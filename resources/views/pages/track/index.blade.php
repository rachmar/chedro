@extends('layouts.admin')

@section('content')

<div class="row">
  <div class="col-md-12">
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">Your Assigned Transaction</h3>
      </div>
      <div class="box-body">
        @if ( !$transactions->isEmpty() )

        <table id="datatable" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th> Control ID</th>
              <th> Institution Name</th>
              <th> Document Name</th>
              <th> Priority </th>
              <th> Action </th>
              <th> Transfer</th>

              @if (Auth::user()->isRECORD())
                <th> Archive</th>
              @endif 

            </tr>
          </thead>
          <tbody>

            @foreach($transactions as $transaction)
                <tr>
                  <td >{{ $transaction->control_id }}</td>
                  <td>{{ $transaction->institution_name }}</td>
                  <td>{{ $transaction->document_name }}</td>
                  <td>
                    @if ( $transaction->priority_id === 1 )
                     <span class="label  bg-green">Lease Priority</span>
                  @elseif ( $transaction->priority_id === 2 )
                     <span class="label  bg-yellow">Mid Priority</span>
                  @elseif ( $transaction->priority_id === 3 )
                     <span class="label  bg-red">High Priority</span>
                  @else
                     <span class="label  bg-blue">No Priority Set</span>
                  @endif
                  </td>
                  <td>
                    @if ( $transaction->status_id != 1 )
                       <span class="label bg-maroon">{{$transaction->status_name}}</span>
                    @else
                       <span class="label bg-blue">No Action Set</span>
                    @endif
                  </td>

                  <td>
                    <button type="button" 
                            class="btn btn-md btn-default  btn-block pull-right"
                            data-id="{{ $transaction->id }}"
                            data-control_id="{{ $transaction->control_id }}"
                            data-institution_name="{{ $transaction->institution_name }}"
                            data-document_name="{{ $transaction->document_name }}"
                            data-status_id="{{ $transaction->status_id }}"
                            data-status_name="{{ $transaction->status_name }}"
                            data-priority_id="{{ $transaction->priority_id }}"
                            data-subject="{{ $transaction->subject }}"
                            data-comments="{{ $transaction->comments }}"
                            data-filelink="{{ $transaction->image_filename ? asset('storage/'.$transaction->image_filename ): '#' }}"

                            data-toggle="modal" 
                            data-keyboard="false" 
                            data-backdrop="static"  
                            data-target="#ViewTransaction"> <i class="fa fa-fw fa-eye"></i> Transfer
                    </button>
                  </td>   

                  @if (Auth::user()->isRECORD())
                    <td>

                      <form action="{{ route('track.update', 'archive') }}" class="archive" method="POST">
                          {{ method_field('PUT') }}
                          {{csrf_field()}}
                          <input type="hidden" name="transaction_id" value="{{ $transaction->id }}">

                           <button type="submit" class="btn btn-md btn-default  btn-block pull-right"> 
                          <i class="fa fa-fw fa-save"></i> Archive
                        </button>
                      </form>

                    </td> 
                  @endif               
                 
                </tr>
            @endforeach
            
          </tbody>

        </table>

        @else
             No Transaction Found

          @endif

      </div>
    </div>
  </div>
</div>




</div>


<div class="modal fade" id="ViewTransaction">
  <div class="modal-dialog">
    
    <form action="{{ route('track.update', 'update') }}" class="confused" method="POST">
      {{ method_field('PUT') }}
      {{csrf_field()}}
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
          <h4 class="modal-title"> Transaction: 
            <span id="control_id">asdasd</span>
          </h4>
        </div>
        <div class="modal-body">
          
         <input type="hidden" id="transaction_id" name="transaction_id" class="form-control" >

          <div class="row">
            <div class="form-group col-md-6">
              <label for="institution_id">Priority</label>
              <p><span id="priority_id"></span></p>
            </div>
            <div class="form-group col-md-6">
              <label for="document_id">Status</label>
              <p><span id="status_id"></span></p>
            </div>
          </div>


          <div class="row">
            <div class="form-group col-md-6">
              <label for="institution_id">From</label>
              <p id="institution_name"></p>
            </div>
            <div class="form-group col-md-6">
              <label for="document_id">Document</label>
              <p id="document_name"></p>
            </div>
          </div>

          <div class="row">
            <div class="form-group col-md-12">
              <label for="subject">Subject</label>
              <p id="subject"></p>
            </div>
            <div class="form-group col-md-12">
              <label for="comments">Comments</label>
              <p id="comments"></p>
            </div>

            <div class="form-group col-md-12">
              <label for="uploadFile">Upload Image</label>
              <p><a href="#" id="file" >Click Here to Download</a></p>
            </div>
     
          </div>
     
        </div>
        <div class="modal-footer">

          <table class="table table-striped">
            <tbody>
                <tr>

                    @if (Auth::user()->isSECRETARY())
                      <th>Status</th>
                      <th>Assign To</th>
                    @else
                      <th>Assign To</th>
                    @endif

                </tr>
                <tr>

                    @if (Auth::user()->isSECRETARY())
                    <td>
                        <select id="status" class="form-control" name="status">
                            @foreach ($statuses as $status)
                            <option value="{{ $status->id }}">{{ $status->name }}</option>
                            @endforeach
                        </select>
                    </td>
                    @else
                     <input type="hidden" id="status_inpt" name="status" value="">
                    @endif


                    <td>
                        <select id="assign" class="form-control" name="assign">
                            <option value="0">Please Choose</option>
                            @foreach ($workers as $worker)
                            <option value="{{ $worker->id }}">{{ $worker->name }}</option>
                            @endforeach
                        </select>
                    </td>

                </tr>

            </tbody>
          </table>

          <button type="button" class="btn btn-warning pull-left" data-dismiss="modal">Close</button>
          <button id="btn_confused" type="submit" class="btn btn-success" disabled>Submit</button>
        </div>
      </div>
    </form> 
  </div>
</div>
@endsection

@section('script')
<script type="text/javascript">
  
  $('#ViewTransaction').on('show.bs.modal',function (e) {

    var transaction_id= $(e.relatedTarget).data('id');
    var control_id= $(e.relatedTarget).data('control_id');
    var priority_id= $(e.relatedTarget).data('priority_id');
    var status_id= $(e.relatedTarget).data('status_id');
    var status_name= $(e.relatedTarget).data('status_name');

    var institution_name= $(e.relatedTarget).data('institution_name');
    var document_name= $(e.relatedTarget).data('document_name');
    var subject= $(e.relatedTarget).data('subject');
    var comments= $(e.relatedTarget).data('comments');

    var filelink= $(e.relatedTarget).data('filelink');

    console.log(filelink);

    $(e.currentTarget).find('input[id="transaction_id"]').val(transaction_id);

    $(e.currentTarget).find('span[id="control_id"]').html(control_id);

    $(e.currentTarget).find('span[id="priority_id"]').removeClass();
    if (priority_id === 3) {
      $(e.currentTarget).find('span[id="priority_id"]').addClass('label bg-red');
      $(e.currentTarget).find('span[id="priority_id"]').html('High Priority');
    }else if( priority_id === 2 ){
      $(e.currentTarget).find('span[id="priority_id"]').addClass('label bg-yellow')
      $(e.currentTarget).find('span[id="priority_id"]').html('Mid Priority');
    }else if( priority_id === 1){
      $(e.currentTarget).find('span[id="priority_id"]').addClass('label bg-green')
      $(e.currentTarget).find('span[id="priority_id"]').html('Lease Priority');
    }else{
      $(e.currentTarget).find('span[id="priority_id"]').addClass('label bg-blue')
      $(e.currentTarget).find('span[id="priority_id"]').html('No Priority Set');
    }

    $(e.currentTarget).find('span[id="status_id"]').removeClass();
     if( status_id != 1){
      $(e.currentTarget).find('span[id="status_id"]').addClass('label bg-maroon')
    }else{
      $(e.currentTarget).find('span[id="status_id"]').addClass('label bg-blue')
    }



    $(e.currentTarget).find('span[id="status_id"]').html(status_name);

    $(e.currentTarget).find('p[id="institution_name"]').html(institution_name);
    $(e.currentTarget).find('p[id="document_name"]').html(document_name);
    $(e.currentTarget).find('p[id="subject"]').html(subject);
    $(e.currentTarget).find('p[id="comments"]').html(comments);


    $(e.currentTarget).find('a[id="file"]').attr("href", filelink);

    if (filelink == '#') {
      $(e.currentTarget).find('a[id="file"]').html('No Attachement File');
    }

    $("#status").val(status_id);
    $("#status_inpt").val(status_id);


  });


  $(".archive").submit(function (e) {
      e.preventDefault();

      // swal.fire({
      //   title: 'Are you sure?',
      //   text: 'This will archive the transaction.',
      //   type: 'warning',
      //   showCancelButton: true,
      //   confirmButtonText: 'Yes, archive it!',
      //   cancelButtonText: 'No, not yet'
      //   }).then((result) => {
      //   if (result.value) {
      //     $(this).closest(".archive").off("submit").submit();
      //   }else{
      //     swal.fire('Cancelled','Your transaction is safe!','error');
          
      //   }
      // });

        swal.fire({
        
        title: 'Are you sure?',
        text: 'This will archive the transaction.',
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, archive it!',
        cancelButtonText: 'No, not yet',
        input: 'text',
        inputPlaceholder: "Received By",
        inputAttributes: {
          autocapitalize: 'off',
        },
        showLoaderOnConfirm: true,
        preConfirm: (login) => {

          if (login === '') {
            swal.showValidationMessage(`Required Received By!`)
          }
          console.log(login);
          // return fetch(`//api.github.com/users/${login}`)
          //   .then(response => {
          //     if (!response.ok) {
          //       throw new Error(response.statusText)
          //     }
          //     return response.json()
          //   })
          //   .catch(error => {
          //     swal.showValidationMessage(
          //       `Request failed: ${error}`
          //     )
          //   })

          return 'asdasd';
        },
        allowOutsideClick: false,
        }).then((result) => {
                  if (result.value) {
          $(this).closest(".archive").off("submit").submit();
        }else{
          swal.fire('Cancelled','Your transaction is safe!','error');
          
        }
        })
  });





</script>


@if (Auth::user()->isSECRETARY())
    <script type="text/javascript">

      $("#status").change(function (e) {
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
            text: 'This will changed the assigned transaction.',
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, change it!',
            cancelButtonText: 'No, not yet'
            }).then((result) => {
            if (result.value) {
              $(this).closest(".confused").off("submit").submit();
            }else{
              swal.fire('Cancelled','Your transaction is safe!','error');
              $("#status").val(1);
              $("#assign").val(0);
              $('#btn_confused').prop('disabled',true);
            }
          });
      });

      function isFormSubmittable(){
        if ( $("#status").val() != 1  && $("#assign").val() != 0 ) {
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