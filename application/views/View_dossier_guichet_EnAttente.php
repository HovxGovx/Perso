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
<div class="content-wrapper" style="background-color: white">
	<div class="container-fluid">
		<div class="row">
			<div class="col-16"
				style="display: flex; 
					justify-content:center;
					align-items:center;
                    color: orange; 
                    font-size: 1.5em;">
				<strong style="text-align: center; 
                    color: orange; 
                    font-size: 1.5em;"> Demande en attente de C.E.L</strong>
			</div>
			<br>
			<div class="col-12" id="liste-dossiers">
				<div class="card">
					<!-- /.card-header -->
					<div class="card-body table-responsive" style="color: black">
						<!--<div class="d-flex  mb-4">
                               <button class="btn btn-success" onclick="newDossier()">Nouveau</button>
                            </div>-->
						<div class="table-responsive">
							<table id="tablerecu" class="table align-middle table-bordered table-striped">
								<thead>
									<tr>
										<th>Numéro d'affaire</th>
										<th>Objet de la fiche</th>
										<th>Date demande</th>
										<th>Nature demande</th>
										<th>Description</th>
										<th>Etat du dossier</th>
										<th>Date de la convocation</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>

									<?php
									// Obtenir la date d'aujourd'hui
									$today = new DateTime();

									foreach ($EnAttenteDossier as $onedossier):
										// Convertir la date de convocation en objet DateTime
										$dateConvocation = new DateTime($onedossier['date_convocation']);

										// Calculer la différence en jours
										$diffDays = $today->diff($dateConvocation)->days;
										$isButtonDisabled = ($diffDays > 8); // Vérifie si c'est moins de 8 jours et que la date est passée
									?>
										<tr>
											<td><strong><?php echo $onedossier['num_affaire']; ?></strong></td>
											<td><?php echo $onedossier['objetfiche']; ?></td>
											<td><?php echo $onedossier['date_demande']; ?></td>
											<td><?php echo $onedossier['nature_demande']; ?></td>
											<td><?php echo $onedossier['description']; ?></td>
											<td><?php echo $onedossier['Etat']; ?></td>
											<td><?php echo $onedossier['date_convocation']; ?></td>

											<td style="display: flex; 
													justify-content:center;
													align-items:center;">
												<?php if ($isButtonDisabled): ?>
													<button
														class="resetAndModal btn btn-success btn-lg btncel"
														data-id_dossier="<?php echo $onedossier['id_dossier']; ?>"
														data-toggle="modal"
														data-target="#modelCEL"
														title="Vous pouvez passer à l'étape suivante pour ce dossier.">
														C.E.L
													</button>
												<?php else: ?>
													<button class="btn btn-warning btn-lg btnAttente"
														data-id_dossier="<?php echo $onedossier['id_dossier']; ?>"
														data-jour_restante="<?php echo (8 - $diffDays); ?>"
														data-num_affaire="<?php echo $onedossier['num_affaire']; ?>"
														data-toggle="modal"
														data-target="#exampleModalCenter">C.E.L
													</button>
												<?php endif; ?>
												<button class="btn btn-info btn-lg btndetails" data-id="<?php echo $onedossier['id_dossier']; ?>" data-toggle="modal" data-target="#detailModalContent">
													<i class="far fa-file-alt"></i>
												</button>
											</td>
										</tr>
									<?php
									endforeach;
									?>
								</tbody>
								<tfoot>
									<tr>
										<th>Numéro d'affaire</th>
										<th>Objet de la fiche</th>
										<th>Date demande</th>
										<th>Nature demande</th>
										<th>Description</th>
										<th>Etat du dossier </th>
										<th>Date de la convocation</th>
										<th>Action</th>
									</tr>
								</tfoot>
							</table>
						</div>

						<!-- Section Constat d'etat des lieux -->
						<section class="formulaircel">
							<!-- Modal -->
							<div class="modal fade" id="modelCEL" tabindex="-1" role="dialog" aria-labelledby="modelCEL" aria-hidden="true">
								<div class="modal-dialog modal-lg" role="document">
									<div class="modal-content">
										<div class="modal-body" style="background-color: white">
											<div class="grandTitre">
												<h2 class="mb-4" style="color:green">Formulaire C.E.L</h2>
											</div>
											<form action="<?php echo base_url('CelController/ajouterDonnees'); ?>" method="post" id="formulaire_cel" enctype="multipart/form-data">
												<!-- Étape 1 -->
												<div class="form-group" style="visibility: hidden; display:none;">
													<label for="id_dossier">Numéro dossier: </label>
													<input name="id_dossier" type="text" class="form-control id_dossier">
												</div>
												<div class="form-group">
													<label for="date_descente">Date Descente :</label>
													<input class="form-control" type="date" id="date_descente" name="date_descente" required>
												</div>
												<div class="form-goup">
													<label for="resume_pv"> PV :</label>
													<div class="">
														<!-- text input -->
														<div class="form-group">
															<div class="btn btn-default btn-file">
																<i class="fas fa-paperclip"></i> Piece jointe C.E.L
																<input type="file" name="resume_pv" id="resume_pv" required>
															</div>
															<p id="fileCountMessage"></p>
															<p id="fileCountMessage"></p>
														</div>
														<p id="fileCountMessage"></p>
													</div>
												</div>
												<div class="form-goup">
													<label for="consistance">Consistance :</label>
													<input class="form-control" type="text" id="consistance" name="consistance">
												</div>
												<div class="form-group">
													<label for="date_mise_valeur">Date Mise Valeur :</label>
													<input class="form-control" type="date" id="date_mise_valeur" name="date_mise_valeur">
												</div>
												<div class="form-group" id="VocationTs">
													<label for="vocation">Vocation du terrain :</label>
													<select id="VocationT" name="VocationT" class="form-control">
														<option value="Affectation">Agricole</option>
														<option value="Acquisition">Urbaine</option>
														<option value="Location">Rural</option>
														<option value="Nouveau">Autre...</option>
													</select>
													<input id="VocationTInput" name="VocationTInput" type="text" class="form-control" placeholder="Entrez un nouveau" style="display:none;">
												</div>
												<div class="form-group">
													<button type="button" class="btn btn-primary mb-3" id="btnAvisCel" data-toggle="modal" data-target="#addAvisModal">+</button>

													<!-- Tableau des avis -->
													<table class="table table-bordered align-center">
														<thead>
															<tr>
																<th>Nom</th>
																<th>Avis</th>
																<th>Autres</th>
																<th>Actions</th>
															</tr>
														</thead>
														<tbody id="avisTableBody">
															<!-- Les avis ajoutés apparaîtront ici -->
														</tbody>
													</table>
												</div>
												<div class="form-group ">
													<button id="etape_suivante" class="btn btn-primary etape_suivante" type="submit">Envoyer</button>
												</div>
										</form>
									</div>
								</div>
							</div>
					</div>
					</section>
					<!-- Section qui affiche les details du dossier(demandeur, terrain) -->
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
					<!-- Modal de lancement de convocation -->
					<div class="modal fade" id="exampleModalCenter" tabindex="-2" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
						<div class="modal-dialog modal-dialog-centered" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="exampleModalLongTitle"></h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<h3>
										Ce dossier ne peut pas encore passer à l'étape C.E.L. Veuillez attendre encore <strong id="nbrjrsrest"></strong> jours."
									</h3>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Fermer</button>
								</div>
							</div>
						</div>
					</div>

					<!-- Formulaire Modal -->
					<div class="modal fade" id="addAvisModal" tabindex="0" aria-labelledby="addAvisModal" aria-hidden="true">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="addAvisModalLabel">Ajouter un Avis</h5>
									<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
								</div>
								<div class="modal-body">

									<form id="avisForm">
										<div class="mb-3 d-none">
											<label for="IdDossier" class="form-label">Id_dossier</label>
											<input type="text" class="form-control id_dossier" rows="3" required></input>
										</div>
										<div class="mb-3">
											<label for="personneSelect" class="form-label">Personne</label>
											<select class="form-select form-control" id="personneSelect" required>
												<option value="" disabled selected>Choisir une personne</option>
												<option value="CCDF">CCDF*</option>
												<option value="president">President C.E.L*</option>
												<option value="Entité 1">Avis Srat</option>
												<option value="Entité 2">Avis eau et foret</option>
												<option value="Entité 3">Avis autre</option>
												<option value="Nouveau">Autre ...</option>
											</select>
											<input id="personneInput" name="personneInput" type="text" class="form-control" placeholder="Entrez une autre" style="display:none;">
										</div>
										<div class="mb-3">
											<label for="avisInput" class="form-label">Avis</label>
											<input type="text" class="form-control" id="avisInput" rows="3" required></input>
										</div>
										<div id="CCDFAvis">
											<div class="mb-3" id="prices">
												<label for="prixCCDF" class="form-label">Prix(Ar)</label>
												<input type="number" min="50" class="form-control" id="prixCCDF" rows="3"></input>
											</div>
											<div class="form-group" id="ModAttrs">
												<label for="ModAttr">Mode d'attribution :</label>
												<select id="ModAttr" name="ModAttr" class="form-control">
													<option value="Vente definitive">Vente definitive</option>
													<option value="Vente à l'amiable">Vente à l'amiable</option>
													<option value="Vente de gré à gré">Vente de gré à gré</option>
													<option value="Nouveau">Autre...</option>
												</select>
												<input id="ModAttrInput" name="ModAttrInput" type="text" class="form-control" placeholder="Entrez une autre" style="display:none;">
											</div>
										</div>
									</form>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
									<button type="button" id="addAvisButton" class="btn btn-primary">Ajouter</button>
								</div>
							</div>
						</div>
					</div>
					<!-- Formulaire Modal -->
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
<script src="<?php echo base_url('assets/js/ajax/View_dossier_guichet_EnAttente.js?v=' . time()); ?>"></script>
<!-- jQuery -->
