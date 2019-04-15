<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use \App\User;
use \App\Log;
use DB;
use Excel;
use Response;

class SearchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $month = $request->input('month');
        $year = $request->input('year');

        if ($month !== 'all') {
            $users = User::all()->except(Auth::id());
            $lists_approve = Log::orderBy('created_at', 'desc')
                    ->whereYear('created_at', '=', $year)
                    ->whereMonth('created_at', '=', $month)
                    ->get();
            $lists_active = Log::orderBy('created_at', 'desc')
                    ->whereYear('created_at', '=', $year)
                    ->whereMonth('created_at', '=', $month)
                    ->where('status', '=', 0)->paginate(5);
            // return $lists;
            return view('admin.index', ['lists_approve' => $lists_approve, 'lists_active' => $lists_active, 'users' => $users]);
        }   

        $users = User::all()->except(Auth::id());
        $lists_approve = Log::orderBy('created_at', 'desc')
                    ->get();
            $lists_active = Log::orderBy('created_at', 'desc')
                    ->where('status', '=', 0)->paginate(5);
        // return $lists;
        return view('admin.index', ['lists_approve' => $lists_approve, 'lists_active' => $lists_active, 'users' => $users]);
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
        //
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

    public function allLogsCsv()
    {

        // $data = Log::whereDate('created_at','=', date('Y-m-d'))->get();

        $name = Log::join('users', 'logs.user_id', '=', 'users.id')
            ->select('logs.*', 'users.name')
            ->get();

        $table = Log::whereDate('created_at', '=', date('Y-m-d'))
            ->get();

        $filename = "logs.csv";
        $handle = fopen($filename, 'w+');
        fputcsv($handle, array('Name', 'Title', 'Productivty Time', 'Message', 'Date'));
    
        foreach($name as $row) {

            fputcsv($handle, array($row['name'], $row['activity_name'], $row['activity_time_consume'], $row['message'], $row['created_at']));
        }
    
        fclose($handle);
    
        $headers = array(
            'Content-Type' => 'text/csv',
        );
    
        return Response::download($filename, 'logs.csv', $headers);
    }
}
