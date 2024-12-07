<!-- jQuery -->
<script src="<?php echo base_url().'assets/jquery/jquery.min.js';?>"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?php echo base_url().'assets/jquery-ui/jquery-ui.min.js';?>"></script>
<!-- Script Select option avec ajax pour dossier -->
<!-- <script>

    $(document).ready(function() {
        $('#recherche_dossier').on('input', function() {
            var recherche = $(this).val().toLowerCase();
            $.ajax({
                url: '<?= site_url('CelController/obtenirDossiersJSON'); ?>',
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    console.log(data);
                    $('#id_dossier').empty();
                    $.each(data, function(index, dossier) {
                        if (dossier.numdossier.toLowerCase().includes(recherche)) {
                            $('#id_dossier').append('<option value="' + dossier.id_dossier + '">' + dossier.numdossier + '</option>');
                        }
                    });
                }
            });
        });
    });
</script> -->
<style>
    .divplus{
        font-size:18px;
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
</style>




    <div class="grandTitre">
        <h2 class="mb-4">Formulaire C.E.L</h2>
    </div>
    <form action="<?php echo base_url('CelController/ajouterDonnees');?>" method="post" id="formulaire_cel">

        <!-- Étape 1 -->
        <div class="etape" id="etape1">
            <div class="form-group">
                <label for="id_dossier">Dossier: </label>
                <input class="form-control" type="text" class="form-control" id="recherche_dossier" placeholder="Rechercher un dossier">
                <!-- <select class="form-control mt-2" name="id_dossier" id="id_dossier" required>
                     Options  chargées dynamiquement  par AJAX 
                </select> -->
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
                <input class="form-control" type="text" id="auteur" name="auteur">
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
    






