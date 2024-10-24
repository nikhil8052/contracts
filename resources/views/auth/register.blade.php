@extends('users_layout.other_master')
@section('content')


<style>
    .password-input {
    position: relative;
}

.show-password-input {
    position: absolute;
    right: 10px;
    top: 50%;
    transform: translateY(-50%);
    cursor: pointer;
    font-size: 1.2em; /* Adjust icon size */
}

</style>
<!-- <section class="login-sec register-sec p-100">
    <div class="container">
		<div class="woocommerce">
			<div class="login-contant fa-text">
				<h1>{{ $register->title ?? '' }}</h1>
				<div class="woocommerce-notices-wrapper"></div> 
                    <form method="post" action="{{ url('/registerProcc') }}" id="register-form" class="woocommerce-form woocommerce-form-register register">
                        @csrf
                        <p class="form-row form-row-first">
                            <label for="first_name">Nombre <span class="required">*</span></label>
                            <input type="text" class="woocommerce-Input woocommerce-Input--text input-text form-control" name="first_name" id="first_name" value="">
                            <span class="text text-danger error" style="display:none;">This field is required</span>
                            @error('first_name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror

                        </p>
                        <p class="form-row form-row-last">
                            <label for="last_name">Apellido <span class="required">*</span></label>
                            <input type="text" class="woocommerce-Input woocommerce-Input--text input-text form-control" name="last_name" id="last_name" value="">
                            <span class="text text-danger error" style="display:none;">This field is required</span>
                            @error('last_name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </p>
                
                        <div class="clear"></div>
                        <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                            <label for="email">Correo electrónico&nbsp;<span class="required">*</span></label>
                            <input type="email" class="woocommerce-Input woocommerce-Input--text input-text form-control" name="email" id="email" autocomplete="email" value="" data-gtm-form-interact-field-id="0">
                            <span class="text text-danger error" style="display:none;">This field is required</span>
                            @error('email')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </p> 
                    
                        <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                            <label for="reg_password">Contraseña&nbsp;<span class="required">*</span></label>
                            <span class="password-input">
                                <input type="password" class="woocommerce-Input woocommerce-Input--text input-text form-control" name="password" id="reg_password" autocomplete="new-password" aria-autocomplete="list" data-gtm-form-interact-field-id="1">
                                <span class="show-password-input display-password" onclick="togglePasswordVisibility('reg_password')">
                                    <i class="fas fa-eye" id="icon-reg_password"></i>
                                </span>
                                @error('password')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </span>
                            <span class="text text-danger error" style="display:none;">This field is required</span>
                        </p>
                        
                        <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                            <label for="reg_password_confirmation">Confirmar Contraseña&nbsp;<span class="required">*</span></label>
                            <span class="password-input">
                                <input type="password" class="woocommerce-Input woocommerce-Input--text input-text form-control" name="password_confirmation" id="reg_password_confirmation" autocomplete="new-password" aria-autocomplete="list" data-gtm-form-interact-field-id="1">
                                <span class="show-password-input display-password" onclick="togglePasswordVisibility('reg_password_confirmation')">
                                    <i class="fas fa-eye" id="icon-reg_password_confirmation"></i>
                                </span>
                                @error('password_confirmation')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </span>
                            <span class="text text-danger error" style="display:none;">This field is required</span>
                        </p>
                        <p class="woocommerce-form-row form-row">
                            <button type="button" class="woocommerce-Button woocommerce-button button woocommerce-form-register__submit" name="register" id="register_btn" value="Register">Crear cuenta</button>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section> -->
<section class="contac_login_card p_120 light">
    <div class="container">
        <div class="wt_ot">
            <div class="inside_contac_box">
                <div class="h_contac_box" id="top">
                    <h3 class="ponte_h">
                        <font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><h3>{{ $register->title ?? '' }}</h3</font></font>
                    </h3>
                </div>
                <form method="post" action="{{ url('/registerProcc') }}" id="register-form" enctype="multipart/form-data">
                    @csrf
                    <!-- <input type="hidden" name="_token" value="" autocomplete="off" /> -->
                    <div class="contac_inp_fld">
                        <div class="inside_contac_fild">
                            <input type="text" class="mine_input" name="first_name" placeholder="Name" />
                        </div>
                        <div class="inside_contac_fild">
                            <input type="text" class="mine_input" name="last_name" placeholder="Phone number" />
                        </div>
                        <div class="inside_contac_fild">
                            <input type="text" class="mine_input" name="email" placeholder="Email" />
                        </div>
                        <div class="inside_contac_fild">
                            <input type="password" class="mine_input" name="password" placeholder="Password" />
                        </div>
                        <div class="inside_contac_fild">
                            <input type="password" class="mine_input" name="password_confirmation" placeholder="Confirm Password" />
                        </div>
                        <div class="outer_aft_btn">
                            <button class="cta_org submit-btn" type="submit" tabindex="0">
                                <font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Register</font></font>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<script>
function togglePasswordVisibility(inputId) {
    const passwordInput = document.getElementById(inputId);
    console.log(passwordInput);
    const icon = document.getElementById(`icon-${inputId}`); // Get the corresponding icon

    if (passwordInput.type === "password") {
        passwordInput.type = "text";
        icon.classList.remove("fa-eye");
        icon.classList.add("fa-eye-slash"); // Change to "eye-slash" when visible
    } else {
        passwordInput.type = "password";
        icon.classList.remove("fa-eye-slash");
        icon.classList.add("fa-eye"); // Change back to "eye" when hidden
    }
}
</script>

<script>
$(document).ready(function(){
    $('#register_btn').click(function(e){
        e.preventDefault();

        var first_name = $("input[name='first_name']").val();
        var last_name = $("input[name='last_name']").val();
        var email = $("input[name='email']").val();
        var password = $("input[name='password']").val();
        var password_confirmation = $("input[name='password_confirmation']").val();
        var isvalid = true;

        if(first_name === '' || first_name === undefined || first_name === null && last_name === '' || last_name === undefined || last_name === null && email === '' || email === undefined || email === null && password === '' || password === undefined || password === null && password_confirmation === '' || password_confirmation === undefined || password_confirmation === null){
            $('.error').show();
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