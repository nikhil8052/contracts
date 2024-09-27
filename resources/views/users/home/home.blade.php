@extends('users_layout.master')
@section('content')

<section class="banner_sec dark" style="background-image: url({{ asset('assets/img/banner-img.png') }});">
	<div class="container">
		<div class="row align-items-center">
			<div class="col-md-7">
				<div class="banner_content">
					<h1>Crea Contratos y documentos legales en minutos</h1>
				</div>
				<div class="search_bar">
					<div class="wrap">
						<div class="search">
							<input type="text" class="searchTerm"
								placeholder="Nombre del documento ej. Contrato de Trabajo">
							<button type="submit" class="searchButton">
								Empezar
							</button>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-5">
				<div class="banner_img">
					<img src="{{ asset('assets/img/col_banner.png') }}" alt="">
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
				<h2 class="doc_h">Documentos más populares</h2>
			</div>
		</div>
	</div>
        <!-- tab1 ///////////////////////////////////////////////////////////////////////////// -->
	<div class="container ">
		<div class="wrapper">
			<div class="tab">
				<div class="btn active">Negocios y Comercio </div>
				<div class="btn">Vida Personal</div>
				<div class="btn">Laboral y Cumplimiento</div>
				<div class="btn">Tecnología y Consumo</div>
			</div>

			<div class="tabContentWrap">
				<!-- tab1 ///////////////////////////////////////////// -->
				<div class="tabContent show tab_box_sec">
					<div class="slider">
						<div class="inside_box_b">
							<div class="inside_box_tab">
								<div class="img_tab_sec">
									<img src="{{ asset('assets/img/tab1_img.png') }}" alt="">
								</div>
								<div class="cont_tab_ot">
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
									<div class="tab_btn">
									<a href="" class="cta_org">Crear ahora</a>
									</div>
								</div>
							</div>
						</div>
						<div class="inside_box_b">
							<div class="inside_box_tab">
								<div class="img_tab_sec">
									<img src="{{ asset('assets/img/tab1_img.png') }}" alt="">
								</div>
								<div class="cont_tab_ot">
									<div class="tab_text">
										<h5 class=" size20">
											Carta de Recomendación Labora
										</h5>
										<ul class="tab_ul">
											<li> <img src="{{ asset('assets/img/stars.png') }}" alt=""></li>
											<li>4.8</li>
										</ul>
									</div>
									<div class="tab_2text light">
									La Carta de Recomendación Laboral es un documento que evidencia el desempeño
									y las..
									</div>
									<div class="tab_btn">
									<a href="" class="cta_org">Crear ahora</a>
									</div>
								</div>
							</div>
						</div>
						<div class="inside_box_b">
							<div class="inside_box_tab">
								<div class="img_tab_sec">
									<img src="{{ asset('assets/img/tab1_img.png') }}" alt="">
								</div>
								<div class="cont_tab_ot">
									<div class="tab_text">
										<h5 class=" size20">
											Carta de Renuncia Voluntaria
										</h5>
										<ul class="tab_ul">
											<li> <img src="{{ asset('assets/img/stars.png') }}" alt=""></li>
											<li>4.8</li>
										</ul>
									</div>
									<div class="tab_2text light">
									La Carta de Renuncia Voluntaria es un documento que formaliza la decisión de
									un empleado..
									</div>
									<div class="tab_btn">
									<a href="" class="cta_org">Crear ahora</a>
									</div>
								</div>
							</div>
						</div>
						<div class="inside_box_b">
							<div class="inside_box_tab">
								<div class="img_tab_sec">
									<img src="{{ asset('assets/img/tab1_img.png') }}" alt="">
								</div>
								<div class="cont_tab_ot">
									<div class="tab_text">
										<h5 class=" size20">
											Contrato de Comisión Mercantil
										</h5>
										<ul class="tab_ul">
											<li> <img src="{{ asset('assets/img/stars.png') }}" alt=""></li>
											<li>4.9</li>
										</ul>
									</div>
									<div class="tab_2text light">
									El Contrato de Comisión Mercantil es un acuerdo en el que un comitente
									delega a
									un..
									</div>
									<div class="tab_btn">
									<a href="" class="cta_org">Crear ahora</a>
									</div>
								</div>
							</div>
						</div>
						<div class="inside_box_b">
							<div class="inside_box_tab">
								<div class="img_tab_sec">
									<img src="{{ asset('assets/img/tab1_img.png') }}" alt="">
								</div>
								<div class="cont_tab_ot">
									<div class="tab_text">
										<h5 class=" size20">
											Contrato de Comisión Mercantil
										</h5>
										<ul class="tab_ul">
											<li> <img src="{{ asset('assets/img/stars.png') }}" alt=""></li>
											<li>4.9</li>
										</ul>
									</div>
									<div class="tab_2text light">
									El Contrato de Comisión Mercantil es un acuerdo en el que un comitente
									delega a
									un..
									</div>
									<div class="tab_btn">
									<a href="" class="cta_org">Crear ahora</a>
									</div>
								</div>
							</div>
						</div>
						<div class="inside_box_b">
							<div class="inside_box_tab">
								<div class="img_tab_sec">
									<img src="{{ asset('assets/img/tab1_img.png') }}" alt="">
								</div>
								<div class="cont_tab_ot">
									<div class="tab_text">
										<h5 class=" size20">
											Carta de Recomendación Labora
										</h5>
										<ul class="tab_ul">
											<li> <img src="{{ asset('assets/img/stars.png') }}" alt=""></li>
											<li>4.8</li>
										</ul>
									</div>
									<div class="tab_2text light">
										La Carta de Recomendación Laboral es un documento que evidencia el desempeño
										y las..
									</div>
									<div class="tab_btn">
										<a href="" class="cta_org">Crear ahora</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<!-- tab2//////////////////////////////////////////////////////////////////// -->

				<div class="tabContent">
					<div class="slider">
						<div class="inside_box_b">
							<div class="inside_box_tab">
								<div class="img_tab_sec">
									<img src="{{ asset('assets/img/tab1_img.png') }}" alt="">
								</div>
								<div class="cont_tab_ot">
									<div class="tab_text">
										<h5 class=" size20">
											Carta de Recomendación Labora
										</h5>
										<ul class="tab_ul">
											<li> <img src="{{ asset('assets/img/stars.png') }}" alt=""></li>
											<li>4.8</li>
										</ul>
									</div>
									<div class="tab_2text light">
										La Carta de Recomendación Laboral es un documento que evidencia el desempeño
										y las..
									</div>
									<div class="tab_btn">
										<a href="" class="cta_org">Crear ahora</a>
									</div>
								</div>
							</div>
						</div>
						<div class="inside_box_b">
							<div class="inside_box_tab">
								<div class="img_tab_sec">
									<img src="{{ asset('assets/img/tab1_img.png') }}" alt="">
								</div>
								<div class="cont_tab_ot">
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
									<div class="tab_btn">
										<a href="" class="cta_org">Crear ahora</a>
									</div>
								</div>
							</div>
						</div>
						
						<div class="inside_box_b">
							<div class="inside_box_tab">
								<div class="img_tab_sec">
									<img src="{{ asset('assets/img/tab1_img.png') }}" alt="">
								</div>
								<div class="cont_tab_ot">
									<div class="tab_text">
										<h5 class=" size20">
											Contrato de Comisión Mercantil
										</h5>
										<ul class="tab_ul">
											<li> <img src="{{ asset('assets/img/stars.png') }}" alt=""></li>
											<li>4.9</li>
										</ul>
									</div>
									<div class="tab_2text light">
										El Contrato de Comisión Mercantil es un acuerdo en el que un comitente
										delega a
										un..
									</div>
									<div class="tab_btn">
										<a href="" class="cta_org">Crear ahora</a>
									</div>
								</div>
							</div>
						</div>
						<div class="inside_box_b">
							<div class="inside_box_tab">
								<div class="img_tab_sec">
									<img src="{{ asset('assets/img/tab1_img.png') }}" alt="">
								</div>
								<div class="cont_tab_ot">
									<div class="tab_text">
										<h5 class=" size20">
											Carta de Renuncia Voluntaria
										</h5>
										<ul class="tab_ul">
											<li> <img src="{{ asset('assets/img/stars.png') }}" alt=""></li>
											<li>4.8</li>
										</ul>
									</div>
									<div class="tab_2text light">
									La Carta de Renuncia Voluntaria es un documento que formaliza la decisión de
									un empleado..
									</div>
									<div class="tab_btn">
									<a href="" class="cta_org">Crear ahora</a>
									</div>
								</div>
							</div>
						</div>
						
						<div class="inside_box_b">
							<div class="inside_box_tab">
								<div class="img_tab_sec">
									<img src="{{ asset('assets/img/tab1_img.png') }}" alt="">
								</div>
								<div class="cont_tab_ot">
									<div class="tab_text">
										<h5 class=" size20">
											Contrato de Comisión Mercantil
										</h5>
										<ul class="tab_ul">
											<li> <img src="{{ asset('assets/img/stars.png') }}" alt=""></li>
											<li>4.9</li>
										</ul>
									</div>
									<div class="tab_2text light">
									El Contrato de Comisión Mercantil es un acuerdo en el que un comitente
									delega a
									un..
									</div>
									<div class="tab_btn">
									<a href="" class="cta_org">Crear ahora</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

					<!-- tab3/////////////////////////////////////////////////////////////// -->

				<div class="tabContent">
					<div class="slider">
						<div class="inside_box_b">
							<div class="inside_box_tab">
								<div class="img_tab_sec">
									<img src="{{ asset('assets/img/tab1_img.png') }}" alt="">
								</div>
								<div class="cont_tab_ot">
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
									<div class="tab_btn">
										<a href="" class="cta_org">Crear ahora</a>
									</div>
								</div>
							</div>
						</div>
						<div class="inside_box_b">
							<div class="inside_box_tab">
								<div class="img_tab_sec">
									<img src="{{ asset('assets/img/tab1_img.png') }}" alt="">
								</div>
								<div class="cont_tab_ot">
									<div class="tab_text">
										<h5 class=" size20">
											Carta de Recomendación Labora
										</h5>
										<ul class="tab_ul">
											<li> <img src="{{ asset('assets/img/stars.png') }}" alt=""></li>
											<li>4.8</li>
										</ul>
									</div>
									<div class="tab_2text light">
										La Carta de Recomendación Laboral es un documento que evidencia el desempeño
										y las..
									</div>
									<div class="tab_btn">
										<a href="" class="cta_org">Crear ahora</a>
									</div>
								</div>
							</div>
						</div>
						<div class="inside_box_b">
							<div class="inside_box_tab">
								<div class="img_tab_sec">
									<img src="{{ asset('assets/img/tab1_img.png') }}" alt="">
								</div>
								<div class="cont_tab_ot">
									<div class="tab_text">
										<h5 class=" size20">
											Carta de Renuncia Voluntaria
										</h5>
										<ul class="tab_ul">
											<li> <img src="{{ asset('assets/img/stars.png') }}" alt=""></li>
											<li>4.8</li>
										</ul>
									</div>
									<div class="tab_2text light">
										La Carta de Renuncia Voluntaria es un documento que formaliza la decisión de
										un empleado..
									</div>
									<div class="tab_btn">
										<a href="" class="cta_org">Crear ahora</a>
									</div>
								</div>
							</div>
						</div>
						<div class="inside_box_b">
							<div class="inside_box_tab">
								<div class="img_tab_sec">
									<img src="{{ asset('assets/img/tab1_img.png') }}" alt="">
								</div>
								<div class="cont_tab_ot">
									<div class="tab_text">
										<h5 class=" size20">
											Contrato de Comisión Mercantil
										</h5>
										<ul class="tab_ul">
											<li> <img src="{{ asset('assets/img/stars.png') }}" alt=""></li>
											<li>4.9</li>
										</ul>
									</div>
									<div class="tab_2text light">
										El Contrato de Comisión Mercantil es un acuerdo en el que un comitente
										delega a
										un..
									</div>
									<div class="tab_btn">
										<a href="" class="cta_org">Crear ahora</a>
									</div>
								</div>
							</div>
						</div>
						<div class="inside_box_b">
							<div class="inside_box_tab">
								<div class="img_tab_sec">
									<img src="{{ asset('assets/img/tab1_img.png') }}" alt="">
								</div>
								<div class="cont_tab_ot">
									<div class="tab_text">
										<h5 class=" size20">
											Contrato de Comisión Mercantil
										</h5>
										<ul class="tab_ul">
											<li> <img src="{{ asset('assets/img/stars.png') }}" alt=""></li>
											<li>4.9</li>
										</ul>
									</div>
									<div class="tab_2text light">
										El Contrato de Comisión Mercantil es un acuerdo en el que un comitente
										delega a
										un..
									</div>
									<div class="tab_btn">
										<a href="" class="cta_org">Crear ahora</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

					<!-- tab4/////////////////////////////////////////////////////////////// -->

				<div class="tabContent">
					<div class="slider">
						<div class="inside_box_b">
							<div class="inside_box_tab">
								<div class="img_tab_sec">
									<img src="{{ asset('assets/img/tab1_img.png') }}" alt="">
								</div>
								<div class="cont_tab_ot">
									<div class="tab_text">
										<h5 class=" size20">
											Carta de Recomendación Labora
										</h5>
										<ul class="tab_ul">
											<li> <img src="{{ asset('assets/img/stars.png') }}" alt=""></li>
											<li>4.8</li>
										</ul>
									</div>
									<div class="tab_2text light">
										La Carta de Recomendación Laboral es un documento que evidencia el desempeño
										y las..
									</div>
									<div class="tab_btn">
										<a href="" class="cta_org">Crear ahora</a>
									</div>
								</div>
							</div>
						</div>
						<div class="inside_box_b">
							<div class="inside_box_tab">
								<div class="img_tab_sec">
									<img src="{{ asset('assets/img/tab1_img.png') }}" alt="">
								</div>
								<div class="cont_tab_ot">
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
									<div class="tab_btn">
										<a href="" class="cta_org">Crear ahora</a>
									</div>
								</div>
							</div>
						</div>
						
						<div class="inside_box_b">
							<div class="inside_box_tab">
								<div class="img_tab_sec">
									<img src="{{ asset('assets/img/tab1_img.png') }}" alt="">
								</div>
								<div class="cont_tab_ot">
									<div class="tab_text">
										<h5 class=" size20">
											Contrato de Comisión Mercantil
										</h5>
										<ul class="tab_ul">
											<li> <img src="{{ asset('assets/img/stars.png') }}" alt=""></li>
											<li>4.9</li>
										</ul>
									</div>
									<div class="tab_2text light">
										El Contrato de Comisión Mercantil es un acuerdo en el que un comitente
										delega a
										un..
									</div>
									<div class="tab_btn">
										<a href="" class="cta_org">Crear ahora</a>
									</div>
								</div>
							</div>
						</div>
						<div class="inside_box_b">
							<div class="inside_box_tab">
								<div class="img_tab_sec">
									<img src="{{ asset('assets/img/tab1_img.png') }}" alt="">
								</div>
								<div class="cont_tab_ot">
									<div class="tab_text">
										<h5 class=" size20">
											Carta de Renuncia Voluntaria
										</h5>
										<ul class="tab_ul">
											<li> <img src="{{ asset('assets/img/stars.png') }}" alt=""></li>
											<li>4.8</li>
										</ul>
									</div>
									<div class="tab_2text light">
										La Carta de Renuncia Voluntaria es un documento que formaliza la decisión de
										un empleado..
									</div>
									<div class="tab_btn">
										<a href="" class="cta_org">Crear ahora</a>
									</div>
								</div>
							</div>
						</div>
						<div class="inside_box_b">
							<div class="inside_box_tab">
								<div class="img_tab_sec">
									<img src="{{ asset('assets/img/tab1_img.png') }}" alt="">
								</div>
								<div class="cont_tab_ot">
									<div class="tab_text">
										<h5 class=" size20">
											Contrato de Comisión Mercantil
										</h5>
										<ul class="tab_ul">
											<li> <img src="{{ asset('assets/img/stars.png') }}" alt=""></li>
											<li>4.9</li>
										</ul>
									</div>
									<div class="tab_2text light">
										El Contrato de Comisión Mercantil es un acuerdo en el que un comitente
										delega a
										un..
									</div>
									<div class="tab_btn">
										<a href="" class="cta_org">Crear ahora</a>
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

    <!------------------------------ tabs section end  ------------------------------------ -->

<section class="Comienza_sec dark">
	<div class="container">
		<div class="Comienza_bg" style="background-color: #012555;">
			<div class="row align-items-center">
				<div class="col-md-6">
					<div class="Comienza-img">
						<img src="{{ asset('assets/img/Comienza-img.png') }}" alt="">
					</div>
				</div>
				<div class="col-md-6">
					<div class="Comienza-content">
						<h2>Comienza a crear Documentos Legales Personalizados</h2>
						<p>Lorem Ipsum es simplemente un texto de relleno de la industria de la impresión y la
							tipografía. Lorem Ipsum ha sido el texto de relleno estándar de la industria desde el
							siglo XVI, cuando un impresor desconocido tomó una galería de tipos y los mezcló</p>
						<a href="" class="">Comienza ahora</a>
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
						Categorías principales
					</h2>
				</div>
			</div>
		</div>
		<div class="container">
			<div class="row">
				<div class="col-lg-3">
					<div class="in_box_cate">
						<div class="in_img_cate">
							<img src="{{ asset('assets/img/cata1.png') }}" alt="">
						</div>
						<div class="in_cate_content">
							<h6>Negocios y Comercio</h6>
							<p class="in_cate_para">
								Lorem Ipsum es simplemente un texto de relleno de la industria de la impresión y la
								tipografía. Lorem Ipsum ha sido el texto de relleno estándar de la industria.
							</p>

						</div>
						<div class="cata_btn">
							<a href="" class="cta_org">Ver documentos  <img src="{{ asset('assets/img/right_arrow_btn.png') }}" alt=""></a>
						</div>
					</div>
				</div>
				<div class="col-lg-3">
					<div class="in_box_cate">
						<div class="in_img_cate">
							<img src="{{ asset('assets/img/cata2.png') }}" alt="">
						</div>
						<div class="in_cate_content">
							<h6>Vida Personal</h6>
							<p class="in_cate_para">
								Lorem Ipsum es simplemente un texto de relleno de la industria de la impresión y la
								tipografía. Lorem Ipsum ha sido el texto de relleno estándar de la industria.
							</p>
						</div>
						<div class="cata_btn">
							<a href="" class="cta_org">Ver documentos  <img src="{{ asset('assets/img/right_arrow_btn.png') }}" alt=""></a>
						</div>
					</div>
				</div>
				<div class="col-lg-3">
					<div class="in_box_cate">
						<div class="in_img_cate">
							<img src="{{ asset('assets/img/cata3.png') }}" alt="">
						</div>
						<div class="in_cate_content">
							<h6>Laboral y Cumplimiento</h6>
							<p class="in_cate_para">
								Lorem Ipsum es simplemente un texto de relleno de la industria de la impresión y la
								tipografía. Lorem Ipsum ha sido el texto de relleno estándar de la industria.
							</p>
						</div>
						<div class="cata_btn">
							<a href="" class="cta_org">Ver documentos   <img src="{{ asset('assets/img/right_arrow_btn.png') }}" alt=""></a>
						</div>
					</div>
				</div>
				<div class="col-lg-3">
					<div class="in_box_cate">
						<div class="in_img_cate">
							<img src="{{ asset('assets/img/cata4.png') }}" alt="">
						</div>
						<div class="in_cate_content">
							<h6>Tecnología y Consumo</h6>
							<p class="in_cate_para">
								Lorem Ipsum es simplemente un texto de relleno de la industria de la impresión y la
								tipografía. Lorem Ipsum ha sido el texto de relleno estándar de la industria.
							</p>
						</div>
						<div class="cata_btn">
							<a href="" class="cta_org">Ver documentos  <img src="{{ asset('assets/img/right_arrow_btn.png') }}" alt=""></a>
						</div>
					</div>
				</div>
			</div>
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
							<h3>Únete y crea tus documentos en minutos</h3>

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
					<h2>Lo que dicen nuestros clientes</h2>
					<p>Valoramos tu opinión - Así nos califican nuestros clientes.</p>
				</div>
				<div class="btn-wrap">
					<button class="prev-btn"><img src="{{ asset('assets/img/left-arrow.png') }}" alt=""></button>
					<button class="next-btn"><img src="{{ asset('assets/img/right-arrow.png') }}" alt=""></button>
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

@endsection

          