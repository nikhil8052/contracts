@extends('admin_layout.master')
@section('content')

<div class="nk-content">
     <div class="container-fluid">
          <div class="nk-content-inner">
               <div class="nk-content-body">
                    <div class="components-preview wide-md mx-auto">
                         <div class="nk-block nk-block-lg">
                              <div class="nk-block-head">
                                   <div class="nk-block-head-content">
                                        <h4 class="nk-block-title">FAQ Categories</h4>
                                   </div>
                                   <div class="d-flex justify-content-end p-2">
                                        <div class="nk-block-head-content">
                                             <div class="mbsc-form-group">
                                                  <a href="{{ url('/admin-dashboard/add/faq-category') }}" class="btn btn-light">Add Category</a>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                              <div class="card card-bordered card-preview">
                                   <div class="card-inner">
                                        <table class="table">
                                             <thead>
                                                  <tr>
                                                       <th scope="col">#</th>
                                                       <th scope="col">Name</th>
                                                       <th scope="col">Description</th>
                                                       <th scope="col">Slug</th>
                                                  </tr>
                                             </thead>
                                             <tbody>
                                             @if($faqCategory)
                                             <?php $count = 1; ?>
                                             @foreach($faqCategory as $category)
                                             <tr>
                                                  <td>{{ $count++ }}</td>
                                                  <td><a href="{{ url('/admin-dashboard/edit/faq-category/'.$category->slug ?? '' ) }}">{{ $category->category_name ?? '' }}</td>
                                                  <td>{{ $category->description ?? '----' }}</td>
                                                  <td>{{ $category->slug ?? '' }}</td>
                                             </tr>
                                             @endforeach
                                             </tbody>
                                             @endif
                                        </table>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
     </div>
</div>

@endsection