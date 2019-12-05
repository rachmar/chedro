<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Transaction;

class ArchiveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transactions = Transaction::select(
            'transactions.*',
            'documents.name as document_name',
            'institutions.name as institution_name',
            'status.name as status_name',
            'users.name as assign_name'
        )
        ->join('users', 'transactions.assign_id', '=', 'users.id')
        ->join('status', 'transactions.status_id', '=', 'status.id')
        ->join('documents', 'transactions.document_id', '=', 'documents.id')
        ->join('institutions', 'transactions.institution_id', '=', 'institutions.id')
        ->where('transactions.is_archive', 1)
        ->orderBy('transactions.priority_id', 'desc')
        ->get();   
       
        return view('pages.archive.index',compact('transactions'));
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
