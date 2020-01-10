<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Milon\Barcode\DNS2D;
use App\Model\Institution;
use App\Model\Document;

class QrCodeController extends Controller
{
    public function index()
    {

    	$control_id = $_GET['crl_id'];
    	$document = Document::find($_GET['doc_id']);
    	$institution = Institution::find($_GET['ins_id']);

    	$baseImage64 = DNS2D::getBarcodePNG($_GET['crl_id'], 'QRCODE', 4, 4 );


      	return view('pages.qrcode.index',compact('baseImage64','control_id','document','institution'));

    }
}
