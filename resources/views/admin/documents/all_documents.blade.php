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
                                        <h4 class="nk-block-title">Documents</h4>
                                   </div>
                                   <div class="d-flex justify-content-end p-2">
                                        <div class="nk-block-head-content">
                                             <div class="mbsc-form-group">
                                                  <a href="{{ url('/admin-dashboard/documents') }}" class="btn btn-light">Add Document</a>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                              <div class="card card-bordered card-preview">
                                   <div class="card-inner">
                                        <table class="table" id="catg_table">
                                             <thead>
                                                  <tr>
                                                       <th scope="col">#</th>
                                                       <th scope="col">Title</th>
                                                       <th scope="col">Document Categories</th>
                                                  </tr>
                                             </thead>
                                             <tbody>
                                             @if(isset($documents) && $documents->isNotEmpty())
                                                  <?php 
                                                       $count = 1;
                                                  ?>
                                                  @foreach($documents as $data)
                                                  <tr>
                                                       <th scope="row">{{ $count ?? '' }}</th>
                                                       <td><a href="{{ url('admin-dashboard/edit-document/'.$data->slug) }}">{{ $data->title ?? '' }}</a></td>
                                                       <td>
                                                       @if(isset($data->category_id) && $data->category_id != null)
                                                            <?php 
                                                                 $category = json_decode($data->category_id); 
                                                                 foreach($category as $cat){
                                                                      $documentCategory = App\Models\DocumentCategory::find($cat);
                                                                      print_r($documentCategory->name);
                                                                      echo ',';
                                                                 }
                                                            ?>
                                                       @endif
                                                       </td>
                                                  </tr>
                                                  <?php $count++; ?>
                                                  @endforeach
                                             @endif
                                             </tbody>
                                        </table>
                                   </div>
                              </div><!-- .card-preview -->
                         </div><!-- .nk-block -->
                    </div><!-- .components-preview -->
               </div>
          </div>
     </div>
</div>

@endsection