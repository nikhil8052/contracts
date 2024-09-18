@extends('admin_layout.master')
@section('content')

<div class="nk-content">
     <div class="container-fluid">
          <form action="{{ url('admin-dashboard/add-how-it-works') }}" method="post" enctype="multipart/form-data">
               @csrf
               <input type="hidden" id="slug" name="slug" value="">
               <div class="card card-bordered card-preview">
                    <div class="card-inner">
                         <div class="col-md-8 pb-2">
                              <div class="form-group">
                                   <label class="form-label" for="title"><b><h4>Page Title</b></h4></label>
                                   <input type="text" class="form-control form-control-lg" id="title" name="title" value="">
                              </div>
                         </div>
                         <hr>
                         <h5>First Section</h5>  
                         <hr>
                         <div class="col-md-8">
                              <div class="form-group" id="template-section">
                                   <label class="form-label" for="">Template Section</label>
                              </div>
                         </div>
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
                         <h6>Second Section</h6>
                         <hr>
                         <div class="col-md-8">
                              <div class="form-group">
                                   <label class="form-label" for="main_heading">Main Heading</label>
                                   <input type="text" class="form-control form-control" id="main_heading" name="main_heading" value="">
                              </div>
                         </div>
                         <div class="col-md-8">
                              <div class="form-group">
                                   <label class="form-label" for="short_description">Short Description</label>
                                   <textarea class="form-control" id="short_description" name="short_description"></textarea>
                              </div>
                         </div>
                         <div class="col-md-8">
                              <div class="form-group" id="work-section">
                                   <label class="form-label" for="">Works</label>
                              </div>
                         </div>
                         <div class="col-md-5 offset-md-7">
                              <div class="form-group">
                                   <button type="button" class="btn btn-sm btn-primary" id="add-works-sec">Add Row</button>
                              </div>
                         </div>
                         <hr>
                         <div class="col-md-8">
                              <div class="form-group">
                                   <label class="form-label" for="join_our_community">Join our community text</label>
                                   <textarea class="form-control" id="join_our_community" name="join_our_community"></textarea>
                              </div>
                         </div>
                    </div>
               </div>
               <div class="card card-bordered card-preview">
                    <div class="card-inner">
                         <h6>Banner Section</h6>
                         <hr>
                         <div class="legal-section m-4">
                              <div class="col-md-8">
                                   <div class="form-group">
                                        <label class="form-label" for="banner_heading">Heading</label>
                                        <input type="text" class="form-control form-control" id="banner_heading" name="banner_heading" value="">
                                   </div>
                              </div>
                              <div class="col-md-8">
                                   <div class="form-group">
                                        <label class="form-label" for="sub_heading">Sub Heading</label>
                                        <input type="text" class="form-control form-control" id="sub_heading" name="sub_heading" value="">
                                   </div>
                              </div>
                              <div class="col-md-8">
                                   <div class="form-group">
                                        <label class="form-label" for="button_label">Button Label</label>
                                        <input type="text" class="form-control form-control" id="button_label" name="button_label" value="">
                                   </div>
                              </div>
                              <div class="col-md-8">
                                   <div class="form-group">
                                        <label class="form-label" for="button_link">Button Link</label>
                                        <input type="text" class="form-control form-control" id="button_link" name="button_link" value="">
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
          $('#add-works-sec').click(function(){
               var html = `<div class="work-append-sec">
                              <hr>
                              <div class="col-md-1 offset-md-11">
                                   <div class="form-group">
                                        <div class="remove-work-sec"><span><i class="fa fa-times"></i></span></div>
                                   </div>
                              </div>
                              <div class="row gy-12">
                                   <div class="col-md-4">
                                        <div class="form-group">
                                             <label class="form-label" for="work_image">Image</label>
                                             <input type="file" class="form-control" id="work_image" name="work_image[]" value="">
                                        </div>
                                   </div>
                                   <div class="col-md-4">
                                        <div class="form-group">
                                             <label class="form-label" for="work_heading">Heading</label>
                                             <input type="text" class="form-control" id="work_heading" name="work_heading[]" value="">
                                        </div>
                                   </div>
                                   <div class="col-md-4">
                                        <div class="form-group">
                                             <label class="form-label" for="work_description">Description</label>
                                             <textarea class="form-control" id="work_description" name="work_description[]"></textarea>
                                        </div>
                                   </div>
                              </div>
                         </div><br>`

               $('#work-section').append(html);
          })

          // Remove work section //
          $('body').delegate('.remove-work-sec','click',function(){
              $(this).closest('.work-append-sec').hide();
          });



     })
</script>


@endsection