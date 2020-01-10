@extends('layouts.admin')

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="box">
      <div class="box-header with-border">
            <h3 class="box-title">List Of Institutions</h3>
            <button type="button" class="btn btn-success  pull-right" data-toggle="modal" data-keyboard="false" data-backdrop="static" data-target="#AddDocument">
              <i class="fa fa-fw fa-plus-circle"></i> Add Institution
            </button>
      </div>
      <div class="box-body">

        <table id="datatable" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th> Institution ID</th>
              <th> Institution Name</th>
              <th> Edit</th>
              <th> Delete</th>
            </tr>
          </thead>
          <tbody>
            @foreach($institutions as $institution)
                <tr>
                  <td>{{ $institution->id }}</td>
                  <td>{{ $institution->name }}</td>
                   <td width="10%">
                    <button type="button" 
                            class="btn btn-md btn-warning  btn-block pull-right"
                            data-id="{{ $institution->id }}"
                            data-name="{{ $institution->name }}"
                            data-toggle="modal" data-keyboard="false" data-backdrop="static"  data-target="#EditDocument"> <i class="fa fa-fw fa-edit"></i> Edit
                    </button>
                  </td>                
                  <td width="10%">
                    <form action="{{ route('institution.destroy', $institution->id ) }}" class="delete" method="POST">
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
              <th> Institution ID</th>
              <th> Institution Name</th>
              <th> Edit</th>
              <th> Delete</th>
            </tr>
          </tfoot>

        </table>

      </div>
    </div>
  </div>
</div>



<div class="modal fade" id="AddDocument">
  <div class="modal-dialog">
    <form  action="{{ route('institution.store') }}" method="POST">
      {{csrf_field()}}
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
          <h4 class="modal-title">Add Institution</h4>
        </div>
        <div class="modal-body">
  
        <div class="form-group">
          <label> Institution Name</label>
          <input type="text" name="name" class="form-control" required>
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


<div class="modal fade" id="EditDocument">
  <div class="modal-dialog">
    <form  action="{{ route('institution.update', 'update' ) }}" method="POST">
      {{csrf_field()}}
      {{ method_field('PUT') }}
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
          <h4 class="modal-title">Edit Institution</h4>
        </div>
        <div class="modal-body">
        
        <input type="hidden" id="id" name="id" class="form-control" >

        <div class="form-group">
          <label> Institution Name</label>
          <input type="text" id="name" name="name" class="form-control" required>
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

    $('#datatable').DataTable();

    $('#EditDocument').on('show.bs.modal',function (e) {

        var id= $(e.relatedTarget).data('id');
        var name= $(e.relatedTarget).data('name');

        $(e.currentTarget).find('input[id="id"]').val(id);
        $(e.currentTarget).find('input[id="name"]').val(name);

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