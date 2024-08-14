<?php if(!defined('myweb')){ exit(); }?>

<!DOCTYPE html>
<html class="loading" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
	<meta name="description" content="K-means merupakan salah satu algoritma clustering . Tujuan algoritma ini yaitu untuk membagi data menjadi beberapa kelompok. Algoritma ini menerima masukan berupa data tanpa label kelas.">
	<meta name="keywords" content="">
	<meta name="author" content="">
	<title>Aplikasi Sistem Penentuan Keputusan Metode NAIVE BAYES - Rizky <?php echo date('Y'); ?></title>
	<link rel="shortcut icon" type="image/x-icon" href="<?php echo $www; ?>favicon.ico">
	<link rel="shortcut icon" type="image/png" href="<?php echo $www; ?>favicon.ico">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-touch-fullscreen" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="default">
	<link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,700,900%7CMontserrat:300,400,500,600,700,800,900" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="<?php echo $www; ?>assets/fonts/feather/style.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo $www; ?>assets/fonts/simple-line-icons/style.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo $www; ?>assets/fonts/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo $www; ?>assets/vendors/css/perfect-scrollbar.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo $www; ?>assets/vendors/css/prism.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo $www; ?>assets/vendors/css/switchery.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo $www; ?>assets/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo $www; ?>assets/css/bootstrap-extended.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo $www; ?>assets/css/colors.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo $www; ?>assets/css/components.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo $www; ?>assets/css/themes/layout-dark.min.css">
	<link rel="stylesheet" href="<?php echo $www; ?>assets/css/plugins/switchery.min.css">
	<link rel="stylesheet" href="<?php echo $www; ?>assets/css/pages/authentication.css">
	<link rel="stylesheet" type="text/css" href="<?php echo $www; ?>assets/css/style.css">
	<script src="<?php echo $www; ?>assets/vendors/js/vendors.min.js"></script>
	<script src="<?php echo $www; ?>assets/vendors/js/switchery.min.js"></script>
	<script src="<?php echo $www; ?>assets/js/core/app-menu.min.js"></script>
	<script src="<?php echo $www; ?>assets/js/core/app.min.js"></script>
	<script src="<?php echo $www; ?>assets/js/notification-sidebar.min.js"></script>
	<script src="<?php echo $www; ?>assets/js/customizer.min.js"></script>
	<script src="<?php echo $www; ?>assets/js/scroll-top.min.js"></script>
	<script src="<?php echo $www; ?>assets/js/sweetalert2.all.min.js"></script>
	<link href="<?php echo $www; ?>assets/css/sweetalert2.min.css" rel="stylesheet">
</head>
<body class="vertical-layout vertical-menu 1-column auth-page navbar-sticky blank-page" data-menu="vertical-menu" data-col="1-column">
	<div class="wrapper">
		<div class="main-panel">
			<div class="main-content">
				<div class="content-overlay"></div>
				<div class="content-wrapper">
					<section id="login" class="auth-height">
						<div class="row full-height-vh m-0">
							<div class="col-12 d-flex align-items-center justify-content-center">
								<div class="card overflow-hidden">
									<div class="card-content">
										<div class="card-body auth-img">
											<div class="row m-0">
												<div class="col-lg-6 d-none d-lg-flex justify-content-center align-items-center auth-img-bg p-3">
													<img src="<?php echo $www; ?>assets/img/gallery/login.png" alt="" class="img-fluid" width="300" height="230">
												</div>
												<div class="col-lg-6 col-12 px-4 py-3" style="max-width: 500px;">
													<h4 class="mb-2 card-title">Login</h4>
													<p>Selamat datang di Aplikasi SPK Metode NAIVE BAYES</p>
													<form action="<?php echo $www; ?>login.php" method="post" id="form_login">
														<input type="text" name="username" value="admin" class="form-control mb-3" placeholder="Username">
														<input type="password" name="password" value="admin" class="form-control mb-2" placeholder="Password">
														<!-- <div class="d-sm-flex justify-content-between mb-3 font-small-2">
														<div class="remember-me mb-2 mb-sm-0">
														<div class="checkbox auth-checkbox">
														<input type="checkbox" id="auth-ligin">
														<label for="auth-ligin"><span>Remember Me</span></label>
														</div>
														</div>
														<a href="#">Forgot Password?</a>
														</div> -->
														<div class="d-flex justify-content-between flex-sm-row flex-column">
															<!-- <a href="#" class="btn bg-light-primary mb-2 mb-sm-0">Register</a> -->
															<button type="submit" id="btn_login" class="btn btn-primary">Login</button>
														</div>
													</form>
													<hr>
													<!-- <div class="d-flex justify-content-between align-items-center">
													<h6 class="text-primary m-0">Or Login With</h6>
													<div class="login-options">
													<a class="btn btn-sm btn-social-icon btn-facebook mr-1"><span class="fa fa-facebook"></span></a>
													<a class="btn btn-sm btn-social-icon btn-twitter mr-1"><span class="fa fa-twitter"></span></a>
													</div>
													</div> -->

													<p style="word-wrap: break-word;">Naive Bayes merupakan pengklasifikasian dengan metode
													probabilitas dan statistik yang dikemukan oleh ilmuwan Inggris Thomas Bayes, yaitu
													memprediksi peluang di masa depan berdasarkan pengalaman di masa sebelumnya.</p>
													<hr>
													Copyright &copy; <?php echo date('Y'); ?> <a href="https://upi-yai.ac.id/page/teknik-informatika-s-1">Universitas Persada Indonesia YAI</a>
												</div>
											</div>

										</div>
									</div>
								</div>
							</div>
						</div>



					</section>
				</div>
			</div>
		</div>
	</div>

	<script type="text/javascript">
	jQuery(document).ready(function() {
		$('#form_login').submit(function (e) {
			data = $(this).serializeArray();
			data.push({'name': 'login', 'value': 'true'});
			$.ajax({
				type: 'POST',
				url: $(this).attr('action'),
				data: data,
				beforeSend: function(data) {
					$('#btn_login').prop('disabled', true);
					$('#btn_login').html('<span class="spinner-border spinner-border-sm me-05" role="status" aria-hidden="true"></span> Loading');
				},
				error: function(xhr, status, error) {
					$('#btn_login').prop('disabled', false);
					$('#btn_login').html('Login');
					Swal.fire({
						text: xhr.responseText,
						icon: "error",
						buttonsStyling: !1,
						confirmButtonText: "OK",
						customClass: { confirmButton: "btn btn-primary" },
					});
				},
				success: function(data) {
					location.reload();
				}
			});
			e.preventDefault();
		});
	});

	</script>

</body>

</html>