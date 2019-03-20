@extends('layouts.app')

@section('content')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<!-- LIST OF ALL ACTIVITIES -->
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3>List of Activities</h3>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>NAME</th>
                            <th>TITLE</th>
                            <th>TIME CONSUME</th>
                            <th>PROF OF OUTPUT</th>
                            <th>OPTIONAL INFO</th>
                            <th>STATUS</th>
                            <th>DATE</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($lists as $list)
                            <tr>
                                <td>{{$list->user->name}}</td>
                                <td>{{$list->activity_name}}</td>
                                <td>{{$list->activity_time_consume}}</td>
                                <td>
                                    <a href="{{ asset('public/uploads/'.$list->prof_of_output) }}">download file</a>
                                </td>
                                <td>{{$list->message}}
                                <td>
                                    @if ($list->status === 0  )
                                        <h5 style="color: blue;">Submitted</h5>
                                    @else
                                        <h5>Approved</h5>
                                    @endif
                                </td>
                                <td>{{$list->created_at}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div> 
</div>
@endsection