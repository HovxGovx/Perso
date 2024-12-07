<br><br>
<!-- Content Wrapper. Contains page content -->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="background-color: white">
	<!-- Content Header (Page header) -->
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0">Circonscription</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item">
							<button type="button" class="btn btn-outline-primary">
								Ajout
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
                    font-size: 1.5em;margin-left: 40%">Liste de Circonscription</strong>
			</div>
			<br>
			<div class="col-12">
				<div id="liste-dossiers">
					<form action="#">
						<table id="example1" class="table table-bordered table-striped">
							<thead>
								<tr>
									<th>Circonscription</th>
									<th>Indice</th>
									<th>service regionnal</th>
									<th>Responsables</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php //foreach ($pouravisccdf as $value) : 
								?>
								<tr>
									<td>Tana II<?php //echo $value->num_affaire; 
													?></td>
									<td>IA<?php //echo $value->date_demande; 
											?></td>
									<td >
										Analamanga 
									</td>
									<td>

										<button class="btn btn-secondary  btnRegion shadow" data-toggle="modal" data-target="#myModal">
										 Lister
										<span class="badge badge-light">9</span>
										</button>
									</td>
									<td >
										<button class="btn btn-warning  btnModifier shadow" data-toggle="modal" data-target="#detailModalContent">
											<i class="far fa-file-alt"></i> Modifier
										</button>
										<button class="btn btn-danger  btnSupprimer" data-toggle="modal" data-target="#avis">
											<i class="fas fa-edit"></i> Supprimer
										</button>
									</td>
								</tr>
								<?php //endforeach; 
								?>
							</tbody>

						</table>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
