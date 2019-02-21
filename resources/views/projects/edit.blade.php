@extends('layouts.app')

@section('content')
<div class="col-md-12">
            <div class="box box-primary">
                <div class="box-title"> <h3> Create Project </h3></div>

                
                <form class="form-horizontal" method="POST" action="{{ route('project.update',$project->id )}}">
                {{ method_field('PUT') }}
                        {{ csrf_field() }}
                    <div class="box-body">
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">

                            <label for="name" class="col-sm-2 control-label">Name</label>

                                <div class="col-sm-10">
                            
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

                            <div class="col-sm-10">
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

                            <div class="col-sm-10">
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

                            <div class="col-sm-10">
                            <select name="status" id="status">
                            @foreach($status as $statusku )
                                <option name="status" id="status" value="{{$statusku->id}}" {{ $project->status  == $statusku->id ? 'selected' : '' }} > {{$statusku->name}} </option>
                            @endforeach
                                </select>
                            </div>
                          </div>


                    
            
                        <!-- <div class="col-md-12"> -->
                            <!-- <div class="box-body 2"> -->
                                <!-- <div class="box-title">  -->
                                    <h3>Project Member </h3>
                                <!-- </div> -->
<!-- 
                                    <div class="box-body"> -->
                                        
                                            <div class="checkbox">

                                                @foreach($user as $users)
                                                    <label>
                                        
                                                    <input type="checkbox" name="user_id[]" id="user_id[]" value="{{$users->id}}" 
                                                    @if(in_array($users->id, $project->member))
                                                    checked
                                                    @endif                                                    
                                                     > {{$users->name}} 
                                        
                                                    </label>

                                                    <br>
                                                @endforeach 
                                            </div>
                                    
                                        
                                    </div> 
                            <!-- </div> -->
                        <!-- </div> -->

                        
                        <div class="box-footer">
                                <button type="submit" class="btn btn-primary">
                                    Upload
                                </button>
                        </div>
                    </div>
                </form>
                    
            </div>
</div>
@endsection