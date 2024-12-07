<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Responsable extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->library('layout');
		$this->load->model('Responsable_model');
		$this->load->model('Region_model');
		$this->load->model('Circonscription_model');
		if (!$this->session->userdata('currently_logged_in')) {
			redirect('main');
		}
	}

	public function index()
	{
		// Appel du modèle pour récupérer les utilisateurs avec leurs rôles
		$data['responsables'] = $this->Responsable_model->get_users_with_roles();
		$data['id_role'] = $this->session->userdata('id_role'); 
		$data['libelle'] = $this->session->userdata('libelle');
		$data['username'] = $this->session->userdata('username');
		$this->layout->view('responsable_view', $data);
	}

	public function getRoles()
	{
		$roles = $this->Responsable_model->getRoles();
		echo json_encode($roles);
	}

	public function getRegion()
	{
		$region = $this->Region_model->get_list_region();
		echo json_encode($region);
	}

	public function view($id)
	{
		$data['id_role'] = $this->session->userdata('id_role');
		$data['libelle'] = $this->session->userdata('libelle');
		$data['username'] = $this->session->userdata('username');
		$data['responsable'] = $this->Responsable_model->get_responsable_by_id($id);
		$this->layout->view('profil', $data);
		// $this->load->view('layout/header', $data);
		// $this->load->view('profil', $data);
		// $this->load->view('layout/footer');
	}

	public function add()
	{
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$data = array(
				'id_role' => $this->input->post('id_role'),
				'email' => $this->input->post('email'),
				'telephone' => $this->input->post('telephone'),
				'login' => $this->input->post('login'),
				'mdp' => $this->input->post('mdp'),
				'nom' => $this->input->post('nom'),
				'prenom' => $this->input->post('prenom'),
				'fonction' => $this->input->post('fonction'),
				'id_region' => $this->input->post('id_region'),
				'id_circonscription' => $this->input->post('id_circonscription'),

			);
			$this->Responsable_model->add_responsable($data);
			redirect('responsable/index');
		} else {
			$data['id_role'] = $this->session->userdata('id_role');
			$data['libelle'] = $this->session->userdata('libelle');
			$data['username'] = $this->session->userdata('username'); // Charger la vue et passer les données
			$this->layout->view('responsable_ajout', $data);
		}
	}

	public function edit($id)
	{
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$data = array(
				'id_role' => $this->input->post('id_role'),
				'email' => $this->input->post('email'),
				'telephone' => $this->input->post('telephone'),
				'login' => $this->input->post('login'),
				'mdp' => $this->input->post('mdp'),
				'nom' => $this->input->post('nom'),
				'prenom' => $this->input->post('prenom')
			);

			$this->Responsable_model->update_responsable($id, $data);
			redirect('responsable/index');
		} else {
			$data['id_role'] = $this->session->userdata('id_role');
			$data['libelle'] = $this->session->userdata('libelle');
			$data['username'] = $this->session->userdata('username');
			$data['responsable'] = $this->Responsable_model->get_responsable_by_id($id);
			$this->layout->view('responsable_edit', $data);
		}
	}


	public function delete($id)
	{
		$this->Responsable_model->delete_responsable($id);
		redirect('responsable/index');
	}




	public function display_total_rows()
	{
		$total_rows = $this->Responsable_model->get_total_rows(); // Appeler la fonction du modèle

	}


	public function getLieuRoles($id)
	{
		$data = $this->Responsable_model->lieu($id);
		// Appeler la fonction du modèle
		echo json_encode($data);
	}

	public function getCirconscription($idRegionS)
	{
		$circ = $this->Circonscription_model->get_circonscription_byregion($idRegionS);
		// Si $circ contient des objets, il faut les convertir en tableau associatif
		$result = array_map(function ($row) {
			return (array) $row;  // Convertir l'objet en tableau
		}, $circ);
		echo json_encode($result);
	}
}
