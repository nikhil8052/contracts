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
        $keys = [
            'title',
            'background_image',
            'banner_title',
            'banner_description',
            'banner_image',
            'main_heading',
            'short_description',
            'second_banner_img',
            'second_banner_heading',
            'second_banner_sub_heading',
            'button_label',
            'button_link'
        ];

        $results = HowItWork::whereIn('key', $keys)->get()->keyBy('key');
        $data = [
            'title_name' => $results['title']->value ?? null,
            'background_image' => $results['background_image']->value ?? null,
            'banner_title' => $results['banner_title']->value ?? null,
            'banner_description' => $results['banner_description']->value ?? null,
            'banner_image' => $results['banner_image']->value ?? null,
            'main_heading' => $results['main_heading']->value ?? null,
            'short_description' => $results['short_description']->value ?? null,
            'second_banner_img' => $results['second_banner_img']->value ?? null,
            'second_banner_heading' => $results['second_banner_heading']->value ?? null,
            'second_banner_sub_heading' => $results['second_banner_sub_heading']->value ?? null,
            'button_label' => $results['button_label']->value ?? null,
            'button_link' => $results['button_link']->value ?? null,
        ];

        $works = HowItWork::where('key','work')->with('works.media')->get();

        return view('users.site_meta.how_it_works',compact('data','works'));
    }

    public function Faq(){
        $faqs = QuestionAnswer::where('key','!=',null)->get();        
        return view('users.site_meta.faq',compact('faqs'));
    }

    public function termsAndConditions(){
        $keys = [
            'title',
            'background_image',
            'banner_title',
            'banner_description',
            'banner_image',
            'main_heading'
        ];

        $results = TermsAndCondition::whereIn('key',$keys)->get()->keyBy('key');
        $data = [
            'title_name' => $results['title']->value ?? null,
            'background_image' => $results['background_image']->value ?? null,
            'banner_title' => $results['banner_title']->value ?? null,
            'banner_description' => $results['banner_description']->value ?? null,
            'banner_image' => $results['banner_image']->value ?? null,
            'main_heading' => $results['main_heading']->value ?? null,
        ];
        $termsAndCondition = TermsAndCondition::where('key','terms_and_condition')->get();

        return view('users.site_meta.terms_and_conditions',compact('termsAndCondition','data'));
    }

    public function privacyNotice(){
        
        $policys = PrivacyPolicy::all();
    
        return view('users.site_meta.privacy_policy',compact('policys'));
    }
}
