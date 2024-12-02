@extends('admin_layout.master')
@section('content')

@php use Carbon\Carbon; @endphp
<div class="nk-content">
     <div class="container-fluid">
          <form action="{{ url('/admin-dashboard/update-document-right-content') }}" id="updatecontentForm" method="post" enctype="multipart/form-data">
               @csrf
               <input type="hidden" id="published" name="published" value="">
               <input type="hidden" id="remove_content_heading" name="remove_content_heading" value="">
               <input type="hidden" id="remove_content" name="remove_content" value="">
               <input type="hidden" id="remove_condition" name="remove_condition" value="">
               <input type="hidden" id="formdata" name="formdata" value="">
               <input type="hidden" id="document_id" name="document_id" value="{{ $_GET['id'] ?? '' }}">

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
                         @error('title')
                              <span class="text-danger">{{ $message }}</span>
                         @enderror
                         <span class="text-danger validation_error"></span>
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
                              <a href="{{ url('admin-dashboard/document-questions/?id='.$_GET['id']) }}" class="btn tab_btn" target="_blank">Document questions</a>
                              @else
                              <a href="{{ url('admin-dashboard/document-questions/') }}" class="btn tab_btn" target="_blank">Document questions</a>
                              @endif
                              @if(isset($_GET['id']) && $_GET['id'] != null)
                              <a href="{{ url('admin-dashboard/document-right-content/?id='.$_GET['id']) }}" class="btn tab_btn active">Document Text</a>
                              @else
                              <a href="{{ url('admin-dashboard/document-right-content/') }}" class="btn tab_btn active">Document Text</a>
                              @endif
                         </div>
                    </div>
               </div>
               <div class="row main_section mt-4">
                    <div class="col col-md-8 left-content">
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
                                                  <div class="append_content_heading" id="content_heading{{ $data->id ?? '' }}" data-id="{{ $data->id ?? '' }}" data-is_new=false>
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
                                                                           <input type="text" class="form-control content_heading_html" name="content_heading_html-{{ $count++ }}" id="content_heading_html{{ $uniqueId ?? '' }}" value="{{ $data->content ?? '' }}">
                                                                      </div>
                                                                 </div>
                                                            </div>
                                                       </div>
                                                  </div>
                                                  @elseif($data->type == 'content')
                                                  <div class="append_content" id="content{{ $data->id ?? '' }}" data-id="{{ $data->id ?? '' }}" data-is_new=false>
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
                                                                 <!-- <div class="col-md-12">
                                                                      <div class="form-group">
                                                                           <label class="form-label" for="">Start New Section</label>
                                                                      </div>
                                                                 </div>
                                                                 <div class="custom-control custom-checkbox">
                                                                 @if(isset($data->start_new_section) && $data->start_new_section != null)
                                                                      @if($data->start_new_section == '1')
                                                                      <input type="checkbox" class="custom-control-input new_section" id="start_new_section{{ $data->id ?? '' }}" name="start_new_section-{{ $count++ }}" checked>
                                                                      <label class="custom-control-label" for="start_new_section{{ $data->id ?? '' }}"></label>
                                                                      @else
                                                                      <input type="checkbox" class="custom-control-input new_section" id="start_new_section{{ $data->id ?? '' }}" name="start_new_section-{{ $count++ }}">
                                                                      <label class="custom-control-label" for="start_new_section{{ $data->id ?? '' }}"></label>
                                                                      @endif
                                                                 @else
                                                                      <input type="checkbox" class="custom-control-input new_section" id="start_new_section{{ $data->id ?? '' }}" name="start_new_section-{{ $count++ }}">
                                                                      <label class="custom-control-label" for="start_new_section{{ $data->id ?? '' }}"></label>
                                                                 @endif
                                                                 </div>
                                                                 <hr> -->
                                                                 @if(isset($data->text_alignment) && $data->text_alignment != null)
                                                                 <div class="start_append_section{{ $data->id ?? '' }}" style="display:block">
                                                                      <div class="row">
                                                                           <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                     <label class="form-label" for="text_align">Text align</label>
                                                                                     <div class="form-control-wrap"> 
                                                                                          <select class="form-select js-select2" name="text_align-{{ $count++ }}" id="text_align">
                                                                                               <option value="" selected disabled>Select</option>
                                                                                               @if(isset($data->text_alignment) && $data->text_alignment != null)
                                                                                                    @if($data->text_alignment == 'left')
                                                                                                    <option value="left" selected>left</option>
                                                                                                    @else
                                                                                                    <option value="left">left</option>
                                                                                                    @endif

                                                                                                    @if($data->text_alignment == 'right')
                                                                                                    <option value="right" selected>right</option>
                                                                                                    @else
                                                                                                    <option value="right">right</option>
                                                                                                    @endif

                                                                                                    @if($data->text_alignment == 'center')
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
                                                                           <!-- <div class="col-md-6">
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
                                                                           </div> -->
                                                                      </div>
                                                                      <hr>
                                                                 </div>
                                                                 @else
                                                                 <div class="start_append_section{{ $data->id ?? '' }}">
                                                                      <div class="row">
                                                                           <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                     <label class="form-label" for="text_align">Text align</label>
                                                                                     <div class="form-control-wrap"> 
                                                                                          <select class="form-select js-select2 text_align" name="text_align-{{ $count++ }}" id="text_align">
                                                                                               <option value="" selected disabled>Select</option>
                                                                                               <option value="left">left</option>
                                                                                               <option value="right">right</option>
                                                                                               <option value="center">center</option>
                                                                                          </select>
                                                                                     </div>
                                                                                </div>
                                                                           </div>
                                                                           <!-- <div class="col-md-6">
                                                                                <p class="p_label">This is signature field</p>
                                                                                <div class="custom-control custom-checkbox">
                                                                                     <input type="checkbox" class="custom-control-input" id="signature_field" name="signature_field-{{ $count++ }}">
                                                                                     <label class="custom-control-label" for="signature_field"></label>
                                                                                </div>
                                                                           </div> -->
                                                                      </div>
                                                                      <hr>
                                                                 </div>
                                                                 @endif
                                                                 <div class="col-md-12">
                                                                      <div class="form-group">
                                                                           <label class="form-label" for="content_content_html">Content Html</label>
                                                                           <textarea class="form-control content_content_html" name="content_content_html-{{ $count++ }}" id="content_content_html">{{ $data->content ?? '' }}</textarea>
                                                                      </div>
                                                                 </div>
                                                                 <hr>
                                                                 <div class="row">
                                                                      <div class="col-md-6">
                                                                           <p class="p_label">Add Condition</p>
                                                                           <div class="custom-control custom-checkbox">
                                                                           @if(isset($data->is_condition) && $data->is_condition != null)
                                                                                @if($data->is_condition == '1')
                                                                                     <input type="checkbox" class="custom-control-input add_condition" id="add_condition{{ $data->id ?? '' }}" name="add_condition-{{ $count++ }}" checked>
                                                                                     <label class="custom-control-label" for="add_condition{{ $data->id ?? '' }}"></label>
                                                                                @else
                                                                                     <input type="checkbox" class="custom-control-input add_condition" id="add_condition{{ $data->id ?? '' }}" name="add_condition-{{ $count++ }}">
                                                                                     <label class="custom-control-label" for="add_condition{{ $data->id ?? '' }}"></label>
                                                                                @endif
                                                                           @else
                                                                                <input type="checkbox" class="custom-control-input add_condition" id="add_condition{{ $data->id ?? '' }}" name="add_condition-{{ $count++ }}">
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
                                                                           <div class="condition-section" id="condition-section{{ $qu_conditions->id ?? '' }}" data-id="{{ $qu_conditions->id ?? '' }}" data-is_new=false>
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
                                                                                               <label class="form-label" for="condition_question_id-{{ $count++ }}">Question ID</label>
                                                                                               <div class="form-control-wrap"> 
                                                                                                    <select class="form-select js-select2" data-search="on" name="condition_question_id-{{ $count++ }}[]" id="condition_question_id-{{ $count++ }}">
                                                                                                         @if(isset($questions) && $questions != null)
                                                                                                              @foreach($questions as $question)
                                                                                                                   <option value="{{ $question->getName() }}" 
                                                                                                                        {{ isset($qu_conditions->conditional_question_id) && $qu_conditions->conditional_question_id == $question->getName() ? 'selected' : '' }}>
                                                                                                                        {{ $question->getName() }}
                                                                                                                   </option>
                                                                                                              @endforeach
                                                                                                         @endif
                                                                                                    </select>
                                                                                               </div>
                                                                                          </div>
                                                                                     </div>
                                                                                     <div class="col-md-4">
                                                                                          <div class="form-group">
                                                                                               <label class="form-label" for="conditions-{{ $count++ }}">Condition</label>
                                                                                               <div class="form-control-wrap"> 
                                                                                                    <select class="form-select js-select2" name="conditions-{{ $count++ }}[]" id="conditions-{{ $count++ }}">
                                                                                                         <option value="" selected disabled>Select</option>
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
                                                                                               <label class="form-label" for="condition_question_value-{{ $count++ }}">Question Value</label>
                                                                                               <input type="text" class="form-control" id="condition_question_value-{{ $count++ }}" name="condition_question_value-{{ $count++ }}[]" value="{{ $qu_conditions->conditional_question_value ?? '' }}">
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
                                                                                <button type="button" class="btn btn-sm btn-primary" onclick="addCondition('{{ $data->id ?? '' }}')">Add Condition</button>
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
                                                                                <button type="button" class="btn btn-sm btn-primary" onclick="addCondition('{{ $data->id ?? '' }}')">Add Condition</button>
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
                                                                      <!-- <div class="col-md-6">
                                                                           <p class="p_label">Blurr Content</p>
                                                                           <div class="custom-control custom-checkbox">
                                                                           @if(isset($data->blur_content) && $data->blur_content != null)
                                                                                @if($data->blur_content == '1')
                                                                                <input type="checkbox" class="custom-control-input" id="blurr_content{{ $uniqueId ?? '' }}" name="blurr_content-{{ $count++ }}" checked>
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
                                                                      </div> -->
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
                    <div class="col col-md-4 right-content">
                         <div class="card card-bordered card-preview">
                              <div class="card-inner">
                                   <div class="d-flex justify-content-end">
                                        <div class="nk-block-head-content">
                                             <div class="up-btn mbsc-form-group">
                                                  @if(isset($_GET['id']) && $_GET['id'] != null)
                                                  <button class="btn btn-sm btn-primary" type="button" id="updateFormdata">Update</button>
                                                  @else
                                                  <button class="btn btn-sm btn-primary" type="button" id="saveFormdata">Save</button>
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
                              </div> 
                         </div>
                    </div>
               </div>
          </form>
     </div>
</div>

<script>
     $(document).ready(function() {
          $('.js-select2').select2({
               placeholder: 'Select a question',
               allowClear: true
          });
     });
</script>

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
               html = `<div class="append_content_heading" id="content_heading${heading_section_count}" value="appended" data-is_new=true>
                    <hr>
                    <div class="card card-bordered card-preview">
                         <div class="card-inner">
                              <div class="row add_content_heading">
                                   <div class="col-md-6">
                                        <h6>Content Heading</h6>  
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
                                                  <span onclick="removeContent(this)" value="appended" data-field="content_heading"><i class="fa-solid fa-minus"></i></span>
                                             </span>  
                                        </div>
                                   </div>
                              </div> 
                              <hr>
                              <div class="col-md-12">
                                   <div class="form-group">
                                        <label class="form-label" for="content_heading_html${newUniqueId}">Content Html</label>
                                        <input type="text" class="form-control new_heading_html" name="content_heading_html-${heading_section_count}" id="content_heading_html${newUniqueId}" value="">
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>`
               
          }else if(name === 'content'){
               content_section_count++ ;

               html = `<div class="append_content" id="content${content_section_count}" value="appended" data-is_new=true>
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
                              <!-- <div class="col-md-12">
                                   <div class="form-group">
                                        <label class="form-label" for="">Start New Section</label>
                                   </div>
                              </div>
                              <div class="custom-control custom-checkbox">
                                   <input type="checkbox" class="custom-control-input new_section" id="start_new_section${newUniqueId}" name="start_new_section-${content_section_count}">
                                   <label class="custom-control-label" for="start_new_section${newUniqueId}"></label>
                              </div>
                              <hr> -->
                              <div class="start_append_section${newUniqueId} text-section">
                                   <div class="row">
                                        <div class="col-md-6">
                                             <div class="form-group">
                                                  <label class="form-label" for="text_align">Text align</label>
                                                  <div class="form-control-wrap"> 
                                                       <select class="form-select js-select2 text_align" name="text_align-${content_section_count}" id="text_align">
                                                            <option value="" selected disabled>Select</option>
                                                            <option value="left">left</option>
                                                            <option value="right">right</option>
                                                            <option value="center">center</option>
                                                       </select>
                                                  </div>
                                             </div>
                                        </div>
                                        <!-- <div class="col-md-6">
                                             <p class="p_label">This is signature field</p>
                                             <div class="custom-control custom-checkbox">
                                                  <input type="checkbox" class="custom-control-input" id="signature_field${newUniqueId}" name="signature_field-${content_section_count}">
                                                  <label class="custom-control-label" for="signature_field${newUniqueId}"></label>
                                             </div>
                                        </div> -->
                                   </div>
                                   <hr>
                              </div>
                              <div class="col-md-12">
                                   <div class="form-group">
                                        <label class="form-label" for="content_content_html">Content Html</label>
                                        <textarea class="form-control new_content_html" name="content_content_html-${content_section_count}" id="content_content_html"></textarea>
                                   </div>
                              </div>
                              <hr>
                              <div class="row">
                                   <div class="col-md-6">
                                        <p class="p_label">Add Condition</p>
                                        <div class="custom-control custom-checkbox">
                                             <input type="checkbox" class="custom-control-input add_condition" id="add_condition${newUniqueId}" name="add_condition-${content_section_count}">
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
                                             <button type="button" class="btn btn-sm btn-primary" onclick="addCondition('${newUniqueId}')">Add Condition</button>
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
                                   <!-- <div class="col-md-6">
                                        <p class="p_label">Blurr Content</p>
                                        <div class="custom-control custom-checkbox">
                                             <input type="checkbox" class="custom-control-input" id="blurr_content${newUniqueId}" name="blurr_content-${content_section_count}">
                                             <label class="custom-control-label" for="blurr_content${newUniqueId}">Blurr Content</label>
                                        </div>
                                   </div> -->
                              </div>
                         </div>
                    </div>
               </div>`
          }

          $('.add_contents').append(html);
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

     let condition_count = 0;
     function addCondition(id){
          condition_count++ ; 

          const html = `<div class="condition-section" id="condition-section" value="appended" data-is_new=true>
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
                                        <label class="form-label" for="new_condition_question_id-${condition_count}">Question ID</label>
                                        <div class="form-control-wrap question"> 
                                             <select class="form-select js-select2 new_condition_question_id" data-search="on" name="new_condition_question_id-${condition_count}[]" id="new_condition_question_id-${condition_count}">
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
                                        <label class="form-label" for="new_conditions-${condition_count}">Condition</label>
                                        <div class="form-control-wrap"> 
                                             <select class="form-select js-select2 new_conditions" name="new_conditions-${condition_count}[]" id="new_conditions-${condition_count}">
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
                                        <label class="form-label" for="new_condition_question_value-${condition_count}">Question Value</label>
                                        <input type="text" class="form-control new_condition_question_value" id="new_condition_question_value-${condition_count}" name="new_condition_question_value-${condition_count}[]" value="">
                                   </div>
                              </div>
                         </div>
                         <br>
                    </div>`
          $('#append_condition'+id).append(html);

          $('.js-select2').select2();
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

     // function startNewSection(id) {
     //      if ($('#start_new_section' + id).is(':checked')) {
     //           $('.start_append_section' + id).show();
     //           $('#start_new_section' + id).val(1);
     //      } else {
     //           $('.start_append_section' + id).hide();
     //           $('#start_new_section' + id).val(0);
     //      }
     // }

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

     $('.add_contents .append_content_heading').each(function(){
          var is_new = $(this).data('is_new');
          var id = $(this).data('id');
          var headingInputValue = $(this).find('input[type="text"]').val();

          contents.push({
               section: 'content_heading',
               id: id,
               is_new: is_new,
               heading_html: headingInputValue,
          });
     });

     $('.add_contents .append_content').each(function(){
          var is_new = $(this).data('is_new');
          var id = $(this).data('id');

          // var startNewSection = $(this).find('input[name^="start_new_section"]').is(':checked') ? 1 : 0;
          var textAlign = $(this).find('select[name^="text_align"]').val() || ''; 
          // var signatureField = $(this).find('input[name^="signature_field"]').is(':checked') ? 1 : 0;
          var contentHtml = $(this).find('textarea[name^="content_content_html"]').val();
          var contentClass = $(this).find('input[name^="content_class"]').val() || '';
          var addCondition = $(this).find('input[name^="add_condition"]').is(':checked') ? 1 : 0;
          var secureBlurrContent = $(this).find('input[name^="secure_blurr_content"]').is(':checked') ? 1 : 0;
          // var blurrContent = $(this).find('input[name^="blurr_content"]').is(':checked') ? 1 : 0;

          var contentData = {
               section: 'content',
               is_new: is_new,
               id: id,
               // start_new_section: startNewSection,
               text_align: textAlign,
               // signature_field: signatureField,
               content_html: contentHtml,
               content_class: contentClass,
               add_condition: addCondition,
               secure_blurr_content: secureBlurrContent,
               // blurr_content: blurrContent,
               conditions: [],
               new_conditions: [],
          };

          if(addCondition){
               $(this).find('.append_condition .condition-section').each(function () {
                    var status = $(this).data('is_new'); 
                    var conditionId = $(this).data('id');

                    if(status === true){
                         var new_condition = {
                              question_id: $(this).find('select[name^="new_condition_question_id"]').val() || '',
                              condition: $(this).find('select[name^="new_conditions"]').val() || '',
                              question_value: $(this).find('input[name^="new_condition_question_value"]').val() || '',
                              status: status,
                         };

                         if(new_condition.question_id && new_condition.condition && new_condition.question_value) {
                              contentData.new_conditions.push(new_condition);
                         }
                    }else if(status === false){
                         var condition = {
                              question_id: $(this).find('select[name^="condition_question_id"]').val() || '',
                              condition: $(this).find('select[name^="conditions"]').val() || '',
                              question_value: $(this).find('input[name^="condition_question_value"]').val() || '',
                              status: status,
                              condition_id: conditionId
                         };

                         if(condition.question_id && condition.condition && condition.question_value) {
                              contentData.conditions.push(condition);
                         }
                    }
               });
          }

         contents.push(contentData);
     });

     console.log(contents);
     return contents;
}

$(document).ready(function () {
     $('#saveFormdata').click(function (e) {
          var data = getAllContents();
          $('#formdata').val(JSON.stringify(data));

          var documentName = $('#document_id').val();
          let hasError = false;
     
          // $(".new_section").each(function(){
          //      if($(this).is(':checked')) {
          //           const uniqueId = $(this).attr('id').replace('start_new_section', '');
          //           const section = $(`.start_append_section${uniqueId}`);
          //           const textAlign = section.find(".text_align").val();
          //           if(!textAlign){
          //                NioApp.Toast('Please select the Text align option', 'error', { position: 'top-right' });
          //                hasError = true;
          //                return false;
          //           }
          //      }
          // });

          $(".text_align").each(function(){
               if(!$(this).val()){
                    NioApp.Toast('Please select the Text align option', 'error', { position: 'top-right' });
                    hasError = true;
                    return false;
               }
          })

          $(".new_heading_html").each(function(){
               if (!hasError && !$(this).val()) {
                    NioApp.Toast('Please fill the heading HTML field', 'error', { position: 'top-right' });
                    hasError = true;
                    return false;
               }
          });
     
          $(".new_content_html").each(function(){
               if (!hasError && !$(this).val()) {
                    NioApp.Toast('Please fill the content HTML field', 'error', { position: 'top-right' });
                    hasError = true;
                    return false;
               }
          });
     
          $('.add_condition').each(function () {
               const uniqueId = $(this).attr('id').replace('add_condition', '');
               const conditionSection = $('.add_condition_section' + uniqueId);

               if(!hasError && $(this).is(':checked')){
                    const appendSection = $('#append_condition' + uniqueId);
                    const conditionSections = appendSection.find('.condition-section');

                    if(conditionSections.length === 0){
                         NioApp.Toast('Please add condition.', 'error', { position: 'top-right' });
                         hasError = true;
                         return false; 
                    }

                    let conditionInvalid = false;
                    conditionSection.find('select').each(function(){
                         if(!$(this).val()){
                              conditionInvalid = true;
                              return false; 
                         }
                    });
 
                    if(conditionInvalid){
                         NioApp.Toast('Please fill in all required condition fields.', 'error', { position: 'top-right' });
                         hasError = true;
                         return false;
                    }
               }
          });
     
          if(!hasError && (!documentName || documentName.trim() === "")){
               NioApp.Toast('Please select the document', 'error', { position: 'top-right' });
               hasError = true;
          }
     
          if(!hasError){
               $('#updatecontentForm').submit();
          }
          
     });

     $('#updateFormdata').click(function (e) {
          var data = getAllContents();
          $('#formdata').val(JSON.stringify(data));

          var documentName = $('#document_id').val();
          var new_section = $('.new_section').val();
          var add_condition = $('.add_condition').val();
          
          let hasError = false;
    
          // $(".new_section").each(function(){
          //      if($(this).is(':checked')) {
          //           const uniqueId = $(this).attr('id').replace('start_new_section', '');
          //           const section = $(`.start_append_section${uniqueId}`);
          //           const textAlign = section.find(".text_align").val();

          //           if(!textAlign){
          //                NioApp.Toast('Please select the Text align option', 'error', { position: 'top-right' });
          //                hasError = true;
          //                return false;
          //           }
          //      }
          // });

          $(".text_align").each(function(){
               if(!$(this).val()){
                    NioApp.Toast('Please select the Text align option', 'error', { position: 'top-right' });
                    hasError = true;
                    return false;
               }
          })

          $(".new_heading_html").each(function(){
               if(!hasError && !$(this).val()){
                    NioApp.Toast('Please fill the heading HTML field', 'error', { position: 'top-right' });
                    hasError = true;
                    return false;
               }
          });
     
          $(".new_content_html").each(function(){
               if (!hasError && !$(this).val()) {
                    NioApp.Toast('Please fill the content HTML field', 'error', { position: 'top-right' });
                    hasError = true;
                    return false;
               }
          });
     
          $('.add_condition').each(function (){
               const uniqueId = $(this).attr('id').replace('add_condition', '');
               const conditionSection = $('.add_condition_section' + uniqueId);

               if(!hasError && $(this).is(':checked')){
                    const appendSection = $('#append_condition' + uniqueId);
                    const conditionSections = appendSection.find('.condition-section');

                    if(conditionSections.length === 0){
                         NioApp.Toast('Please add condition.', 'error', { position: 'top-right' });
                         hasError = true;
                         return false; 
                    }

                    let conditionInvalid = false;
                    conditionSection.find('select').each(function(){
                         if(!$(this).val()){
                              conditionInvalid = true;
                              return false; 
                         }
                    });
 
                    if(conditionInvalid){
                         NioApp.Toast('Please fill in all required condition fields.', 'error', { position: 'top-right' });
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
               $('#updatecontentForm').submit();
          }
     });

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


@endsection