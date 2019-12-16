<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\Model\Status;
use App\Model\Log;
use App\Model\Attachment;

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

        $statuses = Status::get();

        $transaction = Transaction::find($id);

        $status_f = Status::find($transaction->status_id);

        $attachments = Attachment::where('control_id', $transaction->control_id)->get();

        $workers = User::whereHas('roles', function($q){
            $q->where('roles.name', '<>', 'ADMIN');
            $q->where('roles.name', '<>', 'PACD');
            $q->where('users.id', '<>',  Auth::user()->id);
        })->get();

        return view('pages.track.show',compact('transaction','attachments', 'workers','statuses' , 'status_f'));
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


        $returnTitle = 'Tranfer!';
        $returnMsg= 'Transaction Succesfully Transfer!';


        switch ($action) {

            case 'update':

                $transaction = Transaction::find($request->transaction_id);

                if(!empty($request->comments)){
                    $transaction->comments .= "====[".Auth::user()->name."]====<br/>".$request->comments."<br/><br/>";
                }

                $transaction->status_id = $request->status;
                $transaction->assign_id = $request->assign;
                $transaction->save();

                if(!empty($request->uploadFile)){

                    $attachment = new Attachment;
                    $filename = $transaction->control_id."-".uniqid().".".$request->uploadFile->extension();
                    $attachment->control_id = $transaction->control_id;
                    $attachment->image_filename = $filename;
                    $attachment->save();
                    $request->uploadFile->storeAs('', $filename, 'public');

                }


                $log = new Log;
                $log->user_id = Auth::user()->id;
                $log->description = "TRANSFER CONTROL NUM ".$transaction->control_id."  TO ".Auth::user()->name."  ON ".date('l, jS \of F Y h:i A');
                $log->save();

                break;


            case 'archive':
                
                $transaction = Transaction::find($request->transaction_id);
                $transaction->is_archive = 1;
                $transaction->is_archive_by = Auth::user()->id;
                $transaction->save();

                $log = new Log;
                $log->user_id = Auth::user()->id;
                $log->description = "ARCHIVE CONTROL NUM ".$transaction->control_id."  BY ".Auth::user()->name."  ON ".date('l, jS \of F Y h:i A');
                $log->save();

                $returnTitle = 'Archive!';
                $returnMsg= 'Transaction Succesfully Archive!';

                break;

            case 'received':
                
                $transaction = Transaction::find($request->transaction_id);
                $transaction->is_archive = 1;
                $transaction->is_archive_by = Auth::user()->id;
                $transaction->received_by = $request->name;
                $transaction->save();

                $log = new Log;
                $log->user_id = Auth::user()->id;
                $log->description = "CONTROL NUM ".$transaction->control_id." WAS RECEIVED BY ".$request->name." PROCESSED BY ".Auth::user()->name."  ON ".date('l, jS \of F Y h:i A');
                $log->save();

                $returnTitle = 'Received!';
                $returnMsg= 'Transaction Succesfully Received!';

                break;
            
            default:
                die("Please contact adminstrator");
                break;


        }

        
        
        return redirect('track')->with(['title'=>$returnTitle,'status'=>$returnMsg,'mode'=>'success']);
        
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
