<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Tweet;
use App\User;

class Like extends Model
{
    public function use()
    {
        return $this->belongsTo('App\User');
    }

    public function Tweet()
    {
        return $this->belongsTo('App\Tweet');
    }
}
