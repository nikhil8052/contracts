@extends('admin_layout.master')
@section('content')

<div class="nk-content">
     <div class="container-fluid">
          @if(isset($document) && $document != null)
          <form action="{{ url('admin-dashboard/add-documents') }}" method="post" enctype="multipart/form-data">
          @else
          <form action="{{ url('admin-dashboard/add-documents') }}" method="post" enctype="multipart/form-data">
          @endif
               @csrf
               <input type="hidden" name="id" value="{{ $document->id ?? '' }}">
               <input type="hidden" name="img_sec_ids" id="img_sec_ids" value="">
               <input type="hidden" name="guide_sec_ids" id="guide_sec_ids" value="">
               <input type="hidden" name="agg_sec_ids" id="agg_sec_ids" value="">
               <input type="hidden" name="slug" id="slug" value="{{ $document->slug ?? '' }}">
               <div class="card card-bordered card-preview separate-fields">
                    <div class="card-inner">
                         <p><b>Approved ?</b></p>
                         <div class="approved-section m-4">
                              <div class="col-md-8">
                                   <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input approved" id="approved" name="approved" value="0">
                                        <label class="custom-control-label" for="approved"></label>
                                   </div>
                              </div>
                         </div>
                         <hr>
                         <div class="valid-in">
                              <div class="col-md-8">
                                   <div class="form-group">
                                        <label class="form-label" for="valid_in">Valid in</label>
                                        <input type="text" class="form-control form-control" id="valid_in" name="valid_in" value="{{ $document->valid_in ?? '' }}">
                                   </div>
                              </div>
                         </div>
                         <hr>
                         <div class="categories">
                              <div class="col-md-8">
                                   <div class="form-group">
                                        <label class="form-label" for="category_id">Categories</label>  
                                        <div class="form-control-wrap"> 
                                             <select class="form-select js-select2" multiple="multiple" name="category_id[]" id="category_id">
                                                  @if(isset($categories) && $categories != null)
                                                  @foreach($categories as $category)
                                                       @if(isset($document->category_id) && $document->category_id != null)
                                                            <?php $categoryIDs = json_decode($document->category_id);?>
                                                            @if(in_array($category->id,$categoryIDs))
                                                                 <option value="{{ $category->id ?? '' }}" selected>{{ $category->name ?? '' }}</option>
                                                            @else
                                                            <option value="{{ $category->id ?? '' }}">{{ $category->name ?? '' }}</option>
                                                            @endif
                                                       @else
                                                       <option value="{{ $category->id ?? '' }}">{{ $category->name ?? '' }}</option>
                                                       @endif
                                                  @endforeach
                                                  @endif
                                             </select>
                                        </div>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>
               <div class="card card-bordered card-preview">
                    <div class="card-inner">
                         <div class="col-md-8 pb-2">
                              <div class="form-group">
                                   <label class="form-label" for="title"><b><h4>@if(isset($document) && $document != null) Edit Document @else Add New Document @endif</b></h4></label>
                                   <input type="text" class="form-control form-control-lg" id="title" name="title" placeholder="Add title" value="{{ $document->title ?? '' }}">
                              </div>
                         </div>
                         <hr>
                         @if(isset($document) && $document != null)

                         @else
                         <div class="col-md-8">
                              <div class="form-group">
                                   <label class="form-label" for="document_image">Image</label>
                                   <input type="file" class="form-control" id="document_image" name="document_image" value="">
                              </div>
                         </div>
                         <hr>
                         @endif
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
                         <h5>Agreement Section</h5>
                         <hr>
                         <div class="col-md-8">
                              <div class="form-group">
                                   <label class="form-label" for="long_description">Long Description</label>
                                   <textarea id="long_description" name="long_description">{{ $document->long_description ?? '' }}</textarea>
                              </div>
                         </div>
                         <div class="col-md-8">
                              <div class="form-group">
                                   <label class="form-label" for="">Agreement Steps</label>
                              </div>
                         </div>  
                         @if(isset($document->documentAgreement) && $document->documentAgreement != null)
                         @foreach($document->documentAgreement as $agrmnt)
                         <div class="faq-append-sec{{ $agrmnt->id ?? '' }}">
                              <div class="col-md-2 offset-md-10">
                                   <div class="form-group">
                                        <div><span class="remove-faq" data-id="{{ $agrmnt->id ?? '' }}"><i class="fa fa-times"></i></span></div>
                                   </div>
                              </div>
                              <div class="row gy-8">
                                   <div class="col-md-3">
                                        <div class="form-group">
                                             <img src="{{ asset('storage/'.$agrmnt->media->file_name ?? '' ) }}" alt="">
                                        </div>
                                   </div>
                                   <div class="col-md-3">
                                        <div class="form-group">
                                             <label class="form-label" for="agreement_heading">Heading</label>
                                             <input type="text" class="form-control" id="agreement_heading" name="agreement_heading[{{ $agrmnt->id ?? '' }}]" value="{{ $agrmnt->heading ?? '' }}">
                                        </div>
                                   </div>
                                   <div class="col-md-4">
                                        <div class="form-group">
                                             <label class="form-label" for="agreement_description">Description</label>
                                             <textarea class="form-control" id="agreement_description" name="agreement_description[{{ $agrmnt->id ?? '' }}]">{{ $agrmnt->description ?? '' }}</textarea>
                                        </div>
                                   </div>
                              </div>
                         </div>
                         @endforeach
                         @endif
                         <br>
                         <div class="col-md-3 offset-md-9">
                              <div class="form-group">
                                   <button type="button" class="btn btn-sm btn-primary" id="add-sec">Add Row</button>
                              </div>
                         </div>                      
                         <div id="steps"></div>
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
                                   @foreach($document->documentField as $index=>$field)
                                   <div class="img-txt-section{{ $field->id ?? '' }}">
                                        <div class="col-md-4 offset-md-8">
                                             <div class="form-group">
                                                  <div><span class="remove-second-sec" data-id="{{ $field->id ?? '' }}"><i class="fa fa-times"></i></span></div>
                                             </div>
                                        </div>
                                        <div class="col-md-8">
                                             <div class="form-group">
                                                  <label class="form-label" for="img_heading">Heading</label>
                                                  <input type="text" class="form-control" id="img_heading" name="img_heading[{{ $field->id ?? '' }}]" value="{{ $field->heading ?? '' }}">
                                             </div>
                                        </div>
                                        <div class="col-md-8">
                                             <div class="form-group">
                                                  <label class="form-label" for="img_description">Description Here</label>
                                                  <textarea class="form-control" id="img_description{{ $index ?? '' }}" name="img_description[{{ $field->id ?? '' }}]">{{ $field->description ?? '' }}</textarea>
                                             </div>
                                        </div>
                                        <br>
                                        <div class="col-md-8">
                                             <div class="form-group">
                                                  <img src="{{ asset('storage/'.$field->media->file_name ?? '' ) }}" height="220px" width="220px">
                                             </div>
                                        </div>
                                   </div>
                                   <hr>
                                   <script>  ClassicEditor.create( document.querySelector('#img_description{{ $index }}')); </script>
                                   @endforeach
                              @else
                              <div class="img-txt-section">
                                   <div class="col-md-8">
                                        <div class="form-group">
                                             <label class="form-label" for="img_heading">Heading</label>
                                             <input type="text" class="form-control" id="img_heading" name="img_heading[]" value="">
                                        </div>
                                   </div>
                                   <div class="col-md-8">
                                        <div class="form-group">
                                             <label class="form-label" for="img_description">Description Here</label>
                                             <textarea class="form-control" id="img_description" name="img_description[]"></textarea>
                                        </div>
                                   </div>
                                   <div class="col-md-8">
                                        <div class="form-group">
                                             <label class="form-label" for="upload_image">Upload Image</label>
                                             <input type="file" class="form-control" id="upload_image" name="upload_image[]" value="">
                                        </div>
                                   </div>
                              </div>
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
                                   <div class="guide-append-sec{{ $guide->id ?? '' }}">
                                        <div class="col-md-3 offset-md-9">
                                             <div class="form-group">
                                                  <div><span class="remove-guide" data-id="{{ $guide->id ?? '' }}"><i class="fa fa-times"></i></span></div>
                                             </div>
                                        </div>
                                        <div class="row gy-12">
                                             <div class="col-md-4">
                                                  <div class="form-group">
                                                       <label class="form-label" for="step_title">Step Title</label>
                                                       <input type="text" class="form-control form-control" id="step_title" name="step_title[{{ $guide->id ?? '' }}]" value="{{ $guide->step_title ?? '' }}">
                                                  </div>
                                             </div>
                                             <div class="col-md-4">
                                                  <div class="form-group">
                                                       <label class="form-label" for="step_description">Step Description</label>
                                                       <textarea class="form-control" id="step_description" name="step_description[{{ $guide->id ?? '' }}]">{{ $guide->step_description ?? '' }}</textarea>
                                                  </div>
                                             </div>
                                        </div>
                                   </div>
                                   <hr>
                                   @endforeach
                                   @endif
                                   <br>
                                   <div class="col-md-2 offset-md-10">
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
                                   @if(isset($document->legal_doc_image) && $document->legal_doc_image != null)
                                   <div class="col-md-8">
                                        <div class="form-group">
                                             <img src="{{ asset('storage/'.$document->legal_doc_image ) }}" width="200px" height="200px">
                                        </div>
                                   </div>
                                   @endif
                              </div>
                         </div>
                         <hr>
                         <h6>Related Document Section</h6>
                         <div class="card card-bordered card-preview">
                              <div class="related-section m-4">
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
                                             <div class="form-control-wrap">
                                                  <select class="form-select js-select2" multiple="multiple" id="select_related_doc" name="select_related_doc[]">
                                                       <option value="">Select</option>
                                                       @if(isset($related_documents) && $related_documents != null)
                                                            @foreach($related_documents as $related)
                                                                 @php
                                                                      $isSelected = isset($document->relatedDocuments) && $document->relatedDocuments->contains('related_document_id', $related->id);
                                                                 @endphp
                                                                 <option value="{{ $related->id ?? '' }}" {{ $isSelected ? 'selected' : '' }}>
                                                                      {{ $related->title ?? '' }}
                                                                 </option>
                                                            @endforeach
                                                       @endif
                                                  </select>
                                             </div>
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
                         <div class="col-md-8">
                              <div class="form-group">
                                   <label class="form-label" for="format">Format</label>
                                   <div class="form-control-wrap">
                                        <select class="form-select js-select2" multiple="multiple" id="format" name="format[]">
                                        @if(isset($document->format) && $document->format != null)
                                        <?php 
                                             $formats = json_decode($document->format);
                                        ?>
                                        @foreach($formats as $format)
                                             @if($format == 'pdf')
                                             <option value="pdf" selected>PDF</option>
                                             @elseif($format == 'docx')
                                             <option value="docx" selected>DOCX</option>
                                             @endif
                                        @endforeach
                                        @else
                                        <option value="pdf">PDF</option>
                                        <option value="docx">DOCX</option>
                                        @endif
                                        </select>
                                   </div>
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
                              @if($reviews->isNotEmpty())
                                   <input type="checkbox" class="custom-control-input reviews" id="reviews" name="reviews" value="0">
                              @else
                                   <input type="checkbox" class="custom-control-input reviews" id="reviews" name="reviews" value="1" checked>
                              @endif
                                   <label class="custom-control-label" for="reviews">Allow reviews.</label>
                              </div>
                         </div>
                         <hr>
                         @if($reviews->isNotEmpty())
                         @foreach($reviews as $rev)
                         <div class="row gy-12">
                              <div class="col-md-3">
                                   <div class="form-group">
                                   {{ $rev->first_name ?? '' }} {{ $rev->last_name ?? '' }}
                                   {{ $rev->email ?? '' }}
                                   </div>
                              </div>
                              <div class="col-md-3">
                              @if(isset($rev->rating) && $rev->rating != null)
                              <div id="full-stars-example-two">
                                   <div class="ratings">
                                   @for($i = 1; $i <= 5; $i++)
                                   <label for="rating{{ $i }}">
                                        <i rate="{{ $i }}" class="star fa fa-star {{ $rev->rating >= $i ? 'rating-color' : '' }}"></i>
                                   </label>
                                   <input name="rating" id="rating{{ $i }}" class="chkbox" style="display:none;" value="{{ $i }}" {{ $rev->rating == $i ? 'checked' : '' }}>
                                   @endfor
                                   </div>
                              </div>
                              @endif
                              </div>
                              <div class="col-md-4">
                                   <div class="form-group">
                                        {{ $rev->description ?? '' }}
                                   </div>
                              </div>
                         </div>
                         <br>
                         @endforeach
                         @else
                         <p>No reviews yet.</p>
                         @endif
                    </div>
               </div>
               <div class="mt-3">
               @if(isset($document) && $document != null)
                    <button class="btn btn-primary" type="submit">Update</button>
               @else
                    <button class="btn btn-primary" type="submit">Save</button>
               @endif
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
               var html = `<div class="img-txt-section">
                              <div class="col-md-4 offset-md-8">
                                   <div class="form-group">
                                        <div><span class="remove-second-sec" value="appended"><i class="fa fa-times"></i></span></div>
                                   </div>
                              </div>
                              <div class="second-append-sec" id="second-append-sec">
                                   <div class="col-md-8">
                                        <div class="form-group">
                                             <label class="form-label" for="new_img_heading">Heading</label>
                                             <input type="text" class="form-control" id="new_img_heading" name="new_img_heading[]" value="">
                                        </div>
                                   </div>
                                   <div class="col-md-8">
                                        <div class="form-group">
                                             <label class="form-label" for="new_img_description">Description Here</label>
                                             <textarea class="description-editor" id="new_img_description" name="new_img_description[]"></textarea>
                                        </div>
                                   </div>
                                   <div class="col-md-8">
                                        <div class="form-group">
                                             <label class="form-label" for="new_upload_image">Upload Image</label>
                                             <input type="file" class="form-control" id="new_upload_image" name="new_upload_image[]" value="">
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
          $('body').delegate('.remove-second-sec', 'click', function () {
               var id = $(this).data('id');
               if($(this).attr('value') === 'appended'){
                    $(this).closest('.img-txt-section').remove();
                    return false;
               }

               let deleteIds = $('#img_sec_ids').val();
               if(deleteIds) {
                    deleteIds += ',' + id;
               }else {
                    deleteIds = id;
               }
               $('#img_sec_ids').val(deleteIds);

               $('.img-txt-section'+id).hide();
          });

          // Append Guide section // 
          $('#add-guide-sec').click(function(){
               var html = `<div class="guide-append-sec">
                              <div class="col-md-3 offset-md-9">
                                   <div class="form-group">
                                        <div><span class="remove-guide" value="appended"><i class="fa fa-times"></i></span></div>
                                   </div>
                              </div>
                              <div class="row gy-12">
                                   <div class="col-md-4">
                                             <div class="form-group">
                                             <label class="form-label" for="new_step_title">Step Title</label>
                                             <input type="text" class="form-control form-control" id="new_step_title" name="new_step_title[]" value="">
                                        </div>
                                   </div>
                                   <div class="col-md-4">
                                        <div class="form-group">
                                             <label class="form-label" for="new_step_description">Step Description</label>
                                             <textarea class="form-control" id="new_step_description" name="new_step_description[]"></textarea>
                                        </div>
                                   </div>
                              </div>
                         </div>`

               $('#guide-sec-steps').append(html);
          });

          // Remove guide section //
          $('body').delegate('.remove-guide', 'click', function () {
               var id = $(this).data('id');
               if($(this).attr('value') === 'appended'){
                    $(this).closest('.guide-append-sec').remove();
                    return false;
               }

               let deleteIds = $('#guide_sec_ids').val();
               if(deleteIds) {
                    deleteIds += ',' + id;
               }else {
                    deleteIds = id;
               }
               $('#guide_sec_ids').val(deleteIds);

               $('.guide-append-sec'+id).hide();
          });


          // Add Faq Section //
          $('#add-sec').click(function(){
               var html = `<div class="faq-append-sec">
                              <div class="col-md-2 offset-md-10">
                                   <div class="form-group">
                                        <div><span class="remove-faq" value="appended"><i class="fa fa-times"></i></span></div>
                                   </div>
                              </div>
                              <div class="row gy-8">
                                   <div class="col-md-3">
                                        <div class="form-group">
                                             <label class="form-label" for="new_agreement_image">Image</label>
                                             <input type="file" class="form-control" id="new_agreement_image" name="new_agreement_image[]" value="">
                                        </div>
                                   </div>
                                   <div class="col-md-3">
                                        <div class="form-group">
                                             <label class="form-label" for="new_agreement_heading">Heading</label>
                                             <input type="text" class="form-control" id="new_agreement_heading" name="new_agreement_heading[]" value="">
                                        </div>
                                   </div>
                                   <div class="col-md-4">
                                        <div class="form-group">
                                             <label class="form-label" for="new_agreement_description">Description</label>
                                             <textarea class="form-control" id="new_agreement_description" name="new_agreement_description[]"></textarea>
                                        </div>
                                   </div>
                              </div>
                         </div>`

               $('#steps').append(html);
          });


          // Remove Faq section //
          $('body').delegate('.remove-faq', 'click', function () {
               var id = $(this).data('id');
               if($(this).attr('value') === 'appended'){
                    $(this).closest('.faq-append-sec').remove();
                    return false;
               }

               let deleteIds = $('#agg_sec_ids').val();
               if(deleteIds) {
                    deleteIds += ',' + id;
               }else {
                    deleteIds = id;
               }
               $('#agg_sec_ids').val(deleteIds);

               $('.faq-append-sec'+id).hide();
          });

     });
</script>

<script>
$(document).ready(function(){
     $('.approved').click(function(){
          $('.approved').val('1');

     })

     $('.reviews').change(function(){
          $('.reviews').val('1');
     })
})
</script>

@endsection