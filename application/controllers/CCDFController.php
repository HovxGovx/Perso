<?php
class CCDFController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
		$circId = $this->session->userdata('id_circonscription');
        $this->load->model('Dossier_model');
        $this->load->model('Responsable_model');
        if (!$this->session->userdata('currently_logged_in')) {
            redirect('main');
        }
    }

    //Fonction pour afficher la (view)liste des dossiers Pour CCDF
    public function ccdfDossier()
    {
        
        $this->load->library('layout');
		$circId = $this->session->userdata('id_circonscription');

        // Charge la vue pour afficher les dossiers pour les ccdf
        $data['id_role'] = $this->session->userdata('id_role'); 
		$data['libelle'] = $this->session->userdata('libelle');
		$data['username'] = $this->session->userdata('username');
        $data['pouravisccdf'] = $this->Dossier_model->get_all_dossiers_ccdf($circId);
        $data['destinataire'] = $this->Responsable_model->get_responsable_region($this->session->userdata('id_region'));
        $data['allDossier'] = $this->Dossier_model->get_all_dossier_guichet($this->session->userdata('id_circonscription'));
		// var_dump($data);exit;
		$this->layout->view('View_dossier_ccdf', $data);
    }
	public function EnvoieCCDF()
    {
        
        $this->load->library('layout');
		$circId = $this->session->userdata('id_circonscription');

        // Charge la vue pour afficher les dossiers pour les ccdf 
        $data['id_role'] = $this->session->userdata('id_role'); 
		$data['libelle'] = $this->session->userdata('libelle');
		$data['username'] = $this->session->userdata('username');
        $data['envoiCCDF'] = $this->Dossier_model->get_all_dossiers_Envoi_Ccdf($circId);
        $data['destinataire'] = $this->Responsable_model->get_responsable_region($this->session->userdata('id_region'));
        // var_dump($data);exit;
        $this->layout->view('View_dossier_Envoi_ccdf', $data);
    }
	public function ReceptionCCDF()
    {
        
        $this->load->library('layout');
		$circId = $this->session->userdata('id_circonscription');

        // Charge la vue pour afficher les dossiers pour les ccdf 
        $data['id_role'] = $this->session->userdata('id_role'); 
		$data['libelle'] = $this->session->userdata('libelle');
		$data['username'] = $this->session->userdata('username');
        $data['recuCCDF'] = $this->Dossier_model->get_all_dossiers_Recu_Ccdf($circId);
        $data['destinataire'] = $this->Responsable_model->get_responsable_region($this->session->userdata('id_region'));
       // var_dump($data);exit;
        $this->layout->view('View_dossier_Recu_ccdf', $data);
    }
	public function CCDFsuivie()
    {
        
        $this->load->library('layout');
		$circId = $this->session->userdata('id_circonscription');

        // Charge la vue pour afficher les dossiers pour les ccdf 
        $data['id_role'] = $this->session->userdata('id_role'); 
		$data['libelle'] = $this->session->userdata('libelle');
		$data['username'] = $this->session->userdata('username');
        $data['ccdfsuivi'] = $this->Dossier_model->get_all_dossiers_Suivie_Ccdf($circId);
        $data['destinataire'] = $this->Responsable_model->get_responsable_region($this->session->userdata('id_region'));
		// var_dump($data);exit;
        $this->layout->view('CCDFsuivi', $data);
    }
}
