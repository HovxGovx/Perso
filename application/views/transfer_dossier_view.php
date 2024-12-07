



            <!-- Content Wrapper. Contains page content -->
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Tableau de bord</h1>
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
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?php echo $totaldossier;?></h3>

                <p>Nouvelle demande</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>0<sup style="font-size: 20px">%</sup></h3>

                <p>Demandes traités</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><?php echo $totalresp; ?></h3>

                <p>Les responsables</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="<?php echo base_url().'responsable';?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>0</h3>

                <p>Demande refusée</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
		
		
	<div class="doss" style="justify-content: center; align-items: center; padding: 20px;">		  
			  
      <h1>Transférer un dossier</h1>
    <form action="<?php echo base_url('DossierController/transfer_dossier'); ?>" method="post">
        <label for="nom">Nom du dossier :</label>
        <input type="text" name="nom" id="nom" required><br>

        <label for="description">Description :</label>
        <textarea name="description" id="description"></textarea><br>

        <label for="expediteur_id">Expéditeur :</label>
        <input type="text" name="expediteur_id" id="expediteur_id" required><br>

        <label for="destinataire_id">Destinataire :</label>
        <select name="destinataire_id" id="destinataire_id" required>
            <?php foreach ($responsables as $responsable) : ?>
                <option value="<?php echo $responsable->id; ?>"><?php echo $responsable->nom; ?></option>
            <?php endforeach; ?>
        </select><br>

        <input type="submit" value="Transférer">
    </form>

    <?php
    if (isset($result_message)) {
        echo '<p>' . $result_message . '</p>';
    }
    ?>
	</div>
     

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
       
        <div class="card-body p-0">
          </div>
        <!-- /.card-body -->
      </div>
    
  </div>
  <!-- /.content-wrapper -->
  
