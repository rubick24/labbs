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
     * scope
     */
    public function scopeVerified($query,$type=true)
    {
        return $query->where('status', $type);
    }

    public static function unratified(){
        $result = [];
        $i=0;
        foreach (User::verified()->get() as $user ){
            if ($user->hasRole('member')||$user->hasRole('owner')){
                ;
            }
            else {
                $result[$i] = $user;
                $i++;
            }
        }
        return $result;
    }

    /**
     * relations
     */
    public function articles(){
        return $this->hasMany('App\Article');
    }

    public function comments(){
        return $this->hasMany('App\Comment');
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
