@extends('layouts.app')

@section('content')
<div class="box box-primary">
  <div class="box-title"> <h3 style="text-align:center">Edit Project File</h3>
  </div>
  <form  class="form-horizontal" role="form" method="POST" action="{{route('document.update', $file->id )}}"  enctype="multipart/form-data">
  {{ method_field('PUT') }}
  {{ csrf_field() }}
  <div class="box-body">
    <input type="hidden" name="project_idx" id="project_idx" value="{{request()->project_id}}">
    <input type="hidden" name="upload_by" id="upload_by" value="{{Auth::user()->id}}">
      <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
        <label for="DocumentName"  class="col-sm-2 control-label">Document Name</label>
        <div class="col-sm-9">
          <input type="text" class="form-control" id="document_name" name="document_name" value="{{ $file->name}}">
          @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
          @endif
        </div>
      </div>
      <div class="form-group {{ $errors->has('description') ? ' has-error' : '' }}">
        <label for="Description" class="col-sm-2 control-label">Description</label>
        <div class="col-sm-9">
          <input type="text" class="form-control" id="description" name="description" placeholder="Description" value="{{$file->description}}">
        </div>
      </div>
      <div class="form-group {{ $errors->has('file') ? ' has-error' : '' }}">
        <label for="exampleInputFile" class="col-sm-2 control-label">Attach File</label>
        <div class="col-sm-9">
          <input type="file" id="file" name='file' value="{{$file->filename}}" title="a">
        </div>
      </div>
      <div class="form-group {{ $errors->has('related_by') ? ' has-error' : '' }}">
        <label for="RevisionFor" class="col-sm-2 control-label">Revision For</label>
        <div class="col-sm-9">
          <select name="related_by" id="related_by" class="form-control select2">
                <option name="related_by" id="related_by" value="">--Select Revision--</option>
              @foreach($list as $pro)
              <option name="related_by" id="related_by" value="{{$pro->id}}"  related_by="{{$file->related_by}}" {{ $file->related_by ==  $pro->id  ? 'selected' : '' }} >{{$pro->name}} </option>
              @endforeach
          </select>
        </div>
      </div>
      <div class="box-footer">
     <button type="submit" class="btn btn-primary pull-right">Update</button></form>
     <form action="{{route('project.show' , request()->project_id)}}"><button type="submit" class="btn btn-primary pull-left">Back Detail Project</button></form>
   </div>
  </div>
 
   
  
 
</div>
@endsection