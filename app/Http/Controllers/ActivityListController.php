<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use \App\ActivityList;
use \App\Activity;
use DB;

class ActivityListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        // return $request->file('prof_of_output');
        $user_id = Auth::user()->id;
        $activitylist = new ActivityList($request->all());

        $data = $request->validate([
            'activity_name' => 'required',
        ]);
 
        $image = " ";

        //If has a image to be uploaded
        if($request->hasfile('prof_of_output')) 
        { 
            $file = $request->file('prof_of_output');
            $extension = rand() .'.'.$file->getClientOriginalExtension(); // getting image extension
            $filename =time().'.'.$extension;
            $file->move(public_path("uploads/"), $filename);
            $activitylist->prof_of_output = $filename;
        }


        $activitylist->activity_name = $request->input('activity_name');
        $activitylist->activity_time_consume = $request->input('activity_time_consume');
        $activitylist->message = $request->input('message');
        $activitylist->status = 0;
        $activitylist->user_id = $user_id;
        $activitylist->save();
        return back()->with('message', 'Activity Done and Posted!');
 
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
