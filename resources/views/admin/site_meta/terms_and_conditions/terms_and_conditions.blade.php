@extends('admin_layout.master')
@section('content')
<div class="nk-content">
     <div class="container-fluid">
          <form action="{{ url('/admin-dashboard/add-terms-process') }}" method="post" enctype="multipart/form-data">
               @csrf
               <input type="hidden" name="remove_ids" id="remove_ids" value="">
               <div class="row main_section">
                    <div class="col-md-8 left-content">
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
                                   <img src="{{ asset('storage/'.$data['banner_image'] ?? '' ) }}">
                              </div>
                         </div>
                         <hr>
                         <h5>term & Condition</h5>  
                         <hr>
                         <h6>Terms & Condition Section</h6>
                         <div class="col-md-8">
                              <div class="form-group">
                                   <label class="form-label" for="main_heading">Main Heading</label>
                                   <input type="text" class="form-control" id="main_heading" name="main_heading" value="{{ $data['main_heading'] ?? '' }}">
                              </div>
                         </div>
                         <div class="col-md-8">
                              <div class="form-group" id="terms_section">
                                   <label class="form-label" for="main_heading">Terms & condition</label>
                              </div>
                         </div>
                         @if(isset($termsAndCondition) && $termsAndCondition->isNotEmpty())
                         @foreach($termsAndCondition as $index=>$value)
                         <div class="append-sec{{ $value->id ?? '' }}">
                              <div class="col-md-2 offset-md-10">
                                   <div class="form-group">
                                        <div><span class="removeTerms" data-id="{{ $value->id ?? '' }}"><i class="fa fa-times"></i></span></div>
                                   </div>
                              </div>
                              <div class="row gy-4">
                                   <div class="col-md-5">
                                             <div class="form-group">
                                             <label class="form-label" for="terms">Terms</label>
                                             <input type="text" class="form-control form-control" id="terms" name="terms[{{ $value->id ?? '' }}]" value="{{ $value->terms ?? '' }}">
                                        </div>
                                   </div>
                                   <div class="col-md-5">
                                        <div class="form-group">
                                             <label class="form-label" for="condition">Condition</label>
                                             <textarea class="form-control" id="condition{{ $index ?? '' }}" name="condition[{{ $value->id ?? '' }}]">{{ $value->condition ?? '' }}</textarea>
                                        </div>
                                   </div>
                              </div>
                         </div>
                         <script>  ClassicEditor.create( document.querySelector('#condition{{ $index }}')); </script>
                         @endforeach
                         @endif
                         <br>
                         <div id="termCondition-section"></div>
                         <div class="col-md-3 offset-md-9">
                              <div class="form-group">
                                   <button type="button" class="btn btn-sm btn-primary" id="addnewrow">Add Row</button>
                              </div>
                         </div>
                    </div>
                    <div class="col-md-4 right-content">
                         <div class="card card-bordered card-preview">
                              <div class="card-inner">
                                   <div class="col-md-12">
                                        <div class="form-group">
                                             <label class="form-label" for="title_tag">Title Tag</label>
                                             <input type="text" class="form-control" id="title_tag" name="title_tag" value="">
                                        </div>
                                   </div>
                                   <div class="col-md-12">
                                        <div class="form-group">
                                             <label class="form-label" for="title_description">Title Description</label>
                                             <textarea class="form-control" id="title_tag" name="title_description"></textarea>
                                        </div>
                                   </div>
                                   <div class="row">
                                        <div class="view_btn col-md-6 mt-3">
                                             <a href="{{ url('/terms-and-conditions') }}" class="btn btn-primary" target="_blank">View Page</a>
                                        </div>
                                        <div class="up-btn col-md-6 mt-3">
                                             <button class="btn btn-primary" type="submit">Save</button>
                                        </div>
                                   </div>
                              </div> 
                         </div>
                    </div>
               </div>
          </form>
     </div>
</div>


<script>

     ClassicEditor
     .create( document.querySelector('#description'))
     .catch( error => {
          console.error( error );
     });


     $(document).ready(function(){
          $('#addnewrow').click(function(){
               var html = `<div class="append-sec">
                              <hr>
                              <div class="col-md-2 offset-md-10">
                                   <div class="form-group">
                                        <div class=""><span class="removeTerms" value="appended"><i class="fa fa-times"></i></span></div>
                                   </div>
                              </div>
                              <div class="row gy-4">
                                   <div class="col-md-5">
                                             <div class="form-group">
                                             <label class="form-label" for="new_terms">Terms</label>
                                             <input type="text" class="form-control form-control" id="new_terms" name="new_terms[]" value="">
                                        </div>
                                   </div>
                                   <div class="col-md-5">
                                        <div class="form-group">
                                             <label class="form-label" for="new_condition">Condition</label>
                                             <textarea class="add-editor" id="new_condition" name="new_condition[]"></textarea>
                                        </div>
                                   </div>
                              </div>
                         </div>`;
               $('#termCondition-section').append(html);

               $('.add-editor').each(function() {
                    if (!$(this).data('ckeditor-initialized')) {
                         ClassicEditor
                              .create(this)
                              .catch(error => {
                                   console.error(error);
                              });
                         $(this).data('ckeditor-initialized', true); 
                    }
               });
          })

          $('body').delegate('.removeTerms', 'click', function () {
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
     })
</script>


@endsection