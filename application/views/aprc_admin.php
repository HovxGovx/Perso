<br><br>
<!-- Content Wrapper. Contains page content -->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="background-color: white">
	<!-- Content Header (Page header) -->
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0">Tableau de bord</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item">
							<button type="button" class="btn btn-outline-primary">
								<a href="<?php echo base_url() . 'GuichetController/guichetAjoutDossier'; ?>" class="text-decoration-none">Ajout</a>
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
			<!-- Small boxes (Stat box) -->
			<h4>Tableau de bord Guichet</h4>
			<div class="row">
				<div class="col-lg-3 col-6">
					<!-- small box -->
					<div class="small-box bg-primary">
						<div class="inner">
							<h3><?php echo $totaldossier; ?></h3>

							<p>Nouvelle demande pour guichet</p>
						</div>
						<div class="icon">
							<i class="ion ion-bag"></i>
						</div>
						<a href="<?php echo base_url() . 'GuichetController/guichetDossier'; ?>" class="small-box-footer">Voir la liste <i class="fas fa-arrow-circle-right"></i></a>
					</div>
				</div>
				<!-- ./col -->
				<div class="col-lg-3 col-6">
					<!-- small box -->
					<div class="small-box bg-info">
						<div class="inner">
							<h3><?php echo $totalenattentecel; ?></h3>
							<p>Dossiers en attente de C.E.L</p>
						</div>
						<div class="icon">
							<i class="ion ion-person-add"></i>
						</div>

						<a href="<?php echo base_url('GuichetController/guichetDossierEnAttente') ?>" class="small-box-footer">Voir la liste <i class="fas fa-arrow-circle-right"></i></a>
					</div>
				</div>
				<!-- ./col -->
				<div class="col-lg-3 col-6">
					<!-- small box -->
					<div class="small-box bg-light">
						<div class="inner">
							<h3>120<sup style="font-size: 20px"></sup></h3>

							<p>Dematerialisation par Guichet</p>
						</div>
						<div class="icon">
							<i class="ion ion-stats-bars"></i>
						</div>
						<a href="<?php echo base_url() . 'GuichetController/guichetDematerialisation'; ?>" class="small-box-footer">Voir plus <i class="fas fa-arrow-circle-right"></i></a>
					</div>
				</div>
				<!-- ./col -->
				<div class="col-lg-3 col-6">
					<!-- small box -->
					<div class="small-box bg-secondary">
						<div class="inner">
							<h3><?php echo $totalsuivie; ?></h3>
							<p>Suivie Guichet</p>
						</div>
						<div class="icon">
							<i class="ion ion-pie-graph"></i>
						</div>
						<a href="<?php echo base_url() . 'GuichetController/guichetSuivie'; ?>" class="small-box-footer">Voir la liste <i class="fas fa-arrow-circle-right"></i></a>
					</div>
				</div>
				<!-- ./col -->
			</div>
			<h4>Tableau de bord CCDF</h4>
			<!-- PARTIE CCDF -->
			<div class="row">
				<div class="col-lg-3 col-6">
					<!-- small box -->
					<div class="small-box bg-primary">
						<div class="inner">
							<h3><?php echo $totalpouravisCCDF; ?></h3>
							<p>Demande pour CCDF</p>
						</div>
						<div class="icon">
							<i class="ion ion-bag"></i>
						</div>
						<a href="<?php echo base_url() . 'CCDFController/ccdfDossier'; ?>" class="small-box-footer">Voir la liste <i class="fas fa-arrow-circle-right"></i></a>
					</div>
				</div>
				<!-- ./col -->
				<div class="col-lg-3 col-6">
					<!-- small box -->
					<div class="small-box bg-info">
						<div class="inner">
							<h3><?php echo $totalpourRecuCCDF; ?>
								<!-- <sup style="font-size: 20px">%</sup> -->
							</h3>
							<p> Dossier reçu par CCDF</p>
						</div>
						<div class="icon">
							<i class="ion ion-stats-bars"></i>
						</div>
						<a href="<?php echo base_url() . 'CCDFController/ReceptionCCDF'; ?>" class="small-box-footer">Voir la liste <i class="fas fa-arrow-circle-right"></i></a>
					</div>
				</div>
				<!-- ./col -->
				<div class="col-lg-3 col-6">
					<!-- small box -->
					<div class="small-box bg-light">
						<div class="inner">
							<h3><?php echo $totalpourEnvoyeCCDF ?></h3>
							<p>Dossier envoyer par CCDF</p>
						</div>
						<div class="icon">
							<i class="ion ion-person-add"></i>
						</div>
						<a href="<?php echo base_url() . 'CCDFController/EnvoieCCDF'; ?>" class="small-box-footer">Voir la liste <i class="fas fa-arrow-circle-right"></i></a>
					</div>
				</div>
				<!-- ./col -->
				<div class="col-lg-3 col-6">
					<!-- small box -->
					<div class="small-box bg-secondary">
						<div class="inner">
							<h3><?php echo $totalpourEnvoyeCCDF + $totalpourRecuCCDF + $totalpouravisCCDF ?></h3>

							<p>Suivie CCDF</p>
						</div>
						<div class="icon">
							<i class="ion ion-pie-graph"></i>
						</div>
						<a href="<?php echo base_url() . 'CCDFController/CCDFsuivie'; ?>" class="small-box-footer">Voir plus <i class="fas fa-arrow-circle-right"></i></a>
					</div>
				</div>
				<!-- ./col -->
			</div>
			<!-- PARTIE SRD -->
			<h4>Tableau de bord SRD</h4>
			<div class="row">
				<div class="col-lg-3 col-6">
					<!-- small box -->
					<div class="small-box bg-primary">
						<div class="inner">
							<h3><?php echo $totalpouravisSRD; ?></h3>
							<p>Demande</p>
						</div>
						<div class="icon">
							<i class="ion ion-bag"></i>
						</div>
						<a href="<?php echo base_url() . 'SRDController/srdDossier'; ?>" class="small-box-footer">Voir la liste <i class="fas fa-arrow-circle-right"></i></a>
					</div>
				</div>
				<!-- ./col -->
				<div class="col-lg-3 col-6">
					<!-- small box -->
					<div class="small-box bg-info">
						<div class="inner">
							<h3><?php echo $totalpourRecuSRD; ?>
								<!-- <sup style="font-size: 20px">%</sup> -->
							</h3>
							<p> Dossier reçu</p>
						</div>
						<div class="icon">
							<i class="ion ion-stats-bars"></i>
						</div>
						<a href="<?php echo base_url() . 'SRDController/ReceptionSRD'; ?>" class="small-box-footer">Voir la liste <i class="fas fa-arrow-circle-right"></i></a>
					</div>
				</div>
				<!-- ./col -->
				<div class="col-lg-3 col-6">
					<!-- small box -->
					<div class="small-box bg-light">
						<div class="inner">
							<h3><?php echo $totalpourEnvoyeSRD ?></h3>
							<p>Dossier envoyer</p>
						</div>
						<div class="icon">
							<i class="ion ion-person-add"></i>
						</div>
						<a href="<?php echo base_url() . 'SRDController/EnvoieSRD'; ?>" class="small-box-footer">Voir la liste <i class="fas fa-arrow-circle-right"></i></a>
					</div>
				</div>
				<!-- ./col -->
				<div class="col-lg-3 col-6">
					<!-- small box -->
					<div class="small-box bg-secondary">
						<div class="inner">
							<h3><?php echo $totalpourEnvoyeSRD + $totalpourRecuSRD + $totalpouravisSRD ?></h3>

							<p>Suivie</p>
						</div>
						<div class="icon">
							<i class="ion ion-pie-graph"></i>
						</div>
						<a href="<?php echo base_url() . 'SRDController/SRDsuivie'; ?>" class="small-box-footer">Voir plus <i class="fas fa-arrow-circle-right"></i></a>
					</div>
				</div>
				<!-- ./col -->
			</div>
	</section>
</div>
