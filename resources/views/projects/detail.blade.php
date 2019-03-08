@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
            @if($errors->any())
            <ul>
              @foreach($errors->all() as $error)
              <li>{{$error}}</li>
              @endforeach
            </ul>
            @endif
        <div class="box box-primary">
            <div class="box-title"> <h1 style="text-align:center"> {{$project -> name}} <span class="label label-success"> {{$project->statuses->name}} </span> </h3> </div>
            
            <h4 style="text-align:center"> {{$project->description}} </h2>
            <div class="box-body">
              <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                  <li class="tab-pane {{ !empty(@session('projectfilestatus')) && @session('projectfilestatus') == '1' ? '' : 'active' }}"><a href="#tab_1" data-toggle="tab" name="tab1">Project Member</a></li>
                  <li class="tab-pane {{ !empty(@session('projectfilestatus')) && @session('projectfilestatus') == '1' ? 'active' : '' }}"> <a href="#tab_2" data-toggle="tab" name="document" id="document" class="tab-pane ">Document</a></li> 
                  <li class="pull-right"></li>
                </ul>
                <div class="tab-content">
                  <div class="tab-pane {{ !empty(@session('projectfilestatus')) && @session('projectfilestatus') == '1' ? '' : 'active' }}" id="tab_1">
                    <table id="example2" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                      <th>No</th>
                      <th>Name</th>
                      <th>Email</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php (
                      $no = 1
                    )
                          @foreach($projectmember as $member)
                          <tr>
                          <td>{{$no++}}</td>
                          <td>{{$member->name}}</td>
                          <td>{{$member->email}}</td>
                        </tr>
                          @endforeach
                        </tbody>
                        </table>
                  </div>

        
                  <!-- /.tab-pane -->
                  <div class="tab-pane {{ !empty(@session('projectfilestatus')) && @session('projectfilestatus') == '1' ? 'active' : '' }}" id="tab_2">
                    <form action="{{route('document.create')}}"> 
                      <button class="btn btn-block btn-default" type="submit" > <i class="fa fa-plus"> </i> Add Document </button>
                    <input type="hidden" name="project_id" id="project_id" value="{{$project->id}}">

                    </form> 
                    <br>
                    <table id="example2" class="table table-bordered">
                    <thead>
                    <tr>
                      <th>No</th>
                      <th>Document</th>
                      <th>Description</th>
                      <th colspan="3" style="text-align:center">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php (
                      $no1 = 1
                    )
                          @foreach($projectfile as $projectfiles)
                          <tr>
                          <td>{{$no1++}}</td>
                          <td>{{$projectfiles->name}}</td>
                          <td>{{$projectfiles->description}}</td>
                          <td><form action="{{url('/storage/files').'/'.$projectfiles->filename}}" download="{{$projectfiles->filename}}"> <button class="btn btn-success"> <i class="fa fa-download" style="text-align:center"></i> </button> </form> </td>
                          <td>
                          <button class="btn btn-success remove-record" type="button" data-toggle="modal" data-target="#modal-delete" data-id="{{$projectfiles->id}}" data-url="{{route('document.destroy', $projectfiles->id )}}"> <i class="fa fa-trash" style="text-align:center"> </i> 
                          </button> </td>
                        
                          <td><form action="{{route('document.edit', $projectfiles->id)}}">
                          <input type="hidden" name="project_id" id="project_id" value="{{$project->id}}">
                          <button type="submit" class="btn btn-success"> <i class="fa fa-pencil" style="text-align:center"></i></button></form> </td>
                              
                          </tr>
                          
                          @endforeach
                          <form action="" method="POST" class="remove-record-model">
                          {{ csrf_field() }}
                          <div class="modal fade" id="modal-delete" >
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
                                    <button type="button" class="btn btn-outline pull-left remove-data-from-delete-form" data-dismiss="modal">Close</button>
                                    <button class="btn btn-success " type="submit" value="Delete "> Delete </button>
                                              
                                  </div>
                                </div>
                              </div>
                          </div>
                          </form>
                        </tbody>
                        </table>
                  </div>
                  <!-- /.tab-pane -->
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div>
              <form action="{{route('home')}}"><button type="submit" class="btn btn-primary pull-left">Back Home</button></form>
            </div>
          
        </div>
    </div>
        <!-- /.col -->

        <!-- /.col -->
      </div>
@include('sweet::alert')

@endsection

@section('script')
<script>
      $(document).ready(function(){
        // For A Delete Record Popup
        $('.remove-record').click(function() {
          var id = $(this).attr('data-id');
          console.log(id);
          var url = $(this).attr('data-url');
          // var token = ;
          $(".remove-record-model").attr("action",url);
          $('body').find('.remove-record-model').append('<input name="_token" type="hidden" value="{{csrf_token()}}">');
          $('body').find('.remove-record-model').append('<input name="_method" type="hidden" value="DELETE">');
          $('body').find('.remove-record-model').append('<input name="id" type="hidden" value="'+ id +'">');
        });

        $('.remove-data-from-delete-form').click(function() {
          $('body').find('.remove-record-model').find( "input" ).remove();
        });
        $('.modal').click(function() {
          // $('body').find('.remove-record-model').find( "input" ).remove();
        });
      });

</script>
@endsection
