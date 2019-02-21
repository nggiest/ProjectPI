@extends('layouts.app')

@section('content')
<div class="center panel panel-body col col-md-12">

<div class="table-responsive" >

@php(
    $no = 1
) 
            <table class="table table-striped table-sm">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Project Name</th>
                  <th>Url</th>
                  <th>Start Date</th>
                  <th>Status</th>
                  <th colspan:2>Action</th>
                </tr>
              </thead>
              <tbody>
              @foreach($project as $projects)
                <tr> 
                  <td>{{$no++}} </td>
                  <td>{{$projects->name}}</td>
                  <td>{{$projects->url}}</td>
                  <td>{{$projects->start_date}}</td>
                  <td>{{$projects->status }} </td>
                  <td>  <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-default">
                      Delete
                      </button>
                      </form> </td> <td> <form action="{{route('project.edit', $projects->id)}}">
                      <button class="btn btn-success" type="submit" value="Edit"> Edit </button> </form>  </td> <td> 
                      <form action="{{route('project.show', $projects->id)}}" method="GET">
                      <button class="btn btn-success" type="submit" value="Edit"> Detail </button> </form> </td>

                </tr>
                      <div class="modal fade" id="modal-default">
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
                              <form action="{{route('project.destroy', $projects->id)}}" method="POST">
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
    </div>
@endsection