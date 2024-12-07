<br>
<div class="container-fluid">

	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<div class="content-header">
			<div class="container-fluid">
				<div class="row mb-2">
					<div class="col-sm-6">
						<h1 class="m-0">Responsable</h1>
					</div><!-- /.col -->
					<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item">
								<button type="button" class="btn btn-outline-dark">
									<a href="<?php echo site_url('responsable'); ?>">
										Liste
									</a>
								</button>
							</li>
						</ol>
					</div><!-- /.col -->
				</div><!-- /.row -->
			</div><!-- /.container-fluid -->
		</div>
		<!-- /.content-header -->
		<!-- Main content -->
		<section class="content">
			<div class="container-fluid">
				<!-- general form elements disabled -->
				<div class="card card-warning">
					<div class="card-header">
						<h3 class="card-title">Informations generaux</h3>
					</div>
					<!-- /.card-header -->
					<div class="card-body">
						<form action="<?php echo base_url('responsable/add'); ?>" enctype="multipart/form-data" method="post">
							<div id="accordion">
								<div class="card">
									<div class="card-header" id="headingOne">
										<h5 class="mb-0">
											<button type="button" class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
												Information Personnel
											</button>
										</h5>
									</div>
									<div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
										<div class="card-body">
											<div class="row">
												<div class="col-sm-6">
													<!-- text input -->
													<div class="form-group">
														<label>Nom</label>
														<input name="nom" type="text" class="form-control" placeholder="Enter ..." require>
													</div>
												</div>
												<div class="col-sm-6">
													<!-- textarea -->
													<div class="form-group">
														<label>Prenom</label>
														<input name="prenom" class="form-control" rows="3" placeholder="Enter ..." require>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-sm-6">
													<!-- text input -->
													<div class="form-group">
														<label>Telephone</label>
														<input name="telephone" type="text" class="form-control" placeholder="Enter ..." require>
													</div>
												</div>
												<div class="col-sm-6">
													<!-- text input -->
													<div class="form-group">
														<label>Email :</label>
														<input name="email" type="email" class="form-control" placeholder="Enter ..." require>
													</div>
												</div>
											</div>
											<div class="col-sm-6">
												<div class="form-group">
													<label>Fonction</label>
													<input name="fonction" class="form-control" rows="3" placeholder="Enter ..." require>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="card">
									<div class="card-header" id="headingTwo">
										<h5 class="mb-0">
											<button type="button" class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
												Inscription
											</button>
										</h5>
									</div>
									<div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
										<div class="card-body">
											<div class="row">
												<div class="col-sm-6">
													<!-- text input -->
													<div class="form-group">
														<label>Login</label>
														<input name="login" type="text" class="form-control" placeholder="Enter ..." require>
													</div>
												</div>
												<div class="col-sm-6">
													<!-- text input -->
													<div class="form-group">
														<label>Mot de passe :</label>
														<input name="mdp" type="password" class="form-control" placeholder="Enter ..." require>
													</div>
												</div>
											</div>
											<div class="col-sm-6">
												<!-- select -->
												<div class="form-group">
													<label for="selectRole">Sélectionnez un rôle :</label>
													<select id="selectRole" name="id_role" onchange="lieu()" class="form-control"></select>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="card">
									<div class="card-header" id="headingThree">
										<h5 class="mb-0">
											<button type="button" class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
												Localisation
											</button>
										</h5>
									</div>
									<div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
										<div class="card-body">
											<div class="col-sm-6" id="divCirconscription">
												<div class="form-group">
													<label for="selectCirconscription">Circonscription</label>
													<select id="selectCirconscription" name="id_circonscription" class="form-control"></select>
												</div>
											</div>
											<div class="col-sm-6" id="divRegion">
												<!-- textarea -->
												<div class="form-group">
													<label for="selectRegion">Région</label>
													<select id="selectRegion" name="id_region" onChange="getCirconscription()" class="form-control"></select>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-sm-6">
								<input class="btn btn-primary" type="submit" value="Ajouter">
							</div>
						</form>
					</div>
					<!-- /.card-body -->

					<!-- /.card -->



				</div>
				<!-- /.row (main row) -->
			</div><!-- /.container-fluid -->
		</section>
		<!-- /.content -->
	</div>
	<!-- /.content-wrapper -->
</div>
<!-- Page Heading -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
	var id_region = '<?php //echo $id_region 
						?>';
	//  console.log('this one is',id_region);
	var base_url = '<?php echo base_url(); ?>';
	var site_url = '<?php echo site_url(); ?>';
</script>
<script src="<?php echo base_url('assets/js/ajax/responsable_ajout?v=' . time()); ?>"></script>
