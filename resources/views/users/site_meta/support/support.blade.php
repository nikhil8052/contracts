@extends('users_layout.master')
@section('content')
    <section class="banner_sec dark inner-banner centro" style="background-image: url({{ asset('assets/img/banner-img.png') }});">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-7">
                    <div class="banner_content">
                        <h1>Centro de Ayuda</h1>
                    </div>
                    <div class="search_bar">
                        <div class="wrap">
                            <div class="search">
                                <input type="text" class="searchTerm" placeholder="¿Cómo podemos ayudarte?">
                                <button type="submit" class="searchButton">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="banner_img">
                        <img src="{{ asset('assets/img/centro.png') }}" alt="centro-de-ayuda">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="como_sec p_120">
        <div class="container">
            <h2 class="b-dark"  style="text-align: center;">Cómo podemos ayudarte!</h2>
            <div class="row">
                <div class="col-lg-4 col-sm-6">
                    <div class="help active">
                        <div class="hlp-img">
                            <img src="{{ asset('assets/img/h1.png') }}" alt="help1">
                        </div>
                        <div class="hlp-txt">
                            <h5 class="b-dark">Empezando</h5>
                            <p>Lorem Ipsum ha sido el texto de relleno estándar de la industria desde el año 1500,
                                cuando era un.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="help">
                        <div class="hlp-img">
                            <img src="{{ asset('assets/img/h2.png') }}" alt="help2">
                        </div>
                        <div class="hlp-txt">
                            <h5 class="b-dark">Personalización</h5>
                            <p>Lorem Ipsum ha sido el texto de relleno estándar de la industria desde el año 1500,
                                cuando era un.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="help">
                        <div class="hlp-img">
                            <img src="{{ asset('assets/img/h3.png') }}" alt="help3">
                        </div>
                        <div class="hlp-txt">
                            <h5 class="b-dark">Base de conocimientos</h5>
                            <p>Lorem Ipsum ha sido el texto de relleno estándar de la industria desde el año 1500,
                                cuando era un.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="help">
                        <div class="hlp-img">
                            <img src="{{ asset('assets/img/h4.png') }}" alt="help4">
                        </div>
                        <div class="hlp-txt">
                            <h5 class="b-dark">Widget</h5>
                            <p>Lorem Ipsum ha sido el texto de relleno estándar de la industria desde el año 1500,
                                cuando era un.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="help">
                        <div class="hlp-img">
                            <img src="{{ asset('assets/img/h5.png')}}" alt="help5">
                        </div>
                        <div class="hlp-txt">
                            <h5 class="b-dark">Guías</h5>
                            <p>Lorem Ipsum ha sido el texto de relleno estándar de la industria desde el año 1500,
                                cuando era un.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="help">
                        <div class="hlp-img">
                            <img src="{{ asset('assets/img/h6.png')}}" alt="help6">
                        </div>
                        <div class="hlp-txt">
                            <h5 class="b-dark">Cuenta y equipo</h5>
                            <p>Lorem Ipsum ha sido el texto de relleno estándar de la industria desde el año 1500,
                                cuando era un.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="faq_sec p_120 pt-0">
        <div class="container">
            <h2 class="b-dark">
                Frequently Asked Questions
            </h2>
            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the
                industry's standard dummy text ever since the 1500s.</p>
            <div class="accordion  accordion-flush" id="accordionExample">
                <div class="accordion-item">
                    <h6 class="accordion-header" id="headingOne">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            Lorem Ipsum es simplemente el texto de relleno de la impresión?
                        </button>
                    </h6>
                    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                        data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            Lorem Ipsum es simplemente un texto de relleno de la industria de la impresión y la
                            tipografía. Lorem Ipsum ha sido el texto de relleno estándar de la industria desde el
                            siglo XVI, cuando un impresor desconocido tomó una galería de tipos y los mezcló para
                            hacer un libro de muestras tipográficas.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h6 class="accordion-header" id="headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            Se utilizó el trozo estándar de Lorem Ipsum?
                        </button>
                    </h6>
                    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                        data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            Lorem Ipsum es simplemente un texto de relleno de la industria de la impresión y la
                            tipografía. Lorem Ipsum ha sido el texto de relleno estándar de la industria desde el siglo
                            XVI, cuando un impresor desconocido tomó una galería de tipos y los mezcló para hacer un
                            libro de muestras tipográficas.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h6 class="accordion-header" id="headingThree">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            Lorem Ipsum es simplemente texto de relleno de la impresión.
                        </button>
                    </h6>
                    <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                        data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            Lorem Ipsum es simplemente un texto de relleno de la industria de la impresión y la
                            tipografía. Lorem Ipsum ha sido el texto de relleno estándar de la industria desde el siglo
                            XVI, cuando un impresor desconocido tomó una galería de tipos y los mezcló para hacer un
                            libro de muestras tipográficas.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h6 class="accordion-header" id="headingFour">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                            Por qué la usamos?
                        </button>
                    </h6>
                    <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour"
                        data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            Lorem Ipsum es simplemente un texto de relleno de la industria de la impresión y la
                            tipografía. Lorem Ipsum ha sido el texto de relleno estándar de la industria desde el siglo
                            XVI, cuando un impresor desconocido tomó una galería de tipos y los mezcló para hacer un
                            libro de muestras tipográficas.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h6 class="accordion-header" id="headingFive">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                            De dónde viene?
                        </button>
                    </h6>
                    <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive"
                        data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            Lorem Ipsum es simplemente un texto de relleno de la industria de la impresión y la
                            tipografía. Lorem Ipsum ha sido el texto de relleno estándar de la industria desde el siglo
                            XVI, cuando un impresor desconocido tomó una galería de tipos y los mezcló para hacer un
                            libro de muestras tipográficas.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h6 class="accordion-header" id="headingSix">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                            El pasaje estándar de Lorem Ipsum, utilizado desde el año 1500?
                        </button>
                    </h6>
                    <div id="collapseSix" class="accordion-collapse collapse" aria-labelledby="headingSix"
                        data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            Lorem Ipsum es simplemente un texto de relleno de la industria de la impresión y la
                            tipografía. Lorem Ipsum ha sido el texto de relleno estándar de la industria desde el siglo
                            XVI, cuando un impresor desconocido tomó una galería de tipos y los mezcló para hacer un
                            libro de muestras tipográficas.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h6 class="accordion-header" id="headingSeven">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                            Lorem Ipsum es simplemente el texto de relleno de la impresión? </button>
                    </h6>
                    <div id="collapseSeven" class="accordion-collapse collapse" aria-labelledby="headingSeven"
                        data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            Lorem Ipsum es simplemente un texto de relleno de la industria de la impresión y la
                            tipografía. Lorem Ipsum ha sido el texto de relleno estándar de la industria desde el siglo
                            XVI, cuando un impresor desconocido tomó una galería de tipos y los mezcló para hacer un
                            libro de muestras tipográficas.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="generate-sec p_100 Comienza_sec" style="background: #F5F5F5;">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="Comienza-img">
                        <img src="{{ asset('assets/img/Comienza-img.png')}}" alt="image here">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="Comienza-content">
                        <h2 class="b-dark">Genera tus documentos legales de forma rápida y sencilla</h2>
                        <p class="size18">
                            Nuestro sistema intuitivo te guía paso a paso para crear documentos legales personalizados.
                            Descárgalos al instante en los formatos PDF y DOCX (Word) y tenlos listos en cuestión de
                            minutos.
                        </p>
                        <a href="#" class="cta_org">Comienza ahora<i class="fa-solid fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection