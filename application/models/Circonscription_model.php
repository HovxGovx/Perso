<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Circonscription_model extends CI_Model {
 
    // var $column_order = array('libelle',null); //set column field database for datatable orderable
    // var $column_search = array('libelle'); //set column field database for datatable searchable just broker_name is searchable
    // var $order = array('idcirconscription' => 'desc');
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    protected $table = 'circonscription';
    
    private function _get_datatables_query()
    {
        
        $this->db->select('service_regional.nomregion, service_regional.idregion as regionId,circonscription.*');  
        $this->db->from($this->table);
        $this->db->join('service_regional','service_regional.idregion=circonscription.idregion');
    }
 
    function get_datatables()
    {
       $this->_get_datatables_query();
       $query = $this->db->get();
       return $query->result();
    }
 
    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }
 
    public function count_all()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }
 
    public function get_by_id($id)
    {
        $this->db->from($this->table);
        $this->db->where('idcirconscription',$id);
        $query = $this->db->get();
 
        return $query->row();
    }
 
    public function save($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }
 
    public function update($where, $data)
    {
        $this->db->update($this->table, $data, $where);
        return $this->db->affected_rows();
    }
 
    public function delete_by_id($id)
    {
        $this->db->where('idcirconscription', $id);
        $this->db->delete($this->table);
    }
    
    public function delete_broker($table,$id)
    {
        $this->db->where('broker_id', $id);
        $this->db->delete($table);
    }
    public function get_circonscription_byregion($regionId)
    {

        $this->db->order_by("libelle","asc");
        $this->db->select('libelle');
        $this->db->from('circonscription');
         $this->db->where('idregion', $regionId);
        $query = $this->db->get();
		 // Récupérer les résultats sous forme d'un tableau de valeurs libellé
		 $libelles = array();
		 foreach ($query->result() as $row) {
			 $libelles[] = $row->libelle;
		 }
		 
		 return $libelles;
    }
    
     public function get_circonscription($id)
    {
        $this->db->from($this->table);
        $this->db->where('idcirconscription',$id);
        $query = $this->db->get();
        $result = $query->result();
        
 
        $region = array();
        
        foreach ($result as $row) 
        {
           // $brokers[0]='';
            $region[$row->idcirconscription]=$row->libelle;
            
        }
        return $region;
 
    }
}
