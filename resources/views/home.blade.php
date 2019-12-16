@extends('layouts.admin')
 
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Monitoring</h3>
            </div>
            <div class="box-body">
                @if ( !$transactions->isEmpty() )

                <table id="datatable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th> Control ID</th>
                            <th> Current Holder</th>
                            <th> Institution Name</th>
                            <th> Document Name</th>
                            <th> Priority </th>
                            <th> Action </th>
                            <th> Created On</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach($transactions as $transaction)
                        <tr>
                            <td>{{ $transaction->control_id }}</td>
                            <td>{{ $transaction->assign_name }}</td>
                            <td>{{ $transaction->institution_name }}</td>
                            <td>{{ $transaction->document_name }}</td>

                            <td>
                                @if ( $transaction->priority_id === 1 )
                                <span class="label  bg-green">Lease Priority</span> @elseif ( $transaction->priority_id === 2 )
                                <span class="label  bg-yellow">Mid Priority</span> @elseif ( $transaction->priority_id === 3 )
                                <span class="label  bg-red">High Priority</span> @else
                                <span class="label  bg-blue">No Priority Set</span> @endif
                            </td>
                            <td>
                                @if ( $transaction->status_id != 1 )
                                <span class="label bg-maroon">{{$transaction->status_name}}</span> @else
                                <span class="label bg-blue">No Action Set</span> @endif
                            </td>

                            <td>{{ $transaction->created_at->format('Y-m-d h:i:s a') }}</td>

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
            pageLength: 100,
        });
    });
 </script>
@endsection