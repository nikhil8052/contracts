@extends('users_layout.master')
@section('content')

@if($login->background_image != null)
    <?php $path = str_replace('public/', '', $login->file_path ?? null); ?>
    <section class="banner_sec dark inner-banner acerca model_banner" style="background-image: url({{ asset('storage/'.$path) }});">
@else
    <section class="banner_sec dark inner-banner acerca model_banner" style="background-image: url({{ asset('assets/img/banner-img.png') }});">
@endif
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-7">
                <div class="banner_content">
                </div>
            </div>
            <div class="col-md-5">
                <div class="banner_img">
                </div>
            </div>
        </div>
    </div>
</section>


    <!---------------------------------------------- section social ------------------------------------- -->

    <section class="social_login light p_120">

        <div class="inner_social_log">
            <div class="container">
                <div class="social_sec_wt">
                    <div class="social_contct">
                        <form action="{{route('login.process')}}" id="loginForm" method="post">
                            @csrf
                            <div class="social_hd">
                                
                                <h2>
                                    {{ $login->main_heading ?? 'Iniciar sesión' }}
                                </h2>
                                <p class="hd_para_consta">
                                    {{ $login->main_sub_heading ?? 'Bienvenido! Por favor seleccione un método de inicio de sesión' }}
                                </p>
                            </div>
                            <div class="goog_fb_box">
                                <div class="in_gfb_box">
                                    <a class="social_btn" href="{{ route('login.google') }}" class="link-url"><i class="fa-brands fa-google"></i> Regístrese con <span
                                            class="span1">Google</span> </a>
                                </div>
                                <div class="in_gfb_box">
                                    <a class="social_btn2" href=""><i class="fa-brands fa-facebook" class="link-url"></i> Regístrese con
                                        <span class="span1">Facebook</span> </a>
                                </div>
                            </div>

                            <div class="af_bfore_line">
                                <div class="right-line left-line center-text">or</div>
                            </div>
                            <div class="contac_ot_box">
                                <input class="inside_contac " id ="email" type="email" placeholder="Correo electrónico" name="email">
                                <span class="text-danger" id="email-wrong"></span>
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="contac_ot_box">
                                <div class="form-group">
                                    <input id="password-field" type="password" class="form-control inside_contac"
                                        name="password" placeholder="Contraseña">
                                    <span toggle="#password-field"
                                        class="fa fa-fw fa-eye-slash field-icon toggle-password">
                                    </span>
                                    <span class="text-danger" id="pass-wrong" style="display:none"></span>
                                    @error('password')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="selct_div">
                                <div class="mainte_box">
                                    <div class="ot_check_mainte">
                                        <div class="form-group">
                                            <input type="checkbox" id="html">
                                            <label for="html">Mantener sesión activa </label>
                                        </div>
                                    </div>
                                    <div class="ot_check_mainte">
                                        <p class=" ot_check_mainte_pra">
                                            <a href="{{route('recover.password')}}" class="link-url" >Recuperar contraseña</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="contac_ot_box">
                                <button id="login_submit" type="button" class="cta_org" tabindex="0">Ingresar</a>
                            </div>
                            <div class="contac_ot_box">
                                <p class="contaco_para_in">
                                     ¿No estas registrado? <span class="span1"><a href="{{route('register')}}" class="link-url">Crear cuenta</a></span>
                                </p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
<script>
  $(document).ready(function() {
    $('#login_submit').click(function(e) {
    console.log('this is test');
        e.preventDefault();
        
        let email = $('#email').val();
        let password = $('#password-field').val();
        let emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/; // Basic email regex
        
        // Clear any previous error messages

        let hasError = false;

        if (email === '') {
            $('#email-wrong').text('Email field is required').show();
            hasError = true;
        } else if (!emailRegex.test(email)) {
            $('#email-wrong').text('Please enter a valid email address').show();
            hasError = true;
        }
        
        if (password === '') {
            $('#pass-wrong').text('Password field is required').show();
            hasError = true;
        }

        if (!hasError) {
            // Proceed with form submission or any other logic
            // Example: $('#yourFormId').submit();
            $('#loginForm').submit();
        }
    });
});

$(document).ready(function() {
    $(".toggle-password").click(function() {
        const passwordField = $($(this).attr("toggle"));
        const type = passwordField.attr("type") === "password" ? "text" : "password";
        passwordField.attr("type", type);
        
        // Toggle the eye icon
        if (type === "password") {
            $(this).removeClass("fa-eye").addClass("fa-eye-slash"); // When hidden
        } else {
            $(this).removeClass("fa-eye-slash").addClass("fa-eye"); // When shown
        }
    });
});
</script>

@endsection