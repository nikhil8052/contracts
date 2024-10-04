@extends('users_layout.other_master')
@section('content')

<section class="banner_sec dark inner-banner" style="background-image: url('{{ asset('storage/'.$data['background_image'] ?? '' ) }}');">
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
                <img src="{{ asset('storage/'.$data['banner_image'] ?? '' ) }}" alt="Así funciona">
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
                <img src="{{ asset('storage/'.$data['second_banner_img'] ?? '' ) }}" alt="image here">
            </div>
            <div class="col-md-6">
                <h2 class="b-dark">{{ $data['second_banner_heading'] ?? '' }}</h2>
                <p class="size18">
                    {{ $data['second_banner_sub_heading'] ?? '' }}
                </p>
                <a href="#" class="cta_org">Comienza ahora<i class="fa-solid fa-arrow-right"></i></a>
            </div>
        </div>

    </div>
</section>

@endsection