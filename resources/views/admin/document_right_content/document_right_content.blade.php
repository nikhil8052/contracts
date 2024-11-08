@extends('admin_layout.master')
@section('content')

<div class="nk-content">
     <div class="container-fluid">
          <form action="{{ url('/admin-dashboard/add-document-right-content') }}" method="post" enctype="multipart/form-data">
          @csrf
          <input type="hidden" id="sign_field" name="sign_field" value="">
          <input type="hidden" id="content_headings" name="content_headings" value="">
          <input type="hidden" id="content_val" name="content_val" value="">
          <div class="row main_section">
               <div class="col md-8 left-content">
                    <div class="col-md-12 doc-title mt-4 pb-4">
                         <div class="form-group">
                              <label class="form-label" for="title"><b><h4>Add New Right Content</h4></b></label>
                              <input type="text" class="form-control form-control-lg" id="title" name="title" placeholder="Add title" value="">
                         </div>
                    </div>
                    <h5>Contract Right Content</h5>
                    <div class="card card-bordered card-preview">
                         <div class="card-inner">
                              <h6>Contract Right Content</h6>
                              <div class="add_contents"></div>
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

               // var type = name;
               // let types = $('#content_headings').val();
               // if(types){
               //      types += ',' + type;
               // }else{
               //      types = type;
               // }
               $('#content_headings').val(heading_section_count);

               html = `<div class="append_content_heading" id="content_heading_${heading_section_count}">
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
                                        <input type="text" class="form-control" name="content_heading_html[]" id="content_heading_html${newUniqueId}" value="">
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>`
          }else if(name === 'content'){
               content_section_count++ ;

               // var type = name;
               // let types = $('#content_val').val();
               // if(types){
               //      types += ',' + type;
               // }else{
               //      types = type;
               // }
               $('#content_val').val(content_section_count);

               html = `<div class="append_content" id="content_${content_section_count}">
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
                                   <input type="checkbox" class="custom-control-input" id="start_new_section${newUniqueId}" name="start_new_section[]">
                                   <label class="custom-control-label" for="start_new_section${newUniqueId}"></label>
                              </div>
                              <hr>
                              <div class="start_append_section${newUniqueId}" style="display:none;">
                                   <div class="row">
                                        <div class="col-md-6">
                                             <div class="form-group">
                                                  <label class="form-label" for="text_align">Text align</label>
                                                  <div class="form-control-wrap"> 
                                                       <select class="form-select js-select2" name="text_align[]" id="text_align">
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
                                                  <input type="checkbox" class="custom-control-input" id="signature_field${newUniqueId}" name="signature_field[]">
                                                  <label class="custom-control-label" for="signature_field${newUniqueId}"></label>
                                             </div>
                                        </div>
                                   </div>
                                   <hr>
                              </div>
                              <div class="col-md-12">
                                   <div class="form-group">
                                        <label class="form-label" for="content_content_html">Content Html</label>
                                        <textarea class="form-control" name="content_content_html[]" id="content_content_html"></textarea>
                                   </div>
                              </div>
                              <hr>
                              <div class="row">
                                   <div class="col-md-6">
                                        <div class="form-group">
                                             <label class="form-label" for="content_class">Content Class</label>
                                             <input type="text" class="form-control" name="content_class[]" id="content_class" value="">
                                        </div>
                                   </div>
                                   <div class="col-md-6">
                                        <p class="p_label">Add Condition</p>
                                        <div class="custom-control custom-checkbox">
                                             <input type="checkbox" class="custom-control-input" id="add_condition${newUniqueId}" name="add_condition[]">
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
                                             <input type="checkbox" class="custom-control-input" id="secure_blurr_content${newUniqueId}" name="secure_blurr_content[]">
                                             <label class="custom-control-label" for="secure_blurr_content${newUniqueId}">Secure Blurr Content</label>
                                        </div>
                                   </div>
                                   <div class="col-md-6">
                                        <p class="p_label">Blurr Content</p>
                                        <div class="custom-control custom-checkbox">
                                             <input type="checkbox" class="custom-control-input" id="blurr_content${newUniqueId}" name="blurr_content[]">
                                             <label class="custom-control-label" for="blurr_content${newUniqueId}">Blurr Content</label>
                                        </div>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>`
          }

          $('.add_contents').append(html);

          conditionalOptions(newUniqueId);

          $('#add_condition'+newUniqueId).change(function(){
               conditionalOptions(newUniqueId);
          });

          startNewSection(newUniqueId);

          $('#start_new_section'+newUniqueId).change(function(){
               startNewSection(newUniqueId);
          });

          $('#signature_field'+newUniqueId).change(function(){
               var status = false;
               if($('#signature_field'+newUniqueId).is(':checked')){
                    status = $('#signature_field'+newUniqueId).is(':checked');
                    $('#signature_field'+newUniqueId).val(1);
               }else{
                    status = $('#signature_field'+newUniqueId).is(':checked');
                    $('#signature_field'+newUniqueId).val(0);
               }
          })

          $('#add_condition'+newUniqueId).change(function(){
               var status = false;
               if($('#add_condition'+newUniqueId).is(':checked')){
                    status = $('#add_condition'+newUniqueId).is(':checked');
                    $('#add_condition'+newUniqueId).val(1);
               }else{
                    status = $('#add_condition'+newUniqueId).is(':checked');
                    $('#add_condition'+newUniqueId).val(0);
               }
          })

          $('#secure_blurr_content'+newUniqueId).change(function(){
               var status = false;
               if($('#secure_blurr_content'+newUniqueId).is(':checked')){
                    status = $('#secure_blurr_content'+newUniqueId).is(':checked');
                    $('#secure_blurr_content'+newUniqueId).val(1);
               }else{
                    status = $('#secure_blurr_content'+newUniqueId).is(':checked');
                    $('#secure_blurr_content'+newUniqueId).val(0);
               }
          })

          $('#blurr_content'+newUniqueId).change(function(){
               var status = false;
               if($('#blurr_content'+newUniqueId).is(':checked')){
                    status = $('#blurr_content'+newUniqueId).is(':checked');
                    $('#blurr_content'+newUniqueId).val(1);
               }else{
                    status = $('#blurr_content'+newUniqueId).is(':checked');
                    $('#blurr_content'+newUniqueId).val(0);
               }
          })
     }


     function removeContent(e){
          if($(e).attr('data-field') === 'content_heading'){
               if($(e).attr('value') === 'appended'){
                    $(e).closest('.append_content_heading').remove();
               }else{
                    var id = $(e).data('id');
                    let deleteIds = $('#img_sec_ids').val();
                    if(deleteIds){
                         deleteIds += ',' + id;
                    }else{
                         deleteIds = id;
                    }
                    $('#img_sec_ids').val(deleteIds);
                    $('.append_content_heading'+id).hide();
               }
          }else if($(e).attr('data-field') === 'content'){
               if($(e).attr('value') === 'appended'){
                    $(e).closest('.append_content').remove();
               }else{
                    var id = $(e).data('id');
                    let deleteIds = $('#img_sec_ids').val();
                    if(deleteIds){
                         deleteIds += ',' + id;
                    }else{
                         deleteIds = id;
                    }
                    $('#img_sec_ids').val(deleteIds);
                    $('.append_content'+id).hide();
               }
          }
     }

     function addCondition(id){
          const html = `<div class="condition-section">
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
                                        <input type="text" class="form-control" id="condition_question_id" name="condition_question_id[]" value="">
                                   </div>
                              </div>
                              <div class="col-md-4">
                                   <div class="form-group">
                                        <label class="form-label" for="conditions">Condition</label>
                                        <div class="form-control-wrap"> 
                                             <select class="form-select js-select2" name="conditions[]" id="conditions">
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
                                        <label class="form-label" for="condition_question_label">Question Value</label>
                                        <input type="text" class="form-control" id="condition_question_label" name="condition_question_label[]" value="">
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
               var id = $(e).data('id');
               let deleteIds = $('#img_sec_ids').val();
               if(deleteIds){
                    deleteIds += ',' + id;
               }else{
                    deleteIds = id;
               }
               $('#img_sec_ids').val(deleteIds);
               $('.condition-section'+id).hide();
          }
     }

     function conditionalOptions(id){
          if($('#add_condition'+id).is(':checked')){
               $('.add_condition_section'+id).show();
          }else{
               $('.add_condition_section'+id).hide();
          }
     }
     
     function startNewSection(id){
          let status = false;
          if($('#start_new_section'+id).is(':checked')){
               status = $('#start_new_section'+id).is(':checked');
               $('#start_new_section'+id).val(1);
               $('.start_append_section'+id).show();
          }else{
               status = $('#start_new_section'+id).is(':checked');
               $('#start_new_section'+id).val(0);
               $('.start_append_section'+id).hide();
          }
     }
</script>


@endsection