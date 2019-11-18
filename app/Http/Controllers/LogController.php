<?php

namespace App\Http\Controllers;

use Auth;
use App\Model\Log;
use App\Exports\LogsExport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;


class LogController extends Controller
{

    public function index()
    {
      $id = Auth::user()->id;
      $logs = Log::select()->get();
      return view('pages.log.index',compact('logs'));
    }

    public function export()
    {
      return Excel::download(new LogsExport, "UserLogs".date('mdY').".xlsx");
    }
}
