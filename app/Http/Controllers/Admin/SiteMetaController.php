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
use Exception;
use File;


class SiteMetaController extends Controller
{
    protected $fileUploadService;

    public function __construct(FileUploadService $fileUploadService){
        $this->fileUploadService = $fileUploadService;
    }

    public function howItWorks(){
        $howitwork = HowItWork::with('works')->get();

        $keys = [
            'title',
            'main_heading',
            'short_description',
            'join_our_community_text',
            'second_banner_heading',
            'second_banner_sub_heading',
            'button_label',
            'button_link'
        ];

        $results = HowItWork::whereIn('key', $keys)->get()->keyBy('key');
        $data = [
            'title_name' => $results['title']->value ?? null,
            'main_heading' => $results['main_heading']->value ?? null,
            'short_description' => $results['short_description']->value ?? null,
            'join_our_community_text' => $results['join_our_community_text']->value ?? null,
            'second_banner_heading' => $results['second_banner_heading']->value ?? null,
            'second_banner_sub_heading' => $results['second_banner_sub_heading']->value ?? null,
            'button_label' => $results['button_label']->value ?? null,
            'button_link' => $results['button_link']->value ?? null,
        ];

        return view('admin.site_meta.howItWorks.add_how_it_work', compact('howitwork', 'data'));

    }

    public function addHowItWorks(Request $request){
        try{
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
                    $filename = 'SiteImages' . time() . rand(1, 100) . '.' . $file->extension();
                    $file->move(public_path('site_images'), $filename);
    
                    if($request->new_work_heading != null){
                        $new_work_heading = $request->new_work_heading[$i];
                    }
                    
                    if($request->new_work_description != null){
                        $new_work_description = $request->new_work_description[$i];
                    }
                    
                    $howitwork = new HowItWork;
                    $howitwork->key = 'work';
                    $howitwork->type = 'work_type';

                    $works = new Work;
                    $works->image = $filename;
                    $works->heading = $new_work_heading;
                    $works->description = $new_work_description;
                    $works->save();

                    $howitwork->work_id = $works->id;
                    $howitwork->save();
                }
            }

            $fields = [
                'title' => 'title',
                'main_heading' => 'main_heading',
                'short_description' => 'short_description',
                'join_our_community_text' => 'join_our_community',
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
            
            if($request->has('delete_work_ids')){
                $deleteIds = explode(',', $request->delete_work_ids);
                foreach($deleteIds as $id){
                    $work = Work::find($id);
                    if($work){
                        $image_path = public_path('site_images/' . $work->image);
                        if (File::exists($image_path)) {
                            unlink($image_path);
                        }
                        $work->delete();
                    }
                    HowItWork::where('work_id', $id)->delete();
                }
            }

            return redirect()->back()->with('success', 'Data successfully updated');

        }catch(Exception $e){
            saveLog("Error:", "SiteMetaController", $e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong. Please try again.');
        }
    }
    
    public function termsConditions(){
        $keys = [
            'title',
            'main_heading',
            'sub_heading',
            'description',
        ];

        $results = TermsAndCondition::whereIn('key',$keys)->get()->keyBy('key');
        $data = [
            'title_name' => $results['title']->value ?? null,
            'main_heading' => $results['main_heading']->value ?? null,
            'sub_heading' => $results['sub_heading']->value ?? null,
            'description' => $results['description']->value ?? null,
        ];
        $termsAndCondition = TermsAndCondition::where('key','terms_and_condition')->get();

        return view('admin.site_meta.terms_and_conditions.terms_and_conditions',compact('termsAndCondition','data'));
    }

    public function addTermsAndCondition(Request $request){
        try{
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
                'sub_heading' => 'sub_heading',
                'description' => 'description',
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
            $contact->title = $request->title;
            $contact->description = $request->description;
            $contact->main_title = $request->main_title;
            $contact->main_description = $request->main_description;
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
        $documents = Document::all();
        $document_category = DocumentCategory::all();

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

        $home = HomeContent::where('key','category')->with('homeCategory.media')->get();

        return view('admin.site_meta.home.home_content',compact('documents','document_category','data','home'));
    }

    public function addHomeContent(Request $request){
        try{
            if($request->hasFile('background_image')){
                $background_image = $request->file('background_image');
                $directory = 'public';
                $filename = time().rand(1,50).'.'.$background_image->extension();
                $background_image->storeAs($directory, $filename);

                $home_content = HomeContent::where('key','background_image')->first();
                $home_content->value = $filename;
                $home_content->update();
            }

            if($request->hasFile('banner_image')){
                $banner_image = $request->file('banner_image');
                $directory = 'public';
                $filename = time().rand(1,50).'.'.$banner_image->extension();
                $banner_image->storeAs($directory, $filename);

                $home_content = HomeContent::where('key','banner_image')->first();
                $home_content->value = $filename;
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
                $file = $request->file('bottom_banner_img');
                $directory = 'public';
                $filename = time().rand(1,50).'.'.$file->extension();
                $file->storeAs($directory, $filename);

                $home_content = HomeContent::where('key','bottom_banner_image')->first();
                $home_content->value = $filename;
                $home_content->update();
            }

            if($request->hasFile('category_btn_arrow_img')){
                $file = $request->file('category_btn_arrow_img');
                $directory = 'public';
                $filename = time().rand(1,50).'.'.$file->extension();
                $file->storeAs($directory, $filename);

                $home_content = HomeContent::where('key','category_btn_arrow_img')->first();
                $home_content->value = $filename;
                $home_content->update();
            }

            if($request->has('review_left_arrow')){
                $file = $request->file('review_left_arrow');
                $directory = 'public';
                $filename = time().rand(1,50).'.'.$file->extension();
                $file->storeAs($directory, $filename);

                $home_content = HomeContent::where('key','review_left_arrow')->first();
                $home_content->value = $filename;
                $home_content->update();
            }

            if($request->has('review_right_arrow')){
                $file = $request->file('review_right_arrow');
                $directory = 'public';
                $filename = time().rand(1,50).'.'.$file->extension();
                $file->storeAs($directory, $filename);

                $home_content = HomeContent::where('key','review_right_arrow')->first();
                $home_content->value = $filename;
                $home_content->update();
            }

            if($request->hasFile('new_cat_img')){
                $image = $request->file('new_cat_img');
                for($i=0; $i<count($image); $i++){
                    $file = $image[$i];

                    if($request->has('new_cat_heading')){
                        $cat_heading = $request->new_cat_heading[$i];
                    }

                    if($request->has('new_category')){
                        $category = $request->new_category[$i];
                    }

                    if($request->has('new_category_description')){
                        $category_description = $request->new_category_description[$i];
                    }

                    $fileupload = $this->fileUploadService->upload($file, 'public');           
                    $fileuploadData = $fileupload->getData();

                    if(isset($fileuploadData) && $fileuploadData->status == '200'){
                        $home_category = new HomeCategories;
                        $home_category->media_id = $fileuploadData->id;
                        $home_category->heading = $cat_heading;
                        $home_category->category_id = $category;
                        $home_category->category_description = $category_description;
                        $home_category->save();

                        $home_content = new HomeContent;
                        $home_content->key = 'category';
                        $home_content->home_category_id = $home_category->id;
                        $home_content->save();
                        
                    }elseif($fileuploadData->status == '400') {
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

                foreach($request->category as $id=>$vl){
                    $home_category = HomeCategories::find($id);
                    $home_category->category_id = $vl;
                    $home_category->update();
                }

                foreach($request->category_description as $index=>$value){
                    $home_category = HomeCategories::find($index);
                    $home_category->category_description = $value;
                    $home_category->update();
                }
            }

            $fields = [
                'title' => 'title',      
                'banner_title' => 'banner_title',
                'button_name' => 'button_name',
                'banner_description' => 'banner_description',
                'bottom_button_link' => 'bottom_button_link',
                'most_popular_title' => 'main_title',
                'most_popular_btn_text' => 'most_popular_btn_text',
                'bottom_heading' => 'bottom_heading',
                'bottom_subheading' => 'bottom_sub_heading',
                'bottom_button_label' => 'bottom_button_label',
                'bottom_button_link' => 'bottom_button_link',
                'category_title' => 'category_main_title',
                'category_btn_text' => 'category_btn_text',
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

            if($request->category_sec != null){
                $deleteIds = explode(',', $request->category_sec);
                foreach($deleteIds as $id){
                    $home_category = HomeCategories::where('id',$id)->with('media')->first();
                    if($home_category->media){
                        $image_path = storage_path('/app/'.$home_category->media->file_path);
                        if (File::exists($image_path)) {
                            unlink($image_path);
                        }
                        $home_category->delete();
                    }
                    HomeContent::where('home_category_id', $id)->delete();
                    Media::where('id',$home_category->media_id)->delete();
                }
            }

            return redirect()->back()->with('success', 'Data successfully saved.');

        }catch(Exception $e){
            saveLog("Error:", "SiteMetaController", $e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong. Please try again.');
        }
    }
   
}
