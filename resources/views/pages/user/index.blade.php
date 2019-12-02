@extends('layouts.admin')

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="box">
      <div class="box-header with-border">
            <h3 class="box-title">List Of Users</h3>
            <button type="button" class="btn btn-success  pull-right" data-toggle="modal" data-keyboard="false" data-backdrop="static" data-target="#AddUser">
              <i class="fa fa-fw fa-plus-circle"></i> Add User
            </button>
      </div>
      <div class="box-body">

        <table id="datatable" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th> Name</th>
              <th> Email</th>
              <th> Edit</th>
              <th> Delete</th>
            </tr>
          </thead>
          <tbody>
            @foreach($users as $user)
                <tr>
                  <td>{{ $user->name }}</td>
                  <td>{{ $user->email }}</td>

                   <td width="10%">
                    <button type="button" 
                            class="btn btn-md btn-warning  btn-block pull-right"
                            data-id="{{ $user->id }}"
                            data-name="{{ $user->name }}"
                            data-email="{{ $user->email }}"
                            data-role="{{ $user->roles->first()->id }}"
                            data-toggle="modal" data-keyboard="false" data-backdrop="static"  data-target="#EditUser"> <i class="fa fa-fw fa-edit"></i> Edit
                    </button>
                  </td>                
                  <td width="10%">
                    <form action="{{ route('user.destroy', $user->id ) }}" class="delete" method="POST">
                        {{ method_field('DELETE') }}
                        {{ csrf_field()}}
                      <button type="submit" class="btn btn-md btn-block pull-right btn-danger" ><i class="fa fa-fw fa-trash"></i> Delete</button>
                    </form>
                  </td>
                </tr>
            @endforeach
          </tbody>
          <tfoot>
           <tr>
              <th> Name</th>
              <th> Email</th>
              <th> Edit</th>
              <th> Delete</th>
            </tr>
          </tfoot>

        </table>

      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="AddUser">
  <div class="modal-dialog">
    <form  action="{{ route('user.store') }}" method="POST">
      {{csrf_field()}}
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
          <h4 class="modal-title">Add User</h4>
        </div>
        <div class="modal-body">
  
        <div class="form-group">
          <label>Email:</label>
          <input type="email" class="form-control" name="email" placeholder="e.g testemail@chedro.com" required>
        </div>

         <div class="form-group">
          <label>Username:</label>
          <input type="text" class="form-control" name="name" placeholder="e.g John Doe" required>
        </div>

        <div class="form-group">
          <label>Password:</label>
          <input type="password" class="form-control" name="password" placeholder="e.g 123!chedronickname" required>
        </div>

        <div class="form-group">
          <label>Role:</label>
          <select class="form-control"  name="role">
            @foreach($roles as $role);
              <option value="{{ $role->id }}">{{ $role->name }}</option>
            @endforeach
          </select>
        </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-warning pull-left" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-success">Submit</button>
        </div>
      </div>
    </form> 
  </div>
</div>

<div class="modal fade" id="EditUser">
  <div class="modal-dialog">
    <form  action="{{ route('user.update', 'update' ) }}" method="POST">
      {{csrf_field()}}
      {{ method_field('PUT') }}
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
          <h4 class="modal-title">Edit Document</h4>
        </div>
        <div class="modal-body">
        
        <input type="hidden" id="id" name="id" class="form-control" >

        <div class="form-group">
          <label>Email:</label>
          <input type="email" class="form-control" name="email" id="email" placeholder="e.g testemail@chedro.com" required>
        </div>

         <div class="form-group">
          <label>Username:</label>
          <input type="text" class="form-control" name="name" id="name" placeholder="e.g John Doe" required>
        </div>

        <div class="form-group">
          <label>Role:</label>
          <select class="form-control" id="role" name="role">
            @foreach($roles as $role);
              <option value="{{ $role->id }}">{{ $role->name }}</option>
            @endforeach
          </select>
        </div>

        <div class="form-group">
          <label>Set New Password</label>
          <input type="password" class="form-control" name="password" id="password" placeholder="e.g 123!chedronickname" required>
        </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-warning pull-left" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-success">Submit</button>
        </div>
      </div>
    </form> 
  </div>
</div>

@endsection

@section('script')
<script type="text/javascript">
   $( document ).ready(function() {
       
     $('#datatable').DataTable({
        "ordering": false,
        "pageLength": 100
      });

    $('#EditUser').on('show.bs.modal',function (e) {

        var id= $(e.relatedTarget).data('id');
        var name= $(e.relatedTarget).data('name');
        var email= $(e.relatedTarget).data('email');
        var role= $(e.relatedTarget).data('role');

        console.log(role);
        $(e.currentTarget).find('input[id="id"]').val(id);
        $(e.currentTarget).find('input[id="name"]').val(name);
        $(e.currentTarget).find('input[id="email"]').val(email);
        $(e.currentTarget).find('select[id="role"]').val(role);

    });

    $(".delete").submit(function (e) {
      
      e.preventDefault();

      swal.fire({
          title: 'Are you sure?',
          text: 'You will not be able to recover this data!',
          type: 'warning',
          showCancelButton: true,
          confirmButtonText: 'Yes, delete it!',
          cancelButtonText: 'No, keep it'
          }).then((result) => {
          if (result.value) {
            $(this).closest(".delete").off("submit").submit();
          }else{
            swal.fire('Cancelled','Your data is safe!','error')
          }
      });

     });

  });
</script>
@endsection