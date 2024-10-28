@extends('users_layout.master')
@section('content')

@if($register->background_image != null)
    <?php $path = str_replace('public/', '', $register->file_path ?? null); ?>
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

<section class="social_login light p_120">
    <div class="regisater-form-div">
        <div class="inner_social_log">
            <div class="container">
                <div class="social_sec_wt">
                    <div class="social_contct">
                        <form method="post" action="{{ url('/registerProcc') }}" id="register-form" enctype="multipart/form-data">
                            @csrf
                            <div class="social_hd">
                                <h2>{{ $register->main_heading ?? 'Crear cuenta' }}</h2>
                            </div>
                            <div class="fs-n-lt-n">
                                <div class="contac_ot_box">
                                    <input type="text" class="inside_contac" name="first_name" placeholder="Nombre" required>
                                    <span class="error text-danger">@error('first_name') {{ $message }} @enderror</span>
                                </div>

                                <div class="contac_ot_box">
                                    <input type="text" class="inside_contac" name="last_name" placeholder="Apellido" required>
                                    <span class="error text-danger">@error('last_name') {{ $message }} @enderror</span>
                                </div>
                            </div>
                        

                            <div class="contac_ot_box">
                                <input type="email" class="inside_contac" name="email" placeholder="Correo electrónico" id="email" required>
                                <span class="error text-danger">@error('email') {{ $message }} @enderror</span>
                            </div>

                        <div class="contac_ot_box">
                                <div class="form-group">
                                    <input id="password-field" type="password" class="form-control inside_contac" name="password" placeholder="Contraseña" required>
                                    <span toggle="#password-field" class="fa fa-fw fa-eye-slash field-icon toggle-password"></span>
                                </div>
                                <span class="text-danger">@error('password') {{ $message }} @enderror</span>
                            </div>

                            <div class="contac_ot_box">
                                <div class="form-group">
                                    <input id="confirm-password-field" type="password" class="form-control inside_contac" name="password_confirmation" placeholder="Confirmar Contraseña" required>
                                    <span toggle="#confirm-password-field" class="fa fa-fw fa-eye-slash field-icon toggle-password"></span>
                                </div>
                                <span class="text-danger">@error('password_confirmation') {{ $message }} @enderror</span>
                            </div>

                            <div class="outer_aft_btn mt-5">
                                <button class="cta_org submit-btn register_btn" type="submit" tabindex="0">Crear cuenta</button>
                            </div>

                            <div class="contac_ot_box">
                                <p class="contaco_para_in">
                                    ¿Ya tienes una cuenta? <span class="span1"><a href="{{ route('login.user') }}" class="link-url">Iniciar sesión</a></span>
                                </p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
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

<script>
$(document).ready(function(){
    $('.register_btn').click(function(e){
        e.preventDefault();
        let emailVal = $('#email').val();
        let emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/; // Basic email regex
        
        // Clear any previous error messages

        let hasError = false;

        if (emailVal === '') {
            $('#email-wrong').text('Email field is required').show();
            hasError = true;
        } else if (!emailRegex.test(emailVal)) {
            $('#email-wrong').text('Please enter a valid email address').show();
            hasError = true;
        }
        var first_name = $("input[name='first_name']").val();
        var last_name = $("input[name='last_name']").val();
        var email = $("input[name='email']").val();
        var password = $("input[name='password']").val();
        var password_confirmation = $("input[name='password_confirmation']").val();
        var isvalid = true;

        if(first_name === '' || first_name === undefined || first_name === null && last_name === '' || last_name === undefined || last_name === null && email === '' || email === undefined || email === null && password === '' || password === undefined || password === null && password_confirmation === '' || password_confirmation === undefined || password_confirmation === null){
            $('.error').text('this field is required').show();
            isvalid = false;
        }

        if(isvalid){
            $('.error').hide();
            $('#register-form').submit();
        }

    })
})

</script>

@endsection