<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Follow;
use Illuminate\Database\Seeder;

class UserController extends Controller
{




    public function index(){

        $follows = Follow::where("user_id","=",Auth::id())->get();

        // $follow=['follow_id'];
        $followIds = [];
        foreach ($follows as $follow) {
            $follow = $follow->follow_id; 
            $followIds[] = $follow;


        }
        

        $users = User::where("id","!=",Auth::id())->get();
        $users = User::paginate(5);

        return view('user.list',["users"=>$users,"followIds"=>$followIds]);
    }










    public function follow( $follow_id){//postでやってみる
        $follow = new Follow;
        $follow->user_id = Auth::id();

        $follow->follow_id = $follow_id;

        
        $follow->save();
        return redirect("/users");
    }


    public function unfollow(Request $request)
    
    { 
       
        $unfollowid = Follow::where('follow_id', $request->id)
        ->where('user_id',Auth::id());


        $unfollowid->delete();

        return redirect('/users');
    }

}






