<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<!-- Font Awesome -->
  <link rel="stylesheet" href="/assets/font-awesome-4.4.0/font-awesome-4.4.0/css/font-awesome.min.css">
	<!-- Ionicons -->

	
	<!-- Bootstrap 3.3.5 -->
	<link rel="stylesheet" href="/assets/bootstrap/css/bootstrap.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="/assets/dist/css/AdminLTE.min.css">
	<!-- iCheck -->
	<link rel="stylesheet" href="/assets/plugins/iCheck/square/blue.css">

	<script src="/assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>
	<script src="/assets/bootstrap/js/bootstrap.min.js"></script>
	<script src="/assets/plugins/iCheck/icheck.min.js"></script>

	<link rel="stylesheet" href="/assets/dist/css/common.css">
  <link rel="stylesheet" href="/assets/dist/css/skin-custom.css">
</head>



<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <img src="/assets/ce-logo.png" />
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
   <?php echo validation_errors(); ?>
   <?php echo form_open('/Login/login_user'); ?>
   <?php if ($error) { echo "<p style='color:#FF8264'>Failed to login.</p>"; } ?>
      <div class="form-group has-feedback">
        <input name="username" type="text" class="form-control" placeholder="User name">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input name="password" type="password" class="form-control" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox">&nbsp;Remember Me
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

    <div style="display:none" class="social-auth-links text-center">
      <p>- OR -</p>
      <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using
        Facebook</a>
      <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using
        Google+</a>
    </div>
    <!-- /.social-auth-links -->
<!--
    <a href="#">I forgot my password</a><br>
    <a href="register.html" class="text-center">Register a new membership</a>
-->
  </div>
  <script>
	  $(function () {
	    $('input').iCheck({
	      checkboxClass: 'icheckbox_square-blue',
	      radioClass: 'iradio_square-blue',
	      increaseArea: '20%' // optional
	    });
	  });
  </script>
  <!-- /.login-box-body -->
</div>
</body>
</html>