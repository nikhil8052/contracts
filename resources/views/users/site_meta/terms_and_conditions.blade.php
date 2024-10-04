@extends('users_layout.other_master')
@section('content')

<section class="banner_sec dark inner-banner tc" style="background-image: url({{ asset('storage/'.$data['background_image'] ?? '' ) }});">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-7">
                <div class="banner_content">
                    <h1>{{ $data['banner_title'] ?? '' }}</h1>
                    <p>{{ $data['banner_description'] ?? '' }}</p>
                </div>
            </div>
            <div class="col-md-5">
                <div class="banner_img">
                    <img src="{{ asset('storage/'.$data['banner_image'] ?? '' ) }}" alt="">
                </div>
            </div>
        </div>
    </div>
</section>
<section class="tc-sec p_110">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="tc-index">
                    <p class="size18">
                        {{ $data['main_heading'] ?? '' }}
                    </p>
                    <ol class="tc-links mb-0">
                    @if(!empty($termsAndCondition))
                        @foreach($termsAndCondition as $term)
                            <li class="tc-item {{ $loop->first ? 'active' : '' }}">
                                <a href="#c{{ $loop->iteration }}">{{ $term->terms ?? '' }}</a>
                            </li>
                        @endforeach
                    @endif

                    </ol>
                    <div class="tc-p mt-3">
                        <p class="size18">
                            Política de Privacidad
                        </p>
                        <p class="size18">
                            Aviso Legal </p>
                    </div>

                </div>
            </div>
            <div class="col-lg-8">
                <h2 class="b-dark">{{ $data['main_heading'] ?? '' }}</h2>
                @if(!empty($termsAndCondition))
                    @foreach($termsAndCondition as $condition)
                    <div class="b-dark tc-cntnt" id="c{{ $loop->iteration ?? '' }}">
                        <?php print_r($condition->condition) ?>
                    </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</section>


@endsection            