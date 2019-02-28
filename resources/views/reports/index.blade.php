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
                    <i class="fa fa-fw fa-eye"> </i> Read
                    </button> 
                  </td> 
                  <td>
                      <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-delete">
                        <i class="fa fa-trash"> Delete </i>
                      </button>
                  </td> 
                  <td>
                     
                        <form action="{{route('daily.edit', $reports->id)}}">
                          <button type="submit" class="btn btn-success" value="Edit">
                          <i class="fa fa-pencil"> Edit </i>
                          </button>
                        </form>
                  </td>
                    </tr>
                      
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
                                <form action="{{route('daily.destroy', $reports->id)}}" method="POST">
                                  {{csrf_field()}}
                                  {{method_field('DELETE')}}
                                  <button class="btn btn-success" type="submit" value="Delete"> Delete
                                </button>
                                </form>
                              </div>
                            </div>
                            <!-- /.modal-content -->
                  </div>
                  
                @endforeach
                  </tbody>
                </table>
             
                <div class="modal fade" id="modal-report">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                          <h4 class="modal-title tanggal"> Report </h4>
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
                                <tbody id="activityx">
                              @php (
                                $no = 1
                                
                              )

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

var no = 1 ;


          function view_report(reportId) {
            $.ajax({
                  headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  },
          
                  type: "GET",
                  url: '/daily/getDaily/'+reportId,
                  dataType:"json",
                  success: function(data){
                    console.log(data);
                    $("#activityx").empty();
                    $.each(data,function(key,value){
                      $("#activityx").append('<tr><td>'+value.id+'</td><td>'+value.activity+'</td><td>'+value.project_id+'</td><td>'+value.module+'</td><td>'+value.priority+'</td><td>'+value.status+'</td></tr>');
                    });
                  }
            });
            
          }

            

            </script>
@endsection