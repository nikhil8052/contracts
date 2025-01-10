@extends('admin_layout.master')
@section('content')

<div class="nk-content">
     <div class="container-fluid">
          <form action="{{ url('/admin-dashboard/add/general-section') }}" method="post" enctype="multipart/form-data">
               @csrf
               <div class="col-md-12 pb-4">
                    <h3>General Section</h3>
               </div>
               <div class="row">
                    <div class="col-md-8">
                         <div class="card card-bordered card-preview">
                              <div class="card-inner">
                                   <h5>Agreement Steps</h5>    
                                   <hr> 
                                   @if(isset($agreements) && $agreements != null)
                                   @foreach($agreements as $agrmnt)
                                   <?php 
                                   $path = str_replace('public/', '', $agrmnt->media->file_path ?? null); ?>
                                   <div class="faq-append-sec{{ $agrmnt->id ?? '' }}">
                                        <div class="row gy-12">
                                             <div class="col-md-2">
                                                  <div class="form-group">
                                                       <button class="btn-sm update_agreement_img" type="button" data-id="{{ $agrmnt->id ?? '' }}">Add New</button>
                                                       <input type="file" name="agreement_up_img" class="update_img" data-id="{{ $agrmnt->id ?? '' }}" id="agreement_up_img{{ $agrmnt->id ?? '' }}" style="display:none;">
                                                  </div>
                                                  <div class="img_div" id="img_div{{ $agrmnt->id ?? '' }}">
                                                       <div class="form-group">
                                                            <img src="{{ asset('storage/'.$path ?? '' ) }}" alt="{{ asset('storage/'.$path ?? '' ) }}">
                                                       </div>
                                                  </div>
                                             </div>
                                             <div class="col-md-5">
                                                  <div class="form-group">
                                                       <label class="form-label" for="new_agreement_heading">Heading</label>
                                                       <input type="text" class="form-control" id="new_agreement_heading" name="new_agreement_heading[{{ $agrmnt->id ?? '' }}]" value="{{ $agrmnt->heading ?? '' }}">
                                                  </div>
                                             </div>
                                             <div class="col-md-5">
                                                  <div class="form-group">
                                                       <label class="form-label" for="new_agreement_description">Description</label>
                                                       <textarea class="form-control" id="new_agreement_description" name="new_agreement_description[{{ $agrmnt->id ?? '' }}]">{{ $agrmnt->description ?? '' }}</textarea>
                                                  </div>
                                             </div>
                                        </div>
                                   </div>
                                   @endforeach
                                   @else
                                   @php $num=4; @endphp
                                   @for($i=1; $i<=$num; $i++)
                                   <div class="faq-append-sec{{ $i ?? '' }}">
                                        <div class="row gy-12">
                                             <div class="col-md-2">
                                                  <div class="form-group">
                                                       <label class="form-label" for="agreement_image">Image</label>
                                                       <input type="file" class="form-control" name="agreement_image[]">
                                                  </div>
                                             </div>
                                             <div class="col-md-5">
                                                  <div class="form-group">
                                                       <label class="form-label" for="agreement_heading">Heading</label>
                                                       <input type="text" class="form-control" id="agreement_heading" name="agreement_heading[]" value="">
                                                  </div>
                                             </div>
                                             <div class="col-md-5">
                                                  <div class="form-group">
                                                       <label class="form-label" for="agreement_description">Description</label>
                                                       <textarea class="form-control" id="agreement_description" name="agreement_description[]"></textarea>
                                                  </div>
                                             </div>
                                        </div>
                                   </div>
                                   @endfor
                                   @endif
                                   <hr>
                                   <h5 class="mt-2">Guide Section</h5>
                                   <hr>
                                   <div class="col-md-12 mt-2">
                                        <div class="form-group">
                                             <label class="form-label" for="guide_heading">Guide Section Main Heading</label>
                                             <input type="text" class="form-control form-control" id="guide_heading" name="guide_heading" value="{{ $data['guide_heading'] ?? '' }}">
                                        </div>
                                   </div>
                                   <br>
                                   <div class="col-md-12 mt-2">
                                        <h6>Guide Section Steps</h6>
                                   </div>
                                   @if(isset($guides) && $guides != null)
                                        @foreach($guides as $guide)
                                             <div class="guide-append-sec{{ $guide->id ?? '' }}">
                                                  <hr>
                                                  <div class="row gy-12">
                                                       <div class="col-md-6">
                                                            <div class="form-group">
                                                                 <label class="form-label" for="new_step_title">Step Title</label>
                                                                 <input type="text" class="form-control form-control" id="new_step_title" name="new_step_title[{{ $guide->id ?? '' }}]" value="{{ $guide->heading ?? '' }}">
                                                            </div>
                                                       </div>
                                                       <div class="col-md-6">
                                                            <div class="form-group">
                                                                 <label class="form-label" for="new_step_description">Step Description</label>
                                                                 <textarea class="form-control" id="new_step_description" name="new_step_description[{{ $guide->id ?? '' }}]">{{ $guide->description ?? '' }}</textarea>
                                                            </div>
                                                       </div>
                                                  </div>
                                             </div>
                                        @endforeach
                                        @else
                                        @php $count=2; @endphp
                                        @for($i=1; $i<=$count; $i++)
                                        <div class="guide-append-sec{{ $i ?? '' }}">
                                             <hr>
                                             <div class="row gy-12">
                                                  <div class="col-md-6">
                                                       <div class="form-group">
                                                            <label class="form-label" for="step_title">Step Title</label>
                                                            <input type="text" class="form-control form-control" id="step_title" name="step_title[]" value="">
                                                       </div>
                                                  </div>
                                                  <div class="col-md-6">
                                                       <div class="form-group">
                                                            <label class="form-label" for="step_description">Step Description</label>
                                                            <textarea class="form-control" id="step_description" name="step_description[]"></textarea>
                                                       </div>
                                                  </div>
                                             </div>
                                        </div>
                                        @endfor
                                   @endif
                                   <hr>
                                   <div class="col-md-12 mt-2">
                                        <div class="form-group">
                                             <label class="form-label" for="guide_button">Guide Button</label>
                                             <input type="text" class="form-control form-control" id="guide_button" name="guide_button" value="{{ $data['guide_button'] ?? '' }}">
                                        </div>
                                   </div>
                                   <hr>
                                   <div class="col-md-12 mt-2">
                                        <div class="form-group">
                                             <label class="form-label" for="valid_in">Valid in</label>
                                             <input type="text" class="form-control form-control" id="valid_in" name="valid_in" value="{{ $data['valid_in'] ?? '' }}">
                                        </div>
                                   </div>
                                   <hr>
                                   <h6 class="mt-4">Related Document Section</h6>
                                   <hr>
                                   <div class="col-md-12 mt-2">
                                        <div class="form-group">
                                             <label class="form-label" for="related_heading">Related Document Heading</label>
                                             <input type="text" class="form-control" id="related_heading" name="related_heading" value="{{ $data['related_heading'] ?? '' }}">
                                             @error('related_heading')
                                                  <span class="text-danger">{{ $message }}</span>
                                             @enderror
                                        </div>
                                   </div>
                                   <div class="col-md-12 mt-2">
                                        <div class="form-group">
                                             <label class="form-label" for="related_description">Related Document Short Description</label>
                                             <textarea class="form-control" id="related_description" name="related_description">{{ $data['related_description'] ?? '' }}</textarea>
                                             @error('related_description')
                                                  <span class="text-danger">{{ $message }}</span>
                                             @enderror
                                        </div>
                                   </div>
                                   <hr>
                                   <h6 class="mt-4">Contract Left heading</h6>
                                   <hr>
                                   <div class="col-md-12 mt-2">
                                        <div class="form-group">
                                             <label class="form-label" for="contract_heading">Heading</label>
                                             <input type="text" class="form-control" id="contract_heading" name="contract_heading" value="{{ $data['contract_heading'] ?? '' }}">
                                             @error('contract_heading')
                                                  <span class="text-danger">{{ $message }}</span>
                                             @enderror
                                        </div>
                                   </div>
                              </div>
                         </div>
                    </div>
                    <div class="col-md-4">
                         <div class="card card-bordered card-preview">
                              <div class="card-inner">
                                   <div class="d-flex justify-content-end">
                                        <div class="nk-block-head-content">
                                             <div class="up-btn mbsc-form-group">
                                                  <button class="btn btn-sm btn-primary" type="submit">Update</button>
                                             </div>
                                        </div>
                                   </div> 
                              </div>
                         </div>
                    </div>
               </div>
          </form>
     </div>
</div>

<script>
     // Update Agreement Image //
     $('.update_agreement_img').click(function(){
          var id = $(this).data('id');
          $('#agreement_up_img' + id).trigger('click');
     });

     $('.update_img').change(function() {
          var id = $(this).data('id');
          var file = this.files[0]; 
          var formData = new FormData(); 
          formData.append('image', file);
          formData.append('_token', "{{ csrf_token() }}");
          formData.append('id', id);

          $.ajax({
               url: "{{ url('/update/agreement/image') }}", 
               type: 'POST',
               data: formData,
               processData: false,  
               contentType: false, 
               dataType: "json",
               success: function(response){
                    console.log(response);
                    NioApp.Toast('New image is updated', 'info', {position: 'top-right'});
                    setTimeout(() => {
                         location.reload();
                    },1000);
               },
               error: function(response) {
                    console.log(response.responseText); 
                    alert('Error uploading image');
               }
          });
     });
</script>

@endsection