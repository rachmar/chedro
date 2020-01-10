@extends('layouts.admin')

@section('content')
<div class="row">

  <div class="col-md-12">

    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Control # : {{ strtoupper($control_id) }}</h3>
        <div class="box-tools pull-right" style="font-size: 18px;">
          {{ date('l, jS \of F Y h:i A') }}
        </div>
      </div>

        <form class="generate" action="{{ route('transaction.store') }}" method="POST" enctype="multipart/form-data">
          {{csrf_field()}}

          <div class="box-body">

            <input type="hidden" id="control_id" name="control_id" value="{{ strtoupper($control_id) }}">

            <div class="row">
              <div class="form-group col-md-6">
                <label for="institution_id">From <span>*</span></label>
                <select id="institution_id" class="form-control" name="institution_id">
                  @foreach ($institutions as $institution)
                    <option value="{{ $institution->id }}">{{ $institution->name }}</option>
                  @endforeach
                    <!-- <option value="99999999">Other...</option> -->
                </select>
                <input type="text" class="form-control" id="institution_id_other" name="institution_id_other" value="" placeholder="Institution..." style="display: none;">
              </div>
              <div class="form-group col-md-6">
                <label for="document_id">Document <span>*</span></label>
                <select id="document_id" class="form-control" name="document_id">
                  @foreach ($documents as $document)
                    <option value="{{ $document->id }}">{{ $document->name }}</option>
                  @endforeach
                    <!-- <option value="99999999">Other...</option> -->
                </select>
                <input type="text" class="form-control" id="document_id_other" name="document_id_other" value="" placeholder="Document..." style="display: none;">
              </div>
            </div>

            <div class="row">
              <div class="form-group col-md-6">
                <label for="secretary_id">Secretary <span>*</span></label>
                <select id="secretary_id" class="form-control" name="secretary_id">
                  @foreach ($secretaries as $secretary)
                    <option value="{{ $secretary->id }}">{{ $secretary->name }}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group col-md-6">
                <label for="priority_id">Priority <span>*</span></label>
                <select id="priority_id" class="form-control" name="priority_id" >
                    <option value="1">Lease Priority</option>
                    <option value="2">Mid Priority</option>
                    <option value="3">High Priority</option>
                </select>
              </div>
            </div>

            <div class="row">
              <div class="form-group col-md-12">
                <label for="subject">Subject <span>*</span></label>
                <input type="text" id="subject" class="form-control" name="subject" autocomplete="off" required>
              </div>
              <div class="form-group col-md-12">
                <label for="comments">Comments <span>*</span></label>
                <textarea id="comments" class="form-control" name="comments" rows="5" required></textarea>
              </div>
             
              <div class="form-group col-md-12">
                
                <label for="uploadFile">Attachement</label>
                <input type="file" name="uploadFile">
              </div>
            </div>

          </div>

          <div class="box-footer ">
            <div class="form-group">
                <button  type="submit" class="btn btn-primary pull-right" >Generate Transaction</button>
            </div>
          </div>
        </form>
      </div>
  </div>

 <!--  <div class="col-md-6">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">On Progress Transactions</h3>
        </div>
        <div class="box-body">
         @if(!$transactions->isEmpty())
           <table class="table table-striped refined_payment">
              <tbody>
                  <tr>
                    <th>Control Num</th>
                    <th>Document Name</th>
                    <th></th>
                  </tr>
                @foreach ($transactions as $transaction)
                  <tr>
                      <td>{{ $transaction->control_id }}</td>
                      <td>{{ $transaction->name }}</td>
                      <td><span class="label pull-right bg-green">NOT SET</span></td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          @else
              No Data Found
          @endif
        </div>
      </div>
  </div> -->

</div>
@endsection

@section('script')
<script type="text/javascript">
  $(".generate").submit(function (e) {

      var ins_id = $('#institution_id').val();
      var doc_id = $('#document_id').val();
      var crl_id = '{{ strtoupper($control_id) }}';
      var link = "{{ route('qrcode.index') }}";

      e.preventDefault();

      swal.fire({
        title: 'Are you sure?',
        text: 'This will generate the transaction.',
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, generate it!',
        cancelButtonText: 'No, not yet'
        }).then((result) => {
        if (result.value) {
          window.open(link + "?crl_id="+crl_id+"&doc_id="+doc_id+"&ins_id="+ins_id);
          $(this).closest(".generate").off("submit").submit();
        }else{
          swal.fire('Cancelled','Your transaction is safe!','error');
          
        }
      });

        
  });

</script>

<script type="text/javascript">

  $("#institution_id").change(function() {

      console.log(this.value);

      if ( this.value != '99999999') {
        $('#institution_id_other').hide();
        $('#institution_id_other').prop('required',false);

      }else{
        $('#institution_id_other').show();
        $('#institution_id_other').prop('required',true);
      }

  });


  $("#document_id").change(function() {

      console.log(this.value);

      if ( this.value != '99999999') {
        $('#document_id_other').hide();
        $('#document_id_other').prop('required',false);

      }else{
        $('#document_id_other').show();
        $('#document_id_other').prop('required',true);
      }

  });



  function checkFieldHaveValue(){

  }





</script>
@endsection
