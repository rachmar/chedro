<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\Model\Document;
use App\Model\Institution;
use App\Model\Transaction;
use App\Model\Attachment;
use App\Model\Log;
use Illuminate\Support\Facades\Storage;

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
        $institutions = Institution::get();
        $last_transaction = Transaction::latest('id')->first();

        if(empty($last_transaction))
        {
          $sequence_id = 0;
        }

        else
        {
          $sequence_id = $last_transaction->id;
        }

        // $control_id = uniqid();
        $control_id = date("Y-m-d")."-".sprintf("%010d", ++$sequence_id);

        $secretaries = User::whereHas('roles', function($q){
            $q->where('name', 'SECRETARY');
        })->get();

        $transactions = Transaction::join('documents', 'transactions.document_id', '=', 'documents.id')
            ->where('status_id', 1)
            ->where('priority_id', 0)
            ->get();

        return view('pages.transaction.index',compact('documents','control_id','secretaries' , 'transactions' , 'institutions'));


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
        //Institution and Document Conditions
        if($request->institution_id == "99999999")
        {
          $institution = new Institution();
          $institution->name = $request->institution_id_other;
          $institution->save();
          $institution_id_pointer = $institution->id;
        }
        else
        {
          $institution_id_pointer = $request->institution_id;
        }


        if($request->document_id == "99999999")
        {
          $document = new Document();
          $document->name = $request->document_id_other;
          $document->save();
          $document_id_pointer = $document->id;
        }
        else
        {
          $document_id_pointer =  $request->document_id;
        }


        $transaction = new Transaction;
        $transaction->control_id =  $request->control_id;
        $transaction->institution_id = $institution_id_pointer;
        $transaction->document_id =  $document_id_pointer;
        $transaction->assign_id =  $request->secretary_id;
        $transaction->subject =  $request->subject;

        $transaction->comments = "====[".Auth::user()->name."]====<br/>".$request->comments."<br/><br/>";

        $transaction->priority_id = $request->priority_id;
        
        if(!empty($request->uploadFile)){

            $attachment = new Attachment;

            $filename = $transaction->control_id."-".uniqid()."." . $request->uploadFile->extension();
            $attachment->control_id = $request->control_id;
            $attachment->image_filename = $filename;
            $attachment->save();

            $request->uploadFile->storeAs('', $filename, 'public');

        }

        $transaction->save();


        // print_r($file); exit;

        $log = new Log;
        $log->user_id = Auth::user()->id;
        $log->description = "GENERATE TRANSACTION USING CONTROL NUM ".$request->control_id." ON ".date('l, jS \of F Y h:i A');
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
