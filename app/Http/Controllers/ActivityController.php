<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use \App\User;
use \App\Activity;
use \App\Log;
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
            //User is Admin
            if(Auth::user()->isAdmin()){
                //get all users except admin
                $users = User::all()->except(Auth::id());
                $lists_active = Log::orderBy('created_at', 'desc')->where('status', '=', 0)->paginate(5);
                $lists_approve = Log::orderBy('created_at', 'desc')->where('status', '=', 1)->get();
                // return $lists;
                return view('admin.index', ['lists_active' => $lists_active, 'lists_approve' => $lists_approve, 'users' => $users]);
            }else{
                //User Has Post
                $user = Auth::user()->id;
                $activities = DB::table('activities')->where("user_id", "=", $user)->latest()->get();
                $lists = DB::table('logs')->where("user_id", "=", $user)->latest()->get();
                $lists = Log::orderBy('created_at', 'desc')->where("user_id", "=", $user)->paginate(5);
                // $posts = Post::all();
                return view('activities.index', ['activities' => $activities, 'lists' => $lists]);		
                }
        }else{
            //User Has No Post
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

        $date = Carbon::now('Asia/Manila')->toDateTimeString();
        $activity->activity_name = $request->input('activity_name');
        $activity->created_at = $date;
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
