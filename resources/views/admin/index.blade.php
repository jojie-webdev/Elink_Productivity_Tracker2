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
    <div class="col-md-7">
        <div class="card">
            <div class="card-header">
                <h3>Users</h3>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>NAME</th>
                            <th>EMAIL</th>
                            <th>DEPARTMENT</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->department}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div> 
</div>
<br />
<!-- LIST OF ALL ACTIVITIES -->
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3>To be approved</h3>
            </div>
            <div class="card-body">
                <form action="{{url('admin')}}" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="_method" value="POST">
                    {{ csrf_field() }}
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
                            <th>ACTION</th>
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
                                <td><input class="form-control cbox" style="height: calc(1.19rem + 2px);" type="checkbox" name="approved[]" value="{{$list->id}}" /></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                    <input id="submit" name="submit" type="submit" class="btn btn-primary activity_button_done" value="Submit">
                </form>
            </div>
        </div>
    </div> 
</div>

<script>
    $(document).ready(function() { 
 
        $('#submit').attr("disabled",true);

        $('.cbox').change(function() {
            $('#submit').attr('disabled', $('.cbox:checked').length == 0);
        });

    });
</script>
@endsection