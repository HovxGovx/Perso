<?php
class GuichetController extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('layout');
		$this->load->model('Dossier_model');
		$this->load->model('Responsable_model');
		if (!$this->session->userdata('currently_logged_in')) {
			redirect('main');
		}
		$this->load->library('layout');
	}
	//Fonction pour afficher la (view)liste des dossiers Pour Guichet
	public function guichetDossier()
	{
		// Charge la vue pour afficher les dossiers pour les ccdf 
		$data['libelle'] = $this->session->userdata('libelle');
		$data['id_role'] = $this->session->userdata('id_role');
		$data['id_region'] = $this->session->userdata('id_region');
		$data['username'] = $this->session->userdata('username');
		$data['allDossier'] = $this->Dossier_model->get_all_dossier_guichet($this->session->userdata('id_circonscription'));
		$this->layout->view('View_dossier_guichet', $data);
	}
	//Fonction pour afficher la (view)liste des dossiers Pour Guichet
	public function guichetSuivie()
	{
		// Charge la vue pour afficher les dossiers pour les ccdf 
		$data['libelle'] = $this->session->userdata('libelle');
		$data['id_role'] = $this->session->userdata('id_role');
		$data['id_region'] = $this->session->userdata('id_region');
		$data['username'] = $this->session->userdata('username');
		$data['allDossier'] = $this->Dossier_model->get_all_dossier_guichet_suivie($this->session->userdata('id_circonscription'));
		$this->layout->view('View_dossier_guichet_suivie', $data);
	}
	public function guichetDossierEnAttente()
	{
		// Charge la vue pour afficher les dossiers pour les ccdf 
		$data['libelle'] = $this->session->userdata('libelle');
		$data['id_role'] = $this->session->userdata('id_role');
		$data['id_region'] = $this->session->userdata('id_region');
		$data['username'] = $this->session->userdata('username');
		$data['EnAttenteDossier'] = $this->Dossier_model->get_all_dossier_en_attente($this->session->userdata('id_circonscription'));
		$this->layout->view('View_dossier_guichet_EnAttente', $data);
	}
	public function guichetAjoutDossier()
	{
		// Charge la vue pour afficher les dossiers pour les ccdf 
		$data['libelle'] = $this->session->userdata('libelle');
		$data['id_role'] = $this->session->userdata('id_role');
		$data['id_region'] = $this->session->userdata('id_region');
		$data['nomregion'] = $this->session->userdata('nomregion');

		$data['username'] = $this->session->userdata('username');
		$this->layout->view('dossier_add', $data);
	}
	public function guichetModifDossier($id_dossier)
	{
		$data['id_dossier'] = $id_dossier;
		// Charge la vue pour afficher la formulaire de modification de dossier  
		$data['libelle'] = $this->session->userdata('libelle');
		$data['id_role'] = $this->session->userdata('id_role');
		$data['username'] = $this->session->userdata('username');
		$this->layout->view('fiche_modification_dossier', $data);
	}
	public function guichetSuppDossier()
	{
		// Charge la vue pour afficher les dossiers pour les ccdf 
		$data['libelle'] = $this->session->userdata('libelle');
		$data['id_role'] = $this->session->userdata('id_role');
		$data['username'] = $this->session->userdata('username');
		$this->layout->view('View_dossier_supp', $data);
	}
	public function getDossierById($idDossier)
	{
		// Récupération Du circonscription de la session
		$circId = $this->session->userdata('id_circonscription');
		//Récupération demandes
		$demandes = $this->Dossier_model->getDemande($idDossier, $circId);
		// Récupération des Pieces Jointes
		$piecesjointesdossiers = $this->Dossier_model->getPdfByDossierId($idDossier);
		// Récupération des demandeurs
		$demandeurs = $this->Dossier_model->getDemandeursByDossierId($idDossier);
		// Récupération du terrain
		$terrain = $this->Dossier_model->getTerrainByDossierId($idDossier);
		// Retourner les données
		echo json_encode([
			'demandes' => $demandes,
			'demandeurs' => $demandeurs,
			'terrain' => $terrain,
			'piecejointes' => $piecesjointesdossiers
		]);
	}
	public function deleteDemandeur($id_dossier, $id_demandeur)
	{
		$this->load->model('Demandeur_model'); // Assurez-vous que le modèle est chargé
		$result = $this->Demandeur_model->delete($id_dossier, $id_demandeur);

		if ($result) {
			echo json_encode(['success' => true]);
		} else {
			echo json_encode(['success' => false, 'message' => "Impossible de supprimer le demandeur."]);
		}
	}
}
