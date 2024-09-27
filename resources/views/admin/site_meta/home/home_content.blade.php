@extends('admin_layout.master')
@section('content')

<div class="nk-content">
     <div class="container-fluid">
          <form action="{{ url('admin-dashboard/add/home-content') }}" method="post" enctype="multipart/form-data">
               @csrf
               <div class="card card-bordered card-preview">
                    <div class="card-inner">
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
                                             <input type="text" class="form-control" id="banner_description" name="banner_description" value="">
                                        </div>
                                   </div>
                                   <div class="col-md-8">
                                        <div class="form-group">
                                             <label class="form-label" for="banner_image">Banner Image</label>
                                             <input type="file" class="form-control" id="banner_image" name="banner_image" value="">
                                        </div>
                                   </div>
                              </div>
                         </div>
                         <hr>
                         <h5>Template Section</h5>  
                         <hr>
                         <div class="card card-bordered card-preview">
                              <div class="card-inner">
                                   <div class="col-md-8">
                                        <div class="form-group">
                                             <label class="form-label" for="">Templates</label>
                                        </div>
                                   </div>
                                   <div class="col-md-6 offset-md-6">
                                        <div class="form-group">
                                             <button type="button" class="btn btn-sm btn-primary" id="addnewrow">Add Row</button>
                                        </div>
                                   </div>
                                   <div id="temp_sec"></div>
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
                                                       <option value="">Select</option>
                                                  @if(isset($documents) && $documents != null)
                                                  @foreach($documents as $document)
                                                       <option value="{{ $document->id ?? '' }}">{{ $document->title ?? '' }}</option>
                                                  @endforeach
                                                  @endif
                                                  </select>
                                             </div>
                                        </div>
                                   </div>
                                   <!-- <div class="col-md-8">
                                        <div class="form-group">
                                             <label class="form-label" for="button_name">Button Name</label>
                                             <input type="text" class="form-control" id="button_name" name="button_name" value="">
                                        </div>
                                   </div>
                                   <div class="col-md-8">
                                        <div class="form-group">
                                             <label class="form-label" for="button_url">Button Url</label>
                                             <input type="text" class="form-control" id="button_url" name="button_url" value="">
                                        </div>
                                   </div> -->
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
                                             <input type="text" class="form-control" id="bottom_button_link" name="bottom_button_link" value="">
                                        </div>
                                   </div>
                                   <div class="col-md-8">
                                        <div class="form-group">
                                             <label class="form-label" for="bottom_banner_img">Banner Image</label>
                                             <input type="file" class="form-control" id="bottom_banner_img" name="bottom_banner_img" value="">
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
                                   <div class="col-md-6 offset-md-6">
                                        <div class="form-group">
                                             <button type="button" class="btn btn-sm btn-primary" id="add_catgory">Add Row</button>
                                        </div>
                                   </div>
                                   <div id="catg_sec"></div>
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

               let deleteIds = $('#remove_ids').val();
               
               if(deleteIds) {
                    deleteIds += ',' + id;
               }else{
                    deleteIds = id;
               }
               $('#remove_ids').val(deleteIds);

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
                         <div class="col-md-4 offset-md-8">
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
                                   <label class="form-label" for="cat_img">Image</label>
                                   <input type="file" class="form-control" id="cat_img" name="cat_img[]">
                                   </div>
                              </div>
                              <div class="col-md-2">
                                   <div class="form-group">
                                   <label class="form-label" for="cat_heading">Heading</label>
                                   <input type="text" class="form-control" id="cat_heading" name="cat_heading[]" value="">
                                   </div>
                              </div>
                              <div class="col-md-2">
                                   <div class="form-group">
                                   <label class="form-label" for="category">Category</label>
                                   <div class="form-control-wrap"> 
                                        <select class="form-select js-select2" name="category" id="category">
                                             <option value="" selected disabled>Select</option>
                                             ${category_options_html}
                                        </select>
                                   </div>
                                   </div>
                              </div>
                              <div class="col-md-2">
                                   <div class="form-group">
                                   <label class="form-label" for="cat_icon">Category Icon</label>
                                   <input type="text" class="form-control" id="cat_icon" name="cat_icon[]" value="">
                                   </div>
                              </div>
                         </div>
                    </div>`;
               
               $('#catg_sec').append(html);
          });

          $('body').delegate('.remove_category', 'click', function () {
               var id = $(this).data('id');
               if($(this).attr('value') === 'appended'){
                    $(this).closest('.category-sec').remove();
                    return false;
               }

               let deleteIds = $('#remove_ids').val();
               
               if(deleteIds) {
                    deleteIds += ',' + id;
               }else{
                    deleteIds = id;
               }
               $('#remove_ids').val(deleteIds);

               $('.category-sec'+id).hide();
          });
     })
</script>


@endsection