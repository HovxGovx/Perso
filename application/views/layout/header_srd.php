

<!DOCTYPE html>
<html lang="en">
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
  <nav class="main-header navbar navbar-expand navbar-dark">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="<?php echo base_url().'main/data1';?>" class="nav-link">Accueil</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
	
      <!-- Navbar Search -->
      
	  

      <!-- Messages Dropdown Menu -->
      
      <!-- Notifications Dropdown Menu -->
	  <li>
	  <a href="<?php echo base_url().'main/logout';?>">
		<button type="submit" class="btn btn-outline-danger" action="main/logout"> <i class="bi bi-box-arrow-left" style="margin: 10px;"></i>Deconnexion</button>
	  </a>
	  </li>
      
      
      
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?php echo base_url().'main/data1';?>" class="brand-link">
      <img src="<?php echo base_url().'assets/img/logo.jpg';?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">trait FG</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?php echo base_url().'assets/img/user2-160x160.jpg';?>" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?php echo $username;?></a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
         
			<li class="nav-item">
            <a href="#" class="nav-link">
              <i class="bi bi-person-circle" style="font-size: 20px; color:cornflowerblue;"></i>
              <p style="margin-left: 10px;">
                Profil
               
              </p>
            </a>
            
          </li>
		  <li class="nav-item">
            <a href="<?php echo base_url().'main/data1';?>" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt" style="font-size: 20px; color: cornflowerblue; "></i>
              <p style="margin-left: 10px;">
                Tableau de bord
                
              </p>
            </a>
            
          </li>
		  
          <li class="nav-item">
            <a href="pages/widgets.html" class="nav-link">
              <i class="bi bi-folder2" style="font-size: 20px; color: cornflowerblue;"></i>
              <p style="margin-left: 10px;">
                 Dossiers
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
			
				<ul class="nav nav-treeview">
				  
				  <li class="nav-item">
					<a href="<?php echo base_url().'Ajout_donnees/view_all_dossiers';?>" class="nav-link">
					  <i class="bi bi-folder" style="margin-left: 10px;"></i>
					  <p style="margin-left: 10px;">Listes des dossiers</p>
					</a>
				  </li>
				</ul>
			
          </li>
          
		  
		   
          
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon bi bi-person-square"></i>
              <p style="margin-left: 10px;">
                Responsables
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              
              <li class="nav-item">
                <a href="<?php echo base_url().'responsable';?>" class="nav-link">
                  <i class="bi bi-people-fill nav-icon"></i>
                  <p style="margin-left: 10px;">Voir la liste complète</p>
                </a>
              </li>
              
            </ul>
          </li>
		  
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon bi bi-person-lines-fill"></i>
              <p>
                Demandeurs
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="pages/tables/simple.html" class="nav-link">
                  <i class="bi bi-person-standing nav-icon"></i>
                  <p>Listes des demandeurs</p>
                </a>
              </li>
              
              
            </ul>
          </li>
          <li class="nav-header">AUTRES</li>
          <li class="nav-item">
            <a href="<?php echo base_url().'DossierController';?>" class="nav-link">
              <i class="nav-icon far fa-calendar-alt"></i>
              <p>
                Transfert
            <!--    <span class="badge badge-info right">2</span>  !-->
              </p>
            </a>
          </li>
          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>