<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    public function documents(){
        return view('admin.documents.document');
    }

    public function addDocuments(Request $request){
        return $request->all();
    }

}
