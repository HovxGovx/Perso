
      <!-- jQuery -->
<script src="<?php echo base_url().'assets/jquery/jquery.min.js';?>"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?php echo base_url().'assets/jquery-ui/jquery-ui.min.js';?>"></script>
<!-- Script Select option avec ajax pour dossier -->
<!-- Inclusion des fichiers Bootstrap (JavaScript) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.min.js"></script>
<script>
        $(document).ready(function(){
            
                //  afficher toutes les données initialement
                chargerDonnees('');
            $('#numdossier').on('keypress', function(event) {
                    
                    var filtre = $(this).val();
                    chargerDonnees(filtre);
                    
            });
                $('.btn-modifier').click(function() {
                    var idcel = $(this).data('idcel');
                    var iddosier = $(this).data('iddossier');
                    var date_descente = $(this).data('date_descente');
                    var resume_pv = $(this).data('resume_pv');
                    var consistance = $(this).data('consistance');
                    var auteur = $(this).data('auteur');
                    var date_mise_valeur = $(this).data('date_mise_valeur');
                    var opposition = $(this).data('opposition');
                        
                    $('#idcel').val(idcel);
                    $('#iddossier').val(iddossier);
                    $('#date_descente').val(date_descente);
                    $('#resume_pv').val(resume_pv);
                    $('#consistance').val(consistance);
                    $('#auteur').val(auteur);
                    $('#date_mise_valeur').val(date_mise_valeur);
                    $('#opposition').val(opposition);
                });
        });

        function chargerDonnees(filtre) {
            $.ajax({
                type: 'POST',
                url: '<?= site_url('CelController/chargerDonneesAjax'); ?>',
                data: { filtre: filtre },
                dataType: 'json',
                success: function(data) {
                    
                    var html = '';
                    data.forEach(function(row) {
                        html += '<tr >';
                            html += '<td class=\"hiding d-none\">' + row.idcel + '</td>';
                            html += '<td class=\"hiding d-none\">' + row.iddossier + '</td>';
                            html += '<td>' + row.date_descente + '</td>';
                            html += '<td>' + row.resume_pv + '</td>';
                            html += '<td>' + row.consistance + '</td>';
                            html += '<td>' + row.auteur + '</td>';
                            html += '<td>' + row.date_mise_valeur + '</td>';
                            html += '<td>' + row.opposition + '</td>';
                            html += '<td><button type="button" data-bs-toggle="modal" data-bs-target="#modalModification" class="btn btn-primary btn-modifier" idcel="' + row.idcel + '" date_descente="' + row.date_descente + '" resume_pv="' + row.resume_pv + '" consistance="' + row.consistance + '" auteur="' + row.auteur + '" date_mise_valeur="' + row.date_mise_valeur + '" opposition="' + row.opposition + '">Modifier</button></td>';
                            html += '<td><button type="button" class="btn btn-danger btn-supprimer">Supprimer</button></td>';
                        html += '</tr>';
                    });
                    $('#table_cel tbody').html(html);
                }
                
            });
        }


</script>
<style>
    
    
    .grandTitre{
        display:flex;
        justify-content:center;
        align-items:center;
    }
    

</style>


<div class="container  mt-4  divplus">
    <div class="grandTitre">
        <h1>Resultat C.E.L</h1>
    </div>
    <div class="recherche">
        <label for="numdossier"> Recherche par numéro de dossier : </label>
        <input type="text" class=" form-control" id="numdossier" placeholder="Entrer le numero de dossier">
    </div>
  
        <table id="table_cel" class="table table-group-divider  table-active d-table   table-bordered table-striped ">
            <thead class="thead-dark">
                <tr class="">
                    <th class="hiding d-none">ID CEL</th>
                    <th class="hiding d-none">ID Dossier</th>
                    <th>Date-descente</th>
                    <th>Résumé_PV</th>
                    <th>Consistance</th>
                    <th>Auteur</th>
                    <th>Date_Mise_Valeur</th>
                    <th>Opposition</th>
                    <th>Action</th>
                    <th>Attention</th>
                </tr>
            </thead>
            <tbody>
                <!-- Les données seront insérées ici par jquery -->
            </tbody>
        </table>
    
    

 <div id="formulaire-modification">
        <!-- Formulaire de Modification de CEL -->
<div class="modal fade" id="modalModification"  tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modifier les données du CEL</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?= site_url('celController/modifierDonneesCel'); ?>" method="post">
                    <input type="hidden" name="idcel" id="idcel" value="">
                    <input type="hidden" name="idcel" id="iddossier" value="">

                    <div class="mb-3">
                        <label for="date_descente" class="form-label">Date Descente</label>
                        <input type="date" class="form-control" id="date_descente" name="date_descente" required>
                    </div>
                    <div class="mb-3">
                        <label for="resume_pv" class="form-label">Résumé PV</label>
                        <input type="text" class="form-control" id="resume_pv" name="resume_pv" required>
                    </div>
                    <div class="mb-3">
                        <label for="consistance" class="form-label">Consistance</label>
                        <input type="text" class="form-control" id="consistance" name="consistance">
                    </div>
                    <div class="mb-3">
                        <label for="auteur" class="form-label">Auteur</label>
                        <input type="text" class="form-control" id="auteur" name="auteur">
                    </div>
                    <div class="mb-3">
                        <label for="date_mise_valeur" class="form-label">Date Mise en Valeur</label>
                        <input type="text" class="form-control" id="date_mise_valeur" name="date_mise_valeur">
                    </div>
                    <div class="mb-3">
                        <label for="opposition" class="form-label">Opposition</label>
                        <input type="text" class="form-control" id="opposition" name="opposition" required>
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
                </form>
            </div>
        </div>
    </div>
</div>
 </div>
<!-- Exemple de bouton déclencheur -->

</div>
    

    
