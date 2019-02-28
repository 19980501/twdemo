<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Like;
use App\User;

class Tweet extends Model
{
	public function user(){
		return $this->belongsTo('App\User');

		
	}
	public function getData(){

		return $this->user->name; 
	}














	public function use()
	{
		return $this->belongsTo('App\User');
	}

	public function likes()
	{
		return $this->hasMany('App\Like');
	}

}
