<head>
  <script src="/assets/Flexigrid-master/js/flexigrid.js"></script>
  <script src="/assets/dist/js/formvalidation.js"></script>

<!--
  <script src="/assets/quickblox/quickblox.min.js"></script>

  <script src="/assets/quickblox/qbconfig.js"></script>
  <script src="/assets/quickblox/qbinit.js"></script>
-->
</head>

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Edit user info..
      <small>Edit user info manually</small>
    </h1>
  </section>

  <div class="box box-primary">
  <div class="box-header with-border">
    <h3 class="box-title">User info</h3>
  </div>
  <!-- /.box-header -->
  <!-- form start -->
  <?php echo form_open( $page . '/save', array("id"=>"save_user_form")); ?>
    <input type="hidden" name="id" value='<?= $param->id ?>'>
    <div class="row">
      <div class="col-md-6">
        <div class="box-body">
          <div class="form-group"><label>Email address</label><input name="username" type="text" value='<?= $param->username ?>' class="form-control" placeholder="Password"></div>
          <div class="form-group"><label >Fist name</label><input name="firstname" type="text" value='<?= $param->firstname ?>' class="form-control" placeholder="First name"></div>
          <div class="form-group"><label >Last name</label><input name="lastname" type="text" value='<?= $param->lastname ?>' class="form-control" placeholder="Last name"></div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="box-body">
          <div class="form-group"><label >Role</label>
            <?= $param->rolesHTML ?>
          </div>
          <div class="form-group"><label >Status</label>
            <input name="status" type="text" value='<?= $param->status ?>' class="form-control" placeholder="Status">
          </div>
          <input class="changepassword" type="checkbox" />&nbsp;&nbsp;&nbsp;Change password
          <div class="form-group"><label>Password</label><input name="password" type="password" class="form-control" placeholder="Password"></div>
          <div class="form-group"><label>Confirm Password</label><input name="confirmpassword" type="password" class="form-control" placeholder="Confirm password"></div>
        </div>
      </div>
    </div>
    <div class="box-footer" style="text-align:right">
      <button type="submit" class="btn btn-flat btn-girdtoolbar">SAVE</button>
    </div>
  </form>
</div>


<!--
    Javascript calls.....
-->
<script>
$(function() {
  $(document).ready(function(evt) {
      var date = new Date();

      $('.changepassword').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: '20%' // optional
      });

     $("#save_user_form").submit(function(evt) {
        if (!validate("input[name='username']", "text", "Please input username correctly.")) { evt.preventDefault(); return;}
        if (!validate("input[name='firstname']", "text", "Please input first name correctly.")) { evt.preventDefault(); return;}
        if (!validate("input[name='lastname']", "text", "Please input last name correctly.")) { evt.preventDefault(); return;}

        if (!validate("input[name='password']", "text", "Please input last name correctly.")) { evt.preventDefault(); return;}
        if (!validate("input[name='lastname']", "text", "Please input last name correctly.")) { evt.preventDefault(); return;}
     });
  });
});
</script>