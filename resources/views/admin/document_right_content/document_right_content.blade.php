@extends('admin_layout.master')
@section('content')

@php use Carbon\Carbon; @endphp
<div class="nk-content">
     <div class="container-fluid">
          @if(isset($documentRight) && $documentRight != null)
          <form action="{{ url('/admin-dashboard/update-document-right-content') }}" id="updatecontentForm" method="post" enctype="multipart/form-data">
          @else
          <form action="{{ url('/admin-dashboard/add-document-right-content') }}" id="contentForm" method="post" enctype="multipart/form-data">
          @endif     
               @csrf
               <input type="hidden" id="published" name="published" value="">
               <input type="hidden" id="remove_content_heading" name="remove_content_heading" value="">
               <input type="hidden" id="remove_content" name="remove_content" value="">
               <input type="hidden" id="remove_condition" name="remove_condition" value="">
               <input type="hidden" id="formdata" name="formdata" value="">
               <div class="row main_section">
                    <div class="col md-8 left-content">
                         <div class="col-md-12 doc-title mt-4 pb-4">
                              <div class="form-group">
                                   <label class="form-label" for="title"><b><h4>@if(isset($documentRight) && $documentRight != null) Edit Right Content @else Add New Right Content @endif</h4></b></label>
                                   <input type="text" class="form-control form-control-lg" id="title" name="title" placeholder="Add title" value="{{ $title ?? '' }}">
                              </div>
                         </div>
                         <h5>Contract Right Content</h5>
                         <div class="card card-bordered card-preview">
                              <div class="card-inner">
                                   <h6>Contract Right Content</h6>
                                   <div class="add_contents">
                                        @if(isset($documentRight) && $documentRight != null)
                                        <?php 
                                             $count = 1;
                                             $date = Carbon::now();
                                             $carbonDate = Carbon::parse($date);
                                             $uniqueId = $carbonDate->timestamp * 1000;
                                        ?>
                                             @foreach($documentRight as $data)
                                                  @if($data->type == 'content_heading')
                                                  <div class="append_content_heading" id="content_heading{{ $data->id ?? '' }}" data-id="{{ $data->id ?? '' }}" data-is_new=”false”>
                                                       <hr>
                                                       <div class="card card-bordered card-preview">
                                                            <div class="card-inner">
                                                                 <div class="row add_content_heading">
                                                                      <div class="col-md-6">
                                                                           <h6>Content Heading</h6>  
                                                                      </div> 
                                                                      <div class="col-md-6">
                                                                           <div class="form-group">
                                                                                <span class="col-md-2 offset-md-10">
                                                                                     <span onclick="removeContent(this)" data-id="{{ $data->id ?? '' }}" data-field="content_heading"><i class="fa-solid fa-minus"></i></span>
                                                                                </span>  
                                                                           </div>
                                                                      </div>
                                                                 </div> 
                                                                 <hr>
                                                                 <div class="col-md-12">
                                                                      <div class="form-group">
                                                                           <label class="form-label" for="content_heading_html{{ $uniqueId ?? '' }}">Content Html</label>
                                                                           <input type="text" class="form-control" name="content_heading_html-{{ $count++ }}" id="content_heading_html{{ $uniqueId ?? '' }}" value="{{ $data->content ?? '' }}">
                                                                      </div>
                                                                 </div>
                                                            </div>
                                                       </div>
                                                  </div>
                                                  @elseif($data->type == 'content')
                                                  <div class="append_content" id="content{{ $data->id ?? '' }}" data-id="{{ $data->id ?? '' }}" data-is_new=”false”>
                                                       <hr>
                                                       <div class="card card-bordered card-preview">
                                                            <div class="card-inner">
                                                                 <div class="row">
                                                                      <div class="col-md-6">
                                                                           <h6>Content</h6>  
                                                                      </div> 
                                                                      <div class="col-md-6">
                                                                           <div class="form-group">
                                                                                <span class="col-md-2 offset-md-10">
                                                                                     <span onclick="removeContent(this)" data-id="{{ $data->id ?? '' }}" data-field="content"><i class="fa-solid fa-minus"></i></span>
                                                                                </span>  
                                                                           </div>
                                                                      </div>
                                                                 </div> 
                                                                 <hr>
                                                                 <div class="col-md-12">
                                                                      <div class="form-group">
                                                                           <label class="form-label" for="">Start New Section</label>
                                                                      </div>
                                                                 </div>
                                                                 <div class="custom-control custom-checkbox">
                                                                 @if(isset($data->start_new_section) && $data->start_new_section != null)
                                                                      @if($data->start_new_section == '1')
                                                                      <input type="checkbox" class="custom-control-input" id="start_new_section{{ $data->id ?? '' }}" name="start_new_section-{{ $count++ }}" checked>
                                                                      <label class="custom-control-label" for="start_new_section{{ $data->id ?? '' }}"></label>
                                                                      @else
                                                                      <input type="checkbox" class="custom-control-input" id="start_new_section{{ $data->id ?? '' }}" name="start_new_section-{{ $count++ }}">
                                                                      <label class="custom-control-label" for="start_new_section{{ $data->id ?? '' }}"></label>
                                                                      @endif
                                                                 @else
                                                                      <input type="checkbox" class="custom-control-input" id="start_new_section{{ $data->id ?? '' }}" name="start_new_section-{{ $count++ }}">
                                                                      <label class="custom-control-label" for="start_new_section{{ $data->id ?? '' }}"></label>
                                                                 @endif
                                                                 </div>
                                                                 <hr>
                                                                 <div class="start_append_section{{ $data->id ?? '' }}">
                                                                      <div class="row">
                                                                           <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                     <label class="form-label" for="text_align">Text align</label>
                                                                                     <div class="form-control-wrap"> 
                                                                                          <select class="form-select js-select2" name="text_align-{{ $count++ }}" id="text_align">
                                                                                               <option value=""></option>
                                                                                               @if(isset($data->text_align) && $data->text_align != null)
                                                                                                    @if($data->text_align == 'left')
                                                                                                    <option value="left" selected>left</option>
                                                                                                    @else
                                                                                                    <option value="left">left</option>
                                                                                                    @endif

                                                                                                    @if($data->text_align == 'right')
                                                                                                    <option value="right" selected>right</option>
                                                                                                    @else
                                                                                                    <option value="right">right</option>
                                                                                                    @endif

                                                                                                    @if($data->text_align == 'center')
                                                                                                    <option value="center" selected>center</option>
                                                                                                    @else
                                                                                                    <option value="center">center</option>
                                                                                                    @endif
                                                                                               @else
                                                                                               <option value="left">left</option>
                                                                                               <option value="right">right</option>
                                                                                               <option value="center">center</option>
                                                                                               @endif
                                                                                          </select>
                                                                                     </div>
                                                                                </div>
                                                                           </div>
                                                                           <div class="col-md-6">
                                                                                <p class="p_label">This is signature field</p>
                                                                                <div class="custom-control custom-checkbox">
                                                                                @if(isset($data->signature_field) && $data->signature_field != null)
                                                                                     @if($data->signature_field == '1')
                                                                                     <input type="checkbox" class="custom-control-input" id="signature_field{{ $data->id ?? '' }}" name="signature_field-{{ $count++ }}" checked>
                                                                                     <label class="custom-control-label" for="signature_field{{ $data->id ?? '' }}"></label>
                                                                                     @else
                                                                                     <input type="checkbox" class="custom-control-input" id="signature_field{{ $data->id ?? '' }}" name="signature_field-{{ $count++ }}">
                                                                                     <label class="custom-control-label" for="signature_field{{ $data->id ?? '' }}"></label>
                                                                                     @endif
                                                                                @else
                                                                                     <input type="checkbox" class="custom-control-input" id="signature_field{{ $data->id ?? '' }}" name="signature_field-{{ $count++ }}">
                                                                                     <label class="custom-control-label" for="signature_field{{ $data->id ?? '' }}"></label>
                                                                                @endif
                                                                                </div>
                                                                           </div>
                                                                      </div>
                                                                      <hr>
                                                                 </div>
                                                                 <div class="col-md-12">
                                                                      <div class="form-group">
                                                                           <label class="form-label" for="content_content_html">Content Html</label>
                                                                           <textarea class="form-control" name="content_content_html-{{ $count++ }}" id="content_content_html">{{ $data->content ?? '' }}</textarea>
                                                                      </div>
                                                                 </div>
                                                                 <hr>
                                                                 <div class="row">
                                                                      <div class="col-md-6">
                                                                           <div class="form-group">
                                                                                <label class="form-label" for="content_class">Content Class</label>
                                                                                <input type="text" class="form-control" name="content_class-{{ $count++ }}" id="content_class" value="{{ $data->content_class ?? '' }}">
                                                                           </div>
                                                                      </div>
                                                                      <div class="col-md-6">
                                                                           <p class="p_label">Add Condition</p>
                                                                           <div class="custom-control custom-checkbox">
                                                                           @if(isset($data->is_condition) && $data->is_condition != null)
                                                                                @if($data->is_condition == '1')
                                                                                <input type="checkbox" class="custom-control-input" id="add_condition{{ $data->id ?? '' }}" name="add_condition-{{ $count++ }}" checked>
                                                                                <label class="custom-control-label" for="add_condition{{ $data->id ?? '' }}"></label>
                                                                                @else
                                                                                <input type="checkbox" class="custom-control-input" id="add_condition{{ $data->id ?? '' }}" name="add_condition-{{ $count++ }}">
                                                                                <label class="custom-control-label" for="add_condition{{ $data->id ?? '' }}"></label>
                                                                                @endif
                                                                           @else
                                                                                <input type="checkbox" class="custom-control-input" id="add_condition{{ $data->id ?? '' }}" name="add_condition-{{ $count++ }}">
                                                                                <label class="custom-control-label" for="add_condition{{ $data->id ?? '' }}"></label>
                                                                           @endif
                                                                           </div>
                                                                      </div>
                                                                 </div>
                                                                 <hr>
                                                                 @if(isset($data->is_condition) && $data->is_condition != null)
                                                                 <div class="add_condition_section{{ $data->id ?? '' }}" style="display:block;">
                                                                      <div class="col-md-12">
                                                                           <p class="p_label">Add Content Html Condition</p> 
                                                                      </div>
                                                                      <div class="append_condition" id="append_condition{{ $data->id ?? '' }}">
                                                                      @if(isset($data->conditions) && $data->conditions != null)
                                                                      @foreach($data->conditions as $qu_conditions)
                                                                      @if($qu_conditions->condition_type == 'content_condition')
                                                                           <div class="condition-section" id="condition-section{{ $qu_conditions->id ?? '' }}" data-id="{{ $qu_conditions->id ?? '' }}">
                                                                                <hr>
                                                                                <div class="text-end">
                                                                                     <div class="form-group">
                                                                                          <div>
                                                                                               <span onclick="removeCondition(this)" data-id="{{ $qu_conditions->id ?? '' }}">
                                                                                                    <i class="fa fa-times"></i>
                                                                                               </span>
                                                                                          </div>
                                                                                     </div>
                                                                                </div>
                                                                                <div class="row">
                                                                                     <div class="col-md-4">
                                                                                          <div class="form-group">
                                                                                               <label class="form-label" for="condition_question_id">Question ID</label>
                                                                                               <input type="text" class="form-control" id="condition_question_id" name="condition_question_id-{{ $count++ }}[]" value="{{ $qu_conditions->conditional_question_id ?? '' }}">
                                                                                          </div>
                                                                                     </div>
                                                                                     <div class="col-md-4">
                                                                                          <div class="form-group">
                                                                                               <label class="form-label" for="conditions">Condition</label>
                                                                                               <div class="form-control-wrap"> 
                                                                                                    <select class="form-select js-select2" name="conditions-{{ $count++ }}[]" id="conditions">
                                                                                                         <option value=""></option>
                                                                                                         @if(isset($qu_conditions->conditional_check) && $qu_conditions->conditional_check != null)
                                                                                                              @if($qu_conditions->conditional_check == '1')
                                                                                                              <option value="is_equal_to" selected>is equal to</option>
                                                                                                              @else
                                                                                                              <option value="is_equal_to">is equal to</option>
                                                                                                              @endif

                                                                                                              @if($qu_conditions->conditional_check == '2')
                                                                                                              <option value="is_greater_than" selected>is greater than</option>
                                                                                                              @else
                                                                                                              <option value="is_greater_than">is greater than</option>
                                                                                                              @endif

                                                                                                              @if($qu_conditions->conditional_check == '3')
                                                                                                              <option value="is_less_than" selected>is less than</option>
                                                                                                              @else
                                                                                                              <option value="is_less_than">is less than</option>
                                                                                                              @endif

                                                                                                              @if($qu_conditions->conditional_check == '4')
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
                                                                                               <label class="form-label" for="condition_question_value">Question Value</label>
                                                                                               <input type="text" class="form-control" id="condition_question_value" name="condition_question_value-{{ $count++ }}[]" value="{{ $qu_conditions->conditional_question_value ?? '' }}">
                                                                                          </div>
                                                                                     </div>
                                                                                </div>
                                                                                <br>
                                                                           </div>
                                                                      @endif
                                                                      @endforeach
                                                                      @endif
                                                                      </div>
                                                                      <div class="text-end">
                                                                           <div class="form-group">
                                                                                <button type="button" class="btn btn-sm btn-primary" onclick="addCondition('{{ $data->id ?? '' }}','{{ $count++ }}')">Add Condition</button>
                                                                           </div>
                                                                      </div>
                                                                      <hr>
                                                                 </div>
                                                                 @else
                                                                 <div class="add_condition_section{{ $data->id ?? '' }}" style="display:none;">
                                                                      <div class="col-md-12">
                                                                           <p class="p_label">Add Content Html Condition</p> 
                                                                      </div>
                                                                      <div class="append_condition" id="append_condition{{ $data->id ?? '' }}"></div>
                                                                      <div class="text-end">
                                                                           <div class="form-group">
                                                                                <button type="button" class="btn btn-sm btn-primary" onclick="addCondition('{{ $data->id ?? '' }}','{{ $count++ }}')">Add Condition</button>
                                                                           </div>
                                                                      </div>
                                                                      <hr>
                                                                 </div>
                                                                 @endif
                                                                 <div class="row">
                                                                      <div class="col-md-6">
                                                                           <p class="p_label">Secure Blurr Content</p>
                                                                           <div class="custom-control custom-checkbox">
                                                                           @if(isset($data->secure_blur_content) && $data->secure_blur_content != null)
                                                                                @if($data->secure_blur_content == '1')
                                                                                <input type="checkbox" class="custom-control-input" id="secure_blurr_content{{ $uniqueId ?? '' }}" name="secure_blurr_content-{{ $count++ }}" checked>
                                                                                <label class="custom-control-label" for="secure_blurr_content{{ $uniqueId ?? '' }}">Secure Blurr Content</label>
                                                                                @else
                                                                                <input type="checkbox" class="custom-control-input" id="secure_blurr_content{{ $uniqueId ?? '' }}" name="secure_blurr_content-{{ $count++ }}">
                                                                                <label class="custom-control-label" for="secure_blurr_content{{ $uniqueId ?? '' }}">Secure Blurr Content</label>
                                                                                @endif
                                                                           @else
                                                                           <input type="checkbox" class="custom-control-input" id="secure_blurr_content{{ $uniqueId ?? '' }}" name="secure_blurr_content-{{ $count++ }}">
                                                                           <label class="custom-control-label" for="secure_blurr_content{{ $uniqueId ?? '' }}">Secure Blurr Content</label>
                                                                           @endif
                                                                           </div>
                                                                      </div>
                                                                      <div class="col-md-6">
                                                                           <p class="p_label">Blurr Content</p>
                                                                           <div class="custom-control custom-checkbox">
                                                                           @if(isset($data->blur_content) && $data->blur_content != null)
                                                                                @if($data->blur_content == '1')
                                                                                <input type="checkbox" class="custom-control-input" id="blurr_content{{ $uniqueId ?? '' }}" name="blurr_content-{{ $count++ }}">
                                                                                <label class="custom-control-label" for="blurr_content{{ $uniqueId ?? '' }}">Blurr Content</label>
                                                                                @else
                                                                                <input type="checkbox" class="custom-control-input" id="blurr_content{{ $uniqueId ?? '' }}" name="blurr_content-{{ $count++ }}">
                                                                                <label class="custom-control-label" for="blurr_content{{ $uniqueId ?? '' }}">Blurr Content</label>
                                                                                @endif
                                                                           @else
                                                                                <input type="checkbox" class="custom-control-input" id="blurr_content{{ $uniqueId ?? '' }}" name="blurr_content-{{ $count++ }}">
                                                                                <label class="custom-control-label" for="blurr_content{{ $uniqueId ?? '' }}">Blurr Content</label>
                                                                           @endif
                                                                           </div>
                                                                      </div>
                                                                 </div>
                                                            </div>
                                                       </div>
                                                  </div>
                                                  @endif
                                             @endforeach
                                        @endif
                                   </div>
                                   <br>
                                   <div class="text-end">
                                        <button type="button" class="btn btn-primary question_dropbtn" onclick="toggleDropdown()">Add Content</button>
                                        <div class="form-group question_dropdown"> 
                                             <div id="" class="question_dropdown-content">
                                                  <a onclick="addContent('content_heading')">Content Heading</a>
                                                  <a onclick="addContent('content')">Content</a>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                         </div>
                    </div>
                    <div class="col md-4 right-content">
                         <div class="card card-bordered card-preview">
                              <div class="card-inner">
                                   <!-- <div class="col-md-12">
                                        <div class="form-group">
                                             <p>Published</p>
                                             <div class="custom-control custom-switch">
                                                  <input type="checkbox" class="custom-control-input publish" id="publish1">
                                                  <label class="custom-control-label" for="publish1"></label>
                                             </div>
                                        </div>
                                   </div> -->
                                   <div class="col-md-12 mt-2">
                                        <div class="form-group">
                                             <label class="form-label" for="document_id">Select Document</label>  
                                             <div class="form-control-wrap"> 
                                                  <select class="form-select js-select2" name="document_id" id="document_id">
                                                       <option value=""></option>
                                                       @if(isset($documents) && $documents != null)
                                                       @foreach($documents as $document)
                                                            @if(isset($document_id) && $document_id != null)
                                                                 @if($document->id == $document_id)
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
                                   </div>
                                   <div class="d-flex justify-content-end mt-2">
                                        <div class="nk-block-head-content">
                                             <div class="up-btn mbsc-form-group">
                                             @if(isset($documentRight) && $documentRight != null)
                                                  <button class="btn btn-sm btn-primary" type="button" id="updateFormdata">Update</button>
                                             @else
                                                  <button class="btn btn-sm btn-primary" type="button" id="saveFormdata">Save</button>
                                             @endif
                                             </div>
                                        </div>
                                   </div> 
                              </div> 
                         </div>
                    </div>
               </div>
          </form>
     </div>
</div>

<script>
     function toggleDropdown() {
          const isClass = $('.question_dropdown-content').hasClass('show');

          if(!isClass){
               $('.question_dropdown-content').addClass('show');
          }else{
               $('.question_dropdown-content').removeClass('show');
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

     let heading_section_count = 0;
     let content_section_count = 0;
     function addContent(name){
          const newUniqueId = Date.now();
          let html = ``;
          if(name === 'content_heading'){
               heading_section_count++ ;
               // let value = name+'-'+heading_section_count;
               // let type =  $('#heading_type').val();
               // if(type){
               //      type += ',' + value;
               // }else{
               //      type = value;
               // }
               // $('#heading_type').val(type);

               html = `<div class="append_content_heading" id="content_heading${heading_section_count}" value="appended" data-is_new="true">
                    <hr>
                    <div class="card card-bordered card-preview">
                         <div class="card-inner">
                              <div class="row add_content_heading">
                                   <div class="col-md-6">
                                        <h6>Content Heading</h6>  
                                   </div> 
                                   <div class="col-md-6">
                                        <div class="form-group">
                                             <span class="col-md-2 offset-md-10">
                                                  <span onclick="removeContent(this)" value="appended" data-field="content_heading"><i class="fa-solid fa-minus"></i></span>
                                             </span>  
                                        </div>
                                   </div>
                              </div> 
                              <hr>
                              <div class="col-md-12">
                                   <div class="form-group">
                                        <label class="form-label" for="content_heading_html${newUniqueId}">Content Html</label>
                                        <label class="form-label" for="content_heading_html${newUniqueId}">Content Html</label>
                                        <input type="text" class="form-control" name="content_heading_html-${heading_section_count}" id="content_heading_html${newUniqueId}" value="">
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>`
               
          }else if(name === 'content'){
               content_section_count++ ;
               // let value = name+'-'+content_section_count;
               // let type =  $('#content_type').val();
               // if(type){
               //      type += ',' + value;
               // }else{
               //      type = value;
               // }

               // $('#content_type').val(type);

               html = `<div class="append_content" id="content${content_section_count}" value="appended" data-is_new="true">
                    <hr>
                    <div class="card card-bordered card-preview">
                         <div class="card-inner">
                              <div class="row">
                                   <div class="col-md-6">
                                        <h6>Content</h6>  
                                   </div> 
                                   <div class="col-md-6">
                                        <div class="form-group">
                                             <span class="col-md-2 offset-md-10">
                                                  <span onclick="removeContent(this)" value="appended" data-field="content"><i class="fa-solid fa-minus"></i></span>
                                             </span>  
                                        </div>
                                   </div>
                              </div> 
                              <hr>
                              <div class="col-md-12">
                                   <div class="form-group">
                                        <label class="form-label" for="">Start New Section</label>
                                   </div>
                              </div>
                              <div class="custom-control custom-checkbox">
                                   <input type="checkbox" class="custom-control-input" id="start_new_section${newUniqueId}" name="start_new_section-${content_section_count}">
                                   <label class="custom-control-label" for="start_new_section${newUniqueId}"></label>
                              </div>
                              <hr>
                              <div class="start_append_section${newUniqueId}" style="display:none;">
                                   <div class="row">
                                        <div class="col-md-6">
                                             <div class="form-group">
                                                  <label class="form-label" for="text_align">Text align</label>
                                                  <div class="form-control-wrap"> 
                                                       <select class="form-select js-select2" name="text_align-${content_section_count}" id="text_align">
                                                            <option value=""></option>
                                                            <option value="left">left</option>
                                                            <option value="right">right</option>
                                                            <option value="center">center</option>
                                                       </select>
                                                  </div>
                                             </div>
                                        </div>
                                        <div class="col-md-6">
                                             <p class="p_label">This is signature field</p>
                                             <div class="custom-control custom-checkbox">
                                                  <input type="checkbox" class="custom-control-input" id="signature_field${newUniqueId}" name="signature_field-${content_section_count}">
                                                  <label class="custom-control-label" for="signature_field${newUniqueId}"></label>
                                             </div>
                                        </div>
                                   </div>
                                   <hr>
                              </div>
                              <div class="col-md-12">
                                   <div class="form-group">
                                        <label class="form-label" for="content_content_html">Content Html</label>
                                        <textarea class="form-control" name="content_content_html-${content_section_count}" id="content_content_html"></textarea>
                                   </div>
                              </div>
                              <hr>
                              <div class="row">
                                   <div class="col-md-6">
                                        <div class="form-group">
                                             <label class="form-label" for="content_class">Content Class</label>
                                             <input type="text" class="form-control" name="content_class-${content_section_count}" id="content_class" value="">
                                        </div>
                                   </div>
                                   <div class="col-md-6">
                                        <p class="p_label">Add Condition</p>
                                        <div class="custom-control custom-checkbox">
                                             <input type="checkbox" class="custom-control-input" id="add_condition${newUniqueId}" name="add_condition-${content_section_count}">
                                             <label class="custom-control-label" for="add_condition${newUniqueId}"></label>
                                        </div>
                                   </div>
                              </div>
                              <hr>
                              <div class="add_condition_section${newUniqueId}" style="display:none;">
                                   <div class="col-md-12">
                                        <p class="p_label">Add Content Html Condition</p> 
                                   </div>
                                   <div class="append_condition" id="append_condition${newUniqueId}"></div>
                                   <div class="text-end">
                                        <div class="form-group">
                                             <button type="button" class="btn btn-sm btn-primary" onclick="addCondition('${newUniqueId}','${content_section_count}')">Add Condition</button>
                                        </div>
                                   </div>
                                   <hr>
                              </div>
                              <div class="row">
                                   <div class="col-md-6">
                                        <p class="p_label">Secure Blurr Content</p>
                                        <div class="custom-control custom-checkbox">
                                             <input type="checkbox" class="custom-control-input" id="secure_blurr_content${newUniqueId}" name="secure_blurr_content-${content_section_count}">
                                             <label class="custom-control-label" for="secure_blurr_content${newUniqueId}">Secure Blurr Content</label>
                                        </div>
                                   </div>
                                   <div class="col-md-6">
                                        <p class="p_label">Blurr Content</p>
                                        <div class="custom-control custom-checkbox">
                                             <input type="checkbox" class="custom-control-input" id="blurr_content${newUniqueId}" name="blurr_content-${content_section_count}">
                                             <label class="custom-control-label" for="blurr_content${newUniqueId}">Blurr Content</label>
                                        </div>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>`
          }

          $('.add_contents').append(html);

          // conditionalOptions(newUniqueId);

          // $('#add_condition'+newUniqueId).change(function(){
          //      conditionalOptions(newUniqueId);
          // });

          // startNewSection(newUniqueId);

          // $('#start_new_section'+newUniqueId).change(function(){
          //      startNewSection(newUniqueId);
          // });

          // $('#signature_field'+newUniqueId).change(function(){
          //      var status = false;
          //      if($('#signature_field'+newUniqueId).is(':checked')){
          //           status = $('#signature_field'+newUniqueId).is(':checked');
          //           $('#signature_field'+newUniqueId).val(1);
          //      }else{
          //           status = $('#signature_field'+newUniqueId).is(':checked');
          //           $('#signature_field'+newUniqueId).val(0);
          //      }
          // })

          // $('#add_condition'+newUniqueId).change(function(){
          //      var status = false;
          //      if($('#add_condition'+newUniqueId).is(':checked')){
          //           status = $('#add_condition'+newUniqueId).is(':checked');
          //           $('#add_condition'+newUniqueId).val(1);
          //      }else{
          //           status = $('#add_condition'+newUniqueId).is(':checked');
          //           $('#add_condition'+newUniqueId).val(0);
          //      }
          // })

          // $('#secure_blurr_content'+newUniqueId).change(function(){
          //      var status = false;
          //      if($('#secure_blurr_content'+newUniqueId).is(':checked')){
          //           status = $('#secure_blurr_content'+newUniqueId).is(':checked');
          //           $('#secure_blurr_content'+newUniqueId).val(1);
          //      }else{
          //           status = $('#secure_blurr_content'+newUniqueId).is(':checked');
          //           $('#secure_blurr_content'+newUniqueId).val(0);
          //      }
          // })

          // $('#blurr_content'+newUniqueId).change(function(){
          //      var status = false;
          //      if($('#blurr_content'+newUniqueId).is(':checked')){
          //           status = $('#blurr_content'+newUniqueId).is(':checked');
          //           $('#blurr_content'+newUniqueId).val(1);
          //      }else{
          //           status = $('#blurr_content'+newUniqueId).is(':checked');
          //           $('#blurr_content'+newUniqueId).val(0);
          //      }
          // })
     }


     function removeContent(e){
          if($(e).attr('data-field') === 'content_heading'){
               if($(e).attr('value') === 'appended'){
                    console.log('yes');
                    $(e).closest('.append_content_heading').remove();
               }else{
                    console.log('no');
                    var id = $(e).attr('data-id');
                    let deleteIds = $('#remove_content_heading').val();
                    if(deleteIds){
                         deleteIds += ',' + id;
                    }else{
                         deleteIds = id;
                    }
                    $('#remove_content_heading').val(deleteIds);
                    $('#content_heading'+id).hide();
               }
          }else if($(e).attr('data-field') === 'content'){
               if($(e).attr('value') === 'appended'){
                    $(e).closest('.append_content').remove();
               }else{
                    var id = $(e).attr('data-id');
                    let deleteIds = $('#remove_content').val();
                    if(deleteIds){
                         deleteIds += ',' + id;
                    }else{
                         deleteIds = id;
                    }
                    $('#remove_content').val(deleteIds);
                    $('#content'+id).hide();
               }
          }
     }

     function addCondition(id,num){
          const html = `<div class="condition-section" id="condition-section" value="appended">
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
                                        <label class="form-label" for="condition_question_id">Question ID</label>
                                        <input type="text" class="form-control" id="condition_question_id" name="condition_question_id-${num}[]" value="">
                                   </div>
                              </div>
                              <div class="col-md-4">
                                   <div class="form-group">
                                        <label class="form-label" for="conditions">Condition</label>
                                        <div class="form-control-wrap"> 
                                             <select class="form-select js-select2" name="conditions-${num}[]" id="conditions">
                                                  <option value=""></option>
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
                                        <label class="form-label" for="condition_question_value">Question Value</label>
                                        <input type="text" class="form-control" id="condition_question_value" name="condition_question_value-${num}[]" value="">
                                   </div>
                              </div>
                         </div>
                         <br>
                    </div>`
          $('#append_condition'+id).append(html);
     }

     function removeCondition(e){
          if($(e).attr('value') === 'appended'){
               $(e).closest('.condition-section').remove();
          }else{
               var id = $(e).attr('data-id');
               let deleteIds = $('#remove_condition').val();
               if(deleteIds){
                    deleteIds += ',' + id;
               }else{
                    deleteIds = id;
               }
               $('#remove_condition').val(deleteIds);
               $('#condition-section'+id).hide();
          }
     }

     // function conditionalOptions(id){
     //      if($('#add_condition'+id).is(':checked')){
     //           $('.add_condition_section'+id).show();
     //      }else{
     //           $('.add_condition_section'+id).hide();
     //      }
     // }
     
     // function startNewSection(id){
     //      let status = false;
     //      if($('#start_new_section'+id).is(':checked')){
     //           status = $('#start_new_section'+id).is(':checked');
     //           $('#start_new_section'+id).val(1);
     //           $('.start_append_section'+id).show();
     //      }else{
     //           status = $('#start_new_section'+id).is(':checked');
     //           $('#start_new_section'+id).val(0);
     //           $('.start_append_section'+id).hide();
     //      }
     // }


     $(document).ready(function() {
          $(document).on('change', '[id^="add_condition"]', function() {
               const id = $(this).attr('id').replace('add_condition', '');
               conditionalOptions(id);
          });

          $(document).on('change', '[id^="start_new_section"]', function() {
               const id = $(this).attr('id').replace('start_new_section', '');
               startNewSection(id);
          });

          $(document).on('change', '[id^="signature_field"]', function() {
               const id = $(this).attr('id').replace('signature_field', '');
               toggleCheckboxValue($(this), 'signature_field' + id);
          });

          $(document).on('change', '[id^="secure_blurr_content"]', function() {
               const id = $(this).attr('id').replace('secure_blurr_content', '');
               toggleCheckboxValue($(this), 'secure_blurr_content' + id);
          });

          $(document).on('change', '[id^="blurr_content"]', function() {
               const id = $(this).attr('id').replace('blurr_content', '');
               toggleCheckboxValue($(this), 'blurr_content' + id);
          });
     });

     function conditionalOptions(id) {
          if ($('#add_condition' + id).is(':checked')) {
               $('.add_condition_section' + id).show();
               $('#add_condition' + id).val(1);
          } else {
               $('.add_condition_section' + id).hide();
               $('#add_condition' + id).val(0);
          }
     }

     function startNewSection(id) {
          if ($('#start_new_section' + id).is(':checked')) {
               $('.start_append_section' + id).show();
               $('#start_new_section' + id).val(1);
          } else {
               $('.start_append_section' + id).hide();
               $('#start_new_section' + id).val(0);
          }
     }

     function toggleCheckboxValue(element, id) {
          if (element.is(':checked')) {
               $('#' + id).val(1);
          } else {
               $('#' + id).val(0);
          }
     }
</script>

<script>

     function getAllContents() {
          var contents = [];
          var order = 1;

          $('.add_contents .append_content_heading').each(function(){
               // var contentHeadingId = $(this).attr('id');
               var headingInputValue = $(this).find('input[type="text"]').val();
               
               contents.push({
                    section: 'content_heading',
                    heading_html: headingInputValue,
                    order: order++
               });
          });
         
          $('.add_contents .append_content').each(function(){
               // var contentId = $(this).attr('id');
               var startNewSection = $(this).find('input[name^="start_new_section"]').is(':checked') ? 1 : 0;
               var textAlign = $(this).find('select[name^="text_align"]').val();
               var signatureField = $(this).find('input[name^="signature_field"]').is(':checked') ? 1 : 0;
               var contentHtml = $(this).find('textarea[name^="content_content_html"]').val();
               var contentClass = $(this).find('input[name^="content_class"]').val();
               var addCondition = $(this).find('input[name^="add_condition"]').is(':checked') ? 1 : 0;
               var secureBlurrContent = $(this).find('input[name^="secure_blurr_content"]').is(':checked') ? 1 : 0;
               var blurrContent = $(this).find('input[name^="blurr_content"]').is(':checked') ? 1 : 0;

               var contentData = {
                    section: 'content',
                    start_new_section: startNewSection,
                    text_align: textAlign,
                    signature_field: signatureField,
                    content_html: contentHtml,
                    content_class: contentClass,
                    add_condition: addCondition,
                    secure_blurr_content: secureBlurrContent,
                    blurr_content: blurrContent,
                    order: order++,
                    conditions: []
               };

               if(addCondition){
                    $(this).find('.append_condition .condition-section').each(function() {
                         var condition = {
                              question_id: $(this).find('input[name^="condition_question_id"]').val(),
                              condition: $(this).find('select[name^="conditions"]').val(),
                              question_value: $(this).find('input[name^="condition_question_value"]').val()
                         };
                    
                         if(condition.question_id || condition.condition || condition.question_value){
                              contentData.conditions.push(condition);
                         }
                    });
               }
               contents.push(contentData);
          });
          console.log(contents);
          return contents;
     }

     $(document).ready(function() {
          $('#saveFormdata').click(function() {
               var data = getAllContents();
               data = JSON.stringify(data);
               $('#formdata').val(data);
               // $('#contentForm').submit();
          });

          // $('#updateFormdata').click(function() {
          //      var data = getAllContents();
          //      data = JSON.stringify(data);
          //      $('#formdata').val(data);
          //      // $('#updatecontentForm').submit();
          // });

          var switchStatus = false;
          $(".publish").on('change', function() {
               if($(this).is(':checked')) {
                    switchStatus = $(this).is(':checked');
                    $('#published').val(1);
               }else{
                    switchStatus = $(this).is(':checked');
                    $('#published').val(0);
               }
          })
     });

</script>

<script>
     function getAllDynamicContents(){
          var update_contents = [];
          var order = 1;

          $('.add_contents .append_content_heading').each(function(){
               // var contentHeadingId = $(this).attr('id');
               var headingInputValue = $(this).find('input[type="text"]').val();
               
               update_contents.push({
                    section: 'content_heading',
                    heading_html: headingInputValue,
                    order: order++
               });
          });
         
          $('.add_contents .append_content').each(function(){
               // var contentId = $(this).attr('id');
               var startNewSection = $(this).find('input[name^="start_new_section"]').is(':checked') ? 1 : 0;
               var textAlign = $(this).find('select[name^="text_align"]').val();
               var signatureField = $(this).find('input[name^="signature_field"]').is(':checked') ? 1 : 0;
               var contentHtml = $(this).find('textarea[name^="content_content_html"]').val();
               var contentClass = $(this).find('input[name^="content_class"]').val();
               var addCondition = $(this).find('input[name^="add_condition"]').is(':checked') ? 1 : 0;
               var secureBlurrContent = $(this).find('input[name^="secure_blurr_content"]').is(':checked') ? 1 : 0;
               var blurrContent = $(this).find('input[name^="blurr_content"]').is(':checked') ? 1 : 0;

               var contentData = {
                    section: 'content',
                    start_new_section: startNewSection,
                    text_align: textAlign,
                    signature_field: signatureField,
                    content_html: contentHtml,
                    content_class: contentClass,
                    add_condition: addCondition,
                    secure_blurr_content: secureBlurrContent,
                    blurr_content: blurrContent,
                    order: order++,
                    conditions: []
               };

               if(addCondition){
                    $(this).find('.append_condition .condition-section').each(function() {
                         var condition = {
                              question_id: $(this).find('input[name^="condition_question_id"]').val(),
                              condition: $(this).find('select[name^="conditions"]').val(),
                              question_value: $(this).find('input[name^="condition_question_value"]').val()
                         };
                    
                         if(condition.question_id || condition.condition || condition.question_value){
                              contentData.conditions.push(condition);
                         }
                    });
               }
               update_contents.push(contentData);
          });
          console.log(update_contents);
          return update_contents;
     }

     $(document).ready(function() {
          $('#updateFormdata').click(function() {
               var data = getAllContents();
               data = JSON.stringify(data);
               $('#formdata').val(data);
               // $('#updatecontentForm').submit();
          });
     });

</script>

@endsection