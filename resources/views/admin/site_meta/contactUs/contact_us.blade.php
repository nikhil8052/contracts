@extends('admin_layout.master')
@section('content')

<div class="nk-content">
     <div class="container-fluid">
          <form action="{{ url('/admin-dashboard/contact-us-procc') }}" method="post" enctype="multipart/form-data">
               @csrf
               <input type="hidden" name="id" value="{{ $contact->id ?? '' }}">
               <div class="card card-bordered card-preview">
                    <div class="card-inner">
                         <div class="d-flex justify-content-end p-2">
                              <div class="nk-block-head-content">
                                   <div class="mbsc-form-group">
                                        <a href="{{ url('/contact-us') }}" target="_blank" class="btn btn-default">View Page</a>
                                   </div>
                              </div>
                         </div>
                         <div class="col-md-8 pb-2">
                              <div class="form-group">
                                   <label class="form-label" for="title"><b><h4>Page Title</b></h4></label>
                                   <input type="text" class="form-control form-control-lg" id="title" name="title" value="{{ $contact->title ?? '' }}">
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
                                   <img src="{{ asset('storage/'.$contact->background_image ?? '' ) }}" height="140px" width="160px">
                              </div>
                         </div>
                         <div class="col-md-8">
                              <div class="form-group">
                                   <label class="form-label" for="banner_title">Banner Title</label>
                                   <input type="text" class="form-control" id="banner_title" name="banner_title" value="{{ $contact->banner_title ?? '' }}">
                              </div>
                         </div>
                         <div class="col-md-8">
                              <div class="form-group">
                                   <label class="form-label" for="banner_description">Banner Description</label>
                                   <textarea class="form-control" id="banner_description" name="banner_description">{{ $contact->banner_description ?? '' }}</textarea>
                              </div>
                         </div>
                         <div class="col-md-8">
                              <div class="form-group">
                                   <label class="form-label" for="banner_image">Banner Image</label>
                                   <input type="file" class="form-control" id="banner_image" name="banner_image" value="">
                              </div>
                              <div class="form-group">
                                   <img src="{{ asset('storage/'.$contact->banner_image ?? '' ) }}" height="200px" width="280px">
                              </div>
                         </div>
                         <hr>
                         <h5>Contact Page</h5>  
                         <hr>
                         <h6>Contact Section</h6>
                         <div class="card card-bordered card-preview">
                              <div class="card-inner">
                                   <div class="col-md-8">
                                        <div class="form-group">
                                             <label class="form-label" for="main_title">Main Title</label>
                                             <input type="text" class="form-control" id="main_title" name="main_title" value="{{ $contact->main_title ?? '' }}">
                                        </div>
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

</script>


@endsection