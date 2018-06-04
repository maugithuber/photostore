<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\Bitacora;
use Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $this->validate($request,[
            'status'=>'required',
        ]);
        $order = Order::find($id);
        $order->status = $request->status;


        if($order->save()){
            $bitacora = new Bitacora();
            $bitacora->table = 'orders';
            $bitacora->action = 'se actualizo la oreden a: '.  $order->status;
            $bitacora->user_id = Auth::user()->id;
            $bitacora->save();
            return back()->with("msj","Datos actualizados");
        }else{
            return back()->with("errormsj","DATOS INVALIDOS");
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'status'=>'required',
            'delivery_id'=>'required'
        ]);
        $order = Order::find($id);
        $order->status = $request->status;
        $order->delivery_id = $request->delivery_id;



        if($order->save()){
            $bitacora = new Bitacora();
            $bitacora->table = 'orders';
            $bitacora->action = 'se actualizo la oreden: '.$order->id.' al estado: '.  $order->status.' y se le asigno el delivery: '.$request->delivery_id;
            $bitacora->user_id = Auth::user()->id;
            $bitacora->save();
            return back()->with("msj","Datos actualizados");
        }else{
            return back()->with("errormsj","DATOS INVALIDOS");
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
