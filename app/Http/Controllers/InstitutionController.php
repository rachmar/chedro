<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Institution;

class InstitutionController extends Controller
{
    //

    public function index()
    {
      $institutions = Institution::select('id','name')->get();
      return view('pages.institution.index',compact('institutions'));
    }

    public function store(Request $request)
    {
      // print_r($request->input('name'));
      $document = new Institution();
      $document->name = $request->input('name');
      $document->save();

      return redirect('/admin/institution')->with(['title'=>"Success!",'status'=>"Successfully Stored",'mode'=>'success']);
    }

    public function destroy($id)
    {
      $document = Institution::find($id);
      $document->delete();

      return redirect('/admin/institution')->with(['title'=>"Success!",'status'=>"Successfully Delete",'mode'=>'success']);
    }

    public function update(Request $request, $id)
    {
      $document = Institution::find($request->id);
      $document->name = $request->name;
      $document->save();

      return redirect('/admin/institution')->with(['title'=>"Success!",'status'=>"Successfully Update",'mode'=>'success']);

    }
}
