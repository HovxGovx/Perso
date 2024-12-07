<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Region_model extends CI_Model {
 
    //var $column_order = array('actif','created_at','nom_user','login','tel_user','profil', null); //set column field database for datatable orderable
    //var $column_search = array('nom_courtier','representant','orias_courrier'); //set column field database for datatable searchable just firstname , lastname , address are searchable
    //var $order = array('id' => 'desc');
    public function __construct()
    {
        parent::__construct();
        $this->load->database('default', TRUE);
    }
    
    protected $table = 'service_regional';
    protected $table2 = 'circonscription';

    private function _get_datatables_query()
    {
           
        $this->db->from($this->table);
 
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
        $this->db->where('idregion',$id);
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
        $this->db->where('idregion', $id);
        $this->db->delete($this->table);
           
    }
   public function delete_circonscription($id)
    {
        $this->db->where('idregion',$id);
        $this->db->delete($this->table2);
        $this->db->join('service_regional','service_regional.idregion=circonscription.idregion','left');
    }

   public function get_list_region()
    {

        $this->db->order_by("service_regional.nomregion","asc");
        $this->db->select('service_regional.nomregion,service_regional.idregion');
        $this->db->from('service_regional');
        //$this->db->join('circonscription','circonscription.idregion=service_regional.idregion','left');
        
   
        $query = $this->db->get();
        $result = $query->result();
        
 
        $region = array();
        
        foreach ($result as $row) 
        {
            $region[0]='';
            $region[$row->idregion]=$row->nomregion;
            
        }
        return $region;
 
    }
     public function get_region($id)
    {
        $this->db->from($this->table);
        $this->db->where('idregion',$id);
        $query = $this->db->get();
        $result = $query->result();
        
 
        $region = array();
        
        foreach ($result as $row) 
        {
           // $brokers[0]='';
            $region[$row->idregion]=$row->nomregion;
            
        }
        return $region;
 
    }
    
    
    
}