@extends('layouts.admin')

@section('page-title', 'Generate Transaction')

@section('content')
<div class="row">
  <div class="col-md-6">
    <div class="box box-primary">
        <form action="{{ route('transaction.store') }}" method="POST">
        {{csrf_field()}}
          <div class="box-body">
            <div class="form-group">
              <label for="control_id">Control # : {{ strtoupper($control_id) }}</label>
              <input type="hidden" id="control_id" name="control_id" value="{{ strtoupper($control_id) }}">
            </div>
            <div class="form-group">
              <label for="from">From</label>
              <select id="from" class="form-control" name="from">
                <option value="school">School</option>
                <option value="agency">Agency</option>
                <option value="walk-in">Walk-In</option>
              </select>
            </div>
            <div class="form-group">
              <label for="document_id">Document</label>
              <select id="document_id" class="form-control" name="document_id">
                <option value="0">Please Choose an item</option>
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
              <input type="text" id="subject" class="form-control" name="subject" >
            </div>
            <div class="form-group">
              <label for="details">Details</label>
              <textarea id="details" class="form-control" name="details"></textarea>
            </div>
            <div class="form-group">
              <label for="comments">Comments</label>
              <textarea id="comments" class="form-control" name="comments"></textarea>
            </div>
          </div>
          <div class="box-footer"> 
            <div class="form-group">
                <button  type="submit" class="btn btn-primary btn-block btn-flat">Generate</button>
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