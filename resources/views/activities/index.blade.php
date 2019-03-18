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
<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h3>Create Activity Here</h3>
            </div>
            <div class="card-body">
                <!-- Add blog -->
                <form class="article" action="{{ url('activities') }}" method="POST" enctype="multipart/form-data" class="add-note">
                {{ csrf_field() }}
                        <div class="form-group">
                            <label class="col-lg-12 control-label">Title</label>
                            <div class="col-lg-12">
                                <input class="form-control file" name="activity_name" type="text" required>
                            </div>
                        </div>
                        <!-- <div class="form-group">
                            <label class="col-lg-12 control-label">Start Time</label>
                            <div class="col-lg-12">
                                <div id="play-timer"><div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-12 control-label">End Time</label>
                            <div class="col-lg-12">
                                <input class="form-control file" name="activity_end_time" type="text" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-12 control-label">Prof of Output</label>
                            <div class="col-lg-12">
                                <textarea class="form-control" name="prof_of_output" type="text" required>
                                </textarea>  
                            </div>
                        </div> -->
                        <div class="form-group">
                            <div class="col-lg-12">
                                <input type="submit" class="btn btn-primary" value="Submit">
                            </div>
                        </div>
                </form><!-- Form END -->
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h3>Current Activity</h3>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>TITLE</th>
                            <th>TIMER</th>
                            <th>PROF OF OUTPUT</th>
                            <th>OPTIONAL INFO</th>
                            <th>ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($activities as $activity)
                            <tr>
                                <td>{{$activity->activity_name}}</td>
                                <td>
                                    <button class=" startPause btn btn-primary" onclick="startPause()">Start</button>
                                    <!-- <button id="startPause" onclick="startPause()">Play</button> -->
                                    <p class="demo"></p>
                                </td>
                                <td>
                                    <input type="file" class="file" name="prof_of_output" required>
                                </td>
                                <td>
                                    <textarea class="form-control" name="message" type="text" required>
                                    </textarea>  
                                </td>
                                <td>
                                    <input type="submit" class="btn btn-primary" value="Submit">
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
   
</div>

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
                            <th>TITLE</th>
                            <th>TIMER</th>
                            <th>PROF OF OUTPUT</th>
                            <th>OPTIONAL INFO</th>
                            <th>STATUS</th>
                            <th>DATE</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($activities as $activity)
                            <tr>
                                <td>DATA</td>
                                <td>DATA</td>
                                <td>DATA</td>
                                <td>DATA</td>
                                <td>DATA</td>
                                <td>DATA</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
   
</div>

<script>
    //https://www.youtube.com/watch?v=kDnfrlK2CLg
    function startTime() {
        var dateNow = Date.now();
        $('.play-timer').html(dateNow);
        // document.getElementById("play-timer").innerHTML = dateNow;
    }

    var running = 0;   
    var time = 0;
    
    function startPause() {
        if(running == 0) {
            running = 1;
            increment();
            $('.startPause').html("Pause");
            // document.getElementById('startPause').innerHTML ="Pause" ;
        } else {
            running = 0;
            $('.startPause').html("Resume");
            // document.getElementById('startPause').innerHTML ="Resume" ;
        }
    }

    function increment() {
        if(running == 1) {
            setTimeout(function(){ 
        
                time++;
                var mins = Math.floor(time/10/60);
                var secs = Math.floor(time/10%60);

                var hours = (mins / 60);
                var rhours = Math.floor(hours);

                var tenths = time % 10;

                if(rhours < 10) {
                    rhours = "0" +rhours;
                }

                if(mins < 10) {
                    mins = "0" +mins;
                }
                if(secs < 10) {
                    secs = "0" +secs;
                }

                var timer = rhours + ":" + mins + ":" + secs + ":" + tenths ;
                $('.demo').html(timer);

                // document.getElementById('demo').innerHTML = rhours + ":" + mins + ":" + secs + ":" + tenths ;
                increment();
            }, 100);
        }
    }

</script>
@endsection
