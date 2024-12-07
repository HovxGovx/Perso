<?php
class SRDController extends CI_Controller{
	public function __construct()
    {
        parent::__construct();
        $this->load->model('Dossier_model');
        $this->load->model('Responsable_model');
        if (!$this->session->userdata('currently_logged_in')) {
            redirect('main');
        }
    }
	//Fonction pour afficher la (view)liste des dossiers Pour srd
    public function srdDossier()
    {
        $this->load->library('layout');
		$circId = $this->session->userdata('id_circonscription');
		$regId = $this->session->userdata('id_region');

        // Charge la vue pour afficher les dossiers pour les ccdf
        $data['id_role'] = $this->session->userdata('id_role'); 
		$data['libelle'] = $this->session->userdata('libelle');
		$data['username'] = $this->session->userdata('username');
        $data['pouravissrd'] = $this->Dossier_model->get_all_dossiers_srd($regId);
        $data['destinataire'] = $this->Responsable_model->get_responsable_region($this->session->userdata('id_region'));
        $data['allDossier'] = $this->Dossier_model->get_all_dossier_guichet($this->session->userdata('id_circonscription'));
		// var_dump($data);exit;
		$this->layout->view('View_dossier_srd', $data);
    }
	public function EnvoieSRD()
    {
        
        $this->load->library('layout');
		$circId = $this->session->userdata('id_circonscription');
		$regId = $this->session->userdata('id_region');

        // Charge la vue pour afficher les dossiers pour les ccdf 
        $data['id_role'] = $this->session->userdata('id_role'); 
		$data['libelle'] = $this->session->userdata('libelle');
		$data['username'] = $this->session->userdata('username');
        $data['envoiSRD'] = $this->Dossier_model->get_all_dossiers_Envoi_SRD($regId);
        $data['destinataire'] = $this->Responsable_model->get_responsable_region($this->session->userdata('id_region'));
        // var_dump($data);exit;
        $this->layout->view('View_dossier_Envoi_srd', $data);
    }
	public function ReceptionSRD()
    {
        
        $this->load->library('layout');
		$circId = $this->session->userdata('id_circonscription');
		$regId = $this->session->userdata('id_region');

        // Charge la vue pour afficher les dossiers pour les ccdf 
        $data['id_role'] = $this->session->userdata('id_role'); 
		$data['libelle'] = $this->session->userdata('libelle');
		$data['username'] = $this->session->userdata('username');
        $data['pouravissrd'] = $this->Dossier_model->get_all_dossiers_srd($regId);
        $data['recuSRD'] = $this->Dossier_model->get_all_dossiers_Recu_SRD($regId);
        $data['destinataire'] = $this->Responsable_model->get_responsable_region($this->session->userdata('id_region'));
       // var_dump($data);exit;
        $this->layout->view('View_dossier_Recu_srd', $data);
    }
	public function SRDsuivie()
    {
        
        $this->load->library('layout');
		$circId = $this->session->userdata('id_circonscription');
		$regId = $this->session->userdata('id_region');

        // Charge la vue pour afficher les dossiers pour les ccdf 
        $data['id_role'] = $this->session->userdata('id_role'); 
		$data['libelle'] = $this->session->userdata('libelle');
		$data['username'] = $this->session->userdata('username');
        $data['srdsuivi'] = $this->Dossier_model->get_all_dossiers_Suivie_SRD($regId);
        $data['destinataire'] = $this->Responsable_model->get_responsable_region($this->session->userdata('id_region'));
		// var_dump($data);exit;
        $this->layout->view('SRDsuivie', $data);
    }
}
