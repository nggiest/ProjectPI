@extends('layouts.app')

@section('content')
<div class="box box-primary">
              <div class="box-title" > <h3 style="text-align:center">Add New File</h3> </div>

          
            <div class="box-body">
            <form class="form-horizontal"  role="form" method="post" action="{{route('document.store')}}"  enctype="multipart/form-data">
            {{ csrf_field() }}
              <input type="hidden" name="project_idx" id="project_idx" value="{{request()->project_id}}">
              <input type="hidden" name="upload_by" id="upload_by" value="{{Auth::user()->id}}">
                <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                  <label for="DocumentName"class="col-sm-2 control-label" >Document Name</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="name" name="name" placeholder="Document Name">
                    @if ($errors->has('name'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('name') }}</strong>
                              </span>
                    @endif
                  </div>
                </div>
                <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                  <label for="Description" class="col-sm-2 control-label">Description</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="description" name="description" placeholder="Description">
                    @if ($errors->has('description'))
                        <span class="help-block">
                            <strong>{{ $errors->first('description') }}</strong>
                        </span>
                    @endif
                  </div>
                </div>
                <div class="form-group{{ $errors->has('file') ? ' has-error' : '' }}">
                  <label for="exampleInputFile" class="col-sm-2 control-label">Attach File</label>
                  <div class="col-sm-9">
                  <input type="file" id="file" name='file'>
                  @if ($errors->has('file'))
                            <span class="help-block">
                                <strong>{{ $errors->first('file') }}</strong>
                            </span>
                        @endif
                  </div>
                </div>
                <div class="form-group{{ $errors->has('related_by') ? ' has-error' : '' }}">
                  <label for="RevisionFor" class="col-sm-2 control-label">Revision For</label>
                  <div class="col-sm-9">
                    <select name="related_by" id="related_by" class="form-control select2">
                    <option name="related_by" id="related_by" value=""> --Select Revision-- </option>
                    @foreach($projectfile as $pfs)
                        <option name="related_by" id="related_by" value="{{$data = $pfs->id }}">{{$pfs->name }} </option>
                     @endforeach
                     @if ($errors->has('related_by'))
                            <span class="help-block">
                                <strong>{{ $errors->first('related_by') }}</strong>
                            </span>
                        @endif
                    </select>
                    </div>
              </div>
            </div>
              <div class="box-footer">
                <button type="submit" class="btn btn-primary pull-right">Submit</button>  </form>
                <form action="{{route('project.show' , request()->project_id)}}"><button type="submit" class="btn btn-primary pull-left">Back Detail Project</button></form>
              </div>
           
          </div>
@endsection