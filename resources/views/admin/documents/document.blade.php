@extends('admin_layout.master')
@section('content')

<div class="nk-content">
     <div class="container-fluid">
          @if(isset($document) && $document != null)
          <form action="" method="post" enctype="multipart/form-data">
          @else
          <form action="{{ url('admin-dashboard/add-documents') }}" method="post" enctype="multipart/form-data">
          @endif
               @csrf
               <input type="hidden" name="slug" id="slug" value="">
               <div class="card card-bordered card-preview">
                    <div class="card-inner">
                         <div class="col-md-8 pb-2">
                              <div class="form-group">
                                   <label class="form-label" for="title"><b><h4>@if(isset($document) && $document != null) Edit Document @else Add New Document @endif</b></h4></label>
                                   <input type="text" class="form-control form-control-lg" id="title" name="title" placeholder="Add title" value="{{ $document->title ?? '' }}">
                              </div>
                         </div>
                         <hr>
                         <div class="col-md-8">
                              <div class="form-group">
                                   <label class="form-label" for="document_image">Image</label>
                                   <input type="file" class="form-control" id="document_image" name="document_image" value="">
                              </div>
                         </div>
                         <hr>
                         <h5>Document Short Description</h5>  
                         <hr>
                         <div class="col-md-8">
                              <div class="form-group">
                                   <label class="form-label" for="short_description">Short Description</label>
                                   <textarea class="form-control" id="short_description" name="short_description">{{ $document->short_description ?? '' }}</textarea>
                              </div>
                         </div>
                         <div class="col-md-8">
                              <div class="form-group">
                                   <label class="form-label" for="document_button_text">Create Document Button Text</label>
                                   <input type="text" class="form-control" id="document_button_text" name="document_button_text" value="{{ $document->btn_text ?? '' }}">
                              </div>
                         </div>
                    </div>
               </div>
               <div class="card card-bordered card-preview">
                    <div class="card-inner">
                         <div class="col-md-8">
                              <div class="form-group">
                                   <label class="form-label" for="long_description">Long Description</label>
                                   <textarea id="long_description" name="long_description">{{ $document->long_description ?? '' }}</textarea>
                              </div>
                         </div>
                    </div>
               </div>
               <div class="card card-bordered card-preview">
                    <div class="card-inner">
                         <h5>Documents Field</h5> 
                         <hr>
                         <h6>Image and text</h6>
                         <div class="card card-bordered card-preview">
                              <div class="second-sec m-4" id="second-repeat-sec">
                              @if(isset($document->documentField) && $document->documentField != null)
                                   @foreach($document->documentField as $field)
                                   <div class="img-txt-section">
                                        <div class="col-md-8">
                                             <div class="form-group">
                                                  <label class="form-label" for="img_heading">Heading</label>
                                                  <input type="text" class="form-control" id="img_heading" name="img_heading[]" value="{{ $field->heading ?? '' }}">
                                             </div>
                                        </div>
                                        <div class="col-md-8">
                                             <div class="form-group">
                                                  <label class="form-label" for="img_description">Description Here</label>
                                                  <textarea class="form-control" id="img_description" name="img_description[]">{{ $field->description ?? '' }}</textarea>
                                             </div>
                                        </div>
                                        <div class="col-md-8">
                                             <div class="form-group">
                                                  <label class="form-label" for="upload_image">Upload Image</label>
                                                  <input type="file" class="form-control" id="upload_image" name="upload_image[]" value="">
                                             </div>
                                        </div>
                                   </div>
                                   @endforeach
                                   @endif
                                   <br>
                                   <div class="col-md-5 offset-md-7">
                                        <div class="form-group">
                                             <button type="button" class="btn btn-sm btn-primary" id="second-section-add">Add Row</button>
                                        </div>
                                   </div>
                                   <div id="img-txt-section"></div>
                              </div>
                         </div>
                         <hr>
                         <h6>Guide Section</h6>
                         <div class="card card-bordered card-preview">
                              <div class="guide-section m-4">
                                   <div class="col-md-8">
                                        <div class="form-group">
                                             <label class="form-label" for="guide_heading">Guide Section Main Heading</label>
                                             <input type="text" class="form-control form-control" id="guide_heading" name="guide_heading" value="{{ $document->guide_main_heading ?? '' }}">
                                        </div>
                                   </div>
                                   <div class="col-md-8">
                                        <div class="form-group">
                                             <label class="form-label">Guide Section Steps</label>
                                        </div>
                                   </div>
                                   @if(isset($document->documentGuide) && $document->documentGuide != null)
                                   @foreach($document->documentGuide as $guide)
                                   <div class="guide-append-sec">
                                        <hr>
                                        <div class="col-md-3 offset-md-9">
                                             <div class="form-group">
                                                  <div class="remove-guide"><span><i class="fa fa-times"></i></span></div>
                                             </div>
                                        </div>
                                        <div class="row gy-12">
                                             <div class="col-md-4">
                                                       <div class="form-group">
                                                       <label class="form-label" for="step_title">Step Title</label>
                                                       <input type="text" class="form-control form-control" id="step_title" name="step_title[]" value="{{ $guide->step_title }}">
                                                  </div>
                                             </div>
                                             <div class="col-md-4">
                                                  <div class="form-group">
                                                       <label class="form-label" for="step_description">Step Description</label>
                                                       <textarea class="form-control" id="step_description" name="step_description[]">{{ $guide->step_description ?? '' }}</textarea>
                                                  </div>
                                             </div>
                                        </div>
                                   </div>
                                   @endforeach
                                   @endif
                                   <div class="col-md-5 offset-md-7">
                                        <div class="form-group">
                                             <button type="button" class="btn btn-sm btn-primary" id="add-guide-sec">Add Row</button>
                                        </div>
                                   </div>
                                   <div id="guide-sec-steps"></div>
                              </div>
                         </div>
                         <hr>
                         <h6>Legal Document</h6>
                         <div class="card card-bordered card-preview">
                              <div class="legal-section m-4">
                                   <div class="col-md-8">
                                        <div class="form-group">
                                             <label class="form-label" for="legal_heading">Heading</label>
                                             <input type="text" class="form-control form-control" id="legal_heading" name="legal_heading" value="{{ $document->legal_heading ?? '' }}">
                                        </div>
                                   </div>
                                   <div class="col-md-8">
                                        <div class="form-group">
                                             <label class="form-label" for="legal_description">Description</label>
                                             <textarea class="form-control" id="legal_description" name="legal_description">{{ $document->legal_description ?? '' }}</textarea>
                                        </div>
                                   </div>
                                   <div class="col-md-8">
                                        <div class="form-group">
                                             <label class="form-label" for="legal_btn_text">Button Label</label>
                                             <input type="text" class="form-control" id="legal_btn_text" name="legal_btn_text" value="{{ $document->legal_btn_text ?? '' }}">
                                        </div>
                                   </div>
                                   <div class="col-md-8">
                                        <div class="form-group">
                                             <label class="form-label" for="legal_btn_link">Button Link</label>
                                             <input type="text" class="form-control" id="legal_btn_link" name="legal_btn_link" value="{{ $document->legal_btn_link ?? '' }}">
                                        </div>
                                   </div>
                                   <div class="col-md-8">
                                        <div class="form-group">
                                             <label class="form-label" for="legal_doc_image">Document Image</label>
                                             <input type="file" class="form-control" id="legal_doc_image" name="legal_doc_image" value="">
                                        </div>
                                   </div>
                              </div>
                         </div>
                         <hr>
                         <p><b>Approved ?</b></p>
                         <div class="approved-section m-4">
                              <div class="col-md-8">
                                   <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="approved" name="approved" value="1">
                                        <label class="custom-control-label" for="approved"></label>
                                   </div>
                              </div>
                         </div>
                         <hr>
                         <div class="m-4">
                              <div class="col-md-8">
                                   <div class="form-group">
                                        <label class="form-label" for="valid_in">Valid in</label>
                                        <input type="text" class="form-control form-control" id="valid_in" name="valid_in" value="{{ $document->valid_in ?? '' }}">
                                   </div>
                              </div>
                         </div>
                         <div class="m-4">
                              <div class="col-md-8">
                                   <div class="form-group">
                                        <label class="form-label" for="category_id">Categories</label>   
                                        <select class="form-select js-select2" multiple="multiple" name="category_id[]" id="category_id">
                                             <option value="">Select a category</option>
                                             @foreach($categories as $category)
                                                  <option value="{{ $category->id }}">{{ $category->name }}</option>
                                             @endforeach
                                        </select>
                                   </div>
                              </div>
                         </div>
                         <h6>Faq</h6>
                         <div class="card card-bordered card-preview">
                              <div class="faq-section m-4">
                                   <div class="col-md-8">
                                        <div class="form-group">
                                             <label class="form-label" for="faq_heading">Faq heading</label>
                                             <input type="text" class="form-control form-control" id="faq_heading" name="faq_heading" value="{{ $document->faq_heading ?? '' }}">
                                        </div>
                                   </div>
                                   <div class="col-md-8">
                                        <div class="form-group">
                                             <label class="form-label">Question Answers</label>
                                        </div>
                                   </div>
                                   <div class="col-md-5 offset-md-7">
                                        <div class="form-group">
                                             <button type="button" class="btn btn-sm btn-primary" id="add-faq-sec">Add Row</button>
                                        </div>
                                   </div>
                                   <div id="faq-steps"></div>
                              </div>
                         </div>
                         <hr>
                         <h6>Related Document Section</h6>
                         <div class="card card-bordered card-preview">
                              <div class="faq-section m-4">
                                   <div class="col-md-8">
                                        <div class="form-group">
                                             <label class="form-label" for="related_heading">Related Document Heading</label>
                                             <input type="text" class="form-control" id="related_heading" name="related_heading" value="{{ $document->related_heading ?? '' }}">
                                        </div>
                                   </div>
                                   <div class="col-md-8">
                                        <div class="form-group">
                                             <label class="form-label" for="related_description">Related Document Short Description</label>
                                             <textarea class="form-control" id="related_description" name="related_description">{{ $document->related_description ?? '' }}</textarea>
                                        </div>
                                   </div>
                                   <div class="col-md-8">
                                        <div class="form-group">
                                             <label class="form-label" for="select_related_doc">Select Related Documents</label>
                                             <select class="form-select" id="select_related_doc" name="select_related_doc[]" >
                                                  <option value="">Select</option>
                                             </select>
                                        </div>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>
               <div class="card card-bordered card-preview">
                    <div class="card-inner">
                         <h5>Additional Information</h5> 
                         <hr>
                         <div class="col-md-8">
                              <div class="form-group">
                                   <label class="form-label" for="additional_info">Additional Information</label>
                                   <textarea class="form-control" id="additional_info" name="additional_info">{{ $document->additional_info ?? '' }}</textarea>
                              </div>
                         </div>
                    </div>
               </div>
               <div class="card card-bordered card-preview">
                    <div class="card-inner">
                         <h5>Document Price</h5> 
                         <hr>
                         <div class="col-md-8">
                              <div class="form-group">
                                   <label class="form-label" for="doc_price">Price *</label>
                                   <input type="text" class="form-control" id="doc_price" name="doc_price" value="{{ $document->doc_price ?? '' }}">
                              </div>
                         </div>
                         <div class="col-md-8">
                              <div class="form-group">
                                   <label class="form-label" for="no_of_downloads">No of downloads</label>
                                   <input type="number" class="form-control" id="no_of_downloads" name="no_of_downloads" value="{{ $document->no_of_downloads ?? '' }}">
                              </div>
                         </div>
                         <div class="col-md-8">
                              <div class="form-group">
                                   <label class="form-label" for="total_likes">Total Likes</label>
                                   <input type="text" class="form-control" id="total_likes" name="total_likes" value="{{ $document->total_likes ?? '' }}">
                              </div>
                         </div>
                         <div class="col-md-8">
                              <div class="form-group">
                                   <label class="form-label" for="discount_price">Discount price</label>
                                   <input type="text" class="form-control" id="discount_price" name="discount_price" value="{{ $document->discount_price ?? '' }}">
                              </div>
                         </div>
                    </div>
               </div>
               <div class="card card-bordered card-preview">
                    <div class="card-inner">
                         <h5>Reviews</h5> 
                         <hr>
                         <div class="col-md-8">
                              <div class="custom-control custom-checkbox">
                                   <input type="checkbox" class="custom-control-input" id="customCheck1" checked>
                                   <label class="custom-control-label" for="customCheck1">Allow reviews.</label>
                              </div>
                         </div>
                         <div class="col-md-8">
                              <div class="form-group">
                                   <p>No reviews yet.</p>
                              </div>
                         </div>
                    </div>
               </div>
               <div class="mt-3">
                    <button class="btn btn-primary" type="submit">Save</button>
               </div>
          </form>
     </div>
</div>

<script>
     $('#title').on('keyup',function(){
          const name = $(this).val();
          const url = name.toLowerCase().replace(/ /g,'-').replace(/[^\w-]+/g, '');
          $('#slug').val(url);
     })

     ClassicEditor
     .create( document.querySelector('#short_description'))
     .catch( error => {
          console.error( error );
     });

     ClassicEditor
     .create( document.querySelector('#long_description'))
     .catch( error => {
          console.error( error );
     });

     ClassicEditor
     .create( document.querySelector('#img_description'))
     .catch( error => {
          console.error( error );
     });
    
     ClassicEditor
     .create( document.querySelector('#additional_info'))
     .catch( error => {
          console.error( error );
     });
     

</script>

<script>
     $(document).ready(function(){

          // Append Second section //
          $('#second-section-add').on('click',function(){
               var html = `<div class="append-container">
                              <hr>
                              <div class="col-md-4 offset-md-8">
                                   <div class="form-group">
                                        <div class="remove-second-sec"><span><i class="fa fa-times"></i></span></div>
                                   </div>
                              </div>
                              <div class="second-append-sec" id="second-append-sec">
                                   <div class="col-md-8">
                                        <div class="form-group">
                                             <label class="form-label" for="img_heading">Heading</label>
                                             <input type="text" class="form-control" id="img_heading" name="img_heading[]" value="">
                                        </div>
                                   </div>
                                   <div class="col-md-8">
                                        <div class="form-group">
                                             <label class="form-label" for="img_description">Description Here</label>
                                             <textarea class="description-editor" id="img_description" name="img_description[]"></textarea>
                                        </div>
                                   </div>
                                   <div class="col-md-8">
                                        <div class="form-group">
                                             <label class="form-label" for="upload_image">Upload Image</label>
                                             <input type="file" class="form-control" id="upload_image" name="upload_image[]" value="">
                                        </div>
                                   </div>
                              </div>
                         </div>`
               $('#img-txt-section').append(html);

               // Intialized ck editor with appended row //
               $('.description-editor').each(function() {
                    if (!$(this).data('ckeditor-initialized')) {
                         ClassicEditor
                              .create(this)
                              .catch(error => {
                                   console.error(error);
                              });
                         $(this).data('ckeditor-initialized', true); // Mark as initialized
                    }
               });
              
          });

          // Remove second section //
          $('body').delegate('.remove-second-sec','click',function(){
              $(this).closest('.append-container').hide();
          });


          // Append Guide section // 
          $('#add-guide-sec').click(function(){
               var html = `<div class="guide-append-sec">
                              <hr>
                              <div class="col-md-3 offset-md-9">
                                   <div class="form-group">
                                        <div class="remove-guide"><span><i class="fa fa-times"></i></span></div>
                                   </div>
                              </div>
                              <div class="row gy-12">
                                   <div class="col-md-4">
                                             <div class="form-group">
                                             <label class="form-label" for="step_title">Step Title</label>
                                             <input type="text" class="form-control form-control" id="step_title" name="step_title[]" value="">
                                        </div>
                                   </div>
                                   <div class="col-md-4">
                                        <div class="form-group">
                                             <label class="form-label" for="step_description">Step Description</label>
                                             <textarea class="form-control" id="step_description" name="step_description[]"></textarea>
                                        </div>
                                   </div>
                              </div>
                         </div>`

               $('#guide-sec-steps').append(html);
          });

          // Remove guide section //
          $('body').delegate('.remove-guide','click',function(){
              $(this).closest('.guide-append-sec').hide();
          });


          // Add Faq Section //
          $('#add-faq-sec').click(function(){
               var html = `<div class="faq-append-sec">
                              <hr>
                              <div class="col-md-3 offset-md-9">
                                   <div class="form-group">
                                        <div class="remove-faq"><span><i class="fa fa-times"></i></span></div>
                                   </div>
                              </div>
                              <div class="row gy-8">
                                   <div class="col-md-4">
                                        <div class="form-group">
                                             <label class="form-label" for="doc_question">Quiz</label>
                                             <input type="text" class="form-control" id="doc_question" name="doc_question[]" value="">
                                        </div>
                                   </div>
                                   <div class="col-md-4">
                                        <div class="form-group">
                                             <label class="form-label" for="doc_answer">Answer</label>
                                             <textarea class="answer-editor" id="doc_answer" name="doc_answer[]"></textarea>
                                        </div>
                                   </div>
                              </div>
                         </div>`

               $('#faq-steps').append(html);

               // Intialized ck editor with appended row //

               $('.answer-editor').each(function() {
                    if (!$(this).data('ckeditor-initialized')) {
                         ClassicEditor
                              .create(this)
                              .catch(error => {
                                   console.error(error);
                              });
                         $(this).data('ckeditor-initialized', true); 
                    }
               });
          });


          // Remove Faq section //
          $('body').delegate('.remove-faq','click',function(){
              $(this).closest('.faq-append-sec').hide();
          });

     });

  
</script>


@endsection