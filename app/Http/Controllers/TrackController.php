<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\Model\Status;
use App\Model\Log;

use App\Model\Transaction;
use Illuminate\Http\Request;


class TrackController extends Controller
{   

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $id = Auth::user()->id;

        $transactions = Transaction::select(
            'transactions.*',
            'documents.name as document_name',
            'institutions.name as institution_name',
            'status.name as status_name'
        )
        ->join('status', 'transactions.status_id', '=', 'status.id')
        ->join('documents', 'transactions.document_id', '=', 'documents.id')
        ->join('institutions', 'transactions.institution_id', '=', 'institutions.id')
        ->where('transactions.is_archive','<>', 1)
        ->where('transactions.assign_id', $id)
        ->orderBy('transactions.priority_id', 'desc')
        ->get();   
         
        $statuses = Status::get();

        $workers = User::whereHas('roles', function($q){
            $q->where('roles.name', '<>', 'ADMIN');
            $q->where('roles.name', '<>', 'PACD');
            $q->where('users.id', '<>',  Auth::user()->id);
        })->get();

        return view('pages.track.index',compact('transactions', 'workers','statuses' , 'status'));



    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        // $statuses = Status::get();

        // $transaction = Transaction::find($id);

        // $status = Status::find($transaction->status_id);

        // $workers = User::whereHas('roles', function($q){
        //     $q->where('roles.name', '<>', 'ADMIN');
        //     $q->where('roles.name', '<>', 'PACD');
        //     $q->where('users.id', '<>',  Auth::user()->id);
        // })->get();

        // return view('pages.track.show',compact('transaction', 'workers','statuses' , 'status'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $action)
    {

        switch ($action) {
            case 'update':

                $transaction = Transaction::find($request->transaction_id);
                $transaction->status_id = $request->status;
                $transaction->assign_id = $request->assign;
                $transaction->save();


                $user = User::find($request->assign);

                $log = new Log;
                $log->user_id = Auth::user()->id;
                $log->description = "TRANSFER CONTROL NUM ".$transaction->control_id."  TO ".$user->name."  ON ";
                $log->save();

                break;


            case 'archive':
                
                $transaction = Transaction::find($request->transaction_id);
                $transaction->is_archive = 1;
                $transaction->is_archive_by = Auth::user()->id;
                $transaction->save();

                $log = new Log;
                $log->user_id = Auth::user()->id;
                $log->description = "ARCHIVE CONTROL NUM ".$transaction->control_id."  BY ".Auth::user()->name."  ON ";
                $log->save();

                break;
            
            default:
                die("Please contact adminstrator");
                break;
        }
        

        return redirect('track')->with(['title'=>'Tranfer!','status'=>'Transaction Succesfully Transfer!','mode'=>'success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
