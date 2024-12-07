<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Demandeur_model extends CI_Model {

    var $table = 'demandeur';
    var $column_order = array('id_demandeur', 'type_demandeur', 'nom_demandeur', 'prenom_demandeur', 'email_demandeur', 'telephone');
    var $column_search = array('id_demandeur', 'type_demandeur', 'nom_demandeur', 'prenom_demandeur', 'email_demandeur', 'telephone');
    var $order = array('id_demandeur' => 'asc');

    public function __construct() {
        parent::__construct();
    }
    
    public function check_exists($cin_demandeur) {
        $this->db->where('cin_demandeur', $cin_demandeur);
        $query = $this->db->get('demandeur');
        return $query->num_rows() > 0;
    }
    public function check_exists_nom($nom) {
        $this->db->where('nom', $nom);
        $query = $this->db->get('demandeur');
        return $query->num_rows() > 0;
    }
    //Inserer demandeur 
    public function insert_demandeur($data) {
        $this->db->insert('demandeur', $data);
        return $this->db->insert_id();
    }
  
    //Obtenir la liste complète des demandeurs.
     
    function obtenir_demandeurs() {
        $query = $this->db->get($this->table);
        return $query->result();
    }
    
    //Obtenir les informations d'un demandeur par son ID.
    public function get_demandeur_by_id($id_demandeur) {
        return $this->db->get_where('demandeur', array('id_demandeur' => $id_demandeur))->row_array();
    }

    //Ajouter un nouveau demandeur.
     
    function ajouter_demandeur($data) {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    
    //Modifier les informations d'un demandeur.
     
    public function update_demandeur($id, $data) {
        $this->db->where('id_demandeur', $id);
        $this->db->update('demandeur', $data);
    }

    
    //Supprimer un demandeur par son ID.
     
    function supprimer_demandeur($id) {
        $this->db->where('id_demandeur', $id);
        $this->db->delete($this->table);
    }

    
    //Rechercher des demandeurs par nom ou prénom.
     
    function recherche($mot_cle) {
        $this->db->like('nom_demandeur', $mot_cle);
        $this->db->or_like('prenom_demandeur', $mot_cle);
        $query = $this->db->get($this->table);
        return $query->result();
    }
    //Récupérer les données pour DataTables 
     
    public function get_datatables() {
        $query = $this->db->get('demandeur');
        return $query->result();
    }
    // Effacer un demandeur relier au dossier
    public function delete($id_dossier,$id_demandeur) {
        $this->db->where('id_dossier', $id_dossier);
        $this->db->where('id_demandeur', $id_demandeur);
        $this->db->delete('demandeur_dossier');
    }
    
}
