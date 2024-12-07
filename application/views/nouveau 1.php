<!DOCTYPE html>
<html>
<head>
    <title>Liste des responsables</title>
</head>
<body>
    <h2>Liste des responsables</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Email</th>
            <th>Téléphone</th>
            <th>Login</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($responsables as $responsable) : ?>
            <tr>
                <td><?php echo $responsable->id_role; ?></td>
                <td><?php echo $responsable->email; ?></td>
                <td><?php echo $responsable->telephone; ?></td>
                <td><?php echo $responsable->login; ?></td>
                <td><?php echo $responsable->nom; ?></td>
                <td><?php echo $responsable->prenom; ?></td>
                <td>
                    <a href="<?php echo site_url('responsable/view/'.$responsable->id_role); ?>">Voir</a>
                    <a href="<?php echo site_url('responsable/edit/'.$responsable->id_role); ?>">Éditer</a>
                    <a href="<?php echo site_url('responsable/delete/'.$responsable->id_role); ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce responsable ?')">Supprimer</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <a href="<?php echo site_url('responsable/add'); ?>">Ajouter un responsable</a>
</body>
</html>
