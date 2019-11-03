<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\Model\Role;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class UserController extends Controller
{

    public function index()
    {
      $id = Auth::user()->id;
      $users = User::select('*')->get();
      $roles = Role::select('*')->get();

      // echo "<pre>";
      // print_r($users);
      // echo "</pre>";
      // $users = Role::select('*')->get();
      return view('pages.user',compact('users','roles'));
    }

    public function delete($id){

      $user = User::find($id);
      $user->delete();

      return redirect('/admin/user');

    }


    public function store(Request $request)
    {
      // print_r($request->input('name'));
      $user = new User();
      $user->name = $request->input('name');
      $user->email = $request->input('email');
      $user->password = Hash::make($request->input('password'));
      $user->save();
      $user->roles()->attach($request->input('role'));
      $user->save();

      return redirect('/admin/user');
    }

    // public function update(Request $request, $id)
    // {
    //   $user = Document::find($id);
    //   $user->name = $request->input('name');
    //   $user->save();
    //
    //   return redirect('/admin/document');
    //
    // }
}
