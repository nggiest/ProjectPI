@extends('layouts.app')

@section('content')
<div class="container">
    <form id="giomales" method="POST" action="{{ route('daily.store')}}">
            <div class="box box-primary">
                <div class="panel-heading"><h3 style="text-align:center">Daily Report </h3></div>
                <div class="panel-body">
                    <div class="form-horizontal" >
                        {{ csrf_field() }}
                        <input type="hidden" name="user" id="user" value="{{Auth::user()->id}}">
                        <label class="col-md-2"> Date </label>
                        <div class="col-md-9">
                                <input id="date" type="date" class="form-control" name="date" value ="{{ date('Y-m-d', strtotime('now')) }}" required autofocus>
                                <!-- <input id="date" type="date" class="form-control" name="date" value ="{{ Carbon\Carbon::now()}}" required autofocus> -->
                        </div> 
                      
                    </div>
                </div>
            </div>
            <button type ="button" class="btn btn-success" id="btn1"> <i class="fa fa-plus-circle"> </i> Activities </button> <br> <br>
            <div id="box-activities">
              <div class="box box-primary cloningan" id="myactivities">
                  <div class="box-title"><h3 style="text-align:center"> My Report 
                    <button class="btn btn-box-tool delbutton" type="button"><i class="fa fa-times"></i></button> </h3>
                  </div>
                  <div class="box-body" id="activitybox">
                    <div class="form-horizontal">
                      <div class="form-group">
                        <label for="Project" class="col-md-2">Project</label>
                          <div class="col-md-9">         
                        <select class="form-control ini" name="project_id">
                          <option name="project_id" id="project_id" value=""> ---Select Project--- </option>
                          @foreach($project as $projects)
                          <option name="project_id" id="project_id" value="{{$data = $projects->id}}">{{$projects->name}}</option>
                          @endforeach
                        </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="" class="col-md-2">Module/Parts</label>
                          <div class="col-md-9">
                        <input type="text" class="form-control ini" id="module" name="module" placeholder="Module">
                          </div>
                      </div>
                      <div class="form-group">
                        <label for="" class="col-md-2">Activity</label>
                          <div class="col-md-9">
                        <input type="text" class="form-control ini" id="activity" name="activity" adplaceholder="Activity">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="Priority "class="col-md-2">Priority</label>
                          <div class="col-md-9">
                            <select class="form-control ini" name="priority">
                              <option name="priority" id="priority" value=""> ---Select Priority--- </option>

                              @foreach($priority as $priority)
                              <option id="priority" name="priority" value="{{$data = $priority->id}}">{{$priority->priority}}</option>
                              @endforeach
                            </select>
                          </div>
                      </div>
                      <div class="form-group">
                          <label for="Status" class="col-md-2">Status</label>
                          <div class="col-md-9">
                            <select class="form-control ini" name="status">
                            <option name="priority" id="priority" value=""> ---Select Priority--- </option>                        
                            @foreach($status as $status)
                            <option id="status" name="status" value="{{$data = $status->id }}">{{$status->name}}</option>
                            @endforeach
                          </select>
                      </div>
                    </div>
                  </div>   
              </div>
              </div>
            </div>
            <div class="box-footer">
              <button type="submit" class="btn btn-primary pull-right">Submit</button>  </form> 
              <form action="{{route('daily.index')}}"><button type="submit" class="btn btn-primary pull-left">Back To Report List</button></form>
            </div> 
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
        // $(fel).attr('name', 'activities['+i+']['+name+']').reset();
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
            
                       