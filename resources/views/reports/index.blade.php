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
                  <th>Action</th>
                  
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
                  
                  <td>
                     {{$countid}}
                  </td>
                  <td> <button class="btn btn-success" type="button" data-toggle="modal" data-target="#modal-report">
                  <i class="fa fa-fw fa-eye"></i>
                  </button>
                  <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-default">
                    <i class="fa fa-trash"> </i>
                  </button>

                   </td>
                  </tr>
                <div class="modal fade" id="modal-report">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title"> Report {{$reports->date}} </h4>
                      </div>
                      <div class="modal-body">
                     
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
                @endforeach
                </tbody>
            </table>
</div>
@endsection