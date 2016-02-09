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
      Edit Ingredient info..
      <small>Edit Ingredient info manually</small>
    </h1>
  </section>

  <div class="box box-primary">
  <div class="box-header with-border">
    <h3 class="box-title">Pattern info</h3>
  </div>
  <!-- /.box-header -->
  <!-- form start -->
  <?php echo form_open( $page . '/save', array("id"=>"save_form")); ?>
    <input type="hidden" name="id" value='<?= $param->id ?>'>
    <input type='hidden' name='isNew' value='<?= $param->isNew ?>'>

    <input type='hidden' name='selIngs'/>

    <div class="row">
      <div class="col-md-2">
        <div class="box-body">
          <div class="form-group"><label>First name</label><input name="firstname" type="text" value='<?= $param->firstname ?>' class="form-control" placeholder="First name"></div>
          <div class="form-group"><label>Last name</label><input name="lastname" type="text" value='<?= $param->lastname ?>' class="form-control" placeholder="Last name"></div>

          <div class="form-group"><label>Company</label><input name="company" type="text" value='<?= $param->company ?>' class="form-control" placeholder="Company"></div>

          <div class="form-group"><label>Email</label><input name="email" type="text" value='<?= $param->email ?>' class="form-control" placeholder="Email"></div>
          <div class="form-group"><label>Best time to call us</label><input name="besttimetocall" type="text" value='<?= $param->besttimetocall ?>' class="form-control" placeholder="Best time to call us"></div>
          <div class="form-group"><label>How did you hear about us?</label><input name="hearaboutus" type="text" value='<?= $param->hearaboutus ?>' class="form-control" placeholder="How did you hear about us?"></div>
          <div class="form-group"><label>How can we help?</label><input name="howcanwehelp" type="text" value='<?= $param->howcanwehelp ?>' class="form-control" placeholder="How can we help?"></div>

          <input type='hidden' name='status'/>
          <input type='hidden' name='share'/>
          
        </div>
      </div>
      <div class="col-md-7">
        <div class="box-body">
          <label>Projects</label><br/>
          <div id="projects">
          </div>
        </div>
      </div>
      <div class="col-md-3">
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


<script src="/assets/dist/js/edit/systems.js"></script>