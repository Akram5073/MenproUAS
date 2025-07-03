<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pembayaran extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('M_pembayaran');
        $this->load->helper(['url', 'form']);
    }

    public function index() {
        $data['transaksi'] = $this->M_pembayaran->get_transaksi_belum_lunas();
        $data['jumlah_bayar'] = '';
        $data['denda'] = '';

        if ($this->input->post()) {
            $id_transaksi = $this->input->post('id_transaksi');
            $tanggal_bayar = $this->input->post('tanggal_bayar');
            $metode_bayar = $this->input->post('metode_bayar');

            if ($this->input->post('calculate')) {
                $result = $this->M_pembayaran->hitung_pembayaran($id_transaksi, $tanggal_bayar);
                $data['jumlah_bayar'] = $result['total_bayar'];
                $data['denda'] = $result['denda'];
            }

            if ($this->input->post('submit')) {
                $result = $this->M_pembayaran->hitung_pembayaran($id_transaksi, $tanggal_bayar);
                $jumlah_bayar = $result['total_bayar'];

                $pembayaran_data = [
                    'id_transaksi' => $id_transaksi,
                    'tanggal_bayar' => $tanggal_bayar,
                    'metode_bayar' => $metode_bayar,
                    'jumlah_bayar' => $jumlah_bayar
                ];

                if ($this->M_pembayaran->insert_pembayaran($pembayaran_data)) {
                    $this->M_pembayaran->update_status_transaksi($id_transaksi, 'Lunas');
                    $data['success'] = 'Pembayaran berhasil ditambahkan dan status diperbarui.';
                } else {
                    $data['error'] = 'Gagal menambahkan pembayaran.';
                }
            }
        }

        $this->load->view('templates/header');
        $this->load->view('templates/navbar');
        $this->load->view('pembayaran', $data);
        $this->load->view('templates/footer');
    }
}
