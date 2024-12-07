// ! Au debut
$(document).ready(function () {
	$('#tablerecu').DataTable({
		destroy: true,
		dom: 'Bfrtip',
		language: {
			search: "Recherche :",
			lengthMenu: "Afficher _MENU_ entrées",
			info: "Affichage de _START_ à _END_ sur _TOTAL_ entrées",
			infoEmpty: "Affichage de 0 à 0 sur 0 entrée",
			infoFiltered: "(filtré de _MAX_ entrées au total)",
			loadingRecords: "Chargement...",
			zeroRecords: "Aucun résultat trouvé",
			emptyTable: "Aucune donnée disponible dans le tableau",
			paginate: {
				first: "Premier",
				last: "Dernier",
				next: "Suivant",
				previous: "Précédent"
			},
			buttons: {
				copy: "Copier",
				csv: "Exporter CSV",
				excel: "Exporter Excel",
				pdf: "Exporter PDF",
				print: "Imprimer"
			}
		},
		pageLength: 5, // Définit le nombre d'entrées par page à 7,
		buttons: [
			{
				extend: 'colvis',
				text: 'Col'
			},
		]
	});
	$('.btnreperage').on('click', function () {
		$('#reperageModalReperage').empty('');
		let empt = '';
		var id_dossier = $(this).data('id_dossier');
		var empietement = $(this).data('empietement');
		if (empietement == 'True') {
			empt = "Avec empietement"
		} else {
			empt = "Sans empietement"
		}
	});
});
// ! Scripts (2) pour le lancement de convocation C.E.L
$('.btnconvocation').on('click', function () {
	var id_dossier = $(this).data('id_dossier');
	var num_affaireS = $(this).data('num_affaires');
	console.log(num_affaireS,'T',id_dossier);
	var dateConvo= $('#date_convo').val();
	console.log(dateConvo);
	$('.modal-title').text('Lancement de convocation pour :' + num_affaireS);
	$('#date_convo').val(dateConvo);
	$('#id_dossierS').val(id_dossier);
});
$('.btnConvoSend').on('click', function () {
	var id_dossier = $('#id_dossierS').val();
	var date_convo = $('#date_convo').val();
	console.log(id_dossier);
	$.ajax({
		url: base_url + 'DossierController/convocationDossier/' + id_dossier +'/'+ date_convo,
		type: "POST",
		success: function (response) {
			console.log("okok")
		},
		error: function () {
			alert('Etat non sauvegarder');
		}
	});
});
// ! Script pour afficher les détails sur le demandeur et sur le terrain d'un dossier 
$('#liste-dossiers').on('click', '.btndetails', function () {
	var dossierId = $(this).data('id');
	$.ajax({
		url: site_url + 'DossierController/getDetails/' + dossierId,
		type: 'GET',
		success: function (data) {
			// Nettoyer la chaîne pour éliminer les caractères invisibles (comme les espaces ou BOM)
			 var datat = data.replace(/^\s+|\s+$/g, '').replace(/[\x00-\x1F\x7F]/g, '');  // Supprimer les espaces et les caractères de contrôle
			
			try {
				var datar = JSON.parse(datat);
				console.log("Parsing réussi de datastsr", datar);
			  } catch (e) {
				console.error("Erreur lors du parsing du JSON :", e.message);
			  }
			$('#detailsDemandeur').empty();
			$('#detailsTerrain').empty();
			$('#detailsPiecesJointes').empty();
			// Vérifiez s'il y a des demandeurs
			if (datar.demandeurs && datar.demandeurs.length > 0) {
				$.each(datar.demandeurs, function (index, demandeur) {
					let type_demandeur = '';
					if (demandeur.type_demandeur == 1) {
						type_demandeur = "Personne physique";
					} else if (demandeur.type_demandeur == 2) {
						type_demandeur = "Personne morale";
					}
					// Générer l'HTML pour chaque demandeur
					let demandeurhtml = `
					<div class="grandTitre bg-secondary card pt-1" ></div>
						<h6>N° ${(index + 1).toString().padStart(2, '0')} sur ${datar.demandeurs.length}</h6>
						<p>Nom : <span id="nom_demandeur">${demandeur.nom_demandeur}</span></p>
						<p>Prénom: <span id="prenom_demandeur">${demandeur.prenom_demandeur}</span></p>
						<p>Type: <span id="type_demandeur">${type_demandeur}</span></p>
						<p>CIN: <span id="cin_demandeur">${demandeur.cin_demandeur}</span></p>
						<p>Téléphone : <span id="telephone">${demandeur.telephone}</span></p>             `;
					// Ajouter chaque demandeur au conteneur des demandeurs
					$('#detailsDemandeur').append(demandeurhtml);
				});
			} else {
				$('#detailsDemandeur').append('<p>Aucun demandeur trouvé.</p>');
			}
			// Affichage du details du terrain 
			let type_terrain, num_titre, nom_prop, parcelle, section, canton = '';
			let terrainhtml = '';
			// Vérifiez si des détails de terrain sont disponibles
			if (datar.terrain) {
				let locationData = datar.terrain.localisation;

				// Diviser la chaîne en utilisant le séparateur '-'
				let parts = locationData.split('-');

				// Création d'une petite phrase
				let formattedSentence = ` Dans le district de ${parts[1]} comprend la commune de ${parts[2]}, située dans le fokontany de ${parts[3]}.`;

				if (datar.terrain.type_terrain == 1) {
					type_terrain = "Titré";
					terrainhtml = `
						<p>Type de terrain : <span id="type_terrain">${type_terrain}</span></p>
						<p>Superficie : <span id="superficie">${datar.terrain.superficie} m²</span></p>
						<p>Numéro de Titre : <span id="num_titre">${datar.terrain.num_titre}</span></p>
						<p>Nom de la propriete :<span id="num_parcelle">${datar.terrain.nom_propriete}</span></p>
						<p>Localisation :<span id="num_parcelle">${formattedSentence}</span></p>
					   `;
				} else if (datar.terrain.type_terrain == 2) {
					type_terrain = "Cadastré";
					terrainhtml = ` 
						<p>Type de terrain : <span id="type_terrain">${type_terrain}</span></p>
						<p>Superficie : <span id="superficie">${datar.terrain.superficie} m²</span></p>
						<p>Numéro de Parcelle : <span id="num_parcelle">${datar.terrain.num_parcelle}</span></p>
						<p>Section : <span id="section">${datar.terrain.section}</span></p>
						<p>Canton : <span id="canton">${datar.terrain.canton}</span></p>
						<p>Localisation :<span id="num_parcelle">${formattedSentence}</span></p>
					`;
				} else {
					type_terrain = "Ni titré ni cadastré";
					terrainhtml = ` 
						<p>Type de terrain : <span id="type_terrain">${type_terrain}</span></p>
						<p>Superficie : <span id="superficie">${datar.terrain.superficie} m²</span></p>
						<p>Localisation :<span id="num_parcelle">${formattedSentence}</span></p>
					`;
				}
				// Ajouter les détails du terrain au conteneur
				$('#detailsTerrain').append(terrainhtml);
			} else {
				$('#detailsTerrain').append('<p>Aucun détail de terrain trouvé.</p>');
			}
			//Affichage des pieces jointes du dossier parmis les details du dossier
			if (datar.piecejointes && datar.piecejointes.length > 0) {
				$.each(datar.piecejointes, function (index, piecejointe) {
					if (piecejointe.id_dossier == dossierId) {
						var fileNames = piecejointe.path_plan;
						var fileUrls = 'http://localhost/etrait/assets/uploads/nouvelledemande/' + fileNames;

						// Create a link for each file
						var fileLinks = `
								<a href="${fileUrls}" target="_blank">${fileNames}</a><br/>
							`;
						$('#detailsPiecesJointes').append(fileLinks);
					}
				});
			} else {
				$('#detailsPiecesJointes').text("Aucun fichier n'est associé à ce dossier");
			}
		},
		error: function (xhr, status, error) {
			let errorMessage = xhr.status + ': ' + xhr.statusText;
			console.log('Une erreur s\'est produite lors du chargement des détails du dossier.\n' + errorMessage +','+ error);
		}
	});


});

function enregObservation() {
	var idtransfert = $('#idtransfert').val();
	var transfert_situation = $('#retour').val();
	var obs_dest = $('#obs').val();
	var iddest = $('#destinataire').val();
	var designation = $('#designation').val();
	var idpers = $('#idpers').val();
	alert(transfert_situation);
	$.ajax({
		type: "POST",
		url: base_url + "0070000",
		data: {
			idtransfert: idtransfert,
			transfert_situation: transfert_situation,
			obs_dest: obs_dest,
			iddest: iddest,
			idpers: idpers,
			designation: designation
		},
		success: function (response) {
			console.log(response);
			alert(response);
			if (response == 'true') {
				location.href = "<?php echo site_url('0000700') ?>?i=" + idpers;
			} else if (response == 'erreurobs') {
				alert('Erreur insertion observation!veuillez contacter votre administrateur');
			} else if (response == 'erreurtransfert') {
				alert('Erreur de transfert. Veuillez recommencer');
			} else {
				alert('erreur!veuillez contacter votre administrateur');
			}
		},
		error: function (xhr, status, error) {
			alert(error);
			alert(status);
			console.error("Erreur AJAX:", status, error);
		}
	});
}

function traiter(iddossier, idpers, identite, idtransfert, designation) {
	document.getElementById('idtransfert').value = idtransfert;
	document.getElementById('designation').value = designation;
	document.getElementById('idpers').value = idpers;
	$('#modal-traitement').modal('show');
}

function recevoir(iddossier, idpers, identite, idtransfert) {
	alert(idpers);
	showConfirmationModal('Êtes-vous sûr de vouloir confirmer cet action ?', function () {
		recevoir_dossier(idpers, idtransfert);
	});
}

function recevoir_dossier(idpers, idtransfert) {

	var idtransfert = idtransfert;
	$.ajax({
		type: "POST",
		url: base_url + "0007000",
		data: {
			idtransfert: idtransfert
		},
		success: function (response) {
			if (response == 'true') {
				location.href = site_url + '0000700' + '/i=' + idpers;
			} else {
				alert('erreur!veuillez contacter votre administrateur');
			}
		},
		error: function (xhr, status, error) {
			alert("erreur lors du reception au supérieur");
			console.error("Erreur AJAX:", status, error);
		}
	});
}
// Fonction pour ouvrir le modal de confirmation
function showConfirmationModal(message, onConfirm) {
	// Définir le message dans le modal
	document.getElementById('confirmationMessage').textContent = message;

	// Définir la fonction à appeler lorsque l'utilisateur confirme
	document.getElementById('confirmYes').onclick = function () {
		// Appeler la fonction de confirmation
		if (typeof onConfirm === 'function') {
			onConfirm();
		}
		// Fermer le modal
		$('#confirmationModal').modal('hide');
	};

	// Afficher le modal
	$('#confirmationModal').modal('show');
}

function newDossier() {
	$.ajax({
		type: "POST",
		url: base_url + "0000007",
		data: '',
		success: function (data) {
			document.getElementById('numordre').value = data;
		}
	});
	$('#modal-nouveau').modal('show');
}

function enregDossier() {

	var idpersid = document.getElementById('idpers');
	var idpers = idpersid.getAttribute('data-idpers');
	var datesaisie = $('#datesaisie').val();
	var numbe = $('#numbe').val();
	var numordre = $('#numordre').val();
	var datedossier = $('#datedossier').val();
	var expediteur = $('#expediteur').val();
	var designation = $('#designation').val();

	$.ajax({
		type: "POST",
		url: "<?php echo base_url(); ?>0000070",
		data: {
			idpers: idpers,
			datesaisie: datesaisie,
			numbe: numbe,
			numordre: numordre,
			datebe: datedossier,
			expediteur: expediteur,
			designation: designation
		},
		success: function (response) {
			location.href = site_url + '0000006' + '/i=' + idpers;
		},
		error: function (xhr, status, error) {
			alert("erreur lors du transfert au supérieur");
			console.error("Erreur AJAX:", status, error);
		}
	});
}



