<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Document;
use App\Models\DocumentRightSection;
use App\Models\RightSectionCondition;
use App\Models\QuestionCondition;
use App\Models\Question;
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
        if(isset($_GET['id']) && $_GET['id'] != null){
            $questions = Question::where('document_id', $_GET['id'])->get();
            $document = Document::find($_GET['id']);
            $documentRight = DocumentRightSection::where('document_id', $_GET['id'])->with('conditions','document')->orderBy('order_id')->orderByRaw('order_id IS NULL')->get();
        }else{
            $questions = '';
            $document = '';
            $documentRight = '';
        }
        
        return view('admin.document_right_content.document_right_content',compact('document','documentRight','questions'));

    }

    public function updateRightContent(Request $request){
        // return $request->all();
        
        DB::beginTransaction(); 
        try{
            if(isset($request->formdata) && $request->formdata != null){
                $formData = json_decode($request->formdata);
                foreach($formData as $data){                    
                    if($data->section == 'content_heading'){
                        
                        if($data->is_new == true){
                            $document_right_section = new DocumentRightSection;
                            $document_right_section->content = $data->heading_html;
                            $document_right_section->type = $data->section;
                            // $document_right_section->title = $request->title;
                            $document_right_section->document_id = $request->document_id;
                            $document_right_section->published = $request->published;
                            $document_right_section->save();

                        }elseif($data->is_new == false){
                            $document_right_section = DocumentRightSection::where([['id',$data->id],['type',$data->section]])->first();
                            $document_right_section->content = $data->heading_html;
                            $document_right_section->update();
                        }
                        

                    }elseif($data->section == 'content'){
                        if($data->is_new == true){
                            // $text_alignment = $data->text_align ?? null;
                            $text_align = $data->text_align ?? null;
                            $document_right_section = new DocumentRightSection;
                            $document_right_section->type = $data->section;
                            // $document_right_section->title = $request->title;
                            $document_right_section->document_id = $request->document_id;
                            $document_right_section->published = $request->published;
                            // $document_right_section->start_new_section = $data->start_new_section;
                            $document_right_section->content = $data->content_html;
                            $document_right_section->text_align = $text_align;
                            // $document_right_section->text_alignment = $text_alignment;
                            $document_right_section->signature_field = $data->signature_field;
                            // $document_right_section->content_class = $data->content_class;
                            $document_right_section->is_condition = $data->add_condition;
                            $document_right_section->secure_blur_content = $data->secure_blurr_content;
                            // $document_right_section->blur_content = $data->blurr_content;
                            $document_right_section->save();

                        }elseif($data->is_new == false){
                            $text_align = $data->text_align ?? null;

                            $document_right_section = DocumentRightSection::where([['id',$data->id],['type',$data->section]])->first();
                            // $document_right_section->start_new_section = $data->start_new_section;
                            $document_right_section->content = $data->content_html;
                            $document_right_section->text_align = $text_align;
                            $document_right_section->signature_field = $data->signature_field;
                            $document_right_section->is_condition = $data->add_condition;
                            $document_right_section->secure_blur_content = $data->secure_blurr_content;
                            // $document_right_section->blur_content = $data->blurr_content;
                            $document_right_section->update();
                        }
                        
                        if (!empty($data->add_condition)) {
                            // Handle New Conditions
                            if (!empty($data->new_conditions)) {
                                foreach ($data->new_conditions as $new_condition) {
                                    $condition_value = match ($new_condition->condition) {
                                        'is_equal_to' => 1,
                                        'is_greater_than' => 2,
                                        'is_less_than' => 3,
                                        'not_equal_to' => 4,
                                        default => null,
                                    };
                                   
                                    
                                    if ($condition_value !== null) {
                                        $documentCondition = new QuestionCondition();
                                        $documentCondition->condition_type = 'content_condition';
                                        $documentCondition->document_right_content_id = $document_right_section->id;
                                        $documentCondition->conditional_question_id = $new_condition->question_id;
                                        $documentCondition->conditional_check = $condition_value;
                                        $documentCondition->conditional_question_value = $new_condition->question_value;
                                        $documentCondition->save();
                                    }
                                }
                            }
                        
                            // Handle Existing Conditions
                            if (!empty($data->conditions)) {
                                foreach ($data->conditions as $condition) {
                                    $condition_value = match ($condition->condition) {
                                        'is_equal_to' => 1,
                                        'is_greater_than' => 2,
                                        'is_less_than' => 3,
                                        'not_equal_to' => 4,
                                        default => null,
                                    };

                                    if ($condition_value !== null) {
                                        $documentCondition = QuestionCondition::find($condition->condition_id);
                                        if ($documentCondition) {
                                            $documentCondition->conditional_question_id = $condition->question_id;
                                            $documentCondition->conditional_check = $condition_value;
                                            $documentCondition->conditional_question_value = $condition->question_value;
                                            $documentCondition->update();
                                        }
                                    }
                                }
                            }
                        }
                        
                    }
                }   

                if($request->remove_content != null){
                    $deleteIds = explode(',', $request->remove_content);
                    foreach($deleteIds as $id){
                        $delete_content = DocumentRightSection::where([['id',$id],['type','content']])->first();
                        if($delete_content){
                            $delete_content->delete();
                        }
                    }
                }

                if($request->remove_content_heading != null){
                    $deleteIds = explode(',', $request->remove_content_heading);
                    foreach($deleteIds as $id){
                        $delete_heading = DocumentRightSection::where([['id',$id],['type','content_heading']])->first();
                        if($delete_heading){
                            $delete_heading->delete();
                        }
                    }
                }
    
                if($request->remove_condition != null){
                    $deleteIds = explode(',', $request->remove_condition);
                    foreach($deleteIds as $id){
                        $delete_condition = QuestionCondition::where('id',$id)->first();
                        if($delete_condition){
                            $delete_condition->delete();
                        }
                    }
                }
                
                DB::commit();
                return redirect()->back()->with('success', 'Document Right Section Successfully Updated.');
            }
        }catch(Exception $e){
            DB::rollBack();
            saveLog("Error:", "DocumentRightController", $e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong. Please try again.');
        }
    
    }
}
