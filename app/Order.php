<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['user_id','date','total','type'];

    public function details(){
        return $this->hasMany('App\Detail');
    }

    public function client(){
        return $this->belongsTo('App\Client');
    }
}
