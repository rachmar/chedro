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
        $transactions = Transaction::whereHas('users', function($q){
            $id = Auth::user()->id;
            $q->where('user_id', $id);
        })->get();

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

        $workers = User::whereHas('roles', function($q){
            $q->where('roles.name', '<>', 'SA');
            $q->where('users.id', '<>',  Auth::user()->id);
        })->get();

        return view('pages.track.show',compact('transaction', 'workers','statuses'));
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
        $transaction->save();
        
        $user_detach = User::find(Auth::user()->id);
        $user_detach->transactions()->detach();

        $user_attach = User::find($request->assign);
        $user_attach->transactions()->attach($transaction);

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
