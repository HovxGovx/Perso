
<h4>Détails du dossier</h4>
<!-- Accédez aux données du dossier, du demandeur et du terrain via $details -->
<p>id Dossier : <?= $details['id-dossier']; ?></p>
<p>id demandeur : <?= $details['id_demandeur']; ?></p>
<p>id terrain : <?= $details['id_terrain']; ?></p>

<h5>Détails du demandeur</h5>
<p>nom : <?= $details['nom_demandeur']; ?></p>
<p>Prénom : <?= $details['prenom_demandeur']; ?></p>
<p>Email : <?= $details['email_demandeur']; ?></p>
<p>Téléphone : <?= $details['telephone']; ?></p>

<h5>Détails du terrain</h5>
<p>Superficie : <?= $details['superficie']; ?></p>
<p>Numéro de Titre : <?= $details['num_titre']; ?></p>
<p>Numéro de Parcelle : <?= $details['num_parcelle']; ?></p>
<p>Section : <?= $details['section']; ?></p>
<p>Type de terrain : <?= $details['type_terrain']; ?></p>
