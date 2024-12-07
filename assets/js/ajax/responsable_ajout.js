
$(document).ready(function() {
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
	$.ajax({
		url:  base_url + "Responsable/getRoles",
		type: "GET",
		success: function(data) {
			var selectRole = $("#selectRole");
			$.each(data, function(index, item) {
				selectRole.append($('<option>', {
					value: item.id,
					text: item.libelle
				}));
			});
		}
	});
	$.ajax({
		url: + "Responsable/getRegion",
		type: "GET",
		success: function(data) {
			var selectRegion = $("#selectRegion");
			$.each(data, function(index, item) {
				selectRegion.append($('<option>', {
					value: index,
					text: item
				}));
			});
		}
	});

	$('#divCirconscription').hide();
	$('#divRegion').hide();
});

function lieu() {
	var roleID = $('#selectRole').val();
	$.ajax({
		url: base_url + 'Responsable/getLieuRoles/' + roleID,
		type: "GET",
		success: function(data) {
			if ((data.lieu) == 'Central') {
				$('#divCirconscription').hide();
				$('#divRegion').hide();
			} else {
				if ((data.lieu) == 'REG') {
					$('#divRegion').show();

				} else {
					$('#divCirconscription').show();
					$('#divRegion').show();
				}
			}

		}


	});
}

function getCirconscription() {

	var regionID = $('#selectRegion').val();

	$.ajax({
		type: "POST",
		dataType: 'json',
		url: base_url + "Responsable/getCirconscription",
		data: {
			"region_id": regionID
		},
		success: function(data) {
			$('#selectCirconscription').html('');
			$.each(data, function(index, value) {
				$("#selectCirconscription").append('<option value="' + index + '">' + value + '</option>')

			});

		}
	});



}
