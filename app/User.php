<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laratrust\Traits\LaratrustUserTrait;

class User extends Authenticatable
{
    use LaratrustUserTrait;
    use Notifiable;

    /**
     * relations
     */
    public function articles(){
        return $this->hasMany('App\Article');
    }

    public function comments(){
        return $this->hasMany('App\Comment');
    }

    public function receivedMessages(){
        return $this->hasMany('App\Message','user_id','id');
    }

    public function sentMessages(){
        return $this->hasMany('App\Message','sender_id','id');
    }

    public function photos(){
        return $this->hasMany('App\Photo');
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
