
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AvisController extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		// Chargez le modèle Avis_Model
		$this->load->model('Avis_Model');
	}
	public function index()
	{
		$data['libelle'] = $this->session->userdata('libelle');
		$data['username'] = $this->session->userdata('username');
		// Vérifiez si une session est active
		if ($this->session->userdata('logged_in')) {
			afficherFormulaire();
		} else {
			// Redirigez vers la page de connexion
			redirect('Main/login');
		}
	}

	public function obtenirDossiersAvisJSON()
	{
		$this->load->model('Avis_Model');
		// Obtenez les dossiers depuis le modèle avec l'état "valide"
		$dossiers = $this->Avis_Model->getDossiersValides();

		// Convertissez les résultats en JSON
		$json = json_encode($dossiers);

		// Configurez les en-têtes pour indiquer le type de contenu JSON
		$this->output
			->set_content_type('application/json')
			->set_output($json);
	}
	public function AjoutAvis()
	{
		$id_dossier = $this->input->post('id_dossierSS');
		$auteur = $this->input->post('auteurSS');
		$avis = $this->input->post('avisSS');
		$prix = $this->input->post('prixSS');
		$mod_attr = $this->input->post('Mod_AttrSS');

		// Insérer dans la base de données
		$data = [
			'avis' => $avis,
			'Mod_Attr' => $mod_attr,
			'prix' => $prix,
			'auteur' => $auteur,
			'id_dossier' => $id_dossier,
		];
		// Appeler le modèle pour insérer l'avis
		$id_avis = $this->Avis_Model->ajouter_avis($data);
		// Vérifier si l'insertion a réussi
		if ($id_avis) {
			// Retourner une réponse JSON avec l'ID inséré
			echo json_encode($id_avis);
		} else {
			// En cas d'échec, retourner une réponse JSON avec une erreur
			echo json_encode(['success' => false, 'message' => 'Erreur lors de l\'ajout de l\'avis']);
		}
	}
	public function deleteAvis()
	{
		$idAvis = $this->input->post('id'); // Récupérer l'ID envoyé via AJAX


		$model  = $this->Avis_Model;

		try {
			if ($model->deleteAvis($idAvis)) {
			// En cas d'e success, retourner une réponse JSON avec une erreur
			echo json_encode(['success' => true, 'message' => 'Suppression ok']);
			} else {
			// En cas d'échec, retourner une réponse JSON avec une erreur
			echo json_encode(['success' => false, 'message' => 'Erreur lors de la suppression de l\'avis']);
			}
		} catch (\Exception $e) {
			return $this->response->setJSON([
				'success' => false,
				'message' => 'Erreur : ' . $e->getMessage()
			]);
		}
	}
	public function getAvisByDossier()
	{
		$idDossier =  $this->input->post('id_dossierSS'); // Récupérer l'ID du dossier


		$model = new Avis_Model();

		try {
			$avis = $model->getAvisByDossier($idDossier);
			echo json_encode($avis);
		} catch (\Exception $e) {
			echo json_encode([
				'success' => false,
				'message' => 'Erreur : ' . $e->getMessage()
			]);
		}
	}
}
