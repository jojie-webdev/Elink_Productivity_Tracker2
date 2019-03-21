
<!-- https://www.tutorialrepublic.com/twitter-bootstrap-tutorial/bootstrap-tabs.php -->
<script type="text/javascript">
$(document).ready(function(){ 
    $("#myTab li:eq(1) a").tab('show');
});
</script>
<style type="text/css">
	.bs-example{
		margin: 20px;
	}
</style>
<div class="bs-example">
    <ul class="nav nav-tabs" id="myTab">
        <li><a data-toggle="tab" href="#sectionA">ACTIVE</a></li>
        &nbsp;&nbsp;|&nbsp;&nbsp;
        <li><a data-toggle="tab" href="#sectionB">APPROVED</a></li>
    </ul>
    <div class="tab-content">
        <div id="sectionA" class="tab-pane fade in active">
            <!-- LIST OF ALL ACTIVITIES TO BE APPROVED -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3>ACTIVE</h3>
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
                                        @if ($list->status === 0  )
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
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                                <input id="submit" name="submit" type="submit" class="btn btn-primary activity_button_done" value="Submit">
                            </form>
                        </div>
                    </div>
                </div> 
            </div>
        </div>
        <div id="sectionB" class="tab-pane fade">
             <!-- LIST OF ALL ACTIVITIES APPROVED-->
             <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3>APPROVED</h3>
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
                                        @if ($list->status === 1  )
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
                                                    <h5 style="background: green; color: #fff; text-align: center;">Approved</h5>
                                                    @endif
                                                </td>
                                                <td>{{$list->approved_date}}</td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div> 
            </div>
        </div>
    </div>
</div>
