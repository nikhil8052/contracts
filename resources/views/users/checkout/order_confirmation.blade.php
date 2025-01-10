@extends('users_layout.master') 
@section('content')

<section class="odr_sec">
     <div class="container">
          <div class="cnfrm-odr">
               <div class="odr_img">
                    <img src="{{ asset('assets/img/oc.png') }}" alt="order-confirmed">
               </div>
               <div class="odr_txt">
                    <h2>Gracias</h2>
                    <h6>
                         Confirmación del pedido enviada a su correo electrónico.
                    </h6>
               </div>
               <div class="odr_btn">
                    <a href="#" class="cta_wyt">Descargar documento</a>
               </div>
          </div>
     </div>
</section>

@endsection