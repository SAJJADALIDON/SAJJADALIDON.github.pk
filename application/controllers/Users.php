<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Users extends CI_Controller {

    public function __construct() 
    {
        parent::__construct();
        $this->load->model('user_model');
        if (!$this->session->userdata('log')) {
            redirect(base_url('login'));
        }
    }

    public function index()
    {
        $data = array();
        $data['header'] = $this->load->view('header/head', '', TRUE);
        $data['navigation'] = $this->load->view('header/navigation', $data, TRUE);
        $data['users'] = $this->user_model->index();
        $data['content'] = $this->load->view('content/view_users', $data, TRUE);
        $data['extra_footer'] = $this->load->view('footer/x-editable_scripts', '', TRUE);
        $data['footer'] = $this->load->view('footer/footer', '', TRUE);
        $this->load->view('main', $data);
    }

    public function add_user()
    {
        if ($this->input->post()) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('full_name', 'Full Name', 'trim|required');
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_emails|is_unique[user.user_email]');
            $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]');
            $this->form_validation->set_rules('c-password', 'Confirm Password', 'trim|required|matches[password]');
            $this->form_validation->set_rules('address', 'Address', 'trim');
            $this->form_validation->set_rules('role', 'Role', 'trim|integer');
            if ($this->form_validation->run() != FALSE) {
                if (!$this->user_model->save_user()) {
                    $message = '<div class="alert alert-danger">An ERROR occurred!</div>';
                    $this->session->set_flashdata('message', $message);
                    redirect(base_url('users/add_user'));
                } else {
                    $message = '<div class="alert alert-success alert-dismissable">'
                            . '<button type="button" class="close" data-dismiss="alert" aria-hidden="TRUE">&times;</button>'
                            . 'User Added Successfully!'
                            . '</div>';
                    $this->session->set_flashdata('message', $message);
                    redirect(base_url('users'));
                }
            }
        }
        $data = array();
        $data['header'] = $this->load->view('header/head', '', TRUE);
        $data['navigation'] = $this->load->view('header/navigation', '', TRUE);
        $data['content'] = $this->load->view('forms/form_add_user', '', TRUE);
        $data['footer'] = $this->load->view('footer/footer', '', TRUE);
        $this->load->view('main', $data);
    }

    public function update_user()
    {
        echo ($this->user_model->update_user()) ? 'TRUE' : 'FALSE';
    }

    public function update_password()
    {
        if (!$this->session->userdata('role') AND !($this->session->userdata('user_id') == $this->input->post('id', TRUE))) {
            $message = '<div class="alert alert-danger">Not allowed!</div>';
            $this->session->set_flashdata('message', $message);
            redirect(base_url('users'));
        }

        $this->load->library('form_validation');
        $this->form_validation->set_rules('current-pass', 'Current Password', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]');
        $this->form_validation->set_rules('c-password', 'Confirm Password', 'trim|required|matches[password]');
        $this->form_validation->set_rules('role', 'Role', 'trim|integer');
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message', validation_errors('<div class="alert alert-danger">', '</div>'));
            redirect(base_url('users'));
        } else{
            $result = $this->db->get_where('user', array('user_id' => $this->input->post('id', TRUE)),1)->row();
            if($result->password != sha1($this->input->post('current-pass', TRUE))){
                $message = '<div class="alert alert-danger">Current Password Doesn\'t Match!</div>';
                $this->session->set_flashdata('message', $message);
                redirect(base_url('users'));
            }
            if ($this->user_model->update_password()) {
            $message = '<div class="alert alert-success alert-dismissable">'
                    . '<button type="button" class="close" data-dismiss="alert" aria-hidden="TRUE">&times;</button>'
                    . 'Password Updated Successfully!'
                    . '</div>';
            $this->session->set_flashdata('message', $message);
            redirect(base_url('users'));
            } else {
                $message = '<div class="alert alert-danger">An ERROR occurred!</div>';
                $this->session->set_flashdata('message', $message);
                redirect(base_url('users'));
            }
        }
    }

    public function delete_user($id = NULL)
    {
        if (!$this->session->userdata('role') OR !is_numeric($id) OR is_null($id)) {
            $message = '<div class="alert alert-danger">Not allowed!</div>';
            $this->session->set_flashdata('message', $message);
            redirect(base_url('users'));
        }
        if (!$this->user_model->delete_user($id)) {
            $message = '<div class="alert alert-danger">An ERROR occurred!</div>';
            $this->session->set_flashdata('message', $message);
            redirect(base_url('users'));
        } else {
            $message = '<div class="alert alert-success alert-dismissable">'
                    . '<button type="button" class="close" data-dismiss="alert" aria-hidden="TRUE">&times;</button>'
                    . 'User Deleted!'
                    . '</div>';
            $this->session->set_flashdata('message', $message);
            redirect(base_url('users'));
        }
    }
}