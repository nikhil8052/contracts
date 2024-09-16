@extends('admin_layout.master')
@section('content')

<div class="nk-content">
     <div class="container-fluid">
          <form action="" method="post" enctype="multipart/form-data">
               @csrf
               <div class="col-md-8 pb-2">
                    <div class="form-group">
                         <label class="form-label" for="document-title"><b><h4>Document Title</b></h4></label>
                         <input type="text" class="form-control form-control-lg" id="document-title" name="document-title" value="">
                    </div>
               </div>
               <div class="card card-bordered card-preview">
                    <div class="card-inner">
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
                                   <label class="form-label" for="document-button-text">Document Button Text</label>
                                   <input type="text" class="form-control" id="document-button-text" name="document-button-text" value="">
                              </div>
                         </div>
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
                              <div class="img-txt-section m-4">
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
                                   <button class="btn btn-primary">Add Row</button>
                              </div>
                              <hr>
                              <h6>Guide Section</h6>
                              <div class="guide-section m-4">
                                   <div class="col-md-8">
                                        <div class="form-group">
                                             <label class="form-label" for="">Guide Section Main Hedaing</label>
                                             <input type="text" class="form-control form-control" id="" name="" value="">
                                        </div>
                                   </div>
                                   <div class="col-md-8">
                                        <div class="form-group">
                                             <label class="form-label" for="">Guide Section Steps</label>
                                        </div>
                                   </div>
                                   <button class="btn btn-primary">Add Row</button>
                              </div>
                              <hr>
                              <h6>Legal Document</h6>
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
                              <hr>
                              <h6>Approved ?</h6>
                              <div class="approved-section m-4">
                                   <div class="col-md-8">
                                        <!-- <div class="form-group">
                                             <label class="form-label" for="legal-heading">Heading</label>
                                             <input type="text" class="form-control form-control" id="legal-heading" name="legal-heading" value="">
                                        </div> -->
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
                              <hr>
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
                                             <div class="form-group">
                                                  <label class="form-label" for="faq-heading">Question Answers</label>
                                             </div>
                                        </div>
                                        <button class="btn btn-primary">Add Row</button>
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
                              <div class="mt-3">
                                   <button class="btn btn-primary" type="submit">Save</button>
                              </div>
                         </div>
                    </div>
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
    

</script>

@endsection