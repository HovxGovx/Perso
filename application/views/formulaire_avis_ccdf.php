<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title>Formulaire Avis</title>
  <!-- Add Bootstrap CSS -->
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="<?php echo base_url().'assets/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css';?>">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo base_url().'assets/icheck-bootstrap/icheck-bootstrap.min.css';?>">
  <!-- JQVMap -->
  <link rel="stylesheet" href="<?php echo base_url().'assets/jqvmap/jqvmap.min.css';?>">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url().'assets/fontawesome-free/css/all.min.css';?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url().'assets/css/adminlte.min.css';?>">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?php echo base_url().'assets/overlayScrollbars/css/OverlayScrollbars.min.css';?>">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?php echo base_url().'assets/daterangepicker/daterangepicker.css';?>">
  <!-- summernote -->
  <link rel="stylesheet" href="<?php echo base_url().'assets/summernote/summernote-bs4.min.css';?>">
     <!-- jQuery -->
<script src="<?php echo base_url().'assets/jquery/jquery.min.js';?>"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?php echo base_url().'assets/jquery-ui/jquery-ui.min.js';?>"></script>
<!-- Script Select option avec ajax pour dossier -->
<script>
    $(document).ready(function () {
        $('#recherche_dossier').on('input', function () {
            var recherche = $(this).val().toLowerCase();
            $.ajax({
                url: '<?= site_url('CelController/obtenirDossiersJSON'); ?>',
                type: 'GET',
                dataType: 'json',
                success: function (data) {
                    console.log(data);
                    $('#id_dossier').empty();
                    $.each(data, function (index, dossier) {
                        if (dossier.numdossier.toLowerCase().includes(recherche) && dossier.etat === 'valide') {
                            $('#id_dossier').append('<option value="' + dossier.id_dossier + '">' + dossier.numdossier + '</option>');
                        }
                    });
                }
            });
        });
    });
</script>
</head>
<body>
 <div class="container ">
    <h2 class="text-left">Formulaire Avis</h2>
    <div class="row  ">
        <div class="col-md-8  w-75">
            <form class="  mr-2 shadow  px-2 py-2 ">
                <div class="form-group">
                    <label for="id_dossier">Dossier: <?php echo $username;?></label>
                    <input class="form-control" type="text" class="form-control" id="recherche_dossier" placeholder="Rechercher un dossier">
                    <select class="form-control mt-2" name="id_dossier" id="id_dossier" required>
                        <!-- Options  chargées dynamiquement  par AJAX -->
                    </select>
                </div>
                
                <div class="form-group">
                  <label for="prix">Prix</label>
                  <input type="number" class="form-control" id="prix" placeholder="Proposition de prix....">
                </div>
                <div class="form-group">
                  <label for="message">Observation</label>
                  <textarea class="form-control" id="message" rows="3" placeholder="Enter message"></textarea>
                </div>
                <div class="d-flex justify-content-between mt-4">
                    <button class="btn btn-primary">Envoyer </button>
                    <button class="btn btn-success">Valider</button>
                    <button class="btn btn-danger">Refuser</button>
                </div>
            </form>
        </div>

        <!-- Colonne pour afficher le texte depuis la base de données avec ombre -->
        <div class="col-md-4 mb-3 p-4 w-125 shadow">
            <?php
            // Remplacez cette partie avec le code pour récupérer le texte depuis la base de données
           // $texteDepuisBD = "Details Dossier Et Observation";
           // echo $texteDepuisBD;
            ?>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Iure assumenda, ullam dolorem corrupti cumque, ad expedita accusantium consectetur vero exercitationem, obcaecati temporibus quidem! Praesentium aliquam rerum ratione asperiores, vero laboriosam?</p>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Iure assumenda, ullam dolorem corrupti cumque, ad expedita accusantium consectetur vero exercitationem, obcaecati temporibus quidem! Praesentium aliquam rerum ratione asperiores, vero laboriosam?</p>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Iure assumenda, ullam dolorem corrupti cumque, ad expedita accusantium consectetur vero exercitationem, obcaecati temporibus quidem! Praesentium aliquam rerum ratione asperiores, vero laboriosam?</p>

        </div>
    </div>
</div>

 <!-- Add jQuery and Bootstrap JavaScript -->
 <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
