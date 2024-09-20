<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HowItWork;
use App\Models\Work;
use App\Models\QuestionAnswer;
use App\Models\TermsAndCondition;
use App\Models\PrivacyPolicy;

class SitePagesController extends Controller
{
    public function howItWork(){
        $howitwork = HowItWork::with('works')->get();

        $keys = [
            'title',
            'main_heading',
            'short_description',
            'join_our_community_text',
            'second_banner_heading',
            'second_banner_sub_heading',
            'button_label',
            'button_link'
        ];

        $results = HowItWork::whereIn('key', $keys)->get()->keyBy('key');
        $data = [
            'title_name' => $results['title']->value ?? null,
            'main_heading' => $results['main_heading']->value ?? null,
            'short_description' => $results['short_description']->value ?? null,
            'join_our_community_text' => $results['join_our_community_text']->value ?? null,
            'second_banner_heading' => $results['second_banner_heading']->value ?? null,
            'second_banner_sub_heading' => $results['second_banner_sub_heading']->value ?? null,
            'button_label' => $results['button_label']->value ?? null,
            'button_link' => $results['button_link']->value ?? null,
        ];

        return view('users.site_meta.how_it_works',compact('data','howitwork'));
    }

    public function Faq(){
        $faqs = QuestionAnswer::where('key','!=',null)->get();        
        return view('users.site_meta.faq',compact('faqs'));
    }

    public function termsAndConditions(){
        $keys = [
            'title',
            'main_heading',
            'sub_heading',
            'description',
        ];

        $results = TermsAndCondition::whereIn('key',$keys)->get()->keyBy('key');
        $data = [
            'title_name' => $results['title']->value ?? null,
            'main_heading' => $results['main_heading']->value ?? null,
            'sub_heading' => $results['sub_heading']->value ?? null,
            'description' => $results['description']->value ?? null,
        ];
        $termsAndCondition = TermsAndCondition::where('key','terms_and_condition')->get();
        return view('users.site_meta.terms_and_conditions',compact('termsAndCondition'));
    }

    public function privacyNotice(){
        
        $policys = PrivacyPolicy::all();
    
        return view('users.site_meta.privacy_policy',compact('policys'));
    }
}
