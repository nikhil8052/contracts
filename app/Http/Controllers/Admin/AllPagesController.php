<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\QuestionAnswer;
use Illuminate\Support\Str;
use App\Models\PrivacyPolicy;
use App\Models\User;
class AllPagesController extends Controller
{
     public function faq()
    {
        $faqs = QuestionAnswer::whereNotNull('key')->get();

        return view('admin.site_meta.faqs.faqs',compact('faqs'));
    }

    public function faqAdd(Request $request)
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
    public function removeFaq(Request $request)
    {
        $ids = $request->ids;
        
        $deletedRows = QuestionAnswer::whereIn('id', $ids)->delete();

        // Return success or error based on deletion result
        if ($deletedRows > 0) {
            return response()->json(['success' => true, 'message' => 'FAQs deleted successfully!']);
        } else {
            return response()->json(['success' => false, 'message' => 'FAQs not found.']);
        }
    }
    public function privecyPolicy()
    {
        $privacyPolicys = PrivacyPolicy::all();
        // dd($privacyPolicys);
        return view('admin.site_meta.terms_and_conditions.privacy_policy',compact('privacyPolicys'));
    }

    public function addPrivacyPolicy(Request $request)
    {
         $updated = false;
         $added = false;
        if ($request->has('title')) {
            foreach ($request->title as $id => $titleUpdate) {
                $policy = PrivacyPolicy::find($id);
                if ($policy) {
                    $policy->value = $titleUpdate; // Assuming 'title' is the column name
                    $policy->save();
                    $updated = true;
                }
            }
        }

        // Update descriptions if present
        if ($request->has('description')) {
            foreach ($request->description as $id => $descriptionUpdate) {
                $policy = PrivacyPolicy::find($id);
                if ($policy) {
                    $policy->value = $descriptionUpdate; // Assuming 'description' is the column name
                    $policy->save();
                    $updated = true;
                }
            }
        }
        if($request->has('main_heading')){
            foreach($request->main_heading as $id => $mainHeadingUpdate)
            {
                $policy = PrivacyPolicy::find($id);
                if($policy)
                {
                    $policy->value =  $mainHeadingUpdate;
                    $policy->save();
                    $updated = true;
                }
            }
        }
        if($request->has('sub_heading')){
            foreach($request->sub_heading as $id => $subHeadingUpdate)
            {
                $policy = PrivacyPolicy::find($id);
                if($policy)
                {
                    $policy->value = $subHeadingUpdate;
                    $policy->save();
                    $updated = true;
                }
            }
        }
      
         foreach ($request->terms as $id => $term) {
            $policy = PrivacyPolicy::find($id);
            if($policy)
            {
                $policy->terms = $term;
                $policy->condition = $request->condition[$id];
                $policy->save();
                $updated = true;
            }else
            {
                PrivacyPolicy::create([
                'key' => 'privacy_policie',
                'terms' => $term,
                'condition' => $request->condition[$id],
                $added = true
                
            ]);
            }
           
        }
         if ($updated && $added) {
            return redirect()->back()->with('success', 'Data updated and new New Privacy Policy added successfully!');
        } elseif ($updated) {
            return redirect()->back()->with('success', 'Data updated successfully!');
        } elseif ($added) {
            return redirect()->back()->with('success', 'New Privacy Policy added successfully!');
        }
    }
    public function removePolicy(Request $request)
    {
      
        $ids = $request->ids;
        $deletePolicy = PrivacyPolicy::whereIn('id', $ids)->delete();
        
        // Return success or error based on deletion result
        if ($deletePolicy > 0) {
            return response()->json(['success' => true, 'message' => 'Privacy Policy deleted successfully!']);
        } else {
            return response()->json(['success' => false, 'message' => 'Privacy Policy not found.']);
        }
    }

    public function allUsers()
    {
        $users = User::where('is_admin',null)->get();
      
        return view('admin.users.all_users',compact('users'));
    }

    public function editUser($id)
    {   
        $user = User::find($id);
        
        return view('admin.users.edit_user',compact('user'));
    }
    public function updateUser(Request $request)
    {
       
        $user = User::find($request->id);

        if ($user) {
            // Update user details
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            // $user->is_admin = $request->is_admin;
            $user->save();

            return redirect()->route('all.users')->with('success', 'User information successfully updated.');
        } else {
            return redirect()->back()->with('error', 'User not found.');
        }
    }
    public function deleteUser($id)
    {
        $user = User::find($id);

        if ($user) {
            $user->delete();
            return redirect()->back()->with('success', 'User deleted successfully.');
        } else {
            return redirect()->back()->with('error', 'User not found.');
        }
    }
}
