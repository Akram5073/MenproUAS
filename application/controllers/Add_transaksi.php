<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Add_transaksi extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('M_add_transaksi');
        $this->load->model('M_pelanggan');
        $this->load->model('M_playstation');
        $this->load->helper(['url', 'form']);
        $this->load->library('session'); // Tambahkan library session
    }

    public function index() {
        // Cek apakah admin login
        if (!$this->session->userdata('logged_in')) {
            redirect('index.php/auth/login');
        }

        $data['pelanggan'] = $this->M_pelanggan->get_all();
        $data['playstation'] = $this->M_playstation->get_all_with_stock();
        $data['success'] = '';
        $data['error'] = '';

        if ($this->input->post()) {
            $id_pelanggan = $this->input->post('id_pelanggan');
            $tanggal_sewa = $this->input->post('tanggal_sewa');
            $tanggal_kembali = $this->input->post('tanggal_kembali');
            $jaminan = $this->input->post('jaminan');
            $id_playstation = $this->input->post('id_playstation');
            $jumlah_item = $this->input->post('jumlah_item');

            // Ambil id_admin dari session
            $id_admin = $this->session->userdata('id_admin');

            // Validasi input
            if (!$id_pelanggan || !$tanggal_sewa || !$tanggal_kembali || !$jaminan || empty($id_playstation) || empty($jumlah_item)) {
                $data['error'] = 'Semua field wajib diisi.';
            } else {
                $result = $this->M_add_transaksi->simpanTransaksi(
                    $id_pelanggan, $tanggal_sewa, $tanggal_kembali, $id_playstation, $jumlah_item, $jaminan, $id_admin
                );

                if ($result['status']) {
                    $data['success'] = 'Transaksi berhasil disimpan.';
                } else {
                    $data['error'] = 'Gagal menyimpan transaksi: ' . $result['message'];
                }
            }
        }

        $this->load->view('templates/header');
        $this->load->view('templates/navbar');
        $this->load->view('add_transaksi', $data);
        $this->load->view('templates/footer');
    }
}
