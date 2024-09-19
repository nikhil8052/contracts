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
        $faqs = QuestionAnswer::whereNotNull('key')->get();

        return view('admin.site_meta.faqs.faqs',compact('faqs'));
    }

    public function faqProcess(Request $request)
    {
      
         $updated = false;
         $added = false;
        // $request->validate([
        //     'title'   =>  'required',
        //     'main_title'   =>  'required',
        //     'second_banner_heading' =>  'required',
        //     'second_banner_sub_heading' =>  'required',
        //     'button_label'     =>  'required',
        //     'button_link'    =>  'required',
        //     'faq.*'      => 'required|string',
        //     'answer.*' => 'required|string',
        // ]);
       if ($request->has('title')) {
            // Loop through each title in the request
            foreach ($request->title as $id => $titleValue) {
                // Find the FAQ entry by its ID
                $faq = QuestionAnswer::find($id);
              
                // If the FAQ entry exists, update its value
                if ($faq) {
                    $faq->value = $titleValue; // Set the new title
                    $faq->save(); // Save the changes
                    $updated = true;
                }
            }
        }
        if($request->has('main_title')){

             foreach ($request->main_title as $id => $main_title_value) {
                // Find the FAQ entry by its ID
                $faq = QuestionAnswer::find($id);
                // If the FAQ entry exists, update its value
                if ($faq) {
                    $faq->value = $main_title_value; // Set the new title
                    $faq->save(); // Save the changes
                    $updated = true;
                }
            }
        }
        if($request->has('second_banner_heading')){

            foreach ($request->second_banner_heading as $id => $second_banner_heading_value) {
                // Find the FAQ entry by its ID
                $faq = QuestionAnswer::find($id);
               
                // If the FAQ entry exists, update its value
                if ($faq) {
                    $faq->value = $second_banner_heading_value; // Set the new title
                    $faq->save(); // Save the changes
                    $updated = true;
                }
            }
        }
        if($request->has('second_banner_sub_heading')){

            foreach ($request->second_banner_sub_heading as $id => $second_banner_sub_heading_value) {
                // Find the FAQ entry by its ID
                $faq = QuestionAnswer::find($id);
               
                // If the FAQ entry exists, update its value
                if ($faq) {
                    $faq->value = $second_banner_sub_heading_value; // Set the new title
                    $faq->save(); // Save the changes
                    $updated = true;
                }
            }
        }
        if($request->has('button_label')){

            foreach ($request->button_label as $id => $button_label_value) {
                // Find the FAQ entry by its ID
                $faq = QuestionAnswer::find($id);
               
                // If the FAQ entry exists, update its value
                if ($faq) {
                    $faq->value = $button_label_value; // Set the new title
                    $faq->save(); // Save the changes
                    $updated = true;
                }
            }
        }
        if($request->has('button_link')){

            foreach ($request->button_link as $id => $button_link_value) {
                // Find the FAQ entry by its ID
                $faq = QuestionAnswer::find($id);
               
                // If the FAQ entry exists, update its value
                if ($faq) {
                    $faq->value = $button_link_value; // Set the new title
                    $faq->save(); // Save the changes
                    $updated = true;
                }
            }
        }
        if ($request->has('faq') && is_array($request->faq) && count($request->faq) > 0) {
            foreach ($request->faq as $id => $faqUpdate) {
                // Check if the FAQ entry exists
                $faq = QuestionAnswer::find($id);
                if ($faq) {
                    // If it exists, update the question and answer
                    $faq->question = $faqUpdate; // Update the question
                    $faq->answer = $request->answer[$id]; // Update the answer
                    $faq->save(); // Save the changes
                    $updated = true;
                } else {
                    // If it does not exist, create a new FAQ entry
                    $faq = new QuestionAnswer();
                    $faq->key = 'faq';
                    $faq->type = 'faq';
                    $faq->id = $id; // Assign the provided ID
                    $faq->question = $faqUpdate; // Set the new question
                    $faq->answer = $request->answer[$id]; // Set the answer
                    $faq->save(); // Save the new entry
                    $added = true;
                }
            }
        }
            // Now, save the FAQ questions and answers
        if ($updated && $added) {
            return redirect()->back()->with('success', 'Data updated and new FAQs added successfully!');
        } elseif ($updated) {
            return redirect()->back()->with('success', 'Data updated successfully!');
        } elseif ($added) {
            return redirect()->back()->with('success', 'New FAQs added successfully!');
        }

        return redirect()->back()->with('info', 'No changes made.');
    
            // return redirect()->back()->with('success', 'FAQ created successfully!');
    }
    public function removeFaq($id)
    {
        $removeID = QuestionAnswer::find($id);
        if ($removeID) {
            $removeID->delete(); // Delete the entry
            return redirect()->back()->with('success', 'FAQ deleted successfully!'); // Redirect with a success message
        }

    return redirect()->back()->with('error', 'FAQ not found.');
    }
}
