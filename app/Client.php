<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
        'user_id', 'face_id'
    ];
    public function user(){
        return $this->belongsTo('App\User');
    }
    public function subscriptions(){
        return $this-hasMany('App\Subscription');
    }
    public function orders(){
        return $this-hasMany('App\Order');
    }
}
