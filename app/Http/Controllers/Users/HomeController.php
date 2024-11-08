<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HomeContent;
use App\Models\HomeCategories;
use App\Models\Document;
use App\Models\DocumentCategory;
use App\Models\Review;
use App\Models\Question;
use App\Models\DocumentRightSection;

class HomeController extends Controller
{
    public function home(){
        $keys = [
            'title',
            'favicon',
            'background_image',
            'banner_image',         
            'banner_title',
            'banner_description',
            'banner_placeholder',
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
            'favicon' => $results['favicon']->value ?? null,
            'background_image' => str_replace('public/', '', $results['background_image']->file_path ?? null),
            'banner_image' =>  str_replace('public/', '', $results['banner_image']->file_path ?? null),
            'banner_title' => $results['banner_title']->value ?? null,
            'banner_description' => $results['banner_description']->value ?? null,
            'banner_placeholder' => $results['banner_placeholder']->value ?? null,
            'button_name' => $results['button_name']->value ?? null,
            'most_popular_title' => $results['most_popular_title']->value ?? null,
            'most_popular_btn_text' => $results['most_popular_btn_text']->value ?? null,
            'popular' => $results['popular']->value ?? null,
            'bottom_heading' => $results['bottom_heading']->value ?? null,
            'bottom_subheading' => $results['bottom_subheading']->value ?? null,
            'bottom_button_label' => $results['bottom_button_label']->value ?? null,
            'bottom_button_link' => $results['bottom_button_link']->value ?? null,
            'bottom_banner_image' => str_replace('public/', '', $results['bottom_banner_image']->file_path ?? null),
            'category_title' => $results['category_title']->value ?? null,
            'join_us_text' => $results['join_us_text']->value ?? null, 
            'reviews_heading' => $results['reviews_heading']->value ?? null, 
            'reviews_sub_heading' => $results['reviews_sub_heading']->value ?? null, 
            'review_left_arrow' => str_replace('public/', '', $results['review_left_arrow']->file_path ?? null),
            'review_right_arrow' => str_replace('public/', '', $results['review_right_arrow']->file_path ?? null),
        ];

        $home_category = HomeCategories::with('media')->get();
        $document_category = DocumentCategory::limit(4)->get();
        $alldocuments = Document::where('published',1)->get();
        $reviews = Review::where('status',1)->with('media')->get();

        return view('users.home.home',compact('data','home_category','document_category','alldocuments','reviews'));
    }

    public function getDocument($slug){
        $document = Document::where('slug',$slug)->with(['documentAgreement.media','documentField.media','documentGuide','relatedDocuments'])->first();
        $reviews = Document::with('reviews')->get();
        $keys = [
            'reviews_heading',
            'reviews_sub_heading',
        ];

        $results = HomeContent::whereIn('key', $keys)->get()->keyBy('key');
        $data = [
            'reviews_heading' => $results['reviews_heading']->value ?? null, 
            'reviews_sub_heading' => $results['reviews_sub_heading']->value ?? null, 
        ];
        // dd($document->relatedDocuments);

        return view('users.contracts.contract_details',compact('document','reviews','data'));
    }


    // This is the testing for the questions 
  public function question_testing()
{
    $questions = Question::with(['questionData', 'conditions', 'options', 'nextQuestion'])->get();
    $documentContents = DocumentRightSection::where('document_id', 3)->get();

    // Process each content and replace placeholders
    foreach ($documentContents as $content) {
        // Match and replace all #{number}# patterns
        $content->content = preg_replace_callback(
            '/#(\d+)#/',
            function ($matches) {
                $classNumber = $matches[1];
                return "<span class=\"answered_spns qidtarget-$classNumber\"></span>";
            },
            $content->content
        );
    }

    // Log the output to ensure replacements are made
    // dd($documentContents);

    return view('users.contracts.canvas_question_testing', compact('questions', 'documentContents'));
}



    



}
