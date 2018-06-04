<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Client;
use App\Detail;
use App\Event;
use PayPal\Api\Payer;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Amount;
use PayPal\Api\Transaction;
use Validator;
use URL;
//use DB;
use Session;
use Redirect;
use Input;
use Auth;
use Illuminate\Support\Facades\DB;
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use Illuminate\Foundation\Bus\DispatchesCommands;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\ExecutePayment;
use PayPal\Api\PaymentExecution;
use App\Order;



class PaypalController extends Controller
{
    private $_api_context;

    public function __construct()
    {
        $paypal_conf = \Config::get('paypal');
        $this->_api_context = new ApiContext(new OAuthTokenCredential($paypal_conf['client_id'], $paypal_conf['secret']));
        $this->_api_context->setConfig($paypal_conf['settings']);
    }

    public function postPayment(){
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');
        $items = array();
        $subtotal = 0;
        $currency = 'USD';

        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        foreach($cart->items as $it){
            $item = new Item();
            $item->setName('Photo')
                ->setCurrency($currency)
                ->setDescription('great photo')
                ->setQuantity($it['qty'])
                ->setPrice($it['price']);
            $items[] = $item;
            $subtotal += $it['price'];
        }
        $item_list = new ItemList();
        $item_list->setItems($items);

        $amount = new Amount();
        $amount->setCurrency($currency)
            ->setTotal($subtotal);

        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($item_list)
            ->setDescription('Pedido de prueba en mi Laravel App Store');

        $redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl(\URL::route('payment.status'))
            ->setCancelUrl(\URL::route('payment.status'));

        $payment = new Payment();
        $payment->setIntent('Sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirect_urls)
            ->setTransactions(array($transaction));
        try {
            $payment->create($this->_api_context);
        } catch (\PayPal\Exception\PPConnectionException $ex) {
            if (\Config::get('app.debug')) {
                echo "Exception: " . $ex->getMessage() . PHP_EOL;
                $err_data = json_decode($ex->getData(), true);
                exit;
            } else {
                die('Ups! Algo salió mal');
            }
        }
        foreach($payment->getLinks() as $link) {
            if($link->getRel() == 'approval_url') {
                $redirect_url = $link->getHref();
                break;
            }
        }
        // add payment ID to session
        \Session::put('paypal_payment_id', $payment->getId());
        if(isset($redirect_url)) {
            // redirect to paypal
            return \Redirect::away($redirect_url);
        }
        return \Redirect::route('cart-show')
            ->with('error', 'Ups! Error desconocido.');
    }


    public function getPaymentStatus()
    {
        $payment_id = \Session::get('paypal_payment_id');
        \Session::forget('paypal_payment_id');
        $payerId = \Input::get('PayerID');
        $token = \Input::get('token');
        if (empty($payerId) || empty($token)) {
            return \Redirect::route('home')
                ->with('message', 'Hubo un problema al intentar pagar con Paypal');
        }
        $payment = Payment::get($payment_id, $this->_api_context);
        $execution = new PaymentExecution();
        $execution->setPayerId(\Input::get('PayerID'));
        $result = $payment->execute($execution, $this->_api_context);
        if ($result->getState() == 'approved') { // payment made
            $oldCart = Session::get('cart');
            $cart = new Cart($oldCart);

            $c=Client::where('user_id',Auth::user()->id)->first();
            $order = new Order();
            $order->client_id = $c->id;
            $order->type = 1;
            $order->total = $cart->totalPrice;
            $order->save();

            foreach ($cart->items as $item) {
                $detail = new Detail();
                $detail->order_id = $order->id;
                $detail->photo_id =  $item['item']['id'];;
                $detail->price = $item['price'];
                $detail->qty = $item ['qty'];
                $detail->subtotal = $item['price']*$item ['qty'];
                $detail->save();
            }
            \Session::forget('cart');
            Session::flash('message-success','La compra fue realizada exitosamente');

            $c=Client::where('user_id',Auth::user()->id)->first();
            $photos = DB::table('photos as p')
                ->select('p.id','p.url','p.name')
                ->join('details as d','d.photo_id','p.id')
                ->join('orders as o','o.id','d.order_id')
                ->where('o.client_id',$c->id)
                ->get();

            flash('transaction succesfully completed')->success();
            return view('clients.myphotos')->with(['photos'=>$photos]);
        }
        $events = Event::all();
        return view('clients.index')->with(['events'=>$events]);
    }


}
