@extends('users_layout.other_master')
@section('content')

 <!-- ********(banner-sec)*********** -->
 <section class="banner_sec dark inner-banner fun-banner" style="background-image: url({{ asset('storage/'.$data['background_image'] )}});">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-7">
                <div class="banner_content pre-heading">
                    <h1>{{ $data['banner_title'] ?? 'Preguntas Frecuentes' }}</h1>
                    <p>{{ $data['banner_description'] ?? 'Lorem Ipsum es simplemente un texto de relleno de la industria de la impresión y la
                        tipografía. Lorem Ipsum ha sido el texto de relleno estándar de la industria desde el siglo
                        XVI.' }}
                    </p>
                </div>
            </div>
            <div class="col-md-5">
                <div class="banner_img">
                    <img src="{{ asset('storage/'.$data['banner_image'] ) }}" alt="Preguntas Frecuentes">
                </div>
            </div>
        </div>
    </div>
</section>
 <!-- ********(FAQ_sec)***********  -->
 <section class="tab-faq_sec p_120">
    <div class="container">
        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill"
                    data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home"
                    aria-selected="true">Todos</button>
            </li>
            <!-- @if(isset($faqCategory) && $faqCategory != null)
                @foreach($faqCategory as $value)
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-profile-tab{{ $value->id ?? '' }}" data-bs-toggle="pill"
                        data-bs-target="#pills-profile{{ $value->id ?? '' }}" type="button" role="tab" aria-controls="pills-profile"
                        aria-selected="false">{{ $value->category_name }}</button>
                </li>
                @endforeach
            @endif -->
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill"
                    data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile"
                    aria-selected="false">Información general</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill"
                    data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact"
                    aria-selected="false">Documentos de compra</button>
            </li>
            <li class="nav-item" role="presentation">
            <button class="nav-link" id="pills-use-document-tab" data-bs-toggle="pill"
                data-bs-target="#pills-use-document" type="button" role="tab" aria-controls="pills-use-document"
                aria-selected="false">Usando documentos</button>
            </li>
        </ul>
        <div class="tab-content" id="pills-tabContent">
            <!--================================== tab1 ========================= -->

            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                <div class="faq_sec p-0">
                    <div class="container">
                        <div class="faq-heading">
                            <h3 class="b-dark">
                                Información genera
                            </h3>
                            <div class="accordion  accordion-flush" id="accordionExample">
                                <div class="accordion-item">
                                    <h6 class="accordion-header" id="headingOne">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapseOne" aria-expanded="true"
                                            aria-controls="collapseOne">
                                            Lorem Ipsum es simplemente el texto de relleno de la impresión?
                                        </button>
                                    </h6>
                                    <div id="collapseOne" class="accordion-collapse collapse show"
                                        aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            Lorem Ipsum es simplemente un texto de relleno de la industria de la
                                            impresión y la
                                            tipografía. Lorem Ipsum ha sido el texto de relleno estándar de la
                                            industria
                                            desde el
                                            siglo XVI, cuando un impresor desconocido tomó una galería de tipos y
                                            los
                                            mezcló para
                                            hacer un libro de muestras tipográficas.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h6 class="accordion-header" id="headingTwo">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseTwo"
                                            aria-expanded="false" aria-controls="collapseTwo">
                                            Se utilizó el trozo estándar de Lorem Ipsum?
                                        </button>
                                    </h6>
                                    <div id="collapseTwo" class="accordion-collapse collapse"
                                        aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            Lorem Ipsum es simplemente un texto de relleno de la industria de la
                                            impresión y la
                                            tipografía. Lorem Ipsum ha sido el texto de relleno estándar de la
                                            industria
                                            desde el siglo
                                            XVI, cuando un impresor desconocido tomó una galería de tipos y los
                                            mezcló
                                            para hacer un
                                            libro de muestras tipográficas.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h6 class="accordion-header" id="headingThree">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseThree"
                                            aria-expanded="false" aria-controls="collapseThree">
                                            Lorem Ipsum es simplemente texto de relleno de la impresión.
                                        </button>
                                    </h6>
                                    <div id="collapseThree" class="accordion-collapse collapse"
                                        aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            Lorem Ipsum es simplemente un texto de relleno de la industria de la
                                            impresión y la
                                            tipografía. Lorem Ipsum ha sido el texto de relleno estándar de la
                                            industria
                                            desde el siglo
                                            XVI, cuando un impresor desconocido tomó una galería de tipos y los
                                            mezcló
                                            para hacer un
                                            libro de muestras tipográficas.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="faq-heading">
                            <h3 class="b-dark">
                                Documentos de compra
                            </h3>
                            <div class="accordion  accordion-flush" id="accordionExample">
                                <div class="accordion-item">
                                    <h6 class="accordion-header" id="headingFour">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseFour"
                                            aria-expanded="false" aria-controls="collapseFour">
                                            Por qué la usamos?
                                        </button>
                                    </h6>
                                    <div id="collapseFour" class="accordion-collapse collapse"
                                        aria-labelledby="headingFour" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            Lorem Ipsum es simplemente un texto de relleno de la industria de la
                                            impresión y la
                                            tipografía. Lorem Ipsum ha sido el texto de relleno estándar de la
                                            industria
                                            desde el siglo
                                            XVI, cuando un impresor desconocido tomó una galería de tipos y los
                                            mezcló
                                            para hacer un
                                            libro de muestras tipográficas.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h6 class="accordion-header" id="headingFive">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseFive"
                                            aria-expanded="false" aria-controls="collapseFive">
                                            De dónde viene?
                                        </button>
                                    </h6>
                                    <div id="collapseFive" class="accordion-collapse collapse"
                                        aria-labelledby="headingFive" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            Lorem Ipsum es simplemente un texto de relleno de la industria de la
                                            impresión y la
                                            tipografía. Lorem Ipsum ha sido el texto de relleno estándar de la
                                            industria
                                            desde el siglo
                                            XVI, cuando un impresor desconocido tomó una galería de tipos y los
                                            mezcló
                                            para hacer un
                                            libro de muestras tipográficas.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h6 class="accordion-header" id="headingSix">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseSix"
                                            aria-expanded="false" aria-controls="collapseSix">
                                            El pasaje estándar de Lorem Ipsum, utilizado desde el año 1500?
                                        </button>
                                    </h6>
                                    <div id="collapseSix" class="accordion-collapse collapse"
                                        aria-labelledby="headingSix" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            Lorem Ipsum es simplemente un texto de relleno de la industria de la
                                            impresión y la
                                            tipografía. Lorem Ipsum ha sido el texto de relleno estándar de la
                                            industria
                                            desde el siglo
                                            XVI, cuando un impresor desconocido tomó una galería de tipos y los
                                            mezcló
                                            para hacer un
                                            libro de muestras tipográficas.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="faq-heading">
                            <h3 class="b-dark">
                                Documentos de compra
                            </h3>
                            <div class="accordion  accordion-flush" id="accordionExample">
                                <div class="accordion-item">
                                    <h6 class="accordion-header" id="headingSeven">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseSeven"
                                            aria-expanded="false" aria-controls="collapseSeven">
                                            Lorem Ipsum es simplemente el texto de relleno de la impresión?
                                        </button>
                                    </h6>
                                    <div id="collapseSeven" class="accordion-collapse collapse"
                                        aria-labelledby="headingSeven" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            Lorem Ipsum es simplemente un texto de relleno de la industria de la
                                            impresión y la
                                            tipografía. Lorem Ipsum ha sido el texto de relleno estándar de la
                                            industria
                                            desde el siglo
                                            XVI, cuando un impresor desconocido tomó una galería de tipos y los
                                            mezcló
                                            para hacer un
                                            libro de muestras tipográficas.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h6 class="accordion-header" id="headingEight">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseEight"
                                            aria-expanded="false" aria-controls="collapseEight">
                                            Por qué la usamos?</button>
                                    </h6>
                                    <div id="collapseEight" class="accordion-collapse collapse"
                                        aria-labelledby="headingEight" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            Lorem Ipsum es simplemente un texto de relleno de la industria de la
                                            impresión y la
                                            tipografía. Lorem Ipsum ha sido el texto de relleno estándar de la
                                            industria
                                            desde el siglo
                                            XVI, cuando un impresor desconocido tomó una galería de tipos y los
                                            mezcló
                                            para hacer un
                                            libro de muestras tipográficas.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h6 class="accordion-header" id="headingNine">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseNine"
                                            aria-expanded="false" aria-controls="collapseNine">
                                            Se utilizó el trozo estándar de Lorem Ipsum?</button>
                                    </h6>
                                    <div id="collapseNine" class="accordion-collapse collapse"
                                        aria-labelledby="headingNine" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            Lorem Ipsum es simplemente un texto de relleno de la industria de la
                                            impresión y la
                                            tipografía. Lorem Ipsum ha sido el texto de relleno estándar de la
                                            industria
                                            desde el siglo
                                            XVI, cuando un impresor desconocido tomó una galería de tipos y los
                                            mezcló
                                            para hacer un
                                            libro de muestras tipográficas.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h6 class="accordion-header" id="headingTen">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseTen"
                                            aria-expanded="false" aria-controls="collapseTen">
                                            El pasaje estándar de Lorem Ipsum, utilizado desde el año 1500?
                                        </button>
                                    </h6>
                                    <div id="collapseTen" class="accordion-collapse collapse"
                                        aria-labelledby="headingTen" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            Lorem Ipsum es simplemente un texto de relleno de la industria de la
                                            impresión y la
                                            tipografía. Lorem Ipsum ha sido el texto de relleno estándar de la
                                            industria
                                            desde el siglo
                                            XVI, cuando un impresor desconocido tomó una galería de tipos y los
                                            mezcló
                                            para hacer un
                                            libro de muestras tipográficas.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--================================== tab2 ========================= -->

            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                <div class="faq_sec p-0">
                    <div class="container">
                        <div class="faq-heading">
                            <h3 class="b-dark">
                                Información genera
                            </h3>
                            <div class="accordion  accordion-flush" id="accordionExample">
                                <div class="accordion-item">
                                    <h6 class="accordion-header" id="headingOne">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapseOne" aria-expanded="true"
                                            aria-controls="collapseOne">
                                            Lorem Ipsum es simplemente el texto de relleno de la impresión?
                                        </button>
                                    </h6>
                                    <div id="collapseOne" class="accordion-collapse collapse show"
                                        aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            Lorem Ipsum es simplemente un texto de relleno de la industria de la
                                            impresión y la
                                            tipografía. Lorem Ipsum ha sido el texto de relleno estándar de la
                                            industria
                                            desde el
                                            siglo XVI, cuando un impresor desconocido tomó una galería de tipos y
                                            los
                                            mezcló para
                                            hacer un libro de muestras tipográficas.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h6 class="accordion-header" id="headingTwo">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseTwo"
                                            aria-expanded="false" aria-controls="collapseTwo">
                                            Se utilizó el trozo estándar de Lorem Ipsum?
                                        </button>
                                    </h6>
                                    <div id="collapseTwo" class="accordion-collapse collapse"
                                        aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            Lorem Ipsum es simplemente un texto de relleno de la industria de la
                                            impresión y la
                                            tipografía. Lorem Ipsum ha sido el texto de relleno estándar de la
                                            industria
                                            desde el siglo
                                            XVI, cuando un impresor desconocido tomó una galería de tipos y los
                                            mezcló
                                            para hacer un
                                            libro de muestras tipográficas.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h6 class="accordion-header" id="headingThree">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseThree"
                                            aria-expanded="false" aria-controls="collapseThree">
                                            Lorem Ipsum es simplemente texto de relleno de la impresión.
                                        </button>
                                    </h6>
                                    <div id="collapseThree" class="accordion-collapse collapse"
                                        aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            Lorem Ipsum es simplemente un texto de relleno de la industria de la
                                            impresión y la
                                            tipografía. Lorem Ipsum ha sido el texto de relleno estándar de la
                                            industria
                                            desde el siglo
                                            XVI, cuando un impresor desconocido tomó una galería de tipos y los
                                            mezcló
                                            para hacer un
                                            libro de muestras tipográficas.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="faq-heading">
                            <h3 class="b-dark">
                                Documentos de compra
                            </h3>
                            <div class="accordion  accordion-flush" id="accordionExample">
                                <div class="accordion-item">
                                    <h6 class="accordion-header" id="headingFour">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseFour"
                                            aria-expanded="false" aria-controls="collapseFour">
                                            Por qué la usamos?
                                        </button>
                                    </h6>
                                    <div id="collapseFour" class="accordion-collapse collapse"
                                        aria-labelledby="headingFour" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            Lorem Ipsum es simplemente un texto de relleno de la industria de la
                                            impresión y la
                                            tipografía. Lorem Ipsum ha sido el texto de relleno estándar de la
                                            industria
                                            desde el siglo
                                            XVI, cuando un impresor desconocido tomó una galería de tipos y los
                                            mezcló
                                            para hacer un
                                            libro de muestras tipográficas.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h6 class="accordion-header" id="headingFive">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseFive"
                                            aria-expanded="false" aria-controls="collapseFive">
                                            De dónde viene?
                                        </button>
                                    </h6>
                                    <div id="collapseFive" class="accordion-collapse collapse"
                                        aria-labelledby="headingFive" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            Lorem Ipsum es simplemente un texto de relleno de la industria de la
                                            impresión y la
                                            tipografía. Lorem Ipsum ha sido el texto de relleno estándar de la
                                            industria
                                            desde el siglo
                                            XVI, cuando un impresor desconocido tomó una galería de tipos y los
                                            mezcló
                                            para hacer un
                                            libro de muestras tipográficas.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h6 class="accordion-header" id="headingSix">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseSix"
                                            aria-expanded="false" aria-controls="collapseSix">
                                            El pasaje estándar de Lorem Ipsum, utilizado desde el año 1500?
                                        </button>
                                    </h6>
                                    <div id="collapseSix" class="accordion-collapse collapse"
                                        aria-labelledby="headingSix" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            Lorem Ipsum es simplemente un texto de relleno de la industria de la
                                            impresión y la
                                            tipografía. Lorem Ipsum ha sido el texto de relleno estándar de la
                                            industria
                                            desde el siglo
                                            XVI, cuando un impresor desconocido tomó una galería de tipos y los
                                            mezcló
                                            para hacer un
                                            libro de muestras tipográficas.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="faq-heading">
                            <h3 class="b-dark">
                                Documentos de compra
                            </h3>
                            <div class="accordion  accordion-flush" id="accordionExample">
                                <div class="accordion-item">
                                    <h6 class="accordion-header" id="headingSeven">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseSeven"
                                            aria-expanded="false" aria-controls="collapseSeven">
                                            Lorem Ipsum es simplemente el texto de relleno de la impresión?
                                        </button>
                                    </h6>
                                    <div id="collapseSeven" class="accordion-collapse collapse"
                                        aria-labelledby="headingSeven" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            Lorem Ipsum es simplemente un texto de relleno de la industria de la
                                            impresión y la
                                            tipografía. Lorem Ipsum ha sido el texto de relleno estándar de la
                                            industria
                                            desde el siglo
                                            XVI, cuando un impresor desconocido tomó una galería de tipos y los
                                            mezcló
                                            para hacer un
                                            libro de muestras tipográficas.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h6 class="accordion-header" id="headingEight">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseEight"
                                            aria-expanded="false" aria-controls="collapseEight">
                                            Por qué la usamos?</button>
                                    </h6>
                                    <div id="collapseEight" class="accordion-collapse collapse"
                                        aria-labelledby="headingEight" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            Lorem Ipsum es simplemente un texto de relleno de la industria de la
                                            impresión y la
                                            tipografía. Lorem Ipsum ha sido el texto de relleno estándar de la
                                            industria
                                            desde el siglo
                                            XVI, cuando un impresor desconocido tomó una galería de tipos y los
                                            mezcló
                                            para hacer un
                                            libro de muestras tipográficas.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h6 class="accordion-header" id="headingNine">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseNine"
                                            aria-expanded="false" aria-controls="collapseNine">
                                            Se utilizó el trozo estándar de Lorem Ipsum?</button>
                                    </h6>
                                    <div id="collapseNine" class="accordion-collapse collapse"
                                        aria-labelledby="headingNine" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            Lorem Ipsum es simplemente un texto de relleno de la industria de la
                                            impresión y la
                                            tipografía. Lorem Ipsum ha sido el texto de relleno estándar de la
                                            industria
                                            desde el siglo
                                            XVI, cuando un impresor desconocido tomó una galería de tipos y los
                                            mezcló
                                            para hacer un
                                            libro de muestras tipográficas.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h6 class="accordion-header" id="headingTen">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseTen"
                                            aria-expanded="false" aria-controls="collapseTen">
                                            El pasaje estándar de Lorem Ipsum, utilizado desde el año 1500?
                                        </button>
                                    </h6>
                                    <div id="collapseTen" class="accordion-collapse collapse"
                                        aria-labelledby="headingTen" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            Lorem Ipsum es simplemente un texto de relleno de la industria de la
                                            impresión y la
                                            tipografía. Lorem Ipsum ha sido el texto de relleno estándar de la
                                            industria
                                            desde el siglo
                                            XVI, cuando un impresor desconocido tomó una galería de tipos y los
                                            mezcló
                                            para hacer un
                                            libro de muestras tipográficas.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--================================== tab3 ========================= -->

            <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                <div class="faq_sec p-0">
                    <div class="container">
                        <div class="faq-heading">
                            <h3 class="b-dark">
                                Información genera
                            </h3>
                            <div class="accordion  accordion-flush" id="accordionExample">
                                <div class="accordion-item">
                                    <h6 class="accordion-header" id="headingOne">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapseOne" aria-expanded="true"
                                            aria-controls="collapseOne">
                                            Lorem Ipsum es simplemente el texto de relleno de la impresión?
                                        </button>
                                    </h6>
                                    <div id="collapseOne" class="accordion-collapse collapse show"
                                        aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            Lorem Ipsum es simplemente un texto de relleno de la industria de la
                                            impresión y la
                                            tipografía. Lorem Ipsum ha sido el texto de relleno estándar de la
                                            industria
                                            desde el
                                            siglo XVI, cuando un impresor desconocido tomó una galería de tipos y
                                            los
                                            mezcló para
                                            hacer un libro de muestras tipográficas.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h6 class="accordion-header" id="headingTwo">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseTwo"
                                            aria-expanded="false" aria-controls="collapseTwo">
                                            Se utilizó el trozo estándar de Lorem Ipsum?
                                        </button>
                                    </h6>
                                    <div id="collapseTwo" class="accordion-collapse collapse"
                                        aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            Lorem Ipsum es simplemente un texto de relleno de la industria de la
                                            impresión y la
                                            tipografía. Lorem Ipsum ha sido el texto de relleno estándar de la
                                            industria
                                            desde el siglo
                                            XVI, cuando un impresor desconocido tomó una galería de tipos y los
                                            mezcló
                                            para hacer un
                                            libro de muestras tipográficas.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h6 class="accordion-header" id="headingThree">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseThree"
                                            aria-expanded="false" aria-controls="collapseThree">
                                            Lorem Ipsum es simplemente texto de relleno de la impresión.
                                        </button>
                                    </h6>
                                    <div id="collapseThree" class="accordion-collapse collapse"
                                        aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            Lorem Ipsum es simplemente un texto de relleno de la industria de la
                                            impresión y la
                                            tipografía. Lorem Ipsum ha sido el texto de relleno estándar de la
                                            industria
                                            desde el siglo
                                            XVI, cuando un impresor desconocido tomó una galería de tipos y los
                                            mezcló
                                            para hacer un
                                            libro de muestras tipográficas.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="faq-heading">
                            <h3 class="b-dark">
                                Documentos de compra
                            </h3>
                            <div class="accordion  accordion-flush" id="accordionExample">
                                <div class="accordion-item">
                                    <h6 class="accordion-header" id="headingFour">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseFour"
                                            aria-expanded="false" aria-controls="collapseFour">
                                            Por qué la usamos?
                                        </button>
                                    </h6>
                                    <div id="collapseFour" class="accordion-collapse collapse"
                                        aria-labelledby="headingFour" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            Lorem Ipsum es simplemente un texto de relleno de la industria de la
                                            impresión y la
                                            tipografía. Lorem Ipsum ha sido el texto de relleno estándar de la
                                            industria
                                            desde el siglo
                                            XVI, cuando un impresor desconocido tomó una galería de tipos y los
                                            mezcló
                                            para hacer un
                                            libro de muestras tipográficas.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h6 class="accordion-header" id="headingFive">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseFive"
                                            aria-expanded="false" aria-controls="collapseFive">
                                            De dónde viene?
                                        </button>
                                    </h6>
                                    <div id="collapseFive" class="accordion-collapse collapse"
                                        aria-labelledby="headingFive" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            Lorem Ipsum es simplemente un texto de relleno de la industria de la
                                            impresión y la
                                            tipografía. Lorem Ipsum ha sido el texto de relleno estándar de la
                                            industria
                                            desde el siglo
                                            XVI, cuando un impresor desconocido tomó una galería de tipos y los
                                            mezcló
                                            para hacer un
                                            libro de muestras tipográficas.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h6 class="accordion-header" id="headingSix">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseSix"
                                            aria-expanded="false" aria-controls="collapseSix">
                                            El pasaje estándar de Lorem Ipsum, utilizado desde el año 1500?
                                        </button>
                                    </h6>
                                    <div id="collapseSix" class="accordion-collapse collapse"
                                        aria-labelledby="headingSix" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            Lorem Ipsum es simplemente un texto de relleno de la industria de la
                                            impresión y la
                                            tipografía. Lorem Ipsum ha sido el texto de relleno estándar de la
                                            industria
                                            desde el siglo
                                            XVI, cuando un impresor desconocido tomó una galería de tipos y los
                                            mezcló
                                            para hacer un
                                            libro de muestras tipográficas.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="faq-heading">
                            <h3 class="b-dark">
                                Documentos de compra
                            </h3>
                            <div class="accordion  accordion-flush" id="accordionExample">
                                <div class="accordion-item">
                                    <h6 class="accordion-header" id="headingSeven">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseSeven"
                                            aria-expanded="false" aria-controls="collapseSeven">
                                            Lorem Ipsum es simplemente el texto de relleno de la impresión?
                                        </button>
                                    </h6>
                                    <div id="collapseSeven" class="accordion-collapse collapse"
                                        aria-labelledby="headingSeven" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            Lorem Ipsum es simplemente un texto de relleno de la industria de la
                                            impresión y la
                                            tipografía. Lorem Ipsum ha sido el texto de relleno estándar de la
                                            industria
                                            desde el siglo
                                            XVI, cuando un impresor desconocido tomó una galería de tipos y los
                                            mezcló
                                            para hacer un
                                            libro de muestras tipográficas.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h6 class="accordion-header" id="headingEight">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseEight"
                                            aria-expanded="false" aria-controls="collapseEight">
                                            Por qué la usamos?</button>
                                    </h6>
                                    <div id="collapseEight" class="accordion-collapse collapse"
                                        aria-labelledby="headingEight" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            Lorem Ipsum es simplemente un texto de relleno de la industria de la
                                            impresión y la
                                            tipografía. Lorem Ipsum ha sido el texto de relleno estándar de la
                                            industria
                                            desde el siglo
                                            XVI, cuando un impresor desconocido tomó una galería de tipos y los
                                            mezcló
                                            para hacer un
                                            libro de muestras tipográficas.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h6 class="accordion-header" id="headingNine">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseNine"
                                            aria-expanded="false" aria-controls="collapseNine">
                                            Se utilizó el trozo estándar de Lorem Ipsum?</button>
                                    </h6>
                                    <div id="collapseNine" class="accordion-collapse collapse"
                                        aria-labelledby="headingNine" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            Lorem Ipsum es simplemente un texto de relleno de la industria de la
                                            impresión y la
                                            tipografía. Lorem Ipsum ha sido el texto de relleno estándar de la
                                            industria
                                            desde el siglo
                                            XVI, cuando un impresor desconocido tomó una galería de tipos y los
                                            mezcló
                                            para hacer un
                                            libro de muestras tipográficas.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h6 class="accordion-header" id="headingTen">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseTen"
                                            aria-expanded="false" aria-controls="collapseTen">
                                            El pasaje estándar de Lorem Ipsum, utilizado desde el año 1500?
                                        </button>
                                    </h6>
                                    <div id="collapseTen" class="accordion-collapse collapse"
                                        aria-labelledby="headingTen" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            Lorem Ipsum es simplemente un texto de relleno de la industria de la
                                            impresión y la
                                            tipografía. Lorem Ipsum ha sido el texto de relleno estándar de la
                                            industria
                                            desde el siglo
                                            XVI, cuando un impresor desconocido tomó una galería de tipos y los
                                            mezcló
                                            para hacer un
                                            libro de muestras tipográficas.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--================================== tab4 ========================= -->
            <div class="tab-pane fade" id="pills-use-document" role="tabpanel"
                aria-labelledby="pills-use-document-tab">
                <div class="faq_sec p-0">
                    <div class="container">
                        <div class="faq-heading">
                            <h3 class="b-dark">
                                Información genera
                            </h3>
                            <div class="accordion  accordion-flush" id="accordionExample">
                                <div class="accordion-item">
                                    <h6 class="accordion-header" id="headingOne">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapseOne" aria-expanded="true"
                                            aria-controls="collapseOne">
                                            Lorem Ipsum es simplemente el texto de relleno de la impresión?
                                        </button>
                                    </h6>
                                    <div id="collapseOne" class="accordion-collapse collapse show"
                                        aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            Lorem Ipsum es simplemente un texto de relleno de la industria de la
                                            impresión y la
                                            tipografía. Lorem Ipsum ha sido el texto de relleno estándar de la
                                            industria
                                            desde el
                                            siglo XVI, cuando un impresor desconocido tomó una galería de tipos y
                                            los
                                            mezcló para
                                            hacer un libro de muestras tipográficas.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h6 class="accordion-header" id="headingTwo">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseTwo"
                                            aria-expanded="false" aria-controls="collapseTwo">
                                            Se utilizó el trozo estándar de Lorem Ipsum?
                                        </button>
                                    </h6>
                                    <div id="collapseTwo" class="accordion-collapse collapse"
                                        aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            Lorem Ipsum es simplemente un texto de relleno de la industria de la
                                            impresión y la
                                            tipografía. Lorem Ipsum ha sido el texto de relleno estándar de la
                                            industria
                                            desde el siglo
                                            XVI, cuando un impresor desconocido tomó una galería de tipos y los
                                            mezcló
                                            para hacer un
                                            libro de muestras tipográficas.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h6 class="accordion-header" id="headingThree">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseThree"
                                            aria-expanded="false" aria-controls="collapseThree">
                                            Lorem Ipsum es simplemente texto de relleno de la impresión.
                                        </button>
                                    </h6>
                                    <div id="collapseThree" class="accordion-collapse collapse"
                                        aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            Lorem Ipsum es simplemente un texto de relleno de la industria de la
                                            impresión y la
                                            tipografía. Lorem Ipsum ha sido el texto de relleno estándar de la
                                            industria
                                            desde el siglo
                                            XVI, cuando un impresor desconocido tomó una galería de tipos y los
                                            mezcló
                                            para hacer un
                                            libro de muestras tipográficas.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="faq-heading">
                            <h3 class="b-dark">
                                Documentos de compra
                            </h3>
                            <div class="accordion  accordion-flush" id="accordionExample">
                                <div class="accordion-item">
                                    <h6 class="accordion-header" id="headingFour">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseFour"
                                            aria-expanded="false" aria-controls="collapseFour">
                                            Por qué la usamos?
                                        </button>
                                    </h6>
                                    <div id="collapseFour" class="accordion-collapse collapse"
                                        aria-labelledby="headingFour" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            Lorem Ipsum es simplemente un texto de relleno de la industria de la
                                            impresión y la
                                            tipografía. Lorem Ipsum ha sido el texto de relleno estándar de la
                                            industria
                                            desde el siglo
                                            XVI, cuando un impresor desconocido tomó una galería de tipos y los
                                            mezcló
                                            para hacer un
                                            libro de muestras tipográficas.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h6 class="accordion-header" id="headingFive">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseFive"
                                            aria-expanded="false" aria-controls="collapseFive">
                                            De dónde viene?
                                        </button>
                                    </h6>
                                    <div id="collapseFive" class="accordion-collapse collapse"
                                        aria-labelledby="headingFive" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            Lorem Ipsum es simplemente un texto de relleno de la industria de la
                                            impresión y la
                                            tipografía. Lorem Ipsum ha sido el texto de relleno estándar de la
                                            industria
                                            desde el siglo
                                            XVI, cuando un impresor desconocido tomó una galería de tipos y los
                                            mezcló
                                            para hacer un
                                            libro de muestras tipográficas.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h6 class="accordion-header" id="headingSix">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseSix"
                                            aria-expanded="false" aria-controls="collapseSix">
                                            El pasaje estándar de Lorem Ipsum, utilizado desde el año 1500?
                                        </button>
                                    </h6>
                                    <div id="collapseSix" class="accordion-collapse collapse"
                                        aria-labelledby="headingSix" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            Lorem Ipsum es simplemente un texto de relleno de la industria de la
                                            impresión y la
                                            tipografía. Lorem Ipsum ha sido el texto de relleno estándar de la
                                            industria
                                            desde el siglo
                                            XVI, cuando un impresor desconocido tomó una galería de tipos y los
                                            mezcló
                                            para hacer un
                                            libro de muestras tipográficas.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="faq-heading">
                            <h3 class="b-dark">
                                Documentos de compra
                            </h3>
                            <div class="accordion  accordion-flush" id="accordionExample">
                                <div class="accordion-item">
                                    <h6 class="accordion-header" id="headingSeven">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseSeven"
                                            aria-expanded="false" aria-controls="collapseSeven">
                                            Lorem Ipsum es simplemente el texto de relleno de la impresión?
                                        </button>
                                    </h6>
                                    <div id="collapseSeven" class="accordion-collapse collapse"
                                        aria-labelledby="headingSeven" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            Lorem Ipsum es simplemente un texto de relleno de la industria de la
                                            impresión y la
                                            tipografía. Lorem Ipsum ha sido el texto de relleno estándar de la
                                            industria
                                            desde el siglo
                                            XVI, cuando un impresor desconocido tomó una galería de tipos y los
                                            mezcló
                                            para hacer un
                                            libro de muestras tipográficas.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h6 class="accordion-header" id="headingEight">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseEight"
                                            aria-expanded="false" aria-controls="collapseEight">
                                            Por qué la usamos?</button>
                                    </h6>
                                    <div id="collapseEight" class="accordion-collapse collapse"
                                        aria-labelledby="headingEight" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            Lorem Ipsum es simplemente un texto de relleno de la industria de la
                                            impresión y la
                                            tipografía. Lorem Ipsum ha sido el texto de relleno estándar de la
                                            industria
                                            desde el siglo
                                            XVI, cuando un impresor desconocido tomó una galería de tipos y los
                                            mezcló
                                            para hacer un
                                            libro de muestras tipográficas.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h6 class="accordion-header" id="headingNine">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseNine"
                                            aria-expanded="false" aria-controls="collapseNine">
                                            Se utilizó el trozo estándar de Lorem Ipsum?</button>
                                    </h6>
                                    <div id="collapseNine" class="accordion-collapse collapse"
                                        aria-labelledby="headingNine" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            Lorem Ipsum es simplemente un texto de relleno de la industria de la
                                            impresión y la
                                            tipografía. Lorem Ipsum ha sido el texto de relleno estándar de la
                                            industria
                                            desde el siglo
                                            XVI, cuando un impresor desconocido tomó una galería de tipos y los
                                            mezcló
                                            para hacer un
                                            libro de muestras tipográficas.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h6 class="accordion-header" id="headingTen">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseTen"
                                            aria-expanded="false" aria-controls="collapseTen">
                                            El pasaje estándar de Lorem Ipsum, utilizado desde el año 1500?
                                        </button>
                                    </h6>
                                    <div id="collapseTen" class="accordion-collapse collapse"
                                        aria-labelledby="headingTen" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            Lorem Ipsum es simplemente un texto de relleno de la industria de la
                                            impresión y la
                                            tipografía. Lorem Ipsum ha sido el texto de relleno estándar de la
                                            industria
                                            desde el siglo
                                            XVI, cuando un impresor desconocido tomó una galería de tipos y los
                                            mezcló
                                            para hacer un
                                            libro de muestras tipográficas.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ********(clienbtes_slider)***********  -->

<section class="clientes_slider p_140 light cd" style="background: #F5F5F5;">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="clientes_data size20 ">
                    <h2>Lo que dicen nuestros clientes</h2>
                    <p>Valoramos tu opinión - Así nos califican nuestros clientes.</p>
                </div>
                <div class="btn-wrap">
                    <button class="prev-btn"><img src="img/left-arrow.png" alt=""></button>
                    <button class="next-btn"><img src="img/right-arrow.png" alt=""></button>
                </div>
            </div>
            <div class="col-md-8">
                <div class="client-slider">
                    <div class="control_box">
                        <div class="d-flex">
                            <div class="slider-img">
                                <img src="img/slider-icon.png" alt="">
                            </div>
                            <div class="txt_slider">
                                <h6>Jesús Castellanos</h6>
                                <span>México </span>
                            </div>
                        </div>
                        <div class="star_img">
                            <img src="img/star.png" alt="">
                        </div>
                        <p>“Un excelente documento, bien estructurado, fácil y práctico de llenar”</p>
                        <span>Hace 7 meses</span>
                    </div>
                    <div class="control_box">
                        <div class="d-flex">
                            <div class="slider-img">
                                <img src="img/slider-icon1.png" alt="">
                            </div>
                            <div class="txt_slider">
                                <h6>Jesús Castellanos</h6>
                                <span>México </span>
                            </div>
                        </div>
                        <div class="star_img">
                            <img src="img/star.png" alt="">
                        </div>
                        <p>“Un excelente documento, bien estructurado, fácil y práctico de llenar”</p>
                        <span>Hace 7 meses</span>
                    </div>
                    <div class="control_box">
                        <div class="d-flex">
                            <div class="slider-img">
                                <img src="img/slider-icon2.png" alt="">
                            </div>
                            <div class="txt_slider">
                                <h6>Sara Cabeza</h6>
                                <span>Ciudad de México </span>
                            </div>
                        </div>
                        <div class="star_img">
                            <img src="img/star.png" alt="">
                        </div>
                        <p>“Rápido fácil y completo” </p>
                        <span>Hace 7 meses</span>
                    </div>
                    <div class="control_box">
                        <div class="d-flex">
                            <div class="slider-img">
                                <img src="img/slider-icon1.png" alt="">
                            </div>
                            <div class="txt_slider">
                                <h6>Jesús Castellanos</h6>
                                <span>México </span>
                            </div>
                        </div>
                        <div class="star_img">
                            <img src="img/star.png" alt="">
                        </div>
                        <p>“Un excelente documento, bien estructurado, fácil y práctico de llenar”</p>
                        <span>Hace 7 meses</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection