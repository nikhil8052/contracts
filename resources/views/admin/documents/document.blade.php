@extends('admin_layout.master')
@section('content')

<div class="nk-content">
     <div class="container-fluid">
          @if(isset($document) && $document != null)
          <form action="{{ url('/admin-dashboard/update-document') }}" id="documentForm" method="post" enctype="multipart/form-data">
          @else
          <form action="{{ url('admin-dashboard/add-documents') }}" id="documentForm" method="post" enctype="multipart/form-data">
          @endif
               @csrf
               <input type="hidden" name="id" value="{{ $document->id ?? '' }}">
               <input type="hidden" name="img_sec_ids" id="img_sec_ids" value="">
               <input type="hidden" name="slug" id="slug" value="{{ $document->slug ?? '' }}">
               <input type="hidden" name="published" id="published" value="{{ $document->published ?? '' }}">
               <input type="hidden" name="field_img_id" id="field_img_id" value="">
               <input type="hidden" name="ag_img_id" id="ag_img_id" value="">
               
               @if(isset($document) && $document != null)
               <div class="col-md-12 doc-title mt-4 pb-4">
                    <h3>{{ $document->title ?? '' }}</h3>
               </div>
               @endif 
               <div class="nk-block-head doc-outer-div">
                    <div class="nk-block-head-content wrapper">
                         <div class="tab">
                              @if(isset($document) && $document != null)
                              <a href="{{ url('admin-dashboard/edit-document/'.$document->slug) }}" class="btn tab_btn active">Frontpage</a>
                              @endif 
                              <a class="btn tab_btn" target="_blank">Document generator</a>
                              @if(isset($document) && $document != null)
                              <a href="{{ url('admin-dashboard/document-questions/?id='.$document->id) }}" class="btn tab_btn" target="_blank">Document questions</a>
                              @else
                              <a href="{{ url('admin-dashboard/document-questions/') }}" class="btn tab_btn" target="_blank">Document questions</a>
                              @endif
                              @if(isset($document) && $document != null)
                              <a href="{{ url('admin-dashboard/document-right-content/?id='.$document->id) }}" class="btn tab_btn" target="_blank">Document Text</a>
                              @else
                              <a href="{{ url('admin-dashboard/document-right-content/') }}" class="btn tab_btn" target="_blank">Document Text</a>
                              @endif
                         </div>
                    </div>
               </div>
               <div class="row main_section_div">
                    <div class="col col-md-8 doc-left-content">
                         <div class="doc-top-butns2 mt-0">
                              <div class="form-group">
                                   <button type="button" class="btn btn-light">AI Autofill</button>
                              </div>
                         </div>
                         <div class="card card-bordered card-preview mt-4">
                              <div class="card-inner">
                                   @if(isset($document) && $document != null)
                                   <div class="col-md-12 doc-title">
                                        <div class="form-group">
                                             <label class="form-label" for="title"><b><h4>Document Title</h4></b></label>
                                             <input type="text" class="form-control form-control-lg" id="title" name="title" placeholder="Add title" value="{{ $document->title ?? '' }}">
                                        </div>
                                   </div>
                                   @else
                                   <div class="col-md-12 doc-title">
                                        <div class="form-group">
                                             <label class="form-label" for="title"><b><h3>Document Title</h3></b></label>
                                             <input type="text" class="form-control form-control-lg" id="title" name="title" placeholder="Add title" value="">
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
                                        <?php 
                                             $image_path = str_replace('public/', '', $document->document_file_path ?? null);
                                        ?>
                                             <img src="{{ asset('storage/'.$image_path) }}" alt="{{ asset('storage/'.$image_path) }}" height="200px" width="200px">
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
                                             <span class="text-danger validation_error"></span>
                                        </div>
                                   </div>
                                   <h5 class="mt-4">Agreement Section</h5>
                                   <hr>
                                   <div class="col-md-12 mt-2">
                                        <div class="form-group">
                                             <label class="form-label" for="long_description">Long Description</label>
                                             <textarea class="form-control" id="long_description" name="long_description">{{ $document->long_description ?? '' }}</textarea>
                                             @error('long_description')
                                                  <span class="text-danger">{{ $message }}</span>
                                             @enderror
                                        </div>
                                   </div>
                                   <br>
                                   <h5>Documents Field</h5> 
                                   <hr>
                                   <h6>Image and text</h6>
                                   @if(isset($document->documentField) && $document->documentField != null)
                                        @foreach($document->documentField as $index=>$field)
                                        <?php 
                                             $path = str_replace('public/', '', $field->media->file_path ?? null);
                                        ?>
                                        <div class="img-txt-section{{ $field->id ?? '' }}">
                                             <hr>
                                             <!-- <div class="text-end">
                                                  <div class="form-group">
                                                       <div><span class="remove-second-sec" data-id="{{ $field->id ?? '' }}"><i class="fa fa-times"></i></span></div>
                                                  </div>
                                             </div> -->
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
                                             <div class="col-md-12 mt-2">
                                                  <div class="form-group">
                                                       <button class="btn-sm update_field_img" type="button" data-id="{{ $field->id ?? '' }}">Add New</button>
                                                       <input type="file" name="field_up_img" class="up_img" data-id="{{ $field->id ?? '' }}" id="field_up_img{{ $field->id ?? '' }}" style="display:none;">
                                                  </div>
                                                  <div class="field_img_div" id="field_img_div{{ $field->id ?? '' }}">
                                                       <!-- <div class="text-end">
                                                            <span class="remove_field_img" data-id="{{ $field->id ?? '' }}">
                                                                 <i class="fa fa-times"></i>
                                                            </span>
                                                       </div> -->
                                                       <div class="form-group">
                                                            <img src="{{ asset('storage/'.$path) }}" alt="{{ asset('storage/'.$path) }}">
                                                       </div>
                                                  </div>
                                             </div>
                                             <div class="col-md-12 mt-2">
                                                  <div class="form-group">
                                                       <label class="form-label" for="img_description_second">Description Here</label>
                                                       <textarea class="form-control" id="img_description_second{{ $index ?? '' }}" name="img_description_second[{{ $field->id ?? '' }}]">{{ $field->description2 ?? '' }}</textarea>
                                                  </div>
                                             </div>
                                        </div>
                                        <script>
                                             ClassicEditor.create(document.querySelector('#img_description{{ $index }}'),{
                                             toolbar: {
                                                  items: [
                                                       'heading', 
                                                       'bold', 
                                                       'bulletedList', 
                                                       'numberedList', 
                                                  ]
                                             },
                                             heading: {
                                                  options: [
                                                       { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
                                                       { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' },
                                                       { model: 'heading4', view: 'h4', title: 'Heading 4', class: 'ck-heading_heading4' }
                                                  ]
                                             },
                                             removePlugins: [
                                                  'Table','MediaEmbed', 'BlockQuote',
                                             ]
                                        })
                                        .catch( error => {
                                             console.error( error );
                                        });

                                        ClassicEditor.create(document.querySelector('#img_description_second{{ $index }}'),{
                                             toolbar: {
                                                  items: [
                                                       'heading', 
                                                       'bold', 
                                                       'bulletedList', 
                                                       'numberedList', 
                                                  ]
                                             },
                                             heading: {
                                                  options: [
                                                       { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
                                                       { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' },
                                                       { model: 'heading4', view: 'h4', title: 'Heading 4', class: 'ck-heading_heading4' }
                                                  ]
                                             },
                                             removePlugins: [
                                                  'Table','MediaEmbed', 'BlockQuote',
                                             ]
                                        })
                                        .catch( error => {
                                             console.error( error );
                                        });

                                        </script>
                                        @endforeach
                                   @else
                                   <div class="img-txt-section">
                                        <hr>
                                        <div class="col-md-12 mt-2">
                                             <div class="form-group">
                                                  <label class="form-label" for="img_heading">Heading</label>
                                                  <input type="text" class="form-control" id="img_heading" name="img_heading[]" value="">
                                                  @error('img_heading.*')
                                                       <span class="text-danger">{{ $message }}</span>
                                                  @enderror
                                                  <span class="text-danger validation_error"></span>
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
                                                  @error('field_image.*')
                                                       <span class="text-danger">{{ $message }}</span>
                                                  @enderror
                                             </div>
                                        </div>
                                        <div class="col-md-12 mt-2">
                                             <div class="form-group">
                                                  <label class="form-label" for="img_description_second">Description Here</label>
                                                  <textarea class="form-control" id="img_description_second" name="img_description_second[]"></textarea>
                                                  @error('img_description_second.*')
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
                                   <!-- <div class="col-md-12 mt-2">
                                        <div class="form-group">
                                             <label class="form-label" for="guide_button_link">Guide Section Button Link</label>
                                             <input type="text" class="form-control form-control" id="guide_button_link" name="guide_button_link" value="{{ $document->guide_button_link ?? '' }}">
                                        </div>
                                   </div> -->
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
                                   <h6 class="mt-4">Related Document Section</h6>
                                   <hr>
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
                         </div>
                    </div>
                    <div class="col col-md-4 doc-right-content">
                         <div class="card card-bordered card-preview">
                              <div class="card-inner">
                                   <div class="d-flex justify-content-end">
                                        <div class="nk-block-head-content">
                                             <div class="up-btn mbsc-form-group">
                                                  @if(isset($document) && $document != null)
                                                  <button class="btn btn-sm btn-primary" type="submit">Update</button>
                                                  @else
                                                  <button class="btn btn-sm btn-primary" type="submit">Save</button>
                                                  @endif
                                             </div>
                                        </div>
                                   </div> 
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
                                   <div class="col-md-12 mt-2">
                                        <div class="form-group">
                                             <label class="form-label" for="category_id">Categories</label>  
                                             <div class="form-control-wrap"> 
                                                  <select class="form-select js-select2" multiple="multiple" name="category_id[]" id="category_id">
                                                  @if(isset($categories) && $categories != null)
                                                  @foreach($categories as $category)
                                                       @php
                                                            $isSelected = false;
                                                            if(isset($document->categories) && $document->categories != null){
                                                                 foreach($document->categories as $catg){
                                                                      if($catg->id == $category->id){
                                                                           $isSelected = true;
                                                                           break;
                                                                      }
                                                                 }
                                                            }
                                                       @endphp
                                                       <option value="{{ $category->id ?? '' }}" {{ $isSelected ? 'selected' : '' }}>
                                                            {{ $category->name ?? '' }}
                                                       </option>
                                                  @endforeach
                                                  @endif
                                                  </select>
                                             </div>
                                             @error('category_id')
                                                  <span class="text-danger">{{ $message }}</span>
                                             @enderror
                                        </div>
                                   </div>
                                   <div class="col-md-12 mt-2">
                                        <div class="form-group">
                                             <label class="form-label" for="doc_price">Price (MXN)</label> 
                                             <input type="text" class="form-control" id="doc_price" name="doc_price" value="{{ $document->doc_price ?? '' }}">
                                             @error('doc_price')
                                                  <span class="text-danger">{{ $message }}</span>
                                             @enderror
                                             <span class="text-danger validation_error"></span>
                                        </div>
                                   </div>
                                   <div class="col-md-12 mt-2">
                                        <div class="form-group">
                                             <label class="form-label" for="meta_title">Meta Title</label>
                                             <input type="text" class="form-control" id="meta_title" name="meta_title" maxlength="50" value="{{ $document->meta_title ?? '' }}">
                                             @error('title_tag')
                                                  <span class="text-danger">{{ $message }}</span>
                                             @enderror
                                        </div>
                                   </div>
                                   <div class="col-md-12 mt-2">
                                        <div class="form-group">
                                             <label class="form-label" for="meta_description">Meta Description</label>
                                             <textarea class="form-control" id="meta_description" name="meta_description" maxlength="155">{{ $document->meta_description ?? '' }}</textarea>
                                             @error('title_description')
                                                  <span class="text-danger">{{ $message }}</span>
                                             @enderror
                                        </div>
                                   </div>
                                   <div class="d-flex justify-content-end">
                                        <div class="nk-block-head-content butn-cls">
                                             <div class="mbsc-form-group view_btn mt-3">
                                                  @if(isset($document) && $document != null)
                                                  <a href="{{ url('document/'.$document->slug ?? '') }}" target="_blank" class="view_page">View Page</a>
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

@section('js')
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.0/classic/ckeditor.js"></script>
@endsection

<script>
     $('#title').on('keyup',function(){
          const name = $(this).val();
          const url = name.toLowerCase().replace(/ /g,'-').replace(/[^\w-]+/g, '');
          $('#slug').val(url);
     })

     ClassicEditor
     .create( document.querySelector('#short_description'),{
          toolbar: {
               items: [
                    'heading', 
                    'bold', 
                    'bulletedList', 
                    'numberedList', 
               ]
          },
          heading: {
               options: [
                    { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
                    { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' },
                    { model: 'heading4', view: 'h4', title: 'Heading 4', class: 'ck-heading_heading4' }
               ]
          },
          removePlugins: [
               'Table','MediaEmbed', 'BlockQuote',
          ]
     })
     .catch( error => {
          console.error( error );
     });

     ClassicEditor
     .create( document.querySelector('#long_description'),{
          toolbar: {
               items: [
                    'heading', 
                    'bold', 
                    'bulletedList', 
                    'numberedList', 
               ]
          },
          heading: {
               options: [
                    { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
                    { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' },
                    { model: 'heading4', view: 'h4', title: 'Heading 4', class: 'ck-heading_heading4' }
               ]
          },
          removePlugins: [
               'Table','MediaEmbed', 'BlockQuote',
          ]
     })
     .catch( error => {
          console.error( error );
     });

     ClassicEditor
     .create( document.querySelector('#img_description'),{
          toolbar: {
               items: [
                    'heading', 
                    'bold', 
                    'bulletedList', 
                    'numberedList', 
               ]
          },
          heading: {
               options: [
                    { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
                    { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' },
                    { model: 'heading4', view: 'h4', title: 'Heading 4', class: 'ck-heading_heading4' }
               ]
          },
          removePlugins: [
               'Table','MediaEmbed', 'BlockQuote',
          ]
     })
     .catch( error => {
          console.error( error );
     });

     ClassicEditor
     .create( document.querySelector('#img_description_second'),{
          toolbar: {
               items: [
                    'heading', 
                    'bold', 
                    'bulletedList', 
                    'numberedList', 
               ]
          },
          heading: {
               options: [
                    { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
                    { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' },
                    { model: 'heading4', view: 'h4', title: 'Heading 4', class: 'ck-heading_heading4' }
               ]
          },
          removePlugins: [
               'Table','MediaEmbed', 'BlockQuote',
          ]
     })
     .catch( error => {
          console.error( error );
     });
</script>

<script>
     $(document).ready(function(){
          var switchStatus = false;
          $(".publish").on('change', function() {
               if($(this).is(':checked')) {
                    switchStatus = $(this).is(':checked');
                    $('#published').val(1);
               }
               else{
                    switchStatus = $(this).is(':checked');
                    $('#published').val(0);
               }
          })

          // Update Document Field Image // 
          $('.update_field_img').click(function(){
               var id = $(this).data('id');
               $('#field_up_img' + id).trigger('click');
          });

          $('.up_img').change(function() {
               var id = $(this).data('id');
               var file = this.files[0]; 
               var formData = new FormData(); 
               formData.append('field_image', file);
               formData.append('_token', "{{ csrf_token() }}");
               formData.append('id', id);

               $.ajax({
                    url: "{{ url('/update/documentField/image') }}", 
                    type: 'POST',
                    data: formData,
                    processData: false,  
                    contentType: false, 
                    dataType: "json",
                    success: function(response){
                         console.log(response);
                         NioApp.Toast('New image is updated', 'info', {position: 'top-right'});
                         setTimeout(() => {
                              location.reload();
                         },1000);
                    },
                    error: function(response) {
                         console.log(response.responseText); 
                         alert('Error uploading image');
                    }
               });
          });

          // Delete Field Image //
          $('.remove_field_img').click(function(){
               id = $(this).data('id');
               let removeIds = $('#field_img_id').val();
               
               if(removeIds) {
                    removeIds += ',' + id;
               }else{
                    removeIds = id;
               }
               $('#field_img_id').val(removeIds);

               $('#field_img_div'+id).hide();
          })

     });

</script>

<script>
     function initializeCKEditor(element) {
          ClassicEditor
          .create(element, {
               toolbar: {
                    items: [
                         'heading',   // For headings (h2, h3, h4)
                         'bold',      // For bold text
                         'bulletedList',  // For unordered list
                         'numberedList'   // For ordered list
                    ]
               },
               heading: {
                    options: [
                         { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
                         { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' },
                         { model: 'heading4', view: 'h4', title: 'Heading 4', class: 'ck-heading_heading4' }
                    ]
               },
               removePlugins: [
                    'Table', 'MediaEmbed', 'BlockQuote',
               ]
          })
          .catch(error => {
               console.error(error);
          });
     }

     $(document).ready(function(){
          $('#second-section-add').on('click',function(){
               
               var html = `<div class="img-txt-section">
                              <hr>
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
                                             <label class="form-label" for="new_field_image">Image</label>
                                             <input type="file" class="form-control" id="new_field_image" name="new_field_image[]">
                                        </div>
                                   </div>
                                   <div class="col-md-12 mt-2">
                                        <div class="form-group">
                                             <label class="form-label" for="new_img_description_second">Description Here</label>
                                             <textarea class="description-editor2" id="new_img_description_second" name="new_img_description_second[]"></textarea>
                                        </div>
                                   </div>
                              </div>
                         </div>`
               $('#document_field_container').append(html);

               const firstTextarea = $('.description-editor').last()[0];
               if (firstTextarea && !$(firstTextarea).data('ckeditor-initialized')) {
                    initializeCKEditor(firstTextarea);
                    $(firstTextarea).data('ckeditor-initialized', true);
               }

               const secondTextarea = $('.description-editor2').last()[0];
               if (secondTextarea && !$(secondTextarea).data('ckeditor-initialized')) {
                    initializeCKEditor(secondTextarea);
                    $(secondTextarea).data('ckeditor-initialized', true);
               }
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
                    $('.img-txt-section'+id).hide();
               }
          });

     });

</script>


@endsection