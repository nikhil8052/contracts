@extends('admin_layout.master')
@section('content')

<div class="nk-content">
     <div class="container-fluid">
          <form action="{{ url('/admin-dashboard/add-review') }}" method="post" enctype="multipart/form-data">
               @csrf
               <input type="hidden" name="id" value="{{ $review->id ?? '' }}">
               <div class="card card-bordered card-preview">
                    <div class="card-inner">
                         <div class="col-md-8">
                              <div class="form-group">
                                   <label class="form-label" for="document">Select Document</label>
                                   <select class="form-select" id="document" name="document" tabindex="-1" aria-hidden="true">
                                        <option value="" disabled selected>Select</option>
                                        @if(isset($documents) && $documents != null) 
                                        @foreach($documents as $doc)
                                             @if(isset($review->document_id) && $review->document_id != null)
                                                  @if($review->document_id == $doc->id)
                                                  <option value="{{ $doc->id ?? '' }}" selected>{{ $doc->title ?? '' }}</option>
                                                  @else
                                                  <option value="{{ $doc->id ?? '' }}">{{ $doc->title ?? '' }}</option>
                                                  @endif
                                             @else
                                             <option value="{{ $doc->id ?? '' }}">{{ $doc->title ?? '' }}</option>
                                             @endif
                                        @endforeach
                                        @endif
                                   </select>
                                   @error('document')
                                   <span class="text text-danger">{{ $message }}</span>
                                   @enderror
                              </div>
                         </div>
                         <br>
                         <div class="col-md-8">
                              <div class="form-group">
                                   <label class="form-label" for="regular_price">Document Rating</label>
                              </div>
                              <div id="full-stars-example-two">
                                   <div class="ratings">
                                   @if(isset($review->rating) && $review->rating != null)
                                   @for($i = 1; $i <= 5; $i++)
                                        <label for="rating{{ $i }}">
                                             <i rate="{{ $i }}" class="star fa fa-star {{ $review->rating >= $i ? 'rating-color' : '' }}"></i>
                                        </label>
                                        <input type="checkbox" name="rating" id="rating{{ $i }}" class="chkbox" style="display:none;" value="{{ $i }}" {{ $review->rating == $i ? 'checked' : '' }}>
                                   @endfor
                                   @else
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
                                   @endif
                                   </div>
                              </div>
                              @error('rating')
                                   <span class="text text-danger">{{ $message }}</span>
                              @enderror
                         </div>
                         <br>
                         <div class="col-md-8">
                              <div class="form-group">
                                   <label class="form-label" for="first_name">First Name</label>
                                   <input type="text" class="form-control" id="first_name" name="first_name" value="{{ $review->first_name ?? '' }}">
                                   @error('first_name')
                                        <span class="text text-danger">{{ $message }}</span>
                                   @enderror
                              </div>
                         </div>
                         <br>
                         <div class="col-md-8">
                              <div class="form-group">
                                   <label class="form-label" for="last_name">Last Name</label>
                                   <input type="text" class="form-control" id="last_name" name="last_name" value="{{ $review->last_name ?? '' }}">
                                   @error('last_name')
                                        <span class="text text-danger">{{ $message }}</span>
                                   @enderror
                              </div>
                         </div>
                         <br>
                         <div class="col-md-8">
                              <div class="form-group">
                                   <label class="form-label" for="city_name">City Name</label>
                                   <input type="text" class="form-control" id="city_name" name="city_name" value="{{ $review->city ?? '' }}">
                                   @error('city_name')
                                        <span class="text text-danger">{{ $message }}</span>
                                   @enderror
                              </div>
                         </div>
                         <br>
                         <div class="col-md-8">
                              <div class="form-group">
                                   <label class="form-label" for="date">Date</label>
                                   <input type="date" class="form-control" id="date" name="date" value="{{ $review->date ?? '' }}">
                                   @error('date')
                                        <span class="text text-danger">{{ $message }}</span>
                                   @enderror
                              </div>
                         </div>
                         <br>
                         <div class="col-md-8">
                              <div class="form-group">
                                   <label class="form-label" for="description">Document Review Description</label>
                                   <textarea class="form-control" id="description" name="description">{{ $review->description ?? '' }}</textarea>
                                   @error('description')
                                        <span class="text text-danger">{{ $message }}</span>
                                   @enderror
                              </div>
                         </div>
                    </div>
               </div>
               <div class="mt-3">
                    @if(isset($review) && $review != null)
                    <button class="btn btn-primary" type="submit">Edit</button>
                    @else
                    <button class="btn btn-primary" type="submit">Save</button>
                    @endif
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