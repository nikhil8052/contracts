@extends('users_layout.master')
@section('content')

@if(isset($data['background_image']) && $data['background_image'] != null)
    <section class="banner_sec dark inner-banner centro" style="background-image: url({{ asset('storage/'.$data['background_image'])  }});">
@else
    <section class="banner_sec dark inner-banner centro" style="background-image: url({{ asset('assets/img/banner-img.png')  }});">
@endif
        <div class="container banner-col-width">
            <div class="row align-items-center support-banner-row">
                <div class="col-md-6 banner-col">
                    <div class="banner_content">
                        <h1>Centro de Ayuda</h1>
                    </div>
                    <div class="search_bar">
                        <div class="wrap">
                            <div class="search">
                                <input type="text" class="searchTerm" placeholder="{{ $data['banner_placeholder'] ?? '¿Cómo podemos ayudarte?' }}">
                                <button type="submit" class="searchButton">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 banner-col">
                    <div class="banner_img">
                    @if(isset($data['banner_image']) && $data['banner_image'] != null)
                        <img src="{{ asset('storage/'.$data['banner_image']) }}" alt="centro-de-ayuda">
                    @else
                        <img src="{{ asset('assets/img/centro.png') }}" alt="centro-de-ayuda">
                    @endif

                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="como_sec p_120">
        <div class="container">
            <h2 class="b-dark" style="text-align: center;">{{ $data['main_title'] ?? 'Cómo podemos ayudarte!' }}</h2>
            <div class="row">
            @if(isset($help_you) && $help_you)
            @foreach($help_you as $help)
            <?php 
                $path = str_replace('public/', '', $help->media->file_path ?? null);
            ?>
            <div class="col-lg-4 col-sm-6">
                <div class="help">
                    <div class="hlp-img">
                        <img src="{{ asset('storage/'.$path) }}" alt="helpIcon">
                    </div>
                    <div class="hlp-txt">
                        <h5 class="b-dark">{{ $help->heading ?? '' }}</h5>
                        <p>{{ $help->description ?? '' }}</p>
                    </div>
                </div>
            </div>
            @endforeach
            @endif
            </div>
        </div>
    </section>

    <section class="faq_sec p_120 pt-0">
        <div class="container">
            <h2 class="b-dark">
                {{ $data['faq_heading'] ?? 'Frequently Asked Questions' }}
            </h2>
            <p>{{ $data['faq_description'] ?? '' }}</p>
            <div class="accordion  accordion-flush" id="accordionExample">
            @if(isset($faqs) && $faqs != null)
            @foreach($faqs as $faq)
            <div class="accordion-item">
                <h6 class="accordion-header" id="heading{{ $loop->iteration ?? '' }}">
                    <button class="{{ $loop->first ? 'accordion-button':'accordion-button collapsed' }}" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapse{{ $loop->iteration ?? '' }}" aria-expanded="{{ $loop->first ? 'true':'false' }}" aria-controls="collapse{{ $loop->iteration ?? '' }}">
                        {{ $faq->question ?? '' }}
                    </button>
                </h6>
                <div id="collapse{{ $loop->iteration ?? '' }}" class="{{ $loop->first ? 'accordion-collapse collapse show':'accordion-collapse collapse' }}" aria-labelledby="heading{{ $loop->iteration ?? '' }}"
                    data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <?php
                            $answer = strip_tags($faq->answer);
                            print_r($answer);
                        ?>
                    </div>
                </div>
            </div>
            @endforeach
            @endif
            </div>
        </div>
    </section>


    <section class="generate-sec p_100 Comienza_sec">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="Comienza-img">
                    @if(isset($data['bottom_banner_image']) && $data['bottom_banner_image'] != null)
                        <img src="{{ asset('storage/'.$data['bottom_banner_image'] )}}" alt="image here">
                    @else
                        <img src="{{ asset('assets/img/Comienza-img.png')}}" alt="image here">
                    @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="Comienza-content">
                        <h2 class="b-dark">{{ $data['banner_heading'] ?? 'Genera tus documentos legales de forma rápida y sencilla' }}</h2>
                        <p class="">
                            {{ $data['banner_description'] ?? ' Nuestro sistema intuitivo te guía paso a paso para crear documentos legales personalizados.
                            Descárgalos al instante en los formatos PDF y DOCX (Word) y tenlos listos en cuestión de
                            minutos.' }}
                        </p>
                        <a href="#" class="cta_org">{{ $data['button_text'] ?? '' }}<i class="fa-solid fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection