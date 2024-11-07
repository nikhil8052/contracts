@extends('admin_layout.master')
@section('content')

<div class="nk-content">
     <div class="container-fluid">
          <form action="{{ url('/admin-dashboard/add/document-questions') }}" method="post" enctype="multipart/form-data">
          @csrf
          <div class="row main_section">
               <div class="col md-8 left-content">
                    <div class="col-md-12 doc-title mt-4 pb-4">
                         <div class="form-group">
                              <label class="form-label" for="title"><b><h4>Add New Question</h4></b></label>
                              <input type="text" class="form-control form-control-lg" id="title" name="title" placeholder="Add title" value="">
                         </div>
                    </div>
                    <h5>Contract Questions</h5>
                    <hr>
                    <h6>Steps</h6>
                    <!-- <div class="card card-bordered card-preview">
                         <div class="card-inner"> -->
                              <div class="add_steps"></div>
                              <br>
                              <div class="text-end">
                                   <div class="form-group">
                                        <button type="button" class="btn btn-sm btn-primary" id="addsteps" onclick="addSteps()">Add Step</button>
                                   </div>
                              </div>
                         <!-- </div>
                    </div> -->
               </div>
               <div class="col md-4 right-content">
                    <div class="card card-bordered card-preview">
                         <div class="card-inner">
                              <div class="col-md-12">
                                   <div class="form-group">
                                        <p>Published</p>
                                        <div class="custom-control custom-switch">
                                             <input type="checkbox" class="custom-control-input publish" id="publish1">
                                             <label class="custom-control-label" for="publish1"></label>
                                        </div>
                                   </div>
                              </div>
                              <div class="col-md-12 mt-2">
                                   <div class="form-group">
                                        <label class="form-label" for="document_id">Select Document</label>  
                                        <div class="form-control-wrap"> 
                                             <select class="form-select js-select2" name="document_id" id="document_id">
                                                  <option value=""></option>
                                                  @if(isset($documents) && $documents != null)
                                                  @foreach($documents as $document)
                                                       <option value="{{ $document->id ?? '' }}">{{ $document->title ?? '' }}</option>
                                                  @endforeach
                                                  @endif
                                             </select>
                                        </div>
                                   </div>
                              </div>
                              <div class="d-flex justify-content-end mt-2">
                                   <div class="nk-block-head-content">
                                        <div class="up-btn mbsc-form-group">
                                             <button class="btn btn-sm btn-primary" type="submit">Save</button>
                                        </div>
                                   </div>
                              </div> 
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
                    $('.append_textbox'+id).hide();
               }
          })
     });

     function addLabel(id){
          const html = `<div class="label-condition">
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
                                        <label class="form-label" for="condition_question_label">Label</label>
                                        <input type="text" class="form-control" id="condition_question_label" name="condition_question_label" value="">
                                   </div>
                              </div>
                              <div class="col-md-4">
                                   <div class="form-group">
                                        <label class="form-label" for="label_qu_id">Question ID</label>
                                        <input type="text" class="form-control" id="label_qu_id" name="label_qu_id" value="">
                                   </div>
                              </div>
                              <div class="col-md-4">
                                   <div class="form-group">
                                        <label class="form-label" for="condition_question_value">Value</label>
                                        <input type="text" class="form-control" id="condition_question_value" name="condition_question_value" value="">
                                   </div>
                              </div>
                         </div>
                         <br>
                    </div>`
          $('#append_label_condition'+id).append(html);
     }

     function removeLabel(e){
          if($(e).attr('value') === 'appended'){
               $(e).closest('.label-condition').remove();
          }else{
               var id = $(e).data('id');
               let deleteIds = $('#img_sec_ids').val();
               if(deleteIds){
                    deleteIds += ',' + id;
               }else{
                    deleteIds = id;
               }
               $('#img_sec_ids').val(deleteIds);
               $('.label-condition'+id).hide();
          }
     }

     function addCondition(id){
          const html = `<div class="sec-condition">
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
                                        <label class="form-label" for="page_Setting_qu_id">Question ID</label>
                                        <input type="text" class="form-control" id="page_Setting_qu_id" name="page_Setting_qu_id" value="">
                                   </div>
                              </div>
                              <div class="col-md-4">
                                   <div class="form-group">
                                        <label class="form-label" for="page_Setting_conditions">Condition</label>
                                        <div class="form-control-wrap"> 
                                             <select class="form-select js-select2" name="page_Setting_conditions" id="page_Setting_conditions">
                                                  <option value="is equal to">is equal to</option>
                                                  <option value="is greater than">is greater than</option>
                                                  <option value="is less than">is less than</option>
                                                  <option value="not equal to">not equal to</option>
                                             </select>
                                        </div>
                                   </div>
                              </div>
                              <div class="col-md-4">
                                   <div class="form-group">
                                        <label class="form-label" for="page_Setting_qu_val">Value</label>
                                        <input type="text" class="form-control" id="page_Setting_qu_val" name="page_Setting_qu_val" value="">
                                   </div>
                              </div>
                         </div>
                         <br>
                    </div>`
          $('#append_page_condition'+id).append(html);
     }

     function removeCondition(e){
          if($(e).attr('value') === 'appended'){
               $(e).closest('.sec-condition').remove();
          }else{
               var id = $(e).data('id');
               let deleteIds = $('#img_sec_ids').val();
               if(deleteIds){
                    deleteIds += ',' + id;
               }else{
                    deleteIds = id;
               }
               $('#img_sec_ids').val(deleteIds);
               $('.sec-condition'+id).hide();
          }
     }

     function addOptions(value,id){
          let html = ``;
          if(value === 'dropdown'){
               html = `<div class="dropdown-option">
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
                                   <label class="form-label" for="dropdown_option_label">Label</label>
                                   <input type="text" class="form-control" id="dropdown_option_label" name="dropdown_option_label" value="">
                              </div>
                         </div>
                         <div class="col-md-4">
                              <div class="form-group">
                                   <label class="form-label" for="dropdown_option_value">Value</label>
                                   <input type="text" class="form-control" id="dropdown_option_value" name="dropdown_option_value" value="">
                              </div>
                         </div>
                         <div class="col-md-4">
                              <div class="form-group">
                                   <label class="form-label" for="dropdown_go_to_step">Go to Step</label>
                                   <input type="text" class="form-control" id="dropdown_go_to_step" name="dropdown_go_to_step" value="">
                              </div>
                         </div>
                    </div>
                    <br>
               </div>`;
          }else if(value === 'radio-button'){
               html = `<div class="radio-option">
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
                                   <label class="form-label" for="radio_option_label">Label</label>
                                   <input type="text" class="form-control" id="radio_option_label" name="radio_option_label" value="">
                              </div>
                         </div>
                         <div class="col-md-4">
                              <div class="form-group">
                                   <label class="form-label" for="radio_option_value">Value</label>
                                   <input type="text" class="form-control" id="radio_option_value" name="radio_option_value" value="">
                              </div>
                         </div>
                         <div class="col-md-4">
                              <div class="form-group">
                                   <label class="form-label" for="radio_go_to_step">Go to Step</label>
                                   <input type="text" class="form-control" id="radio_go_to_step" name="radio_go_to_step" value="">
                              </div>
                         </div>
                    </div>
                    <br>
               </div>`;
          }
          $('#append_options_'+id).append(html);
     }

     function removeOptions(e){
          if($(e).attr('data-field') === 'dropdown'){
               if($(e).attr('value') === 'appended'){
                    $(e).closest('.dropdown-option').remove();
               }else{
                    var id = $(e).data('id');
                    let deleteIds = $('#img_sec_ids').val();
                    if(deleteIds){
                         deleteIds += ',' + id;
                    }else{
                         deleteIds = id;
                    }
                    $('#img_sec_ids').val(deleteIds);
                    $('.dropdown-option'+id).hide();
               }
          }else if($(e).attr('data-field') === 'radio-button'){
               if($(e).attr('value') === 'appended'){
                    $(e).closest('.radio-option').remove();
               }else{
                    var id = $(e).data('id');
                    let deleteIds = $('#img_sec_ids').val();
                    if(deleteIds){
                         deleteIds += ',' + id;
                    }else{
                         deleteIds = id;
                    }
                    $('#img_sec_ids').val(deleteIds);
                    $('.radio-option'+id).hide();
               }
          }
     }

     function addContractRow(){
          const html = `<div class="dropdown-option">
                              <hr>
                              <div class="text-end">
                                   <div class="form-group">
                                        <div>
                                             <span class="remove_dropdown_option" value="appended">
                                                  <i class="fa fa-times"></i>
                                             </span>
                                        </div>
                                   </div>
                              </div>
                              <div class="row">
                                   <div class="col-md-2">
                                        <div class="form-group">
                                             <label class="form-label" for="dropdown_link_label">Label</label>
                                             <input type="text" class="form-control" id="dropdown_link_label" name="dropdown_link_label" value="">
                                        </div>
                                   </div>
                                   <div class="col-md-4">
                                        <div class="form-group">
                                             <label class="form-label" for="contract_link">Contract Link</label>
                                             <input type="text" class="form-control" id="contract_link" name="contract_link" value="">
                                        </div>
                                   </div>
                                   <div class="col-md-6">
                                        <div class="form-group">
                                             <label class="form-label" for="">Contract send to next step</label>
                                             <div class="custom-control custom-checkbox checked">
                                                  <input type="checkbox" class="custom-control-input" id="contract_send_next_step" name="contract_send_next_step">
                                                  <label class="custom-control-label" for="contract_send_next_step"></label>
                                             </div>  
                                        </div>
                                   </div>
                              </div>
                              <br>
                         </div>`;
          $('.add_cont_rw').append(html);
     }

     function conditionalQuestions(id){
          if($('#condition_qu_label'+id).is(':checked')){
               $('.cond_ques_div'+id).show();
               $('#hide_question_label'+id).hide();
          }else{
               $('.cond_ques_div'+id).hide();
               $('#hide_question_label'+id).show();
          }
     }


     function conditionalPageSetting(id){
          if($('#condition_go_to'+id).is(':checked')){
               $('.cond_div'+ id).show();
          }else{
               $('.cond_div'+id).hide();
          }
     }

     function addSteps(){
          const uniqueDropdownId = 'dropdown_' + Date.now();
          const unqId = Date.now();
          const html = `<div class="steps_section" id="steps_section">
               <div class="card card-bordered card-preview">
                    <div class="card-inner">
                         <div class="row add_step">
                              <div class="col-md-6">
                                   <h6>Add Steps</h6>  
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
                         <div class="col-md-12">
                              <div class="form-group">
                                   <label class="form-label" for="step">Step *</label>
                                   <input type="text" class="form-control" id="step" name="step">
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

     function addQuestionfields(name,id){
          // console.log(name,id);
          const newUniqueId = Date.now();
          let html = ``;
          if(name === 'textbox'){
               html = `<div class="append_textbox">
                         <div class="card card-bordered card-preview">
                              <div class="card-inner">
                                   <div class="row add_step">
                                        <div class="col-md-6">
                                             <h6>Textbox</h6>  
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
                                        <input type="checkbox" class="custom-control-input" id="condition_qu_label${newUniqueId}" name="condition_qu_label">
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
                                   <div class="col-md-12" id="hide_question_label${newUniqueId}">
                                        <div class="form-group">
                                             <label class="form-label" for="text_qu_label">Question Label</label>
                                             <input type="text" class="form-control" id="text_qu_label" name="text_qu_label">
                                        </div>
                                        <hr>
                                   </div>
                                   <div class="col-md-12">
                                        <div class="form-group">
                                             <label class="form-label" for="text_id">Text Box ID</label>
                                             <input type="text" class="form-control" id="text_id" name="text_id">
                                        </div>
                                   </div>
                                   <hr>
                                   <div class="col-md-12">
                                        <div class="form-group">
                                             <label class="form-label" for="text_placeholder">Text Box Placeholder</label>
                                             <input type="text" class="form-control" id="text_placeholder" name="text_placeholder">
                                        </div>
                                   </div>
                                   <hr>
                                   <div class="col-md-12">
                                        <div class="form-group">
                                             <label class="form-label" for="text_placeholder">Placeholder text</label>
                                             <input type="text" class="form-control" id="text_placeholder" name="text_placeholder">
                                        </div>
                                   </div>
                                   <hr>
                                   <div class="col-md-12">
                                        <div class="form-group">
                                             <label class="form-label" for="text_go_to_step">Go to step</label>
                                             <input type="text" class="form-control" id="text_go_to_step" name="text_go_to_step">
                                        </div>
                                   </div>
                                   <hr>
                                   <div class="col-md-12">
                                        <div class="form-group">
                                             <label class="form-label" for="">Conditional Go to step Settings</label>
                                        </div>
                                   </div>
                                   <div class="custom-control custom-checkbox checked">
                                        <input type="checkbox" class="custom-control-input" id="condition_go_to${newUniqueId}" name="condition_go_to">
                                        <label class="custom-control-label" for="condition_go_to${newUniqueId}">Enable Conditional Go To Step Settings</label>
                                   </div>
                                   <hr>
                                   <div class="cond_div${newUniqueId}">
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
                    </div>`;
               // $('.add_qu_sec').append(html);
          }else if(name === 'textarea'){
               // console.log(name);
               html =`<div class="append_textarea">
                              <div class="card card-bordered card-preview">
                                   <div class="card-inner">
                                        <div class="row add_step">
                                             <div class="col-md-6">
                                                  <h6>Textarea</h6>  
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
                                             <input type="checkbox" class="custom-control-input" id="condition_qu_label${newUniqueId}" name="condition_qu_label">
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
                                        <div class="col-md-12" id="hide_question_label${newUniqueId}">
                                             <div class="form-group">
                                                  <label class="form-label" for="text_qu_label">Question Label</label>
                                                  <input type="text" class="form-control" id="text_qu_label" name="text_qu_label">
                                             </div>
                                             <hr>
                                        </div>
                                        <div class="col-md-12">
                                             <div class="form-group">
                                                  <label class="form-label" for="text_id">Text Box ID</label>
                                                  <input type="text" class="form-control" id="text_id" name="text_id">
                                             </div>
                                        </div>
                                        <hr>
                                        <div class="col-md-12">
                                             <div class="form-group">
                                                  <label class="form-label" for="text_placeholder">Text Box Placeholder</label>
                                                  <input type="text" class="form-control" id="text_placeholder" name="text_placeholder">
                                             </div>
                                        </div>
                                        <hr>
                                        <div class="col-md-12">
                                             <div class="form-group">
                                                  <label class="form-label" for="text_placeholder">Placeholder text</label>
                                                  <input type="text" class="form-control" id="text_placeholder" name="text_placeholder">
                                             </div>
                                        </div>
                                        <hr>
                                        <div class="col-md-12">
                                             <div class="form-group">
                                                  <label class="form-label" for="text_go_to_step">Go to step</label>
                                                  <input type="text" class="form-control" id="text_go_to_step" name="text_go_to_step">
                                             </div>
                                        </div>
                                        <hr>
                                        <div class="col-md-12">
                                             <div class="form-group">
                                                  <label class="form-label" for="">Conditional Go to step Settings</label>
                                             </div>
                                        </div>
                                        <div class="custom-control custom-checkbox checked">
                                             <input type="checkbox" class="custom-control-input" id="condition_go_to${newUniqueId}" name="condition_go_to">
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
                         </div>`;
               // $('.add_qu_sec').append(html);
          }else if(name === 'dropdown'){
               html = `<div class="append_dropdown">
                         <div class="card card-bordered card-preview">
                              <div class="card-inner">
                                   <div class="row add_step">
                                        <div class="col-md-6">
                                             <h6>Dropdown</h6>  
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
                                        <input type="checkbox" class="custom-control-input" id="condition_qu_label${newUniqueId}" name="condition_qu_label">
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
                                   <div class="col-md-12" id="hide_question_label${newUniqueId}">
                                        <div class="form-group">
                                             <label class="form-label" for="text_qu_label">Question Label</label>
                                             <input type="text" class="form-control" id="text_qu_label" name="text_qu_label">
                                        </div>
                                        <hr>
                                   </div>
                                   <div class="col-md-12">
                                        <div class="form-group">
                                             <label class="form-label" for="text_qu_id">Question ID</label>
                                             <input type="text" class="form-control" id="text_qu_id" name="text_qu_id">
                                        </div>
                                   </div>
                                   <hr>
                                   <div class="col-md-12">
                                        <div class="form-group">
                                             <label class="form-label" for="">Add Dropdown Option</label>
                                        </div>
                                   </div>
                                   <div class="append_options" id="append_options_${newUniqueId}"></div>
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
                                        <input type="checkbox" class="custom-control-input" id="condition_go_to${newUniqueId}" name="condition_go_to">
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
                    </div>`;
               // $('.add_qu_sec').append(html);
          }else if(name === 'radio-button'){
               html = `<div class="append_radio">
                         <div class="card card-bordered card-preview">
                              <div class="card-inner">
                                   <div class="row add_step">
                                        <div class="col-md-6">
                                             <h6>Radio Button</h6>  
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
                                        <input type="checkbox" class="custom-control-input" id="condition_qu_label${newUniqueId}" name="condition_qu_label">
                                        <label class="custom-control-label" for="condition_qu_label${newUniqueId}">Conditional questions label</label>
                                   </div>
                                   <hr>
                                   <div class="col-md-12">
                                        <div class="form-group">
                                             <label class="form-label" for="text_qu_label">Question Label</label>
                                             <input type="text" class="form-control" id="text_qu_label" name="text_qu_label">
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
                                             <label class="form-label" for="text_qu_id">Question ID</label>
                                             <input type="text" class="form-control" id="text_qu_id" name="text_qu_id">
                                        </div>
                                   </div>
                                   <hr>
                                   <div class="col-md-12">
                                        <div class="form-group">
                                             <label class="form-label" for="">Add Radio Option</label>
                                        </div>
                                   </div>
                                   <div class="append_options" id="append_options_${newUniqueId}"></div>
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
                                        <input type="checkbox" class="custom-control-input" id="condition_go_to${newUniqueId}" name="condition_go_to">
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
                    </div>`;
               // $('.add_qu_sec').append(html);
          }else if(name === 'date-field'){
               html = `<div class="append_dateField">
                         <div class="card card-bordered card-preview">
                              <div class="card-inner">
                                   <div class="row add_step">
                                        <div class="col-md-6">
                                             <h6>Date Field</h6>  
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
                                        <input type="checkbox" class="custom-control-input" id="condition_qu_label${newUniqueId}" name="condition_qu_label">
                                        <label class="custom-control-label" for="condition_qu_label${newUniqueId}">Conditional questions label</label>
                                   </div>
                                   <hr>
                                   <div class="col-md-12">
                                        <div class="form-group">
                                             <label class="form-label" for="text_qu_label">Question Label</label>
                                             <input type="text" class="form-control" id="text_qu_label" name="text_qu_label">
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
                                             <label class="form-label" for="date_field_id">Date field ID</label>
                                             <input type="text" class="form-control" id="date_field_id" name="date_field_id">
                                        </div>
                                   </div>
                                   <hr>
                                   <div class="col-md-12">
                                        <div class="form-group">
                                             <label class="form-label" for="date_go_to_step">Go to step</label>
                                             <input type="text" class="form-control" id="date_go_to_step" name="date_go_to_step">
                                        </div>
                                   </div>
                                   <div class="col-md-12">
                                        <div class="form-group">
                                             <label class="form-label" for="">Conditional Go to step Settings</label>
                                        </div>
                                   </div>
                                   <div class="custom-control custom-checkbox checked">
                                        <input type="checkbox" class="custom-control-input" id="condition_go_to${newUniqueId}" name="condition_go_to">
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
                    </div>`;
               // $('.add_qu_sec').append(html);    
          }else if(name === 'pricebox'){
               html = `<div class="append_priceBox">
                         <div class="card card-bordered card-preview">
                              <div class="card-inner">
                                   <div class="row add_step">
                                        <div class="col-md-6">
                                             <h6>Pricebox</h6>  
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
                                        <input type="checkbox" class="custom-control-input" id="condition_qu_label${newUniqueId}" name="condition_qu_label">
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
                                   <div class="col-md-12" id="hide_question_label${newUniqueId}">
                                        <div class="form-group">
                                             <label class="form-label" for="text_qu_label">Question Label</label>
                                             <input type="text" class="form-control" id="text_qu_label" name="text_qu_label">
                                        </div>
                                        <hr>
                                   </div>
                                   <div class="col-md-12">
                                        <div class="form-group">
                                             <label class="form-label" for="text_id">Text Box ID</label>
                                             <input type="text" class="form-control" id="text_id" name="text_id">
                                        </div>
                                   </div>
                                   <hr>
                                   <div class="col-md-12">
                                        <div class="form-group">
                                             <label class="form-label" for="text_placeholder">Text Box Placeholder</label>
                                             <input type="text" class="form-control" id="text_placeholder" name="text_placeholder">
                                        </div>
                                   </div>
                                   <hr>
                                   <div class="col-md-12">
                                        <div class="form-group">
                                             <label class="form-label" for="text_placeholder">Placeholder text</label>
                                             <input type="text" class="form-control" id="text_placeholder" name="text_placeholder">
                                        </div>
                                   </div>
                                   <hr>
                                   <div class="col-md-12">
                                        <div class="form-group">
                                             <label class="form-label" for="text_go_to_step">Go to step</label>
                                             <input type="text" class="form-control" id="text_go_to_step" name="text_go_to_step">
                                        </div>
                                   </div>
                                   <hr>
                                   <div class="col-md-12">
                                        <div class="form-group">
                                             <label class="form-label" for="">Conditional Go to step Settings</label>
                                        </div>
                                   </div>
                                   <div class="custom-control custom-checkbox checked">
                                        <input type="checkbox" class="custom-control-input" id="condition_go_to${newUniqueId}" name="condition_go_to">
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
                    </div>`;
               // $('.add_qu_sec').append(html);
          }else if(name === 'number-field'){
               html = `<div class="append_numberField">
                         <div class="card card-bordered card-preview">
                              <div class="card-inner">
                                   <div class="row add_step">
                                        <div class="col-md-6">
                                             <h6>Number field</h6>  
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
                                        <input type="checkbox" class="custom-control-input" id="condition_qu_label${newUniqueId}" name="condition_qu_label">
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
                                   <div class="col-md-12" id="hide_question_label${newUniqueId}">
                                        <div class="form-group">
                                             <label class="form-label" for="text_qu_label">Question Label</label>
                                             <input type="text" class="form-control" id="text_qu_label" name="text_qu_label">
                                        </div>
                                        <hr>
                                   </div>
                                   <div class="col-md-12">
                                        <div class="form-group">
                                             <label class="form-label" for="text_id">Number field ID</label>
                                             <input type="text" class="form-control" id="text_id" name="text_id">
                                        </div>
                                   </div>
                                   <hr>
                                   <div class="col-md-12">
                                        <div class="form-group">
                                             <label class="form-label" for="text_placeholder">Number field Placeholder</label>
                                             <input type="text" class="form-control" id="text_placeholder" name="text_placeholder">
                                        </div>
                                   </div>
                                   <hr>
                                   <div class="col-md-12">
                                        <div class="form-group">
                                             <label class="form-label" for="text_placeholder">Placeholder text</label>
                                             <input type="text" class="form-control" id="text_placeholder" name="text_placeholder">
                                        </div>
                                   </div>
                                   <hr>
                                   <div class="col-md-12">
                                        <div class="form-group">
                                             <label class="form-label" for="text_go_to_step">Go to step</label>
                                             <input type="text" class="form-control" id="text_go_to_step" name="text_go_to_step">
                                        </div>
                                   </div>
                                   <hr>
                                   <div class="col-md-12">
                                        <div class="form-group">
                                             <label class="form-label" for="">Conditional Go to step Settings</label>
                                        </div>
                                   </div>
                                   <div class="custom-control custom-checkbox checked">
                                        <input type="checkbox" class="custom-control-input" id="condition_go_to${newUniqueId}" name="condition_go_to">
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
                    </div>`;
               // $('.add_qu_sec').append(html);
          }else if(name === 'percentage-box'){
               // console.log(name);
               html = `<div class="appendPercentageBox">
                         <div class="card card-bordered card-preview">
                              <div class="card-inner">
                                   <div class="row add_step">
                                        <div class="col-md-6">
                                             <h6>Percentage Box</h6>  
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
                                        <input type="checkbox" class="custom-control-input" id="condition_qu_label${newUniqueId}" name="condition_qu_label">
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
                                   <div class="col-md-12" id="hide_question_label${newUniqueId}">
                                        <div class="form-group">
                                             <label class="form-label" for="text_qu_label">Question Label</label>
                                             <input type="text" class="form-control" id="text_qu_label" name="text_qu_label">
                                        </div>
                                        <hr>
                                   </div>
                                   <div class="col-md-12">
                                        <div class="form-group">
                                             <label class="form-label" for="text_id">Text Box ID</label>
                                             <input type="text" class="form-control" id="text_id" name="text_id">
                                        </div>
                                   </div>
                                   <hr>
                                   <div class="col-md-12">
                                        <div class="form-group">
                                             <label class="form-label" for="text_placeholder">Text Box Placeholder</label>
                                             <input type="text" class="form-control" id="text_placeholder" name="text_placeholder">
                                        </div>
                                   </div>
                                   <hr>
                                   <div class="col-md-12">
                                        <div class="form-group">
                                             <label class="form-label" for="text_placeholder">Placeholder text</label>
                                             <input type="text" class="form-control" id="text_placeholder" name="text_placeholder">
                                        </div>
                                   </div>
                                   <hr>
                                   <div class="col-md-12">
                                        <div class="form-group">
                                             <label class="form-label" for="text_go_to_step">Go to step</label>
                                             <input type="text" class="form-control" id="text_go_to_step" name="text_go_to_step">
                                        </div>
                                   </div>
                                   <hr>
                                   <div class="col-md-12">
                                        <div class="form-group">
                                             <label class="form-label" for="">Conditional Go to step Settings</label>
                                        </div>
                                   </div>
                                   <div class="custom-control custom-checkbox checked">
                                        <input type="checkbox" class="custom-control-input" id="condition_go_to${newUniqueId}" name="condition_go_to">
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
                    </div>`;
               // $('.add_qu_sec').append(html);
          }else if(name === 'dropdown-link'){
               // console.log(name);
               html = `<div class="append_dropdownLink">
                         <div class="card card-bordered card-preview">
                              <div class="card-inner">
                                   <div class="row add_step">
                                        <div class="col-md-6">
                                             <h6>Dropdown link</h6>  
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
                                             <label class="form-label" for="text_qu_label">Question Label</label>
                                             <input type="text" class="form-control" id="text_qu_label" name="text_qu_label">
                                        </div>
                                   </div>
                                   <hr>
                                   <div class="col-md-12">
                                        <div class="form-group">
                                             <label class="form-label" for="same_contract_link">Same Contract Link Label</label>
                                             <input type="text" class="form-control" id="same_contrct_link" name="same_contrct_link">
                                        </div>
                                   </div>
                                   <hr>
                                   <div class="col-md-12">
                                        <div class="form-group">
                                             <label class="form-label" for="">Different Contract Link</label>
                                        </div>
                                   </div>
                                   <br>
                                   <div class="add_cont_rw"></div>
                                   <div class="text-end">
                                        <div class="form-group">
                                             <button type="button" class="btn btn-sm btn-primary" id="add_contract_row" onclick="addContractRow()">Add Row</button>
                                        </div>
                                   </div>
                                   <hr>
                                   <div class="col-md-12">
                                        <div class="form-group">
                                             <label class="form-label" for="text_placeholder">Placeholder text</label>
                                             <input type="text" class="form-control" id="text_placeholder" name="text_placeholder">
                                        </div>
                                   </div>
                                   <hr>
                                   <div class="col-md-12">
                                        <div class="form-group">
                                             <label class="form-label" for="text_go_to_step">Go to step</label>
                                             <input type="text" class="form-control" id="text_go_to_step" name="text_go_to_step">
                                        </div>
                                   </div>
                              </div>
                         </div>
                         <br>
                    </div>`;
               // $('.add_qu_sec').append(html);
          }
          $('#add_qu_sec_'+id).append(html);

          conditionalQuestions(newUniqueId);

          $('#condition_qu_label'+newUniqueId).change(function(){
               conditionalQuestions(newUniqueId);
          });

          conditionalPageSetting(newUniqueId);

          $('#condition_go_to'+newUniqueId).change(function(){
               conditionalPageSetting(newUniqueId);
          })
     }

     function removeFields(e){
          if($(e).attr('data-field') === 'textbox'){
               if($(e).attr('value') === 'appended'){
                    $(e).closest('.append_textbox').remove();
               }else{
                    var id = $(e).data('id');
                    let deleteIds = $('#img_sec_ids').val();
                    if(deleteIds){
                         deleteIds += ',' + id;
                    }else{
                         deleteIds = id;
                    }
                    $('#img_sec_ids').val(deleteIds);
                    $('.append_textbox'+id).hide();
               }    
          }else if($(e).attr('data-field') === 'textarea'){
               if($(e).attr('value') === 'appended'){
                    $(e).closest('.append_textarea').remove();
               }else{
                    var id = $(e).data('id');
                    let deleteIds = $('#img_sec_ids').val();
                    if(deleteIds){
                         deleteIds += ',' + id;
                    }else{
                         deleteIds = id;
                    }
                    $('#img_sec_ids').val(deleteIds);
                    $('.append_textarea'+id).hide();
               }   
          }else if($(e).attr('data-field') === 'dropdown'){
               if($(e).attr('value') === 'appended'){
                    $(e).closest('.append_dropdown').remove();
               }else{
                    var id = $(e).data('id');
                    let deleteIds = $('#img_sec_ids').val();
                    if(deleteIds){
                         deleteIds += ',' + id;
                    }else{
                         deleteIds = id;
                    }
                    $('#img_sec_ids').val(deleteIds);
                    $('.append_dropdown'+id).hide();
               }   

          }else if($(e).attr('data-field') === 'radio-button'){
               if($(e).attr('value') === 'appended'){
                    $(e).closest('.append_radio').remove();
               }else{
                    var id = $(e).data('id');
                    let deleteIds = $('#img_sec_ids').val();
                    if(deleteIds){
                         deleteIds += ',' + id;
                    }else{
                         deleteIds = id;
                    }
                    $('#img_sec_ids').val(deleteIds);
                    $('.append_radio'+id).hide();
               }   
          }else if($(e).attr('data-field') === 'date-field'){
               if($(e).attr('value') === 'appended'){
                    $(e).closest('.append_dateField').remove();
               }else{
                    var id = $(e).data('id');
                    let deleteIds = $('#img_sec_ids').val();
                    if(deleteIds){
                         deleteIds += ',' + id;
                    }else{
                         deleteIds = id;
                    }
                    $('#img_sec_ids').val(deleteIds);
                    $('.append_dateField'+id).hide();
               }   
          }else if($(e).attr('data-field') === 'pricebox'){
               if($(e).attr('value') === 'appended'){
                    $(e).closest('.append_priceBox').remove();
               }else{
                    var id = $(e).data('id');
                    let deleteIds = $('#img_sec_ids').val();
                    if(deleteIds){
                         deleteIds += ',' + id;
                    }else{
                         deleteIds = id;
                    }
                    $('#img_sec_ids').val(deleteIds);
                    $('.append_priceBox'+id).hide();
               }   
          }else if($(e).attr('data-field') === 'number-field'){
               if($(e).attr('value') === 'appended'){
                    $(e).closest('.append_numberField').remove();
               }else{
                    var id = $(e).data('id');
                    let deleteIds = $('#img_sec_ids').val();
                    if(deleteIds){
                         deleteIds += ',' + id;
                    }else{
                         deleteIds = id;
                    }
                    $('#img_sec_ids').val(deleteIds);
                    $('.append_numberField'+id).hide();
               }   
          }else if($(e).attr('data-field') === 'percentBox'){
               if($(e).attr('value') === 'appended'){
                    $(e).closest('.appendPercentageBox').hide();
               }else{
                    var id = $(e).data('id');
                    let deleteIds = $('#img_sec_ids').val();
                    if(deleteIds){
                         deleteIds += ',' + id;
                    }else{
                         deleteIds = id;
                    }
                    $('#img_sec_ids').val(deleteIds);
                    $('.appendPercentageBox'+id).hide();
               }   
          }else if($(e).attr('data-field') === 'dropdown-link'){
               if($(e).attr('value') === 'appended'){
                    $(e).closest('.append_dropdownLink').remove();
               }else{
                    var id = $(e).data('id');
                    let deleteIds = $('#img_sec_ids').val();
                    if(deleteIds){
                         deleteIds += ',' + id;
                    }else{
                         deleteIds = id;
                    }
                    $('#img_sec_ids').val(deleteIds);
                    $('.append_dropdownLink'+id).hide();
               }   
          }
     }
</script>


@endsection