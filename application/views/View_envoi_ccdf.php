<!-- jQuery -->
<script src="<?php echo base_url() . 'assets/jquery/jquery.min.js'; ?>"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?php echo base_url() . 'assets/jquery-ui/jquery-ui.min.js'; ?>"></script>
<!-- Inclusion de Bootstrap CSS -->
<link rel="stylesheet" href="<?php echo base_url('assets/bootstrap-5.3.2-dist/css/bootstrap.min.css'); ?>">
<!-- Inclusion de Bootstrap JS -->
<script src="<?php echo base_url('assets/bootstrap-5.3.2-dist/js/bootstrap.bundle.min.js'); ?>"></script>
<!-- <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script> -->

<script>
    $(document).ready(function() {
        //script pour charger les dossier 
        $('#recherche_transfer').on('input', function() {
            var recherche = $(this).val().toLowerCase();
            $.ajax({
                url: '<?= site_url('TransferController/getEnvoiCcdf') ?>',
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    $('#liste-envoi').empty();
                    $.each(data, function(index, transfer) {
                        if (transfer.date_trans.includes(recherche)) {
                            var cardHtml = `
                                <div class="card  mb-3 shadow " style="max-width: 500px;">
                                    <div class="card-body">
                                        <p class="card-text"><strong>Auteur :</strong> ${transfer.auteur}</p>
                                        <p class="card-text"><strong>Destinataire :</strong> ${transfer.destinataire}</p>
                                        <p class="card-text"><strong>Date du transfert:</strong> ${transfer.date_trans}</p>
                                        <p class="card-text"><strong>Numero de bordereau :</strong> ${transfer.bordereau}</p>
                                    <div class=" gg">
                                        <div class="ccc">
                                                <button class="btn btn-secondary mx-1 my-2 btndossier shadow"  data-id="${transfer.id_dossier}" data-toggle="modal" data-target="#myModal1">
                                                    <i class="fas fa-eye"></i> Dossier
                                                </button>
                                                <button class="btn btn-secondary mx-1 my-2 btnavis shadow"  data-id="${transfer.id_avis}" data-toggle="modal" data-target="#avis">
                                                    <i class="far fa-file-alt"></i> Avis
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer  justify-content space-around gg">
                                        <div class="ccc">
                                            <button class="btn btn-warning mx-1 my-4 btnPdfBrordereau" data-id="${transfer.id_dossier}">
                                                <i class="fas fa-edit"></i> Afficher
                                            </button>
                                            <button class="btn btn-warning mx-1 my-4 btnmodifdossier" data-id="${transfer.id_dossier}" >
                                                <i class="fas fa-edit"></i> Telecharger
                                            </button>
                                        </div>
                                    </div>
                                </div>
                        `;
                            $('#liste-envoi').append(cardHtml);
                        }
                    });
                }
            });
        });
        //script pour afficher le dossier
        $('#liste-envoi').on('click', '.btndossier', function() {
            var iddossier = $(this).data('id');
            $.ajax({
                url: '<?= site_url('DossierController/getDossierEnvoiCcdf/') ?>' + iddossier,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    $.each(data, function(index, dossier) {

                        $('#DossierDetail').empty();
                        var cardHtml = `
                                        <div class="card  mb-3 shadow" style="max-width: 400px;">
                                            <div class="card-body">
                                                <p class="card-text"><strong>Numéro de dossier :</strong> ${dossier.numdossier}</p>
                                                <p class="card-text"><strong>Objet de la fiche :</strong> ${dossier.objetfiche}</p>
                                                <p class="card-text"><strong>Date de la demande :</strong> ${dossier.date_demande}</p>
                                                <p class="card-text"><strong>Nature de la demande :</strong> ${dossier.nature_demande}</p>
                                                <p class="card-text"><strong>Description :</strong> ${dossier.description}</p>
                                                <p class="card-text"><strong>Type d'affaire :</strong> ${dossier.type_affaire}</p>
                                                <p class="card-text"><strong>Numero d'affaire :</strong> ${dossier.num_affaire}</p>
                                                <p class="card-text"><strong>Etat :</strong> ${dossier.Etat}</p>
                                                <div class="gg">
                                                    <div class="ccc">
                                                        <button class="btn btn-info mx-1 my-2 btncel shadow" data-numdossier="${dossier.numdossier}" data-id="${dossier.id_dossier}" data-toggle="modal" data-target="#myModal">
                                                            <i class="fas fa-eye"></i> C.E.L
                                                        </button>
                                                        <button class="btn btn-info mx-1 my-2 btndetails shadow"  data-id="${dossier.id_dossier}" data-toggle="modal" data-target="#detailModalContent">
                                                            <i class="far fa-file-alt"></i> Détails
                                                        </button>
                                                        <button class="btn btn-info mx-1 my-2 btnpdf shadow"  data-iddossier="${dossier.id_dossier}" data-toggle="modal" data-target="#modalfichier">
                                                            <i class="far fa-file"></i> Fichiers
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                `;
                        $('#DossierDetail').append(cardHtml);

                    });


                },
                error: function(xhr, status, error) {
                    var errorMessage = xhr.status + ':' + xhr.statusText;
                    alert('Une erreur s\'est produite lors du chargement des détails du dossier\n' + iddossier + errorMessage);
                }
            });
        });
        //script pour afficher les details du C.E.L
        $('#DossierDetail').on('click', '.btncel', function() {
            var iddossier = $(this).data('id');
            $.ajax({
                url: '<?= site_url('CelController/getDetails/') ?>' + iddossier,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    $.each(data, function(index, cel) {
                        $('#detailcel').empty();
                        var detailcelhtml = `
                                <p>Auteur : <span id="Auteur">${cel.auteur}</span></p>
                                <p>Consistance : <span id="Consistance">${cel.consistance}</span> </p>
                                <p>Descente le : <span id="Descente">${cel.date_descente}</span></p>
                                <p>Date du mise en valeur : <span id="date_mise_valeur"></span>${cel.date_mise_valeur}</p>
                                <button id="btndemandeur" class="btn btn-info mx-1 my-2 btndetailcel" data-pathplan="${cel.resume_pv}" data-toggle="modal" data-target="#modalfichier" >
                                    <i class="far fa-file"></i>  P.V
                                </button>
                    `;
                        $('#detailcel').append(detailcelhtml);
                    });

                },
                error: function(xhr, status, error) {
                    var errorMessage = xhr.status + ':' + xhr.statusText;
                    alert('Une erreur s\'est produite lors du chargement des détails du C.E.L.\n' + errorMessage);
                }
            });
        });
        //Script pour afficher le pv du cel
        $('#detailcel').on('click', '.btndetailcel', function() {
            var pathplan = $(this).data('pathplan');
            $('#ambedId').empty();
            var pv = `<embed src="http://localhost/Domaine/projet/${pathplan}" width="100%" height="600px"/>`;
            $('#ambedId').append(pv);
        });
        // Script pour afficher les détails sur le demandeur et sur le terrain d'un dossier d'un dossier
        $('#DossierDetail').on('click', '.btndetails', function() {
            var dossierId = $(this).data('id');
            var type_demandeur = "";
            $.ajax({
                url: '<?= site_url('DossierController/getDetails/') ?>' + dossierId,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    $('#detailsDemandeur').empty();
                    $('#detailsTerrain').empty();
                    if (data.type_demandeur == 1) {
                        type_demandeur = "Personne physique";
                    }
                    if (data.type_demandeur == 2) {
                        type_demandeur = "Personne Moral";
                    }
                    var demandeurhtml = `
                                <p>Nom du demandeur : <span id="nom_demandeur">${data.nom_demandeur}</span></p>
                                <p>Prénom du demandeur: <span id="prenom_demandeur">${data.prenom_demandeur}</span> </p>
                                <p>Type du demandeur : <span id="type_demandeur">${type_demandeur}</span></p>
                                <p>CIN du demandeur : <span id="cin_demandeur"></span>${data.cin_demandeur}</p>
                                <p>Téléphone : <span id="telephone"></span>${data.telephone}</p>
                    `;

                    $('#detailsDemandeur').append(demandeurhtml);
                    var terrainhtml = `
                                <p>Superficie : <span id="superficie">${data.superficie}</span> </p>
                                <p>Numéro de Titre : <span id="num_titre">${data.num_titre}</span> </p>
                                <p>Numéro de Parcelle :<span id="num_parcelle">${data.num_parcelle}</span></p>
                                <p>Section : <span id="section">${data.section}</span></p>
                                <p>Type de terrain : <span id="type_terrain">${data.type_terrain}</span></p> 
                    `;
                    $('#detailsTerrain').append(terrainhtml);
                },
                error: function(xhr, status, error) {
                    var errorMessage = xhr.status + ': ' + xhr.statusText;
                    alert('Une erreur s\'est produite lors du chargement des détails du dossier.\n' + errorMessage);
                }
            });
        });
        //Script pour charger les liens vers les pdf et afficher le pdf
        $('#DossierDetail').on('click', '.btnpdf', function() {
            var d = $(this).data('iddossier');
            $.ajax({
                url: '<?= site_url('DossierController/getPdf/') ?>' + d,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    $('#ambedId').empty();
                    $.each(data, function(index, piecejointe) {

                        if (piecejointe.id_dossier == d) {
                            var piecejointes = `
                                <embed src="http://localhost/Domaine/projet/assets/uploads/nouvelledemande/${piecejointe.path_plan}" width="100%" height="600px"/>
                            `;
                            $('#ambedId').append(piecejointes);
                        }
                        if (!piecejointe.id_dossier) {
                            $('#embId').text("Auncun fichier n\'est associer a ce dossier");
                        }

                    });
                },
                error: function(xhr, status, error) {
                    var errorMessage = xhr.status + ': ' + xhr.statusText;
                    alert('Une erreur s\'est produite lors du chargement des paths\n' + errorMessage);
                }
            });
        });
        //Script pour afficher l'avis sur un dossier
        $('#liste-envoi').on('click', '.btnavis', function() {
            var d = $(this).data('id');
            var a, b, c;
            $.ajax({
                url: '<?= site_url('TransferController/getAvis/') ?>' + d,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    $('#detailsAvis').empty();
                    $.each(data, function(index, avis) {
                        if (avis.avis == 1) {
                            a = "Pour avis et decision de l'Autorite Superieure";
                        } else if (avis.avis == 2) {
                            a = "Propose un rejet pur et simple";
                        } else {
                            a = "Approbation de l'acte de vente";
                        }
                        if (avis.Mod_Attr == 1) {
                            b = "Vente à l'amiable";
                        } else {
                            b = "Vente à credit";
                        }
                        var avishtml = `
                        <div >
                            
                                <p class="card-text"><strong>Avis :</strong> ${a}</p>
                                <p class="card-text"><strong>Mode d'attribution :</strong> ${b}</p>
                                <p class="card-text"><strong>Observation :</strong> ${avis.obs}</p>
                                <p class="card-text"><strong>Auteur:</strong> ${avis.auteur}</p>
                            
                        </div>

                        `;
                        $('#detailsAvis').append(avishtml);
                    });
                },
                error: function(xhr, status, error) {
                    var errorMessage = xhr.status + ': ' + xhr.statusText;
                    alert('Une erreur s\'est produite lors du chargement des paths\n' + errorMessage);
                }
            });
        });
        //Script pour afficher le pdf du bordereau d'envoi
        $('#liste-envoi').on('click', '.btnPdfBrordereau', function() {
            var d = $(this).data('id');
            var a, b, c;
            $.ajax({
                url: '<?= site_url('TransferController/generer_pdf') ?>',
                success: function() {
                    console.log("Mandeha tsara")
                },
                error: function(xhr, status, error) {
                    var errorMessage = xhr.status + ': ' + xhr.statusText;
                    alert('Une erreur s\'est produite lors du chargement des paths\n' + errorMessage);
                }
            });
        });
    });
</script>
<style>
    .gradient {
        background-image: linear-gradient(to right, #0819B5, #07D2FB);
    }

    .divplus {
        font-size: 18px;
        position: relative;
        left: 7rem;
        width: 40%;
    }

    .grandTitre {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    label {
        position: relative;
        left: 0.5rem;
    }

    input,
    textarea {
        height: 3rem !important;
        font-size: 18px;
    }

    .ceci {
        margin-top: 60px;
    }

    .btn-group-vertical {
        display: block;
    }

    #liste-envoi {
        max-height: 500px;
        overflow-y: auto;

        scrollbar-width: thin;
        /* Pour Firefox */
        scrollbar-color: transparent transparent;
        /* Pour Firefox */
        -ms-overflow-style: none;
        /* Pour Internet Explorer et Edge */
    }

    #liste-envoi::-webkit-scrollbar {
        width: 5px;
        /* Largeur de la barre de défilement pour les navigateurs WebKit (Chrome, Safari, etc.) */
    }

    #liste-envoi::-webkit-scrollbar-thumb {
        background-color: transparent;
        /* Couleur du curseur de défilement */
    }

    .gg {
        display: grid;
        justify-content: center;
        align-items: center;
    }
</style>
<div class="section">

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper ceci">
        <!-- Content Header (Page header) -->
        <!-- Les details de chaque section sont afficher par ajax -->
        <div class="content-header">
            <div class="row">
                <div class="col-12">
                    <strong style="text-align: center; 
                    color: orange; 
                    font-size: 1.5em;margin-left: 40%"> Dossiers reçus</strong>
                </div>
                <br>
                <div class="col-12">
                    <div id="liste-envoi">
                        <form action="#">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>

                                    <tr>
                                        <th>Numéro bordereau</th>
                                        <th>Date d'envoi</th>
                                        <th>Par</th>
                                        <th>Actions</th>
                                    </tr>

                                </thead>
                                <tbody>
                                    <?php foreach ($dossierenvoi as $value) : ?>
                                        <tr>
                                            <td><?php echo $value->bordereau; ?></td>
                                            <td><?php echo $value->date_trans; ?></td>
                                            <td><?php echo $value->auteur; ?></td>

                                            <td class="btn-group">
                                                <!--<div class="gg">-->
                                                <!--<div class="ccc">-->
                                                <button class="btn btn-secondary mx-1 my-2 btndossier shadow" data-id="<?php echo $value->id_dossier; ?>" data-toggle="modal" data-target="#myModal1">
                                                    <i class="fas fa-eye"></i> Dossier
                                                </button>
                                                <button class="btn btn-secondary mx-1 my-2 btnavis shadow" data-id="<?php echo $value->id_avis; ?>" data-toggle="modal" data-target="#avis">
                                                    <i class="far fa-file-alt"></i> Avis
                                                </button>
                                                <button class="btn btn-warning mx-1 my-4 btnPdfBrordereau" data-id="<?php echo $value->id_dossier; ?>">
                                                    <i class="fas fa-edit"></i> Afficher
                                                </button>
                                                <button class="btn btn-warning mx-1 my-4 btnmodifdossier" data-id="<?php echo $value->id_dossier; ?>">
                                                    <i class="fas fa-edit"></i> Telecharger
                                                </button>
                                                <!--</div>-->
                                                <!--</div>-->



                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>

                            </table>
                        </form>
                    </div>
                    <!--<div id="liste-dossiers" class="shadow center gg">
                    <!-- La liste des dossiers sera generer automatiquement par ajax 
               </div>-->
                </div>
            </div>

        </div>
        <!-- section dossier -->
        <section class="Dossier">
            <div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-body ">
                            <div class="grandTitre bg-secondary card pt-1">
                                <h5>Détails du dossier</h5>
                            </div>
                            <div class="detail gg gradient" id="DossierDetail">
                                <!-- Les details seront afficher via ajax -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- section cel -->
        <section class="cel">
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="grandTitre bg-secondary card pt-1">
                                <h5>Détails du Constat d'etat des lieux</h5>
                            </div>
                            <div class="detail gg gradient" id="detailcel">
                                <!-- Les details seront afficher via ajax -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- section  detail dossier -->
        <section class="detail">
            <div class="modal fade" id="detailModalContent" tabindex="0" role="dialog" arial-labelledby="LabelExemple" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="grandTitre">
                                <h2 class="mb-4">Details du dossier</h2>
                            </div>
                            <div id="detailsContent">
                                <div class="card px-3 py-3 shadow gradient">
                                    <div class="grandTitre bg-secondary card pt-1">
                                        <h5>Détails du demandeur</h5>
                                    </div>
                                    <div class="details" id="detailsDemandeur">
                                        <!-- Les details du demandeur sera afficher par ajax ici -->
                                    </div>
                                </div>

                                <div class="card shadow px-3 py-3 gradient">
                                    <div class="grandTitre bg-secondary card pt-1">
                                        <h5>Détails du terrain</h5>
                                    </div>
                                    <div class="details" id="detailsTerrain">
                                        <!-- Les details du terrain sera afficher par ajax ici -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- section  fichiers dossier -->
        <section class="fichiers">
            <div class="modal fade" id="modalfichier" tabindex="1" role="dialog" aria-labelledby="labelledby" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <h1>Fichier PDF</h1>
                            <!-- <embed id="embedId" type="application/pdf" width="100%" height="600px" /> -->
                            <div id="ambedId">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- section dossier -->
        <section class="avis">
            <div class="modal fade" id="avis" tab-index="3" role="dialog" aria-labelledby="modal_form_label" aria-hidden="false">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title"></h5>
                        </div>
                        <div class="modal-body">
                            <div class="grandTitre">
                                <h2 class="mb-4">Avis</h2>
                            </div>
                            <div id="detailsContent">
                                <div class="card px-3 py-3 shadow">
                                    <div id="detailsAvis">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
        </section>

    </div>