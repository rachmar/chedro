@extends('layouts.admin')

@section('page-title', 'Show Transaction')

@section('content')

<div class="row">

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
						<span class="label bg-maroon">{{$transaction->status_name}}</span>
					</div>

			      </div>

			       <div class="box-body">
			      		

				        <div class="row">
			             
			             <div class="form-group col-md-6">
			                <label for="uploadFile">Institution Name</label>
			                <p>{{ $transaction->institution_name }}</p>
			              </div>

			              <div class="form-group col-md-6">
			                <label for="uploadFile">Document Name</label>
			                <p>{{ $transaction->document_name }}</p>
			              </div>

			              <div class="form-group col-md-12">
			                <label for="uploadFile">Subject</label>
			                <p>{{ $transaction->subject }}</p>
			              </div>

			              <div class="form-group col-md-12">
			                <label for="uploadFile">Comments</label>
			                <div>
			                @if ( !$comments->isEmpty() )
		          				@foreach($comments as $comment)
		               				<dl>
									  <dt>{{ $comment->user }} @ {{ $comment->created_at->format('h:i a') }}</b></dt>
									  <dd>{{ $comment->message }}</dd>
									</dl>
		            			@endforeach
		                	@else 
		                		No Comments Found 
		                	@endif
		                	</div>
			              </div>


			             <div class="form-group col-md-12">
			                <label for="uploadFile">Attachment</label>
			                <div>
			                @if ( !$attachments->isEmpty() )
		          				@foreach($attachments as $attachment)
		               				<a href="{{asset('storage/'.$attachment->image_filename)}}" target="_blank"> {{ $attachment->image_filename }} </a>
		               				 <br/>
		            			@endforeach
		                	@else 
		                		No Attachments Found 
		                	@endif
		                	</div>
			              </div>

			              

			            </div>

		        	</div>




		        	<div class="box-footer text-center">
		              <a href="{{ route('track.index') }}" class="uppercase">Go Back</a>
		            </div>

			    </div>
			</div>

		    <div class="col-md-4">

		    	<form action="{{ route('track.update', 'update') }}" class="confused" method="POST" enctype="multipart/form-data">
			    	{{ method_field('PUT') }}
			        {{csrf_field()}}

			        	
		        	<input type="hidden" name="transaction_id" value="{{ $transaction->id }}">      

		    		<div class="row">

		    			@if (Auth::user()->isSECRETARY())
					  		<div class="col-md-12">
					  			<div class="box box-primary">
							    	<div class="box-body">
							         	<label for="status">Status</label>
								        <select id="status" class="form-control" name="status" >
								        	<option value="0">Please Choose</option>
							                @foreach ($statuses as $status)
							                  <option value="{{ $status->id }}" 
							                  	{{ ( $status->id === $transaction->status_id) ? 'selected' : '' }}
							                  	>{{ $status->name }}</option>
							                @endforeach
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
				  			<div class="box box-primary">
						    	<div class="box-body">

						         	<div class="form-group">
						                <label for="uploadFile">Upload Attachment</label>
						                <input type="file" name="uploadFile">
						            </div>

									<div class="form-group">
						                <label for="comments">Comments</label>
						                <textarea id="comments" class="form-control" name="comments" rows="5"></textarea>
						            </div>
						        </div>
						    </div>
				  		</div>

				  		<div class="col-md-12">
							<button id="btn_confused" type="submit" class="btn btn-primary btn-block btn-flat" disabled>Transfer</button>
						</div>

			  		</div>

		  		</form>

		  		@if (Auth::user()->isRECORD())

		  		<form action="{{ route('track.update', 'archive') }}" class="archive" method="POST">
                      {{ method_field('PUT') }}
                      {{csrf_field()}}
                      <input type="hidden" name="transaction_id" value="{{ $transaction->id }}">

                       <button type="submit" class="btn btn-md btn-success btn-flat  btn-block"> 
                      	Archive
                    	</button>
                </form>


                <form action="{{ route('track.update', 'received') }}" class="archive" method="POST">
                      {{ method_field('PUT') }}
                      {{csrf_field()}}

                      <input type="hidden" name="transaction_id" value="{{ $transaction->id }}">

                      <div class="input-group input-group-md">
		                <input type="text" class="form-control" name="name" autocomplete="off" required> 
		                    <span class="input-group-btn">
		                      <button type="submit" class="btn btn-danger btn-flat">Received By</button>
		                    </span>
		              </div>

                </form>

                @endif 
		    	
		   	</div>

	   	

   	</div>

   

</div>
@endsection

@section('script')

	<script type="text/javascript">
		$(".archive").submit(function (e) {
	      e.preventDefault();

	      swal.fire({
	        title: 'Are you sure?',
	        text: 'This will archive the transaction.',
	        type: 'warning',
	        showCancelButton: true,
	        confirmButtonText: 'Yes, archive it!',
	        cancelButtonText: 'No, not yet'
	        }).then((result) => {
	        if (result.value) {
	          $(this).closest(".archive").off("submit").submit();
	        }else{
	          swal.fire('Cancelled','Your transaction is safe!','error');
	          
	        }
	      });

	        
	  });

	</script>

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
				if ( $("#status").val() != 0  && $("#status").val() != 1 && $("#priority").val() != 0 && $("#assign").val() != 0 ) {
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