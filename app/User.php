<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    protected $fillable = [
        'name', 'email', 'password','photo','type','phone'
    ];
    
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function clients(){
        return $this->hasMany('App\Client');
    }
    public function photographers(){
        return $this->hasMany('App\Photographer');
    }
}
