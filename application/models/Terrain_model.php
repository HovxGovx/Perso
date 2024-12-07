<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Terrain_model extends CI_Model
{
    public function insert_terrain($data) {
        $this->db->insert('terrain', $data);
        return $this->db->insert_id();
    }
    // Retrieve a terrain by id
    public function getTerrainById($id_terrain)
    {
        $this->db->where('id_terrain', $id_terrain);
        $query = $this->db->get('terrain');
        return $query->row_array(); // Return single row as an associative array
    }

    // Update a terrain by id
    public function updateTerrain($id_terrain, $data)
    {
        $this->db->where('id_terrain', $id_terrain);
        return $this->db->update('terrain', $data); // Returns TRUE on success
    }
}
