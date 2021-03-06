@extends('layouts.app')
@section('content')
<div class="box box-primary">
  <div class="box-title"> <h3 style="text-align:center"> List User </h3> 
  </div>
  <div class="box-body">
    {{csrf_field()}}
    <div class="table-responsive" >

        @php(
            $no = 1
        ) 
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th>No</th>
              <th>Name</th>
              <th>Email</th>
              <th>Status</th>
              <th>Role</th>
              <th style="text-align:center">Action</th>
            </tr>
          </thead>
          <tbody>
          @foreach ($user as $pengguna)
            <tr> 
              <td>{{$no++}} </td>
              <td>{{$pengguna->name}}</td>
              <td>{{$pengguna->email}}</td>
              <td>{{$pengguna->status == 1 ? 'Active User' : 'Non Active User'}} </td>
              <td>{{$pengguna->role}}</td>
              <td style="text-align:center"> <form action="{{route('user.edit', $pengguna->id)}}">  
              <button class="btn btn-success" type="submit" value="Edit"> Edit </button> </form>  </td>
              </tr>
                <div class="modal fade" id="modal-default">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">SPM Management File</h4>
                      </div>
                      <div class="modal-body">
                        <h3 style="text-align:center"> Are you sure ? </h3>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
                        <form action="{{route('user.destroy', $pengguna->id)}}" method="POST">
                        {{csrf_field()}}
                        {{method_field('DELETE')}}
                        <button class="btn btn-success" type="submit" value="Delete"> Delete </button>
                        </form>
                                            
                      </div>
                    </div>
                  </div>
                </div>   
          @endforeach
          </tbody>
        </table>
          {{$user->links()}}
    </div>
  <form action="{{route('home')}}"><button type="submit" class="btn btn-primary">Back Home</button></form>
  </div>
</div>
<script src="/pathto/js/sweetalert.js"></script>
@include('sweet::alert')
@endsection

<!-- @section('script')
<script>
      $(document).ready(function(){
        // For A Delete Record Popup
        $('.remove-record').click(function() {
          var id = $(this).attr('data-id');
          console.log(id);
          var url = $(this).attr('data-url');
          // var token = ;
          $(".remove-record-model").attr("action",url);
          $('body').find('.remove-record-model').append('<input name="_token" type="hidden" value="{{csrf_token()}}">');
          $('body').find('.remove-record-model').append('<input name="_method" type="hidden" value="DELETE">');
          $('body').find('.remove-record-model').append('<input name="id" type="hidden" value="'+ id +'">');
        });

        $('.remove-data-from-delete-form').click(function() {
          $('body').find('.remove-record-model').find( "input" ).remove();
        });
        $('.modal').click(function() {
          // $('body').find('.remove-record-model').find( "input" ).remove();
        });
      });

</script>
@endsection -->