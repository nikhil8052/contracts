@extends('users_layout.master')
@section('content')

<div class="mobile_header_side_bar">
	<div class="header_sidebar_inner">
		<div class="sidebar_empty_space"></div>
		<div class="sidebar_header_content">
			<div class="sidebar_header_nav">
				<div class="header_search_form">
					<form id="header_search_form" method="POST" action="https://documentos-legales.mx/contratos-documentos-legales/" autocomplete="off">
						<input type="text" class="form-control" name="search" placeholder="Buscar" />
						<button class="mobilesearch-btn" type="submit">
							<i class="fa-solid fa-magnifying-glass"></i>
						</button>
					</form>
				</div>
				<ul class="_Ty8L2" data-qa="SidebarMenuList">
					<li><a href="https://documentos-legales.mx/arrendamiento/">Arrendamiento</a></li>
					<li><a href="https://documentos-legales.mx/comercio/">Comercio</a></li>
					<li><a href="https://documentos-legales.mx/consumo/">Consumo</a></li>
					<li><a href="https://documentos-legales.mx/familia/">Familia</a></li>
					<li><a href="https://documentos-legales.mx/internet/">Internet</a></li>
					<li><a href="https://documentos-legales.mx/laboral/">Laboral</a></li>
					<li><a href="https://documentos-legales.mx/vida-diaria/">Vida diaria</a></li>
				</ul>

				<ul class="_Ty8L3" data-qa="SidebarMenuList">
					<li><a href="https://documentos-legales.mx/asi-funciona/">Así funciona</a></li>
					<li><a href="https://documentos-legales.mx/preguntas-frecuentes/">Preguntas</a></li>
				</ul>

				<div class="mobile_header_buuton">
					<a class="cta" href="https://documentos-legales.mx/contratos-documentos-legales/">Crear documento</a>
				</div>
			</div>
		</div>
	</div>
	<div role="button" class="_GtzsW _Gv2_B">
		<div class="_NRBhu"></div>
	</div>
	<div class="__z_48"></div>
</div>
<div class="mobile_header_side_bar_right">
	<div class="header_sidebar_inner">
		<div class="sidebar_empty_space"></div>
		<div class="sidebar_header_content">
			<div class="sidebar_header_nav">
				<div class="header_right_sidebar_content">
					<div>
						<p class="logged-in">¡Bienvenido!</p>
						<div class="mobile_right_header_button loggedin">
							<a href="https://documentos-legales.mx/mi-cuenta" class="cta login">Mis documentos</a>
							<a href="https://documentos-legales.mx/mi-cuenta/configuracion/" class="cta register">Configuración</a>
							<a href="https://documentos-legales.mx/wp-login.php?action=logout&amp;redirect_to=https%3A%2F%2Fdocumentos-legales.mx&amp;_wpnonce=f67ee7e251" class="cta login">Cerrar session</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div role="button" class="_GtzsW _Gv2_B _zNNE6"><div class="_NRBhu"></div></div>
	<div class="__z_48"></div>
</div>

<div class="wn_hght">
	<section class="banner-sec" style="background-image: url('https://documentos-legales.mx/wp-content/uploads/2024/05/banner-bg-1.svg');">
		<div class="container">
			<div class="row">
				<div class="col-md-6">
					<div class="banner-text">
						<div class="banner-head">
						<h1>Crea tus Contratos y Documentos Legales en minutos</h1>
						</div>

						<div class="row">
							<div class="search-container-doc">
								<form id="searchDocx" action="">
									<input type="text" id="search_name_doc_id" name="search_name_doc" placeholder="Buscar contrato o documento" />

									<button type="submit" id="searchIcon" aria-label="Name"><i class="fa fa-search"></i></button>
								</form>
								<button id="searchClear" style="display: none;"><i class="fa fa-times"></i></button>
								<div class="spinner-border" role="status" style="display: none;">
									<span class="sr-only">Loading...</span>
								</div>
							</div>
							<div class="srch_main_content">
								<ul class="suggestions_doc" id="suggestions_doc_id" style="display: none;"></ul>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-6 banner-col">
					<div class="banner-img">
						<img src="https://documentos-legales.mx/wp-content/uploads/2024/06/banner-image.svg" alt="home banner document image" height="200" width="500" />
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="home document-sec pt-0" style="padding-bottom: 20px;">
	<div class="container">
		<div class="selected-doc-text-content">
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12">
					<div class="">
					<div class="select-doc-text_1">
						<div class="doc-head">
							<h2>Más Populares</h2>
						</div>

						<div class="row home-docs">
							<div class="col-md-3 maincol3">
								<div class="doc-content">
									<a href="https://documentos-legales.mx/carta-poder/" class="doc-box">
									<div class="doc-img"><img src="https://documentos-legales.mx/wp-content/uploads/2023/09/carta-poder.svg" alt="documentos-legales-docx" height="200" width="170" /></div>
									<div class="doc-text">
										<p>Carta Poder</p>
									</div>
									</a>
									<div class="doc-footer">
									<div class="foot-wrapper">
										<div class="str-rate">
											<p class="review-rating" data-current_rating="4.8">
												<span class="rating-on rate-1" data-rating="1"></span><span class="rating-on rate-2" data-rating="2"></span><span class="rating-on rate-3" data-rating="3"></span>
												<span class="rating-on rate-4" data-rating="4"></span><span class="rating-on rate-5" data-rating="5"></span>
											</p>
											4.8
										</div>
										<div class="download-btn">
											<a href="https://documentos-legales.mx/cdl/carta-poder">
												<img src="https://documentos-legales.mx/wp-content/themes/econtract/assets/images/Union.svg" alt="Docx-image" />
											</a>
										</div>
									</div>
									</div>
								</div>
							</div>
							<div class="col-md-3 maincol3">
								<div class="doc-content">
									<a href="https://documentos-legales.mx/contrato-de-arrendamiento-casa-habitacion/" class="doc-box">
									<div class="doc-img">
										<img src="https://documentos-legales.mx/wp-content/uploads/2023/02/contrato-arrendamiento-casa-habitacion.svg" alt="documentos-legales-docx" height="200" width="170" />
									</div>
									<div class="doc-text">
										<p>Contrato de Arrendamiento Casa Habitación</p>
									</div>
									</a>
									<div class="doc-footer">
									<div class="foot-wrapper">
										<div class="str-rate">
											<p class="review-rating" data-current_rating="4.9">
												<span class="rating-on rate-1" data-rating="1"></span><span class="rating-on rate-2" data-rating="2"></span><span class="rating-on rate-3" data-rating="3"></span>
												<span class="rating-on rate-4" data-rating="4"></span><span class="rating-on rate-5" data-rating="5"></span>
											</p>
											4.9
										</div>
										<div class="download-btn">
											<a href="https://documentos-legales.mx/cdl/contrato-de-arrendamiento-casa-habitacion">
												<img src="https://documentos-legales.mx/wp-content/themes/econtract/assets/images/Union.svg" alt="Docx-image" />
											</a>
										</div>
									</div>
									</div>
								</div>
							</div>
							<div class="col-md-3 maincol3">
								<div class="doc-content">
									<a href="https://documentos-legales.mx/contrato-de-compraventa-de-automovil/" class="doc-box">
									<div class="doc-img">
										<img src="https://documentos-legales.mx/wp-content/uploads/2023/03/contrato-compraventa-automovil-2.svg" alt="documentos-legales-docx" height="200" width="170" />
									</div>
									<div class="doc-text">
										<p>Contrato de Compraventa de Automóvil</p>
									</div>
									</a>
									<div class="doc-footer">
									<div class="foot-wrapper">
										<div class="str-rate">
											<p class="review-rating" data-current_rating="4.8">
												<span class="rating-on rate-1" data-rating="1"></span><span class="rating-on rate-2" data-rating="2"></span><span class="rating-on rate-3" data-rating="3"></span>
												<span class="rating-on rate-4" data-rating="4"></span><span class="rating-on rate-5" data-rating="5"></span>
											</p>
											4.8
										</div>
										<div class="download-btn">
											<a href="https://documentos-legales.mx/cdl/contrato-de-compraventa-de-automovil">
												<img src="https://documentos-legales.mx/wp-content/themes/econtract/assets/images/Union.svg" alt="Docx-image" />
											</a>
										</div>
									</div>
									</div>
								</div>
							</div>
							<div class="col-md-3 maincol3">
								<div class="doc-content">
									<a href="https://documentos-legales.mx/contrato-de-trabajo/" class="doc-box">
									<div class="doc-img"><img src="https://documentos-legales.mx/wp-content/uploads/2023/05/Contrato-de-Trabajo.svg" alt="documentos-legales-docx" height="200" width="170" /></div>
									<div class="doc-text">
										<p>Contrato de Trabajo</p>
									</div>
									</a>
									<div class="doc-footer">
									<div class="foot-wrapper">
										<div class="str-rate">
											<p class="review-rating" data-current_rating="4.7">
												<span class="rating-on rate-1" data-rating="1"></span><span class="rating-on rate-2" data-rating="2"></span><span class="rating-on rate-3" data-rating="3"></span>
												<span class="rating-on rate-4" data-rating="4"></span><span class="rating-off rate-half" data-rating="5"></span>
											</p>
											4.7
										</div>
										<div class="download-btn">
											<a href="https://documentos-legales.mx/cdl/contrato-de-trabajo">
												<img src="https://documentos-legales.mx/wp-content/themes/econtract/assets/images/Union.svg" alt="Docx-image" />
											</a>
										</div>
									</div>
									</div>
								</div>
							</div>
							<div class="col-md-3 maincol3">
								<div class="doc-content">
									<a href="https://documentos-legales.mx/contrato-de-prestacion-de-servicios/" class="doc-box">
									<div class="doc-img"><img src="https://documentos-legales.mx/wp-content/uploads/2023/05/Prestacion-de-Servicios.svg" alt="documentos-legales-docx" height="200" width="170" /></div>
									<div class="doc-text">
										<p>Contrato de Prestación de Servicios</p>
									</div>
									</a>
									<div class="doc-footer">
									<div class="foot-wrapper">
										<div class="str-rate">
											<p class="review-rating" data-current_rating="4.9">
												<span class="rating-on rate-1" data-rating="1"></span><span class="rating-on rate-2" data-rating="2"></span><span class="rating-on rate-3" data-rating="3"></span>
												<span class="rating-on rate-4" data-rating="4"></span><span class="rating-on rate-5" data-rating="5"></span>
											</p>
											4.9
										</div>
										<div class="download-btn">
											<a href="https://documentos-legales.mx/cdl/contrato-de-prestacion-de-servicios">
												<img src="https://documentos-legales.mx/wp-content/themes/econtract/assets/images/Union.svg" alt="Docx-image" />
											</a>
										</div>
									</div>
									</div>
								</div>
							</div>
							<div class="col-md-3 maincol3">
								<div class="doc-content">
									<a href="https://documentos-legales.mx/contrato-de-comodato-prestamo-de-bienes/" class="doc-box">
										<div class="doc-img"><img src="https://documentos-legales.mx/wp-content/uploads/2023/07/Prestamo-de-Bienes-1.svg" alt="documentos-legales-docx" height="200" width="170" /></div>
										<div class="doc-text">
											<p>Contrato de Préstamo de Bienes</p>
										</div>
									</a>
									<div class="doc-footer">
										<div class="foot-wrapper">
											<div class="str-rate">
												<p class="review-rating" data-current_rating="4.9">
													<span class="rating-on rate-1" data-rating="1"></span><span class="rating-on rate-2" data-rating="2"></span><span class="rating-on rate-3" data-rating="3"></span>
													<span class="rating-on rate-4" data-rating="4"></span><span class="rating-on rate-5" data-rating="5"></span>
												</p>
												4.9
											</div>
											<div class="download-btn">
												<a href="https://documentos-legales.mx/cdl/contrato-de-comodato-prestamo-de-bienes">
													<img src="https://documentos-legales.mx/wp-content/themes/econtract/assets/images/Union.svg" alt="Docx-image" />
												</a>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-3 maincol3">
								<div class="doc-content">
									<a href="https://documentos-legales.mx/contrato-de-compraventa-de-bien-inmueble/" class="doc-box">
										<div class="doc-img">
											<img src="https://documentos-legales.mx/wp-content/uploads/2023/06/Compraventa-de-Bien-Inmueble.svg" alt="documentos-legales-docx" height="200" width="170" />
										</div>
										<div class="doc-text">
											<p>Contrato de Compraventa de Bien Inmueble</p>
										</div>
									</a>
									<div class="doc-footer">
										<div class="foot-wrapper">
											<div class="str-rate">
												<p class="review-rating" data-current_rating="4.8">
													<span class="rating-on rate-1" data-rating="1"></span><span class="rating-on rate-2" data-rating="2"></span><span class="rating-on rate-3" data-rating="3"></span>
													<span class="rating-on rate-4" data-rating="4"></span><span class="rating-on rate-5" data-rating="5"></span>
												</p>
												4.8
											</div>
											<div class="download-btn">
												<a href="https://documentos-legales.mx/cdl/contrato-de-compraventa-de-bien-inmueble">
													<img src="https://documentos-legales.mx/wp-content/themes/econtract/assets/images/Union.svg" alt="Docx-image" />
												</a>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-3 maincol3">
								<div class="doc-content">
									<a href="https://documentos-legales.mx/contrato-de-mutuo-prestamo-de-dinero/" class="doc-box">
										<div class="doc-img"><img src="https://documentos-legales.mx/wp-content/uploads/2023/06/Prestamo-de-Dinero-1.svg" alt="documentos-legales-docx" height="200" width="170" /></div>
										<div class="doc-text">
											<p>Contrato de Préstamo de Dinero</p>
										</div>
									</a>
									<div class="doc-footer">
										<div class="foot-wrapper">
											<div class="str-rate">
												<p class="review-rating" data-current_rating="4.6">
													<span class="rating-on rate-1" data-rating="1"></span><span class="rating-on rate-2" data-rating="2"></span><span class="rating-on rate-3" data-rating="3"></span>
													<span class="rating-on rate-4" data-rating="4"></span><span class="rating-off rate-half" data-rating="5"></span>
												</p>
												4.6
											</div>
											<div class="download-btn">
												<a href="https://documentos-legales.mx/cdl/contrato-de-mutuo-prestamo-de-dinero">
													<img src="https://documentos-legales.mx/wp-content/themes/econtract/assets/images/Union.svg" alt="Docx-image" />
												</a>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-3 maincol3">
								<div class="doc-content">
									<a href="https://documentos-legales.mx/formato-pagare/" class="doc-box">
									<div class="doc-img"><img src="https://documentos-legales.mx/wp-content/uploads/2023/06/Pagare.svg" alt="documentos-legales-docx" height="200" width="170" /></div>
									<div class="doc-text">
										<p>Formato Pagaré</p>
									</div>
									</a>
									<div class="doc-footer">
									<div class="foot-wrapper">
										<div class="str-rate">
											<p class="review-rating" data-current_rating="4.7">
												<span class="rating-on rate-1" data-rating="1"></span><span class="rating-on rate-2" data-rating="2"></span><span class="rating-on rate-3" data-rating="3"></span>
												<span class="rating-on rate-4" data-rating="4"></span><span class="rating-off rate-half" data-rating="5"></span>
											</p>
											4.7
										</div>
										<div class="download-btn">
											<a href="https://documentos-legales.mx/cdl/formato-pagare">
												<img src="https://documentos-legales.mx/wp-content/themes/econtract/assets/images/Union.svg" alt="Docx-image" />
											</a>
										</div>
									</div>
									</div>
								</div>
							</div>
							<div class="col-md-3 maincol3">
								<div class="doc-content">
									<a href="https://documentos-legales.mx/acuerdo-bilateral-de-confidencialidad/" class="doc-box">
									<div class="doc-img">
										<img src="https://documentos-legales.mx/wp-content/uploads/2023/08/Acuerdo-Bilateral-de-Confidencialidad-1.svg" alt="documentos-legales-docx" height="200" width="170" />
									</div>
									<div class="doc-text">
										<p>Acuerdo Bilateral de Confidencialidad</p>
									</div>
									</a>
									<div class="doc-footer">
									<div class="foot-wrapper">
										<div class="str-rate">
											<p class="review-rating" data-current_rating="4.9">
												<span class="rating-on rate-1" data-rating="1"></span><span class="rating-on rate-2" data-rating="2"></span><span class="rating-on rate-3" data-rating="3"></span>
												<span class="rating-on rate-4" data-rating="4"></span><span class="rating-on rate-5" data-rating="5"></span>
											</p>
											4.9
										</div>
										<div class="download-btn">
											<a href="https://documentos-legales.mx/cdl/acuerdo-bilateral-de-confidencialidad">
												<img src="https://documentos-legales.mx/wp-content/themes/econtract/assets/images/Union.svg" alt="Docx-image" />
											</a>
										</div>
									</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="doc-btn">
						<a href="https://documentos-legales.mx/contratos-documentos-legales/" class="cta">Todos los documentos</a>
					</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	</section>
	<section class="footer_bann_wreap p-130">
	<div class="container">
		<div class="row home_banner_cs">
			<div class="col-md-7">
				<div class="global_content">
					<h2>Comienza a crear Documentos Legales Personalizados</h2>
					<p class="bl_sec">Genera y descarga tus documentos legales en formatos PDF y DOCX (Word) al instante, de manera fácil y rápida.</p>

					<div class="start_new text-center">
					<a href="https://documentos-legales.mx/contratos-documentos-legales/" class="cta">Comienza ahora</a>
					</div>
				</div>
			</div>
			<div class="col-md-5 imgsec">
				<img src="https://documentos-legales.mx/wp-content/uploads/2024/05/doc-icon.svg" alt="Docx-image" height="300" width="600" />
			</div>
		</div>
	</div>
	</section>

	<section class="categ-sec p-130">
	<div class="container">
		<h2>Categorías</h2>
		<div class="categ-wrapper">
			<div class="categ-wrap">
				<a href="https://documentos-legales.mx/arrendamiento/">
					<div class="categ-box">
					<div class="cat-img">
						<i class="fa-solid fa-building"></i>
					</div>
					<div class="cat-text">
						<p>Arrendamiento</p>
					</div>
					</div>
				</a>
			</div>
			<div class="categ-wrap">
				<a href="https://documentos-legales.mx/comercio/">
					<div class="categ-box">
					<div class="cat-img">
						<i class="fa-solid fa-briefcase"></i>
					</div>
					<div class="cat-text">
						<p>Comercio</p>
					</div>
					</div>
				</a>
			</div>
			<div class="categ-wrap">
				<a href="https://documentos-legales.mx/compra-venta/">
					<div class="categ-box">
					<div class="cat-img">
						<i class="fa-solid fa-hand-holding-dollar"></i>
					</div>
					<div class="cat-text">
						<p>Compra-Venta</p>
					</div>
					</div>
				</a>
			</div>
			<div class="categ-wrap">
				<a href="https://documentos-legales.mx/consumo/">
					<div class="categ-box">
					<div class="cat-img">
						<i class="fas fa-sack-dollar"></i>
					</div>
					<div class="cat-text">
						<p>Consumo</p>
					</div>
					</div>
				</a>
			</div>
			<div class="categ-wrap">
				<a href="https://documentos-legales.mx/familia/">
					<div class="categ-box">
					<div class="cat-img">
						<i class="fa-solid fa-users"></i>
					</div>
					<div class="cat-text">
						<p>Familia</p>
					</div>
					</div>
				</a>
			</div>
		</div>
	</div>
	</section>
	<section class="slider-sec">
	<div class="container">
		<div class="logomax-content">
			<h2>Lo que dicen Nuestros Clientes</h2>
			<div class="star-rt-feature maindtpage"></div>
			<p>Valoramos tu opinión - Así nos califican nuestros clientes.</p>
		</div>
		<div class="slider slider-nav-review">
			<div class="cmt-sec review-slide">
				<div class="uimage_auth">
					<span class="usrav">JC</span>
					<div class="uinfo">
					<h3>Jesús Castellanos</h3>
					<p class="mp"><i class="fa-solid fa-location-dot"></i> México</p>
					</div>
				</div>
				<div class="im_str imtext">
					<div class="star_Av">
					<div class="cmt_star"><span class="fullstar"></span><span class="fullstar"></span><span class="fullstar"></span><span class="fullstar"></span><span class="fullstar"></span></div>
					<p>
						Hace 7 meses
					</p>
					</div>
					<p class="comnt_cnt">Un excelente documento, bien estructurado, fácil y práctico de llenar</p>
				</div>
			</div>
			<div class="cmt-sec review-slide">
				<div class="uimage_auth">
					<span class="usrav">JZ</span>
					<div class="uinfo">
					<h3>JORGE ZENTENO</h3>
					<p class="mp"><i class="fa-solid fa-location-dot"></i> Zacatecas zacatecas</p>
					</div>
				</div>
				<div class="im_str imtext">
					<div class="star_Av">
					<div class="cmt_star"><span class="fullstar"></span><span class="fullstar"></span><span class="fullstar"></span><span class="fullstar"></span><span class="fullstar"></span></div>
					<p>
						Hace 7 meses
					</p>
					</div>
					<p class="comnt_cnt">Rápido fácil y completo</p>
				</div>
			</div>
			<div class="cmt-sec review-slide">
				<div class="uimage_auth">
					<span class="usrav">SC</span>
					<div class="uinfo">
					<h3>Sara Cabeza</h3>
					<p class="mp"><i class="fa-solid fa-location-dot"></i> Ciudad de México</p>
					</div>
				</div>
				<div class="im_str imtext">
					<div class="star_Av">
					<div class="cmt_star"><span class="fullstar"></span><span class="fullstar"></span><span class="fullstar"></span><span class="fullstar"></span><span class="fullstar"></span></div>
					<p>
						Hace 8 meses
					</p>
					</div>
					<p class="comnt_cnt">Excelente y económico, muchísimas gracias.</p>
				</div>
			</div>
		</div>
		<div class="cstm-btn slidersec_btn">
			<a href="https://documentos-legales.mx/contratos-documentos-legales/" class="cta my-document-button-account"> Crea tu Documento </a>
		</div>
	</div>
	</section>
</div>

@endsection

          