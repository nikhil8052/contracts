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
								<img src="{{ asset('storage/'.$path) }}" alt="">
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
								<li class="foot_li"><a href="{{ url('/who-we-are') }}">Quiénes Somos</a></li>
								<li class="foot_li"><a href="{{ url('/prices') }}">Precios </a></li>
								<li class="foot_li"><a href="{{ url('/contact-us') }}">Contacto </a></li>
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
								<li class="foot_li"><a href="{{ url('/help-center') }}">Centro de Ayuda </a></li>
								<li class="foot_li"> <a href="{{ url('/how-it-works') }}">Así funciona </a></li>
								<li class="foot_li"><a href="{{ url('/faq') }}">Preguntas Frecuentes </a></li>
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
								<li class="foot_li"> <a href="{{ url('/terms-and-conditions') }}">Términos y Condiciones </a></li>
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
						<div class="select-btn">
							<span class="sBtn-text">México - Español</span>
							<i class="fa fa-chevron-down"></i>
						</div>
						<ul class="options">
							<li class="option">

								<span class="option-text">Mexico - Hindi</span>
							</li>
							<li class="option">

								<span class="option-text">Mexico - English</span>
							</li>
							<li class="option">

								<span class="option-text">Mexico - Russian</span>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</footer>

         