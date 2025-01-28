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
                                             <input class="form-check-input" name="pymnt_method" value="stripe" type="radio" id="cards" checked>
                                        </label>
                                   </div>
                                   <!-- Stripe Form  -->
                                   <form class="row g-3 pymnt-details " id="stripe_form" action="{{ route('checkout.customer') }}" method="POST">
                                        @csrf
                                        <div class="col-md-12">
                                             <label for="card-number">Número de tarjeta *</label>
                                             <div class="form-control" id="card-number"></div>
                                        </div>
                                        <div class="col-md-6">
                                             <label for="card-expiry">Válido hasta *</label>
                                             <div class="form-control" id="card-expiry"></div>
                                        </div>
                                        <div class="col-md-6">
                                             <label for="card-cvc">CVC *</label>
                                             <div class="form-control" id="card-cvc"></div>
                                        </div>
                                        <input type="hidden" name="payment_method" id="stripe_pm" value="">
                                        <input type="hidden" name="payment_intent" id="stripe_i" value="{{ $intent->id }}">
                                   </form>
                                   <div id="card-errors" class="text-danger mt-2" role="alert"></div>

                              </div>
                              <div class="opt">
                                   <div class="form-check">
                                        <label class="form-check-label" for="paypal">
                                             <img src="{{ asset('assets/img/PayPal.png') }}" alt="paypal"> 
                                             <input class="form-check-input" name="pymnt_method" value="paypal" type="radio" id="paypal">
                                        </label>
                                   </div>
                                   <!-- Paypal Form  -->
                                   <form class="row g-3 pymnt-details" id="paypal_form" action="{{ route('checkout.paypal') }}" method="POST" >
                                        @csrf 
                                        <input type="hidden" name="payment_method" value="paypal" >
                                        <input type="hidden" name="document_id" value="{{ $document->id }}" >

                                   </form>
                              </div>
                              <!-- <div class="opt">
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
                              </div> -->

                              <div class="form-check">
                                   <input class="form-check-input" type="checkbox" value="" id="accept">
                                   <label class="form-check-label" for="accept"> Acepto los <span> <a href="#" class="b-dark">Términos y Condiciones yel Aviso de Privacidad. </a>
                                        </span>
                                   </label>
                              </div>
                         </div>
                         <div class="form_btn">
                              <a href="javascript:void(0)" class="cta_org size20 submit-form">Confirmar y descargar</a>
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
                                        <h6>{{ $title ?? '' }}</h6>
                                        <p class="size18 mb-0">
                                        Descarga inmediata en PDF y DOCX (Word)
                                        </p>
                                   </div>
                              </div>
                              <div class="carta_cost">
                                   <p class="size20 mb-0">Total</p>
                                   <p class="size20 b-dark mb-0">
                                        ${{ $price ?? '199' }}
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
<script src="https://js.stripe.com/v3/"></script>
<script>
    
    var secretKey = `{{ env('STRIPE_KEY') }}`;
    var clientSecret = `{{ $clientSecret }}`; // The client secret for the PaymentIntent
    const stripe = Stripe(secretKey);
    const elements = stripe.elements();
    // Create individual card input fields
    const cardNumber = elements.create('cardNumber');
    const cardExpiry = elements.create('cardExpiry');
    const cardCvc = elements.create('cardCvc');
    // Mount the card input fields to their respective elements
    cardNumber.mount('#card-number');
    cardExpiry.mount('#card-expiry');
    cardCvc.mount('#card-cvc');
    const cardErrors = document.getElementById('card-errors'); // For error messages


    $('.submit-form').on('click', async (e) => {
     e.preventDefault();
     $('.submit-form').text("Hold On...")
     $('.submit-form').prop('disabled', true);
        var payment_method = $('input[name="pymnt_method"]:checked').val();
        if (payment_method == "stripe") {
            // Create payment method
            const { paymentMethod, error: paymentMethodError } = await stripe.createPaymentMethod({
                type: 'card',
                card: cardNumber,
            });

            if (paymentMethodError) {
               // Confirmar y descargar
               $('.submit-form').text("Confirmar y descargar")
               $('.submit-form').prop('disabled', false);
                cardErrors.textContent = paymentMethodError.message;
                return;
            }

          //   create the order here for the user in the database and then work on that 
          const orderData = {
               payment_method: paymentMethod.id,
               payment_intent:`{{ $intent->id }}`,
               price: {{ $price * 100 }}, // Pass the price in cents
               description: "order for the user ID this man", // Payment description
               document_id: {{ $document->id }} , // Document ID
               _token: '{{ csrf_token() }}', // CSRF token
          };

          try {
                const response = await fetch('{{ route('user.place_order') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(orderData),
                });
                const orderResponse = await response.json();
                if (!response.ok || !orderResponse.success) {
                    cardErrors.textContent = "Failed to create the order. Please try again.";
                    return;
                }
                
            } catch (error) {
               $('.submit-form').text("Confirmar y descargar")
               $('.submit-form').prop('disabled', false);
                cardErrors.textContent = "An error occurred while creating the order.";
            }
            // Confirm payment with the client secret
            const { paymentIntent, error: paymentIntentError } = await stripe.confirmCardPayment(clientSecret, {
                payment_method: paymentMethod.id,
            });
            if (paymentIntentError) {
                cardErrors.textContent = paymentIntentError.message;
                console.log(paymentIntentError, "Payment confirmation failed");
                return;
            }
            if (paymentIntent && paymentIntent.status === 'succeeded') {
                $('#stripe_pm').val(paymentMethod.id); 
                $('#stripe_form').submit(); 
            } else {
                cardErrors.textContent = "Payment failed. Please try again.";
            }
        }else if (payment_method=="paypal"){       
           InitPaypal();
        }
    });



    function InitPaypal (){
       $('#paypal_form').submit();
    }
</script>
@endsection