
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Koperasi Makmur | Log in</title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<!-- Bootstrap 3.3.7 -->
	<link rel="stylesheet" href="<?php echo base_url('assetAdmin/bower_components/bootstrap/dist/css/bootstrap.min.css'); ?>" rel="stylesheet">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="<?php echo base_url('assetAdmin/bower_components/font-awesome/css/font-awesome.min.css'); ?>" rel="stylesheet">
	<!-- Ionicons -->
	<link rel="stylesheet" href="<?php echo base_url('assetAdmin/bower_components/Ionicons/css/ionicons.min.css'); ?>" rel="stylesheet">
	<!-- Theme style -->
	<link rel="stylesheet" href="<?php echo base_url('assetAdmin/dist/css/AdminLTE.min.css'); ?>" rel="stylesheet">
	<!-- iCheck -->
	<link rel="stylesheet" href="<?php echo base_url('assetAdmin/plugins/iCheck/square/blue.css'); ?>" rel="stylesheet">

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

	<!-- Google Font -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page">
<div class="login-box">
	<div class="login-logo">
		<a href="../../index2.html"><b>Koperasi</b>Makmur</a>
	</div>

	<div style="color: red;margin-bottom: 15px;">
		<?php
		// Cek apakah terdapat session nama message
		if($this->session->flashdata('message')){ // Jika ada
			echo $this->session->flashdata('message'); // Tampilkan pesannya
		}
		?>
	</div>
	<!-- /.login-logo -->
	<div class="login-box-body">
		<p class="login-box-msg">Sign in to start the sistem</p>

		<form action="<?php echo base_url('Auth/login')?>" method="post">
			<div class="form-group has-feedback">
				<input type="Username" class="form-control" placeholder="Username" name="username">
				<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
			</div>
			<div class="form-group has-feedback">
				<input type="password" class="form-control" placeholder="Password" name="password">
				<span class="glyphicon glyphicon-lock form-control-feedback"></span>
			</div>
			<div class="row">
				<!-- /.col -->
				<div class="col-xs-4">
					<button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
				</div>
				<!-- /.col -->
			</div>
		</form>
		<a href="register.html" class="text-center">Register a new employee</a>

	</div>
	<!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="<?php echo base_url('assetAdmin/bower_components/jquery/dist/jquery.min.js'); ?>"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url('assetAdmin/bower_components/bootstrap/dist/js/bootstrap.min.js'); ?>"></script>
<!-- iCheck -->
<script src="<?php echo base_url('assetAdmin/plugins/iCheck/icheck.min.js'); ?>"></script>
<script>
	$(function () {
		$('input').iCheck({
			checkboxClass: 'icheckbox_square-blue',
			radioClass: 'iradio_square-blue',
			increaseArea: '20%' /* optional */
		});
	});
</script>
</body>
</html>
