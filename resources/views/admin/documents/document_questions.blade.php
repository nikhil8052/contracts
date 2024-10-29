<style>
     .dropbtn{
          background-color: #3498DB;
          color: white;
          padding: 16px;
          font-size: 16px;
          border: none;
          cursor: pointer;
     }

     .dropbtn:hover, .dropbtn:focus{
          background-color: #FD5602;
     }

     .dropdown{
          position: relative;
          display: inline-block;
     }

     .dropdown-content{
          display: none;
          position: absolute;
          background-color: #f1f1f1;
          min-width: 160px;
          overflow: auto;
          box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
          z-index: 1;
     }

     .dropdown-content a{
          color: black;
          padding: 8px 16px;
          text-decoration: none;
          display: block;
          background-color: #fff;
          text-align: left;
     }

     .dropdown a:hover{
          background-color: #DDF4F4;
          color: #012555;
     }

     .show{
          display: block;
     }
</style>

@extends('admin_layout.master')
@section('content')

<div class="nk-content">
     <div class="container-fluid">
          <form action="" id="documentForm" method="post" enctype="multipart/form-data">
          @csrf
          <div class="row main_section">
               <div class="col md-10 left-content">
                    <div class="col-md-12 doc-title mt-4 pb-4">
                         <div class="form-group">
                              <label class="form-label" for="title"><b><h4>Add New Question</h4></b></label>
                              <input type="text" class="form-control form-control-lg" id="title" name="title" placeholder="Add title" value="">
                         </div>
                    </div>
                    <h5>Contract Questions</h5>
                    <hr>
                    <h6>Steps</h6>
                    <div class="card card-bordered card-preview">
                         <div class="card-inner">
                              <div class="add_steps"></div>
                              <br>
                              <div class="text-end">
                                   <div class="form-group">
                                        <button type="button" class="btn btn-sm btn-primary" id="addsteps" onclick="addSteps()">Add Step</button>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>
               <div class="col md-2 right-content">
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
          console.log("Toggling dropdown for ID:", id);
          const dropdown = document.getElementById(id);
          if(dropdown){
               dropdown.classList.toggle("show");
          }else{
               console.error(`Dropdown with ID ${id} not found.`);
          }
     }

     window.onclick = function(event) {
          if (!event.target.matches('.dropbtn')) {
               const dropdowns = document.getElementsByClassName("dropdown-content");
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

          // textbox fields //
          const uniqueId = Date.now();
          $('body').delegate('.textbox', 'click', function() {
               const newUniqueId = Date.now();
               const html = `<div class="append_textbox">
                         <div class="card card-bordered card-preview">
                              <div class="card-inner">
                                   <div class="row add_step">
                                        <div class="col-md-6">
                                             <h6>Textbox</h6>  
                                        </div> 
                                        <div class="col-md-6">
                                             <div class="form-group">
                                                  <span class="col-md-2 offset-md-10">
                                                       <span class="remove_questions" value="appended"><i class="fa-solid fa-minus"></i></span>
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
                                        <div class="append_label_condition"></div>
                                        <div class="text-end">
                                             <div class="form-group">
                                                  <button type="button" class="btn btn-sm btn-primary add_label">Add Label</button>
                                             </div>
                                        </div>
                                   </div>
                                   <div class="col-md-12">
                                        <div class="form-group">
                                             <label class="form-label" for="text_qu_label">Question Label</label>
                                             <input type="text" class="form-control" id="text_qu_label" name="text_qu_label">
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
                                             <label class="form-label" for="">Conditional Go to page Settings</label>
                                        </div>
                                   </div>
                                   <div class="custom-control custom-checkbox checked">
                                        <input type="checkbox" class="custom-control-input" id="textbox_condition_go_to${newUniqueId}" name="textbox_condition_go_to">
                                        <label class="custom-control-label" for="textbox_condition_go_to${newUniqueId}">Enable Conditional Go To Page Settings</label>
                                   </div>
                                   <hr>
                                   <div class="cond_div${newUniqueId}" style="display:none;">
                                        <div class="col-md-12">
                                             <div class="form-group">
                                                  <label class="form-label" for="">Add Conditions</label>
                                             </div>
                                        </div>
                                        <div class="append_page_condition"></div>
                                        <div class="text-end">
                                             <div class="form-group">
                                                  <button type="button" class="btn btn-sm btn-primary add_condition" id="add_condition">Add Condition</button>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                         </div>
                         <br>
                    </div>`;
    
               $('.add_qu_sec').append(html);

               conditionalQuestions(newUniqueId);

               $('#condition_qu_label'+newUniqueId).change(function(){
                    conditionalQuestions(newUniqueId);
               });

               conditionalPageSetting(newUniqueId);
               $('#textbox_condition_go_to'+newUniqueId).change(function(){
                    conditionalPageSetting(newUniqueId);
               })
          });

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

          $('body').delegate('.add_label','click',function(){
               const html = `<div class="label-condition">
                              <hr>
                              <div class="text-end">
                                   <div class="form-group">
                                        <div>
                                             <span class="remove_label_condition" value="appended">
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
                                             <label class="form-label" for="label_qu_id">Ouestion ID</label>
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
               $('.append_label_condition').append(html);
          })

          $('body').delegate('.remove_label_condition','click', function(){
               if($(this).attr('value') === 'appended'){
                    $(this).closest('.label-condition').remove();
               }else{
                    var id = $(this).data('id');
                    let deleteIds = $('#img_sec_ids').val();
                    if(deleteIds){
                         deleteIds += ',' + id;
                    }else{
                         deleteIds = id;
                    }
                    $('#img_sec_ids').val(deleteIds);
                    $('.label-condition'+id).hide();
               }
          })

          $('body').delegate('.add_condition','click',function(){
               const html = `<div class="sec-condition">
                              <hr>
                              <div class="text-end">
                                   <div class="form-group">
                                        <div>
                                             <span class="remove_condition" value="appended">
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
               $('.append_page_condition').append(html);
          })

          $('body').delegate('.remove_condition','click', function(){
               if($(this).attr('value') === 'appended'){
                    $(this).closest('.sec-condition').remove();
               }else{
                    var id = $(this).data('id');
                    let deleteIds = $('#img_sec_ids').val();
                    if(deleteIds){
                         deleteIds += ',' + id;
                    }else{
                         deleteIds = id;
                    }
                    $('#img_sec_ids').val(deleteIds);
                    $('.sec-condition'+id).hide();
               }
          })
     });

     function conditionalQuestions(id){
          if($('#condition_qu_label'+id).is(':checked')){
               $('.cond_ques_div'+id).show();
          }else{
               $('.cond_ques_div'+id).hide();
          }
     }


     function conditionalPageSetting(id){
          if($('#textbox_condition_go_to'+id).is(':checked')){
               $('.cond_div'+ id).show();
          }else{
               $('.cond_div'+id).hide();
          }
     }

     function addSteps(){
          const uniqueDropdownId = 'dropdown_' + Date.now();
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
                         <div class="add_qu_sec"></div>
                         <div class="col-md-12">
                              <div class="form-group">
                                   <label class="form-label" for="">Add Questions</label>
                              </div>
                         </div>
                         <div class="text-end">
                              <button type="button" class="btn btn-sm btn-primary dropbtn" onclick="toggleDropdown('${uniqueDropdownId}')">Add Question</button>
                              <div class="form-group dropdown"> 
                                   <div id="${uniqueDropdownId}" class="dropdown-content">
                                        @foreach($types as $type)
                                             <a class="{{ $type->slug ?? '' }}">{{ $type->name ?? '' }}</a>
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

     function addTextBoxfields(name){
          const newUniqueId = Date.now();
          if(name === 'textbox'){
               const html = `<div class="append_textbox">
                         <div class="card card-bordered card-preview">
                              <div class="card-inner">
                                   <div class="row add_step">
                                        <div class="col-md-6">
                                             <h6>Textbox</h6>  
                                        </div> 
                                        <div class="col-md-6">
                                             <div class="form-group">
                                                  <span class="col-md-2 offset-md-10">
                                                       <span class="remove_questions" value="appended"><i class="fa-solid fa-minus"></i></span>
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
                                        <div class="append_label_condition"></div>
                                        <div class="text-end">
                                             <div class="form-group">
                                                  <button type="button" class="btn btn-sm btn-primary add_label">Add Label</button>
                                             </div>
                                        </div>
                                   </div>
                                   <div class="col-md-12">
                                        <div class="form-group">
                                             <label class="form-label" for="text_qu_label">Question Label</label>
                                             <input type="text" class="form-control" id="text_qu_label" name="text_qu_label">
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
                                             <label class="form-label" for="">Conditional Go to page Settings</label>
                                        </div>
                                   </div>
                                   <div class="custom-control custom-checkbox checked">
                                        <input type="checkbox" class="custom-control-input" id="textbox_condition_go_to${newUniqueId}" name="textbox_condition_go_to">
                                        <label class="custom-control-label" for="textbox_condition_go_to${newUniqueId}">Enable Conditional Go To Page Settings</label>
                                   </div>
                                   <hr>
                                   <div class="cond_div${newUniqueId}" style="display:none;">
                                        <div class="col-md-12">
                                             <div class="form-group">
                                                  <label class="form-label" for="">Add Conditions</label>
                                             </div>
                                        </div>
                                        <div class="append_page_condition"></div>
                                        <div class="text-end">
                                             <div class="form-group">
                                                  <button type="button" class="btn btn-sm btn-primary add_condition" id="add_condition">Add Condition</button>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                         </div>
                         <br>
                    </div>`;

               $('.add_qu_sec').append(html);
          }
          
          conditionalQuestions(newUniqueId);

          $('#condition_qu_label'+newUniqueId).change(function(){
               conditionalQuestions(newUniqueId);
          });

          conditionalPageSetting(newUniqueId);
          $('#textbox_condition_go_to'+newUniqueId).change(function(){
               conditionalPageSetting(newUniqueId);
          })
     }
</script>


@endsection