<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tweet;
use Illuminate\Support\Facades\Auth;

class TweetController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }   //ログインしていないといかない

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function store( Request $req )
    {
        $tweets = new Tweet;
        $tweets->user_id = Auth::id();
        $tweets->tweet = $req->tweet;
        $tweets->save();
        return redirect("/home");
    }
    
    

}






