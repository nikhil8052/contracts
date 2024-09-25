@extends('users_layout.master')
@section('content')
<style>
	@media only screen and (max-width: 767px) {
	.lost_reset_password, .register-sec .register {
		border: 1px solid #e0e0e0;
		border-radius: 15px;
		padding: 30px 30px;
		max-width: 709px;
		margin: auto;
	}
	}
</style>
<section class="login-sec p-100">
    <div class="container">
        <div class="login-contant fa-text">
            <h1>Recuperar contraseña</h1>
			<div class="woocommerce-notices-wrapper"></div>

			<form method="post" action="{{url('forget-password-email')}}" class="woocommerce-ResetPassword lost_reset_password">
				@csrf
				<p>Recibirás un enlace para crear una nueva contraseña por correo electrónico.</p>
				<p class="woocommerce-form-row woocommerce-form-row--first form-row form-row-first">
					
					<input class="woocommerce-Input woocommerce-Input--text input-text form-control" type="email" placeholder="Correo electrónico" name="email" id="user_login" autocomplete="username">
				</p>

				<div class="clear"></div>

				<p class="woocommerce-form-row form-row">
					<button type="submit" class="woocommerce-Button reset-btn button" value="Reset password">Recuperar contraseña</button>
				</p>
			</form>
		</div>
	</div>
</section>
@endsection