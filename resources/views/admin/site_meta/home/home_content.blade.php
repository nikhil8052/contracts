@extends('admin_layout.master')
@section('content')

<div class="nk-content">
     <div class="container-fluid">
          <form action="{{ url('admin-dashboard/add/home-content') }}" method="post" enctype="multipart/form-data">
               @csrf
               <input type="hidden" id="category_sec" name="category_sec" value="">
               <input type="hidden" id="template_sec" name="template_sec" value="">
               <div class="card card-bordered card-preview">
                    <div class="card-inner">
                         <div class="d-flex justify-content-end p-2">
                              <div class="nk-block-head-content">
                                   <div class="mbsc-form-group">
                                        <a href="{{ url('/') }}" class="btn btn-default">View Page</a>
                                   </div>
                              </div>
                         </div>
                         <div class="col-md-8 pb-2">
                              <div class="form-group">
                                   <label class="form-label" for="title"><b><h4>Page Title</b></h4></label>
                                   <input type="text" class="form-control form-control-lg" id="title" name="title" value="{{ $data['title'] ?? '' }}">
                              </div>
                         </div>
                         <hr>
                         <h5>Home Page</h5>  
                         <hr>
                         <h6>Banner Section</h6>
                         <div class="card card-bordered card-preview">
                              <div class="card-inner">
                                   <div class="col-md-8">
                                        <div class="form-group">
                                             <label class="form-label" for="background_image">Background Image</label>
                                             <input type="file" class="form-control" id="background_image" name="background_image" value="">
                                        </div>
                                        <div class="form-group">
                                             <img src="{{ asset('storage/'.$data['background_image'] ?? '' ) }}" height="140px" width="160px">
                                        </div>
                                   </div>
                                   <div class="col-md-8">
                                        <div class="form-group">
                                             <label class="form-label" for="banner_title">Banner Title</label>
                                             <input type="text" class="form-control" id="banner_title" name="banner_title" value="{{ $data['banner_title'] ?? '' }}">
                                        </div>
                                   </div>
                                   <div class="col-md-8">
                                        <div class="form-group">
                                             <label class="form-label" for="banner_description">Banner Description</label>
                                             <input type="text" class="form-control" id="banner_description" name="banner_description" value="{{ $data['banner_description'] ?? '' }}">
                                        </div>
                                   </div>
                                   <div class="col-md-8">
                                        <div class="form-group">
                                             <label class="form-label" for="banner_image">Banner Image</label>
                                             <input type="file" class="form-control" id="banner_image" name="banner_image" value="">
                                        </div>
                                        <div class="form-group">
                                             <img src="{{ asset('storage/'.$data['banner_image'] ?? '' ) }}" height="140px" width="160px">
                                        </div>
                                   </div>
                                   <div class="col-md-8">
                                        <div class="form-group">
                                             <label class="form-label" for="button_name">Button Name</label>
                                             <input type="text" class="form-control" id="button_name" name="button_name" value="{{ $data['button_name'] ?? '' }}">
                                        </div>
                                   </div>
                              </div>
                         </div>
                         <hr>
                         <h6>Most popular Documents</h6>  
                         <div class="card card-bordered card-preview">
                              <div class="card-inner">
                                   <div class="col-md-8">
                                        <div class="form-group">
                                             <label class="form-label" for="main_title">Main Title</label>
                                             <input type="text" class="form-control" id="main_title" name="main_title" value="{{ $data['most_popular_title'] ?? '' }}">
                                        </div>
                                   </div>
                                   <div class="col-md-8">
                                        <div class="form-group">
                                             <label class="form-label" for="popular_documents">Popular Documents</label>
                                             <div class="form-control-wrap"> 
                                                  <select class="form-select js-select2" multiple="multiple" name="popular_documents[]" id="popular_documents">
                                                  @if(isset($document_category) && $document_category != null)
                                                  @foreach($document_category as $document)
                                                       @if(isset($data['popular']) && $data['popular'] != null) 
                                                       <?php 
                                                            $documentsId = json_decode($data['popular']);
                                                       ?>
                                                            @if(in_array($document->id,$documentsId))
                                                            <option value="{{ $document->id ?? '' }}" selected>{{ $document->name ?? '' }}</option>
                                                            @else
                                                            <option value="{{ $document->id ?? '' }}">{{ $document->name ?? '' }}</option>
                                                            @endif
                                                       @else
                                                       <option value="{{ $document->id ?? '' }}">{{ $document->name ?? '' }}</option>
                                                       @endif
                                                  @endforeach
                                                  @endif
                                                  </select>
                                             </div>
                                        </div>
                                   </div>
                                   <div class="col-md-8">
                                        <div class="form-group">
                                             <label class="form-label" for="most_popular_btn_text">Button Text</label>
                                             <input type="text" class="form-control" id="most_popular_btn_text" name="most_popular_btn_text" value="{{ $data['most_popular_btn_text'] ?? '' }}">
                                        </div>
                                   </div>
                              </div>
                         </div>
                         <hr>
                         <h6>Bottom Banner</h6>  
                         <div class="card card-bordered card-preview">
                              <div class="card-inner">
                                   <div class="col-md-8">
                                        <div class="form-group">
                                             <label class="form-label" for="bottom_heading">Heading</label>
                                             <input type="text" class="form-control" id="bottom_heading" name="bottom_heading" value="{{ $data['bottom_heading'] ?? '' }}">
                                        </div>
                                   </div>
                                   <div class="col-md-8">
                                        <div class="form-group">
                                             <label class="form-label" for="bottom_sub_heading">Sub Heading</label>
                                             <textarea class="form-control" id="bottom_sub_heading" name="bottom_sub_heading">{{ $data['bottom_subheading'] ?? '' }}</textarea>
                                        </div>
                                   </div>
                                   <div class="col-md-8">
                                        <div class="form-group">
                                             <label class="form-label" for="bottom_button_label">Button Label</label>
                                             <input type="text" class="form-control" id="bottom_button_label" name="bottom_button_label" value="{{ $data['bottom_button_label'] ?? '' }}">
                                        </div>
                                   </div>
                                   <div class="col-md-8">
                                        <div class="form-group">
                                             <label class="form-label" for="bottom_button_link">Button Link</label>
                                             <input type="text" class="form-control" id="bottom_button_link" name="bottom_button_link" value="{{ $data['bottom_button_link'] ?? '' }}">
                                        </div>
                                   </div>
                                   <div class="col-md-8">
                                        <div class="form-group">
                                             <label class="form-label" for="bottom_banner_img">Banner Image</label>
                                             <input type="file" class="form-control" id="bottom_banner_img" name="bottom_banner_img" value="">
                                        </div>
                                        <div class="form-group">
                                             <img src="{{ asset('storage/'.$data['bottom_banner_image'] ?? '' ) }}" height="140px" width="160px">
                                        </div>
                                   </div>
                              </div>
                         </div>
                         <hr>
                         <h6>Categories Section</h6>  
                         <div class="card card-bordered card-preview">
                              <div class="card-inner">
                                   <div class="col-md-8">
                                        <div class="form-group">
                                             <label class="form-label" for="category_main_title">Main Title</label>
                                             <input type="text" class="form-control" id="category_main_title" name="category_main_title" value="{{ $data['category_title'] ?? '' }}">
                                        </div>
                                   </div>
                                   <div class="col-md-8">
                                        <div class="form-group">
                                             <label class="form-label" for="">Categories</label>
                                        </div>
                                   </div>
                                   @if(isset($home) && $home != null)
                                   @foreach($home as $index=>$value)
                                   <div class="category-sec{{ $value->id ?? '' }}">
                                        <hr>
                                        <div class="text-end">
                                             <div class="form-group">
                                                  <div>
                                                  <span class="remove_category" data-id="{{ $value->id ?? '' }}">
                                                       <i class="fa fa-times"></i>
                                                  </span>
                                                  </div>
                                             </div>
                                        </div>
                                        <div class="row gy-5">
                                             <div class="col-md-2">
                                                  <div class="form-group">
                                                       <div class="form-group">
                                                            <img src="{{ asset('storage/'.$value->media->file_name ?? '' ) }}">
                                                       </div>
                                                  </div>
                                             </div>
                                             <div class="col-md-2">
                                                  <div class="form-group">
                                                       <label class="form-label" for="cat_heading">Heading</label>
                                                       <input type="text" class="form-control" id="cat_heading" name="cat_heading[{{ $value->id ?? '' }}]" value="{{ $value->heading ?? '' }}">
                                                  </div>
                                             </div>
                                             <div class="col-md-2">
                                                  <div class="form-group">
                                                       <label class="form-label" for="category">Category</label>
                                                       <div class="form-control-wrap">
                                                            <select class="form-select js-select2" name="category[{{ $value->id ?? '' }}]" id="category">
                                                                 <option value="" selected disabled>Select</option>
                                                                 @if(isset($document_category) && count($document_category) > 0)
                                                                      @foreach($document_category as $catg)
                                                                           @php
                                                                           $isSelected = isset($value->category_id) && $value->category_id == $catg->id;
                                                                           @endphp
                                                                           <option value="{{ $catg->id }}" {{ $isSelected ? 'selected' : '' }}>
                                                                           {{ $catg->name ?? '' }}
                                                                           </option>
                                                                      @endforeach
                                                                 @else
                                                                      <option value="" disabled>No categories available</option>
                                                                 @endif
                                                            </select>
                                                       </div>
                                                  </div>

                                             </div>
                                             <div class="col-md-2">
                                                  <div class="form-group">
                                                       <label class="form-label" for="category_btn_text">Button Text</label>
                                                       <input type="text" class="form-control" id="category_btn_text" name="category_btn_text[{{ $value->id ?? '' }}]" value="{{ $value->btn_text ?? '' }}">
                                                  </div>
                                             </div>
                                             <div class="col-md-2">
                                                  <div class="form-group">
                                                       <label class="form-label" for="category_btn_link">Button Link</label>
                                                       <input type="text" class="form-control" id="category_btn_link" name="category_btn_link[{{ $value->id ?? '' }}]" value="{{ $value->btn_link ?? '' }}">
                                                  </div>
                                             </div>
                                             <div class="col-md-2">
                                                  <div class="form-group">
                                                       <label class="form-label" for="category_description">Description</label>
                                                       <textarea class="form-control" id="category_description" name="category_description[{{ $value->id ?? '' }}]">{{ $value->category_description ?? '' }}</textarea>
                                                  </div>
                                             </div>
                                        </div>
                                   </div>
                                   @endforeach
                                   @endif
                                   <br>
                                   <div class="text-end">
                                        <div class="form-group">
                                             <button type="button" class="btn btn-sm btn-primary" id="add_catgory">Add Row</button>
                                        </div>
                                   </div>
                                   <div id="catg_sec"></div>
                              </div>
                         </div>
                         <hr>
                         <div class="card card-bordered card-preview">
                              <div class="card-inner">
                                   <div class="col-md-8">
                                        <div class="form-group">
                                             <label class="form-label" for="join_us_text">Join Us Text</label>
                                             <input type="text" class="form-control" id="join_us_text" name="join_us_text" value="{{ $data['join_us_text'] ?? '' }}">
                                        </div>
                                   </div>
                                   <hr>
                                   <div class="col-md-8">
                                        <div class="form-group">
                                             <label class="form-label" for="reviews_heading">Reviews Heading</label>
                                             <input type="text" class="form-control" id="reviews_heading" name="reviews_heading" value="{{ $data['reviews_heading'] ?? '' }}">
                                        </div>
                                   </div>
                                   <div class="col-md-8">
                                        <div class="form-group">
                                             <label class="form-label" for="review_left_arrow">Left button image</label>
                                             <input type="file" class="form-control" id="review_left_arrow" name="review_left_arrow">
                                        </div>
                                        <div class="form-group">
                                             <img src="{{ asset('storage/'.$data['review_left_arrow'] ?? '' ) }}">
                                        </div>
                                   </div>
                                   <div class="col-md-8">
                                        <div class="form-group">
                                             <label class="form-label" for="review_right_arrow">Right button image</label>
                                             <input type="file" class="form-control" id="review_right_arrow" name="review_right_arrow">
                                        </div>
                                        <div class="form-group">
                                             <img src="{{ asset('storage/'.$data['review_right_arrow'] ?? '' ) }}">
                                        </div>
                                   </div>
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
     $(document).ready(function(){
          $('.js-select2').select2();

          $('#addnewrow').click(function(){
               var html = `<div class="append-sec">
                              <hr>
                              <div class="col-md-4 offset-md-8">
                                   <div class="form-group">
                                        <div><span class="removeTemplate" value="appended"><i class="fa fa-times"></i></span></div>
                                   </div>
                              </div>
                              <div class="row gy-5">
                                   <div class="col-md-2">
                                             <div class="form-group">
                                             <label class="form-label" for="temp_img">Image</label>
                                             <input type="file" class="form-control" id="temp_img" name="temp_img[]">
                                        </div>
                                   </div>
                                   <div class="col-md-2">
                                        <div class="form-group">
                                             <label class="form-label" for="temp_heading">Heading</label>
                                             <input type="text" class="form-control" id="temp_heading" name="temp_heading[]" value="">
                                        </div>
                                   </div>
                                   <div class="col-md-2">
                                             <div class="form-group">
                                             <label class="form-label" for="temp_subheading">Sub Heading</label>
                                             <input type="text" class="form-control" id="temp_subheading" name="temp_subheading[]" value="">
                                        </div>
                                   </div>
                                   <div class="col-md-2">
                                        <div class="form-group">
                                             <label class="form-label" for="temp_link">Link</label>
                                             <input type="text" class="form-control" id="temp_link" name="temp_link[]" value="">
                                        </div>
                                   </div>
                              </div>
                         </div>`;
               $('#temp_sec').append(html);
          })

          $('body').delegate('.removeTemplate', 'click', function () {
               var id = $(this).data('id');
               if($(this).attr('value') === 'appended'){
                    $(this).closest('.append-sec').remove();
                    return false;
               }

               let deleteIds = $('#template_sec').val();
               
               if(deleteIds) {
                    deleteIds += ',' + id;
               }else{
                    deleteIds = id;
               }
               $('#template_sec').val(deleteIds);

               $('.append-sec'+id).hide();
          });

          var document_category = {!! json_encode($document_category) !!};

          $('#add_catgory').click(function(){
               var category_option = [];
               $.each(document_category, function(key, val){
                    var category_html = `<option value="${val.id}">${val.name}</option>`;
                    category_option.push(category_html);
               });
               var category_options_html = category_option.join('');

               var html = `
                    <div class="category-sec">
                         <hr>
                         <div class="text-end">
                              <div class="form-group">
                                   <div>
                                   <span class="remove_category" value="appended">
                                        <i class="fa fa-times"></i>
                                   </span>
                                   </div>
                              </div>
                         </div>
                         <div class="row gy-5">
                              <div class="col-md-2">
                                   <div class="form-group">
                                   <label class="form-label" for="new_cat_img">Image</label>
                                   <input type="file" class="form-control" id="new_cat_img" name="new_cat_img[]">
                                   </div>
                              </div>
                              <div class="col-md-2">
                                   <div class="form-group">
                                   <label class="form-label" for="new_cat_heading">Heading</label>
                                   <input type="text" class="form-control" id="new_cat_heading" name="new_cat_heading[]" value="">
                                   </div>
                              </div>
                              <div class="col-md-2">
                                   <div class="form-group">
                                   <label class="form-label" for="new_category">Category</label>
                                   <div class="form-control-wrap"> 
                                        <select class="form-select js-select2" name="new_category[]" id="new_category">
                                             <option value="" selected disabled>Select</option>
                                             ${category_options_html}
                                        </select>
                                   </div>
                                   </div>
                              </div>
                              <div class="col-md-2">
                                   <div class="form-group">
                                   <label class="form-label" for="new_category_btn_text">Button Text</label>
                                   <input type="text" class="form-control" id="new_category_btn_text" name="new_category_btn_text[]" value="">
                                   </div>
                              </div>
                              <div class="col-md-2">
                                   <div class="form-group">
                                   <label class="form-label" for="new_category_btn_link">Button Link</label>
                                   <input type="text" class="form-control" id="new_category_btn_link" name="new_category_btn_link[]" value="">
                                   </div>
                              </div>
                              <div class="col-md-2">
                                   <div class="form-group">
                                   <label class="form-label" for="new_category_description">Description</label>
                                   <textarea class="form-control" id="new_category_description" name="new_category_description[]"></textarea>
                                   </div>
                              </div>
                         </div>
                    </div>`;
               
               $('#catg_sec').append(html);
          });

          $('body').delegate('.remove_category', 'click', function(){
               var id = $(this).data('id');
               if($(this).attr('value') === 'appended'){
                    $(this).closest('.category-sec').remove();
                    return false;
               }

               let deleteIds = $('#category_sec').val();
               
               if(deleteIds) {
                    deleteIds += ',' + id;
               }else{
                    deleteIds = id;
               }
               $('#category_sec').val(deleteIds);

               $('.category-sec'+id).hide();
          });
     })
</script>


@endsection