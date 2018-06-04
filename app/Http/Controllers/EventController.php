<?php

namespace App\Http\Controllers;
use App\Event;

use App\Photographer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use DB;
use QrCode;
use Alert;
use Illuminate\Support\Facades\Storage;
use Larareko\Rekognition\Rekognition;


class EventController extends Controller
{
    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required',
            'place'=>'required',
            'date'=>'required',
            'type'=>'required'
        ]);

        $event = new Event();
        $event->name = $request->name;
        $event->place = $request->place;
        $event->date = $request->date;
        $event->type = $request->type;

        $p=Photographer::where('user_id',Auth::user()->id)->first();
        $event->photographer_id = $p->id;
        $event->save();
        $event->qr='img/qrs/'.$event->id.'.png';
        $event->update();

        QrCode::format('png');
        QrCode::size(400);
        QrCode::generate('https://ingmauriciopl.000webhostapp.com/subscribeurl'.$event->id ,'img/qrs/'.$event->id.'.png');

        Session::flash('message-success','Los Datos fueron creados exitosamente');

        $events = Event::all();
        flash('event succesfully created')->success();
        return view('photographers.index')->with(['events'=>$events]);  
    }


    public function view_event($id)
    {
        $event=Event::where('id',$id)->first();
        if(Auth::user()->type==1){//cliente
            return view('clients.view_event')->with(['event'=>$event]);
        }

     return view('photographers.view_event')->with(['event'=>$event]);
    }




}
