@extends('admin_layout.master')
@section('content')
<div class="nk-content">
     <div class="container-fluid">
          <form action="{{ url('admin-dashboard/add-how-it-works') }}" method="post" enctype="multipart/form-data">
               @csrf
               <input type="hidden" id="slug" name="slug" value="{{ $howitwork->slug ?? '' }}">
               <div class="card card-bordered card-preview">
                    <div class="card-inner">
                         <div class="col-md-8 pb-2">
                              <div class="form-group">
                                   <label class="form-label" for="title"><b><h4>Page Title</b></h4></label>
                                   <input type="text" class="form-control form-control-lg" id="title" name="title" value="{{ $howitwork->title ?? '' }}">
                              </div>
                         </div>
                         <hr>
                         <h5>How it Works</h5>  
                         <hr>
                         <div class="col-md-8">
                              <div class="form-group" id="template-section">
                                   <label class="form-label" for="">Template Section</label>
                              </div>
                         </div>
                         @if(isset($howitwork->template_section) && $howitwork->template_section != null)
                         <?php 
                              $temp_count = 0; 
                              $template_section = json_decode($howitwork->template_section);
                         ?>
                         @foreach($template_section as $key=>$value)
                         <div class="col-md-4 offset-md-8">
                              <div class="form-group">
                                   <div class="remove-temp-sec"><span><i class="fa fa-times"></i></span></div>
                              </div>
                         </div>
                         <div class="temp-section{{ $temp_count}}">
                              <div class="row gy-12">
                                   <div class="form-group">
                                        <img src="{{ asset('site_images/'.$value->image) }}" alt="">
                                   </div>
                                   <div class="col-md-4">
                                        <div class="form-group">
                                             <label class="form-label" for="template-heading">Heading</label>
                                             <input type="text" class="form-control" id="template_heading" name="template_heading[]" value="{{ $value->heading ?? '' }}">
                                        </div>
                                   </div>
                                   <div class="col-md-4">
                                        <div class="form-group">
                                             <label class="form-label" for="templatesubheading">Sub heading</label>
                                             <input type="text" class="form-control" id="templatesubheading" name="templatesubheading[]" value="{{ $value->sub_heading ?? '' }}">
                                        </div>
                                   </div>
                              </div>
                         </div>
                         <br>
                         <?php $temp_count++; ?>
                         @endforeach
                         @endif
                         <div class="col-md-5 offset-md-7">
                              <div class="form-group">
                                   <button type="button" class="btn btn-sm btn-primary" id="add-template-sec">Add Row</button>
                              </div>
                         </div>
                         <div class="col-md-8">
                              <div class="form-group">
                                   <label class="form-label" for="template_image">Template Section Image</label>
                                   <input type="file" class="form-control form-control" id="template_image" name="template_image" value="">
                              </div>
                         </div>
                         <hr>
                         <h6>Work Section</h6>
                         <hr>
                         <div class="col-md-8">
                              <div class="form-group">
                                   <label class="form-label" for="main_heading">Main Heading</label>
                                   <input type="text" class="form-control form-control" id="main_heading" name="main_heading" value="{{ $howitwork->second_main_heading ?? '' }}">
                              </div>
                         </div>
                         <div class="col-md-8">
                              <div class="form-group">
                                   <label class="form-label" for="short_description">Short Description</label>
                                   <textarea class="form-control" id="short_description" name="short_description">{{ $howitwork->second_short_description ?? '' }}</textarea>
                              </div>
                         </div>
                         <div class="col-md-8">
                              <div class="form-group">
                                   <label class="form-label" for="">Works</label>
                              </div>
                         </div>
                         @if(isset($howitwork->works) && $howitwork->works != null)
                         <?php 
                              $count = 0; 
                              $work_section = json_decode($howitwork->works);
                              $num = 0; $n = 0; $m = 0;
                         ?>
                         @foreach($work_section as $key=>$value)
                         <div class="work-section{{ $count}}">
                              <div class="text-end"><span class="remove-work-sec" key="{{ $m }}"><i class="fa fa-times"></i></span></div>
                              <div class="row gy-12">
                                   <div class="col-md-2">
                                        <div class="form-group">
                                             <img src="{{ asset('site_images/'.$value->image) }}" alt="">
                                        </div>
                                   </div>
                                   <div class="col-md-4">
                                        <div class="form-group">
                                             <label class="form-label" for="work_heading">Heading</label>
                                             <input type="text" class="form-control" id="work_heading" name="work_heading[]" value="{{ $value->heading ?? '' }}">
                                        </div>
                                   </div>
                                   <div class="col-md-4">
                                        <div class="form-group">
                                             <label class="form-label" for="work_description">Description</label>
                                             <textarea class="form-control" id="work_description" name="work_description[]">{{ $value->description ?? '' }}</textarea>
                                        </div>
                                   </div>
                              </div>
                         </div>
                         <?php $count++; $m++; $num++; $n++; ?>
                         @endforeach
                         @endif
                         <br>
                         <!-- <div class="col-md-3 offset-md-9">
                              <div class="form-group">
                                   <button type="button" class="btn btn-sm btn-primary" id="add-works-sec">Add Row</button>
                              </div>
                         </div> -->
                         <div id="work-section">
                         </div>
                         <hr>
                         <div class="col-md-8">
                              <div class="form-group">
                                   <label class="form-label" for="join_our_community">Join our community text</label>
                                   <textarea class="form-control" id="join_our_community" name="join_our_community">{{ $howitwork->join_our_community_text ?? '' }}</textarea>
                              </div>
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
                                        <label class="form-label" for="banner_heading">Heading</label>
                                        <input type="text" class="form-control" id="banner_heading" name="banner_heading" value="{{ $howitwork->banner_heading ?? '' }}">
                                   </div>
                              </div>
                              <div class="col-md-8">
                                   <div class="form-group">
                                        <label class="form-label" for="sub_heading">Sub Heading</label>
                                        <textarea class="form-control" id="sub_heading" name="sub_heading">{{ $howitwork->banner_sub_heading ?? '' }}</textarea>
                                   </div>
                              </div>
                              <div class="col-md-8">
                                   <div class="form-group">
                                        <label class="form-label" for="button_label">Button Label</label>
                                        <input type="text" class="form-control" id="button_label" name="button_label" value="{{ $howitwork->banner_button_label ?? '' }}">
                                   </div>
                              </div>
                              <div class="col-md-8">
                                   <div class="form-group">
                                        <label class="form-label" for="button_link">Button Link</label>
                                        <input type="text" class="form-control form-control" id="button_link" name="button_link" value="{{ $howitwork->banner_button_link ?? '' }}">
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
     $('#title').on("keyup",function(){
          const title = $('#title').val();
          const url = title.toLowerCase().replace(/ /g, '-').replace(/[^\w-]+/g, '');
          const slug = $('#slug').val(url);
     }) 

</script>


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
                         </div><br>`

               $('#template-section').append(html);
          })

          // Remove template section //
          $('body').delegate('.remove-template-sec','click',function(){
              $(this).closest('.template-append-sec').hide();
          });


          // Append Work Section // 
     
          // $('#add-works-sec').click(function(){
          //      var html = `<div class="work-append-sec">
          //                     <hr>
          //                     <div class="row gy-12">
          //                          <div class="text-end"><span class="remove-work-sec" value="appended" key=""><i class="fa fa-times"></i></span></div>
          //                          <div class="col-md-4">
          //                               <div class="form-group">
          //                                    <label class="form-label" for="work_image">Image</label>
          //                                    <input type="file" class="form-control" id="work_image" name="work_image[]" value="">
          //                               </div>
          //                          </div>
          //                          <div class="col-md-4">
          //                               <div class="form-group">
          //                                    <label class="form-label" for="work_heading">Heading</label>
          //                                    <input type="text" class="form-control" id="work_heading" name="work_heading[]" value="">
          //                               </div>
          //                          </div>
          //                          <div class="col-md-4">
          //                               <div class="form-group">
          //                                    <label class="form-label" for="work_description">Description</label>
          //                                    <textarea class="form-control" id="work_description" name="work_description[]"></textarea>
          //                               </div>
          //                          </div>
          //                     </div>
          //                </div><br>`

          //      $('#work-section').append(html);
          // })
          
          let count = "{{ $count ?? '' }}";

          $('#add-works-sec').click(function() {
               var html = `
                    <div class="work-append-sec${count}">
                         <hr>
                         <div class="row gy-12">
                              <div class="text-end">
                                   <span class="remove-work-sec" value="appended" key="${count}">
                                   <i class="fa fa-times"></i>
                                   </span>
                              </div>
                              <div class="col-md-4">
                                   <div class="form-group">
                                   <label class="form-label" for="work_image${count}">Image</label>
                                   <input type="file" class="form-control" id="work_image${count}" name="work_image[]" value="">
                                   </div>
                              </div>
                              <div class="col-md-4">
                                   <div class="form-group">
                                   <label class="form-label" for="work_heading${count}">Heading</label>
                                   <input type="text" class="form-control" id="work_heading${count}" name="work_heading[]" value="">
                                   </div>
                              </div>
                              <div class="col-md-4">
                                   <div class="form-group">
                                   <label class="form-label" for="work_description${count}">Description</label>
                                   <textarea class="form-control" id="work_description${count}" name="work_description[]"></textarea>
                                   </div>
                              </div>
                         </div>
                    </div><br>`;
               
               $('#work-section').append(html);
               count = parseInt(count) + 1;
          });

          $('body').delegate('.remove-work-sec','click',function(){
               key = $(this).attr('key');

               if($(this).attr('value') === 'appended'){
                    $('.work-append-sec'+key).remove();
                    return false;
               }
               $.ajax({
                    method:'post',
                    url:"{{ url('admin-dashboard/add-how-it-works') }}",
                    data:{ _token:"{{ csrf_token() }}",key:key,action:'update_work_sec' },
                    success:function(response){
                         // console.log(response);
                         $('.work-append-sec'+key).remove();
                    }
               })
          });

     })
</script>


@endsection