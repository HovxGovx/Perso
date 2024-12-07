<script>
document.addEventListener('DOMContentLoaded', function() {
    // Sélectionnez l'élément d'entrée de fichier
    var inputFile = document.getElementById('userfile');
    // Sélectionnez l'élément du message de comptage
    var fileCountMessage = document.getElementById('fileCountMessage');
    // Ajoutez un écouteur d'événement sur le changement de fichier
    inputFile.addEventListener('change', function() {
        // Obtenez le nombre de fichiers sélectionnés
        var fileCount = inputFile.files.length;
        // Affichez le message de comptage
        fileCountMessage.textContent = 'Nombre de fichiers sélectionnés : ' + fileCount;
    });
});

$(document).ready(function() {
    // Initialisation du type_demandeur
    get_type_demandeur();

    // Evenement pour changer le type demadeur
    $('#type_demandeur').change(function() {
        get_type_demandeur();
    });
});

function get_type_demandeur()
{
  var typeDemandeur = $('#type_demandeur').val();
  
  if(typeDemandeur =='2'){       
      $('#prenom_demandeur').hide();
      $('#cin_demandeur').hide();
      $('#representant_demandeur').show();
      
  }else{
      $('#prenom_demandeur').show();
      $('#cin_demandeur').show();
      $('#representant_demandeur').hide();
  }
    
}

function get_type_terrain() {
  var typeTerrain = $('#type_terrain').val();
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

</script>
<style>
	.gg{
        display:flex;
        justify-content: space-evenly;
        align-items:center;
    }
	.form-group{
		width:100%;
		margin-right:5px;
	}
	.tsipika{
		border-top:2px solid #FFFF ;
	}
	.apekarina{
		margin-bottom:30px;
	}
</style>

<div class="container-fluid">

	<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Les dossiers</h1>
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
              	<div class="card-header">
                	<h3 class="card-title">Fiche à remplir</h3>
            	</div>
				<div class="card-body">   
					<form action = "<?php echo base_url('ajout_donnees/add_data');?>" enctype="multipart/form-data"  method="post">		  
					    <div id="demandeur_container">	
                                            <div class="col top-1"><span class="apekarina">Demandeur</span>
							<div class="gg tsipika pt-3">
                                                            <!-- select -->
                                                             <div class="form-group">
									<label for="select_typedem">Type de demandeur :</label>
									<select name="type_demandeur" id="type_demandeur" class="form-control">
										<option value="1">Personne physique</option>
										<option value="2">Personne morale</option>                          
									</select>
								</div>
								<!-- text input -->
								<div class="form-group">
									<label>Nom du demandeur :</label>
									<input name="nom_demandeur" type="text" class="form-control" placeholder="Nom du demandeur ..." required>
								</div>
								<!-- text input -->
                                                 
                                     
								<div class="form-group" id="prenom_demandeur">
									<label>Prenom du demandeur :</label>
									<input name="prenom_demandeur"  type="text" class="form-control" placeholder="Prenom du demandeur ..." >
								</div>
                                                                
                                                                <div class="form-group" id="representant_demandeur">
									<label>Representant :</label>
									<input name="representant_demandeur"  type="text" class="form-control" placeholder="Représentant ..." >
								</div>
								
							</div>
                                                    <div class="gg">
								<!-- text input -->
								<div class="form-group" id="cin_demandeur">
									<label>Date de naissance :</label>
									<input name="datenaissance_demandeur" type="date" class="form-control" placeholder="Date de naissance du demandeur ...">
								</div>
								<!-- text input -->
								<div class="form-group">
									<label>Lieu de naissance :</label>
									<input name="lieunaissance_demandeur" type="text" class="form-control" placeholder="Lieu de naissance du demandeur ...">
								</div>
								<!-- text input -->
								<div class="form-group">
									<label>Adresse :</label>
									<input name="adresse_demandeur" type="text" class="form-control" placeholder="Adresse du demandeur ..." required>
								</div> 
                                                                
							</div>
                                                    <div class="gg">
								<!-- text input -->
								<div class="form-group" id="cin_demandeur">
									<label for="select_situationdem">Situation familiale :</label>
									<select name="situation_demandeur" id="situation_demandeur" class="form-control">
										<option value="Marié">Marié</option>
										<option value="Célibataire">Célibataire</option>
                                                                                <option value="Divorcé">Divorcé</option> 
                                                                                <option value="Veuf">Veuf</option> 
									</select>
								</div>
								<!-- text input -->
								<div class="form-group">
									<label>Père :</label>
									<input name="pere_demandeur" type="text" class="form-control" placeholder="Père  du demandeur ...">
								</div>
								<!-- text input -->
								<div class="form-group">
									<label>Mère :</label>
									<input name="mere_demandeur" type="text" class="form-control" placeholder="Mère du demandeur ..." required>
								</div> 
                                                                
							</div>
							<div class="gg">
								<!-- text input -->
								<div class="form-group" id="cin_demandeur">
									<label>Numero CIN du demandeur :</label>
									<input name="cin_demandeur" type="number" class="form-control" placeholder="Numero CIN du demandeur ...">
								</div>
								<!-- text input -->
								<div class="form-group">
									<label>Numero de telephone :</label>
									<input name="telephone" type="number" class="form-control" placeholder="Numero de telephone ...">
								</div>
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
                                            </div>  
                                                    <span class="apekarina">Terrain</span>
							<div class="gg tsipika pt-3">
                                                              <!-- text input -->
								<div class="form-group">
                                                                    <label for="select_typeterr">Type de terrain :</label>
									<select name="type_terrain" id="type_terrain" onChange="get_type_terrain()" class="form-control">
										<option value="1">Titré</option>
										<option value="2">Cadastré</option> 
                                                                                <option value="3">Ni titré ni cadastré</option>
									</select>
									
								</div>
                                                              <!-- text input -->
								<div class="form-group">
									<label>Superficie du terrain (en m2) :</label>
									<input name="superficie" type="number" class="form-control" placeholder="Superficie du terrain  ..." >
								</div>
								
							</div>
							<div class="gg">
								<!-- text input -->
								<div class="form-group" id="num_titre">
									<label>Numero du titre :</label>
									<input name="num_titre" type="text" class="form-control" placeholder="Numero du titre ...">
								</div>
                                                                
                                                                <!-- text input -->
								<div class="form-group" id="nom_propriete">
									<label>Nom de la propriété :</label>
									<input name="nom_propriete" type="text" class="form-control" placeholder="Nom de la propriété ...">
								</div>
								<!-- text input -->
								<div class="form-group" id="num_parcelle">
									<label>Numero parcelle :</label>
									<input name="num_parcelle" type="text" class="form-control" placeholder="Numero parcelle ...">
								</div>
								<!-- select -->
								<div class="form-group" id="section">
                                                                     <label for="select_section">Section :</label>
									<select name="section"  class="form-control">
                                                                            <option value="A">A</option>
                                                                            <option value="B">B</option>
                                                                        </select>
								</div>
                                                                <!-- text input -->
								<div class="form-group" id="canton">
									<label>Canton :</label>
									<input name="canton" type="text" class="form-control" placeholder="Canton ..." >
								</div>
								
							</div>
                                                        <span class="apekarina">Demande</span>
							<div class="gg tsipika pt-3">
								<!-- text input -->
								<div class="form-group">
									
									<label>  Objet de la demande :</label>
									<input name="objetfiche" type="text" class="form-control" placeholder="Objet de la demande ...">
								</div>
								<!-- text input -->
								<!--<div class="form-group">
									<label>Nature de la demande :</label>
									<input name="nature_demande" type="text" class="form-control" placeholder="Nature de la demande  ...">
								</div>-->
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
									<textarea name="description" class="form-control" rows="3" placeholder="Description ..." ></textarea>
								</div>
							</div>
							<div class="gg">
								<!-- text input -->
								<div class="form-group">
										<div class="btn btn-default btn-file">
											<i class="fas fa-paperclip"></i> Pièce jointes								
											<input type="file" name="userfilesss"  multiple  required>
										</div>
										<p id="fileCountMessage"></p>
								</div>
								<div class="" >
									<input class="btn btn-primary"  type="submit" value="Enregistrer" >
								</div>
							</div>
						</div> 					  	   
					</form>
				</div>
			</div>
        </div>
    </section>
  </div>
</div>

 

