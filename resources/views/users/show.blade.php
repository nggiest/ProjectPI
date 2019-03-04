@extends('layouts.app')
@section('title')
<h2> User </h2>
@endsection
@section('content')

<div class="panel panel-body">
{{csrf_field()}}

<div class="table-responsive" >

@php(
    $no = 1
) 
            <table class="table table-striped table-sm">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Status</th>
                  <th>Role</th>
                  <th colspan='2' style="text-align:center">Action</th>
                </tr>
              </thead>
              <tbody>
              @foreach ($user as $pengguna)
                <tr> 
                  <td>{{$no++}} </td>
                  <td>{{$pengguna->name}}</td>
                  <td>{{$pengguna->email}}</td>
                  <td>{{$pengguna->status}} </td>
                  <td>{{$pengguna->role}}</td>
                  <td>  <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-default">
                            Delete
                          </button> </td>
                  <td> <form action="{{route('user.edit', $pengguna->id)}}">  
                  <button class="btn btn-success" type="submit" value="Edit"> Edit </button> </form>  </td>
                  </tr>
                                  <div class="modal fade" id="modal-default">
                                    <div class="modal-dialog">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span></button>
                                          <h4 class="modal-title">SPM Management File</h4>
                                        </div>
                                        <div class="modal-body">
                                          <h3 style="text-align:center"> Are you sure ? </h3>
                                        </div>
                                        <div class="modal-footer">
                                          <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
                                          <form action="{{route('user.destroy', $pengguna->id)}}" method="POST">
                                          {{csrf_field()}}
                                          {{method_field('DELETE')}}
                                          <button class="btn btn-success" type="submit" value="Delete"> Delete </button>
                                          </form>
                                          
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
        {{$user->links()}}
    </div>
</div>
<script src="/pathto/js/sweetalert.js"></script>
@include('sweet::alert')
@endsection
