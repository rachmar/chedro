@extends('layouts.admin')
 
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Archive</h3>
            </div>
            <div class="box-body">
                @if ( !$transactions->isEmpty() )

                <table id="datatable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th> Control ID</th>
                            <th> Institution Name </th>
                            <th> Document Name </th>
                            <th> Archive On</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach($transactions as $transaction)
                        <tr>
                            <td>{{ $transaction->control_id }}</td>
                            <td>{{ $transaction->institution_name }}</td>
                            <td>{{ $transaction->document_name }}</td>
                            <td>{{ $transaction->updated_at->format('Y-m-d h:i:s a') }}</td>
                            @endforeach

                    </tbody>

                </table>

                @else No Transaction Found @endif

            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
  <script type="text/javascript">
    $( document ).ready(function() {
      	$('#datatable').DataTable({
		  "ordering": false,
		  "pageLength": 100
		});
    });
 </script>
@endsection