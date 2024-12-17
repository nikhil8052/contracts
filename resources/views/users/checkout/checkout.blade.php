@extends('users_layout.master') 
@section('content')

<section class="check_out odr_sec">
     <div class="container">
          <div class="listo">
               <div class="listo_img">
                    <img src="{{ asset('assets/img/tk.png') }}" alt="">
               </div>
               <div class="listo_txt">
                    <h2>Tu documento está listo</h2>
                    <p class="size20">
                         8,780 personas han comprado este documento
                    </p>
                    <p class="size20"><span>5.0</span><span><img src="{{ asset('assets/img/stars.png') }}" alt=""></span></p>
               </div>
          </div>
          <div class="row prnt_row">
               <div class="col-lg-6">
                    <div class="pymnt_form">
                         <div class="detail">
                              <h6 class="b-dark">
                                   Datos del cliente
                              </h6>
                              <p class="size18 mb-0">¿Ya eres cliente? <span><a href="#">Haz clic aquí.</a></span></p>
                              <form class="row g-3">
                                   <div class="col-md-6">
                                        <input type="text" class="form-control" id="fname" placeholder="Nombre *">
                                   </div>
                                   <div class="col-md-6">
                                        <input type="text" class="form-control" id="lname" placeholder="Apellido *">
                                   </div>
                                   <div class="col-md-6">
                                        <input type="email" class="form-control" id="inputEmail4"
                                        placeholder="Correo electrónico *">
                                   </div>
                                   <div class="col-md-6">
                                        <input type="text" class="form-control" id="rfc" placeholder="RFC">
                                   </div>
                                   <div class="col-md-12">
                                        <input type="password" class="form-control" id="password"
                                        placeholder="Crear contraseña *">
                                   </div>

                              </form>
                         </div>
                         <div class="pymnt">
                              <div class="p-heading">
                                   <h6 class="b-dark">Forma de pago</h6>
                              </div>
                              <div class="opt">
                                   <div class="form-check active">
                                        <label class="form-check-label" for="cards">
                                             <img src="{{ asset('assets/img/Group_34801.svg') }}">
                                             <img src="{{ asset('assets/img/Group_34802.svg') }}">
                                             <img src="{{ asset('assets/img/American_Express_logo.svg') }}">
                                             <input class="form-check-input" name="pymnt_method" value="card" type="radio" id="cards">
                                        </label>
                                   </div>
                                   <form class="row g-3 pymnt-details">
                                        <div class="col-md-12">
                                             <input type="number" class="form-control" id="c_num"
                                                  placeholder="Número de tarjeta *">
                                             </div>
                                             <div class="col-md-12">
                                             <input type="number" class="form-control" id="c_num"
                                                  placeholder="Número de tarjeta *">
                                        </div>
                                        <div class="col-md-6">
                                             <input type="number" class="form-control" id="valid_date"
                                                  placeholder="Válido hasta *">
                                        </div>
                                        <div class="col-md-6">
                                             <input type="number" class="form-control" id="valid_till"
                                             placeholder="Válido hasta *">
                                        </div>
                                   </form>
                              </div>
                              <div class="opt">
                                   <div class="form-check">
                                        <label class="form-check-label" for="paypal">
                                             <img src="{{ asset('assets/img/PayPal.png') }}" alt="paypal"> 
                                             <input class="form-check-input" name="pymnt_method" value="PayPal" type="radio" id="paypal">
                                        </label>
                                   </div>
                                   <form class="row g-3 pymnt-details">
                                        <div class="col-md-12">
                                             <input type="number" class="form-control" id="num_card"
                                                  placeholder="Número de tarjeta *">
                                        </div>
                                        <div class="col-md-12">
                                             <input type="number" class="form-control" id="c_num"
                                                  placeholder="Número de tarjeta *">
                                        </div>
                                        <div class="col-md-6">
                                             <input type="number" class="form-control" id="v_date"
                                                  placeholder="Válido hasta *">
                                        </div>
                                        <div class="col-md-6">
                                             <input type="number" class="form-control" id="v_till"
                                                  placeholder="Válido hasta *">
                                        </div>
                                   </form>
                              </div>
                              <div class="opt">
                                   <div class="form-check">
                                        <label class="form-check-label" for="oxxo">
                                             <img src="{{ asset('assets/img/oxxo.png') }}" alt="oxxo"> <input class="form-check-input" type="radio" name="pymnt_method" value="oxxo" id="oxxo">

                                        </label>
                                   </div>
                                   <form class="row g-3 pymnt-details">
                                        <div class="col-md-12">
                                             <input type="number" class="form-control" id="card_num"
                                                  placeholder="Número de tarjeta *">
                                        </div>
                                        <div class="col-md-12">
                                             <input type="number" class="form-control" id="c_num"
                                                  placeholder="Número de tarjeta *">
                                        </div>
                                        <div class="col-md-6">
                                             <input type="number" class="form-control" id="valid_d"
                                             placeholder="Válido hasta *">
                                        </div>
                                        <div class="col-md-6">
                                             <input type="number" class="form-control" id="valid_t"
                                             placeholder="Válido hasta *">
                                        </div>
                                   </form>
                              </div>

                              <div class="form-check">
                                   <input class="form-check-input" type="checkbox" value="" id="accept">
                                   <label class="form-check-label" for="accept"> Acepto los <span> <a href="#" class="b-dark">Términos y Condiciones yel Aviso de Privacidad. </a>
                                        </span>
                                   </label>
                              </div>
                         </div>
                         <div class="form_btn">
                              <a href="#" class="cta_org size20">Confirmar y descargar</a>
                         </div>
                    </div>
               </div>
               <div class="col-lg-6">
                    <div class="doc_ready">
                         <div class="form_btn">
                              <a href="#" class="cta_org size20">Confirmar y descargar</a>
                         </div>
                         <div class="carta-poder">
                              <div class="carta-detail">
                                   <div class="carta_img">
                                        <img src="{{ asset('assets/img/cp.png') }}" alt="carta poder">
                                   </div>
                                   <div class="carta_txt">
                                        <h6>Carta Poder</h6>
                                        <p class="size18 mb-0">
                                        Descarga inmediata en PDF y DOCX (Word)
                                        </p>
                                   </div>
                              </div>
                              <div class="carta_cost">
                                   <p class="size20 mb-0">Total</p>
                                   <p class="size20 b-dark mb-0">
                                        $199
                                   </p>
                              </div>
                         </div>
                         <div class="sitio carta-poder">
                              <div class="carta-detail">
                                   <div class="sc_txt">
                                        <div class="lock_img">
                                             <img src="{{ asset('assets/img/lock.png') }}" alt="security">
                                        </div>
                                        <div class="sitio_txt">
                                             <p class="size18 b-dark mb-0">Sitio web seguro
                                             </p>
                                             <p>
                                                  Descargas rapidas, datos encriptados, pagos seguros.
                                             </p>
                                        </div>
                                   </div>
                                   <div class="sitio_img">
                                        <img src="{{ asset('assets/img/ssl.png') }}" alt="carta poder">
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
     </div>
</section>

@endsection