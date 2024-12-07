<!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Tableau DOMPDF</title>
	<style>
		body {
			font-family: Arial, sans-serif;
			font-size: 12px;
			margin: 0;
			padding: 0;
		}

		.table-container {
			border-collapse: collapse;
			width: 100%;
		}

		.table-container td {
			padding: 8px;
			text-align: center;
		}

		.table-container .header {
			font-weight: bold;
			text-align: left;
		}

		.table-container .section-title {
			font-weight: bold;
			text-align: center;
		}

		.table-container .content {
			text-align: left;
		}

		header {
			display: flex;
			justify-content: space-between;
		}

		.header-left,
		.header-right {
			width: 48%;
		}

		.title {
			text-align: center;
			margin: 20px 0;
		}

		.title h1 {
			font-size: 16px;
			text-transform: uppercase;
			margin-bottom: 5px;
		}

		.title p {
			font-size: 12px;
		}

		#tab {
			width: 100%;
			border-collapse: collapse;
			margin: 20px 0;
		}

		#tab th,
		#tab td {
			border: 1px solid #000;
			padding: 10px;
			text-align: left;
		}

		tfoot td {
			font-weight: bold;
		}
	</style>
</head>

<body>
	<table class="table-container">
		<tr>
			<td colspan="2" class="header">MINISTERE DE L’AMENAGEMENT DU TERRITOIRE ET DES TRAVAUX PUBLICS</td>


		</tr>
		<tr>
			<td colspan="2" class="header">SECRETARIAT GENERAL</td>
			<td colspan="3" class="content">Antananarivo, le<br>Le Chef de la Circonscription Domaniale et Foncière<br><strong>ANTANANARIVO-VILLE</strong></td>

		</tr>
		<tr>
			<td colspan="2" class="header">DIRECTION GENERALE DES SERVICES FONCIERS</td>

		</tr>
		<tr>
			<td colspan="2" class="header">DIRECTION DES DOMAINES ET DE LA PROPRIETE FONCIERE</td>
			<td colspan="3" class="content">a</td>

		</tr>
		<tr>
			<td colspan="2" class="header">SERVICE DES DOMAINES ET DE LA CONSERVATION</td>
			<td colspan="3" class="content">Monsieur LE CHEF DE SERVICE REGIONAL DES DOMAINES ANALAMANGA</td>
		</tr>
		<tr>
			<td colspan="2" class="header">SERVICE REGIONAL DES DOMAINES</td>
		</tr>
		<tr>
			<td colspan="3" class="header">CIRCONSCRIPTION DOMANIALE ET FONCIERE</td>
		</tr>
	</table>
	<section class="title">
		<br><br>
		<h1>BORDEREAU D’ENVOI</h1>
		<br><br>
		<br>
		<p>N°:<?php print_r($bordereau); ?></p>
	</section>
	<br><br>
	<br><br>
	<br><br>
	<br><br>
	<br><br>

	<table id="tab">
		<thead>
			<tr>
				<th>DESIGNATION</th>
				<th>NB</th>
				<th>OBSERVATION</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>Demande d’acquisition au nom de
					<?php
					$noms = []; // Tableau pour stocker les noms complets des demandeurs
					foreach ($demandeur as $demandeurs) {
						$noms[] = trim($demandeurs['nom_demandeur']) . ' ' . trim($demandeurs['prenom_demandeur']);
					}
					echo implode(', ', $noms); // Joint les noms avec une virgule
					?>
					, auteur <?php echo $num_affaire; ?></td>
				<td>01</td>
				<td>
					<?php
					if ($avis == 'Pour approbation') {
						echo "Pour, sauf objection de votre part, approbation de l’acte de vente définitive ci-joint par l’Autorité Compétente.";
					} elseif ($avis == 'Pour decision') {
						echo "Pour, sauf objection de votre part, avis sur le document ci-joint par les services compétents.";
					} elseif ($avis == 'Pour avis') {
						echo "Pour, une avis de decision de votre part, de l’acte présenté ci-joint par l’Autorité Compétente.";
					} elseif ($avis == 'second_reperage') {
						echo "Pour, sauf objection de votre part, réalisation du second repérage conformément au document ci-joint.";
					} else {
						echo "Aucun avis sélectionné.";
					}
					?>

				</td>
			</tr>
		</tbody>
		<tfoot>
			<tr>
				<td><strong>TOTAL</strong></td>
				<td>01</td>
				<td></td>
			</tr>
		</tfoot>
	</table>

</body>

</html>
