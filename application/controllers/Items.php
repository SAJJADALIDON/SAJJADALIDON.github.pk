<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Items extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
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
        $data['items'] = $this->item_model->index();
        $data['categories'] = $this->item_model->get_categories();
        $data['content'] = $this->load->view('content/view_items', $data, TRUE);
        $data['extra_footer'] = $this->load->view('footer/x-editable_scripts', '', TRUE);
        $data['footer'] = $this->load->view('footer/footer', '', TRUE);
        $this->load->view('main', $data);
    }

    public function add_item()
    {
        if (!$this->session->userdata('role')) {
            exit('<div class="alert alert-danger">Not allowed!</div>');
        }

        if ($this->input->post()) 
        {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('item_code', 'Item Code', 'required|is_unique[items.item_code]');
            $this->form_validation->set_rules('item_name', 'Item Name', 'required');
            $this->form_validation->set_rules('category_id', 'Category', 'required');
            if ($this->form_validation->run() != FALSE) {
                $form_info = array();
                if ($_FILES['item_image']['name']) {
                    $config['upload_path'] = './item_iamages/';
                    $config['allowed_types'] = 'gif|jpg|png';
                    $config['file_name'] = $this->input->post('item_code');
                    $config['overwrite'] = TRUE;
                    $config['max_size'] = '150';
                    $config['max_width'] = '1024';
                    $config['max_height'] = '768';

                    $this->load->library('upload', $config);
                    if (!$this->upload->do_upload('item_image')) {
                        $error = array('error' => $this->upload->display_errors('<div class="alert alert-danger">', '</div>'));
                        $this->session->set_flashdata('message', $error['error']);
                        redirect(base_url('items/add_item'));
                    } else {
                        $data = array('upload_data' => $this->upload->data());
                        //Resize images
                        $this->resize_image($data['upload_data']['full_path'], $data['upload_data']['file_name']);
                        $form_info['img_info'] = $data;
                    }
                }

                $form_info['code'] = addslashes($this->input->post('item_code', TRUE));
                $form_info['description'] = addslashes($this->input->post('item_description', TRUE));
                $form_info['name'] = addslashes($this->input->post('item_name', TRUE));
                $form_info['category'] = $this->input->post('category_id', TRUE);

                if (!$this->item_model->save_item($form_info)) {
                    $message = '<div class="alert alert-danger">An ERROR occurred!</div>';
                    $this->session->set_flashdata('message', $message);
                    redirect(base_url('items/add_item'));
                } else {
                    $this->barcode($form_info['code']);
                    $message = '<div class="alert alert-success alert-dismissable">'
                            . '<button type="button" class="close" data-dismiss="alert" aria-hidden="TRUE">&times;</button>'
                            . 'Item Added Successfully!'
                            . '</div>';
                    $this->session->set_flashdata('message', $message);
                    redirect(base_url('items'));
                }
            }
        }

        $data = array();
        $data['header'] = $this->load->view('header/head', '', TRUE);
        $data['navigation'] = $this->load->view('header/navigation', $data, TRUE);
        $data['categories'] = $this->item_model->get_categories();
        $data['content'] = $this->load->view('forms/form_add_item', $data, TRUE);
        $data['footer'] = $this->load->view('footer/footer', '', TRUE);
        $this->load->view('main', $data);
    }

    public function modify($id = NULL)
    {
        if (!is_numeric($id) OR is_null($id)) {
            $message = '<div class="alert alert-danger">Not allowed!</div>';
            $this->session->set_flashdata('message', $message);
            redirect(base_url('items'));
        }

        if ($this->input->post()) {
            // echo "<pre/>"; print_r($_POST); exit();
            $this->load->library('form_validation');
            $this->form_validation->set_rules('category', 'Category', 'required');
            $this->form_validation->set_rules('item_name', 'Item Name', 'required');
            if ($this->form_validation->run() != FALSE) {
                $form_info = array();
                if ($_FILES['item_image']['name']) {
                    $config['upload_path'] = './item_iamages/';
                    $config['allowed_types'] = 'gif|jpg|png';
                    $config['file_name'] = $this->input->post('item_code');
                    $config['overwrite'] = TRUE;

                    $this->load->library('upload', $config);
                    if (!$this->upload->do_upload('item_image')) {
                        $error = array('error' => $this->upload->display_errors('<div class="alert alert-danger">', '</div>'));
                        $this->session->set_flashdata('message', $error['error']);
                        redirect(base_url('items/modify/'.$id));
                    } else {
                        $data = array('upload_data' => $this->upload->data());
                        //Resize images
                        $this->resize_image($data['upload_data']['full_path'], $data['upload_data']['file_name']);
                        $form_info['img_info'] = $data;
                    }
                }

                $form_info['description'] = addslashes($this->input->post('item_description', TRUE));
                $form_info['name'] = addslashes($this->input->post('item_name', TRUE));
                $form_info['category'] = $this->input->post('category', TRUE);
                if (!$this->item_model->update_item($form_info, $id)) {
                    $message = '<div class="alert alert-danger">An ERROR occurred!</div>';
                    $this->session->set_flashdata('message', $message);
                    redirect(base_url('items/modify/'.$id));
                } else {
                    //$this->barcode($form_info['code']);
                    $message = '<div class="alert alert-success alert-dismissable">'
                            . '<button type="button" class="close" data-dismiss="alert" aria-hidden="TRUE">&times;</button>'
                            . 'Item Added Successfully!'
                            . '</div>';
                    $this->session->set_flashdata('message', $message);
                    redirect(base_url('items'));
                }
            }
        }

        $data = array();
        $data['header'] = $this->load->view('header/head', '', TRUE);
        $data['navigation'] = $this->load->view('header/navigation', $data, TRUE);
        $data['item'] = $this->item_model->get_item_by_id($id);
        $data['content'] = $this->load->view('forms/form_modify_item', $data, TRUE);
        $data['footer'] = $this->load->view('footer/footer', '', TRUE);
        $this->load->view('main', $data);
    }


    // public function modify($id = NULL)
    // {


    //     if ($this->input->post()) {
    //         $this->load->library('form_validation');
    //         // echo "<pre/>"; print_r($_POST); exit();
    //         $this->form_validation->set_rules('item_code', 'Item Code', 'required');
    //         $this->form_validation->set_rules('category', 'Category', 'required');
    //         $this->form_validation->set_rules('item_name', 'Item Name', 'required');
    //         if ($this->form_validation->run() != FALSE) {
    //             if ($this->item_model->update_item($id)) {
    //                 // $this->barcode($form_info['code']);
    //                 $message = '<div class="alert alert-success alert-dismissable">'
    //                         . '<button type="button" class="close" data-dismiss="alert" aria-hidden="TRUE">&times;</button>'
    //                         . 'Item Updated Successfully!'
    //                         . '</div>';
    //                 if($_FILES['item_image']['name'])
    //                     $message .= $this->upload_item_image($id);

    //                 $this->session->set_flashdata('message', $message);
    //                 redirect(base_url('items'));
    //             } else {
    //                 $message = '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="TRUE">&times;</button>An ERROR occurred!</div>';
    //                 $this->session->set_flashdata('message', $message);
    //                 redirect(base_url('items/modify/'.$id));
    //             }
    //         }
    //     }


    // }


    public function view_barcodes() 
    {
        $data = array();
        $data['header'] = $this->load->view('header/head', '', TRUE);
        $data['extra_head'] = $this->load->view('header/barcode', '', TRUE);
        $data['navigation'] = $this->load->view('header/navigation', $data, TRUE);
        $data['items'] = $this->item_model->index();
        $data['content'] = $this->load->view('content/view_barcodes', $data, TRUE);
        $data['footer'] = $this->load->view('footer/footer', '', TRUE);
        $this->load->view('main', $data);
    }

    public function add_category()
    {
        $data = array();
        $data['header'] = $this->load->view('header/head', '', TRUE);
        $data['navigation'] = $this->load->view('header/navigation', $data, TRUE);
        $data['content'] = $this->load->view('forms/form_add_category', $data, TRUE);
        $data['footer'] = $this->load->view('footer/footer', '', TRUE);
        $this->load->view('main', $data);        
    }       

    public function save_category()
    {
        if (!$this->session->userdata('role')) {
            exit('<div class="alert alert-danger">Not allowed!</div>');
        }
        $this->load->library('form_validation');
        $this->form_validation->set_rules('cat_name', 'Category Name', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message', validation_errors('<div class="alert alert-danger">', '</div>'));
            redirect(base_url('items/add_category'));
        } else {
            if (!$this->item_model->save_category()) {
                $message = '<div class="alert alert-danger">An ERROR occurred!</div>';
            } else {
                $message = '<div class="alert alert-success alert-dismissable">'
                        . '<button type="button" class="close" data-dismiss="alert" aria-hidden="TRUE">&times;</button>'
                        . 'Category Added Successfully!'
                        . '</div>';
            }
            $this->session->set_flashdata('message', $message);
            redirect(base_url('items/add_item'));
        }
    }

    public function update_category()
    {
        echo ($this->item_model->update_category()) ? 'TRUE' : 'FALSE';
    }

    public function delete_category($id = '')
    {
        if (!$this->session->userdata('role') OR !is_numeric($id) OR is_null($id)) {
            exit('<div class="alert alert-danger">Not allowed!</div>');
        }
        if (!$this->item_model->delete_category($id)) {
            $message = '<div class="alert alert-danger">An ERROR occurred!</div>';
            $this->session->set_flashdata('message', $message);
            redirect(base_url('settings'));
        } else {
            $message = '<div class="alert alert-success alert-dismissable">'
                    . '<button type="button" class="close" data-dismiss="alert" aria-hidden="TRUE">&times;</button>'
                    . 'Category Deleted!'
                    . '</div>';
            $this->session->set_flashdata('message', $message);
            redirect(base_url('settings'));
        }
    }

    public function update_item()
    {
        echo ($this->item_model->update_item()) ? 'TRUE' : 'FALSE';
    }

    public function update_image()
    {
        $id = $this->input->post('item-id', TRUE);
        $item = $this->item_model->get_item_by_id($id);

        if ($_FILES['item_image']['name']) {
            $config['upload_path'] = './item_iamages/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['file_name'] = $item->item_code;
            $config['overwrite'] = TRUE;
            $config['max_size'] = '150';
            $config['max_width'] = '1024';
            $config['max_height'] = '768';

            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('item_image')) {
                $error = array('error' => $this->upload->display_errors('<div class="alert alert-danger">', '</div>'));
                $this->session->set_flashdata('message', $error['error']);
                redirect(base_url('items'));
            } else {
                $data = array('upload_data' => $this->upload->data());
                //Resize images
                $this->resize_image($data['upload_data']['full_path'], $data['upload_data']['file_name']);

                if (!$this->item_model->update_item_image($id, $data)) {
                    $message = '<div class="alert alert-danger">An ERROR occurred!</div>';
                    $this->session->set_flashdata('message', $message);
                    redirect(base_url('items'));
                } else {
                    $message = '<div class="alert alert-success alert-dismissable">'
                            . '<button type="button" class="close" data-dismiss="alert" aria-hidden="TRUE">&times;</button>'
                            . 'Image Updated Successfully!'
                            . '</div>';
                    $this->session->set_flashdata('message', $message);
                    redirect(base_url('items'));
                }
            }
        }
    }

    public function delete_item($id = NULL)
    {
        if (!$this->session->userdata('role') OR !is_numeric($id) OR is_null($id)) {
            exit('<div class="alert alert-danger">Not allowed!</div>');
        }
        if (!$this->item_model->delete_item($id)) {
            $message = '<div class="alert alert-danger">An ERROR occurred!</div>';
            $this->session->set_flashdata('message', $message);
            redirect(base_url('items'));
        } else {
            $message = '<div class="alert alert-success alert-dismissable">'
                    . '<button type="button" class="close" data-dismiss="alert" aria-hidden="TRUE">&times;</button>'
                    . 'Item Deleted!'
                    . '</div>';
            $this->session->set_flashdata('message', $message);
            redirect(base_url('items'));
        }
    }


    public function upload_item_image($id){
        $path_parts = pathinfo($_FILES['item_image']['name']);       // Get file info
        $ext_type = array('gif','jpg','jpe','jpeg','png');  // Allowed extension

        if (in_array($path_parts['extension'], $ext_type)) {
            if(move_uploaded_file($_FILES['item_image']['tmp_name'], './item_iamages/' . $id . '.jpg')){
                //Resize images
                $this->resize_image('./item_iamages/' . $id . '.jpg', $id . '.jpg');

                $message = '<div class="alert alert-success alert-dismissable">'
                        . '<button type="button" class="close" data-dismiss="alert" aria-hidden="TRUE">&times;</button>'
                        . 'Image Updated Successfully!'
                        . '</div>';
            }else{
                $message = '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="TRUE">&times;</button>An ERROR occurred!</div>';
            }
        }else{
            $message = '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="TRUE">&times;</button>File type is not allowed!</div>';
        }
        // $this->session->set_flashdata('message', $message);
        return $message;
    }

    public function resize_image($path, $file)
    {
        $config['image_library'] = 'gd2';
        $config['source_image'] = $path;
        $config['create_thumb'] = TRUE;
        $config['maintain_ratio'] = TRUE;
        $config['width'] = 75;
        $config['height'] = 50;
        $config['new_image'] = './item_iamages/' . $file;

        $this->load->library('image_lib', $config);
        $this->image_lib->resize();
    }

//Barcode generation function, using Zend library
     public function barcode($code) 
     {
        $code = strtoupper($code);
        $this->load->library('zend');
        $this->zend->load('Zend/Barcode');
        $img = Zend_Barcode::factory('code39', 'image', array('text' => $code), array())->draw();
        imagejpeg($img, 'barcodes/' . $code . '.jpg', 100);
        imagedestroy($img); 
    }
//End of Barcode generation function
    
    public function category_check($val)
    {
        //Callback Function for form validation
        if ($val == 0) {
            $this->form_validation->set_message('category_check', 'Select Category.');
            return FALSE;
        } else {
            return TRUE;
        }
    }
}