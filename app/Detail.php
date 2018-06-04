<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{
    protected $fillable = ['order_id','photo_id','price','qty','subtotal'];

    public function order(){
        return $this->belongsTo('App\Order');
    }

    public function photo(){
        return $this->belongsTo('App\Photo');
    }
}
