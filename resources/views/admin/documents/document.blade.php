@extends('admin_layout.master')
@section('content')

<div class="nk-content">
     <div class="container-fluid">
          @if(isset($document) && $document != null)
          <form action="{{ url('/admin-dashboard/add-documents') }}" method="post" enctype="multipart/form-data">
          @else
          <form action="{{ url('admin-dashboard/add-documents') }}" method="post" enctype="multipart/form-data">
          @endif
               @csrf
               <input type="hidden" name="id" value="{{ $document->id ?? '' }}">
               <input type="hidden" name="img_sec_ids" id="img_sec_ids" value="">
               <input type="hidden" name="guide_sec_ids" id="guide_sec_ids" value="">
               <input type="hidden" name="agg_sec_ids" id="agg_sec_ids" value="">
               <input type="hidden" name="slug" id="slug" value="{{ $document->slug ?? '' }}">
               <input type="hidden" name="published" id="published" value="">

               <div class="nk-block-head doc-outer-div">
                    <div class="nk-block-head-content wrapper">
                         <div class="tab">
                              @if(isset($document) && $document != null)
                              <a href="{{ url('admin-dashboard/edit-document/'.$document->slug) }}" class="btn tab_btn active">Frontpage</a>
                              @endif
                              <button type="button" class="btn tab_btn">Document generator</button>
                              <button type="button" class="btn tab_btn">Document questions</button>
                              <button type="button" class="btn tab_btn">Document Text</button>
                         </div>
                    </div>
                    <div class="doc-top-butns2 mt-4">
                         <div class="form-group">
                              <button type="button" class="btn btn-light">AI Autofill</button>
                         </div>
                    </div>
               </div>
               <div class="row">
                    <div class="col md-8 left-content">
                         @if(isset($document) && $document != null)
                         <div class="col-md-12 doc-title mt-2">
                              <div class="form-group">
                                   <label class="form-label" for="title"><b><h4>Document Title</h4></b></label>
                                   <input type="text" class="form-control form-control-lg" id="title" name="title" placeholder="Add title" value="{{ $document->title ?? '' }}">
                              </div>
                         </div>
                         @else
                         <div class="col-md-12 doc-title mt-2">
                              <div class="form-group">
                                   <label class="form-label" for="title"><b><h4>Document Title</h4></b></label>
                                   <input type="text" class="form-control form-control-lg" id="title" name="title" placeholder="Add title" value="{{ $document->title ?? '' }}">
                                   @error('title')
                                        <span class="text-danger">{{ $message }}</span>
                                   @enderror
                              </div>
                         </div>
                         @endif 
                         <div class="col-md-12 mt-2">
                              <div class="form-group">
                                   <label class="form-label" for="document_image">Image</label>
                                   <input type="file" class="form-control" id="document_image" name="document_image" value="">
                                   @error('document_image')
                                        <span class="text-danger">{{ $message }}</span>
                                   @enderror
                              </div>
                              <div class="form-group">
                              @if(isset($document->document_image) && $document->document_image != null)
                                   <img src="{{ asset('storage/'.$document->document_image) }}" alt="document_img" height="200px" width="200px">
                              @endif
                              </div>
                         </div>
                         <h5 class="mt-2">Document Short Description</h5>  
                         <hr>
                         <div class="row gy-12 mt-2">
                              <div class="col-md-12 doc-short-des">
                                   <div class="form-group">
                                        <label class="form-label" for="short_description">Short Description</label>
                                        <textarea class="form-control" id="short_description" name="short_description">{{ $document->short_description ?? '' }}</textarea>
                                        @error('short_description')
                                             <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                   </div>
                              </div>
                         </div>
                         <div class="col-md-12 mt-2">
                              <div class="form-group">
                                   <label class="form-label" for="document_button_text">Create Document Button Text</label>
                                   <input type="text" class="form-control" id="document_button_text" name="document_button_text" value="{{ $document->btn_text ?? '' }}">
                                   @error('document_button_text')
                                        <span class="text-danger">{{ $message }}</span>
                                   @enderror
                              </div>
                         </div>
                         <h5 class="mt-4">Agreement Section</h5>
                         <hr>
                         <div class="col-md-12 mt-2">
                              <div class="form-group">
                                   <label class="form-label" for="long_description">Long Description</label>
                                   <textarea id="long_description" name="long_description">{{ $document->long_description ?? '' }}</textarea>
                                   @error('long_description')
                                        <span class="text-danger">{{ $message }}</span>
                                   @enderror
                              </div>
                         </div>
                         <div class="col-md-12 mt-2">
                              <div class="form-group">
                                   <label class="form-label" for="">Agreement Steps</label>
                              </div>
                         </div>  
                         @if(isset($document->documentAgreement) && $document->documentAgreement != null)
                         @foreach($document->documentAgreement as $agrmnt)
                         <?php $path = str_replace('public/', '', $agrmnt->media->file_path ?? null); ?>
                         <div class="faq-append-sec{{ $agrmnt->id ?? '' }}">
                              <div class="text-end">
                                   <div class="form-group">
                                        <div><span class="remove-faq" data-id="{{ $agrmnt->id ?? '' }}"><i class="fa fa-times"></i></span></div>
                                   </div>
                              </div>
                              <div class="row gy-12">
                                   <div class="col-md-4">
                                        <div class="form-group">
                                             <img src="{{ asset('storage/'.$path ?? '' ) }}" alt="">
                                        </div>
                                   </div>
                                   <div class="col-md-4">
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
                         <div id="steps"></div>
                         <br>
                         <div class="text-end">
                              <div class="form-group">
                                   <button type="button" class="btn btn-sm btn-primary" id="add-sec">Add Row</button>
                              </div>
                         </div>                      
                         <h5>Documents Field</h5> 
                         <hr>
                         <h6>Image and text</h6>
                         <hr>
                         @if(isset($document->documentField) && $document->documentField != null)
                              @foreach($document->documentField as $index=>$field)
                              <div class="img-txt-section{{ $field->id ?? '' }}">
                                   <div class="text-end">
                                        <div class="form-group">
                                             <div><span class="remove-second-sec" data-id="{{ $field->id ?? '' }}"><i class="fa fa-times"></i></span></div>
                                        </div>
                                   </div>
                                   <div class="col-md-12 mt-2">
                                        <div class="form-group">
                                             <label class="form-label" for="img_heading">Heading</label>
                                             <input type="text" class="form-control" id="img_heading" name="img_heading[{{ $field->id ?? '' }}]" value="{{ $field->heading ?? '' }}">
                                        </div>
                                   </div>
                                   <div class="col-md-12 mt-2">
                                        <div class="form-group">
                                             <label class="form-label" for="img_description">Description Here</label>
                                             <textarea class="form-control" id="img_description{{ $index ?? '' }}" name="img_description[{{ $field->id ?? '' }}]">{{ $field->description ?? '' }}</textarea>
                                        </div>
                                   </div>
                              </div>
                              <hr>
                              <script>
                                   ClassicEditor
                                   .create(document.querySelector('#img_description{{ $index }}'), {
                                        toolbar: [
                                             'heading', '|', 'bold', 'italic', 'link',
                                             'bulletedList', 'numberedList', 'blockQuote',
                                             'imageUpload', 'undo', 'redo'
                                        ],
                                        ckfinder: {
                                             uploadUrl: "{{ route('ckeditor.upload') }}?_token={{ csrf_token() }}"
                                        }
                                   })
                                   .then(editor => {
                                        console.log('Editor was initialized', editor);
                                        editor.model.document.on('change:data', () => {
                                             const url = editor.data.get('upload');
                                             if (url) {
                                                  console.log('Upload response:', url);
                                             }
                                        });
                                   })
                                   .catch(error => {
                                        console.error('Error initializing editor:', error);
                                   });
                              </script>
                              @endforeach
                         @else
                         <div class="img-txt-section">
                              <div class="col-md-12 mt-2">
                                   <div class="form-group">
                                        <label class="form-label" for="img_heading">Heading</label>
                                        <input type="text" class="form-control" id="img_heading" name="img_heading[]" value="">
                                        @error('img_heading.*')
                                             <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                   </div>
                              </div>
                              <div class="col-md-12 mt-2">
                                   <div class="form-group">
                                        <label class="form-label" for="img_description">Description Here</label>
                                        <textarea class="form-control" id="img_description" name="img_description[]"></textarea>
                                        @error('img_description.*')
                                             <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                   </div>
                              </div>
                              <div class="col-md-12 mt-2">
                                   <div class="form-group">
                                        <label class="form-label" for="field_image">Image</label>
                                        <input type="file" class="form-control" id="field_image" name="field_image[]">
                                   </div>
                              </div>
                              <div class="col-md-12 mt-2">
                                   <div class="form-group">
                                        <label class="form-label" for="img_description2">Description Here</label>
                                        <textarea class="form-control" id="img_description2" name="img_description2[]"></textarea>
                                        @error('img_description2.*')
                                             <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                   </div>
                              </div>
                         </div>
                         @endif
                         <div id="document_field_container"></div>
                         <br>
                         <div class="text-end">
                              <div class="form-group">
                                   <button type="button" class="btn btn-sm btn-primary" id="second-section-add">Add Row</button>
                              </div>
                         </div>
                         <hr>
                         <h6 class="mt-2">Guide Section</h6>
                         <hr>
                         <div class="col-md-12 mt-2">
                              <div class="form-group">
                                   <label class="form-label" for="guide_heading">Guide Section Main Heading</label>
                                   <input type="text" class="form-control form-control" id="guide_heading" name="guide_heading" value="{{ $document->guide_main_heading ?? '' }}">
                                   @error('guide_heading')
                                        <span class="text-danger">{{ $message }}</span>
                                   @enderror
                              </div>
                         </div>
                         <div class="col-md-12 mt-2">
                              <div class="form-group">
                                   <label class="form-label">Guide Section Steps</label>
                              </div>
                         </div>
                         @if(isset($document->documentGuide) && $document->documentGuide != null)
                              @foreach($document->documentGuide as $guide)
                                   <div class="guide-append-sec{{ $guide->id ?? '' }}">
                                        <div class="text-end">
                                             <div class="form-group">
                                                  <div><span class="remove-guide" data-id="{{ $guide->id ?? '' }}"><i class="fa fa-times"></i></span></div>
                                             </div>
                                        </div>
                                        <div class="row gy-12">
                                             <div class="col-md-6">
                                                  <div class="form-group">
                                                       <label class="form-label" for="step_title">Step Title</label>
                                                       <input type="text" class="form-control form-control" id="step_title" name="step_title[{{ $guide->id ?? '' }}]" value="{{ $guide->step_title ?? '' }}">
                                                  </div>
                                             </div>
                                             <div class="col-md-6">
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
                         <div id="guide-sec-steps"></div>
                         <br>
                         <div class="text-end">
                              <div class="form-group">
                                   <button type="button" class="btn btn-sm btn-primary" id="add-guide-sec">Add Row</button>
                              </div>
                         </div>
                         <hr>
                         <h6 class="mt-4">Legal Document</h6>
                         <hr>
                         <div class="col-md-12 mt-2">
                              <div class="form-group">
                                   <label class="form-label" for="legal_heading">Heading</label>
                                   <input type="text" class="form-control form-control" id="legal_heading" name="legal_heading" value="{{ $document->legal_heading ?? '' }}">
                                   @error('legal_heading')
                                        <span class="text-danger">{{ $message }}</span>
                                   @enderror
                              </div>
                         </div>
                         <div class="col-md-12 mt-2">
                              <div class="form-group">
                                   <label class="form-label" for="legal_description">Description</label>
                                   <textarea class="form-control" id="legal_description" name="legal_description">{{ $document->legal_description ?? '' }}</textarea>
                                   @error('legal_description')
                                        <span class="text-danger">{{ $message }}</span>
                                   @enderror
                              </div>
                         </div>
                         <div class="col-md-12 mt-2">
                              <div class="form-group">
                                   <label class="form-label" for="legal_btn_text">Button Label</label>
                                   <input type="text" class="form-control" id="legal_btn_text" name="legal_btn_text" value="{{ $document->legal_btn_text ?? '' }}">
                                   @error('legal_btn_text')
                                        <span class="text-danger">{{ $message }}</span>
                                   @enderror
                              </div>
                         </div>
                         <div class="col-md-12 mt-2">
                              <div class="form-group">
                                   <label class="form-label" for="legal_doc_image">Document Image</label>
                                   <input type="file" class="form-control" id="legal_doc_image" name="legal_doc_image" value="">
                              </div>
                         </div>
                         @if(isset($document->legal_doc_image) && $document->legal_doc_image != null)
                         <?php 
                              $image = str_replace('public/', '', $document->file_path ?? null)
                         ?>
                         <div class="col-md-12 mt-2">
                              <div class="form-group">
                                   <img src="{{ asset('storage/'.$image ) }}" width="200px" height="200px">
                              </div>
                         </div>
                         @endif
                         <hr>
                         <div class="col-md-12 mt-2">
                              <div class="form-group">
                                   <label class="form-label" for="valid_in">Valid in</label>
                                   <input type="text" class="form-control form-control" id="valid_in" name="valid_in" value="{{ $document->valid_in ?? '' }}">
                              </div>
                         </div>
                         <hr>
                         <h6 class="mt-4">Related Document Section</h6>
                         <hr>
                         <div class="col-md-12 mt-2">
                              <div class="form-group">
                                   <label class="form-label" for="related_heading">Related Document Heading</label>
                                   <input type="text" class="form-control" id="related_heading" name="related_heading" value="{{ $document->related_heading ?? '' }}">
                                   @error('related_heading')
                                        <span class="text-danger">{{ $message }}</span>
                                   @enderror
                              </div>
                         </div>
                         <div class="col-md-12 mt-2">
                              <div class="form-group">
                                   <label class="form-label" for="related_description">Related Document Short Description</label>
                                   <textarea class="form-control" id="related_description" name="related_description">{{ $document->related_description ?? '' }}</textarea>
                                   @error('related_description')
                                        <span class="text-danger">{{ $message }}</span>
                                   @enderror
                              </div>
                         </div>
                         <div class="col-md-12 mt-2">
                              <div class="form-group">
                                   <label class="form-label" for="select_related_doc">Select Related Documents</label>               
                                   <div class="form-control-wrap">
                                        <select class="form-select js-select2" multiple="multiple" id="select_related_doc" name="select_related_doc[]" value="">
                                             <option value="">Select</option>
                                             @if(isset($related_documents) && $related_documents != null)
                                                  @foreach($related_documents as $related)
                                                       @if(isset($document) && $document != null)
                                                            @if($related->id != $document->id)
                                                                 @php
                                                                      $isSelected = isset($document->relatedDocuments) && $document->relatedDocuments->contains('id', $related->id);
                                                                 @endphp
                                                                 <option value="{{ $related->id ?? '' }}" {{ $isSelected ? 'selected' : '' }}>
                                                                      {{ $related->title ?? '' }}
                                                                 </option>
                                                            @endif
                                                       @else
                                                            <option value="{{ $related->id ?? '' }}">
                                                                 {{ $related->title ?? '' }}
                                                            </option>
                                                       @endif
                                                  @endforeach
                                             @endif
                                        </select>
                                   </div>
                              </div>
                         </div>
                    </div>
                    <div class="col-md-4 right-content">
                         <div class="card card-bordered card-preview">
                              <div class="card-inner">
                                   <div class="col-md-12">
                                        <div class="form-group">
                                             <p>Published</p>
                                             <div class="custom-control custom-switch">
                                             @if(isset($document->published) && $document->published != null) 
                                                  @if($document->published == '1')
                                                  <input type="checkbox" class="custom-control-input publish" id="publish1" checked>
                                                  <label class="custom-control-label" for="publish1"></label>
                                                  @else
                                                  <input type="checkbox" class="custom-control-input publish" id="publish1">
                                                  <label class="custom-control-label" for="publish1"></label>
                                                  @endif
                                             @else
                                                  <input type="checkbox" class="custom-control-input publish" id="publish1">
                                                  <label class="custom-control-label" for="publish1"></label>
                                             @endif
                                             </div>
                                        </div>
                                   </div>
                                   <div class="col-md-12">
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
                                             @error('category_id')
                                                  <span class="text-danger">{{ $message }}</span>
                                             @enderror
                                        </div>
                                   </div>
                                   <div class="col-md-12">
                                        <div class="form-group">
                                             <label class="form-label" for="doc_price">Price *</label>
                                             <input type="text" class="form-control" id="doc_price" name="doc_price" value="{{ $document->doc_price ?? '' }}">
                                             @error('doc_price')
                                                  <span class="text-danger">{{ $message }}</span>
                                             @enderror
                                        </div>
                                   </div>
                                   <div class="col-md-12">
                                        <div class="form-group">
                                             <label class="form-label" for="title_tag">Title Tag</label>
                                             <input type="text" class="form-control" id="title_tag" name="title_tag" value="">
                                             @error('title_tag')
                                                  <span class="text-danger">{{ $message }}</span>
                                             @enderror
                                        </div>
                                   </div>
                                   <div class="col-md-12">
                                        <div class="form-group">
                                             <label class="form-label" for="title_description">Title Description</label>
                                             <textarea class="form-control" id="title_tag" name="title_description"></textarea>
                                             @error('title_description')
                                                  <span class="text-danger">{{ $message }}</span>
                                             @enderror
                                        </div>
                                   </div>
                                   <div class="row">
                                        <div class="view_btn col-md-6 mt-3">
                                             @if(isset($document) && $document != null)
                                             <a href="{{ url('document/'.$document->slug ?? '') }}" target="_blank" class="btn btn-sm btn-primary">View Page</a>
                                             @else
                                             <a class="btn btn-sm btn-primary" disabled>View Page</a>
                                             @endif
                                        </div>
                                        <div class="up-btn col-md-6 mt-3">
                                             @if(isset($document) && $document != null)
                                             <button class="btn btn-sm btn-primary" type="submit">Update</button>
                                             @else
                                             <button class="btn btn-sm btn-primary" type="submit" id="saveform">Save</button>
                                             @endif
                                        </div>
                                   </div>
                              </div> 
                         </div>
                    </div>
               </div>
          </form>
     </div>
</div>

@section('js')
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.0/classic/ckeditor.js"></script>
@endsection

<!-- <script>
     ClassicEditor
     .create(document.querySelector('#img_description'), {
          toolbar: [
               'heading', '|', 'bold', 'italic', 'link',
               'bulletedList', 'numberedList', 'blockQuote',
               'imageUpload', 'undo', 'redo'
          ],
          ckfinder: {
               uploadUrl: "{{ route('ckeditor.upload') }}?_token={{ csrf_token() }}"
          }
     })
     .then(editor => {
          console.log('Editor was initialized', editor);
     })
     .catch(error => {
          console.error('Error initializing editor:', error);
     });

     editor.model.document.on('change:data', () => {
          const url = editor.data.get('upload');
          if (url) {
               console.log('Upload response:', url);
          }
     });

</script> -->

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
     .create( document.querySelector('#img_description2'))
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
          var switchStatus = false;
          $(".publish").on('change', function() {
               if ($(this).is(':checked')) {
                    switchStatus = $(this).is(':checked');
                    $('#published').val(1);
               }
               else {
                    switchStatus = $(this).is(':checked');
                    $('#published').val(0);
               }
          })
     });

</script>

<script>
function initializeCKEditor(element) {
    ClassicEditor.create(element).catch(error => {
        console.error(error);
    });
}

$(document).ready(function(){
     $('#second-section-add').on('click',function(){
          var html = `<div class="img-txt-section">
                         <div class="text-end">
                              <div class="form-group">
                                   <div><span class="remove-second-sec" value="appended"><i class="fa fa-times"></i></span></div>
                              </div>
                         </div>
                         <div class="second-append-sec" id="second-append-sec">
                              <div class="col-md-12 mt-2">
                                   <div class="form-group">
                                        <label class="form-label" for="new_img_heading">Heading</label>
                                        <input type="text" class="form-control" name="new_img_heading[]" value="">
                                   </div>
                              </div>
                              <div class="col-md-12 mt-2">
                                   <div class="form-group">
                                        <label class="form-label" for="new_img_description">Description Here</label>
                                        <textarea class="description-editor" name="new_img_description[]"></textarea>
                                   </div>
                              </div>
                              <div class="col-md-12 mt-2">
                                   <div class="form-group">
                                        <label class="form-label" for="field_image">Image</label>
                                        <input type="file" class="form-control" id="field_image" name="field_image[]">
                                   </div>
                              </div>
                              <div class="col-md-12 mt-2">
                                   <div class="form-group">
                                        <label class="form-label" for="img_description2">Description Here</label>
                                        <textarea class="description-editor" id="img_description2" name="img_description2[]"></textarea>
                                   </div>
                              </div>
                         </div>
                    </div>`
          $('#document_field_container').append(html);

          $('.description-editor').each(function() {
          initializeCKEditor(this);
          });

          // $('.description-editor').each(function() {
          //      if (!$(this).data('ckeditor-initialized')) {
          //           ClassicEditor
          //           .create(this, {
          //                toolbar: [
          //                     'heading', '|', 'bold', 'italic', 'link',
          //                     'bulletedList', 'numberedList', 'blockQuote',
          //                     'imageUpload', 'undo', 'redo'
          //                ],
          //                ckfinder: {
          //                     uploadUrl: "{{ route('ckeditor.upload') }}?_token={{ csrf_token() }}"
          //                }
          //           })
          //           .then(editor => {
          //                $(this).data('ckeditor-initialized', true);
          //                console.log('Editor was initialized', editor);
          //           })
          //           .catch(error => {
          //                console.error('Error initializing editor:', error);
          //           });
          //      }
          // });
     });

     // Remove second section //
     $('body').delegate('.remove-second-sec', 'click', function () {
          if ($(this).attr('value') === 'appended') {
               $(this).closest('.img-txt-section').remove();
          } else {
               var id = $(this).data('id');
               let deleteIds = $('#img_sec_ids').val();
               if (deleteIds) {
                    deleteIds += ',' + id;
               } else {
                    deleteIds = id;
               }
               $('#img_sec_ids').val(deleteIds);
               $(this).closest('.img-txt-section').hide();
          }
     });

     // Append Guide section //
     $('#add-guide-sec').click(function(){
          var html = `<div class="guide-append-sec">
                         <div class="text-end">
                              <div class="form-group">
                                   <div><span class="remove-guide" value="appended"><i class="fa fa-times"></i></span></div>
                              </div>
                         </div>
                         <div class="row gy-12">
                              <div class="col-md-6">
                                   <div class="form-group">
                                        <label class="form-label" for="new_step_title">Step Title</label>
                                        <input type="text" class="form-control" name="new_step_title[]" value="">
                                   </div>
                              </div>
                              <div class="col-md-6">
                                   <div class="form-group">
                                        <label class="form-label" for="new_step_description">Step Description</label>
                                        <textarea class="form-control" name="new_step_description[]"></textarea>
                                   </div>
                              </div>
                         </div>
                    </div>`;

          $('#guide-sec-steps').append(html);
     });

     // Remove guide section //
     $('body').delegate('.remove-guide', 'click', function () {
          if ($(this).attr('value') === 'appended') {
               $(this).closest('.guide-append-sec').remove();
          } else {
               var id = $(this).data('id');
               let deleteIds = $('#guide_sec_ids').val();
               if (deleteIds) {
                    deleteIds += ',' + id;
               } else {
                    deleteIds = id;
               }
               $('#guide_sec_ids').val(deleteIds);
               $(this).closest('.guide-append-sec').hide();
          }
     });

     // Add Faq Section //
     $('#add-sec').click(function(){
          var html = `<div class="faq-append-sec">
                         <div class="text-end">
                              <div class="form-group">
                                   <div><span class="remove-faq" value="appended"><i class="fa fa-times"></i></span></div>
                              </div>
                         </div>
                         <div class="row gy-8">
                              <div class="col-md-4">
                                   <div class="form-group">
                                        <label class="form-label" for="new_agreement_image">Image</label>
                                        <input type="file" class="form-control" name="new_agreement_image[]" value="">
                                   </div>
                              </div>
                              <div class="col-md-4">
                                   <div class="form-group">
                                        <label class="form-label" for="new_agreement_heading">Heading</label>
                                        <input type="text" class="form-control" name="new_agreement_heading[]" value="">
                                   </div>
                              </div>
                              <div class="col-md-4">
                                   <div class="form-group">
                                        <label class="form-label" for="new_agreement_description">Description</label>
                                        <textarea class="form-control" name="new_agreement_description[]"></textarea>
                                   </div>
                              </div>
                         </div>
                    </div>`;

          $('#steps').append(html);
     });

// Remove Faq section //
     $('body').delegate('.remove-faq', 'click', function () {
          if ($(this).attr('value') === 'appended') {
               $(this).closest('.faq-append-sec').remove();
          } else {
               var id = $(this).data('id');
               let deleteIds = $('#agg_sec_ids').val();
               if (deleteIds) {
                    deleteIds += ',' + id;
               } else {
                    deleteIds = id;
               }
               $('#agg_sec_ids').val(deleteIds);
               $(this).closest('.faq-append-sec').hide();
          }
     });

});

</script>


@endsection