<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>E-trait FG</title>
	<!-- jQuery -->
	<script src="<?php echo base_url() . 'assets/jquery/jquery.min.js'; ?>"></script>
	<!-- jQuery UI 1.11.4 -->
	<script src="<?php echo base_url() . 'assets/jquery-ui/jquery-ui.min.js'; ?>"></script>
	<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
	<script>
		$.widget.bridge('uibutton', $.ui.button)
	</script>
	<!-- Bootstrap 4 -->
	<script src="<?php echo base_url() . 'assets/bootstrap/js/bootstrap.bundle.min.js'; ?>"></script>
	<!-- overlayScrollbars -->
	<script src="<?php echo base_url() . 'assets/overlayScrollbars/js/jquery.overlayScrollbars.min.js'; ?>"></script>
	<!-- AdminLTE App -->
	<script src="<?php echo base_url() . 'assets/js/adminlte.js'; ?>"></script>

	<!-- Bootstrap 4 -->
	<script src="<?php echo base_url() . 'assets/bootstrap/js/bootstrap.bundle.min.js'; ?>"></script>
	<!-- ChartJS -->
	<script src="<?php echo base_url() . 'assets/chart.js/Chart.min.js'; ?>"></script>
	<!-- Sparkline -->
	<script src="<?php echo base_url() . 'assets/sparklines/sparkline.js'; ?>"></script>
	<!-- JQVMap -->
	<script src="<?php echo base_url() . 'assets/jqvmap/jquery.vmap.min.js'; ?>"></script>
	<script src="<?php echo base_url() . 'assets/jqvmap/maps/jquery.vmap.usa.js'; ?>"></script>
	<!-- jQuery Knob Chart -->
	<script src="<?php echo base_url() . 'assets/jquery-knob/jquery.knob.min.js'; ?>"></script>
	<!-- daterangepicker -->
	<script src="<?php echo base_url() . 'assets/moment/moment.min.js'; ?>"></script>
	<script src="<?php echo base_url() . 'assets/daterangepicker/daterangepicker.js'; ?>"></script>
	<!-- Tempusdominus Bootstrap 4 -->
	<script src="<?php echo base_url() . 'assets/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js'; ?>"></script>
	<!-- Summernote -->
	<script src="<?php echo base_url() . 'assets/summernote/summernote-bs4.min.js'; ?>"></script>
	<!-- overlayScrollbars -->
	<script src="<?php echo base_url() . 'assets/overlayScrollbars/js/jquery.overlayScrollbars.min.js' ?>"></script>
	<!-- AdminLTE App -->
	<script src="<?php echo base_url() . 'assets/js/adminlte.js'; ?>"></script>
	<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
	<script src="<?php echo base_url() . 'assets/js/pages/dashboard.js'; ?>"></script>

	<script src="<?php echo base_url() . 'assets/jquery/jquery.min.js'; ?>"></script>

	<script src="<?php echo base_url() . 'assets/datatables/jquery.dataTables.min.js'; ?>"></script>

	<script src="<?php echo base_url() . 'assets/datatables-bs4/js/dataTables.bootstrap4.min.js'; ?>"></script>
	<script src="<?php echo base_url() . 'assets/datatables-responsive/js/dataTables.responsive.min.js'; ?>"></script>
	<script src="<?php echo base_url() . 'assets/datatables-responsive/js/responsive.bootstrap4.min.js'; ?>"></script>
	<script src="<?php echo base_url() . 'assets/datatables-buttons/js/dataTables.buttons.min.js'; ?>"></script>
	<script src="<?php echo base_url() . 'assets/datatables-buttons/js/buttons.bootstrap4.min.js'; ?>"></script>
	<script src="<?php echo base_url() . 'assets/jszip/jszip.min.js'; ?>"></script>
	<script src="<?php echo base_url() . 'assets/pdfmake/pdfmake.min.js'; ?>"></script>
	<script src="<?php echo base_url() . 'assets/pdfmake/vfs_fonts.js'; ?>"></script>
	<script src="<?php echo base_url() . 'assets/datatables-buttons/js/buttons.html5.min.js'; ?>"></script>
	<script src="<?php echo base_url() . 'assets/datatables-buttons/js/buttons.print.min.js'; ?>"></script>
	<script src="<?php echo base_url() . 'assets/datatables-buttons/js/buttons.colVis.min.js'; ?>"></script>




	<script src="<?php echo base_url() . 'assets/js/adminlte.min.js'; ?>"></script>
	<script>
		$(function() {
			$("#example1").DataTable({
				"responsive": true,
				"lengthChange": false,
				"autoWidth": false,
				"buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
			}).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
			$('#example2').DataTable({
				"paging": true,
				"lengthChange": false,
				"searching": true,
				"ordering": true,
				"info": true,
				"autoWidth": false,
				"responsive": true,
			});
			$("#tablerecu").DataTable({
				"responsive": true,
				"lengthChange": false,
				"autoWidth": false,
				"buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
			}).buttons().container().appendTo('#tablerecu_wrapper .col-md-6:eq(0)');
			$("#tabledossierccdf").DataTable({
				"responsive": true,
				"lengthChange": false,
				"autoWidth": false,
				"buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
			}).buttons().container().appendTo('#tabledossierccdf_wrapper .col-md-6:eq(0)');
		});
	</script>

	<!-- Tempusdominus Bootstrap 4 -->
	<link rel="stylesheet" href="<?php echo base_url() . 'assets/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css'; ?>">
	<!-- iCheck -->
	<link rel="stylesheet" href="<?php echo base_url() . 'assets/icheck-bootstrap/icheck-bootstrap.min.css'; ?>">
	<!-- JQVMap -->
	<link rel="stylesheet" href="<?php echo base_url() . 'assets/jqvmap/jqvmap.min.css'; ?>">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="<?php echo base_url() . 'assets/fontawesome-free/css/all.min.css'; ?>">
	<!-- Theme style -->
	<link rel="stylesheet" href="<?php echo base_url() . 'assets/css/adminlte.min.css'; ?>">
	<!-- overlayScrollbars -->
	<link rel="stylesheet" href="<?php echo base_url() . 'assets/overlayScrollbars/css/OverlayScrollbars.min.css'; ?>">
	<!-- Daterange picker -->
	<link rel="stylesheet" href="<?php echo base_url() . 'assets/daterangepicker/daterangepicker.css'; ?>">
	<!-- summernote -->
	<link rel="stylesheet" href="<?php echo base_url() . 'assets/summernote/summernote-bs4.min.css'; ?>">
	<!-- DataTables -->
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">


	<style>
		body {
			background-color: #f5f5f5;
			/* Light grey background */
		}

		.main-header {
			background-color: #c8102e;
			/* Red background for the navbar */
		}

		.main-sidebar {
			background-color: #004d00;
			/* Dark green background for the sidebar */
		}

		.brand-link {
			background-color: #003300;
			/* Dark green background for the brand link */
		}

		.brand-text {
			color: #ffffff;
			/* White text for the brand text */
		}

		.user-panel .info a {
			color: #ffffff;
			/* White text for the user info */
		}

		.btn-outline-danger {
			border-color: #c8102e;
			/* Red border for the logout button */
			color: #c8102e;
			/* Red text color for the logout button */
		}

		.btn-outline-danger:hover {
			background-color: #c8102e;
			/* Red background color on hover */
			color: #ffffff;
			/* White text color on hover */
		}

		.main-footer {
			background-color: #004d00;
			/* Dark green background for the footer */
			color: #ffffff;
			/* White text for the footer */
		}
	</style>
</head>

<body class="hold-transition sidebar-mini layout-fixed " data-panel-auto-height-mode="height" style="background-color: white">
	<div class="wrapper" style="background-color: #ecfdf5">

		<!-- Navbar -->
		<nav class="main-header navbar navbar-expand navbar-dark fixed-top" style="background-color:#0C6478">
			<!-- Left navbar links -->
			<ul class="navbar-nav">
				<li class="nav-item">
					<a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
				</li>
				<li class="nav-item d-none d-sm-inline-block">
					<a href="<?php echo base_url() . 'Main/data1'; ?>">
						<button type="submit" class="btn btn-outline-light"> <i class="fa fas-box-arrow-left"></i>Acceuil</button>
					</a>
				</li>
			</ul>

			<!-- Right navbar links -->
			<ul class="navbar-nav ml-auto">
				<!-- Messages Dropdown Menu -->
				<!-- Notifications Dropdown Menu -->
				<li>
					<a href="<?php echo base_url() . 'main/logout'; ?>">
						<button type="submit" class="btn btn-outline-danger"> <i class="fa fas-box-arrow-left"></i>Deconnexion</button>
					</a>
				</li>
			</ul>
		</nav>
		<!-- /.navbar -->

		<!-- Main Sidebar Container -->
		<aside class="main-sidebar sidebar-dark-primary elevation-4" Style="background-color: whitesmoke">
			<!-- Brand Logo -->
			<a href="<?php echo base_url() . 'main/data1'; ?>" class="brand-link" style="background-color: #0C6478">
				<img src="<?php echo base_url() . 'assets/img/logo.jpg'; ?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
				<span class="brand-text font-weight-light">E-trait FG</span>
			</a>

			<!-- Sidebar -->
			<div class="sidebar">
				<!-- Sidebar user panel (optional) -->
				<div class="user-panel mt-3 pb-3 mb-3 d-flex">
					<div class="image">
						<img src="<?php echo base_url() . 'assets/img/user2-160x160.jpg'; ?>" class="img-circle elevation-2" alt="User Image">
					</div>
					<div class="info">
						<a href="#" class="d-block" style="color: black"><?php echo $username; ?></a>
					</div>
				</div>
				<!-- Sidebar Menu(pour l'admin seulement) -->
				<?php if ($libelle == "Administrateur"): ?>
					<!-- Sidebar Menu -->
					<nav class="mt-2">
						<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
							<!-- Service regional Menu et sous meu -->
							<li class=" activation">
								<a href="<?php echo base_url() . 'RegionController'; ?>" class="nav-link">
									<i class="bi bi-folder2" style="font-size: 20px; color: black;"></i>
									<p style="margin-left: 10px; color:black;">
										Service regional
										<i class="fas fa-angle-right right"></i>
									</p>
								</a>
							</li>
							<!-- Circonscription Menu et sous meu -->
							<li class=" activation">
								<a href="<?php echo base_url() . 'Ajout_circonscription'; ?>" class="nav-link">
									<i class="bi bi-folder2" style="font-size: 20px; color: black;"></i>
									<p style="margin-left: 10px; color:black;">
										Circonscription
										<i class="fas fa-angle-right right circonscription_view"></i>
									</p>
								</a>
							</li>
							<!-- Responsables Menu et sous meu -->
							<li class="nav-item activation">
								<a href="#" class="nav-link">
									<i class="nav-icon bi bi-person-square"></i>
									<p style="margin-left: 10px; color:black;">
										Responsables
										<i class="fas fa-angle-right right"></i>
									</p>
								</a>
								<ul class="nav nav-treeview">
									<li class="nav-item">
										<a href="<?php echo base_url() . 'responsable/add'; ?>" class="nav-link">
											<i class="bi bi-person-plus-fill nav-icon"></i>
											<p style="margin-left: 10px; color:black;">Ajouter une personne</p>
										</a>
									</li>
									<li class="nav-item">
										<a href="<?php echo base_url() . 'responsable'; ?>" class="nav-link">
											<i class="bi bi-people-fill nav-icon"></i>
											<p style="margin-left: 10px; color:black;">Voir la liste complète</p>
										</a>
									</li>

								</ul>
							</li>

							<!-- Demandeur Menu et sous meu -->
							<li class=" activation">
								<a href="<?php echo base_url() . 'DemandeurController'; ?>" class="nav-link">
									<i class="bi bi-folder2" style="font-size: 20px; color: black;"></i>
									<p style="margin-left: 10px; color:black;">
										Demandeur
										<i class="fas fa-angle-right right"></i>
									</p>
								</a>
							</li>
							<!-- Dossier  Menu et sous menus -->
							<li class=" activation">
								<a href="<?php echo base_url() . 'DossierControlleur'; ?>" class="nav-link">
									<i class="bi bi-folder2" style="font-size: 20px; color: black;"></i>
									<p style="margin-left: 10px; color:black;">
										Dossier
										<i class="fas fa-angle-right right"></i>
									</p>
								</a>
							</li>
							<!-- Terrain  Menu et sous menus -->
							<li class=" activation">
								<a href="<?php echo base_url() . 'TerainControlleur'; ?>" class="nav-link">
									<i class="bi bi-folder2" style="font-size: 20px; color: black;"></i>
									<p style="margin-left: 10px; color:black;">
										Terrain
										<i class="fas fa-angle-right right"></i>
									</p>
								</a>
							</li>
							
						</ul>
					</nav>
				<?php endif; ?>
			</div>
			<!-- /.sidebar -->
		</aside>

		<?php echo $output; ?>


		<!-- Control Sidebar -->
		<aside class="control-sidebar control-sidebar-dark">
			<!-- Control sidebar content goes here -->
		</aside>
		<!-- /.control-sidebar -->
	</div>
	<!-- ./wrapper -->


</body>

</html>

</body>

</html>
