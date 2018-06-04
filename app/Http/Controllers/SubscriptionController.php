<?php

namespace App\Http\Controllers;
use Auth;
use App\Client;
use App\Event;
use App\Subscription;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function subscribe(Request $request){
        $event= Event::where('id',$request->code)->first();
        $client =Client::where('user_id',Auth::user()->id)->first();

        if($event != null){ //codigo valido
            $sc= Subscription::where('client_id',$client->id)->where('event_id',$event->id)->first();
            if($sc==null){ //verificar si ya esta susbcrito
                $sub= new Subscription();
                $sub->client_id=$client->id;
                $sub->event_id=$event->id;
                $sub->save();

                $subs= Subscription::where('client_id',$client->id)->get();
                flash('you have just subscribed to: '.$event->name)->success();
                return view('clients.index')->with(['subs'=>$subs]);
            }else{
                $subs= Subscription::where('client_id',$client->id)->get();
                flash('you are already subscribed to: '.$event->name)->warning();
                return view('clients.index')->with(['subs'=>$subs]);
            }


        }else{
            $subs= Subscription::where('client_id',$client->id)->get();
            flash('incorrect code')->error();
            return view('clients.index')->with(['subs'=>$subs]);
        }

    }
    public function subscribeurl($id){
        $event= Event::where('id',$id)->first();
        $client =Client::where('user_id',Auth::user()->id)->first();

        if($event != null){ //codigo valido
            $sc= Subscription::where('client_id',$client->id)->where('event_id',$event->id)->first();
            if($sc==null){ //verificar si ya esta susbcrito
                $sub= new Subscription();
                $sub->client_id=$client->id;
                $sub->event_id=$event->id;
                $sub->save();

                $subs= Subscription::where('client_id',$client->id)->get();
                flash('you have just subscribed to: '.$event->name)->success();
                return view('clients.index')->with(['subs'=>$subs]);
            }else{
                $subs= Subscription::where('client_id',$client->id)->get();
                flash('you are already subscribed to: '.$event->name)->warning();
                return view('clients.index')->with(['subs'=>$subs]);
            }


        }else{
            $subs= Subscription::where('client_id',$client->id)->get();
            flash('incorrect code')->error();
            return view('clients.index')->with(['subs'=>$subs]);
        }

    }
}
