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
use Illuminate\Support\Str;
use Exception;
use App\Services\FileUploadService;
use Illuminate\Support\Facades\DB;

class DocumentController extends Controller
{
    protected $fileUploadService;

    public function __construct(FileUploadService $fileUploadService){
        $this->fileUploadService = $fileUploadService;
    }

    public function documents(){
        $categories  = DocumentCategory::all();
        $related_documents = Document::all();
        $reviews = Document::with('reviews')->get();
        return view('admin.documents.document',compact('categories','related_documents','reviews'));
    }

    public function addDocuments(Request $request){
        DB::beginTransaction(); 
        try{
            if(isset($request->id) && $request->id != null){
                $document = Document::find($request->id);

                if($request->has('new_img_heading')){
                    for($i=0; $i<count($request->new_img_heading); $i++){
                        $img_heading = $request->new_img_heading[$i];
                        if($request->has('new_img_description')){
                            $img_description = $request->new_img_description[$i];
                        }
    
                        $document_field = new DocumentsField;
                        $document_field->document_id = $document->id;
                        $document_field->heading = $img_heading;
                        $document_field->description = $img_description;
                        $document_field->save();
                    }
                }

                if($request->has('agreement_heading')){
                    $agHeading = $request->agreement_heading;
                    foreach($agHeading as $key=>$val){
                        $document_agreement = DocumentAgreement::find($key);
                        $document_agreement->heading = $val;
                        $document_agreement->update();
                    }
    
                    $agDescription = $request->agreement_description;
                    foreach($agDescription as $index=>$value){
                        $document_agreement = DocumentAgreement::find($index);
                        $document_agreement->description = $value;
                        $document_agreement->update();
                    }
                }
            }else{
                $document = new Document;
            }
            
            $document->title = $request->title;
            $document->slug = $request->slug;

            if($request->hasFile('document_image')){
                $document_image = $request->file('document_image');
                $imagename = generateFileName($document_image);
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

            if($request->hasFile('new_agreement_image')){
                $agreement_image = $request->file('new_agreement_image');
                for($i=0; $i<count($agreement_image); $i++){
                    $file = $agreement_image[$i];

                    if($request->has('new_agreement_heading')){
                        $agreement_heading = $request->new_agreement_heading[$i];
                    }

                    if($request->has('new_agreement_description')){
                        $agreement_description = $request->new_agreement_description[$i];
                    }

                    $fileupload = $this->fileUploadService->upload($file, 'public');
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

            if($request->has('img_heading')){
                $img_headings = $request->img_heading;
                $img_descriptions = $request->img_description;
            
                foreach($img_headings as $key => $img_heading){
                    $document_field = DocumentsField::find($key);
            
                    if(!$document_field){
                        $document_field = new DocumentsField;
                        $document_field->document_id = $document->id;
                    }

                    $document_field->heading = $img_heading;
                    $document_field->description = $img_descriptions[$key] ?? ''; 
                    $document_field->save(); 
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
            $document->valid_in = $request->valid_in;
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
           

            $document->related_heading = $request->related_heading;
            $document->related_description = $request->related_description;

            if($request->hasFile('legal_doc_image')){
                $legal_image = $request->file('legal_doc_image');
                $imagename = generateFileName($legal_image);
                $directory = 'public';
                $path = $legal_image->storeAs($directory, $imagename);

                $document->legal_doc_image = $imagename;
                $document->directory_name = $directory;
                $document->file_path = $path;
            }
            
            $document->doc_price = $request->doc_price;
            $document->reviews = 1;

            if($request->img_sec_ids != null){
                $removeIds = explode(',', $request->img_sec_ids);
                $removeDocumentFields = DocumentsField::whereIn('id',$removeIds)->delete();
            }

            if($request->guide_sec_ids != null){
                $removeIds = explode(',', $request->guide_sec_ids);
                $removeGuideSection = DocumentGuide::whereIn('id',$removeIds)->delete();
            }

            if($request->agg_sec_ids != null){
                $removeIds = explode(',', $request->agg_sec_ids);
                $removeAgreementSection = DocumentAgreement::whereIn('id',$removeIds)->delete();
            }

            $document->status = 0;
            $document->save();
            DB::commit(); 

            return redirect()->back()->with('success','Data Successfully saved');
        }catch(Exception $e){
            DB::rollBack();
            saveLog("Error:", "DocumentController", $e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong. Please try again.');
        }
    }

    // public function addDocuments(DocumentFormRequest $request){
    //     DB::beginTransaction(); 
    //     try{
    //         $document = new Document;
    //         $document->title = $request->title;
    //         $document->slug = $request->slug;
    //         $document->save();

    //         if($request->hasFile('document_image')){
    //             $document_image = $request->file('document_image');
    //             $image_id = $document->id;
    //             $timestamp = now()->timestamp;
    //             $directory = "public/document_images/{$image_id}_{$timestamp}";
    //             $imagename = generateFileName($document_image);
    //             $path = $document_image->storeAs($directory, $imagename);

    //             $document->document_image = $imagename;
    //             $document->document_directory_name = $directory;
    //             $document->document_file_path = $path;
    //         }

    //         $document->short_description = $request->short_description;
    //         $document->btn_text = $request->document_button_text;
    //         $document->long_description = $request->long_description;
            
    //         if($request->hasFile('new_agreement_image') && $request->has('new_agreement_heading') && $request->has('new_agreement_description')){
    //             $agreement_image = $request->file('new_agreement_image');
    //             for($i=0; $i<count($agreement_image); $i++){
    //                 $file = $agreement_image[$i];
    //                 $agreement_heading = $request->new_agreement_heading[$i];
    //                 $agreement_description = $request->new_agreement_description[$i];

    //                 $directory = "public/document_images";
    //                 $fileupload = $this->fileUploadService->upload($file, $directory);
    //                 $fileuploadData = $fileupload->getData();

    //                 if(isset($fileuploadData) && $fileuploadData->status == '200'){
    //                     $document_agreement = new DocumentAgreement;
    //                     $document_agreement->document_id = $document->id;
    //                     $document_agreement->media_id = $fileuploadData->id;
    //                     $document_agreement->heading = $agreement_heading;
    //                     $document_agreement->description = $agreement_description;
    //                     $document_agreement->save();
            
    //                 }elseif($fileuploadData->status == '400') {
    //                     DB::rollBack();
    //                     return redirect()->back()->with('error', $fileuploadData->error);
    //                 }
    //             }
    //         }

    //         if($request->has('img_heading') && $request->has('img_description')){
    //             for($i=0; $i<count($request->img_heading); $i++){
    //                 $img_headings = $request->img_heading[$i];
    //                 $img_descriptions = $request->img_description[$i];
            
    //                 $document_field = new DocumentsField;
    //                 $document_field->document_id = $document->id;
    //                 $document_field->heading = $img_headings;
    //                 $document_field->description = $img_descriptions; 
    //                 $document_field->save(); 
    //             }
    //         }

    //         if($request->has('new_img_heading') && $request->has('new_img_description')){
    //             for($i=0; $i<count($request->new_img_heading); $i++){
    //                 $img_headings = $request->new_img_heading[$i];
    //                 $img_descriptions = $request->new_img_description[$i];
            
    //                 $document_field = new DocumentsField;
    //                 $document_field->document_id = $document->id;
    //                 $document_field->heading = $img_headings;
    //                 $document_field->description = $img_descriptions; 
    //                 $document_field->save(); 
    //             }
    //         }

    //         $document->guide_main_heading = $request->guide_heading;

    //         if($request->has('new_step_title') && $request->has('new_step_description')){
    //             $step_title = $request->new_step_title;
    //             for($i=0; $i<count($step_title); $i++){
    //                 $title_steps = $step_title[$i];
    //                 $description = $request->new_step_description[$i];

    //                 $document_guide = new DocumentGuide;
    //                 $document_guide->document_id = $document->id;                   
    //                 $document_guide->step_title = $title_steps; 
    //                 $document_guide->step_description = $description; 
    //                 $document_guide->save();
    //             }
    //         }

    //         $document->legal_heading = $request->legal_heading;
    //         $document->legal_description = $request->legal_description;
    //         $document->legal_btn_text = $request->legal_btn_text;

    //         if($request->hasFile('legal_doc_image')){
    //             $legal_image = $request->file('legal_doc_image');
    //             $directory = "public/document_images";
    //             $imagename = generateFileName($legal_image);
    //             $path = $legal_image->storeAs($directory, $imagename);

    //             $document->legal_doc_image = $imagename;
    //             $document->directory_name = $directory;
    //             $document->file_path = $path;
    //         }

    //         $document->valid_in = $request->valid_in;
    //         $document->published = $request->published;
    //         $document->related_heading = $request->related_heading;
    //         $document->related_description = $request->related_description;

    //         if($request->has('select_related_doc')){
    //             $related_doc = $request->select_related_doc;
    //             $current_related_docs = DocumentRelated::where('document_id', $document->id)->pluck('related_document_id')->toArray();
    //             $docs_to_delete = array_diff($current_related_docs, $related_doc);

    //             DocumentRelated::where('document_id', $document->id)
    //             ->whereIn('related_document_id', $docs_to_delete)
    //             ->delete();

    //             for ($i = 0; $i < count($related_doc); $i++) {
    //                 $related_document_id = $related_doc[$i];
            
    //                 if (!in_array($related_document_id, $current_related_docs)) {
    //                     $related_document = new DocumentRelated;
    //                     $related_document->document_id = $document->id;
    //                     $related_document->related_document_id = $related_document_id;
    //                     $related_document->save();
    //                 }
    //             }
    //         }


    //         $document->doc_price = $request->doc_price;
    //         $document->reviews = 1;

    //         if($request->has('category_id')){
    //             for($i=0; $i<count($request->category_id); $i++){
    //                 $category_id = $request->category_id[$i];

    //                 $document_with_category = new DocumentWithCategory;
    //                 $document_with_category->document_id = $document->id;
    //                 $document_with_category->category_id = $category_id;
    //                 $document_with_category->save();
    //             }
    //         }

    //         $document->status = 0;
    //         $document->save();
    //         DB::commit(); 

    //         return redirect()->back()->with('success','Document Added Successfully.');

    //     }catch(Exception $e){
    //         saveLog("Error:", "DocumentController", $e->getMessage());
    //         return redirect()->back()->with('error', 'Something went wrong. Please try again.');
    //     }
    // }

    public function allDocuments(){
        $documents = Document::where('published',1)->get();
        return view('admin.documents.all_documents',compact('documents'));
    }

    public function editDocument($slug){
        $document = Document::where('slug',$slug)->with('documentAgreement','documentGuide','documentField.media','relatedDocuments')->first();
        $categories  = DocumentCategory::all();
        $related_documents = Document::all();
        $reviews = Document::where('reviews',1)->with('reviews')->get();

        // $documentCategory = Document::with('categories')->get();
        // dd($documentCategory);

        return view('admin.documents.document',compact('categories','document','related_documents','reviews'));
    }

    // public function updateDocument(Request $request){

    // }

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

}
