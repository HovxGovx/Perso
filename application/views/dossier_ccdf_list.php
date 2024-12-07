<head>
	<style>
		button {
			 width: 150px;
			 height: 50px;
			 cursor: pointer;
			 display: flex;
			 align-items: center;
			 background: red;
			 border: none;
			 border-radius: 5px;
			 box-shadow: 1px 1px 3px rgba(0,0,0,0.15);
			 background: #e62222;
			}

			button, button span {
			 transition: 200ms;
			}

			button .text {
			 transform: translateX(35px);
			 color: white;
			 font-weight: bold;
			}

			button .icon {
			 position: absolute;
			 border-left: 1px solid #c41b1b;
			 transform: translateX(110px);
			 height: 40px;
			 width: 40px;
			 display: flex;
			 align-items: center;
			 justify-content: center;
			}

			button svg {
			 width: 15px;
			 fill: #eee;
			}

			button:hover {
			 background: #ff3636;
			}

			button:hover .text {
			 color: transparent;
			}

			button:hover .icon {
			 width: 150px;
			 border-left: none;
			 transform: translateX(0);
			}

			button:focus {
			 outline: none;
			}

			button:active .icon svg {
			 transform: scale(0.8);
			}
	</style>
</head>    
	<!-- Content Wrapper. Contains page content -->
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        
		
	<div class="card">
              <div class="card-header">
                <h3 class="card-title">Listes des responsables</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  
                   <tr>
						<th>Numéro du dossier</th>
						<th>Date demande</th>
						<th>Affaire</th>
						
						<th>Actions</th>
					</tr>
					
                  </thead>
                  <tbody>
						<?php foreach ($pouravisccdf as $value) : ?>
							<tr>
								<td><?php echo $value->numdossier; ?></td>
								<td><?php echo $value->date_demande; ?></td>
								<td><?php echo $value->type_affaire.''.$value->num_affaire ?></td>
								
								<td class="btn-group">
                                                                         <button class="btn btn-secondary mx-1 my-2 btncel shadow" data-numdossier=<?php echo $value->numdossier?> data-id=<?php echo $value->id_dossier?>  data-toggle="modal" data-target="#myModal">
                                                                         <i class="fas fa-eye"></i> C.E.L
                                                                         </button>
									<a href="<?php echo site_url('responsable/edit/'.$value->id_dossier); ?>"><button class="btn btn-warning w-75" ><i class="fas fa-edit"></i></button></a>
									<a href="<?php echo site_url('responsable/delete/'.$value->id_dossier); ?>"><button class="btn btn-danger w-75" ><i class="fas fa-trash"></i></button></a>
								</td>
								<td>
									<a href="<?php echo site_url('responsable/view/'.$value->id_responsable); ?>"><button class="btn btn-eye w-75" ><i class="fas fa-eye"></i></button></a>
								</td>
							</tr>
						<?php endforeach; ?>
                  </tbody>
                  
                </table>
					<a href="<?php echo site_url('responsable/add'); ?>">
					<input type="submit" value="Ajouter un utilisateur" class="btn btn-success float-right">
					</a>
              </div>
              <!-- /.card-body -->
			
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
  

<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

