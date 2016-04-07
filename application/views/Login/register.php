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
    <?php echo form_open('/Login/register', array("id"=>"register")); ?>
    <?php
      if (isset($error) && $error != "") {
        echo "<p style='color:#FF8264'>$error.</p>";
      }
      if (isset($info) && $info != "") {
        echo "<p style='color:#FFE000'>$info";
      }
    ?>
      <div class="form-group has-feedback">
        <input name="firstname" type="text" class="form-control" placeholder="First name">
        <i class="input-icon fa fa-user"></i>
      </div>

      <div class="form-group has-feedback">
        <input name="lastname" type="text" class="form-control" placeholder="Last name">
        <i class="input-icon fa fa-user"></i>
      </div>

      <div class="form-group has-feedback">
        <input name="email" type="email" class="form-control" placeholder="Email">
        <i class="input-icon fa fa-at"></i>
      </div>

      <div class="form-group has-feedback">
        <input name="password" type="password" class="form-control" placeholder="Password">
        <i class="input-icon fa fa-lock"></i>
      </div>

      <div class="form-group has-feedback">
        <input name="confirmpassword" type="password" class="form-control" placeholder="Confirm password">
        <i class="input-icon fa fa-lock"></i>
      </div>

      <div class="row">
        <!-- /.col -->
        <div class="col-xs-12">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Sign Up</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

    <div class='signup'>I have already account. <a href='/Login'>&nbsp;&nbsp;Sign In.</a></div>
    <!-- /.social-auth-links -->
<!--
    <a href="#">I forgot my password</a><br>
    <a href="register.html" class="text-center">Register a new membership</a>
-->
  </div>
  <!-- /.login-box-body -->
</div>
<script src="/assets/dist/js/formvalidation.js"></script>
<script src="/assets/dist/js/pages/register.js"></script>

</body>
</html>