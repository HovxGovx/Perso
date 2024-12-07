<?php
class GuichetController extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Dossier_model');
        $this->load->model('Responsable_model');
        if (!$this->session->userdata('currently_logged_in')){
            redirect('main');
        }
        $this->load->library('layout');
    }
    //Fonction pour afficher la (view)liste des dossiers Pour Guichet
    public function guichetDossier(){
        // Charge la vue pour afficher les dossiers pour les ccdf 
		$data['username'] = $this->session->userdata('username');  
        //$this->load->view('layout/header_guichet', $data);
        $this->layout->view('View_dossier_guichet',$data);
       // $this->load->view('layout/footer');
    }
    public function guichetAjoutDossier(){
      $data['username'] = $this->session->userdata('username');		
        $this->layout->view('dossier_ajout',$data);
       // $this->load->view('layout/footer');
    }
    public function guichetSuppDossier(){
        $data['username'] = $this->session->userdata('username');
		//$this->load->view('layout/header_guichet', $data);
        $this->layout->view('View_dossier_supp', $data);
       // $this->load->view('layout/footer');
    }
}