@extends('layouts.admin')

@section('page-title', 'Show Transaction')

@section('content')
<div class="row">
  	<div class="col-md-8">
	    <div class="box box-primary">
	      <div class="box-header with-border">
	        <h3 class="box-title">Control # : {{ strtoupper($transaction->control_id) }}</h3>

			<div class="pull-right" >
		        @if ( $transaction->priority_id === 1 )
				   <span class="label  bg-green">Lease Priority</span>
				@elseif ( $transaction->priority_id === 2 )
				   <span class="label  bg-yellow">Mid Priority</span>
				@elseif ( $transaction->priority_id === 3 )
				   <span class="label  bg-red">High Priority</span>
				@else
				   <span class="label  bg-blue">No Priority Set</span>
				@endif
			</div>

			<div class="pull-right" style="margin-right: 10px;">
				@if ( $transaction->status_id != 0 )
				   <span class="label bg-maroon">{{$status->name}}</span>
				@else
				   <span class="label bg-maroon">No Action Set</span>
				@endif
			</div>
	        
	      </div>

	       <div class="box-body">
          		<dl>
		            <dt>Subject</dt>
		            <dd>{{ $transaction->subject }}</dd>
		            <dt>Comments</dt>
		            <dd>{{ $transaction->comments }}</dd>
		         </dl>
        	</div>
        	<div class="box-footer text-center">
              <a href="{{ route('track.index') }}" class="uppercase">Go Back</a>
            </div>

	    </div>
	</div>

    <div class="col-md-4">
        <form action="{{ route('track.update', $transaction->id ) }}" class="confused" method="POST">
        	{{ method_field('PUT') }}
            {{csrf_field()}}
    		<div class="row">

    			@if (Auth::user()->isSECRETARY())
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
					      <select id="priority" class="form-control" name="priority" >
						        	<option value="0">Please Choose</option>
						            <option value="1">Lease Priority</option>
						            <option value="2">Mid Priority</option>
						            <option value="3">High Priority</option>
						        </select>
					        </div>
					    </div>
			  		</div>
			  	@else

			  		<input type="hidden" name="status" value="{{ $transaction->status_id }}">
			  		<input type="hidden" name="priority" value="{{ $transaction->priority_id }}">

				@endif

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
					<button id="btn_confused" type="submit" class="btn btn-primary btn-block btn-flat" disabled>Transfer</button>
				</div>
	  		</div>
    	</form>
   	</div>
</div>
@endsection

@section('script')

	@if (Auth::user()->isSECRETARY())
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

	@else
		<script type="text/javascript">
			
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
			        $("#assign").val(0);
			        $('#btn_confused').prop('disabled',true);
			      }
			    });
			});

			function isFormSubmittable(){
				if ( $("#assign").val() != 0 ) {
					$('#btn_confused').prop('disabled',false);
				}else{
					$('#btn_confused').prop('disabled',true);
				}
			}
		</script>
	@endif


@endsection