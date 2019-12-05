@extends('layouts.admin')

@section('content')
<div class="row">

  @if ( !Request::isMethod('post') )

    <form  action="{{ route('report.store') }}" method="POST">
      {{csrf_field()}}

      <div class="form-group col-md-4">
        <label>From Date</label>
        <div class="input-group">
            <input type="text" name="from" class="form-control datepicker" autocomplete="off">
            <span class="input-group-addon"><i class="fa fa-fw fa-calendar"></i></span>
        </div>
      </div>
      <div class="form-group col-md-4">
        <label>To Date</label>
        <div class="input-group">
            <input type="text" name="to"  class="form-control datepicker" autocomplete="off">
            <span class="input-group-addon"><i class="fa fa-fw fa-calendar"></i></span>
        </div>
      </div>
      <div class="form-group col-md-4" style="margin-top: 25px;">
         <button type="submit" class="btn btn-success  ">
              Submit
            </button>
      </div>         
    </form>

  @else

    <div id="printreport" class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Reports</h3>
                <button class="btn btn-success pull-right no-print" onclick="printDiv()">Print Report</button>
            </div>
            <div class="box-body">
                @if ( !$transactions->isEmpty() )

                <table id="datatable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th> Control ID</th>
                            <th> Institution Name</th>
                            <th> Document Name </th>
                            <th> Created On</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach($transactions as $transaction)
                        <tr>
                            <td>{{ $transaction->control_id }}</td>
                            <td>{{ $transaction->institution_name }}</td>
                            <td>{{ $transaction->document_name }}</td>
                            <td>{{ $transaction->created_at->format('Y-m-d h:i:s a') }}</td>
                          </tr>
                            @endforeach
                    </tbody>
                </table>

                @else 

                  No Transaction Found 

                @endif

            </div>
            <div class="box-footer">
               <a href="{{route('report.index')}}" class="btn btn-warning">Go Back</a>
              </div>
        </div>
    </div>

  @endif


</div>
@endsection

@section('script')
<script type="text/javascript">
    $('.datepicker').datepicker({
      format: 'yyyy-mm-dd'
    });

    function printDiv() {
        var divName= "printreport";

         var printContents = document.getElementById(divName).innerHTML;
         var originalContents = document.body.innerHTML;

         document.body.innerHTML = printContents;

         window.print();

         document.body.innerHTML = originalContents;
    }

</script>
@endsection