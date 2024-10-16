@extends('admin_layout.master')
@section('content')
<div class="nk-content">
     <div class="container-fluid">
          <form action="" method="POST" enctype="multipart/form-data">
               @csrf
               <input type="hidden" name="removeVision" id="removeVision" value="">
               <input type="hidden" id="removeOffer" name="removeOffer" value="">
               <input type="hidden" id="baner_image_id" name="baner_image_id" value="">
               <div class="card card-bordered card-preview">
                    <div class="card-inner">
                         <div class="d-flex justify-content-end p-2">
                              <!-- <div class="nk-block-head-content">
                                   <div class="mbsc-form-group">
                                        <a href="{{ url('/') }}" target="_blank" class="btn btn-default">View Page</a>
                                   </div>
                              </div> -->
                         </div>
                         <div class="col-md-12 pb-2">
                              <div class="form-group">
                                   <label class="form-label" for="title"><b><h5>Title</b></h5></label>
                                   <input class="form-control form-control-lg" type="text" id="title"  name="title" value="">
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
                         
                         </div>
                         <div class="col-md-12">
                              <div class="form-group">
                                   <label class="form-label" for="banner_title">Banner Title</label>
                                   <input type="text" class="form-control" id="banner_title" name="banner_title" value="">
                              </div>
                         </div>
                         <div class="col-md-12">
                              <div class="form-group">
                                   <label class="form-label" for="banner_description">Banner Description</label>
                                   <textarea class="form-control" id="banner_description" name="banner_description"></textarea>
                              </div>
                         </div>
                         <div class="col-md-12">
                              <div class="form-group">
                                   <label class="form-label" for="banner_image">Banner Image</label>
                                   <input type="file" class="form-control" id="banner_image" name="banner_image">
                              </div>
                         </div>
                         <hr>
                         <h6>About Legal Documents Section</h6>
                         <hr>
                         <div class="col-md-12">
                              <div class="form-group">
                                   <label class="form-label" for="image">Image</label>
                                   <input type="file" class="form-control" name="image[]" id="image" value="">
                              </div>
                         </div>
                         <div class="col-md-12">
                              <div class="form-group">
                                   <label class="form-label" for="heading">Heading</label>
                                   <input type="text" class="form-control" name="heading[]" id="heading" value="">
                              </div>
                         </div>
                         <div class="col-md-12 mt-2">
                              <div class="form-group">
                                   <label class="form-label" for="description">Description</label>
                                   <textarea class="form-control answer_editor" name="description[]" id="description"></textarea>
                              </div>
                         </div>
                         <hr>
                         <h6>Vision Section</h6>
                         <hr>
                         <div id="vision_container"></div>
                         <br>
                         <div class="text-end">
                              <div class="form-group">
                                   <button type="button" class="btn btn-sm btn-primary" id="add-sec">Add</button>
                              </div>
                         </div>
                         <hr>
                         <h6>Offer Section</h6>
                         <hr>
                         <div class="col-md-12">
                              <div class="form-group">
                                   <label class="form-label" for="offer_image">Image</label>
                                   <input type="file" class="form-control" name="offer_image[]" id="offer_image" value="">
                              </div>
                         </div>
                         <div class="col-md-12">
                              <div class="form-group">
                                   <label class="form-label" for="offer_heading">Heading</label>
                                   <input type="text" class="form-control" name="offer_heading[]" id="offer_heading" value="">
                              </div>
                         </div>
                         <div class="col-md-12 mt-2">
                              <div class="form-group">
                                   <label class="form-label" for="offer_description">Description</label>
                                   <textarea class="form-control" name="offer_description[]" id="offer_description"></textarea>
                              </div>
                         </div>
                         <hr>
                         <div class="col-md-12">
                              <div class="form-group">
                                   <label class="form-label" for="">Offers</label>
                              </div>
                         </div>
                         <div id="offer_container"></div>
                         <br>
                         <div class="text-end">
                              <div class="form-group">
                                   <button type="button" class="btn btn-sm btn-primary" id="add-offer-sec">Add</button>
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
    $(document).ready(function(){
        $('.remove_background_image').click(function(){
            id = $(this).data('id');
            $('#bg_image_id').val(id);
            $('#bg_image'+id).hide();
        });

        $('.remove_banner_image').click(function(){
            id = $(this).data('id');
            $('#baner_image_id').val(id);
            $('#banner_div'+id).hide();
        });
    })
   
</script>


<script> 
function initializeCKEditor(element) {
     ClassicEditor.create(element).catch(error => {
          console.error(error);
     });
}

$('.answer_editor').each(function() {
     initializeCKEditor(this);
});

$(document).ready(function() {
     $('#add-sec').click(function() {
          let html = `
          <div class="vision_append">
          <hr>
          <div class="row gy-12">
               <div class="text-end">
                    <div class="form-group">
                         <div><span class="remove_vision" value="appended"><i class="fa fa-times"></i></span></div>
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
                         <label class="form-label" for="vision_heading">Heading</label>
                         <input class="form-control" name="vision_heading[]" id="vision_heading" value="">
                    </div>
               </div>
               <div class="col-md-5">
                    <div class="form-group">
                         <label class="form-label" for="vision_description">Description</label>
                         <textarea class="form-control" name="vision_description[]" id="vision_description"></textarea>
                    </div>
               </div>
          </div>
          </div>`;

          $('#vision_container').append(html);
     });

     $('body').delegate('.remove_vision', 'click', function(){
          var id = $(this).data('id');
          if($(this).attr('value') === 'appended'){
               $(this).closest('.vision_append').remove();
               return false;
          }

          let deleteIds = $('#removeVision').val();
          
          if(deleteIds) {
               deleteIds += ',' + id;
          }else{
               deleteIds = id;
          }
          $('#removeVision').val(deleteIds);

          $('.vision_append'+id).hide();
     });   

     $('#add-offer-sec').click(function(){
          let html = `
          <div class="offer_append">
          <hr>
          <div class="row gy-12">
               <div class="text-end">
                    <div class="form-group">
                         <div><span class="remove_offer" value="appended"><i class="fa fa-times"></i></span></div>
                    </div>
               </div>
               <div class="col-md-6">
                    <div class="form-group">
                         <label class="form-label" for="of_heading">Offer Heading</label>
                         <input class="form-control" name="of_heading[]" id="of_heading" value="">
                    </div>
               </div>
               <div class="col-md-6">
                    <div class="form-group">
                         <label class="form-label" for="of_description">Offer Description</label>
                         <textarea class="form-control" name="of_description[]" id="of_description"></textarea>
                    </div>
               </div>
          </div>
          </div>`;

          $('#offer_container').append(html);
     });

     $('body').delegate('.remove_offer', 'click', function(){
          var id = $(this).data('id');
          if($(this).attr('value') === 'appended'){
               $(this).closest('.offer_append').remove();
               return false;
          }

          let deleteIds = $('#removeOffer').val();
          
          if(deleteIds) {
               deleteIds += ',' + id;
          }else{
               deleteIds = id;
          }
          $('#removeOffer').val(deleteIds);

          $('.offer_append'+id).hide();
     });  
});


</script>


@endsection