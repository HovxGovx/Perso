<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>E-trait FG</title>
<!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="<?php echo base_url().'assets/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css';?>">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo base_url().'assets/icheck-bootstrap/icheck-bootstrap.min.css';?>">
  <!-- JQVMap -->
  <link rel="stylesheet" href="<?php echo base_url().'assets/jqvmap/jqvmap.min.css';?>">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url().'assets/fontawesome-free/css/all.min.css';?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url().'assets/css/adminlte.min.css';?>">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?php echo base_url().'assets/overlayScrollbars/css/OverlayScrollbars.min.css';?>">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?php echo base_url().'assets/daterangepicker/daterangepicker.css';?>">
  <!-- summernote -->
  <link rel="stylesheet" href="<?php echo base_url().'assets/summernote/summernote-bs4.min.css';?>">
</head>
<body class="hold-transition sidebar-mini layout-fixed dark-mode" data-panel-auto-height-mode="height">
<div class="wrapper">
  <!-- Navbar -->
  <nav class=" navbar navbar-expand navbar-dark">
    <!-- Left navbar links -->
    <ul class="navbar-nav w-100">
      <li class="nav-item">
        <a href="<?php echo base_url().'main/data1';?>" class="brand-link">
            <img src="<?php echo base_url().'assets/img/logo.jpg';?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light">E-trait FG</span>
        </a>
      </li>
      <li class="nav-item   top-50 ">
        <a href="<?php echo base_url().'main/data1';?>" class="nav-link">Tableau de bord</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="<?php echo base_url().'CelController/afficherPremierPageCel';?>" class="nav-link">Etat de lieu</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
	  <li>
	  <a href="<?php echo base_url().'main/logout';?>">
		<button type="submit" class="btn btn-outline-danger" action="main/logout"> <i class="bi bi-box-arrow-left" style="margin: 10px;"></i>Deconnexion</button>
	  </a>
	  </li>
      
      
      
    </ul>
  </nav>
  <!-- /.navbar -->
