@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <form method="POST" action="{{ route('daily.store')}}">
        <div class="col-md-8">
            <div class="box box-primary">
                <div class="panel-heading">Daily Report</div>

                <div class="panel-body">
                    <form class="form-horizontal" >
                        {{ csrf_field() }}
                        <input type="hidden" name="user" id="user" value="{{Auth::user()->id}}">
                        <div class="col-md-6">
                        <label> Date </label>
                                <input id="date" type="date" class="form-control" name="date" value ="{{ date('Y-m-d', strtotime('now')) }}" required autofocus>
                                <!-- <input id="date" type="date" class="form-control" name="date" value ="{{ Carbon\Carbon::now()}}" required autofocus> -->
                        </div> 
                      
                    </form>
                </div>
            </div>

            <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Daily Report</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <div class="box-body">
              <div class="form-group">
                  <label for="Project">Project</label>
                  <select class="form-control" name="project">
                    @foreach($project as $projects)
                    <option name="project" id="project" value="{{$data = $projects->id}}">{{$projects->name}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label for="">Module/Parts</label>
                  <input type="text" class="form-control" id="module" name="module" placeholder="Module">
                </div>
                <div class="form-group">
                  <label for="">Activity</label>
                  <input type="text" class="form-control" id="activity" name="activity" adplaceholder="Activity">
                </div>
              
                  <div class="form-group">
                      <label for="Priority">Priority</label>
                      <select class="form-control" name="priority">
                        @foreach($priority as $priority)
                        <option id="priority" name="priority" value="{{$data = $priority->id}}">{{$priority->priority}}</option>
                        @endforeach
                      </select>
                    </div>


                  <div class="form-group">
                    <label for="Status">Status</label>
                    <select class="form-control" name="status">
                      @foreach($status as $status)
                      <option id="status" name="status" value="{{$data = $status->status }}">{{$status->status}}</option>
                      @endforeach
                    </select>
                  </div>

              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
             
              </div>
            </div>
          </div>

        </div>
    </form>

  </div>
</div>

@endsection
                       