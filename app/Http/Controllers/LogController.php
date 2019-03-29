<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use \App\Log;
use DateTime;
use Carbon\Carbon;
use DB;

class LogController extends Controller
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
        // return $request->input('activity_id');
        $user_id = Auth::user()->id;
        $activity_id = $request->input('activity_id');
        $activitylist = new Log($request->all());

        $data = $request->validate([
            'activity_name' => 'required',
        ]);
 
        $image = " ";

        //If has a file to be uploaded
        if($request->hasfile('prof_of_output')) 
        { 
            $file = $request->file('prof_of_output');
            $extension = rand() .'.'.$file->getClientOriginalExtension(); // getting image extension
            $filename =time().'.'.$extension;
            $file->move(public_path("uploads/"), $filename);
            $activitylist->prof_of_output = $filename;
        }

        $start_time1 = $request->input('activity_time_consume');
        $end_time1 = Carbon::now('Asia/Manila')->toDateTimeString();

        $start_time = Carbon::parse($start_time1);
        $end_time = Carbon::parse($end_time1);

        $minutes = $start_time->diffInMinutes($end_time);
        function convertToHoursMins($minutes, $format = '%02d:%02d') {
            if ($minutes < 1) {
                return;
            }
    
            $hours = floor($minutes / 60);
            $minutes = floor($minutes % 60);
            return sprintf($format,  $hours, $minutes);
        }
        
       $activity_time_consume = convertToHoursMins($minutes, " %02d hour's %02d minute's");

        $activitylist->activity_name = $request->input('activity_name');
        $activitylist->start_time = $start_time1;
        $activitylist->activity_time_consume = $activity_time_consume;
        $activitylist->message = $request->input('message');
        $activitylist->status = 0;
        $activitylist->user_id = $user_id;
        $activitylist->created_at = $end_time;

        DB::table('activities')->where('id', '=', $activity_id)->delete();

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
