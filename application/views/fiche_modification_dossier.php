<style>
    /* Assure que le modal est centré horizontalement et verticalement */
    .modal-dialog {
        margin: 0 auto;
        /* Centre horizontalement */
        max-width: 80%;
        /* Largeur maximale du modal */
    }

    .modal-content {
        width: 80vw;
        /* Largeur du modal en pourcentage de la largeur de la fenêtre */
        height: 80vh;
        /* Hauteur du modal en pourcentage de la hauteur de la fenêtre */
        max-width: 80%;
        /* Assure que la largeur ne dépasse pas l'écran */
        max-height: 100%;
        /* Assure que la hauteur ne dépasse pas l'écran */
        margin: auto;
        /* Centre verticalement */
        margin-top: 20px;
    }

    @media (max-width: 768px) {
        .modal-content {
            width: 95vw;
            /* Réduit la largeur pour les petits écrans */
            height: 80vh;
            /* Ajuste la hauteur pour les petits écrans */
        }
    }

    #cin_demandeur_container {
        position: relative;
    }
</style>
<script>
    // ! Fonction pour supprimer une ligne du tableau demandeur via AJAX
    function suppLigne(id_dossierss, id_demandeur) {
        if (confirm("Êtes-vous sûr de vouloir supprimer ce demandeur de ce dossier ?")) {
            $.ajax({
                url: '<?php echo base_url("GuichetController/deleteDemandeur"); ?>/' + id_dossierss + '/' + id_demandeur,
                type: 'POST',
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        // Supprime la ligne du tableau correspondant à l'ID du demandeur
                        $('tr').filter(function() {
                            return $(this).find('input[name="demandeur_ids[]"]').val() == id_demandeur;
                        }).remove();
                        alert("Demandeur supprimé avec succès.");
                    } else {
                        alert("Erreur : " + response.message);
                    }
                },
                error: function() {
                    alert("Erreur lors de la suppression du demandeur.");
                }
            });
        }
    }
    // ! Logique pour remplir les elements a modifier au moments de l'ouverture du document
    $(document).ready(function() {
        // Récupérer l'ID du dossier depuis l'URL
        const id_dossier = "<?php echo $id_dossier; ?>";
        $.ajax({
            url: '<?php echo base_url("GuichetController/getDossierById"); ?>/' + id_dossier,
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                // Affiche toutes les données dans la console
                console.log("Données complètes :", response);
                // Afficher chaque section séparément
                console.log("Demandes :", response.demandes);
                console.log("Demandeurs :", response.demandeurs);
                console.log("Terrain :", response.terrain);
                console.log("Pièces jointes :", response.piecejointes);
                // Vous pouvez maintenant traiter ces données et les afficher dans la vue si nécessaire
                if (response.demandeurs) {
                    // ! Pre remplir le tableau pour le(s) demandeurs
                    $.each(response.demandeurs, function(index, demandeur) {
                        if (demandeur.type_demandeur == 1) {
                            var row = '<tr>' +
                                '<td> <input type="hidden" name="demandeur_ids[]" value="' + demandeur.id_demandeur + '"/>' + demandeur.id_demandeur + '</td>' +
                                '<td>' + demandeur.nom_demandeur + '</td>' +
                                '<td>' + demandeur.prenom_demandeur + '</td>' +
                                '<td><input type="hidden" name="demandeur_cins[]" value="' + demandeur.cin_demandeur + '"/>' + demandeur.cin_demandeur + '</td>' +
                                '<td>' +
                                '<a class="btn btn-danger btn-sm" onclick="suppLigne(' + id_dossier + ',' + demandeur.id_demandeur + ')" style="color: white">' +
                                '<i class="fas fa-folder"></i> Supprimer' +
                                '</a>' +
                                '</td>' +
                                '</tr>';
                            $('#tablebody').append(row);

                        } else {
                            var rowrep = '<tr>' +
                                '<td>' + demandeur.id_demandeur + '</td>' +
                                '<td>' + demandeur.nom_demandeur + '</td>' +
                                '<td>' + demandeur.representant + '</td>' +
                                '<td></td>' +
                                '<td>' +
                                '<a class="btn btn-danger btn-sm" onclick="suppLigne(' + id_dossier + ',' + demandeur.id_demandeur + ')" style="color: white">' +
                                '<i class="fas fa-folder"></i> Supprimer' +
                                '</a>' +
                                '</td>' +
                                '</tr>';
                            $('#tablebody').append(rowrep);

                        }
                    });

                }
                // ! Pre-remplire les champs pour  "terrain"
                if (response.terrain) {
                    $('#type_terrain').val(response.terrain.type_terrain);
                    $('#Modif_superficie').val(response.terrain.superficie);
                    $('#Modif_canton').val(response.terrain.canton);
                    $('#Modif_nom_propriete').val(response.terrain.nom_propriete);
                    $('#Modif_section').val(response.terrain.section);
                    $('#Modif_num_parcelle').val(response.terrain.num_parcelle);
                    $('#Modif_num_titre').val(response.terrain.num_titre);
                }
                //Pre-remplir les champs pour  "demande"
                if (response.demandes) {
                    console.log(response.terrain);
                    $('#Modif_type_terrain').val(response.terrain.type_terrain);
                    $('#Modif_superficie').val(response.terrain.superficie);
                    $('#Modif_canton').val(response.terrain.canton);
                    $('#Modif_nom_propriete').val(response.terrain.nom_propriete);
                    $('#Modif_section').val(response.terrain.section);
                    $('#Modif_num_parcelle').val(response.terrain.num_parcelle);
                    $('#Modif_num_titre').val(response.terrain.num_titre);
                }

            },
            error: function() {
                alert("Erreur lors du chargement des données.");
            }
        });
        // Initialisation du type_demandeur
        get_type_demandeur();
        get_type_terrain();
        // Evenement pour changer le type demadeur
        $('#type_demandeur').change(function() {
            get_type_demandeur();
        });
    });


    // * Affiche les champs par rapport au type de demandeur
    function get_type_demandeur() {
        var typeDemandeur = $('#type_demandeur').val();
        var fields = [
            'cin_demandeur_container',
            'nom_demandeur',
            'prenom_demandeur',
            'representant',
            'date_naissance',
            'lieu_naissance',
            'adresse_demandeur',
            'modif_pere_demandeur',
            'modif_mere_demandeur',
            'telephone'
        ];
        clearFields(fields);
        if (typeDemandeur == '2') {

            $('#div_prenom').hide();
            $('#cin_demandeur_container').hide().val('');
            $('#modif_situation_familiale').hide();
            $('#modif_pere_demandeur').hide().val('');
            $('#modif_mere_demandeur').hide().val('');
            /*$('#nom_demandeur').val('');
            $('#prenom_demandeur').val('');
            $('#adresse_demandeur').val('');
            $('#lieu_naissance').val('');
            $('#adresse_demandeur').val('');
            $('#telephone').val('');
            $('#representant').val('');*/
            $('#div_representant').show();

        } else {

            $('#div_prenom').show();
            $('#cin_demandeur_container').show();
            $('#modif_situation_familiale').show();
            $('#modif_pere_demandeur').show();
            $('#modif_mere_demandeur').show();
            $('#div_representant').hide();
        }

    }

    function get_type_terrain() {
        var typeTerrain = $('#Modif_type_terrain').val();
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

    function clearFields(fields) {

        fields.forEach(function(id) {
            $('#' + id).val('');
        });
    }

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
        elementIDs.forEach(function(id) {
            var value = $('#' + id).val();
            formData[id] = value;
        });

        $.ajax({
            url: '<?php echo base_url('add_dmdr'); ?>',
            type: 'POST',
            contentType: 'application/json',
            data: JSON.stringify(formData),
            success: function(res) {
                console.log('Success:', res);
                var parsedRes = JSON.parse(res);
                var idDemandeur = parsedRes.id_demandeur;
                var cin = $('#cin_demandeur').val();
                var nom = $('#nom_demandeur').val();
                var prenom = $('#prenom_demandeur').val();
                var representant = $('#representant').val();
                var typeDemandeur = $('#type_demandeur').val();
                var tableBody = $('#tablebody');
                if (typeDemandeur == '1') {
                    var row2 = '<tr>' +
                        '<td> <input type="hidden" name="demandeur_id[]" value="' + idDemandeur + '"/>' + idDemandeur + '</td>' +
                        '<td> <input type="hidden" name="demandeur_nom[]" value="' + nom + '"/>' + nom + '</td>' +
                        '<td> <input type="hidden" name="demandeur_prenom[]" value="' + prenom + '"/>' + prenom + '</td>' +
                        '<td><input type="hidden" name="demandeur_cin[]" value="' + cin + '"/>' + cin + '</td>' +
                        '<td>' +
                        '<a class="btn btn-danger btn-sm" onclick="suppLigne(' + idDemandeur + ')" style="color: white">' +
                        '<i class="fas fa-folder"></i> Supprimer' +
                        '</a>' +
                        '</td>' +
                        '</tr>';
                    $('#tablebody').append(row2);
                } else {
                    var rowrep2 = '<tr>' +
                        '<td>' + idDemandeur + '</td>' +
                        '<td>' + nom + '</td>' +
                        '<td>' + representant + '</td>' +
                        '<td></td>' +
                        '<td>' +
                        '<a class="btn btn-danger btn-sm" onclick="suppLigne(' + idDemandeur + ')" style="color: white">' +
                        '<i class="fas fa-folder"></i> Supprimer' +
                        '</a>' +
                        '</td>' +
                        '</tr>';
                    $('#tablebody').append(rowrep2);
                }
                $('#modal-default').modal('hide');
            },
            error: function(error) {
                console.error('Error:', error);
            }
        });
    }
</script>
<style>
    .gg {
        display: flex;
        justify-content: space-evenly;
        align-items: center;
    }

    .form-group {
        width: 100%;
        margin-right: 5px;
    }


    .tsipika {
        border-top: 2px solid #FFFF;
    }

    .apekarina {
        margin-bottom: 30px;
    }
</style>

<div class="container-fluid">

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <br><br>
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Formulaire de modification</h1>
                    </div><!-- /.col -->
                    <!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- general form elements disabled -->
                <div class="card card-warning">
                    <div class="card-body">
                        <div class="col-md-12">
                            <!-- /.card-header -->
                            <div class="card-body">
                                <form action="<?php echo base_url('ajout_donnees/add_data'); ?>" enctype="multipart/form-data" method="post">
                                    <!-- we are adding the accordion ID so Bootstrap's collapse plugin detects it -->
                                    <div id="accordion">
                                        <div class="card card-secondary">
                                            <div class="card-header">
                                                <h4 class="card-title w-100">
                                                    <a class="d-block w-100" data-toggle="collapse" href="#collapseOne">
                                                        Demandeur(s)
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapseOne" class="collapse show" data-parent="#accordion">
                                                <div class="card-body">
                                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default">
                                                        Nouveau demandeur
                                                    </button>
                                                    <br><br>
                                                    <table id="tabledemandeur" class="table table-bordered table-striped">
                                                        <thead>
                                                            <tr>
                                                                <th>id</th>
                                                                <th>Nom</th>
                                                                <th>Prenom</th>
                                                                <th>CIN</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="tablebody">

                                                        </tbody>
                                                        <tfoot>
                                                            <tr>
                                                                <th>id </th>
                                                                <th>Nom</th>
                                                                <th>Prenom</th>
                                                                <th>CIN</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </tfoot>
                                                    </table>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="card card-info">
                                            <div class="card-header">
                                                <h4 class="card-title w-100">
                                                    <a class="d-block w-100" data-toggle="collapse" href="#collapseTwo">
                                                        Terrain
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapseTwo" class="collapse" data-parent="#accordion">
                                                <div class="card-body">
                                                    <div class="gg tsipika pt-3">
                                                        <!-- text input -->
                                                        <div class="form-group">
                                                            <label for="select_typeterr">Type de terrain :</label>
                                                            <select name="Modif_type_terrain" id="Modif_type_terrain" onChange="get_type_terrain()" class="form-control">
                                                                <option value="1">Titré</option>
                                                                <option value="2">Cadastré</option>
                                                                <option value="3">Ni titré ni cadastré</option>
                                                            </select>
                                                        </div>
                                                        <!-- text input -->
                                                        <div class="form-group">
                                                            <label>Superficie du terrain (en m²) :</label>
                                                            <input name="Modif_superficie" id="Modif_superficie" type="number" class="form-control" placeholder="Superficie du terrain  ...">
                                                        </div>

                                                    </div>
                                                    <div class="gg">
                                                        <!-- text input -->
                                                        <div class="form-group" id="num_titre">
                                                            <label>Numero du titre :</label>
                                                            <input name="Modif_num_titre" id="Modif_num_titre" type="text" class="form-control" placeholder="Numero du titre ...">
                                                        </div>

                                                        <!-- text input -->
                                                        <div class="form-group" id="nom_propriete">
                                                            <label>Nom de la propriété :</label>
                                                            <input name="Modif_nom_propriete" id="Modif_nom_propriete" type="text" class="form-control" placeholder="Nom de la propriété ...">
                                                        </div>
                                                        <!-- text input -->
                                                        <div class="form-group" id="num_parcelle">
                                                            <label>Numero parcelle :</label>
                                                            <input name="Modif_num_parcelle" id="Modif_num_parcelle" type="text" class="form-control" placeholder="Numero parcelle ...">
                                                        </div>
                                                        <!-- select -->
                                                        <div class="form-group" id="section">
                                                            <label for="select_section">Section :</label>
                                                            <select name="Modif_section" id="Modif_section" class="form-control">
                                                                <option value="A">A</option>
                                                                <option value="B">B</option>
                                                            </select>
                                                        </div>
                                                        <!-- text input -->
                                                        <div class="form-group" id="canton">
                                                            <label>Canton :</label>
                                                            <input name="Modif_canton" id="Modif_canton" type="text" class="form-control" placeholder="Canton ...">
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card card-warning">
                                            <div class="card-header">
                                                <h4 class="card-title w-100">
                                                    <a class="d-block w-100" data-toggle="collapse" href="#collapseFour">
                                                        Repérage
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapseFour" class="collapse" data-parent="#accordion">
                                                <div class="card-body">
                                                    <div class="gg tsipika pt-3">
                                                        <!-- text input -->
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3">Répèrage : </label>
                                                            <div class="radio-inline"><input value=False name="reperage" id="reper1" type="radio" required>Sans empiètement</div>
                                                            <div class="radio-inline"><input value=True name="reperage" id="reper2" type="radio" required>Avec empiètement</div>

                                                        </div>
                                                        <!-- text input -->
                                                        <div class="form-group" id="nom_propriete">
                                                            <label>Second répérage :</label>
                                                            <input name="2nd_reperage" type="text" class="form-control" placeholder="Second répérage ...">
                                                        </div>
                                                        <!-- text input -->
                                                    </div>
                                                    <div class="gg">
                                                        <div class="form-group">
                                                            <label>Superficie demandée (en m²) :</label>
                                                            <input name="superficiedemande" type="text" class="form-control" placeholder="Superficie demandee  ...">
                                                        </div>
                                                        <!-- text input -->
                                                        <div class="form-group" id="num_titre">
                                                            <label>Superficie constatée (en m²) :</label>
                                                            <input name="superficieconstate" type="text" class="form-control" placeholder="Superficie constatée ...">
                                                        </div>




                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card card-success">
                                            <div class="card-header">
                                                <h4 class="card-title w-100">
                                                    <a class="d-block w-100" data-toggle="collapse" href="#collapseThree">
                                                        Demande
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapseThree" class="collapse" data-parent="#accordion">
                                                <div class="card-body">

                                                    <div class="gg">
                                                        <!-- text input -->
                                                        <div class="form-group">
                                                            <label>Date de la demande :</label>
                                                            <input name="date_demande" type="date" class="form-control" placeholder="Date de la demande ..." required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Numéro quittance :</label>
                                                            <input name="num_quittance" type="text" class="form-control" placeholder="Numéro de la quittance ..." required>
                                                        </div>

                                                    </div>
                                                    <div class="gg tsipika pt-3">
                                                        <!-- text input -->
                                                        <div class="form-group">

                                                            <label> Objet de la demande :</label>
                                                            <input name="objetfiche" type="text" class="form-control" placeholder="Objet de la demande ...">
                                                        </div>
                                                        <!-- text input -->
                                                        <div class="form-group">
                                                            <label>Nature de la demande :</label>
                                                            <input name="nature_demande" type="text" class="form-control" placeholder="Nature de la demande  ...">
                                                        </div>
                                                        <!-- text input -->
                                                        <div class="form-group">
                                                            <label>Numero du dossier :</label>
                                                            <input name="numdossier" type="text" class="form-control" placeholder="Numero du dossier ..." required>
                                                        </div>
                                                    </div>
                                                    <div class="gg">
                                                        <!-- text input -->
                                                        <div class="form-group">
                                                            <label>Type d'affaire :</label>
                                                            <input name="type_affaire" type="text" class="form-control" placeholder="Type d'affaire ..." required>
                                                        </div>
                                                        <!-- text input -->
                                                        <div class="form-group">
                                                            <label>Numero d'affaire :</label>
                                                            <input name="num_affaire" type="text" class="form-control" placeholder="Numero d'affaire ..." required>
                                                        </div>
                                                        <!-- textarea -->
                                                        <div class="form-group">
                                                            <label>Description :</label>
                                                            <textarea name="description" class="form-control" rows="3" placeholder="Description ..."></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="gg">
                                                        <!-- text input -->
                                                        <div class="form-group">
                                                            <div class="btn btn-default btn-file">
                                                                <i class="fas fa-paperclip"></i> Pièce jointes
                                                                <input type="file" name="userfile[]" required multiple="multiple">
                                                            </div>
                                                            <p id="fileCountMessage"></p>
                                                        </div>
                                                        <div class="">
                                                            <input class="btn btn-primary" type="submit" value="Enregistrer">
                                                        </div>
                                                    </div>


                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- /.card -->
                        </div>

                        <div class="modal fade" id="modal-default">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Ajout demandeur</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">

                                        <div id="demandeur_container">
                                            <div class="col top-1">
                                                <div class="gg"><!-- select -->
                                                    <div class="form-group">
                                                        <label for="select_typedem">Type de demandeur :</label>
                                                        <select name="type_demandeur" id="type_demandeur" class="form-control">
                                                            <option value="1">Personne physique</option>
                                                            <option value="2">Personne morale</option>
                                                        </select>
                                                    </div>

                                                </div>
                                                <div class="gg tsipika pt-3">
                                                    <!-- text input -->
                                                    <div class="form-group" id="cin_demandeur_container">
                                                        <label>Numero CIN du demandeur :</label>
                                                        <input name="cin_demandeur" id="cin_demandeur" type="number" class="form-control" placeholder="Numero CIN du demandeur ...">
                                                        <div class="row">
                                                            <div id="suggesstion-req" class="form-group" style="position: absolute;

                                                                                                                         border: 1px solid #d4d4d4;
                                                                                                                         border-bottom: none;
                                                                                                                         border-top: none;
                                                                                                                         z-index: 99;
                                                                                                                         top: 100%;
                                                                                                                         left: 0;
                                                                                                                         right: 0;
                                                                                                                         background-color: #d4d4d4"></div>
                                                        </div>
                                                    </div>
                                                    <!-- text input -->
                                                    <div class="form-group">
                                                        <label>Nom du demandeur :</label>
                                                        <input name="nom_demandeur" id="nom_demandeur" type="text" class="form-control" placeholder="Nom du demandeur ..." required>
                                                    </div>
                                                    <!-- text input -->


                                                    <div class="form-group" id="div_prenom">
                                                        <label>Prenom du demandeur :</label>
                                                        <input name="prenom_demandeur" id="prenom_demandeur" type="text" class="form-control" placeholder="Prenom du demandeur ...">
                                                    </div>

                                                    <div class="form-group" id="div_representant">
                                                        <label>Representant :</label>
                                                        <input name="representant" id="representant" type="text" class="form-control" placeholder="Représentant ...">
                                                    </div>

                                                </div>
                                                <div class="gg">
                                                    <!-- text input -->
                                                    <div class="form-group">
                                                        <label>Date de naissance :</label>
                                                        <input name="date_naissance" id="date_naissance" type="date" class="form-control" placeholder="Date de naissance du demandeur ...">
                                                    </div>
                                                    <!-- text input -->
                                                    <div class="form-group">
                                                        <label>Lieu de naissance :</label>
                                                        <input name="lieu_naissance" id="lieu_naissance" type="text" class="form-control" placeholder="Lieu de naissance du demandeur ...">
                                                    </div>
                                                    <!-- text input -->
                                                    <div class="form-group">
                                                        <label>Adresse :</label>
                                                        <input name="adresse_demandeur" id="adresse_demandeur" type="text" class="form-control" placeholder="Adresse du demandeur ..." required>
                                                    </div>

                                                </div>
                                                <div class="gg">
                                                    <!-- text input -->
                                                    <div class="form-group" id="modif_situation_familiale">
                                                        <label for="select_situationdem">Situation familiale :</label>
                                                        <select name="situation_familiale" id="situation_familiale" class="form-control">
                                                            <option value="Marié">Marié</option>
                                                            <option value="Célibataire">Célibataire</option>
                                                            <option value="Divorcé">Divorcé</option>
                                                            <option value="Veuf">Veuf</option>
                                                        </select>
                                                    </div>
                                                    <!-- text input -->
                                                    <div class="form-group" id="modif_pere_demandeur">
                                                        <label>Père :</label>
                                                        <input name="pere_demandeur" id="pere_demandeur" type="text" class="form-control" placeholder="Père  du demandeur ...">
                                                    </div>
                                                    <!-- text input -->
                                                    <div class="form-group" id="modif_mere_demandeur">
                                                        <label>Mère :</label>
                                                        <input name="mere_demandeur" id="mere_demandeur" type="text" class="form-control" placeholder="Mère du demandeur ..." required>
                                                    </div>

                                                </div>
                                                <div class="gg">
                                                    <!-- text input -->

                                                    <!-- text input -->
                                                    <div class="form-group">
                                                        <label>Numero de telephone :</label>
                                                        <input name="telephone" id="telephone" type="number" class="form-control" placeholder="Numero de telephone ...">
                                                    </div>


                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                    <div class="modal-footer justify-content-between">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                                        <button type="button" class="btn btn-primary" onclick="enreg_demandeur()">Enregistrer</button>
                                    </div>
                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
<script>
    $("#cin_demandeur").keyup(function() {
        $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>cin_auto",
            data: 'keyword=' + $(this).val(),
            beforeSend: function() {
                $("#cin_demandeur").css("background", "#FFF url(LoaderIcon.gif) no-repeat 165px");
            },
            success: function(data) {
                var $list = "<ul id=\"demandeur-list\" class=\"select2-results__options\">" + data + "";
                $("#suggesstion-req").show();
                $("#suggesstion-req").html($list);
                $("#cin_demandeur").css("background", "#FFF");
            }
        });
    });

    function selectCinReq(val) {
        $("#cin_req").val(val);
        $("#suggesstion-req").hide();
        $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>infodemandeur",
            data: 'cin=' + val,
            success: function(data) {
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
</script>