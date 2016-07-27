<!DOCTYPE html>
<html>
<head>
  <title><?php echo config_item('app_name') ?></title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <link rel="stylesheet" href="<?php echo base_url("assets/plugins/jquery-ui-1.11.2/jquery-ui.min.css") ?>">
  <link rel="stylesheet" href="<?php echo base_url("assets/plugins/AdminLTE-2.3.3/bootstrap/css/bootstrap.min.css") ?>">
  <link rel="stylesheet" href="<?php echo base_url("assets/plugins/font-awesome-4.6.3/css/font-awesome.min.css") ?>">
  <link rel="stylesheet" href="<?php echo base_url("assets/plugins/ionicons-2.0.1/css/ionicons.min.css") ?>">
  <link rel="stylesheet" href="<?php echo base_url("assets/plugins/AdminLTE-2.3.3/dist/css/AdminLTE.min.css") ?>">
  <link rel="stylesheet" href="<?php echo base_url("assets/plugins/AdminLTE-2.3.3/dist/css/skins/skin-blue.min.css") ?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/plugins/select2-4.0.3/css/select2.min.css')?>"/>
  <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css')?>"/>
  
  <script type="text/javascript" src="<?php echo base_url("assets/plugins/AdminLTE-2.3.3/plugins/jQuery/jQuery-2.2.0.min.js") ?>"></script>
  <script type="text/javascript" src="<?php echo base_url('assets/plugins/select2-4.0.3/js/select2.min.js')?>"/></script>
  <script type="text/javascript" src="<?php echo base_url("assets/plugins/jquery-ui-1.11.2/jquery-ui.min.js") ?>"></script>
  <script type="text/javascript" src="<?php echo base_url("assets/plugins/AdminLTE-2.3.3/bootstrap/js/bootstrap.min.js") ?>"></script>
  <script type="text/javascript" src="<?php echo base_url("assets/plugins/AdminLTE-2.3.3/dist/js/app.min.js") ?>"></script>
  <script type="text/javascript" src="<?php echo base_url('assets/plugins/price_format_plugin.js')?>"/></script>
  <script type="text/javascript" src="<?php echo base_url('assets/js/general.js')?>"/></script>  
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
  <header class="main-header">
    <a href="<?php echo base_url() ?>" class="logo">
      <span class="logo-mini"><b>SBK</b></span>
      <span class="logo-lg"><b><?php echo config_item('app_name') ?></b></span>
    </a>
    <nav class="navbar navbar-static-top" role="navigation">
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <span class="hidden-xs"><?php echo $this->user_login['name'] ?></span>
            </a>
            <ul class="dropdown-menu">
              <li class="user-header">
                <p>
                  <?php echo $this->user_login['name'] ?>
                  <small><?php echo $this->user_login['level_name'] ?></small>
                </p>
              </li>
              <li class="user-footer">
                <div class="pull-left">
                  <?php echo anchor('change_password',$this->lang->line('change_password'),array('class'=>'btn btn-default btn-flat')) ?>
                </div>
                <div class="pull-right">
                  <?php echo anchor('home/logout',$this->lang->line('logout'),array('class'=>'btn btn-default btn-flat')) ?>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <aside class="main-sidebar">
    <section class="sidebar">
      <ul class="sidebar-menu">
        <li class="header"><?php echo strtoupper($this->lang->line('menu')) ?></li>
        <li class="treeview <?php echo active_menu('home',$active_menu)?>"><?php echo anchor('home','<i class="fa fa-home"></i> <span>'.$this->lang->line('home').'</span>')?></li>
        <?php if (array_search($this->user_login['level'], array(1)) !== false): ?>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-database"></i> <span><?php echo $this->lang->line('menu_master_data') ?></span> <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li class="<?php echo active_menu('barang',$active_menu)?>"><?php echo anchor('barang','<i class="fa fa-circle-o"></i> Barang')?></li>
            <li class="<?php echo active_menu('barang_jenis',$active_menu)?>"><?php echo anchor('master/barang_jenis','<i class="fa fa-circle-o"></i> Jenis Barang')?></li>
            <li class="<?php echo active_menu('permintaan_barang_status',$active_menu)?>"><?php echo anchor('master/permintaan_barang_status','<i class="fa fa-circle-o"></i> Status Permintaan Barang')?></li>
            <li class="<?php echo active_menu('toko',$active_menu)?>"><?php echo anchor('master/toko','<i class="fa fa-circle-o"></i> Toko')?></li>
            <li class="<?php echo active_menu('user_level',$active_menu)?>"><?php echo anchor('master/user_level','<i class="fa fa-circle-o"></i> User Level')?></li>
            <li class="<?php echo active_menu('user_status',$active_menu)?>"><?php echo anchor('master/user_status','<i class="fa fa-circle-o"></i> User Status')?></li>
          </ul>
        </li> 
        <?php endif ?>
        <?php if (array_search($this->user_login['level'], array(1,2)) !== false): ?>
        <li class="treeview <?php echo active_menu('permintaan_barang',$active_menu)?>"><?php echo anchor('permintaan_barang','<i class="fa fa-tasks"></i> <span>Permintaan Barang</span>')?></li>
        <?php endif ?>
        <?php if (array_search($this->user_login['level'], array(1,3)) !== false): ?>
        <li class="treeview <?php echo active_menu('permintaan_barang_list',$active_menu)?>"><?php echo anchor('permintaan_barang_list','<i class="fa fa-tasks"></i> <span>List Permintaan Barang</span>')?></li>
        <?php endif ?>
        <?php if (array_search($this->user_login['level'], array(1)) !== false): ?>
        <li class="treeview <?php echo active_menu('user',$active_menu)?>"><?php echo anchor('user','<i class="fa fa-user"></i> <span>'.$this->lang->line('menu_user').'</span>')?></li>
        <?php endif ?>                       
      </ul>
    </section>
  </aside>

  <div class="content-wrapper">
    <?php echo $content ?>
  </div>

  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      Version 1.0
    </div>
    <strong>Copyright &copy; 2016 <a href="#">Bayu</a>.</strong> All rights reserved.
  </footer>
  <div class="control-sidebar-bg"></div>
</div>
<script type="text/javascript">
  $('li.active').parent().parent().addClass('active');
  $('li.active').parent().parent().parent().parent().addClass('active');
</script>     
</body>
</html>
