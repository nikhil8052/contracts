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

class DocumentController extends Controller
{
    protected $fileUploadService;

    public function __construct(FileUploadService $fileUploadService){
        $this->fileUploadService = $fileUploadService;
    }

    public function documents(){
        $categories  = DocumentCategory::all();
        return view('admin.documents.document',compact('categories'));
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

            $document->guide_main_heading = $request->guide_heading;

            if($request->has('step_title') && $request->has('step_description')){
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
            
            $document->category_id = json_encode($request->category_id);
            $document->legal_heading = $request->legal_heading;
            $document->legal_description = $request->legal_description;
            $document->legal_btn_text = $request->legal_btn_text;
            $document->legal_btn_link = $request->legal_btn_link;
            $document->approved = $request->approved;
            $document->valid_in = $request->valid_in;
            $document->faq_heading = $request->faq_heading;

            if($request->has('doc_question') && $request->has('doc_answer')){
                $doc_question = $request->doc_question;
                for($i=0; $i<count($doc_question); $i++){
                    $quiz = $doc_question[$i];
                    $answer = $request->doc_answer[$i];

                    $document_faq = new DocumentFaq;
                    $document_faq->document_id = $document->id;                   
                    $document_faq->question = $quiz; 
                    $document_faq->answer = $answer; 
                    $document_faq->save();
                }
            }

            $document->related_heading = $request->related_heading;
            $document->related_description = $request->related_description;

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
        $document = Document::where('slug',$slug)->with('documentFaq','documentGuide','documentField.media')->first();
        $categories  = DocumentCategory::all();
        return view('admin.documents.document',compact('categories','document'));
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


}
