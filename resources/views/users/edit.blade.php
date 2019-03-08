@extends('layouts.app')
@section('content')

<div class="box box-primary">
    <div class="box-title"> <h3 style="text-align:center"> Edit User {{$user->name}} </h3> 
    <div class="box-body">
        <form class="form-horizontal" method="POST" action="{{ route('user.update', $user->id) }}">
            {{ csrf_field() }}
            <input type="hidden" name="_method" value="PATCH">
            <div class="form-group" >
                <label for="name" class="col-md-2 control-label">Name</label>
                <div class="col-md-9">
                    <input id="name" type="text" class="form-control" name="name" value="{{ $user->name }}" required autofocus>
                </div>
            </div>

            <div class="form-group">
                <label for="email" class="col-md-2 control-label">E-Mail Address</label>
                <div class="col-md-9">
                    <input id="email" type="email" class="form-control" name="email" value="{{ $user->email }}" required>
                </div>
            </div>

            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <label for="password" class="col-md-2 control-label">Password</label>

                <div class="col-md-9">
                    <input id="password" type="password" class="form-control" name="password" >

                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <label for="password-confirm" class="col-md-2 control-label">Confirm Password</label>

                <div class="col-md-9">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" >
                </div>
            </div>

            <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                <label for="name" class="col-md-2 control-label">Activation Status</label>

                <div class="col-md-9">
                <select name="status" id="status" class="form-control select2" >
                    <option name="status" id="status" value="{{$data = 1 }}" {{ $user->status  == $data ? 'selected' : '' }} > Active User </option>
                    <option name="status" id="status" value="{{$data = 0 }}" {{ $user->status  == $data ? 'selected' : '' }}> Non Active User </option>
                    </select>
                    @if ($errors->has('status'))
                        <span class="help-block">
                            <strong>{{ $errors->first('status') }}</strong>
                        </span>
                        @endif
                </div>
            </div>

                <div class="form-group{{ $errors->has('role') ? ' has-error' : '' }}">
                 <label for="name" class="col-md-2 control-label">Role</label>

                    <div class="col-md-9">
                        <select name="role" id="role"class="form-control select2">
                        <option name="role" id="role" value="">---Select User Role---</option>
                        <option name="role" id="role" value="{{$data = 'Admin'}} " {{ $user->role  == $data ? 'selected' : '' }}> Admin </option>
                        <option name="role" id="role" value="{{$data = 'User'}}" {{ $user->role  == $data ? 'selected' : '' }}> User </option>
                        </select>
                        @if ($errors->has('role'))
                        <span class="help-block">
                            <strong>{{ $errors->first('role') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>

            <div class="box-footer">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary pull-right">
                        Update
                    </button>
                    </form>
                    <form action="{{route('user.index')}}"><button type="submit" class="btn btn-primary pull-left">Back To List User</button></form>
                </div>
            </div>
        
    </div>
</div>
        
@endsection