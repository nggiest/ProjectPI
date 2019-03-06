@extends('layouts.app')

@section('content')
<div>
    <div class="row">
        <div class="col-md-12">
        
            <div class="panel">
                <div class="panel-heading">Home</div>
                
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    You are logged in!
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@include('sweet::alert')
@endsection
