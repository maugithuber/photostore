<?php

namespace App\Http\Controllers;

use App\Photo;
use Illuminate\Http\Request;
use App\Cart;
use Session;
use Larareko\Rekognition\Rekognition;
class DetailController extends Controller
{
    public function add_cart(Request $request, $id)
    {
        $photo = Photo::find($id); //captura el objeto producto
        $oldCart =Session::has('cart') ? Session::get('cart'): null; //guarda en $oldCart  al carrito 
        $cart = new Cart($oldCart);//instancia al modelo Cart con el $oldCart
        $cart->add($photo, $photo->id);// usa la funcion add del modelo Cart

        $request->session()->put('cart',$cart);
        return back();
    }
    public function getCart()
    {
        if(!Session::has('cart')){
            return view('clients.shopping-cart',['products'=>null]);
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);

        

        
        return view('clients.shopping-cart',['products'=>$cart->items, 'totalPrice'=>$cart->totalPrice]);
    }
    public function getRemove($id)
    {
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        $cart->remove($id);
        if(count($cart->items) > 0){
            Session::put('cart',$cart);
        }else{
            Session::forget('cart');
        }
        return back();
    }
}
