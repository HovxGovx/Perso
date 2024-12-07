<?php
class Piecejointe_model extends CI_Model {
    public function insert_piecejointe($data) {
        $this->db->insert('piecejointe', $data);
        return $this->db->insert_id();
    }
}
