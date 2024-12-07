<!-- jQuery -->
<script src="<?php echo base_url().'assets/jquery/jquery.min.js';?>"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?php echo base_url().'assets/jquery-ui/jquery-ui.min.js';?>"></script>
 <!-- Inclusion de Bootstrap CSS -->
<link rel="stylesheet" href="<?php echo base_url('assets/bootstrap-5.3.2-dist/css/bootstrap.min.css'); ?>">
<!-- Inclusion de Bootstrap JS -->
<script src="<?php echo base_url('assets/bootstrap-5.3.2-dist/js/bootstrap.bundle.min.js'); ?>"></script>


<script>
    $(document).ready(function() {
        //script pour charger les dossier 
        $('#recherche_dossier').on('input', function() {
            var recherche = $(this).val().toLowerCase();
            $.ajax({
                url:'<?= site_url('DossierController/getDossierSupp')?>',
                type:'GET',
                dataType:'json', 
                success: function(data){
                    $('#liste-dossiers').empty();
                    $.each(data,function(index,dossier){
                        if(dossier.numdossier.toLowerCase().includes(recherche)){
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
                                        <div class="gg">
                                            <div class="ccc">
                                                <button class="btn btn-secondary mx-1 my-2 btncel" data-numdossier="${dossier.numdossier}" data-id_dossier="${dossier.id_dossier}" data-toggle="modal" data-target="#myModal">
                                                    <i class="fas fa-eye"></i> C.E.L
                                                </button>
                                                <button class="btn btn-secondary mx-1 my-2 btndetails"  data-id="${dossier.id_dossier}" data-toggle="modal" data-target="#detailModalContent">
                                                    <i class="far fa-file-alt"></i> Détails
                                                </button>
                                                <button class="btn btn-secondary mx-1 my-2 btnpdf"  data-iddossier="${dossier.id_dossier}" data-toggle="modal" data-target="#modalfichier">
                                                    <i class="far fa-file"></i> Fichiers
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer  justify-content space-around gg">
                                        <div class="ccc">
                                        </div>
                                    </div>
                                </div>
                        `;
                        $('#liste-dossiers').append(cardHtml);
                        }
                    });
                }
            });
        });
        //script pour afficher le formulaire du C.E.L
        $('#liste-dossiers').on('click','.btncel', function(){
            var numdossier = $(this).data('numdossier');
            $('#numdossier').val(numdossier);
            var id_dossier = $(this).data('id_dossier');
            $('#id_dossier').val(id_dossier);

        });
        // Script pour afficher les détails sur le demandeur et sur le terrain d'un dossier d'un dossier
        $('#liste-dossiers').on('click', '.btndetails', function() {
            var dossierId = $(this).data('id');  
            var type_demandeur="";      
            $.ajax({
                url: '<?= site_url('DossierController/getDetails/') ?>' + dossierId,
                type: 'GET',
                dataType: 'json', 
                success: function(data) {
                    $('#detailsDemandeur').empty();
                    $('#detailsTerrain').empty();
                    if (data.type_demandeur == 1) {
                        type_demandeur="Personne physique";
                    }
                    if (data.type_demandeur == 2){
                        type_demandeur="Personne Moral";
                    }
                    var demandeurhtml =`
                                <p>Nom du demandeur : <span id="nom_demandeur">${data.nom_demandeur}</span></p>
                                <p>Prénom du demandeur: <span id="prenom_demandeur">${data.prenom_demandeur}</span> </p>
                                <p>Type du demandeur : <span id="type_demandeur">${type_demandeur}</span></p>
                                <p>CIN du demandeur : <span id="cin_demandeur"></span>${data.cin_demandeur}</p>
                                <p>Téléphone : <span id="telephone"></span>${data.telephone}</p>
                                
                    `;                    
                    $('#detailsDemandeur').append(demandeurhtml);                       
                    var terrainhtml =`
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
        //script pour charger les liens vers les pdf 
        $('#liste-dossiers').on('click','.btnpdf', function(){
            var d = $(this).data('iddossier');
            $.ajax({
                url:'<?= site_url('DossierController/getPdf/')?>' + d,
                type: 'GET',
                dataType:'json',
                success: function(data){
                    $('#ambedId').empty();
                    $.each(data,function(index,piecejointe){
                        
                        if (piecejointe.id_dossier == d) {
                            var piecejointes=`
                                <embed src="http://localhost/Domaine/projet/assets/uploads/nouvelledemande/${piecejointe.path_plan}" width="100%" height="600px"/>
                            `;
                            $('#ambedId').append(piecejointes); 
                        }
                        if (!piecejointe.id_dossier) {
                            $('#embId').text("Auncun fichier n\'est associer a ce dossier");
                        }
                    });
                },
                error: function(xhr,status,error){
                    var errorMessage = xhr.status + ': ' + xhr.statusText;
                    alert('Une erreur s\'est produite lors du chargement des paths\n' + errorMessage);
                }
            });
        });
        
    });
</script>
<style>
    .divplus{
        font-size:18px;
        position: relative;
        left:7rem;
        width:40%;      
    }
    .grandTitre{
        display:flex;
        justify-content:center;
        align-items:center;
    }
    label{
        position: relative;
        left:0.5rem;
    }
    input,textarea{
        height: 3rem !important;
        font-size:18px;
    }
    .ceci{
        margin-top: 60px;
    }
    .btn-group-vertical {
        display: block;
    }
    #liste-dossiers {
        max-height: 500px;
        overflow-y: auto;
       
        scrollbar-width: thin; /* Pour Firefox */
        scrollbar-color: transparent transparent; /* Pour Firefox */
        -ms-overflow-style: none; /* Pour Internet Explorer et Edge */
    }

    #liste-dossiers::-webkit-scrollbar {
        width: 5px; /* Largeur de la barre de défilement pour les navigateurs WebKit (Chrome, Safari, etc.) */
    }

    #liste-dossiers::-webkit-scrollbar-thumb {
        background-color: transparent; /* Couleur du curseur de défilement */
    }
    .gg{
        display:grid;
        justify-content: center;
        align-items:center;
    }
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper ceci">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container ">
            <div class="">
                <div class="">
                    <h3 class="">Listes des dossiers</h3>
                </div>
                    <div>
                        <form action="#">
                            <div class="form-group">
                                <label for="id_dossier">Recherche par numéro : <?php echo $username;?></label>
                                <input class="form-control" type="text" class="form-control" id="recherche_dossier" placeholder="Rechercher un dossier">
                            </div>
                        </form>
                    </div>                
                <div id="liste-dossiers" class="shadow center gg">
                    <!-- La liste des dossiers sera generer automatiquement par ajax -->
                </div>              
            </div>
        </div>
    </div>
    <section class="formulaircel">
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="grandTitre">
                            <h2 class="mb-4">Formulaire C.E.L</h2>
                        </div>
                        <form action="<?php echo base_url('CelController/ajouterDonnees');?>" method="post" id="formulaire_cel" enctype="multipart/form-data">
                            <!-- Étape 1 -->
                            <div class="etape" id="etape1">
                                <div class="form-group">
                                    <label for="id_dossier">Numéro dossier: </label>
                                    <input class="form-control d-block" name="id_dossier" type="text" class="form-control" id="id_dossier">
                                    <input class="form-control" type="text" class="form-control" id="numdossier" Disabled>
                                </div>
                                <div class="form-group">
                                <label for="date_descente">Date Descente :</label>
                                <input class="form-control" type="date" id="date_descente" name="date_descente" required>
                                </div>
                            
                                <div class="form-goup">
                                    <label for="resume_pv"> PV :</label>
                                    <div class="">
                                    <!-- text input -->
                                    <div class="form-group">
                                        <div class="btn btn-default btn-file">
                                            <i class="fas fa-paperclip"></i> Piece jointe C.E.L
                                                <?php echo form_open_multipart('upload/do_upload');?>
                                            <input type="file" name="resume_pv" id="resume_pv" required>
                                        </div>
                                    </div>
                                </div>
                                </div>
                                <div class="form-goup">
                                    <label for="consistance">Consistance :</label>
                                    <input class="form-control" type="text" id="consistance" name="consistance">
                                </div>
                                <div class="form-group">
                                    <label for="auteur">Auteur :</label>
                                    <input class="form-control" type="text" id="auteur" name="auteur" value="<?php echo $username;?>">
                                </div>
                                <div class="form-group">
                                    <label for="date_mise_valeur">Date Mise Valeur :</label>
                                    <input class="form-control" type="date" id="date_mise_valeur" name="date_mise_valeur">
                                </div>  
                                <div class="form-group">
                                    <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckIndeterminateDisabled" disabled>
                                        <label class="form-check-label" for="flexCheckIndeterminateDisabled">Opposition :</label>
                                    </div>
                                    <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckIndeterminateDisabled2" disabled>
                                        <label class="form-check-label" for="flexCheckIndeterminateDisabled2">Empietement</label>
                                    </div>
                                </div>                 
                                
                                <div class="form-group">
                                    <button type="submit" id="etape_suivante" class="btn btn-primary ">Enregistrer</button>
                                </div>
                            </div>
                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <section class="detail">
        <div class="modal fade" id="detailModalContent"  tabindex="0" role="dialog" arial-labelledby="LabelExemple" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="grandTitre">
                            <h2 class="mb-4">Details du dossier</h2>
                        </div>
                        <div id="detailsContent">
                        <div class="card px-3 py-3 shadow">
                        <div class="grandTitre bg-secondary card pt-1">
                            <h5>Détails du demandeur</h5>
                        </div>  
                            <div class="details" id="detailsDemandeur">
                                <!-- Les details du demandeur sera afficher par ajax ici -->
                            </div>                    
                        </div>
                            
                        <div class="card shadow px-3 py-3">
                            <div class="grandTitre bg-primary card pt-1">
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
    
    <section class="modifdemandeur">
        <div class="modal fade" id="modifdemandeur" tabindex="2" role="dialog" aria-labelledby="modal_form_label" aria-hidden="false">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Modifier le Demandeur</h5>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="<?php echo base_url('DemandeurController/modifier');?>">
                            <input type="hidden" value="" id="id_demandeur23" name="id_demandeur"/>
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
                                <label for="cin_demandeur">Email :</label>
                                <input type="text" class="form-control" id="cin_demandeur" name="cin_demandeur">
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
</div>



</div>



