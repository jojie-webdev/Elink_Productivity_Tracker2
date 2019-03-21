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
<!-- <div class="row">
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
</div> -->
<br />

 <div class="form-group" style="margin-bottom: 4em!important;">
    <form name="search" id="search" action="{{url('search')}}" method="GET">
        <input type="hidden" name="_method" value="SEARCH">
        {{ csrf_field() }}
        <div class="col-lg-1" style="width: 2.333333%;">
            <span class="fa fa-filter" title="Filter By" style="color: #777777; font-size: 18px; padding: 5px"></span>
        </div>
        <div class="col-lg-3"  style="float: left;">
            <select class="form-control" name="year" id="year" required>
                <option value=" ">Year</option>
                <option value="2018">2018</option>
                <option value="2019">2019</option>
                <option value="2020">2020</option>
            </select>
        </div>
        <div class="col-lg-3" style="float: left;">
            <select class="form-control" name="month" id="month" required>
                <option value="all">Show All</option>
                <option value="01">January</option>
                <option value="02">February</option>
                <option value="03">March</option>
                <option value="04">April</option>
                <option value="05">May</option>
                <option value="06">June</option>
                <option value="07">July</option>
                <option value="08">August</option>
                <option value="09">September</option>
                <option value="10">October</option>
                <option value="11">November</option>
                <option value="12">December</option>
            </select>
        </div>
        <input type="submit" class="btn btn-primary" value="SEARCH"  style="float: left;">
    </form>
</div>
<hr />


@include('admin.tabLogs')

<script>
    $(document).ready(function() { 
 
        $('#submit').attr("disabled",true);

        $('.cbox').change(function() {
            $('#submit').attr('disabled', $('.cbox:checked').length == 0);
        });

    });
</script>
@endsection