<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Transaksi_model extends CI_Model
{
    public function show_data($table)
    {
        $result = $this->db->order_by('id', 'desc')->get_where($table);
        if ($result->num_rows() > 0) {
            return $result->result();
        } else {
            return false;
        }
    }

    public function dashboard_data($table)
    {
        $result = $this->db->order_by('id', 'desc')->get_where($table);
        if ($result->num_rows() > 0) {
            return $result->num_rows();
        } else {
            return false;
        }
    }

    public function get_id_invoice($id_invoice)
    {
        $result = $this->db->where('id', $id_invoice)
                           ->limit(1)
                           ->get('tbl_invoice');
        if ($result->num_rows() > 0) {
            return $result->row();
        } else {
            return false;
        }
    }

    public function get_id_pesanan($id_invoice)
    {
        $result = $this->db->where('id_invoice', $id_invoice)
                           ->get('tbl_pesanan');
        if ($result->num_rows() > 0) {
            return $result->result();
        } else {
            return false;
        }
    }
}

/* End of file Transaksi_model.php */
