<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="STG">
    <link rel="shortcut icon" href="{{asset('images/icon/favicon.png')}}">
    <meta name="author" content="STG">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Title Page-->
    <title>STG TELECOM - Public Registration</title>
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="{{ asset('public_registration/images/icons/favicon.ico')}}" />
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('public_registration/vendor/bootstrap/css/bootstrap.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('public_registration/fonts/font-awesome-4.7.0/css/font-awesome.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('public_registration/fonts/iconic/css/material-design-iconic-font.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('public_registration/vendor/animate/animate.css')}}">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="{{ asset('public_registration/vendor/css-hamburgers/hamburgers.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('public_registration/vendor/animsition/css/animsition.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('public_registration/vendor/select2/select2.min.css')}}">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="{{ asset('public_registration/vendor/daterangepicker/daterangepicker.css')}}">

		<link rel="stylesheet" type="text/css" href="{{ asset('public_registration/css/component.css')}}" />
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('public_registration/css/util.css')}}">
	<link rel="stylesheet" type="text/css" href="{{ asset('public_registration/css/main3.css')}}">
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div id="main-container" class="container-login100" style="background-image: linear-gradient(rgb(25, 181, 254) 39%, rgb(255, 255, 255) 100%);">
			
			<div class="wrap-login100 p-l-25 p-r-25 p-t-0 p-b-0">
				<form class="login100-form validate-form ">
					<span class="login100-form-title p-b-90 p-t-90">
						<img src="{{ asset('public_registration/images/logo_stg_telecom.png')}}" alt="STG TELECOM" class="logo-img">
					</span>

					<div class="wrap-input100 validate-input m-b-23" data-validate = "Seulement les chiffres">
						<span class="label-input100">IMEI 1</span>
						<input class="input100" type="text" id="imei1" name="imei1" placeholder="* * * * * * * * * * * *" autocomplete="off">
						<span class="focus-input100" data-symbol="&#xf02a;"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Seulement les chiffres">
						<span class="label-input100">IMEI 2</span>
						<input class="input100" type="text" id="imei2" name="imei2" placeholder="* * * * * * * * * * * *" autocomplete="off">
						<span class="focus-input100" data-symbol="&#xf02a;"></span>
					</div>
					
					<div class="container-login100-form-btn p-t-100 p-b-100">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button id="btn-imei" class="login100-form-btn">
								Valider
							</button>
						</div>
					</div>
				</form>
			</div>
				<button style="display:none !important;" class="md-trigger" data-modal="modal-12">Just Me</button>
		</div>
	</div>
	<div class=" md-modal md-effect-12 " id="modal-12" style="    box-shadow: 5px 5px 19px #0000007a;" data-backdrop="static">
		<div class="md-content">
			<h3>Client Information</h3>
			<div id="scroll-content">
				<form action="" id="client-info" class="validate-form-modal">
					<div class="row">
						<input type="hidden" id="imei" name="imei" value="">
						@csrf
						<div class="col-xs-12 col-md-6 ">
								<div class="wrap-input100 validate-input m-b-23" data-validate = "Prénom est obligatoire">
								<span class="label-input100">Prénom</span>
								<input class="input100 input-register-form" type="text" id="first_name" name="first_name" placeholder="" autocomplete="off" >
								<span class="focus-input100" ></span>
							</div>
						</div>
						<div class="col-xs-12 col-md-6">
							<div class="wrap-input100 validate-input m-b-23" data-validate = "Nom est obligatoire">
								<span class="label-input100">Nom</span>
								<input class="input100 input-register-form" type="text" id="name" name="last_name" placeholder="" autocomplete="off">
								<span class="focus-input100" ></span>
							</div>
						</div>
						<div class="col-xs-12 col-md-6">
							<div class="wrap-input100 m-b-23">
								<span class="label-input100">Email</span>
								<input class="input100 input-register-form" type="email" id="email" name="email" placeholder="" autocomplete="off">
								<span class="focus-input100" ></span>
							</div>
						</div>
						<div class="col-xs-12 col-md-6">
							<div class="wrap-input100 validate-input m-b-23" >
								<span class="label-input100">Date de vente</span>
								<input class="input100 input-register-form " type="text" name="date_flow" id="birth_date" autocomplete="off">
								<span class="focus-input100" ></span>
							</div>
						</div>
						<div class="col-xs-12 col-md-6">
							<div class="wrap-input100  m-b-23" >
								<span class="label-input100">Adresse</span>
								<input class="input100 input-register-form" type="text" id="address" name="address" placeholder="" autocomplete="off">
								<span class="focus-input100" ></span>
							</div>
						</div>
						<div class="col-xs-12 col-md-6">
							<div class="wrap-input100 validate-input m-b-23" data-validate = "Telephone est obligatoire">
								<span class="label-input100">Téléphone</span>
								<input class="input100 input-register-form" type="tel" d="tel" name="tel"  placeholder="" autocomplete="off">
								<span class="focus-input100" ></span>
							</div>
						</div>
						<div class="col-xs-12 col-md-6">
							<div class="wrap-input100 validate-input m-b-23" data-validate = "Ville est obligatoire">
								<span class="label-input100">Ville</span>
								<input class="input100 input-register-form" type="text" id="city" name="city" placeholder="" autocomplete="off">
								<span class="focus-input100" ></span>
							</div>
						</div>
						<div class="col-xs-12 col-md-6">
							<div class="wrap-input100 validate-input m-b-23" data-validate = "Nature est obligatoire">
								<span class="label-input100">Nature</span>
								<select name="nature" id="nature" class="input-select" required>
									<option value="">-----</option>
									<option value="Particulier">Particulier</option>
									<option value="Entreprise">Entreprise</option>
								</select>
							</div>
							
						</div>
						<div class="col-xs-12 col-md-6">
							<div class="wrap-input100 validate-input m-b-23" data-validate = "CIN est obligatoire">
								<span class="label-input100">CIN</span>
								<input class="input100 input-register-form" type="text" name="num_id" id="id" placeholder="" autocomplete="off" required>
								<span class="focus-input100" ></span>
								<input type="hidden" name="type_id" id="type_id" value="CIN">
							</div>
						</div>
					</div>
					<div class="row justify-content-center">
						<div class="col-5">
							<div class="p-t-30 p-b-30">
								<button id="btn-client" type="submit" class="register-form-btn">
									Inscrire
								</button>
							</div>
							<!-- <button class="md-close">Close me!</button> -->
						</div>
					</div>
				</form>
			</div>
				
			</div>
		</div>
	</div>
	<div class="md-overlay"></div><!-- the overlay element -->
	
	
<!--===============================================================================================-->
	<script src="{{ asset('public_registration/vendor/jquery/jquery-3.2.1.min.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('public_registration/vendor/animsition/js/animsition.min.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('public_registration/vendor/bootstrap/js/popper.js')}}"></script>
	<script src="{{ asset('public_registration/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('public_registration/vendor/select2/select2.min.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('public_registration/vendor/daterangepicker/moment.min.js')}}"></script>
	<script src="{{ asset('public_registration/vendor/daterangepicker/daterangepicker.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('public_registration/vendor/countdowntime/countdowntime.js')}}"></script>
<!--===============================================================================================-->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<!--===============================================================================================-->




<script src="{{ asset('public_registration/js/modalEffects/modernizr.custom.js')}}"></script>
<script src="{{ asset('public_registration/js/modalEffects/classie.js')}}"></script>
<script src="{{ asset('public_registration/js/modalEffects/modalEffects.js')}}"></script>

<script src="{{ asset('public_registration/js/main.js')}}"></script>
<!--===============================================================================================-->

</body>
</html>