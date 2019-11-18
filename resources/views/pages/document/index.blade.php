@extends('layouts.document')



@section('content')
<div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Documents</h3>

          <div class="box-tools">
            <div class="input-group input-group-sm hidden-xs" style="width: 150px;">
              <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

              <div class="input-group-btn">
                <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
              </div>
            </div>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
          <table class="table table-hover">
            <tbody><tr>
              <th>ID</th>
              <th>Document</th>
            </tr>
            @foreach($documents as $document)
            <tr>
              <td>{{ $document->id }}</td>
              <td>{{ $document->name }}</td>
              <td>
                <div class="row">
                  <div class="col-xs-5">
                    <form method="post" action="{{URL::to('/admin/document/'.$document->id)}}">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modal-edit-{{ $document->id }}" ><i class="fa fa-edit" aria-hidden="true"></i></button>
                        <button class="btn btn-danger" type="submit"><i class="fa fa-trash" aria-hidden="true"></i></button>
                    </form>
                  </div>

                  <div class="modal fade in" id="modal-edit-{{ $document->id }}" style="display: none; padding-right: 16px;">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span></button>
                          <h4 class="modal-title">Default Modal</h4>
                        </div>
                        <form action="{{URL::to('/admin/document/'.$document->id)}}" method="post">
                          {{method_field('PUT')}}
                          {{ csrf_field() }}
                        <div class="modal-body">

                            <div class="form-group">
                              <label>Document:</label>
                              <input type="text" class="form-control" name="name" id="name" value="{{ $document->name }}">
                            </div>

                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                          <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                        </form>
                      </div>
                      <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                  </div>

                </div>


              </td>
            </tr>
            @endforeach

          </tbody></table>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
  </div>

  <div class="modal fade in" id="modal-add" style="display: none; padding-right: 16px;">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span></button>
          <h4 class="modal-title">Default Modal</h4>
        </div>
        <form action="{{URL::to('/admin/document')}}" method="post">
          {{ csrf_field() }}
        <div class="modal-body">

            <div class="form-group">
              <label>Document:</label>
              <input type="text" class="form-control" name="name" id="name" placeholder="Document Name">
            </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
@endsection
