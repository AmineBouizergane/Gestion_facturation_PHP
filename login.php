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

	<link rel="stylesheet" href="<?=WEB_ROOT?>assets/css/style.css">
	<!--[if lt IE 9]>
			<script src="<?=WEB_ROOT?>assets/js/html5shiv.min.js"></script>
			<script src="<?=WEB_ROOT?>assets/js/respond.min.js"></script>
		<![endif]-->
</head>

<body>

	<div class="main-wrapper login-body">
		<div class="login-wrapper">
			<div class="container">
				<img class="img-fluid logo-dark mb-2" src="<?=WEB_ROOT?>assets/img/logo-blue.svg" alt="Logo">
				<div class="loginbox">
					<div class="login-right">
						<div class="login-right-wrap">
							<h1>Login</h1>
							<form action="<?=WEB_ROOT?>login" method="post" name="registerform">
								<div class="form-group">
									<label class="form-control-label">Email Address</label>
									<input type="email" class="form-control"  name="username" value="admin@omega-pave.com">
								</div>
								<div class="form-group">
									<label class="form-control-label">Password</label>
									<div class="pass-group">
										<input type="password" class="form-control pass-input" name="password" value="omega2010">
										<span class="fas fa-eye toggle-password"></span>
									</div>
								</div>
								<button class="btn btn-lg btn-block btn-primary" type="submit" name="login_btn">Login</button>
								
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>


	<script src="<?=WEB_ROOT?>assets/js/jquery-3.5.1.min.js"></script>

	<script src="<?=WEB_ROOT?>assets/js/popper.min.js"></script>
	<script src="<?=WEB_ROOT?>assets/js/bootstrap.min.js"></script>

	<script src="<?=WEB_ROOT?>assets/js/feather.min.js"></script>

	<script src="<?=WEB_ROOT?>assets/js/script.js"></script>
</body>

</html>