@extends('admin_layout.master')
@section('content')

<div class="nk-content">
     <div class="container-fluid">
          <form action="{{ url('admin-dashboard/add-documents') }}" method="post" enctype="multipart/form-data">
               @csrf
               
               <div class="card card-bordered card-preview">
                    <div class="card-inner">
                         <div class="col-md-8 pb-2">
                              <div class="form-group">
                                   <label class="form-label" for="document-title"><b><h4>Add New Document</b></h4></label>
                                   <input type="text" class="form-control form-control-lg" id="document-title" name="document-title" placeholder="Add title" value="">
                              </div>
                         </div>
                         <hr>
                         <h5>Document Short Description</h5>  
                         <hr>
                         <div class="col-md-8">
                              <div class="form-group">
                                   <label class="form-label" for="short-description">Short Description</label>
                                   <textarea id="short-description" name="short-description"></textarea>
                              </div>
                         </div>
                         <div class="col-md-8">
                              <div class="form-group">
                                   <label class="form-label" for="document-button-text">Create Document Button Text</label>
                                   <input type="text" class="form-control" id="document-button-text" name="document-button-text" value="">
                              </div>
                         </div>
                    </div>
               </div>
               <div class="card card-bordered card-preview">
                    <div class="card-inner">
                         <div class="col-md-8">
                              <div class="form-group">
                                   <label class="form-label" for="long-description">Long Description</label>
                                   <textarea id="long-description" name="long-description"></textarea>
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
                                   <div class="img-txt-section" id="img-txt-section">
                                        <div class="col-md-8">
                                             <div class="form-group">
                                                  <label class="form-label" for="img-heading">Heading</label>
                                                  <input type="text" class="form-control form-control" id="img-heading" name="img-heading" value="">
                                             </div>
                                        </div>
                                        <div class="col-md-8">
                                             <div class="form-group">
                                                  <label class="form-label" for="description-here">Description Here</label>
                                                  <textarea id="description-here" name="description-here"></textarea>
                                             </div>
                                        </div>
                                        <div class="col-md-8">
                                             <div class="form-group">
                                                  <label class="form-label" for="upload-image">Upload Image</label>
                                                  <input type="file" class="form-control form-control" id="upload-image" name="upload-image" value="">
                                             </div>
                                        </div>
                                   </div>
                                   <br>
                                   <div class="col-md-5 offset-md-7">
                                        <div class="form-group">
                                             <button type="button" class="btn btn-sm btn-primary" id="second-section-add">Add Row</button>
                                        </div>
                                   </div>
                              </div>
                         </div>
                         <hr>
                         <h6>Guide Section</h6>
                         <div class="card card-bordered card-preview">
                              <div class="guide-section m-4">
                                   <div class="col-md-8">
                                        <div class="form-group">
                                             <label class="form-label" for="">Guide Section Main Hedaing</label>
                                             <input type="text" class="form-control form-control" id="" name="" value="">
                                        </div>
                                   </div>
                                   <div class="col-md-8">
                                        <div class="form-group" id="guide-sec-steps">
                                             <label class="form-label" for="">Guide Section Steps</label>
                                        </div>
                                   </div>
                                   <div class="col-md-5 offset-md-7">
                                        <div class="form-group">
                                             <button type="button" class="btn btn-sm btn-primary" id="add-guide-sec">Add Row</button>
                                        </div>
                                   </div>
                              </div>
                         </div>
                         <hr>
                         <h6>Legal Document</h6>
                         <div class="card card-bordered card-preview">
                              <div class="legal-section m-4">
                                   <div class="col-md-8">
                                        <div class="form-group">
                                             <label class="form-label" for="legal-heading">Heading</label>
                                             <input type="text" class="form-control form-control" id="legal-heading" name="legal-heading" value="">
                                        </div>
                                   </div>
                                   <div class="col-md-8">
                                        <div class="form-group">
                                             <label class="form-label" for="legal-description">Description</label>
                                             <input type="text" class="form-control form-control" id="legal-description" name="legal-description" value="">
                                        </div>
                                   </div>
                                   <div class="col-md-8">
                                        <div class="form-group">
                                             <label class="form-label" for="button-label">Button Label</label>
                                             <input type="text" class="form-control form-control" id="button-label" name="button-label" value="">
                                        </div>
                                   </div>
                                   <div class="col-md-8">
                                        <div class="form-group">
                                             <label class="form-label" for="button-link">Button Link</label>
                                             <input type="text" class="form-control form-control" id="button-link" name="button-link" value="">
                                        </div>
                                   </div>
                                   <div class="col-md-8">
                                        <div class="form-group">
                                             <label class="form-label" for="document-image">Document Image</label>
                                             <input type="file" class="form-control form-control" id="document-image" name="document-image" value="">
                                        </div>
                                   </div>
                              </div>
                         </div>
                         <hr>
                         <p><b>Approved ?</b></p>
                         <div class="approved-section m-4">
                              <div class="col-md-8">
                                   <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="customSwitch1">
                                        <label class="custom-control-label" for="customSwitch1"></label>
                                   </div>
                              </div>
                         </div>
                         <hr>
                         <div class="m-4">
                              <div class="col-md-8">
                                   <div class="form-group">
                                        <label class="form-label" for="valid-in">Valid in</label>
                                        <input type="text" class="form-control form-control" id="valid-in" name="valid-in" value="">
                                   </div>
                              </div>
                         </div>
                         <h6>Faq</h6>
                         <div class="card card-bordered card-preview">
                              <div class="faq-section m-4">
                                   <div class="col-md-8">
                                        <div class="form-group">
                                             <label class="form-label" for="faq-heading">Faq heading</label>
                                             <input type="text" class="form-control form-control" id="faq-heading" name="faq-heading" value="">
                                        </div>
                                   </div>
                                   <div class="col-md-8">
                                        <div class="form-group" id="faq-steps">
                                             <label class="form-label" for="">Question Answers</label>
                                        </div>
                                   </div>
                                   <div class="col-md-5 offset-md-7">
                                        <div class="form-group">
                                             <button type="button" class="btn btn-sm btn-primary" id="add-faq-sec">Add Row</button>
                                        </div>
                                   </div>
                              </div>
                         </div>
                         <hr>
                         <h6>Related Document Section</h6>
                         <div class="card card-bordered card-preview">
                              <div class="faq-section m-4">
                                   <div class="col-md-8">
                                        <div class="form-group">
                                             <label class="form-label" for="related-heading">Related Document Heading</label>
                                             <input type="text" class="form-control" id="related-heading" name="related-heading" value="">
                                        </div>
                                   </div>
                                   <div class="col-md-8">
                                        <div class="form-group">
                                             <label class="form-label" for="related-description">Related Document Short Description</label>
                                             <textarea id="related-description" name="related-description"></textarea>
                                        </div>
                                   </div>
                                   <div class="col-md-8">
                                        <div class="form-group">
                                             <label class="form-label" for="select-related-doc">Select Related Documents</label>
                                             <select class="form-select" id="select-related-doc" name="select-related-doc">
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
                         <h5>Contrato Form Html</h5> 
                         <hr>
                         <div class="col-md-8">
                              <div class="form-group">
                                   <label class="form-label" for="contrato-file">Upload Html File</label>
                                   <input type="file" class="form-control form-control" id="contrato-file" name="contrato-file" value="">
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
                                   <label class="form-label" for="additional-info">Additional Information</label>
                                   <textarea id="additional-info" name="additional-info"></textarea>
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
                                   <label class="form-label" for="document-price">Price *</label>
                                   <input type="text" class="form-control" id="document-price" name="document-price" value="">
                              </div>
                         </div>
                         <div class="col-md-8">
                              <div class="form-group">
                                   <label class="form-label" for="no-of-downloads">No of downloads</label>
                                   <input type="number" class="form-control" id="no-of-downloads" name="no-of-downloads" value="">
                              </div>
                         </div>
                         <div class="col-md-8">
                              <div class="form-group">
                                   <label class="form-label" for="total-likes">Total Likes</label>
                                   <input type="text" class="form-control" id="total-likes" name="total-likes" value="">
                              </div>
                         </div>
                         <div class="col-md-8">
                              <div class="form-group">
                                   <label class="form-label" for="discount-price">Discount price</label>
                                   <input type="text" class="form-control" id="discount-price" name="discount-price" value="">
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
     ClassicEditor
     .create( document.querySelector('#short-description'))
     .catch( error => {
          console.error( error );
     });

     ClassicEditor
     .create( document.querySelector('#long-description'))
     .catch( error => {
          console.error( error );
     });

     ClassicEditor
     .create( document.querySelector('#description-here'))
     .catch( error => {
          console.error( error );
     });

     ClassicEditor
     .create( document.querySelector('#related-description'))
     .catch( error => {
          console.error( error );
     });
    
     ClassicEditor
     .create( document.querySelector('#additional-info'))
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
                                             <label class="form-label" for="img-heading">Heading</label>
                                             <input type="text" class="form-control form-control" id="img-heading" name="img-heading" value="">
                                        </div>
                                   </div>
                                   <div class="col-md-8">
                                        <div class="form-group">
                                             <label class="form-label" for="description-here">Description Here</label>
                                             <textarea class="description-editor" id="description-here" name="description-here"></textarea>
                                        </div>
                                   </div>
                                   <div class="col-md-8">
                                        <div class="form-group">
                                             <label class="form-label" for="upload-image">Upload Image</label>
                                             <input type="file" class="form-control form-control" id="upload-image" name="upload-image" value="">
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
              
          })

          // Remove second section //
          $('body').delegate('.remove-second-sec','click',function(){
              $(this).closest('.append-container').hide();
          })


          // Append Guide section // 
          $('#add-guide-sec').click(function(){
               var html = `<div class="guide-append-sec">
                              <hr>
                              <div class="col-md-3 offset-md-9">
                                   <div class="form-group">
                                        <div class="remove-guide"><span><i class="fa fa-times"></i></span></div>
                                   </div>
                              </div>
                              <div class="row gy-4">
                                   <div class="col-md-5">
                                             <div class="form-group">
                                             <label class="form-label" for="step-title">Step Title</label>
                                             <input type="text" class="form-control form-control" id="step-title" name="step-title" value="">
                                        </div>
                                   </div>
                                   <div class="col-md-5">
                                        <div class="form-group">
                                             <label class="form-label" for="step-description">Step Description</label>
                                             <textarea id="step-description" name="step-description"></textarea>
                                        </div>
                                   </div>
                              </div>
                         </div>`

               $('#guide-sec-steps').append(html);
          })

          // Remove guide section //
          $('body').delegate('.remove-guide','click',function(){
              $(this).closest('.guide-append-sec').hide();
          })


          // Add Faq Section //
          $('#add-faq-sec').click(function(){
               var html = `<div class="faq-append-sec">
                              <hr>
                              <div class="col-md-2 offset-md-10">
                                   <div class="form-group">
                                        <div class="remove-faq"><span><i class="fa fa-times"></i></span></div>
                                   </div>
                              </div>
                              <div class="row gy-8">
                                   <div class="col-md-5">
                                        <div class="form-group">
                                             <label class="form-label" for="quiz">Quiz</label>
                                             <input type="text" class="form-control form-control" id="quiz" name="quiz" value="">
                                        </div>
                                   </div>
                                   <div class="col-md-5">
                                        <div class="form-group">
                                             <label class="form-label" for="quiz-answer">Answer</label>
                                             <textarea class="answer-editor" id="quiz-answer" name="quiz-answer"></textarea>
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
          })


          // Remove Faq section //
          $('body').delegate('.remove-faq','click',function(){
              $(this).closest('.faq-append-sec').hide();
          })

     })
</script>


@endsection