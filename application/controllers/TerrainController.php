<?php
defined('BASEPATH') or exit('No direct script access allowed');

class TerrainController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Terrain_model');
        $this->load->helper('url');
    }

    // Method to retrieve a terrain by id
    public function getTerrain($id_terrain)
    {
        $terrain = $this->Terrain_model->getTerrainById($id_terrain);
        echo json_encode([
            'terrain' => $terrain
        ]);
    }

    // Method to update a terrain
    public function updateTerrain()
    {
        $json_input = file_get_contents('php://input');
        $data = json_decode($json_input, true);
        $id_terrain = $this->input->post('id_terrain');
        $data = [
            'superficie' => $this->input->post('superficie'),
            'num_titre' => $this->input->post('num_titre'),
            'num_parcelle' => $this->input->post('num_parcelle'),
            'section' => $this->input->post('section'),
            'type_terrain' => $this->input->post('type_terrain'),
            'nom_propriete' => $this->input->post('nom_propriete'),
            'canton' => $this->input->post('canton')
        ];

        $success = $this->Terrain_model->updateTerrain($id_terrain, $data);
        echo json_encode(['success' => $success]);
    }
}
