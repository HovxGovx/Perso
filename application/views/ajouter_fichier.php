<!-- application/views/ajouter_fichiers.php -->
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter des fichiers</title>
</head>
<body>
    <h2>Ajouter des fichiers</h2>

    <?php echo form_open_multipart('fichier_controller/ajouter_fichiers'); ?>
        <label for="nom_fichier">Nom commun pour tous les fichiers:</label>
        <input type="text" name="nom_fichier" required>

        <label for="fichiers">Choisir des fichiers:</label>
        <input type="file" name="fichiers[]" multiple required>

        <input type="submit" value="Ajouter">
    <?php echo form_close(); ?>
</body>
</html>

