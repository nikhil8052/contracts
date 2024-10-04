@extends('admin_layout.master')
@section('content')
<div class="nk-content">
     <div class="container-fluid">
          <form action="{{ url('admin-dashboard/add-how-it-works') }}" method="post" enctype="multipart/form-data">
               @csrf
               <input type="hidden" name="delete_work_ids" id="delete_work_ids" value="">
               <div class="card card-bordered card-preview">
                    <div class="card-inner">
                         <div class="d-flex justify-content-end p-2">
                              <div class="nk-block-head-content">
                                   <div class="mbsc-form-group">
                                        <a href="{{ url('/how-it-works') }}" class="btn btn-default">View Page</a>
                                   </div>
                              </div>
                         </div>
                         <div class="col-md-8 pb-2">
                              <div class="form-group">
                                   <label class="form-label" for="title"><b><h4>Page Title</b></h4></label>
                                   <input type="text" class="form-control form-control-lg" id="title" name="title" value="{{ $data['title_name'] ?? '' }}">
                              </div>
                         </div>
                         <hr>
                         <h5>Banner Section</h5>
                         <hr>
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
                                   <textarea class="form-control" id="banner_description" name="banner_description">{{ $data['banner_description'] ?? '' }}</textarea>
                              </div>
                         </div>
                         <div class="col-md-8">
                              <div class="form-group">
                                   <label class="form-label" for="banner_image">Banner Image</label>
                                   <input type="file" class="form-control" id="banner_image" name="banner_image" value="">
                              </div>
                              <div class="form-group">
                                   <img src="{{ asset('storage/'.$data['banner_image'] ?? '' ) }}" height="200px" width="250px">
                              </div>
                         </div>
                         <hr>
                         <h5>How it Works</h5>  
                         <hr>
                         <h6>Work Section</h6>
                         <hr>
                         <div class="col-md-8">
                              <div class="form-group">
                                   <label class="form-label" for="main_heading">Main Heading</label>
                                   <input type="text" class="form-control form-control" id="main_heading" name="main_heading" value="{{ $data['main_heading'] ?? '' }}">
                              </div>
                         </div>
                         <div class="col-md-8">
                              <div class="form-group">
                                   <label class="form-label" for="short_description">Short Description</label>
                                   <textarea class="form-control" id="short_description" name="short_description">{{ $data['short_description'] ?? '' }}</textarea>
                              </div>
                         </div>
                         <div class="col-md-8">
                              <div class="form-group">
                                   <label class="form-label" for="">Works</label>
                              </div>
                         </div>
                         @if(isset($works) && $works->isNotEmpty())
                         @foreach($works as $work)
                         <div class="work-append-sec{{ $work->works->id ?? '' }}">
                              <hr>
                              <div class="row gy-12">
                                   <div class="text-end"><span class="remove-work-sec" data-id="{{ $work->works->id ?? '' }}"><i class="fa fa-times"></i></span></div>
                                   <div class="col-md-2">
                                        <div class="form-group">
                                             <img src="{{ asset('storage/'.$work->works->media->file_name ?? '' ) }}" alt="">
                                        </div>
                                   </div>
                                   <div class="col-md-4">
                                        <div class="form-group">
                                             <label class="form-label" for="work_heading">Heading</label>
                                             <input type="text" class="form-control" id="work_heading" name="work_heading[{{$work->works->id}}]" value="{{ $work->works->heading ?? '' }}">
                                        </div>
                                   </div>
                                   <div class="col-md-4">
                                        <div class="form-group">
                                             <label class="form-label" for="work_description">Description</label>
                                             <textarea class="form-control" id="work_description" name="work_description[{{$work->works->id}}]">{{ $work->works->description ?? '' }}</textarea>
                                        </div>
                                   </div>
                              </div>
                         </div>
                         @endforeach
                         @endif
                         <br>
                         <div class="col-md-3 offset-md-9">
                              <div class="form-group">
                                   <button type="button" class="btn btn-sm btn-primary" id="add-works-sec">Add Row</button>
                              </div>
                         </div>
                         <div id="work-section">
                         </div>
                    </div>
               </div>
               <div class="card card-bordered card-preview">
                    <div class="card-inner">
                         <h6>Second Banner</h6>
                         <hr>
                         <div class="legal-section m-4">
                              <div class="col-md-8">
                                   <div class="form-group">
                                        <label class="form-label" for="second_banner_img">Banner Image</label>
                                        <input type="file" class="form-control" id="second_banner_img" name="second_banner_img">
                                   </div>
                                   <div class="form-group">
                                        <img src="{{ asset('storage/'.$data['second_banner_img'] ?? '' ) }}" height="140px" width="160px">
                                   </div>
                              </div>
                              <div class="col-md-8">
                                   <div class="form-group">
                                        <label class="form-label" for="banner_heading">Heading</label>
                                        <input type="text" class="form-control" id="banner_heading" name="banner_heading" value="{{ $data['second_banner_heading'] ?? '' }}">
                                   </div>
                              </div>
                              <div class="col-md-8">
                                   <div class="form-group">
                                        <label class="form-label" for="sub_heading">Sub Heading</label>
                                        <textarea class="form-control" id="sub_heading" name="sub_heading">x</textarea>
                                   </div>
                              </div>
                              <div class="col-md-8">
                                   <div class="form-group">
                                        <label class="form-label" for="button_label">Button Label</label>
                                        <input type="text" class="form-control" id="button_label" name="button_label" value="{{ $data['button_label'] ?? '' }}">
                                   </div>
                              </div>
                              <div class="col-md-8">
                                   <div class="form-group">
                                        <label class="form-label" for="button_link">Button Link</label>
                                        <input type="text" class="form-control form-control" id="button_link" name="button_link" value="{{ $data['button_link'] ?? '' }}">
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
          // Append Template // 
          $('#add-template-sec').click(function(){
               var html = `<div class="template-append-sec">
                              <hr>
                              <div class="col-md-1 offset-md-11">
                                   <div class="form-group">
                                        <div class="remove-template-sec"><span><i class="fa fa-times"></i></span></div>
                                   </div>
                              </div>
                              <div class="row gy-12">
                                   <div class="col-md-4">
                                        <div class="form-group">
                                             <label class="form-label" for="append_template_image">Image</label>
                                             <input type="file" class="form-control" id="append_template_image" name="append_template_image[]" value="">
                                        </div>
                                   </div>
                                   <div class="col-md-4">
                                        <div class="form-group">
                                             <label class="form-label" for="template-heading">Heading</label>
                                             <input type="text" class="form-control" id="template_heading" name="template_heading[]" value="">
                                        </div>
                                   </div>
                                   <div class="col-md-4">
                                        <div class="form-group">
                                             <label class="form-label" for="templatesubheading">Sub heading</label>
                                             <input type="text" class="form-control" id="templatesubheading" name="templatesubheading[]" value="">
                                        </div>
                                   </div>
                              </div>
                         </div><br>`;

               $('#template-section').append(html);
          });

          // Remove template section //
          $('body').delegate('.remove-template-sec','click',function(){
              $(this).closest('.template-append-sec').hide();
          });

          // Append Work Section // 
          $('#add-works-sec').click(function(){
               var html = `<div class="work-append-sec">
                              <hr>
                              <div class="row gy-12">
                                   <div class="text-end"><span class="remove-work-sec" value="appended"><i class="fa fa-times"></i></span></div>
                                   <div class="col-md-4">
                                        <div class="form-group">
                                             <label class="form-label" for="new_work_image">Image</label>
                                             <input type="file" class="form-control" id="new_work_image" name="new_work_image[]" value="">
                                        </div>
                                   </div>
                                   <div class="col-md-4">
                                        <div class="form-group">
                                             <label class="form-label" for="new_work_heading">Heading</label>
                                             <input type="text" class="form-control" id="new_work_heading" name="new_work_heading[]" value="">
                                        </div>
                                   </div>
                                   <div class="col-md-4">
                                        <div class="form-group">
                                             <label class="form-label" for="new_work_description">Description</label>
                                             <textarea class="form-control" id="new_work_description" name="new_work_description[]"></textarea>
                                        </div>
                                   </div>
                              </div>
                         </div><br>`;

               $('#work-section').append(html);
          });


          $('body').delegate('.remove-work-sec', 'click', function () {
               var id = $(this).data('id');
               if($(this).attr('value') === 'appended'){
                    $(this).closest('.work-append-sec').remove();
                    return false;
               }

               let deleteIds = $('#delete_work_ids').val();
               if(deleteIds) {
                    deleteIds += ',' + id;
               }else {
                    deleteIds = id;
               }
               $('#delete_work_ids').val(deleteIds);

               $('.work-append-sec'+id).hide();
          });


     });
</script>

@endsection
