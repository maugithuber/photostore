<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    protected $fillable = [
        'client_id','event_id','date'
    ];
    public function event(){
        return $this->belongsTo('App\Event');
    }
    public function client(){
        return $this->belongsTo('App\Client');
    }
}
