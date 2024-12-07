<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CelController extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('CelModel');
		$this->load->library('layout');
	}

	public function index()
	{
		// Appel du modèle pour récupérer les utilisateurs avec leurs rôles
		$data['cel'] = $this->Responsable_model->get_users_with_roles();
		$data['username'] = $this->session->userdata('username');
		$data['libelle'] = $this->session->userdata('libelle');

		$this->load->view('responsable_list', $data);
	}
	

	public function ajouterDonnees(){
		// Récupérer les données du formulaire
		$id_dossier = $this->input->post('id_dossier');
		$date_descente = $this->input->post('date_descente');
		$consistance = $this->input->post('consistance');
		$date_mise_valeur = $this->input->post('date_mise_valeur');
		$auteur = $this->session->userdata('username');
		// Télécharger la pièce jointe
		// Configurer l'upload
		$config['upload_path'] = './assets/uploads/nouvelledemande/';
		$config['allowed_types'] = 'pdf|doc|docx|jpg|png';
		$config['max_size'] = 0; // Pas de limite de taille de fichier

		// Charger la bibliothèque d'upload avec la configuration
		$this->load->library('upload', $config);
		// Récupérer les fichiers envoyés
		$files = $_FILES['resume_pv'];

		$uploadSuccess = true;

		// Préparer chaque fichier pour l'upload
		$_FILES['resume_pv'] = array(
			'name' => $files['name'],
			'type' => $files['type'],
			'tmp_name' => $files['tmp_name'],
			'error' => $files['error'],
			'size' => $files['size']
		);

		// Initialiser la librairie d'upload pour le fichier actuel
		$this->upload->initialize($config);

		// Tenter l'upload du fichier
		if ($this->upload->do_upload('resume_pv')) {
			// Récupérer les informations du fichier uploadé
			$fileData = $this->upload->data();
			// Préparer les données à insérer
			$data_piecejointe = array(
				'id_dossier' => $id_dossier,
				'path_plan' => $fileData['file_name'] // Utiliser le nom du fichier téléchargé
			);
			$resume_pv_path = 'assets/uploads/cel/' . $fileData['file_name'];

			// Insérer chaque pièce jointe dans la base de données
			$this->load->model('Piecejointe_model');

			$piecejointe_id = $this->Piecejointe_model->insert_piecejointe($data_piecejointe);
		} else {
			// Si une erreur se produit, la variable $uploadSuccess devient false
			$uploadSuccess = false;
			$error = array('error' => $this->upload->display_errors());
			print_r($error);
		}

		$upload_data = $this->upload->data();

		// Enregistrement des données dans un tableau
		$data_cel = array(
			'id_dossier' => $id_dossier,
			'resume_pv' => $resume_pv_path,
			'consistance' => $consistance,
			'auteur' => $auteur,
			'date_mise_valeur' => $date_mise_valeur,
			'date_descente' => $date_descente,
			'resume_pv' => $resume_pv_path,
		);

		// Enregistrement des données dans la table 'cel'

		$this->CelModel->insertData($data_cel);

		// Enregistrement du fichier uploader dans la table 'piecejointes'
		$data_piecejointe = array(
			'id_dossier' => $id_dossier,
			'pathplan' => $resume_pv_path
		);

		$this->CelModel->cel($id_dossier);

		// Mise à jour de la table dossier pour ne plus être "en attente"
		$this->load->model('Dossier_model');
		$dossier_id = $this->Dossier_model->cel($id_dossier);

		// Rediriger vers une page de succès ou autre
		redirect('Main/data1');
	}
	public function obtenirDossiersJSON()
	{
		$dossiers = $this->CelModel->obtenirDossiers();
		echo json_encode($dossiers);
	}
	public function chargerDonneesAjax()
	{
		$filtre = $this->input->post('filtre');
		$this->load->model('CelModel');
		$data['donnees'] = $this->CelModel->chargerDonneesAvecFiltre($filtre);
		echo json_encode($data['donnees']);
	}

	public function modifierDonneesCel()
	{
		$data = array(
			'date_descente' => $this->input->post('date_descente'),
			'resume_pv' => $this->input->post('resume_pv'),
			'consistance' => $this->input->post('consistance'),
			'auteur' => $this->input->post('auteur'),
			'date_mise_valeur' => $this->input->post('date_mise_valeur'),
			'opposition' => ('non'),
			'empietement' => ('non'),
		);

		$idcel = $this->input->post('idcel');

		$this->CelModel->modifierDonneesCel($idcel, $data);

		// Rediriger vers la page des détails du CEL après la modification
		redirect('CelController/afficherFormulaire');
	}

	public function getDetails($iddossier)
	{
		try {
			$this->load->model('CelModel');
			$don = $this->CelModel->chargerdonnees($iddossier);
			echo json_encode($don);
		} catch (Exception $e) {
			//Erreur
			$error = $e->getMessage();
			$this->output->set_status_header(500);
			echo json_encode(array('error' => $error));
		}
	}
}
