<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Like;
use App\Tweet;

class User extends Authenticatable
{
   public function tweets(){
       return $this->hasMany('App\Tweet','user_id','id');




   }
   use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];











    public function Tweet()
    {
        return $this->hasMany('App\Tweet');
    }

    public function likes()
    {
        return $this->hasMany('App\Like');
    }
}
