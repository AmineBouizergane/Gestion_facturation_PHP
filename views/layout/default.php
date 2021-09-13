<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
	<title>Omega Pave - Admin</title>

	<link rel="shortcut icon" href="<?=WEB_ROOT?>assets/img/favicon.png">

	<link rel="stylesheet" href="<?=WEB_ROOT?>assets/css/bootstrap.min.css">

	<link rel="stylesheet" href="<?=WEB_ROOT?>assets/plugins/fontawesome/css/fontawesome.min.css">
	<link rel="stylesheet" href="<?=WEB_ROOT?>assets/plugins/fontawesome/css/all.min.css">

	<link rel="stylesheet" href="<?=WEB_ROOT?>assets/css/bootstrap-datetimepicker.min.css">

	<link rel="stylesheet" href="<?=WEB_ROOT?>assets/css/style.css">
	<!--[if lt IE 9]>
			<script src="<?=WEB_ROOT?>assets/js/html5shiv.min.js"></script>
			<script src="<?=WEB_ROOT?>assets/js/respond.min.js"></script>
		<![endif]-->
</head>

<body>

	<div class="main-wrapper">

		<div class="header">

			<div class="header-left">
				<a href="index.html" class="logo">
					<img src="<?=WEB_ROOT?>assets/img/logo.svg" alt="Logo">
				</a>
				<a href="index.html" class="logo logo-small">
					<img src="<?=WEB_ROOT?>assets/img/logo-small.svg" alt="Logo" width="60">
				</a>
			</div>

			<a class="mobile_btn" id="mobile_btn">
				<i class="fas fa-bars"></i>
			</a>


			<ul class="nav user-menu">
				<li class="nav-item dropdown has-arrow main-drop">
					<a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
						<span class="user-img" >
							<img src="<?=WEB_ROOT?>assets/img/profiles/profile.png" style="border-radius: 0%;" alt="">
							<span class="status online"></span>
						</span>
						<span>Admin</span>
					</a>
					<div class="dropdown-menu">
						<a class="dropdown-item" href="<?=WEB_ROOT?>login/log_out"><i data-feather="log-out" class="mr-1"></i>
							Logout</a>
					</div>
				</li>

			</ul>

		</div>


		<?=$content_for_layout?>

	</div>


	
</body>

	<script src="<?=WEB_ROOT?>assets/js/jquery-3.5.1.min.js"></script>
	
	<script type="text/javascript" src="<?=WEB_ROOT?>assets/js/jautocalc.js"></script>

	<script src="<?=WEB_ROOT?>assets/js/popper.min.js"></script>
	<script src="<?=WEB_ROOT?>assets/js/bootstrap.min.js"></script>

	<script src="<?=WEB_ROOT?>assets/js/feather.min.js"></script>

	<script src="<?=WEB_ROOT?>assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>

	<script src="<?=WEB_ROOT?>assets/plugins/apexchart/apexcharts.min.js"></script>
	<script src="<?=WEB_ROOT?>assets/plugins/apexchart/chart-data.js"></script>

	<script src="<?=WEB_ROOT?>assets/js/script.js"></script>
	
	<script src="<?=WEB_ROOT?>assets/js/bootstrap-datetimepicker.min.js"></script>

</html>