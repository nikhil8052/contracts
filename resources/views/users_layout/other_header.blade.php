@php 
    $setting = App\Models\Setting::where('key', 'header_logo')->first();
	$path = str_replace('public/', '', $setting->file_path ?? null);
@endphp

<header class="inner-header fun-header">
    <div class="main_header">
        <div class="container-fluid">
            <div class="srch-hdr">
                <div class="hedaer_logo mobile-hide">
               
                    <a href="{{ url('/') }}">
                    <img src="{{ asset('storage/'.$path) }}" alt="">
                    </a>
                </div>
                <div class="form">
                    <input type="search" placeholder="Buscar documento legal">
                    <button class="btn cta_dark"><i class="fa-solid fa-magnifying-glass"></i></button>
                </div>
                <div class="hedaer_bnt">
                    <a href="" class="cta_dark"><i class="fa-solid fa-file-lines"></i>Crear documento</a>
                    <a href="{{ url('/login') }}" class="cta_light">Iniciar sesión</a>
                </div>

            </div>
        </div>
    </div>
    <div class="top_header dark">
        <div class="container-fluid">
            <nav class="navbar navbar-expand-lg">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <div class="bar bar1"></div>
                    <div class="bar bar2"></div>
                    <div class="bar bar3"></div>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <div class="left_menu">
                        <ul class="menu">
                            <li class="menu-item dropdown dropdown-6">
                                <a href="#">
                                    <span class="dropdown_tittle">Negocios y Comercio</span>
                                    <span class="dropdown_toggle">
                                        <i class="fa-solid fa-chevron-down"></i></span>
                                </a>
                                <div class="dropdown_menu dropdown_menu--animated dropdown_menu-6">
                                    <div class="row">
                                        <div class="col-md-3 col-width">
                                            <div class="dropdown_content">
                                                <h6>WEBSITES <span class="dropdown_submenu"><i class="fa-solid fa-chevron-down"></i></span></h6>
                                                <ul>
                                                    <li> <a href="#"><i class="fa-solid fa-file-lines"></i>Item
                                                            1</a></li>
                                                    <li> <a href="#"><i class="fa-solid fa-file-lines"></i>Item
                                                            2</a></li>
                                                    <li> <a href="#"><i class="fa-solid fa-file-lines"></i>Item
                                                            3</a></li>
                                                    <li> <a href="#"><i class="fa-solid fa-file-lines"></i>Item
                                                            4</a></li>
                                                    <li> <a href="#"><i class="fa-solid fa-file-lines"></i>Item
                                                            5</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-width">
                                            <div class="dropdown_content">

                                                <h6>HOSTING <span class="dropdown_submenu"><i class="fa-solid fa-chevron-down"></i></span></h6>
                                                <ul>
                                                    <li> <a href="#"><i class="fa-solid fa-file-lines"></i>Item
                                                            1</a></li>
                                                    <li> <a href="#"><i class="fa-solid fa-file-lines"></i>Item
                                                            2</a></li>
                                                    <li> <a href="#"><i class="fa-solid fa-file-lines"></i>Item
                                                            3</a></li>
                                                    <li> <a href="#"><i class="fa-solid fa-file-lines"></i>Item
                                                            4</a></li>
                                                    <li> <a href="#"><i class="fa-solid fa-file-lines"></i>Item
                                                            5</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-width">
                                            <div class="dropdown_content">
                                                <h6>GODADDY PRO <span class="dropdown_submenu"><i class="fa-solid fa-chevron-down"></i></span>
                                                </h6>
                                                <ul>
                                                    <li> <a href="#"><i class="fa-solid fa-file-lines"></i>Item
                                                            1</a></li>
                                                    <li> <a href="#"><i class="fa-solid fa-file-lines"></i>Item
                                                            2</a></li>
                                                    <li> <a href="#"><i class="fa-solid fa-file-lines"></i>Item
                                                            3</a></li>
                                                    <li> <a href="#"><i class="fa-solid fa-file-lines"></i>Item
                                                            4</a></li>
                                                    <li> <a href="#"><i class="fa-solid fa-file-lines"></i>Item
                                                            5</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-width">
                                            <div class="dropdown_content">
                                                <ul>
                                                    <li><a href="">
                                                        <img src="{{ asset('assets/img/dropdown-col-img.webp') }}" alt=""></a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class=" menu-item dropdown dropdown-6">
                                <a href="#">
                                    <span class="dropdown_tittle">Vida Personal</span>
                                    <span class="dropdown_toggle">
                                        <i class="fa-solid fa-chevron-down"></i></span>
                                </a>

                                <div class="dropdown_menu dropdown_menu--animated dropdown_menu-6">
                                    <div class="row">
                                        <div class="col-md-3 col-width">
                                            <div class="dropdown_content">
                                                <h6>WEBSITES <span class="dropdown_submenu"><i class="fa-solid fa-chevron-down"></i></span></h6>
                                                <ul>
                                                    <li> <a href="#"><i class="fa-solid fa-file-lines"></i>Item
                                                            1</a></li>
                                                    <li> <a href="#"><i class="fa-solid fa-file-lines"></i>Item
                                                            2</a></li>
                                                    <li> <a href="#"><i class="fa-solid fa-file-lines"></i>Item
                                                            3</a></li>
                                                    <li> <a href="#"><i class="fa-solid fa-file-lines"></i>Item
                                                            4</a></li>
                                                    <li> <a href="#"><i class="fa-solid fa-file-lines"></i>Item
                                                            5</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-width">
                                            <div class="dropdown_content">
                                                <h6>HOSTING <span class="dropdown_submenu"><i class="fa-solid fa-chevron-down"></i></span>
                                                </h6>
                                                <ul>
                                                    <li> <a href="#"><i class="fa-solid fa-file-lines"></i>Item
                                                            1</a></li>
                                                    <li> <a href="#"><i class="fa-solid fa-file-lines"></i>Item
                                                            2</a></li>
                                                    <li> <a href="#"><i class="fa-solid fa-file-lines"></i>Item
                                                            3</a></li>
                                                    <li> <a href="#"><i class="fa-solid fa-file-lines"></i>Item
                                                            4</a></li>
                                                    <li> <a href="#"><i class="fa-solid fa-file-lines"></i>Item
                                                            5</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-width">
                                            <div class="dropdown_content">
                                                <h6>GODADDY PRO <span class="dropdown_submenu"><i class="fa-solid fa-chevron-down"></i></span>
                                                </h6>
                                                <ul>
                                                    <li> <a href="#"><i class="fa-solid fa-file-lines"></i>Item
                                                            1</a></li>
                                                    <li> <a href="#"><i class="fa-solid fa-file-lines"></i>Item
                                                            2</a></li>
                                                    <li> <a href="#"><i class="fa-solid fa-file-lines"></i>Item
                                                            3</a></li>
                                                    <li> <a href="#"><i class="fa-solid fa-file-lines"></i>Item
                                                            4</a></li>
                                                    <li> <a href="#"><i class="fa-solid fa-file-lines"></i>Item
                                                            5</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-width">
                                            <div class="dropdown_content">
                                                <ul>
                                                    <li><a href="">
                                                        <img src="{{ asset('assets/img/dropdown-col-img.webp') }}" alt=""></a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class=" menu-item dropdown dropdown-6">
                                <a href="#">
                                    <span class="dropdown_tittle">Laboral y Cumplimiento</span>
                                    <span class="dropdown_toggle">
                                        <i class="fa-solid fa-chevron-down"></i></span>
                                </a>
                                <div class="dropdown_menu dropdown_menu--animated dropdown_menu-6">
                                    <div class="row">
                                        <div class="col-md-3 col-width">
                                            <div class="dropdown_content">
                                                <h6>WEBSITES <span class="dropdown_submenu"><i class="fa-solid fa-chevron-down"></i></span></h6>
                                                <ul>
                                                    <li> <a href="#"><i class="fa-solid fa-file-lines"></i>Item
                                                            1</a></li>
                                                    <li> <a href="#"><i class="fa-solid fa-file-lines"></i>Item
                                                            2</a></li>
                                                    <li> <a href="#"><i class="fa-solid fa-file-lines"></i>Item
                                                            3</a></li>
                                                    <li> <a href="#"><i class="fa-solid fa-file-lines"></i>Item
                                                            4</a></li>
                                                    <li> <a href="#"><i class="fa-solid fa-file-lines"></i>Item
                                                            5</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-width">
                                            <div class="dropdown_content">
                                                <h6>HOSTING <span class="dropdown_submenu"><i class="fa-solid fa-chevron-down"></i></span>
                                                </h6>
                                                <ul>
                                                    <li> <a href="#"><i class="fa-solid fa-file-lines"></i>Item
                                                            1</a></li>
                                                    <li> <a href="#"><i class="fa-solid fa-file-lines"></i>Item
                                                            2</a></li>
                                                    <li> <a href="#"><i class="fa-solid fa-file-lines"></i>Item
                                                            3</a></li>
                                                    <li> <a href="#"><i class="fa-solid fa-file-lines"></i>Item
                                                            4</a></li>
                                                    <li> <a href="#"><i class="fa-solid fa-file-lines"></i>Item
                                                            5</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-width">
                                            <div class="dropdown_content">
                                                <h6>GODADDY PRO <span class="dropdown_submenu"><i class="fa-solid fa-chevron-down"></i></span>
                                                </h6>
                                                <ul>
                                                    <li> <a href="#"><i class="fa-solid fa-file-lines"></i>Item
                                                            1</a></li>
                                                    <li> <a href="#"><i class="fa-solid fa-file-lines"></i>Item
                                                            2</a></li>
                                                    <li> <a href="#"><i class="fa-solid fa-file-lines"></i>Item
                                                            3</a></li>
                                                    <li> <a href="#"><i class="fa-solid fa-file-lines"></i>Item
                                                            4</a></li>
                                                    <li> <a href="#"><i class="fa-solid fa-file-lines"></i>Item
                                                            5</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-width">
                                            <div class="dropdown_content">
                                                <ul>
                                                    <li><a href="">
                                                        <img src="{{ asset('assets/img/dropdown-col-img.webp') }}" alt=""></a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class=" menu-item dropdown dropdown-6">
                                <a href="#">
                                    <span class="dropdown_tittle">Tecnología y Consumo</span>
                                    <span class="dropdown_toggle">
                                        <i class="fa-solid fa-chevron-down"></i></span>
                                </a>
                                <div class="dropdown_menu dropdown_menu--animated dropdown_menu-6">
                                    <div class="row">
                                        <div class="col-md-3 col-width">
                                            <div class="dropdown_content">
                                                <h6>WEBSITES <span class="dropdown_submenu"><i class="fa-solid fa-chevron-down"></i></span></h6>
                                                <ul>
                                                    <li> <a href="#"><i class="fa-solid fa-file-lines"></i>Item
                                                            1</a></li>
                                                    <li> <a href="#"><i class="fa-solid fa-file-lines"></i>Item
                                                            2</a></li>
                                                    <li> <a href="#"><i class="fa-solid fa-file-lines"></i>Item
                                                            3</a></li>
                                                    <li> <a href="#"><i class="fa-solid fa-file-lines"></i>Item
                                                            4</a></li>
                                                    <li> <a href="#"><i class="fa-solid fa-file-lines"></i>Item
                                                            5</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-width">
                                            <div class="dropdown_content">
                                                <h6>HOSTING <span class="dropdown_submenu"><i class="fa-solid fa-chevron-down"></i></span>
                                                </h6>
                                                <ul>
                                                    <li> <a href="#"><i class="fa-solid fa-file-lines"></i>Item
                                                            1</a></li>
                                                    <li> <a href="#"><i class="fa-solid fa-file-lines"></i>Item
                                                            2</a></li>
                                                    <li> <a href="#"><i class="fa-solid fa-file-lines"></i>Item
                                                            3</a></li>
                                                    <li> <a href="#"><i class="fa-solid fa-file-lines"></i>Item
                                                            4</a></li>
                                                    <li> <a href="#"><i class="fa-solid fa-file-lines"></i>Item
                                                            5</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-width">
                                            <div class="dropdown_content">
                                                <h6>GODADDY PRO <span class="dropdown_submenu"><i class="fa-solid fa-chevron-down"></i></span>
                                                </h6>
                                                <ul>
                                                    <li> <a href="#"><i class="fa-solid fa-file-lines"></i>Item
                                                            1</a></li>
                                                    <li> <a href="#"><i class="fa-solid fa-file-lines"></i>Item
                                                            2</a></li>
                                                    <li> <a href="#"><i class="fa-solid fa-file-lines"></i>Item
                                                            3</a></li>
                                                    <li> <a href="#"><i class="fa-solid fa-file-lines"></i>Item
                                                            4</a></li>
                                                    <li> <a href="#"><i class="fa-solid fa-file-lines"></i>Item
                                                            5</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-width">
                                            <div class="dropdown_content">
                                                <ul>
                                                    <li><a href="">
                                                        <img src="{{ asset('assets/img/dropdown-col-img.webp') }}" alt=""></a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>

                    <div class="right_menu">
                        <ul>
                            <li>
                                <a href="{{ url('/how-it-works') }}">Así funciona </a>
                            </li>
                            <li>
                                <a href="#">Ayuda</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="hedaer_logo">
                    <a href="{{ url('/') }}"><img src="{{ asset('storage/'.$path) }}" alt=""></a>
                </div>
            </nav>
        </div>
    </div>
</header>