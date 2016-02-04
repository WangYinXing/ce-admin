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
      Edit Pattern info..
      <small>Edit Pattern info manually</small>
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
    <div class="row">
      <div class="col-md-6">
        <div class="box-body">
          <div class="form-group"><label>Pattern name</label><input name="name" type="text" value='<?= $param->name ?>' class="form-control" placeholder="Pattern name"></div>
        </div>
      </div>
      <div class="col-md-6">
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
     $("#save_form").submit(function(event) {
        if (!validate("input[name='name']", "text", "Please input pattern name correctly.")) { event.preventDefault(); return;}
     });
  });
});
</script>