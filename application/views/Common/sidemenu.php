<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel hidden">
      <div class="pull-left image">
        <img src="<?php echo base_url('assets/dist/img/user2-160x160.jpg'); ?>" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p>
          <?php echo $session->userdata('username')?>
        </p>
        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu">
      <li <?php if ($page == 'Dashboard') echo "class='active'";?>>
        <a href='<?php echo site_url("dashboard"); ?>'>
          <i class="fa fa-dashboard"></i> <span>DASHBOARD</span>
        </a>
      </li>
      <li class="<?php if ($page == 'Accounts') echo 'active';?>">
        <a href='<?php echo site_url("accounts"); ?>'>
          <i class="fa fa-user"></i> <span>ACCOUNTS</span>
        </a>
      </li>
      <li class="<?php if ($page == 'Colors' || $page == 'Patterns') echo 'active';?>" class='treeview'>
        <a href='<?php echo site_url("colors"); ?>'>
          <i class="fa fa-balance-scale"></i> <span>INGREDIENT</span><i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            <li class="<?php if ($page == 'Colors') echo 'active';?>"><a href='<?php echo site_url("colors"); ?>'><i class="fa fa-circle-o"></i> Color</a></li>
            <li class="<?php if ($page == 'Patterns') echo 'active';?>"><a href='<?php echo site_url("patterns"); ?>'><i class="fa fa-circle-o"></i> Pattern</a></li>
          </ul>
      </li>
      <li class="<?php if ($page == 'Systems') echo 'active';?>">
        <a href='<?php echo site_url("systems"); ?>'>
          <i class="fa fa-th"></i> <span>SYSTEMS</span>
        </a>
      </li>
      <li class="<?php if ($page == 'Leads') echo 'active';?>">
        <a href='<?php echo site_url("systems"); ?>'>
          <i class="fa fa-table"></i> <span>LEADS</span>
        </a>
      </li>
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>