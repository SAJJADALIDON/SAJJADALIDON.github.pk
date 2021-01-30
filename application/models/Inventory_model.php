<?php

class Inventory_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->db->select('*')
                ->from('inventory')
                ->join('items', 'inventory.item_id = items.item_id', 'left')
                ->join('category', 'items.cat_id = category.cat_id', 'left');
        $result = $this->db->get()->result();
        return $result;
    }

    public function get_damage_items()
    {
        $this->db->select('*')
                ->where('inventory.inventory_damage_qtt >', 0)
                ->from('inventory')
                ->join('items', 'inventory.item_id = items.item_id', 'left')
                ->join('category', 'items.cat_id = category.cat_id', 'left');
        $result = $this->db->get()->result();
        return $result;
    }

    public function item_in()
    {
        $items = $this->input->post('item', TRUE);
        $unit_price = $this->input->post('unit_price', TRUE);
        $quantity = $this->input->post('quantity', TRUE);
        $alrt_quantity = $this->input->post('alrt_quantity', TRUE);
        $inventories = $this->db->get('inventory')->result();

        $ids = '';
        $u_price = '';
        $qtt = '';
        $total_price = 0;
        foreach ($items as $key => $item) { $i = 0;
            if($items[$key] AND ($items[$key] != 0) AND (is_numeric($items[$key]))){
            if($unit_price[$key] AND ($unit_price[$key] != 0) AND (is_numeric($unit_price[$key]))){
            if($quantity[$key] AND ($quantity[$key] != 0) AND (is_numeric($quantity[$key]))){

                foreach ($inventories as $inventory) {
                    if($inventory->item_id == $items[$key]){ $i++;
                        $data['inventory_quantity'] = ($inventory->inventory_quantity + $quantity[$key]);

                        if ($alrt_quantity[$key] AND ($alrt_quantity[$key] != 0) AND (is_numeric($alrt_quantity[$key]))) {
                            $data['alert_qtt'] = $alrt_quantity[$key];
                        }

                        $data['inventory_update'] = date('Y-m-d');
                        $this->db->where('item_id', $items[$key]);
                        $this->db->update('inventory', $data);
                        break;
                    }
                }

                if (!$i) {
                    if ($alrt_quantity[$key] AND ($alrt_quantity[$key] != 0) AND (is_numeric($alrt_quantity[$key]))) {
                        $data['alert_qtt'] = $alrt_quantity[$key];
                    }
                    $data['item_id'] = $items[$key];
                    $data['inventory_quantity'] = $quantity[$key];
                    $data['inventory_added'] = date('Y-m-d');
                    $data['inventory_update'] = date('Y-m-d');
                    $this->db->insert('inventory', $data);
                }
                if ($this->db->affected_rows() == 1) {
                    $ids .= $item.',';
                    $qtt .= $quantity[$key].',';
                    $u_price .= $unit_price[$key].',';
                    $total_price = ($total_price + ($unit_price[$key] * $quantity[$key]));
                }                
            }
            }
            }
        }

        $ids = substr($ids, 0, -1);
        $u_price = substr($u_price, 0, -1);
        $qtt = substr($qtt, 0, -1);

        $info['supplier_id'] = $this->input->post('supplier', TRUE);
        $info['item_ids'] = $ids;
        $info['unit_prices'] = $u_price;
        $info['quantities'] = $qtt;
        $info['total_price'] = $total_price;
        $info['user_id'] = $this->session->userdata('user_id');
        $info['note'] = addslashes($this->input->post('note', TRUE));
        $info['date'] = date('Y-m-d');
        if($this->db->insert('invoice_purchase', $info)){
            return TRUE;
        }else{
            return FALSE;
        }
    }

    public function item_out()
    {
        $items = $this->input->post('item', TRUE);
        $unit_price = $this->input->post('unit_price', TRUE);
        $quantity = $this->input->post('quantity', TRUE);

        $inventories = $this->db->get('inventory')->result();

        $ids = '';
        $u_price = '';
        $qtt = '';
        $total_price = 0;
        $alert_items = '';
        foreach ($items as $key => $item) {
            if($items[$key] AND ($items[$key] != 0) AND (is_numeric($items[$key]))){
            if($unit_price[$key] AND ($unit_price[$key] != 0) AND (is_numeric($unit_price[$key]))){
            if($quantity[$key] AND ($quantity[$key] != 0) AND (is_numeric($quantity[$key]))){

                foreach ($inventories as $inventory) {
                if($inventory->item_id == $items[$key]){ 
                    $data['inventory_quantity'] = ($inventory->inventory_quantity - $quantity[$key]);

                    if ($data['inventory_quantity'] < 0) {
                        continue;
                    }
                    if (($data['inventory_quantity'] == 0) AND ($inventory->inventory_damage_qtt == 0)) {
                        $this->db->where('item_id', $items[$key]);
                        $this->db->delete('inventory');
                    }

                    $data['inventory_update'] = date('Y-m-d');
                    $this->db->where('item_id', $items[$key]);
                    $this->db->update('inventory', $data);
                    if ($this->db->affected_rows() == 1) {
                        $ids .= $item.',';
                        $u_price .= $unit_price[$key].',';
                        $qtt .= $quantity[$key].',';
                        $total_price = ($total_price + ($unit_price[$key] * $quantity[$key]));
                    } else {
                        continue;
                    }
                    if ($data['inventory_quantity'] <= $inventory->alert_qtt) {
                        if($this->session->userdata('alert')){
                            $item = $this->db->get_where('items', array('item_id' => $items[$key]))->row();
                            $alert_items .= $item->item_name.',';                            
                        }
                    }
                }
                }
            }
            }
            }
        }

        if($alert_items != ''){
            $alert_items = substr($alert_items, 0, -1);

            $from = $this->session->userdata('user_email');
            $to = $this->session->userdata('alert_email');
            $suject = 'Inventory getting low!';
            $message_body = 'Hello, <br/>'
            .'The items '. $alert_items .' is getiing under the alert quantity. Please take necessary actions.<br/>'
            .'Thanks,<br/>'. $this->session->userdata('brand');

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
        }

        $ids = substr($ids, 0, -1);
        $u_price = substr($u_price, 0, -1);
        $qtt = substr($qtt, 0, -1);

        $info['warehouse_id'] = $this->input->post('warehouse', TRUE);
        $info['item_ids'] = $ids;
        $info['unit_prices'] = $u_price;
        $info['quantities'] = $qtt;
        $info['total_price'] = $total_price;
        $info['user_id'] = $this->session->userdata('user_id');
        $info['note'] = addslashes($this->input->post('note', TRUE));
        $info['date'] = date('Y-m-d');
        if($this->db->insert('invoice_out', $info)){
            return TRUE;
        }else{
            return FALSE;
        }
    }

    public function update_damage_item($operation)
    {
        $id = $this->input->post('item_id', TRUE);
        $quantity = $this->input->post('quantity', TRUE);
        $item = $this->db->get_where('inventory', array('item_id' => $id),1)->row();
        
        $info = array();
        if($operation === 'add'){
            if($item->inventory_quantity >= $quantity){
                $info['inventory_quantity'] = ($item->inventory_quantity - $quantity);
                $quantity = ($item->inventory_damage_qtt + $quantity);
            } else{
                return FALSE;
            }
        }else if($operation === 'remove'){
            if($item->inventory_damage_qtt >= $quantity){
                $info['inventory_quantity'] = ($item->inventory_quantity + $quantity);
                $quantity = ($item->inventory_damage_qtt - $quantity);
            } else{
                return FALSE;
            }
        }
        
        $info['inventory_damage_qtt'] = $quantity;
        $this->db->where('item_id', $id);
        $this->db->update('inventory', $info);
        if ($this->db->affected_rows() == 1) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
}