<?php

class Login_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $query = $this->db->get_where('user', 
                array(
                    'user_email' => $this->input->post('email'), 
                    'password' => sha1($this->input->post('password'))
                    ),
                1);
        $result = $query->row();

        if ($result) {
                // echo "<pre/>"; print_r($result); exit();
            $settings = $this->db->get('settings',1)->row();

            $this->session->set_userdata('log', TRUE);
            $this->session->set_userdata('role', $result->user_role);
            $this->session->set_userdata('user_name', $result->user_full_name);
            $this->session->set_userdata('user_email', $result->user_email);
            $this->session->set_userdata('user_id', $result->user_id);
            if ($settings) {
                $this->session->set_userdata('brand', $settings->brand_name);
                $this->session->set_userdata('alert', $settings->alert_on);
                $this->session->set_userdata('alert_email', $settings->alert_email);
                $this->session->set_userdata('address', $settings->address);
                $this->session->set_userdata('phone', $settings->phone);
            }
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function register($info)
    {
        $if_exist = $this->db->get_where('users', array('user_email' => $info['user_email']), 1)
                ->result();
        if ($if_exist) {
            return FALSE;
        } else {
            $this->db->insert('users', $info);
            if ($this->db->affected_rows() == 1) {
                return TRUE;
            } else {
                return FALSE;
            }
        }
    }
}