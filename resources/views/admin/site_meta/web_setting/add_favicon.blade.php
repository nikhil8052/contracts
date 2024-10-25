@extends('admin_layout.master')
@section('content')

<div class="nk-content">
     <div class="container-fluid">
          <form action="" method="post" enctype="multipart/form-data">
               <div class="card card-bordered card-preview">
                    <div class="card-inner">
                         <div class="col-md-12">
                              <div class="form-group">
                                   <label class="form-label" for="favicon">Favicon</label>
                                   <input type="file" class="form-control" id="favicon" name="favicon">
                              </div>
                             
                              <div class="fav_image_div">
                                   <div class="form-group">
                                        <img src="" height="140px" width="170px">
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

@endsection