<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Responsable_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }
    public function getRoles() {
        $roles = array(
            array('id' => 1, 'libelle' => 'DDPF'),
            array('id' => 2, 'libelle' => 'SRD'),
            array('id' => 3, 'libelle' => 'SDC'),
            array('id' => 4, 'libelle' => 'CCDF'),
            array('id' => 5, 'libelle' => 'Guichet'),
            array('id' => 6, 'libelle' => 'Administrateur'),
        );

        return $roles;
    }

    public function get_all_responsables()
    {
        return $this->db->get('responsable')->result();
    }

    public function get_responsable_by_id($id)
    {
        return $this->db->get_where('responsable', array('id_responsable' => $id))->row();
    }

    public function add_responsable($data)
    {
        return $this->db->insert('responsable', $data);
    }

    public function update_responsable($id, $data)
    {
        $this->db->where('id_role', $id);
        return $this->db->update('responsable', $data);
    }

    public function delete_responsable($id)
    {
        return $this->db->delete('responsable', array('id_responsable' => $id));
    }
	
    public function get_total_rows() {
        return $this->db->count_all('responsable'); 
    }

	 public function get_users_with_roles() {
        $this->db->select('responsable.id_responsable, responsable.email, responsable.telephone, responsable.login, responsable.nom, responsable.prenom, responsable.fonction, role.libelle');
        $this->db->from('responsable');
        $this->db->join('role', 'responsable.id_role = role.id_role');
        $query = $this->db->get();
        return $query->result();
    }
	public function afficheprof(){
		return $this->db->get_where('responsable', array('id_responsable'=>$id))->row();
	}
	
	public function role(){
		$this->db->select('role.libelle');
		$this->db->from ('responsable');
		$this->db->join('role','responsable.id_role = role.id_role');
		$query = $this->db->get();
		return $query->result();
		
	}
	
	public function lieu($id){
            return $this->db->get_where('role', array('id_role' => $id))->row();
		
	}
       public function get_responsable_region($idregion) {
        $this->db->select('responsable.id_responsable');
        $this->db->from('responsable');
        $this->db->where('id_circonscription',null);
        $this->db->where('id_region',$idregion);
        $query = $this->db->get();
        return $query->row();
        }

}
?>


