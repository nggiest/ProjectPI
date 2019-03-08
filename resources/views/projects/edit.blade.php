@extends('layouts.app')

@section('content')
 <div class="box box-primary">
     <div class="box-title"> <h3 style="text-align:center"> Edit Project</h3></div>
     <form class="form-horizontal" method="POST" action="{{ route('project.update',$project->id )}}">
     {{ method_field('PUT') }}
             {{ csrf_field() }}
         <div class="box-body">
             <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                 <label for="name" class="col-sm-2 control-label">Name</label>
                     <div class="col-sm-9">
                     <input id="name" type="text" class="form-control" name="name" value='{{$project->name}}'required autofocus>
                     @if ($errors->has('name'))
                         <span class="help-block">
                             <strong>{{ $errors->first('name') }}</strong>
                         </span>
                     @endif
                     </div>
             </div>
             <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                 <label for="description" class="col-sm-2 control-label">Description</label>
                 <div class="col-sm-9">
                     <input id="description" type="text" class="form-control" name="description" value='{{$project->description}}' required>
                     @if ($errors->has('description'))
                         <span class="help-block">
                             <strong>{{ $errors->first('description') }}</strong>
                         </span>
                     @endif
                     </div>
             </div>
             <div class="form-group{{ $errors->has('url') ? ' has-error' : '' }}">
                 <label for="url" class="col-sm-2 control-label">Url</label>
                 <div class="col-sm-9">
                     <input id="url" type="text" class="form-control" name="url" value='{{$project->url}}' required>
                     @if ($errors->has('url'))
                         <span class="help-block">
                             <strong>{{ $errors->first('url') }}</strong>
                         </span>
                     @endif
                     </div>
             </div>
             <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                 <label for="name" class="col-sm-2 control-label">Status Project</label>
                 <div class="col-sm-9">
                     <select name="status" id="status" class="form-control select2">
                     @foreach($status as $statusku )
                         <option name="status" id="status" value="{{$statusku->id}}" {{ $project->status  == $statusku->id ? 'selected' : '' }} > {{$statusku->name}} </option>
                     @endforeach
                         </select>
                         @if ($errors->has('status'))
                             <span class="help-block">
                                 <strong>{{ $errors->first('status') }}</strong>
                             </span>
                         @endif
                 </div>
             </div>
             <div class="box-title"> 
                 <h3 style="text-align:center">Project Member </h3>
             </div>
                  <div class="checkbox">
                      @foreach($user as $users)
                          <label>
                          <input type="checkbox" name="user_id[]" id="user_id[]" value="{{$users->id}}" 
                          @if(in_array($users->id, $project->member)) checked @endif> {{$users->name}} 
                          </label>
                          <br>
                      @endforeach 
                  </div>            
             </div> 
             <div class="box-footer">
                     <button type="submit" class="btn btn-primary pull-right">
                         Update Data
                     </button> </form>
                     <form action="{{route('project.index')}}"><button type="submit" class="btn btn-primary pull-left">Back to Project List</button></form>
             </div>
         </div> 
 </div>
@endsection