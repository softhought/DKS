<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>DKS</title>
 <!-- Font Awesome -->
 <link rel="stylesheet" href="<?php echo(base_url());?>assets/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo(base_url());?>assets/plugins/datatables-bs4/css/dataTables.bootstrap4.css">

  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo(base_url());?>assets/dist/css/adminlte.min.css">
  <!-- Bootstrap Select -->
  <link rel="stylesheet" href="<?php echo(base_url());?>assets/css/bootstrap-select.css">

  <!--  -->
  <link rel="stylesheet" href="<?php echo(base_url());?>assets/plugins/sweetalert2/sweetalert2.min.css">



  <!-- Bootstrap4 Duallistbox -->
  <link rel="stylesheet" href="<?php echo(base_url());?>assets/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">

 <!-- custome css  -->
  <link rel="stylesheet" href="<?php echo(base_url());?>assets/css/softhought_style.css">

    <!-- Select2 -->
  <link rel="stylesheet" href="<?php echo(base_url());?>assets/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="<?php echo(base_url());?>assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="<?php echo(base_url());?>assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">

  <!-- jQuery -->
<script src="<?php echo(base_url());?>assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo(base_url());?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Bootstrap Select -->
<script src="<?php echo(base_url());?>assets/js/bootstrap-select.js"></script>
<!-- Bootstrap Select -->
<script src="<?php echo(base_url());?>assets/plugins/sweetalert2/sweetalert2.js"></script>
<!-- Select2 -->
<script src="<?php echo(base_url());?>assets/plugins/select2/js/select2.full.min.js"></script>
<!-- InputMask -->
<script src="<?php echo(base_url());?>assets/plugins/moment/moment.min.js"></script>
<script src="<?php echo(base_url());?>assets/plugins/inputmask/min/jquery.inputmask.bundle.min.js"></script>

<!-- datepicker -->
<script src="<?php echo(base_url());?>assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- DataTables -->
<script src="<?php echo(base_url());?>assets/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?php echo(base_url());?>assets/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo(base_url());?>assets/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo(base_url());?>assets/dist/js/demo.js"></script>

<!-- input date checker jquery -->
<script src="<?php echo base_url(); ?>assets/js/customJs/datecheck.js"></script>



  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

  <style>
  .err-border{
    border: 2px solid red !important;
  }
  </style>
</head>
<body class="hold-transition layout-top-nav">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
    <div class="container">
      <a href="#" class="navbar-brand">
      <img src="<?php echo(base_url());?>assets/img/logo-dks.png" alt=" Dakshin Kalikata Sansad Logo" class="brand-image " style="opacity: 1">
        <!-- <img src="<?php echo(base_url());?>assets/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8"> -->
        <!-- <span class="brand-text font-weight-light"><b>DKS</b></span> -->
      </a>
      
      <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse order-3" id="navbarCollapse">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
          <?php if(sizeof($menu)>0){ 
            foreach($menu as $firstlevel)
            {
              if(sizeof($firstlevel['secondLevelMenu'])>0){
          ?>
          <li class="nav-item dropdown">
            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle"><?php echo $firstlevel['menu_name']; ?></a>
            <!-- Level two dropdown-->
            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">              
              <?php 
                foreach($firstlevel['secondLevelMenu'] as $second_lvl){
                if(sizeof($second_lvl['thirdLevelMenu'])>0){	
					  	?>
              <li class="dropdown-submenu dropdown-hover">
                <a id="dropdownSubMenu2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle"><?php echo $second_lvl['second_menu_name']; ?></a>

                <!-- Level three dropdown-->
                <ul aria-labelledby="dropdownSubMenu2" class="dropdown-menu border-0 shadow">                  
                  <?php foreach($second_lvl['thirdLevelMenu'] as $third_lvl){?>
                  <li class="dropdown-submenu">
                    <a id="dropdownSubMenu3" href="<?php echo base_url().$third_lvl['third_menu_link']; ?>"  class="dropdown-item "><?php echo $third_lvl['third_menu_name']; ?></a>
                    <!-- <ul aria-labelledby="dropdownSubMenu3" class="dropdown-menu border-0 shadow">
                      <li><a href="#" class="dropdown-item">3rd level</a></li>
                    </ul> -->
                  </li>
                  <?php } ?>                  
                </ul>
                <!-- End Level three -->

              </li>
                <?php }else { ?>
                  <li><a href="<?php echo base_url().$second_lvl['second_menu_link']; ?>" class="dropdown-item"><?php echo $second_lvl['second_menu_name']; ?></a></li>
                <?php }}?>              
            </ul>
            <!-- End Level two -->

          </li>

          <?php }else {?>
            <li class="nav-item"><a href="<?php echo base_url().$firstlevel['menu_link'];?>" class="nav-link"><?php echo $firstlevel['menu_name']; ?></a></li> 
          <?php  } }} ?>


          <!-- <li class="nav-item dropdown">
            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Dropdown</a>
            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
              <li><a href="#" class="dropdown-item">Some action </a></li>
              <li><a href="#" class="dropdown-item">Some other action</a></li> -->

              <!-- Level two dropdown-->
              <!-- <li class="dropdown-submenu dropdown-hover">
                <a id="dropdownSubMenu2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Hover for action</a>
                <ul aria-labelledby="dropdownSubMenu2" class="dropdown-menu border-0 shadow">
                  <li>
                    <a tabindex="-1" href="#" class="dropdown-item">level 2</a>
                  </li> -->

                  <!-- Level three dropdown-->
                  <!-- <li class="dropdown-submenu">
                    <a id="dropdownSubMenu3" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">level 2</a>
                    <ul aria-labelledby="dropdownSubMenu3" class="dropdown-menu border-0 shadow">
                      <li><a href="#" class="dropdown-item">3rd level</a></li>
                      <li><a href="#" class="dropdown-item">3rd level</a></li>
                    </ul>
                  </li> -->
                  <!-- End Level three -->

                  <!-- <li><a href="#" class="dropdown-item">level 2</a></li>
                  <li><a href="#" class="dropdown-item">level 2</a></li>
                </ul>
              </li> -->
              <!-- End Level two -->
            <!-- </ul>
          </li> -->
        </ul>
      </div>

      <!-- Right navbar links -->
      <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
        <li class="nav-item">
          <!-- <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="<?php echo base_url(); ?>logout">
            <i class="fas fa-th-large"></i>
          </a> -->
          <a class="nav-link"  href="<?php echo base_url(); ?>logout">
            <?php echo $user; ?> &nbsp;<img src="<?php echo base_url(); ?>assets/img/power.png" title="logout" alt="logout" hight="30px" width="30px">
          </a>
        </li>
      </ul>
    </div>
  </nav>
  <!-- /.navbar -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Navigation <small></small></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item"><a href="#">Layout</a></li>
              <li class="breadcrumb-item active">Top Navigation</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container">
<?php //pre($menu); ?>


      <?php 
			if($bodyview)  :
			$this->load->view($bodyview);
			endif; 
		?>



 <input type="hidden" value="<?php echo base_url();?>" id="basepath" readonly />
     
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      <!-- Anything you want -->
    </div>
    <!-- Default to the left -->
    <!-- <strong>Copyright &copy; 2014-2019 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved. -->
  </footer>
</div>
<!-- ./wrapper -->


<script>
  $(document).ready(function() {
    $('.selectpicker').selectpicker();
    $('.dataTable').DataTable();
     //Initialize Select2 Elements
    $('.select2').select2();
      //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    });
    $('.datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })

} );
</script>
</body>
</html>
