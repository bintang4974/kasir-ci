<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Barang extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('barang_model');

        if ($this->session->userdata('hak_akses') != '1') {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">Anda belum login!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('login');
        }
    }

    public function index()
    {
        $data['title'] = 'Barang';
        $data['barang'] = $this->barang_model->get_data('tbl_barang')->result();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('barang', $data);
        $this->load->view('templates/footer');
    }

    public function tambah()
    {
        $data['title'] = 'Tambah Barang';

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('tambah_barang');
        $this->load->view('templates/footer');
    }

    public function tambah_aksi()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->tambah();
        } else {
            $foto_barang = $_FILES['foto_barang']['name'];
            if ($foto_barang = '') {
            } else {
                $config['upload_path'] = './assets/foto';
                $config['allowed_types'] = 'jpg|png|gif';

                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('foto_barang')) {
                    echo 'Upload Gagal!';
                    die();
                } else {
                    $foto_barang = $this->upload->data('file_name');
                }
            }

            $data = array(
                'nama_barang' => htmlspecialchars($this->input->post('nama_barang')),
                'harga_barang' => htmlspecialchars($this->input->post('harga_barang')),
                'stok_barang' => htmlspecialchars($this->input->post('stok_barang')),
                'foto_barang' => $foto_barang,
            );

            $this->barang_model->insert_data($data, 'tbl_barang');
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Data Berhasil Ditambahkan!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('barang');
        }
    }

    public function edit($id_barang)
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->index();
        } else {
            $foto_barang = $_FILES['foto_barang']['name'];
            if ($foto_barang) {
                $config['upload_path'] = './assets/foto';
                $config['allowed_types'] = 'jpg|png|gif';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('foto_barang')) {
                    $foto_barang = $this->upload->data('file_name');
                    $this->db->set('foto_barang', $foto_barang);
                } else {
                    echo $this->upload->display_errors();
                }
            }

            $data = array(
                'id_barang' => $id_barang,
                'nama_barang' => htmlspecialchars($this->input->post('nama_barang')),
                'harga_barang' => htmlspecialchars($this->input->post('harga_barang')),
                'stok_barang' => htmlspecialchars($this->input->post('stok_barang')),
                'foto_barang' => $foto_barang,
            );

            $this->barang_model->update_data($data, 'tbl_barang');
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">Data Berhasil Diubah!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('barang');
        }
    }

    public function print()
    {
        $data['barang'] = $this->barang_model->get_data('tbl_barang')->result();
        $this->load->view('print_barang', $data);
    }

    public function pdf()
    {
        $this->load->library('dompdf_gen');

        $data['barang'] = $this->barang_model->get_data('tbl_barang')->result();
        $this->load->view('laporan_barang', $data);

        $paper_size = 'A4';
        $orientation = 'potrait';
        $html = $this->output->get_output();
        $this->dompdf->set_paper($paper_size, $orientation);

        $this->dompdf->load_html($html);
        $this->dompdf->render();
        $this->dompdf->stream('laporan_barang.pdf', array('Attachment' => 0));
    }

    public function _rules()
    {
        $this->form_validation->set_rules('nama_barang', 'Nama Barang', 'required', [
            'required' => '%s harus diisi !!'
        ]);
        $this->form_validation->set_rules('harga_barang', 'Harga Barang', 'required', [
            'required' => '%s harus diisi !!'
        ]);
        $this->form_validation->set_rules('stok_barang', 'Stok Barang', 'required', [
            'required' => '%s harus diisi !!'
        ]);
    }

    public function delete($id)
    {
        $where = array('id_barang' => $id);

        $this->barang_model->delete_data($where, 'tbl_barang');
        $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">Data Berhasil Dihapus!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        redirect('barang');
    }
}

/* End of file Dashboard.php */
