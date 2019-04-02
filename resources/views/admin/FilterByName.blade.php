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
<!-- List of users -->
<div class="row">
    <div class="col-md-7" style="margin-bottom: 2em;">
        <div class="card">
            <div class="card-header">
                <h3>Users</h3>
            </div>
            <div class="card-body">
                <form name="search" id="search" action="{{url('admin/userfetchdata')}}" method="GET">
                    <input type="hidden" name="_method" value="SEARCH">
                    {{ csrf_field() }}
                    <select name="to_user"  class="form-control">
                        <option value="show-all">show all</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach`
                    </select>
                    <input type="submit" class="btn btn-primary" value="SEARCH"  style="margin-top: 1em; float: left;">
                </form>
            </div>
        </div>
    </div> 
    
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3>DATA</h3>
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
                            <th>DATE APPROVED</th>
                            <th>DATE CREATED</th>
                        </tr>
                    </thead>
                    <tbody> 
                        @foreach($datas as $data)
                            <tr>
                                <td>{{ $data->user->name}}</td>
                                <td>{{ $data->activity_name}}</td>
                                <td>{{ $data->activity_time_consume}}</td>
                                <td>
                                    <a href="{{ asset('public/uploads/'.$data->prof_of_output) }}">download file</a>
                                </td>
                                <td>{{ $data->message}}
                                <td>
                                    @if ($data->status === 0  )
                                        <h5 style="color: blue;">Submitted</h5>
                                    @else
                                    <h5 style="background: green; color: #fff; text-align: center;">Approved</h5>
                                    @endif
                                </td>
                                <td>
                                    @if ($data->approved_date !== null  )
                                        {{ $data->approved_date}}
                                    @else
                                        0000-00-00 00:00:00
                                    @endif
                                </td>
                                <td>{{ $data->created_at}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div> 
</div>

@endsection