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

<section class="social_login light p_120">
    <div class="inner_social_log">
        <div class="container">
            <div class="social_sec_wt">
                <div class="social_contct">
                    <form method="post" action="{{ url('forget-password-email') }}" class="needs-validation" novalidate>
                        @csrf
                        <div class="social_hd">
                            <h2>Recuperar contraseña</h2>
                            <p class="hd_para_consta">
                                Recibirás un enlace para crear una nueva contraseña por correo electrónico.
                            </p>
                        </div>

                        <div class="contac_ot_box">
                            <input class="form-control inside_contac" id="user_login" type="email" placeholder="Correo electrónico" name="email" required>
                            <div class="invalid-feedback">
                                Por favor, introduce un correo electrónico válido.
                            </div>
                            <span class="text-danger">@error('email') {{ $message }} @enderror</span>
                        </div>

                        <div class="contac_ot_box">
                            <button type="submit" class="cta_org btn btn-primary btn-block">Recuperar contraseña</button>
                        </div>

                        <div class="contac_ot_box">
                            <p class="contaco_para_in">
                                ¿No estás registrado? <span class="span1"><a href="{{route('register')}}" class="link-url">Crear cuenta</a></span>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>


@endsection