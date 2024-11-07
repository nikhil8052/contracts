@extends('users_layout.master')
@section('content')

<?php use Illuminate\Support\Str; ?>

<section class="banner_sec dark" style="background-image: url({{ asset('storage/'.$data['background_image'] ?? '' ) }});">
	<div class="container banner-col-width">
		<div class="row align-items-center home-banner-row">
			<div class="col-md-6 banner-col">
				<div class="banner_content">
					<h1>{{ $data['banner_title'] ?? '' }}</h1>
				</div>
				<div class="search_bar">
					<div class="wrap">
						<div class="search">
							<input type="text" class="searchTerm"
								placeholder="{{ $data['banner_placeholder'] ?? '' }}">
							<button type="submit" class="searchButton">
								{{ $data['button_name'] ?? '' }}
							</button>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-6 banner-col">
				<div class="banner_img">
					<img src="{{ asset('storage/'.$data['banner_image'] ?? '' ) }}" alt="">
				</div>
			</div>
		</div>
	</div>
</section>
    <!------------------------------ tabs section start  ------------------------------------ -->

<section class=" tab_sec_ot p_120">
	<div class="container">
		<div class="row">
			<div class="heading_sec_tabs">
				<h2 class="doc_h">{{ $data['most_popular_title'] ?? '' }}</h2>
			</div>
		</div>
	</div>
        <!-- tab1 ///////////////////////////////////////////////////////////////////////////// -->
	<div class="container ">
		<div class="wrapper">
			<div class="tab">
			@if(isset($document_category) && $document_category != null)
				@foreach($document_category as $category)
					<div class="btn  home_tab_btns {{ $loop->first ? 'tab_btn1 active' : 'tab_btn' . $loop->iteration }}" >
						{{ $category->name ?? '' }}
					</div>
				@endforeach
			@endif
			</div>
			<div class="tabContentWrap">
				@if(isset($document_category) && $document_category != null)
				@foreach($document_category as $catg)
				<div class="tabContent tab_box_sec {{ $loop->first ? 'show' : 'tab_btn'.$loop->iteration }}">
					<div class="slider">
						@php 
							$popular_document_ids = json_decode($data['popular']) ?? [];
						@endphp

						@if(!empty($popular_document_ids))
							@php
								$documents = App\Models\Document::whereIn('id', $popular_document_ids)->get();
							@endphp

							@foreach($documents as $document)
								@if($document->categories->contains('id', $catg->id))
								<div class="inside_box_b">
									<a href="{{ url('document/'.$document->slug) }}" class="contract_link">
										<div class="inside_box_tab">
											<div class="img_tab_sec">
											<?php 
												$image_path = str_replace('public/', '', $document->document_file_path ?? null);
											?>
												<img src="{{ asset('storage/'.$image_path) }}" alt="">
											</div>
											<div class="cont_tab_ot">
												<div class="tab_text">
													<h5 class="size20">{{ $document->title ?? '' }}</h5>
													<ul class="tab_ul">
														<li><img src="{{ asset('assets/img/stars.png') }}" alt=""></li>
														<li>4.6</li>
													</ul>
												</div>
												<div class="tab_2text light">
													<?php $short = Str::limit($document->short_description, 70, '...'); 
														print_r($short);
													?>
												</div>
												<div class="tab_btn">
													<a href="{{ url('document/'.$document->slug) }}" class="cta_org">{{ $data['most_popular_btn_text'] ?? '' }}</a>
												</div>
											</div>
										</div>
									</a>
								</div>
								@endif
							@endforeach
						@endif
					</div>
				</div>
				@endforeach
				@endif
			</div>
		</div>
	</div>
</section>

    <!------------------------------ tabs section end  ------------------------------------ -->

<section class="Comienza_sec dark">
	<div class="container">
		<div class="Comienza_bg" style="background-color: #002655;">
			<div class="row align-items-center">
				<div class="col-md-6">
					<div class="Comienza-img">
						<img src="{{ asset('storage/'.$data['bottom_banner_image'] ?? '' ) }}" alt="">
					</div>
				</div>
				<div class="col-md-6">
					<div class="Comienza-content">
						<h2>{{ $data['bottom_heading'] ?? '' }}</h2>
						<p>{{ $data['bottom_subheading'] ?? '' }}</p>
						<div class="Comienza-btn">
							<a href="{{ $data['bottom_button_link'] ?? '' }}" class="cta_org">{{ $data['bottom_button_label'] ?? '' }} <i class="fa-solid fa-arrow-right-long"></i></a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

    <!---------------- catagors section start ------------------------------- -->

<section class="outer_cate p_120 light">
	<div class="in_cate">
		<div class="head_cata">
			<div class="container">
				<div class="cata_h">
					<h2>
						{{ $data['category_title'] ?? '' }}
					</h2>
				</div>
			</div>
		</div>
		<div class="container">
			<div class="row">
			@if(isset($home_category) && $home_category != null)
			@foreach($home_category as $category)
			<?php 
				$path = str_replace('public/', '', $category->media->file_path ?? null);
			?>
				<div class="col-lg-3">
					<div class="in_box_cate">
						<div class="in_img_cate">
							<img src="{{ asset('storage/'.$path ?? '' ) }}" alt="">
						</div>
						<div class="in_cate_content">
							<h3>{{ $category->heading ?? '' }}</h3>
							<p class="in_cate_para">
								{{ $category->category_description ?? '' }}
							</p>

						</div>
						<div class="cata_btn">
							<a href="" class="cta_org">{{ $category->btn_text ?? '' }}  <i class="fa-solid fa-arrow-right-long"></i></a>
						</div>
					</div>
				</div>
			@endforeach
			@endif
		</div>
	</div>
</section>

    <!---------------- catagors section end ------------------------------- -->
    <!----------------- card_section start ------------------------>

<section class="card_sec_out">
	<div class="in_card_bg p_120">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="card_ot_lyr">
						<div class="card_h">
							<h3>{{ $data['join_us_text'] ?? '' }}</h3>

						</div>
						<div class="ot_plat dark">
							<div class="othr_platform">
								<a class="google" href=""><i class="fa-brands fa-google"></i>Regístrese con <span
									class="span1"> Google</span> </a>
							</div>
							<div class="othr_platform">
								<a class=" facebook" href=""><i class="fa-brands fa-facebook"></i>Regístrese con
								<span class="span1"> Facebook </span>
								</a>
							</div>
							<div class="othr_platform">
								<a class=" email" href=""><i class="fa-regular fa-envelope"></i>Regístrese con <span
									class="span1"> Email</span> </a>
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>

</section>
    <!----------------- card_section end ------------------------>

<section class="clientes_slider p_140 light">
	<div class="container">
		<div class="row">
			<div class="col-md-4">
				<div class="clientes_data size20">
					<h2>{{ $data['reviews_heading'] ?? '' }}</h2>
					<p>{{ $data['reviews_sub_heading'] ?? '' }}</p>
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
				<div class="client-slider slick-list">
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

          