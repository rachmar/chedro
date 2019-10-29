<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\Model\Document;
use App\Model\Transaction;
use App\Model\Log;

use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $documents = Document::get();
        
        $control_id = uniqid();

        $secretaries = User::whereHas('roles', function($q){
            $q->where('name', 'SECRETARY');
        })->get();

        $transactions = Transaction::join('documents', 'transactions.document_id', '=', 'documents.id')
            ->where('status_id', 1)
            ->where('priority_id', 0)
            ->get();

        return view('pages.transaction.index',compact('documents','control_id','secretaries' , 'transactions'));


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

        $transaction = new Transaction;
        $transaction->control_id =  $request->control_id;
        $transaction->document_id =  $request->document_id;
        $transaction->assign_id =  $request->secretary_id;
        $transaction->subject =  $request->subject;
        $transaction->comments = $request->comments;
        $transaction->save();

        $log = new Log;
        $log->user_id = Auth::user()->id;
        $log->description = "GENERATE TRANSACTION USING CONTROL NUM ".$request->control_id." ON";
        $log->save();


        return redirect()->back()->with(['title'=>'Added!','status'=>'Successfully Added!','mode'=>'success']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($control_id)
    {

        //

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
    public function update(Request $request, $id)
    {
        //
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
