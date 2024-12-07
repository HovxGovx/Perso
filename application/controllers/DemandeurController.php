<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DemandeurController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Demandeur_model');
        $this->load->model('cin_model','cin');
        $this->load->helper('url');
    }

    public function index() {
		$data['username'] = $this->session->userdata('username');
		$data['libelle'] = $this->session->userdata('libelle');

		// $this->load->view('layout/header',$data);
        // $this->load->view('DemandeurView');
		// $this->load->view('layout/footer');
        $this->layout->view('DemandeurView', $data);        
    }

    public function ajax_list() {
        $list = $this->Demandeur_model->obtenir_demandeurs();
        $output = array("data" => $list);
        echo json_encode($output);
    }
    
    public function ajax_get_demandeur($id_demandeur) {
            // Utilisez la méthode du modèle pour obtenir les détails du demandeur par ID
            $demandeur = $this->Demandeur_model->get_demandeur_by_id($id_demandeur);
            echo json_encode($demandeur);
    }
    // Fonction pour récupérer les informations d'un demandeur pour la modification
    // Fonction pour récupérer les informations d'un demandeur pour la modification
    public function modifier() {
        // Récupérer les données du formulaire
        $data = array(
            'id_demandeur' => $this->input->post('id_demandeur'),
            'type_demandeur' => $this->input->post('type_demandeur'),
            'nom_demandeur' => $this->input->post('nom_demandeur'),
            'prenom_demandeur' => $this->input->post('prenom_demandeur'),
            'email_demandeur' => $this->input->post('email_demandeur'),
            'telephone' => $this->input->post('telephone'),
        );

        $id = $data["id_demandeur"];

        // Mettre à jour la ligne dans la base de données en fonction de l'ID
        $this->load->model('Demandeur_model');
        $this->Demandeur_model->update_demandeur($id, $data);

        // Charger la vue avec les informations du demandeur
        $demandeur_data = $this->Demandeur_model->get_demandeur($id); // Assurez-vous d'avoir une fonction pour récupérer les informations d'un demandeur dans votre modèle
        $this->layout->view('DemandeurView', $demandeur_data);        

    }

    // Fonction pour mettre à jour les informations d'un demandeur
    public function ajax_mettre_a_jour() {
        // Récupérer les données du formulaire
        $data = array(
            'type_demandeur' => $this->input->post('type_demandeur'),
            'nom_demandeur' => $this->input->post('nom_demandeur'),
            'prenom_demandeur' => $this->input->post('prenom_demandeur'),
            'email_demandeur' => $this->input->post('email_demandeur'),
            'telephone' => $this->input->post('telephone')
        );

        // Appeler la méthode du modèle pour mettre à jour le demandeur
        $this->Demandeur_model->modifier_demandeur($this->input->post('id_demandeur'), $data);

        echo json_encode(array("status" => TRUE));
    }

    // Fonction pour supprimer un demandeur
    public function ajax_delete($id) {
        // Appeler la méthode du modèle pour supprimer le demandeur
        $this->Demandeur_model->supprimer_demandeur($id);

        echo json_encode(array("status" => TRUE));
    }

    // Fonction pour la recherche de demandeurs par nom ou prénom
    public function ajax_recherche() {
        $keyword = $this->input->post('keyword');
        $list = $this->Demandeur_model->recherche($keyword);
        $data = array();
        foreach ($list as $demandeur) {
            $row = array();
            $row[] = $demandeur->id_demandeur;
            $row[] = $demandeur->type_demandeur;
            $row[] = $demandeur->nom_demandeur;
            $row[] = $demandeur->prenom_demandeur;
            $row[] = $demandeur->email_demandeur;
            $row[] = $demandeur->telephone;

            // Ajoutez les boutons d'action (modifier et supprimer) ici
            $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Modifier" onclick="modifier_demandeur('."'".$demandeur->id_demandeur."'".')"><i class="glyphicon glyphicon-pencil"></i> Modifier</a>
                     <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Supprimer" onclick="supprimer_demandeur('."'".$demandeur->id_demandeur."'".')"><i class="glyphicon glyphicon-trash"></i> Supprimer</a>';

            $data[] = $row;
        }

        $output = array("data" => $data);
        // Sortie au format JSON
        echo json_encode($output);
    }
    
    // Fonction pour autocompletion
    public function cin_autocompletion(){
        
       
       $keyword=$this->input->post('keyword');
       $data=$this->cin->GetRow($keyword);  
       if(!empty($data)) {
           
           foreach($data as $onecin){
               echo "<li onClick=\"selectCinReq('". $onecin->cin."')\";>".$onecin->cin."</li>";
           }
       }
   }
   
    public function infodemandeur(){
          $cin=$this->input->post('cin');
          $res=$this->cin->get_dem($cin);
          if(count($res) > 0)
            {
                $data = array();
                $data['id_demandeur']=$res[0]->id_demandeur;
                $data['type_demandeur']=$res[0]->type_demandeur;
                $data['nom_demandeur']=$res[0]->nom_demandeur;
                $data['prenom_demandeur']=$res[0]->prenom_demandeur;
                $data['cin_demandeur']=$res[0]->cin_demandeur;
                $data['adresse_demandeur']=$res[0]->adresse_demandeur;
                $data['date_naissance']=$res[0]->date_naissance;
                $data['lieu_naissance']=$res[0]->lieu_naissance;
                $data['situation_familiale']=$res[0]->situation_familiale;
                $data['pere_demandeur']=$res[0]->pere_demandeur;                
                $data['mere_demandeur']=$res[0]->mere_demandeur;
                $data['representant']=$res[0]->representant;
                $data['telephone']=$res[0]->telephone;
                echo  json_encode($data);
            }else{
                echo "false";
            }
          
    }
    
   public function add_demandeur() {
    $json_input = file_get_contents('php://input');
    $data = json_decode($json_input, true);

    if (json_last_error() === JSON_ERROR_NONE) {
        $this->load->model('Demandeur_model');

        
        if ($data['type_demandeur']=="1"){
            $exists = $this->Demandeur_model->check_exists($data['cin_demandeur']);
            if ($exists) {
                $this->db->where('cin_demandeur', $data['cin_demandeur']);
                $this->db->update('demandeur', $data);

                $this->db->select('id_demandeur');
                $this->db->where('cin_demandeur', $data['cin_demandeur']);
                $query = $this->db->get('demandeur');
                $row = $query->row();
                $id = $row ? $row->id_demandeur : null;

                $message = 'Demandeur mise à jour.';
            } else {

                $id = $this->Demandeur_model->insert_demandeur($data);
                $message = 'Demandeur enregistrée.';
            }
        }else if ($data['type_demandeur']=="2"){
            $exists = $this->Demandeur_model->check_exists($data['nom_demandeur']);
            
            if ($exists) {
                $this->db->where('nom_demandeur', $data['nom_demandeur']);
                $this->db->update('demandeur', $data);

                $this->db->select('id_demandeur');
                $this->db->where('nom_demandeur', $data['nom_demandeur']);
                $query = $this->db->get('demandeur');
                $row = $query->row();
                $id = $row ? $row->id_demandeur : null;

                $message = 'Demandeur mise à jour.';
            } else {

                $id = $this->Demandeur_model->insert_demandeur($data);
                $message = 'Demandeur enregistrée.';
            }
        }
        

        echo json_encode(['status' => 'success', 'message' => $message, 'id_demandeur' => $id]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'JSON Invalide.']);
    }
}


}
