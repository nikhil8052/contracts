<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HowItWork;
use App\Models\QuestionAnswer;
class SitePagesController extends Controller
{
    public function howItWork(){
        
        $howitwork = HowItWork::first();
        return view('users.site_meta.how_it_works',compact('howitwork'));
    }

    public function Faq()
    {
        $faqs = QuestionAnswer::where('key','!=',null)->get();
        
        return view('users.site_meta.faq',compact('faqs'));
    }

    public function termsAndConditions()
    {
        return view('users.site_meta.terms_and_conditions');
    }

    public function privacyNotice()
    {
        return view('users.site_meta.privacy_notice');

    }
}
