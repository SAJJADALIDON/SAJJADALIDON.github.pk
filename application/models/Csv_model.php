<?php
 
class Csv_model extends CI_Model {
 
    function __construct() {
        parent::__construct();
 
    }
 
    function insert_csv($data) 
    {
        $this->db->insert('items', $data);
    }
}