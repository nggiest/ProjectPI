@extends('layouts.app')

@section('content')
<div class="box-body">
{{csrf_field()}}
@php (
  $no = 1
)

              <table id="" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Date</th>
                  <th>Number of Activity</th>
                  <th colspan="3">Action</th>
                  
                </tr>
                </thead>
                <tbody>
               @php (
                 $no = 1
                
               )

               @foreach ($report as $reports)
                <tr>
                  <td>{{$no++}}</td>
                  <td>{{$reports->date}}</td>
                  <td>{{$reports->reportcount->countId}}</td>
                  <td> 
                      <button class="btn btn-success view-report" type="button" data-toggle="modal" data-target="#modal-report" onClick="view_report({{$reports->id}})">
                      <i class="fa fa-fw fa-eye"></i>
                      </button> </td> <td>
                      <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-delete">
                        <i class="fa fa-trash"> </i>
                      </button></td> <td>

                      <form action="{{route('daily.edit', $reports->id)}}">
                      <button type="submit" class="btn btn-success" >
                        <i class="fa fa-pencil"> </i>
                      </button>
                      </form>
                      
                   </td>
                </tr>
                @endforeach
                  </tbody>
                </table>
             
                <div class="modal fade" id="modal-report">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                          <h4 class="modal-title"> Report {{$reports->date}} </h4>
                        </div>
                        <div class="modal-body">
                            <table id="activity" class="table ">
                                <thead>
                                <tr>
                                  <th>No</th>
                                  <th>Activity</th>
                                  <th>Project</th>
                                  <th>Module/Part</th>
                                  <th>Priority</th>
                                  <th>Status</th>
                                  
                                </tr>
                                </thead>
                                <tbody>
                              @php (
                                $no = 1
                                
                              )

                              @foreach ($reports->repact as $rpd)
                              
                                <tr>
                                  <td>{{$no++}}</td>
                                  <td>{{$rpd->activity}}</td>
                                  <td>{{$rpd->projects->name}}</td>
                                  <td>{{$rpd->module}}</td>
                                  <td>{{$rpd->priorities->priority}}</td>
                                  <td>{{$rpd->statuses->name}}<td>
                                  
                                  </tr>
                              @endforeach
                            </table>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                          
                        </div>
                      </div>
                      <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>



                <div class="modal fade" id="modal-delete">
                    <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h4 class="modal-title">SPM File Management</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span></button>
                              </div>
                              <div class="modal-body">
                                <h3 style="text-align:center">Are you sure ?</h3>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                                <form action="{{route('daily.destroy', $reports->countId)}}" method="POST">
                                  {{csrf_field()}}
                                  {{method_field('DELETE')}}
                                  <button class="btn btn-success" type="submit" value="Delete"> Delete
                                </button>
                              </div>
                            </div>
                            <!-- /.modal-content -->
                    </div>
                      <!-- /.modal-dialog -->
                </div> 
               
</div>
@endsection

@section('script')
<script
              src="https://code.jquery.com/jquery-3.2.1.min.js"
              integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
              crossorigin="anonymous">
                  
</script>

<script type="text/javascript">
            $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
             });
</script>

<script type="text/javascript">
        $(document).ready(function(){
          $('#btn').on('click',function(e){
              e.preventDefault();

            // form.append('image', image);
            $.view_report({
                  headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  },
          
                  type: "GET",
                  url: 'ReportActivity.php',
                  data: {
                    'activity' : activity,
                    'report' : report_id,
                    'project_id' : project_id,
                    'module' : module,
                    'priority' : priority,
                    'status' :status,
                  },
                  success: function(data) {
                      alert(data);
                      console.log(data);
                  }
            });
          });
      });
            </script>
@endsection