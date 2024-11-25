@extends('users_layout.master')
@section('content')

 <!-- ********(banner-sec)*********** -->
 <section class="banner_sec dark inner-banner fun-banner" style="background-image: url({{ asset('storage/'.$data['background_image'] )}});">
    <div class="container banner-col-width">
        <div class="row align-items-center">
            <div class="col-md-6 banner-col">
                <div class="banner_content pre-heading">
                    <div class="banner_main_title">
                        <h1>{{ $data['banner_title'] ?? 'Preguntas Frecuentes' }}</h1>
                    </div>
                    <p>{{ $data['banner_description'] ?? 'Lorem Ipsum es simplemente un texto de relleno de la industria de la impresión y la
                        tipografía. Lorem Ipsum ha sido el texto de relleno estándar de la industria desde el siglo
                        XVI.' }}
                    </p>
                </div>
            </div>
            <div class="col-md-6 banner-col">
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
            @if(isset($faqCategory) && $faqCategory != null)
                @foreach($faqCategory as $value)
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-profile-tab{{ $value->id ?? '' }}" data-bs-toggle="pill"
                        data-bs-target="#pills-profile{{ $value->id ?? '' }}" type="button" role="tab" aria-controls="pills-profile"
                        aria-selected="false">{{ $value->category_name }}</button>
                </li>
                @endforeach
            @endif
        </ul>
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                <div class="faq_sec pt-5 pb-0">
                    <div class="container">
                    @if(isset($faqCategory) && $faqCategory != null)
                    @foreach($faqCategory as $catg)
                    @if($catg->id == '1')
                        <div class="faq-heading">
                            <h2 class="b-dark">
                                {{ $catg->category_name ?? '' }}
                            </h2>
                            <div class="accordion  accordion-flush" id="accordionExample">
                            @if(isset($faqs1) && $faqs1 != null) 
                                @foreach($faqs1 as $faq1)
                                <div class="accordion-item">
                                    <h6 class="accordion-header" id="heading{{ $loop->iteration ?? '' }}">
                                        <button class="{{ $loop->first ? 'accordion-button' : 'accordion-button collapsed' }}" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapse{{ $loop->iteration ?? '' }}" aria-expanded="{{ $loop->first ? 'true': 'false' }}"
                                            aria-controls="collapse{{ $loop->iteration ?? '' }}">
                                            {{ $faq1->question ?? '' }}
                                        </button>
                                    </h6>
                                    <div id="collapse{{ $loop->iteration ?? '' }}" class="{{ $loop->first ? 'accordion-collapse collapse show' : 'accordion-collapse collapse' }}"
                                        aria-labelledby="heading{{ $loop->iteration ?? '' }}" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <?php
                                                $answer = strip_tags($faq1->answer);
                                                print_r($answer);
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            @endif
                            </div>
                        </div>
                    @elseif($catg->id == '2')
                        <div class="faq-heading">
                            <h2 class="b-dark">
                                {{ $catg->category_name ?? '' }}
                            </h2>
                            <div class="accordion  accordion-flush" id="accordionExample">
                            @if(isset($faqs2) && $faqs2 != null) 
                                @foreach($faqs2 as $faq2)
                                <div class="accordion-item">
                                    <h6 class="accordion-header" id="heading{{ $loop->iteration ?? '' }}">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapse{{ $loop->iteration ?? '' }}"
                                            aria-expanded="false" aria-controls="collapse{{ $loop->iteration ?? '' }}">
                                            {{ $faq2->question ?? '' }}
                                        </button>
                                    </h6>
                                    <div id="collapse{{ $loop->iteration ?? '' }}" class="accordion-collapse collapse"
                                        aria-labelledby="heading{{ $loop->iteration ?? '' }}" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <?php
                                                $answer = strip_tags($faq2->answer);
                                                print_r($answer);
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            @endif
                            </div>
                        </div>
                    @elseif($catg->id == '3')
                        <div class="faq-heading">
                            <h2 class="b-dark">
                                {{ $catg->category_name ?? '' }}
                            </h2>
                            <div class="accordion  accordion-flush" id="accordionExample">
                            @if(isset($faqs3) && $faqs3 != null) 
                                @foreach($faqs3 as $faq3)
                                <div class="accordion-item">
                                    <h6 class="accordion-header" id="heading{{ $loop->iteration ?? '' }}">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapse{{ $loop->iteration ?? '' }}"
                                            aria-expanded="false" aria-controls="collapse{{ $loop->iteration ?? '' }}">
                                            {{ $faq3->question ?? '' }}
                                        </button>
                                    </h6>
                                    <div id="collapse{{ $loop->iteration ?? '' }}" class="accordion-collapse collapse"
                                        aria-labelledby="heading{{ $loop->iteration ?? '' }}" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <?php
                                                $answer = strip_tags($faq3->answer);
                                                print_r($answer);
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            @endif
                            </div>
                        </div>
                    @endif
                    @endforeach
                    @endif
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="pills-profile1" role="tabpanel" aria-labelledby="pills-profile-tab1">
                <div class="faq_sec p-0">
                    <div class="container">
                    @if(isset($faqCategory) && $faqCategory != null)
                    @foreach($faqCategory as $catg)
                        @if($catg->id == '1')
                        <div class="faq-heading">
                            <h2 class="b-dark">
                            {{ $catg->category_name ?? '' }}
                            </h2>
                            <div class="accordion  accordion-flush" id="accordionExample">
                            @if(isset($faqs1) && $faqs1 != null) 
                                @foreach($faqs1 as $faq1)
                                <div class="accordion-item">
                                    <h6 class="accordion-header" id="heading{{ $loop->iteration ?? '' }}">
                                        <button class="{{ $loop->first ? 'accordion-button' : 'accordion-button collapsed' }}" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapse{{ $loop->iteration ?? '' }}" aria-expanded="{{ $loop->first ? 'true': 'false' }}"
                                            aria-controls="collapse{{ $loop->iteration ?? '' }}">
                                            {{ $faq1->question ?? '' }}
                                        </button>
                                    </h6>
                                    <div id="collapse{{ $loop->iteration ?? '' }}" class="{{ $loop->first ? 'accordion-collapse collapse show' : 'accordion-collapse collapse' }}"
                                        aria-labelledby="heading{{ $loop->iteration ?? '' }}" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <?php
                                                $answer = strip_tags($faq1->answer);
                                                print_r($answer);
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            @endif
                            </div>
                        </div>
                        @endif
                    @endforeach
                    @endif
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="pills-profile2" role="tabpanel" aria-labelledby="pills-profile-tab2">
                <div class="faq_sec p-0">
                    <div class="container">
                    @if(isset($faqCategory) && $faqCategory != null)
                    @foreach($faqCategory as $catg)
                        @if($catg->id == '2')
                        <div class="faq-heading">
                            <h2 class="b-dark">
                                {{ $catg->category_name ?? '' }}
                            </h2>
                            <div class="accordion  accordion-flush" id="accordionExample">
                            @if(isset($faqs2) && $faqs2 != null) 
                                @foreach($faqs2 as $faq2)
                                <div class="accordion-item">
                                    <h6 class="accordion-header" id="heading{{ $loop->iteration ?? '' }}">
                                        <button class="{{ $loop->first ? 'accordion-button' : 'accordion-button collapsed' }}" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapse{{ $loop->iteration ?? '' }}"
                                            aria-expanded="{{ $loop->first ? 'true': 'false' }}" aria-controls="collapse{{ $loop->iteration ?? '' }}">
                                            {{ $faq2->question ?? '' }}
                                        </button>
                                    </h6>
                                    <div id="collapse{{ $loop->iteration ?? '' }}" class="{{ $loop->first ? 'accordion-collapse collapse show' : 'accordion-collapse collapse' }}"
                                        aria-labelledby="heading{{ $loop->iteration ?? '' }}" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <?php
                                                $answer = strip_tags($faq2->answer);
                                                print_r($answer);
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            @endif
                            </div>
                        </div>
                        @endif
                    @endforeach
                    @endif
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="pills-profile3" role="tabpanel" aria-labelledby="pills-profile-tab3">
                <div class="faq_sec p-0">
                    <div class="container">
                    @if(isset($faqCategory) && $faqCategory != null)
                    @foreach($faqCategory as $catg)
                    @if($catg->id == '3')
                        <div class="faq-heading">
                            <h2 class="b-dark">
                                {{ $catg->category_name ?? '' }}
                            </h2>
                            <div class="accordion  accordion-flush" id="accordionExample">
                            @if(isset($faqs3) && $faqs3 != null) 
                                @foreach($faqs3 as $faq3)
                                <div class="accordion-item">
                                    <h6 class="accordion-header" id="heading{{ $loop->iteration ?? '' }}">
                                        <button class="{{ $loop->first ? 'accordion-button' : 'accordion-button collapsed' }}" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapse{{ $loop->iteration ?? '' }}"
                                            aria-expanded="{{ $loop->first ? 'true': 'false' }}" aria-controls="collapse{{ $loop->iteration ?? '' }}">
                                            {{ $faq3->question ?? '' }}
                                        </button>
                                    </h6>
                                    <div id="collapse{{ $loop->iteration ?? '' }}" class="{{ $loop->first ? 'accordion-collapse collapse show' : 'accordion-collapse collapse' }}"
                                        aria-labelledby="heading{{ $loop->iteration ?? '' }}" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <?php
                                                $answer = strip_tags($faq3->answer);
                                                print_r($answer);
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            @endif
                            </div>
                        </div>
                    @endif
                    @endforeach
                    @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="clientes_slider p_140 light cd" style="background: #F5F5F5;">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="clientes_data size20 ">
                    <h2>{{ $data2['reviews_heading'] ?? '' }}</h2>
					<p>{{ $data2['reviews_sub_heading'] ?? '' }}</p>
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
				@if(isset($reviews) && $reviews != null)
				@foreach($reviews as $review)
					<div class="control_box">
						<div class="d-flex">
							<div class="slider-img">
							@if(isset($review->media->file_name) && $review->media->file_name != null)
								<img src="{{ asset('storage/'.$review->media->file_name) }}" alt="">
							@else
							<?php $initials = strtoupper(substr($review->first_name, 0, 1)) . strtoupper(substr($review->last_name, 0, 1)); ?>
							<span>{{ $initials ?? '' }}</span>
							@endif
							</div>
							@if($review->type == 'custom')
							<div class="txt_slider">
								<h6>{{ $review->first_name ?? '' }} {{ $review->last_name ?? '' }}</h6>
								<span>{{ $review->city ?? '' }}</span>
							</div>
							@endif
						</div>
						<!-- @if(isset($review->rating) && $review->rating != null)
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
						@endif -->
                        <div class="tab_star_li">
                            <span class="rating-on rate-1" data-rating="1"></span>
                            <span class="rating-on rate-2" data-rating="2"></span>
                            <span class="rating-on rate-3" data-rating="3"></span>
                            <span class="rating-on rate-4" data-rating="4"></span>
                            <span class="rating-on rate-5" data-rating="5"></span>
                        </div>
						<p>“{{ $review->description ?? '' }}”</p>
						<span>{{ $review->date ? \Carbon\Carbon::parse($review->date)->diffForHumans() : '' }}</span>
					</div>
				@endforeach
				@endif
				</div>
			</div>
        </div>
    </div>
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