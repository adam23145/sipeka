<html lang="en">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="msapplication-tap-highlight" content="no">
	<title>Login Page | SIPEKA</title>

	<link rel="icon" type="image/png" href="<?php echo base_url(); ?>public/assets/core/images/logo1.png" sizes="32x32" />
	<!-- Favicons-->
	<!--link rel="icon" href="<?php //echo base_url();
								?>public/assets/additional/login/images/favicon/favicon-32x32.png" -->
	<!-- Favicons-->
	<link rel="apple-touch-icon-precomposed" href="<?php echo base_url(); ?>public/assets/additional/login/images/favicon/apple-touch-icon-152x152.png">
	<!-- For iPhone -->
	<meta name="msapplication-TileColor" content="#00bcd4">
	<meta name="msapplication-TileImage" content="<?php echo base_url(); ?>public/assets/additional/login/images/favicon/mstile-144x144.png">
	<!-- For Windows Phone -->

	<link rel="stylesheet" href="<?php echo base_url(); ?>public/assets/vendors/css/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">


	<!-- CORE CSS-->

	<link href="<?php echo base_url(); ?>public/assets/additional/login/css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection">
	<link href="<?php echo base_url(); ?>public/assets/additional/login/css/style.css" type="text/css" rel="stylesheet" media="screen,projection">
	<link href="<?php echo base_url(); ?>public/assets/additional/login/css/page-center.css" type="text/css" rel="stylesheet" media="screen,projection">

	<!-- INCLUDED PLUGIN CSS ON THIS PAGE -->
	<link href="<?php echo base_url(); ?>public/assets/additional/login/css/prism.css" type="text/css" rel="stylesheet" media="screen,projection">
	<link href="<?php echo base_url(); ?>public/assets/additional/login/js/plugins/perfect-scrollbar/perfect-scrollbar.css" type="text/css" rel="stylesheet" media="screen,projection">
	<style>
		.limiter {
			width: 100%;
			margin: 0 auto;
		}

		.container-login100 {
			width: 100%;
			min-height: 70px;
			display: -webkit-box;
			display: -webkit-flex;
			display: -moz-box;
			display: -ms-flexbox;
			display: flex;
			flex-wrap: wrap;
			justify-content: center;
			align-items: center;
			background: #f2f2f2;
		}

		.wrap-login100 {
			width: 100%;
			background: #fff;
			overflow: hidden;
			display: -webkit-box;
			display: -webkit-flex;
			display: -moz-box;
			display: -ms-flexbox;
			display: flex;
			flex-wrap: wrap;
			align-items: stretch;
			flex-direction: row-reverse;
		}

		.login100-form {
			width: 560px;
			min-height: 70px;
			display: block;
			background-color: #fff;
			padding: 53px 55px 24px 55px;
		}

		.login100-more {
			width: calc(100% - 560px);
			background-repeat: no-repeat;
			background-size: cover;
			background-position: center;
			position: relative;
			z-index: 1;
		}

		.responsive {
			width: 100%;
			max-width: 500px;
			height: auto;
		}
	</style>
</head>

<body class="grey" id="mod-login">
	<!-- Start Page Loading -->
	<div id="loader-wrapper">
		<div id="loader"></div>
		<div class="loader-section section-left"></div>
		<div class="loader-section section-right"></div>
	</div>
	<!-- End Page Loading -->

	<div id="login-page" class="row">
		<div class="limiter">
			<div class="container-login100">
				<div class="wrap-login100">
					<form class="login100-form" id="loginform" method="POST">
						<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
						<div class="row">
							<div class="input-field col s12 center">
								<!--img src="<?php echo base_url(); ?>public/assets/core/images/logo1.png" alt="" class="responsive-img valign profile-image-login" -->
								<h1 class="center login-form-text">Silahkan Login Dengan Akun Anda</h1>
							</div>
						</div>
						<div class="row margin">
							<div class="input-field col s12" style="margin-bottom: -16px;">
								<i class="mdi-content-mail prefix"></i>
								<input name="userid" id="username" type="text">
								<label for="username" class="center-align">Email</label>
							</div>
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label for="username" class="center-align">@trunojoyo.ac.id / @student.trunojoyo.ac.id</label>
						</div>
						<div class="row margin">
							<div class="input-field col s12">
								<i class="mdi-action-lock-outline prefix"></i>
								<input name="password" id="password" type="password">
								<label for="password">Password</label>
							</div>
						</div>
						<div class="row">
							<div class="input-field col s12">
								<button class="btn waves-effect waves-light col s12" type="submit">Sign In</button>
							</div>
						</div>
					</form>
					<div class="login100-more" style="text-align: center; padding: 40px; max-width: 600px; margin: 0 auto;">
						<img class="responsive" src="<?php echo base_url(); ?>public/assets/core/images/logo1.png" alt="Logo" style="width: 150px; margin-bottom: 20px;">
						<p style="text-align: justify;">
							<strong>Visi:</strong><br>
							Pada tahun 2030, menjadi institusi yang mampu mewujudkan lulusan yang cerdas, berdaya saing, berakhlakul karimah, dan unggul dalam pendidikan serta riset berdasarkan potensi Madura.<br><br>

							<strong>Misi:</strong><br>
						</p>
						<ul style="text-align: justify;">
							<li>1. Menyelenggarakan layanan pendidikan yang berkualitas, relevan, dan kompeten untuk penguatan ilmu pengetahuan, teknologi, serta iman dan takwa.</li>
							<li>2. Menyelenggarakan kegiatan penelitian dan pengabdian masyarakat berdasarkan potensi Madura secara berkesinambungan dalam mendukung proses pembelajaran dan publikasi ilmiah.</li>
							<li>3. Meningkatkan jejaring kerja sama dengan pemerintah, swasta, industri, pondok pesantren, alumni, dan lembaga pendidikan di dalam dan luar negeri yang dapat menunjang pengembangan potensi Madura.</li>
							<li>4. Meningkatkan tata kelola perguruan tinggi menggunakan prinsip kredibel, transparan, akuntabel, tanggung jawab, dan adil.</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>

<!-- jQuery Library -->
<script type="text/javascript" src="<?php echo base_url(); ?>public/assets/additional/login/js/jquery-1.11.2.min.js"></script>
<!--materialize js-->
<script type="text/javascript" src="<?php echo base_url(); ?>public/assets/additional/login/js/materialize.js"></script>
<!--prism-->
<script type="text/javascript" src="<?php echo base_url(); ?>public/assets/additional/login/js/prism.js"></script>
<!--scrollbar-->
<script type="text/javascript" src="<?php echo base_url(); ?>public/assets/additional/login/js/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script src="<?php echo base_url(); ?>public/assets/vendors/js/sweetalert2/dist/sweetalert2.min.js"></script>
<script src="<?php echo base_url(); ?>public/assets/vendors/js/sweetalert2.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>public/assets/additional/login/js/plugins.js"></script>


<script type="text/javascript">
	$(document).ready(function() {
		$("#loginform").submit(function() {
			Swal({
				title: 'Please wait . . .',
				allowOutsideClick: false,
				onBeforeOpen: () => {
					Swal.showLoading()
				}
			});
			$.ajax({
				type: "POST",
				url: "<?php echo base_url() . 'login/verifylogin' ?>",
				data: $(this).serialize(),
				success: function(data) {
					if (data == 0) {
						swal({
							type: 'warning',
							title: 'Oops...',
							text: 'Kombinasi User ID dengan Password tidak sesuai!',
							confirmButtonColor: '#3085d6',
							confirmButtonText: 'Oke, saya coba lagi'
						});
					} else if (data == 1) {
						window.location.replace("<?php echo base_url() . 'home' ?>");
					}
				}
			});
			return false;
		});

	});
</script>

</html>