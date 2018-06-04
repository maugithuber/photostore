<?php

namespace App;
use Illuminate\Notifications\Notifiable;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use Notifiable;


    protected $fillable = [
        'name', 'place', 'date','qr','image_id','available'
    ];
    

    public function photos(){
        return $this-hasMany('App\Photo');
    }
    public function subscriptions(){
        return $this-hasMany('App\Subscription');
    }
}
