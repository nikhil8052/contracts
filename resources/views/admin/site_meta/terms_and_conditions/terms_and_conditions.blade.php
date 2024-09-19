@extends('admin_layout.master')
@section('content')
<div class="nk-content">
     <div class="container-fluid">
          <form action="{{ url('/admin-dashboard/add-terms-process') }}" method="post" enctype="multipart/form-data">
               @csrf
               <div class="card card-bordered card-preview">
                    <div class="card-inner">
                         <div class="col-md-8 pb-2">
                              <div class="form-group">
                                   <label class="form-label" for="title"><b><h4>Page Title</b></h4></label>
                                   <input type="text" class="form-control form-control-lg" id="title" name="title" value="">
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
                                             <input type="text" class="form-control" id="main_heading" name="main_heading" value="">
                                        </div>
                                   </div>
                                   <div class="col-md-8">
                                        <div class="form-group">
                                             <label class="form-label" for="sub_heading">Sub Heading</label>
                                             <input type="text" class="form-control" id="sub_heading" name="sub_heading" value="">
                                        </div>
                                   </div>
                                   <div class="col-md-8">
                                        <div class="form-group" id="terms_section">
                                             <label class="form-label" for="main_heading">Terms & condition</label>
                                        </div>
                                   </div>
                                   <div class="col-md-5 offset-md-7">
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
     $(document).ready(function(){
          $('#addnewrow').click(function(){
               var html = `<div class="append-sec">
                              <hr>
                              <div class="col-md-3 offset-md-9">
                                   <div class="form-group">
                                        <div class=""><span class="removeTerms"><i class="fa fa-times"></i></span></div>
                                   </div>
                              </div>
                              <div class="row gy-4">
                                   <div class="col-md-5">
                                             <div class="form-group">
                                             <label class="form-label" for="terms">Terms</label>
                                             <input type="text" class="form-control form-control" id="terms" name="terms" value="">
                                        </div>
                                   </div>
                                   <div class="col-md-5">
                                        <div class="form-group">
                                             <label class="form-label" for="condition">Condition</label>
                                             <textarea class="add-editor" id="condition" name="condition"></textarea>
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
                         $(this).data('ckeditor-initialized', true); // Mark as initialized
                    }
               });

               $('body').delegate('.removeTerms','click',function(){
                    $(this).closest('.append-sec').hide();
               })
          })
     })
</script>


@endsection