@extends('users_layout.other_master')
@section('content')

@php use Carbon\Carbon; @endphp
<section class=" dark other_bg">

</section>
    <!---------------------------------------------------- section2 start ------------------------------------ -->

<section class="outer_sec2  p_120">
    <div class="inner_sec2 light">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 ">
                    <div class="pdf_in1">
                        <img src="{{ asset('storage/'.$document->document_image ?? '' ) }}" alt="">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="pdf_in2">
                        <div class="pdf_head">
                            <h2>{{ $document->title ?? '' }} <span class="share_sn">
                            <a href=""> <img src="{{ asset('assets/img/share_icon.png') }}" alt=""> </a></span> </h2>
                        </div>
                        <div class="ul_st">
                            <ul class="inside_ul_pdf">
                                <li><img src="{{ asset('assets/img/org_tick.png') }}" alt=""></li>
                                <li>{{ $document->valid_in ?? '' }}</li>
                            </ul>
                        </div>
                        <ul class="cont_ul">
                            <li class="drop_cont_li">
                                <div class="select">
                                    <div class="selectBtn" data-type="firstOption">
                                        5.0 <span class="span_img"> <img src="{{ asset('assets/img/stars.png') }}" alt=""> </span>
                                    </div>
                                    <div class="selectDropdown">
                                        <div class="option" data-type="fourthOption">
                                            4.5 <span class="span_img"><img src="{{ asset('assets/img/stars.png') }}" alt=""></span>
                                        </div>               
                                        <div class="option" data-type="fifthOption">
                                            3.0 <span class="span_img"><img src="{{ asset('assets/img/stars.png') }}" alt=""></span>
                                        </div>
                                        <div class="option" data-type="fifthOption">
                                            2.0 <span class="span_img"><img src="{{ asset('assets/img/stars.png') }}" alt=""></span>
                                        </div>
                                        <div class="option" data-type="fifthOption">
                                            1.0 <span class="span_img"><img src="{{ asset('assets/img/stars.png') }}" alt=""></span>
                                        </div>
                                    </div>
                                </div>
                                
                                

                            </li>
                            <li class="cont_li ">81 opiniones</li>
                        </ul>

                        <div class="cont_content">
                            @if(isset($document->short_description) && $document->short_description != null)
                                <?php print_r($document->short_description); ?>
                            @else
                                <p class="text_contr">
                                    El Acuerdo Unilateral de Confidencialidad es de gran importancia cuando se trata de
                                    proteger información confidencial entre dos personas físicas o morales. En este
                                    acuerdo, la parte que recibe la información se compromete a no divulgarla,
                                    asegurando así su confidencialidad.

                                </p>
                                <p class="text_contr">
                                    <span class="span1"> En tan solo unos minutos, crea un Acuerdo Unilateral de
                                        Confidencialidad</span>
                                    ajustado a tus necesidades y en total cumplimiento con las leyes y regulaciones
                                    vigentes en México. Descárgalo al instante en PDF y DOCX (Word).
                                </p>
                            @endif
                        </div>
                        <div class="time_box">
                            <ul class="time_ul">
                                <li class="time_li"> <span class=" span1">Última revision: </span> @php $date = $document->created_at; $formattedDate = Carbon::parse($date)->format('m/Y');@endphp {{ $formattedDate ?? '' }}</li>
                            </ul>
                            <ul class="time_ul">
                                <li class="time_li"> <span class=" span1">Formatos </span>PDF, DOCX </li>
                            </ul>
                            <ul class="time_ul">
                                <li class="time_li"> <span class=" span1">Descargas: </span>1,587 </li>
                            </ul>
                            <!-- <ul class="time_ul">
                                <li class="time_li"> <span class=" span1">Share: </span>
                                    <div class="socal_ic">
                                        <div class="icon_soc">
                                            <a href=""><i class="fa-brands fa-facebook-f"></i></a>
                                        </div>
                                        <div class="icon_soc">
                                            <a href=""><i class="fa-brands fa-pinterest-p"></i></a>
                                        </div>
                                        <div class="icon_soc">
                                            <a href=""><i class="fa-brands fa-twitter"></i></a>
                                        </div>
                                    </div>
                                </li>
                            </ul> -->

                            <div class="con_btn_div">
                                <a href="" class="cta_light_cont ">{{ $document->btn_text ?? '' }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<!---------------------------------------------------- section4 start ---------------------------------- -->

<section class="sec4_conrt_ot  light size18 ">
    <div class="in_sec4_cont">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="sec4_conrt_h_ot">
                        <?php
                            print_r($document->long_description);
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="in_sec4_card_box p_120 pt-0">
        <div class="container">
            <div class="row">
            @if(isset($document->documentAgreement) && $document->documentAgreement != null)
            @foreach($document->documentAgreement as $agreement)
                <div class="col-lg-3 col-md-6  mb-2">
                    <div class="card_sec4_conrt ">
                        <div class="img_sec4">
                            <img src="{{ asset('storage/'.$agreement->media->file_name ?? '' ) }}" alt="">
                        </div>
                        <div class="sec4_card_p">
                            <h6 class="size20">{{ $agreement->heading ?? '' }}</h6>
                            <p class="sec4_card_para">
                               {{ $agreement->description ?? '' }}
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
            @endif
            </div>
        </div>
    </div>


</section>



<!---------------------------------------------------- section5 start------------------------------------>
<section class="sec5_conrt_ot dark p_120 pt-0">
    <div class="in_cont_sec5bg p_120">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7">
                    <div class="ot_sec5_cont">
                        <div class="head_cont">
                            <h3>
                                {{ $document->legal_heading ?? '' }}
                            </h3>
                            <p>
                               {{ $document->legal_description ?? '' }}
                            </p>

                            <div class="sec5_cont_btn">
                                <a href="" class="cta_org padd-cta">
                                    {{ $document->legal_btn_text ?? '' }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="cont_sec5_img">
                        <img src="{{ asset('storage/'.$document->legal_doc_image ?? '' ) }}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>


<!---------------------------------------------------- section6 start------------------------------------>


<section class="sec6_outer_para light">
    <div class="inside_para_sec6">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                @if(isset($document->documentField) && $document->documentField != null)
                @foreach($document->documentField as $field)
                    <div class="Para_ot_box">
                        <div class="head_sec6_para">
                            <h3>
                                {{ $field->heading ?? '' }}
                            </h3>
                            <?php print_r($field->description ?? '' ); ?>
                        </div>
                        <!-- <div class="para_h_const">
                            <h6 class="creac">Creación rápida y sencilla</h6>
                            <p class="h_const_p">
                                Elabora tu Acuerdo Unilateral de Confidencialidad de forma rápida y directa. Nuestra
                                plataforma es fácil de usar y está optimizada para ahorrar tiempo y esfuerzo,
                                permitiéndote enfocarte en lo que realmente importa. Simplificamos el proceso legal
                                para que puedas obtener un documento vital sin complicaciones.
                            </p>
                        </div>
                        <div class="para_h_const">
                            <h6 class="creac">Innovación y desarrollo de productos</h6>
                            <p class="h_const_p">
                                En la industria de la innovación y desarrollo de productos, el intercambio de ideas
                                y conceptos es crucial. Este acuerdo se convierte en un recurso clave para
                                salvaguardar la propiedad intelectual y mantener la privacidad de diseños, planes y
                                prototipos. Esto permite a las partes explorar nuevas posibilidades sin el riesgo de
                                que la información se divulgue de manera indebida.
                            </p>
                        </div>
                        <div class="img_sec6_box">
                            <img class="sec6_inner_img" src="img/sec6_img1.png" alt="">
                        </div>
                        <div class="para_h_const">
                            <h6 class="creac">Negociaciones y acuerdos comerciales</h6>
                            <p class="h_const_p">
                                Durante las negociaciones y la formalización de acuerdos comerciales, es común
                                compartir detalles estratégicos, financieros y comerciales. El Acuerdo Unilateral de
                                Confidencialidad actúa como un escudo protector para resguardar la información
                                durante estas etapas críticas. Esto asegura que las partes puedan intercambiar
                                información relevante sin preocuparse por su divulgación.G
                            </p>
                        </div>
                        <div class="para_h_const">
                            <h6 class="creac">Investigación y desarrollo</h6>
                            <p class="h_const_p">
                                En el ámbito de la investigación científica y tecnológica, la colaboración puede
                                conducir a avances significativos. Este acuerdo es esencial cuando las partes
                                comparten resultados experimentales, datos técnicos o ideas innovadoras. Al
                                formalizar la confidencialidad de esta información, se fomenta la cooperación entre
                                investigadores y científicos.
                            </p>
                        </div>
                        <div class="para_h_const">
                            <h6 class="creac">Protección de propiedad intelectual</h6>
                            <p class="h_const_p">
                                Para las empresas creativas, proteger la propiedad intelectual es esencial. El
                                acuerdo asegura que los detalles sobre invenciones, diseños y creaciones artísticas
                                se mantengan en secreto durante el proceso de colaboración. Esto garantiza que los
                                derechos de propiedad intelectual estén preservados.
                            </p>
                        </div> -->
                    </div>
                @endforeach
                @endif
                </div>
            </div>
        </div>
    </div>


</section>

<!---------------------------------------------------- section7 start------------------------------------>

<section class="sec7_cont_out dark p_120 pb-0">
    <div class="container">
        <div class="const_bg_sec7">
            <div class="const_hed_sec7">
                <h2>
                    {{ $document->guide_main_heading ?? '' }}
                </h2>
            </div>


            <div class="sec7_const_content">
                <div class="container">
                    <div class="row">
                    @foreach($document->documentGuide as $key => $guide)
                        <div class="col-lg-6">
                            <div class="sec7_const_h {{ $key == 0 ? 'b_right' : '' }}">
                                <div class="sec7_const_img">
                                    <img src="{{ $key == 0 ? asset('assets/img/sec7_1img.png') : asset('assets/img/sec7_img2.png') }}" alt="">
                                </div>

                                <div class="h_sec_const">
                                    <h6>{{ $guide->step_title }}</h6>
                                    <p>
                                        {!! $guide->step_description !!}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach

                        <!-- <div class="col-lg-6">
                            <div class="sec7_const_h b_right">
                                <div class="sec7_const_img">
                                    <img src="img/sec7_1img.png" alt="">
                                </div>
                                <div class="h_sec_const">
                                    <h6>Crea tu acuerdo</h6>
                                    <p>
                                        Utiliza nuestro Generador de Acuerdos para crear tu acuerdo personalizado en
                                        solo unos minutos, permitiéndote elaborar el documento de acuerdo a tus
                                        necesidades específicas.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="sec7_const_h">
                                <div class="sec7_const_img">
                                    <img src="img/sec7_img2.png" alt="">
                                </div>
                                <div class="h_sec_const">
                                    <h6>Descarga tu acuerdo</h6>
                                    <p>
                                        Descarga el acuerdo en el formato que prefieras, disponible en PDF o DOCX,
                                        listo para imprimir, editar y ser firmado por todas las partes involucradas,
                                        asegurando así su validez legal.
                                    </p>
                                </div>
                            </div>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

<!---------------------------------------------------- section8 start------------------------------------>


<section class="sec8_cont_ot light p_120">
    <div class="inside_sec8_const">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 p-0 mb-2">
                    <div class="inside_box_b" style="width: 100%; display: inline-block;">
                        <div class="inside_box_tab">
                            <div class="img_tab_sec">
                                <img src="img/tab1_img.png" alt="">
                            </div>
                            <div class="cont_tab_ot">
                                <div class="tab_ot_text">

                                    <div class="tab_text">
                                        <h5 class=" size20">
                                            Carta de Recomendación Personal
                                        </h5>
                                        <ul class="tab_ul">
                                            <li> <img src="img/stars.png" alt=""></li>
                                            <li>4.6</li>
                                        </ul>
                                    </div>
                                    <div class="tab_2text light">
                                        La Carta de Recomendación Personal es un documento que resalta las
                                        cualidades...
                                    </div>

                                </div>

                            </div>
                            <div class="tab_btn">
                                <a href="" class="cta_blue" tabindex="-1">Crear ahora</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 p-0 mb-2">
                    <div class="inside_box_b" style="width: 100%; display: inline-block;">
                        <div class="inside_box_tab">
                            <div class="img_tab_sec">
                                <img src="img/tab1_img.png" alt="">
                            </div>
                            <div class="cont_tab_ot">
                                <div class="tab_ot_text">

                                    <div class="tab_text">
                                        <h5 class=" size20">
                                            Carta de Recomendación Personal
                                        </h5>
                                        <ul class="tab_ul">
                                            <li> <img src="img/stars.png" alt=""></li>
                                            <li>4.6</li>
                                        </ul>
                                    </div>
                                    <div class="tab_2text light">
                                        La Carta de Recomendación Personal es un documento que resalta las
                                        cualidades...
                                    </div>

                                </div>

                            </div>
                            <div class="tab_btn">
                                <a href="" class="cta_blue" tabindex="-1">Crear ahora</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 p-0 mb-2">
                    <div class="inside_box_b" style="width: 100%; display: inline-block;">
                        <div class="inside_box_tab">
                            <div class="img_tab_sec">
                                <img src="img/tab1_img.png" alt="">
                            </div>
                            <div class="cont_tab_ot">
                                <div class="tab_ot_text">

                                    <div class="tab_text">
                                        <h5 class=" size20">
                                            Carta de Recomendación Personal
                                        </h5>
                                        <ul class="tab_ul">
                                            <li> <img src="img/stars.png" alt=""></li>
                                            <li>4.6</li>
                                        </ul>
                                    </div>
                                    <div class="tab_2text light">
                                        La Carta de Recomendación Personal es un documento que resalta las
                                        cualidades...
                                    </div>

                                </div>

                            </div>
                            <div class="tab_btn">
                                <a href="" class="cta_blue" tabindex="-1">Crear ahora</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 p-0 mb-2">
                    <div class="inside_box_b" style="width: 100%; display: inline-block;">
                        <div class="inside_box_tab">
                            <div class="img_tab_sec">
                                <img src="img/tab1_img.png" alt="">
                            </div>
                            <div class="cont_tab_ot">
                                <div class="tab_ot_text">

                                    <div class="tab_text">
                                        <h5 class=" size20">
                                            Carta de Recomendación Personal
                                        </h5>
                                        <ul class="tab_ul">
                                            <li> <img src="img/stars.png" alt=""></li>
                                            <li>4.6</li>
                                        </ul>
                                    </div>
                                    <div class="tab_2text light">
                                        La Carta de Recomendación Personal es un documento que resalta las
                                        cualidades...
                                    </div>

                                </div>

                            </div>
                            <div class="tab_btn">
                                <a href="" class="cta_blue" tabindex="-1">Crear ahora</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>


<!--------------------------------- section9 start ------------------------------------ -->

<section class="sec9_outer_cont p_120">
    <section class="clientes_slider p_140 light pt-0">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="clientes_data size20">
                        <h2>Lo que dicen nuestros clientes</h2>
                        <p>Valoramos tu opinión - Así nos califican nuestros clientes.</p>
                    </div>
                    <div class="btn-wrap">
                        <button class="prev-btn"><img src="{{ asset('assets/img/left-arrow.png') }}" alt=""></button>
                        <button class="next-btn"><img src="{{ asset('assets/img/right-arrow.png') }}" alt=""></button>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="client-slider">
                        <div class="control_box">
                            <div class="d-flex">
                                <div class="slider-img">
                                    <img src="{{ asset('assets/img/slider-icon.png') }}" alt="">
                                </div>
                                <div class="txt_slider">
                                    <h6>Jesús Castellanos</h6>
                                    <span>México </span>
                                </div>
                            </div>
                            <div class="star_img">
                                <img src="{{ asset('assets/img/star.png') }}" alt="">
                            </div>
                            <p>“Un excelente documento, bien estructurado, fácil y práctico de llenar”</p>
                            <span>Hace 7 meses</span>
                        </div>
                        <div class="control_box">
                            <div class="d-flex">
                                <div class="slider-img">
                                    <img src="{{ asset('assets/img/slider-icon1.png') }}" alt="">
                                </div>
                                <div class="txt_slider">
                                    <h6>Jesús Castellanos</h6>
                                    <span>México </span>
                                </div>
                            </div>
                            <div class="star_img">
                                <img src="{{ asset('assets/img/star.png') }}" alt="">
                            </div>
                            <p>“Un excelente documento, bien estructurado, fácil y práctico de llenar”</p>
                            <span>Hace 7 meses</span>
                        </div>
                        <div class="control_box">
                            <div class="d-flex">
                                <div class="slider-img">
                                    <img src="{{ asset('assets/img/slider-icon2.png') }}" alt="">
                                </div>
                                <div class="txt_slider">
                                    <h6>Sara Cabeza</h6>
                                    <span>Ciudad de México </span>
                                </div>
                            </div>
                            <div class="star_img">
                                <img src="{{ asset('assets/img/star.png') }}" alt="">
                            </div>
                            <p>“Rápido fácil y completo” </p>
                            <span>Hace 7 meses</span>
                        </div>
                        <div class="control_box">
                            <div class="d-flex">
                                <div class="slider-img">
                                    <img src="{{ asset('assets/img/slider-icon1.png') }}" alt="">
                                </div>
                                <div class="txt_slider">
                                    <h6>Jesús Castellanos</h6>
                                    <span>México </span>
                                </div>
                            </div>
                            <div class="star_img">
                                <img src="{{ asset('assets/img/star.png') }}" alt="">
                            </div>
                            <p>“Un excelente documento, bien estructurado, fácil y práctico de llenar”</p>
                            <span>Hace 7 meses</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- <section class="clientes_slider p_140 light">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="clientes_data size20">
                        <h2>{{ $data['reviews_heading'] ?? '' }}</h2>
                        <p>{{ $data['reviews_sub_heading'] ?? '' }}</p>
                    </div>
                    <div class="btn-wrap">
                        <button class="prev-btn"><img src="{{ asset('storage/'.$data['review_left_arrow'] ?? '' ) }}" alt=""></button>
                        <button class="next-btn"><img src="{{ asset('storage/'.$data['review_right_arrow'] ?? '' ) }}" alt=""></button>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="client-slider slick-list">
                    @if(isset($reviews) && $reviews != null)
                    @foreach($reviews as $review)
                        <div class="control_box">
                            <div class="d-flex">
                                <div class="slider-img">

                                <?php 
                                // $initials = strtoupper(substr($review->first_name, 0, 1)) . strtoupper(substr($review->last_name, 0, 1)); ?>
                                <span>{{ $initials ?? '' }}</span>
                                
                                </div>
                                <div class="txt_slider">
                                    <h6>{{ $review->first_name ?? '' }} {{ $review->last_name ?? '' }}</h6>
                                    <span>{{ $review->city ?? '' }}</span>
                                </div>
                            </div>
                            @if(isset($review->rating) && $review->rating != null)
                            <div id="full-stars-example-two">
                                <div class="ratings">
                                @if($review->rating == 1)
                                    <label for="rating1">
                                        <i rate="1" class="star fa fa-star rating-color"></i>
                                    </label>
                                    <input name="rating" id="rating1" class="chkbox" style="display:none;" value="1">
                                @elseif($review->rating == 2)
                                    <label for="rating1">
                                        <i rate="1" class="star fa fa-star rating-color"></i>
                                    </label>
                                    <input name="rating" id="rating1" class="chkbox" style="display:none;" value="1">
                                    <label for="rating2">
                                        <i rate="2" class="star fa fa-star rating-color"></i>
                                    </label>
                                    <input name="rating" id="rating2" class="chkbox" style="display:none;" value="2">
                                @elseif($review->rating == 3)
                                    <label for="rating1">
                                        <i rate="1" class="star fa fa-star rating-color"></i>
                                    </label>
                                    <input name="rating" id="rating1" class="chkbox" style="display:none;" value="1">
                                    <label for="rating2">
                                        <i rate="2" class="star fa fa-star rating-color"></i>
                                    </label>
                                    <input name="rating" id="rating2" class="chkbox" style="display:none;" value="2">
                                    <label for="rating3">
                                        <i rate="3" class="star fa fa-star rating-color"></i>
                                    </label>
                                    <input name="rating" id="rating3" class="chkbox" style="display:none;" value="3">
                                @elseif($review->rating == 4)
                                    <label for="rating1">
                                        <i rate="1" class="star fa fa-star rating-color"></i>
                                    </label>
                                    <input name="rating" id="rating1" class="chkbox" style="display:none;" value="1">
                                    <label for="rating2">
                                        <i rate="2" class="star fa fa-star rating-color"></i>
                                    </label>
                                    <input name="rating" id="rating2" class="chkbox" style="display:none;" value="2">
                                    <label for="rating3">
                                        <i rate="3" class="star fa fa-star rating-color"></i>
                                    </label>
                                    <input name="rating" id="rating3" class="chkbox" style="display:none;" value="3">
                                    <label for="rating4">
                                        <i rate="4" class="star fa fa-star rating-color"></i>
                                    </label>
                                @elseif($review->rating == 5)
                                    <label for="rating1">
                                        <i rate="1" class="star fa fa-star rating-color"></i>
                                    </label>
                                    <input name="rating" id="rating1" class="chkbox" style="display:none;" value="1">
                                    <label for="rating2">
                                        <i rate="2" class="star fa fa-star rating-color"></i>
                                    </label>
                                    <input name="rating" id="rating2" class="chkbox" style="display:none;" value="2">
                                    <label for="rating3">
                                        <i rate="3" class="star fa fa-star rating-color"></i>
                                    </label>
                                    <input name="rating" id="rating3" class="chkbox" style="display:none;" value="3">
                                    <label for="rating4">
                                        <i rate="4" class="star fa fa-star rating-color"></i>
                                    </label>
                                    <input name="rating" id="rating4" class="chkbox" style="display:none;" value="4">
                                    <label for="rating5">
                                        <i rate="5" class="star fa fa-star rating-color"></i>
                                    </label>
                                    <input name="rating" id="rating5" class="chkbox" style="display:none;" value="5" checked>
                                @endif
                                </div>
                            </div>
                            @endif
                            <p>“{{ $review->description ?? '' }}”</p>
                            <span>{{ $review->date ? \Carbon\Carbon::parse($review->date)->diffForHumans() : '' }}</span>
                        </div>
                    @endforeach
                    @endif
                    </div>
                </div>
            </div>
        </div>
    </section> -->

</section>


@endsection