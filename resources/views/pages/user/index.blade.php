@extends('layouts.user')



@section('content')
<div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Users</h3>

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
              <th>Users</th>
              <th>Role</th>
              <td> </td>
            </tr>
            @foreach($users as $user)
            <tr>
              <td>{{ $user->id }}</td>
              <td>{{ $user->name }}</td>
              <td>{{ $user->roles[0]->description}}</td>
              <td>
                <div class="row">
                  <div class="col-xs-4">
                    <form method="post" action="{{URL::to('/admin/user/'.$user->id)}}">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modal-edit-{{ $user->id }}"><i class="fa fa-edit" aria-hidden="true"></i></button>
                        <button class="btn btn-danger" type="submit"><i class="fa fa-trash" aria-hidden="true"></i></button>
                    </form>
                  </div>
                  <div class="modal fade in" id="modal-edit-{{ $user->id }}" style="display: none; padding-right: 16px;">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span></button>
                          <h4 class="modal-title">Default Modal</h4>
                        </div>
                        <form action="{{URL::to('/admin/document/'.$user->id)}}" method="post">
                          {{method_field('PUT')}}
                          {{ csrf_field() }}
                        <div class="modal-body">

                            <div class="form-group">
                              <label>Document:</label>
                              <input type="text" class="form-control" name="name" id="name" value="{{ $user->name }}">
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
          <h4 class="modal-title">Create User</h4>
        </div>
        <form action="{{URL::to('/admin/user')}}" method="post">
          {{ csrf_field() }}
        <div class="modal-body">

            <div class="form-group">

              <input type="email" class="form-control" name="email" id="email" placeholder="Email">
              <br/>

              <input type="text" class="form-control" name="name" id="name" placeholder="Name">
              <br/>

              <select class="form-control" id="role" name="role">
                  <option value="" disabled selected>Please select role.</option>
                @foreach($roles as $role);
                  <option value="{{ $role->id }}">{{ $role->name }}</option>
                @endforeach
              </select>

              <input type="password" class="form-control" name="password" id="password" placeholder="Password">
              <br/>
            </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Create User</button>
        </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
@endsection
