<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Transaksi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('barang_model');
        $this->load->model('transaksi_model');

        if ($this->session->userdata('hak_akses') != '1') {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">Anda belum login!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('login');
        }
    }

    public function index()
    {
        $data['title'] = 'Transaksi';
        $data['barang'] = $this->barang_model->get_data('tbl_barang')->result();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('transaksi', $data);
        $this->load->view('templates/footer');
    }

    public function tambah_keranjang($id)
    {
        $barang = $this->barang_model->find($id);
        $data = array(
            'id'      => $barang->id_barang,
            'qty'     => 1,
            'price'   => $barang->harga_barang,
            'name'    => $barang->nama_barang,
        );

        $this->cart->insert($data);
        redirect('transaksi');
    }

    public function hapus_keranjang()
    {
        $this->cart->destroy();
        redirect('transaksi');
    }

    public function tambah_aksi()
    {
        date_default_timezone_set('Asia/Jakarta');
        $invoice = array(
            'total_harga' => htmlspecialchars($this->input->post('total_harga')),
            'waktu_pesan' => date('Y-m-d H:i:s'),
        );
        $this->db->insert('tbl_invoice', $invoice);
        $id_invoice = $this->db->insert_id();

        foreach ($this->cart->contents() as $item) {
            $data = array(
                'id_invoice' => $id_invoice,
                'id_barang' => $item['id'],
                'nama_barang' => $item['name'],
                'jumlah' => $item['qty'],
                'harga_barang' => $item['price'],
                'total_bayar' => htmlspecialchars($this->input->post('total_bayar')),
                'kembalian' => htmlspecialchars($this->input->post('kembalian')),
            );
            $this->db->insert('tbl_pesanan', $data);
        }
        redirect('transaksi/checkout');
        return true;
    }

    public function checkout()
    {
        $this->cart->destroy();
        $data['title'] = 'Checkout';
        $data['checkout'] = $this->transaksi_model->show_data('tbl_invoice');

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('checkout', $data);
        $this->load->view('templates/footer');
    }

    public function detail_checkout($id_invoice)
    {
        $data['title'] = 'Detail Pesanan';
        $data['checkout'] = $this->transaksi_model->show_data('tbl_invoice');
        $data['invoice'] = $this->transaksi_model->get_id_invoice($id_invoice);
        $data['pesanan'] = $this->transaksi_model->get_id_pesanan($id_invoice);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('detail_checkout', $data);
        $this->load->view('templates/footer');
    }

    public function print($id_invoice)
    {
        $data['invoice'] = $this->transaksi_model->get_id_invoice($id_invoice);
        $data['pesanan'] = $this->transaksi_model->get_id_pesanan($id_invoice);
        $this->load->view('print_checkout', $data);
    }

    public function _rules()
    {
        $this->form_validation->set_rules('total_harga', 'Total Harga', 'required', [
            'required' => '%s harus diisi !!'
        ]);
        $this->form_validation->set_rules('total_bayar', 'Total Bayar', 'required', [
            'required' => '%s harus diisi !!'
        ]);
        $this->form_validation->set_rules('kembalian', 'Kembalian', 'required', [
            'required' => '%s harus diisi !!'
        ]);
    }
}

/* End of file Transaksi.php */
