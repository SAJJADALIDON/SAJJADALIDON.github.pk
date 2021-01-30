<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Csv extends CI_Controller {
 
    function __construct() {
        parent::__construct();
        $this->load->model('csv_model');
//        $this->load->spark('csvimport/0.0.1');
        $this->load->library('csvimport');
//        $this->load->library('my_csv');
        $this->load->helper('download');
    }
 
    public function index() {
        $data = array();
        $data['header'] = $this->load->view('header/head', '', TRUE);
        $data['navigation'] = $this->load->view('header/navigation', $data, TRUE);
        $data['content'] = $this->load->view('forms/form_csv_upload', $data, TRUE);
        $data['footer'] = $this->load->view('footer/footer', '', TRUE);
        $this->load->view('main', $data);        
    }
 
    public function importcsv() 
    {
        $config['upload_path'] = './csv_upload/';
        $config['allowed_types'] = 'csv';
        $config['max_size'] = '2500';
        $config['overwrite'] = TRUE;
 
        $this->load->library('upload', $config);
 
        // If upload failed, display error
        if (!$this->upload->do_upload('csv_file')) {
            $message = '<div class="alert alert-danger alert-dismissable">'
                    . '<button type="button" class="close" data-dismiss="alert" aria-hidden="TRUE">&times;</button>'
                    . $this->upload->display_errors()
                    . '</div>';
            $this->session->set_flashdata('message', $message);
            redirect(base_url('csv'));
        } else {
            $file_data = $this->upload->data();

            $file_path =  './csv_upload/'.$file_data['file_name'];
            $csv_array = $this->csvimport->get_array($file_path, "", TRUE);
            // $csv_array = $this->csvimport->get_array($file_path);
            // echo "<pre/>"; print_r($csv_array); exit();

            if ($this->csvimport->get_array($file_path)) {
                $csv_array = $this->csvimport->get_array($file_path);

                foreach ($csv_array as $row) {
                    $insert_data = array(
                        'item_code'=>$row['item_code'],
                        'cat_id'=>$row['cat_id'],
                        'item_name'=>$row['item_name'],
                        'item_description'=>$row['item_description'],
                    );
                    
                    $this->barcode($insert_data['item_code']);
                    $this->csv_model->insert_csv($insert_data);
                }
                $message = '<div class="alert alert-success alert-dismissable">'
                        . '<button type="button" class="close" data-dismiss="alert" aria-hidden="TRUE">&times;</button>'
                        . "Csv Data Imported Succesfully"
                        . '</div>';
                $this->session->set_flashdata('message', $message);
                redirect(base_url('csv'));
            } else { 
                $message = '<div class="alert alert-danger alert-dismissable">'
                        . '<button type="button" class="close" data-dismiss="alert" aria-hidden="TRUE">&times;</button>'
                        . "Error occured"
                        . '</div>';
                $this->session->set_flashdata('message', $message);
                redirect(base_url('csv'));
            }
        }
 
    } 

    public function download_template() 
    {
        $data = file_get_contents("csv_template/item_upload_template.csv"); // Read the file's contents
        $name = 'item_upload_template.csv';

        force_download($name, $data);
    }

    public function download_csv($table_name) 
    {
        $this->load->dbutil();
        $query = $this->db->query("SELECT * FROM ".$table_name);
        $data = $this->dbutil->csv_from_result($query); 
        $name = $table_name.'.csv';
        force_download($name, $data);
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


}