<?php

namespace App\Http\Controllers;

use App\Client;
use App\Detail;
use App\Photo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ClientController extends Controller
{
    public function myphotos()
    {
        $c=Client::where('user_id',Auth::user()->id)->first();
        $photos = DB::table('photos as p')
            ->select('p.id','p.url','p.name')
            ->join('details as d','d.photo_id','p.id')
            ->join('orders as o','o.id','d.order_id')
            ->where('o.client_id',$c->id)
            ->get();
        return view('clients.myphotos')->with(['photos'=>$photos]);
    }



}
