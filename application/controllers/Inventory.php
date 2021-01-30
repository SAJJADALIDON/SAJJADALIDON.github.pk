<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Inventory extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('inventory_model');
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
        $data['inventory'] = $this->inventory_model->index();
        $data['content'] = $this->load->view('content/view_inventory', $data, TRUE);
        $data['footer'] = $this->load->view('footer/footer', '', TRUE);
        $this->load->view('main', $data);
    }

    public function item_in()
    {
        if (!$this->session->userdata('role')) {
            $message = '<div class="alert alert-danger">You are not allowed to do this!</div>';
            $this->session->set_flashdata('message', $message);
            redirect(base_url('inventory'));
        }
        if($this->input->post()){
            $this->load->library('form_validation');
            $this->form_validation->set_rules('unit_price[1]', 'Unit Price', 'required|numeric');
            $this->form_validation->set_rules('quantity[1]', 'Quantity', 'required|integer');
            $this->form_validation->set_rules('supplier', 'Supplier', 'required');
            if ($this->form_validation->run() != FALSE) {
                if (!$this->inventory_model->item_in()) {
                    $message = '<div class="alert alert-danger">An ERROR occurred!</div>';
                    $this->session->set_flashdata('message', $message);
                    redirect(base_url('inventory/item_in'));
                } else {
                    $message = '<div class="alert alert-success alert-dismissable">'
                            . '<button type="button" class="close" data-dismiss="alert" aria-hidden="TRUE">&times;</button>'
                            . 'Inventory Updated Successfully!'
                            . '</div>';
                    $this->session->set_flashdata('message', $message);
                    redirect(base_url('inventory'));
                }
            }
        }
        
        $this->load->model('supplier_model');
        $data = array();
        $data['header'] = $this->load->view('header/head', '', TRUE);
        $data['navigation'] = $this->load->view('header/navigation', $data, TRUE);
        $data['suppliers'] = $this->supplier_model->index();
        $data['items'] = $this->item_model->get_items();
        $data['content'] = $this->load->view('forms/form_item_in', $data, TRUE);
        $data['footer'] = $this->load->view('footer/footer', '', TRUE);
        $this->load->view('main', $data);
    }
    
    public function item_out()
    {
        if (!$this->session->userdata('role')) {
            $message = '<div class="alert alert-danger">You are not allowed to do this!</div>';
            $this->session->set_flashdata('message', $message);
            redirect(base_url('inventory'));
        }
        if($this->input->post()){
            $this->load->library('form_validation');
            $this->form_validation->set_rules('unit_price[1]', 'Unit Price', 'required|numeric');
            $this->form_validation->set_rules('quantity[1]', 'Quantity', 'required|integer');
            $this->form_validation->set_rules('warehouse', 'Warehouse', 'required');
            if ($this->form_validation->run() != FALSE) {
                if (!$this->inventory_model->item_out()) {
                    $message = '<div class="alert alert-danger">An ERROR occurred!</div>';
                    $this->session->set_flashdata('message', $message);
                    redirect(base_url('inventory/item_out'));
                } else {
                    $message = '<div class="alert alert-success alert-dismissable">'
                            . '<button type="button" class="close" data-dismiss="alert" aria-hidden="TRUE">&times;</button>'
                            . 'Inventory Updated Successfully!'
                            . '</div>';
                    $this->session->set_flashdata('message', $message);
                    redirect(base_url('inventory'));
                }
            }
        }
        $this->load->model('settings_model');
        $data = array();
        $data['header'] = $this->load->view('header/head', '', TRUE);
        $data['navigation'] = $this->load->view('header/navigation', $data, TRUE);
        $data['items'] = $this->inventory_model->index();
        $data['warehouses'] = $this->settings_model->get_warehouses();
        $data['content'] = $this->load->view('forms/form_item_out', $data, TRUE);
        $data['footer'] = $this->load->view('footer/footer', '', TRUE);
        $this->load->view('main', $data);
    }
    
    public function damage_items() 
    {
        $data = array();
        $data['header'] = $this->load->view('header/head', '', TRUE);
        $data['navigation'] = $this->load->view('header/navigation', $data, TRUE);
        $data['damage_items'] = $this->inventory_model->get_damage_items();
        $data['content'] = $this->load->view('content/view_damage_items', $data, TRUE);
        $data['footer'] = $this->load->view('footer/footer', '', TRUE);
        $this->load->view('main', $data);
    }

    public function update_damage_item($operation = 'add')
    {
        if (!$this->session->userdata('role')) {
            $message = '<div class="alert alert-danger">You are not allowed to do this!</div>';
            $this->session->set_flashdata('message', $message);
            redirect(base_url('inventory'));
        }
       if($this->input->post()){
            $this->load->library('form_validation');
            $this->form_validation->set_rules('quantity', 'Quantity', 'required|integer');
            $this->form_validation->set_rules('item_id', 'Item', 'required|integer');
            if ($this->form_validation->run() != FALSE) {
                if (!$this->inventory_model->update_damage_item($operation)) {
                    $message = '<div class="alert alert-danger">An ERROR occurred!</div>';
                    $this->session->set_flashdata('message', $message);
                    redirect(base_url('inventory/damage_items'));
                } else {
                    $message = '<div class="alert alert-success alert-dismissable">'
                            . '<button type="button" class="close" data-dismiss="alert" aria-hidden="TRUE">&times;</button>'
                            . 'Inventory Updated Successfully!'
                            . '</div>';
                    $this->session->set_flashdata('message', $message);
                    redirect(base_url('inventory/damage_items'));
                }
            }
        }
        $data = array();
        $data['header'] = $this->load->view('header/head', '', TRUE);
        $data['navigation'] = $this->load->view('header/navigation', $data, TRUE);
        
        if($operation === 'add'){
            $data['items'] = $this->inventory_model->index();
            $data['content'] = $this->load->view('forms/form_add_damage_item', $data, TRUE);
        }else if($operation === 'remove'){
            $data['items'] = $this->inventory_model->get_damage_items();
            $data['content'] = $this->load->view('forms/form_remove_damage_item', $data, TRUE);
        }else{
            show_404();
        }
        $data['footer'] = $this->load->view('footer/footer', '', TRUE);
        $this->load->view('main', $data);
    }
    
    public function warehouse_id_check($val)
    {
        //Callback Function for form validation
        if ($val == 0) {
            $this->form_validation->set_message('warehouse_id_check', 'Select warehouse.');
            return FALSE;
        } else {
            return TRUE;
        }
    }
    public function supplier_id_check($val)
    {
        //Callback Function for form validation
        if ($val == 0) {
            $this->form_validation->set_message('supplier_id_check', 'Select supplier.');
            return FALSE;
        } else {
            return TRUE;
        }
    }
    public function item_id_check($val)
    {
        //Callback Function for form validation
        if ($val == 0) {
            $this->form_validation->set_message('supplier_item_id_check', 'Select item.');
            return FALSE;
        } else {
            return TRUE;
        }
    }
    
}