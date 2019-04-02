<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use \App\User;
use \App\Activity;
use \App\Log;
use Carbon\Carbon;
use DB;

class AdminController extends Controller
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
        $logids = $request->input('approved');
        // return $ids = $request->get('lists.ids', approved[]); 
        $date = Carbon::now('Asia/Manila')->toDateTimeString();
        foreach($logids as $id) {
            Log::where('id', $id)
            ->update(['status' => 1, 'approved_date' => $date]);
        }
        return back()->with('message', 'Selected activity approved!');
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

    public function filterByName()
    {
        if(Auth::user()->isAdmin()){
            $users = User::all()->except(Auth::id());
            $data = Log::orderBy('created_at', 'desc')->get();
            // return $data;
            return view('admin.filterByName', ['datas' => $data, 'users' => $users]);
        }
    }

    public function userFetchData(Request $request)
    {
        if(Auth::user()->isAdmin()){
            $id = $request->input('to_user');
            $users = User::all()->except(Auth::id());
            if($id != 'show-all') {
                $data = Log::orderBy('created_at', 'desc')->where('user_id', '=', $id)->get();

                // return $data;
                return view('admin.filterByName', ['datas' => $data, 'users' => $users]);
            } else {
                $data = Log::orderBy('created_at', 'desc')->get();
                // return $data;
                return view('admin.filterByName', ['datas' => $data, 'users' => $users]);
            }
        }

    }

}
