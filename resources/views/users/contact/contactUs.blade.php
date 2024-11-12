@extends('users_layout.master')
@section('content')
<style>
.textarea-wrapper{
  position: relative;
  /* width: fit-content; */
}

#contact_image {
  position: absolute;
  top: 50%;
  right: 10px;  /* Adjust position as needed */
  transform: translateY(-50%);
  width:40px;
  /* Remove pointer-events: none; to make the image clickable */
}

</style>
<?php 
     $path = str_replace('public/', '', $contact->background_image_path ?? null);
?>
<section class="banner_sec dark inner-banner acerca" style="background-image: url({{ asset('storage/'.$path) }});">
     <div class="container banner-col-width">
          <div class="row align-items-center contact-us-banner-row">
               <div class="col-md-6 banner-col">
                    <div class="banner_content">
                         <h1>{{ $contact->banner_title ?? '' }}</h1>
                         <p>
                         {{ $contact->banner_description ?? '' }}
                         </p>
                    </div>
               </div>
               <div class="col-md-6 banner-col">
                    <div class="banner_img">
                    <?php 
                         $banner_path = str_replace('public/', '', $contact->banner_image_path ?? null);
                    ?>
                         <img src="{{ asset('storage/'.$banner_path) }}" alt="">
                    </div>
               </div>
          </div>
     </div>
</section>

<section class="contac_login_card p_120 light">
     <div class="container">
          <div class="wt_ot">
               <div class="inside_contac_box">
                    <div class="h_contac_box" id="top">
                         <h3 class="ponte_h">{{ $contact->main_title ?? '' }}</h3>
                    </div>
                    <form action="{{ url('/contactusProcc') }}" id="contact-form" method="post" enctype="multipart/form-data">
                         @csrf
                         <div class="contac_inp_fld">
                              <div class="inside_contac_fild">
                                   <input type="text" class="mine_input" name="name" placeholder="Nombre">
                                   @if($errors->has('name'))
                                   <span class="text-danger">{{ $errors->first('name') }}</span>
                                   @endif
                              </div>
                              <div class="inside_contac_fild">
                                   <input type="text"  class="mine_input" name="phone_number" placeholder="Número de teléfono ">
                                   @if($errors->has('phone_number'))
                                   <span class="text-danger">{{ $errors->first('phone_number') }}</span>
                                   @endif
                              </div>
                              <div class="inside_contac_fild">
                                   <input type="text" class="mine_input" name="email" placeholder="Correo electrónico">
                                   @if($errors->has('email'))
                                   <span class="text-danger">{{ $errors->first('email') }}</span>
                                   @endif
                              </div>
                              <!-- <div class="inside_contac_fild textarea-wrapper">
                                   <textarea class="mine_input" name="message" cols="0" rows="6" placeholder="Mensaje"></textarea>
                                   <img id="contact_image" src="{{ asset('assets/img/upload_img.svg') }}" alt="">
                                   @if($errors->has('message'))
                                   <span class="text-danger">{{ $errors->first('message') }}</span>
                                   @endif
                              </div> -->
          
                              <div class="inside_contac_fild textarea-wrapper">
                                   <textarea class="mine_input" name="message" cols="0" rows="6" placeholder="Mensaje"></textarea>
                                   <div class="image-wrapper">
                                        <img id="contact_image" src="{{ asset('assets/img/upload_img.svg') }}" alt="Upload Icon">
                                   </div>
                                   
                                   @if($errors->has('message'))
                                   <span class="text-danger">{{ $errors->first('message') }}</span>
                                   @endif
                              </div>
                              <input type="file" id="fileInput" class="form-control-file upload_input_file" name="fileInput" style="display:none;">
                              @if($errors->has('fileInput'))
                                   <span class="text-danger">{{ $errors->first('fileInput') }}</span>
                              @endif

                              <!-- <div class="inside_contac_fild">
                                   <div class="drag_h_contac">
                                        <h6 class="drg_hd">
                                             Agregar archivo :
                                        </h6>
                                   </div>
                                   <div class="drag_drop_box">
                                        <div class="upload-box mine_input">
                                             <input type="file" name="file" id="fileInput" hidden />
                                             <label for="fileInput">
                                                  <img src="{{ asset('assets/img/drag_dp.svg') }}" alt="">
                                                  <p>Arrastra una imagen aquí o <span>sube un archivo</span></p>
                                             </label>
                                        </div>
                                        <div class="upload-box mine_input">
                                             <div class="file_input_para">
                                                  <input type="file" id="fileInput" class="form-control-file upload_input_file" name="fileInput" style="display:none;">
                                                  <p>Arrastra una imagen aquí o <span>sube un archivo</span></p>
                                             </div>
                                             <div class="file_img_icon">
                                                  <label for="fileInput11">
                                                       <img id="contact_image" src="{{ asset('assets/img/upload_img.svg') }}" alt="">
                                                  </label>
                                             </div>
                                        </div>
                                   </div>
                                   @if($errors->has('file'))
                                   <span class="text-danger">{{ $errors->first('file') }}</span>
                                   @endif
                              </div> -->

                              <div class="g-recaptcha" data-sitekey="{{ env('RECAPTCHA_SITE_KEY') }}"></div>
                              @if($errors->has('g-recaptcha-response'))
                              <span class="text-danger">{{ $errors->first('g-recaptcha-response') }}</span>
                              @endif
                              <div class="outer_aft_btn">
                                   <button class="cta_org submit-btn" type="submit" tabindex="0">Enviar</button>
                              </div>
                         </div>
                    </form>
               </div>
          </div>
     </div>

</section>

<script src="https://www.google.com/recaptcha/api.js" async defer></script>

<script>
     $(document).ready(function(){
          $('#contact_image').on('click',function(){
               console.log('Image clicked'); // Log message to console
               $('#fileInput').trigger('click');
          });
     });
</script>

@endsection