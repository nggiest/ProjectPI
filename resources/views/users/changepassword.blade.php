@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 ">
            <div class="box box-default">
            @if($errors->any())
            <ul>
              @foreach($errors->all() as $error)
              <li>{{$error}}</li>
              @endforeach
            </ul>
            @endif
                <div class="box-heading">Change Password</div>

                <div class="box-body">
                    <form class="form-horizontal" method="POST" action="{{ route('user.ganti', Auth::user()->id) }}">
                        {{ method_field('PUT') }}
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" value="PATCH">
                        

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password">

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
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Update
                                </button>
                                <br> 
                                <br>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection