<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\QuestionAnswer;
use Illuminate\Support\Str;

class AllPagesController extends Controller
{
     public function faq()
    {
        $faqs = QuestionAnswer::whereNotNull('key')->pluck('value', 'key');

        
        return view('admin.site_meta.faqs.faqs');
    }

    public function faqProcess(Request $request)
    {
         $request->validate([
            'title'   =>  'required',
            'main_title'   =>  'required',
            'second_banner_heading' =>  'required',
            'second_banner_sub_heading' =>  'required',
            'button_label'     =>  'required',
            'button_link'    =>  'required',
            'faq.*'      => 'required|string',
            'answer.*' => 'required|string',
        ]);
            $fields = [
                'title' => $request->title,
                'main_title' => $request->main_title,
                'second_banner_heading' => $request->second_banner_heading,
                'second_banner_sub_heading' => $request->second_banner_sub_heading,
                'button_label' => $request->button_label,
                'button_link' => $request->button_link,
            ];
            foreach ($fields as $key => $value) {
                // Check if key already exists to avoid duplication
                $existing = QuestionAnswer::where('key', $key)->first();
                if (!$existing) {
                    $faqs = new QuestionAnswer();
                    $faqs->key = $key;
                    $faqs->value = $value;
                    $faqs->save();
                }
            }
            
            // Now, save the FAQ questions and answers
            for ($i = 0; $i < count($request->faq); $i++) {
                $faq = new QuestionAnswer();
                $faq->question = $request->faq[$i];
                $faq->answer = $request->answer[$i];
                $faq->save(); // Save each question-answer pair separately
            }
            

            // for ($i = 0; $i < count($request->faq); $i++) {
            //     foreach ($fields as $key => $value) {
            //         $faqs = new QuestionAnswer();
            //         $faqs->key = $key;
            //         $faqs->value = $value;
            //         $faqs->question = $request->faq[$i];
            //         $faqs->answer = $request->answer[$i];
            //         $faqs->save();
            //     }
            // }

       
        return redirect()->back()->with('success', 'FAQ created successfully!');
    }
}
