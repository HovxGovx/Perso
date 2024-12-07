<style>
	.data-item {
		margin-bottom: 10px;
		font-family: Arial, sans-serif;
		color: #333;
	}

	.data-item span {
		font-weight: bold;
	}

	.divplus {
		font-size: 18px;
		position: relative;
		left: 7rem;
		width: 40%;
	}

	.grandTitre {
		display: flex;
		justify-content: center;
		align-items: center;
	}

	label {
		position: relative;
		left: 0.5rem;
	}

	input,
	textarea {
		height: 3rem !important;
		font-size: 18px;
	}


	.btn-group-vertical {
		display: block;
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

	.dataTables_filter {
		margin-right: 25px !important;
	}
</style>
<br><br>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="background-color: white">
	<!-- Content Header (Page header) -->
	<div class="container-fluid">
		<div class="row">
			<div class="col-12">
				<strong style="text-align: center;
                    color: orange;
                    font-size: 1.5em;margin-left: 40%"> Dossier envoyer</strong>
			</div>
			<br>
			<div class="col-12">
				<div id="liste-dossiers">
					<form action="#">
						<table id="example1" class="table table-bordered table-striped">
							<thead>

								<tr>
									<th>Numéro d'affaire</th>
									<th>Objet de la fiche</th>
									<th>Date demande</th>
									<th>Nature demande</th>
									<th>Description</th>
									<th>Action</th>
								</tr>

							</thead>
							<tbody>
								<?php foreach ($envoiCCDF as $value) : ?>
									<tr>
										<td><strong><?php echo $value['num_affaire']; ?></strong></td>
										<td><?php echo $value['objetfiche']; ?></td>
										<td><?php echo $value['date_demande']; ?></td>
										<td><?php echo $value['nature_demande']; ?></td>
										<td><?php echo $value['description']; ?></td>
										<td class="btn-group">
											<!--<div class="gg">-->
											<!--<div class="ccc">-->
											<button class="btn btn-secondary  btncel shadow" data-id="<?php echo $value["id_dossier"] ?>" data-toggle="modal" data-target="#myModal">
												<i class="fas fa-eye"></i> C.E.L
											</button>
											<button class="btn btn-primary  btndetails shadow" data-id="<?php echo $value["id_dossier"] ?>" data-toggle="modal" data-target="#detailModalContent">
												<i class="far fa-file-alt"></i> Dossier
											</button>
										</td>
									</tr>
								<?php endforeach; ?>
							</tbody>

						</table>
					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- Ces sections sont afficher par ajax -->
	<section class="cel">
		<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-body">
						<div class="grandTitre bg-secondary card pt-1">
							<h5>Détails du Constat d'etat des lieux</h5>
						</div>
						<div id="data-display">

						</div>
						<div class="form-group">
							<!-- Tableau des avis -->
							<table class="table table-bordered align-center">
								<thead>
									<tr>
										<th>Nom</th>
										<th>Avis</th>
										<th>Autres</th>
									</tr>
								</thead>
								<tbody id="avisTableBody">
									<!-- Les avis ajoutés apparaîtront ici -->
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- section etails -->
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
	<!-- section avis -->
	<section class="avis">
		<div class="modal fade" id="avis" tab-index="1" role="dialog" aria-labelledby="modal_form_label" aria-hidden="false">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Avis</h5>
					</div>
					<div class="modal-body">
						<form action="<?php echo base_url('TransferController/ajouterDonneesAvis'); ?>" method="post" class="  mr-2 shadow  px-2 py-2 ">
							<div class="form-group d-none">
								<label for="auteur">Auteur</label>
								<input type="text" name="auteur" class="form-control" id="auteur" rows="3" value="<?php echo $username; ?>"></input>
							</div>
							<div class="form-group d-none">
								<label for="auteur">Avis ID</label>
								<input type="text" name="idAvis" class="form-control" id="idAvis" rows="3"></input>
							</div>
							<div class="form-group d-none">
								<label for="id_dossier">Dossier</label>
								<input type="text" name="id_dossier" class="form-control" id="id_dossier" rows="3"></input>
							</div>
							<div class="form-group ">
								<label for="id_dossier">Numero Affaire</label>
								<input type="text" name="num_affaireYY" class="form-control" id="num_affaireYY" rows="3"></input>
							</div>
							<div class="form-group ">
								<label for="avis">Avis</label>
								<select name="avis2" id="avis2" class="form-control">
									<option value="Pour avis">Pour avis </option>
									<option value="Pour decision">Pour decision</option>
									<option value="Pour approbation">Pour approbation</option>
									<option value="Pour second reperage">Pour second reperage</option>
									<option value="3">Accepter</option>
									<option value="4">Refuser</option>
								</select>
							</div>
							<section>
							</section>
							<div class="form-group" id="destinataire">
								<label for="destinataire">Destinataires</label>
								<select name="destinataire" class="form-control">
									<option value="SRD">SRD </option>
									<option value="SDC">SDC</option>
								</select>
							</div>

							<div class="form-group d-none" id="ModAttrs">
								<label for="ModAttr">Mode d'attribution :</label>
								<select id="ModAttr" name="ModAttr" class="form-control">
									<option value="Vente definitive">Vente definitive</option>
									<option value="Vente à l'amiable">Vente à l'amiable</option>
									<option value="Vente de gré à gré">Vente de gré à gré</option>
								</select>
							</div>
							<div class="form-group d-none">
								<label for="prix">Prix(Ar/m²)</label>
								<input type="number" min="50" name="prix" class="form-control" id="prix" rows="3"></input>
							</div>

							<div class="form-group">
								<label for="obs">Observation</label>
								<textarea class="form-control" name="obs" id="obs" rows="3" placeholder="Observation" required></textarea>
							</div>
							<div class="d-flex justify-content-between mt-4">
								<input type="submit" class="btn btn-primary" name="noo" class="form-control" rows="3"></input>
								<button class="btn btn-success">Accepter</button>
								<button class="btn btn-danger">Refuser</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>

<script>
	var base_url = '<?php echo base_url(); ?>';
	var site_url = '<?php echo site_url(); ?>';
</script>
<script src="<?php echo base_url('assets/js/ajax/View_dossier_Envoi_ccdf.js?v=' . time()); ?>"></script>
<!-- jQuery -->
