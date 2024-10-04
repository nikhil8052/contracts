@extends('users_layout.other_master')
@section('content')

<section class="banner_sec dark inner-banner acerca" style="background-image: url({{ asset('storage/'.$contact->background_image ?? '' ) }});">
     <div class="container">
          <div class="row align-items-center">
               <div class="col-md-7">
               <div class="banner_content">
                    <h1>{{ $contact->banner_title ?? '' }}</h1>
                    <p>
                    {{ $contact->banner_description ?? '' }}
                    </p>
               </div>
               </div>
               <div class="col-md-5">
               <div class="banner_img">
                    <img src="{{ asset('storage/'.$contact->banner_image ?? '' ) }}" alt="">
               </div>
               </div>
          </div>
     </div>
</section>

<section class="contac_login_card p_120 light">
     <div class="container">
          <div class="wt_ot">
               <div class="inside_contac_box">
               <div class="h_contac_box">
                    <h3 class="ponte_h">{{ $contact->main_title ?? '' }}</h3>
               </div>
               <div class="contac_inp_fld">
                    <div class="inside_contac_fild">
                         <input class="mine_input" type="text" placeholder="Nombre">
                    </div>
                    <div class="inside_contac_fild">
                         <input class="mine_input" type="text" placeholder="Número de teléfono ">
                    </div>
                    <div class="inside_contac_fild">
                         <input class="mine_input" type="text" placeholder="Correo electrónico">
                    </div>
                    <div class="inside_contac_fild">
                         <textarea class="mine_input" name="" cols="0" rows="6" placeholder="Mensaje"></textarea>
                    </div>

                    <div class="inside_contac_fild">
                         <div class="drag_h_contac">
                              <h6 class="drg_hd">
                                   Agregar archivo :
                              </h6>
                         </div>


                         <div class="drag_drop_box">
                              <div class="upload-box mine_input">
                                   <input type="file" id="fileInput" hidden />
                                   <label for="fileInput">
                                   <img src="img/drag_dp.svg" alt="">
                                   <p>Arrastra una imagen aquí o <span>sube un archivo</span></p>
                                   </label>
                              </div>
                         </div>
                    </div>

                    <div class="inside_contac_fild">
                         <div class="captcha_ot_box">

                              <div class="box-container">
                                   <input type="checkbox">
                                   <p class="robot">I'm not a robot</p>
                                   <div>
                                   <div class="container">
                                        <div class="logo">
                                        <svg width="31" height="30" viewBox="0 0 31 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M30.0906 14.9789C30.0899 14.7631 30.0849 14.5485 30.0753 14.335V2.15984L26.7093 5.52576C23.9545 2.15375 19.7637 0 15.0697 0C10.1847 0 5.84492 2.33169 3.10156 5.94269L8.61873 11.5179C9.15941 10.5179 9.92751 9.65906 10.8536 9.01039C11.8168 8.25873 13.1816 7.64415 15.0695 7.64415C15.2976 7.64415 15.4736 7.6708 15.603 7.72101C17.9421 7.90563 19.9696 9.19653 21.1635 11.0702L17.2581 14.9755C22.2047 14.9561 27.7928 14.9447 30.0902 14.978" fill="#1C3AA9"/>
                                        <path d="M14.9789 0.000610352C14.7631 0.00131601 14.5485 0.00633868 14.335 0.0159818H2.15983L5.52576 3.38191C2.15375 6.13673 0 10.3275 0 15.0216C0 19.9065 2.33173 24.2463 5.94269 26.9897L11.5179 21.4725C10.5179 20.9318 9.65906 20.1637 9.01039 19.2376C8.25877 18.2744 7.64415 16.9096 7.64415 15.0217C7.64415 14.7937 7.6708 14.6176 7.72101 14.4883C7.90563 12.1492 9.19653 10.1216 11.0702 8.92779L14.9755 12.8331C14.9561 7.88654 14.9447 2.29845 14.978 0.00103747" fill="#4285F4"/>
                                        <path d="M0 15.0211C0.00072284 15.2369 0.00569389 15.4514 0.0153656 15.665V27.8402L3.38129 24.4742C6.13611 27.8462 10.3269 30 15.021 30C19.9059 30 24.2457 27.6683 26.9891 24.0573L21.4719 18.4821C20.9312 19.4821 20.1631 20.3409 19.237 20.9896C18.2738 21.7413 16.909 22.3558 15.0211 22.3558C14.7931 22.3558 14.617 22.3292 14.4877 22.279C12.1486 22.0944 10.121 20.8035 8.92718 18.9298L12.8325 15.0245C7.88593 15.0439 2.29784 15.0553 0.000429605 15.022" fill="#ABABAB"/>
                                        </svg>
                                             <div class="logo-text">
                                             <p>reCAPTCHA</p>            
                                             </div>            
                                        </div>
                                        <p class="logo-text-tos">Privacy - Terms</p>
                                   </div>
                                   </div>    
                              </div>
                         </div>

                    </div>
                    <div class="outer_aft_btn">
                         <a href="" class="cta_org" tabindex="0">Enviar</a>
                    </div>
               </div>
               </div>
          </div>
     </div>

</section>



<script>
     $(document).ready(function(){
          $('.submit-btn').click(function(e){
               e.preventDefault();

               var name = $("input[name='name']").val();
               var phone = $("input[name='phone_number']").val();
               var email = $("input[name='email']").val();
               var message = $("input[name='message']").val();
               var file = $("input[name='file']").val();
               var isvalid = true;

               if(name === '' || name === undefined || name === null && phone === '' || phone === undefined || phone === null && email === '' || email === undefined || email === null){
                   
                    const $scroll = $('.for-contant');

                    if ($scroll.length) {
                         $('html,body').animate({
                              scrollTop: $scroll.offset().top
                         }, 200);
                    }

                    $('.error').show();
                    isvalid = false;

               }

               if(isvalid){
                    $('.error').hide();
                    $('#contact-form').submit();
               }

          })
     })

</script>

@endsection