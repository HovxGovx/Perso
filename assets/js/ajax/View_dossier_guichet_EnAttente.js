// ! Au debut

// Sauvegarder une copie des options initiales
const selectElement = document.getElementById('personneSelect');
const originalHTML = selectElement.innerHTML;
$(document).ready(function () {
	$('#tablerecu').DataTable({
		destroy: true,
		dom: 'Bfrtip',
		language: {
			search: "Recherche :",
			lengthMenu: "Afficher _MENU_ entrées",
			info: "Affichage de _START_ à _END_ sur _TOTAL_ dossiers",
			infoEmpty: "Aucun dossier à afficher",
			infoFiltered: "(filtré de _MAX_ entrées au total)",
			loadingRecords: "Chargement...",
			zeroRecords: "Aucun résultat trouvé",
			emptyTable: "Aucun dossier à afficher",
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
		pageLength: 5, // Définit le nombre d'entrées par page à ,
		buttons: [
			{
				extend: 'colvis',
				text: 'Colonne'
			},
		]
	});
	// ! Pour le select option du mode d'attribution
	var selectedValuesModAttr = $('#ModAttr').val();
	$('#ModAttrInput').val(selectedValuesModAttr);
	var selectedValuesPersonne = $('#personneSelect').val();
	$('#personneInput').val(selectedValuesPersonne);
	//  *  Celui de l'objet demande dans le fomulaire Demande
	$('#ModAttr').change(function () {
		var selectedValueFiche = $(this).val();

		if (selectedValueFiche === 'Nouveau') {
			// Show input field for custom entry
			$('#ModAttrInput').show().val(''); // Clear the input field
		} else {
			// Hide input field and set its value to the selected option
			$('#ModAttrInput').hide().val(selectedValueFiche);
		}
	});
	// ? Optionally, synchronize the input value with the select
	$('#ModAttrInput').on('input', function () {

		$('#ModAttr').val('Nouveau');
	});
	// ! Pour le select option du Personne
	$('#personneSelect').change(function () {
		var selectedValuePers = $(this).val();

		if (selectedValuePers === 'Nouveau') {
			// Show input field for custom entry
			$('#personneInput').show().val(''); // Clear the input field
		} else {
			// Hide input field and set its value to the selected option
			$('#personneInput').hide().val(selectedValuePers);
		}
	});
	// ? Optionally, synchronize the input value with the select
	$('#personneInput').on('input', function () {
		var test = $(this).val();
		$('#personneSelect').val(test);
	});
	// ! ppppppppppppppppppppppppppp
	$('#addAvisButton').click(function () {
		// ! Ajouter dans le tableau les avis
		try {
			var idDossi = $('.id_dossier').val();
			var personne = $('#personneSelect').val();
			var avis = $('#avisInput').val().trim();
			var prix = $("#prixCCDF").val();
			var mod_attr = $('#ModAttr').val();
			if (!(personne == 'CCDF')) {
				mod_attr = '';
				prix = "";
			} else {
				if (!prix) {
					alert("Veuillez remplir tous les champs.");
					return;
				}
			}
			if (!personne || !avis) {
				alert("Veuillez remplir tous les champs.");
				return;
			}
			console.log({
				id_dossierSS: idDossi,
				auteurSS: personne,
				avisSS: avis,
				prixSS: prix,
				Mod_AttrSS: mod_attr,
			});

			$.ajax({
				type: "POST",
				url: base_url + "AvisController/AjoutAvis",
				data: {
					id_dossierSS: idDossi,
					auteurSS: personne,
					avisSS: avis,
					prixSS: prix,
					Mod_AttrSS: mod_attr,
				},
				success: function (response) {
					console.log(response);
					const result = JSON.parse(response);
					if (response) {
						loadAvis(idDossi);
						// Optionnel : Réinitialiser le formulaire et fermer le modal
						$('#avisForm').find('input:not(:first)').val('');
					} else {
						console.log(response || "Une erreur est survenue");
					}

				},
				error: function (xhr, status, error) {
					console.log(error);
					console.log(status);
					console.error("Erreur AJAX ajout avis:", status, error);
				}
			});
		} catch (e) {
			console.error("Erreur lors de l'ajout de l'avis : ", e);
		}
	});


	// ! Controle de l'affichages des champs pour 
	$('#CCDFAvis').hide();
	$('#personneSelect').change(function () {
		var ccdf = $('#personneSelect').val();
		if (ccdf == "CCDF") {
			console.log("ok:" + ccdf);
			$('#CCDFAvis').show();
		}
		else {
			$('#CCDFAvis').hide();
			console.log("pas ok" + ccdf);
		}

	})
	$('.resetAndModal').on('click', function () {
		var idDossier = $(this).data('id_dossier');
		$('.id_dossier').val(idDossier);
		// Vider le tableau
		$("#avisTableBody").empty();
		loadAvis(idDossier);

	});
	// ! Synchronisation de la valeur des select avec ceux de l'input pour la vocation du terrain
	var selectedValuesVocationT = $('#VocationT').val();
	$('#vocationInput').val(selectedValuesVocationT);
	$('#VocationTInput').val(selectedValuesVocationT);
	//  *  Celui de l'objet demande dans le fomulaire Demande
	$('#VocationT').change(function () {
		var selectedValueFiche = $(this).val();
		console.log("Changesss");
		if (selectedValueFiche === 'Nouveau') {
			// Show input field for custom entry
			$('#VocationTInput').show().val(''); // Clear the input field
		} else {
			// Hide input field and set its value to the selected option
			$('#VocationTInput').hide().val(selectedValueFiche);
		}
	});
	// ? Optionally, synchronize the input value with the select
	$('#vocationInput').on('input', function () {
		$('#VocationT').val('Nouveau');
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
						<p>Nom  : <span id="nom_demandeur">${demandeur.nom_demandeur}</span></p>
						<p>Prénom: <span id="prenom_demandeur">${demandeur.prenom_demandeur}</span></p>
						<p>Type : <span id="type_demandeur">${type_demandeur}</span></p>
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
			console.log('Une erreur s\'est produite lors du chargement des détails du dossier.\n' + errorMessage + ',' + error);
		}
	});


});

$('.btnAttente').on('click', function () {
	var jourRestantes = $(this).data('jour_restante');
	var numAffaire = $(this).data('num_affaire');
	console.log("jour restante:" + jourRestantes);
	$('#nbrjrsrest').text('');
	$('#exampleModalLongTitle').text('');

	$('#nbrjrsrest').text(jourRestantes);
	$('#exampleModalLongTitle').text(numAffaire);

	console.log("Texte :" + $('#nbrjrsrest').text());

});
$("#etape_suivante").prop("disabled", false);

var ccdf, personneCEL = false;
// ! script ajax pour recupere les avis
function loadAvis(idDossier) {
	// Envoyer une requête AJAX pour récupérer les avis
	$.ajax({
		url: base_url + 'AvisController/getAvisByDossier', // URL vers le contrôleur
		type: 'POST',
		data: { id_dossierSS: idDossier }, // Envoyer l'ID du dossier
		success: function (responses) {
			var responsee = responses.replace(/^\s+|\s+$/g, '').replace(/[\x00-\x1F\x7F]/g, '');  // Supprimer les espaces et les caractères de contrôle
			var response = JSON.parse(responsee);
			console.log(response);
			const avisList = response;
			ccdf, personneCEL = false;
			if (ccdf && personneCEL) {
				console.log("activer");
				$(".etape_suivante").prop("disabled", false);// ! peut passer
			} else {
				console.log("desactiver");
				$(".etape_suivante").prop("disabled", true);// ! non
			}
			if (avisList.length > 0) {
				const tableBody = $('#avisTableBody'); // ID du tableau
				tableBody.empty(); // Nettoyer le tableau avant d'ajouter les nouvelles lignes
				var qlq='';
				// Restaurer les options depuis la sauvegarde HTML
				selectElement.innerHTML = originalHTML;
				avisList.forEach((avis) => {
					if(avis.auteur == "CCDF"){
						qlq= avis.prix +"Ar,par"+avis.Mod_Attr ;
					}else{
						qlq='';
					}
					for (let i = 0; i < selectElement.options.length; i++) {
						if (selectElement.options[i].value === avis.auteur) {
							selectElement.remove(i);
							break;
						}
					}
					if (avis.auteur === "CCDF") {
						ccdf = true;
					}
					if (avis.auteur === "president") {
						personneCEL = true
					}
					if (ccdf && personneCEL) {
						console.log("activer");
						$(".etape_suivante").prop("disabled", false);// ! peut passer
					} else {
						console.log("desactiver");
						$(".etape_suivante").prop("disabled", true);// ! non
					}

					const row = `
                            <tr data-id="${avis.id_avis}" data-name="${avis.auteur}">
                                <td>${avis.auteur}</td>
                                <td>${avis.avis}</td>
                                <td>${avis.prix} Ar,par ${avis.Mod_Attr}</td>
                                <td>
                                    <button type="button" class="btn btn-danger btn-sm deleteAvis">Supprimer</button>
                                </td>
                            </tr>
                        `;
					tableBody.append(row); // Ajouter la ligne au tableau
				});
			}
		},
		error: function (xhr, status, error) {
			console.error('Erreur AJAX :', error);
			alert('Une erreur est survenue lors du chargement des avis.');
		}
	});
}
// ! script ajax pour supprimer un avis
$(document).on('click', '.deleteAvis', function () {
	// Récupérer la ligne et l'ID à partir de l'attribut data-id
	const row = $(this).closest('tr');
	const idAvis = row.data('id');

	// Confirmation avant suppression
	if (confirm('Êtes-vous sûr de vouloir supprimer cet avis ?')) {
		// Envoyer la requête AJAX pour supprimer dans la base de données
		$.ajax({
			url: base_url + 'AvisController/deleteAvis', // URL de l'endpoint côté serveur
			type: 'POST',       // Méthode HTTP
			data: { id: idAvis }, // Envoyer l'ID de l'avis
			success: function (response) {
				if (response) {
					// Supprimer la ligne du tableau en cas de succès
					row.remove();
					alert('Avis supprimé avec succès.');
				} else {
					alert('Erreur lors de la suppression : ' + response.message);
				}
			},
			error: function (xhr, status, error) {
				// Gérer les erreurs
				alert('Une erreur est survenue : ' + error);
			}
		});
	}
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

function editTerrain(id_terrain) {
	// Make an AJAX call to get the terrain data
	$.ajax({
		url: site_url + 'TerrainController/getTerrain/' + id_terrain,
		type: 'GET',
		dataType: 'json',
		success: function (data) {
			type_terrains = '';
			if (data.terrain) {
				// Populate the modal form fields with the response data
				$('#id_terrainmodif').val(data.terrain.id_terrain);
				$('#superficiemodif').val(data.terrain.superficie);
				$('#num_titremodif').val(data.terrain.num_titre);
				$('#num_parcellemodif').val(data.terrain.num_parcelle);
				$('#sectionmodif').val(data.terrain.section);
				$('#type_terrainmodif').val(data.terrain.type_terrain);
				$('#nom_proprietemodif').val(data.terrain.nom_propriete);
				$('#cantonmodif').val(data.terrain.canton);
				// Ajouter les détails du terrain au conteneur
				//$('#detailsTerrainmodif').append(terrainhtml);
				// Show the modal
				$('#editTerrainModal').modal('show');
			} else {
				alert('Failed to retrieve terrain data.');
			}
		},
		error: function () {
			alert('Error retrieving terrain data.');
		}
	});
}

function submitEditTerrain() {
	// Collect data from the form
	var formData = {
		id_terrain: $('#id_terrainmodif').val(),
		superficie: $('#superficiemodif').val(),
		num_titre: $('#num_titremodif').val(),
		num_parcelle: $('#num_parcellemodif').val(),
		section: $('#sectionmodif').val(),
		type_terrain: $('#type_terrainmodif').val(),
		nom_propriete: $('#nom_proprietemodif').val(),
		canton: $('#cantonmodif').val()
	};

	// Send the updated data via AJAX
	$.ajax({
		url: site_url + 'TerrainController/updateTerrain',
		type: 'POST',
		contentType: 'application/json',
		data: JSON.stringify(formData),
		success: function (response) {
			if (response.success) {
				alert("Terrain updated successfully.");
				$('#editTerrainModal').modal('hide'); // Hide the modal after successful update
				// Optionally, refresh the page or update the table to reflect changes
			} else {
				alert("Failed to update terrain.");
			}
		},
		error: function () {
			alert("Error updating terrain.");
		}
	});
}

