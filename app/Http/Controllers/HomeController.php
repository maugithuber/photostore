<?php

namespace App\Http\Controllers;

use App\Client;
use App\Event;
use App\Photographer;
use App\Subscription;
use Illuminate\Http\Request;
use Auth;
use Alert;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Larareko\Rekognition\Rekognition;
use Illuminate\Support\Collection as Collection;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){

        if( Auth::user()->type == 1){ //cliente
            $client =Client::where('user_id',Auth::user()->id)->first();
            $subs= Subscription::where('client_id',$client->id)->orderBy('id', 'desc')->get();
            return view('clients.index')->with(['subs'=>$subs]);
        }else{
            $photographer =Photographer::where('user_id',Auth::user()->id)->first();
            $events = DB::table('events')->where('photographer_id',$photographer->id)->orderBy('id', 'desc')->get();
            return view('photographers.index')->with(['events'=>$events]);
        }
    }
}



//$client = new Rekognition();
//$client =$client->getClient();
//
//
//        $client->deleteCollection([
//            'CollectionId' => 'profiles', // REQUIRED
//        ]);
//
//        $client->deleteCollection([
//            'CollectionId' => 'myphotos', // REQUIRED
//        ]);
//        ////
//        $result= $client->createCollection([
//            'CollectionId'=>'profiles'
//        ]);
//        $result= $client->createCollection([
//            'CollectionId'=>'myphotos'
//        ]);
//

//        $result = $client->listFaces([
//            'CollectionId' => 'myphotos',
//            'MaxResults' => 100,
//        ]);
////        $result = $client->listCollections([]);
//    dd($result);
//        $result = $client->listCollections([]);
//////
