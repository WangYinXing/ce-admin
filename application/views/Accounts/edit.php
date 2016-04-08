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
    <input type='hidden' name='isNew' value='<?= $param->isNew ?>'>
    <div class="row">
      <div class="col-md-4">
        <div class="box-body">
          <div class="form-group"><label>Email address</label><input <?php if (!$param->isNew) echo 'readonly'; ?> name="username" type="text" value='<?= $param->username ?>' class="form-control" placeholder="email or usename"></div>
          <div class="form-group"><label >Fist name</label><input name="firstname" type="text" value='<?= $param->firstname ?>' class="form-control" placeholder="First name"></div>
          <div class="form-group"><label >Last name</label><input name="lastname" type="text" value='<?= $param->lastname ?>' class="form-control" placeholder="Last name"></div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="box-body">
          <div class="form-group"><label >Role</label>
            <?= $param->rolesHTML ?>
          </div>
          <div class="form-group hidden"><label >Status</label>
            <input name="status" type="text" value='<?= $param->status ?>' class="form-control" placeholder="Status">
          </div>
          <?php
            if (!$param->isNew) {
              echo '<input id="changepassword" type="checkbox" name="checkbox" value="1"><label for="changepassword">&nbsp;&nbsp;Change password</label>';
            }
          ?>
          <div class="form-group"><label>Password</label>
            <input name="password" type="password" class="form-control" placeholder="Password" <?php if (!$param->isNew) echo "disabled='true'" ?> />
          </div>
          <div class="form-group"><label>Confirm Password</label>
            <input name="confirmpassword" type="password" class="form-control" placeholder="Confirm password" <?php if (!$param->isNew) echo "disabled='true'" ?> />
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="box-body">
          <?php $this->view( 'Common/dbinfo') ?>
        </div>
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

      $('#changepassword').change( function() {
        $("input[name='password']").prop("disabled", !$(this).prop("checked"));
        $("input[name='confirmpassword']").prop("disabled", !$(this).prop("checked"));
      });

     $("#save_user_form").submit(function(event) {
        if (!validate("input[name='username']", "text", "Please input username correctly.")) { event.preventDefault(); return;}
        if (!validate("input[name='firstname']", "text", "Please input first name correctly.")) { event.preventDefault(); return;}
        if (!validate("input[name='lastname']", "text", "Please input last name correctly.")) { event.preventDefault(); return;}

        if ($('#changepassword').prop("checked") || $("input[name='isNew']").val()) {
          if ($("input[name='password']").val() == "") {
            alert("Please input password.");

            event.preventDefault();
            return;
          }
          if ($("input[name='password']").val() != $("input[name='confirmpassword']").val()) {
            alert("Password doesn't match.");

            event.preventDefault();
            return;
          }
          if ($("input[name='password']").val().length < 6) {
            alert("Password should be longer than 6 characters.");

            event.preventDefault();
            return;
          }



        }
     });
  });
});
</script>