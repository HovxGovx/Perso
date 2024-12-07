<br>
<br>
<style>
	input,
	textarea,
	select {
		background: linear-gradient(to right, #ffffff, #ffffff);
		/* Dégradé de couleur */
		border: 1px solid #ccc;
		/* Bordure */
		padding: 10px;
		/* Espacement intérieur */
		color: #333;
		/* Couleur du texte */

		.form-control input {
			color: black;
		}
	}

	.grandTitre .btn {
		top: 0;
		left: 0;
		width: 100%;
		height: 100%;
		padding: 0;
		/* Supprimez le padding interne du bouton pour qu'il occupe toute la zone */
		background: transparent;
		/* Assurez-vous que le bouton n'a pas de fond s'il doit être transparent */
		border: none;
		/* Supprimez les bordures si besoin */
	}
	#liste-dossiers {
		max-height: 500px;
		overflow-y: auto;

		scrollbar-width: thin;
		/* Pour Firefox */
		scrollbar-color: transparent transparent;
		/* Pour Firefox */
		-ms-overflow-style: none;
		/* Pour Internet Explorer et Edge */
	}

	#liste-dossiers::-webkit-scrollbar {
		width: 5px;
		/* Largeur de la barre de défilement pour les navigateurs WebKit (Chrome, Safari, etc.) */
	}

	#liste-dossiers::-webkit-scrollbar-thumb {
		background-color: transparent;
		/* Couleur du curseur de défilement */
	}

	.gg {
		display: grid;
		justify-content: center;
		align-items: center;
	}
</style>
<!-- Content Wrapper. Contains page content -->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="background-color: #ecfdf5">
	<div class="container-fluid">
		<div class="row">
			<div class=""
				style="
                    color: orange; 
                    font-size: 1.5em;">
				<strong style="text-align: center; 
                    color: orange; 
                    font-size: 1.5em;"> NOUVELLE DEMANDE</strong>
			</div>
		</div>
		<br>
		<div class="col-12" id="liste-dossiers">
			<div class="card">
				<!-- /.card-header -->
				<div class="card-body" style="color: black">
					<!--<div class="d-flex  mb-4">
                               <button class="btn btn-success" onclick="newDossier()">Nouveau</button>
                            </div>-->
					<table id="tablerecu" class="table table-bordered table-striped">

						<thead>
							<tr>
								<th>Numéro d'affaire</th>
								<th>Objet de la fiche</th>
								<th>Date demande</th>
								<th>Nature demande</th>
								<th>Description</th>
								<th>Etat du dossier</th>
								<th>Details</th>
							</tr>
						</thead>
						<tbody>

							<?php foreach ($allDossier as $onedossier):
							?>
								<tr>
									<td><strong><?php echo $onedossier['num_affaire']; ?></strong></td>
									<td><?php echo $onedossier['objetfiche']; ?></td>
									<td><?php echo $onedossier['date_demande']; ?></td>
									<td><?php echo $onedossier['nature_demande']; ?></td>
									<td><?php echo $onedossier['description']; ?></td>
									<td>
										<h6>
											<?php
											// Condition pour changer la classe du background en fonction de l'état
											$etatClass = '';
											if ($onedossier['Etat'] == "Nouvelle Demande") {
												$etatClass = 'bg-primary text-white';
											} elseif ($onedossier['Etat'] == "En attente de C.E.L") {
												$etatClass = 'bg-info text-white';
											}
											?>
											<span class="badge-pill <?php echo $etatClass; ?>">
												<?php echo $onedossier['Etat']; ?>
											</span>
										</h6>
									</td>
									<td>
										<button class="btn btn-secondary mx-1 my-2 btndetails" data-id="<?php echo $onedossier['id_dossier']; ?>" data-toggle="modal" data-target="#detailModalContent">
											<i class="far fa-file-alt"></i>
										</button>
									</td>
								</tr>
							<?php
							endforeach;
							?>
						</tbody>
					</table>
					<!-- Section details du dossier(demandeur, terrain) -->
					<section class="detail">
						<div class="modal fade" id="detailModalContent" tabindex="0" role="dialog" arial-labelledby="LabelExemple" aria-hidden="true">
							<div class="modal-dialog modal-lg" role="document">
								<div class="modal-content">
									<div class="modal-body">
										<div class="grandTitre">
											<h2 class="mb-4">Details du dossier</h2>
										</div>
										<div id="detailsContent">

											<div class="card px-3 py-3 shadow">
												<div class="grandTitre bg-secondary card pt-1">
													<h5>Détails du demandeur</h5>
												</div>
												<div class="details" id="detailsDemandeur">
													<!-- Les details du demandeur sera afficher par ajax ici -->
												</div>
											</div>

											<div class="card shadow px-3 py-3">
												<div class="grandTitre bg-primary card pt-1">
													<h5>Détails du terrain</h5>
												</div>
												<div class="details" id="detailsTerrain">
													<!-- Les details du terrain sera afficher par ajax ici -->
												</div>
											</div>
											<div class="card shadow px-3 py-3">
												<div class="grandTitre bg-primary card pt-1">
													<h5>Fichiers</h5>
												</div>
												<div class="details p-1" id="detailsPiecesJointes">
													<!-- Les fichiers pieces jointes seront afficher par ajax ici -->
												</div>
											</div>
										</div>

									</div>
								</div>
							</div>
						</div>
					</section>
					<!-- Modal -->
					<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenter" aria-hidden="true">
						<div class="modal-dialog modal-dialog-centered" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<form>
										<div class="form-group" style="visibility: hidden;">
											<input type="text" class="form-control" name="id_dossierS" id="id_dossierS">
										</div>
										<div class="form-group">
											<label for="message-text" class="col-form-label">Message:</label>
											<input class="form-control" type="date" name="date_convo" id="date_convo" value="<?php echo date('Y-m-d'); ?>">
										</div>
									</form>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
									<button type="button" class="btn btn-primary btnConvoSend">Send message</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<script>
	var id_region = '<?php echo $id_region ?>';
	var base_url = '<?php echo base_url(); ?>';
	var site_url = '<?php echo site_url(); ?>';
</script>
<script src="<?php echo base_url('assets/js/ajax/View_dossier_guichet.js?v=' . time()); ?>"></script>
<!-- jQuery -->
