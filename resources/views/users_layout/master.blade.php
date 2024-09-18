<html lang="es-MX">
     <head>
          <script>
               (function(w,d,t,r,u)
               {
               var f,n,i;
               w[u]=w[u]||[],f=function()
               {
               var o={ti:"343094731", enableAutoSpaTracking: true};
               o.q=w[u],w[u]=new UET(o),w[u].push("pageLoad")
               },
               n=d.createElement(t),n.src=r,n.async=1,n.onload=n.onreadystatechange=function()
               {
               var s=this.readyState;
               s&&s!=="loaded"&&s!=="complete"||(f(),n.onload=n.onreadystatechange=null)
               },
               i=d.getElementsByTagName(t)[0],i.parentNode.insertBefore(n,i)
               })
               (window,document,"script","//bat.bing.com/bat.js","uetq");
          </script>

          <script type='text/javascript'>
               function loadCSS(e, t, n) { "use strict"; var i = window.document.createElement("link"); var o = t || window.document.getElementsByTagName("script")[0]; i.rel = "stylesheet"; i.href = e; i.media = "only x"; o.parentNode.insertBefore(i, o); setTimeout(function () { i.media = n || "all" }) }loadCSS("https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css");
          </script>
          <meta name="google" content="notranslate" />
          <meta charset="UTF-8" />
          <meta name="viewport" content="width=device-width, initial-scale=1 , shrink-to-fit=no" />
          <meta name="language" content="es-MX" />
          <link rel="profile" href="https://gmpg.org/xfn/11" />
          <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1" />

          <link rel="dns-prefetch" href="//cdn.datatables.net" />
          <link rel="dns-prefetch" href="//netdna.bootstrapcdn.com" />
          <link rel="dns-prefetch" href="//code.jquery.com" />
          <link rel="dns-prefetch" href="//cdn.jsdelivr.net" />
        
          <link rel="stylesheet" id="start_rate-css" href="{{ asset('assets/css/star_rt.css') }}" media="all" />
          <link rel="stylesheet" id="fontmon-style-cs-css-css" href="{{ asset('assets/fonts/fontmon-style.css?nocach=0.11217500+1726128914 &#038;ver=6.6.1') }}" media="all" />
          <link rel="stylesheet" id="main-style-cs-css-css" href="{{ asset('assets/css/style-new.css?nocach=0.11218400+1726128914&#038;ver=6.6.1') }}" media="all" />

          <!-- Bootstrap -->
          <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

          <!-- Toastr CSS -->
          <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
          <!-- JQuery cdn -->
          <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
          <!-- Toastr JS -->
          <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
          
          <!-- Bootstrap JS -->
          <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

          <script src="//cdn.datatables.net/1.10.11/js/jquery.dataTables.min.js?ver=6.6.1" id="data_tables_script-js"></script>
          <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js?ver=6.6.1" id="bootstrap_script-js"></script>
          <script src="https://code.jquery.com/jquery-3.6.1.min.js?ver=6.6.1" id="ajax-econtrato-js"></script>
          <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js?ver=6.6.1" id="bootstrap-js-econtrato-js"></script>
          <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js?ver=6.6.1" id="validation-econtrato-js"></script>
          
     
          <style>
               header .desk-lng_drp {
                    display: none;
               }
               header .mobile-lng_drp{
                    display: none;
               }
		</style>

          <style id=''>

               img.wp-smiley, img.emoji {
                    display: inline !important;
                    border: none !important;
                    box-shadow: none !important;
                    height: 1em !important;
                    width: 1em !important;
                    margin: 0 0.07em !important;
                    vertical-align: -0.1em !important;
                    background: none !important;
                    padding: 0 !important;
               }
          </style>
          <style id="">
               body {
                    margin-bottom: 0 !important;
               }
               .page-id-1485 h1.entry-title {
                    display: none;
               }
               div#facturacion_wrapper .step-header h1{
                    color: #fff !important;
               }
               div#facturacion_wrapper .buttons-right .f-submit {
                    color: #fff !important;
               }
          </style>
     </head>
     <body class="" data-user="1">
          <div id="page" class="site">

               @include('users_layout.header')
     
               @yield('content')

               @include('users_layout.footer')

          </div>
        <!-- #page -->

		<script>
			(function () {
				var c = document.body.className;
				c = c.replace(/woocommerce-no-js/, "woocommerce-js");
				document.body.className = c;
			})();
		</script>
          <style id=''>
               .wpcf7 .wpcf7-recaptcha iframe {margin-bottom: 0;}.wpcf7 .wpcf7-recaptcha[data-align="center"] > div {margin: 0 auto;}.wpcf7 .wpcf7-recaptcha[data-align="right"] > div {margin: 0 0 0 auto;}
          </style>
		
		<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js?ver=1.0.0" id="jquery-ui-js-js"></script>
		<script src="{{ asset('assets/js/jquerySpellingNumber.js?ver=1.0.0') }}" id="theme-jquerySpellingNumber-js"></script>
		<script src="{{ asset('assets/js/script.js?nocach=0.11206500+1726128914&amp;ver=1.0.0') }}" id="theme-custom-scripts-js"></script>
		<script src="{{ asset('assets/js/scriptcustom.js?nocach=0.11219600+1726128914&amp;ver=6.6.1') }}" id="econtarto-java-script-js-js"></script>
		<script src="{{ asset('assets/js/custom.js?nocach=0.11220400+1726128914&amp;ver=6.6.1') }}" id="custom-js-js"></script>
		<script src="{{ asset('assets/js/new-custom.js?nocach=0.11221100+1726128914&amp;ver=6.6.1') }}" id="newcustom-js-js"></script>
		<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
		<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
		<script src="https://alexandrebuffet.fr/codepen/slider/slick-animation.min.js"></script>
		
          <script>
			$(".slider-nav-review").slick({
				slidesToShow: 3,
				slidesToScroll: 1,
				focusOnSelect: true,
				dots: false,
				prevArrow: '<i class="fa-solid fa-chevron-left"></i>',
				nextArrow: '<i class="fa-solid fa-chevron-right"></i>',
				responsive: [
				{
					breakpoint: 991,
					settings: {
						slidesToShow: 2,
						slidesToScroll: 1,
					},
				},
				{
					breakpoint: 767,
					settings: {
						slidesToShow: 1,
						slidesToScroll: 1,
					},
				},
				{
					breakpoint: 480,
					settings: {
						slidesToShow: 1,
						slidesToScroll: 1,
					},
				},
				// You can unslick at a given breakpoint now by adding:
				// settings: "unslick"
				// instead of a settings object
				],
			});
		</script>

     @if(Session::get('error'))
     <script>
          toastr.clear();
          toastr.error('{{ Session::get("error") }}');
     </script>
     @endif

     @if(Session::get('success'))
     <script>
          toastr.clear();
          toastr.success('{{ Session::get("success") }}');
     </script>
     @endif

    </body>
</html>




         