@extends('admin_layout.master')
@section('content')

<div class="nk-content">
     <div class="container-fluid">
          <form action="{{ url('/admin-dashboard/add/document-questions') }}" id="questionForm" method="post" enctype="multipart/form-data">
          @csrf
          <input type="hidden" id="formdata" name="formdata" value="">
          <input type="hidden" id="is_end" name="is_end" value="">
          <input type="hidden" id="document_id" name="document_id" value="{{ $_GET['id'] ?? '' }}">
          <input type="hidden" id="remove_question_id" name="remove_question_id" value="">
          <input type="hidden" id="condition_id" name="condition_id" value="">
          <input type="hidden" id="option_id" name="option_id" value="">

          @if(isset($document) && $document != null)
          <div class="col-md-12 doc-title mt-4 pb-4">
               <h3>{{ $document->title ?? '' }}</h3>
               <!-- <div class="form-group">
                    <label class="form-label" for="title"><b><h3>Document Title</h3></b></label>
                    <input type="text" class="form-control form-control-lg" id="title" name="title" placeholder="Add title" value="{{ $document->title ?? '' }}" readonly>
               </div> -->
          </div>
          @else
          <div class="col-md-12 doc-title mt-4 pb-4">
               <div class="form-group">
                    <label class="form-label" for="title"><b><h3>Document Title</h3></b></label>
                    <input type="text" class="form-control form-control-lg" id="title" name="title" placeholder="Add title" value="">
               </div>
          </div>
          @endif
          <div class="nk-block-head doc-outer-div">
               <div class="nk-block-head-content wrapper">
                    <div class="tab">
                         @if(isset($document) && $document != null)
                         <a href="{{ url('admin-dashboard/edit-document/'.$document->slug) }}" class="btn tab_btn">Frontpage</a>
                         @endif
                         <a class="btn tab_btn" target="_blank">Document generator</a>
                         @if(isset($_GET['id']) && $_GET['id'] != null)
                         <a href="{{ url('admin-dashboard/document-questions/?id='.$_GET['id']) }}" class="btn tab_btn active">Document questions</a>
                         @else
                         <a href="{{ url('admin-dashboard/document-questions/') }}" class="btn tab_btn active">Document questions</a>
                         @endif
                         @if(isset($_GET['id']) && $_GET['id'] != null)
                         <a href="{{ url('admin-dashboard/document-right-content/?id='.$_GET['id']) }}" class="btn tab_btn" target="_blank">Document Text</a>
                         @else
                         <a href="{{ url('admin-dashboard/document-right-content/') }}" class="btn tab_btn" target="_blank">Document Text</a>
                         @endif
                    </div>
               </div>
          </div>
          <div class="row main_section">
               <div class="col col-md-8 left-content">
                    <h5 class="mt-4">Contract Questions</h5>
                    <div class="steps_section" id="steps_section">
                         <div class="card card-bordered card-preview">
                              <div class="card-inner">
                                   <div class="row add_step">
                                        <div class="col-md-6">
                                             <h6>Add Question</h6>
                                        </div>
                                   </div>
                                   <hr>
                                   <div class="add_qu_sec">
                                   @if(isset($document_questions) && $document_questions != null)
                                   <?php $num = 1; ?>
                                   @foreach($document_questions as $docQues)
                                   @if($docQues->type == 'textbox')
                                   <div class="new_que_sec{{ $docQues->id ?? '' }}">
                                        <div class="append_textbox" id="append_textbox{{ $docQues->id ?? '' }}" data-id="{{ $docQues->id ?? '' }}" data-is_new=false>
                                             <div class="card card-bordered card-preview">
                                                  <div class="card-inner main_question_div">
                                                       <div class="row add_step">
                                                            <div class="col-md-1">
                                                                 <b><p>{{ $num++ ?? ''}}</p></b>
                                                            </div>
                                                            <div class="col-md-6">
                                                                 <h6>Textbox</h6> 
                                                                 <!-- <div class="form-group">
                                                                      <select class="form-select js-select2 new_question" name="question_type{{ $docQues->id ?? '' }}" id="question_type{{ $docQues->id ?? '' }}">
                                                                           @foreach($types as $type)
                                                                                @if($docQues->type == $type->slug)
                                                                                <option value="{{ $type->slug ?? '' }}" selected>{{ $type->name ?? '' }}</option>
                                                                                @else
                                                                                <option value="{{ $type->slug ?? '' }}">{{ $type->name ?? '' }}</option>
                                                                                @endif
                                                                           @endforeach
                                                                      </select>
                                                                 </div>  -->
                                                            </div> 
                                                            <div class="col-md-5">
                                                                 <div class="form-group">
                                                                      <span class="col-md-2 offset-md-10">
                                                                           <span onclick="removeFields(this)" data-id="{{ $docQues->id ?? '' }}" data-field="textbox"><i class="fa-solid fa-minus"></i></span>
                                                                      </span>  
                                                                 </div>
                                                            </div>
                                                       </div>
                                                       <hr>
                                                       <div class="col-md-12">
                                                            <div class="form-group">
                                                                 <label class="form-label" for="">Conditional questions label</label>
                                                            </div>
                                                       </div>
                                                       <div class="custom-control custom-checkbox">
                                                            @if(isset($docQues->is_condition) && $docQues->is_condition != null)
                                                                 @if($docQues->is_condition == 1 && $docQues->condition_type == 1 || $docQues->condition_type == 3)
                                                                 <input type="checkbox" class="custom-control-input add_conditional_label" id="condition_qu_label{{ $docQues->id ?? '' }}" name="condition_qu_label{{ $docQues->id ?? '' }}" checked>
                                                                 <label class="custom-control-label" for="condition_qu_label{{ $docQues->id ?? '' }}">Conditional questions label</label>
                                                                 @else
                                                                 <input type="checkbox" class="custom-control-input add_conditional_label" id="condition_qu_label{{ $docQues->id ?? '' }}" name="condition_qu_label{{ $docQues->id ?? '' }}">
                                                                 <label class="custom-control-label" for="condition_qu_label{{ $docQues->id ?? '' }}">Conditional questions label</label>
                                                                 @endif
                                                            @else
                                                            <input type="checkbox" class="custom-control-input add_conditional_label" id="condition_qu_label{{ $docQues->id ?? '' }}" name="condition_qu_label{{ $docQues->id ?? '' }}">
                                                            <label class="custom-control-label" for="condition_qu_label{{ $docQues->id ?? '' }}">Conditional questions label</label>
                                                            @endif
                                                       </div>
                                                       <hr>
                                                       @php
                                                            $isCondition = isset($docQues->is_condition) && $docQues->is_condition != null;
                                                            $isConditionType1 = $isCondition && $docQues->is_condition == 1 && $docQues->condition_type == 1 || $docQues->condition_type == 3;
                                                            $conditions = $isConditionType1 ? json_decode($docQues->conditions) : [];
                                                       @endphp

                                                       @if($isConditionType1 && !empty($conditions))
                                                       <div class="cond_ques_div{{ $docQues->id ?? '' }}" style="display:block;">
                                                            <div class="col-md-12">
                                                                 <div class="form-group">
                                                                      <label class="form-label" for="">Add conditional questions label</label>
                                                                 </div>
                                                            </div>
                                                            <div class="append_label_condition" id="append_label_condition{{ $docQues->id ?? '' }}">
                                                            @foreach($conditions as $condition)
                                                                 @if($condition->condition_type == 'question_label_condition')
                                                                 <div class="label-condition" id="label-condition{{ $condition->id ?? '' }}" data-id="{{ $condition->id ?? '' }}" data-is_new="false">
                                                                      <hr>
                                                                      <div class="text-end">
                                                                           <div class="form-group">
                                                                                <span onclick="removeLabel(this)" data-id="{{ $condition->id ?? '' }}">
                                                                                     <i class="fa fa-times"></i>
                                                                                </span>
                                                                           </div>
                                                                      </div>
                                                                      <div class="row">
                                                                           <div class="col-md-4">
                                                                                <div class="form-group">
                                                                                     <label class="form-label" for="condition_question_label-{{ $condition->id ?? '' }}">Label</label>
                                                                                     <input type="text" class="form-control" id="condition_question_label-{{ $condition->id ?? '' }}" name="condition_question_label-{{ $condition->id ?? '' }}[]" value="{{ $condition->question_label ?? '' }}">
                                                                                </div>
                                                                           </div>
                                                                           <div class="col-md-4">
                                                                                <div class="form-group">
                                                                                     <label class="form-label" for="label_qu_id-{{ $condition->id ?? '' }}">Question ID</label>
                                                                                     <select class="form-select js-select2 new_label_question_id" name="label_qu_id-{{ $condition->id ?? '' }}[]" id="label_qu_id-{{ $condition->id ?? '' }}">
                                                                                          @foreach($questions ?? [] as $question)
                                                                                               <option value="{{ $question->getName() ?? '' }}" {{ $condition->conditional_question_id == $question->getName() ? 'selected' : '' }}>
                                                                                               {{ $question->getName() ?? '' }}
                                                                                               </option>
                                                                                          @endforeach
                                                                                     </select>
                                                                                </div>
                                                                           </div>
                                                                           <div class="col-md-4">
                                                                                <div class="form-group">
                                                                                     <label class="form-label" for="condition_question_value-{{ $condition->id ?? '' }}">Value</label>
                                                                                     <input type="text" class="form-control" id="condition_question_value-{{ $condition->id ?? '' }}" name="condition_question_value-{{ $condition->id ?? '' }}[]" value="{{ $condition->conditional_question_value ?? '' }}">
                                                                                </div>
                                                                           </div>
                                                                      </div>
                                                                      <br>
                                                                 </div>
                                                                 @endif
                                                            @endforeach
                                                            </div>
                                                            <div class="text-end">
                                                                 <div class="form-group">
                                                                      <button type="button" class="btn btn-sm btn-primary" onclick="addLabel('{{ $docQues->id ?? '' }}')">Add Label</button>
                                                                 </div>
                                                            </div>
                                                            <hr>
                                                       </div>
                                                       @else
                                                       <div class="cond_ques_div{{ $docQues->id ?? '' }}" style="display:none;">
                                                            <div class="col-md-12">
                                                                 <div class="form-group">
                                                                      <label class="form-label" for="">Add conditional questions label</label>
                                                                 </div>
                                                            </div>
                                                            <div class="append_label_condition" id="append_label_condition{{ $docQues->id ?? '' }}"></div>
                                                            <div class="text-end">
                                                                 <div class="form-group">
                                                                      <button type="button" class="btn btn-sm btn-primary" onclick="addLabel('{{ $docQues->id ?? '' }}')">Add Label</button>
                                                                 </div>
                                                            </div>
                                                            <hr>
                                                       </div>
                                                       @endif
                                                       @if($isCondition)
                                                       <div class="col-md-12 hide_question_label" id="hide_question_label{{ $docQues->id ?? '' }}" style="display:none;">
                                                            <div class="form-group">
                                                                 <label class="form-label" for="text_qu_label-{{ $docQues->id ?? '' }}">Question Label</label>
                                                                 <input type="text" class="form-control question_labl" id="text_qu_label-{{ $docQues->id ?? '' }}" name="text_qu_label-${newUniqueId}" value="{{ $docQues->questionData->question_label ?? '' }}">
                                                            </div>
                                                            <hr>
                                                       </div>
                                                       @else
                                                       <div class="col-md-12 hide_question_label" id="hide_question_label{{ $docQues->id ?? '' }}">
                                                            <div class="form-group">
                                                                 <label class="form-label" for="text_qu_label-{{ $docQues->id ?? '' }}">Question Label</label>
                                                                 <input type="text" class="form-control question_labl" id="text_qu_label-{{ $docQues->id ?? '' }}" name="text_qu_label-${newUniqueId}" value="{{ $docQues->questionData->question_label ?? '' }}">
                                                            </div>
                                                            <hr>
                                                       </div>
                                                       @endif
                                                       <div class="col-md-12">
                                                            <div class="form-group">
                                                                 <label class="form-label" for="text_placeholder-{{ $docQues->id ?? '' }}">Text Box Placeholder</label>
                                                                 <input type="text" class="form-control text_box_placeholder" id="text_placeholder-{{ $docQues->id ?? '' }}" name="text_placeholder-{{ $docQues->id ?? '' }}" value="{{ $docQues->questionData->text_box_placeholder ?? '' }}">
                                                            </div>
                                                       </div>
                                                       <hr>
                                                       <div class="col-md-12">
                                                            <div class="form-group">
                                                                 <label class="form-label" for="text_go_to_step-{{ $docQues->id ?? '' }}">Go to step</label>
                                                                 <div class="form-control-wrap"> 
                                                                      <select class="form-select js-select2 new_label_question_id" data-search="on" name="text_go_to_step-{{ $docQues->id ?? '' }}" id="text_go_to_step-{{ $docQues->id ?? '' }}">
                                                                      <option value=""></option>
                                                                      @if(isset($questions) && $questions != null)
                                                                           @foreach($questions as $question)
                                                                           <option value="{{ $question->getName() ?? '' }}" {{ $docQues->questionData->next_question_id == $question->getName() ? 'selected' : '' }}>{{ $question->getName() ?? '' }}</option>
                                                                           @endforeach
                                                                      @endif
                                                                      </select>
                                                                 </div>
                                                            </div>
                                                       </div>
                                                       <hr>
                                                       <div class="col-md-12">
                                                            <div class="form-group">
                                                                 <label class="form-label" for="">Conditional Go to step Settings</label>
                                                            </div>
                                                       </div>
                                                       <div class="custom-control custom-checkbox checked">
                                                            @if(isset($docQues->is_condition) && $docQues->is_condition != null)
                                                                 @if($docQues->is_condition == 1 && $docQues->condition_type == 2 || $docQues->condition_type == 3)
                                                                 <input type="checkbox" class="custom-control-input enable_conditional" id="condition_go_to{{ $docQues->id ?? '' }}" name="condition_go_to{{ $docQues->id ?? '' }}" checked>
                                                                 <label class="custom-control-label" for="condition_go_to{{ $docQues->id ?? '' }}">Enable Conditional Go To Step Settings</label>
                                                                 @else
                                                                 <input type="checkbox" class="custom-control-input enable_conditional" id="condition_go_to{{ $docQues->id ?? '' }}" name="condition_go_to{{ $docQues->id ?? '' }}">
                                                                 <label class="custom-control-label" for="condition_go_to{{ $docQues->id ?? '' }}">Enable Conditional Go To Step Settings</label>
                                                                 @endif
                                                            @else
                                                            <input type="checkbox" class="custom-control-input enable_conditional" id="condition_go_to{{ $docQues->id ?? '' }}" name="condition_go_to{{ $docQues->id ?? '' }}">
                                                            <label class="custom-control-label" for="condition_go_to{{ $docQues->id ?? '' }}">Enable Conditional Go To Step Settings</label>
                                                            @endif
                                                       </div>
                                                       <hr>
                                                       @php
                                                            $isCondition = isset($docQues->is_condition) && $docQues->is_condition != null;
                                                            $isConditionType2 = $isCondition && $docQues->is_condition == 1 && $docQues->condition_type == 2 || $docQues->condition_type == 3;
                                                            $enable_conditions = $isConditionType2 ? json_decode($docQues->conditions) : [];
                                                       @endphp

                                                       @if($isConditionType2 && !empty($enable_conditions))
                                                       <div class="cond_div{{ $docQues->id ?? '' }}">
                                                            <div class="col-md-12">
                                                                 <div class="form-group">
                                                                      <label class="form-label" for="">Add Conditions</label>
                                                                 </div>
                                                            </div>
                                                            <div class="append_page_condition" id="append_page_condition{{ $docQues->id ?? '' }}">
                                                            @foreach($enable_conditions as $condition)
                                                                 @if($condition->condition_type == 'go_to_step_condition')
                                                                 <div class="sec-condition" id="sec-condition{{ $condition->id ?? '' }}"  data-id="{{ $condition->id ?? '' }}" data-is_new=false>
                                                                      <hr>
                                                                      <div class="text-end">
                                                                           <div class="form-group">
                                                                                <div>
                                                                                     <span onclick="removeCondition(this)"  data-id="{{ $condition->id ?? '' }}">
                                                                                          <i class="fa fa-times"></i>
                                                                                     </span>
                                                                                </div>
                                                                           </div>
                                                                      </div>
                                                                      <div class="row">
                                                                           <div class="col-md-4">
                                                                                <div class="form-group">
                                                                                     <label class="form-label" for="page_Setting_qu_id-{{ $condition->id ?? '' }}">Question ID</label>
                                                                                     <div class="form-control-wrap question"> 
                                                                                          <select class="form-select js-select2" data-search="on" name="page_Setting_qu_id-{{ $condition->id ?? '' }}[]" id="page_Setting_qu_id-{{ $condition->id ?? '' }}">
                                                                                               @if(isset($questions) && $questions != null)
                                                                                                    @foreach($questions ?? [] as $question)
                                                                                                         <option value="{{ $question->getName() ?? '' }}" {{ $condition->conditional_question_id == $question->getName() ? 'selected' : '' }}>
                                                                                                         {{ $question->getName() ?? '' }}
                                                                                                         </option>
                                                                                                    @endforeach
                                                                                               @endif
                                                                                          </select>
                                                                                     </div>
                                                                                </div>
                                                                           </div>
                                                                           <div class="col-md-4">
                                                                                <div class="form-group">
                                                                                     <label class="form-label" for="page_Setting_conditions-{{ $condition->id ?? '' }}">Condition</label>
                                                                                     <div class="form-control-wrap"> 
                                                                                          <select class="form-select js-select2" name="page_Setting_conditions-{{ $condition->id ?? '' }}[]" id="page_Setting_conditions-{{ $condition->id ?? '' }}">
                                                                                               <option value="" selected disabled>Select</option>
                                                                                               @if(isset($condition->conditional_check) && $condition->conditional_check != null)
                                                                                                    @if($condition->conditional_check == 1)
                                                                                                    <option value="is_equal_to" selected>is equal to</option>
                                                                                                    @else
                                                                                                    <option value="is_equal_to">is equal to</option>
                                                                                                    @endif

                                                                                                    @if($condition->conditional_check == 2)
                                                                                                    <option value="is_greater_than" selected>is greater than</option>
                                                                                                    @else
                                                                                                    <option value="is_greater_than">is greater than</option>
                                                                                                    @endif

                                                                                                    @if($condition->conditional_check == 3)
                                                                                                    <option value="is_less_than" selected>is less than</option>
                                                                                                    @else
                                                                                                    <option value="is_less_than">is less than</option>
                                                                                                    @endif

                                                                                                    @if($condition->conditional_check == 4)
                                                                                                    <option value="not_equal_to" selected>not equal to</option>
                                                                                                    @else
                                                                                                    <option value="not_equal_to">not equal to</option>
                                                                                                    @endif
                                                                                               @else
                                                                                               <option value="is_equal_to">is equal to</option>
                                                                                               <option value="is_greater_than">is greater than</option>
                                                                                               <option value="is_less_than">is less than</option>
                                                                                               <option value="not_equal_to">not equal to</option>
                                                                                               @endif
                                                                                          </select>
                                                                                     </div>
                                                                                </div>
                                                                           </div>
                                                                           <div class="col-md-4">
                                                                                <div class="form-group">
                                                                                     <label class="form-label" for="page_Setting_qu_val-{{ $condition->id ?? '' }}">Value</label>
                                                                                     <input type="text" class="form-control" id="page_Setting_qu_val-{{ $condition->id ?? '' }}" name="page_Setting_qu_val-{{ $condition->id ?? '' }}[]" value="{{ $condition->conditional_question_value ?? '' }}">
                                                                                </div>
                                                                           </div>
                                                                      </div>
                                                                      <br>
                                                                 </div>
                                                                 @endif
                                                            @endforeach
                                                            </div>
                                                            <div class="text-end">
                                                                 <div class="form-group">
                                                                      <button type="button" class="btn btn-sm btn-primary" onclick="addCondition('{{ $docQues->id ?? '' }}')">Add Condition</button>
                                                                 </div>
                                                            </div>
                                                       </div>
                                                       @else
                                                       <div class="cond_div{{ $docQues->id ?? '' }}" style="display:none">
                                                            <div class="col-md-12">
                                                                 <div class="form-group">
                                                                      <label class="form-label" for="">Add Conditions</label>
                                                                 </div>
                                                            </div>
                                                            <div class="append_page_condition" id="append_page_condition{{ $docQues->id ?? '' }}"></div>
                                                            <div class="text-end">
                                                                 <div class="form-group">
                                                                      <button type="button" class="btn btn-sm btn-primary" onclick="addCondition('{{ $docQues->id ?? '' }}')">Add Condition</button>
                                                                 </div>
                                                            </div>
                                                            <hr>
                                                       </div>
                                                       @endif
                                                  </div>
                                             </div>
                                             <br>
                                        </div>
                                   </div>
                                   @elseif($docQues->type == 'textarea')
                                   <div class="new_que_sec{{ $docQues->id ?? '' }}">
                                        <div class="append_textarea" id="append_textarea{{ $docQues->id ?? '' }}" data-id="{{ $docQues->id ?? '' }}" data-is_new=false>
                                             <div class="card card-bordered card-preview">
                                                  <div class="card-inner">
                                                       <div class="row add_step">
                                                            <div class="col-md-1">
                                                                 <b><p>{{ $num++ ?? ''}}</p></b>
                                                            </div>
                                                            <div class="col-md-6">
                                                                 <h6>Textarea</h6>  
                                                                 <!-- <div class="form-group">
                                                                      <select class="form-select js-select2 new_question" name="question_type{{ $docQues->id ?? '' }}" id="question_type{{ $docQues->id ?? '' }}">
                                                                           @foreach($types as $type)
                                                                                @if($docQues->type == $type->slug)
                                                                                <option value="{{ $type->slug ?? '' }}" selected>{{ $type->name ?? '' }}</option>
                                                                                @else
                                                                                <option value="{{ $type->slug ?? '' }}">{{ $type->name ?? '' }}</option>
                                                                                @endif
                                                                           @endforeach
                                                                      </select> 
                                                                 </div> -->
                                                            </div> 
                                                            <div class="col-md-5">
                                                                 <div class="form-group">
                                                                      <span class="col-md-2 offset-md-10">
                                                                           <span onclick="removeFields(this)" data-id="{{ $docQues->id ?? '' }}" data-field="textarea"><i class="fa-solid fa-minus"></i></span>
                                                                      </span>  
                                                                 </div>
                                                            </div>
                                                       </div>
                                                       <hr>
                                                       <div class="col-md-12">
                                                            <div class="form-group">
                                                                 <label class="form-label" for="">Conditional questions label</label>
                                                            </div>
                                                       </div>
                                                       <div class="custom-control custom-checkbox">
                                                            @if(isset($docQues->is_condition) && $docQues->is_condition != null)
                                                                 @if($docQues->is_condition == 1 && $docQues->condition_type == 1 || $docQues->condition_type == 3)
                                                                 <input type="checkbox" class="custom-control-input add_conditional_label" id="condition_qu_label{{ $docQues->id ?? '' }}" name="condition_qu_label{{ $docQues->id ?? '' }}" checked>
                                                                 <label class="custom-control-label" for="condition_qu_label{{ $docQues->id ?? '' }}">Conditional questions label</label>
                                                                 @else
                                                                 <input type="checkbox" class="custom-control-input add_conditional_label" id="condition_qu_label{{ $docQues->id ?? '' }}" name="condition_qu_label{{ $docQues->id ?? '' }}">
                                                                 <label class="custom-control-label" for="condition_qu_label{{ $docQues->id ?? '' }}">Conditional questions label</label>
                                                                 @endif
                                                            @else
                                                            <input type="checkbox" class="custom-control-input add_conditional_label" id="condition_qu_label{{ $docQues->id ?? '' }}" name="condition_qu_label{{ $docQues->id ?? '' }}">
                                                            <label class="custom-control-label" for="condition_qu_label{{ $docQues->id ?? '' }}">Conditional questions label</label>
                                                       @endif
                                                       </div>
                                                       <hr>
                                                       @php
                                                            $isCondition = isset($docQues->is_condition) && $docQues->is_condition != null;
                                                            $isConditionType1 = $isCondition && $docQues->is_condition == 1 && $docQues->condition_type == 1 || $docQues->condition_type == 3;
                                                            $conditions = $isConditionType1 ? json_decode($docQues->conditions) : [];
                                                       @endphp

                                                       @if($isConditionType1 && !empty($conditions))
                                                            <div class="cond_ques_div{{ $docQues->id ?? '' }}" style="display:block;">
                                                                 <div class="col-md-12">
                                                                      <div class="form-group">
                                                                           <label class="form-label" for="">Add conditional questions label</label>
                                                                      </div>
                                                                 </div>
                                                                 <div class="append_label_condition" id="append_label_condition{{ $docQues->id ?? '' }}">
                                                                 @foreach($conditions as $condition)
                                                                      @if($condition->condition_type == 'question_label_condition')
                                                                      <div class="label-condition" id="label-condition{{ $condition->id ?? '' }}" data-id="{{ $condition->id ?? '' }}" data-is_new="false">
                                                                           <hr>
                                                                           <div class="text-end">
                                                                                <div class="form-group">
                                                                                     <span onclick="removeLabel(this)" data-id="{{ $condition->id ?? '' }}">
                                                                                          <i class="fa fa-times"></i>
                                                                                     </span>
                                                                                </div>
                                                                           </div>
                                                                           <div class="row">
                                                                                <div class="col-md-4">
                                                                                     <div class="form-group">
                                                                                          <label class="form-label" for="condition_question_label-{{ $condition->id ?? '' }}">Label</label>
                                                                                          <input type="text" class="form-control" id="condition_question_label-{{ $condition->id ?? '' }}" name="condition_question_label-{{ $condition->id ?? '' }}[]" value="{{ $condition->question_label ?? '' }}">
                                                                                     </div>
                                                                                </div>
                                                                                <div class="col-md-4">
                                                                                     <div class="form-group">
                                                                                          <label class="form-label" for="label_qu_id-{{ $condition->id ?? '' }}">Question ID</label>
                                                                                          <select class="form-select js-select2 new_label_question_id" name="label_qu_id-{{ $condition->id ?? '' }}[]" id="label_qu_id-{{ $condition->id ?? '' }}">
                                                                                               @foreach($questions ?? [] as $question)
                                                                                                    <option value="{{ $question->getName() ?? '' }}" {{ $condition->conditional_question_id == $question->getName() ? 'selected' : '' }}>
                                                                                                    {{ $question->getName() ?? '' }}
                                                                                                    </option>
                                                                                               @endforeach
                                                                                          </select>
                                                                                     </div>
                                                                                </div>
                                                                                <div class="col-md-4">
                                                                                     <div class="form-group">
                                                                                          <label class="form-label" for="condition_question_value-{{ $condition->id ?? '' }}">Value</label>
                                                                                          <input type="text" class="form-control" id="condition_question_value-{{ $condition->id ?? '' }}" name="condition_question_value-{{ $condition->id ?? '' }}[]" value="{{ $condition->conditional_question_value ?? '' }}">
                                                                                     </div>
                                                                                </div>
                                                                           </div>
                                                                           <br>
                                                                      </div>
                                                                      @endif
                                                                 @endforeach
                                                                 </div>
                                                                 <div class="text-end">
                                                                      <div class="form-group">
                                                                           <button type="button" class="btn btn-sm btn-primary" onclick="addLabel('{{ $docQues->id ?? '' }}')">Add Label</button>
                                                                      </div>
                                                                 </div>
                                                                 <hr>
                                                            </div>
                                                       @else
                                                       <div class="cond_ques_div{{ $docQues->id ?? '' }}" style="display:none;">
                                                            <div class="col-md-12">
                                                                 <div class="form-group">
                                                                      <label class="form-label" for="">Add conditional questions label</label>
                                                                 </div>
                                                            </div>
                                                            <div class="append_label_condition" id="append_label_condition{{ $docQues->id ?? '' }}"></div>
                                                            <div class="text-end">
                                                                 <div class="form-group">
                                                                      <button type="button" class="btn btn-sm btn-primary" onclick="addLabel('{{ $docQues->id ?? '' }}')">Add Label</button>
                                                                 </div>
                                                            </div>
                                                            <hr>
                                                       </div>
                                                       @endif
                                                       @if($isCondition)
                                                       <div class="col-md-12 hide_question_label" id="hide_question_label{{ $docQues->id ?? '' }}" style="display:none;">
                                                            <div class="form-group">
                                                                 <label class="form-label" for="text_qu_label-{{ $docQues->id ?? '' }}">Question Label</label>
                                                                 <input type="text" class="form-control question_labl" id="text_qu_label-{{ $docQues->id ?? '' }}" name="text_qu_label-${newUniqueId}" value="{{ $docQues->questionData->question_label ?? '' }}">
                                                            </div>
                                                            <hr>
                                                       </div>
                                                       @else
                                                       <div class="col-md-12 hide_question_label" id="hide_question_label{{ $docQues->id ?? '' }}">
                                                            <div class="form-group">
                                                                 <label class="form-label" for="text_qu_label-{{ $docQues->id ?? '' }}">Question Label</label>
                                                                 <input type="text" class="form-control question_labl" id="text_qu_label-{{ $docQues->id ?? '' }}" name="text_qu_label-${newUniqueId}" value="{{ $docQues->questionData->question_label ?? '' }}">
                                                            </div>
                                                            <hr>
                                                       </div>
                                                       @endif
                                                       <div class="col-md-12">
                                                            <div class="form-group">
                                                                 <label class="form-label" for="text_placeholder-{{ $docQues->id ?? '' }}">Text Box Placeholder</label>
                                                                 <input type="text" class="form-control text_box_placeholder" id="text_placeholder-{{ $docQues->id ?? '' }}" name="text_placeholder-{{ $docQues->id ?? '' }}" value="{{ $docQues->questionData->text_box_placeholder ?? '' }}">
                                                            </div>
                                                       </div>
                                                       <hr>
                                                       <div class="col-md-12">
                                                            <div class="form-group">
                                                                 <label class="form-label" for="text_go_to_step-{{ $docQues->id ?? '' }}">Go to step</label>
                                                                 <div class="form-control-wrap"> 
                                                                      <select class="form-select js-select2 new_label_question_id" data-search="on" name="text_go_to_step-{{ $docQues->id ?? '' }}" id="text_go_to_step-${newUniqueId}">
                                                                      <option value=""></option>
                                                                      @if(isset($questions) && $questions != null)
                                                                           @foreach($questions as $question)
                                                                           <option value="{{ $question->getName() ?? '' }}" {{ $docQues->questionData->next_question_id == $question->getName() ? 'selected' : '' }}> 
                                                                           {{ $question->getName() ?? '' }}
                                                                           </option>
                                                                           @endforeach
                                                                      @endif
                                                                      </select>
                                                                 </div>
                                                            </div>
                                                       </div>
                                                       <hr>
                                                       <div class="col-md-12">
                                                            <div class="form-group">
                                                                 <label class="form-label" for="">Conditional Go to step Settings</label>
                                                            </div>
                                                       </div>
                                                       <div class="custom-control custom-checkbox checked">
                                                            @if(isset($docQues->is_condition) && $docQues->is_condition != null)
                                                                 @if($docQues->is_condition == 1 && $docQues->condition_type == 2 || $docQues->condition_type == 3)
                                                                 <input type="checkbox" class="custom-control-input enable_conditional" id="condition_go_to{{ $docQues->id ?? '' }}" name="condition_go_to{{ $docQues->id ?? '' }}" checked>
                                                                 <label class="custom-control-label" for="condition_go_to{{ $docQues->id ?? '' }}">Enable Conditional Go To Step Settings</label>
                                                                 @else
                                                                 <input type="checkbox" class="custom-control-input enable_conditional" id="condition_go_to{{ $docQues->id ?? '' }}" name="condition_go_to{{ $docQues->id ?? '' }}">
                                                                 <label class="custom-control-label" for="condition_go_to{{ $docQues->id ?? '' }}">Enable Conditional Go To Step Settings</label>
                                                                 @endif
                                                            @else
                                                            <input type="checkbox" class="custom-control-input enable_conditional" id="condition_go_to{{ $docQues->id ?? '' }}" name="condition_go_to{{ $docQues->id ?? '' }}">
                                                            <label class="custom-control-label" for="condition_go_to{{ $docQues->id ?? '' }}">Enable Conditional Go To Step Settings</label>
                                                            @endif
                                                       </div>
                                                       <hr>
                                                       @php
                                                            $isCondition = isset($docQues->is_condition) && $docQues->is_condition != null;
                                                            $isConditionType2 = $isCondition && $docQues->is_condition == 1 && $docQues->condition_type == 2 || $docQues->condition_type == 3;
                                                            $enable_conditions = $isConditionType2 ? json_decode($docQues->conditions) : [];
                                                       @endphp

                                                       @if($isConditionType2 && !empty($enable_conditions))
                                                       <div class="cond_div{{ $docQues->id ?? '' }}">
                                                            <div class="col-md-12">
                                                                 <div class="form-group">
                                                                      <label class="form-label" for="">Add Conditions</label>
                                                                 </div>
                                                            </div>
                                                            <div class="append_page_condition" id="append_page_condition{{ $docQues->id ?? '' }}">
                                                            @foreach($enable_conditions as $condition)
                                                                 @if($condition->condition_type == 'go_to_step_condition')
                                                                 <div class="sec-condition" id="sec-condition{{ $condition->id ?? '' }}" data-id="{{ $condition->id ?? '' }}" data-is_new=false>
                                                                      <hr>
                                                                      <div class="text-end">
                                                                           <div class="form-group">
                                                                                <div>
                                                                                     <span onclick="removeCondition(this)" data-id="{{ $condition->id ?? '' }}">
                                                                                          <i class="fa fa-times"></i>
                                                                                     </span>
                                                                                </div>
                                                                           </div>
                                                                      </div>
                                                                      <div class="row">
                                                                           <div class="col-md-4">
                                                                                <div class="form-group">
                                                                                     <label class="form-label" for="page_Setting_qu_id-{{ $condition->id ?? '' }}">Question ID</label>
                                                                                     <div class="form-control-wrap question"> 
                                                                                          <select class="form-select js-select2" data-search="on" name="page_Setting_qu_id-{{ $condition->id ?? '' }}[]" id="page_Setting_qu_id-{{ $condition->id ?? '' }}">
                                                                                               @if(isset($questions) && $questions != null)
                                                                                                    @foreach($questions ?? [] as $question)
                                                                                                         <option value="{{ $question->getName() ?? '' }}" {{ $condition->conditional_question_id == $question->getName() ? 'selected' : '' }}>
                                                                                                         {{ $question->getName() ?? '' }}
                                                                                                         </option>
                                                                                                    @endforeach
                                                                                               @endif
                                                                                          </select>
                                                                                     </div>
                                                                                </div>
                                                                           </div>
                                                                           <div class="col-md-4">
                                                                                <div class="form-group">
                                                                                     <label class="form-label" for="page_Setting_conditions-{{ $condition->id ?? '' }}">Condition</label>
                                                                                     <div class="form-control-wrap"> 
                                                                                          <select class="form-select js-select2" name="page_Setting_conditions-{{ $condition->id ?? '' }}[]" id="page_Setting_conditions-{{ $condition->id ?? '' }}">
                                                                                               <option value="" selected disabled>Select</option>
                                                                                               @if(isset($condition->conditional_check) && $condition->conditional_check != null)
                                                                                               @if($condition->conditional_check == 1)
                                                                                                    <option value="is_equal_to" selected>is equal to</option>
                                                                                                    @else
                                                                                                    <option value="is_equal_to">is equal to</option>
                                                                                                    @endif

                                                                                                    @if($condition->conditional_check == 2)
                                                                                                    <option value="is_greater_than" selected>is greater than</option>
                                                                                                    @else
                                                                                                    <option value="is_greater_than">is greater than</option>
                                                                                                    @endif

                                                                                                    @if($condition->conditional_check == 3)
                                                                                                    <option value="is_less_than" selected>is less than</option>
                                                                                                    @else
                                                                                                    <option value="is_less_than">is less than</option>
                                                                                                    @endif

                                                                                                    @if($condition->conditional_check == 4)
                                                                                                    <option value="not_equal_to" selected>not equal to</option>
                                                                                                    @else
                                                                                                    <option value="not_equal_to">not equal to</option>
                                                                                                    @endif
                                                                                               @else
                                                                                               <option value="is_equal_to">is equal to</option>
                                                                                               <option value="is_greater_than">is greater than</option>
                                                                                               <option value="is_less_than">is less than</option>
                                                                                               <option value="not_equal_to">not equal to</option>
                                                                                               @endif
                                                                                          </select>
                                                                                     </div>
                                                                                </div>
                                                                           </div>
                                                                           <div class="col-md-4">
                                                                                <div class="form-group">
                                                                                     <label class="form-label" for="page_Setting_qu_val-{{ $condition->id ?? '' }}">Value</label>
                                                                                     <input type="text" class="form-control" id="page_Setting_qu_val-{{ $condition->id ?? '' }}" name="page_Setting_qu_val-{{ $condition->id ?? '' }}[]" value="{{ $condition->conditional_question_value ?? '' }}">
                                                                                </div>
                                                                           </div>
                                                                      </div>
                                                                      <br>
                                                                 </div>
                                                                 @endif
                                                            @endforeach
                                                            </div>
                                                            <div class="text-end">
                                                                 <div class="form-group">
                                                                      <button type="button" class="btn btn-sm btn-primary" onclick="addCondition('{{ $docQues->id ?? '' }}')">Add Condition</button>
                                                                 </div>
                                                            </div>
                                                       </div>
                                                       @else
                                                       <div class="cond_div{{ $docQues->id ?? '' }}" style="display:none">
                                                            <div class="col-md-12">
                                                                 <div class="form-group">
                                                                      <label class="form-label" for="">Add Conditions</label>
                                                                 </div>
                                                            </div>
                                                            <div class="append_page_condition" id="append_page_condition{{ $docQues->id ?? '' }}"></div>
                                                            <div class="text-end">
                                                                 <div class="form-group">
                                                                      <button type="button" class="btn btn-sm btn-primary" onclick="addCondition('{{ $docQues->id ?? '' }}')">Add Condition</button>
                                                                 </div>
                                                            </div>
                                                            <hr>
                                                       </div>
                                                       @endif
                                                  </div>
                                             </div>
                                             <br>
                                        </div>
                                   </div>
                                   @elseif($docQues->type == 'dropdown')
                                   <div class="new_que_sec{{ $docQues->id ?? '' }}">
                                        <div class="append_dropdown" id="append_dropdown{{ $docQues->id ?? '' }}" data-id="{{ $docQues->id ?? '' }}" data-is_new=false>
                                             <div class="card card-bordered card-preview">
                                                  <div class="card-inner">
                                                       <div class="row add_step">
                                                            <div class="col-md-1">
                                                                 <b><p>{{ $num++ ?? ''}}</p></b>
                                                            </div>
                                                            <div class="col-md-6">
                                                                 <h6>Dropdown</h6>  
                                                                 <!-- <div class="form-group">
                                                                       <select class="form-select js-select2 new_question" name="question_type{{ $docQues->id ?? '' }}" id="question_type{{ $docQues->id ?? '' }}">
                                                                           @foreach($types as $type)
                                                                                @if($docQues->type == $type->slug)
                                                                                <option value="{{ $type->slug ?? '' }}" selected>{{ $type->name ?? '' }}</option>
                                                                                @else
                                                                                <option value="{{ $type->slug ?? '' }}">{{ $type->name ?? '' }}</option>
                                                                                @endif
                                                                           @endforeach
                                                                      </select> 
                                                                 </div> -->
                                                            </div> 
                                                            <div class="col-md-5">
                                                                 <div class="form-group">
                                                                      <span class="col-md-2 offset-md-10">
                                                                           <span onclick="removeFields(this)" data-id="{{ $docQues->id ?? '' }}" data-field="dropdown"><i class="fa-solid fa-minus"></i></span>
                                                                      </span>  
                                                                 </div>
                                                            </div>
                                                       </div>
                                                       <hr>
                                                       <div class="col-md-12">
                                                            <div class="form-group">
                                                                 <label class="form-label" for="">Conditional questions label</label>
                                                            </div>
                                                       </div>
                                                       <div class="custom-control custom-checkbox">
                                                       @if(isset($docQues->is_condition) && $docQues->is_condition != null)
                                                            @if($docQues->is_condition == 1 && $docQues->condition_type == 1 || $docQues->condition_type == 3)
                                                            <input type="checkbox" class="custom-control-input add_conditional_label" id="condition_qu_label{{ $docQues->id ?? '' }}" name="condition_qu_label{{ $docQues->id ?? '' }}" checked>
                                                            <label class="custom-control-label" for="condition_qu_label{{ $docQues->id ?? '' }}">Conditional questions label</label>
                                                            @else
                                                            <input type="checkbox" class="custom-control-input add_conditional_label" id="condition_qu_label{{ $docQues->id ?? '' }}" name="condition_qu_label{{ $docQues->id ?? '' }}">
                                                            <label class="custom-control-label" for="condition_qu_label{{ $docQues->id ?? '' }}">Conditional questions label</label>
                                                            @endif
                                                       @else
                                                       <input type="checkbox" class="custom-control-input add_conditional_label" id="condition_qu_label{{ $docQues->id ?? '' }}" name="condition_qu_label{{ $docQues->id ?? '' }}">
                                                       <label class="custom-control-label" for="condition_qu_label{{ $docQues->id ?? '' }}">Conditional questions label</label>
                                                       @endif
                                                       </div>
                                                       <hr>
                                                       @php
                                                            $isCondition = isset($docQues->is_condition) && $docQues->is_condition != null;
                                                            $isConditionType1 = $isCondition && $docQues->is_condition == 1 && $docQues->condition_type == 1 || $docQues->condition_type == 3;
                                                            $conditions = $isConditionType1 ? json_decode($docQues->conditions) : [];
                                                       @endphp

                                                       @if($isConditionType1 && !empty($conditions))
                                                            <div class="cond_ques_div{{ $docQues->id ?? '' }}" style="display:block;">
                                                                 <div class="col-md-12">
                                                                      <div class="form-group">
                                                                           <label class="form-label" for="">Add conditional questions label</label>
                                                                      </div>
                                                                 </div>
                                                                 <div class="append_label_condition" id="append_label_condition{{ $docQues->id ?? '' }}">
                                                                 @foreach($conditions as $condition)
                                                                      @if($condition->condition_type == 'question_label_condition')
                                                                      <div class="label-condition" id="label-condition{{ $condition->id ?? '' }}" data-id="{{ $condition->id ?? '' }}" data-is_new="false">
                                                                           <hr>
                                                                           <div class="text-end">
                                                                                <div class="form-group">
                                                                                     <span onclick="removeLabel(this)" data-id="{{ $condition->id ?? '' }}">
                                                                                          <i class="fa fa-times"></i>
                                                                                     </span>
                                                                                </div>
                                                                           </div>
                                                                           <div class="row">
                                                                                <div class="col-md-4">
                                                                                     <div class="form-group">
                                                                                          <label class="form-label" for="condition_question_label-{{ $condition->id ?? '' }}">Label</label>
                                                                                          <input type="text" class="form-control" id="condition_question_label-{{ $condition->id ?? '' }}" name="condition_question_label-{{ $condition->id ?? '' }}[]" value="{{ $condition->question_label ?? '' }}">
                                                                                     </div>
                                                                                </div>
                                                                                <div class="col-md-4">
                                                                                     <div class="form-group">
                                                                                          <label class="form-label" for="label_qu_id-{{ $condition->id ?? '' }}">Question ID</label>
                                                                                          <select class="form-select js-select2 new_label_question_id" name="label_qu_id-{{ $condition->id ?? '' }}[]" id="label_qu_id-{{ $condition->id ?? '' }}">
                                                                                               @foreach($questions ?? [] as $question)
                                                                                                    <option value="{{ $question->getName() ?? '' }}" {{ $condition->conditional_question_id == $question->getName() ? 'selected' : '' }}>
                                                                                                    {{ $question->getName() ?? '' }}
                                                                                                    </option>
                                                                                               @endforeach
                                                                                          </select>
                                                                                     </div>
                                                                                </div>
                                                                                <div class="col-md-4">
                                                                                     <div class="form-group">
                                                                                          <label class="form-label" for="condition_question_value-{{ $condition->id ?? '' }}">Value</label>
                                                                                          <input type="text" class="form-control" id="condition_question_value-{{ $condition->id ?? '' }}" name="condition_question_value-{{ $condition->id ?? '' }}[]" value="{{ $condition->conditional_question_value ?? '' }}">
                                                                                     </div>
                                                                                </div>
                                                                           </div>
                                                                           <br>
                                                                      </div>
                                                                      @endif
                                                                 @endforeach
                                                                 </div>
                                                                 <div class="text-end">
                                                                      <div class="form-group">
                                                                           <button type="button" class="btn btn-sm btn-primary" onclick="addLabel('{{ $docQues->id ?? '' }}')">Add Label</button>
                                                                      </div>
                                                                 </div>
                                                                 <hr>
                                                            </div>
                                                       @else
                                                       <div class="cond_ques_div{{ $docQues->id ?? '' }}" style="display:none;">
                                                            <div class="col-md-12">
                                                                 <div class="form-group">
                                                                      <label class="form-label" for="">Add conditional questions label</label>
                                                                 </div>
                                                            </div>
                                                            <div class="append_label_condition" id="append_label_condition{{ $docQues->id ?? '' }}"></div>
                                                            <div class="text-end">
                                                                 <div class="form-group">
                                                                      <button type="button" class="btn btn-sm btn-primary" onclick="addLabel('{{ $docQues->id ?? '' }}')">Add Label</button>
                                                                 </div>
                                                            </div>
                                                            <hr>
                                                       </div>
                                                       @endif
                                                       @if($isCondition)
                                                       <div class="col-md-12 hide_question_label" id="hide_question_label{{ $docQues->id ?? '' }}" style="display:none;">
                                                            <div class="form-group">
                                                                 <label class="form-label" for="text_qu_label-{{ $docQues->id ?? '' }}">Question Label</label>
                                                                 <input type="text" class="form-control question_labl" id="text_qu_label-{{ $docQues->id ?? '' }}" name="text_qu_label-${newUniqueId}" value="{{ $docQues->questionData->question_label ?? '' }}">
                                                            </div>
                                                            <hr>
                                                       </div>
                                                       @else
                                                       <div class="col-md-12 hide_question_label" id="hide_question_label{{ $docQues->id ?? '' }}">
                                                            <div class="form-group">
                                                                 <label class="form-label" for="text_qu_label-{{ $docQues->id ?? '' }}">Question Label</label>
                                                                 <input type="text" class="form-control question_labl" id="text_qu_label-{{ $docQues->id ?? '' }}" name="text_qu_label-${newUniqueId}" value="{{ $docQues->questionData->question_label ?? '' }}">
                                                            </div>
                                                            <hr>
                                                       </div>
                                                       @endif
                                                       <div class="col-md-12">
                                                            <div class="form-group">
                                                                 <label class="form-label" for="">Add Dropdown Option</label>
                                                            </div>
                                                       </div>
                                                       <div class="append_options" id="append_options{{ $docQues->id ?? '' }}">
                                                            @if(isset($docQues->options) && $docQues->options != null)
                                                            <?php $options = json_decode($docQues->options); ?>
                                                            @foreach($options as $option)
                                                            <div class="dropdown-option" id="dropdown-option{{ $option->id ?? '' }}" data-id="{{ $option->id ?? '' }}" data-is_new=false>
                                                                 <hr>
                                                                 <div class="text-end">
                                                                      <div class="form-group">
                                                                           <div>
                                                                                <span onclick="removeOptions(this)" data-id="{{ $option->id ?? '' }}" data-field="dropdown">
                                                                                     <i class="fa fa-times"></i>
                                                                                </span>
                                                                           </div>
                                                                      </div>
                                                                 </div>
                                                                 <div class="row">
                                                                      <div class="col-md-4">
                                                                           <div class="form-group">
                                                                                <label class="form-label" for="dropdown_option_label-{{ $option->id ?? '' }}">Label</label>
                                                                                <input type="text" class="form-control" id="dropdown_option_label-{{ $option->id ?? '' }}" name="dropdown_option_label-{{ $option->id ?? '' }}[]" value="{{ $option->option_label ?? '' }}">
                                                                           </div>
                                                                      </div>
                                                                      <div class="col-md-4">
                                                                           <div class="form-group">
                                                                                <label class="form-label" for="dropdown_option_value-{{ $option->id ?? '' }}">Value</label>
                                                                                <input type="text" class="form-control" id="dropdown_option_value-{{ $option->id ?? '' }}" name="dropdown_option_value-{{ $option->id ?? '' }}[]" value="{{ $option->option_value ?? '' }}">
                                                                           </div>
                                                                      </div>
                                                                      <div class="col-md-4">
                                                                           <div class="form-group">
                                                                                <label class="form-label" for="dropdown_go_to_step-{{ $option->id ?? '' }}">Go to Step</label>
                                                                                <div class="form-control-wrap"> 
                                                                                     <select class="form-select js-select2 new_label_question_id" data-search="on" name="dropdown_go_to_step-{{ $option->id ?? '' }}[]" id="dropdown_go_to_step-{{ $option->id ?? '' }}">
                                                                                          <option value=""></option>
                                                                                          @if(isset($questions) && $questions != null)
                                                                                               @foreach($questions as $question)
                                                                                                   <option value="{{ $question->getName() ?? '' }}" {{ $option->next_question_id == $question->getName() ? 'selected': '' }}>
                                                                                                   {{ $question->getName() ?? '' }}
                                                                                                   </option>
                                                                                               @endforeach
                                                                                          @endif
                                                                                     </select>
                                                                                </div>
                                                                           </div>
                                                                      </div>
                                                                 </div>
                                                                 <br>
                                                            </div>
                                                            @endforeach
                                                            @endif
                                                       </div>
                                                       <div class="text-end">
                                                            <div class="form-group">
                                                                 <button type="button" class="btn btn-sm btn-primary" onclick="addOptions('dropdown','{{ $docQues->id ?? '' }}')">Add Option</button>
                                                            </div>
                                                       </div>
                                                       <div class="col-md-12">
                                                            <div class="form-group">
                                                                 <label class="form-label" for="">Conditional Go to step Settings</label>
                                                            </div>
                                                       </div>
                                                       <div class="custom-control custom-checkbox checked">
                                                            @if(isset($docQues->is_condition) && $docQues->is_condition != null)
                                                                 @if($docQues->is_condition == 1 && $docQues->condition_type == 2 || $docQues->condition_type == 3)
                                                                 <input type="checkbox" class="custom-control-input enable_conditional" id="condition_go_to{{ $docQues->id ?? '' }}" name="condition_go_to{{ $docQues->id ?? '' }}" checked>
                                                                 <label class="custom-control-label" for="condition_go_to{{ $docQues->id ?? '' }}">Enable Conditional Go To Step Settings</label>
                                                                 @else
                                                                 <input type="checkbox" class="custom-control-input enable_conditional" id="condition_go_to{{ $docQues->id ?? '' }}" name="condition_go_to{{ $docQues->id ?? '' }}">
                                                                 <label class="custom-control-label" for="condition_go_to{{ $docQues->id ?? '' }}">Enable Conditional Go To Step Settings</label>
                                                                 @endif
                                                            @else
                                                            <input type="checkbox" class="custom-control-input enable_conditional" id="condition_go_to{{ $docQues->id ?? '' }}" name="condition_go_to{{ $docQues->id ?? '' }}">
                                                            <label class="custom-control-label" for="condition_go_to{{ $docQues->id ?? '' }}">Enable Conditional Go To Step Settings</label>
                                                            @endif
                                                       </div>
                                                       <hr>
                                                       @php
                                                            $isCondition = isset($docQues->is_condition) && $docQues->is_condition != null;
                                                            $isConditionType2 = $isCondition && $docQues->is_condition == 1 && $docQues->condition_type == 2 || $docQues->condition_type == 3;
                                                            $enable_conditions = $isConditionType2 ? json_decode($docQues->conditions) : [];
                                                       @endphp

                                                       @if($isConditionType2 && !empty($enable_conditions))
                                                       <div class="cond_div{{ $docQues->id ?? '' }}">
                                                            <div class="col-md-12">
                                                                 <div class="form-group">
                                                                      <label class="form-label" for="">Add Conditions</label>
                                                                 </div>
                                                            </div>
                                                            <div class="append_page_condition" id="append_page_condition{{ $docQues->id ?? '' }}">
                                                            @foreach($enable_conditions as $condition)
                                                                 @if($condition->condition_type == 'go_to_step_condition')
                                                                 <div class="sec-condition" id="sec-condition{{ $condition->id ?? '' }}"  data-id="{{ $condition->id ?? '' }}" data-is_new=false>
                                                                      <hr>
                                                                      <div class="text-end">
                                                                           <div class="form-group">
                                                                                <div>
                                                                                     <span onclick="removeCondition(this)"  data-id="{{ $condition->id ?? '' }}">
                                                                                          <i class="fa fa-times"></i>
                                                                                     </span>
                                                                                </div>
                                                                           </div>
                                                                      </div>
                                                                      <div class="row">
                                                                           <div class="col-md-4">
                                                                                <div class="form-group">
                                                                                     <label class="form-label" for="page_Setting_qu_id-{{ $condition->id ?? '' }}">Question ID</label>
                                                                                     <div class="form-control-wrap question"> 
                                                                                          <select class="form-select js-select2" data-search="on" name="page_Setting_qu_id-{{ $condition->id ?? '' }}[]" id="page_Setting_qu_id-{{ $condition->id ?? '' }}">
                                                                                               @if(isset($questions) && $questions != null)
                                                                                                    @foreach($questions ?? [] as $question)
                                                                                                         <option value="{{ $question->getName() ?? '' }}" {{ $condition->conditional_question_id == $question->getName() ? 'selected' : '' }}>
                                                                                                         {{ $question->getName() ?? '' }}
                                                                                                         </option>
                                                                                                    @endforeach
                                                                                               @endif
                                                                                          </select>
                                                                                     </div>
                                                                                </div>
                                                                           </div>
                                                                           <div class="col-md-4">
                                                                                <div class="form-group">
                                                                                     <label class="form-label" for="page_Setting_conditions-{{ $condition->id ?? '' }}">Condition</label>
                                                                                     <div class="form-control-wrap"> 
                                                                                          <select class="form-select js-select2" name="page_Setting_conditions-{{ $condition->id ?? '' }}[]" id="page_Setting_conditions-{{ $condition->id ?? '' }}">
                                                                                               <option value="" selected disabled>Select</option>
                                                                                               @if(isset($condition->conditional_check) && $condition->conditional_check != null)
                                                                                               @if($condition->conditional_check == 1)
                                                                                                    <option value="is_equal_to" selected>is equal to</option>
                                                                                                    @else
                                                                                                    <option value="is_equal_to">is equal to</option>
                                                                                                    @endif

                                                                                                    @if($condition->conditional_check == 2)
                                                                                                    <option value="is_greater_than" selected>is greater than</option>
                                                                                                    @else
                                                                                                    <option value="is_greater_than">is greater than</option>
                                                                                                    @endif

                                                                                                    @if($condition->conditional_check == 3)
                                                                                                    <option value="is_less_than" selected>is less than</option>
                                                                                                    @else
                                                                                                    <option value="is_less_than">is less than</option>
                                                                                                    @endif

                                                                                                    @if($condition->conditional_check == 4)
                                                                                                    <option value="not_equal_to" selected>not equal to</option>
                                                                                                    @else
                                                                                                    <option value="not_equal_to">not equal to</option>
                                                                                                    @endif
                                                                                               @else
                                                                                               <option value="is_equal_to">is equal to</option>
                                                                                               <option value="is_greater_than">is greater than</option>
                                                                                               <option value="is_less_than">is less than</option>
                                                                                               <option value="not_equal_to">not equal to</option>
                                                                                               @endif
                                                                                          </select>
                                                                                     </div>
                                                                                </div>
                                                                           </div>
                                                                           <div class="col-md-4">
                                                                                <div class="form-group">
                                                                                     <label class="form-label" for="page_Setting_qu_val-{{ $condition->id ?? '' }}">Value</label>
                                                                                     <input type="text" class="form-control" id="page_Setting_qu_val-{{ $condition->id ?? '' }}" name="page_Setting_qu_val-{{ $condition->id ?? '' }}[]" value="{{ $condition->conditional_question_value ?? '' }}">
                                                                                </div>
                                                                           </div>
                                                                      </div>
                                                                      <br>
                                                                 </div>
                                                                 @endif
                                                            @endforeach
                                                            </div>
                                                            <div class="text-end">
                                                                 <div class="form-group">
                                                                      <button type="button" class="btn btn-sm btn-primary" onclick="addCondition('{{ $docQues->id ?? '' }}')">Add Condition</button>
                                                                 </div>
                                                            </div>
                                                       </div>
                                                       @else
                                                       <div class="cond_div{{ $docQues->id ?? '' }}" style="display:none">
                                                            <div class="col-md-12">
                                                                 <div class="form-group">
                                                                      <label class="form-label" for="">Add Conditions</label>
                                                                 </div>
                                                            </div>
                                                            <div class="append_page_condition" id="append_page_condition{{ $docQues->id ?? '' }}"></div>
                                                            <div class="text-end">
                                                                 <div class="form-group">
                                                                      <button type="button" class="btn btn-sm btn-primary" onclick="addCondition('{{ $docQues->id ?? '' }}')">Add Condition</button>
                                                                 </div>
                                                            </div>
                                                            <hr>
                                                       </div>
                                                       @endif
                                                  </div>
                                             </div>
                                             <br>
                                        </div>
                                   </div>
                                   @elseif($docQues->type == 'radio-button')
                                   <div class="new_que_sec{{ $docQues->id ?? '' }}">
                                        <div class="append_radio" id="append_radio{{ $docQues->id ?? '' }}" data-id="{{ $docQues->id ?? '' }}" data-is_new=false>
                                             <div class="card card-bordered card-preview">
                                                  <div class="card-inner">
                                                       <div class="row add_step">
                                                            <div class="col-md-1">
                                                                 <b><p>{{ $num++ ?? ''}}</p></b>
                                                            </div>
                                                            <div class="col-md-6">
                                                                 <h6>Radio Button</h6> 
                                                                 <!-- <div class="form-group">
                                                                      <select class="form-select js-select2 new_question" name="question_type{{ $docQues->id ?? '' }}" id="question_type{{ $docQues->id ?? '' }}">
                                                                           @foreach($types as $type)
                                                                                @if($docQues->type == $type->slug)
                                                                                <option value="{{ $type->slug ?? '' }}" selected>{{ $type->name ?? '' }}</option>
                                                                                @else
                                                                                <option value="{{ $type->slug ?? '' }}">{{ $type->name ?? '' }}</option>
                                                                                @endif
                                                                           @endforeach
                                                                      </select>
                                                                 </div>   -->
                                                            </div> 
                                                            <div class="col-md-5">
                                                                 <div class="form-group">
                                                                      <span class="col-md-2 offset-md-10">
                                                                           <span onclick="removeFields(this)" data-id="{{ $docQues->id ?? '' }}" data-field="radio-button"><i class="fa-solid fa-minus"></i></span>
                                                                      </span>  
                                                                 </div>
                                                            </div>
                                                       </div>
                                                       <hr>
                                                       <div class="col-md-12">
                                                            <div class="form-group">
                                                                 <label class="form-label" for="">Conditional questions label</label>
                                                            </div>
                                                       </div>
                                                       <div class="custom-control custom-checkbox">
                                                       @if(isset($docQues->is_condition) && $docQues->is_condition != null)
                                                            @if($docQues->is_condition == 1 && $docQues->condition_type == 1 || $docQues->condition_type == 3)
                                                            <input type="checkbox" class="custom-control-input add_conditional_label" id="condition_qu_label{{ $docQues->id ?? '' }}" name="condition_qu_label{{ $docQues->id ?? '' }}" checked>
                                                            <label class="custom-control-label" for="condition_qu_label{{ $docQues->id ?? '' }}">Conditional questions label</label>
                                                            @else
                                                            <input type="checkbox" class="custom-control-input add_conditional_label" id="condition_qu_label{{ $docQues->id ?? '' }}" name="condition_qu_label{{ $docQues->id ?? '' }}">
                                                            <label class="custom-control-label" for="condition_qu_label{{ $docQues->id ?? '' }}">Conditional questions label</label>
                                                            @endif
                                                       @else
                                                            <input type="checkbox" class="custom-control-input add_conditional_label" id="condition_qu_label{{ $docQues->id ?? '' }}" name="condition_qu_label{{ $docQues->id ?? '' }}">
                                                            <label class="custom-control-label" for="condition_qu_label{{ $docQues->id ?? '' }}">Conditional questions label</label>
                                                       @endif
                                                       </div>
                                                       <hr>
                                                       @php
                                                            $isCondition = isset($docQues->is_condition) && $docQues->is_condition != null;
                                                            $isConditionType1 = $isCondition && $docQues->is_condition == 1 && $docQues->condition_type == 1 || $docQues->condition_type == 3;
                                                            $conditions = $isConditionType1 ? json_decode($docQues->conditions) : [];
                                                       @endphp

                                                       @if($isConditionType1 && !empty($conditions))
                                                            <div class="cond_ques_div{{ $docQues->id ?? '' }}" style="display:block;">
                                                                 <div class="col-md-12">
                                                                      <div class="form-group">
                                                                           <label class="form-label" for="">Add conditional questions label</label>
                                                                      </div>
                                                                 </div>
                                                                 <div class="append_label_condition" id="append_label_condition{{ $docQues->id ?? '' }}">
                                                                 @foreach($conditions as $condition)
                                                                      @if($condition->condition_type == 'question_label_condition')
                                                                      <div class="label-condition" id="label-condition{{ $condition->id ?? '' }}" data-id="{{ $condition->id ?? '' }}" data-is_new="false">
                                                                           <hr>
                                                                           <div class="text-end">
                                                                                <div class="form-group">
                                                                                     <span onclick="removeLabel(this)" data-id="{{ $condition->id ?? '' }}">
                                                                                          <i class="fa fa-times"></i>
                                                                                     </span>
                                                                                </div>
                                                                           </div>
                                                                           <div class="row">
                                                                                <div class="col-md-4">
                                                                                     <div class="form-group">
                                                                                          <label class="form-label" for="condition_question_label-{{ $condition->id ?? '' }}">Label</label>
                                                                                          <input type="text" class="form-control" id="condition_question_label-{{ $condition->id ?? '' }}" name="condition_question_label-{{ $condition->id ?? '' }}[]" value="{{ $condition->question_label ?? '' }}">
                                                                                     </div>
                                                                                </div>
                                                                                <div class="col-md-4">
                                                                                     <div class="form-group">
                                                                                          <label class="form-label" for="label_qu_id-{{ $condition->id ?? '' }}">Question ID</label>
                                                                                          <select class="form-select js-select2 new_label_question_id" name="label_qu_id-{{ $condition->id ?? '' }}[]" id="label_qu_id-{{ $condition->id ?? '' }}">
                                                                                               @foreach($questions ?? [] as $question)
                                                                                                    <option value="{{ $question->getName() ?? '' }}" {{ $condition->conditional_question_id == $question->getName() ? 'selected' : '' }}>
                                                                                                    {{ $question->getName() ?? '' }}
                                                                                                    </option>
                                                                                               @endforeach
                                                                                          </select>
                                                                                     </div>
                                                                                </div>
                                                                                <div class="col-md-4">
                                                                                     <div class="form-group">
                                                                                          <label class="form-label" for="condition_question_value-{{ $condition->id ?? '' }}">Value</label>
                                                                                          <input type="text" class="form-control" id="condition_question_value-{{ $condition->id ?? '' }}" name="condition_question_value-{{ $condition->id ?? '' }}[]" value="{{ $condition->conditional_question_value ?? '' }}">
                                                                                     </div>
                                                                                </div>
                                                                           </div>
                                                                           <br>
                                                                      </div>
                                                                      @endif
                                                                 @endforeach
                                                                 </div>
                                                                 <div class="text-end">
                                                                      <div class="form-group">
                                                                           <button type="button" class="btn btn-sm btn-primary" onclick="addLabel('{{ $docQues->id ?? '' }}')">Add Label</button>
                                                                      </div>
                                                                 </div>
                                                                 <hr>
                                                            </div>
                                                       @else
                                                       <div class="cond_ques_div{{ $docQues->id ?? '' }}" style="display:none;">
                                                            <div class="col-md-12">
                                                                 <div class="form-group">
                                                                      <label class="form-label" for="">Add conditional questions label</label>
                                                                 </div>
                                                            </div>
                                                            <div class="append_label_condition" id="append_label_condition{{ $docQues->id ?? '' }}"></div>
                                                            <div class="text-end">
                                                                 <div class="form-group">
                                                                      <button type="button" class="btn btn-sm btn-primary" onclick="addLabel('{{ $docQues->id ?? '' }}')">Add Label</button>
                                                                 </div>
                                                            </div>
                                                            <hr>
                                                       </div>
                                                       @endif
                                                       <div class="col-md-12">
                                                            <div class="form-group">
                                                                 <label class="form-label" for="text_qu_label{{ $docQues->id ?? '' }}">Question Label</label>
                                                                 <input type="text" class="form-control radio_ques" id="text_qu_label{{ $docQues->id ?? '' }}" name="text_qu_label{{ $docQues->id ?? '' }}" value="{{ $docQues->questionData->question_label ?? '' }}">
                                                            </div>
                                                       </div>
                                                       <hr>
                                                       <div class="col-md-12">
                                                            <div class="form-group">
                                                                 <label class="form-label" for="">Add Radio Option</label>
                                                            </div>
                                                       </div>
                                                       <div class="append_options" id="append_options{{ $docQues->id ?? '' }}">
                                                       @if(isset($docQues->options) && $docQues->options != null)
                                                       <?php $options = json_decode($docQues->options); ?>
                                                       @foreach($options as $option)
                                                       <div class="radio-option" id="radio-option{{ $option->id ?? '' }}" data-id="{{ $option->id ?? '' }}" data-is_new=false>
                                                            <hr>
                                                            <div class="text-end">
                                                                 <div class="form-group">
                                                                      <div>
                                                                           <span onclick="removeOptions(this)" data-id="{{ $option->id ?? '' }}" data-field="radio-button">
                                                                                <i class="fa fa-times"></i>
                                                                           </span>
                                                                      </div>
                                                                 </div>
                                                            </div>
                                                            <div class="row">
                                                                 <div class="col-md-4">
                                                                      <div class="form-group">
                                                                           <label class="form-label" for="radio_option_label-{{ $option->id ?? '' }}">Label</label>
                                                                           <input type="text" class="form-control" id="radio_option_label-{{ $option->id ?? '' }}" name="radio_option_label-{{ $option->id ?? '' }}[]" value="{{ $option->option_label ?? '' }}">
                                                                      </div>
                                                                 </div>
                                                                 <div class="col-md-4">
                                                                      <div class="form-group">
                                                                           <label class="form-label" for="radio_option_value-{{ $option->id ?? '' }}">Value</label>
                                                                           <input type="text" class="form-control" id="radio_option_value-{{ $option->id ?? '' }}" name="radio_option_value-{{ $option->id ?? '' }}[]" value="{{ $option->option_value ?? '' }}">
                                                                      </div>
                                                                 </div>
                                                                 <div class="col-md-4">
                                                                      <div class="form-group">
                                                                           <label class="form-label" for="radio_go_to_step-{{ $option->id ?? '' }}">Go to Step</label>
                                                                           <div class="form-control-wrap"> 
                                                                                <select class="form-select js-select2 new_label_question_id" data-search="on" name="radio_go_to_step-{{ $option->id ?? '' }}[]" id="radio_go_to_step-{{ $option->id ?? '' }}">
                                                                                     <option value=""></option>
                                                                                     @if(isset($questions) && $questions != null)
                                                                                          @foreach($questions as $question)
                                                                                               <option value="{{ $question->getName() ?? '' }}" {{ $option->next_question_id == $question->getName() ? 'selected':'' }}>
                                                                                                    {{ $question->getName() ?? '' }}
                                                                                               </option>
                                                                                          @endforeach
                                                                                     @endif
                                                                                </select>
                                                                           </div>
                                                                      </div>
                                                                 </div>
                                                            </div>
                                                            <br>
                                                       </div>
                                                       @endforeach
                                                       @endif
                                                       </div>
                                                       <div class="text-end">
                                                            <div class="form-group">
                                                                 <button type="button" class="btn btn-sm btn-primary" onclick="addOptions('radio-button','{{ $docQues->id ?? '' }}')">Add Option</button>
                                                            </div>
                                                       </div>
                                                       <div class="col-md-12">
                                                            <div class="form-group">
                                                                 <label class="form-label" for="">Conditional Go to step Settings</label>
                                                            </div>
                                                       </div>
                                                       <div class="custom-control custom-checkbox checked">
                                                       @if(isset($docQues->is_condition) && $docQues->is_condition != null)
                                                            @if($docQues->is_condition == 1 && $docQues->condition_type == 2 || $docQues->condition_type == 3)
                                                            <input type="checkbox" class="custom-control-input enable_conditional" id="condition_go_to{{ $docQues->id ?? '' }}" name="condition_go_to{{ $docQues->id ?? '' }}" checked>
                                                            <label class="custom-control-label" for="condition_go_to{{ $docQues->id ?? '' }}">Enable Conditional Go To Step Settings</label>
                                                            @else
                                                            <input type="checkbox" class="custom-control-input enable_conditional" id="condition_go_to{{ $docQues->id ?? '' }}" name="condition_go_to{{ $docQues->id ?? '' }}">
                                                            <label class="custom-control-label" for="condition_go_to{{ $docQues->id ?? '' }}">Enable Conditional Go To Step Settings</label>
                                                            @endif
                                                       @else
                                                            <input type="checkbox" class="custom-control-input enable_conditional" id="condition_go_to{{ $docQues->id ?? '' }}" name="condition_go_to{{ $docQues->id ?? '' }}">
                                                            <label class="custom-control-label" for="condition_go_to{{ $docQues->id ?? '' }}">Enable Conditional Go To Step Settings</label>
                                                       @endif
                                                       </div>
                                                       <hr>
                                                       @php
                                                            $isCondition = isset($docQues->is_condition) && $docQues->is_condition != null;
                                                            $isConditionType2 = $isCondition && $docQues->is_condition == 1 && $docQues->condition_type == 2 || $docQues->condition_type == 3;
                                                            $enable_conditions = $isConditionType2 ? json_decode($docQues->conditions) : [];
                                                       @endphp

                                                       @if($isConditionType2 && !empty($enable_conditions))
                                                       <div class="cond_div{{ $docQues->id ?? '' }}">
                                                            <div class="col-md-12">
                                                                 <div class="form-group">
                                                                      <label class="form-label" for="">Add Conditions</label>
                                                                 </div>
                                                            </div>
                                                            <div class="append_page_condition" id="append_page_condition{{ $docQues->id ?? '' }}">
                                                            @foreach($enable_conditions as $condition)
                                                                 @if($condition->condition_type == 'go_to_step_condition')
                                                                 <div class="sec-condition" id="sec-condition{{ $condition->id ?? '' }}"  data-id="{{ $condition->id ?? '' }}" data-is_new=false>
                                                                      <hr>
                                                                      <div class="text-end">
                                                                           <div class="form-group">
                                                                                <div>
                                                                                     <span onclick="removeCondition(this)"  data-id="{{ $condition->id ?? '' }}">
                                                                                          <i class="fa fa-times"></i>
                                                                                     </span>
                                                                                </div>
                                                                           </div>
                                                                      </div>
                                                                      <div class="row">
                                                                           <div class="col-md-4">
                                                                                <div class="form-group">
                                                                                     <label class="form-label" for="page_Setting_qu_id-{{ $condition->id ?? '' }}">Question ID</label>
                                                                                     <div class="form-control-wrap question"> 
                                                                                          <select class="form-select js-select2" data-search="on" name="page_Setting_qu_id-{{ $condition->id ?? '' }}[]" id="page_Setting_qu_id-{{ $condition->id ?? '' }}">
                                                                                               @if(isset($questions) && $questions != null)
                                                                                                    @foreach($questions ?? [] as $question)
                                                                                                         <option value="{{ $question->getName() ?? '' }}" {{ $condition->conditional_question_id == $question->getName() ? 'selected': '' }}>
                                                                                                         {{ $question->getName() ?? '' }}
                                                                                                         </option>
                                                                                                    @endforeach
                                                                                               @endif
                                                                                          </select>
                                                                                     </div>
                                                                                </div>
                                                                           </div>
                                                                           <div class="col-md-4">
                                                                                <div class="form-group">
                                                                                     <label class="form-label" for="page_Setting_conditions-{{ $condition->id ?? '' }}">Condition</label>
                                                                                     <div class="form-control-wrap"> 
                                                                                          <select class="form-select js-select2" name="page_Setting_conditions-{{ $condition->id ?? '' }}[]" id="page_Setting_conditions-{{ $condition->id ?? '' }}">
                                                                                               <option value="" selected disabled>Select</option>
                                                                                               @if(isset($condition->conditional_check) && $condition->conditional_check != null)
                                                                                               @if($condition->conditional_check == 1)
                                                                                                    <option value="is_equal_to" selected>is equal to</option>
                                                                                                    @else
                                                                                                    <option value="is_equal_to">is equal to</option>
                                                                                                    @endif

                                                                                                    @if($condition->conditional_check == 2)
                                                                                                    <option value="is_greater_than" selected>is greater than</option>
                                                                                                    @else
                                                                                                    <option value="is_greater_than">is greater than</option>
                                                                                                    @endif

                                                                                                    @if($condition->conditional_check == 3)
                                                                                                    <option value="is_less_than" selected>is less than</option>
                                                                                                    @else
                                                                                                    <option value="is_less_than">is less than</option>
                                                                                                    @endif

                                                                                                    @if($condition->conditional_check == 4)
                                                                                                    <option value="not_equal_to" selected>not equal to</option>
                                                                                                    @else
                                                                                                    <option value="not_equal_to">not equal to</option>
                                                                                                    @endif
                                                                                               @else
                                                                                               <option value="is_equal_to">is equal to</option>
                                                                                               <option value="is_greater_than">is greater than</option>
                                                                                               <option value="is_less_than">is less than</option>
                                                                                               <option value="not_equal_to">not equal to</option>
                                                                                               @endif
                                                                                          </select>
                                                                                     </div>
                                                                                </div>
                                                                           </div>
                                                                           <div class="col-md-4">
                                                                                <div class="form-group">
                                                                                     <label class="form-label" for="page_Setting_qu_val-{{ $condition->id ?? '' }}">Value</label>
                                                                                     <input type="text" class="form-control" id="page_Setting_qu_val-{{ $condition->id ?? '' }}" name="page_Setting_qu_val-{{ $condition->id ?? '' }}[]" value="{{ $condition->conditional_question_value ?? '' }}">
                                                                                </div>
                                                                           </div>
                                                                      </div>
                                                                      <br>
                                                                 </div>
                                                                 @endif
                                                            @endforeach
                                                            </div>
                                                            <div class="text-end">
                                                                 <div class="form-group">
                                                                      <button type="button" class="btn btn-sm btn-primary" onclick="addCondition('{{ $docQues->id ?? '' }}')">Add Condition</button>
                                                                 </div>
                                                            </div>
                                                       </div>
                                                       @else
                                                       <div class="cond_div{{ $docQues->id ?? '' }}" style="display:none">
                                                            <div class="col-md-12">
                                                                 <div class="form-group">
                                                                      <label class="form-label" for="">Add Conditions</label>
                                                                 </div>
                                                            </div>
                                                            <div class="append_page_condition" id="append_page_condition{{ $docQues->id ?? '' }}"></div>
                                                            <div class="text-end">
                                                                 <div class="form-group">
                                                                      <button type="button" class="btn btn-sm btn-primary" onclick="addCondition('{{ $docQues->id ?? '' }}')">Add Condition</button>
                                                                 </div>
                                                            </div>
                                                            <hr>
                                                       </div>
                                                       @endif
                                                  </div>
                                             </div>
                                             <br>
                                        </div>
                                   </div>
                                   @elseif($docQues->type == 'date-field')
                                   <div class="new_que_sec{{ $docQues->id ?? '' }}">
                                        <div class="append_dateField" id="append_dateField{{ $docQues->id ?? '' }}" data-id="{{ $docQues->id ?? '' }}" data-is_new=false>
                                             <div class="card card-bordered card-preview">
                                                  <div class="card-inner">
                                                       <div class="row add_step">
                                                            <div class="col-md-1">
                                                                 <b><p>{{ $num++ ?? ''}}</p></b>
                                                            </div>
                                                            <div class="col-md-6">
                                                                 <h6>Date Field</h6>  
                                                                 <!-- <div class="form-group">
                                                                      <select class="form-select js-select2 new_question" name="question_type{{ $docQues->id ?? '' }}" id="question_type{{ $docQues->id ?? '' }}">
                                                                           @foreach($types as $type)
                                                                                @if($docQues->type == $type->slug)
                                                                                <option value="{{ $type->slug ?? '' }}" selected>{{ $type->name ?? '' }}</option>
                                                                                @else
                                                                                <option value="{{ $type->slug ?? '' }}">{{ $type->name ?? '' }}</option>
                                                                                @endif
                                                                           @endforeach
                                                                      </select>
                                                                 </div> -->
                                                            </div> 
                                                            <div class="col-md-5">
                                                                 <div class="form-group">
                                                                      <span class="col-md-2 offset-md-10">
                                                                           <span onclick="removeFields(this)" data-id="{{ $docQues->id ?? '' }}" data-field="date-field"><i class="fa-solid fa-minus"></i></span>
                                                                      </span>  
                                                                 </div>
                                                            </div>
                                                       </div>
                                                       <hr>
                                                       <div class="col-md-12">
                                                            <div class="form-group">
                                                                 <label class="form-label" for="">Conditional questions label</label>
                                                            </div>
                                                       </div>
                                                       <div class="custom-control custom-checkbox">
                                                       @if(isset($docQues->is_condition) && $docQues->is_condition != null)
                                                            @if($docQues->is_condition == 1 && $docQues->condition_type == 1 || $docQues->condition_type == 3)
                                                            <input type="checkbox" class="custom-control-input add_conditional_label" id="condition_qu_label{{ $docQues->id ?? '' }}" name="condition_qu_label{{ $docQues->id ?? '' }}" checked>
                                                            <label class="custom-control-label" for="condition_qu_label{{ $docQues->id ?? '' }}">Conditional questions label</label>
                                                            @else
                                                            <input type="checkbox" class="custom-control-input add_conditional_label" id="condition_qu_label{{ $docQues->id ?? '' }}" name="condition_qu_label{{ $docQues->id ?? '' }}">
                                                            <label class="custom-control-label" for="condition_qu_label{{ $docQues->id ?? '' }}">Conditional questions label</label>
                                                            @endif
                                                       @else
                                                            <input type="checkbox" class="custom-control-input add_conditional_label" id="condition_qu_label{{ $docQues->id ?? '' }}" name="condition_qu_label{{ $docQues->id ?? '' }}">
                                                            <label class="custom-control-label" for="condition_qu_label{{ $docQues->id ?? '' }}">Conditional questions label</label>
                                                       @endif
                                                       </div>
                                                       <hr>
                                                       <div class="col-md-12">
                                                            <div class="form-group">
                                                                 <label class="form-label" for="text_qu_label-{{ $docQues->id ?? '' }}">Question Label</label>
                                                                 <input type="text" class="form-control date_ques" id="text_qu_label-{{ $docQues->id ?? '' }}" name="text_qu_label-{{ $docQues->id ?? '' }}" value="{{ $docQues->questionData->question_label ?? '' }}">
                                                            </div>
                                                       </div>
                                                       <hr>
                                                       @php
                                                            $isCondition = isset($docQues->is_condition) && $docQues->is_condition != null;
                                                            $isConditionType1 = $isCondition && $docQues->is_condition == 1 && $docQues->condition_type == 1 || $docQues->condition_type == 3;
                                                            $conditions = $isConditionType1 ? json_decode($docQues->conditions) : [];
                                                       @endphp

                                                       @if($isConditionType1 && !empty($conditions))
                                                            <div class="cond_ques_div{{ $docQues->id ?? '' }}" style="display:block;">
                                                                 <div class="col-md-12">
                                                                      <div class="form-group">
                                                                           <label class="form-label" for="">Add conditional questions label</label>
                                                                      </div>
                                                                 </div>
                                                                 <div class="append_label_condition" id="append_label_condition{{ $docQues->id ?? '' }}">
                                                                 @foreach($conditions as $condition)
                                                                      @if($condition->condition_type == 'question_label_condition')
                                                                      <div class="label-condition" id="label-condition{{ $condition->id ?? '' }}" data-id="{{ $condition->id ?? '' }}" data-is_new="false">
                                                                           <hr>
                                                                           <div class="text-end">
                                                                                <div class="form-group">
                                                                                     <span onclick="removeLabel(this)" data-id="{{ $condition->id ?? '' }}">
                                                                                          <i class="fa fa-times"></i>
                                                                                     </span>
                                                                                </div>
                                                                           </div>
                                                                           <div class="row">
                                                                                <div class="col-md-4">
                                                                                     <div class="form-group">
                                                                                          <label class="form-label" for="condition_question_label-{{ $condition->id ?? '' }}">Label</label>
                                                                                          <input type="text" class="form-control" id="condition_question_label-{{ $condition->id ?? '' }}" name="condition_question_label-{{ $condition->id ?? '' }}[]" value="{{ $condition->question_label ?? '' }}">
                                                                                     </div>
                                                                                </div>
                                                                                <div class="col-md-4">
                                                                                     <div class="form-group">
                                                                                          <label class="form-label" for="label_qu_id-{{ $condition->id ?? '' }}">Question ID</label>
                                                                                          <select class="form-select js-select2 new_label_question_id" name="label_qu_id-{{ $condition->id ?? '' }}[]" id="label_qu_id-{{ $condition->id ?? '' }}">
                                                                                               @foreach($questions ?? [] as $question)
                                                                                                    <option value="{{ $question->getName() ?? '' }}" {{ $condition->conditional_question_id == $question->getName() ? 'selected' : '' }}>
                                                                                                    {{ $question->getName() ?? '' }}
                                                                                                    </option>
                                                                                               @endforeach
                                                                                          </select>
                                                                                     </div>
                                                                                </div>
                                                                                <div class="col-md-4">
                                                                                     <div class="form-group">
                                                                                          <label class="form-label" for="condition_question_value-{{ $condition->id ?? '' }}">Value</label>
                                                                                          <input type="text" class="form-control" id="condition_question_value-{{ $condition->id ?? '' }}" name="condition_question_value-{{ $condition->id ?? '' }}[]" value="{{ $condition->conditional_question_value ?? '' }}">
                                                                                     </div>
                                                                                </div>
                                                                           </div>
                                                                           <br>
                                                                      </div>
                                                                      @endif
                                                                 @endforeach
                                                                 </div>
                                                                 <div class="text-end">
                                                                      <div class="form-group">
                                                                           <button type="button" class="btn btn-sm btn-primary" onclick="addLabel('{{ $docQues->id ?? '' }}')">Add Label</button>
                                                                      </div>
                                                                 </div>
                                                                 <hr>
                                                            </div>
                                                       @else
                                                       <div class="cond_ques_div{{ $docQues->id ?? '' }}" style="display:none;">
                                                            <div class="col-md-12">
                                                                 <div class="form-group">
                                                                      <label class="form-label" for="">Add conditional questions label</label>
                                                                 </div>
                                                            </div>
                                                            <div class="append_label_condition" id="append_label_condition{{ $docQues->id ?? '' }}"></div>
                                                            <div class="text-end">
                                                                 <div class="form-group">
                                                                      <button type="button" class="btn btn-sm btn-primary" onclick="addLabel('{{ $docQues->id ?? '' }}')">Add Label</button>
                                                                 </div>
                                                            </div>
                                                            <hr>
                                                       </div>
                                                       @endif
                                                       <div class="col-md-12">
                                                            <div class="form-group">
                                                                 <label class="form-label" for="date_go_to_step-{{ $docQues->id ?? '' }}">Go to step</label>
                                                                 <div class="form-control-wrap"> 
                                                                      <select class="form-select js-select2 new_label_question_id" data-search="on" name="date_go_to_step-{{ $docQues->id ?? '' }}" id="date_go_to_step-${newUniqueId}">
                                                                           <option value=""></option>
                                                                           @if(isset($questions) && $questions != null)
                                                                           @foreach($questions as $question)
                                                                           <option value="{{ $question->getName() ?? '' }}" {{ $docQues->questionData->next_question_id == $question->getName() ? 'selected':'' }}>
                                                                                {{ $question->getName() ?? '' }}
                                                                           </option>
                                                                           @endforeach
                                                                           @endif
                                                                      </select>
                                                                 </div>
                                                            </div>
                                                       </div>
                                                       <hr>
                                                       <div class="col-md-12">
                                                            <div class="form-group">
                                                                 <label class="form-label" for="">Conditional Go to step Settings</label>
                                                            </div>
                                                       </div>
                                                       <div class="custom-control custom-checkbox checked">
                                                       @if(isset($docQues->is_condition) && $docQues->is_condition != null)
                                                            @if($docQues->is_condition == 1 && $docQues->condition_type == 2 || $docQues->condition_type == 3)
                                                            <input type="checkbox" class="custom-control-input enable_conditional" id="condition_go_to{{ $docQues->id ?? '' }}" name="condition_go_to{{ $docQues->id ?? '' }}" checked>
                                                            <label class="custom-control-label" for="condition_go_to{{ $docQues->id ?? '' }}">Enable Conditional Go To Step Settings</label>
                                                            @else
                                                            <input type="checkbox" class="custom-control-input enable_conditional" id="condition_go_to{{ $docQues->id ?? '' }}" name="condition_go_to{{ $docQues->id ?? '' }}">
                                                            <label class="custom-control-label" for="condition_go_to{{ $docQues->id ?? '' }}">Enable Conditional Go To Step Settings</label>
                                                            @endif
                                                       @else
                                                            <input type="checkbox" class="custom-control-input enable_conditional" id="condition_go_to{{ $docQues->id ?? '' }}" name="condition_go_to{{ $docQues->id ?? '' }}">
                                                            <label class="custom-control-label" for="condition_go_to{{ $docQues->id ?? '' }}">Enable Conditional Go To Step Settings</label>
                                                       @endif
                                                       </div>
                                                       <hr>
                                                       @php
                                                            $isCondition = isset($docQues->is_condition) && $docQues->is_condition != null;
                                                            $isConditionType2 = $isCondition && $docQues->is_condition == 1 && $docQues->condition_type == 2 || $docQues->condition_type == 3;
                                                            $enable_conditions = $isConditionType2 ? json_decode($docQues->conditions) : [];
                                                       @endphp

                                                       @if($isConditionType2 && !empty($enable_conditions))
                                                       <div class="cond_div{{ $docQues->id ?? '' }}">
                                                            <div class="col-md-12">
                                                                 <div class="form-group">
                                                                      <label class="form-label" for="">Add Conditions</label>
                                                                 </div>
                                                            </div>
                                                            <div class="append_page_condition" id="append_page_condition{{ $docQues->id ?? '' }}">
                                                            @foreach($enable_conditions as $condition)
                                                                 @if($condition->condition_type == 'go_to_step_condition')
                                                                 <div class="sec-condition" id="sec-condition{{ $condition->id ?? '' }}"  data-id="{{ $condition->id ?? '' }}" data-is_new=false>
                                                                      <hr>
                                                                      <div class="text-end">
                                                                           <div class="form-group">
                                                                                <div>
                                                                                     <span onclick="removeCondition(this)"  data-id="{{ $condition->id ?? '' }}">
                                                                                          <i class="fa fa-times"></i>
                                                                                     </span>
                                                                                </div>
                                                                           </div>
                                                                      </div>
                                                                      <div class="row">
                                                                           <div class="col-md-4">
                                                                                <div class="form-group">
                                                                                     <label class="form-label" for="page_Setting_qu_id-{{ $condition->id ?? '' }}">Question ID</label>
                                                                                     <div class="form-control-wrap question"> 
                                                                                          <select class="form-select js-select2" data-search="on" name="page_Setting_qu_id-{{ $condition->id ?? '' }}[]" id="page_Setting_qu_id-{{ $condition->id ?? '' }}">
                                                                                               @if(isset($questions) && $questions != null)
                                                                                                    @foreach($questions ?? [] as $question)
                                                                                                         <option value="{{ $question->getName() ?? '' }}" {{ $condition->conditional_question_id == $question->getName() ? 'selected' : '' }}>
                                                                                                         {{ $question->getName() ?? '' }}
                                                                                                         </option>
                                                                                                    @endforeach
                                                                                               @endif
                                                                                          </select>
                                                                                     </div>
                                                                                </div>
                                                                           </div>
                                                                           <div class="col-md-4">
                                                                                <div class="form-group">
                                                                                     <label class="form-label" for="page_Setting_conditions-{{ $condition->id ?? '' }}">Condition</label>
                                                                                     <div class="form-control-wrap"> 
                                                                                          <select class="form-select js-select2" name="page_Setting_conditions-{{ $condition->id ?? '' }}[]" id="page_Setting_conditions-{{ $condition->id ?? '' }}">
                                                                                               <option value="" selected disabled>Select</option>
                                                                                               @if(isset($condition->conditional_check) && $condition->conditional_check != null)
                                                                                               @if($condition->conditional_check == 1)
                                                                                                    <option value="is_equal_to" selected>is equal to</option>
                                                                                                    @else
                                                                                                    <option value="is_equal_to">is equal to</option>
                                                                                                    @endif

                                                                                                    @if($condition->conditional_check == 2)
                                                                                                    <option value="is_greater_than" selected>is greater than</option>
                                                                                                    @else
                                                                                                    <option value="is_greater_than">is greater than</option>
                                                                                                    @endif

                                                                                                    @if($condition->conditional_check == 3)
                                                                                                    <option value="is_less_than" selected>is less than</option>
                                                                                                    @else
                                                                                                    <option value="is_less_than">is less than</option>
                                                                                                    @endif

                                                                                                    @if($condition->conditional_check == 4)
                                                                                                    <option value="not_equal_to" selected>not equal to</option>
                                                                                                    @else
                                                                                                    <option value="not_equal_to">not equal to</option>
                                                                                                    @endif
                                                                                               @else
                                                                                               <option value="is_equal_to">is equal to</option>
                                                                                               <option value="is_greater_than">is greater than</option>
                                                                                               <option value="is_less_than">is less than</option>
                                                                                               <option value="not_equal_to">not equal to</option>
                                                                                               @endif
                                                                                          </select>
                                                                                     </div>
                                                                                </div>
                                                                           </div>
                                                                           <div class="col-md-4">
                                                                                <div class="form-group">
                                                                                     <label class="form-label" for="page_Setting_qu_val-{{ $condition->id ?? '' }}">Value</label>
                                                                                     <input type="text" class="form-control" id="page_Setting_qu_val-{{ $condition->id ?? '' }}" name="page_Setting_qu_val-{{ $condition->id ?? '' }}[]" value="{{ $condition->conditional_question_value ?? '' }}">
                                                                                </div>
                                                                           </div>
                                                                      </div>
                                                                      <br>
                                                                 </div>
                                                                 @endif
                                                            @endforeach
                                                            </div>
                                                            <div class="text-end">
                                                                 <div class="form-group">
                                                                      <button type="button" class="btn btn-sm btn-primary" onclick="addCondition('{{ $docQues->id ?? '' }}')">Add Condition</button>
                                                                 </div>
                                                            </div>
                                                       </div>
                                                       @else
                                                       <div class="cond_div{{ $docQues->id ?? '' }}" style="display:none">
                                                            <div class="col-md-12">
                                                                 <div class="form-group">
                                                                      <label class="form-label" for="">Add Conditions</label>
                                                                 </div>
                                                            </div>
                                                            <div class="append_page_condition" id="append_page_condition{{ $docQues->id ?? '' }}"></div>
                                                            <div class="text-end">
                                                                 <div class="form-group">
                                                                      <button type="button" class="btn btn-sm btn-primary" onclick="addCondition('{{ $docQues->id ?? '' }}')">Add Condition</button>
                                                                 </div>
                                                            </div>
                                                            <hr>
                                                       </div>
                                                       @endif
                                                  </div>
                                             </div>
                                             <br>
                                        </div>
                                   </div>
                                   @elseif($docQues->type == 'pricebox')
                                   <div class="new_que_sec{{ $docQues->id ?? '' }}">
                                        <div class="append_priceBox" id="append_priceBox{{ $docQues->id ?? '' }}" data-id="{{ $docQues->id ?? '' }}" data-is_new=false>
                                             <div class="card card-bordered card-preview">
                                                  <div class="card-inner">
                                                       <div class="row add_step">
                                                            <div class="col-md-1">
                                                                 <b><p>{{ $num++ ?? ''}}</p></b>
                                                            </div>
                                                            <div class="col-md-6">
                                                                 <h6>Pricebox</h6>
                                                                 <!-- <div class="form-group">
                                                                      <select class="form-select js-select2 new_question" name="question_type{{ $docQues->id ?? '' }}" id="question_type{{ $docQues->id ?? '' }}">
                                                                           @foreach($types as $type)
                                                                                @if($docQues->type == $type->slug)
                                                                                <option value="{{ $type->slug ?? '' }}" selected>{{ $type->name ?? '' }}</option>
                                                                                @else
                                                                                <option value="{{ $type->slug ?? '' }}">{{ $type->name ?? '' }}</option>
                                                                                @endif
                                                                           @endforeach
                                                                      </select>
                                                                 </div>    -->
                                                            </div> 
                                                            <div class="col-md-5">
                                                                 <div class="form-group">
                                                                      <span class="col-md-2 offset-md-10">
                                                                           <span onclick="removeFields(this)" data-id="{{ $docQues->id ?? '' }}" data-field="pricebox"><i class="fa-solid fa-minus"></i></span>
                                                                      </span>  
                                                                 </div>
                                                            </div>
                                                       </div>
                                                       <hr>
                                                       <div class="col-md-12">
                                                            <div class="form-group">
                                                                 <label class="form-label" for="">Conditional questions label</label>
                                                            </div>
                                                       </div>
                                                       <div class="custom-control custom-checkbox">
                                                       @if(isset($docQues->is_condition) && $docQues->is_condition != null)
                                                            @if($docQues->is_condition == 1 && $docQues->condition_type == 1 || $docQues->condition_type == 3)
                                                            <input type="checkbox" class="custom-control-input add_conditional_label" id="condition_qu_label{{ $docQues->id ?? '' }}" name="condition_qu_label{{ $docQues->id ?? '' }}" checked>
                                                            <label class="custom-control-label" for="condition_qu_label{{ $docQues->id ?? '' }}">Conditional questions label</label>
                                                            @else
                                                            <input type="checkbox" class="custom-control-input add_conditional_label" id="condition_qu_label{{ $docQues->id ?? '' }}" name="condition_qu_label{{ $docQues->id ?? '' }}">
                                                            <label class="custom-control-label" for="condition_qu_label{{ $docQues->id ?? '' }}">Conditional questions label</label>
                                                            @endif
                                                       @else
                                                            <input type="checkbox" class="custom-control-input add_conditional_label" id="condition_qu_label{{ $docQues->id ?? '' }}" name="condition_qu_label{{ $docQues->id ?? '' }}">
                                                            <label class="custom-control-label" for="condition_qu_label{{ $docQues->id ?? '' }}">Conditional questions label</label>
                                                       @endif
                                                       </div>
                                                       <hr>
                                                       @php
                                                            $isCondition = isset($docQues->is_condition) && $docQues->is_condition != null;
                                                            $isConditionType1 = $isCondition && $docQues->is_condition == 1 && $docQues->condition_type == 1 || $docQues->condition_type == 3;
                                                            $conditions = $isConditionType1 ? json_decode($docQues->conditions) : [];
                                                       @endphp

                                                       @if($isConditionType1 && !empty($conditions))
                                                            <div class="cond_ques_div{{ $docQues->id ?? '' }}" style="display:block;">
                                                                 <div class="col-md-12">
                                                                      <div class="form-group">
                                                                           <label class="form-label" for="">Add conditional questions label</label>
                                                                      </div>
                                                                 </div>
                                                                 <div class="append_label_condition" id="append_label_condition{{ $docQues->id ?? '' }}">
                                                                 @foreach($conditions as $condition)
                                                                      @if($condition->condition_type == 'question_label_condition')
                                                                      <div class="label-condition" id="label-condition{{ $condition->id ?? '' }}" data-id="{{ $condition->id ?? '' }}" data-is_new="false">
                                                                           <hr>
                                                                           <div class="text-end">
                                                                                <div class="form-group">
                                                                                     <span onclick="removeLabel(this)" data-id="{{ $condition->id ?? '' }}">
                                                                                          <i class="fa fa-times"></i>
                                                                                     </span>
                                                                                </div>
                                                                           </div>
                                                                           <div class="row">
                                                                                <div class="col-md-4">
                                                                                     <div class="form-group">
                                                                                          <label class="form-label" for="condition_question_label-{{ $condition->id ?? '' }}">Label</label>
                                                                                          <input type="text" class="form-control" id="condition_question_label-{{ $condition->id ?? '' }}" name="condition_question_label-{{ $condition->id ?? '' }}[]" value="{{ $condition->question_label ?? '' }}">
                                                                                     </div>
                                                                                </div>
                                                                                <div class="col-md-4">
                                                                                     <div class="form-group">
                                                                                          <label class="form-label" for="label_qu_id-{{ $condition->id ?? '' }}">Question ID</label>
                                                                                          <select class="form-select js-select2 new_label_question_id" name="label_qu_id-{{ $condition->id ?? '' }}[]" id="label_qu_id-{{ $condition->id ?? '' }}">
                                                                                               @if(isset($questions) && $questions != null)     
                                                                                               @foreach($questions ?? [] as $question)
                                                                                                    <option value="{{ $question->getName() ?? '' }}" {{ $condition->conditional_question_id == $question->getName() ? 'selected' : '' }}>
                                                                                                    {{ $question->getName() ?? '' }}
                                                                                                    </option>
                                                                                               @endforeach
                                                                                               @endif
                                                                                          </select>
                                                                                     </div>
                                                                                </div>
                                                                                <div class="col-md-4">
                                                                                     <div class="form-group">
                                                                                          <label class="form-label" for="condition_question_value-{{ $condition->id ?? '' }}">Value</label>
                                                                                          <input type="text" class="form-control" id="condition_question_value-{{ $condition->id ?? '' }}" name="condition_question_value-{{ $condition->id ?? '' }}[]" value="{{ $condition->conditional_question_value ?? '' }}">
                                                                                     </div>
                                                                                </div>
                                                                           </div>
                                                                           <br>
                                                                      </div>
                                                                      @endif
                                                                 @endforeach
                                                                 </div>
                                                                 <div class="text-end">
                                                                      <div class="form-group">
                                                                           <button type="button" class="btn btn-sm btn-primary" onclick="addLabel('{{ $docQues->id ?? '' }}')">Add Label</button>
                                                                      </div>
                                                                 </div>
                                                                 <hr>
                                                            </div>
                                                       @else
                                                       <div class="cond_ques_div{{ $docQues->id ?? '' }}" style="display:none;">
                                                            <div class="col-md-12">
                                                                 <div class="form-group">
                                                                      <label class="form-label" for="">Add conditional questions label</label>
                                                                 </div>
                                                            </div>
                                                            <div class="append_label_condition" id="append_label_condition{{ $docQues->id ?? '' }}"></div>
                                                            <div class="text-end">
                                                                 <div class="form-group">
                                                                      <button type="button" class="btn btn-sm btn-primary" onclick="addLabel('{{ $docQues->id ?? '' }}')">Add Label</button>
                                                                 </div>
                                                            </div>
                                                            <hr>
                                                       </div>
                                                       @endif
                                                       @if($isCondition)
                                                       <div class="col-md-12 hide_question_label" id="hide_question_label{{ $docQues->id ?? '' }}" style="display:none;">
                                                            <div class="form-group">
                                                                 <label class="form-label" for="text_qu_label-{{ $docQues->id ?? '' }}">Question Label</label>
                                                                 <input type="text" class="form-control question_labl" id="text_qu_label-{{ $docQues->id ?? '' }}" name="text_qu_label-${newUniqueId}" value="{{ $docQues->questionData->question_label ?? '' }}">
                                                            </div>
                                                            <hr>
                                                       </div>
                                                       @else
                                                       <div class="col-md-12 hide_question_label" id="hide_question_label{{ $docQues->id ?? '' }}">
                                                            <div class="form-group">
                                                                 <label class="form-label" for="text_qu_label-{{ $docQues->id ?? '' }}">Question Label</label>
                                                                 <input type="text" class="form-control question_labl" id="text_qu_label-{{ $docQues->id ?? '' }}" name="text_qu_label-${newUniqueId}" value="{{ $docQues->questionData->question_label ?? '' }}">
                                                            </div>
                                                            <hr>
                                                       </div>
                                                       @endif
                                                       <div class="col-md-12">
                                                            <div class="form-group">
                                                                 <label class="form-label" for="text_placeholder-{{ $docQues->id ?? '' }}">Text Box Placeholder</label>
                                                                 <input type="text" class="form-control text_box_placeholder" id="text_placeholder-{{ $docQues->id ?? '' }}" name="text_placeholder-{{ $docQues->id ?? '' }}" value="{{ $docQues->questionData->text_box_placeholder ?? '' }}">
                                                            </div>
                                                       </div>
                                                       <hr>
                                                       <div class="col-md-12">
                                                            <div class="form-group">
                                                                 <label class="form-label" for="text_go_to_step-{{ $docQues->id ?? '' }}">Go to step</label>
                                                                 <div class="form-control-wrap"> 
                                                                      <select class="form-select js-select2 new_label_question_id" data-search="on" name="text_go_to_step-{{ $docQues->id ?? '' }}" id="text_go_to_step-${newUniqueId}">
                                                                           <option value=""></option>
                                                                           @if(isset($questions) && $questions != null)
                                                                           @foreach($questions ?? [] as $question)
                                                                                <option value="{{ $question->getName() ?? '' }}" {{ $docQues->questionData->next_question_id == $question->getName() ? 'selected' : '' }}>
                                                                                {{ $question->getName() ?? '' }}
                                                                                </option>
                                                                           @endforeach
                                                                           @endif
                                                                      </select>
                                                                 </div>
                                                            </div>
                                                       </div>
                                                       <hr>
                                                       <div class="col-md-12">
                                                            <div class="form-group">
                                                                 <label class="form-label" for="">Conditional Go to step Settings</label>
                                                            </div>
                                                       </div>
                                                       <div class="custom-control custom-checkbox checked">
                                                       @if(isset($docQues->is_condition) && $docQues->is_condition != null)
                                                            @if($docQues->is_condition == 1 && $docQues->condition_type == 2 || $docQues->condition_type == 3)
                                                            <input type="checkbox" class="custom-control-input enable_conditional" id="condition_go_to{{ $docQues->id ?? '' }}" name="condition_go_to{{ $docQues->id ?? '' }}" checked>
                                                            <label class="custom-control-label" for="condition_go_to{{ $docQues->id ?? '' }}">Enable Conditional Go To Step Settings</label>
                                                            @else
                                                            <input type="checkbox" class="custom-control-input enable_conditional" id="condition_go_to{{ $docQues->id ?? '' }}" name="condition_go_to{{ $docQues->id ?? '' }}">
                                                            <label class="custom-control-label" for="condition_go_to{{ $docQues->id ?? '' }}">Enable Conditional Go To Step Settings</label>
                                                            @endif
                                                       @else
                                                            <input type="checkbox" class="custom-control-input enable_conditional" id="condition_go_to{{ $docQues->id ?? '' }}" name="condition_go_to{{ $docQues->id ?? '' }}">
                                                            <label class="custom-control-label" for="condition_go_to{{ $docQues->id ?? '' }}">Enable Conditional Go To Step Settings</label>
                                                       @endif
                                                       </div>
                                                       <hr>
                                                       @php
                                                            $isCondition = isset($docQues->is_condition) && $docQues->is_condition != null;
                                                            $isConditionType2 = $isCondition && $docQues->is_condition == 1 && $docQues->condition_type == 2 || $docQues->condition_type == 3;
                                                            $enable_conditions = $isConditionType2 ? json_decode($docQues->conditions) : [];
                                                       @endphp

                                                       @if($isConditionType2 && !empty($enable_conditions))
                                                       <div class="cond_div{{ $docQues->id ?? '' }}">
                                                            <div class="col-md-12">
                                                                 <div class="form-group">
                                                                      <label class="form-label" for="">Add Conditions</label>
                                                                 </div>
                                                            </div>
                                                            <div class="append_page_condition" id="append_page_condition{{ $docQues->id ?? '' }}">
                                                            @foreach($enable_conditions as $condition)
                                                                 @if($condition->condition_type == 'go_to_step_condition')
                                                                 <div class="sec-condition" id="sec-condition{{ $condition->id ?? '' }}"  data-id="{{ $condition->id ?? '' }}" data-is_new=false>
                                                                      <hr>
                                                                      <div class="text-end">
                                                                           <div class="form-group">
                                                                                <div>
                                                                                     <span onclick="removeCondition(this)"  data-id="{{ $condition->id ?? '' }}">
                                                                                          <i class="fa fa-times"></i>
                                                                                     </span>
                                                                                </div>
                                                                           </div>
                                                                      </div>
                                                                      <div class="row">
                                                                           <div class="col-md-4">
                                                                                <div class="form-group">
                                                                                     <label class="form-label" for="page_Setting_qu_id-{{ $condition->id ?? '' }}">Question ID</label>
                                                                                     <div class="form-control-wrap question"> 
                                                                                          <select class="form-select js-select2" data-search="on" name="page_Setting_qu_id-{{ $condition->id ?? '' }}[]" id="page_Setting_qu_id-{{ $condition->id ?? '' }}">
                                                                                               <option value=""></option>     
                                                                                               @if(isset($questions) && $questions != null)
                                                                                               @foreach($questions ?? [] as $question)
                                                                                                    <option value="{{ $question->getName() ?? '' }}" {{ $condition->conditional_question_id == $question->getName() ? 'selected' : '' }}>
                                                                                                         {{ $question->getName() ?? '' }}
                                                                                                    </option>
                                                                                               @endforeach
                                                                                               @endif
                                                                                          </select>
                                                                                     </div>
                                                                                </div>
                                                                           </div>
                                                                           <div class="col-md-4">
                                                                                <div class="form-group">
                                                                                     <label class="form-label" for="page_Setting_conditions-{{ $condition->id ?? '' }}">Condition</label>
                                                                                     <div class="form-control-wrap"> 
                                                                                          <select class="form-select js-select2" name="page_Setting_conditions-{{ $condition->id ?? '' }}[]" id="page_Setting_conditions-{{ $condition->id ?? '' }}">
                                                                                               <option value="" selected disabled>Select</option>
                                                                                               @if(isset($condition->conditional_check) && $condition->conditional_check != null)
                                                                                               @if($condition->conditional_check == 1)
                                                                                                    <option value="is_equal_to" selected>is equal to</option>
                                                                                                    @else
                                                                                                    <option value="is_equal_to">is equal to</option>
                                                                                                    @endif

                                                                                                    @if($condition->conditional_check == 2)
                                                                                                    <option value="is_greater_than" selected>is greater than</option>
                                                                                                    @else
                                                                                                    <option value="is_greater_than">is greater than</option>
                                                                                                    @endif

                                                                                                    @if($condition->conditional_check == 3)
                                                                                                    <option value="is_less_than" selected>is less than</option>
                                                                                                    @else
                                                                                                    <option value="is_less_than">is less than</option>
                                                                                                    @endif

                                                                                                    @if($condition->conditional_check == 4)
                                                                                                    <option value="not_equal_to" selected>not equal to</option>
                                                                                                    @else
                                                                                                    <option value="not_equal_to">not equal to</option>
                                                                                                    @endif
                                                                                               @else
                                                                                               <option value="is_equal_to">is equal to</option>
                                                                                               <option value="is_greater_than">is greater than</option>
                                                                                               <option value="is_less_than">is less than</option>
                                                                                               <option value="not_equal_to">not equal to</option>
                                                                                               @endif
                                                                                          </select>
                                                                                     </div>
                                                                                </div>
                                                                           </div>
                                                                           <div class="col-md-4">
                                                                                <div class="form-group">
                                                                                     <label class="form-label" for="page_Setting_qu_val-{{ $condition->id ?? '' }}">Value</label>
                                                                                     <input type="text" class="form-control" id="page_Setting_qu_val-{{ $condition->id ?? '' }}" name="page_Setting_qu_val-{{ $condition->id ?? '' }}[]" value="{{ $condition->conditional_question_value ?? '' }}">
                                                                                </div>
                                                                           </div>
                                                                      </div>
                                                                      <br>
                                                                 </div>
                                                                 @endif
                                                            @endforeach
                                                            </div>
                                                            <div class="text-end">
                                                                 <div class="form-group">
                                                                      <button type="button" class="btn btn-sm btn-primary" onclick="addCondition('{{ $docQues->id ?? '' }}')">Add Condition</button>
                                                                 </div>
                                                            </div>
                                                       </div>
                                                       @else
                                                       <div class="cond_div{{ $docQues->id ?? '' }}" style="display:none">
                                                            <div class="col-md-12">
                                                                 <div class="form-group">
                                                                      <label class="form-label" for="">Add Conditions</label>
                                                                 </div>
                                                            </div>
                                                            <div class="append_page_condition" id="append_page_condition{{ $docQues->id ?? '' }}"></div>
                                                            <div class="text-end">
                                                                 <div class="form-group">
                                                                      <button type="button" class="btn btn-sm btn-primary" onclick="addCondition('{{ $docQues->id ?? '' }}')">Add Condition</button>
                                                                 </div>
                                                            </div>
                                                            <hr>
                                                       </div>
                                                       @endif
                                                  </div>
                                             </div>
                                             <br>
                                        </div>
                                   </div>
                                   @elseif($docQues->type == 'number-field')
                                   <div class="new_que_sec{{ $docQues->id ?? '' }}">
                                        <div class="append_numberField" id="append_numberField{{ $docQues->id ?? '' }}" data-id="{{ $docQues->id ?? '' }}" data-is_new=false>
                                             <div class="card card-bordered card-preview">
                                                  <div class="card-inner">
                                                       <div class="row add_step">
                                                            <div class="col-md-1">
                                                                 <b><p>{{ $num++ ?? ''}}</p></b>
                                                            </div>
                                                            <div class="col-md-6">
                                                                 <h6>Number field</h6>  
                                                                 <!-- <div class="form-group">
                                                                      <select class="form-select js-select2 new_question" name="question_type{{ $docQues->id ?? '' }}" id="question_type{{ $docQues->id ?? '' }}">
                                                                           @foreach($types as $type)
                                                                                @if($docQues->type == $type->slug)
                                                                                <option value="{{ $type->slug ?? '' }}" selected>{{ $type->name ?? '' }}</option>
                                                                                @else
                                                                                <option value="{{ $type->slug ?? '' }}">{{ $type->name ?? '' }}</option>
                                                                                @endif
                                                                           @endforeach
                                                                      </select>
                                                                 </div>  -->
                                                            </div> 
                                                            <div class="col-md-5">
                                                                 <div class="form-group">
                                                                      <span class="col-md-2 offset-md-10">
                                                                           <span onclick="removeFields(this)" data-field="number-field" data-id="{{ $docQues->id ?? '' }}"><i class="fa-solid fa-minus"></i></span>
                                                                      </span>  
                                                                 </div>
                                                            </div>
                                                       </div>
                                                       <hr>
                                                       <div class="col-md-12">
                                                            <div class="form-group">
                                                                 <label class="form-label" for="">Conditional questions label</label>
                                                            </div>
                                                       </div>
                                                       <div class="custom-control custom-checkbox">
                                                       @if(isset($docQues->is_condition) && $docQues->is_condition != null)
                                                            @if($docQues->is_condition == 1 && $docQues->condition_type == 1 || $docQues->condition_type == 3)
                                                            <input type="checkbox" class="custom-control-input add_conditional_label" id="condition_qu_label{{ $docQues->id ?? '' }}" name="condition_qu_label{{ $docQues->id ?? '' }}" checked>
                                                            <label class="custom-control-label" for="condition_qu_label{{ $docQues->id ?? '' }}">Conditional questions label</label>
                                                            @else
                                                            <input type="checkbox" class="custom-control-input add_conditional_label" id="condition_qu_label{{ $docQues->id ?? '' }}" name="condition_qu_label{{ $docQues->id ?? '' }}">
                                                            <label class="custom-control-label" for="condition_qu_label{{ $docQues->id ?? '' }}">Conditional questions label</label>
                                                            @endif
                                                       @else
                                                            <input type="checkbox" class="custom-control-input add_conditional_label" id="condition_qu_label{{ $docQues->id ?? '' }}" name="condition_qu_label{{ $docQues->id ?? '' }}">
                                                            <label class="custom-control-label" for="condition_qu_label{{ $docQues->id ?? '' }}">Conditional questions label</label>
                                                       @endif
                                                       </div>
                                                       <hr>
                                                       @php
                                                            $isCondition = isset($docQues->is_condition) && $docQues->is_condition != null;
                                                            $isConditionType1 = $isCondition && $docQues->is_condition == 1 && $docQues->condition_type == 1 || $docQues->condition_type == 3;
                                                            $conditions = $isConditionType1 ? json_decode($docQues->conditions) : [];
                                                       @endphp

                                                       @if($isConditionType1 && !empty($conditions))
                                                            <div class="cond_ques_div{{ $docQues->id ?? '' }}" style="display:block;">
                                                                 <div class="col-md-12">
                                                                      <div class="form-group">
                                                                           <label class="form-label" for="">Add conditional questions label</label>
                                                                      </div>
                                                                 </div>
                                                                 <div class="append_label_condition" id="append_label_condition{{ $docQues->id ?? '' }}">
                                                                 @foreach($conditions as $condition)
                                                                      @if($condition->condition_type == 'question_label_condition')
                                                                      <div class="label-condition" id="label-condition{{ $condition->id ?? '' }}" data-id="{{ $condition->id ?? '' }}" data-is_new="false">
                                                                           <hr>
                                                                           <div class="text-end">
                                                                                <div class="form-group">
                                                                                     <span onclick="removeLabel(this)" data-id="{{ $condition->id ?? '' }}">
                                                                                          <i class="fa fa-times"></i>
                                                                                     </span>
                                                                                </div>
                                                                           </div>
                                                                           <div class="row">
                                                                                <div class="col-md-4">
                                                                                     <div class="form-group">
                                                                                          <label class="form-label" for="condition_question_label-{{ $condition->id ?? '' }}">Label</label>
                                                                                          <input type="text" class="form-control" id="condition_question_label-{{ $condition->id ?? '' }}" name="condition_question_label-{{ $condition->id ?? '' }}[]" value="{{ $condition->question_label ?? '' }}">
                                                                                     </div>
                                                                                </div>
                                                                                <div class="col-md-4">
                                                                                     <div class="form-group">
                                                                                          <label class="form-label" for="label_qu_id-{{ $condition->id ?? '' }}">Question ID</label>
                                                                                          <select class="form-select js-select2 new_label_question_id" name="label_qu_id-{{ $condition->id ?? '' }}[]" id="label_qu_id-{{ $condition->id ?? '' }}">
                                                                                               @foreach($questions ?? [] as $question)
                                                                                                    <option value="{{ $question->getName() ?? '' }}" {{ $condition->conditional_question_id == $question->getName() ? 'selected' : '' }}>
                                                                                                    {{ $question->getName() ?? '' }}
                                                                                                    </option>
                                                                                               @endforeach
                                                                                          </select>
                                                                                     </div>
                                                                                </div>
                                                                                <div class="col-md-4">
                                                                                     <div class="form-group">
                                                                                          <label class="form-label" for="condition_question_value-{{ $condition->id ?? '' }}">Value</label>
                                                                                          <input type="text" class="form-control" id="condition_question_value-{{ $condition->id ?? '' }}" name="condition_question_value-{{ $condition->id ?? '' }}[]" value="{{ $condition->conditional_question_value ?? '' }}">
                                                                                     </div>
                                                                                </div>
                                                                           </div>
                                                                           <br>
                                                                      </div>
                                                                      @endif
                                                                 @endforeach
                                                                 </div>
                                                                 <div class="text-end">
                                                                      <div class="form-group">
                                                                           <button type="button" class="btn btn-sm btn-primary" onclick="addLabel('{{ $docQues->id ?? '' }}')">Add Label</button>
                                                                      </div>
                                                                 </div>
                                                                 <hr>
                                                            </div>
                                                       @else
                                                       <div class="cond_ques_div{{ $docQues->id ?? '' }}" style="display:none;">
                                                            <div class="col-md-12">
                                                                 <div class="form-group">
                                                                      <label class="form-label" for="">Add conditional questions label</label>
                                                                 </div>
                                                            </div>
                                                            <div class="append_label_condition" id="append_label_condition{{ $docQues->id ?? '' }}"></div>
                                                            <div class="text-end">
                                                                 <div class="form-group">
                                                                      <button type="button" class="btn btn-sm btn-primary" onclick="addLabel('{{ $docQues->id ?? '' }}')">Add Label</button>
                                                                 </div>
                                                            </div>
                                                            <hr>
                                                       </div>
                                                       @endif
                                                       @if($isCondition)
                                                       <div class="col-md-12 hide_question_label" id="hide_question_label{{ $docQues->id ?? '' }}" style="display:none;">
                                                            <div class="form-group">
                                                                 <label class="form-label" for="text_qu_label-{{ $docQues->id ?? '' }}">Question Label</label>
                                                                 <input type="text" class="form-control question_labl" id="text_qu_label-{{ $docQues->id ?? '' }}" name="text_qu_label-${newUniqueId}" value="{{ $docQues->questionData->question_label ?? '' }}">
                                                            </div>
                                                            <hr>
                                                       </div>
                                                       @else
                                                       <div class="col-md-12 hide_question_label" id="hide_question_label{{ $docQues->id ?? '' }}">
                                                            <div class="form-group">
                                                                 <label class="form-label" for="text_qu_label-{{ $docQues->id ?? '' }}">Question Label</label>
                                                                 <input type="text" class="form-control question_labl" id="text_qu_label-{{ $docQues->id ?? '' }}" name="text_qu_label-${newUniqueId}" value="{{ $docQues->questionData->question_label ?? '' }}">
                                                            </div>
                                                            <hr>
                                                       </div>
                                                       @endif
                                                       <div class="col-md-12">
                                                            <div class="form-group">
                                                                 <label class="form-label" for="text_placeholder-{{ $docQues->id ?? '' }}">Number field Placeholder</label>
                                                                 <input type="text" class="form-control number_placeholder" id="text_placeholder-{{ $docQues->id ?? '' }}" name="text_placeholder-{{ $docQues->id ?? '' }}" value="{{ $docQues->questionData->text_box_placeholder ?? '' }}">
                                                            </div>
                                                       </div>
                                                       <hr>
                                                       <div class="col-md-12">
                                                            <div class="form-group">
                                                                 <label class="form-label" for="text_go_to_step-{{ $docQues->id ?? '' }}">Go to step</label>
                                                                 <div class="form-control-wrap"> 
                                                                      <select class="form-select js-select2 new_label_question_id" data-search="on" name="text_go_to_step-{{ $docQues->id ?? '' }}" id="text_go_to_step-{{ $docQues->id ?? '' }}">
                                                                           <option value=""></option>
                                                                           @if(isset($questions) && $questions != null)
                                                                           @foreach($questions ?? [] as $question)
                                                                                <option value="{{ $question->getName() ?? '' }}" {{ $docQues->questionData->next_question_id == $question->getName() ? 'selected' : '' }}>
                                                                                {{ $question->getName() ?? '' }}
                                                                                </option>
                                                                           @endforeach
                                                                           @endif
                                                                      </select>
                                                                 </div>
                                                            </div>
                                                       </div>
                                                       <hr>
                                                       <div class="col-md-12">
                                                            <div class="form-group">
                                                                 <label class="form-label" for="">Conditional Go to step Settings</label>
                                                            </div>
                                                       </div>
                                                       <div class="custom-control custom-checkbox checked">
                                                       @if(isset($docQues->is_condition) && $docQues->is_condition != null)
                                                            @if($docQues->is_condition == 1 && $docQues->condition_type == 2 || $docQues->condition_type == 3)
                                                            <input type="checkbox" class="custom-control-input enable_conditional" id="condition_go_to{{ $docQues->id ?? '' }}" name="condition_go_to{{ $docQues->id ?? '' }}" checked>
                                                            <label class="custom-control-label" for="condition_go_to{{ $docQues->id ?? '' }}">Enable Conditional Go To Step Settings</label>
                                                            @else
                                                            <input type="checkbox" class="custom-control-input enable_conditional" id="condition_go_to{{ $docQues->id ?? '' }}" name="condition_go_to{{ $docQues->id ?? '' }}">
                                                            <label class="custom-control-label" for="condition_go_to{{ $docQues->id ?? '' }}">Enable Conditional Go To Step Settings</label>
                                                            @endif
                                                       @else
                                                            <input type="checkbox" class="custom-control-input enable_conditional" id="condition_go_to{{ $docQues->id ?? '' }}" name="condition_go_to{{ $docQues->id ?? '' }}">
                                                            <label class="custom-control-label" for="condition_go_to{{ $docQues->id ?? '' }}">Enable Conditional Go To Step Settings</label>
                                                       @endif
                                                       </div>
                                                       <hr>
                                                       @php
                                                            $isCondition = isset($docQues->is_condition) && $docQues->is_condition != null;
                                                            $isConditionType2 = $isCondition && $docQues->is_condition == 1 && $docQues->condition_type == 2 || $docQues->condition_type == 3;
                                                            $enable_conditions = $isConditionType2 ? json_decode($docQues->conditions) : [];
                                                       @endphp

                                                       @if($isConditionType2 && !empty($enable_conditions))
                                                       <div class="cond_div{{ $docQues->id ?? '' }}">
                                                            <div class="col-md-12">
                                                                 <div class="form-group">
                                                                      <label class="form-label" for="">Add Conditions</label>
                                                                 </div>
                                                            </div>
                                                            <div class="append_page_condition" id="append_page_condition{{ $docQues->id ?? '' }}">
                                                            @foreach($enable_conditions as $condition)
                                                                 @if($condition->condition_type == 'go_to_step_condition')
                                                                 <div class="sec-condition" id="sec-condition{{ $condition->id ?? '' }}"  data-id="{{ $condition->id ?? '' }}" data-is_new=false>
                                                                      <hr>
                                                                      <div class="text-end">
                                                                           <div class="form-group">
                                                                                <div>
                                                                                     <span onclick="removeCondition(this)"  data-id="{{ $condition->id ?? '' }}">
                                                                                          <i class="fa fa-times"></i>
                                                                                     </span>
                                                                                </div>
                                                                           </div>
                                                                      </div>
                                                                      <div class="row">
                                                                           <div class="col-md-4">
                                                                                <div class="form-group">
                                                                                     <label class="form-label" for="page_Setting_qu_id-{{ $condition->id ?? '' }}">Question ID</label>
                                                                                     <div class="form-control-wrap question"> 
                                                                                          <select class="form-select js-select2" data-search="on" name="page_Setting_qu_id-{{ $condition->id ?? '' }}[]" id="page_Setting_qu_id-{{ $condition->id ?? '' }}">
                                                                                               @if(isset($questions) && $questions != null)
                                                                                                    @foreach($questions ?? [] as $question)
                                                                                                         <option value="{{ $question->getName() ?? '' }}" {{ $condition->conditional_question_id == $question->getName() ? 'selected' : '' }}>
                                                                                                         {{ $question->getName() ?? '' }}
                                                                                                         </option>
                                                                                                    @endforeach
                                                                                               @endif
                                                                                          </select>
                                                                                     </div>
                                                                                </div>
                                                                           </div>
                                                                           <div class="col-md-4">
                                                                                <div class="form-group">
                                                                                     <label class="form-label" for="page_Setting_conditions-{{ $condition->id ?? '' }}">Condition</label>
                                                                                     <div class="form-control-wrap"> 
                                                                                          <select class="form-select js-select2" name="page_Setting_conditions-{{ $condition->id ?? '' }}[]" id="page_Setting_conditions-{{ $condition->id ?? '' }}">
                                                                                               <option value="" selected disabled>Select</option>
                                                                                               @if(isset($condition->conditional_check) && $condition->conditional_check != null)
                                                                                               @if($condition->conditional_check == 1)
                                                                                                    <option value="is_equal_to" selected>is equal to</option>
                                                                                                    @else
                                                                                                    <option value="is_equal_to">is equal to</option>
                                                                                                    @endif

                                                                                                    @if($condition->conditional_check == 2)
                                                                                                    <option value="is_greater_than" selected>is greater than</option>
                                                                                                    @else
                                                                                                    <option value="is_greater_than">is greater than</option>
                                                                                                    @endif

                                                                                                    @if($condition->conditional_check == 3)
                                                                                                    <option value="is_less_than" selected>is less than</option>
                                                                                                    @else
                                                                                                    <option value="is_less_than">is less than</option>
                                                                                                    @endif

                                                                                                    @if($condition->conditional_check == 4)
                                                                                                    <option value="not_equal_to" selected>not equal to</option>
                                                                                                    @else
                                                                                                    <option value="not_equal_to">not equal to</option>
                                                                                                    @endif
                                                                                               @else
                                                                                               <option value="is_equal_to">is equal to</option>
                                                                                               <option value="is_greater_than">is greater than</option>
                                                                                               <option value="is_less_than">is less than</option>
                                                                                               <option value="not_equal_to">not equal to</option>
                                                                                               @endif
                                                                                          </select>
                                                                                     </div>
                                                                                </div>
                                                                           </div>
                                                                           <div class="col-md-4">
                                                                                <div class="form-group">
                                                                                     <label class="form-label" for="page_Setting_qu_val-{{ $condition->id ?? '' }}">Value</label>
                                                                                     <input type="text" class="form-control" id="page_Setting_qu_val-{{ $condition->id ?? '' }}" name="page_Setting_qu_val-{{ $condition->id ?? '' }}[]" value="{{ $condition->conditional_question_value ?? '' }}">
                                                                                </div>
                                                                           </div>
                                                                      </div>
                                                                      <br>
                                                                 </div>
                                                                 @endif
                                                            @endforeach
                                                            </div>
                                                            <div class="text-end">
                                                                 <div class="form-group">
                                                                      <button type="button" class="btn btn-sm btn-primary" onclick="addCondition('{{ $docQues->id ?? '' }}')">Add Condition</button>
                                                                 </div>
                                                            </div>
                                                       </div>
                                                       @else
                                                       <div class="cond_div{{ $docQues->id ?? '' }}" style="display:none">
                                                            <div class="col-md-12">
                                                                 <div class="form-group">
                                                                      <label class="form-label" for="">Add Conditions</label>
                                                                 </div>
                                                            </div>
                                                            <div class="append_page_condition" id="append_page_condition{{ $docQues->id ?? '' }}"></div>
                                                            <div class="text-end">
                                                                 <div class="form-group">
                                                                      <button type="button" class="btn btn-sm btn-primary" onclick="addCondition('{{ $docQues->id ?? '' }}')">Add Condition</button>
                                                                 </div>
                                                            </div>
                                                            <hr>
                                                       </div>
                                                       @endif
                                                  </div>
                                             </div>
                                             <br>
                                        </div>
                                   </div>
                                   @elseif($docQues->type == 'percentage-box')
                                   <div class="new_que_sec{{ $docQues->id ?? '' }}">
                                        <div class="appendPercentageBox" id="appendPercentageBox{{ $docQues->id ?? '' }}" data-id="{{ $docQues->id ?? '' }}" data-is_new=false>
                                             <div class="card card-bordered card-preview">
                                                  <div class="card-inner">
                                                       <div class="row add_step">
                                                            <div class="col-md-1">
                                                                 <b><p>{{ $num++ ?? ''}}</p></b>
                                                            </div>
                                                            <div class="col-md-6">
                                                                 <h6>Percentage Box</h6>  
                                                                 <!-- <div class="form-group">
                                                                      <select class="form-select js-select2 new_question" name="question_type{{ $docQues->id ?? '' }}" id="question_type{{ $docQues->id ?? '' }}">
                                                                           @foreach($types as $type)
                                                                                @if($docQues->type == $type->slug)
                                                                                <option value="{{ $type->slug ?? '' }}" selected>{{ $type->name ?? '' }}</option>
                                                                                @else
                                                                                <option value="{{ $type->slug ?? '' }}">{{ $type->name ?? '' }}</option>
                                                                                @endif
                                                                           @endforeach
                                                                      </select>
                                                                 </div>  -->
                                                            </div> 
                                                            <div class="col-md-5">
                                                                 <div class="form-group">
                                                                      <span class="col-md-2 offset-md-10">
                                                                           <span onclick="removeFields(this)" data-field="percentBox" data-id="{{ $docQues->id ?? '' }}"><i class="fa-solid fa-minus"></i></span>
                                                                      </span>  
                                                                 </div>
                                                            </div>
                                                       </div>
                                                       <hr>
                                                       <div class="col-md-12">
                                                            <div class="form-group">
                                                                 <label class="form-label" for="">Conditional questions label</label>
                                                            </div>
                                                       </div>
                                                       <div class="custom-control custom-checkbox">
                                                       @if(isset($docQues->is_condition) && $docQues->is_condition != null)
                                                            @if($docQues->is_condition == 1 && $docQues->condition_type == 1 || $docQues->condition_type == 3)
                                                            <input type="checkbox" class="custom-control-input add_conditional_label" id="condition_qu_label{{ $docQues->id ?? '' }}" name="condition_qu_label{{ $docQues->id ?? '' }}" checked>
                                                            <label class="custom-control-label" for="condition_qu_label{{ $docQues->id ?? '' }}">Conditional questions label</label>
                                                            @else
                                                            <input type="checkbox" class="custom-control-input add_conditional_label" id="condition_qu_label{{ $docQues->id ?? '' }}" name="condition_qu_label{{ $docQues->id ?? '' }}">
                                                            <label class="custom-control-label" for="condition_qu_label{{ $docQues->id ?? '' }}">Conditional questions label</label>
                                                            @endif
                                                       @else
                                                            <input type="checkbox" class="custom-control-input add_conditional_label" id="condition_qu_label{{ $docQues->id ?? '' }}" name="condition_qu_label{{ $docQues->id ?? '' }}">
                                                            <label class="custom-control-label" for="condition_qu_label{{ $docQues->id ?? '' }}">Conditional questions label</label>
                                                       @endif
                                                       </div>
                                                       <hr>
                                                       @php
                                                            $isCondition = isset($docQues->is_condition) && $docQues->is_condition != null;
                                                            $isConditionType1 = $isCondition && $docQues->is_condition == 1 && $docQues->condition_type == 1 || $docQues->condition_type == 3;
                                                            $conditions = $isConditionType1 ? json_decode($docQues->conditions) : [];
                                                       @endphp

                                                       @if($isConditionType1 && !empty($conditions))
                                                            <div class="cond_ques_div{{ $docQues->id ?? '' }}" style="display:block;">
                                                                 <div class="col-md-12">
                                                                      <div class="form-group">
                                                                           <label class="form-label" for="">Add conditional questions label</label>
                                                                      </div>
                                                                 </div>
                                                                 <div class="append_label_condition" id="append_label_condition{{ $docQues->id ?? '' }}">
                                                                 @foreach($conditions as $condition)
                                                                      @if($condition->condition_type == 'question_label_condition')
                                                                      <div class="label-condition" id="label-condition{{ $condition->id ?? '' }}" data-id="{{ $condition->id ?? '' }}" data-is_new="false">
                                                                           <hr>
                                                                           <div class="text-end">
                                                                                <div class="form-group">
                                                                                     <span onclick="removeLabel(this)" data-id="{{ $condition->id ?? '' }}">
                                                                                          <i class="fa fa-times"></i>
                                                                                     </span>
                                                                                </div>
                                                                           </div>
                                                                           <div class="row">
                                                                                <div class="col-md-4">
                                                                                     <div class="form-group">
                                                                                          <label class="form-label" for="condition_question_label-{{ $condition->id ?? '' }}">Label</label>
                                                                                          <input type="text" class="form-control" id="condition_question_label-{{ $condition->id ?? '' }}" name="condition_question_label-{{ $condition->id ?? '' }}[]" value="{{ $condition->question_label ?? '' }}">
                                                                                     </div>
                                                                                </div>
                                                                                <div class="col-md-4">
                                                                                     <div class="form-group">
                                                                                          <label class="form-label" for="label_qu_id-{{ $condition->id ?? '' }}">Question ID</label>
                                                                                          <select class="form-select js-select2 new_label_question_id" name="label_qu_id-{{ $condition->id ?? '' }}[]" id="label_qu_id-{{ $condition->id ?? '' }}">
                                                                                               @foreach($questions ?? [] as $question)
                                                                                                    <option value="{{ $question->getName() ?? '' }}" {{ $condition->conditional_question_id == $question->getName() ? 'selected' : '' }}>
                                                                                                    {{ $question->getName() ?? '' }}
                                                                                                    </option>
                                                                                               @endforeach
                                                                                          </select>
                                                                                     </div>
                                                                                </div>
                                                                                <div class="col-md-4">
                                                                                     <div class="form-group">
                                                                                          <label class="form-label" for="condition_question_value-{{ $condition->id ?? '' }}">Value</label>
                                                                                          <input type="text" class="form-control" id="condition_question_value-{{ $condition->id ?? '' }}" name="condition_question_value-{{ $condition->id ?? '' }}[]" value="{{ $condition->conditional_question_value ?? '' }}">
                                                                                     </div>
                                                                                </div>
                                                                           </div>
                                                                           <br>
                                                                      </div>
                                                                      @endif
                                                                 @endforeach
                                                                 </div>
                                                                 <div class="text-end">
                                                                      <div class="form-group">
                                                                           <button type="button" class="btn btn-sm btn-primary" onclick="addLabel('{{ $docQues->id ?? '' }}')">Add Label</button>
                                                                      </div>
                                                                 </div>
                                                                 <hr>
                                                            </div>
                                                       @else
                                                       <div class="cond_ques_div{{ $docQues->id ?? '' }}" style="display:none;">
                                                            <div class="col-md-12">
                                                                 <div class="form-group">
                                                                      <label class="form-label" for="">Add conditional questions label</label>
                                                                 </div>
                                                            </div>
                                                            <div class="append_label_condition" id="append_label_condition{{ $docQues->id ?? '' }}"></div>
                                                            <div class="text-end">
                                                                 <div class="form-group">
                                                                      <button type="button" class="btn btn-sm btn-primary" onclick="addLabel('{{ $docQues->id ?? '' }}')">Add Label</button>
                                                                 </div>
                                                            </div>
                                                            <hr>
                                                       </div>
                                                       @endif
                                                       @if($isCondition)
                                                       <div class="col-md-12 hide_question_label" id="hide_question_label{{ $docQues->id ?? '' }}" style="display:none;">
                                                            <div class="form-group">
                                                                 <label class="form-label" for="text_qu_label-{{ $docQues->id ?? '' }}">Question Label</label>
                                                                 <input type="text" class="form-control question_labl" id="text_qu_label-{{ $docQues->id ?? '' }}" name="text_qu_label-${newUniqueId}" value="{{ $docQues->questionData->question_label ?? '' }}">
                                                            </div>
                                                            <hr>
                                                       </div>
                                                       @else
                                                       <div class="col-md-12 hide_question_label" id="hide_question_label{{ $docQues->id ?? '' }}">
                                                            <div class="form-group">
                                                                 <label class="form-label" for="text_qu_label-{{ $docQues->id ?? '' }}">Question Label</label>
                                                                 <input type="text" class="form-control question_labl" id="text_qu_label-{{ $docQues->id ?? '' }}" name="text_qu_label-${newUniqueId}" value="{{ $docQues->questionData->question_label ?? '' }}">
                                                            </div>
                                                            <hr>
                                                       </div>
                                                       @endif
                                                       <div class="col-md-12">
                                                            <div class="form-group">
                                                                 <label class="form-label" for="text_placeholder-{{ $docQues->id ?? '' }}">Text Box Placeholder</label>
                                                                 <input type="text" class="form-control text_box_placeholder" id="text_placeholder-{{ $docQues->id ?? '' }}" name="text_placeholder-{{ $docQues->id ?? '' }}" value="{{ $docQues->questionData->text_box_placeholder ?? '' }}">
                                                            </div>
                                                       </div>
                                                       <hr>
                                                       <div class="col-md-12">
                                                            <div class="form-group">
                                                                 <label class="form-label" for="text_go_to_step-{{ $docQues->id ?? '' }}">Go to step</label>
                                                                 <div class="form-control-wrap"> 
                                                                      <select class="form-select js-select2 new_label_question_id" data-search="on" name="text_go_to_step-{{ $docQues->id ?? '' }}" id="text_go_to_step-{{ $docQues->id ?? '' }}">
                                                                           <option value=""></option>     
                                                                           @if(isset($questions) && $questions != null)
                                                                           @foreach($questions as $question)
                                                                                <option value="{{ $question->getName() ?? '' }}">{{ $question->getName() ?? '' }}</option>
                                                                           @endforeach
                                                                           @endif
                                                                      </select>
                                                                 </div>
                                                            </div>
                                                       </div>
                                                       <hr>
                                                       <div class="col-md-12">
                                                            <div class="form-group">
                                                                 <label class="form-label" for="">Conditional Go to step Settings</label>
                                                            </div>
                                                       </div>
                                                       <div class="custom-control custom-checkbox checked">
                                                       @if(isset($docQues->is_condition) && $docQues->is_condition != null)
                                                            @if($docQues->is_condition == 1 && $docQues->condition_type == 2 || $docQues->condition_type == 3)
                                                            <input type="checkbox" class="custom-control-input enable_conditional" id="condition_go_to{{ $docQues->id ?? '' }}" name="condition_go_to{{ $docQues->id ?? '' }}" checked>
                                                            <label class="custom-control-label" for="condition_go_to{{ $docQues->id ?? '' }}">Enable Conditional Go To Step Settings</label>
                                                            @else
                                                            <input type="checkbox" class="custom-control-input enable_conditional" id="condition_go_to{{ $docQues->id ?? '' }}" name="condition_go_to{{ $docQues->id ?? '' }}">
                                                            <label class="custom-control-label" for="condition_go_to{{ $docQues->id ?? '' }}">Enable Conditional Go To Step Settings</label>
                                                            @endif
                                                       @else
                                                            <input type="checkbox" class="custom-control-input enable_conditional" id="condition_go_to{{ $docQues->id ?? '' }}" name="condition_go_to{{ $docQues->id ?? '' }}">
                                                            <label class="custom-control-label" for="condition_go_to{{ $docQues->id ?? '' }}">Enable Conditional Go To Step Settings</label>
                                                       @endif
                                                       </div>
                                                       <hr>
                                                       @php
                                                            $isCondition = isset($docQues->is_condition) && $docQues->is_condition != null;
                                                            $isConditionType2 = $isCondition && $docQues->is_condition == 1 && $docQues->condition_type == 2 || $docQues->condition_type == 3;
                                                            $enable_conditions = $isConditionType2 ? json_decode($docQues->conditions) : [];
                                                       @endphp

                                                       @if($isConditionType2 && !empty($enable_conditions))
                                                       <div class="cond_div{{ $docQues->id ?? '' }}">
                                                            <div class="col-md-12">
                                                                 <div class="form-group">
                                                                      <label class="form-label" for="">Add Conditions</label>
                                                                 </div>
                                                            </div>
                                                            <div class="append_page_condition" id="append_page_condition{{ $docQues->id ?? '' }}">
                                                            @foreach($enable_conditions as $condition)
                                                                 @if($condition->condition_type == 'go_to_step_condition')
                                                                 <div class="sec-condition" id="sec-condition{{ $condition->id ?? '' }}" data-id="{{ $condition->id ?? '' }}" data-is_new=false>
                                                                      <hr>
                                                                      <div class="text-end">
                                                                           <div class="form-group">
                                                                                <div>
                                                                                     <span onclick="removeCondition(this)" data-id="{{ $condition->id ?? '' }}">
                                                                                          <i class="fa fa-times"></i>
                                                                                     </span>
                                                                                </div>
                                                                           </div>
                                                                      </div>
                                                                      <div class="row">
                                                                           <div class="col-md-4">
                                                                                <div class="form-group">
                                                                                     <label class="form-label" for="page_Setting_qu_id-{{ $condition->id ?? '' }}">Question ID</label>
                                                                                     <div class="form-control-wrap question"> 
                                                                                          <select class="form-select js-select2" data-search="on" name="page_Setting_qu_id-{{ $condition->id ?? '' }}[]" id="page_Setting_qu_id-{{ $condition->id ?? '' }}">
                                                                                               @if(isset($questions) && $questions != null)
                                                                                                    @foreach($questions ?? [] as $question)
                                                                                                         <option value="{{ $question->getName() ?? '' }}" {{ $condition->conditional_question_id == $question->getName() ? 'selected' : '' }}>
                                                                                                         {{ $question->getName() ?? '' }}
                                                                                                         </option>
                                                                                                    @endforeach
                                                                                               @endif
                                                                                          </select>
                                                                                     </div>
                                                                                </div>
                                                                           </div>
                                                                           <div class="col-md-4">
                                                                                <div class="form-group">
                                                                                     <label class="form-label" for="page_Setting_conditions-{{ $condition->id ?? '' }}">Condition</label>
                                                                                     <div class="form-control-wrap"> 
                                                                                          <select class="form-select js-select2" name="page_Setting_conditions-{{ $condition->id ?? '' }}[]" id="page_Setting_conditions-{{ $condition->id ?? '' }}">
                                                                                               <option value="" selected disabled>Select</option>
                                                                                               @if(isset($condition->conditional_check) && $condition->conditional_check != null)
                                                                                               @if($condition->conditional_check == 1)
                                                                                                    <option value="is_equal_to" selected>is equal to</option>
                                                                                                    @else
                                                                                                    <option value="is_equal_to">is equal to</option>
                                                                                                    @endif

                                                                                                    @if($condition->conditional_check == 2)
                                                                                                    <option value="is_greater_than" selected>is greater than</option>
                                                                                                    @else
                                                                                                    <option value="is_greater_than">is greater than</option>
                                                                                                    @endif

                                                                                                    @if($condition->conditional_check == 3)
                                                                                                    <option value="is_less_than" selected>is less than</option>
                                                                                                    @else
                                                                                                    <option value="is_less_than">is less than</option>
                                                                                                    @endif

                                                                                                    @if($condition->conditional_check == 4)
                                                                                                    <option value="not_equal_to" selected>not equal to</option>
                                                                                                    @else
                                                                                                    <option value="not_equal_to">not equal to</option>
                                                                                                    @endif
                                                                                               @else
                                                                                               <option value="is_equal_to">is equal to</option>
                                                                                               <option value="is_greater_than">is greater than</option>
                                                                                               <option value="is_less_than">is less than</option>
                                                                                               <option value="not_equal_to">not equal to</option>
                                                                                               @endif
                                                                                          </select>
                                                                                     </div>
                                                                                </div>
                                                                           </div>
                                                                           <div class="col-md-4">
                                                                                <div class="form-group">
                                                                                     <label class="form-label" for="page_Setting_qu_val-{{ $condition->id ?? '' }}">Value</label>
                                                                                     <input type="text" class="form-control" id="page_Setting_qu_val-{{ $condition->id ?? '' }}" name="page_Setting_qu_val-{{ $condition->id ?? '' }}[]" value="{{ $condition->conditional_question_value ?? '' }}">
                                                                                </div>
                                                                           </div>
                                                                      </div>
                                                                      <br>
                                                                 </div>
                                                                 @endif
                                                            @endforeach
                                                            </div>
                                                            <div class="text-end">
                                                                 <div class="form-group">
                                                                      <button type="button" class="btn btn-sm btn-primary" onclick="addCondition('{{ $docQues->id ?? '' }}')">Add Condition</button>
                                                                 </div>
                                                            </div>
                                                       </div>
                                                       @else
                                                       <div class="cond_div{{ $docQues->id ?? '' }}" style="display:none">
                                                            <div class="col-md-12">
                                                                 <div class="form-group">
                                                                      <label class="form-label" for="">Add Conditions</label>
                                                                 </div>
                                                            </div>
                                                            <div class="append_page_condition" id="append_page_condition{{ $docQues->id ?? '' }}"></div>
                                                            <div class="text-end">
                                                                 <div class="form-group">
                                                                      <button type="button" class="btn btn-sm btn-primary" onclick="addCondition('{{ $docQues->id ?? '' }}')">Add Condition</button>
                                                                 </div>
                                                            </div>
                                                            <hr>
                                                       </div>
                                                       @endif
                                                  </div>
                                             </div>
                                             <br>
                                        </div>
                                   </div>
                                   @elseif($docQues->type == 'dropdown-link')
                                   <div class="new_que_sec{{ $docQues->id ?? '' }}">
                                        <div class="append_dropdownLink" id="append_dropdownLink{{ $docQues->id ?? '' }}" data-id="{{ $docQues->id ?? '' }}" data-is_new=false>
                                             <div class="card card-bordered card-preview">
                                                  <div class="card-inner">
                                                       <div class="row add_step">
                                                            <div class="col-md-1">
                                                                 <b><p>{{ $num++ ?? ''}}</p></b>
                                                            </div>
                                                            <div class="col-md-6">
                                                                 <h6>Dropdown link</h6> 
                                                                 <!-- <div class="form-group">
                                                                      <select class="form-select js-select2 new_question" name="question_type{{ $docQues->id ?? '' }}" id="question_type{{ $docQues->id ?? '' }}">
                                                                           @foreach($types as $type)
                                                                                @if($docQues->type == $type->slug)
                                                                                <option value="{{ $type->slug ?? '' }}" selected>{{ $type->name ?? '' }}</option>
                                                                                @else
                                                                                <option value="{{ $type->slug ?? '' }}">{{ $type->name ?? '' }}</option>
                                                                                @endif
                                                                           @endforeach
                                                                      </select>
                                                                 </div>   -->
                                                            </div> 
                                                            <div class="col-md-5">
                                                                 <div class="form-group">
                                                                      <span class="col-md-2 offset-md-10">
                                                                           <span onclick="removeFields(this)" data-field="dropdown-link" data-id="{{ $docQues->id ?? '' }}"><i class="fa-solid fa-minus"></i></span>
                                                                      </span>  
                                                                 </div>
                                                            </div>
                                                       </div>
                                                       <hr>
                                                       <div class="col-md-12">
                                                            <div class="form-group">
                                                                 <label class="form-label" for="text_qu_label-{{ $docQues->id ?? '' }}">Question Label</label>
                                                                 <input type="text" class="form-control dropdown_ques" id="text_qu_label-{{ $docQues->id ?? '' }}" name="text_qu_label-{{ $docQues->id ?? '' }}" value="{{ $docQues->questionData->question_label ?? '' }}">
                                                            </div>
                                                       </div>
                                                       <hr>
                                                       <div class="col-md-12">
                                                            <div class="form-group">
                                                                 <label class="form-label" for="same_contract_link-{{ $docQues->id ?? '' }}">Same Contract Link Label</label>
                                                                 <input type="text" class="form-control same_contract" id="same_contract_link-{{ $docQues->id ?? '' }}" name="same_contract_link-{{ $docQues->id ?? '' }}" value="{{ $docQues->questionData->same_contract_link_label ?? '' }}">
                                                            </div>
                                                       </div>
                                                       <hr>
                                                       <div class="col-md-12">
                                                            <div class="form-group">
                                                                 <label class="form-label" for="">Different Contract Link</label>
                                                            </div>
                                                       </div>
                                                       <div class="add_cont_rw" id="add_cont_rw{{ $docQues->id ?? '' }}">
                                                       @if(isset($docQues->options) && $docQues->options != null)
                                                       <?php $options = json_decode($docQues->options); ?>
                                                       @foreach($options as $option)
                                                       <div class="contract-option" id="contract-option{{ $option->id ?? '' }}" data-id="{{ $option->id ?? '' }}" data-is_new=false>
                                                            <hr>
                                                            <div class="text-end">
                                                                 <div class="form-group">
                                                                      <div>
                                                                           <span onclick="removeContract(this)" data-id="{{ $option->id ?? '' }}">
                                                                                <i class="fa fa-times"></i>
                                                                           </span>
                                                                      </div>
                                                                 </div>
                                                            </div>
                                                            <div class="row">
                                                                 <div class="col-md-4">
                                                                      <div class="form-group">
                                                                           <label class="form-label" for="dropdown_link_label{{ $option->id ?? '' }}">Label</label>
                                                                           <input type="text" class="form-control" id="dropdown_link_label{{ $option->id ?? '' }}" name="dropdown_link_label{{ $option->id ?? '' }}[]" value="{{ $option->option_label ?? '' }}">
                                                                      </div>
                                                                 </div>
                                                                 <div class="col-md-4">
                                                                      <div class="form-group">
                                                                           <label class="form-label" for="contract_link{{ $option->id ?? '' }}">Contract Link</label>
                                                                           <input type="text" class="form-control" id="contract_link{{ $option->id ?? '' }}" name="contract_link{{ $option->id ?? '' }}[]" value="{{ $option->contract_link ?? '' }}">
                                                                      </div>
                                                                 </div>
                                                                 <div class="col-md-4">
                                                                      <div class="form-group">
                                                                           <label class="form-label" for="">Contract send to next step</label>
                                                                           <div class="custom-control custom-checkbox checked">
                                                                           @if(isset($option->contract_send_to_next_step) && $option->contract_send_to_next_step != null)
                                                                                @if($option->contract_send_to_next_step == 1)
                                                                                <input type="checkbox" class="custom-control-input" id="contract_send_next_step{{ $option->id ?? '' }}" name="contract_send_next_step{{ $option->id ?? '' }}[]" checked>
                                                                                <label class="custom-control-label" for="contract_send_next_step{{ $option->id ?? '' }}"></label>
                                                                                @else
                                                                                <input type="checkbox" class="custom-control-input" id="contract_send_next_step{{ $option->id ?? '' }}" name="contract_send_next_step{{ $option->id ?? '' }}[]">
                                                                                <label class="custom-control-label" for="contract_send_next_step{{ $option->id ?? '' }}"></label>
                                                                                @endif
                                                                           @else
                                                                           <input type="checkbox" class="custom-control-input" id="contract_send_next_step{{ $option->id ?? '' }}" name="contract_send_next_step{{ $option->id ?? '' }}[]">
                                                                           <label class="custom-control-label" for="contract_send_next_step{{ $option->id ?? '' }}"></label>
                                                                           @endif
                                                                           </div>  
                                                                      </div>
                                                                 </div>
                                                            </div>
                                                            <br>
                                                       </div>
                                                       <br>
                                                       @endforeach
                                                       @endif
                                                       </div>
                                                       <div class="text-end">
                                                            <div class="form-group">
                                                                 <button type="button" class="btn btn-sm btn-primary" onclick="addContractRow('{{ $docQues->id ?? '' }}')">Add Row</button>
                                                            </div>
                                                       </div>
                                                       <hr>
                                                       <div class="col-md-12">
                                                            <div class="form-group">
                                                                 <label class="form-label" for="text_go_to_step-{{ $docQues->id ?? '' }}">Go to step</label>
                                                                 <div class="form-control-wrap"> 
                                                                      <select class="form-select js-select2 new_label_question_id" data-search="on" name="text_go_to_step-{{ $docQues->id ?? '' }}" id="text_go_to_step-{{ $docQues->id ?? '' }}">
                                                                           <option value=""></option>
                                                                           @if(isset($questions) && $questions != null)     
                                                                           @foreach($questions ?? [] as $question)
                                                                                <option value="{{ $question->getName() ?? '' }}" {{ $docQues->questionData->next_question_id == $question->getName() ? 'selected' : '' }}>
                                                                                {{ $question->getName() ?? '' }}
                                                                                </option>
                                                                           @endforeach
                                                                           @endif
                                                                      </select>
                                                                 </div>
                                                            </div>
                                                       </div>
                                                  </div>
                                             </div>
                                             <br>
                                        </div>
                                   </div>
                                   @endif
                                   @endforeach
                                   @endif
                                  </div>
                                   <br>
                                   <div class="text-end">
                                        <button type="button" class="btn btn-sm btn-primary question_dropbtn"
                                             onclick="toggleDropdown('testing')">Add question</button>
                                        <div class="form-group question_dropdown">
                                             <div id="testing" class="question_dropdown-content">
                                                  @foreach($types as $type)
                                                       <a onclick="addQuestionfields('{{ $type->slug ?? '' }}','${unqId}','first')">{{ $type->name ?? '' }}</a>
                                                  @endforeach
                                             </div>
                                        </div>
                                   </div>
                                   <div class="col-md-12">
                                        <div class="form-group">
                                             <label class="form-label" for="">Form submit handler for generating pdf</label>
                                        </div>
                                   </div>
                                   <div class="custom-control custom-checkbox checked">
                                        <input type="checkbox" class="custom-control-input" id="last_step" name="last_step">
                                        <label class="custom-control-label" for="last_step">Please check this box if you are on the last
                                             step</label>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>
               <div class="col col-md-4 right-content">
                    <div class="card card-bordered card-preview">
                         <div class="card-inner">
                              <div class="d-flex justify-content-end">
                                   <div class="nk-block-head-content">
                                        <div class="up-btn mbsc-form-group">
                                             @if(isset($_GET['id']) && $_GET['id'] != null)
                                             <button class="btn btn-sm btn-primary" type="button" id="updateQuestiondata">Update</button>
                                             @else
                                             <button class="btn btn-sm btn-primary" type="button" id="saveQuestiondata1">Save</button>
                                             @endif
                                        </div>
                                   </div>
                              </div>
                              <div class="d-flex justify-content-end">
                                   <div class="nk-block-head-content butn-cls">
                                        <div class="mbsc-form-group view_btn mt-3">
                                             @if(isset($_GET['id']) && $_GET['id'] != null)
                                             <a href="" target="_blank" class="view_page">View Page</a>
                                             @else
                                             <a class="view_page" disabled>View Page</a>
                                             @endif
                                        </div>
                                   </div>
                              </div>
                              <!-- <div class="col-md-12">
                                   <div class="form-group">
                                        <p>Published</p>
                                        <div class="custom-control custom-switch">
                                             <input type="checkbox" class="custom-control-input publish" id="publish1">
                                             <label class="custom-control-label" for="publish1"></label>
                                        </div>
                                   </div>
                              </div> -->
                              <!-- <div class="col-md-12 mt-2">
                                   <div class="form-group">
                                        <label class="form-label" for="document_id">Select Document</label>  
                                        <div class="form-control-wrap"> 
                                             <select class="form-select js-select2" data-search="on" name="document_id" id="document_id">
                                                  <option value="" selected disabled>Select</option>
                                                  @if(isset($documents) && $documents != null)
                                                  @foreach($documents as $document)
                                                       @if(isset($_GET['id']) && $_GET['id'] != null)
                                                            @if($_GET['id'] == $document->id)
                                                            <option value="{{ $document->id ?? '' }}" selected>{{ $document->title ?? '' }}</option>
                                                            @else
                                                            <option value="{{ $document->id ?? '' }}">{{ $document->title ?? '' }}</option>
                                                            @endif
                                                       @else
                                                       <option value="{{ $document->id ?? '' }}">{{ $document->title ?? '' }}</option>
                                                       @endif
                                                  @endforeach
                                                  @endif
                                             </select>
                                        </div>
                                   </div>
                              </div> -->
                         </div> 
                    </div>
               </div>
          </div>
     </div>
</div>

<script>
     function toggleDropdown(id) {
          // console.log("Toggling dropdown for ID:", id);
          const dropdown = document.getElementById(id);
          if(dropdown){
               dropdown.classList.toggle("show");
          }else{
               console.error(`Dropdown with ID ${id} not found.`);
          }
     }

     window.onclick = function(event) {
          if(!event.target.matches('.question_dropbtn')) {
               const dropdowns = document.getElementsByClassName("question_dropdown-content");
               for(let i=0; i<dropdowns.length; i++){
                    const openDropdown = dropdowns[i];
                    if(openDropdown.classList.contains('show')){
                         openDropdown.classList.remove('show');
                    }
               }
          }
     }

</script>

<script>
     $(document).ready(function(){

          $('#last_step').on('change',function(){
               if($(this).is(':checked')){
                   $('#is_end').val(1);
               }else{
                    $('#is_end').val(0);
               }
          });

          // To remove the steps 
          $('body').delegate('.remove_steps','click', function(){
               if($(this).attr('value') === 'appended'){
                    $(this).closest('.steps_section').remove();
               }else{
                    var id = $(this).data('id');
                    let deleteIds = $('#img_sec_ids').val();
                    if(deleteIds){
                         deleteIds += ',' + id;
                    }else{
                         deleteIds = id;
                    }
                    $('#img_sec_ids').val(deleteIds);
                    $('.steps_section'+id).hide();
               }
          })

          // $(document).on('keyup', 'input', (e) => {
          //      const input = $(e.target); // Select the current input field
          //      const value = input.val(); // Get the current value of the input
          //      input.attr('attempted', value); // Set the 'attempted' attribute with the current value
          //      console.log(value); // Log the value if needed
          // });


          // To remove the questions 
          $('body').delegate('.remove_questions','click', function(){
               if($(this).attr('value') === 'appended'){
                    $(this).closest('.append_textbox').remove();
               }else{
                    var id = $(this).data('id');
                    let deleteIds = $('#img_sec_ids').val();
                    if(deleteIds){
                         deleteIds += ',' + id;
                    }else{
                         deleteIds = id;
                    }
                    $('#img_sec_ids').val(deleteIds);
                    $('#append_textbox'+id).hide();
               }
          })
     });

     // To add the  Label 
     let label_count = 0;
     function addLabel(id){
          label_count++ ;
          const html = `<div class="label-condition" id="label-condition${id}" value="appended" data-is_new=true>
                         <hr>
                         <div class="text-end">
                              <div class="form-group">
                                   <div>
                                        <span onclick="removeLabel(this)" value="appended">
                                             <i class="fa fa-times"></i>
                                        </span>
                                   </div>
                              </div>
                         </div>
                         <div class="row">
                              <div class="col-md-4">
                                   <div class="form-group">
                                        <label class="form-label" for="condition_question_label-${label_count}">Label</label>
                                        <input type="text" class="form-control" id="condition_question_label-${label_count}" name="condition_question_label-${label_count}[]" value="">
                                   </div>
                              </div>
                              <div class="col-md-4">
                                   <div class="form-group">
                                        <label class="form-label" for="label_qu_id-${label_count}">Question ID</label>
                                        <div class="form-control-wrap question"> 
                                             <select class="form-select js-select2 new_label_question_id" data-search="on" name="label_qu_id-${label_count}[]" id="label_qu_id-${label_count}">
                                                  @if(isset($questions) && $questions != null)
                                                       @foreach($questions as $question)
                                                            <option value="{{ $question->getName() ?? '' }}">{{ $question->getName() ?? '' }}</option>
                                                       @endforeach
                                                  @endif
                                             </select>
                                        </div>
                                   </div>
                              </div>
                              <div class="col-md-4">
                                   <div class="form-group">
                                        <label class="form-label" for="condition_question_value-${label_count}">Value</label>
                                        <input type="text" class="form-control" id="condition_question_value-${label_count}" name="condition_question_value-${label_count}[]" value="">
                                   </div>
                              </div>
                         </div>
                         <br>
                    </div>`
          $('#append_label_condition'+id).append(html);
          $('.js-select2').select2();
     }

     // To remove  the label 
     function removeLabel(e){
          if($(e).attr('value') === 'appended'){
               $(e).closest('.label-condition').remove();
          }else{
               var id = $(e).data('id');
               let deleteIds = $('#condition_id').val();
               if(deleteIds){
                    deleteIds += ',' + id;
               }else{
                    deleteIds = id;
               }
               $('#condition_id').val(deleteIds);
               $('#label-condition'+id).hide();
          }
     }

     // Add the condition 
     let condition_count = 0;
     function addCondition(id){
          condition_count++ ;
          const html = `<div class="sec-condition" id="sec-condition${id}" value="appended" data-is_new=true>
                         <hr>
                         <div class="text-end">
                              <div class="form-group">
                                   <div>
                                        <span onclick="removeCondition(this)" value="appended">
                                             <i class="fa fa-times"></i>
                                        </span>
                                   </div>
                              </div>
                         </div>
                         <div class="row">
                              <div class="col-md-4">
                                   <div class="form-group">
                                        <label class="form-label" for="page_Setting_qu_id-${condition_count}">Question ID</label>
                                        <div class="form-control-wrap question"> 
                                             <select class="form-select js-select2" data-search="on" name="page_Setting_qu_id-${condition_count}[]" id="page_Setting_qu_id-${condition_count}">
                                                  @if(isset($questions) && $questions != null)
                                                       @foreach($questions as $question)
                                                            <option value="{{ $question->getName() ?? '' }}">{{ $question->getName() ?? '' }}</option>
                                                       @endforeach
                                                  @endif
                                             </select>
                                        </div>
                                   </div>
                              </div>
                              <div class="col-md-4">
                                   <div class="form-group">
                                        <label class="form-label" for="page_Setting_conditions-${condition_count}">Condition</label>
                                        <div class="form-control-wrap"> 
                                             <select class="form-select js-select2" name="page_Setting_conditions-${condition_count}[]" id="page_Setting_conditions-${condition_count}">
                                                  <option value="" selected disabled>Select</option>
                                                  <option value="is_equal_to">is equal to</option>
                                                  <option value="is_greater_than">is greater than</option>
                                                  <option value="is_less_than">is less than</option>
                                                  <option value="not_equal_to">not equal to</option>
                                             </select>
                                        </div>
                                   </div>
                              </div>
                              <div class="col-md-4">
                                   <div class="form-group">
                                        <label class="form-label" for="page_Setting_qu_val-${condition_count}">Value</label>
                                        <input type="text" class="form-control" id="page_Setting_qu_val-${condition_count}" name="page_Setting_qu_val-${condition_count}[]" value="">
                                   </div>
                              </div>
                         </div>
                         <br>
                    </div>`
          $('#append_page_condition'+id).append(html);
          $('.js-select2').select2();
     }

     // Remove the condition 
     function removeCondition(e){
          if($(e).attr('value') === 'appended'){
               $(e).closest('.sec-condition').remove();
          }else{
               var id = $(e).data('id');
               let deleteIds = $('#condition_id').val();
               if(deleteIds){
                    deleteIds += ',' + id;
               }else{
                    deleteIds = id;
               }
               $('#condition_id').val(deleteIds);
               $('#sec-condition'+id).hide();
          }
     }

     // Add the options inside the dropdown 
     function addOptions(value,id){
          let uID = Date.now();
          let html = ``;
          if(value === 'dropdown'){
               html = `<div class="dropdown-option" id="dropdown-option${uID}" value="appended" data-is_new=true>
                    <hr>
                    <div class="text-end">
                         <div class="form-group">
                              <div>
                                   <span onclick="removeOptions(this)" data-field="${value}" value="appended">
                                        <i class="fa fa-times"></i>
                                   </span>
                              </div>
                         </div>
                    </div>
                    <div class="row">
                         <div class="col-md-4">
                              <div class="form-group">
                                   <label class="form-label" for="dropdown_option_label-${uID}">Label</label>
                                   <input type="text" class="form-control" id="dropdown_option_label-${uID}" name="dropdown_option_label-${uID}[]" value="">
                              </div>
                         </div>
                         <div class="col-md-4">
                              <div class="form-group">
                                   <label class="form-label" for="dropdown_option_value-${uID}">Value</label>
                                   <input type="text" class="form-control" id="dropdown_option_value-${uID}" name="dropdown_option_value-${uID}[]" value="">
                              </div>
                         </div>
                         <div class="col-md-4">
                              <div class="form-group">
                                   <label class="form-label" for="dropdown_go_to_step-${uID}">Go to Step</label>
                                   <div class="form-control-wrap"> 
                                        <select class="form-select js-select2 new_label_question_id" data-search="on" name="dropdown_go_to_step-${uID}[]" id="dropdown_go_to_step-${uID}">
                                             <option value=""></option>
                                             @if(isset($questions) && $questions != null)
                                                  @foreach($questions as $question)
                                                       <option value="{{ $question->getName() ?? '' }}">{{ $question->getName() ?? '' }}</option>
                                                  @endforeach
                                             @endif
                                        </select>
                                   </div>
                              </div>
                         </div>
                    </div>
                    <br>
               </div>`;
          }else if(value === 'radio-button'){
               html = `<div class="radio-option" id="radio-option${uID}" value="appended" data-is_new=true>
                    <hr>
                    <div class="text-end">
                         <div class="form-group">
                              <div>
                                   <span onclick="removeOptions(this)" data-field="${value}" value="appended">
                                        <i class="fa fa-times"></i>
                                   </span>
                              </div>
                         </div>
                    </div>
                    <div class="row">
                         <div class="col-md-4">
                              <div class="form-group">
                                   <label class="form-label" for="radio_option_label-${uID}">Label</label>
                                   <input type="text" class="form-control" id="radio_option_label-${uID}" name="radio_option_label-${uID}[]" value="">
                              </div>
                         </div>
                         <div class="col-md-4">
                              <div class="form-group">
                                   <label class="form-label" for="radio_option_value-${uID}">Value</label>
                                   <input type="text" class="form-control" id="radio_option_value-${uID}" name="radio_option_value-${uID}[]" value="">
                              </div>
                         </div>
                         <div class="col-md-4">
                              <div class="form-group">
                                   <label class="form-label" for="radio_go_to_step-${uID}">Go to Step</label>
                                   <div class="form-control-wrap"> 
                                        <select class="form-select js-select2 new_label_question_id" data-search="on" name="radio_go_to_step-${uID}[]" id="radio_go_to_step-${uID}">
                                             <option value=""></option>
                                             @if(isset($questions) && $questions != null)
                                                  @foreach($questions as $question)
                                                       <option value="{{ $question->getName() ?? '' }}">{{ $question->getName() ?? '' }}</option>
                                                  @endforeach
                                             @endif
                                        </select>
                                   </div>
                              </div>
                         </div>
                    </div>
                    <br>
               </div>`;
          }
          $('#append_options'+id).append(html);
          $('.js-select2').select2();
     }

     // Remove the options 
     function removeOptions(e){
          if($(e).attr('data-field') === 'dropdown'){
               if($(e).attr('value') === 'appended'){
                    $(e).closest('.dropdown-option').remove();
               }else{
                    var id = $(e).data('id');
                    let deleteIds = $('#option_id').val();
                    if(deleteIds){
                         deleteIds += ',' + id;
                    }else{
                         deleteIds = id;
                    }
                    $('#option_id').val(deleteIds);
                    $('#dropdown-option'+id).hide();
               }
          }else if($(e).attr('data-field') === 'radio-button'){
               if($(e).attr('value') === 'appended'){
                    $(e).closest('.radio-option').remove();
               }else{
                    var id = $(e).data('id');
                    let deleteIds = $('#option_id').val();
                    if(deleteIds){
                         deleteIds += ',' + id;
                    }else{
                         deleteIds = id;
                    }
                    $('#option_id').val(deleteIds);
                    $('#radio-option'+id).hide();
               }
          }
     }

     function addContractRow(id){
          const newUniqueId = Date.now();
          const html = `<div class="contract-option" id="contract-option${newUniqueId}" value="appended" data-is_new=true>
                              <hr>
                              <div class="text-end">
                                   <div class="form-group">
                                        <div>
                                             <span onclick="removeContract(this)" value="appended">
                                                  <i class="fa fa-times"></i>
                                             </span>
                                        </div>
                                   </div>
                              </div>
                              <div class="row">
                                   <div class="col-md-4">
                                        <div class="form-group">
                                             <label class="form-label" for="dropdown_link_label${newUniqueId}">Label</label>
                                             <input type="text" class="form-control" id="dropdown_link_label${newUniqueId}" name="dropdown_link_label${newUniqueId}[]" value="">
                                        </div>
                                   </div>
                                   <div class="col-md-4">
                                        <div class="form-group">
                                             <label class="form-label" for="contract_link${newUniqueId}">Contract Link</label>
                                             <input type="text" class="form-control" id="contract_link${newUniqueId}" name="contract_link${newUniqueId}[]" value="">
                                        </div>
                                   </div>
                                   <div class="col-md-4">
                                        <div class="form-group">
                                             <label class="form-label" for="">Contract send to next step</label>
                                             <div class="custom-control custom-checkbox checked">
                                                  <input type="checkbox" class="custom-control-input" id="contract_send_next_step${newUniqueId}" name="contract_send_next_step${newUniqueId}[]">
                                                  <label class="custom-control-label" for="contract_send_next_step${newUniqueId}"></label>
                                             </div>  
                                        </div>
                                   </div>
                              </div>
                              <br>
                         </div>`;
          $('#add_cont_rw'+id).append(html);
     }

     function removeContract(e){
          if($(e).attr('value') === 'appended'){
               $(e).closest('.contract-option').remove();
          }else{
               var id = $(e).data('id');
               let deleteIds = $('#option_id').val();
               if(deleteIds){
                    deleteIds += ',' + id;
               }else{
                    deleteIds = id;
               }
               $('#option_id').val(deleteIds);
               $('#contract-option'+id).hide();
          }
     }

     // function conditionalQuestions(id){
     //      if($('#condition_qu_label'+id).is(':checked')){
     //           $('.cond_ques_div'+id).show();
     //           $('#hide_question_label'+id).hide();
     //      }else{
     //           $('.cond_ques_div'+id).hide();
     //           $('#hide_question_label'+id).show();
     //      }
     // }

     // function conditionalPageSetting(id){
     //      if($('#condition_go_to'+id).is(':checked')){
     //           $('.cond_div'+ id).show();
     //      }else{
     //           $('.cond_div'+id).hide();
     //      }
     // }

     let step_count = 0;
     // Add the new step code 
     function addSteps(){
          const uniqueDropdownId = 'dropdown_' + Date.now();
          const unqId = Date.now();
          step_count++ ;
          const html = `<div class="steps_section" id="steps_section${step_count}">
               <div class="card card-bordered card-preview">
                    <div class="card-inner">
                         <div class="row add_step">
                              <div class="col-md-6">
                                   <h6>Add Steps </h6>  
                              </div> 
                              <div class="col-md-6">
                                   <div class="form-group">
                                        <span class="col-md-2 offset-md-10">
                                             <span class="remove_steps" value="appended"><i class="fa-solid fa-minus"></i></span>
                                        </span>  
                                   </div>
                              </div>
                         </div>
                         <hr>

                         <div class="add_qu_sec" id="add_qu_sec_${unqId}"></div>
                         <div class="col-md-12">
                              <div class="form-group">
                                   <label class="form-label" for="">Add Questions</label>
                              </div>
                         </div>
                         <div class="text-end">
                              <button type="button" class="btn btn-sm btn-primary question_dropbtn" onclick="toggleDropdown('${uniqueDropdownId}')">Add Question</button>
                              <div class="form-group question_dropdown"> 
                                   <div id="${uniqueDropdownId}" class="question_dropdown-content">
                                        @foreach($types as $type)
                                             <a onclick="addQuestionfields('{{ $type->slug ?? '' }}','${unqId}')">{{ $type->name ?? '' }}</a>
                                        @endforeach
                                   </div>
                              </div>
                         </div>
                         <hr>
                         <div class="col-md-12">
                              <div class="form-group">
                                   <label class="form-label" for="">Form submit handler for generating pdf</label>
                              </div>
                         </div>
                         <div class="custom-control custom-checkbox checked">
                              <input type="checkbox" class="custom-control-input" id="last_step" name="last_step">
                              <label class="custom-control-label" for="last_step">Please check this box if you are on the last step</label>
                         </div>
                    </div>
               </div><br>
               </div>`;
          
          $('.add_steps').append(html);
     }


     // This is the question field 
     let textbox_count = 0;
     let textarea_count = 0;
     let dropdown_count = 0;
     let radio_count = 0;
     let datefield_count = 0;
     let pricebox_count = 0;
     let numberfield_count = 0;
     let percentage_count = 0;
     let droplink_count = 0;

     function addQuestionfields(name,id,key){
          // console.log(name,id);
          const newUniqueId = Date.now();
          let html = ``;
          const types = <?php echo json_encode($types); ?>;

          if(name === 'textbox'){
               textbox_count++ ;
               html = `<div class="new_que_sec${newUniqueId}">
                    <div class="append_textbox" id="append_textbox${newUniqueId}" value="appended" data-is_new=true>
                         <div class="card card-bordered card-preview">
                              <div class="card-inner main_question_div">
                                   <div class="row add_step">
                                        <div class="col-md-6">
                                             <!-- <h6>Textbox</h6> -->
                                             <div class="form-group">
                                                  <select class="form-select js-select2 type_question" name="question_type${newUniqueId}" id="question_type${newUniqueId}">
                                                       ${types.map(type => `
                                                       <option value="${type.slug}" ${name === type.slug ? 'selected' : ''}>${type.name}</option>
                                                       `).join('')}
                                                  </select>
                                             </div>  
                                        </div> 
                                        <div class="col-md-6">
                                             <div class="form-group">
                                                  <span class="col-md-2 offset-md-10">
                                                       <span onclick="removeFields(this)" value="appended" data-field="textbox"><i class="fa-solid fa-minus"></i></span>
                                                  </span>  
                                             </div>
                                        </div>
                                   </div>
                                   <hr>
                                   <div class="col-md-12">
                                        <div class="form-group">
                                             <label class="form-label" for="">Conditional questions label</label>
                                        </div>
                                   </div>
                                   <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input add_conditional_label" id="condition_qu_label${newUniqueId}" name="condition_qu_label${newUniqueId}">
                                        <label class="custom-control-label" for="condition_qu_label${newUniqueId}">Conditional questions label</label>
                                   </div>
                                   <hr>
                                   <div class="cond_ques_div${newUniqueId}" style="display:none;">
                                        <div class="col-md-12">
                                             <div class="form-group">
                                                  <label class="form-label" for="">Add conditional questions label</label>
                                             </div>
                                        </div>
                                        <div class="append_label_condition" id="append_label_condition${newUniqueId}"></div>
                                        <div class="text-end">
                                             <div class="form-group">
                                                  <button type="button" class="btn btn-sm btn-primary" onclick="addLabel('${newUniqueId}')">Add Label</button>
                                             </div>
                                        </div>
                                        <hr>
                                   </div>
                                   <div class="col-md-12 hide_question_label" id="hide_question_label${newUniqueId}">
                                        <div class="form-group">
                                             <label class="form-label" for="text_qu_label-${newUniqueId}">Question Label</label>
                                             <input type="text" class="form-control question_labl" id="text_qu_label-${newUniqueId}" name="text_qu_label-${newUniqueId}" value="">
                                        </div>
                                        <hr>
                                   </div>
                                   <div class="col-md-12">
                                        <div class="form-group">
                                             <label class="form-label" for="text_placeholder-${newUniqueId}">Text Box Placeholder</label>
                                             <input type="text" class="form-control text_box_placeholder" id="text_placeholder-${newUniqueId}" name="text_placeholder-${newUniqueId}" value="">
                                        </div>
                                   </div>
                                   <hr>
                                   <div class="col-md-12">
                                        <div class="form-group">
                                             <label class="form-label" for="text_go_to_step-${newUniqueId}">Go to step</label>
                                             <div class="form-control-wrap"> 
                                                  <select class="form-select js-select2 new_label_question_id" data-search="on" name="text_go_to_step-${newUniqueId}" id="text_go_to_step-${newUniqueId}">
                                                       <option value=""></option>
                                                       @if(isset($questions) && $questions != null)
                                                            @foreach($questions as $question)
                                                                 <option value="{{ $question->getName() ?? '' }}">{{ $question->getName() ?? '' }}</option>
                                                            @endforeach
                                                       @endif
                                                  </select>
                                             </div>
                                        </div>
                                   </div>
                                   <hr>
                                   <div class="col-md-12">
                                        <div class="form-group">
                                             <label class="form-label" for="">Conditional Go to step Settings</label>
                                        </div>
                                   </div>
                                   <div class="custom-control custom-checkbox checked">
                                        <input type="checkbox" class="custom-control-input enable_conditional" id="condition_go_to${newUniqueId}" name="condition_go_to${newUniqueId}">
                                        <label class="custom-control-label" for="condition_go_to${newUniqueId}">Enable Conditional Go To Step Settings</label>
                                   </div>
                                   <hr>
                                   <div class="cond_div${newUniqueId}" style="display:none;">
                                        <div class="col-md-12">
                                             <div class="form-group">
                                                  <label class="form-label" for="">Add Conditions</label>
                                             </div>
                                        </div>
                                        <div class="append_page_condition" id="append_page_condition${newUniqueId}"></div>
                                        <div class="text-end">
                                             <div class="form-group">
                                                  <button type="button" class="btn btn-sm btn-primary" onclick="addCondition('${newUniqueId}')">Add Condition</button>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                         </div>
                         <br>
                    </div>
                    </div>`;
          }else if(name === 'textarea'){
               textarea_count++ ;
               html =`<div class="new_que_sec${newUniqueId}">
                    <div class="append_textarea" id="append_textarea${newUniqueId}" value="appended" data-is_new=true>
                         <div class="card card-bordered card-preview">
                              <div class="card-inner">
                                   <div class="row add_step">
                                        <div class="col-md-6">
                                             <!-- <h6>Textarea</h6> -->
                                             <div class="form-group">
                                                  <select class="form-select js-select2 type_question" name="question_type${newUniqueId}" id="question_type${newUniqueId}">
                                                       ${types.map(type => `
                                                       <option value="${type.slug}" ${name === type.slug ? 'selected' : ''}>${type.name}</option>
                                                       `).join('')}
                                                  </select>
                                             </div> 
                                        </div> 
                                        <div class="col-md-6">
                                             <div class="form-group">
                                                  <span class="col-md-2 offset-md-10">
                                                       <span onclick="removeFields(this)" value="appended" data-field="textarea"><i class="fa-solid fa-minus"></i></span>
                                                  </span>  
                                             </div>
                                        </div>
                                   </div>
                                   <hr>
                                   <div class="col-md-12">
                                        <div class="form-group">
                                             <label class="form-label" for="">Conditional questions label</label>
                                        </div>
                                   </div>
                                   <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input add_conditional_label" id="condition_qu_label${newUniqueId}" name="condition_qu_label${newUniqueId}">
                                        <label class="custom-control-label" for="condition_qu_label${newUniqueId}">Conditional questions label</label>
                                   </div>
                                   <hr>
                                   <div class="cond_ques_div${newUniqueId}" style="display:none;">
                                        <div class="col-md-12">
                                             <div class="form-group">
                                                  <label class="form-label" for="">Add conditional questions label</label>
                                             </div>
                                        </div>
                                        <div class="append_label_condition" id="append_label_condition${newUniqueId}"></div>
                                        <div class="text-end">
                                             <div class="form-group">
                                                  <button type="button" class="btn btn-sm btn-primary" onclick="addLabel('${newUniqueId}')">Add Label</button>
                                             </div>
                                        </div>
                                        <hr>
                                   </div>
                                   <div class="col-md-12 hide_question_label" id="hide_question_label${newUniqueId}">
                                        <div class="form-group">
                                             <label class="form-label" for="text_qu_label-${newUniqueId}">Question Label</label>
                                             <input type="text" class="form-control question_labl" id="text_qu_label-${newUniqueId}" name="text_qu_label-${newUniqueId}">
                                        </div>
                                        <hr>
                                   </div>
                                   <div class="col-md-12">
                                        <div class="form-group">
                                             <label class="form-label" for="text_placeholder-${newUniqueId}">Text Box Placeholder</label>
                                             <input type="text" class="form-control text_box_placeholder" id="text_placeholder-${newUniqueId}" name="text_placeholder-${newUniqueId}">
                                        </div>
                                   </div>
                                   <hr>
                                   <div class="col-md-12">
                                        <div class="form-group">
                                             <label class="form-label" for="text_go_to_step-${newUniqueId}">Go to step</label>
                                             <div class="form-control-wrap"> 
                                                  <select class="form-select js-select2 new_label_question_id" data-search="on" name="text_go_to_step-${newUniqueId}" id="text_go_to_step-${newUniqueId}">
                                                       <option value=""></option>
                                                       @if(isset($questions) && $questions != null)
                                                            @foreach($questions as $question)
                                                                 <option value="{{ $question->getName() ?? '' }}">{{ $question->getName() ?? '' }}</option>
                                                            @endforeach
                                                       @endif
                                                  </select>
                                             </div>
                                        </div>
                                   </div>
                                   <hr>
                                   <div class="col-md-12">
                                        <div class="form-group">
                                             <label class="form-label" for="">Conditional Go to step Settings</label>
                                        </div>
                                   </div>
                                   <div class="custom-control custom-checkbox checked">
                                        <input type="checkbox" class="custom-control-input enable_conditional" id="condition_go_to${newUniqueId}" name="condition_go_to${newUniqueId}">
                                        <label class="custom-control-label" for="condition_go_to${newUniqueId}">Enable Conditional Go To Step Settings</label>
                                   </div>
                                   <hr>
                                   <div class="cond_div${newUniqueId}" style="display:none;">
                                        <div class="col-md-12">
                                             <div class="form-group">
                                                  <label class="form-label" for="">Add Conditions</label>
                                             </div>
                                        </div>
                                        <div class="append_page_condition" id="append_page_condition${newUniqueId}"></div>
                                        <div class="text-end">
                                             <div class="form-group">
                                                  <button type="button" class="btn btn-sm btn-primary" onclick="addCondition('${newUniqueId}')">Add Condition</button>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                         </div>
                         <br>
                    </div>
                    </div>`;
          }else if(name === 'dropdown'){
               dropdown_count++ ;
               html = `<div class="new_que_sec${newUniqueId}">
                    <div class="append_dropdown" id="append_dropdown${newUniqueId}" value="appended" data-is_new=true>
                         <div class="card card-bordered card-preview">
                              <div class="card-inner">
                                   <div class="row add_step">
                                        <div class="col-md-6">
                                             <!-- <h6>Dropdown</h6> -->
                                             <div class="form-group">
                                                  <select class="form-select js-select2 type_question" name="question_type${newUniqueId}" id="question_type${newUniqueId}">
                                                       ${types.map(type => `
                                                       <option value="${type.slug}" ${name === type.slug ? 'selected' : ''}>${type.name}</option>
                                                       `).join('')}
                                                  </select>
                                             </div> 
                                        </div> 
                                        <div class="col-md-6">
                                             <div class="form-group">
                                                  <span class="col-md-2 offset-md-10">
                                                       <span onclick="removeFields(this)" value="appended" data-field="dropdown"><i class="fa-solid fa-minus"></i></span>
                                                  </span>  
                                             </div>
                                        </div>
                                   </div>
                                   <hr>
                                   <div class="col-md-12">
                                        <div class="form-group">
                                             <label class="form-label" for="">Conditional questions label</label>
                                        </div>
                                   </div>
                                   <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input add_conditional_label" id="condition_qu_label${newUniqueId}" name="condition_qu_label${newUniqueId}">
                                        <label class="custom-control-label" for="condition_qu_label${newUniqueId}">Conditional questions label</label>
                                   </div>
                                   <hr>
                                   <div class="cond_ques_div${newUniqueId}" style="display:none;">
                                        <div class="col-md-12">
                                             <div class="form-group">
                                                  <label class="form-label" for="">Add conditional questions label</label>
                                             </div>
                                        </div>
                                        <div class="append_label_condition" id="append_label_condition${newUniqueId}"></div>
                                        <div class="text-end">
                                             <div class="form-group">
                                                  <button type="button" class="btn btn-sm btn-primary" onclick="addLabel('${newUniqueId}')">Add Label</button>
                                             </div>
                                        </div>
                                        <hr>
                                   </div>
                                   <div class="col-md-12 hide_question_label" id="hide_question_label${newUniqueId}">
                                        <div class="form-group">
                                             <label class="form-label" for="text_qu_label-${newUniqueId}">Question Label</label>
                                             <input type="text" class="form-control question_labl" id="text_qu_label-${newUniqueId}" name="text_qu_label-${newUniqueId}">
                                        </div>
                                        <hr>
                                   </div>
                                   <div class="col-md-12">
                                        <div class="form-group">
                                             <label class="form-label" for="">Add Dropdown Option</label>
                                        </div>
                                   </div>
                                   <div class="append_options" id="append_options${newUniqueId}"></div>
                                   <div class="text-end">
                                        <div class="form-group">
                                             <button type="button" class="btn btn-sm btn-primary" onclick="addOptions('${name}','${newUniqueId}')">Add Option</button>
                                        </div>
                                   </div>
                                   <div class="col-md-12">
                                        <div class="form-group">
                                             <label class="form-label" for="">Conditional Go to step Settings</label>
                                        </div>
                                   </div>
                                   <div class="custom-control custom-checkbox checked">
                                        <input type="checkbox" class="custom-control-input enable_conditional" id="condition_go_to${newUniqueId}" name="condition_go_to${newUniqueId}">
                                        <label class="custom-control-label" for="condition_go_to${newUniqueId}">Enable Conditional Go To Step Settings</label>
                                   </div>
                                   <hr>
                                   <div class="cond_div${newUniqueId}" style="display:none;">
                                        <div class="col-md-12">
                                             <div class="form-group">
                                                  <label class="form-label" for="">Add Conditions</label>
                                             </div>
                                        </div>
                                        <div class="append_page_condition" id="append_page_condition${newUniqueId}"></div>
                                        <div class="text-end">
                                             <div class="form-group">
                                                  <button type="button" class="btn btn-sm btn-primary" onclick="addCondition('${newUniqueId}')">Add Condition</button>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                         </div>
                         <br>
                    </div>
                    </div>`;
          }else if(name === 'radio-button'){
               radio_count++ ;
               html = `<div class="new_que_sec${newUniqueId}">
                    <div class="append_radio" id="append_radio${newUniqueId}" value="appended" data-is_new=true>
                         <div class="card card-bordered card-preview">
                              <div class="card-inner">
                                   <div class="row add_step">
                                        <div class="col-md-6">
                                             <!-- <h6>Radio Button</h6> -->
                                             <div class="form-group">
                                                  <select class="form-select js-select2 type_question" name="question_type${newUniqueId}" id="question_type${newUniqueId}">
                                                       ${types.map(type => `
                                                       <option value="${type.slug}" ${name === type.slug ? 'selected' : ''}>${type.name}</option>
                                                       `).join('')}
                                                  </select>
                                             </div>
                                        </div> 
                                        <div class="col-md-6">
                                             <div class="form-group">
                                                  <span class="col-md-2 offset-md-10">
                                                       <span onclick="removeFields(this)" value="appended" data-field="radio-button"><i class="fa-solid fa-minus"></i></span>
                                                  </span>  
                                             </div>
                                        </div>
                                   </div>
                                   <hr>
                                   <div class="col-md-12">
                                        <div class="form-group">
                                             <label class="form-label" for="">Conditional questions label</label>
                                        </div>
                                   </div>
                                   <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input add_conditional_label" id="condition_qu_label${newUniqueId}" name="condition_qu_label${newUniqueId}">
                                        <label class="custom-control-label" for="condition_qu_label${newUniqueId}">Conditional questions label</label>
                                   </div>
                                   <hr>
                                   <div class="col-md-12">
                                        <div class="form-group">
                                             <label class="form-label" for="text_qu_label${newUniqueId}">Question Label</label>
                                             <input type="text" class="form-control radio_ques" id="text_qu_label${newUniqueId}" name="text_qu_label${newUniqueId}">
                                        </div>
                                   </div>
                                   <hr>
                                   <div class="cond_ques_div${newUniqueId}" style="display:none;">
                                        <div class="col-md-12">
                                             <div class="form-group">
                                                  <label class="form-label" for="">Add conditional questions label</label>
                                             </div>
                                        </div>
                                        <div class="append_label_condition" id="append_label_condition${newUniqueId}"></div>
                                        <div class="text-end">
                                             <div class="form-group">
                                                  <button type="button" class="btn btn-sm btn-primary" onclick="addLabel('${newUniqueId}')">Add Label</button>
                                             </div>
                                        </div>
                                        <hr>
                                   </div>
                                   <div class="col-md-12">
                                        <div class="form-group">
                                             <label class="form-label" for="">Add Radio Option</label>
                                        </div>
                                   </div>
                                   <div class="append_options" id="append_options${newUniqueId}"></div>
                                   <div class="text-end">
                                        <div class="form-group">
                                             <button type="button" class="btn btn-sm btn-primary" onclick="addOptions('${name}','${newUniqueId}')">Add Option</button>
                                        </div>
                                   </div>
                                   <div class="col-md-12">
                                        <div class="form-group">
                                             <label class="form-label" for="">Conditional Go to step Settings</label>
                                        </div>
                                   </div>
                                   <div class="custom-control custom-checkbox checked">
                                        <input type="checkbox" class="custom-control-input enable_conditional" id="condition_go_to${newUniqueId}" name="condition_go_to${newUniqueId}">
                                        <label class="custom-control-label" for="condition_go_to${newUniqueId}">Enable Conditional Go To Step Settings</label>
                                   </div>
                                   <hr>
                                   <div class="cond_div${newUniqueId}" style="display:none;">
                                        <div class="col-md-12">
                                             <div class="form-group">
                                                  <label class="form-label" for="">Add Conditions</label>
                                             </div>
                                        </div>
                                        <div class="append_page_condition" id="append_page_condition${newUniqueId}"></div>
                                        <div class="text-end">
                                             <div class="form-group">
                                                  <button type="button" class="btn btn-sm btn-primary" onclick="addCondition('${newUniqueId}')">Add Condition</button>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                         </div>
                         <br>
                    </div>
                    </div>`;
          }else if(name === 'date-field'){
               datefield_count++ ;
               html = `<div class="new_que_sec${newUniqueId}">
                    <div class="append_dateField" id="append_dateField${newUniqueId}" value="appended" data-is_new=true>
                         <div class="card card-bordered card-preview">
                              <div class="card-inner">
                                   <div class="row add_step">
                                        <div class="col-md-6">
                                             <!-- <h6>Date Field</h6> -->
                                             <div class="form-group">
                                                  <select class="form-select js-select2 type_question" name="question_type${newUniqueId}" id="question_type${newUniqueId}">
                                                       ${types.map(type => `
                                                       <option value="${type.slug}" ${name === type.slug ? 'selected' : ''}>${type.name}</option>
                                                       `).join('')}
                                                  </select>
                                             </div>
                                        </div> 
                                        <div class="col-md-6">
                                             <div class="form-group">
                                                  <span class="col-md-2 offset-md-10">
                                                       <span onclick="removeFields(this)" value="appended" data-field="date-field"><i class="fa-solid fa-minus"></i></span>
                                                  </span>  
                                             </div>
                                        </div>
                                   </div>
                                   <hr>
                                   <div class="col-md-12">
                                        <div class="form-group">
                                             <label class="form-label" for="">Conditional questions label</label>
                                        </div>
                                   </div>
                                   <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input add_conditional_label" id="condition_qu_label${newUniqueId}" name="condition_qu_label${newUniqueId}">
                                        <label class="custom-control-label" for="condition_qu_label${newUniqueId}">Conditional questions label</label>
                                   </div>
                                   <hr>
                                   <div class="col-md-12">
                                        <div class="form-group">
                                             <label class="form-label" for="text_qu_label-${newUniqueId}">Question Label</label>
                                             <input type="text" class="form-control date_ques" id="text_qu_label-${newUniqueId}" name="text_qu_label-${newUniqueId}" value="">
                                        </div>
                                   </div>
                                   <hr>
                                   <div class="cond_ques_div${newUniqueId}" style="display:none;">
                                        <div class="col-md-12">
                                             <div class="form-group">
                                                  <label class="form-label" for="">Add conditional questions label</label>
                                             </div>
                                        </div>
                                        <div class="append_label_condition" id="append_label_condition${newUniqueId}"></div>
                                        <div class="text-end">
                                             <div class="form-group">
                                                  <button type="button" class="btn btn-sm btn-primary" onclick="addLabel('${newUniqueId}')">Add Label</button>
                                             </div>
                                        </div>
                                        <hr>
                                   </div>
                                   <div class="col-md-12">
                                        <div class="form-group">
                                             <label class="form-label" for="date_go_to_step-${newUniqueId}">Go to step</label>
                                             <div class="form-control-wrap"> 
                                                  <select class="form-select js-select2 new_label_question_id" data-search="on" name="date_go_to_step-${newUniqueId}" id="date_go_to_step-${newUniqueId}">
                                                       <option value=""></option>
                                                       @if(isset($questions) && $questions != null)
                                                            @foreach($questions as $question)
                                                                 <option value="{{ $question->getName() ?? '' }}">{{ $question->getName() ?? '' }}</option>
                                                            @endforeach
                                                       @endif
                                                  </select>
                                             </div>
                                        </div>
                                   </div>
                                   <hr>
                                   <div class="col-md-12">
                                        <div class="form-group">
                                             <label class="form-label" for="">Conditional Go to step Settings</label>
                                        </div>
                                   </div>
                                   <div class="custom-control custom-checkbox checked">
                                        <input type="checkbox" class="custom-control-input enable_conditional" id="condition_go_to${newUniqueId}" name="condition_go_to${newUniqueId}">
                                        <label class="custom-control-label" for="condition_go_to${newUniqueId}">Enable Conditional Go To Step Settings</label>
                                   </div>
                                   <hr>
                                   <div class="cond_div${newUniqueId}" style="display:none;">
                                        <div class="col-md-12">
                                             <div class="form-group">
                                                  <label class="form-label" for="">Add Conditions</label>
                                             </div>
                                        </div>
                                        <div class="append_page_condition" id="append_page_condition${newUniqueId}"></div>
                                        <div class="text-end">
                                             <div class="form-group">
                                                  <button type="button" class="btn btn-sm btn-primary" onclick="addCondition('${newUniqueId}')">Add Condition</button>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                         </div>
                         <br>
                    </div>
                    </div>`;
          }else if(name === 'pricebox'){
               pricebox_count++ ;
               html = `<div class="new_que_sec${newUniqueId}">
                    <div class="append_priceBox" id="append_priceBox${newUniqueId}" value="appended" data-is_new=true>
                         <div class="card card-bordered card-preview">
                              <div class="card-inner">
                                   <div class="row add_step">
                                        <div class="col-md-6">
                                             <!-- <h6>Pricebox</h6> -->
                                             <div class="form-group">
                                                  <select class="form-select js-select2 type_question" name="question_type${newUniqueId}" id="question_type${newUniqueId}">
                                                       ${types.map(type => `
                                                       <option value="${type.slug}" ${name === type.slug ? 'selected' : ''}>${type.name}</option>
                                                       `).join('')}
                                                  </select>
                                             </div>  
                                        </div> 
                                        <div class="col-md-6">
                                             <div class="form-group">
                                                  <span class="col-md-2 offset-md-10">
                                                       <span onclick="removeFields(this)" value="appended" data-field="pricebox"><i class="fa-solid fa-minus"></i></span>
                                                  </span>  
                                             </div>
                                        </div>
                                   </div>
                                   <hr>
                                   <div class="col-md-12">
                                        <div class="form-group">
                                             <label class="form-label" for="">Conditional questions label</label>
                                        </div>
                                   </div>
                                   <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input add_conditional_label" id="condition_qu_label${newUniqueId}" name="condition_qu_label${newUniqueId}">
                                        <label class="custom-control-label" for="condition_qu_label${newUniqueId}">Conditional questions label</label>
                                   </div>
                                   <hr>
                                   <div class="cond_ques_div${newUniqueId}" style="display:none;">
                                        <div class="col-md-12">
                                             <div class="form-group">
                                                  <label class="form-label" for="">Add conditional questions label</label>
                                             </div>
                                        </div>
                                        <div class="append_label_condition" id="append_label_condition${newUniqueId}"></div>
                                        <div class="text-end">
                                             <div class="form-group">
                                                  <button type="button" class="btn btn-sm btn-primary" onclick="addLabel('${newUniqueId}')">Add Label</button>
                                             </div>
                                        </div>
                                        <hr>
                                   </div>
                                   <div class="col-md-12 hide_question_label" id="hide_question_label${newUniqueId}">
                                        <div class="form-group">
                                             <label class="form-label" for="text_qu_label-${newUniqueId}">Question Label</label>
                                             <input type="text" class="form-control question_labl" id="text_qu_label-${newUniqueId}" name="text_qu_label-${newUniqueId}" value="">
                                        </div>
                                        <hr>
                                   </div>
                                   <div class="col-md-12">
                                        <div class="form-group">
                                             <label class="form-label" for="text_placeholder-${newUniqueId}">Text Box Placeholder</label>
                                             <input type="text" class="form-control text_box_placeholder" id="text_placeholder-${newUniqueId}" name="text_placeholder-${newUniqueId}" value="">
                                        </div>
                                   </div>
                                   <hr>
                                   <div class="col-md-12">
                                        <div class="form-group">
                                             <label class="form-label" for="text_go_to_step-${newUniqueId}">Go to step</label>
                                             <div class="form-control-wrap"> 
                                                  <select class="form-select js-select2 new_label_question_id" data-search="on" name="text_go_to_step-${newUniqueId}" id="text_go_to_step-${newUniqueId}">
                                                       <option value=""></option>
                                                       @if(isset($questions) && $questions != null)
                                                            @foreach($questions as $question)
                                                                 <option value="{{ $question->getName() ?? '' }}">{{ $question->getName() ?? '' }}</option>
                                                            @endforeach
                                                       @endif
                                                  </select>
                                             </div>
                                        </div>
                                   </div>
                                   <hr>
                                   <div class="col-md-12">
                                        <div class="form-group">
                                             <label class="form-label" for="">Conditional Go to step Settings</label>
                                        </div>
                                   </div>
                                   <div class="custom-control custom-checkbox checked">
                                        <input type="checkbox" class="custom-control-input enable_conditional" id="condition_go_to${newUniqueId}" name="condition_go_to${newUniqueId}">
                                        <label class="custom-control-label" for="condition_go_to${newUniqueId}">Enable Conditional Go To Step Settings</label>
                                   </div>
                                   <hr>
                                   <div class="cond_div${newUniqueId}" style="display:none;">
                                        <div class="col-md-12">
                                             <div class="form-group">
                                                  <label class="form-label" for="">Add Conditions</label>
                                             </div>
                                        </div>
                                        <div class="append_page_condition" id="append_page_condition${newUniqueId}"></div>
                                        <div class="text-end">
                                             <div class="form-group">
                                                  <button type="button" class="btn btn-sm btn-primary" onclick="addCondition('${newUniqueId}')">Add Condition</button>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                         </div>
                         <br>
                    </div>
                    </div>`;
          }else if(name === 'number-field'){
               numberfield_count++ ; 
               html = `<div class="new_que_sec${newUniqueId}">
                    <div class="append_numberField" id="append_numberField${newUniqueId}" value="appended" data-is_new=true>
                         <div class="card card-bordered card-preview">
                              <div class="card-inner">
                                   <div class="row add_step">
                                        <div class="col-md-6">
                                             <!-- <h6>Number field</h6> -->
                                             <div class="form-group">
                                                  <select class="form-select js-select2 type_question" name="question_type${newUniqueId}" id="question_type${newUniqueId}">
                                                       ${types.map(type => `
                                                       <option value="${type.slug}" ${name === type.slug ? 'selected' : ''}>${type.name}</option>
                                                       `).join('')}
                                                  </select>
                                             </div>
                                        </div> 
                                        <div class="col-md-6">
                                             <div class="form-group">
                                                  <span class="col-md-2 offset-md-10">
                                                       <span onclick="removeFields(this)" value="appended" data-field="number-field"><i class="fa-solid fa-minus"></i></span>
                                                  </span>  
                                             </div>
                                        </div>
                                   </div>
                                   <hr>
                                   <div class="col-md-12">
                                        <div class="form-group">
                                             <label class="form-label" for="">Conditional questions label</label>
                                        </div>
                                   </div>
                                   <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input add_conditional_label" id="condition_qu_label${newUniqueId}" name="condition_qu_label${newUniqueId}">
                                        <label class="custom-control-label" for="condition_qu_label${newUniqueId}">Conditional questions label</label>
                                   </div>
                                   <hr>
                                   <div class="cond_ques_div${newUniqueId}" style="display:none;">
                                        <div class="col-md-12">
                                             <div class="form-group">
                                                  <label class="form-label" for="">Add conditional questions label</label>
                                             </div>
                                        </div>
                                        <div class="append_label_condition" id="append_label_condition${newUniqueId}"></div>
                                        <div class="text-end">
                                             <div class="form-group">
                                                  <button type="button" class="btn btn-sm btn-primary" onclick="addLabel('${newUniqueId}')">Add Label</button>
                                             </div>
                                        </div>
                                        <hr>
                                   </div>
                                   <div class="col-md-12 hide_question_label" id="hide_question_label${newUniqueId}">
                                        <div class="form-group">
                                             <label class="form-label" for="text_qu_label-${newUniqueId}">Question Label</label>
                                             <input type="text" class="form-control question_labl" id="text_qu_label-${newUniqueId}" name="text_qu_label-${newUniqueId}" value="">
                                        </div>
                                        <hr>
                                   </div>
                                   <div class="col-md-12">
                                        <div class="form-group">
                                             <label class="form-label" for="text_placeholder-${newUniqueId}">Number field Placeholder</label>
                                             <input type="text" class="form-control number_placeholder" id="text_placeholder-${newUniqueId}" name="text_placeholder-${newUniqueId}" value="">
                                        </div>
                                   </div>
                                   <hr>
                                   <div class="col-md-12">
                                        <div class="form-group">
                                             <label class="form-label" for="text_go_to_step-${newUniqueId}">Go to step</label>
                                             <div class="form-control-wrap"> 
                                                  <select class="form-select js-select2 new_label_question_id" data-search="on" name="text_go_to_step-${newUniqueId}" id="text_go_to_step-${newUniqueId}">
                                                       <option value=""></option>
                                                       @if(isset($questions) && $questions != null)
                                                            @foreach($questions as $question)
                                                                 <option value="{{ $question->getName() ?? '' }}">{{ $question->getName() ?? '' }}</option>
                                                            @endforeach
                                                       @endif
                                                  </select>
                                             </div>
                                        </div>
                                   </div>
                                   <hr>
                                   <div class="col-md-12">
                                        <div class="form-group">
                                             <label class="form-label" for="">Conditional Go to step Settings</label>
                                        </div>
                                   </div>
                                   <div class="custom-control custom-checkbox checked">
                                        <input type="checkbox" class="custom-control-input enable_conditional" id="condition_go_to${newUniqueId}" name="condition_go_to-${newUniqueId}">
                                        <label class="custom-control-label" for="condition_go_to${newUniqueId}">Enable Conditional Go To Step Settings</label>
                                   </div>
                                   <hr>
                                   <div class="cond_div${newUniqueId}" style="display:none;">
                                        <div class="col-md-12">
                                             <div class="form-group">
                                                  <label class="form-label" for="">Add Conditions</label>
                                             </div>
                                        </div>
                                        <div class="append_page_condition" id="append_page_condition${newUniqueId}"></div>
                                        <div class="text-end">
                                             <div class="form-group">
                                                  <button type="button" class="btn btn-sm btn-primary" onclick="addCondition('${newUniqueId}')">Add Condition</button>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                         </div>
                         <br>
                    </div>
                    </div>`;
          }else if(name === 'percentage-box'){
               percentage_count++ ;
               html = `<div class="new_que_sec${newUniqueId}">
                    <div class="appendPercentageBox" id="appendPercentageBox${newUniqueId}" value="appended" data-is_new=true>
                         <div class="card card-bordered card-preview">
                              <div class="card-inner">
                                   <div class="row add_step">
                                        <div class="col-md-6">
                                             <!-- <h6>Percentage Box</h6> -->
                                             <div class="form-group">
                                                  <select class="form-select js-select2 type_question" name="question_type${newUniqueId}" id="question_type${newUniqueId}">
                                                       ${types.map(type => `
                                                       <option value="${type.slug}" ${name === type.slug ? 'selected' : ''}>${type.name}</option>
                                                       `).join('')}
                                                  </select>
                                             </div> 
                                        </div> 
                                        <div class="col-md-6">
                                             <div class="form-group">
                                                  <span class="col-md-2 offset-md-10">
                                                       <span onclick="removeFields(this)" value="appended" data-field="percentBox"><i class="fa-solid fa-minus"></i></span>
                                                  </span>  
                                             </div>
                                        </div>
                                   </div>
                                   <hr>
                                   <div class="col-md-12">
                                        <div class="form-group">
                                             <label class="form-label" for="">Conditional questions label</label>
                                        </div>
                                   </div>
                                   <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input add_conditional_label" id="condition_qu_label${newUniqueId}" name="condition_qu_label${newUniqueId}">
                                        <label class="custom-control-label" for="condition_qu_label${newUniqueId}">Conditional questions label</label>
                                   </div>
                                   <hr>
                                   <div class="cond_ques_div${newUniqueId}" style="display:none;">
                                        <div class="col-md-12">
                                             <div class="form-group">
                                                  <label class="form-label" for="">Add conditional questions label</label>
                                             </div>
                                        </div>
                                        <div class="append_label_condition" id="append_label_condition${newUniqueId}"></div>
                                        <div class="text-end">
                                             <div class="form-group">
                                                  <button type="button" class="btn btn-sm btn-primary" onclick="addLabel('${newUniqueId}')">Add Label</button>
                                             </div>
                                        </div>
                                        <hr>
                                   </div>
                                   <div class="col-md-12 hide_question_label" id="hide_question_label${newUniqueId}">
                                        <div class="form-group">
                                             <label class="form-label" for="text_qu_label-${newUniqueId}">Question Label</label>
                                             <input type="text" class="form-control question_labl" id="text_qu_label-${newUniqueId}" name="text_qu_label-${newUniqueId}" value="">
                                        </div>
                                        <hr>
                                   </div>
                                   <div class="col-md-12">
                                        <div class="form-group">
                                             <label class="form-label" for="text_placeholder-${newUniqueId}">Text Box Placeholder</label>
                                             <input type="text" class="form-control text_box_placeholder" id="text_placeholder-${newUniqueId}" name="text_placeholder-${newUniqueId}" value="">
                                        </div>
                                   </div>
                                   <hr>
                                   <div class="col-md-12">
                                        <div class="form-group">
                                             <label class="form-label" for="text_go_to_step-${newUniqueId}">Go to step</label>
                                             <div class="form-control-wrap"> 
                                                  <select class="form-select js-select2 new_label_question_id" data-search="on" name="text_go_to_step-${newUniqueId}" id="text_go_to_step-${newUniqueId}">
                                                       <option value=""></option>
                                                       @if(isset($questions) && $questions != null)
                                                            @foreach($questions as $question)
                                                                 <option value="{{ $question->getName() ?? '' }}">{{ $question->getName() ?? '' }}</option>
                                                            @endforeach
                                                       @endif
                                                  </select>
                                             </div>
                                        </div>
                                   </div>
                                   <hr>
                                   <div class="col-md-12">
                                        <div class="form-group">
                                             <label class="form-label" for="">Conditional Go to step Settings</label>
                                        </div>
                                   </div>
                                   <div class="custom-control custom-checkbox checked">
                                        <input type="checkbox" class="custom-control-input enable_conditional" id="condition_go_to${newUniqueId}" name="condition_go_to${newUniqueId}">
                                        <label class="custom-control-label" for="condition_go_to${newUniqueId}">Enable Conditional Go To Step Settings</label>
                                   </div>
                                   <hr>
                                   <div class="cond_div${newUniqueId}" style="display:none;">
                                        <div class="col-md-12">
                                             <div class="form-group">
                                                  <label class="form-label" for="">Add Conditions</label>
                                             </div>
                                        </div>
                                        <div class="append_page_condition" id="append_page_condition${newUniqueId}"></div>
                                        <div class="text-end">
                                             <div class="form-group">
                                                  <button type="button" class="btn btn-sm btn-primary" onclick="addCondition('${newUniqueId}')">Add Condition</button>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                         </div>
                         <br>
                    </div>
                    </div>`;
          }else if(name === 'dropdown-link'){
               droplink_count++ ;
               html = `<div class="new_que_sec${newUniqueId}">
                    <div class="append_dropdownLink" id="append_dropdownLink${newUniqueId}" value="appended" data-is_new=true>
                    <div class="card card-bordered card-preview">
                         <div class="card-inner">
                              <div class="row add_step">
                                   <div class="col-md-6">
                                        <!-- <h6>Dropdown link</h6> -->
                                        <div class="form-group">
                                             <select class="form-select js-select2 type_question" name="question_type${newUniqueId}" id="question_type${newUniqueId}">
                                                  ${types.map(type => `
                                                  <option value="${type.slug}" ${name === type.slug ? 'selected' : ''}>${type.name}</option>
                                                  `).join('')}
                                             </select>
                                        </div>
                                   </div> 
                                   <div class="col-md-6">
                                        <div class="form-group">
                                             <span class="col-md-2 offset-md-10">
                                                  <span onclick="removeFields(this)" value="appended" data-field="dropdown-link"><i class="fa-solid fa-minus"></i></span>
                                             </span>  
                                        </div>
                                   </div>
                              </div>
                              <hr>
                              <div class="col-md-12">
                                   <div class="form-group">
                                        <label class="form-label" for="text_qu_label-${newUniqueId}">Question Label</label>
                                        <input type="text" class="form-control dropdown_ques" id="text_qu_label-${newUniqueId}" name="text_qu_label-${newUniqueId}" value="">
                                   </div>
                              </div>
                              <hr>
                              <div class="col-md-12">
                                   <div class="form-group">
                                        <label class="form-label" for="same_contract_link-${newUniqueId}">Same Contract Link Label</label>
                                        <input type="text" class="form-control same_contract" id="same_contract_link-${newUniqueId}" name="same_contract_link-${newUniqueId}" value="">
                                   </div>
                              </div>
                              <hr>
                              <div class="col-md-12">
                                   <div class="form-group">
                                        <label class="form-label" for="">Different Contract Link</label>
                                   </div>
                              </div>
                              <br>
                              <div class="add_cont_rw" id="add_cont_rw${newUniqueId}"></div>
                              <div class="text-end">
                                   <div class="form-group">
                                        <button type="button" class="btn btn-sm btn-primary" onclick="addContractRow('${newUniqueId}')">Add Row</button>
                                   </div>
                              </div>
                              <hr>
                              <div class="col-md-12">
                                   <div class="form-group">
                                        <label class="form-label" for="text_go_to_step-${newUniqueId}">Go to step</label>
                                        <div class="form-control-wrap"> 
                                             <select class="form-select js-select2 new_label_question_id" data-search="on" name="text_go_to_step-${newUniqueId}" id="text_go_to_step-${newUniqueId}">
                                                  <option value=""></option>
                                                  @if(isset($questions) && $questions != null)
                                                       @foreach($questions as $question)
                                                            <option value="{{ $question->getName() ?? '' }}">{{ $question->getName() ?? '' }}</option>
                                                       @endforeach
                                                  @endif
                                             </select>
                                        </div>
                                   </div>
                              </div>
                         </div>
                    </div>
                    <br>
               </div>
               </div>`;
          }

          if(key === 'first'){
               $('.add_qu_sec').append(html);
               $('.question_dropbtn').hide();
          }else if(key === 'second'){
               $('.new_que_sec'+id).html(html);
               $('.question_dropbtn').hide();
          }
          // else if(key === 'third'){
          //      $('.new_que_sec'+id).html(html);
          // }
          
          $('.js-select2').select2();

          // conditionalQuestions(newUniqueId);

          // $('#condition_qu_label'+newUniqueId).change(function(){
          //      conditionalQuestions(newUniqueId);
          // });

          // conditionalPageSetting(newUniqueId);

          // $('#condition_go_to'+newUniqueId).change(function(){
          //      conditionalPageSetting(newUniqueId);
          // })

          
     }

     $(document).ready(function() {
          $(document).on('change', '[id^="condition_qu_label"]', function() {
               const id = $(this).attr('id').replace('condition_qu_label', '');
               conditionalOptions(id);
          });

          $(document).on('change', '[id^="condition_go_to"]', function() {
               const id = $(this).attr('id').replace('condition_go_to', '');
               goToSteps(id);
          });

          $(document).on('change', '.type_question', function() {
               const value = $(this).val();
               const id = $(this).attr('id').replace('question_type', '');
               console.log(id);
               addQuestionfields(value, id, 'second');
          });

          // $(document).on('change','.new_question',function(){
          //      const value = $(this).val();
          //      const id = $(this).attr('id').replace('question_type', '');
          //      // console.log(id);
          //      addQuestionfields(value, id, 'third');
          // })


     });

     function conditionalOptions(id) {
          if($('#condition_qu_label' + id).is(':checked')) {
               $('.cond_ques_div' + id).show();
               $('#condition_qu_label' + id).val(1);
               $('#hide_question_label'+id).hide();
          } else {
               $('.cond_ques_div' + id).hide();
               $('#condition_qu_label' + id).val(0);
               $('#hide_question_label'+id).show();
          }
     }

     function goToSteps(id) {
          if($('#condition_go_to' + id).is(':checked')) {
               $('.cond_div' + id).show();
               $('#condition_go_to' + id).val(1);
          } else {
               $('.cond_div' + id).hide();
               $('#condition_go_to' + id).val(0);
          }
     }

     function removeFields(e){
          $('.question_dropbtn').show();
          if($(e).attr('data-field') === 'textbox'){
               if($(e).attr('value') === 'appended'){
                    $(e).closest('.append_textbox').remove();
               }else{
                    var id = $(e).data('id');
                    let deleteIds = $('#remove_question_id').val();
                    if(deleteIds){
                         deleteIds += ',' + id;
                    }else{
                         deleteIds = id;
                    }
                    $('#remove_question_id').val(deleteIds);
                    $('#append_textbox'+id).hide();
               }    
          }else if($(e).attr('data-field') === 'textarea'){
               if($(e).attr('value') === 'appended'){
                    $(e).closest('.append_textarea').remove();
               }else{
                    var id = $(e).data('id');
                    // let deleteIds = $('#removeTextarea_id').val();
                    let deleteIds = $('#remove_question_id').val();
                    if(deleteIds){
                         deleteIds += ',' + id;
                    }else{
                         deleteIds = id;
                    }
                    // $('#removeTextbox_id').val(deleteIds);
                    $('#remove_question_id').val(deleteIds);
                    $('#append_textarea'+id).hide();
               }   
          }else if($(e).attr('data-field') === 'dropdown'){
               if($(e).attr('value') === 'appended'){
                    $(e).closest('.append_dropdown').remove();
               }else{
                    var id = $(e).data('id');
                    // let deleteIds = $('#removeDropdown_id').val();
                    let deleteIds = $('#remove_question_id').val();
                    if(deleteIds){
                         deleteIds += ',' + id;
                    }else{
                         deleteIds = id;
                    }
                    // $('#removeDropdown_id').val(deleteIds);
                    $('#remove_question_id').val(deleteIds);
                    $('#append_dropdown'+id).hide();
               }   

          }else if($(e).attr('data-field') === 'radio-button'){
               if($(e).attr('value') === 'appended'){
                    $(e).closest('.append_radio').remove();
               }else{
                    var id = $(e).data('id');
                    // let deleteIds = $('#removeRadio_id').val();
                    let deleteIds = $('#remove_question_id').val();
                    if(deleteIds){
                         deleteIds += ',' + id;
                    }else{
                         deleteIds = id;
                    }
                    // $('#removeRadio_id').val(deleteIds);
                    $('#remove_question_id').val(deleteIds);
                    $('#append_radio'+id).hide();
               }   
          }else if($(e).attr('data-field') === 'date-field'){
               if($(e).attr('value') === 'appended'){
                    $(e).closest('.append_dateField').remove();
               }else{
                    var id = $(e).data('id');
                    // let deleteIds = $('#removeDatefield_id').val();
                    let deleteIds = $('#remove_question_id').val();
                    if(deleteIds){
                         deleteIds += ',' + id;
                    }else{
                         deleteIds = id;
                    }
                    // $('#removeDatefield_id').val(deleteIds);
                    $('#remove_question_id').val(deleteIds);
                    $('#append_dateField'+id).hide();
               }   
          }else if($(e).attr('data-field') === 'pricebox'){
               if($(e).attr('value') === 'appended'){
                    $(e).closest('.append_priceBox').remove();
               }else{
                    var id = $(e).data('id');
                    // let deleteIds = $('#removePricebox_id').val();
                    let deleteIds = $('#remove_question_id').val();
                    if(deleteIds){
                         deleteIds += ',' + id;
                    }else{
                         deleteIds = id;
                    }
                    // $('#removePricebox_id').val(deleteIds);
                    $('#remove_question_id').val(deleteIds);
                    $('#append_priceBox'+id).hide();
               }   
          }else if($(e).attr('data-field') === 'number-field'){
               if($(e).attr('value') === 'appended'){
                    $(e).closest('.append_numberField').remove();
               }else{
                    var id = $(e).data('id');
                    // let deleteIds = $('#removeNumberfield_id').val();
                    let deleteIds = $('#remove_question_id').val();
                    if(deleteIds){
                         deleteIds += ',' + id;
                    }else{
                         deleteIds = id;
                    }
                    // $('#removeNumberfield_id').val(deleteIds);
                    $('#remove_question_id').val(deleteIds);
                    $('#append_numberField'+id).hide();
               }   
          }else if($(e).attr('data-field') === 'percentBox'){
               if($(e).attr('value') === 'appended'){
                    $(e).closest('.appendPercentageBox').hide();
               }else{
                    var id = $(e).data('id');
                    // let deleteIds = $('#removePercentagebox_id').val();
                    let deleteIds = $('#remove_question_id').val();
                    if(deleteIds){
                         deleteIds += ',' + id;
                    }else{
                         deleteIds = id;
                    }
                    // $('#removePercentagebox_id').val(deleteIds);
                    $('#remove_question_id').val(deleteIds);
                    $('#appendPercentageBox'+id).hide();
               }   
          }else if($(e).attr('data-field') === 'dropdown-link'){
               if($(e).attr('value') === 'appended'){
                    $(e).closest('.append_dropdownLink').hide();
               }else{
                    var id = $(e).data('id');
                    // let deleteIds = $('#removeDropdownlink_id').val();
                    let deleteIds = $('#remove_question_id').val();
                    if(deleteIds){
                         deleteIds += ',' + id;
                    }else{
                         deleteIds = id;
                    }
                    // $('#removeDropdownlink_id').val(deleteIds);
                    $('#remove_question_id').val(deleteIds);
                    $('#append_dropdownLink'+id).hide();
               }   
          }
     }
</script>

<script>

     function getAllSteps(){
          var questions = [];

          $('.add_qu_sec .append_textbox').each(function(){
               var is_new = $(this).data('is_new');
               var id = $(this).data('id');

               var conditionalQuestion = $(this).find('input[name^="condition_qu_labe"]').is(':checked') ? 1 : 0;
               var questionLabel = $(this).find('input[name^="text_qu_label"]').val() || ''; 
               // var textBoxId = $(this).find('input[name^="text_id"]').val() || '';
               var textBoxPlaceholder = $(this).find('input[name^="text_placeholder"]').val() || '';
               // var placeholderText = $(this).find('input[name^="placeholder_text"]').val() || '';
               var goToStep = $(this).find('select[name^="text_go_to_step"]').val() || '';
               var conditionalStep = $(this).find('input[name^="condition_go_to"]').is(':checked') ? 1 : 0;

               if(conditionalQuestion){
                    questionLabel = null;
               }

               var textboxData = {
                    type: 'textbox',
                    is_new: is_new,
                    id: id,
                    is_conditional_question: conditionalQuestion,
                    question_label: questionLabel,
                    // text_box_id: textBoxId,
                    text_box_placeholder: textBoxPlaceholder,
                    // placeholder_text: placeholderText,
                    go_to_step: goToStep,
                    is_conditional_step: conditionalStep,
                    conditional_question_labels: [],
                    new_conditional_question_labels: [],
                    conditions: [],
                    new_conditions: [],
               };

               if(conditionalQuestion){
                    $(this).find('.append_label_condition .label-condition').each(function() {
                         var status = $(this).data('is_new'); 
                         var conditionId = $(this).data('id');

                         if(status === true){
                              var question_label = {
                                   label: $(this).find('input[name^="condition_question_label"]').val() || '',
                                   questionID: $(this).find('select[name^="label_qu_id"]').val() || '',
                                   question_value: $(this).find('input[name^="condition_question_value"]').val() || '',
                                   status: status,
                              };

                              if(question_label.label && question_label.questionID && question_label.question_value){
                                   textboxData.new_conditional_question_labels.push(question_label);
                              }
                         }else if(status === false){
                              var question_label = {
                                   label: $(this).find('input[name^="condition_question_label"]').val() || '',
                                   questionID: $(this).find('select[name^="label_qu_id"]').val() || '',
                                   question_value: $(this).find('input[name^="condition_question_value"]').val() || '',
                                   status: status,
                                   condition_id: conditionId,
                              };

                              if(question_label.label && question_label.questionID && question_label.question_value){
                                   textboxData.conditional_question_labels.push(question_label);
                              }
                         }
                    });
               }

               if(conditionalStep){
                    $(this).find('.append_page_condition .sec-condition').each(function() {
                         var status = $(this).data('is_new'); 
                         var conditionId = $(this).data('id');

                         if(status === true){
                              var condition = {
                                   questionID: $(this).find('select[name^="page_Setting_qu_id"]').val() || '',
                                   question_condition: $(this).find('select[name^="page_Setting_conditions"]').val() || '',
                                   question_value: $(this).find('input[name^="page_Setting_qu_val"]').val() || '',
                                   status: status,
                              };

                              if(condition.questionID && condition.question_condition && condition.question_value){
                                   textboxData.new_conditions.push(condition);
                              }
                         }else if(status === false){
                              var condition = {
                                   questionID: $(this).find('select[name^="page_Setting_qu_id"]').val() || '',
                                   question_condition: $(this).find('select[name^="page_Setting_conditions"]').val() || '',
                                   question_value: $(this).find('input[name^="page_Setting_qu_val"]').val() || '',
                                   status: status,
                                   condition_id: conditionId, 
                              };

                              if(condition.questionID && condition.question_condition && condition.question_value){
                                   textboxData.conditions.push(condition);
                              }
                         }
                    });
               }

               questions.push(textboxData);
          });

          $('.add_qu_sec .append_textarea').each(function(){
               var is_new = $(this).data('is_new');
               var id = $(this).data('id');

               var conditionalQuestion = $(this).find('input[name^="condition_qu_labe"]').is(':checked') ? 1 : 0;
               var questionLabel = $(this).find('input[name^="text_qu_label"]').val() || ''; 
               // var textBoxId = $(this).find('input[name^="text_id"]').val() || '';
               var textBoxPlaceholder = $(this).find('input[name^="text_placeholder"]').val() || '';
               // var placeholderText = $(this).find('input[name^="placeholder_text"]').val() || '';
               var goToStep = $(this).find('select[name^="text_go_to_step"]').val() || '';
               var conditionalStep = $(this).find('input[name^="condition_go_to"]').is(':checked') ? 1 : 0;

               if(conditionalQuestion){
                    questionLabel = null;
               }

               var textareaData = {
                    type: 'textarea',
                    is_new: is_new,
                    id: id,
                    is_conditional_question: conditionalQuestion,
                    question_label: questionLabel,
                    // text_box_id: textBoxId,
                    text_box_placeholder: textBoxPlaceholder,
                    // placeholder_text: placeholderText,
                    go_to_step: goToStep,
                    is_conditional_step: conditionalStep,
                    conditional_question_labels: [],
                    new_conditional_question_labels: [],
                    conditions: [],
                    new_conditions: [],
               };

               if(conditionalQuestion){
                    $(this).find('.append_label_condition .label-condition').each(function() {
                         var status = $(this).data('is_new'); 
                         var conditionId = $(this).data('id');

                         if(status === true){
                              var question_label = {
                                   label: $(this).find('input[name^="condition_question_label"]').val() || '',
                                   questionID: $(this).find('select[name^="label_qu_id"]').val() || '',
                                   question_value: $(this).find('input[name^="condition_question_value"]').val() || '',
                                   status: status,
                              };

                              if(question_label.label && question_label.questionID && question_label.question_value){
                                   textareaData.new_conditional_question_labels.push(question_label);
                              }
                         }else if(status === false){
                              var question_label = {
                                   label: $(this).find('input[name^="condition_question_label"]').val() || '',
                                   questionID: $(this).find('select[name^="label_qu_id"]').val() || '',
                                   question_value: $(this).find('input[name^="condition_question_value"]').val() || '',
                                   status: status,
                                   condition_id: conditionId,
                              };

                              if(question_label.label && question_label.questionID && question_label.question_value){
                                   textareaData.conditional_question_labels.push(question_label);
                              }
                         }
                    });
               }

               if(conditionalStep){
                    $(this).find('.append_page_condition .sec-condition').each(function() {
                         var status = $(this).data('is_new'); 
                         var conditionId = $(this).data('id');

                         if(status === true){
                              var condition = {
                                   questionID: $(this).find('select[name^="page_Setting_qu_id"]').val() || '',
                                   question_condition: $(this).find('select[name^="page_Setting_conditions"]').val() || '',
                                   question_value: $(this).find('input[name^="page_Setting_qu_val"]').val() || '',
                                   status: status,
                              };

                              if(condition.questionID && condition.question_condition && condition.question_value){
                                   textareaData.new_conditions.push(condition);
                              }
                         }else if(status === false){
                              var condition = {
                                   questionID: $(this).find('select[name^="page_Setting_qu_id"]').val() || '',
                                   question_condition: $(this).find('select[name^="page_Setting_conditions"]').val() || '',
                                   question_value: $(this).find('input[name^="page_Setting_qu_val"]').val() || '',
                                   status: status,
                                   condition_id: conditionId, 
                              };

                              if(condition.questionID && condition.question_condition && condition.question_value){
                                   textareaData.conditions.push(condition);
                              }
                         }
                    });
               }

               questions.push(textareaData);
          });

          $('.add_qu_sec .append_dropdown').each(function(){
               var is_new = $(this).data('is_new');
               var id = $(this).data('id');

               var conditionalQuestion = $(this).find('input[name^="condition_qu_labe"]').is(':checked') ? 1 : 0;
               var questionLabel = $(this).find('input[name^="text_qu_label"]').val() || ''; 
               // var questionId = $(this).find('select[name^="text_qu_id"]').val() || '';
               var conditionalStep = $(this).find('input[name^="condition_go_to"]').is(':checked') ? 1 : 0;

               if(conditionalQuestion){
                    questionLabel = null;
               }

               var dropdownData = {
                    type: 'dropdown',
                    is_new: is_new,
                    id: id,
                    is_conditional_question: conditionalQuestion,
                    question_label: questionLabel,
                    // question_id: questionId,
                    is_conditional_step: conditionalStep,
                    conditional_question_labels: [],
                    new_conditional_question_labels: [],
                    conditions: [],
                    new_conditions: [],
                    add_options: [],
                    new_options: [],
               };

               if($(this).find('.append_options .dropdown-option') !== 0){
                    $(this).find('.append_options .dropdown-option').each(function(){
                         var status = $(this).data('is_new'); 
                         var optionId = $(this).data('id');

                         if(status === true){
                              var option = {
                                   option_label: $(this).find('input[name^=dropdown_option_label]').val() || '',
                                   option_value: $(this).find('input[name^=dropdown_option_value]').val() || '',
                                   option_go_to_step: $(this).find('select[name^=dropdown_go_to_step]').val() || '',
                                   status: status,
                              };

                              if(option.option_label && option.option_value && option.option_go_to_step){
                                   dropdownData.new_options.push(option);
                              }
                         }else if(status === false){
                              var option = {
                                   option_label: $(this).find('input[name^=dropdown_option_label]').val() || '',
                                   option_value: $(this).find('input[name^=dropdown_option_value]').val() || '',
                                   option_go_to_step: $(this).find('select[name^=dropdown_go_to_step]').val() || '',
                                   status: status,
                                   option_id: optionId,
                              };

                              if(option.option_label && option.option_value && option.option_go_to_step){
                                   dropdownData.add_options.push(option);
                              }
                         }
                    })
               }

               if(conditionalQuestion){
                    $(this).find('.append_label_condition .label-condition').each(function(){
                         var status = $(this).data('is_new'); 
                         var conditionId = $(this).data('id');

                         if(status === true){
                              var question_label = {
                                   label: $(this).find('input[name^="condition_question_label"]').val() || '',
                                   questionID: $(this).find('select[name^="label_qu_id"]').val() || '',
                                   question_value: $(this).find('input[name^="condition_question_value"]').val() || '',
                                   status: status,
                              };

                              if(question_label.label && question_label.questionID && question_label.question_value){
                                   dropdownData.new_conditional_question_labels.push(question_label);
                              }
                         }else if(status === false){
                              var question_label = {
                                   label: $(this).find('input[name^="condition_question_label"]').val() || '',
                                   questionID: $(this).find('select[name^="label_qu_id"]').val() || '',
                                   question_value: $(this).find('input[name^="condition_question_value"]').val() || '',
                                   status: status,
                                   condition_id: conditionId,
                              };

                              if(question_label.label && question_label.questionID && question_label.question_value){
                                   dropdownData.conditional_question_labels.push(question_label);
                              }
                         }
                    });
               }

               if(conditionalStep){
                    $(this).find('.append_page_condition .sec-condition').each(function() {
                         var status = $(this).data('is_new'); 
                         var conditionId = $(this).data('id');

                         if(status === true){
                              var condition = {
                                   questionID: $(this).find('select[name^="page_Setting_qu_id"]').val() || '',
                                   question_condition: $(this).find('select[name^="page_Setting_conditions"]').val() || '',
                                   question_value: $(this).find('input[name^="page_Setting_qu_val"]').val() || '',
                                   status: status,
                              };

                              if(condition.questionID && condition.question_condition && condition.question_value){
                                   dropdownData.new_conditions.push(condition);
                              }
                         }else if(status === false){
                              var condition = {
                                   questionID: $(this).find('select[name^="page_Setting_qu_id"]').val() || '',
                                   question_condition: $(this).find('select[name^="page_Setting_conditions"]').val() || '',
                                   question_value: $(this).find('input[name^="page_Setting_qu_val"]').val() || '',
                                   status: status,
                                   condition_id: conditionId, 
                              };

                              if(condition.questionID && condition.question_condition && condition.question_value){
                                   dropdownData.conditions.push(condition);
                              }
                         }
                    });
               }

               questions.push(dropdownData);
          });

          $('.add_qu_sec .append_radio').each(function(){
               var is_new = $(this).data('is_new');
               var id = $(this).data('id');

               var conditionalQuestion = $(this).find('input[name^="condition_qu_labe"]').is(':checked') ? 1 : 0;
               var questionLabel = $(this).find('input[name^="text_qu_label"]').val() || ''; 
               // var questionId = $(this).find('select[name^="text_qu_id"]').val() || '';
               var conditionalStep = $(this).find('input[name^="condition_go_to"]').is(':checked') ? 1 : 0;

               var radioData = {
                    type: 'radio-button',
                    is_new: is_new,
                    id: id,
                    is_conditional_question: conditionalQuestion,
                    question_label: questionLabel,
                    // question_id: questionId,
                    is_conditional_step: conditionalStep,
                    conditional_question_labels: [],
                    new_conditional_question_labels: [],
                    conditions: [],
                    new_conditions: [],
                    add_options: [],
                    new_options: [],
               };

               if($(this).find('.append_options .radio-option') !== 0){
                    $(this).find('.append_options .radio-option').each(function(){
                         var status = $(this).data('is_new'); 
                         var optionId = $(this).data('id');

                         if(status === true){
                              var option = {
                                   option_label: $(this).find('input[name^=radio_option_label]').val() || '',
                                   option_value: $(this).find('input[name^=radio_option_value]').val() || '',
                                   option_go_to_step: $(this).find('select[name^=radio_go_to_step]').val() || '',
                                   status: status,
                              };

                              if(option.option_label && option.option_value && option.option_go_to_step){
                                   radioData.new_options.push(option);
                              }
                         }else if(status === false){
                              var option = {
                                   option_label: $(this).find('input[name^=radio_option_label]').val() || '',
                                   option_value: $(this).find('input[name^=radio_option_value]').val() || '',
                                   option_go_to_step: $(this).find('select[name^=radio_go_to_step]').val() || '',
                                   status: status,
                                   option_id: optionId,
                              };

                              if(option.option_label && option.option_value && option.option_go_to_step){
                                   radioData.add_options.push(option);
                              }
                         }
                    })
               }

               if(conditionalQuestion){
                    $(this).find('.append_label_condition .label-condition').each(function(){
                         var status = $(this).data('is_new'); 
                         var conditionId = $(this).data('id');

                         if(status === true){
                              var question_label = {
                                   label: $(this).find('input[name^="condition_question_label"]').val() || '',
                                   questionID: $(this).find('select[name^="label_qu_id"]').val() || '',
                                   question_value: $(this).find('input[name^="condition_question_value"]').val() || '',
                                   status: status,
                              };

                              if(question_label.label && question_label.questionID && question_label.question_value){
                                   radioData.new_conditional_question_labels.push(question_label);
                              }
                         }else if(status === false){
                              var question_label = {
                                   label: $(this).find('input[name^="condition_question_label"]').val() || '',
                                   questionID: $(this).find('select[name^="label_qu_id"]').val() || '',
                                   question_value: $(this).find('input[name^="condition_question_value"]').val() || '',
                                   status: status,
                                   condition_id: conditionId,
                              };

                              if(question_label.label && question_label.questionID && question_label.question_value){
                                   radioData.conditional_question_labels.push(question_label);
                              }
                         }
                    });
               }

               if(conditionalStep){
                    $(this).find('.append_page_condition .sec-condition').each(function() {
                         var status = $(this).data('is_new'); 
                         var conditionId = $(this).data('id');

                         if(status === true){
                              var condition = {
                                   questionID: $(this).find('select[name^="page_Setting_qu_id"]').val() || '',
                                   question_condition: $(this).find('select[name^="page_Setting_conditions"]').val() || '',
                                   question_value: $(this).find('input[name^="page_Setting_qu_val"]').val() || '',
                                   status: status,
                              };

                              if(condition.questionID && condition.question_condition && condition.question_value){
                                   radioData.new_conditions.push(condition);
                              }
                         }else if(status === false){
                              var condition = {
                                   questionID: $(this).find('select[name^="page_Setting_qu_id"]').val() || '',
                                   question_condition: $(this).find('select[name^="page_Setting_conditions"]').val() || '',
                                   question_value: $(this).find('input[name^="page_Setting_qu_val"]').val() || '',
                                   status: status,
                                   condition_id: conditionId, 
                              };

                              if(condition.questionID && condition.question_condition && condition.question_value){
                                   radioData.conditions.push(condition);
                              }
                         }
                    });
               }

               questions.push(radioData);
          });

          $('.add_qu_sec .append_dateField').each(function(){
               var is_new = $(this).data('is_new');
               var id = $(this).data('id');

               var conditionalQuestion = $(this).find('input[name^="condition_qu_labe"]').is(':checked') ? 1 : 0;
               var questionLabel = $(this).find('input[name^="text_qu_label"]').val() || ''; 
               // var dateFieldId = $(this).find('input[name^="date_field_id"]').val() || '';
               var goToStep = $(this).find('select[name^="date_go_to_step"]').val() || '';
               var conditionalStep = $(this).find('input[name^="condition_go_to"]').is(':checked') ? 1 : 0;

               var datefieldData = {
                    type: 'date-field',
                    is_new: is_new,
                    id: id,
                    is_conditional_question: conditionalQuestion,
                    question_label: questionLabel,
                    // date_field_Id: dateFieldId,
                    go_to_step: goToStep,
                    is_conditional_step: conditionalStep,
                    conditional_question_labels: [],
                    new_conditional_question_labels: [],
                    conditions: [],
                    new_conditions: [],
               };

               if(conditionalQuestion){
                    $(this).find('.append_label_condition .label-condition').each(function() {
                         var status = $(this).data('is_new'); 
                         var conditionId = $(this).data('id');

                         if(status === true){
                              var question_label = {
                                   label: $(this).find('input[name^="condition_question_label"]').val() || '',
                                   questionID: $(this).find('select[name^="label_qu_id"]').val() || '',
                                   question_value: $(this).find('input[name^="condition_question_value"]').val() || '',
                                   status: status,
                              };

                              if(question_label.label && question_label.questionID && question_label.question_value){
                                   datefieldData.new_conditional_question_labels.push(question_label);
                              }
                         }else if(status === false){
                              var question_label = {
                                   label: $(this).find('input[name^="condition_question_label"]').val() || '',
                                   questionID: $(this).find('select[name^="label_qu_id"]').val() || '',
                                   question_value: $(this).find('input[name^="condition_question_value"]').val() || '',
                                   status: status,
                                   condition_id: conditionId,
                              };

                              if(question_label.label && question_label.questionID && question_label.question_value){
                                   datefieldData.conditional_question_labels.push(question_label);
                              }
                         }
                    });
               }

               if(conditionalStep){
                    $(this).find('.append_page_condition .sec-condition').each(function() {
                         var status = $(this).data('is_new'); 
                         var conditionId = $(this).data('id');

                         if(status === true){
                              var condition = {
                                   questionID: $(this).find('select[name^="page_Setting_qu_id"]').val() || '',
                                   question_condition: $(this).find('select[name^="page_Setting_conditions"]').val() || '',
                                   question_value: $(this).find('input[name^="page_Setting_qu_val"]').val() || '',
                                   status: status,
                              };

                              if(condition.questionID && condition.question_condition && condition.question_value){
                                   datefieldData.new_conditions.push(condition);
                              }
                         }else if(status === false){
                              var condition = {
                                   questionID: $(this).find('select[name^="page_Setting_qu_id"]').val() || '',
                                   question_condition: $(this).find('select[name^="page_Setting_conditions"]').val() || '',
                                   question_value: $(this).find('input[name^="page_Setting_qu_val"]').val() || '',
                                   status: status,
                                   condition_id: conditionId,
                              };

                              if(condition.questionID && condition.question_condition && condition.question_value){
                                   datefieldData.conditions.push(condition);
                              }
                         }
                    });
               }

               questions.push(datefieldData);
          });

          $('.add_qu_sec .append_priceBox').each(function(){
               var is_new = $(this).data('is_new');
               var id = $(this).data('id');

               var conditionalQuestion = $(this).find('input[name^="condition_qu_labe"]').is(':checked') ? 1 : 0;
               var questionLabel = $(this).find('input[name^="text_qu_label"]').val() || ''; 
               // var textBoxId = $(this).find('input[name^="text_id"]').val() || '';
               var textBoxPlaceholder = $(this).find('input[name^="text_placeholder"]').val() || '';
               // var placeholderText = $(this).find('input[name^="placeholder_text"]').val() || '';
               var goToStep = $(this).find('select[name^="text_go_to_step"]').val() || '';
               var conditionalStep = $(this).find('input[name^="condition_go_to"]').is(':checked') ? 1 : 0;

               if(conditionalQuestion){
                    questionLabel = null;
               }

               var priceBoxData = {
                    type: 'pricebox',
                    is_new: is_new,
                    id: id,
                    is_conditional_question: conditionalQuestion,
                    question_label: questionLabel,
                    // text_box_id: textBoxId,
                    text_box_placeholder: textBoxPlaceholder,
                    // placeholder_text: placeholderText,
                    go_to_step: goToStep,
                    is_conditional_step: conditionalStep,
                    conditional_question_labels: [],
                    new_conditional_question_labels: [],
                    conditions: [],
                    new_conditions: [],
               };

               if(conditionalQuestion){
                    $(this).find('.append_label_condition .label-condition').each(function() {
                         var status = $(this).data('is_new'); 
                         var conditionId = $(this).data('id');

                         if(status === true){
                              var question_label = {
                                   label: $(this).find('input[name^="condition_question_label"]').val() || '',
                                   questionID: $(this).find('select[name^="label_qu_id"]').val() || '',
                                   question_value: $(this).find('input[name^="condition_question_value"]').val() || '',
                                   status: status,
                              };

                              if(question_label.label && question_label.questionID && question_label.question_value){
                                   priceBoxData.new_conditional_question_labels.push(question_label);
                              }
                         }else if(status === false){
                              var question_label = {
                                   label: $(this).find('input[name^="condition_question_label"]').val() || '',
                                   questionID: $(this).find('select[name^="label_qu_id"]').val() || '',
                                   question_value: $(this).find('input[name^="condition_question_value"]').val() || '',
                                   status: status,
                                   condition_id: conditionId,
                              };

                              if(question_label.label && question_label.questionID && question_label.question_value){
                                   priceBoxData.conditional_question_labels.push(question_label);
                              }
                         }
                    });
               }

               if(conditionalStep){
                    $(this).find('.append_page_condition .sec-condition').each(function() {
                         var status = $(this).data('is_new'); 
                         var conditionId = $(this).data('id');

                         if(status === true){
                              var condition = {
                                   questionID: $(this).find('select[name^="page_Setting_qu_id"]').val() || '',
                                   question_condition: $(this).find('select[name^="page_Setting_conditions"]').val() || '',
                                   question_value: $(this).find('input[name^="page_Setting_qu_val"]').val() || '',
                                   status: status,
                              };

                              if(condition.questionID && condition.question_condition && condition.question_value){
                                   priceBoxData.new_conditions.push(condition);
                              }
                         }else if(status === false){
                              var condition = {
                                   questionID: $(this).find('select[name^="page_Setting_qu_id"]').val() || '',
                                   question_condition: $(this).find('select[name^="page_Setting_conditions"]').val() || '',
                                   question_value: $(this).find('input[name^="page_Setting_qu_val"]').val() || '',
                                   status: status,
                                   condition_id: conditionId, 
                              };

                              if(condition.questionID && condition.question_condition && condition.question_value){
                                   priceBoxData.conditions.push(condition);
                              }
                         }
                    });
               }

               questions.push(priceBoxData);
          });

          $('.add_qu_sec .append_numberField').each(function(){
               var is_new = $(this).data('is_new');
               var id = $(this).data('id');

               var conditionalQuestion = $(this).find('input[name^="condition_qu_labe"]').is(':checked') ? 1 : 0;
               var questionLabel = $(this).find('input[name^="text_qu_label"]').val() || ''; 
               // var textBoxId = $(this).find('input[name^="text_id"]').val() || '';
               var textBoxPlaceholder = $(this).find('input[name^="text_placeholder"]').val() || '';
               // var placeholderText = $(this).find('input[name^="placeholder_text"]').val() || '';
               var goToStep = $(this).find('select[name^="text_go_to_step"]').val() || '';
               var conditionalStep = $(this).find('input[name^="condition_go_to"]').is(':checked') ? 1 : 0;

               if(conditionalQuestion){
                    questionLabel = null;
               }

               var numberfieldData = {
                    type: 'number-field',
                    is_new: is_new,
                    id: id,
                    is_conditional_question: conditionalQuestion,
                    question_label: questionLabel,
                    // text_box_id: textBoxId,
                    text_box_placeholder: textBoxPlaceholder,
                    // placeholder_text: placeholderText,
                    go_to_step: goToStep,
                    is_conditional_step: conditionalStep,
                    conditional_question_labels: [],
                    new_conditional_question_labels: [],
                    conditions: [],
                    new_conditions: [],
               };

               if(conditionalQuestion){
                    $(this).find('.append_label_condition .label-condition').each(function() {
                         var status = $(this).data('is_new'); 
                         var conditionId = $(this).data('id');

                         if(status === true){
                              var question_label = {
                                   label: $(this).find('input[name^="condition_question_label"]').val() || '',
                                   questionID: $(this).find('select[name^="label_qu_id"]').val() || '',
                                   question_value: $(this).find('input[name^="condition_question_value"]').val() || '',
                                   status: status,
                              };

                              if(question_label.label && question_label.questionID && question_label.question_value){
                                   numberfieldData.new_conditional_question_labels.push(question_label);
                              }
                         }else if(status === false){
                              var question_label = {
                                   label: $(this).find('input[name^="condition_question_label"]').val() || '',
                                   questionID: $(this).find('select[name^="label_qu_id"]').val() || '',
                                   question_value: $(this).find('input[name^="condition_question_value"]').val() || '',
                                   status: status,
                                   condition_id: conditionId,
                              };

                              if(question_label.label && question_label.questionID && question_label.question_value){
                                   numberfieldData.conditional_question_labels.push(question_label);
                              }
                         }
                    });
               }

               if(conditionalStep){
                    $(this).find('.append_page_condition .sec-condition').each(function() {
                         var status = $(this).data('is_new'); 
                         var conditionId = $(this).data('id');

                         if(status === true){
                              var condition = {
                                   questionID: $(this).find('select[name^="page_Setting_qu_id"]').val() || '',
                                   question_condition: $(this).find('select[name^="page_Setting_conditions"]').val() || '',
                                   question_value: $(this).find('input[name^="page_Setting_qu_val"]').val() || '',
                                   status: status,
                              };

                              if(condition.questionID && condition.question_condition && condition.question_value){
                                   numberfieldData.new_conditions.push(condition);
                              }
                         }else if(status === false){
                              var condition = {
                                   questionID: $(this).find('select[name^="page_Setting_qu_id"]').val() || '',
                                   question_condition: $(this).find('select[name^="page_Setting_conditions"]').val() || '',
                                   question_value: $(this).find('input[name^="page_Setting_qu_val"]').val() || '',
                                   status: status,
                                   condition_id: conditionId, 
                              };

                              if(condition.questionID && condition.question_condition && condition.question_value){
                                   numberfieldData.conditions.push(condition);
                              }
                         }
                    });
               }

               questions.push(numberfieldData);
          });

          $('.add_qu_sec .appendPercentageBox').each(function(){
               var is_new = $(this).data('is_new');
               var id = $(this).data('id');

               var conditionalQuestion = $(this).find('input[name^="condition_qu_labe"]').is(':checked') ? 1 : 0;
               var questionLabel = $(this).find('input[name^="text_qu_label"]').val() || ''; 
               // var textBoxId = $(this).find('input[name^="text_id"]').val() || '';
               var textBoxPlaceholder = $(this).find('input[name^="text_placeholder"]').val() || '';
               // var placeholderText = $(this).find('input[name^="placeholder_text"]').val() || '';
               var goToStep = $(this).find('select[name^="text_go_to_step"]').val() || '';
               var conditionalStep = $(this).find('input[name^="condition_go_to"]').is(':checked') ? 1 : 0;

               if(conditionalQuestion){
                    questionLabel = null;
               }

               var percentageBoxData = {
                    type: 'percentage-box',
                    is_new: is_new,
                    id: id,
                    is_conditional_question: conditionalQuestion,
                    question_label: questionLabel,
                    // text_box_id: textBoxId,
                    text_box_placeholder: textBoxPlaceholder,
                    // placeholder_text: placeholderText,
                    go_to_step: goToStep,
                    is_conditional_step: conditionalStep,
                    conditional_question_labels: [],
                    new_conditional_question_labels: [],
                    conditions: [],
                    new_conditions: [],
               };

               if(conditionalQuestion){
                    $(this).find('.append_label_condition .label-condition').each(function() {
                         var status = $(this).data('is_new'); 
                         var conditionId = $(this).data('id');

                         if(status === true){
                              var question_label = {
                                   label: $(this).find('input[name^="condition_question_label"]').val() || '',
                                   questionID: $(this).find('select[name^="label_qu_id"]').val() || '',
                                   question_value: $(this).find('input[name^="condition_question_value"]').val() || '',
                                   status: status,
                              };

                              if(question_label.label && question_label.questionID && question_label.question_value){
                                   percentageBoxData.new_conditional_question_labels.push(question_label);
                              }
                         }else if(status === false){
                              var question_label = {
                                   label: $(this).find('input[name^="condition_question_label"]').val() || '',
                                   questionID: $(this).find('select[name^="label_qu_id"]').val() || '',
                                   question_value: $(this).find('input[name^="condition_question_value"]').val() || '',
                                   status: status,
                                   condition_id: conditionId,
                              };

                              if(question_label.label && question_label.questionID && question_label.question_value){
                                   percentageBoxData.conditional_question_labels.push(question_label);
                              }
                         }
                    });
               }

               if(conditionalStep){
                    $(this).find('.append_page_condition .sec-condition').each(function() {
                         var status = $(this).data('is_new'); 
                         var conditionId = $(this).data('id');

                         if(status === true){
                              var condition = {
                                   questionID: $(this).find('select[name^="page_Setting_qu_id"]').val() || '',
                                   question_condition: $(this).find('select[name^="page_Setting_conditions"]').val() || '',
                                   question_value: $(this).find('input[name^="page_Setting_qu_val"]').val() || '',
                                   status: status,
                              };

                              if(condition.questionID && condition.question_condition && condition.question_value){
                                   percentageBoxData.new_conditions.push(condition);
                              }
                         }else if(status === false){
                              var condition = {
                                   questionID: $(this).find('select[name^="page_Setting_qu_id"]').val() || '',
                                   question_condition: $(this).find('select[name^="page_Setting_conditions"]').val() || '',
                                   question_value: $(this).find('input[name^="page_Setting_qu_val"]').val() || '',
                                   status: status,
                                   condition_id: conditionId, 
                              };

                              if(condition.questionID && condition.question_condition && condition.question_value){
                                   percentageBoxData.conditions.push(condition);
                              }
                         }
                    });
               }

               questions.push(percentageBoxData);
          });

          $('.add_qu_sec .append_dropdownLink').each(function(){
               var is_new = $(this).data('is_new');
               var id = $(this).data('id');

               var questionLabel = $(this).find('input[name^="text_qu_label"]').val() || ''; 
               var sameContractlink = $(this).find('input[name^="same_contract_link"]').val() || '';
               var goToStep = $(this).find('select[name^="text_go_to_step"]').val() || '';

               var dropdownLinkData = {
                    type: 'dropdown-link',
                    is_new: is_new,
                    id: id,
                    question_label: questionLabel,
                    same_contract_link: sameContractlink,
                    go_to_step: goToStep,
                    add_rows: [],
                    new_rows: [],
               };

               if($(this).find('.add_cont_rw .contract-option') !== 0){
                    $(this).find('.add_cont_rw .contract-option').each(function(){
                         var status = $(this).data('is_new'); 
                         var optionId = $(this).data('id');

                         if(status === true){
                              var row = {
                                   label: $(this).find('input[name^=dropdown_link_label]').val() || '',
                                   contract_link: $(this).find('input[name^=contract_link]').val() || '',
                                   next_step: $(this).find('input[name^=contract_send_next_step]').is(':checked') ? 1 : 0,
                                   status: status,
                              };
                              
                              if(row.label && row.contract_link || row.next_step){
                                   dropdownLinkData.new_rows.push(row);
                              }
                         }else if(status === false){
                              var row = {
                                   label: $(this).find('input[name^=dropdown_link_label]').val() || '',
                                   contract_link: $(this).find('input[name^=contract_link]').val() || '',
                                   next_step: $(this).find('input[name^=contract_send_next_step]').is(':checked') ? 1 : 0,
                                   status: status,
                                   option_id: optionId
                              };

                              if(row.label && row.contract_link || row.next_step){
                                   dropdownLinkData.add_rows.push(row);
                              }
                         }
                    })
               }

               questions.push(dropdownLinkData);
          });
          return questions;
     }

     $(document).ready(function(){
          $('#saveQuestiondata1').click(function(){
               var data = getAllSteps();
               // console.log(data);
               $('#formdata').val(JSON.stringify(data));
               var documentName = $('#document_id').val();
               let hasError = false;

               $('.add_conditional_label').each(function () {
                    const uniqueId = $(this).attr('id').replace('condition_qu_label', '');
                    const conditionSection = $('.cond_ques_div' + uniqueId);

                    if($(this).is(':checked')){
                         const appendSection = $('#append_label_condition' + uniqueId);
                         const conditionSections = appendSection.find('.label-condition');

                         if(conditionSections.length === 0){
                              NioApp.Toast('Please add label.', 'error', { position: 'top-right' });
                              hasError = true;
                              return false; 
                         }

                         let conditionInvalid = false;
                         conditionSection.find('select, input').each(function(){
                              if(!$(this).val()){
                                   conditionInvalid = true;
                                   return false; 
                              }
                         });
     
                         if(conditionInvalid){
                              NioApp.Toast('Please fill in all required labels.', 'error', { position: 'top-right' });
                              hasError = true;
                              return false;
                         }
                    }
               });

               $(".hide_question_label").each(function(){
                    const uniqueId = $(this).attr('id').replace('hide_question_label', '');
                    const questionSection = $(this);
                    const displayStyle = questionSection.css('display'); 
                    
                    if(displayStyle === 'block'){
                         const questionLabelInput = questionSection.find(".question_labl"); 
                         if(!hasError && !questionLabelInput.val()){
                              NioApp.Toast('Please fill the Question Label', 'error', { position: 'top-right' });
                              hasError = true; 
                              return false; 
                         }
                    }
               });

               
               // $(".hide_question_label").each(function(){
               //      const uniqueId = $(this).attr('id').replace('hide_question_label', '');
               //      const questionSection = $('#hide_question_label'+uniqueId);
               //      const displayStyle = questionSection.css('display'); 
               //      console.log(displayStyle);

               //      if(displayStyle === 'block'){
               //           $(".question_labl").each(function(){
               //                if(!hasError && !$(this).val()){
               //                     NioApp.Toast('Please fill the Question Label', 'error', { position: 'top-right' });
               //                     hasError = true;
               //                     return false;
               //                }
               //           });
               //      }
               // })

               $(".radio_ques").each(function(){
                    if(!hasError && !$(this).val()){
                         NioApp.Toast('Please fill the Question Label', 'error', { position: 'top-right' });
                         hasError = true;
                         return false;
                    }
               });

               $(".date_ques").each(function(){
                    if(!hasError && !$(this).val()){
                         NioApp.Toast('Please fill the Question Label', 'error', { position: 'top-right' });
                         hasError = true;
                         return false;
                    }
               });

               $(".dropdown_ques").each(function(){
                    if(!hasError && !$(this).val()){
                         NioApp.Toast('Please fill the Question Label', 'error', { position: 'top-right' });
                         hasError = true;
                         return false;
                    }
               }); 
               
               $(".same_contract").each(function(){
                    if(!hasError && !$(this).val()){
                         NioApp.Toast('Please fill the Same Contract Link Label', 'error', { position: 'top-right' });
                         hasError = true;
                         return false;
                    }
               }); 

               // $(".text_box_id").each(function(){
               //      if(!hasError && !$(this).val()){
               //           NioApp.Toast('Please fill the Text Box ID', 'error', { position: 'top-right' });
               //           hasError = true;
               //           return false;
               //      }
               // });
          
               $(".text_box_placeholder").each(function(){
                    if(!hasError && !$(this).val()){
                         NioApp.Toast('Please fill the Text Box Placeholder', 'error', { position: 'top-right' });
                         hasError = true;
                         return false;
                    }
               });

               // $(".date_field").each(function(){
               //      if(!hasError && !$(this).val()){
               //           NioApp.Toast('Please fill the Date field ID', 'error', { position: 'top-right' });
               //           hasError = true;
               //           return false;
               //      }
               // });
               
               // $(".number_field").each(function(){
               //      if(!hasError && !$(this).val()){
               //           NioApp.Toast('Please fill the Number field ID', 'error', { position: 'top-right' });
               //           hasError = true;
               //           return false;
               //      }
               // });

               $(".number_placeholder").each(function(){
                    if(!hasError && !$(this).val()){
                         NioApp.Toast('Please fill the Number field Placeholder', 'error', { position: 'top-right' });
                         hasError = true;
                         return false;
                    }
               });

               $('.add_cont_rw').each(function(){
                    const uniqueId = $(this).attr('id').replace('add_cont_rw', '');
                    const appendSection = $('#add_cont_rw' + uniqueId);
                    const contractSections = appendSection.find('.contract-option');
                    let conditionInvalid = false;

                    if(!hasError && contractSections.length !== 0){ 
                         contractSections.find('input').each(function(){
                              if(!$(this).val()){
                                   conditionInvalid = true;
                                   return false; 
                              }
                         });
                    }

                    if(!hasError && conditionInvalid){
                         NioApp.Toast('Please fill in all required rows fields.', 'error', { position: 'top-right' });
                         hasError = true;
                         return false;
                    }
               })

               $(".go_to_step").each(function(){
                    if(!hasError && !$(this).val()){
                         NioApp.Toast('Please fill the Go to step', 'error', { position: 'top-right' });
                         hasError = true;
                         return false;
                    }
               });

               // $(".question_ID").each(function(){
               //      if(!hasError && !$(this).val()){
               //           NioApp.Toast('Please fill the Question Id', 'error', { position: 'top-right' });
               //           hasError = true;
               //           return false;
               //      }
               // });

               $('.append_options').each(function(){
                    const uniqueId = $(this).attr('id').replace('append_options', '');
                    const appendSection = $('#append_options' + uniqueId);
                    const dropdownOptionSections = appendSection.find('.dropdown-option');
                    const radioOptionSections = appendSection.find('.radio-option');
                    let conditionInvalid = false;

                    if(!hasError && dropdownOptionSections.length !== 0){ 
                         dropdownOptionSections.find('input').each(function(){
                              if(!$(this).val()){
                                   conditionInvalid = true;
                                   return false; 
                              }
                         });
                    }

                    if(!hasError && radioOptionSections.length !== 0){
                         radioOptionSections.find('input').each(function(){
                              if(!$(this).val()){
                                   conditionInvalid = true;
                                   return false; 
                              }
                         });
                    }

                    if(!hasError && conditionInvalid){
                         NioApp.Toast('Please fill in all required options.', 'error', { position: 'top-right' });
                         hasError = true;
                         return false;
                    }
               })

               $('.enable_conditional').each(function () {
                    const uniqueId = $(this).attr('id').replace('condition_go_to', '');
                    const conditionSection = $('.cond_div' + uniqueId);

                    if(!hasError && $(this).is(':checked')){
                         const appendSection = $('#append_page_condition' + uniqueId);
                         const conditionSections = appendSection.find('.sec-condition');

                         if(conditionSections.length === 0){
                              NioApp.Toast('Please add condition.', 'error', { position: 'top-right' });
                              hasError = true;
                              return false; 
                         }

                         let conditionInvalid = false;
                         conditionSection.find('select, input').each(function(){
                              if(!$(this).val()){
                                   conditionInvalid = true;
                                   return false; 
                              }
                         });
     
                         if(conditionInvalid){
                              NioApp.Toast('Please fill in all required conditions fields.', 'error', { position: 'top-right' });
                              hasError = true;
                              return false;
                         }
                    }
               });

               // if(!hasError && (!documentName || documentName.trim() === "")){
               //      NioApp.Toast('Please select the document', 'error', { position: 'top-right' });
               //      hasError = true;
               // }
     
               if(!hasError){
                    $('#questionForm').submit();
               }
          })

          $('#updateQuestiondata').click(function(){
               var data = getAllSteps();
               console.log(data);

               $('#formdata').val(JSON.stringify(data));
               var documentName = $('#document_id').val();
               let hasError = false;

               $('.add_conditional_label').each(function (){
                    const uniqueId = $(this).attr('id').replace('condition_qu_label', '');
                    const conditionSection = $('.cond_ques_div' + uniqueId);
                   
                    if($(this).is(':checked')){
                         const appendSection = $('#append_label_condition' + uniqueId);
                         const conditionSections = appendSection.find('.label-condition');

                         if(conditionSections.length === 0){
                              NioApp.Toast('Please add label.', 'error', { position: 'top-right' });
                              hasError = true;
                              return false; 
                         }

                         let conditionInvalid = false;
                         conditionSection.find('select, input').each(function(){
                              if(!$(this).val()){
                                   conditionInvalid = true;
                                   return false; 
                              }
                         });
     
                         if(conditionInvalid){
                              NioApp.Toast('Please fill in all required labels.', 'error', { position: 'top-right' });
                              hasError = true;
                              return false;
                         }
                    }
               });

               $(".hide_question_label").each(function(){
                    const uniqueId = $(this).attr('id').replace('hide_question_label', '');
                    const questionSection = $(this);
                    const displayStyle = questionSection.css('display'); 
                    
                    if(displayStyle === 'block'){
                         const questionLabelInput = questionSection.find(".question_labl"); 
                         if(!hasError && !questionLabelInput.val()){
                              NioApp.Toast('Please fill the Question Label', 'error', { position: 'top-right' });
                              hasError = true; 
                              return false; 
                         }
                    }
               });

               
               // $(".hide_question_label").each(function(){
               //      const uniqueId = $(this).attr('id').replace('hide_question_label', '');
               //      const questionSection = $('#hide_question_label'+uniqueId);
               //      const displayStyle = questionSection.css('display'); 
               //      console.log(displayStyle);

               //      if(displayStyle === 'block'){
               //           $(".question_labl").each(function(){
               //                if(!hasError && !$(this).val()){
               //                     NioApp.Toast('Please fill the Question Label', 'error', { position: 'top-right' });
               //                     hasError = true;
               //                     return false;
               //                }
               //           });
               //      }
               // })

               $(".radio_ques").each(function(){
                    if(!hasError && !$(this).val()){
                         NioApp.Toast('Please fill the Question Label', 'error', { position: 'top-right' });
                         hasError = true;
                         return false;
                    }
               });

               $(".date_ques").each(function(){
                    if(!hasError && !$(this).val()){
                         NioApp.Toast('Please fill the Question Label', 'error', { position: 'top-right' });
                         hasError = true;
                         return false;
                    }
               });

               $(".dropdown_ques").each(function(){
                    if(!hasError && !$(this).val()){
                         NioApp.Toast('Please fill the Question Label', 'error', { position: 'top-right' });
                         hasError = true;
                         return false;
                    }
               }); 
               
               $(".same_contract").each(function(){
                    if(!hasError && !$(this).val()){
                         NioApp.Toast('Please fill the Same Contract Link Label', 'error', { position: 'top-right' });
                         hasError = true;
                         return false;
                    }
               }); 

               // $(".text_box_id").each(function(){
               //      if(!hasError && !$(this).val()){
               //           NioApp.Toast('Please fill the Text Box ID', 'error', { position: 'top-right' });
               //           hasError = true;
               //           return false;
               //      }
               // });
          
               $(".text_box_placeholder").each(function(){
                    if(!hasError && !$(this).val()){
                         NioApp.Toast('Please fill the Text Box Placeholder', 'error', { position: 'top-right' });
                         hasError = true;
                         return false;
                    }
               });

               // $(".date_field").each(function(){
               //      if(!hasError && !$(this).val()){
               //           NioApp.Toast('Please fill the Date field ID', 'error', { position: 'top-right' });
               //           hasError = true;
               //           return false;
               //      }
               // });
               
               // $(".number_field").each(function(){
               //      if(!hasError && !$(this).val()){
               //           NioApp.Toast('Please fill the Number field ID', 'error', { position: 'top-right' });
               //           hasError = true;
               //           return false;
               //      }
               // });

               $(".number_placeholder").each(function(){
                    if(!hasError && !$(this).val()){
                         NioApp.Toast('Please fill the Number field Placeholder', 'error', { position: 'top-right' });
                         hasError = true;
                         return false;
                    }
               });

               $('.add_cont_rw').each(function(){
                    const uniqueId = $(this).attr('id').replace('add_cont_rw', '');
                    const appendSection = $('#add_cont_rw' + uniqueId);
                    const contractSections = appendSection.find('.contract-option');
                    let conditionInvalid = false;

                    if(!hasError && contractSections.length !== 0){ 
                         contractSections.find('input').each(function(){
                              if(!$(this).val()){
                                   conditionInvalid = true;
                                   return false; 
                              }
                         });
                    }

                    if(!hasError && conditionInvalid){
                         NioApp.Toast('Please fill in all required rows fields.', 'error', { position: 'top-right' });
                         hasError = true;
                         return false;
                    }
               })

               $(".go_to_step").each(function(){
                    if(!hasError && !$(this).val()){
                         NioApp.Toast('Please fill the Go to step', 'error', { position: 'top-right' });
                         hasError = true;
                         return false;
                    }
               });

               // $(".question_ID").each(function(){
               //      if(!hasError && !$(this).val()){
               //           NioApp.Toast('Please fill the Question Id', 'error', { position: 'top-right' });
               //           hasError = true;
               //           return false;
               //      }
               // });

               $('.append_options').each(function(){
                    const uniqueId = $(this).attr('id').replace('append_options', '');
                    const appendSection = $('#append_options' + uniqueId);
                    const dropdownOptionSections = appendSection.find('.dropdown-option');
                    const radioOptionSections = appendSection.find('.radio-option');
                    let conditionInvalid = false;

                    if(!hasError && dropdownOptionSections.length !== 0){ 
                         dropdownOptionSections.find('input').each(function(){
                              if(!$(this).val()){
                                   conditionInvalid = true;
                                   return false; 
                              }
                         });
                    }

                    if(!hasError && radioOptionSections.length !== 0){
                         radioOptionSections.find('input').each(function(){
                              if(!$(this).val()){
                                   conditionInvalid = true;
                                   return false; 
                              }
                         });
                    }

                    if(!hasError && conditionInvalid){
                         NioApp.Toast('Please fill in all required options.', 'error', { position: 'top-right' });
                         hasError = true;
                         return false;
                    }
               })

               $('.enable_conditional').each(function(){
                    const uniqueId = $(this).attr('id').replace('condition_go_to', '');
                    const conditionSection = $('.cond_div' + uniqueId);
                    // console.log($(this).is(':checked'));
                    if(!hasError && $(this).is(':checked')){
                         const appendSection = $('#append_page_condition' + uniqueId);
                         const conditionSections = appendSection.find('.sec-condition');

                         if(conditionSections.length === 0){
                              NioApp.Toast('Please add condition.', 'error', { position: 'top-right' });
                              hasError = true;
                              return false; 
                         }

                         let conditionInvalid = false;
                         conditionSection.find('select, input').each(function(){
                              if(!$(this).val()){
                                   conditionInvalid = true;
                                   return false; 
                              }
                         });
     
                         if(conditionInvalid){
                              NioApp.Toast('Please fill in all required conditions fields.', 'error', { position: 'top-right' });
                              hasError = true;
                              return false;
                         }
                    }
               });

               // if(!hasError && (!documentName || documentName.trim() === "")){
               //      NioApp.Toast('Please select the document', 'error', { position: 'top-right' });
               //      hasError = true;
               // }
     
               if(!hasError){
                    $('#questionForm').submit();
               }
          })
     })
     
</script>

@endsection