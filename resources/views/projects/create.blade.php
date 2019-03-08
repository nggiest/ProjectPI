@extends('layouts.app')

@section('content') 
<!-- <center> -->
   
<div class="box box-primary">
    <div class="box-title">  <h3 style="text-align:center"> Create Project  </h3 ></div>
    <form class="form-horizontal" method="POST" action="{{ route('project.store')}}">
        {{ csrf_field() }}
        <div class="box-body">
                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    <label for="name" class="col-sm-2 control-label">Name</label>
                        <div class="col-sm-9">
                        <input id="name" type="text" class="form-control" name="name" required autofocus>
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
                                        <input id="description" type="text" class="form-control" name="description" required>
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
                                        <input id="url" type="text" class="form-control" name="url"  required>
                                        @if ($errors->has('url'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('url') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                </div>
                <div class="form-group {{ $errors->has('start_date') ? ' has-error' : '' }}">
                                    <label for="started_at" class="col-sm-2 control-label">Started At</label>
                                    <div class="col-sm-9">
                                        <input id="start_date" type="date" class="form-control" name="start_date" value="{{ date('Y-m-d', strtotime('now')) }}" >
                                        @if ($errors->has('start_date'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('start_date') }}</strong>
                                            </span>
                                        @endif
                                    </div> 
                </div>
                <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                                    <label for="name" class="col-sm-2 control-label">Status Project</label>
                                    <div class="col-sm-9">
                                        <select name="status" id="status" class="form-control select2">
                                            <option name="status" id="status" value="">---Select Status Project---</option>
                                        
                                            @foreach($status as $statusku)
                                                <option name="status" id="status" value="{{$data = $statusku->id}}">{{$statusku->name}} </option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('start_date'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('start_date') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                </div>                           
                <div class="box-title" > <h3 style="text-align:center">Project Member </h3></div>
                    <div class="checkbox col-md-10">
                        @foreach($user as $users)
                            <label>
                                            
                            <input type="checkbox" name="user_id[]" id="user_id[]" value="{{$data = $users->id}}"> {{$users->name}}
                                            
                            </label> 
                            </br>
                        @endforeach 
                        
                    </div>
                </div>
                    <div class="box-footer">
                            <button type="submit" class="btn btn-primary pull-right">Create</button></form>
                            <form action="{{route('project.index')}}"><button type="submit" class="btn btn-primary pull-left">Back to Project List</button></form>
                    </div>

</div>
</div>              
    

<script>

</script>
@endsection 
