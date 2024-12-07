
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        .shadow-container {
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            padding: 20px;
            margin: 20px;
        }

        .card-body button {
            margin-right: 10px;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

<script>
    $(document).ready(function() {
        // Fonction pour charger la liste des demandeurs
        function chargerListeDemandeurs() {
            $.ajax({
                url: "<?php echo site_url('DemandeurController/ajax_list')?>",
                type: "GET",
                dataType: "json",
                success: function(data) {
                    afficherDemandeurs(data);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('Erreur lors du chargement de la liste des demandeurs');
                }
            });
        }

        // Fonction pour afficher la liste des demandeurs
        function afficherDemandeurs(data) {
            $('#demandeur_list').empty();
            $.each(data.data, function(index, demandeur) {
                var content = '<div class="col-md-4 mb-3 ">' +
                    '<div class="card ">' +
                    '<div class="card-body">' +
                    '<h5 class="card-title">' + demandeur.nom_demandeur + ' ' + demandeur.prenom_demandeur + '</h5>' +
                    '<p class="card-text">Type: ' + demandeur.type_demandeur + '</p>' +
                    '<p class="card-text">Email: ' + demandeur.email_demandeur + '</p>' +
                    '<p class="card-text">Téléphone: ' + demandeur.telephone + '</p>' +
                    '<button class="btn bg-primary btnModifier" data-id="' + demandeur.id_demandeur + '">Modifier</button>' +
                    '<button class="btn btn-warning btnSupprimer" data-id="' + demandeur.id_demandeur + '">Supprimer</button>' +
                    '</div>' +
                    '</div>' +
                    '</div>';

                $('#demandeur_list').append(content);
            });
        }

        // Charger la liste des demandeurs au chargement initial de la page
        chargerListeDemandeurs();

        // Gestionnaire d'événement pour le bouton "Modifier"
    $('#demandeur_list').on('click', '.btnModifier', function() {
        var demandeurId = $(this).data('id');
        chargerFormulaireModification(demandeurId);
    });
    // Fonction pour charger le formulaire de modification
    function chargerFormulaireModification(demandeurId) {
        // Utilisez AJAX pour récupérer les détails du demandeur à partir du serveur
        $.ajax({
            url: "<?php echo site_url('DemandeurController/ajax_get_demandeur')?>/" + demandeurId,
            type: "GET",
            dataType: "json",
            success: function(data) {
                // Remplissez le formulaire avec les données du demandeur
                $('#id_demandeur').val(data.id_demandeur);
                $('#type_demandeur').val(data.type_demandeur);
                $('#nom_demandeur').val(data.nom_demandeur);
                $('#prenom_demandeur').val(data.prenom_demandeur);
                $('#email_demandeur').val(data.email_demandeur);
                $('#telephone').val(data.telephone);

                // Affichez le modal de modification
                $('#modal_form').modal('show');
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Erreur lors du chargement des détails du demandeur');
            }
        });
    }
   
    // Fonction pour supprimer un demandeur
    function supprimerDemandeur(demandeurId) {
        alert("La suppression est impossible car le demandeur est associe a un dossier");
    }

    });

</script>
<section class="container block float-right">
<div class="container shadow-container ">
    <h2>Liste des Demandeurs</h2>
    <div class="row " id="demandeur_list">
        <!-- La liste des demandeurs sera affichée ici -->
    </div>
</div>

<div class="modal fade" id="modal_form" tabindex="-1" role="dialog" aria-labelledby="modal_form_label" aria-hidden="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modifier le Demandeur</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="<?php echo base_url('DemandeurController/modifier');?>">
                    <input type="hidden" value="" name="id_demandeur"/>
                    <div class="form-group">
                        <label for="type_demandeur">Type :</label>
                        <input type="text" class="form-control" id="type_demandeur" name="type_demandeur">
                    </div>
                    <div class="form-group">
                        <label for="nom_demandeur">Nom :</label>
                        <input type="text" class="form-control" id="nom_demandeur" name="nom_demandeur">
                    </div>
                    <div class="form-group">
                        <label for="prenom_demandeur">Prénom :</label>
                        <input type="text" class="form-control" id="prenom_demandeur" name="prenom_demandeur">
                    </div>
                    <div class="form-group">
                        <label for="email_demandeur">Email :</label>
                        <input type="text" class="form-control" id="email_demandeur" name="email_demandeur">
                    </div>
                    <div class="form-group">
                        <label for="telephone">Téléphone :</label>
                        <input type="text" class="form-control" id="telephone" name="telephone">
                    </div>
                </form>
            </div>
            <div class="modal-footer ">
                <button type="submit" id="btnSave" class="btn bg-primary">Enregistrer</button>
            </div>
        </div>
    </div>
</div>
</section>
