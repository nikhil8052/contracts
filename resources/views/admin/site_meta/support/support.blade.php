@extends('admin_layout.master')
@section('content')

<div class="nk-content">
     <div class="container-fluid">
          <form action="{{ url('/admin-dashboard/help-center-proccess') }}" method="POST" enctype="multipart/form-data">
               @csrf
               <input type="hidden" name="removefaq" id="removefaq" value="">
               <input type="hidden" id="removehelp" name="removehelp" value="">
               <!-- <input type="hidden" id="baner_image_id" name="baner_image_id" value=""> -->
               <div class="card card-bordered card-preview">
                    <div class="card-inner">
                         <div class="d-flex justify-content-end p-2">
                              <div class="nk-block-head-content">
                                   <div class="mbsc-form-group">
                                        <a href="{{ url('/help-center') }}" target="_blank" class="btn btn-default">View Page</a>
                                   </div>
                              </div>
                         </div>
                         <div class="col-md-12 pb-2">
                              <div class="form-group">
                                   <label class="form-label" for="title"><b><h5>Title</b></h5></label>
                                   <input class="form-control form-control-lg" type="text" id="title"  name="title" value="{{ $data['title'] ?? '' }}">
                              </div>
                         </div>        
                         <hr>
                         <h5>Banner Section</h5>
                         <hr>
                         <div class="col-md-12">
                              <div class="form-group">
                                   <label class="form-label" for="background_image">Background Image</label>
                                   <input type="file" class="form-control" id="background_image" name="background_image">
                              </div>
                              @if(isset($data['background_image']) && $data['background_image'] != null)
                              <div class="bg_image_div" id="bg_image{{ $data['background_image_id'] ?? '' }}">
                                   <!-- <div class="form-group">
                                        <span class="col-md-10 offset-md-2 remove_background_image" data-id="{{ $data['background_image_id'] ?? '' }}">
                                             <i class="fa fa-times"></i>
                                        </span>
                                   </div> -->
                                   <div class="form-group">
                                        <img src="{{ asset('storage/'.$data['background_image']) }}" alt="background_img" height="160px" width="160px">
                                   </div>
                              </div>
                              @endif
                         </div>
                         <div class="col-md-12">
                              <div class="form-group">
                                   <label class="form-label" for="banner_title">Banner Title</label>
                                   <input type="text" class="form-control" id="banner_title" name="banner_title" value="{{ $data['banner_title'] ?? '' }}">
                              </div>
                         </div>
                         <div class="col-md-12">
                              <div class="form-group">
                                   <label class="form-label" for="banner_placeholder">Banner Placeholder</label>
                                   <input type="text" class="form-control" id="banner_placeholder" name="banner_placeholder" value="{{ $data['banner_placeholder'] ?? '' }}">
                              </div>
                         </div>
                         <div class="col-md-12">
                              <div class="form-group">
                                   <label class="form-label" for="banner_image">Banner Image</label>
                                   <input type="file" class="form-control" id="banner_image" name="banner_image">
                              </div>
                              @if(isset($data['banner_image']) && $data['banner_image'] != null)
                              <div class="banner_div" id="banner_div{{ $data['banner_image_id'] ?? '' }}">
                                   <!-- <div class="form-group">
                                        <span class="col-md-10 offset-md-2 remove_banner_image" data-id="{{ $data['banner_image_id'] ?? '' }}">
                                             <i class="fa fa-times"></i>
                                        </span>
                                   </div> -->
                                   <div class="form-group">
                                        <img src="{{ asset('storage/'.$data['banner_image']) }}" alt="banner_img" height="140px" width="160px">
                                   </div>
                              </div>
                              @endif
                         </div>
                         <hr>
                         <h5>Help Section</h5>
                         <hr>
                         <div class="col-md-12">
                              <div class="form-group">
                                   <label class="form-label" for="main_title">Main Title</label>
                                   <input type="text" class="form-control" id="main_title" name="main_title" value="{{ $data['main_title'] ?? '' }}">
                              </div>
                         </div>
                         <div id="help-container"></div>
                         <br>
                         <div class="text-end">
                              <div class="form-group">
                                   <button type="button" class="btn btn-sm btn-primary" id="add-help-sec">Add</button>
                              </div>
                         </div>
                         <hr>
                         <h5>FAQ Section</h5>
                         <hr>
                         <div class="col-md-12">
                              <div class="form-group">
                                   <label class="form-label" for="faq_heading">FAQ Heading</label>
                                   <input type="text" class="form-control" id="faq_heading" name="faq_heading" value="{{ $data['faq_heading'] ?? '' }}">
                              </div>
                         </div>
                         <div class="col-md-12">
                              <div class="form-group">
                                   <label class="form-label" for="faq_description">FAQ Description</label>
                                   <textarea class="form-control" id="faq_description" name="faq_description">{{ $data['faq_description'] ?? '' }}</textarea>
                              </div>
                         </div>
                         <div class="col-md-12">
                              <div class="form-group">
                                   <label class="form-label" for="">FAQ</label>
                              </div>    
                         </div>
                         @if(isset($faqs) && $faqs != null)
                         @foreach($faqs as $faq)
                         <div class="faq-append-sec{{ $faq->id ?? '' }}">
                              <hr>
                              <div class="row gy-12">
                                   <div class="text-end">
                                        <div class="form-group">
                                             <div><span class="remove-faq-sec" data-id="{{ $faq->id ?? '' }}"><i class="fa fa-times"></i></span></div>
                                        </div>
                                   </div>
                                   <div class="col-md-6">
                                        <div class="form-group">
                                             <label class="form-label" for="question">Question</label>
                                             <input class="form-control" name="question[{{ $faq->id ?? '' }}]" id="question" value="{{ $faq->question ?? '' }}">
                                        </div>
                                   </div>
                                   <div class="col-md-6">
                                        <div class="form-group">
                                             <label class="form-label" for="answer">Answer</label>
                                             <textarea class="form-control answer_editor" name="answer[{{ $faq->id ?? '' }}]" id="answer">{{ $faq->answer ?? '' }}</textarea>
                                        </div>
                                   </div>
                              </div>
                         </div>
                         @endforeach
                         @endif
                         <div id="faq-container"></div>
                         <br>
                         <div class="text-end">
                              <div class="form-group">
                                   <button type="button" class="btn btn-sm btn-primary" id="add-faq-sec">Add</button>
                              </div>
                         </div>
                         <hr>
                         <h5>Bottom Banner Section</h5>
                         <hr>
                         <div class="col-md-12">
                              <div class="form-group">
                                   <label class="form-label" for="bottom_banner_image">Banner Image</label>
                                   <input type="file" class="form-control" id="bottom_banner_image" name="bottom_banner_image">
                              </div>
                              @if(isset($data['bottom_banner_image']) && $data['bottom_banner_image'] != null)
                              <div class="banner_div" id="banner_div{{ $data['banner_image_id'] ?? '' }}">
                                   <!-- <div class="form-group">
                                        <span class="col-md-10 offset-md-2 remove_banner_image" data-id="{{ $data['banner_image_id'] ?? '' }}">
                                             <i class="fa fa-times"></i>
                                        </span>
                                   </div> -->
                                   <div class="form-group">
                                        <img src="{{ asset('storage/'.$data['bottom_banner_image']) }}" alt="banner_img" height="140px" width="160px">
                                   </div>
                              </div>
                              @endif
                         </div>
                         <div class="col-md-12">
                              <div class="form-group">
                                   <label class="form-label" for="banner_heading">Banner Heading</label>
                                   <input type="text" class="form-control" id="banner_heading" name="banner_heading" value="{{ $data['banner_heading'] ?? '' }}">
                              </div>
                         </div>
                         <div class="col-md-12">
                              <div class="form-group">
                                   <label class="form-label" for="banner_description">Banner Description</label>
                                   <textarea class="form-control" id="banner_description" name="banner_description">{{ $data['banner_description'] ?? '' }}</textarea>
                              </div>
                         </div>
                         <div class="col-md-12">
                              <div class="form-group">
                                   <label class="form-label" for="button_text">Button Text</label>
                                   <input type="text" class="form-control" id="button_text" name="button_text" value="{{ $data['button_text'] ?? '' }}">
                              </div>
                         </div>
                         <div class="mt-3">
                              <button class="btn btn-primary save_and_remove_btn" type="submit">Save</button>
                         </div>
                    </div>
               </div>       
          </form>
     </div>
</div>

<script>
function initializeCKEditor(element) {
     ClassicEditor.create(element).catch(error => {
          console.error(error);
     });
}

$(document).ready(function() {
     $('.answer_editor').each(function() {
          initializeCKEditor(this);
     });

     $('#add-faq-sec').click(function() {
          let faqHtml = `
          <div class="faq-append-sec">
          <hr>
          <div class="row gy-12">
               <div class="text-end">
                    <div class="form-group">
                         <div><span class="remove-faq-sec" value="appended"><i class="fa fa-times"></i></span></div>
                    </div>
               </div>
               <div class="col-md-6">
                    <div class="form-group">
                         <label class="form-label" for="new_question">Question</label>
                         <input class="form-control" name="new_question[]" id="new_question" value="">
                    </div>
               </div>
               <div class="col-md-6">
                    <div class="form-group">
                         <label class="form-label" for="new_answer">Answer</label>
                         <textarea class="form-control answer_editor" name="new_answer[]" id="new_answer"></textarea>
                    </div>
               </div>
          </div>
          </div>`;

          $('#faq-container').append(faqHtml);

          const newTextarea = $('.answer_editor').last()[0];
          if (newTextarea && !$(newTextarea).data('ckeditor-initialized')) {
               initializeCKEditor(newTextarea);
               $(newTextarea).data('ckeditor-initialized', true);
          }

     });

     $('body').delegate('.remove-faq-sec', 'click', function(){
          var id = $(this).data('id');
          if($(this).attr('value') === 'appended'){
               $(this).closest('.faq-append-sec').remove();
               return false;
          }

          let deleteIds = $('#removefaq').val();
          
          if(deleteIds) {
               deleteIds += ',' + id;
          }else{
               deleteIds = id;
          }
          $('#removefaq').val(deleteIds);

          $('.faq-append-sec'+id).hide();
     });   

     $('#add-help-sec').click(function() {
          let faqHtml = `<div class="help-append-sec">
          <hr>
               <div class="row gy-12">
                    <div class="text-end">
                         <div class="form-group">
                              <div><span class="remove-help-sec" value="appended"><i class="fa fa-times"></i></span></div>
                         </div>
                    </div>
                    <div class="col-md-2">
                         <div class="form-group">
                              <label class="form-label" for="icon">Icon</label>
                              <input type="file" class="form-control" id="icon" name="icon[]">
                         </div>
                    </div>
                    <div class="col-md-5">
                         <div class="form-group">
                              <label class="form-label" for="heading">Heading</label>
                              <input class="form-control" name="heading[]" id="heading" value="">
                         </div>
                    </div>
                    <div class="col-md-5">
                         <div class="form-group">
                              <label class="form-label" for="description">Description</label>
                              <textarea class="form-control" name="description[]" id="description"></textarea>
                         </div>
                    </div>
               </div>
          </div>`;

          $('#help-container').append(faqHtml);
     });

     $('body').delegate('.remove-help-sec', 'click', function(){
          var id = $(this).data('id');
          if($(this).attr('value') === 'appended'){
               $(this).closest('.help-append-sec').remove();
               return false;
          }

          let deleteIds = $('#removehelp').val();
          
          if(deleteIds) {
               deleteIds += ',' + id;
          }else{
               deleteIds = id;
          }
          $('#removehelp').val(deleteIds);

          $('.help-append-sec'+id).hide();
     });   
});

</script>

@endsection