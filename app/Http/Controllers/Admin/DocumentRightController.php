<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Document;
use App\Models\DocumentRightSection;
use App\Models\RightSectionCondition;
use App\Models\QuestionCondition;
use Illuminate\Support\Str;
use App\Services\FileUploadService;
use Illuminate\Support\Facades\DB;
use Exception;

class DocumentRightController extends Controller
{
    public function allRightContent(){
        $documentRightContent = DocumentRightSection::with('document')->get();
        $documents = Document::where('published',1)->get();
        return view('admin.document_right_content.all_document_right_content',compact('documents'));
    }


    public function documentRightContent(){
        $documents = Document::where('published',1)->get();
        return view('admin.document_right_content.document_right_content',compact('documents'));
    }

    public function addDocumentRightContent(Request $request){
        // return $request->all();
        DB::beginTransaction(); 
        try{
            if(isset($request->formdata) && $request->formdata != null){
                $formData = json_decode($request->formdata);
                foreach($formData as $data){
                    $document_right_section = new DocumentRightSection;
                    $document_right_section->type = $data->section;
                    $document_right_section->title = $request->title;
                    $document_right_section->document_id = $request->document_id;
                    $document_right_section->published = $request->published;
    
                    if($data->section == 'content_heading'){
                        $document_right_section->content = $data->heading_html;
                        $document_right_section->order_id = $data->order;
                        $document_right_section->save();

                    }elseif($data->section == 'content'){
                        $document_right_section->start_new_section = $data->start_new_section;
                        $document_right_section->content = $data->content_html;
                        $document_right_section->text_align = $data->text_align;
                        $document_right_section->signature_field = $data->signature_field;
                        $document_right_section->content_class = $data->content_class ?? null;
                        $document_right_section->is_condition = $data->add_condition;
                        $document_right_section->save();

                        if(!empty($data->conditions) && $data->add_condition){
                            for($i=0; $i<count($data->conditions); $i++){
                                $condition = $data->conditions[$i];
                                if($condition->condition == 'is_equal_to'){
                                    $condition_value = 1;
                                }elseif($condition->condition == 'is_greater_than'){
                                    $condition_value = 2;
                                }elseif($condition->condition == 'is_less_than'){
                                    $condition_value = 3;
                                }elseif ($condition->condition == 'not_equal_to') {
                                    $condition_value = 4;
                                }
    
                                $documentCondition = new QuestionCondition;
                                $documentCondition->condition_type = 'content_condition';
                                $documentCondition->document_right_content_id = $document_right_section->id;
                                $documentCondition->conditional_question_id  = $condition->question_id;
                                $documentCondition->conditional_check = $condition_value;
                                $documentCondition->conditional_question_value = $condition->question_value;
                                $documentCondition->save();
                            }
                        }

                        $document_right_section->secure_blur_content = $data->secure_blurr_content;
                        $document_right_section->blur_content = $data->blurr_content;
                        $document_right_section->order_id = $data->order;
                        $document_right_section->save();
                        
                    }
                }
                DB::commit();
                return redirect()->back()->with('success', 'Document Right Section successfully saved.');
            }
        }catch(Exception $e){
            DB::rollBack();
            saveLog("Error:", "DocumentRightController", $e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong. Please try again.');
        }
    }

    public function editRightContent($id){
        
        $documentRight = DocumentRightSection::where('document_id', $id)->with('conditions','document')->orderBy('order_id')->orderByRaw('order_id IS NULL')->get();
        // dd($documentRight);
        // $documentRight = DocumentRightSection::where('document_id', $id)->orderByRaw('ISNULL(order_id), order_id ASC')->get();
        // $documentRight = DocumentRightSection::where('document_id',$id)->with('conditions','document')->orderBy('order_id', 'asc')->get();
        $documents = Document::where('published',1)->get();
        $document_id = $id;
        $document = Document::find($document_id);
        $title = $document->title;
        return view('admin.document_right_content.document_right_content',compact('documents','documentRight','title','document_id'));
    }

    public function updateRightContent(Request $request){
        return $request->all();
        
        try{

        }catch(Exception $e){
            
        }
    }
    
}
