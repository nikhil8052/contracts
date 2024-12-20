<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HowItWork;
use App\Models\Work;
use App\Models\QuestionAnswer;
use App\Models\TermsAndCondition;
use App\Models\PrivacyPolicy;
use App\Models\PricesContent;
use App\Models\FaqCategory;
use App\Models\HomeContent;
use App\Models\Review;
use App\Models\HelpCenter;
use App\Models\HelpYou;
use App\Models\WhoWeAre;
use App\Models\OurVision;

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
            'background_image' => str_replace('public/', '', $results['background_image']->file_path ?? null),
            'banner_title' => $results['banner_title']->value ?? null,
            'banner_description' => $results['banner_description']->value ?? null,
            'banner_image' =>  str_replace('public/', '', $results['banner_image']->file_path ?? null),
            'main_heading' => $results['main_heading']->value ?? null,
            'short_description' => $results['short_description']->value ?? null,
            'second_banner_img' => str_replace('public/', '', $results['second_banner_img']->file_path ?? null),
            'second_banner_heading' => $results['second_banner_heading']->value ?? null,
            'second_banner_sub_heading' => $results['second_banner_sub_heading']->value ?? null,
            'button_label' => $results['button_label']->value ?? null,
            'button_link' => $results['button_link']->value ?? null,
        ];

        $works = Work::with('media')->get();
        
        return view('users.site_meta.how_it_works',compact('data','works'));
    }

    public function Faq(){
        $keys = [
            'title',
            'background_image',
            'banner_title',
            'banner_description',
            'banner_image',
        ];

        $results = QuestionAnswer::whereIn('key', $keys)->get()->keyBy('key');
        $data = [
            'title' => $results['title']->value ?? null,
            'background_image_id' => $results['background_image']->id ?? null,
            'background_image' => str_replace('public/', '', $results['background_image']->file_path ?? null),
            'banner_title' => $results['banner_title']->value ?? null,
            'banner_description' => $results['banner_description']->value ?? null,
            'banner_image_id' =>  $results['banner_image']->id ?? null,
            'banner_image' =>  str_replace('public/', '', $results['banner_image']->file_path ?? null),
        ];

        $keys2 = [
            'reviews_heading',
            'reviews_sub_heading',
            'review_left_arrow',
            'review_right_arrow',
        ];

        $results2 = HomeContent::whereIn('key', $keys2)->get()->keyBy('key');
        $data2 = [
            'reviews_heading' => $results2['reviews_heading']->value ?? null, 
            'reviews_sub_heading' => $results2['reviews_sub_heading']->value ?? null, 
            'review_left_arrow' => str_replace('public/', '', $results2['review_left_arrow']->file_path ?? null),
            'review_right_arrow' => str_replace('public/', '', $results2['review_right_arrow']->file_path ?? null),
        ];

        $faqCategory = FaqCategory::all();
        $faqs1 = QuestionAnswer::where([['key','faq'],['category_id','1']])->with('category')->get();
        $faqs2 = QuestionAnswer::where([['key','faq'],['category_id','2']])->with('category')->get();
        $faqs3 = QuestionAnswer::where([['key','faq'],['category_id','3']])->with('category')->get();

        $reviews = Review::where('status',1)->with('media')->get();

        return view('users.site_meta.faq',compact('faqs1','faqs2','faqs3','data','faqCategory','data2','reviews'));
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
            'background_image' => str_replace('public/', '', $results['background_image']->file_path ?? null),
            'banner_title' => $results['banner_title']->value ?? null,
            'banner_description' => $results['banner_description']->value ?? null,
            'banner_image' => str_replace('public/', '', $results['banner_image']->file_path ?? null),
            'main_heading' => $results['main_heading']->value ?? null,
        ];
        $termsAndCondition = TermsAndCondition::where('key','terms_and_condition')->get();

        return view('users.site_meta.terms_and_conditions',compact('termsAndCondition','data'));
    }

    public function privacyNotice(){
        $keys = [
            'title',
            'main_heading',
            'sub_heading',
            'description',
        ];

        $results = PrivacyPolicy::whereIn('key',$keys)->get()->keyBy('key');
        $data = [
            'title' => $results['title']->value ?? null,
            'main_heading' => $results['main_heading']->value ?? null,
            'sub_heading' => $results['sub_heading']->value ?? null,
            'description' => $results['description']->value ?? null,
            
        ];
        $policys = PrivacyPolicy::where('key','privacy_policie')->get();
    
        return view('users.site_meta.privacy_policy',compact('policys','data'));
    }

    public function upload(Request $request){
        if ($request->hasFile('upload')) {
            $file = $request->file('upload');
            $filename = generateFileName($file);
            $path = $file->storeAs('public', $filename);
            $url = asset('storage/' .$filename);

            return response()->json([
                'uploaded' => 1,
                'url' => $url
            ]);
        }
        return response()->json(['uploaded' => 0, 'error' => ['message' => 'File upload failed.']], 400);
    }
    
    public function prices(){
        $keys = [
            'title',
            'background_image',
            'banner_title',
            'banner_description',
            'banner_image',
            'document_heading',
            'description_heading',
            'price_heading',
        ];

        $results = PricesContent::whereIn('key', $keys)->get()->keyBy('key');
        $data = [
            'title' => $results['title']->value ?? null,
            'background_image' => str_replace('public/', '', $results['background_image']->file_path ?? null),
            'banner_title' => $results['banner_title']->value ?? null,
            'banner_description' => $results['banner_description']->value ?? null,
            'banner_image' => str_replace('public/', '', $results['banner_image']->file_path ?? null),
            'document_heading' => $results['document_heading']->value ?? null,
            'description_heading' => $results['description_heading']->value ?? null,
            'price_heading' => $results['price_heading']->value ?? null,
        ];

        $document_price_description = PricesContent::where('key', 'price_content')->with('documentname')->get();

        return view('users.site_meta.prices',compact('data','document_price_description'));
    }

    public function HelpCenter(Request $request){
        $keys = [
            'title',
            'background_image',
            'banner_title',
            'banner_placeholder',
            'banner_image',
            'main_title',
            'sub_title',
            'faq_heading',
            'faq_description',
            'bottom_banner_image',
            'banner_heading',
            'banner_description',
            'button_text',
        ];

        $results = HelpCenter::whereIn('key', $keys)->get()->keyBy('key');
        $data = [
            'title' => $results['title']->value ?? null,
            'background_image' => str_replace('public/', '', $results['background_image']->file_path ?? null),
            'banner_title' => $results['banner_title']->value ?? null,
            'banner_placeholder' => $results['banner_placeholder']->value ?? null,
            'banner_image' =>  str_replace('public/', '', $results['banner_image']->file_path ?? null),
            'main_title' => $results['main_title']->value ?? null,
            'sub_title' => $results['sub_title']->value ?? null,
            'faq_heading' => $results['faq_heading']->value ?? null,
            'faq_description' => $results['faq_description']->value ?? null,
            'bottom_banner_image' =>  str_replace('public/', '', $results['bottom_banner_image']->file_path ?? null),
            'banner_heading' => $results['banner_heading']->value ?? null,
            'banner_description' => $results['banner_description']->value ?? null,
            'button_text' => $results['button_text']->value ?? null,
        ];

        $faqs = HelpCenter::where('key','faq')->get();
        $help_you = HelpYou::limit(3)->with('media')->get();

        return view('users.site_meta.support.support',compact('data','faqs','help_you'));
    }

    public function whoWeAre(){
        $keys = [
            'title',
            'background_image',
            'banner_title',
            'banner_description',
            'banner_image',
            'image',
            'heading',
            'description',
            'offer_image',
            'offer_heading',
            'offer_description',
        ];

        $results = WhoWeAre::whereIn('key', $keys)->get()->keyBy('key');
        $data = [
            'title' => $results['title']->value ?? null,
            'background_image' => str_replace('public/', '', $results['background_image']->file_path ?? null),
            'banner_title' => $results['banner_title']->value ?? null,
            'banner_description' => $results['banner_description']->value ?? null,
            'banner_image' =>  str_replace('public/', '', $results['banner_image']->file_path ?? null),
            'image' => str_replace('public/', '', $results['image']->file_path ?? null),
            'heading' => $results['heading']->value ?? null,
            'description' => $results['description']->value ?? null,
            'offer_image' => str_replace('public/', '', $results['offer_image']->file_path ?? null),
            'offer_heading' =>  $results['offer_heading']->value ?? null,
            'offer_description' =>  $results['offer_description']->value ?? null,
        ];

        $keys2 = [
            'reviews_heading',
            'reviews_sub_heading',
            'review_left_arrow',
            'review_right_arrow',
        ];

        $results2 = HomeContent::whereIn('key', $keys2)->get()->keyBy('key');
        $data2 = [
            'reviews_heading' => $results2['reviews_heading']->value ?? null, 
            'reviews_sub_heading' => $results2['reviews_sub_heading']->value ?? null, 
            'review_left_arrow' => str_replace('public/', '', $results2['review_left_arrow']->file_path ?? null),
            'review_right_arrow' => str_replace('public/', '', $results2['review_right_arrow']->file_path ?? null),
        ];

        $visions = OurVision::with('media')->get();
        $offers = WhoWeAre::limit(2)->where('key','offer')->get();
        $reviews = Review::where('status',1)->with('media')->get();

        return view('users.site_meta.who_we_are',compact('data','visions','offers','reviews','data2'));
    }
}
