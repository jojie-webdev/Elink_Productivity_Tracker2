<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use \App\Activity;
use Carbon\Carbon;
use DateTime;
use DB;


class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::check()){
            //User Has Post
            $user = Auth::user()->id;
            $activities = DB::table('activities')->where("user_id", "=", $user)->latest()->get();
            $lists = DB::table('lists')->where("user_id", "=", $user)->latest()->get();
            // $posts = Post::all();
            return view('activities.index', ['activities' => $activities, 'lists' => $lists]);
            
        }else{
            return redirect('/login');	
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user()->id;
        $activity = new Activity($request->all());

        $data = $request->validate([
            'activity_name' => 'required'
        ]);

        $activity->activity_name = $request->input('activity_name');
        $activity->user_id = $user;

        $activity->save();   
        return back()->with('message', 'Activity Created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
