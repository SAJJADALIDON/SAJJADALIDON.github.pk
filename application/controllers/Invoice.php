<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Invoice extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('invoice_model');
        $this->load->model('item_model');
        if (!$this->session->userdata('log')) {
            redirect(base_url('login'));
        }
    }
    public function index()
    {
        $data = array();
        $data['header'] = $this->load->view('header/head', '', TRUE);
        $data['navigation'] = $this->load->view('header/navigation', $data, TRUE);
        $data['purchases'] = $this->invoice_model->get_purchases();
        $data['sales'] = $this->invoice_model->get_sales();
        $data['content'] = $this->load->view('content/view_invoice', $data, TRUE);
        $data['footer'] = $this->load->view('footer/footer', '', TRUE);
        $this->load->view('main', $data);
    }

    public function view($type, $id){
        $data = array();
        $data['header'] = $this->load->view('header/head', '', TRUE);
        $data['extra_head'] = $this->load->view('header/invoice', '', TRUE);
        $data['navigation'] = $this->load->view('header/navigation', $data, TRUE);
        $data['items'] = $this->item_model->index();
        $data['invoice'] = $this->invoice_model->get_invoice_by_id($type, $id);
        if($type == 'purchase'){        
            $data['content'] = $this->load->view('content/invoice_purchase', $data, TRUE);
        }else if($type == 'sales'){
            $data['content'] = $this->load->view('content/invoice_sale', $data, TRUE);
        }
        $data['footer'] = $this->load->view('footer/footer', '', TRUE);
        $this->load->view('main', $data);

    }

    public function modify($type, $id){
        $data = array();
        $data['header'] = $this->load->view('header/head', '', TRUE);
        $data['extra_head'] = $this->load->view('header/invoice', '', TRUE);
        $data['navigation'] = $this->load->view('header/navigation', $data, TRUE);
        $data['items'] = $this->item_model->index();
        $data['invoice'] = $this->invoice_model->get_invoice_by_id($type, $id);
        if($type == 'purchase'){        
            $this->load->model('supplier_model');
            $data['suppliers'] = $this->supplier_model->index();
            $data['content'] = $this->load->view('forms/form_modify_purchase', $data, TRUE);
        }else if($type == 'sales'){
            $this->load->model('settings_model');
            $data['warehouses'] = $this->settings_model->get_warehouses();
            $data['content'] = $this->load->view('forms/form_modify_sales', $data, TRUE);
        }
        $data['footer'] = $this->load->view('footer/footer', '', TRUE);
        $this->load->view('main', $data);

    }

    public function delete($type, $id){
        if (!$this->session->userdata('role')) {
            $message = '<div class="alert alert-danger">You are not allowed to do this!</div>';
            $this->session->set_flashdata('message', $message);
            redirect(base_url('invoice'));
        }

        if (!$this->invoice_model->delete($type, $id)) {
            $message = '<div class="alert alert-danger">An ERROR occurred!</div>';
            $this->session->set_flashdata('message', $message);
            redirect(base_url('invoice'));
        } else {
            $message = '<div class="alert alert-success alert-dismissable">'
                    . '<button type="button" class="close" data-dismiss="alert" aria-hidden="TRUE">&times;</button>'
                    . 'Invoice Deleted!'
                    . '</div>';
            $this->session->set_flashdata('message', $message);
            redirect(base_url('invoice'));
        }
    }

    public function update($type, $id){
        $this->load->library('form_validation');
        if($type == 'purchase'){
            $this->form_validation->set_rules('supplier', 'Supplier', 'required');
        }else if($type == 'sales'){
            $this->form_validation->set_rules('warehouse', 'Warehouse', 'required');
        }
        if ($this->form_validation->run() != FALSE) {
            if (!$this->invoice_model->update($type, $id)) {
                $message = '<div class="alert alert-danger">An ERROR occurred!</div>';
                $this->session->set_flashdata('message', $message);
                redirect(base_url('invoice/modify/'.$type.'/'.$id));
            } else {
                $message = '<div class="alert alert-success alert-dismissable">'
                        . '<button type="button" class="close" data-dismiss="alert" aria-hidden="TRUE">&times;</button>'
                        . 'Invoice Updated Successfully!'
                        . '</div>';
                $this->session->set_flashdata('message', $message);
                redirect(base_url('invoice'));
            }
        }else{
            $this->session->set_flashdata('message', '<div class="alert alert-danger  alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="TRUE">&times;</button>'.form_error('supplier').'</div>');
            redirect(base_url('invoice/modify/'.$type.'/'.$id));
        }
    }

    public function supplier_id_check($val)
    {
        //Callback Function for form validation
        if ($val == 0) {
            $this->form_validation->set_message('supplier_id_check', 'Select supplier');
            return FALSE;
        } else {
            return TRUE;
        }
    }

}