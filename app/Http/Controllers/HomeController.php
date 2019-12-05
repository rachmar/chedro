<?php

namespace App\Http\Controllers;

use Auth;

use App\User;
use App\Model\Transaction;
use Illuminate\Http\Request;


class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
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
        ->where('transactions.is_archive','<>', 1)
        ->orderBy('transactions.priority_id', 'desc')
        ->get();   
       
        return view('home',compact('transactions'));
    }

}
