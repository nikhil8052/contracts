<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\QuestionAnswer;
use Illuminate\Support\Str;
use App\Models\PrivacyPolicy;
use App\Models\User;
use App\Models\FaqCategory;
use Hash;
use File;

class AllPagesController extends Controller
{

    public function faqCategory(){
        return view('admin.site_meta.faqs.add_faq_category');
    }

    public function addCategory(Request $request){
        try{
            $messages = [
                'slug.unique' => 'The slug has already been taken. Please choose another one.',
            ];
            if(isset($request->id) && $request->id != null){
                $request->validate([
                    'name' => 'required',
                    'slug' => 'required',
                ]);
    
                $faqCategory = FaqCategory::find($request->id);
                $status = 'edit';

            }else{
                $request->validate([
                    'name' => 'required',
                    'slug' => 'unique:faq_categories,slug',
                ],$messages);
    
                $faqCategory = new FaqCategory;
                $status = 'add';
            }
    
            $faqCategory->category_name = $request->name;
            $faqCategory->slug = $request->slug;
            $faqCategory->description = $request->description;
            $faqCategory->save();
    
            if($status == 'edit'){
                return redirect('/admin-dashboard/edit/faq-category/'.$faqCategory->slug)->with('success','FAQ category updated');
            }elseif($status == 'add'){
                return redirect()->back()->with('success','FAQ category added');
            }

        }catch(Exception $e){
            saveLog("Error:", "SiteMetaController", $e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong.');
        }
        
    }
    
    public function allFaqCategory(){
        $faqCategory = FaqCategory::all();
        return view('admin.site_meta.faqs.faq_category',compact('faqCategory'));
    }

    public function editFaqCategory($slug){
        $faqCategory = FaqCategory::where('slug',$slug)->first();
        return view('admin.site_meta.faqs.add_faq_category',compact('faqCategory'));
    }

     public function faq(){
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

        $faqCategory = FaqCategory::all();
        $faqs = QuestionAnswer::where('key','faq')->with('category')->get();

        return view('admin.site_meta.faqs.faqs',compact('faqCategory','data','faqs'));
    }

    public function faqAdd(Request $request){
        try{
            if($request->hasFile('background_image')){
                $faq = QuestionAnswer::where('key','background_image')->first();
                
                $background_image = $request->file('background_image');
                $directory = "public/faq_images";
                $filename = generateFileName($background_image);
                $filepath = $background_image->storeAs($directory, $filename);

                $faq->value = $filename;
                $faq->file_path = $filepath;
                $faq->update();
            }

            if($request->hasFile('banner_image')){
                $faq = QuestionAnswer::where('key','banner_image')->first();

                $banner_image = $request->file('banner_image');
                $directory = "public/faq_images";
                $filename = generateFileName($banner_image);
                $filepath = $banner_image->storeAs($directory, $filename);

                $faq->value = $filename;
                $faq->file_path = $filepath;
                $faq->update();
            }

            if($request->has('new_question')){
                for($i=0; $i<count($request->new_question); $i++){
                    $question = $request->new_question[$i];

                    if($request->has('new_answer')){
                        $answer = $request->new_answer[$i];
                    }
    
                    if($request->has('new_category')){
                        $category = $request->new_category[$i];
                    }
    
                    $faq = new QuestionAnswer;
                    $faq->key = 'faq';
                    $faq->question = $question;
                    $faq->answer = $answer;
                    $faq->category_id = $category;
                    $faq->save();
                } 
            }

            if($request->has('category')){
                foreach($request->category as $index=>$value){
                    $faq = QuestionAnswer::find($index);
                    $faq->category_id = $value;
                    $faq->update();
                }

                foreach($request->question as $key=>$val){
                    $faq = QuestionAnswer::find($key);
                    $faq->question = $val;
                    $faq->update();
                }

                foreach($request->answer as $idx=>$vlu){
                    $faq = QuestionAnswer::find($idx);
                    $faq->answer = $vlu;
                    $faq->update();
                }
            }

            $fields = [
                'title' => 'title',
                'banner_title' => 'banner_title',
                'banner_description' => 'banner_description',
            ];

            foreach($fields as $key=>$input){
                if($request->has($input)) {
                    $faq = QuestionAnswer::where('key', $key)->first();
                    if($faq){
                        $faq->value = $request->$input;
                        $faq->update();
                    }
                }
            }

            if($request->removefaq != null){
                $deleteIds = explode(',', $request->removefaq);
                foreach($deleteIds as $id){
                    $remove_faq = QuestionAnswer::find($id);
                    if($remove_faq){
                        $remove_faq->delete();
                    }
                }
            }

            if($request->bg_image_id != null){
                $faq = QuestionAnswer::where('id',$request->bg_image_id)->first();
                $file_path = getFilePath($faq->file_path);
                if(File::exists($file_path)) {
                    $directory_path = dirname($file_path);
                    unlink($file_path);              
                    if(is_dir($directory_path) && count(scandir($directory_path)) == 2){
                        rmdir($directory_path);
                    }
                }
                $faq->value = null;
                $faq->file_path = null;
                $faq->save();
            }

            if($request->baner_image_id != null){
                $faq = QuestionAnswer::where('id',$request->baner_image_id)->first();
                $file_path = getFilePath($faq->file_path);
                if(File::exists($file_path)) {
                    $directory_path = dirname($file_path);
                    unlink($file_path);              
                    if(is_dir($directory_path) && count(scandir($directory_path)) == 2){
                        rmdir($directory_path);
                    }
                }
                $faq->value = null;
                $faq->file_path = null;
                $faq->save();
            }

            return redirect()->back()->with("success", "FAQ's updated.");

        }catch(Exception $e){
            saveLog("Error:", "SiteMetaController", $e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong. Please try again.');
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
        $users = User::where('is_admin',false)->get();
      
        return view('admin.users.all_users',compact('users'));
    }

    public function editUser($id = null)
    {   
        $user = User::find($id);
        
        return view('admin.users.edit_user',compact('user'));
    }

    public function updateUser(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'email' => 'required|email|unique:users,email,' . $request->id,
        ]);

        if($request->id){
            $user = User::find($request->id);

            if ($user) {
                $user->first_name = $request->first_name;
                $user->last_name = $request->last_name;
                $user->email = $request->email;
                if($request->password){
                    $user->password = Hash::make($request->password);
                }
                $user->is_admin = $request->is_admin;
                $user->save();
    
                return redirect()->route('all.users')->with('success', 'User information updated successfully.');
            } else {
                return redirect()->back()->with('error', 'User not found.');
            }
        } else {
            $request->validate([
                'password' => 'required',
            ]);

            $user = new User();
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->is_admin = $request->is_admin;
            $user->save();

            return redirect()->route('all.users')->with('success', 'User Created successfully.');
           
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
