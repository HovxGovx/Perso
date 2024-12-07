<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class cin_model extends CI_Model {
   
    
    protected $dem="demandeur";
    
    public function GetRow($keyword){  
        $sql="Select cin_demandeur as cin,id_demandeur from $this->dem where  cin_demandeur like '".$keyword."%'";        
        $query=  $this->db->query($sql);
        return $query->result();
    }
    
    public function get_dem($cin){
        $sql="Select * from $this->dem where cin_demandeur='".$cin."'";
        $query=$this->db->query($sql);
        return $query->result();
    }
    
}