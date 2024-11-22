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
            
            if($request->hasFile('agreement_image') != null && $request->has('agreement_heading') != null && $request->has('agreement_description') != null){
                $agreement_image = $request->file('agreement_image');
                for($i=0; $i<count($agreement_image); $i++){
                    $file = $agreement_image[$i];
                    $agreement_heading = $request->agreement_heading[$i];
                    $agreement_description = $request->agreement_description[$i];

                    $directory = "public/document_images";
                    $fileupload = $this->fileUploadService->upload($file, $directory);
                    $fileuploadData = $fileupload->getData();

                    if(isset($fileuploadData) && $fileuploadData->status == '200'){
                        $document_agreement = new DocumentAgreement;
                        $document_agreement->document_id = $document->id;
                        $document_agreement->media_id = $fileuploadData->id;
                        $document_agreement->heading = $agreement_heading;
                        $document_agreement->description = $agreement_description;
                        $document_agreement->save();
            
                    }elseif($fileuploadData->status == '400') {
                        DB::rollBack();
                        return redirect()->back()->with('error', $fileuploadData->error);
                    }
                }
            }

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

            $document->guide_main_heading = $request->guide_heading;
            $document->guide_button = $request->guide_button;
            // $document->guide_button_link = $request->guide_button_link;

            if($request->has('step_title') != null && $request->has('step_description') != null){
                $step_title = $request->step_title;
                for($i=0; $i<count($step_title); $i++){
                    $title_steps = $step_title[$i];
                    $description = $request->step_description[$i];

                    $document_guide = new DocumentGuide;
                    $document_guide->document_id = $document->id;                   
                    $document_guide->step_title = $title_steps; 
                    $document_guide->step_description = $description; 
                    $document_guide->save();
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

            $document->valid_in = $request->valid_in;
            $document->published = $request->published;
            $document->related_heading = $request->related_heading;
            $document->related_description = $request->related_description;

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
            $document->guide_main_heading = $request->guide_heading;
            $document->guide_button = $request->guide_button;
            $document->legal_heading = $request->legal_heading;
            $document->legal_description = $request->legal_description;
            $document->legal_btn_text = $request->legal_btn_text;
            $document->valid_in = $request->valid_in;
            $document->published = $request->published;
            $document->related_heading = $request->related_heading;
            $document->related_description = $request->related_description;
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
            
            if($request->has('agreement_heading') != null){
                foreach($request->agreement_heading as $key=>$val){
                    $document_agreement = DocumentAgreement::find($key);
                    $document_agreement->heading = $val;
                    $document_agreement->update();
                }
            }

            if($request->has('agreement_description') != null){
                foreach($request->agreement_description as $index=>$value){
                    $document_agreement = DocumentAgreement::find($index);
                    $document_agreement->description = $value;
                    $document_agreement->update();
                }
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

            
            // $document->guide_button_link = $request->guide_button_link;

            if($request->has('step_title') != null){
                foreach($request->step_title as $key=>$val){
                    $document_guide = DocumentGuide::find($key);                  
                    $document_guide->step_title = $val; 
                    $document_guide->update();
                }
            }

            if($request->has('step_description') != null){
                foreach($request->step_description as $key=>$val){
                    $document_guide = DocumentGuide::find($key);                   
                    $document_guide->step_description = $val; 
                    $document_guide->update();
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
            
            if($request->ag_img_id != null){
                $deleteIds = explode(',', $request->ag_img_id);
                foreach($deleteIds as $id){
                    $document_agreement = DocumentAgreement::where('id',$id)->with('media')->first();
                    if($document_agreement->media){
                        $image_path = getFilePath($document_agreement->media->file_path);
                        if(File::exists($image_path)) {
                            $directory_path = dirname($image_path);
                            unlink($image_path);
                            if(is_dir($directory_path) && count(scandir($directory_path)) == 2){
                                rmdir($directory_path);
                            }
                        }
                        Media::where('id',$document_agreement->media_id)->delete();
                        $document_agreement->media_id = null;
                        $document_agreement->update();
                    }
                }
            }
                        
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

    public function updateAgreementImage(Request $request){
        if($request->id != null){
            $id = $request->id;
            if($request->hasFile('image')) {
                $file = $request->file('image');
                $directory = "public/document_images";
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
        return view('admin.documents.document_questions',compact('documents','types','questions'));
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
        return $request->all();
        // DB::beginTransaction(); 
        // try{
        //     if(isset($request->formdata) && $request->formdata != null){
        //         $formData = json_decode($request->formdata);
        //         foreach($formData as $data){                  

        //         }
        //     }
        // }catch(Exception $e){
        //     saveLog("Error:", "DocumentController", $e->getMessage());
        //     return redirect()->back()->with('error', 'Something went wrong. Please try again.');
        // }
    }

}



