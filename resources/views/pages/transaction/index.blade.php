@extends('layouts.admin')

@section('page-title', 'Generate Transaction')

@section('content')
<div class="row">

  <div class="col-md-6">
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Control # : {{ strtoupper($control_id) }}</h3>
      </div>
        <form action="{{ route('transaction.store') }}" method="POST">
        {{csrf_field()}}
          <div class="box-body">
            <input type="hidden" id="control_id" name="control_id" value="{{ strtoupper($control_id) }}">
              <div class="form-group">
                <label for="document_id">Document</label>
                <select id="document_id" class="form-control" name="document_id">
                  @foreach ($documents as $document)
                    <option value="{{ $document->id }}">{{ $document->name }}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label for="secretary_id">Secretary</label>
                <select id="secretary_id" class="form-control" name="secretary_id">
                  @foreach ($secretaries as $secretary)
                    <option value="{{ $secretary->id }}">{{ $secretary->name }}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label for="subject">Subject</label>
                <input type="text" id="subject" class="form-control" name="subject" value=" Testing Subject : {{ strtoupper($control_id) }}" required>
              </div>
              <div class="form-group">
                <label for="comments">Comments</label>
                <textarea id="comments" class="form-control" name="comments" rows="5" required></textarea>
              </div>
            </div>
      
          <div class="box-footer "> 
            <div class="form-group">
                <button  type="submit" class="btn btn-primary pull-right">Generate Transaction</button>
            </div>
          </div>
        </form>
      </div>
  </div>

  <div class="col-md-6">
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
  </div>

</div>
@endsection

@section('script')
<script type="text/javascript">
</script>
@endsection