@extends('admin_layout.master')
@section('content')
<div class="nk-content">
     <div class="container-fluid">
          <form action="{{ url('/admin-dashboard/add-terms-process') }}" method="post" enctype="multipart/form-data">
               @csrf
               <input type="hidden" name="remove_ids" id="remove_ids" value="">
               <div class="card card-bordered card-preview">
                    <div class="card-inner">
                         <div class="col-md-8 pb-2">
                              <div class="form-group">
                                   <label class="form-label" for="title"><b><h4>Page Title</b></h4></label>
                                   <input type="text" class="form-control form-control-lg" id="title" name="title" value="{{ $data['title_name'] ?? '' }}">
                              </div>
                         </div>
                         <div class="col-md-8">
                              <div class="form-group">
                                   <label class="form-label" for="description"></label>
                                   <textarea class="form-control" id="description" name="description">{{ $data['description'] ?? ''}}</textarea>
                              </div>
                         </div>
                         <hr>
                         <h5>term & Condition</h5>  
                         <hr>
                         <h6>Terms & Condition Section</h6>
                         <div class="card card-bordered card-preview">
                              <div class="card-inner">
                                   <div class="col-md-8">
                                        <div class="form-group">
                                             <label class="form-label" for="main_heading">Main Heading</label>
                                             <input type="text" class="form-control" id="main_heading" name="main_heading" value="{{ $data['main_heading'] ?? '' }}">
                                        </div>
                                   </div>
                                   <div class="col-md-8">
                                        <div class="form-group">
                                             <label class="form-label" for="sub_heading">Sub Heading</label>
                                             <input type="text" class="form-control" id="sub_heading" name="sub_heading" value="{{ $data['sub_heading'] ?? '' }}">
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
                                   <div class="col-md-3 offset-md-9">
                                        <div class="form-group">
                                             <button type="button" class="btn btn-sm btn-primary" id="addnewrow">Add Row</button>
                                        </div>
                                   </div>
                                   <div id="termCondition-section">
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