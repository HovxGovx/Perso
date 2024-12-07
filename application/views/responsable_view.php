<br><br>


<!-- Content Wrapper. Contains page content -->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="background-color: white">
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
								<a href="<?php echo site_url('responsable/add'); ?>">
									Nouveau
								</a>
							</button>
						</li>
					</ol>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>
	<!-- Content Header (Page header) -->
	<div class="container-fluid">
		<div class="row">
			<div class="col-12">
				<strong style="text-align: center;
                    color: orange;
                    font-size: 1.5em;margin-left: 40%">Liste des responsables</strong>
			</div>
			<br>
			<div class="col-12">
				<div id="liste-dossiers">
					<form action="#">
						<table id="example1" class="table table-bordered table-striped">
							<thead>
								<tr>
									<th>Rôle</th>
									<th>Fonction</th>
									<th>Email</th>
									<th>Téléphone</th>
									<th>Login</th>
									<th>Nom</th>
									<th>Prénom</th>
									<th>Actions</th>
								</tr>
							</thead>
							<tbody>
							<?php foreach ($responsables as $responsable) : 
								?>
								<tr>
									<td><?php echo $responsable->libelle; ?></td>
									<td><?php echo $responsable->fonction; ?></td>
									<td><?php echo $responsable->email; ?></td>
									<td><?php echo $responsable->telephone; ?></td>
									<td><?php echo $responsable->login; ?></td>
									<td><?php echo $responsable->nom; ?></td>
									<td><?php echo $responsable->prenom; ?></td>
									<td class="btn-group">
										<a href="<?php echo site_url('responsable/edit/' . $responsable->id_responsable); 
													?>"><button class="btn btn-warning w-75"><i class="fas fa-edit"></i></button></a>
										<a href="<?php echo site_url('responsable/delete/' . $responsable->id_responsable); 
													?>"><button class="btn btn-danger w-75"><i class="fas fa-trash"></i></button></a>
									</td>
								</tr>
								<?php endforeach; 
								?>
							</tbody>
						</table>
					</form>

				</div>
			</div>
		</div>
	</div>

</div>
