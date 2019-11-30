@extends('layouts.admin')

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="box">
      <div class="box-header with-border">
          	<h3 class="box-title">Students</h3>
          	<button type="button" class="btn btn-success  pull-right" data-toggle="modal" data-keyboard="false" data-backdrop="static" data-target="#AddStudent">
              <i class="fa fa-fw fa-plus-circle"></i> Add student
            </button>
      </div>
      <div class="box-body">

        <table id="datatable" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>Name</th>
            </tr>
          </thead>
          <tbody>
            @foreach($documents as $document)
                <tr>
              	  <td>{{ $document->name }}</td>                
                  <td width="10%">
                    <form action="{{ route('document.destroy', $document->id ) }}" class="delete" method="POST">
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
              <th>Name</th>
              <th>Section</th>
              <th>Parent</th>
              <th>Phone</th>
              <th>Edit</th>
              <th>Delete</th>
            </tr>
          </tfoot>

        </table>

      </div>
    </div>
  </div>
</div>

@endsection

@section('script')
<script type="text/javascript">
    $( document ).ready(function() {

	  $('#datatable').DataTable();

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