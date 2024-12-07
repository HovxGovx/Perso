$(document).ready(function () {
	$('#example1').DataTable({
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
	$('.btncel').on('click', function () {
		var idDossier = $(this).data('id');
		$('#id_dossier').val(idDossier);
		// Vider le tableau
		$("#avisTableBody").empty();
		loadCel(idDossier);
		loadAvis(idDossier);
	});

	// ! Script pour l'envoie
	// Initially hide the destinataire div and set buttons visibility
	$('#destinataire').hide();
	$('.btn-primary, .btn-danger, .btn-success').hide();
	updateButtons();
	// Event handler for avis change
	$('#avis2').on('change', function () {
		updateButtons();
	});
	
	// ! Script pour afficher les détails sur le demandeur, sur le terrain et sur les fichiers d'un dossier
	$('#liste-dossiers').on('click', '.btndetails', function () {
		var dossierId = $(this).data('id');
		console.log(dossierId);
		var type_demandeur = "";
		$.ajax({
			url: site_url + 'DossierController/getDetails/' + dossierId,
			type: 'GET',
			success: function (data) {
				// Nettoyer la chaîne pour éliminer les caractères invisibles (comme les espaces ou BOM)
				var datat = data.replace(/^\s+|\s+$/g, '').replace(/[\x00-\x1F\x7F]/g, '');  // Supprimer les espaces et les caractères de contrôle

				try {
					var data = JSON.parse(datat);
					console.log("Parsing réussi de datastsr");
				} catch (e) {
					console.error("Erreur lors du parsing du JSON :", e.message);
				}
				$('#detailsDemandeur').empty();
				$('#detailsTerrain').empty();
				$('#detailsPiecesJointes').empty();
				if (data.demandeurs ) {
					$.each(data.demandeurs, function (index, demandeur) {
						let type_demandeur = '';
						if (demandeur.type_demandeur == 1) {
							type_demandeur = "Personne physique";
						} else if (demandeur.type_demandeur == 2) {
							type_demandeur = "Personne morale";
						}
						// Générer l'HTML pour chaque demandeur
						let demandeurhtml = `
						<div class="grandTitre bg-secondary card pt-1" ></div>
						<h6>N° ${(index + 1).toString().padStart(2, '0')} sur ${data.demandeurs.length}</h6>
						<p>Nom du demandeur : <span id="nom_demandeur">${demandeur.nom_demandeur}</span></p>
						<p>Prénom du demandeur : <span id="prenom_demandeur">${demandeur.prenom_demandeur}</span></p>
						<p>Type du demandeur : <span id="type_demandeur">${type_demandeur}</span></p>
						<p>CIN du demandeur : <span id="cin_demandeur">${demandeur.cin_demandeur}</span></p>
						<p>Téléphone : <span id="telephone">${demandeur.telephone}</span></p>             `;
						// Ajouter chaque demandeur au conteneur des demandeurs
						$('#detailsDemandeur').append(demandeurhtml);
					});
				} else {
					$('#detailsDemandeur').append('<p>Aucun demandeur trouvé.</p>');
				}
				let type_terrain, num_titre, nom_prop, parcelle, section, canton = '';
				let terrainhtml = '';
				// Vérifiez si des détails de terrain sont disponibles
				if (data.terrain) {
					if (data.terrain.type_terrain == 1) {
						type_terrain = "Titré";
						terrainhtml = `
						<p>Type de terrain : <span id="type_terrain">${type_terrain}</span></p>
						<p>Superficie : <span id="superficie">${data.terrain.superficie} m²</span></p>
						<p>Numéro de Titre : <span id="num_titre">${data.terrain.num_titre}</span></p>
						<p>Nom de la propriete :<span id="num_parcelle">${data.terrain.nom_propriete}</span></p>
					`;
					} else if (data.terrain.type_terrain == 2) {
						type_terrain = "Cadastré";
						terrainhtml = ` 
						<p>Type de terrain : <span id="type_terrain">${type_terrain}</span></p>
						<p>Superficie : <span id="superficie">${data.terrain.superficie} m²</span></p>
						<p>Numéro de Parcelle : <span id="num_parcelle">${data.terrain.num_parcelle}</span></p>
						<p>Section : <span id="section">${data.terrain.section}</span></p>
						<p>Canton : <span id="canton">${data.terrain.canton}</span></p>
					`;
					} else {
						type_terrain = "Ni titré ni cadastré";
						terrainhtml = ` 
						<p>Type de terrain : <span id="type_terrain">${type_terrain}</span></p>
						<p>Superficie : <span id="superficie">${data.terrain.superficie} m²</span></p>
					`;
					}
					// Ajouter les détails du terrain au conteneur
					$('#detailsTerrain').append(terrainhtml);
				} else {
					$('#detailsTerrain').append('<p>Aucun détail de terrain trouvé.</p>');
				}
				//Affichage des pieces jointes du dossier parmis les details du dossier
				if (data.piecejointes) {
					$.each(data.piecejointes, function (index, piecejointe) {
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
				var errorMessage = xhr.status + ': ' + xhr.statusText;
				alert('Une erreur s\'est produite lors du chargement des détails du dossier.\n' + errorMessage);
			}
		});
	});
	// ! Script pour btnTransferer
	$('.btnTransferer').on('click', function (){
		var idDossierAA = $(this).data('id');
		var num_affaireAA = $(this).data('num_affaire');
		console.log(num_affaireAA);
		$("#num_affaireYY").val(num_affaireAA);
		loadCel(idDossierAA);
		loadAvis(idDossierAA);

	});
});
function updateButtons() {
		var avisValue = $('#avis2').val();
		if (avisValue == "3") { // Accepter
			console.log("OK Accepter")
			console.log(avisValue)
			$('.btn-primary').hide(); // Hide Envoyer
			$('.btn-danger').hide(); // Hide Refuser
			$('.btn-success').show(); // Show Accepter
			$('#destinataire').hide(); // Hide destinataire
		} else if (avisValue == "4") { // Refuser
			console.log("OK refuser")
			console.log(avisValue)

			$('.btn-primary').hide(); // Hide Envoyer
			$('.btn-success').hide(); // Hide Accepter
			$('.btn-danger').show(); // Show Refuser
			$('#destinataire').hide(); // Hide destinataire
		} else {
			console.log("OK Envoie");
			console.log(avisValue)

			$('.btn-success').hide(); // Hide Accepter
			$('.btn-danger').hide(); // Hide Refuser
			$('.btn-primary').show(); // Show Envoyer
			$('#destinataire').show(); // Show destinataire
		}
}
function loadCel(iDossi){
	$.ajax({
		url: base_url + 'CelController/getDetails/'+ iDossi, // URL vers le contrôleur
		type: 'POST', // Envoyer l'ID du dossier
		success: function (responses) {
			var responsee = responses.replace(/^\s+|\s+$/g, '').replace(/[\x00-\x1F\x7F]/g, '');  // Supprimer les espaces et les caractères de contrôle
			var response = JSON.parse(responsee);
			console.log(response);
			// Cible l'élément HTML pour afficher les données
            const dataDisplay = document.getElementById("data-display");
			// Vider le contenu du div
			dataDisplay.innerHTML = "";
			 // Créer les éléments HTML pour chaque objet de données
			 response.forEach((item) => {
                const container = document.createElement("div");
				container.innerHTML = "";
                container.className = "data-container";

                container.innerHTML = `
                    <p class="data-item"><span>Auteur :</span> ${item.auteur}</p>
                    <p class="data-item"><span>Consistance :</span> ${item.consistance}</p>
                    <p class="data-item"><span>Date Descente :</span> ${item.date_descente}</p>
                    <p class="data-item"><span>Date Mise en Valeur :</span> ${item.date_mise_valeur}</p>
                    <p class="data-item"><span>Résumé PV :</span> <a href="${item.resume_pv}" target="_blank">Voir le fichier</a></p>
                `;

                dataDisplay.appendChild(container);
            });
		},
		error: function (xhr, status, error) {
			console.error('Erreur AJAX :', error);
			alert('Une erreur est survenue lors du chargement des avis.');
		}
	});
}
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
			if (avisList.length > 0) {
				const tableBody = $('#avisTableBody'); // ID du tableau
				tableBody.empty(); // Nettoyer le tableau avant d'ajouter les nouvelles lignes
				var qlq='';
				avisList.forEach((avis) => {
					if(avis.auteur == "CCDF"){
						qlq= avis.prix +"Ar, par "+avis.Mod_Attr ;
						$("#idAvis").val(avis.id_avis);
						$("#ModAttr").val(avis.Mod_Attr);
						$("#prix").val(avis.prix);

						console.log(avis.id_avis);
					}else{
						console.log(avis.auteur);
						qlq='';
					}
					const row = `
                            <tr data-id="${avis.id_avis}" data-name="${avis.auteur}">
                                <td>${avis.auteur}</td>
                                <td>${avis.avis}</td>
                                <td>${qlq}</td>
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
