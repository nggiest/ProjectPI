@extends('layouts.app')

@section('content')
<div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Edit Project File</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="POST" action="{{route('document.update', $projectfiles->id )}}"  enctype="multipart/form-data">
            {{ method_field('PUT') }}
            {{ csrf_field() }}
            <div class="box-body">
            <input type="hidden" name="project_idx" id="project_idx" value="{{request()->project_id}}">
              <input type="hidden" name="upload_by" id="upload_by" value="{{Auth::user()->id}}">
                <div class="form-group">
                  <label for="DocumentName">Document Name</label>
                  <input type="text" class="form-control" id="document_name" name="document_name" value="{{ $projectfiles->name}}">
                </div>
                <div class="form-group">
                  <label for="Description">Description</label>
                  <input type="text" class="form-control" id="description" name="description" placeholder="Description" value="{{$projectfiles->description}}">
                </div>
                <div class="form-group">
                  <label for="exampleInputFile">Attach File</label>
                  <input type="file" id="file" name='file' value="{{$projectfiles->filename}}">
                </div>
              </div>

              <div class="form-group">
                  <label for="RevisionFor">Revision For</label>
                 
                    <select name="related_by" id="related_by">
                    <option value="">--Select Revision--</option>
                        @foreach($projfiles as $pro)
                        <option name="related_by" id="related_by" value="{{$pro->id}}" {{ $pro->id  == $projectfiles->related_by ? 'selected' : '' }} >{{$pro->name}} </option>
                        @endforeach
                    </select>
              
              </div>

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Update</button>
              </div>
            </form>
          </div>
@endsection