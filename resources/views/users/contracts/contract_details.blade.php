@extends('users_layout.master')
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
                        <?php 
                            $image_path = str_replace('public/', '', $document->document_file_path ?? null);
                        ?>
                        <img src="{{ asset('storage/'.$image_path) }}" alt="">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="pdf_in2">
                        <div class="pdf_head">
                            <h1>{{ $document->title ?? '' }}
                              <!-- <span class="share_sn">
                            <a href=""> <img src="{{ asset('assets/img/share_icon.png') }}" alt=""> </a></span>   -->
                        </h1>
                        </div>
                        <div class="ul_st">
                            <ul class="inside_ul_pdf">
                                <li><img src="{{ asset('assets/img/org_tick.png') }}" alt=""></li>
                                <li>{{ $document->valid_in ?? '' }}</li>
                            </ul>
                        </div>
                        <div class="share_icon">
                            <div class="review">
                                <ul class="cont_ul">
                                    <li class="cont_li ">5.0 </li>
                                    <li class="drop_cont_li">
                                        <div class="select_ul">
                                            <div class="stars_li" data-type="firstOption">
                                                <span class="span_img"><img src="{{ asset('assets/img/stars.png') }}" alt=""> </span>
                                            </div>           
                                        </div>
                                    </li>
                                    <li class="cont_li ">81 opiniones</li>
                                </ul>
                            </div>
                            <div>
                                <span class="share_sn">
                                    <a href=""><img src="{{ asset('assets/img/share_icon.png') }}" alt=""></a>
                                </span>
                            </div>
                        </div>
                        

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
            <?php 
                $ag_path = str_replace('public/', '', $agreement->media->file_path ?? null); 
            ?>
                <div class="col-lg-3 col-md-6  mb-2">
                    <div class="card_sec4_conrt ">
                        <div class="img_sec4">
                            <img src="{{ asset('storage/'.$ag_path ) }}" alt="">
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
                            <h2>
                                {{ $document->legal_heading ?? '' }}
                            </h2>
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
                    <?php 
                        $legal_path = str_replace('public/', '', $document->file_path ?? null); 
                    ?>
                        <img src="{{ asset('storage/'.$legal_path ) }}" alt="">
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
                <?php 
                    $path = str_replace('public/', '', $field->media->file_path ?? null);
                ?>
                    <div class="Para_ot_box">
                        <div class="head_sec6_para">
                            <h2>
                                {{ $field->heading ?? '' }}
                            </h2>
                            <?php print_r($field->description ?? '' ); ?>

                            <div class="img_sec6_box">
                                <img class="sec6_inner_img" src="{{ asset('storage/'.$path) }}" alt="">
                            </div>
                            <?php print_r($field->description2 ?? '' ); ?>
                        </div>
                        
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
                                    <img src="{{ $key == 0 ? asset('assets/img/Group_36131.png') : asset('assets/img/Group_36132.png') }}" alt="">
                                </div>

                                <div class="h_sec_const">
                                    <h3>{{ $guide->step_title }}</h3>
                                    <p>
                                        {!! $guide->step_description !!}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    </div>
                </div>
            </div>
            <div class="con_btn_div h_sec_btn">
                <a href="{{ $document->guide_button_link ?? '' }}" class="cta_light_cont ">{{ $document->guide_button ?? '' }}</a>
            </div>
        </div>

    </div>
</section>

<!---------------------------------------------------- section8 start------------------------------------>


<section class="sec8_cont_ot light p_120">
    <div class="inside_sec8_const">
        <div class="container">
            <div class="row">
                <div class="heading_sec_tabs">
                    <h2 class="doc_h">{{ $document->related_heading ?? '' }}</h2>
                </div>
                <div class="col-lg-3 col-md-6 p-0 mb-2">
                    <div class="inside_box_b" style="width: 100%; display: inline-block;">
                        <div class="inside_box_tab">
                            <div class="img_tab_sec">
                                <img src="{{ asset('assets/img/tab1_img.png') }}" alt="">
                            </div>
                            <div class="cont_tab_ot">
                                <div class="tab_ot_text">

                                    <div class="tab_text">
                                        <h5 class=" size20">
                                            Carta de Recomendación Personal
                                        </h5>
                                        <ul class="tab_ul">
                                            <li> <img src="{{ asset('assets/img/stars.png') }}" alt=""></li>
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
                                <img src="{{ asset('assets/img/tab1_img.png') }}" alt="">
                            </div>
                            <div class="cont_tab_ot">
                                <div class="tab_ot_text">

                                    <div class="tab_text">
                                        <h5 class=" size20">
                                            Carta de Recomendación Personal
                                        </h5>
                                        <ul class="tab_ul">
                                            <li> <img src="{{ asset('assets/img/stars.png') }}" alt=""></li>
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
                                <img src="{{ asset('assets/img/tab1_img.png') }}" alt="">
                            </div>
                            <div class="cont_tab_ot">
                                <div class="tab_ot_text">

                                    <div class="tab_text">
                                        <h5 class=" size20">
                                            Carta de Recomendación Personal
                                        </h5>
                                        <ul class="tab_ul">
                                            <li> <img src="{{ asset('assets/img/stars.png') }}" alt=""></li>
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
                                <img src="{{ asset('assets/img/tab1_img.png') }}" alt="">
                            </div>
                            <div class="cont_tab_ot">
                                <div class="tab_ot_text">

                                    <div class="tab_text">
                                        <h5 class=" size20">
                                            Carta de Recomendación Personal
                                        </h5>
                                        <ul class="tab_ul">
                                            <li> <img src="{{ asset('assets/img/stars.png') }}" alt=""></li>
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
                        <button class="prev-btn">
                            <img src="{{ asset('assets/img/Vector1.png') }}" alt="">
                        </button>
                        <button class="next-btn">
                            <img src="{{ asset('assets/img/Vector2.png') }}" alt="">
                        </button>
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
</section>

<script>
	$(document).ready(function(){
		$(".client-slider").slick({
			slidesToShow: 2,
			slidesToScroll: 1,
			arrows: true,
			infinite: true,
			autoplay: false,
			responsive: [
				{
					breakpoint: 991,
					settings: {
					slidesToShow: 2,
					},
				},
				{
					breakpoint: 767,
					settings: {
					slidesToShow: 1,
					},
				},
			],
		});

		$(".prev-btn").click(function () {
			$(".client-slider").slick("slickPrev");
		});

		$('.next-btn').on('click', function() {
		$('.client-slider').slick('slickNext'); 
	});

		$(".prev-btn").addClass("slick-disabled");
		$(".slick-list").on("afterChange", function () {
			if ($(".slick-prev").hasClass("slick-disabled")) {
				$(".prev-btn").addClass("slick-disabled");
			} else {
				$(".prev-btn").removeClass("slick-disabled");
			}
			if ($(".slick-next").hasClass("slick-disabled")) {
				$(".next-btn").addClass("slick-disabled");
			} else {
				$(".next-btn").removeClass("slick-disabled");
			}
		});
	})


</script>

@endsection