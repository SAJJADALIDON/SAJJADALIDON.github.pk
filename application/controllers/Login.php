<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->model('login_model');
        // $this->load->library('session');
        if ($this->session->userdata('log')) {
            $this->session->sess_destroy();
        }
    }
    
    public function index()
    {
        if ($_POST) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
            $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
            if ($this->form_validation->run() != FALSE) {
                if ($this->login_model->index()) {
                    // echo "<pre/>"; print_r($this->session->userdata()); exit();
                    redirect(base_url('inventory'));
                } else {
                    $message = '<div class="alert alert-danger">User Email/Password is not correct!</div>';
                    $this->session->set_flashdata('message', $message);
                    redirect(base_url('login'));
                }
            }
        }
        $data = array();
        $data['header'] = $this->load->view('header/head', '', TRUE);
        $data['footer'] = $this->load->view('footer/footer', '', TRUE);
        $data['content'] = $this->load->view('forms/login_form', $data, TRUE);
        $this->load->view('main', $data);
    }
    
    public function password_recovery()
    {
        if ($_POST) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('email', 'Email Address', 'required|valid_email|xss_clean');
            if ($this->form_validation->run() == TRUE) {
                $email = $this->input->post('email');
                if ($this->user_model->check_user_exist($email)) {
                    $mysecret = 'galua.mugda';
                    $key = sha1($mysecret . $email);
                    $from = 'no_reply@example.com';
                    $to = $email;
                    $suject = 'Password reset request ';
                    $message_body = 'Click the link below to reset your password .<br/> '
                            . anchor(base_url('login/reset_password/') . '?user=' . $email . '&key=' . $key, 'Password reset from here.');
                    $config = Array(
                        'mailtype' => 'html',
                        'charset' => 'iso-8859-1',
                        'wordwrap' => TRUE
                    );
                    $this->load->library('email', $config);
                    $this->email->set_newline("\r\n");
                    $this->email->from($from);
                    $this->email->to($to);
                    $this->email->subject($suject);
                    $this->email->message($message_body);
                    if ($this->email->send()) {
                        $message = '<div class="alert alert-danger">Password reset link sent to your email address! Check the junk folder also.</div>';
                    } else {
                        $message = '<div class="alert alert-danger">An ERROR occurred! Please try again.</div>';
                    }
                } else {
                    $message = '<div class="alert alert-danger">User not exist!</div>';
                }
                $this->session->set_flashdata('message', $message);
                redirect(base_url('login/password_recovery'));
            }
        }
        $data = array();
        $data['header'] = $this->load->view('header/head', '', TRUE);
        $data['content'] = $this->load->view('forms/form_password_recovery', '', TRUE);
        $data['footer'] = $this->load->view('footer/footer', '', TRUE);
        $this->load->view('main', $data);
    }

    public function reset_password()
    {
        if ($_POST) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
            $this->form_validation->set_rules('cpassword', 'Confirm Password', 'required|matches[password]');
            if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata('message', validation_errors('<div class="alert alert-danger">', '</div>'));
                redirect(base_url('login/reset_password'));
            } else {
                $mysecret = 'galua.mugda';
                $mail = $this->input->post('mail',TRUE);
                $key = sha1($mysecret . $mail);
                if ($key == $this->input->post('key')) {
                    if ($this->user_model->reset_password($mail)) {
                        $from = 'no_reply@example.com';
                        $to = $this->input->post('mail');
                        $suject = $this->session->userdata['brand_name'] . ' password change confirmation!';
                        $message_body = 'You\'ve successfully changed your password.';
                        $config = Array(
                            'mailtype' => 'html',
                            'charset' => 'iso-8859-1',
                            'wordwrap' => TRUE
                        );
                        $this->load->library('email', $config);
                        $this->email->set_newline("\r\n");
                        $this->email->from($from);
                        $this->email->to($to);
                        $this->email->subject($suject);
                        $this->email->message($message_body);
                        $this->email->send();
                        $_POST = array();
                        $message = '<div class="alert alert-success alert-dismissable">'
                                . '<button type="button" class="close" data-dismiss="alert" aria-hidden="TRUE">&times;</button>'
                                . 'Password reset successfully!.'
                                . '</div>';
                        $this->session->set_flashdata('message', $message);
                        redirect(base_url('login'));
                    } else {
                        $message = '<div class="alert alert-danger">An ERROR occurred! Please try again.</div>';
                        $this->session->set_flashdata('message', $message);
                        redirect(base_url('login/reset_password'));
                    }
                } else {
                    exit('Invalid Key!!!');
                }
            }
        } else {
            $mysecret = 'galua.mugda';
            $key = sha1($mysecret . $this->input->get('user'));
            if ($key == $this->input->get('key')) {
                $data = array();
                $data['header'] = $this->load->view('header/head', '', TRUE);
                $data['key'] = $key;
                $data['mail'] = $this->input->get('user');
                $data['content'] = $this->load->view('forms/form_password_reset', $data, TRUE);
                $data['footer'] = $this->load->view('footer/footer', '', TRUE);
                $this->load->view('main', $data);
            } else {
                exit('Request Denied!!!');
            }
        }
    }
    
    public function logout()
    {
        //$this->session->sess_destroy();
        redirect(base_url());
    }
}