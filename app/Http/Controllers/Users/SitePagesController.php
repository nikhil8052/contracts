<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HowItWork;

class SitePagesController extends Controller
{
    public function howItWork(){
        $howitwork = HowItWork::first();
        return view('users.site_meta.how_it_works',compact('howitwork'));
    }
}
