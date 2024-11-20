@extends('users_layout.master')
@section('content')

@php use Carbon\Carbon; @endphp
<section class=" dark other_bg">

</section>
    <!---------------------------------------------------- section2 start ------------------------------------ -->

<section class="outer_sec2  p_120">
    <div class="inner_sec2 light">
        <div class="container">
            <div class="row">
                <div class="col-lg-5">
                    <div class="pdf_in1">
                        <?php 
                            $image_path = str_replace('public/', '', $document->document_file_path ?? null);
                        ?>
                        <img src="{{ asset('storage/'.$image_path) }}" alt="">
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="pdf_in2">
                        <div class="pdf_head">
                            <h1>{{ $document->title ?? '' }}</h1>
                        </div>
                        <div class="ul_st">
                            <ul class="inside_ul_pdf">
                                <li><img src="{{ asset('assets/img/org_tick.svg') }}" alt=""></li>
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
                            <!-- <div> -->
                                <!-- <span class="share_sn">
                                    <a href=""><img src="{{ asset('assets/img/share_icon.png') }}" alt=""></a>
                                </span> -->
                                <div class="sharing_icons">
                                    <div class="sharing_ul">
                                        <a aria-label="Facebook" class="fb_icon" href="" title="Facebook" target="_blank">
                                            <span class="svg">
                                                <svg style="display:block;border-radius:999px;" focusable="false" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 32 32"><path fill="#1E2C4F" d="M28 16c0-6.627-5.373-12-12-12S4 9.373 4 16c0 5.628 3.875 10.35 9.101 11.647v-7.98h-2.474V16H13.1v-1.58c0-4.085 1.849-5.978 5.859-5.978.76 0 2.072.15 2.608.298v3.325c-.283-.03-.775-.045-1.386-.045-1.967 0-2.728.745-2.728 2.683V16h3.92l-.673 3.667h-3.247v8.245C23.395 27.195 28 22.135 28 16Z"></path></svg>
                                            </span>
                                        </a>
                                    </div>
                                    <div class="sharing_ul">
                                        <a aria-label="Pinterest" class="pin_icon" href="" title="Pinterest" target="_blank">
                                            <span class="svg">
                                                <svg style="display:block;border-radius:999px;" focusable="false" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="-2 -2 35 35"><path fill="#1E2C4F" d="M16.539 4.5c-6.277 0-9.442 4.5-9.442 8.253 0 2.272.86 4.293 2.705 5.046.303.125.574.005.662-.33.061-.231.205-.816.27-1.06.088-.331.053-.447-.191-.736-.532-.627-.873-1.439-.873-2.591 0-3.338 2.498-6.327 6.505-6.327 3.548 0 5.497 2.168 5.497 5.062 0 3.81-1.686 7.025-4.188 7.025-1.382 0-2.416-1.142-2.085-2.545.397-1.674 1.166-3.48 1.166-4.689 0-1.081-.581-1.983-1.782-1.983-1.413 0-2.548 1.462-2.548 3.419 0 1.247.421 2.091.421 2.091l-1.699 7.199c-.505 2.137-.076 4.755-.039 5.019.021.158.223.196.314.077.13-.17 1.813-2.247 2.384-4.324.162-.587.929-3.631.929-3.631.46.876 1.801 1.646 3.227 1.646 4.247 0 7.128-3.871 7.128-9.053.003-3.918-3.317-7.568-8.361-7.568z"></path></svg>
                                            </span>
                                        </a>
                                    </div>
                                    <div class="sharing_ul">
                                        <a aria-label="X" class="twitter_icon" href="" title="Twitter" target="_blank">
                                            <span class="svg">
                                                <svg width="100%" height="100%" style="display:block;border-radius:999px;" focusable="false" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32"><path fill="#1E2C4F" d="M21.751 7h3.067l-6.7 7.658L26 25.078h-6.172l-4.833-6.32-5.531 6.32h-3.07l7.167-8.19L6 7h6.328l4.37 5.777L21.75 7Zm-1.076 16.242h1.7L11.404 8.74H9.58l11.094 14.503Z"></path></svg>
                                            </span>
                                        </a>
                                    </div>
                                    <div class="sharing_ul">
                                        <a aria-label="Copy Link" class="copy_link_icon" href="" title="Copylink" target="_blank">
                                            <span class="svg">
                                                <svg style="display:block;border-radius:999px;" focusable="false" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="-4 -4 40 40"><path fill="#1E2C4F" d="M24.412 21.177c0-.36-.126-.665-.377-.917l-2.804-2.804a1.235 1.235 0 0 0-.913-.378c-.377 0-.7.144-.97.43.026.028.11.11.255.25.144.14.24.236.29.29s.117.14.2.256c.087.117.146.232.177.344.03.112.046.236.046.37 0 .36-.126.666-.377.918a1.25 1.25 0 0 1-.918.377 1.4 1.4 0 0 1-.373-.047 1.062 1.062 0 0 1-.345-.175 2.268 2.268 0 0 1-.256-.2 6.815 6.815 0 0 1-.29-.29c-.14-.142-.223-.23-.25-.254-.297.28-.445.607-.445.984 0 .36.126.664.377.916l2.778 2.79c.243.243.548.364.917.364.36 0 .665-.118.917-.35l1.982-1.97c.252-.25.378-.55.378-.9zm-9.477-9.504c0-.36-.126-.665-.377-.917l-2.777-2.79a1.235 1.235 0 0 0-.913-.378c-.35 0-.656.12-.917.364L7.967 9.92c-.254.252-.38.553-.38.903 0 .36.126.665.38.917l2.802 2.804c.242.243.547.364.916.364.377 0 .7-.14.97-.418-.026-.027-.11-.11-.255-.25s-.24-.235-.29-.29a2.675 2.675 0 0 1-.2-.255 1.052 1.052 0 0 1-.176-.344 1.396 1.396 0 0 1-.047-.37c0-.36.126-.662.377-.914.252-.252.557-.377.917-.377.136 0 .26.015.37.046.114.03.23.09.346.175.117.085.202.153.256.2.054.05.15.148.29.29.14.146.222.23.25.258.294-.278.442-.606.442-.983zM27 21.177c0 1.078-.382 1.99-1.146 2.736l-1.982 1.968c-.745.75-1.658 1.12-2.736 1.12-1.087 0-2.004-.38-2.75-1.143l-2.777-2.79c-.75-.747-1.12-1.66-1.12-2.737 0-1.106.392-2.046 1.183-2.818l-1.186-1.185c-.774.79-1.708 1.186-2.805 1.186-1.078 0-1.995-.376-2.75-1.13l-2.803-2.81C5.377 12.82 5 11.903 5 10.826c0-1.08.382-1.993 1.146-2.738L8.128 6.12C8.873 5.372 9.785 5 10.864 5c1.087 0 2.004.382 2.75 1.146l2.777 2.79c.75.747 1.12 1.66 1.12 2.737 0 1.105-.392 2.045-1.183 2.817l1.186 1.186c.774-.79 1.708-1.186 2.805-1.186 1.078 0 1.995.377 2.75 1.132l2.804 2.804c.754.755 1.13 1.672 1.13 2.75z"></path></svg>
                                            </span>
                                        </a>
                                    </div>
                                    <div class="sharing_ul">
                                        <a aria-label="More" class="more_icon" href="" title="More" target="_blank">
                                            <span class="svg">
                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="-.3 0 32 32" version="1.1" width="100%" height="100%" style="display:block;border-radius:999px;" xml:space="preserve"><g><path fill="#1E2C4F" d="M18 14V8h-4v6H8v4h6v6h4v-6h6v-4h-6z" fill-rule="evenodd"></path></g></svg>
                                            </span>
                                        </a>
                                    </div>
                                </div>
                            <!-- </div> -->
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
                                <li class="time_li"> <span class=" span1">Formatos: </span>PDF, DOCX </li>
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
                        <div class="col-lg-6 {{ $key == 0 ? 'b_right' : '' }}">
                            <div class="sec7_const_h">
                                <div class="sec7_const_img">
                                    <div class="sec7_const_num">{{ $key == 0 ? 1 : 2 }}</div>
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
                    <p class="doc_sub_heading">{{ $document->related_description ?? '' }}</p>
                </div>
                @if(isset($document->relatedDocuments) && $document->relatedDocuments != null)
                @foreach($document->relatedDocuments as $related)
                <div class="col-lg-3 col-md-6 p-0 mb-2">
                    <div class="inside_box_b" style="width: 100%; display: inline-block;">
                        <!-- <a href="{{ url('document/'.$related->slug) }}" class="contract_link"> -->
                            <div class="inside_box_tab">
                                <a href="{{ url('document/'.$related->slug) }}" class="contract_link">
                                <div class="img_tab_sec">
                                <?php 
                                    $image_path = str_replace('public/', '', $related->document_file_path ?? null);
                                ?>
                                    <img src="{{ asset('storage/'.$image_path) }}" alt="">
                                </div>
                                </a>
                                <div class="cont_tab_ot">
                                    <a href="{{ url('document/'.$related->slug) }}" class="contract_link">
                                    <div class="tab_ot_text">

                                        <div class="tab_text">
                                            <h5 class=" size20">
                                                {{ $related->title ?? '' }}
                                            </h5>
                                            <ul class="tab_ul">
                                                <li><img src="{{ asset('assets/img/stars.png') }}" alt=""></li>
                                                <li>4.6</li>
                                            </ul>
                                        </div>
                                        <div class="tab_2text light">
                                            <?php $short = Str::limit($related->short_description, 70, '...'); 
                                                print_r($short);
                                            ?>
                                        </div>
                                    </div>
                                    </a>
                                </div>
                                <div class="tab_btn">
                                    <a href="{{ url('document/'.$related->slug) }}" class="cta_blue" tabindex="-1">Crear ahora</a>
                                </div>
                            </div>
                        <!-- </a> -->
                    </div>
                </div>
                @endforeach
                @endif
                <!-- <div class="col-lg-3 col-md-6 p-0 mb-2">
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
                </div> -->
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