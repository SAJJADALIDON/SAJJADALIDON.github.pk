<?php

class Invoice_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function get_purchases()
    {
        $this->db->select('*')
                ->from('invoice_purchase')
                ->order_by('invoice_purchase.date','desc')
                ->join('supplier', 'supplier.supplier_id = invoice_purchase.supplier_id', 'left')
                ->join('user', 'user.user_id = invoice_purchase.user_id', 'left');

        $result = $this->db->get()->result();
        return $result;
    }

    public function get_sales()
    {
        $this->db->select('*')
                ->from('invoice_out')
                ->order_by('invoice_out.date','desc')
                ->join('warehouse', 'warehouse.warehouse_id = invoice_out.warehouse_id', 'left')
                ->join('user', 'user.user_id = invoice_out.user_id', 'left');

        $result = $this->db->get()->result();
        return $result;
    }

    public function get_invoice_by_id($type, $id) 
    {
        if($type == 'purchase'){
            $this->db->select('*')
                ->from('invoice_purchase')
                ->where('invoice_id', $id)
                ->order_by('invoice_purchase.date','desc')
                ->join('supplier', 'supplier.supplier_id = invoice_purchase.supplier_id', 'left')
                ->join('user', 'user.user_id = invoice_purchase.user_id', 'left');
            $result = $this->db->get()->row();
            return $result;
        }else if($type == 'sales'){
            $this->db->select('*')
                ->from('invoice_out')
                ->where('invoice_id', $id)
                ->order_by('invoice_out.date','desc')
                ->join('warehouse', 'warehouse.warehouse_id = invoice_out.warehouse_id', 'left');
            $result = $this->db->get()->row();
            return $result;
        }
    }

    public function update($type, $id) 
    {
        $items = $this->input->post('item', TRUE);
        $unit_price = $this->input->post('unit_price', TRUE);
        $quantity = $this->input->post('quantity', TRUE);

        $ids = '';
        $u_price = '';
        $qtt = '';
        $total_price = 0;
        foreach ($items as $key => $item) { 
            if($items[$key] AND ($items[$key] != 0) AND (is_numeric($items[$key]))){
            if($unit_price[$key] AND ($unit_price[$key] != 0) AND (is_numeric($unit_price[$key]))){
            if($quantity[$key] AND ($quantity[$key] != 0) AND (is_numeric($quantity[$key]))){
                $ids .= $item.',';
                $qtt .= $quantity[$key].',';
                $u_price .= $unit_price[$key].',';
                $total_price = ($total_price + ($unit_price[$key] * $quantity[$key]));
            }else{
                return FALSE;
            }
            }else{
                return FALSE;
            }
            }
        }

        $ids = substr($ids, 0, -1);
        $u_price = substr($u_price, 0, -1);
        $qtt = substr($qtt, 0, -1);

        $info['item_ids'] = $ids;
        $info['unit_prices'] = $u_price;
        $info['quantities'] = $qtt;
        $info['total_price'] = $total_price;
        $info['user_id'] = $this->session->userdata('user_id');
        $info['note'] = $this->input->post('note', TRUE);
        $info['date'] = date('Y-m-d');

        if($type == 'purchase'){
            $info['supplier_id'] = $this->input->post('supplier', TRUE);
            $this->db->where('invoice_id', $id);
            $this->db->update('invoice_purchase', $info);
        }else if($type == 'sales'){
            $info['warehouse_id'] = $this->input->post('warehouse', TRUE);
            $this->db->where('invoice_id', $id);
            $this->db->update('invoice_out', $info);
        }

        if ($this->db->affected_rows() == 1) {
            return TRUE;
        }else{
            return FALSE;
        }

    }

    public function delete($type, $id) 
    {
        $this->db->where('invoice_id', $id);

        if($type == 'purchase'){
            $this->db->delete('invoice_purchase');
        }else if($type == 'sales'){
            $this->db->delete('invoice_out');
        }

        if ($this->db->affected_rows() == 1) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

}