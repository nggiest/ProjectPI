@extends('layouts.app')
@section('content')
            <div class="box box-primary">
                <div class="box-title"> <h3 style="text-align:center">Change Password</h3></div>
                <form class="form-horizontal" method="POST" action="{{ route('user.ganti', Auth::user()->id) }}">
                {{ method_field('PUT') }}
                {{ csrf_field() }}
                <div class="box-body">
                        
                        <input type="hidden" name="_method" value="PATCH">
                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-2 control-label">Password</label>

                            <div class="col-md-9">
                                <input id="password" type="password" class="form-control" name="password">

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
                </div>
                <div class="box-footer">
                             <button type="submit" class="btn btn-primary pull-right">
                                 Update
                             </button> </form>
                <form action="{{route('home')}}"><button type="submit" class="btn btn-primary">Back Home</button></form>

                </div>
            </div>
@endsection