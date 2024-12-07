<?php
class Transfer_model extends CI_Model {
    public function __construct()
    {
        parent::__construct();
       
    }
    public function insert_avis($data_avis){
        $this->db->insert('avis', $data_avis);
        return $this->db->insert_id();
    }
    public function insert_transF($data_transF){
        $this->db->insert('transF', $data_transF);
    }
    public function get_all_envoi_ccdf($id){
        $this->db->where('destinataire',$id);
        return $this->db->get('transF')->result();
    }
    public function get_avis($id_avis){
        $this->db->where('id_avis',$id_avis);
        return $this->db->get('avis')->result_array();
    }
   public function envoi_ccdf(){
       $this->db->select('responsable.id_responsable');
       $this->db->from ('responsable');
       $this->db->join('','responsable.id_role = role.id_role');
       $query = $this->db->get();
		return $query->result();
   }
    
}