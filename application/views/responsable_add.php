<?php
	require 'layout/header.php';
?>

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
			
			<h2>Ajouter un responsable</h2>
			<form action="<?php echo base_url('responsable/add'); ?>" method="post">
				
				<label for="id_role">Role:</label>
				<input type="text" name="id_role" id="id_role"><br>
				
				<label for="email">Email:</label>
				<input type="text" name="email" id="email"><br>

				<label for="telephone">Téléphone:</label>
				<input type="text" name="telephone" id="telephone"><br>

				<label for="login">Login:</label>
				<input type="text" name="login" id="login"><br>

				<label for="mdp">Mot de passe:</label>
				<input type="password" name="mdp" id="mdp"><br>

				<label for="nom">Nom:</label>
				<input type="text" name="nom" id="nom"><br>

				<label for="prenom">Prénom:</label>
				<input type="text" name="prenom" id="prenom"><br>

				<input type="submit" value="Ajouter">
			</form>

       </div>
			
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
	
	
<?php 
	require 'layout/footer.php' 
?>