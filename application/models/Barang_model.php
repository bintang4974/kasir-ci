<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Barang_model extends CI_Model
{
    public function get_data($table)
    {
        $this->db->order_by('nama_barang', 'asc');
        return $this->db->get($table);
    }

    public function insert_data($data, $table)
    {
        $this->db->insert($table, $data);
    }

    public function update_data($data, $table)
    {
        $this->db->where('id_barang', $data['id_barang']);
        $this->db->update($table, $data);
    }

    public function delete_data($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }

    public function find($id)
    {
        $result = $this->db->where('id_barang', $id)
                           ->limit(1)
                           ->get('tbl_barang');
        if($result->num_rows() > 0){
            return $result->row();
        } else {
            return array();
        }
    }
}

/* End of file Barang_model.php */
