@extends('admin_layout.master')
@section('content')

<div class="nk-content">
     <div class="container-fluid">
          <form action="{{ url('/admin-dashboard/add-review') }}" method="post" enctype="multipart/form-data">
               @csrf
               <div class="card card-bordered card-preview">
                    <div class="card-inner">
                         <div class="col-md-8 pb-2">
                              <div class="form-group">
                                   <label class="form-label" for="name">Profile Image</label>
                                   <input type="file" class="form-control" id="profile" name="profile">
                              </div>
                         </div>
                         <div class="col-md-8">
                              <div class="form-group">
                                   <label class="form-label" for="document">Select Document</label>
                                   <select class="form-select" id="document" name="document" tabindex="-1" aria-hidden="true">
                                        <option value="" disabled selected>Select</option>
                                        @if(isset($documents) && $documents != null) 
                                        @foreach($documents as $doc)
                                             <option value="{{ $doc->id ?? '' }}">{{ $doc->title ?? '' }}</option>
                                        @endforeach
                                        @endif
                                   </select>
                              </div>
                         </div>
                         <div class="col-md-8 pb-2">
                              <div class="form-group">
                                   <label class="form-label" for="regular_price">Document Rating</label>
                              </div>
                              <div id="full-stars-example-two">
                                   <div class="ratings">
                                        <label for="rating1">
                                             <i rate="1" class="star fa fa-star rating-color"></i>
                                        </label>
                                        <input type="checkbox" name="rating" id="rating1" class="chkbox" style="display:none;" value="1">
                                        <label for="rating2">
                                             <i rate="2" class="star fa fa-star rating-color"></i>
                                        </label>
                                        <input type="checkbox" name="rating" id="rating2" class="chkbox" style="display:none;" value="2">
                                        <label for="rating3">
                                             <i rate="3" class="star fa fa-star rating-color"></i>
                                        </label>
                                        <input type="checkbox" name="rating" id="rating3" class="chkbox" style="display:none;" value="3">
                                        <label for="rating4">
                                             <i rate="4" class="star fa fa-star rating-color"></i>
                                        </label>
                                        <input type="checkbox" name="rating" id="rating4" class="chkbox" style="display:none;" value="4">
                                        <label for="rating5">
                                             <i rate="5" class="star fa fa-star rating-color"></i>
                                        </label>
                                        <input type="checkbox" name="rating" id="rating5" class="chkbox" style="display:none;" value="5" checked>
                                   </div>
                              </div>
                         </div>
                         <div class="col-md-8 pb-2">
                              <div class="form-group">
                                   <label class="form-label" for="first_name">First Name</label>
                                   <input type="text" class="form-control" id="first_name" name="first_name" value="">
                              </div>
                         </div>
                         <div class="col-md-8 pb-2">
                              <div class="form-group">
                                   <label class="form-label" for="last_name">Last Name</label>
                                   <input type="text" class="form-control" id="last_name" name="last_name" value="">
                              </div>
                         </div>
                         <div class="col-md-8 pb-2">
                              <div class="form-group">
                                   <label class="form-label" for="city_name">City Name</label>
                                   <input type="text" class="form-control" id="city_name" name="city_name" value="">
                              </div>
                         </div>
                         <div class="col-md-8 pb-2">
                              <div class="form-group">
                                   <label class="form-label" for="date">Date</label>
                                   <input type="date" class="form-control" id="date" name="date" value="">
                              </div>
                         </div>
                         <div class="col-md-8 pb-2">
                              <div class="form-group">
                                   <label class="form-label" for="description">Document Review Description</label>
                                   <textarea class="form-control" id="description" name="description"></textarea>
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

$('.chkbox').change(function(){
     $(".chkbox").prop('checked', false);
     $(this).prop('checked', true);
     val = $(this).val();
     $('.star').removeClass('rating-color');

     for(x=val; x>0; x--){
          $(`i[rate="${x}"]`).addClass('rating-color');
     }
});

</script>

@endsection