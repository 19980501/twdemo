<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tweet;
use App\Follow;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
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
    public function index()
    {   

        $follows = Follow::where("user_id","=",Auth::id())->get();

        // $follow=['follow_id'];
        $followIds = [];
        foreach ($follows as $follow) {
            $follow = $follow->follow_id; 
            $followIds[] = $follow;
        
    }
            $followIds[] = Auth::id();


    $tweet = Tweet::wherein("user_id",$followIds)->orderBy("created_at","desc")->get();



    return view('home',['tweets'=>$tweet]);
}

}
