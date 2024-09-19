@extends('users_layout.master') @section('content') @yield('css')
<style>
    .work-head-banner-desc p {
        padding-top: 20px;
    }
    .work-head-desc p {
        padding-bottom: 10px;
    }
    @media only screen and (max-width: 767px) {
        .work-row .p-left {
            padding: 15px;
        }
        .work-text h3 {
            margin-bottom: 30px;
            font-size: 20px;
        }
    }
    p.bl_sec {
        font-size: 18px;
    }
</style>

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
                        <p class="logged-in">¡Bienvenido!</p>
                        <div class="mobile_right_header_button loggedin">
                            <a href="https://documentos-legales.mx/mi-cuenta" class="cta login">Mis documentos</a>
                            <a href="https://documentos-legales.mx/mi-cuenta/configuracion/" class="cta register">Configuración</a>
                            <a href="https://documentos-legales.mx/wp-login.php?action=logout&amp;redirect_to=https%3A%2F%2Fdocumentos-legales.mx&amp;_wpnonce=1c4e2e77ae" class="cta login">Cerrar session</a>
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
    <div class="category_menu">
        <div class="container">
            <div class="cotegory_menu_container">
                <ul id="menu-category-menu" class="cotegory_navbar">
                    <li id="menu-item-453" class="menu-item menu-item-type-taxonomy menu-item-object-document-cat menu-item-453"><a href="" class="nav-link">Arrendamiento</a></li>
                    <li id="menu-item-452" class="menu-item menu-item-type-taxonomy menu-item-object-document-cat menu-item-452"><a href="" class="nav-link">Comercio</a></li>
                    <li id="menu-item-454" class="menu-item menu-item-type-taxonomy menu-item-object-document-cat menu-item-454"><a href="" class="nav-link">Consumo</a></li>
                    <li id="menu-item-455" class="menu-item menu-item-type-taxonomy menu-item-object-document-cat menu-item-455"><a href="" class="nav-link">Familia</a></li>
                    <li id="menu-item-456" class="menu-item menu-item-type-taxonomy menu-item-object-document-cat menu-item-456"><a href="" class="nav-link">Internet</a></li>
                    <li id="menu-item-457" class="menu-item menu-item-type-taxonomy menu-item-object-document-cat menu-item-457"><a href="" class="nav-link">Laboral</a></li>
                    <li id="menu-item-1905" class="menu-item menu-item-type-taxonomy menu-item-object-document-cat menu-item-1905"><a href="" class="nav-link">Compra-Venta</a></li>
                    <li id="menu-item-458" class="menu-item menu-item-type-taxonomy menu-item-object-document-cat menu-item-458"><a href="" class="nav-link">Vida diaria</a></li>
                </ul>
            </div>
        </div>
    </div>

    <section class="work-sec p-130 custom_section_p">
        <div class="container">
            <div class="work-head">
                <h1>Así funciona</h1>
            </div>
            <div class="work-head-desc">
                <p>
                    Descubre una forma sencilla de generar documentos y contratos en Documentos-Legales.mx. Nuestra plataforma te ofrece una amplia selección de documentos legales para cubrir tus necesidades. ¡Comienza a crear tus contratos
                    personalizados hoy mismo!
                </p>
            </div>

            <div class="work-row-wrapper">
                <div class="row work-row">
                    <div class="col-md-6">
                        <div class="work-img">
                            <img src="https://documentos-legales.mx/wp-content/uploads/2023/10/work-01-1.jpg" alt="Work-image" />
                        </div>
                    </div>
                    <div class="col-md-6 p-left">
                        <div class="work-text">
                            <h3>Explora nuestra variedad de documentos y contratos</h3>
                            <p>
                                Explora nuestra variedad de documentos y contratos En Documentos-Legales.mx, te ofrecemos una amplia selección de documentos legales y contratos para que elijas el que mejor se adapte a tus necesidades. Desde
                                un Contrato de Arrendamiento Casa Habitación hasta un Contrato de Trabajo y más. Simplemente haz clic en "Crear documento" y elige el contrato que necesites.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="row work-row">
                    <div class="col-md-6">
                        <div class="work-img">
                            <img src="https://documentos-legales.mx/wp-content/uploads/2023/10/work-02-1.jpg" alt="Work-image" />
                        </div>
                    </div>
                    <div class="col-md-6 p-left">
                        <div class="work-text">
                            <h3>Personaliza tu documento fácilmente</h3>
                            <p>
                                Una vez seleccionado el contrato, te guiaremos a través de un cuestionario detallado. Responde preguntas específicas y nuestro sistema personalizará el documento según tus requisitos. Estarás tranquilo
                                sabiendo que cada detalle importante estará cubierto en el documento final.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="row work-row">
                    <div class="col-md-6">
                        <div class="work-img">
                            <img src="https://documentos-legales.mx/wp-content/uploads/2023/10/work-03-1.jpg" alt="Work-image" />
                        </div>
                    </div>
                    <div class="col-md-6 p-left">
                        <div class="work-text">
                            <h3>Descarga tu documento en diferentes formatos</h3>
                            <p>
                                Después de completar el cuestionario, recibirás el contrato totalmente personalizado al instante. En Documentos-Legales.mx, puedes descargar tu documento en formatos PDF y DOCX (Word). El formato PDF es ideal
                                para compartir y presentar de manera profesional, mientras que el formato DOCX te permite realizar modificaciones según sea necesario. Tú decides cómo utilizarlo.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="work-head-banner-desc">
                <p>
                    En Documentos-Legales.mx, nos esforzamos por hacer que el proceso de generación de documentos y contratos sea sencillo y conveniente. Obtén documentos legales de calidad de manera rápida y eficiente. ¡Únete a nuestra
                    comunidad de usuarios satisfechos y simplifica tus trámites legales!
                </p>
            </div>
        </div>
    </section>

    <section class="footer_bann_wreap p-130 g_bck">
        <div class="container">
            <div class="global_content text-center">
                <h2>Genera tus documentos legales de forma rápida y sencilla</h2>
                <p class="bl_sec">Nuestro sistema intuitivo te guía paso a paso para crear documentos legales personalizados. Descárgalos al instante en los formatos PDF y DOCX (Word) y tenlos listos en cuestión de minutos.</p>

                <div class="start_new text-center">
                    <a href="{{ url('/') }}" class="cta">Comienza ahora</a>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection
