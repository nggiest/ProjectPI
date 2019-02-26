@extends('layouts.app')

@section('content')
<div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Add New File</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="post" action="{{route('document.store')}}"  enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="box-body">
            
              <input type="hidden" name="project_idx" id="project_idx" value="{{request()->project_id}}">
              <input type="hidden" name="upload_by" id="upload_by" value="{{Auth::user()->id}}">
                <div class="form-group">
                  <label for="DocumentName">Document Name</label>
                  <input type="text" class="form-control" id="name" name="name" placeholder="Document Name">
                </div>
                <div class="form-group">
                  <label for="Description">Description</label>
                  <input type="text" class="form-control" id="description" name="description" placeholder="Description">
                </div>
                <div class="form-group">
                  <label for="exampleInputFile">Attach File</label>
                  <input type="file" id="file" name='file'>
                </div>
              </div>

              <input type="hidden" name="project_id" id="project_id" value:"{{$project}}">

              
              <div class="form-group">
                  <label for="RevisionFor">Revision For</label>
                    <select name="related_to" id="related_to">
                    <option name="related_to" id="related_to" value=""> </option>
                    @foreach($projectfile as $pfs)
                        <option name="related_to" id="related_to" value="{{$data = $pfs->id }}">{{$pfs->name }} </option>
                     @endforeach
                    </select>
              
              </div>
              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
@endsection