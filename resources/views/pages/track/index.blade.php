@extends('layouts.admin')

@section('page-title', 'Track List')

@section('content')
<div class="row">

  @foreach ($transactions as $transaction)

    <div class="col-md-6">
        <div class="box box-widget">
            <div class="box-header with-border">
              <div class="user-block">
                <img class="img-circle" src="https://upload.wikimedia.org/wikipedia/commons/7/7d/Commission_on_Higher_Education_%28CHEd%29.svg" alt="User Image">
                <span class="username"><a href="#"> Control ID: {{ $transaction->control_id }}</a></span>
                <span class="description">

                  @if ( $transaction->priority_id === 1 )
                     <span class="label  bg-green">Lease Priority</span>
                  @elseif ( $transaction->priority_id === 2 )
                     <span class="label  bg-yellow">Mid Priority</span>
                  @elseif ( $transaction->priority_id === 3 )
                     <span class="label  bg-red">High Priority</span>
                  @else
                     <span class="label  bg-blue">No Priority Set</span>
                  @endif

                  @if ( $transaction->status_id != 0 )
                     <span class="label bg-maroon">{{$transaction->name}}</span>
                  @else
                     <span class="label bg-maroon">No Action Set</span>
                  @endif

                  <span class="pull-right"> {{ $transaction->created_at->format('d/m/Y H:m')}}   </span>
                </span>
     
              </div>

            </div>

            <div class="box-footer text-center">
              <a href="{{ route('track.show', $transaction->id ) }}" class="uppercase">View Details</a>
            </div>
        </div>
    </div>

  @endforeach

</div>
@endsection

@section('script')
<script type="text/javascript">
    $( document ).ready(function() {
      
    });
</script>
@endsection