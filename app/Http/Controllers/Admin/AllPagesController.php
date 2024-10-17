<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\FileUploadService;
use Illuminate\Support\Str;
use App\Models\QuestionAnswer;
use App\Models\PrivacyPolicy;
use App\Models\User;
use App\Models\FaqCategory;
use App\Models\WhoWeAre;
use App\Models\OurVision;
use App\Models\Media;
use Hash;
use File;

class AllPagesController extends Controller
{

    protected $fileUploadService;

    public function __construct(FileUploadService $fileUploadService){
        $this->fileUploadService = $fileUploadService;
    }

    public function faqCategory(){
        return view('admin.site_meta.faqs.add_faq_category');
    }

    public function addCategory(Request $request){
        try{
            if(isset($request->id) && $request->id != null){
                $request->validate([
                    'name' => 'required',
                    'slug' => 'required|unique:faq_categories,slug'. $request->id,
                ]);
    
                $faqCategory = FaqCategory::find($request->id);
                $status = 'edit';

            }else{
                $request->validate([
                    'name' => 'required',
                    'slug' => 'required|unique:faq_categories,slug',
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

    public function aboutUs(){
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
            'background_image_id' => $results['background_image']->id ?? null,
            'background_image' => str_replace('public/', '', $results['background_image']->file_path ?? null),
            'banner_title' => $results['banner_title']->value ?? null,
            'banner_description' => $results['banner_description']->value ?? null,
            'banner_image_id' =>  $results['banner_image']->id ?? null,
            'banner_image' =>  str_replace('public/', '', $results['banner_image']->file_path ?? null),
            'image_id' => $results['image']->id ?? null,
            'image' => str_replace('public/', '', $results['image']->file_path ?? null),
            'heading' => $results['heading']->value ?? null,
            'description' => $results['description']->value ?? null,
            'offer_image_id' => $results['offer_image']->id ?? null,
            'offer_image' => str_replace('public/', '', $results['offer_image']->file_path ?? null),
            'offer_heading' =>  $results['offer_heading']->value ?? null,
            'offer_description' =>  $results['offer_description']->value ?? null,
        ];

        $visions = OurVision::with('media')->get();
        $offers = WhoWeAre::where('key','offer')->get();

        return view('admin.site_meta.about_us.who_we_are',compact('data','visions','offers'));
    }

    public function whoWeAre(Request $request){
        try{
            if($request->hasFile('background_image')){
                $who = WhoWeAre::where('key','background_image')->first();
                
                $background_image = $request->file('background_image');
                $directory = "public/who_we_images";
                $filename = generateFileName($background_image);
                $filepath = $background_image->storeAs($directory, $filename);

                $who->value = $filename;
                $who->file_path = $filepath;
                $who->update();
            }

            if($request->hasFile('banner_image')){
                $who = WhoWeAre::where('key','banner_image')->first();

                $banner_image = $request->file('banner_image');
                $directory = "public/who_we_images";
                $filename = generateFileName($banner_image);
                $filepath = $banner_image->storeAs($directory, $filename);

                $who->value = $filename;
                $who->file_path = $filepath;
                $who->update();
            }

            if($request->hasFile('image')){
                $who = WhoWeAre::where('key','image')->first();
                
                $image = $request->file('image');
                $directory = "public/who_we_images";
                $filename = generateFileName($image);
                $filepath = $image->storeAs($directory, $filename);

                $who->value = $filename;
                $who->file_path = $filepath;
                $who->update();
            }

            if($request->hasFile('offer_image')){
                $who = WhoWeAre::where('key','offer_image')->first();

                $offer_image = $request->file('offer_image');
                $directory = "public/who_we_images";
                $filename = generateFileName($offer_image);
                $filepath = $offer_image->storeAs($directory, $filename);

                $who->value = $filename;
                $who->file_path = $filepath;
                $who->update();
            }

            if($request->has('old_vision_heading')){
                foreach($request->old_vision_heading as $idx=>$vlu){
                    $vision = OurVision::find($idx);
                    $vision->heading = $vlu;
                    $vision->update();
                }
            }

            if($request->has('old_vision_description')){
                foreach($request->old_vision_description as $key=>$val){
                    $vision = OurVision::find($key);
                    $vision->description = $val;
                    $vision->update();
                }
            }

            if($request->hasFile('icon')){
                $icon = $request->file('icon');
                for($i=0; $i<count($icon); $i++){
                    $file = $icon[$i];

                    if($request->has('vision_heading')){
                        $vision_heading = $request->vision_heading[$i];
                    }

                    if($request->has('vision_description')){
                        $vision_description = $request->vision_description[$i];
                    }

                    $directory = "public/who_we_images";
                    $fileupload = $this->fileUploadService->upload($file, $directory);
                    $fileuploadData = $fileupload->getData();
            
                    if(isset($fileuploadData) && $fileuploadData->status == '200') {
                        $vision = new OurVision;
                        $vision->media_id = $fileuploadData->id;
                        $vision->heading = $vision_heading;
                        $vision->description = $vision_description;
                        $vision->save();
                    }elseif($fileuploadData->status == '400') {
                        return redirect()->back()->with('error', $fileuploadData->error);
                    }
                }
            }

            if($request->has('of_heading')){
                foreach($request->of_heading as $index=>$value){
                    $who = WhoWeAre::find($index);
                    $who->offer_section_heading = $value;
                    $who->update();
                }
            }

            if($request->has('of_description')){
                foreach($request->of_description as $key=>$val){
                    $who = WhoWeAre::find($key);
                    $who->offer_section_description = $val;
                    $who->update();
                }
            }

            if($request->has('of_new_heading')){
                for($i=0; $i<count($request->of_new_heading); $i++){
                    $heading = $request->of_new_heading[$i];

                    if($request->has('of_new_description')){
                        $description = $request->of_new_description[$i];
                    }

                    $who = new WhoWeAre;
                    $who->key = 'offer';
                    $who->offer_section_heading = $heading;
                    $who->offer_section_description = $description;
                    $who->save();
                }
            }

            $fields = [
                'title' => 'title',
                'banner_title' => 'banner_title',
                'banner_description' => 'banner_description',
                'heading' => 'heading',
                'description' => 'description',
                'offer_heading' => 'offer_heading',
                'offer_description' => 'offer_description',
            ];

            foreach($fields as $key=>$input){
                if($request->has($input)) {
                    $who = WhoWeAre::where('key', $key)->first();
                    if($who){
                        $who->value = $request->$input;
                        $who->update();
                    }
                }
            }

            if($request->bg_image_id != null){
                $who = WhoWeAre::where('id',$request->bg_image_id)->first();
                $file_path = getFilePath($who->file_path);
                if(File::exists($file_path)) {
                    $directory_path = dirname($file_path);
                    unlink($file_path);              
                    if(is_dir($directory_path) && count(scandir($directory_path)) == 2){
                        rmdir($directory_path);
                    }
                }
                $who->value = null;
                $who->file_path = null;
                $who->save();
            }

            if($request->baner_image_id != null){
                $who = WhoWeAre::where('id',$request->baner_image_id)->first();
                $file_path = getFilePath($who->file_path);
                if(File::exists($file_path)) {
                    $directory_path = dirname($file_path);
                    unlink($file_path);              
                    if(is_dir($directory_path) && count(scandir($directory_path)) == 2){
                        rmdir($directory_path);
                    }
                }
                $who->value = null;
                $who->file_path = null;
                $who->save();
            }

            if($request->legal_image_id != null){
                $who = WhoWeAre::where('id',$request->legal_image_id)->first();
                $file_path = getFilePath($who->file_path);
                if(File::exists($file_path)) {
                    $directory_path = dirname($file_path);
                    unlink($file_path);              
                    if(is_dir($directory_path) && count(scandir($directory_path)) == 2){
                        rmdir($directory_path);
                    }
                }
                $who->value = null;
                $who->file_path = null;
                $who->save();
            }

            if($request->offer_id != null){
                $who = WhoWeAre::where('id',$request->offer_id)->first();
                $file_path = getFilePath($who->file_path);
                if(File::exists($file_path)) {
                    $directory_path = dirname($file_path);
                    unlink($file_path);              
                    if(is_dir($directory_path) && count(scandir($directory_path)) == 2){
                        rmdir($directory_path);
                    }
                }
                $who->value = null;
                $who->file_path = null;
                $who->save();
            }

            if($request->vision_image_id != null){
                $deleteIds = explode(',', $request->vision_image_id);
                foreach($deleteIds as $id){
                    $our_vision = OurVision::where('id',$id)->with('media')->first();
                    if($our_vision->media){
                        $image_path = getFilePath($our_vision->media->file_path);
                        if (File::exists($image_path)) {
                            $directory_path = dirname($image_path);
                            unlink($image_path);
                            if(is_dir($directory_path) && count(scandir($directory_path)) == 2){
                                rmdir($directory_path);
                            }
                        }
                        Media::where('id',$our_vision->media_id)->delete();

                        $our_vision->media_id = null;
                        $our_vision->update();
                    }
                }
            }

            if($request->removeOffer != null){
                $deleteIds = explode(',', $request->removeOffer);
                foreach($deleteIds as $id){
                    $who = WhoWeAre::find($id);
                    if($who){
                        $who->delete();
                    }
                }
            }

            if($request->removeVision != null){
                $deleteIds = explode(',', $request->removeVision);
                foreach($deleteIds as $id){
                    $our_vision = OurVision::where('id',$id)->with('media')->first();
                    if($our_vision->media){
                        $image_path = getFilePath($our_vision->media->file_path);
                        if(File::exists($image_path)){
                            $directory_path = dirname($image_path);
                            unlink($image_path);
                            if(is_dir($directory_path) && count(scandir($directory_path)) == 2){
                                rmdir($directory_path);
                            }
                        }
                        Media::where('id',$our_vision->media_id)->delete();
                        $our_vision->delete();
                    }
                    
                }
            }

            return redirect()->back()->with('success','Data successfully updated.');

        }catch(Exception $e){
            saveLog("Error:", "SiteMetaController", $e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong. Please try again.');
        }
    }

    public function updateVisionImage(Request $request){
        if($request->image_id != null){
            $id = $request->image_id;
            if($request->hasFile('image')) {
                $file = $request->file('image');
                $directory = "public/who_we_images";
                $fileupload = $this->fileUploadService->upload($file, $directory);
                $fileuploadData = $fileupload->getData();

                $vision = OurVision::find($id);
                if(isset($fileuploadData) && $fileuploadData->status == '200'){
                    $vision->media_id = $fileuploadData->id;
                    $vision->update();
    
                    $response = [
                        'code' => $fileuploadData->status,
                        'status' => 'success',
                    ];
    
                }elseif($fileuploadData->status == '400') {
                    $response = [
                        'code' => $fileuploadData->status,
                        'status' => 'fail',
                    ];
                }
    
                return response()->json($response);
    
            }else{
                return response()->json([
                    'code' => '400',
                    'status' => 'fail',
                    'message' => 'No file uploaded',
                ], 400);
            }
        }
    }
}
