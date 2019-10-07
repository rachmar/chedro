@extends('layouts.admin')

@section('page-title', 'Generate Transaction')

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Control # : {{ strtoupper($control_id) }}</h3>
      </div>
        <form action="{{ route('transaction.store') }}" method="POST">
        {{csrf_field()}}
          <div class="box-body">
            <input type="hidden" id="control_id" name="control_id" value="{{ strtoupper($control_id) }}">
            <div class="row">
              <div class="form-group col-md-6">
                <label for="from">From</label>
                <select id="from" class="form-control" name="from">
                  <option value="school">School</option>
                  <option value="agency">Agency</option>
                  <option value="walk-in">Walk-In</option>
                </select>
              </div>
              <div class="form-group  col-md-6">
                <label for="document_id">Document</label>
                <select id="document_id" class="form-control" name="document_id">
                  @foreach ($documents as $document)
                    <option value="{{ $document->id }}">{{ $document->name }}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group col-md-6">
                <label for="secretary_id">Secretary</label>
                <select id="secretary_id" class="form-control" name="secretary_id">
                  @foreach ($secretaries as $secretary)
                    <option value="{{ $secretary->id }}">{{ $secretary->name }}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group col-md-6">
                <label for="subject">Subject</label>
                <input type="text" id="subject" class="form-control" name="subject" required>
              </div>
              <div class="form-group col-md-6">
                <label for="details">Details</label>
                <textarea id="details" class="form-control" name="details" required></textarea>
              </div>
              <div class="form-group col-md-6">
                <label for="comments">Comments</label>
                <textarea id="comments" class="form-control" name="comments" required></textarea>
              </div>
            </div>
          </div>
          <div class="box-footer "> 
            <div class="form-group">
                <button  type="submit" class="btn btn-primary pull-right">Generate Route</button>
            </div>
          </div>
        </form>
      </div>
  </div>
</div>
@endsection

@section('script')
<script type="text/javascript">
</script>
@endsection