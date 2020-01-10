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

      $users = User::whereHas('roles', function($q){
            $q->where('name', '<>' ,'ADMIN');
      })->get();

      $roles = Role::all();

      return view('pages.user.index',compact('users','roles'));
    }

    public function destroy($id){

      $user = User::find($id);
      $user->roles()->detach();
      $user->delete();

      return redirect()->back()->with(['title'=>'Deleted!','status'=>'User Succesfully Deleted!','mode'=>'success']);


    }


    public function store(Request $request)
    {

        $role  = Role::where('id',  $request->role)->first();

        $user = new User();
        $user->name =  $request->name;
        $user->email =  $request->email;
        $user->password =  Hash::make($request->password) ;
        $user->save();
        $user->roles()->attach($role);

      return redirect()->back()->with(['title'=>'Added!','status'=>'User Succesfully Added!','mode'=>'success']);
    }

    public function update(Request $request, $id)
    {

      $role  = Role::where('id',  $request->role)->first();

      $user = User::findOrFail($request->id);
      $user->name =  $request->name;
      $user->email =  $request->email;
      $user->password =  Hash::make($request->password) ;
      $user->save();

      $user->roles()->detach();
      $user->roles()->attach($role);

      return redirect()->back()->with(['title'=>'Updated!','status'=>'User Succesfully Updated!','mode'=>'success']);
    
    }
}
