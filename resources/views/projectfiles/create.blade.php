@extends('layouts.app')

@section('content')
            <form role="form">
              <div class="box-body">
                <div class="form-group">
                  <label for="Document">Document Name</label>
                  <input type="text" class="form-control"  placeholder="Document Name" name="filename" id="filename">
                </div>
                <div class="form-group">
                  <label for="Description">Description</label>
                  <input type="text" class="form-control" id="description" name="description" placeholder="Description">
                </div>
                <div class="form-group">
                  <label for="Attach File">Attach File</label>
                  <input type="file" id="">

                </div>
                <div class="form-group">
                  <label for="Attach File">Revision For</label>
                  <div class="form-group">
                  <label>Select</label>
                  <select class="form-control">
                  <!-- looping judul project -->
                    <option>option 1</option>
                  </select>
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
@endsection