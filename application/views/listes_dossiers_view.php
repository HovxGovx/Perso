<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des dossiers</title>
</head>
<body>
    <h1>Liste des dossiers</h1>

    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Description</th>
            <th>Expéditeur</th>
            <th>Destinataire</th>
            <th>Action</th>
        </tr>
        <?php foreach ($dossiers as $dossier) : ?>
            <tr>
                <td><?php echo $dossier->id; ?></td>
                <td><?php echo $dossier->nom; ?></td>
                <td><?php echo $dossier->description; ?></td>
                <td><?php echo $dossier->expediteur_id; ?></td>
                <td><?php echo $dossier->destinataire_id; ?></td>
                <td><a href="<?php echo base_url('DossierController/afficher_details/' . $dossier->id); ?>">Voir les détails</a></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
