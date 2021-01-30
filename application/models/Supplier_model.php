<?php

class Supplier_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function index() 
    {
        return $this->db->get('supplier')->result();
    }
    public function get_supplier_detail($id) 
    {
        return $this->db->where('supplier_id', $id)->get('supplier')->row();
    }
    
    public function save_supplier() 
    {
        $info = array();
        $info['supplier_name'] = addslashes($this->input->post('name', TRUE));
        $info['supplier_phone'] = $this->input->post('phone', TRUE);
        $info['supplier_email'] = $this->input->post('email', TRUE);
        $info['supplier_key_person'] = $this->input->post('key_person', TRUE);
        $info['supplier_address'] = addslashes($this->input->post('address', TRUE));
        $this->db->insert('supplier', $info);
        if ($this->db->affected_rows() == 1) {
            return $this->db->insert_id();
        } else {
            return FALSE;
        }
    }

    public function update_supplier($id)
    {
        if (!$this->session->userdata('role')) {
            return FALSE;
        }
        $data['supplier_name'] = $this->input->post('supplier_name', TRUE);
        $data['supplier_key_person'] = $this->input->post('supplier_key_person', TRUE);
        $data['supplier_email'] = $this->input->post('supplier_email', TRUE);
        $data['supplier_phone'] = $this->input->post('supplier_phone', TRUE);
        $data['supplier_address'] = $this->input->post('supplier_address', TRUE);

        $this->db->where('supplier_id', $id);
        $this->db->update('supplier', $data);
        if ($this->db->affected_rows() == 1) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function delete_supplier($id) 
    {
        $this->db->where('supplier_id', $id);
        $this->db->delete('supplier');
        if ($this->db->affected_rows() == 1) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
}