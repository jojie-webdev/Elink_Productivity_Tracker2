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
                <form action="{{ url('activities') }}" method="post">
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
                                <input type="submit" class=" btn btn-primary" value="Submit">
                            </div>
                        </div>
                </form><!-- Form END -->
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h3>Current Activities</h3>
            </div>
            <div class="card-body">
                <table id="current_activity" class="table table-striped">
                    <thead>
                        <tr>
                            <th>TITLE</th>
                            <th>CREATED AT</th>
                            <th>OPTIONAL INFO</th>
                            <th>PROF OF OUT PUT &nbsp; &nbsp; &nbsp; &nbsp; | &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($activities as $activity)
                            <tr>
                            <td class="activity_id" hidden>{{$activity->id}}</td>
                                <td class="activity_name">{{$activity->activity_name}}</td>
                                <td class="activity_created_at">{{$activity->created_at}}</td>
                                <td>
                                    <textarea class="form-control message" name="message" type="text" required>
                                    </textarea>  
                                </td>
                                <td>
                                    <form action="{{url('logs')}}" method="POST" enctype="multipart/form-data">
                                        <input type="hidden" name="_method" value="POST">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="activity_id" class="get_activity_id" value="name" />
                                        <input type="file" class="file" name="prof_of_output" required style="width: 57%;">
                                        <input type="hidden" name="activity_time_consume" class="get_activity_created_at" value="test"/>
                                        <input type="hidden" name="activity_name" class="get_activity_name" value="name" />
                                        <input type="hidden" name="message" class="get_message" value="messagezzzz" />
                                        <input type="submit" class="btn btn-primary activity_button_done" value="Submit">
                                    </form>
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
                <h3>Logs</h3>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
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

<script>
    $( document ).ready(function() {

        console.log( "ready!" );
        //check if Current Activity has value
        // var tbody = $("#current_activity tbody");
        // if (tbody.children().length == 0) {
        //     // console.log("way sulod");
        //     $("input[type=submit]").removeAttr("disabled");       
        // } else {
        //     console.log("naay sulod");
        //     $(".create_activity_button").attr("disabled", "disabled");
        // }

        //https://www.youtube.com/watch?v=kDnfrlK2CLg


         var date_time = new Date();
         var date = new Date();
                    // $('.demo').html(date);
        $('.play-timer').html(date_time);

         //SUBMIT DONE ACTIVITY
        //  $( "input.btn.btn-primary.done_activity" ).click(function() {
        //     var id = $(this).closest('tr').find('td.p.demo').html();
        //     var activity_time_consume = $('.activity_time_consume').val(id);
        //     alert(activity_time_consume);
        // });

        
        $("input.btn.btn-primary.activity_button_done").click(function(){
            var activity_id = $(this).closest('tr').find('td.activity_id').html();
            var activity_name = $(this).closest('tr').find('td.activity_name').html();
            var activity_created_at = $(this).closest('tr').find('td.activity_created_at').html();
            var message = $('textarea.form-control.message').val();

            var c = $('.get_activity_name').val(activity_name);
            var d = $('.get_activity_created_at').val(activity_created_at);
            var e = $('.get_message').val(message);
                    $('.get_activity_id').val(activity_id);
            // alert('name');
        });
    });

    //START TIMER
    var running = 0;   
        var time = 0;
        var time_consume;
        
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

                    time_consume = rhours + ":" + mins + ":" + secs + ":" + tenths ;
                    var date = new Date();
                    // $('.demo').html(date);

                    // document.getElementById('demo').innerHTML = rhours + ":" + mins + ":" + secs + ":" + tenths ;
                    increment();
                }, 100);
            }
        } //END TIMER 
        
</script>
@endsection
