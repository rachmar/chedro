<?php

namespace App\Http\Controllers;

use Auth;
use App\Model\Document;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class DocumentController extends Controller
{

    public function index()
    {
      $id = Auth::user()->id;
      $documents = Document::select('id','name')->get();
      return view('pages.document.index',compact('documents'));
    }

    public function store(Request $request)
    {
      // print_r($request->input('name'));
      $document = new Document();
      $document->name = $request->input('name');
      $document->save();

      return redirect('/admin/document');
    }

    public function delete($id)
    {
      $document = Document::find($id);
      $document->delete();

      return redirect('/admin/document');
    }

    public function update(Request $request, $id)
    {
      $document = Document::find($id);
      $document->name = $request->input('name');
      $document->save();

      return redirect('/admin/document');

    }
}
