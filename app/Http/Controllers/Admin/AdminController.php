<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(){
        return view('admin.index.index');
    }

    public function country(){
        return view('admin.country.countries');
    }

    public function documents(){
        return view('admin.documents.document');
    }

}
