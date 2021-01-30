<?php

class User_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function index()
    {
        return $this->db->get('user')->result();
    }
    
    public function save_user() 
    {
        $info = array();
        $info['user_full_name'] = addslashes($this->input->post('full_name', TRUE));
        $info['user_phone'] = addslashes($this->input->post('user_phone', TRUE));
        $info['user_email'] = $this->input->post('email', TRUE);
        $info['password'] = sha1($this->input->post('password', TRUE));
        $info['user_address'] = addslashes($this->input->post('user_address', TRUE));
        $info['user_role'] = $this->input->post('role', TRUE);
        $this->db->insert('user', $info);
        if ($this->db->affected_rows() == 1) {
            return $this->db->insert_id();
        } else {
            return FALSE;
        }
    }

    public function update_user()
    {
        if (!$this->session->userdata('role')) {
            return FALSE;
        }
        $name = $this->input->post('name');
        $data = array();
        $this->db->where('user_id', (int) $this->input->post('pk', TRUE));
        switch ($name) {
            case 'user_name':
                $name = $this->input->post('value', TRUE);
                if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
                    return FALSE;
                }
                $data['user_full_name'] = addslashes($name);
                break;
            case 'user_address':
                $data['user_address'] = addslashes($this->input->post('value', TRUE));
                break;
            case 'user_phone':
                $data['user_phone'] = $this->input->post('value', TRUE);
                break;
            case 'user_email':
                $email = $this->input->post('value', TRUE);
                if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
                    return FALSE;
                }
                $data['user_email'] = $email;
                break;
            case 'user_role':
                $role = $this->input->post('value', TRUE);
                if (!preg_match("/^(0|1)$/",$role)) {
                    return FALSE;
                }
                $data['user_role'] = $role;
                break;
            default:
                return FALSE;
                break;
        }
        $this->db->update('user', $data);
        if ($this->db->affected_rows() == 1) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function update_password() 
    {
        $id = $this->input->post('id', TRUE);
        $password = sha1($this->input->post('password', TRUE));
        $data = array();
        $data['password'] = $password;
        $this->db->where('user_id', $id);
        $this->db->update('user', $data);
        if ($this->db->affected_rows() == 1) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function check_user_exist($email)
    { 
        $this->db->where('user_email', $email);
        $this->db->from('user');
        $row = $this->db->count_all_results();
        if ($row) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    public function reset_password($email)
    {
        $data = array();
        $data['password'] = sha1($this->input->post('password'));
        $this->db->where('user_email', $email);
        $this->db->update('user', $data);
        if ($this->db->affected_rows() == 1) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function delete_user($id) 
    {
        $this->db->where('user_id', $id);
        $this->db->delete('user');
        if ($this->db->affected_rows() == 1) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
}