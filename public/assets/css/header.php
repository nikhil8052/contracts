<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package econtract
 */
?>
<!doctype html>
  <html <?php if(is_page('Home') || is_page('Iniciar sesión') || is_page('Elige el Documento Legal que necesitas') || is_page('Preguntas frecuentes') || is_single() || is_tax()) { echo language_attributes();} else{?> class="notranslate"<?php }  ?>>
<head>
<meta name="google" content="notranslate"/>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1 , shrink-to-fit=no">
    <meta name="language" content="es-MX">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	
	<?php wp_head();  ?>
	
	<script async src="https://www.googletagmanager.com/gtag/js?id=AW-10998956509"></script>
	<script>
	 window.dataLayer = window.dataLayer || [];
	 function gtag(){dataLayer.push(arguments);}
	 gtag('js', new Date());
	 gtag('config', 'AW-10998956509');
	</script>
	
	<script async src="https://www.googletagmanager.com/gtag/js?id=G-12TJJ9NXJG"></script>
	<script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());
	  gtag('config', 'G-12TJJ9NXJG');
	</script> 

	<script type='text/javascript'>
	function loadCSS(e, t, n) { "use strict"; var i = window.document.createElement("link"); var o = t || window.document.getElementsByTagName("script")[0]; i.rel = "stylesheet"; i.href = e; i.media = "only x"; o.parentNode.insertBefore(i, o); setTimeout(function () { i.media = n || "all" }) }loadCSS("https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css");
	</Script>	

	<!-- Ads for Facebook -->
	<script>
		!function(f,b,e,v,n,t,s)
		{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
		n.callMethod.apply(n,arguments):n.queue.push(arguments)};
		if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
		n.queue=[];t=b.createElement(e);t.async=!0;
		t.src=v;s=b.getElementsByTagName(e)[0];
		s.parentNode.insertBefore(t,s)}(window, document,'script',
		'https://connect.facebook.net/en_US/fbevents.js');
		fbq('init', '155674246310281');
		fbq('track', 'PageView');
	</script>
	<noscript><img height="1" width="1" style="display:none"
		src="https://www.facebook.com/tr?id=155674246310281&ev=PageView&noscript=1"
	/></noscript>

	<!-- Ads for Twitter -->
    <script>
		!function(e,t,n,s,u,a){e.twq||(s=e.twq=function(){s.exe?s.exe.apply(s,arguments):s.queue.push(arguments);
		},s.version='1.1',s.queue=[],u=t.createElement(n),u.async=!0,u.src='https://static.ads-twitter.com/uwt.js',
		a=t.getElementsByTagName(n)[0],a.parentNode.insertBefore(u,a))}(window,document,'script');
		twq('config','omhmi');
	</script>
<!-- End Twitter conversion tracking base code -->
</head>
<body <?php body_class(); ?> data-user="<?php echo is_user_logged_in()?get_current_user_id() :'';?>">
<?php wp_body_open(); ?>
<div id="page" class="site">
	<?php $header_section = get_field('header_section','option'); ?>

<?php if(is_front_page()){ ?>
	<header class="site-header desktop_header">
        <?php } else{ ?>
            <header class="site-header head-stat desktop_header">
            <?php }
            ?>
        <div class="container">
            <div class="header-nav">
                <nav class="navbar navbar-expand-lg">

                    <div class="col-md-3 brand-ord">
                        <a class="navbar-brand img-fluid" href="<?php echo home_url();  ?> " aria-label="Read more about Seminole tax hike"><img src="<?php echo $header_section['logo_image']; ?>" alt="header-logo"
                                class="img-fluid" height="75" width="175">
								<?php /*  if(isset($header_section['flag_image']) && !empty($header_section['flag_image'])): ?>
									<img src="<?php echo $header_section['flag_image']; ?>" alt="flag" class="flag_image" height="13" width="23"></a>
								<?php endif; */ ?>	
								</a>
									
                    </div>

                    <div class="col-md-9  header-nav-menu-cs">
                        <button class="navbar-toggler btn-ord" aria-label="Name" type="button">
                            <div class="bars bar1"></div>
                            <div class="bars bar2"></div>
                            <div class="bars bar3"></div>
                        </button>
                        <?php 
                        	if(is_user_logged_in()){
									wp_nav_menu( array(
										'theme_location' => 'custom-logged-in-header-menu',
										'container'  => 'div',
										'container_class'  => 'collapse navbar-collapse',
										'container_id'  => 'navbarNavDropdown',
										'menu_class'  => 'navbar-nav ml-auto',
										'menu_id'  => 'menu-header-menu',
										'add_li_class'  => 'nav-item' 
										)
									);
							}else{
									wp_nav_menu( array(
										'theme_location' => 'custom-header-menu',
										'container'  => 'div',
										'container_class'  => 'collapse navbar-collapse',
										'container_id'  => 'navbarNavDropdown',
										'menu_class'  => 'navbar-nav ml-auto',
										'add_li_class'  => 'nav-item' 
										)
									);	
							}
						
                        ?>
						
                    </div>
					
					<div class="col-md-3 mobile_menu_user" style="display:none">
                        <a class="navbar-brand img-fluid" href="<?php echo home_url(); ?>" aria-label="Read more about Seminole tax hike">
								<i class="mobile_user_icon fas fa-user"></i>
						</a>
                    </div>
					
                </nav>
            </div>
        </div>

    </header>
	<div class="mobile_header_side_bar">
		<div class="header_sidebar_inner">
			<div class="sidebar_empty_space"></div>
			<div class="sidebar_header_content">
				<div class="sidebar_header_nav">
					<div class="header_search_form" >
						<form id="header_search_form" method="POST" action="<?php echo home_url('contratos-documentos-legales/'); ?>" autocomplete="off">
                            <input type="text" class="form-control" name="search" placeholder="Buscar">
							<button class="mobilesearch-btn" type="submit">
								<i class="fa-solid fa-magnifying-glass"></i>
							</button>
                        </form>
					</div>
					<?php if(get_field('category_links','option')){ ?>
						<ul class="_Ty8L2" data-qa="SidebarMenuList">
							<?php $category_links = get_field('category_links','option'); 
							foreach($category_links as $term){
								echo '<li><a href="'.get_term_link( $term ).'">'.$term->name.'</a></li>';
							}							
							?>
						</ul>
					<?php } ?>	
					<?php if(get_field('mobile_nav_menu','option')){ ?>
						<ul class="_Ty8L3" data-qa="SidebarMenuList">
							<?php $mobile_nav_menu = get_field('mobile_nav_menu','option'); 
								foreach($mobile_nav_menu as $links){
									if(!empty($links['link']) && !empty($links['title'])){
										echo '<li><a href="'.$links['link'].'">'.$links['title'].'</a></li>';
									}									
								}							
							?>
						</ul>
					<?php } ?>	
					<?php if(!empty(get_field('mobile_header_button_label','option')) && !empty(get_field('mobile_header_button_link','option'))){ ?>
						<div class="mobile_header_buuton">
							<a class="cta" href="<?php echo get_field('mobile_header_button_link','option'); ?>"><?php echo get_field('mobile_header_button_label','option'); ?></a>
						</div>
					<?php } ?>
				</div>
			</div>
		</div>
		<div role="button" class="_GtzsW _Gv2_B"><div class="_NRBhu"></div></div>
		<div class="__z_48"></div>
	</div>
	<div class="mobile_header_side_bar_right">
		<div class="header_sidebar_inner">
			<div class="sidebar_empty_space"></div>
			<div class="sidebar_header_content">
				<div class="sidebar_header_nav">
					<div class="header_right_sidebar_content">
						<div>							
							<?php if(is_user_logged_in()): ?>
								<p class="logged-in">¡Bienvenido!</p>
								<div class="mobile_right_header_button loggedin">
									<a href="<?php echo  home_url('mi-cuenta'); ?>" class="cta login">Mis documentos</a>
									<a href="<?php echo  home_url('mi-cuenta/configuracion/'); ?>" class="cta register">Configuración</a>
									<a href="<?php echo  wp_logout_url( home_url() ); ?>" class="cta login">Cerrar session</a>
								</div>
							<?php else: ?>
								<p class="lgout">¡Bienvenido!</p>
								<p>Libera todas las opciones con una cuenta gratuita.</p>
								<div class="mobile_right_header_button">
									<a href="<?php echo  home_url('crear-cuenta'); ?>" class="cta register">Crear cuenta</a>
									<a href="<?php echo  home_url('iniciar-sesion'); ?>" class="cta login">Iniciar sesión</a>
								</div>
							<?php endif; ?>	
						</div>	
					</div>
				</div>
			</div>
		</div>
		<div role="button" class="_GtzsW _Gv2_B _zNNE6"><div class="_NRBhu"></div></div>
		<div class="__z_48"></div>
	</div>
	
	<div class="wn_hght">
	
	<!-- <script>
		!function(e,t,n,s,u,a){e.twq||(s=e.twq=function(){s.exe?s.exe.apply(s,arguments):s.queue.push(arguments);
		},s.version='1.1',s.queue=[],u=t.createElement(n),u.async=!0,u.src='https://static.ads-twitter.com/uwt.js',
		a=t.getElementsByTagName(n)[0],a.parentNode.insertBefore(u,a))}(window,document,'script');
		twq('config','omh3s');
	</script> -->
	
