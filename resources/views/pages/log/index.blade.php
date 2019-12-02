@extends('layouts.admin')



@section('content')
  <div class="row">
  <div class="col-md-12">
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">List of Logs</h3>
         @if ( !$logs->isEmpty() )

          <a href="{{ route('export') }}"  class="btn btn-success  pull-right" >
            <i class="fa fa-fw fa-file-excel-o"></i> Download
          </a>
           @endif
      </div>

      <div class="box-body">

                @if ( !$logs->isEmpty() )

        <table id="datatable" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th> Modified By</th>
              <th> Description </th>
            </tr>
          </thead>
          <tbody>
            @foreach($logs as $log)
                <tr>
                  <td>{{ $log->user->name }}</td>
                  <td>{{ $log->description }}</td>
                </tr>
            @endforeach
          </tbody>
        </table>

        @else
             No Logs Found

          @endif

      </div>
    </div>
  </div>
</div>

@endsection
