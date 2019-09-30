@extends('layouts.admin')

@section('page-title', 'Track List')

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="box box-primary">
      <div class="box-body">
        <table id="datatable" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>Date</th>
              <th>Control ID</th>
              <th>Action</th>         
            </tr>
          </thead>

          <tbody>

            @foreach ($transactions as $transaction)
                <tr>
                  <td>{{ $transaction->created_at->format('d/m/Y') }}</td>
                  <td>{{ $transaction->control_id }}</td>
                  <td>
                    <a href="{{ route('track.show', $transaction->id ) }}" class="btn btn-sm btn-warning">
                        View Details
                    </a>
                  </td>
                </tr>
            @endforeach
          </tbody>
          <tfoot>
            <tr>
              <th>Date</th>
              <th>Control ID</th>
              <th>Action</th>         
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
    });
</script>
@endsection