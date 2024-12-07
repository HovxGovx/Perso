<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Détails du dossier</title>
</head>
<body>
    <h1>Détails du dossier</h1>

    <p><strong>ID :</strong> <?php echo $dossier->id; ?></p>
    <p><strong>Nom :</strong> <?php echo $dossier->nom; ?></p>
    <p><strong>Description :</strong> <?php echo $dossier->description; ?></p>
    <p><strong>Expéditeur :</strong> <?php echo $dossier->expediteur_id; ?></p>
    <p><strong>Destinataire :</strong> <?php echo $dossier->destinataire_id; ?></p>

    <a href="<?php echo base_url('dossiers'); ?>">Retour à la liste des dossiers</a>
</body>
</html>
