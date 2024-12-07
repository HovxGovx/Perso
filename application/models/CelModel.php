<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CelModel extends CI_Model {

    public function insertData($data1) {
        $this->db->insert('cel', $data1);
    }
    public function cel($id_dossier){
    //mettre a jour la table dossier pour ne plus etre un nouvelle demande.
            $this->db->set('Etat', 'Pour Avis CCDF');
            $this->db->where('id_dossier', $id_dossier); 
            $this->db->update('dossier');
    }
    public function insertPieceJointe($data) {
        $this->db->insert('piecejointe', $data);
    }
    public function obtenirDossiers() {
        $query = $this->db->get('dossier');
        return $query->result_array();
    }
    
    // filtres les C.E.L a afficher
    public function chargerDonneesAvecFiltre($filtre) {
        $this->db->select('*');
        $this->db->from('cel');
        $this->db->join('dossier', 'dossier.id_dossier = cel.iddossier');
    
        if ($filtre) {
            $this->db->group_start();
            $this->db->like('dossier.numdossier', $filtre, 'both');
            $this->db->group_end();
        }
    
        $query = $this->db->get();
        return $query->result_array();
    }
    public function modifierDonneesCel($id, $data2) {
        $this->db->where('idcel', $id);
        $this->db->update('cel', $data2);
    }   
    // Récupère uniquement les details d'un C.E.L
    public function chargerdonnees($iddossier){  
		$this->db->where('id_dossier', $iddossier);
         return $this->db->get('cel')->result_array();
    } 
}
