<?php
class DossierController extends CI_Controller
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
	}

	public function index()
	{
		// Charger la liste des responsables
		$data['responsables'] = $this->Responsable_model->get_all_responsables();
		$data['id_role'] = $this->session->userdata('id_role');
		$data['libelle'] = $this->session->userdata('libelle');
		$data['username'] = $this->session->userdata('username');
		$data['totalresp'] = $this->Responsable_model->get_total_rows();
		$data['totaldossier'] = $this->Dossier_model->get_total_rows();

		$this->layout->view('transfer_dossier_view', $data);
	}
	//Suppression de dossier
	public function supprimerDossier($id_dossier)
	{
		$this->Dossier_model->supp_Dossier($id_dossier);
	}
	public function refusDossier($iddos)
	{
		$this->Dossier_model->refus_Dossier($iddos);
	}
	// ! Changer l'etat du dossier en attente de CEL
	public function convocationDossier($idDos, $dateDos)
	{
		$response = $this->Dossier_model->convocation_Dossier($idDos, $dateDos);
		//  ? Charge la vue pour afficher les dossiers pour e attnte de C.E.L
		$data['libelle'] = $this->session->userdata('libelle');
		$data['id_role'] = $this->session->userdata('id_role');
		$data['id_region'] = $this->session->userdata('id_region');
		$data['username'] = $this->session->userdata('username');
		$data['EnAttenteDossier'] = $this->Dossier_model->get_all_dossier_en_attente($this->session->userdata('id_circonscription'));
		$this->layout->view('View_dossier_guichet_EnAttente', $data);
	}
	//recuperer les dossiers admin
	public function getDossier()
	{
		$d = $this->Dossier_model->get_all_dossiers();
		echo json_encode($d);
	}
	//recuperation des dossiers pour le guichet
	public function getDossierGuichet()
	{
		$do = $this->Dossier_model->get_all_dossier_guichet();
		echo json_encode($do);
	}
	//recuperation des dossiers pour le guichet
	public function getDossierEnAttente()
	{
		$dos = $this->Dossier_model->get_all_dossier_en_attente();
		echo json_encode($dos);
	}
	//recuperation des dossiers supprimer
	public function getDossierSupp()
	{
		$dos = $this->Dossier_model->get_all_dossiers_supp();
		echo json_encode($dos);
	}
	//recuperation les dossier ccdf
	public function getDossiersCCDF()
	{
		$dossiers = $this->Dossier_model->get_all_dossiers_ccdf();
		echo json_encode($dossiers);
	}
	//recuperation du dossier
	public function getDossierEnvoiCcdf($iddossier)
	{
		$enp = $this->Dossier_model->get_all_dossiers_Envoi_Ccdf($iddossier);
		echo json_encode($enp);
	}
	//recuperation des Details du dossier
	public function getDetails($dossierId)
	{
		try {
			// Récupération des demandeurs
			$piecesjointesdossiers = $this->Dossier_model->getPdfByDossierId($dossierId);
			// Récupération des demandeurs
			$demandeurs = $this->Dossier_model->getDemandeursByDossierId($dossierId);
			// Récupération du terrain
			$terrain = $this->Dossier_model->getTerrainByDossierId($dossierId);
			// Retourner les données
			echo json_encode([
				'demandeurs' => $demandeurs,
				'terrain' => $terrain,
				'piecejointes' => $piecesjointesdossiers
			]);
		} catch (Exception $e) {
			$error = $e->getMessage();
			$this->output->set_status_header(500);
			echo json_encode(['error' => $error]);
		}
	}

	//recuperation des paths de toutes les pdf au dossier
	public function getPdf($dossierId)
	{
		try {
			//recupere le path de chaque pdf
			$pdf = $this->Dossier_model->getPdfByDossierId($dossierId);
			echo json_encode($pdf);
		} catch (Exception $e) {
			//Erreur
			$error = $e->getMessage();
			$this->output->set_status_header(500);
			echo json_encode(array('error' => $error));
		}
	}
}
