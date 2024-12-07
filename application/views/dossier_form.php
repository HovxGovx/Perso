<!-- application/views/dossier_form.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Formulaire de dossier</title>
</head>
<body>
    <h1>Formulaire de dossier</h1>
    <form action="<?php echo site_url('dossier/submit'); ?>" method="post">
        <label for="id_demandeur">ID Demandeur:</label>
        <input type="text" id="id_demandeur" name="id_demandeur" required><br>

        <label for="id_terrain">ID Terrain:</label>
        <input type="text" id="id_terrain" name="id_terrain" required><br>

        <label for="numdossier">Numéro de dossier:</label>
        <input type="text" id="numdossier" name="numdossier" required><br>

        <label for="objetfiche">Objet de la fiche:</label>
        <input type="text" id="objetfiche" name="objetfiche" required><br>

        <label for="date_demande">Date de la demande:</label>
        <input type="date" id="date_demande" name="date_demande" required><br>

        <label for="nature_demande">Nature de la demande:</label>
        <input type="text" id="nature_demande" name="nature_demande" required><br>

        <label for="description">Description:</label>
        <textarea id="description" name="description" rows="4" cols="50" required></textarea><br>

        <label for="type_affaire">Type d'affaire:</label>
        <input type="text" id="type_affaire" name="type_affaire" required><br>

        <label for="num_affaire">Numéro d'affaire:</label>
        <input type="text" id="num_affaire" name="num_affaire" required><br>

        <button type="submit">Soumettre</button>
    </form>
</body>
</html>
