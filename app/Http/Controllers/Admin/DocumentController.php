<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DocumentCategory;
use App\Models\Document;
use App\Models\DocumentFaq;
use App\Models\DocumentGuide;
use App\Models\DocumentsField;
use App\Models\DocumentRelated;
use Illuminate\Support\Str;
use Exception;
use App\Services\FileUploadService;
use Illuminate\Support\Facades\DB;
use App\Models\Review;

class DocumentController extends Controller
{
    protected $fileUploadService;

    public function __construct(FileUploadService $fileUploadService){
        $this->fileUploadService = $fileUploadService;
    }

    public function documents(){
        $categories  = DocumentCategory::all();
        $related_documents = Document::all();
        return view('admin.documents.document',compact('categories','related_documents'));
    }

    public function addDocuments(Request $request){
        DB::beginTransaction(); 
        try{
            $document = new Document;
            $document->title = $request->title;
            $document->slug = $request->slug;

            if($request->hasFile('document_image')){
                $document_image = $request->file('document_image');
                $imagename = time().rand(1,50).'.'.$document_image->extension();
                $directory = 'public';
                $path = $document_image->storeAs($directory, $imagename);

                $document->document_image = $imagename;
                $document->document_directory_name = $directory;
                $document->document_file_path = $path;
            }

            $document->short_description = $request->short_description;
            $document->btn_text = $request->document_button_text;
            $document->long_description = $request->long_description;
            $document->save();

            if($request->hasFile('upload_image')){
                $upload_image = $request->file('upload_image');
                for($i=0; $i<count($upload_image); $i++){
                    $file = $upload_image[$i];

                    if($request->has('img_heading')){
                        $img_heading = $request->img_heading[$i];
                    }

                    if($request->has('img_description')){
                        $img_description = $request->img_description[$i];
                    }

                    $fileupload = $this->fileUploadService->upload($file, 'public');
            
                    $fileuploadData = $fileupload->getData();

                    if(isset($fileuploadData) && $fileuploadData->status == '200'){
                        $document_field = new DocumentsField;
                        $document_field->document_id = $document->id;
                        $document_field->heading = $img_heading;
                        $document_field->description = $img_description;
                        $document_field->media_id = $fileuploadData->id;
                        $document_field->save();
            
                    }elseif($fileuploadData->status == '400') {
                        DB::rollBack();
                        return redirect()->back()->with('error', $fileuploadData->error);
                    }
                }
            }

            if($request->hasFile('new_upload_image')){
                $upload_image = $request->file('new_upload_image');
                for($i=0; $i<count($upload_image); $i++){
                    $file = $upload_image[$i];

                    if($request->has('new_img_heading')){
                        $img_heading = $request->img_heading[$i];
                    }

                    if($request->has('new_img_description')){
                        $img_description = $request->img_description[$i];
                    }

                    $fileupload = $this->fileUploadService->upload($file, 'public');
            
                    $fileuploadData = $fileupload->getData();

                    if(isset($fileuploadData) && $fileuploadData->status == '200'){
                        $document_field = new DocumentsField;
                        $document_field->document_id = $document->id;
                        $document_field->heading = $img_heading;
                        $document_field->description = $img_description;
                        $document_field->media_id = $fileuploadData->id;
                        $document_field->save();
            
                    }elseif($fileuploadData->status == '400') {
                        DB::rollBack();
                        return redirect()->back()->with('error', $fileuploadData->error);
                    }
                }
            }

            $document->guide_main_heading = $request->guide_heading;

            if($request->has('new_step_title') && $request->has('new_step_description')){
                $step_title = $request->new_step_title;
                for($i=0; $i<count($step_title); $i++){
                    $title_steps = $step_title[$i];
                    $description = $request->new_step_description[$i];

                    $document_guide = new DocumentGuide;
                    $document_guide->document_id = $document->id;                   
                    $document_guide->step_title = $title_steps; 
                    $document_guide->step_description = $description; 
                    $document_guide->save();
                }
            }
            
            $document->category_id = json_encode($request->category_id);
            $document->legal_heading = $request->legal_heading;
            $document->legal_description = $request->legal_description;
            $document->legal_btn_text = $request->legal_btn_text;
            $document->legal_btn_link = $request->legal_btn_link;
            $document->approved = $request->approved;
            $document->valid_in = $request->valid_in;
            $document->faq_heading = $request->faq_heading;

            if($request->has('new_doc_question') && $request->has('new_doc_answer')){
                $doc_question = $request->new_doc_question;
                for($i=0; $i<count($doc_question); $i++){
                    $quiz = $doc_question[$i];
                    $answer = $request->new_doc_answer[$i];

                    $document_faq = new DocumentFaq;
                    $document_faq->document_id = $document->id;                   
                    $document_faq->question = $quiz; 
                    $document_faq->answer = $answer; 
                    $document_faq->save();
                }
            }

            $document->related_heading = $request->related_heading;
            $document->related_description = $request->related_description;

            if($request->has('select_related_doc')){
                $related_doc = $request->select_related_doc;
                for($i=0; $i<count($request->select_related_doc); $i++){
                    $related_document_id = $related_doc[$i];
                    $related_document = new DocumentRelated;
                    $related_document->document_id = $document->id;
                    $related_document->related_document_id = $related_document_id;
                    $related_document->save();
                }
            }

            if($request->hasFile('legal_doc_image')){
                $legal_image = $request->file('legal_doc_image');
                $imagename = time().rand(1,50).'.'.$legal_image->extension();
                $directory = 'public';
                $path = $legal_image->storeAs($directory, $imagename);

                $document->legal_doc_image = $imagename;
                $document->directory_name = $directory;
                $document->file_path = $path;
            }
            
            $document->additional_info = $request->additional_info;
            $document->doc_price = $request->doc_price;
            $document->no_of_downloads = $request->no_of_downloads;
            $document->total_likes = $request->total_likes;
            $document->discount_price = $request->discount_price;

            $document->save();
            DB::commit(); 

            return redirect()->back()->with('success','Data Successfully saved');
        }catch(Exception $e){
            DB::rollBack();
            saveLog("Error:", "DocumentController", $e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong. Please try again.');
        }
    }

    public function allDocuments(){
        $documents = Document::all();
        return view('admin.documents.all_documents',compact('documents'));
    }

    public function editDocument($slug){
        $document = Document::where('slug',$slug)->with('documentFaq','documentGuide','documentField.media','relatedDocuments')->first();
        $categories  = DocumentCategory::all();
        $related_documents = Document::all();

        return view('admin.documents.document',compact('categories','document','related_documents'));
    }

    public function updateDocument(Request $request){
        // return $request->all();

        DB::beginTransaction(); 
        try{
            $document = Document::find($request->id);
            $document->title = $request->title;
            $document->slug = $request->slug;
            $document->short_description = $request->short_description;
            $document->btn_text = $request->document_button_text;
            $document->long_description = $request->long_description;

            if($request->hasFile('new_upload_image')){
                $upload_image = $request->file('new_upload_image');
                for($i=0; $i<count($upload_image); $i++){
                    $file = $upload_image[$i];

                    if($request->has('new_img_heading')){
                        $img_heading = $request->new_img_heading[$i];
                    }

                    if($request->has('new_img_description')){
                        $img_description = $request->new_img_description[$i];
                    }

                    $fileupload = $this->fileUploadService->upload($file, 'public');
            
                    $fileuploadData = $fileupload->getData();

                    if(isset($fileuploadData) && $fileuploadData->status == '200'){
                        $document_field = new DocumentsField;
                        $document_field->document_id = $request->id;
                        $document_field->heading = $img_heading;
                        $document_field->description = $img_description;
                        $document_field->media_id = $fileuploadData->id;
                        $document_field->save();
            
                    }elseif($fileuploadData->status == '400') {
                        DB::rollBack();
                        return redirect()->back()->with('error', $fileuploadData->error);
                    }
                }
            }

            if($request->has('img_heading')){
                $imgHeading = $request->img_heading;
                foreach($imgHeading as $key=>$val){
                    $document_field = DocumentsField::find($key);
                    $document_field->heading = $val;
                    $document_field->update();
                }

                $imgDescription = $request->img_description;
                foreach($imgDescription as $index=>$value){
                    $document_field = DocumentsField::find($index);
                    $document_field->description = $value;
                    $document_field->update();
                }
            }

            $document->guide_main_heading = $request->guide_heading;

            if($request->has('new_step_title')){
                $step_title = $request->new_step_title;
                for($i=0; $i<count($step_title); $i++){
                    $title_steps = $step_title[$i];

                    if($request->has('new_step_description')){
                        $description = $request->new_step_description[$i];
                    }
                
                    $document_guide = new DocumentGuide;
                    $document_guide->document_id = $request->id;                   
                    $document_guide->step_title = $title_steps; 
                    $document_guide->step_description = $description; 
                    $document_guide->save();
                }
            }

            if($request->has('step_title')){
                foreach($request->step_title as $key=>$val){
                    $document_guide = DocumentGuide::find($key);
                    $document_guide->step_title = $val; 
                    $document_guide->update();
                }

                foreach($request->step_description as $index=>$value){
                    $document_guide = DocumentGuide::find($key);
                    $document_guide->step_description = $value; 
                    $document_guide->update();
                }
            }

            $document->category_id = json_encode($request->category_id);
            $document->legal_heading = $request->legal_heading;
            $document->legal_description = $request->legal_description;
            $document->legal_btn_text = $request->legal_btn_text;
            $document->legal_btn_link = $request->legal_btn_link;

            if($request->hasFile('legal_doc_image')){
                $legal_image = $request->file('legal_doc_image');
                $imagename = time().rand(1,50).'.'.$legal_image->extension();
                $directory = 'public';
                $path = $legal_image->storeAs($directory, $imagename);

                $document->legal_doc_image = $imagename;
                $document->directory_name = $directory;
                $document->file_path = $path;
            }

            $document->approved = $request->approved;
            $document->valid_in = $request->valid_in;
            $document->faq_heading = $request->faq_heading;

            if($request->has('new_doc_question') && $request->has('new_doc_answer')){
                $doc_question = $request->new_doc_question;
                for($i=0; $i<count($doc_question); $i++){
                    $quiz = $doc_question[$i];
                    $answer = $request->new_doc_answer[$i];

                    $document_faq = new DocumentFaq;
                    $document_faq->document_id = $request->id;                   
                    $document_faq->question = $quiz; 
                    $document_faq->answer = $answer; 
                    $document_faq->save();
                }
            }

            if($request->has('doc_question')){
                foreach($request->doc_question as $key=>$val){
                    $document_faq = DocumentFaq::find($key);                 
                    $document_faq->question = $val; 
                    $document_faq->update();
                }

                foreach($request->doc_answer as $index=>$value){
                    $document_faq = DocumentFaq::find($index);                 
                    $document_faq->answer = $value; 
                    $document_faq->update();
                }
            }

            $document->related_heading = $request->related_heading;
            $document->related_description = $request->related_description;

            if($request->has('select_related_doc')){
                $related_doc = $request->select_related_doc;
                for($i=0; $i<count($request->select_related_doc); $i++){
                    $related_document_id = $related_doc[$i];
                    $related_document = new DocumentRelated;
                    $related_document->document_id = $request->id;
                    $related_document->related_document_id = $related_document_id;
                    $related_document->save();  
                }
            }

            $document->additional_info = $request->additional_info;
            $document->doc_price = $request->doc_price;
            $document->no_of_downloads = $request->no_of_downloads;
            $document->total_likes = $request->total_likes;
            $document->discount_price = $request->discount_price;
           
            if($request->img_sec_ids != null){
                $removeIds = explode(',', $request->img_sec_ids);
                $removeDocumentFields = DocumentsField::whereIn('id',$removeIds)->delete();
            }

            if($request->guide_sec_ids != null){
                $removeIds = explode(',', $request->guide_sec_ids);
                $removeGuideSection = DocumentGuide::whereIn('id',$removeIds)->delete();
            }

            if($request->faq_sec_ids != null){
                $removeIds = explode(',', $request->faq_sec_ids);
                $removeFaqSection = DocumentFaq::whereIn('id',$removeIds)->delete();
            }

            $document->update();

            DB::commit();

            return redirect('admin-dashboard/edit-document/'.$request->slug)->with('success','Document Updated');

        }catch(Exception $e){
            DB::rollBack();
            saveLog("Error:", "DocumentController", $e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong. Please try again.');
        }
    }

    public function addDocumentCategory(){
        $parent_category = DocumentCategory::all();
        return view('admin.documents.add_document_category',compact('parent_category'));
    }

    public function categoryProcess(Request $request){
        try{
            if($request->id != null){
                $document_category = DocumentCategory::find($request->id);
                $status = 'updated';
            }else{
                $document_category = new DocumentCategory;
                $status = 'saved';
            }
            $document_category->name = $request->name;
            $document_category->slug = $request->slug;
            $document_category->parent_category = $request->parent_category;
            $document_category->description = $request->description;
            $document_category->save();

            if($status == 'updated'){
                return redirect()->back()->with('success','Data Successfully updated');
            }elseif($status == 'saved'){
                return redirect()->back()->with('success','Data Successfully saved');
            }
            
        }catch(Exception $e){
            saveLog("Error:", "DocumentController", $e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong. Please try again.');
        }
    }

    public function allCategories(){
        $categories = DocumentCategory::all();
        return view('admin.documents.categories',compact('categories'));
    }

    public function editCategory($slug){
        $category =  DocumentCategory::where('slug',$slug)->first();
        $parent_category = DocumentCategory::where('slug', '!=', $slug)->get();
        return view('admin.documents.add_document_category',compact('category','parent_category'));
    }

    public function reviews(){
        $documents = Document::all();
        return view('admin.reviews.review',compact('documents'));
    }

    public function addReview(Request $request){
        try{
            $review = new Review;
            if($request->hasFile('profile')){
                $file = $request->profile;
                $fileupload = $this->fileUploadService->upload($file, 'public');
                $fileuploadData = $fileupload->getData();

                if(isset($fileuploadData) && $fileuploadData->status == '200'){
                    $review->media_id = $fileuploadData->id;
                }elseif($fileuploadData->status == '400') {
                    return redirect()->back()->with('error', $fileuploadData->error);
                }
            }

            $review->document_id = $request->document;
            $review->rating = $request->rating;
            $review->first_name = $request->first_name;
            $review->last_name = $request->last_name;
            $review->city = $request->city_name;
            $review->date = $request->date;
            $review->description = $request->description;
            $review->save();

            return redirect()->back()->with('success', 'Review added.');
        }catch(Exception $e){
            saveLog("Error:", "DocumentController", $e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong. Please try again.');
        }
    }

    public function allreview(){
        $reviews = Review::all();
        return view('admin.reviews.all_reviews',compact('reviews'));
    }
}
