<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\Model\Status;
use App\Model\Transaction;
use Illuminate\Http\Request;

class TrackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $id = Auth::user()->id;
        $transactions = Transaction::where('assign_id', $id)->get();
        return view('pages.track.index',compact('transactions'));
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

        $status = Status::find($transaction->status_id);

        $workers = User::whereHas('roles', function($q){
            $q->where('roles.name', '<>', 'ADMIN');
            $q->where('roles.name', '<>', 'PACD');
            $q->where('users.id', '<>',  Auth::user()->id);
        })->get();

        return view('pages.track.show',compact('transaction', 'workers','statuses' , 'status'));
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

        $transaction = Transaction::find($id);
        $transaction->status_id = $request->status;
        $transaction->priority_id = $request->priority;
        $transaction->assign_id = $request->assign;
        $transaction->save();

        return redirect('admin/track')->with(['title'=>'Edited!','status'=>'User Succesfully Edited!','mode'=>'success']);
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
