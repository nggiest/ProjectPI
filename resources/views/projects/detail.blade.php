@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-title"> <h1 style="text-align:center"> {{$project -> name}} <span class="label label-success">{{$project->status}}</span> </h3> </div>
            <h4 style="text-align:center"> {{$project->description}} </h2>

          <!-- Custom Tabs -->
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
                  <button class="btn btn-block btn-default" type="submit"> <i class="fa fa-plus"> </i> Add Document </button>
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
                      <td><a href="{{url('/storage/files').'/'.$projectfiles->filename}}" download="{{$projectfiles->filename}}" > <i class="fa fa-download" style="text-align:center"></i> </a> </td>
                      <td><form action="{{route('document.destroy', $projectfiles->id)}}" method="POST">
                      {{csrf_field()}}
                      {{method_field('DELETE')}}
                      <button class="btn btn-success" type="submit"> <i class="fa fa-trash" style="text-align:center"> </i> 
                      </button> </form> </td>
                      <td><a href="{{route('document.edit', $projectfiles->id)}}"><i class="fa fa-pencil" style="text-align:center"></i></a> </td>
                          
                    </tr>
                      @endforeach
                    </tbody>
                    </table>
              </div>
              <!-- /.tab-pane -->
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
        </div>
    </div>
        <!-- /.col -->

        <!-- /.col -->
      </div>
@endsection