// ! Script pour Compter le nombre de fichier selectionner avant l'upload
document.addEventListener('DOMContentLoaded', function () {
    // Sélectionnez l'élément d'entrée de fichier
    var inputFile = document.getElementById('userfile');
    // Sélectionnez l'élément du message de comptage
    var fileCountMessage = document.getElementById('fileCountMessage');
    // Ajoutez un écouteur d'événement sur le changement de fichier
    inputFile.addEventListener('change', function () {
        // Obtenez le nombre de fichiers sélectionnés
        var fileCount = inputFile.files.length;
        // Affichez le message de comptage
        fileCountMessage.textContent = 'Nombre de fichiers sélectionnés : ' + fileCount;
    });
});
// !   Script s'executant au moments ou la page est charge
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
    getCirconscription();
    // Initialisation du type_demandeur
    get_type_demandeur();
    get_type_terrain();
    updateNumero();
    // ! Synchronisation de la valeur des select avec ceux de l'input
    var selectedValuesVocation = $('#vocationSelect').val();
    var selectedValuesObjetFiche = $('#objetfiche').val();
    var selectedValuesNature = $('#nature_demande').val();
    $('#vocationInput').val(selectedValuesVocation);
    $('#ObjetFicheInput').val(selectedValuesObjetFiche);
    $('#NatureInput').val(selectedValuesNature);

    // ! afficher ou cacher le boutton par rapport a l'etat d'empietement
    $("#Empt").addClass("hidden"); // Cacher le bouton au début
    $("input[name='reperage']").on("click", function () {
        if ($("#reper2").is(":checked")) {
            $("#Empt").removeClass("hidden").addClass("visible"); // Afficher le bouton
            $("#collapseThree").removeClass("visible").addClass("hidden");
            $("#demandes").addClass("hidden");
        } else {
            $("#Empt").removeClass("visible").addClass("hidden"); // Cacher le bouton
            $("#collapseThree").removeClass("hidden").addClass("visible");
            $("#demandes").removeClass("hidden");
        }
    });
    // ! Changement de type d'affaire
    $('#country-code').on('change', updateNumero);
    updateNumero();
    // ! Script pour les select options qui pourraient avoir d'autres option
    //  *  Celui de la vocation dans le fomulaire terrain
    $('#vocationSelect').change(function () {
        var selectedValue = $(this).val();

        if (selectedValue === 'Nouveau') {
            // Show input field for custom entry
            $('#vocationInput').show().val(''); // Clear the input field
        } else {
            // Hide input field and set its value to the selected option
            $('#vocationInput').hide().val(selectedValue);
        }
    });
    // ? Optionally, synchronize the input value with the select
    $('#vocationInput').on('input', function () {
        $('#vocationSelect').val('Nouveau'); // Always set to "Nouveau" when typing in the input
    });

    //  *  Celui de l'objet demande dans le fomulaire Demande
    $('#objetfiche').change(function () {
        var selectedValueFiche = $(this).val();

        if (selectedValueFiche === 'Nouveau') {
            // Show input field for custom entry
            $('#ObjetFicheInput').show().val(''); // Clear the input field
        } else {
            // Hide input field and set its value to the selected option
            $('#ObjetFicheInput').hide().val(selectedValueFiche);
        }
    });
    // ? Optionally, synchronize the input value with the select
    $('#vocationInput').on('input', function () {
        $('#objetfiche').val('Nouveau'); // Always set to "Nouveau" when typing in the input
    });

    //  *  Celui de la nature de demande dans le fomulaire Demande
    $('#nature_demande').change(function () {
        var selectedValueNature = $(this).val();

        if (selectedValueNature === 'Nouveau') {
            // Show input field for custom entry
            $('#NatureInput').show().val(''); // Clear the input field
        } else {
            // Hide input field and set its value to the selected option
            $('#NatureInput').hide().val(selectedValueNature);
        }
    });
    // ? Optionally, synchronize the input value with the select
    $('#NatureInput').on('input', function () {
        $('#nature_demande').val('Nouveau'); // Always set to "Nouveau" when typing in the input
    });
	
    // !  ALgo pour n'accepter que les dates d'il y a 18 ans pour l'anniversaire du demandeur
    // * Calculer la date d'il y a 18 ans à partir d'aujourd'hui
    var today = new Date();
    var eighteenYearsAgo = new Date();
    eighteenYearsAgo.setFullYear(today.getFullYear() - 18);
    // * Formater la date en YYYY-MM-DD
    var maxDate = eighteenYearsAgo.toISOString().split('T')[0];
    // * Appliquer la date maximale au champ date_naissance
    $('#date_naissance').attr('max', maxDate);
    $('#cin_demandeur').on('change', function () {
        var cinValue = $(this).val();
        if (cinValue.length === 12) {
            $('#cin-error').hide(); // Cache le message d'erreur si c'est valide
        } else {
            $('#cin-error').show(); // Affiche le message d'erreur sinon
        }
    });
    // Evenement pour changer le type demadeur
    $('#type_demandeur').change(function () {
        get_type_demandeur();
    });
});
// ! Fonction permettant de changer le type d'affaire
function updateNumero() {
    var selectedCode = $('#country-code').val();
    var date = new Date();
    var month = ('0' + (date.getMonth() + 1)).slice(-2);  // Format month as 2 digits
    var year = date.getFullYear().toString().slice(-2);  // Last 2 digits of the year
    var dateMarker = month + '/' + year;

    // Simuler la récupération du dernier numéro d'affaire (requête AJAX vers le serveur)
    $.ajax({
        url: base_url + 'Ajout_donnees/getLastNumero',  // Point de terminaison du serveur pour obtenir le dernier numéro
        method: 'POST',
        dataType: 'json',
        data: { code: selectedCode, year: year },
        success: function (response) {
            // Récupère le dernier numéro d'affaire
            var lastNumero = response.lastNumero; // Exemple : 001
            console.log('Response no cologena' + ' ' + response);
            // Si un numéro précédent existe, incrémenter, sinon commencer à 001
            var newNumero = lastNumero ? (parseInt(lastNumero) + 1).toString().padStart(4, '0') : '0001';
            console.log('New Numero' + newNumero);
            // Construire le nouveau numéro en utilisant le code, le numéro incrémenté et le marqueur de date
            var newValue = selectedCode + '-' + newNumero + '-' + dateMarker;

            // Afficher le nouveau numéro dans le champ de formulaire
            $('#phone-number').val(newValue);
        },
        error: function () {
            alert("Tsy poinsa");
            console.log("Erreur lors de la récupération du dernier numéro.");
        }
    });
}
// ! Fonction pour recuperer les circonscription a partir de l'id region du responsable connecter
function getCirconscription() {
    const regionID = id_region;
    $.ajax({
        type: "GET",
        url: base_url + 'Responsable/getCirconscription/' + regionID,
		success: function (response) {
			console.log(response);
            try {
				// Nettoyer la chaîne pour éliminer les caractères invisibles (comme les espaces ou BOM)
				var cleanedResponse = response.replace(/^\s+|\s+$/g, '').replace(/[\x00-\x1F\x7F]/g, '');  // Supprimer les espaces et les caractères de contrôle
				try {
					// Convertir la chaîne en tableau en utilisant JSON.parse
					var parsedResponse = JSON.parse(cleanedResponse);
			
					// Transformer le tableau en un tableau simple de chaînes de caractères
					var result = parsedResponse.map(function(item) {
						return item[0];  // Extraire la première valeur de chaque sous-tableau
					});
			
					// Affichage du résultat
					console.log("Les circonscription disponible pour cette region sont :",result);  
					$.each(result, function (index, value) {
						$('#selectCirconscription').append('<option value="' + index + '">' + value + '</option>');
					});
				} catch (e) {
					console.error('Erreur lors de l\'analyse JSON : ', e);
				}
            } catch (e) {
                console.error("Erreur lors de l'analyse JSON : ", e);
            }
		},
		error: function (xhr, status, error) {
            console.error("Erreur AJAX : ", status, error); // Affiche l'erreur technique
            alert("Une erreur s'est produite lors de la récupération des circonscriptions. Veuillez réessayer.");
        }
    });
}
// ! fonction pour recuperer le type de demandeur
function get_type_demandeur() {
    var typeDemandeur = $('#type_demandeur').val();
    var fields = [
        'cin_demandeur',
        'nom_demandeur',
        'prenom_demandeur',
        'representant',
        'date_naissance',
        'lieu_naissance',
        'adresse_demandeur',
        'pere_demandeur',
        'mere_demandeur',
        'telephone'
    ];
    clearFields(fields);
    if (typeDemandeur == '2') {
        $('#div_prenom').hide();
        $('#situation_familiale_container').hide();
        $('#situation_familiale').val('');
        $('#pere_demandeur_container').hide();
        $('#pere_demandeur').val('');
        $('#mere_demandeur_container').hide();
        $('#mere_demandeur').val('');
        $('#div_representant').show();

    } else {
        $('#div_prenom').show();
        $('#cin_demandeur_container').show();
        $('#situation_familiale_container').show();
        $('#pere_demandeur_container').show();
        $('#mere_demandeur_container').show();
        $('#div_representant').hide();
    }

}
// ! fonction pour recuperer le type du terrain
function get_type_terrain() {
    var typeTerrain = $('#type_terrain').val();
    if (typeTerrain == '1') {
        $('#num_titre').show();
        $('#nom_propriete').show();
        $('#num_parcelle').hide();
        $('#section').hide();
        $('#canton').hide();
    } else if (typeTerrain == '2') {
        $('#num_titre').hide();
        $('#nom_propriete').hide();
        $('#num_parcelle').show();
        $('#section').show();
        $('#canton').show();
    } else {
        $('#num_titre').hide();
        $('#nom_propriete').hide();
        $('#num_parcelle').hide();
        $('#section').hide();
        $('#canton').hide();
    }
}
// ! fonction pour vider les champs
function clearFields(fields) {
    fields.forEach(function (id) {
        $('#' + id).val('');
    });
}
// ! Variable globale pour stocker les idDemandeur et autres
var listeDemandeurEmpt = [];
// ! fonction pour ajouter le demandeur, ou le modifier si il existe deja
function enreg_demandeur() {
    var elementIDs = [
        'cin_demandeur',
        'type_demandeur',
        'nom_demandeur',
        'prenom_demandeur',
        'representant',
        'date_naissance',
        'lieu_naissance',
        'adresse_demandeur',
        'situation_familiale',
        'pere_demandeur',
        'mere_demandeur',
        'telephone'
    ];
    var formData = {};
    elementIDs.forEach(function (id) {
        var value = $('#' + id).val();
        formData[id] = value;
    });

    $.ajax({
        url: base_url + 'add_dmdr',
        type: 'POST',
        contentType: 'application/json',
        data: JSON.stringify(formData),
        success: function (res) {
            console.log('Success:', res);
            var parsedRes = JSON.parse(res);
            var idDemandeur = parsedRes.id_demandeur;
            // Ajout de l'idDemandeur dans la liste
            listeDemandeurEmpt.push(idDemandeur)
            console.log("Listes des iddemandeurs :", listeDemandeurEmpt);
            var cin = $('#cin_demandeur').val();
            var nom = $('#nom_demandeur').val();
            var prenom = $('#prenom_demandeur').val();
            var representant = $('#representant').val();
            var typeDemandeur = $('#type_demandeur').val();
            var tableBody = $('#tablebody');
            if (typeDemandeur == '1') {
                var row = '<tr>' +'<td> <input type="hidden" name="demandeur_nom[]" value="' + nom + '"/>' + nom + '</td>' +
                    '<td><input type="hidden" name="demandeur_id[]" value="' + idDemandeur + '"/> <input type="hidden" name="demandeur_prenom[]" value="' + prenom + '"/>' + prenom + '</td>' +
                    '<td> <input type="hidden" name="demandeur_cin[]" value="' + cin + '"/>' + cin + '</td>' +
                    '<td>' +
                    '<a class="btn btn-warning btn-sm" onclick="suppLigne(' + idDemandeur + ')" style="color: white">' +
                    '<i class="fas fa-user-times"></i> Retirer' +
                    '</a>' +
                    '</td>' +
                    '</tr>';
                tableBody.append(row);
            } else {
                var rowrep = '<tr>' +
					'<td><input type="hidden" name="demandeur_id[]" value="' + idDemandeur + '"/> <input type="hidden" name="demandeur_nom[]" value="' + nom + '"/>' + nom + '</td>' +
                    '<td> <input type="hidden" name="demandeur_nom[]" value="' + representant + '"/>' + representant + '</td>' +
					'<td> <input type="hidden" name="demandeur_cin[]" value="' + cin + '"/>' + cin + '</td>' +
                    '<td>' +
                    '<a class="btn btn-warning btn-sm" onclick="suppLigne(' + idDemandeur + ')" style="color: white">' +
                    '<i class="fas fa-user-times"></i> Retirer' +
                    '</a>' +
                    '</td>' +
                    '</tr>';
                tableBody.append(rowrep);
            }
        },
        error: function (error) {
            console.error('Error:', error);
        }
    });
}
// ! Fonction pour supprimer les lignes du tableau durant l'ajout de demandeur si besoin
function suppLigne(idDemandeur) {
    // Trouver la ligne parente du bouton cliqué et la supprimer
    var row = $('input[name="demandeur_id[]"][value="' + idDemandeur + '"]').closest('tr');
    row.remove();
	$('input[name="demandeur_id[]"][value="' + idDemandeur + '"]').value();

}
// ! suggestion de CIN  de demandeur deja enregistrer 
$("#cin_demandeur").keydown(function () {
    $.ajax({
        type: "POST",
        url: base_url + "cin_auto",
        data: 'keyword=' + $(this).val(),
        beforeSend: function () {
            $("#cin_demandeur").css("background", "#FFF url(LoaderIcon.gif) no-repeat 165px");
        },
        success: function (data) {
            var $list = "<ul id=\"demandeur-list\" class=\"select2-results__options\">" + data + "";
            $("#suggesstion-req").show();
            $("#suggesstion-req").html($list);
            $("#cin_demandeur").css("background", "#FFF");
        }
    });
});
// ! remplissage du formulaire demandeur pour le CIN selectionner
function selectCinReq(val) {
    $("#cin_req").val(val);
    $("#suggesstion-req").hide();
    $.ajax({
        type: "POST",
        url: base_url + "infodemandeur",
        data: 'cin=' + val,
        success: function (data) {
            if (data == "false") {

            } else {
                var infos = JSON.parse(data);
                console.log(infos);
                document.getElementById('nom_demandeur').value = infos['nom_demandeur'];
                document.getElementById('prenom_demandeur').value = infos['prenom_demandeur'];
                document.getElementById('cin_demandeur').value = infos['cin_demandeur'];
                document.getElementById('representant').value = infos['representant_demandeur'];
                document.getElementById('telephone').value = infos['telephone'];
                document.getElementById('adresse_demandeur').value = infos['adresse_demandeur'];
                document.getElementById('date_naissance').value = infos['date_naissance'];
                document.getElementById('lieu_naissance').value = infos['lieu_naissance'];
                document.getElementById('situation_familiale').value = infos['situation_familiale'];
                document.getElementById('pere_demandeur').value = infos['pere_demandeur'];
                document.getElementById('mere_demandeur').value = infos['mere_demandeur'];
            }
        }
    });
}
