<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pembayaran extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('M_pembayaran');
        $this->load->helper(['url', 'form']);
        $this->load->library('session');
    }

    public function index() {
        $data['transaksi'] = $this->M_pembayaran->get_transaksi_belum_lunas();
        $data['jumlah_bayar'] = $this->session->flashdata('jumlah_bayar') ?? '';
        $data['denda'] = $this->session->flashdata('denda') ?? '';
        $data['success'] = '';
        $data['error'] = '';

        $data['jumlah_bayar'] = $this->session->flashdata('jumlah_bayar') ?? '';
        $data['denda'] = $this->session->flashdata('denda') ?? '';
        $data['id_transaksi'] = $this->session->flashdata('id_transaksi') ?? '';
        $data['tanggal_bayar'] = $this->session->flashdata('tanggal_bayar') ?? '';
        $data['metode_bayar'] = $this->session->flashdata('metode_bayar') ?? '';

        if ($this->input->post()) {
            $id_transaksi = $this->input->post('id_transaksi');
            $tanggal_bayar = $this->input->post('tanggal_bayar');
            $metode_bayar = $this->input->post('metode_bayar');

            if ($this->input->post('calculate')) {
                $result = $this->hitung_pembayaran_custom($id_transaksi, $tanggal_bayar);

                $this->session->set_flashdata('jumlah_bayar', $result['total_bayar']);
                $this->session->set_flashdata('denda', $result['denda']);
                $this->session->set_flashdata('id_transaksi', $id_transaksi);
                $this->session->set_flashdata('tanggal_bayar', $tanggal_bayar);
                $this->session->set_flashdata('metode_bayar', $metode_bayar);
                redirect('index.php/pembayaran');
            }

            if ($this->input->post('submit')) {
                $jumlah_bayar = $this->input->post('jumlah_bayar');
                $denda = $this->input->post('denda');

                $pembayaran_data = [
                    'id_transaksi' => $id_transaksi,
                    'tanggal_bayar' => $tanggal_bayar,
                    'metode_bayar' => $metode_bayar,
                    'jumlah_bayar' => $jumlah_bayar
                ];

                if ($this->M_pembayaran->insert_pembayaran($pembayaran_data)) {
                    $this->M_pembayaran->update_status_transaksi($id_transaksi, 'Lunas');

                    // ========== PENGEMBALIAN STOK ==========
                    $this->db->select('id_playstation, jumlah_item');
                    $this->db->from('detail_transaksi');
                    $this->db->where('id_transaksi', $id_transaksi);
                    $items = $this->db->get()->result_array();

                    foreach ($items as $item) {
                        $id_ps = $item['id_playstation'];
                        $jumlah = $item['jumlah_item'];

                        // Tambahkan ke stok, kurangi stok_disewa
                        $this->db->query("
                            UPDATE playstation 
                            SET stok = stok + ?, stok_disewa = GREATEST(stok_disewa - ?, 0)
                            WHERE id_playstation = ?
                        ", [$jumlah, $jumlah, $id_ps]);
                    }

                    $data['success'] = 'Pembayaran berhasil ditambahkan, status diperbarui, dan stok dikembalikan.';
                } else {
                    $data['error'] = 'Gagal menambahkan pembayaran.';
                }

                $data['jumlah_bayar'] = $jumlah_bayar;
                $data['denda'] = $denda;
            }
        }

        $this->load->view('templates/header');
        $this->load->view('templates/navbar');
        $this->load->view('pembayaran', $data);
        $this->load->view('templates/footer');
    }

    private function hitung_pembayaran_custom($id_transaksi, $tanggal_bayar) {
        $denda_per_hari = 50000;
        $data = ['total_bayar' => 0, 'denda' => 0];

        $this->db->select('t.tanggal_sewa, t.tanggal_kembali, dt.jumlah_item, ps.harga_sewa');
        $this->db->from('transaksi t');
        $this->db->join('detail_transaksi dt', 't.id_transaksi = dt.id_transaksi');
        $this->db->join('playstation ps', 'dt.id_playstation = ps.id_playstation');
        $this->db->where('t.id_transaksi', $id_transaksi);
        $query = $this->db->get();

        foreach ($query->result_array() as $row) {
            $tanggal_sewa = new DateTime($row['tanggal_sewa']);
            $tanggal_kembali = new DateTime($row['tanggal_kembali']);
            $tanggal_bayar_dt = new DateTime($tanggal_bayar);

            $durasi = $tanggal_sewa->diff($tanggal_kembali)->days;
            $harga_total = $durasi * $row['harga_sewa'] * $row['jumlah_item'];
            $keterlambatan = max(0, $tanggal_kembali->diff($tanggal_bayar_dt)->days);
            $denda = ($tanggal_bayar_dt > $tanggal_kembali) ? ($keterlambatan * $denda_per_hari) : 0;

            $data['total_bayar'] += $harga_total + $denda;
            $data['denda'] += $denda;
        }

        return $data;
    }
}
