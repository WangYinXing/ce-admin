<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

<?php $this->view('Login/header');?>

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
    <?php if (isset($error) && $error != "") { echo "<p style='color:#FF8264'>$error</p>"; } ?>
    <?php if (isset($info) && $info != "") { echo "<p style='color:#FFE000'>$info</p>"; } ?>
      <div class="form-group has-feedback">
        <input name="username" type="text" class="form-control" placeholder="email">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input name="password" type="password" class="form-control" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <input id="remeberme" type="checkbox" name="checkbox" ><label for="remeberme">&nbsp;&nbsp;Remeber me</label>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

    <div class='signup'>I don't have account. <a href='/Login/register'>&nbsp;&nbsp;Sign up.</a></div>

    <div style="display:none" class="social-auth-links text-center">
      <p>- OR -</p>
      <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using Facebook</a>
      <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using Google+</a>
    </div>
    <!-- /.social-auth-links -->
<!--
    <a href="#">I forgot my password</a><br>
    <a href="register.html" class="text-center">Register a new membership</a>
-->
  </div>
  <!-- /.login-box-body -->
</div>
</body>
</html>