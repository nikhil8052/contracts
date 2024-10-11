<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HowItWork;
use App\Models\Work;
use App\Models\TermsAndCondition;
use App\Models\AdminContactUs;
use App\Models\LoginRegister;
use App\Models\PrepareContract;
use App\Models\PrepareContractWork;
use App\Models\Media;
use App\Services\FileUploadService;
use App\Models\Document;
use App\Models\DocumentCategory;
use App\Models\HomeContent;
use App\Models\HomeCategories;
use App\Models\HomeTemplate;
use App\Models\Setting;
use App\Models\PricesContent;
use Exception;
use File;


class SiteMetaController extends Controller
{
    protected $fileUploadService;

    public function __construct(FileUploadService $fileUploadService){
        $this->fileUploadService = $fileUploadService;
    }

    public function howItWorks(){
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

        return view('admin.site_meta.howItWorks.add_how_it_work', compact('works', 'data'));

    }

    public function addHowItWorks(Request $request){
        // return $request->all();
        try{
            if($request->hasFile('background_image')){
                $file = $request->file('background_image');
                $filename = 'SiteImages' . time() . rand(1, 100) . '.' . $file->extension();
                $directory = 'public';
                $path = $file->storeAs($directory, $filename);

                $how_it_works = HowItWork::where('key','background_image')->first();
                $how_it_works->value = $filename;
                $how_it_works->update();
            }

            if($request->hasFile('banner_image')){
                $file = $request->file('banner_image');
                $filename = 'SiteImages' . time() . rand(1, 100) . '.' . $file->extension();
                $directory = 'public';
                $path = $file->storeAs($directory, $filename);

                $how_it_works = HowItWork::where('key','banner_image')->first();
                $how_it_works->value = $filename;
                $how_it_works->update();
            }

            if($request->hasFile('second_banner_img')){
                $file = $request->file('second_banner_img');
                $filename = 'SiteImages' . time() . rand(1, 100) . '.' . $file->extension();
                $directory = 'public';
                $path = $file->storeAs($directory, $filename);

                $how_it_works = HowItWork::where('key','second_banner_img')->first();
                $how_it_works->value = $filename;
                $how_it_works->update();
            }

            if($request->has('work_heading')){
                foreach($request->work_heading as $key=>$value){
                    $works = Work::find($key);
                    $works->heading = $value;
                    $works->update();
                }

                foreach($request->work_description as $id=>$description){
                    $works = Work::find($id);
                    $works->description	= $description;
                    $works->update();
                }
            }

            if($request->hasFile('new_work_image')){
                for($i=0; $i<count($request->file('new_work_image')); $i++){
                    $file = $request->file('new_work_image')[$i];
    
                    if($request->new_work_heading != null){
                        $new_work_heading = $request->new_work_heading[$i];
                    }
                    
                    if($request->new_work_description != null){
                        $new_work_description = $request->new_work_description[$i];
                    }
                    $fileupload = $this->fileUploadService->upload($file, 'public');
            
                    $fileuploadData = $fileupload->getData();
        
                    if(isset($fileuploadData) && $fileuploadData->status == '200'){
                        $howitwork = new HowItWork;
                        $howitwork->key = 'work';
                        $howitwork->type = 'work_type';
    
                        $works = new Work;
                        $works->media_id = $fileuploadData->id;
                        $works->heading = $new_work_heading;
                        $works->description = $new_work_description;
                        $works->save();
    
                        $howitwork->work_id = $works->id;
                        $howitwork->save();
                    }elseif($fileuploadData->status == '400') {
                        return redirect()->back()->with('error', $fileuploadData->error);
                    }
                }
            }

            $fields = [
                'title' => 'title',
                'banner_title' => 'banner_title',
                'banner_description' => 'banner_description',
                'main_heading' => 'main_heading',
                'short_description' => 'short_description',
                'second_banner_heading' => 'banner_heading',
                'second_banner_sub_heading' => 'sub_heading',
                'button_label' => 'button_label',
                'button_link' => 'button_link'
            ];
            
            foreach($fields as $key=>$input){
                if($request->has($input)) {
                    $How_it_work = HowItWork::where('key', $key)->first();
                    if ($How_it_work) {
                        $How_it_work->value = $request->$input;
                        $How_it_work->update();
                    }
                }
            }
            
            // if($request->has('delete_work_ids')){
            //     $deleteIds = explode(',', $request->delete_work_ids);
            //     foreach($deleteIds as $id){
            //         $work = Work::find($id);
            //         if($work){
            //             $image_path = storage_path('app/' . $work->image);
            //             if (File::exists($image_path)) {
            //                 unlink($image_path);
            //             }
            //             $work->delete();
            //         }
            //         HowItWork::where('work_id', $id)->delete();
            //     }
            // }

            return redirect()->back()->with('success', 'Data successfully updated');

        }catch(Exception $e){
            saveLog("Error:", "SiteMetaController", $e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong. Please try again.');
        }
    }
    
    public function termsConditions(){
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

        return view('admin.site_meta.terms_and_conditions.terms_and_conditions',compact('termsAndCondition','data'));
    }

    public function addTermsAndCondition(Request $request){
        try{
            if($request->hasFile('background_image')){
                $file = $request->file('background_image');
                $filename = generateFileName($file);
                $directory = 'public';
                $path = $file->storeAs($directory, $filename);

                $termsCondition = TermsAndCondition::where('key','background_image')->first();
                $termsCondition->value = $filename;
                $termsCondition->update();
            }

            if($request->hasFile('banner_image')){
                $file = $request->file('banner_image');
                $filename = generateFileName($file);
                $directory = 'public';
                $path = $file->storeAs($directory, $filename);

                $termsCondition = TermsAndCondition::where('key','banner_image')->first();
                $termsCondition->value = $filename;
                $termsCondition->update();
            }

            if($request->has('terms')){
                foreach($request->terms as $index=>$value){
                    $termsCondition = TermsAndCondition::find($index);
                    $termsCondition->terms = $value;
                    $termsCondition->update();
                }

                foreach($request->condition as $key=>$val){
                    $termsCondition = TermsAndCondition::find($key);
                    $termsCondition->condition = $val;
                    $termsCondition->update();
                }
            }

            if($request->has('new_terms')){
                for($i=0; $i<count($request->new_terms); $i++){
                    $new_terms = $request->new_terms[$i];

                    $terms_and_condition = new TermsAndCondition;
                    $terms_and_condition->key = 'terms_and_condition';
                    $terms_and_condition->type = 'terms';
                    $terms_and_condition->terms = $new_terms;

                    if($request->new_condition != null){
                        $new_condition = $request->new_condition[$i];
                    }
                    $terms_and_condition->condition = $new_condition;
                    $terms_and_condition->save();
                }                
            }

            $keys = [
                'title' => 'title',
                'main_heading' => 'main_heading',
                'banner_title' => 'banner_title',
                'banner_description' => 'banner_description',
            ];
            
            foreach($keys as $key=>$input){
                if($request->has($input)){
                    $terms_and_condition = TermsAndCondition::where('key', $key)->first();
                    if ($terms_and_condition) {
                        $terms_and_condition->value = $request->$input;
                        $terms_and_condition->update();
                    }
                }
            }

            if($request->remove_ids != null){
                $removeIds = explode(',', $request->remove_ids);
                $termsCondition = TermsAndCondition::whereIn('id',$removeIds)->delete();
            }

            return redirect()->back()->with('success','Terms and Conditions successfully saved');
        }catch(Exception $e){
            saveLog("Error:", "SiteMetaController", $e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong. Please try again.');
        }
    }

    public function contactUs(){
        $contact = AdminContactUs::first();
   
        return view('admin.site_meta.contactUs.contact_us',compact('contact'));
    }

    public function addContactProcc(Request $request){
        try{
            if($request->id != null){
                $contact = AdminContactUs::find($request->id);
                $status = 'updated';
            }else{
                $contact = new AdminContactUs;
                $status = 'saved';
            }

            if($request->hasFile('background_image')){
                $file = $request->file('background_image');
                $filename = generateFileName($file);
                $directory = 'public';
                $path = $file->storeAs($directory, $filename);
                $contact->background_image = $filename;
            }

            if($request->hasFile('banner_image')){
                $file = $request->file('banner_image');
                $filename = generateFileName($file);
                $directory = 'public';
                $path = $file->storeAs($directory, $filename);
                $contact->banner_image = $filename;
            }

            $contact->title = $request->title;
            $contact->banner_title = $request->banner_title;
            $contact->banner_description = $request->banner_description;
            $contact->main_title = $request->main_title;
            $contact->save();

            if($status == 'updated'){
                return redirect()->back()->with('success','Data Successfully updated');
            }elseif($status == 'saved'){
                return redirect()->back()->with('success','Data Successfully saved');
            }
        }catch(Exception $e){
            saveLog("Error:", "SiteMetaController", $e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong. Please try again.');
        }
    }

    public function login(){
        $login = LoginRegister::where('key','login')->first();
        return view('admin.site_meta.login.login',compact('login'));
    }

    public function addLogin(Request $request){
        try{
            if($request->id != null){
                $login = LoginRegister::find($request->id);  
                $status = 'updated';       
            }else{
                $login = new LoginRegister; 
                $status = 'saved';  
            }
            $login->key = 'login';
            $login->title = $request->title;
            $login->main_heading = $request->main_heading;
            $login->save();
        
            if($status == 'updated'){
                return redirect()->back()->with('success','Data Successfully updated');
            }elseif($status == 'saved'){
                return redirect()->back()->with('success','Data Successfully saved');
            }

        }catch(Exception $e){
            saveLog("Error:", "SiteMetaController", $e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong. Please try again.');
        }
    }

    public function register(){
        $register = LoginRegister::where('key','register')->first();
        return view('admin.site_meta.register.register',compact('register'));
    }

    public function addRegister(Request $request){
        try{
            if($request->id != null){
                $register = LoginRegister::find($request->id);    
                $status = 'updated';       
            }else{
                $register = new LoginRegister;  
                $status = 'saved';  
            }
            $register->key = 'register';
            $register->title = $request->title;
            $register->save();
        
            if($status == 'updated'){
                return redirect()->back()->with('success','Data Successfully updated');
            }elseif($status == 'saved'){
                return redirect()->back()->with('success','Data Successfully saved');
            }

        }catch(Exception $e){
            saveLog("Error:", "SiteMetaController", $e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong. Please try again.');
        }
    }

    public function prepareContract(){
        $keys = [
            'title',
            'fb_link',
            'twitter_link',
            'pinterest_link',
            'short_description',
            'description',
            'page_sub_heading',
            'work_main_heading',
            'economical_main_heading',
            'economical_description',
            'button_text',
            'button_link'
        ];

        $results = PrepareContract::whereIn('key', $keys)->get()->keyBy('key');
        $data = [
            'title_name' => $results['title']->value ?? null,
            'fb_link' => $results['fb_link']->value ?? null,
            'twitter_link' => $results['twitter_link']->value ?? null,
            'pinterest_link' => $results['pinterest_link']->value ?? null,
            'short_description' => $results['short_description']->value ?? null,
            'description' => $results['description']->value ?? null,
            'page_sub_heading' => $results['page_sub_heading']->value ?? null,
            'work_main_heading' => $results['work_main_heading']->value ?? null,
            'economical_main_heading' => $results['economical_main_heading']->value ?? null,
            'economical_description' => $results['economical_description']->value ?? null,
            'button_text' => $results['button_text']->value ?? null,
            'button_link' => $results['button_link']->value ?? null,
        ];

        $image = PrepareContract::where('key','image')->whereNotNull('media_id')->with('media')->first();
        $work_sec =  PrepareContract::where('key','prepare_work')->with('contract_work','media')->get();
       
        return view('admin.site_meta.prepare_contract.prepare_contract',compact('data','image','work_sec'));
    }

    public function prepareContractprocc(Request $request){
        try{
            if($request->image_id != null){
                $prepare_contract = PrepareContract::where('id',$request->image_id)->with('media')->first(); 
                if($prepare_contract->media){
                    $image_path = storage_path('/app/'.$prepare_contract->media->file_path);
                    if (File::exists($image_path)) {
                        unlink($image_path);
                    }
                    $prepare_contract->media_id = null;
                    $prepare_contract->update();
                }
            }

            if($request->hasFile('image')){
                $image = $request->file('image');
                $fileupload = $this->fileUploadService->upload($image, 'public');
            
                $fileuploadData = $fileupload->getData();
        
                if(isset($fileuploadData) && $fileuploadData->status == '200'){
                    $prepare_contract = PrepareContract::where('key','image')->first();
                    if($prepare_contract){
                        $prepare_contract->media_id = $fileuploadData->id;
                        $prepare_contract->update();
                    }else{
                        $prepare_contract = new PrepareContract; 
                        $prepare_contract->key = 'image';
                        $prepare_contract->type = 'file';
                        $prepare_contract->media_id = $fileuploadData->id;
                        $prepare_contract->save();
                    }
                    
                }elseif($fileuploadData->status == '400') {
                    return redirect()->back()->with('error', $fileuploadData->error);
                }
            }

            if($request->has('work_header')){
                foreach($request->work_header as $key=>$value){
                    $prepare_contract_work = PrepareContractWork::find($key);
                    $prepare_contract_work->header = $value; 
                    $prepare_contract_work->update();
                }

                foreach($request->work_short_description as $id=>$description){
                    $prepare_contract_work = PrepareContractWork::find($key);
                    $prepare_contract_work->description = $description;    
                    $prepare_contract_work->update();
                }
            }

            if($request->hasFile('new_work_icon')){
                $icon = $request->file('new_work_icon');
                for($i=0; $i<count($icon); $i++){
                    $file = $icon[$i];

                    if($request->has('new_work_header')){
                        $work_header = $request->new_work_header[$i];
                    }

                    if($request->has('new_work_short_description')){
                        $work_short_description = $request->new_work_short_description[$i];
                    }

                    $fileupload = $this->fileUploadService->upload($file, 'public');
            
                    $fileuploadData = $fileupload->getData();

                    if(isset($fileuploadData) && $fileuploadData->status == '200'){
                        $prepare_contract = new PrepareContract; 
                        $prepare_contract->key = 'prepare_work';
                        $prepare_contract->type = 'work';

                        $prepare_contract_work = new PrepareContractWork;
                        $prepare_contract_work->media_id = $fileuploadData->id;
                        $prepare_contract_work->header = $work_header;
                        $prepare_contract_work->description = $work_short_description;    
                        $prepare_contract_work->save();

                        $prepare_contract->media_id = $fileuploadData->id;
                        $prepare_contract->prepare_work_id = $prepare_contract_work->id;
                        $prepare_contract->save();
            
                    }elseif($fileuploadData->status == '400') {
                        return redirect()->back()->with('error', $fileuploadData->error);
                    }
                }
            }

            $fields = [
                'title' => 'title',
                'fb_link ' => 'fb_link',
                'twitter_link' => 'twitter_link',
                'pinterest_link' => 'pinterest_link',
                'short_description' => 'short_description',
                'description' => 'description',
                'page_sub_heading' => 'page_sub_heading',
                'work_main_heading' => 'work_main_heading',
                'economical_main_heading' => 'economical_main_heading',
                'economical_description' => 'economical_description',
                'button_text' => 'button_text',
                'button_link' => 'button_link',
            ];
            
            foreach($fields as $key=>$input){
                if($request->has($input)) {
                    $prepare_contract = PrepareContract::where('key', $key)->first();
                    if ($prepare_contract) {
                        $prepare_contract->value = $request->$input;
                        $prepare_contract->update();
                    }
                }
            }

            if($request->work_sec_ids != null){
                $deleteIds = explode(',', $request->work_sec_ids);
                foreach($deleteIds as $id){
                    $prepare_contract_work = PrepareContract::where('prepare_work_id',$id)->with('media')->first();
                    if($prepare_contract_work->media){
                        $image_path = storage_path('/app/'.$prepare_contract_work->media->file_path);
                        if (File::exists($image_path)) {
                            unlink($image_path);
                        }
                        $prepare_contract_work->delete();
                    }
                    PrepareContractWork::where('id', $id)->delete();
                }
            }

            return redirect()->back()->with('success', 'Data successfully updated');
        }catch(Exception $e){
            saveLog("Error:", "SiteMetaController", $e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong. Please try again.');
        }
    }

    public function homepage(){
        $document_category = DocumentCategory::all();

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
            'favicon_id' => $results['favicon']->id ?? null,
            'favicon' => str_replace('public/', '', $results['favicon']->file_path ?? null),
            'background_image_id' => $results['background_image']->id ?? null,
            'background_image' => str_replace('public/', '', $results['background_image']->file_path ?? null),
            'banner_image_id' =>  $results['banner_image']->id ?? null,
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
            'bottom_banner_id' => $results['bottom_banner_image']->id ?? null,
            'bottom_banner_image' => str_replace('public/', '', $results['bottom_banner_image']->file_path ?? null),
            'category_title' => $results['category_title']->value ?? null,
            'join_us_text' => $results['join_us_text']->value ?? null, 
            'reviews_heading' => $results['reviews_heading']->value ?? null, 
            'reviews_sub_heading' => $results['reviews_sub_heading']->value ?? null, 
            'left_arrow_id' => $results['review_left_arrow']->id ?? null,
            'review_left_arrow' => str_replace('public/', '', $results['review_left_arrow']->file_path ?? null),
            'right_arrow_id' => $results['review_right_arrow']->id ?? null,
            'review_right_arrow' => str_replace('public/', '', $results['review_right_arrow']->file_path ?? null),
        ];

        $home = HomeCategories::with('media')->get();;

        return view('admin.site_meta.home.home_content',compact('document_category','data','home'));
    }

    public function addHomeContent(Request $request){
        try{
            if($request->hasFile('background_image')){
                $home_content = HomeContent::where('key','background_image')->first();

                $background_image = $request->file('background_image');
                $image_id = $home_content->id;
                $timestamp = now()->timestamp;
                $directory = "public/home_images/{$image_id}_{$timestamp}";
                $filename = generateFileName($background_image);
                $filepath = $background_image->storeAs($directory, $filename);

                $home_content->value = $filename;
                $home_content->file_path = $filepath;
                $home_content->update();
            }

            if($request->hasFile('banner_image')){
                $home_content = HomeContent::where('key','banner_image')->first();

                $banner_image = $request->file('banner_image');
                $image_id = $home_content->id;
                $timestamp = now()->timestamp;
                $directory = "public/home_images/{$image_id}_{$timestamp}";
                $filename = generateFileName($banner_image);
                $filepath = $banner_image->storeAs($directory, $filename);

                $home_content->value = $filename;
                $home_content->file_path = $filepath;
                $home_content->update();
            }

            if($request->has('popular_documents')){
                $popular_documents = $request->popular_documents;

                $home_content = HomeContent::where('key','popular')->first();
                if(isset($home_content) && $home_content != null){
                    $home_content->value = json_encode($popular_documents);
                    $home_content->update();
                }else{
                    $home_content = new HomeContent;
                    $home_content->key = 'popular';
                    $home_content->value = json_encode($popular_documents);
                    $home_content->save();
                }
            }

            if($request->hasFile('bottom_banner_img')){
                $home_content = HomeContent::where('key','bottom_banner_image')->first();
                
                $file = $request->file('bottom_banner_img');
                $image_id = $home_content->id;
                $timestamp = now()->timestamp;
                $directory = "public/home_images/{$image_id}_{$timestamp}";
                $filename = generateFileName($file);
                $filepath = $file->storeAs($directory, $filename);

                $home_content->value = $filename;
                $home_content->file_path = $filepath;
                $home_content->update();
            }

            if($request->hasFile('favicon')){
                $home_content = HomeContent::where('key','favicon')->first();

                $file = $request->file('favicon');
                $image_id = $home_content->id;
                $timestamp = now()->timestamp;
                $directory = "public/home_images/{$image_id}_{$timestamp}";
                $filename = generateFileName($file);
                $filepath = $file->storeAs($directory, $filename);

                $home_content->value = $filename;
                $home_content->file_path = $filepath;
                $home_content->update();
            }

            if($request->has('review_left_arrow')){
                $home_content = HomeContent::where('key','review_left_arrow')->first();

                $file = $request->file('review_left_arrow');
                $image_id = $home_content->id;
                $timestamp = now()->timestamp;
                $directory = "public/home_images/{$image_id}_{$timestamp}";
                $filename = generateFileName($file);
                $filepath = $file->storeAs($directory, $filename);

                $home_content->value = $filename;
                $home_content->file_path = $filepath;
                $home_content->update();
            }

            if($request->has('review_right_arrow')){
                $home_content = HomeContent::where('key','review_right_arrow')->first();
                
                $file = $request->file('review_right_arrow');
                $image_id = $home_content->id;
                $timestamp = now()->timestamp;
                $directory = "public/home_images/{$image_id}_{$timestamp}";
                $filename = generateFileName($file);
                $filepath = $file->storeAs($directory, $filename);

                $home_content->value = $filename;
                $home_content->file_path = $filepath;
                $home_content->update();
            }

            if ($request->hasFile('new_cat_img')) {
                $image = $request->file('new_cat_img');
            
                for ($i = 0; $i < count($image); $i++) {
                    $file = $image[$i];
            
                    $cat_heading = $request->has('new_cat_heading') ? $request->new_cat_heading[$i] : null;
                    $category = $request->has('new_category') ? $request->new_category[$i] : null;
                    $category_description = $request->has('new_category_description') ? $request->new_category_description[$i] : null;
                    $category_btn_text = $request->has('new_category_btn_text') ? $request->new_category_btn_text[$i] : null;
                    $category_btn_link = $request->has('new_category_btn_link') ? $request->new_category_btn_link[$i] : null;
            
                    $home_category = HomeCategories::create([
                        'category_id' => $category,
                        'heading' => $cat_heading,
                        'category_description' => $category_description,
                        'btn_text' => $category_btn_text,
                        'btn_link' => $category_btn_link,
                        'media_id' => null
                    ]);
            
                    $image_id = $home_category->id;
                    $timestamp = now()->timestamp;
                    $directory = "public/home_categories/{$image_id}_{$timestamp}";
                    $fileupload = $this->fileUploadService->upload($file, $directory);
                    $fileuploadData = $fileupload->getData();
            
                    if (isset($fileuploadData) && $fileuploadData->status == '200') {
                        $home_category->media_id = $fileuploadData->id;
                        $home_category->save();
                    } elseif ($fileuploadData->status == '400') {
                        return redirect()->back()->with('error', $fileuploadData->error);
                    }
                }
            }            
            
            if($request->has('cat_heading')){
                foreach($request->cat_heading as $key=>$val){
                    $home_category = HomeCategories::find($key);
                    $home_category->heading = $val;
                    $home_category->update();
                }

                foreach($request->category_description as $index=>$value){
                    $home_category = HomeCategories::find($index);
                    $home_category->category_description = $value;
                    $home_category->update();
                }

                foreach($request->category_btn_text as $idx=>$vlu){
                    $home_category = HomeCategories::find($idx);
                    $home_category->btn_text = $vlu;
                    $home_category->update();
                }
            }

            if($request->category != null){
                foreach($request->category as $id=>$vl){
                    $home_category = HomeCategories::find($id);
                    $home_category->category_id = $vl;
                    $home_category->update();
                }
            }

            if($request->category_btn_link != null){
                foreach($request->category_btn_link as $c_idx=>$c_vlu){
                    $home_category = HomeCategories::find($c_idx);
                    $home_category->btn_link= $c_vlu;
                    $home_category->update();
                }
            }
            
            $fields = [
                'title' => 'title',     
                'banner_title' => 'banner_title',
                'button_name' => 'button_name',
                'banner_description' => 'banner_description',
                'banner_placeholder' => 'banner_placeholder',
                'bottom_button_link' => 'bottom_button_link',
                'most_popular_title' => 'main_title',
                'most_popular_btn_text' => 'most_popular_btn_text',
                'bottom_heading' => 'bottom_heading',
                'bottom_subheading' => 'bottom_sub_heading',
                'bottom_button_label' => 'bottom_button_label',
                'bottom_button_link' => 'bottom_button_link',
                'category_title' => 'category_main_title',
                'join_us_text' => 'join_us_text',
                'reviews_heading' => 'reviews_heading',
                'reviews_sub_heading' => 'reviews_sub_heading',
            ];

            foreach($fields as $key=>$input){
                if($request->has($input)) {
                    $home_content = HomeContent::where('key', $key)->first();
                    if($home_content){
                        $home_content->value = $request->$input;
                        $home_content->update();
                    }
                }
            }

            if($request->favicon_image_id != null){
                $home_content = HomeContent::where('id',$request->favicon_image_id)->first();
                $file_path = getFilePath($home_content->file_path);
                if(File::exists($file_path)) {
                    $directory_path = dirname($file_path);
                    unlink($file_path);              
                    if(is_dir($directory_path) && count(scandir($directory_path)) == 2){
                        rmdir($directory_path);
                    }
                }
                $home_content->value = null;
                $home_content->file_path = null;
                $home_content->save();
            }

            if($request->bg_image_id != null){
                $home_content = HomeContent::where('id',$request->bg_image_id)->first();
                $file_path = getFilePath($home_content->file_path);
                if(File::exists($file_path)) {
                    $directory_path = dirname($file_path);
                    unlink($file_path);              
                    if(is_dir($directory_path) && count(scandir($directory_path)) == 2){
                        rmdir($directory_path);
                    }
                }
                $home_content->value = null;
                $home_content->file_path = null;
                $home_content->save();
            }

            if($request->baner_image_id != null){
                $home_content = HomeContent::where('id',$request->baner_image_id)->first();
                $file_path = getFilePath($home_content->file_path);
                if(File::exists($file_path)) {
                    $directory_path = dirname($file_path);
                    unlink($file_path);              
                    if(is_dir($directory_path) && count(scandir($directory_path)) == 2){
                        rmdir($directory_path);
                    }
                }
                $home_content->value = null;
                $home_content->file_path = null;
                $home_content->save();
            }

            if($request->btom_banner_id != null){
                $home_content = HomeContent::where('id',$request->btom_banner_id)->first();
                $file_path = getFilePath($home_content->file_path);
                if(File::exists($file_path)) {
                    $directory_path = dirname($file_path);
                    unlink($file_path);              
                    if(is_dir($directory_path) && count(scandir($directory_path)) == 2){
                        rmdir($directory_path);
                    }
                }
                $home_content->value = null;
                $home_content->file_path = null;
                $home_content->save();
            }

            if($request->rght_id != null){
                $home_content = HomeContent::where('id',$request->rght_id)->first();
                $file_path = getFilePath($home_content->file_path);
                if(File::exists($file_path)) {
                    $directory_path = dirname($file_path);
                    unlink($file_path);              
                    if(is_dir($directory_path) && count(scandir($directory_path)) == 2){
                        rmdir($directory_path);
                    }
                }
                $home_content->value = null;
                $home_content->file_path = null;
                $home_content->save();
            }

            if($request->lft_id != null){
                $home_content = HomeContent::where('id',$request->lft_id)->first();
                $file_path = getFilePath($home_content->file_path);
                if(File::exists($file_path)) {
                    $directory_path = dirname($file_path);
                    unlink($file_path);              
                    if(is_dir($directory_path) && count(scandir($directory_path)) == 2){
                        rmdir($directory_path);
                    }
                }
                $home_content->value = null;
                $home_content->file_path = null;
                $home_content->save();
            }

            if($request->category_img_id != null){
                $deleteIds = explode(',', $request->category_img_id);
                foreach($deleteIds as $id){
                    $home_category = HomeCategories::where('id',$id)->with('media')->first();
                    if($home_category->media){
                        $image_path = getFilePath($home_category->media->file_path);
                        if (File::exists($image_path)) {
                            $directory_path = dirname($image_path);
                            unlink($image_path);
                            if(is_dir($directory_path) && count(scandir($directory_path)) == 2){
                                rmdir($directory_path);
                            }
                        }
                        $home_category->media_id = null;
                        $home_category->save();
                    }
                    Media::where('id',$home_category->media_id)->delete();
                }
            }

            if($request->category_sec != null){
                $deleteIds = explode(',', $request->category_sec);
                foreach($deleteIds as $id){
                    $home_category = HomeCategories::where('id',$id)->with('media')->first();
                    if($home_category->media){
                        $image_path = getFilePath($home_category->media->file_path);
                        if (File::exists($image_path)) {
                            $directory_path = dirname($image_path);
                            unlink($image_path);
                            if(is_dir($directory_path) && count(scandir($directory_path)) == 2){
                                rmdir($directory_path);
                            }
                        }
                        $home_category->delete();
                    }
                    Media::where('id',$home_category->media_id)->delete();
                }
            }

            return redirect()->back()->with('success', 'Data successfully saved.');

        }catch(Exception $e){
            saveLog("Error:", "SiteMetaController", $e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong. Please try again.');
        }
    }

    public function updateCategoryImage(Request $request){
        if($request->category_id != null){
            $id = $request->category_id;
            if($request->hasFile('cat_image')) {
                $file = $request->file('cat_image');
                $home_category = HomeCategories::find($id);
                $timestamp = now()->timestamp;
                $directory = "public/home_categories/{$id}_{$timestamp}";
                $fileupload = $this->fileUploadService->upload($file, $directory);
                $fileuploadData = $fileupload->getData();
    
                if(isset($fileuploadData) && $fileuploadData->status == '200'){
                    $home_category->media_id = $fileuploadData->id;
                    $home_category->update();
    
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
    
            } else {
                // File not provided in the request
                return response()->json([
                    'code' => '400',
                    'status' => 'fail',
                    'message' => 'No file uploaded',
                ], 400);
            }
        }
    }
    
    // public function updateCategoryImage(Request $request){
    //     if($request->category_id != null){
    //         $id = $request->category_id;
    //         $home_category = HomeCategories::find($id);
    //         $timestamp = now()->timestamp;
    //         $directory = "public/home_categories/{$id}_{$timestamp}";
    //         $fileupload = $this->fileUploadService->upload($file, $directory);
    //         $fileuploadData = $fileupload->getData();
    
    //         if(isset($fileuploadData) && $fileuploadData->status == '200') {
    //             $home_category->media_id = $fileuploadData->id;
    //             $home_category->update();

    //             $response = ([
    //                 'code' => $fileuploadData->status,
    //                 'status' => 'success',
    //             ]);

    //         }elseif($fileuploadData->status == '400') {
    //             $response = ([
    //                 'code' => $fileuploadData->status,
    //                 'status' => 'fail',
    //             ]);
    //         }

    //         return response()->json($response);
    //     }
    // }

    public function webSetting(){
        $keys = [
            'header_logo',
            'footer_logo'
        ];

        $results = Setting::whereIn('key', $keys)->get()->keyBy('key');
        $data = [
            'header_logo' => $results['header_logo']->value ?? null,
            'footer_logo' => $results['footer_logo']->value ?? null,
        ];
        return view('admin.site_meta.web_setting.web_setting',compact('data'));
    }
   
    public function addWebsetting(Request $request){
        try{
            if($request->hasFile('header_logo')){
                $file = $request->file('header_logo');
                $filename = 'Logo' .generateFileName($file);;
                $directory = 'public';
                $path = $file->storeAs($directory, $filename);

                $web_setting = Setting::key('header_logo')->first();
                if(!$web_setting){
                    $web_setting = new Setting;
                    $web_setting->key = 'header_logo';
                    $web_setting->value = $filename;
                    $web_setting->save();
                }else{
                    $web_setting->value = $filename;
                    $web_setting->update();
                }
                
            }

            if($request->hasFile('footer_logo')){
                $file = $request->file('footer_logo');
                $filename = 'Logo' .generateFileName($file);;
                $directory = 'public';
                $path = $file->storeAs($directory, $filename);

                $web_setting = Setting::key('footer_logo')->first();
                if(!$web_setting){
                    $web_setting = new Setting;
                    $web_setting->key = 'footer_logo';
                    $web_setting->value = $filename;
                    $web_setting->save();
                }else{
                    $web_setting->value = $filename;
                    $web_setting->update();
                }
               
            }

            return redirect()->back()->with('success', 'Data successfully saved.');
        }catch(Exception $e){
            saveLog("Error:", "SiteMetaController", $e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong. Please try again.');
        }
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
            'background_image' => $results['background_image']->value ?? null,
            'banner_title' => $results['banner_title']->value ?? null,
            'banner_description' => $results['banner_description']->value ?? null,
            'banner_image' => $results['banner_image']->value ?? null,
            'document_heading' => $results['document_heading']->value ?? null,
            'description_heading' => $results['description_heading']->value ?? null,
            'price_heading' => $results['price_heading']->value ?? null,
        ];

        $document = Document::all();
        $document_price_description = PricesContent::where('key', 'price_content')->get();
        return view('admin.site_meta.prices.price',compact('data','document','document_price_description'));
    }

    public function addPriceContent(Request $request){
        // return $request->all();
        try{
            if($request->hasFile('background_image')){
                $background_image = $request->file('background_image');
                $directory = 'public';
                $filename = generateFileName($background_image);
                $background_image->storeAs($directory, $filename);

                $price_content = PricesContent::where('key','background_image')->first();
                $price_content->value = $filename;
                $price_content->update();
            }

            if($request->hasFile('banner_image')){
                $banner_image = $request->file('banner_image');
                $directory = 'public';
                $filename = generateFileName($banner_image);
                $banner_image->storeAs($directory, $filename);

                $price_content = PricesContent::where('key','banner_image')->first();
                $price_content->value = $filename;
                $price_content->update();
            }

            if($request->has('document')){
                $document = $request->document;
                $button_text = $request->button_text;
                $price = $request->price;
                $description = $request->description;
            
                foreach($document as $key => $document){
                    $price_content = PricesContent::find($key);
                    $price_content->document = $document;
                    $price_content->update(); 
                }

                foreach($button_text as $index => $button){
                    $price_content = PricesContent::find($index);
                    $price_content->button_text = $button;
                    $price_content->update(); 
                }

                foreach($price as $idx => $price){
                    $price_content = PricesContent::find($idx);
                    $price_content->price = $price;
                    $price_content->update(); 
                }

                foreach($description as $keyy => $description){
                    $price_content = PricesContent::find($keyy);
                    $price_content->description = $description;
                    $price_content->update(); 
                }
            }

            if($request->has('new_document')){
                for($i=0; $i<count($request->new_document); $i++){
                    $document = $request->new_document[$i];

                    if($request->has('new_button_text')){
                        $button_text = $request->new_button_text[$i];
                    }

                    if($request->has('new_price')){
                        $price = $request->new_price[$i];
                    }

                    if($request->has('new_description')){
                        $description = $request->new_description[$i];
                    }

                    $price_content = new PricesContent;
                    $price_content->key = 'price_content';
                    $price_content->document = $document;
                    $price_content->button_text = $button_text;
                    $price_content->price = $price;
                    $price_content->description = $description;
                    $price_content->save();
                }
            }

            $keys = [
                'title' => 'title',
                'banner_title' => 'banner_title',
                'banner_description' => 'banner_description',
                'document_heading' => 'document_heading',
                'description_heading' => 'description_heading',
                'price_heading' => 'price_heading',
            ];
            
            foreach($keys as $key=>$input){
                if($request->has($input)){
                    $price_content = PricesContent::where('key', $key)->first();
                    if ($price_content) {
                        $price_content->value = $request->$input;
                        $price_content->update();
                    }
                }
            }

            if($request->delete_content_ids != null){
                $deleteIds = explode(',', $request->delete_content_ids);
                foreach($deleteIds as $id){
                    $price_content = PricesContent::find($id);
                    $price_content->delete();
                }
            }

            return redirect()->back()->with('success', 'Data successfully saved.');
        }catch(Exception $e){
            saveLog("Error:", "SiteMetaController", $e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong. Please try again.');
        }
    }
}
