@extends('layouts.app')

@section('content')
<div class="box-body">
{{csrf_field()}}
@php (
  $no = 1
)

              <table id="" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Date</th>
                  <th>Number of Activity</th>
                  <th>Action</th>
                  
                </tr>
                </thead>
                <tbody>
               @php (
                 $no = 1
                
               )

               @foreach ($datecount as $reports)
                <tr>
                  <td>{{$no++}}</td>
                  <td>{{$reports->date}}</td>
                  
                  <td>
                      {{$reports->countId}}
                  </td>
                  <td><i class="fa fa-fw fa-eye"></i> <i class="fa fa-trash"></i> </td>
                </tr>
                @endforeach
                </tbody>
            </table>
</div>
@endsection