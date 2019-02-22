@extends('layouts.app')

@section('content')
<div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Edit Project File</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="post" action="{{route('document.store')}}"  enctype="multipart/form-data">
            {{ method_field('PUT') }}
            {{ csrf_field() }}
            <div class="box-body">
              <input type="hidden" name="upload_by" id="upload_by" value="{{Auth::user()->id}}">
                <div class="form-group">
                  <label for="DocumentName">Document Name</label>
                  <input type="text" class="form-control" id="name" name="name" value="{{ $projectfile->name}}">
                </div>
                <div class="form-group">
                  <label for="Description">Description</label>
                  <input type="text" class="form-control" id="description" name="description" placeholder="Description" value="{{$projectfile->description}}">
                </div>
                <div class="form-group">
                  <label for="exampleInputFile">Attach File</label>
                  <input type="file" id="file" name='file' value="{{$projectfile->filename}}">
                </div>
              </div>

              <div class="form-group">
                  <label for="RevisionFor">Revision For</label>
                  <br>
                    <select name="related_to" id="related_to">
                    @foreach($projectfile as $pfs)
                        <option name="related_to" id="related_to" value="{{$data = $pfs->id}}" {{ $pfs->id  == $pfs->related_by ? 'selected' : '' }} >{{$pfs->name}} </option>
                     @endforeach
                    </select>
              
              </div>
             

              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
@endsection