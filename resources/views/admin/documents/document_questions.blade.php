<style>
     .dropbtn{
          background-color: #3498DB;
          color: white;
          padding: 16px;
          font-size: 16px;
          border: none;
          cursor: pointer;
     }

     .dropbtn:hover, .dropbtn:focus{
          background-color: #FD5602;
     }

     .dropdown{
          position: relative;
          display: inline-block;
     }

     .dropdown-content{
          display: none;
          position: absolute;
          background-color: #f1f1f1;
          min-width: 160px;
          overflow: auto;
          box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
          z-index: 1;
     }

     .dropdown-content a{
          color: black;
          padding: 8px 16px;
          text-decoration: none;
          display: block;
          background-color: #fff;
          align-items: center;
     }

     .dropdown a:hover{
          background-color: #DDF4F4;
     }

     .show{
          display: block;
     }
</style>

@extends('admin_layout.master')
@section('content')

<div class="nk-content">
     <div class="container-fluid">
          <form action="" id="documentForm" method="post" enctype="multipart/form-data">
          @csrf
          <div class="row main_section">
               <div class="col md-8 left-content">
                    <div class="col-md-12 doc-title mt-4 pb-4">
                         <div class="form-group">
                              <label class="form-label" for="title"><b><h4>Add New Question</h4></b></label>
                              <input type="text" class="form-control form-control-lg" id="title" name="title" placeholder="Add title" value="">
                         </div>
                    </div>
                    <h5>Contract Questions</h5>
                    <hr>
                    <h6>Steps</h6>
                    <hr>
                    <div class="col-md-12">
                         <div class="form-group">
                              <label class="form-label" for="step">Step *</label>
                              <input type="text" class="form-control" id="step" name="step">
                         </div>
                    </div>
                    <hr>
                    <div class="col-md-12">
                         <div class="form-group">
                              <label class="form-label" for="">Add Questions</label>
                         </div>
                    </div>
                    <br>
                    <div class="text-end">
                         <button type="button" class="btn btn-sm btn-primary dropbtn" id="add_question" onclick="myFunction()">Add Question</button>
                         <div class="form-group dropdown"> 
                              <div id="myDropdown" class="dropdown-content">
                                   <a>Textbox</a>
                                   <a>Textarea</a>
                              </div>
                         </div>
                    </div>
                    <hr>
                    <div class="col-md-12">
                         <div class="form-group">
                              <label class="form-label" for="">Form submit handler for generating pdf</label>
                         </div>
                    </div>
                    <div class="custom-control custom-checkbox checked">
                         <input type="checkbox" class="custom-control-input" id="last_step" name="last_step">
                         <label class="custom-control-label" for="last_step">Please check this box if you are on last step</label>
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
     function myFunction() {
          document.getElementById("myDropdown").classList.toggle("show");
     }

     window.onclick = function(event){
          if (!event.target.matches('.dropbtn')) {
               var dropdowns = document.getElementsByClassName("dropdown-content");
               var i;
               for (i = 0; i < dropdowns.length; i++) {
                    var openDropdown = dropdowns[i];
                    if (openDropdown.classList.contains('show')) {
                         openDropdown.classList.remove('show');
                    }
               }
          }
      }
</script>

@endsection