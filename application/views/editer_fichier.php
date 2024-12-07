<!-- application/views/editer_fichier.php -->
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Editer le fichier</title>
</head>
<body>
    <h2>Editer le fichier</h2>

    <?php echo form_open_multipart('fichier_controller/mettre_a_jour_fichier'); ?>
        <input type="hidden" name="id" value="<?= $fichier->id ?>">
        
        <label for="nom_fichier">Nom du fichier:</label>
        <input type="text" name="nom_fichier" value="<?= $fichier->nom_fichier ?>" required>

        <label for="fichier">Choisir un nouveau fichier (optionnel):</label>
        <input type="file" name="nouveau_fichier">

        <input type="submit" value="Mettre à jour">
    <?php echo form_close(); ?>
</body>
</html>
