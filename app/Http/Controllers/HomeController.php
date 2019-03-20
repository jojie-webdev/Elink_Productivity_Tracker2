<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return 'test';
        if(Auth::check()){
            //User is Admin
            if(Auth::user()->isAdmin()){
                $lists = DB::table('lists')->latest()->get();
                // $posts = Post::all();
                return view('admin.index', ['lists' => $lists]);
            }else{
                //User Has Post
                $user = Auth::user()->id;
                $activities = DB::table('activities')->where("user_id", "=", $user)->latest()->get();
                $lists = DB::table('lists')->where("user_id", "=", $user)->latest()->get();
                // $posts = Post::all();
                return view('activities.index', ['activities' => $activities, 'lists' => $lists]);		
                }
        }else{
            //User Has No Post
            return redirect('walay post');	
        }

    }
}
