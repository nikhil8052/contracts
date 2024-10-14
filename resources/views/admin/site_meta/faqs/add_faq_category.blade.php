@extends('admin_layout.master')
@section('content')

<div class="nk-content">
     <div class="container-fluid">
          <form action="{{ url('admin-dashboard/add/procc') }}" method="post" enctype="multipart/form-data">
               @csrf
               <div class="nk-block-head">
                    <div class="nk-block-head-content">
                         <h4 class="nk-block-title">@if(isset($faqCategory) && $faqCategory != null) Edit Category  @else Add Category @endif</h4>
                    </div>
               </div>
               <input type="hidden" name="id" value="{{ $faqCategory->id ?? '' }}">
               <div class="card card-bordered card-preview">
                    <div class="card-inner">
                         <div class="col-md-12 pb-2">
                              <div class="form-group">
                                   <label class="form-label" for="name">Category Name</label>
                                   <input type="text" class="form-control" id="name" name="name" placeholder="Add Category Name" value="{{ $faqCategory->category_name ?? '' }}">
                              </div>
                         </div>
                         <div class="card card-bordered card-preview mt-2">
                              <div class="card-inner">
                                   <div class="row g-3">
                                        <div class="col-lg-2">
                                             <div class="form-group">
                                                  <label class="form-label" for="slug">Slug</label>
                                             </div>
                                        </div>
                                        <div class="col-lg-10">
                                             <div class="form-group">
                                                  <input type="text" class="form-control" id="slug" name="slug" value="{{ $faqCategory->slug ?? '' }}">
                                             </div>
                                        </div>
                                   </div>
                                   <div class="row g-3 mt-2">
                                        <div class="col-lg-2">
                                             <div class="form-group">
                                                  <label class="form-label" for="description">Description</label>
                                             </div>
                                        </div>
                                        <div class="col-lg-10">
                                             <div class="form-group">
                                                  <textarea class="form-control" id="description" name="description">{{ $faqCategory->description ?? '' }}</textarea>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>
               <div class="mt-3">
               @if(isset($faqCategory) && $faqCategory != null)
                    <button class="btn btn-primary" type="submit">Update</button>
               @else
                    <button class="btn btn-primary" type="submit">Save</button>
               @endif
               </div>
          </form>
     </div>
</div>

<script>

     $('#name').on('keyup',function(){
          const name = $(this).val();
          const url = name.toLowerCase().replace(/ /g,'-').replace(/[^\w-]+/g, '');
          $('#slug').val(url);
     })
</script>

@endsection