<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tweet;
use Illuminate\Support\Facades\Auth;
use App\Like;
use App\User;

class LikeController extends Controller
{
    public function like(Request $request)
    {
        $like = new Like;

        $like->user_id = Auth::user()->id;
        $like->tweet_id = $request->id;

        $tweet = Tweet::find($request->id);
        $user = User::find($tweet->user_id);

        $like->save();



        return redirect('/home');
    }

    public function release(Request $request)
    
    { 

        $delid = Like::where('tweet_id', $request->id)
            ->where('user_id',Auth::id());


        $delid->delete();

      return redirect('/home');    
  }



}






