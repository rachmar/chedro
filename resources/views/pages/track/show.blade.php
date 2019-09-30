@extends('layouts.admin')

@section('page-title', 'Show Transaction')

@section('content')
<div class="row">
  	<div class="col-md-8">
	    <div class="box box-primary">
	    	{{ print_r($transaction)}}
	    </div>
  	</div>
    <div class="col-md-4">
        <form action="{{ route('track.update', $transaction->id ) }}" class="confused" method="POST">
        	{{ method_field('PUT') }}
            {{csrf_field()}}
    		<div class="row">
		  		<div class="col-md-12">
		  			<div class="box box-primary">
				    	<div class="box-body">
				         	<label for="status">Status</label>
					        <select id="status" class="form-control" name="status" >
					        	<option value="0">Please Choose</option>
				                @foreach ($statuses as $status)
				                  <option value="{{ $status->id }}">{{ $status->name }}</option>
				                @endforeach
			              	</select>
				        </div>
				    </div>
		  		</div>
		  		<div class="col-md-12">
		  			<div class="box box-primary">
				    	<div class="box-body">
				         	<label for="priority">Priority</label>
				          	<select id="priority" class="form-control" name="priority">
					        	<option value="0">Please Choose</option>
					            <option value="1">Lease Priority</option>
					            <option value="2">Mid Priority</option>
					            <option value="3">High Priority</option>
					        </select>
				        </div>
				    </div>
		  		</div>
		  		<div class="col-md-12">
		  			<div class="box box-primary">
		              	<div class="box-body">
				         	<label for="assign">Assign</label>
				          	<select id="assign" class="form-control" name="assign">
					        	<option value="0">Please Choose</option>
					            @foreach ($workers as $worker)
				                  <option value="{{ $worker->id }}">{{ $worker->name }}</option>
				                @endforeach
					        </select>
				        </div>
				    </div>
		  		</div>
		  		<div class="col-md-12">
					<button id="btn_confused" type="submit" class="btn btn-primary btn-block btn-flat" disabled>Add</button>
				</div>
	  		</div>
    	</form>
   	</div>
</div>
@endsection

@section('script')
<script type="text/javascript">

	$("#status").change(function (e) {
	    e.preventDefault();
	    isFormSubmittable();
	});

	$("#priority").change(function (e) {
	    e.preventDefault();
	    isFormSubmittable();
	});

	$("#assign").change(function (e) {
	    e.preventDefault();
	    isFormSubmittable();
	});

	$(".confused").submit(function (e) {
	    e.preventDefault();
	    swal.fire({
	      title: 'Are you sure?',
	      text: 'This will changed the assigned document.',
	      type: 'warning',
	      showCancelButton: true,
	      confirmButtonText: 'Yes, change it!',
	      cancelButtonText: 'No, not yet'
	      }).then((result) => {
	      if (result.value) {
	        $(this).closest(".confused").off("submit").submit();
	      }else{
	        swal.fire('Cancelled','Your document is safe!','error');
	        $("#status").val(0);
	        $("#priority").val(0);
	        $("#assign").val(0);
	        $('#btn_confused').prop('disabled',true);
	      }
	    });
	});

	function isFormSubmittable(){
		if ( $("#status").val() != 0 && $("#priority").val() != 0 && $("#assign").val() != 0 ) {
			$('#btn_confused').prop('disabled',false);
		}else{
			$('#btn_confused').prop('disabled',true);
		}
	}

</script>
@endsection