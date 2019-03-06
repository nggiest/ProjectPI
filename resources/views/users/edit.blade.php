@extends('layouts.app')
@section('title')
<h2> User </h2>
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 ">
            <div class="box box-default">
                <div class="box-heading">User Profile</div>
                @if($errors->any())
                <ul>
                @foreach($errors->all() as $error)
                <li>{{$error}}</li>
                </ul>
                @endforeach
                @endif
                <div class="box-body">
                    <form class="form-horizontal" method="POST" action="{{ route('user.update', $user->id) }}">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" value="PATCH">
                        <div class="form-group" >
                         <label for="name" class="col-md-4 control-label">Name</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ $user->name }}" required autofocus>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ $user->email }}" required>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" >

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" >
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Activation Status</label>

                            <div class="col-md-6">
                            <select name="status" id="status" class="form-control select2" >
                                <option name="status" id="status" value="{{$data = 1 }}" {{ $user->status  == $data ? 'selected' : '' }} > Active User </option>
                                <option name="status" id="status" value="{{$data = 0 }}" {{ $user->status  == $data ? 'selected' : '' }}> Non Active User </option>
                                </select>
                            </div>
                          </div>

                          <div class="form-group{{ $errors->has('role') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Role</label>

                            <div class="col-md-6">
                                <select name="role" id="role">
                                <option name="role" id="role" value="{{$data = 'Admin'}} " {{ $user->role  == $data ? 'selected' : '' }}> Admin </option>
                                <option name="role" id="role" value="{{$data = 'User'}}" {{ $user->role  == $data ? 'selected' : '' }}> User </option>
                                </select>
                            </div>
                          </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Update
                                </button>
                                <br> 
                                <br>
                                <button href="{{ url('/') }}"> Back Home </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection