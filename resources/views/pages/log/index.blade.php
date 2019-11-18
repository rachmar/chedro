@extends('layouts.log')



@section('content')

<div class="box">
  <div class="box-header">
    <h3 class="box-title">Striped Full Width Table</h3>
  </div>
    <!-- /.box-header -->
    <div class="box-body no-padding">
      <table class="table table-striped">
        <tbody><tr>
          <th>Username</th>
          <th>Description</th>
        </tr>
        @foreach( $logs as $log)
          <tr>
            <td>{{ $log->user->name }}</td>
            <td>{{ $log->description }}</td>
          </tr>
        @endforeach

      </tbody></table>
    </div>
    <!-- /.box-body -->
  </div>

@endsection
