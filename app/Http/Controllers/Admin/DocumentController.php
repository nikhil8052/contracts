<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\DocumentFormRequest;
use App\Models\DocumentCategory;
use App\Models\Document;
use App\Models\DocumentFaq;
use App\Models\DocumentGuide;
use App\Models\DocumentsField;
use App\Models\DocumentRelated;
use App\Models\Review;
use App\Models\DocumentAgreement;
use App\Models\DocumentWithCategory;
use App\Models\Media;
use App\Models\Question;
use App\Models\QuestionType;
use App\Models\DocumentRightSection;
use App\Models\RightSectionCondition;
use App\Models\QuestionCondition;
use App\Models\QuestionData;
use App\Models\MultipleChoiceQuestionOption;
use App\Models\GeneralSection;
use Illuminate\Support\Str;
use App\Services\FileUploadService;
use Illuminate\Support\Facades\DB;
use Exception;
use File;

class DocumentController extends Controller
{
    protected $fileUploadService;

    public function __construct(FileUploadService $fileUploadService){
        $this->fileUploadService = $fileUploadService;
    }

    public function documents(){
        $categories  = DocumentCategory::all();
        $related_documents = Document::where('published',1)->get();
        $reviews = Document::with('reviews')->get();
        return view('admin.documents.document',compact('categories','related_documents','reviews'));
    }

    public function addDocuments(DocumentFormRequest $request){     
        DB::beginTransaction(); 
        try{
            $document = new Document;
            $document->title = $request->title;
            $document->slug = $request->slug;
            $document->save();

            if($request->hasFile('document_image')){
                $document_image = $request->file('document_image');
                $image_id = $document->id;
                $timestamp = now()->timestamp;
                $directory = "public/document_images/{$image_id}_{$timestamp}";
                $imagename = generateFileName($document_image);
                $path = $document_image->storeAs($directory, $imagename);

                $document->document_image = $imagename;
                $document->document_directory_name = $directory;
                $document->document_file_path = $path;
            }

            $document->short_description = $request->short_description;
            $document->btn_text = $request->document_button_text;
            $document->long_description = $request->long_description;
            
            if($request->hasFile('field_image') != null && $request->has('img_heading') != null && $request->has('img_description') != null && $request->has('img_description_second') != null){
                for($i=0; $i<count($request->img_heading); $i++){
                    $file = $request->field_image[$i];
                    $img_headings = $request->img_heading[$i];
                    $img_descriptions = $request->img_description[$i];
                    $img_descriptions2 = $request->img_description_second[$i];

                    $directory = "public/document_images";
                    $fileupload = $this->fileUploadService->upload($file, $directory);
                    $fileuploadData = $fileupload->getData();

                    if(isset($fileuploadData) && $fileuploadData->status == '200'){
                        $document_field = new DocumentsField;
                        $document_field->document_id = $document->id;
                        $document_field->heading = $img_headings;
                        $document_field->description = $img_descriptions; 
                        $document_field->description2 = $img_descriptions2;
                        $document_field->media_id = $fileuploadData->id;
                        $document_field->save(); 
            
                    }elseif($fileuploadData->status == '400') {
                        DB::rollBack();
                        return redirect()->back()->with('error', $fileuploadData->error);
                    }
                }
            }

            if($request->hasFile('new_field_image') != null && $request->has('new_img_heading') != null && $request->has('new_img_description') != null && $request->has('new_img_description_second') != null){
                for($i=0; $i<count($request->new_img_heading); $i++){
                    $file = $request->new_field_image[$i];
                    $img_headings = $request->new_img_heading[$i];
                    $img_descriptions = $request->new_img_description[$i];
                    $img_descriptions2 = $request->new_img_description_second[$i];

                    $directory = "public/document_images";
                    $fileupload = $this->fileUploadService->upload($file, $directory);
                    $fileuploadData = $fileupload->getData();

                    if(isset($fileuploadData) && $fileuploadData->status == '200'){
                        $document_field = new DocumentsField;
                        $document_field->document_id = $document->id;
                        $document_field->heading = $img_headings;
                        $document_field->description = $img_descriptions; 
                        $document_field->description2 = $img_descriptions2;
                        $document_field->media_id = $fileuploadData->id;
                        $document_field->save(); 
            
                    }elseif($fileuploadData->status == '400') {
                        DB::rollBack();
                        return redirect()->back()->with('error', $fileuploadData->error);
                    }
                    
                }
            }

            $document->legal_heading = $request->legal_heading;
            $document->legal_description = $request->legal_description;
            $document->legal_btn_text = $request->legal_btn_text;

            if($request->hasFile('legal_doc_image')){
                $legal_image = $request->file('legal_doc_image');
                $directory = "public/document_images";
                $imagename = generateFileName($legal_image);
                $path = $legal_image->storeAs($directory, $imagename);

                $document->legal_doc_image = $imagename;
                $document->directory_name = $directory;
                $document->file_path = $path;
            }

            $document->published = $request->published;

            if($request->has('select_related_doc')){
                $related_doc = $request->select_related_doc;
                $current_related_docs = DocumentRelated::where('document_id', $document->id)->pluck('related_document_id')->toArray();
                $docs_to_delete = array_diff($current_related_docs, $related_doc);

                DocumentRelated::where('document_id', $document->id)
                ->whereIn('related_document_id', $docs_to_delete)
                ->delete();

                for ($i = 0; $i < count($related_doc); $i++) {
                    $related_document_id = $related_doc[$i];
            
                    if (!in_array($related_document_id, $current_related_docs)) {
                        $related_document = new DocumentRelated;
                        $related_document->document_id = $document->id;
                        $related_document->related_document_id = $related_document_id;
                        $related_document->save();
                    }
                }
            }


            $document->doc_price = $request->doc_price;

            if($request->has('category_id')){
                for($i=0; $i<count($request->category_id); $i++){
                    $category_id = $request->category_id[$i];

                    $document_with_category = new DocumentWithCategory;
                    $document_with_category->document_id = $document->id;
                    $document_with_category->category_id = $category_id;
                    $document_with_category->save();
                }
            }

            $document->meta_title = $request->meta_title;
            $document->meta_description = $request->meta_description;
            $document->status = 0;
            $document->save();
            DB::commit(); 

            return redirect()->back()->with('success','Document Added Successfully.');

        }catch(Exception $e){
            saveLog("Error:", "DocumentController", $e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong. Please try again.');
        }
    }


    public function allDocuments(){
        $documents = Document::where('published',1)->get();
        return view('admin.documents.all_documents',compact('documents'));
    }

    public function editDocument($slug){
        $document = Document::where('slug',$slug)->with('documentAgreement','documentGuide','documentField.media','relatedDocuments')->first();
        $categories  = DocumentCategory::all();
        $related_documents = Document::where('published',1)->get();
        $reviews = Document::with('reviews')->get();
        return view('admin.documents.document',compact('categories','document','related_documents','reviews'));
    }

    public function updateDocument(Request $request){
        // return $request->all();
        DB::beginTransaction(); 
        try{
            $document = Document::where('id',$request->id)->first();
            $document->title = $request->title;
            $document->slug = $request->slug;
            $document->short_description = $request->short_description;
            $document->btn_text = $request->document_button_text;
            $document->long_description = $request->long_description;
            $document->legal_heading = $request->legal_heading;
            $document->legal_description = $request->legal_description;
            $document->legal_btn_text = $request->legal_btn_text;
            $document->published = $request->published;
            $document->doc_price = $request->doc_price;
            $document->meta_title = $request->meta_title;
            $document->meta_description = $request->meta_description;
            $document->update();
            
            if($request->hasFile('document_image')){
                $document_image = $request->file('document_image');
                $image_id = $request->id;
                $timestamp = now()->timestamp;
                $directory = "public/document_images/{$image_id}_{$timestamp}";
                $imagename = generateFileName($document_image);
                $path = $document_image->storeAs($directory, $imagename);

                $document->document_image = $imagename;
                $document->document_directory_name = $directory;
                $document->document_file_path = $path;
            }
            
            if($request->has('img_heading') != null){
                foreach($request->img_heading as $index=>$value){
                    $document_field = DocumentsField::find($index);
                    $document_field->heading = $value;
                    $document_field->update(); 
                }
            }

            if($request->has('img_description') != null){
                foreach($request->img_description as $key=>$val){
                    $document_field = DocumentsField::find($key);
                    $document_field->description = $val; 
                    $document_field->update(); 
                }
            }

            if($request->has('img_description_second') != null){
                foreach($request->img_description_second as $index=>$value){
                    $document_field = DocumentsField::find($index);
                    $document_field->description2 = $value; 
                    $document_field->update(); 
                }
            }

            if($request->hasFile('new_field_image') != null && $request->has('new_img_heading') != null && $request->has('new_img_description') != null && $request->has('new_img_description_second') != null){
                for($i=0; $i<count($request->new_img_heading); $i++){
                    $file = $request->new_field_image[$i];
                    $img_headings = $request->new_img_heading[$i];
                    $img_descriptions = $request->new_img_description[$i];
                    $img_descriptions2 = $request->new_img_description_second[$i];

                    $directory = "public/document_images";
                    $fileupload = $this->fileUploadService->upload($file, $directory);
                    $fileuploadData = $fileupload->getData();

                    if(isset($fileuploadData) && $fileuploadData->status == '200'){
                        $document_field = new DocumentsField;
                        $document_field->document_id = $request->id;
                        $document_field->heading = $img_headings;
                        $document_field->description = $img_descriptions; 
                        $document_field->description2 = $img_descriptions2;
                        $document_field->media_id = $fileuploadData->id;
                        $document_field->save(); 
            
                    }elseif($fileuploadData->status == '400') {
                        DB::rollBack();
                        return redirect()->back()->with('error', $fileuploadData->error);
                    }
                    
                }
            }

            if($request->hasFile('legal_doc_image')){
                $legal_image = $request->file('legal_doc_image');
                $directory = "public/document_images";
                $imagename = generateFileName($legal_image);
                $path = $legal_image->storeAs($directory, $imagename);

                $document->legal_doc_image = $imagename;
                $document->directory_name = $directory;
                $document->file_path = $path;
            }

            if($request->has('select_related_doc')){
                $related_doc = $request->select_related_doc;
                $current_related_docs = DocumentRelated::where('document_id', $document->id)->pluck('related_document_id')->toArray();
                $docs_to_delete = array_diff($current_related_docs, $related_doc);

                DocumentRelated::where('document_id', $document->id)
                ->whereIn('related_document_id', $docs_to_delete)
                ->delete();

                for($i = 0; $i < count($related_doc); $i++){
                    $related_document_id = $related_doc[$i];
            
                    if(!in_array($related_document_id, $current_related_docs)) {
                        $related_document = new DocumentRelated;
                        $related_document->document_id = $request->id;
                        $related_document->related_document_id = $related_document_id;
                        $related_document->save();
                    }
                }
            }

            if($request->has('category_id')) {
                $document = Document::find($request->id);
                $categoryIds = $request->category_id;
                $document->categories()->sync($categoryIds);
            }
            
            if($request->field_img_id != null){
                $deleteIds = explode(',', $request->field_img_id);
                foreach($deleteIds as $id){
                    $document_field = DocumentsField::where('id',$id)->with('media')->first();
                    if($document_field->media){
                        $image_path = getFilePath($document_field->media->file_path);
                        if(File::exists($image_path)) {
                            $directory_path = dirname($image_path);
                            unlink($image_path);
                            if(is_dir($directory_path) && count(scandir($directory_path)) == 2){
                                rmdir($directory_path);
                            }
                        }
                        Media::where('id',$document_field->media_id)->delete();
                        $document_field->media_id = null;
                        $document_field->update();
                    }
                }
            }
            
            // if($request->ag_img_id != null){
            //     $deleteIds = explode(',', $request->ag_img_id);
            //     foreach($deleteIds as $id){
            //         $document_agreement = DocumentAgreement::where('id',$id)->with('media')->first();
            //         if($document_agreement->media){
            //             $image_path = getFilePath($document_agreement->media->file_path);
            //             if(File::exists($image_path)) {
            //                 $directory_path = dirname($image_path);
            //                 unlink($image_path);
            //                 if(is_dir($directory_path) && count(scandir($directory_path)) == 2){
            //                     rmdir($directory_path);
            //                 }
            //             }
            //             Media::where('id',$document_agreement->media_id)->delete();
            //             $document_agreement->media_id = null;
            //             $document_agreement->update();
            //         }
            //     }
            // }
                        
            if($request->img_sec_ids != null){
                $removeIds = explode(',', $request->img_sec_ids);
                foreach($removeIds as $id){
                    $removeDocumentFields = DocumentsField::where('id',$id)->with('media')->first();
                    if($removeDocumentFields->media){
                        $image_path = getFilePath($removeDocumentFields->media->file_path);
                        if(File::exists($image_path)) {
                            $directory_path = dirname($image_path);
                            unlink($image_path);
                            if(is_dir($directory_path) && count(scandir($directory_path)) == 2){
                                rmdir($directory_path);
                            }
                        }
                        Media::where('id',$removeDocumentFields->media_id)->delete();
                    }
                    $removeDocumentFields->delete();
                }
            }
            
            DB::commit(); 

            return redirect('/admin-dashboard/edit-document/'.$document->slug)->with('success','Document Successfully Updated.');

        }catch(Exception $e){
            DB::rollBack();
            saveLog("Error:", "DocumentController", $e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong. Please try again.');
        }
    }

    public function updateFieldImage(Request $request){
        if($request->id != null){
            $id = $request->id;
            if($request->hasFile('field_image')) {
                $file = $request->file('field_image');
                $directory = "public/document_images";
                $fileupload = $this->fileUploadService->upload($file, $directory);
                $fileuploadData = $fileupload->getData();

                $document_field = DocumentsField::find($id);
                if(isset($fileuploadData) && $fileuploadData->status == '200'){
                    $document_field->media_id = $fileuploadData->id;
                    $document_field->update();
    
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

    public function generalSection(){
        $keys = [
            'guide_heading',
            'guide_button',
            'valid_in',
            'related_heading',
            'related_description',
        ];

        $results = GeneralSection::whereIn('key', $keys)->get()->keyBy('key');
        $data = [
            'guide_heading' => $results['guide_heading']->value ?? null,
            'guide_button' => $results['guide_button']->value ?? null,
            'valid_in' => $results['valid_in']->value ?? null,
            'related_heading' => $results['related_heading']->value ?? null,
            'related_description' => $results['related_description']->value ?? null,
        ];

        $agreements = GeneralSection::where('key','agreement')->with('media')->get();
        $guides = GeneralSection::where('key','guide_section')->get();

        return view('admin.documents.general_section',compact('data','agreements','guides'));
    }

    public function addGeneralSection(Request $request){
        DB::beginTransaction(); 
        try{
            if($request->hasFile('agreement_image') != null && $request->has('agreement_heading') != null && $request->has('agreement_description') != null){
                $agreement_image = $request->file('agreement_image');
                for($i=0; $i<count($agreement_image); $i++){
                    $file = $agreement_image[$i];
                    $agreement_heading = $request->agreement_heading[$i];
                    $agreement_description = $request->agreement_description[$i];

                    $directory = "public/general_section_images";
                    $fileupload = $this->fileUploadService->upload($file, $directory);
                    $fileuploadData = $fileupload->getData();

                    if(isset($fileuploadData) && $fileuploadData->status == '200'){
                        $general_section = new GeneralSection;
                        $general_section->key = 'agreement';
                        $general_section->media_id = $fileuploadData->id;
                        $general_section->heading = $agreement_heading;
                        $general_section->description = $agreement_description;
                        $general_section->save();
            
                    }elseif($fileuploadData->status == '400') {
                        DB::rollBack();
                        return redirect()->back()->with('error', $fileuploadData->error);
                    }
                }
            }

            if($request->has('new_agreement_heading') != null){
                foreach($request->new_agreement_heading as $key=>$val){
                    $general_section = GeneralSection::find($key);
                    $general_section->heading = $val;
                    $general_section->update();
                }
            }

            if($request->has('new_agreement_description') != null){
                foreach($request->new_agreement_description as $index=>$value){
                    $general_section = GeneralSection::find($index);
                    $general_section->description = $value;
                    $general_section->update();
                }
            }

            if($request->has('step_title') != null && $request->has('step_description') != null){
                $step_title = $request->step_title;
                for($i=0; $i<count($step_title); $i++){
                    $title_steps = $step_title[$i];
                    $description = $request->step_description[$i];

                    $general_section = new GeneralSection;
                    $general_section->key = 'guide_section';                   
                    $general_section->heading = $title_steps; 
                    $general_section->description = $description; 
                    $general_section->save();
                }
            }

            if($request->has('new_step_title') != null){
                foreach($request->new_step_title as $key=>$val){
                    $general_section = GeneralSection::find($key);                  
                    $general_section->heading = $val; 
                    $general_section->update();
                }
            }

            if($request->has('new_step_description') != null){
                foreach($request->new_step_description as $key=>$val){
                    $general_section = GeneralSection::find($key);                   
                    $general_section->description = $val; 
                    $general_section->update();
                }
            }

            $fields = [
                'guide_heading' => 'guide_heading',
                'guide_button' => 'guide_button',
                'valid_in' => 'valid_in',
                'related_heading' => 'related_heading',
                'related_description' => 'related_description',
            ];
            
            foreach($fields as $key=>$input){
                if($request->has($input)) {
                    $general_section = GeneralSection::where('key', $key)->first();
                    if($general_section){
                        $general_section->value = $request->$input;
                        $general_section->update();
                    }
                }
            }

            DB::commit(); 
            return redirect()->back()->with('success','Data Updated Successfully.');
            
        }catch(Exception $e){
            DB::rollBack();
            saveLog("Error:", "DocumentController", $e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong. Please try again.');
        }
       
    }

    public function updateAgreementImage(Request $request){
        if($request->id != null){
            $id = $request->id;
            if($request->hasFile('image')) {
                $file = $request->file('image');
                $directory = "public/general_section_images";
                $fileupload = $this->fileUploadService->upload($file, $directory);
                $fileuploadData = $fileupload->getData();

                $document_agreement = DocumentAgreement::find($id);
                if(isset($fileuploadData) && $fileuploadData->status == '200'){
                    $document_agreement->media_id = $fileuploadData->id;
                    $document_agreement->update();
    
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

    public function addDocumentCategory(){
        $parent_category = DocumentCategory::all();
        return view('admin.documents.add_document_category',compact('parent_category'));
    }

    public function categoryProcess(Request $request){
        try{
            if($request->id != null){
                $request->validate([
                    'name' => 'required',
                    'slug' => 'required',
                ]);
                $document_category = DocumentCategory::find($request->id);
                $status = 'updated';
            }else{
                $request->validate([
                    'name' => 'required',
                    'slug' => 'required|unique:document_categories,slug',
                ]);
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
            if($request->id != null){
                $review = Review::find($request->id);
                $review->document_id = $request->document;
                $review->rating = $request->rating;
                $review->first_name = $request->first_name;
                $review->last_name = $request->last_name;
                $review->city = $request->city_name;
                $review->date = $request->date;
                $review->description = $request->description;
                $review->update();
                
                return redirect()->back()->with('success', 'Review updated.');
            }else{ 
                $review = new Review;
                $review->document_id = $request->document;
                $review->rating = $request->rating;
                $review->first_name = $request->first_name;
                $review->last_name = $request->last_name;
                $review->city = $request->city_name;
                $review->date = $request->date;
                $review->description = $request->description;
                $review->type = 'custom';
                $review->status = 0;
                $review->save();

                return redirect()->back()->with('success', 'Review added.');
            }
            
        }catch(Exception $e){
            saveLog("Error:", "DocumentController", $e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong. Please try again.');
        }
    }

    public function publishedReview(){
        $reviews = Review::where('status',1)->get();
        return view('admin.reviews.all_reviews',compact('reviews'));
    }

    public function editReview($id){
        $documents = Document::all();
        $review = Review::find($id);
        return view('admin.reviews.review',compact('documents','review'));
    }

    public function deleteReview(Request $request){
        if($request->id != null){
            $review = Review::where('id',$request->id)->delete();
            $response = ([
                'code' => 200,
                'satus' => 'success',
            ]);

            return response()->json($response);
        }
    }

    public function reviewStatus(Request $request){
        if($request->value == 'unpublish'){
            $review = Review::find($request->id);
            $review->status = 0;
            $review->update();

            $response = ([
                'code' => 200,
                'status' => 'unpublish',
            ]);
    
        }elseif($request->value == 'approve'){
            $review = Review::find($request->id);
            $review->status = 1;
            $review->update();

            $response = ([
                'code' => 200,
                'status' => 'approve',
            ]);
    
        }

        return response()->json($response);
    }

    public function pendingReviews(){
        $reviews = Review::where('status',0)->get();
        return view('admin.reviews.pending_reviews',compact('reviews'));
    }

    public function rejectReviews(Request $request){
        if($request->id != null){
            $review = Review::find($request->id);
            $review->status = 3;
            $review->update();

            $response = ([
                'code' => 200,
                'satus' => 'success',
            ]);

            return response()->json($response);
        }
    }

    public function allQuestion(){
        return view('admin.documents.all_document_question');
    }

    public function documentQuestion(){
        $documents = Document::where('published',1)->get();

        $types = QuestionType::all();
        $questions = Question::all();
        if(isset($_GET['id']) && $_GET['id'] != null){
            $document = Document::find($_GET['id']);
            $document_questions = Question::where('document_id',$_GET['id'])->with('questionData','conditions','options','nextQuestion')->get();
        }else{
            $document = '';
            $document_questions = '';
        }
      
        return view('admin.documents.document_questions',compact('documents','types','questions','document_questions','document'));
    }

    public function allquestionType(){
        $question_types = QuestionType::all();
        return view('admin.documents.all_types',compact('question_types'));
    }

    public function questionType(){
        return view('admin.documents.question_types');
    }

    public function addTypes(Request $request){
        try{
            if($request->id != null){
                $question_type = QuestionType::find($request->id);
                $status = 'updated';
            }else{
                $request->validate([
                    'name' => 'required',
                    'slug' => 'required|unique:question_types,slug',
                ]);

                $question_type = new QuestionType;
                $status = 'saved';
            }
            
            $question_type->name = $request->name;
            $question_type->slug = $request->slug;
            $question_type->save();

            if($status == 'updated'){
                return redirect('/admin-dashboard/edit-question-type/'.$question_type->slug)->with('success','Data Successfully updated');
            }elseif($status == 'saved'){
                return redirect()->back()->with('success','Data Successfully saved');
            }

        }catch(Exception $e){
            saveLog("Error:", "DocumentController", $e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong. Please try again.');
        }
    }

    public function editQuestionType($slug){
        $question_type = QuestionType::where('slug',$slug)->first();
        return view('admin.documents.question_types',compact('question_type'));
    }

    public function addDocumentQuestion(Request $request){
        // return $request->all();
        // die();

        DB::beginTransaction(); 
        try{
            if(isset($request->formdata) && $request->formdata != null){
                $formData = json_decode($request->formdata);
                foreach($formData as $data){    
                    if($data->is_new == true){
                        $questions = new Question;
                        $questions->document_id = $request->document_id;
                        $questions->type = $data->type;

                        if(isset($data->is_conditional_question) && $data->is_conditional_question != null || isset($data->is_conditional_step) && $data->is_conditional_step != null){
                            if($data->is_conditional_question == 1){
                                $is_condition = 1;
                                $condition_type = 1;
                            }elseif($data->is_conditional_step == 1){
                                $is_condition = 1;
                                $condition_type = 2;
                            }elseif($data->is_conditional_question == 1 && $data->is_conditional_step == 1){
                                $is_condition = 1;
                                $condition_type = 3;
                            }
                        }else{
                            $is_condition = 0;
                            $condition_type = null;
                        }
                        
                        $questions->is_condition = $is_condition;
                        $questions->condition_type = $condition_type;
                        $questions->save();

                        $question_data = new QuestionData;
                        $question_data->question_id = $questions->id;
                        $question_data->question_label = $data->question_label;

                        // if(isset($data->text_box_id) && $data->text_box_id != null){
                        //     if($data->type == "dropdown" && $data->type == "radio"){
                        //         $question_data->textbox_id = $data->question_id;
                        //     }elseif($data->type == "datefield"){
                        //         $question_data->textbox_id = $data->date_field_Id;
                        //     }elseif($data->type == "dropdownlink"){
                        //         $question_data->textbox_id = null;
                        //     }else{
                        //         $question_data->textbox_id = $data->text_box_id;
                        //     }
                        // }

                        if(isset($data->text_box_placeholder) && $data->text_box_placeholder != null){
                            $question_data->text_box_placeholder = $data->text_box_placeholder;
                        }
                        
                        if($data->type == "dropdown-link"){
                            $question_data->same_contract_link_label = $data->same_contract_link;
                        }
                       
                        if(isset($data->go_to_step) && $data->go_to_step != null){
                            $question_data->next_question_id = $data->go_to_step;
                        }
                        
                        if(isset($request->is_end) && $request->is_end != null){
                            $question_data->is_end = $request->is_end;
                        }else{
                            $question_data->is_end = 0;
                        }
                        
                        if($condition_type == 1){
                            $question_condition_type = "question_label_condition";
                            $conditional_question_labels = $data->conditional_question_labels;
                            for($i=0; $i<count($conditional_question_labels); $i++){
                                $conditional = $conditional_question_labels[$i];

                                $question_conditions = new QuestionCondition;
                                $question_conditions->question_id = $questions->id;
                                $question_conditions->condition_type = $question_condition_type;
                                $question_conditions->question_label = $conditional->label;
                                $question_conditions->conditional_question_id = $conditional->questionID;
                                $question_conditions->conditional_question_value = $conditional->question_value;
                                $question_conditions->save();
                            }
                        }elseif($condition_type == 2){
                            $question_condition_type = "go_to_step_condition";
                            $step_conditions = $data->conditions;
                            for($i=0; $i<count($step_conditions); $i++){
                                $step = $step_conditions[$i];
                                
                                $question_conditions = new QuestionCondition;
                                $question_conditions->question_id = $questions->id;
                                $question_conditions->condition_type = $question_condition_type;

                                if(isset($step->question_condition) && $step->question_condition != null){
                                    if($step->question_condition == "is equal to"){
                                        $conditionCheck = 1;
                                    }elseif($step->question_condition == "is greater than"){
                                        $conditionCheck = 2;
                                    }elseif($step->question_condition == "is less than"){
                                        $conditionCheck = 3;
                                    }elseif($step->question_condition == "not equal to"){
                                        $conditionCheck = 4;
                                    }
                                }

                                $question_conditions->conditional_check = $conditionCheck;
                                $question_conditions->conditional_question_id = $step->questionID;
                                $question_conditions->conditional_question_value = $step->question_value;
                                $question_conditions->save();
                            }
                        }

                        if(isset($data->add_options) && $data->add_options != null){
                            $order = 1;
                            for($i=0; $i<count($data->add_options); $i++){
                                $option = $data->add_options[$i];
                                $multiple_options = new MultipleChoiceQuestionOption;
                                $multiple_options->question_id = $questions->id;
                                $multiple_options->option_label = $option->option_label;
                                $multiple_options->option_value = $option->option_value;
                                $multiple_options->next_question_id = $option->option_go_to_step;
                                $multiple_options->order_id = $order++;
                                $multiple_options->save();
                            }                        
                        }

                        if(isset($data->add_rows) && $data->add_rows != null){
                            $order = 1;
                            for($i=0; $i<count($data->add_rows); $i++){
                                $row = $data->add_rows[$i];
                                $multiple_options = new MultipleChoiceQuestionOption;
                                $multiple_options->question_id = $questions->id;
                                $multiple_options->option_label = $row->label;
                                $multiple_options->contract_link = $row->contract_link;
                                $multiple_options->contract_send_to_next_step = $row->next_step;
                                $multiple_options->order_id = $order++;
                                $multiple_options->save();
                            }
                        }
                        $question_data->save();
                    }
                }
                DB::commit(); 
                return redirect()->back()->with('success', 'Document Questions added successfully.');
            }
        }catch(Exception $e){
            DB::rollBack();
            saveLog("Error:", "DocumentController", $e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong. Please try again.');
        }
    }
}



