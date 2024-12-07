<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Avis_Model extends CI_Model {

    public function getDossiersValides()
    {
        $query = $this->db->where('etat', 'valide')->get('dossier');
        return $query->result();
    }
	// ! ajout d'un avis sur un dossier
	public function ajouter_avis($data) {
        // Insérer les données dans la table 'avis'
        $this->db->insert('avis', $data);
        // Récupérer et retourner le dernier ID inséré
        return $this->db->insert_id();
    }
	// ! Suppression des avis d'un dossier
	public function deleteAvis($id)
    {
		$this->db->where('id_avis', $id);
        return $this->db->delete('avis');
    }
	//! recuperation des avis d'un dossier
	public function getAvisByDossier($idDossier)
    {
        $this->db->where('id_dossier', $idDossier);
        return $this->db->get('avis')->result_array();
    }
}
