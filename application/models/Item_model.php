<?php

class Item_model extends CI_Model {
    public function __construct()
    {
        parent::__construct();
    }
    
    public function index() 
    {
        $this->db->select('*')
                ->from('items')
                ->join('category', 'items.cat_id = category.cat_id','left');
        $result = $this->db->get()->result();
        return $result;
    }
    
    public function get_categories() 
    {
        return $this->db->get('category')->result();
    }
    
    public function get_items() 
    {
        return $this->db->get('items')->result();
    }
    
    public function get_item_by_id($id) 
    {
        return $this->db->get_where('items', array('item_id' => $id),1)->row();
    }
    
    public function save_item($input) 
    {
        $info = array();
        $info['item_code'] = $input['code'];
        $info['cat_id'] = $input['category'];
        $info['item_name'] = $input['name'];
        $info['item_description'] = $input['description'];
        if (isset($input['img_info'])) {
            $info['item_image_name'] = $input['img_info']['upload_data']['raw_name'];
            $info['item_image_type'] = $input['img_info']['upload_data']['file_ext'];
        }
        $this->db->insert('items', $info);
        if ($this->db->affected_rows() == 1) {
            return $this->db->insert_id();
        } else {
            return FALSE;
        }
    }
    
    public function save_category() 
    {
        $info = array();
        $info['cat_name'] = addslashes($this->input->post('cat_name', TRUE));
        
        $this->db->insert('category', $info);
        if ($this->db->affected_rows() == 1) {
            return $this->db->insert_id();
        } else {
            return FALSE;
        }
    }

    public function update_category()
    {
        if (!$this->session->userdata('role')) {
            return FALSE;
        }
        $data = array();
        $data['cat_name'] = $this->input->post('value', TRUE);

        $this->db->where('cat_id', (int) $this->input->post('pk', TRUE));
        $this->db->update('category', $data);
        if ($this->db->affected_rows() == 1) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    public function delete_category($id) 
    {
        $this->db->where('cat_id', $id);
        $this->db->delete('category');
        if ($this->db->affected_rows() == 1) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    public function update_item_image($id, $input)
    {
        $info = array();
        $info['item_image_name'] = $input['upload_data']['raw_name'];
        $info['item_image_type'] = $input['upload_data']['file_ext'];

        $this->db->where('item_id', $id);
        $this->db->update('items', $info);
        return TRUE;
    }


    public function update_item($input, $id)
    {
        $info['cat_id'] = $input['category'];
        $info['item_name'] = $input['name'];
        $info['item_description'] = $input['description'];
        if (isset($input['img_info'])) {
            $info['item_image_name'] = $input['img_info']['upload_data']['raw_name'];
            $info['item_image_type'] = $input['img_info']['upload_data']['file_ext'];
        }

        $this->db->where('item_id', $id);
        $this->db->update('items', $info);
        
        return TRUE;
    }    
    
    public function delete_item($id) 
    {
        $this->db->where('item_id', $id);
        $this->db->delete('items');
        if ($this->db->affected_rows() == 1) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
}