<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\Model\Status;
use App\Model\Log;
use App\Model\Attachment;

use App\Model\Transaction;
use Illuminate\Http\Request;
use App\Model\Comment;

class SearchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('pages.search.index');

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
    public function show($control_id)
    {
        
        $transaction = Transaction::select(
            'transactions.*',
            'documents.name as document_name',
            'institutions.name as institution_name',
            'status.name as status_name',
            'status.id as status_id'
        )
        ->join('status', 'transactions.status_id', '=', 'status.id')
        ->join('documents', 'transactions.document_id', '=', 'documents.id')
        ->join('institutions', 'transactions.institution_id', '=', 'institutions.id')
        ->where('transactions.control_id', $control_id)
        ->first();

        $attachments = Attachment::where('control_id', $control_id)->get();

        $comments = Comment::select(
            'users.name as user',
            'comments.message',
            'comments.created_at'
        )
        ->join('users', 'comments.user_id', '=', 'users.id')
        ->where('control_id', $control_id)
        ->get();

        

        return view('pages.search.show',compact('transaction','attachments', 'comments'));
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
