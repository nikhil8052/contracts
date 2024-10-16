@extends('users_layout.other_master')
@section('content')

@if(isset($data['background_image']) && $data['background_image'] != null)
    <section class="banner_sec dark inner-banner" style="background-image: url('{{ asset('storage/'.$data['background_image'] ?? '' ) }}');">
@else
    <section class="banner_sec dark inner-banner" style="background-image: url({{ asset('assets/img/inner-banner.png') }});">  
@endif
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-7">
                <div class="banner_content">
                    <h1>{{ $data['banner_title'] ?? '' }}</h1>
                    <p>
                        {{ $data['banner_description'] ?? '' }}
                    </p>
                </div>
            </div>
            <div class="col-md-5">
            @if(isset($data['banner_image']) && $data['banner_image'] != null)
                <img src="{{ asset('storage/'.$data['banner_image'] ?? '' ) }}" alt="Así funciona">
            @else
                <img src="{{ asset('assets/img/asi.png') }}" alt="Así funciona">
            @endif
            </div>
        </div>
    </div>
</section>
<section class="explore_sec p_120">
    <div class="container">
        <div class="text-center">
            <h2>{{ $data['main_heading'] ?? '' }}</h2>
            <p>{{ $data['short_description'] ?? '' }}</p>
        </div>
        <div class="row">
        @if(isset($works) && $works->isNotEmpty())
            @foreach($works as $work)    
            <div class="col-md-4">
                <div class="explore-cntnt">
                    <div class="explore-img">
                        <img src="{{ asset('storage/'.$work->works->media->file_name ?? '' ) }}" alt="explore">
                    </div>
                    <div class="explore-txt">
                        <h5 class="b-dark">{{ $work->works->heading ?? '' }}</h5>
                        <p class="light">
                            {{ $work->works->description ?? '' }}
                        </p>
                    </div>
                </div>
            </div>
            @endforeach
        @endif
        </div>
    </div>
</section>
<section class="generate-sec p_100 Comienza_sec" style="background: #F5F5F5;">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
            @if(isset($data['second_banner_img']) && $data['second_banner_img'] != null)
                <img src="{{ asset('storage/'.$data['second_banner_img'] ?? '' ) }}" alt="image here">
            @else
                <img src="{{ asset('assets/img/Comienza-img.png') }}" alt="image here">
            @endif
            </div>
            <div class="col-md-6">
                <h2 class="b-dark">{{ $data['second_banner_heading'] ?? '' }}</h2>
                <p class="size18">
                    {{ $data['second_banner_sub_heading'] ?? '' }}
                </p>
                <a href="#" class="cta_org">{{ $data['button_label'] ?? '' }}<i class="fa-solid fa-arrow-right"></i></a>
            </div>
        </div>

    </div>
</section>

@endsection