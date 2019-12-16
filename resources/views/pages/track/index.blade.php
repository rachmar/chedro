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
                    <span class="label bg-maroon">{{$transaction->status_name}}</span>
                  </td>

                  <td>
                    <a href="{{ route('track.show', $transaction->id ) }}" class="btn btn-md btn-default  btn-block pull-right" ><i class="fa fa-fw fa-eye"></i> View</a>
                  </td>   
                 
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


@endsection

@section('script')
<script type="text/javascript">
  
 
</script>
@endsection