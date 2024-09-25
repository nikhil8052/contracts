@extends('users_layout.master')
@section('content')
<section class="login-sec p-100">
    <div class="container">
        <div class="login-contant fa-text">
            <h1>{{ $login->title ?? '' }}</h1>
            <form class="login-form" id="loginForm" action="{{url('login-process')}}" method="post">
                @csrf
                <div class="form-group">
                    <label> Correo electrónico </label>
                    <input type="email" class="form-control" name="email" id="email" />
                    <small class="text-danger" id="email-wrong"></small>
                </div>
                <div class="form-group">
                    <label for=""> Contraseña</label>
                    <input type="password" class="form-control" id="password" name="password" />
                    <small class="text-danger" id="pass-wrong"  style="display: none;"></small>
                </div>
                <div class="login-checkbox">
                    <div class="jag-checkbox">
                        <input id="wp-comment-cookies-consent" name="remember" value="true" type="checkbox"/>
                        <p for="wp-comment-cookies-consent">Mantener sesión activa</p>
                    </div>
                    <div class="forgot-pass">
                        <p>
                            <span><a href="{{url('forget-password')}}">Recuperar contraseña</a></span>
                        </p>
                    </div>
                </div>
                <div class="login-btn" id="login_submit">
                    <button class="login-button">Ingresar</button>
                    <!-- <input type="hidden" name="action" value="user_login_custom" /> -->
                </div>
                <div class="or-text">
                    <span>O</span>
                </div>
                <div class="account-text">
                    <p>
                        ¿No estas registrado? <span><a href="{{url('/register')}}">Crear cuenta</a></span>
                    </p>
                </div>
            </form>
        </div>
    </div>
</section>
<script>
  $(document).ready(function() {
    $('#login_submit').click(function(e) {
        e.preventDefault();
        
        let email = $('#email').val();
        let password = $('#password').val();
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

</script>

@endsection