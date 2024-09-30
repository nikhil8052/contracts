@extends('users_layout.master')
@section('content')

<?php use Illuminate\Support\Str; ?>

<section class="banner_sec dark" style="background-image: url({{ asset('storage/'.$data['background_image'] ?? '' ) }});">
	<div class="container">
		<div class="row align-items-center">
			<div class="col-md-7">
				<div class="banner_content">
					<h1>{{ $data['banner_title'] ?? '' }}</h1>
				</div>
				<div class="search_bar">
					<div class="wrap">
						<div class="search">
							<input type="text" class="searchTerm"
								placeholder="Nombre del documento ej. Contrato de Trabajo">
							<button type="submit" class="searchButton">
								{{ $data['button_name'] ?? '' }}
							</button>
						</div>
					</div>
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
				<div class="btn most_popular_btn" data-id="{{ $category->id ?? '' }}">{{ $category->name ?? '' }}</div>
				<!-- <div class="btn active">Negocios y Comercio </div>
				<div class="btn">Vida Personal</div>
				<div class="btn">Laboral y Cumplimiento</div>
				<div class="btn">Tecnología y Consumo</div> -->
			@endforeach
			@endif
			</div>

			<div class="tabContentWrap">
				<!-- tab1 ///////////////////////////////////////////// -->
				<div class="tabContent show tab_box_sec">
					<div class="slider">
						@php 
							$popular_document_ids = json_decode($data['popular']) ?? '';
						@endphp
						@if(isset($documents) && $documents != null)
						@foreach($documents as $document)
							@if(isset($popular_document_ids) && $popular_document_ids != null)
							@if(in_array($document->id,$popular_document_ids))
							<div class="inside_box_b">
								<div class="inside_box_tab">
									<div class="img_tab_sec">
										<img src="{{ asset('storage/'.$document->document_image ?? '' ) }}" alt="">
									</div>
									<div class="cont_tab_ot">
										<div class="tab_text">
											<h5 class=" size20">
												{{ $document->title ?? '' }}
											</h5>
											<ul class="tab_ul">
												<li><img src="{{ asset('assets/img/stars.png') }}" alt=""></li>
												<li>4.6</li>
											</ul>
										</div>
										<div class="tab_2text light">
										<?php print_r(Str::limit($document->short_description, 70, '...')); ?>
										</div>
										<div class="tab_btn">
										<a href="" class="cta_org">{{ $data['most_popular_btn_text'] ?? '' }}</a>
										</div>
									</div>
								</div>
							</div>
							@endif
							@endif
						@endforeach
						@endif
					</div>
				</div>

				<!-- tab2//////////////////////////////////////////////////////////////////// -->

				<div class="tabContent">
					<div class="slider">
					@php 
						$popular_document_ids = json_decode($data['popular']) ?? '';
					@endphp
					@if(isset($documents) && $documents != null)
					@foreach($documents as $document)
						@if(isset($popular_document_ids) && $popular_document_ids != null)
						@if(in_array($document->id,$popular_document_ids))
						<div class="inside_box_b">
							<div class="inside_box_tab">
								<div class="img_tab_sec">
									<img src="{{ asset('storage/'.$document->document_image ?? '' ) }}" alt="">
								</div>
								<div class="cont_tab_ot">
									<div class="tab_text">
										<h5 class=" size20">
											{{ $document->title ?? '' }}
										</h5>
										<ul class="tab_ul">
											<li><img src="{{ asset('assets/img/stars.png') }}" alt=""></li>
											<li>4.6</li>
										</ul>
									</div>
									<div class="tab_2text light">
									<?php print_r(Str::limit($document->short_description, 70, '...')); ?>
									</div>
									<div class="tab_btn">
									<a href="" class="cta_org">{{ $data['most_popular_btn_text'] ?? '' }}</a>
									</div>
								</div>
							</div>
						</div>
						@endif
						@endif
					@endforeach
					@endif
					</div>
				</div>

					<!-- tab3/////////////////////////////////////////////////////////////// -->

				<div class="tabContent">
					<div class="slider">
					@php 
						$popular_document_ids = json_decode($data['popular']) ?? '';
					@endphp
					@if(isset($documents) && $documents != null)
					@foreach($documents as $document)
						@if(isset($popular_document_ids) && $popular_document_ids != null)
						@if(in_array($document->id,$popular_document_ids))
						<div class="inside_box_b">
							<div class="inside_box_tab">
								<div class="img_tab_sec">
									<img src="{{ asset('storage/'.$document->document_image ?? '' ) }}" alt="">
								</div>
								<div class="cont_tab_ot">
									<div class="tab_text">
										<h5 class=" size20">
											{{ $document->title ?? '' }}
										</h5>
										<ul class="tab_ul">
											<li><img src="{{ asset('assets/img/stars.png') }}" alt=""></li>
											<li>4.6</li>
										</ul>
									</div>
									<div class="tab_2text light">
									<?php print_r(Str::limit($document->short_description, 70, '...')); ?>
									</div>
									<div class="tab_btn">
									<a href="" class="cta_org">{{ $data['most_popular_btn_text'] ?? '' }}</a>
									</div>
								</div>
							</div>
						</div>
						@endif
						@endif
					@endforeach
					@endif
					</div>
				</div>

					<!-- tab4/////////////////////////////////////////////////////////////// -->
				<div class="tabContent">
					<div class="slider">
					@php 
						$popular_document_ids = json_decode($data['popular']) ?? '';
					@endphp
					@if(isset($documents) && $documents != null)
					@foreach($documents as $document)
						@if(isset($popular_document_ids) && $popular_document_ids != null)
						@if(in_array($document->id,$popular_document_ids))
						<div class="inside_box_b">
							<div class="inside_box_tab">
								<div class="img_tab_sec">
									<img src="{{ asset('storage/'.$document->document_image ?? '' ) }}" alt="">
								</div>
								<div class="cont_tab_ot">
									<div class="tab_text">
										<h5 class=" size20">
											{{ $document->title ?? '' }}
										</h5>
										<ul class="tab_ul">
											<li><img src="{{ asset('assets/img/stars.png') }}" alt=""></li>
											<li>4.6</li>
										</ul>
									</div>
									<div class="tab_2text light">
									<?php print_r(Str::limit($document->short_description, 70, '...')); ?>
									</div>
									<div class="tab_btn">
									<a href="" class="cta_org">{{ $data['most_popular_btn_text'] ?? '' }}</a>
									</div>
								</div>
							</div>
						</div>
						@endif
						@endif
					@endforeach
					@endif
					</div>
				</div>
			</div>

		</div>
	</div>
</section>

    <!------------------------------ tabs section end  ------------------------------------ -->

<section class="Comienza_sec dark">
	<div class="container">
		<div class="Comienza_bg" style="background-color: #012555;">
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
						<a href="{{ $data['bottom_button_link'] ?? '' }}" class="">{{ $data['bottom_button_label'] ?? '' }}</a>
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
				<div class="col-lg-3">
					<div class="in_box_cate">
						<div class="in_img_cate">
							<img src="{{ asset('storage/'.$category->homeCategory->media->file_name ?? '' ) }}" alt="">
						</div>
						<div class="in_cate_content">
							<h6>{{ $category->homeCategory->heading ?? '' }}</h6>
							<p class="in_cate_para">
								{{ $category->homeCategory->category_description ?? '' }}
							</p>

						</div>
						<div class="cata_btn">
							<a href="" class="cta_org">{{ $data['category_btn_text'] ?? '' }}  <img src="{{ asset('storage/'.$data['category_btn_arrow_img'] ?? '' ) }}" alt=""></a>
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
					<button class="prev-btn"><img src="{{ asset('storage/'.$data['review_left_arrow'] ?? '' ) }}" alt=""></button>
					<button class="next-btn"><img src="{{ asset('storage/'.$data['review_right_arrow'] ?? '' ) }}" alt=""></button>
				</div>
			</div>
			<div class="col-md-8">
				<div class="client-slider slick-list">
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

<script>
	$(document).ready(function(){
		$('.most_popular_btn').on('click',function(){
			var data = {
				id: $(this).data('id'),
				_token: "{{ csrf_token() }}"
			}
			$.ajax({
				url: "{{ url('/getCategoryDocument') }}",
				type: "post",
				data: data,
				dataType: "json",
				success: function(response){
					console.log(response);
				}
			})
			
		})
	})
</script>

@endsection

          