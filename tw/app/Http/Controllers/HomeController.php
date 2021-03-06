<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tweet;
use App\Follow;
use Illuminate\Support\Facades\Auth;
use App\User;

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

        // //イマログインしているユーザーが今まで何こツイートしてるか
        // $my_user = User::find(Auth::id());
        // $count = count($my_user->tweets);
        // dd($count);


        $follows = Follow::where("user_id","=",Auth::id())->get();

        // $follow=['follow_id'];
        $followIds = [];
        foreach ($follows as $follow) {
            $follow = $follow->follow_id; 
            $followIds[] = $follow;

        }
        $followIds[] = Auth::id();


        $tweet = Tweet::wherein("user_id",$followIds)->orderBy("created_at","desc")->get();
        $tweet = Tweet::latest()->paginate(5);

    
        $user_id = User::find(Auth::id());






        $favtweet = [];
        foreach ($user_id->likes as $value) {
            // $favtweet[$value->tweet_id] = '1';

            $favtweet[] = $value->tweet_id;

            # code...
        }

        
        return view('home',
            [
                'tweets'=>$tweet,
                'favtweet' => $favtweet,
            ]);
    }

}
