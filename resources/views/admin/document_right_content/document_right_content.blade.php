@extends('admin_layout.master')
@section('content')

<div class="nk-content">
     <div class="container-fluid">
          <form action="" method="post" enctype="multipart/form-data">
          @csrf
          <div class="row main_section">
               <div class="col md-8 left-content">
                    <div class="col-md-12 doc-title mt-4 pb-4">
                         <div class="form-group">
                              <label class="form-label" for="title"><b><h4>Add New Right Content</h4></b></label>
                              <input type="text" class="form-control form-control-lg" id="title" name="title" placeholder="Add title" value="">
                         </div>
                    </div>
                    <h5>Contract Right Content</h5>
                    <hr>
                    <h6>Contract Right Content</h6>
                    <div class="add_content"></div>
                    <br>
                    <div class="text-end">
                         <button type="button" class="btn btn-sm btn-primary question_dropbtn" onclick="toggleDropdown()">Add Content</button>
                         <div class="form-group question_dropdown"> 
                              <div id="" class="question_dropdown-content">
                                   <a class="content_heading">Content Heading</a>
                                   <a class="content">Content</a>
                              </div>
                         </div>
                    </div>
               </div>
               <div class="col md-4 right-content">
                    <div class="card card-bordered card-preview">
                         <div class="card-inner">
                              <div class="col-md-12">
                                   <div class="form-group">
                                        <p>Published</p>
                                        <div class="custom-control custom-switch">
                                             <input type="checkbox" class="custom-control-input publish" id="publish1">
                                             <label class="custom-control-label" for="publish1"></label>
                                        </div>
                                   </div>
                              </div>
                              <div class="col-md-12 mt-2">
                                   <div class="form-group">
                                        <label class="form-label" for="document_id">Select Document</label>  
                                        <div class="form-control-wrap"> 
                                             <select class="form-select js-select2" name="document_id" id="document_id">
                                                  <option value=""></option>
                                                  @if(isset($documents) && $documents != null)
                                                  @foreach($documents as $document)
                                                       <option value="{{ $document->id ?? '' }}">{{ $document->title ?? '' }}</option>
                                                  @endforeach
                                                  @endif
                                             </select>
                                        </div>
                                   </div>
                              </div>
                              <div class="d-flex justify-content-end mt-2">
                                   <div class="nk-block-head-content">
                                        <div class="up-btn mbsc-form-group">
                                             <button class="btn btn-sm btn-primary" type="submit">Save</button>
                                        </div>
                                   </div>
                              </div> 
                         </div> 
                    </div>
               </div>
          </div>
     </div>
</div>

<script>
     function toggleDropdown() {
          $('.question_dropdown-content').toggle();
     }

     window.onclick = function(event) {
          if(!event.target.matches('.question_dropbtn')) {
               const dropdowns = document.getElementsByClassName("question_dropdown-content");
               for(let i=0; i<dropdowns.length; i++){
                    const openDropdown = dropdowns[i];
                    if(openDropdown.classList.contains('show')){
                         openDropdown.classList.remove('show');
                    }
               }
          }
     }

</script>
@endsection