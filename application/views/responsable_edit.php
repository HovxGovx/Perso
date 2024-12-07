<?php
	require 'layout/header.php';
?>
	<div class = "container-fluid">
		
		<div class="container-fluid">

	<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Les responsables</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Accueil</a></li>
              <li class="breadcrumb-item active">Contact</li>
            </ol>
          </div><!-- /.col -->
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
                <h3 class="card-title">Informations generaux</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                
				<form action="<?php echo base_url('responsable/edit/'.$responsable->id_responsable); ?>" method="post">
	
						<label for="id_role">Rôle:</label>
						<input type="text" name="role" id="role" value="<?php echo $responsable->id_role; ?>"><br>
					
						<label for="email">Email:</label>
						<input type="text" name="email" id="email" value="<?php echo $responsable->email; ?>"><br>

						<label for="telephone">Téléphone:</label>
						<input type="text" name="telephone" id="telephone" value="<?php echo $responsable->telephone; ?>"><br>

						<label for="login">Login:</label>
						<input type="text" name="login" id="login" value="<?php echo $responsable->login; ?>"><br>

						<label for="mdp">Mot de passe:</label>
						<input type="password" name="mdp" id="mdp" value="<?php echo $responsable->mdp; ?>"><br>

						<label for="nom">Nom:</label>
						<input type="text" name="nom" id="nom" value="<?php echo $responsable->nom; ?>"><br>

						<label for="prenom">Prénom:</label>
						<input type="text" name="prenom" id="prenom" value="<?php echo $responsable->prenom; ?>"><br>

						<input type="submit" value="Enregistrer">
						
				</form>
				
				
              </div>
              <!-- /.card-body -->
           
            <!-- /.card -->
			
			
			
		</div>
        <!-- /.row -->
        <!-- Main row -->
		
        <div class="row">
          <!-- Left col -->
          <section class="col-lg-7 connectedSortable">
            
          </section>
          <!-- /.Left col -->
          <!-- right col (We are only adding the ID to make the widgets sortable)-->
          <section class="col-lg-5 connectedSortable">

            <!-- /.card -->
          </section>
          <!-- right col -->
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
</div>
		
	</div>
<?php 
	require 'layout/footer.php' 
?>
