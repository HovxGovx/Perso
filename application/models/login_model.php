<?php

class Login_model extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
	}
	protected $table = 'responsable';
	public function log_in_correctly()
	{
		$this->db->select($this->table);
		$this->db->from($this->table);
		$this->db->where('login', $this->input->post('username'));
		$this->db->where('mdp', $this->input->post('password'));
		$query = $this->db->get();
		if ($query->num_rows() == 1) {
			return true;
		} else {
			return false;
		}
	}

	public function roleuser() {
		// Sélectionne tous les champs de 'responsable' et uniquement 'libelle' de 'role'
		$this->db->select('responsable.*, role.*,service_regional.*');
		$this->db->from($this->table); // $this->table est 'responsable'
		$this->db->where('login', $this->input->post('username'));
		$this->db->where('mdp', $this->input->post('password'));
		$this->db->join('role', 'responsable.id_role = role.id_role');
        $this->db->join('service_regional', 'responsable.id_region = service_regional.idregion');
		$query = $this->db->get();
		return $query->result();
	}
	

	public function profuser()
	{
		$this->db->select('*');
		$this->db->from('responsable');
		$query = $this->db->get();
		return $query->result_array();
	}
}
