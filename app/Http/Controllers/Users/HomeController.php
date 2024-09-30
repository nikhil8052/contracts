<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HomeContent;
use App\Models\HomeCategories;
use App\Models\Document;
use App\Models\DocumentCategory;

class HomeController extends Controller
{
    public function home(){
        $keys = [
            'title',
            'background_image',
            'banner_image',         
            'banner_title',
            'banner_description',
            'button_name',
            'most_popular_title',
            'most_popular_btn_text',
            'popular',
            'bottom_heading',
            'bottom_subheading',
            'bottom_button_label',
            'bottom_button_link',
            'bottom_banner_image',
            'category_title',
            'category_btn_text',
            'category_btn_arrow_img',
            'join_us_text',
            'reviews_heading',
            'reviews_sub_heading',
            'review_left_arrow',
            'review_right_arrow',
        ];

        $results = HomeContent::whereIn('key', $keys)->get()->keyBy('key');
        $data = [
            'title' => $results['title']->value ?? null,
            'background_image' => $results['background_image']->value ?? null,
            'banner_image' => $results['banner_image']->value ?? null,
            'banner_title' => $results['banner_title']->value ?? null,
            'banner_description' => $results['banner_description']->value ?? null,
            'button_name' => $results['button_name']->value ?? null,
            'most_popular_title' => $results['most_popular_title']->value ?? null,
            'most_popular_btn_text' => $results['most_popular_btn_text']->value ?? null,
            'popular' => $results['popular']->value ?? null,
            'bottom_heading' => $results['bottom_heading']->value ?? null,
            'bottom_subheading' => $results['bottom_subheading']->value ?? null,
            'bottom_button_label' => $results['bottom_button_label']->value ?? null,
            'bottom_button_link' => $results['bottom_button_link']->value ?? null,
            'bottom_banner_image' => $results['bottom_banner_image']->value ?? null,
            'category_title' => $results['category_title']->value ?? null,
            'category_btn_text' => $results['category_btn_text']->value ?? null,
            'category_btn_arrow_img' => $results['category_btn_arrow_img']->value ?? null,
            'join_us_text' => $results['join_us_text']->value ?? null, 
            'reviews_heading' => $results['reviews_heading']->value ?? null, 
            'reviews_sub_heading' => $results['reviews_sub_heading']->value ?? null, 
            'review_left_arrow' => $results['review_left_arrow']->value ?? null,
            'review_right_arrow' => $results['review_right_arrow']->value ?? null,
        ];


        $home_category = HomeContent::where('key','category')->with('homeCategory.media')->get();
        $document_category = DocumentCategory::limit(4)->get();
        $documents = Document::all();

        return view('users.home.home',compact('data','home_category','document_category','documents'));
    }

    public function getDocumentByCategory(Request $request){
        return $request->all();
    }
}
