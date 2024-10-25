<!DOCTYPE html>
<html lang="zxx" class="js">

<head>
    <base href="../">
    <meta charset="utf-8">
    <meta name="author" content="Softnio">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="A powerful and conceptual apps base dashboard template that especially build for developers and programmers.">
    <!-- Fav Icon  -->
    <link rel="shortcut icon" href="./images/favicon.png">
    <!-- Page Title  -->
    <title>Docx | Admin Dashboard</title>
    <!-- StyleSheets  -->
    <link rel="stylesheet" href="{{ asset('admin-theme/assets/css/dashlite.css?ver=3.1.2?kkkk') }}">
    <link id="skin-default" rel="stylesheet" href="{{ asset('admin-theme/assets/css/theme.css?ver=3.1.2') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css" integrity="sha512-10/jx2EXwxxWqCLX/hHth/vu2KY3jCF70dCQB8TSgNjbCVAC/8vai53GfMDrO2Emgwccf2pJqxct9ehpzG+MTw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>

<body class="nk-body bg-lighter npc-general has-sidebar ">
    <div class="nk-app-root">
        <!-- main @s -->
        <div class="nk-main ">
            <!-- sidebar @s -->
            <div class="nk-sidebar nk-sidebar-fixed is-dark " data-content="sidebarMenu">
                <div class="nk-sidebar-element nk-sidebar-head">
                    <div class="nk-menu-trigger">
                        <a href="#" class="nk-nav-toggle nk-quick-nav-icon d-xl-none" data-target="sidebarMenu"><em class="icon ni ni-arrow-left"></em></a>
                        <a href="#" class="nk-nav-compact nk-quick-nav-icon d-none d-xl-inline-flex" data-target="sidebarMenu"><em class="icon ni ni-menu"></em></a>
                    </div>
                    <div class="nk-sidebar-brand">
                        <a href="{{ url('admin-dashboard') }}" class="logo-link nk-sidebar-logo">
                            <!-- <h3>Legalio</h3> -->
                            <img class="logo-light logo-img" src="{{ asset('assets/img/logo-legalio-mx-new.svg') }}" srcset="{{ asset('assets/img/logo-legalio-mx-new.svg') }}" alt="logo">
                            <img class="logo-dark logo-img" src="{{ asset('assets/img/logo-legalio-mx-new.svg') }}" srcset="{{ asset('assets/img/logo-legalio-mx-new.svg') }}" alt="logo-dark">
                        </a>
                    </div>
                </div><!-- .nk-sidebar-element -->
                <div class="nk-sidebar-element nk-sidebar-body">
                    <div class="nk-sidebar-content">
                        <div class="nk-sidebar-menu" data-simplebar>
                            <ul class="nk-menu">
                                <li class="nk-menu-heading">
                                    <a href="{{ url('admin-dashboard') }}"><h6 class="overline-title text-primary-alt">Dashboard</h6></a>
                                </li>
                                <li class="nk-menu-item has-sub">
                                    <a href="#" class="nk-menu-link nk-menu-toggle">
                                        <span class="nk-menu-icon"><em class="icon ni ni-box"></em></span>
                                        <span class="nk-menu-text">Orders</span>
                                    </a>
                                </li>
                                <li class="nk-menu-item has-sub">
                                    <a href="#" class="nk-menu-link nk-menu-toggle">
                                        <span class="nk-menu-icon"><em class="icon ni ni-star"></em></span>
                                        <span class="nk-menu-text">Reviews</span>
                                    </a>
                                    <ul class="nk-menu-sub">
                                        <li class="nk-menu-item">
                                            <a href="{{ url('/admin-dashboard/published-reviews') }}" class="nk-menu-link"><span class="nk-menu-text">Published Reviews</span></a>
                                        </li>
                                        <li class="nk-menu-item">
                                            <a href="{{ url('/admin-dashboard/pending-reviews') }}" class="nk-menu-link"><span class="nk-menu-text">Pending Reviews</span></a>
                                        </li>
                                        <li class="nk-menu-item">
                                            <a href="{{ url('/admin-dashboard/reviews') }}" class="nk-menu-link"><span class="nk-menu-text">Add Reviews</span></a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="nk-menu-item has-sub">
                                    <a href="#" class="nk-menu-link nk-menu-toggle">
                                        <span class="nk-menu-icon"><em class="icon ni ni-file"></em></span>
                                        <span class="nk-menu-text">Documents</span>
                                    </a>
                                    <ul class="nk-menu-sub">
                                        <li class="nk-menu-item">
                                            <a href="{{ url('/admin-dashboard/all/documents') }}" class="nk-menu-link"><span class="nk-menu-text">Documents</span></a>
                                        </li>
                                        <li class="nk-menu-item">
                                            <a href="{{ url('/admin-dashboard/document/categories') }}" class="nk-menu-link"><span class="nk-menu-text">Categories</span></a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="nk-menu-item has-sub">
                                    <a href="#" class="nk-menu-link nk-menu-toggle">
                                        <span class="nk-menu-icon"><em class="icon ni ni-files"></em></span>
                                        <span class="nk-menu-text">Pages</span>
                                    </a>
                                    <ul class="nk-menu-sub">
                                        <li class="nk-menu-item">
                                            <a href="{{ url('/admin-dashboard/home-content') }}" class="nk-menu-link"><span class="nk-menu-text">Home</span></a>
                                        </li>
                                        <li class="nk-menu-item">
                                            <a href="{{ url('/admin-dashboard/how-it-works') }}" class="nk-menu-link"><span class="nk-menu-text">How It Works</span></a>
                                        </li>
                                        <li class="nk-menu-item">
                                            <a href="{{ url('/admin-dashboard/faq') }}" class="nk-menu-link"><span class="nk-menu-text">FAQ's</span></a>
                                        </li>
                                        <li class="nk-menu-item">
                                            <a href="{{ url('/admin-dashboard/faq-category') }}" class="nk-menu-link"><span class="nk-menu-text">FAQ's Categories</span></a>
                                        </li>
                                        <li class="nk-menu-item">
                                            <a href="{{ url('/admin-dashboard/terms-and-conditions') }}" class="nk-menu-link"><span class="nk-menu-text">Terms & Condition</span></a>
                                        </li>
                                        <li class="nk-menu-item">
                                            <a href="{{ url('/admin-dashboard/help-center') }}" class="nk-menu-link"><span class="nk-menu-text">Help Center</span></a>
                                        </li>
                                        <li class="nk-menu-item">
                                            <a href="{{ url('/admin-dashboard/privacy-policy') }}" class="nk-menu-link"><span class="nk-menu-text">Privacy Policy</span></a>
                                        </li>
                                        <li class="nk-menu-item">
                                            <a href="{{ url('/admin-dashboard/contact-us') }}" class="nk-menu-link"><span class="nk-menu-text">Contact Us</span></a>
                                        </li>
                                        <li class="nk-menu-item">
                                            <a href="{{ url('/admin-dashboard/who-we-are') }}" class="nk-menu-link"><span class="nk-menu-text">Who We Are</span></a>
                                        </li>
                                        <li class="nk-menu-item">
                                            <a href="{{ url('/admin-dashboard/login') }}" class="nk-menu-link"><span class="nk-menu-text">Iniciar sesión</span></a>
                                        </li>
                                        <li class="nk-menu-item">
                                            <a href="{{ url('/admin-dashboard/register') }}" class="nk-menu-link"><span class="nk-menu-text">Crear cuenta</span></a>
                                        </li>
                                        <li class="nk-menu-item">
                                            <a href="{{ url('/admin-dashboard/prices') }}" class="nk-menu-link"><span class="nk-menu-text">Prices</span></a>
                                        </li>
                                        <li class="nk-menu-item">
                                            <a href="{{ url('/admin-dashboard/legal-document') }}" class="nk-menu-link"><span class="nk-menu-text">Legal Document</span></a>
                                        </li>
                                    </ul>
                                </li> 
                                <!-- <li class="nk-menu-item has-sub">
                                    <a href="#" class="nk-menu-link nk-menu-toggle">
                                        <span class="nk-menu-icon"><em class="icon ni ni-box"></em></span>
                                        <span class="nk-menu-text">Productos</span>
                                    </a>
                                    <ul class="nk-menu-sub">
                                        <li class="nk-menu-item">
                                            <a href="{{ url('/admin-dashboard/categories') }}" class="nk-menu-link"><span class="nk-menu-text">Categories</span></a>
                                        </li>
                                        <li class="nk-menu-item">
                                            <a href="{{ url('/admin-dashboard/product-categories') }}" class="nk-menu-link"><span class="nk-menu-text">Add Product Categories</span></a>
                                        </li>
                                        <li class="nk-menu-item">
                                            <a href="{{ url('/admin-dashboard/all-products') }}" class="nk-menu-link"><span class="nk-menu-text">Products</span></a>
                                        </li>
                                        <li class="nk-menu-item">
                                            <a href="{{ url('/admin-dashboard/product') }}" class="nk-menu-link"><span class="nk-menu-text">Add Product</span></a>
                                        </li>
                                    </ul>
                                </li> -->
                                <li class="nk-menu-item has-sub">
                                    <a href="#" class="nk-menu-link nk-menu-toggle">
                                        <span class="nk-menu-icon"><em class="icon ni ni-mail"></em></span>
                                        <span class="nk-menu-text">Emails</span>
                                    </a>
                                    <ul class="nk-menu-sub">
                                        <!-- <li class="nk-menu-item">
                                            <a href="" class="nk-menu-link"><span class="nk-menu-text"></span></a>
                                        </li>
                                        <li class="nk-menu-item">
                                            <a href="" class="nk-menu-link"><span class="nk-menu-text"></span></a>
                                        </li> -->
                                    </ul>
                                </li>
                                <li class="nk-menu-item has-sub">
                                    <a href="#" class="nk-menu-link nk-menu-toggle">
                                        <span class="nk-menu-icon"><em class="icon ni ni-setting"></em></span>
                                        <span class="nk-menu-text">Configuration</span>
                                    </a>
                                    <ul class="nk-menu-sub">
                                        <li class="nk-menu-item">
                                            <a href="{{ url('/admin-dashboard/users') }}" class="nk-menu-link"><span class="nk-menu-text">All Users</span></a>
                                        </li>
                                        <li class="nk-menu-item">
                                            <a href="{{ url('/admin-dashboard/web-setting') }}" class="nk-menu-link"><span class="nk-menu-text">Logos</span></a>
                                        </li>
                                        <li class="nk-menu-item">
                                            <a href="{{ url('/admin-dashboard/messages') }}" class="nk-menu-link"><span class="nk-menu-text">Messages</span></a>
                                        </li>
                                    </ul>
                                </li>
                            </ul><!-- .nk-menu -->
                        </div><!-- .nk-sidebar-menu -->
                    </div><!-- .nk-sidebar-content -->
                </div><!-- .nk-sidebar-element -->
            </div>
            <!-- sidebar @e -->
            <!-- wrap @s -->
            <div class="nk-wrap ">
                <!-- main header @s -->
                <div class="nk-header nk-header-fixed is-light">
                    <div class="container-fluid">
                        <div class="nk-header-wrap">
                            <div class="nk-header-brand d-xl-none">
                            </div> 
                            <div class="nk-header-tools">
                                <ul class="nk-quick-nav">
                                    <li class="dropdown user-dropdown">
                                        <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                            <div class="user-toggle">
                                                <div class="user-avatar sm">
                                                    <em class="icon ni ni-user-alt"></em>
                                                </div>
                                                <?php
                                                    $user = App\Models\User::where('is_admin',1)->first();
                                                ?>
                                                <div class="user-info d-none d-md-block">
                                                    <div class="user-status">Administrator</div>
                                                    <div class="user-name dropdown-indicator">{{ $user->name ?? '' }}</div>
                                                </div>
                                            </div>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-md dropdown-menu-end dropdown-menu-s1">
                                            <div class="dropdown-inner user-card-wrap bg-lighter d-none d-md-block">
                                                <div class="user-card">
                                                    <div class="user-avatar">
                                                        <span>AB</span>
                                                    </div>
                                                    <div class="user-info">
                                                        <span class="lead-text">{{ $user->name ?? '' }}</span>
                                                        <span class="sub-text">{{ $user->email ?? '' }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="dropdown-inner">
                                                <ul class="link-list">
                                                    <li><a href="{{ url('/admin-logout') }}"><em class="icon ni ni-signout"></em><span>Sign out</span></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </li><!-- .dropdown -->
                                </ul><!-- .nk-quick-nav -->
                            </div><!-- .nk-header-tools -->
                        </div><!-- .nk-header-wrap -->
                    </div><!-- .container-fliud -->
                </div>
                <!-- main header @e -->

                @yield('content')

                <!-- <div class="nk-footer">
                    <div class="container-fluid">
                        <div class="nk-footer-wrap">
                            <div class="nk-footer-copyright"> &copy; 2024 Legal Documents</a>
                            </div>
                        </div>
                    </div>
                </div> -->
                <!-- footer @e -->
            </div>
            <!-- wrap @e -->
        </div>
        <!-- main @e -->
    </div>
    <!-- app-root @e -->
    <!-- select region modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="region">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <a href="#" class="close" data-bs-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>
                <div class="modal-body modal-body-md">
                    <h5 class="title mb-4">Select Your Country</h5>
                    <div class="nk-country-region">
                        <ul class="country-list text-center gy-2">
                            <li>
                                <a href="#" class="country-item">
                                    <img src="./images/flags/arg.png" alt="" class="country-flag">
                                    <span class="country-name">Argentina</span>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="country-item">
                                    <img src="./images/flags/aus.png" alt="" class="country-flag">
                                    <span class="country-name">Australia</span>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="country-item">
                                    <img src="./images/flags/bangladesh.png" alt="" class="country-flag">
                                    <span class="country-name">Bangladesh</span>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="country-item">
                                    <img src="./images/flags/canada.png" alt="" class="country-flag">
                                    <span class="country-name">Canada <small>(English)</small></span>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="country-item">
                                    <img src="./images/flags/china.png" alt="" class="country-flag">
                                    <span class="country-name">Centrafricaine</span>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="country-item">
                                    <img src="./images/flags/china.png" alt="" class="country-flag">
                                    <span class="country-name">China</span>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="country-item">
                                    <img src="./images/flags/french.png" alt="" class="country-flag">
                                    <span class="country-name">France</span>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="country-item">
                                    <img src="./images/flags/germany.png" alt="" class="country-flag">
                                    <span class="country-name">Germany</span>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="country-item">
                                    <img src="./images/flags/iran.png" alt="" class="country-flag">
                                    <span class="country-name">Iran</span>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="country-item">
                                    <img src="./images/flags/italy.png" alt="" class="country-flag">
                                    <span class="country-name">Italy</span>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="country-item">
                                    <img src="./images/flags/mexico.png" alt="" class="country-flag">
                                    <span class="country-name">México</span>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="country-item">
                                    <img src="./images/flags/philipine.png" alt="" class="country-flag">
                                    <span class="country-name">Philippines</span>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="country-item">
                                    <img src="./images/flags/portugal.png" alt="" class="country-flag">
                                    <span class="country-name">Portugal</span>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="country-item">
                                    <img src="./images/flags/s-africa.png" alt="" class="country-flag">
                                    <span class="country-name">South Africa</span>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="country-item">
                                    <img src="./images/flags/spanish.png" alt="" class="country-flag">
                                    <span class="country-name">Spain</span>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="country-item">
                                    <img src="./images/flags/switzerland.png" alt="" class="country-flag">
                                    <span class="country-name">Switzerland</span>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="country-item">
                                    <img src="./images/flags/uk.png" alt="" class="country-flag">
                                    <span class="country-name">United Kingdom</span>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="country-item">
                                    <img src="./images/flags/english.png" alt="" class="country-flag">
                                    <span class="country-name">United State</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div><!-- .modal-content -->
        </div><!-- .modla-dialog -->
    </div><!-- .modal -->
    <!-- JavaScript -->
    <script src="{{ asset('admin-theme/assets/js/bundle.js?ver=3.1.2') }}"></script>
    <script src="{{ asset('admin-theme/assets/js/scripts.js?ver=3.1.2') }}"></script>
    <script src="{{ asset('admin-theme/assets/js/charts/gd-default.js?ver=3.1.2') }}"></script>
    <script src="{{ asset('admin-theme/assets/js/example-toastr.js?ver=3.1.2') }}"></script>

    @if(Session::get('error'))
    <script>
        toastr.clear();
        NioApp.Toast('{{ Session::get("error") }}', 'error', {position: 'top-right'});
    </script>
    @endif
    @if(Session::get('success'))
    <script>
        toastr.clear();
        NioApp.Toast('{{ Session::get("success") }}', 'info', {position: 'top-right'});
    </script>
    @endif

</body>

</html>