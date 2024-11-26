@php 
				$setting = App\Models\Setting::where('key', 'footer_logo')->first();
	$path = str_replace('public/', '', $setting->file_path ?? null);
@endphp

<footer>
	<div class="outer_foot_bg dark">
		<div class="container">
			<div class="in1_foot">
				<div class="row">
					<div class="col-lg-3">
						<div class="fot_logo">
							<a href="{{ url('/') }}">
								<img src="{{ asset('storage/' . $path) }}" alt="">
							</a>
							<p class="logo-text">Líder en documentos legales <br> por más de 5 años</p>
						</div>
					</div>
					<div class="col-lg-2">
						<div class="foot_sec">
							<div class="foot_h">
								<h5>
									Documentos
								</h5>
							</div>
							<ul class="foot_ul">
								<li class="foot_li"> <a href="">Negocios y Comercio</a></li>
								<li class="foot_li"><a href="">Vida Personal </a></li>
								<li class="foot_li"><a href="">Laboral y Cumplimiento </a></li>
								<li class="foot_li"><a href="">Tecnología y Consumo</a></li>
							</ul>
						</div>
					</div>
					<div class="col-lg-2">
						<div class="foot_sec">
							<div class="foot_h">
								<h5>
									Información
								</h5>
							</div>
							<ul class="foot_ul">
								<li class="foot_li"><a href="{{ url('/sobre-nosotros') }}">Quiénes Somos</a></li>
								<li class="foot_li"><a href="{{ url('/precios') }}">Precios </a></li>
								<li class="foot_li"><a href="{{ url('/contacto') }}">Contacto </a></li>
							</ul>
						</div>
					</div>
					<div class="col-lg-2">
						<div class="foot_sec">
							<div class="foot_h">
								<h5>
									Ayuda
								</h5>
							</div>
							<ul class="foot_ul">
								<li class="foot_li"><a href="{{ url('/centro-de-ayuda') }}">Centro de Ayuda </a></li>
								<li class="foot_li"> <a href="{{ url('/asi-funciona') }}">Así funciona </a></li>
								<li class="foot_li"><a href="{{ url('/preguntas-frecuentes') }}">Preguntas Frecuentes
									</a></li>
							</ul>
						</div>
					</div>
					<div class="col-lg-2">
						<div class="foot_sec">
							<div class="foot_h">
								<h5>
									Legal
								</h5>
							</div>
							<ul class="foot_ul">
								<li class="foot_li"> <a href="{{ url('/terminus-y-condiciones') }}">Términos y
										Condiciones </a></li>
								<li class="foot_li"><a href="">Aviso de Privacidad</a></li>
								<li class="foot_li"><a href="">Aviso Legal </a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<div class="foot_end_box">
				<div class="reserve_box">
					Copyright © 2020-2024 Legalio. Todos los derechos reservados.
				</div>
				<div class="reserve_box">
					<div class="select-menu active">
						<div class="select-btn ">
							<button class="sBtn-text">México - Español</button>
							<i class="fa fa-chevron-down"></i>
						</div>

						<div class="cus_dropdown_menu options">
							<div class="container">
								<h2>Choose your Country/Region</h2>
								<div class="cus_m_wrapper mst-ly-cnt">


									<a class="cus_dropdown-item " href="">Spain
										- Spanish</a>
									<a class="cus_dropdown-item " href="">Australia - English</a>
									<a class="cus_dropdown-item " href="">Brasil - Português</a>
									<a class="cus_dropdown-item " href="">Canada - English</a>
									<a class="cus_dropdown-item " href="">Canada - Français</a>
									<a class="cus_dropdown-item " href="">Colombia - Español</a>
									<a class="cus_dropdown-item " href="">Deutschland - Deutsch</a>
									<a class="cus_dropdown-item " href="">España - Español</a>
									<a class="cus_dropdown-item " href="">Estados Unidos - Español</a>
									<a class="cus_dropdown-item " href="">France - Français</a>
									<a class="cus_dropdown-item " href="">Hong Kong - English</a>
									<a class="cus_dropdown-item " href="">India - English</a>
									<a class="cus_dropdown-item " href="">Ireland - English</a>
									<a class="cus_dropdown-item " href="">Israel - English</a>
									<a class="cus_dropdown-item " href="">Svizzera - Italiano</a>
									<a class="cus_dropdown-item " href="">Malaysia - English</a>
									<a class="cus_dropdown-item " href="">Mexico - Spanish</a>
									<a class="cus_dropdown-item " href="">New Zealand - English</a>
									<a class="cus_dropdown-item " href="">Österreich - Deutsch</a>
									<a class="cus_dropdown-item " href="">Pakistan - English</a>
									<a class="cus_dropdown-item " href="">Perú - Español</a>
									<a class="cus_dropdown-item " href="">Philippines - English</a>
									<a class="cus_dropdown-item " href="">Polska - Polski</a>
									<a class="cus_dropdown-item " href="">Portuguese - Portugal</a>
									<a class="cus_dropdown-item " href="">Schweiz - Deutsch</a>
									<a class="cus_dropdown-item " href="">Singapore - English</a>
									<a class="cus_dropdown-item " href="">South Africa - English</a>
									<a class="cus_dropdown-item " href="">Suisse - Français</a>
									<a class="cus_dropdown-item " href="">Türkiye - Türkçe</a>
									<a class="cus_dropdown-item " href="">United Arab Emirates -
										English</a>
									<a class="cus_dropdown-item " href="">United Kingdom - English</a>
									<a class="cus_dropdown-item  selected " href="">United States - English</a>
									<a class="cus_dropdown-item " href="">Venezuela - Español</a>
								</div>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>
</footer>