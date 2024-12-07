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

         .phone-input {
                 display: flex;
                 align-items: center;
         }

         .country-code select {
                 padding: 5px;
                 margin-right: 10px;
         }

         #phone-number {
                 width: 150px;
                 padding: 5px;
         }

         .hidden {
                 display: none !important;
         }

         .visible {
                 display: block !important;
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
                                                 <h1 class="m-0">Fiche à remplir </h1>
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
                                                                                                                <i class="fas fa-user"></i> Demandeur(s)
                                                                                                        </a>
                                                                                                 </h4>
                                                                                         </div>
                                                                                         <div id="collapseOne" class="collapse show" data-parent="#accordion">
                                                                                                 <div class="card-body">
                                                                                                         <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default">
                                                                                                                 <i class="fas fa-user-plus"></i> Nouveau demandeur
                                                                                                         </button>
                                                                                                         <br><br>
                                                                                                         <table id="tabledemandeur" class="table table-bordered table-striped">
                                                                                                                 <thead>
                                                                                                                         <tr>
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
                                                                                                                 <i class="fa fa-map"></i> Terrain
                                                                                                         </a>
                                                                                                 </h4>
                                                                                         </div>
                                                                                         <div id="collapseTwo" class="collapse" data-parent="#accordion">
                                                                                                 <div class="card-body">
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
                                                                                                                         <label>Superficie du terrain (en m²) :</label>
                                                                                                                         <input name="superficie" id="TerrainSuperficie" type="number" class="form-control" placeholder="Superficie du terrain  ...">
                                                                                                                 </div>

                                                                                                         </div>
                                                                                                         <div class="gg">
                                                                                                                 <!-- text input -->
                                                                                                                 <div class="form-group" id="num_titre">
                                                                                                                         <label>Numero du titre :</label>
                                                                                                                         <input name="num_titre" id="TerrainNumTitre" type="text" class="form-control" placeholder="Numero du titre ...">
                                                                                                                 </div>

                                                                                                                 <!-- text input -->
                                                                                                                 <div class="form-group" id="nom_propriete">
                                                                                                                         <label>Nom de la propriété :</label>
                                                                                                                         <input name="nom_propriete" id="TerrainNom" type="text" class="form-control" placeholder="Nom de la propriété ...">
                                                                                                                 </div>
                                                                                                                 <!-- text input -->
                                                                                                                 <div class="form-group" id="num_parcelle">
                                                                                                                         <label>Numero parcelle :</label>
                                                                                                                         <input name="num_parcelle" id="TerrainNumParcelle" type="text" class="form-control" placeholder="Numero parcelle ...">
                                                                                                                 </div>
                                                                                                                 <!-- select -->
                                                                                                                 <div class="form-group" id="section">
                                                                                                                         <label for="select_section">Section :</label>
                                                                                                                         <select name="section" id="TerrainSection" class="form-control">
                                                                                                                                 <option value="A">A</option>
                                                                                                                                 <option value="B">B</option>
                                                                                                                         </select>
                                                                                                                 </div>
                                                                                                                 <!-- text input -->
                                                                                                                 <div class="form-group" id="canton">
                                                                                                                         <label>Canton :</label>
                                                                                                                         <input name="canton" id="TerrainCanton" type="text" class="form-control" placeholder="Canton ...">
                                                                                                                 </div>
                                                                                                         </div>

                                                                                                         <div class="gg">
                                                                                                                 <div class="form-group">
                                                                                                                         <label for="selectCirconscription">Circonscription :</label>
                                                                                                                         <select name="Circonscription" class="form-control" id="selectCirconscription">
                                                                                                                                 <!-- A partir du region du responsable -->
                                                                                                                         </select>
                                                                                                                 </div>
                                                                                                                 <!-- select -->
                                                                                                                 <div class="form-group">
                                                                                                                         <label for="location" style="margin-bottom: 0px;">Localisation :</label>
                                                                                                                         <div class="form-group" id="district" style="display: flex; align-items: center;margin-bottom: -10px;">
                                                                                                                                 <input name="district" id="Terraindist" type="text" class="form-control" placeholder="District" style=" width: 150px; border-right: none;">
                                                                                                                                 <h1>/</h1>
                                                                                                                                 <input name="commune" id="Terraincom" type="text" class="form-control" placeholder="Commune" style="border-radius: 0; width: 150px; border-left: none; border-right: none;">
                                                                                                                                 <h1>/</h1>
                                                                                                                                 <input name="fokotany"  id="Terrainfoko" type="text" class="form-control" placeholder="Fokontany" style="border-radius: 0; width: 150px; border-left: none; border-right: none;">
                                                                                                                                 <h1>|</h1>
                                                                                                                         </div>
                                                                                                                 </div>
                                                                                                         </div>
                                                                                                 </div>
                                                                                         </div>
                                                                                 </div>
										 <!-- Division Reperage -->
                                                                                 <div class="card card-warning">
                                                                                         <div class="card-header">
                                                                                                 <h4 class="card-title w-100">
                                                                                                         <a class="d-block w-100" data-toggle="collapse" href="#collapseFour">
                                                                                                                 <i class="fa fa-exclamation-triangle"></i> Repérage
                                                                                                         </a>
                                                                                                 </h4>
                                                                                         </div>
                                                                                         <div id="collapseFour" class="collapse " data-parent="#accordion">
                                                                                                 <div class="card-body" style="display: flex; align-items:center; justify-content:center;">
                                                                                                         <div class="gg tsipika pt-3 " style="display: flex; align-items:center; justify-content:space-between;">
                                                                                                                 <!-- text input -->
                                                                                                                 <div class="form-group">
                                                                                                                         <div class="radio-line">
                                                                                                                                 <label class="control-label ">Répèrage : </label>
                                                                                                                         </div>
                                                                                                                         <div class="radio-inline">
                                                                                                                                 <input value=False name="reperage" id="reper1" type="radio" required>Sans empiètement
                                                                                                                         </div>
                                                                                                                         <div class="radio-inline">
                                                                                                                                 <input value=True name="reperage" id="reper2" type="radio" required>Avec empiètement
                                                                                                                         </div>
                                                                                                                         <span style="font-size: smaller; color:grey; margin-bottom:-20px; width:0;">*Un Terrain avec empiètement n'aura plus de suite. </span>
                                                                                                                 </div>

                                                                                                         </div>

                                                                                                 </div>
                                                                                                 <div class="pt-4 mb-3 mr-3" style="display: flex; align-items:center; justify-content:flex-end;">
                                                                                                         <input class="btn btn-primary" id="Empt" value="EMPT" onclick="Dossier_avec_empt()">
                                                                                                 </div>
                                                                                         </div>
                                                                                 </div>
										 <!-- Division Demandes -->
                                                                                 <div class="card card-success" id="demandes">
                                                                                         <div class="card-header">
                                                                                                 <h4 class="card-title w-100">
                                                                                                         <a class="d-block w-100" data-toggle="collapse" href="#collapseThree">
                                                                                                                 <i class="fa fa-address-card"></i> Demande
                                                                                                         </a>
                                                                                                 </h4>
                                                                                         </div>
                                                                                         <div id="collapseThree" class="collapse" data-parent="#accordion">
                                                                                                 <div class="card-body">
                                                                                                         <div class="gg">
                                                                                                                 <!-- text input -->
                                                                                                                 <div class="form-group">
                                                                                                                         <label>Date de la demande :</label>
                                                                                                                         <input name="date_demande" id="date_demande" type="date" class="form-control" placeholder="Date de la demande ..." required>
                                                                                                                 </div>
                                                                                                                 <div class="form-group">
                                                                                                                         <label>Numéro quittance :</label>
                                                                                                                         <input name="num_quittance" type="text" class="form-control" placeholder="Numéro de la quittance ..." required>
                                                                                                                 </div>

                                                                                                         </div>
                                                                                                         <div class="gg tsipika pt-3">
                                                                                                                 <div class="form-group" id="objetfiches">
                                                                                                                         <label for="vocation">Objet de la demande :</label>
                                                                                                                         <select id="objetfiche" name="objetfiche" class="form-control">
                                                                                                                                 <option value="Affectation">Affectation</option>
                                                                                                                                 <option value="Acquisition">Acquisition</option>
                                                                                                                                 <option value="Location">Location</option>
                                                                                                                                 <option value="Dotation">Dotation</option>
                                                                                                                                 <option value="Grande superficie">Grande superficie</option>
                                                                                                                                 <option value="Nouveau">Autre...</option>
                                                                                                                         </select>
                                                                                                                         <input id="ObjetFicheInput" name="ObjetFicheInput" type="text" class="form-control" placeholder="Entrez un nouveau" style="display:none;">
                                                                                                                 </div>
                                                                                                                 <!-- text input -->
                                                                                                                 <div class="form-group" id="nature_demandes">
                                                                                                                         <label for="vocation">Nature de la demande :</label>
                                                                                                                         <select id="nature_demande" name="nature_demande" class="form-control">
                                                                                                                                 <option value="Morcellement">Morcellement</option>
                                                                                                                                 <option value="Nouveau">Autre...</option>
                                                                                                                         </select>
                                                                                                                         <input id="NatureInput" name="nature_demande" type="text" class="form-control" placeholder="Entrez un nouveau" style="display:none;">
                                                                                                                 </div>
                                                                                                         </div>
                                                                                                         <div class="gg">
                                                                                                                 <div class="phone-input form-goup">
                                                                                                                         <div class="country-code">
                                                                                                                                 <label>Type &</label>
                                                                                                                                 <select id="country-code" name="type_affaire" class="form-control">
                                                                                                                                         <option default value="FN" data-code="FN">FN</option>
                                                                                                                                         <option value="FG" data-code="FG">FG</option>
                                                                                                                                 </select>
                                                                                                                         </div>
                                                                                                                         <div>
                                                                                                                                 <label> Numero d'affaire </label>
                                                                                                                                 <input type="tel" id="phone-number" name="num_affaire" placeholder="" class="form-control" />
                                                                                                                         </div>
                                                                                                                 </div>
                                                                                                                 <!-- Pieces jointes -->
                                                                                                                 <div class="gg">
                                                                                                                         <!-- text input -->
                                                                                                                         <div class="form-group">
                                                                                                                                 <label class="form-label"> Pièce jointes </label>
                                                                                                                                 <div class="btn btn-default btn-file">
                                                                                                                                         <i class="fas fa-paperclip"></i> Pièce jointes
                                                                                                                                         <input type="file" id="userfile" name="userfile[]" required multiple="multiple">
                                                                                                                                 </div>
                                                                                                                                 <p id="fileCountMessage" style="font-size: smaller; color:grey; "></p>

                                                                                                                         </div>
                                                                                                                 </div>
                                                                                                         </div>

                                                                                                         <!-- textarea -->
                                                                                                         <div class="form-group">
                                                                                                                 <label>Description :</label>
                                                                                                                 <textarea name="description" class="form-control" rows="3" placeholder="Description ..."></textarea>
                                                                                                         </div>
                                                                                                         <div class="pt-4 mb-3 mr-3" style="display: flex; align-items:center; justify-content:flex-end;">
                                                                                                                 <input class="btn btn-primary" type="submit" value="Enregistrer">
                                                                                                         </div>
                                                                                                 </div>
                                                                                                 <!-- Pieces jointes
                                                                                                 <div class="gg">
                                                                                                         <div class="form-group">
                                                                                                                 <div class="btn btn-default btn-file">
                                                                                                                         <i class="fas fa-paperclip"></i> Pièce jointes
                                                                                                                         <input type="file" id="userfile" name="userfile[]" required multiple="multiple">
                                                                                                                 </div>
                                                                                                                 <p id="fileCountMessage"></p>
                                                                                                         </div>
                                                                                                 </div> -->
                                                                                         </div>
                                                                                 </div>

                                                                         </div>

                                                                 </form>
                                                         </div>
                                                 </div>
                                                 <!-- /.card -->
                                         </div>
                                         <!-- Modal pour l'ajout ou la modification de demandeur -->
                                         <div class="modal fade" id="modal-default">
                                                 <div class="modal-dialog">
                                                         <div class="modal-content">
                                                                 <div class="modal-header">
                                                                         <h4 class="modal-title">Ajout demandeur </h4>
                                                                         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                 <span aria-hidden="true">&times;</span>
                                                                         </button>
                                                                 </div>
                                                                 <div class="modal-body">

                                                                         <div id="demandeur_container">
                                                                                 <div class="col top-1">
                                                                                         <div class="gg">

                                                                                                 <!-- select -->
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
                                                                                                         <input name="nom_demandeur" id="nom_demandeur" type="text" class="form-control" placeholder="Nom du demandeur ..." >
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
                                                                                                         <input name="adresse_demandeur" id="adresse_demandeur" type="text" class="form-control" placeholder="Adresse du demandeur ..." >
                                                                                                 </div>

                                                                                         </div>
                                                                                         <div class="gg">
                                                                                                 <!-- text input -->
                                                                                                 <div class="form-group" id="situation_familiale_container">
                                                                                                         <label for="select_situationdem">Situation familiale :</label>
                                                                                                         <select name="situation_familiale" id="situation_familiale" class="form-control">
                                                                                                                 <option value="Marié">Marié</option>
                                                                                                                 <option value="Célibataire">Célibataire</option>
                                                                                                                 <option value="Divorcé">Divorcé</option>
                                                                                                                 <option value="Veuf">Veuf</option>
                                                                                                         </select>
                                                                                                 </div>
                                                                                                 <!-- text input -->
                                                                                                 <div class="form-group" id="pere_demandeur_container">
                                                                                                         <label>Père :</label>
                                                                                                         <input name="pere_demandeur" id="pere_demandeur" type="text" class="form-control" placeholder="Père  du demandeur ...">
                                                                                                 </div>
                                                                                                 <!-- text input -->
                                                                                                 <div class="form-group" id="mere_demandeur_container">
                                                                                                         <label>Mère :</label>
                                                                                                         <input name="mere_demandeur" id="mere_demandeur" type="text" class="form-control" placeholder="Mère du demandeur ..." >
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
         var id_region = '<?php echo $id_region ?>';
	 console.log('this one is',id_region);
         var base_url = '<?php echo base_url(); ?>';
         var site_url = '<?php echo site_url(); ?>';
 </script>
 <script src="<?php echo base_url('assets/js/ajax/dossier_add.js?v=' . time()); ?>"></script>
 <script src="<?php echo base_url('assets/js/ajax/dossier_add_empt.js?v=' . time()); ?>"></script>
