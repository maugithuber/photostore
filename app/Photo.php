<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $fillable = ['event_id','url','price','available','image_id','name'];

    public function event(){
        return $this->belongsTo('App\Event');
    }
    public function user(){
        return $this->belongsTo('App\User');
    }
    public function orders(){
        return $this->hasMany('App\Order');
    }
    public function detail(){
        return $this->hasOne('App\Detail');
    }
}
