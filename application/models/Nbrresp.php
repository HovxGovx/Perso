<?php
class Nbrresp extends CI_Model {

    public function get_total_rows() {
        return $this->db->count_all('responsable'); // Remplacez 'votre_table' par le nom de votre table
    }

}
?>
