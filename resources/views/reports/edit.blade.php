@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <form id="giomales" method="POST" action="{{ route('daily.update', $reportactivity->id)}}">
    {{ method_field('PUT') }}
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="panel-heading">Daily Report</div>
                <div class="panel-body">
                    <form class="form-horizontal" >
                        {{ csrf_field() }}
                        <input type="hidden" name="user" id="user" value="{{Auth::user()->id}}">
                        <div class="col-md-6">
                        <label> Date </label>
                                <input id="date" type="date" class="form-control" name="date" value ="{{$reports->date}}" required>
                                <!-- <input id="date" type="date" class="form-control" name="date" value ="{{ Carbon\Carbon::now()}}" required autofocus> -->
                        </div> 
                      
                    </form>
                </div>
            </div>
            <button type ="button" class="btn btn-success" id="btn1"> <i class="fa fa-plus-circle"> </i> Activities </button> <br> <br>
          <div id="box-activities">
        
          <div class="box box-primary cloningan" id="myactivities">
            <div class="box-header with-border">
              <h3 class="box-title">My Report</h3>
              <button class="btn btn-box-tool delbutton" type="button"><i class="fa fa-times"></i></button>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            
            <div class="box-body" id="activitybox">
              
              <!-- <form class="form-main"> -->
                <div class="form-block">
                  <div class="form-group">
                    <label for="Project">Project</label>
                    <select class="form-control ini" name="project_id">
                      @foreach($project as $projects)
                      <option name="project_id" id="project_id" value="{{$projects->id}}" {{ $reportactivity->project_id  == $projects->id ? 'selected' : '' }}>{{$projects->name}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="">Module/Parts</label>
                    <input type="text" class="form-control ini" id="module" name="module" placeholder="Module">
                  </div>
                  <div class="form-group">
                    <label for="">Activity</label>
                    <input type="text" class="form-control ini" id="activity" name="activity" adplaceholder="Activity">
                  </div>
                  <div class="form-group">
                        <label for="Priority">Priority</label>
                        <select class="form-control ini" name="priority">
                          @foreach($priority as $priority)
                          <option id="priority" name="priority" value="{{$priority->id}}" {{ $reportactivity->priority  == $priority->id ? 'selected' : '' }}>{{$priority->priority}}</option>
                          @endforeach
                        </select>
                  </div>
                  <div class="form-group">
                      <label for="Status">Status</label>
                      <select class="form-control ini" name="status">
                        @foreach($status as $status)
                        <option id="status" name="status" value="{{$data = $status->id }}" {{ $reportactivity->status  == $status->id ? 'selected' : '' }}>{{$status->name}}</option>
                        @endforeach
                      </select>
                  </div>
                </div>
              <!-- </form> -->
                <!-- /.box-body -->

                
              </div>
               
            </div>
            </div>
            <div class="box-footer">
            <button type="submit" class="btn btn-primary">Update</button>
          </div> 
          </div>
          
        </div>
    </form>

  </div>
</div>

@endsection

@section('script')
<script>  

var count = 1;

 
          // Global unique counter
    $('#btn1').click(function() {
        count++; // Increment counter
        $('.cloningan:first').clone(true).appendTo('#box-activities'). // Clone and append
          filter('[id]').each(function() { // For each new item with an ID
            this.id = this.id + '_' + count; // Append the counter to the ID
        });
    });

  $(document).on("click", ".delbutton", function() {
      // console.log($(".cloningan").length);
      if ($(".cloningan").length > 1) {
        $(this).parent().parent().remove();
      } else {
        alert("You can't remove this activity");
      }
  });

  $(document).on('submit', 'form', function(){
    $(this).find('.cloningan').each(function (i, el) {
      $(el).find('.ini').each(function(j, fel){
        var name = $(fel).attr('name');
        $(fel).attr('name', 'activities['+i+']['+name+']');
      });
    });
  });


// $("#delbutton").click(function () {
//         var divCount = $("#myacitivities").children("div[id=activitybox]").length;
//         while (divCount > 1) // comparing with 1 beacuse: It will keep default div and remove/ rest
//     {       
//       $("#myactivities").children("div[id=activitybox]:last").remove();
//       divCount;
//     }
//  });
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
@endsection
            
                       