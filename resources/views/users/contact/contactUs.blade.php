@extends('users_layout.master')
@section('content')

<div class="mobile_header_side_bar">
	<div class="header_sidebar_inner">
		<div class="sidebar_empty_space"></div>
		<div class="sidebar_header_content">
			<div class="sidebar_header_nav">
				<div class="header_search_form">
					<form id="header_search_form" method="POST" action="https://documentos-legales.mx/contratos-documentos-legales/" autocomplete="off">
						<input type="text" class="form-control" name="search" placeholder="Buscar" />
						<button class="mobilesearch-btn" type="submit">
							<i class="fa-solid fa-magnifying-glass"></i>
						</button>
					</form>
				</div>
				<ul class="_Ty8L2" data-qa="SidebarMenuList">
					<li><a href="">Arrendamiento</a></li>
					<li><a href="">Comercio</a></li>
					<li><a href="">Consumo</a></li>
					<li><a href="">Familia</a></li>
					<li><a href="">Internet</a></li>
					<li><a href="">Laboral</a></li>
					<li><a href="">Vida diaria</a></li>
				</ul>

				<ul class="_Ty8L3" data-qa="SidebarMenuList">
					<li><a href="">Así funciona</a></li>
					<li><a href="">Preguntas</a></li>
				</ul>

				<div class="mobile_header_buuton">
					<a class="cta" href="">Crear documento</a>
				</div>
			</div>
		</div>
	</div>
	<div role="button" class="_GtzsW _Gv2_B">
		<div class="_NRBhu"></div>
	</div>
	<div class="__z_48"></div>
</div>
<div class="mobile_header_side_bar_right">
     <div class="header_sidebar_inner">
          <div class="sidebar_empty_space"></div>
          <div class="sidebar_header_content">
               <div class="sidebar_header_nav">
                    <div class="header_right_sidebar_content">
                         <div>							
                              <p class="lgout">¡Bienvenido!</p>
                              <p>Libera todas las opciones con una cuenta gratuita.</p>
                              <div class="mobile_right_header_button">
                                   <a href="" class="cta register">Crear cuenta</a>
                                   <a href="" class="cta login">Iniciar sesión</a>
                              </div>
                         </div>	
                    </div>
               </div>
          </div>
     </div>
     <div role="button" class="_GtzsW _Gv2_B _zNNE6">
          <div class="_NRBhu"></div>
     </div>
     <div class="__z_48"></div>
</div>
	
<div class="wn_hght">
     <section class="contact-sec p-130">
          <div class="container">
               <div class="wapper-text">
                    <div class="below-text">
                         <h1>{{ $contact->main_title ?? '' }}</h1>
                         <p>{{ $contact->main_description ?? '' }}</p>
                    </div>    
                    <div class="for-contant">
                         <div class="wpcf7 js" id="wpcf7-f148-o1" lang="en-US" dir="ltr">
                              <div class="screen-reader-response">
                                   <p role="status" aria-live="polite" aria-atomic="true"></p>
                                   <ul></ul>
                              </div>
                              <form action="{{ url('/contactusProcc') }}" id="contact-form" method="post" class="wpcf7-form init" aria-label="Contact form" enctype="multipart/form-data" novalidate="novalidate" data-status="init">
                                   @csrf
                                   <div style="display: none;">
                                        <!-- <input type="hidden" name="_wpcf7" value="148">
                                        <input type="hidden" name="_wpcf7_version" value="5.9.8">
                                        <input type="hidden" name="_wpcf7_locale" value="en_US">
                                        <input type="hidden" name="_wpcf7_unit_tag" value="wpcf7-f148-o1">
                                        <input type="hidden" name="_wpcf7_container_post" value="0">
                                        <input type="hidden" name="_wpcf7_posted_data_hash" value="">
                                        <input type="hidden" name="_wpcf7_recaptcha_response" value=""> -->
                                   </div>
                                   <div class="form-group contact-form-fields">
                                        <p>
                                             <label for="exampleInputEmail1">Nombre *</label><br>
                                             <span class="wpcf7-form-control-wrap" data-name="text"><input size="40" maxlength="400" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required form-control" id="exampleInputEmail1" aria-required="true" aria-invalid="false" value="" type="text" name="name"></span>
                                        </p>
                                        <span class="text text-danger error" style="display:none;">This field is required</span>
                                   </div>
                                   <div class="form-group contact-form-fields">
                                        <p>
                                             <label for="exampleInputNumber">Número de teléfono *</label><br>
                                             <span class="wpcf7-form-control-wrap" data-name="tel"><input size="40" maxlength="400" class="wpcf7-form-control wpcf7-tel wpcf7-validates-as-required wpcf7-text wpcf7-validates-as-tel form-control" id="exampleInputNumber" aria-required="true" aria-invalid="false" value="" type="tel" name="phone_number"></span>
                                        </p>
                                        <span class="text text-danger error" style="display:none;">This field is required</span>
                                   </div>
                                   <div class="form-group contact-form-fields">
                                        <p>
                                             <label for="exampleInputAddress">Correo electrónico *</label><br>
                                             <span class="wpcf7-form-control-wrap" data-name="email"><input size="40" maxlength="400" class="wpcf7-form-control wpcf7-email wpcf7-validates-as-required wpcf7-text wpcf7-validates-as-email form-control" id="exampleInputAddress" aria-required="true" aria-invalid="false" value="" type="email" name="email"></span>
                                        </p>
                                        <span class="text text-danger error" style="display:none;">This field is required</span>
                                   </div>
                                   <div class="form-group contact-form-fields">
                                        <p>
                                             <label for="exampleInputAddress">Mensaje</label><br>
                                             <span class="wpcf7-form-control-wrap" data-name="textarea"><textarea cols="40" rows="10" maxlength="2000" class="wpcf7-form-control wpcf7-textarea" aria-invalid="false" name="message"></textarea></span>
                                        </p>
                                        <span class="text text-danger error" style="display:none;">This field is required</span>
                                   </div>
                                   <div class="form-group file-up contact-form-fields">
                                        <p>
                                             <label class="file-up-label"> Agregar archivo : </label><br>
                                             <span class="wpcf7-form-control-wrap" data-name="file-doc"><input size="40" class="wpcf7-form-control wpcf7-file" id="file-type-doc-id" aria-invalid="false" type="file" name="file"></span>
                                        </p>
                                        <span class="text text-danger error" style="display:none;">This field is required</span>
                                   </div>
                                   <!-- <div class="form-group capdata">
                                        <span class="wpcf7-form-control-wrap recaptcha" data-name="recaptcha"><span data-sitekey="6LcTRs4pAAAAALTwxwPE7W4jUZk_jwIkmEHt9qJ3" class="wpcf7-form-control wpcf7-recaptcha g-recaptcha"><div style="width: 304px; height: 78px;"><div><iframe title="reCAPTCHA" width="304" height="78" role="presentation" name="a-mvivwzxcg5bt" frameborder="0" scrolling="no" sandbox="allow-forms allow-popups allow-same-origin allow-scripts allow-top-navigation allow-modals allow-popups-to-escape-sandbox allow-storage-access-by-user-activation" src="https://www.google.com/recaptcha/api2/anchor?ar=1&amp;k=6LcTRs4pAAAAALTwxwPE7W4jUZk_jwIkmEHt9qJ3&amp;co=aHR0cHM6Ly9kb2N1bWVudG9zLWxlZ2FsZXMubXg6NDQz&amp;hl=es-419&amp;v=WV-mUKO4xoWKy9M4ZzRyNrP_&amp;size=normal&amp;cb=wywgi2mitqrm"></iframe></div><textarea id="g-recaptcha-response" name="g-recaptcha-response" class="g-recaptcha-response" style="width: 250px; height: 40px; border: 1px solid rgb(193, 193, 193); margin: 10px 25px; padding: 0px; resize: none; display: none;"></textarea></div><iframe style="display: none;"></iframe></span>
                                             <noscript>
                                                  <div class="grecaptcha-noscript">
                                                       <iframe src="https://www.google.com/recaptcha/api/fallback?k=6LcTRs4pAAAAALTwxwPE7W4jUZk_jwIkmEHt9qJ3" frameborder="0" scrolling="no" width="310" height="430">
                                                       </iframe>
                                                       <textarea name="g-recaptcha-response" rows="3" cols="40" placeholder="reCaptcha Response Here">
                                                       </textarea>
                                                  </div>
                                             </noscript>
                                        </span>
                                   </div> -->
                                   <p>
                                        <input class="wpcf7-form-control wpcf7-submit has-spinner submit-btn" type="submit" value="Enviar"><span class="wpcf7-spinner"></span>
                                   </p>
                                   <div class="wpcf7-response-output" aria-hidden="true"></div>
                              </form>
                         </div>
                    </div>
               </div>
          </div>
     </section>

     <!-- <div class="header_sidebar_inner">
          <div class="sidebar_empty_space"></div>
               <div class="sidebar_header_content">
                    <div class="sidebar_header_nav">
                         <div class="header_search_form">
                              <form id="header_search_form" method="POST" action="https://documentos-legales.mx/contratos-documentos-legales/" autocomplete="off">
                                   <input type="text" class="form-control" name="search" placeholder="Buscar">
                                   <button class="mobilesearch-btn" type="submit">
                                        <i class="fa-solid fa-magnifying-glass"></i>
                                   </button>
                              </form>
                         </div>
                         <ul class="_Ty8L2" data-qa="SidebarMenuList">
                              <li>
                                   <a href="https://documentos-legales.mx/arrendamiento/">Arrendamiento</a>
                              </li>
                              <li>
                                   <a href="https://documentos-legales.mx/comercio/">Comercio</a>
                              </li>
                              <li>
                                   <a href="https://documentos-legales.mx/consumo/">Consumo</a>
                              </li>
                              <li>
                                   <a href="https://documentos-legales.mx/familia/">Familia</a>
                              </li>
                              <li>
                                   <a href="https://documentos-legales.mx/internet/">Internet</a>
                              </li>
                              <li>
                                   <a href="https://documentos-legales.mx/laboral/">Laboral</a>
                              </li>
                              <li>
                                   <a href="https://documentos-legales.mx/vida-diaria/">Vida diaria</a>
                              </li>						
                         </ul>
                         
                         <ul class="_Ty8L3" data-qa="SidebarMenuList">
                              <li>
                                   <a href="https://documentos-legales.mx/asi-funciona/">Así funciona</a>
                              </li>
                              <li>
                                   <a href="https://documentos-legales.mx/preguntas-frecuentes/">Preguntas</a>
                              </li>						
                         </ul>
                         
                         <div class="mobile_header_buuton">
                              <a class="cta" href="https://documentos-legales.mx/contratos-documentos-legales/">Crear documento</a>
                         </div>
                    </div>
               </div>
          </div>
          <div role="button" class="_GtzsW _Gv2_B">
               <div class="_NRBhu"></div>
          </div>
          <div class="__z_48"></div>
     </div> -->
</div>

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