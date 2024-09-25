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

			<form method="post" action="{{route('password.update')}}" class="woocommerce-ResetPassword lost_reset_password">
				@csrf
				<input type="hidden" name="token" value="{{ $token }}">
				<div class="form-group">
                    <label> Correo electrónico </label>
                    <input type="email" class="form-control" name="email" id="email" value="{{ old('email', $email) }}" readonly/>
                    <small class="text-danger" id="email-wrong"></small>
					<!-- @error('email')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror -->
                </div>
                <div class="form-group">
                    <label for=""> Contraseña</label>
                    <input type="password" class="form-control" id="password" name="password" />
                    <small class="text-danger" id="pass-wrong"  style="display: none;"></small>
					@error('password')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
				 <div class="form-group">
                    <label for=""> Confirmar Contraseña</label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" />
                    <small class="text-danger" id="pass-wrong"  style="display: none;"></small>
					@error('password_confirmation')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <!-- <button type="submit">Reset Password</button> -->
				<div class="login-btn">
					<button type="submit" class="login-button">Reset Password</button>
				</div>
			</form>
		</div>
	</div>
</section>
@endsection