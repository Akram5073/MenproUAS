<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_pembayaran extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function get_transaksi_belum_lunas() {
        return $this->db->where('status !=', 'Lunas')->get('transaksi')->result_array();
    }

    public function hitung_pembayaran($id_transaksi, $tanggal_bayar) {
        $denda_per_hari = 5000;
        $data = ['total_bayar' => 0, 'denda' => 0];

        $this->db->select('ps.harga_sewa, DATEDIFF(t.tanggal_kembali, t.tanggal_sewa) AS durasi_sewa, DATEDIFF("' . $tanggal_bayar . '", t.tanggal_kembali) AS keterlambatan, dt.jumlah_item');
        $this->db->from('transaksi t');
        $this->db->join('detail_transaksi dt', 't.id_transaksi = dt.id_transaksi');
        $this->db->join('playstation ps', 'dt.id_playstation = ps.id_playstation');
        $this->db->where('t.id_transaksi', $id_transaksi);

        $query = $this->db->get();

        foreach ($query->result_array() as $row) {
            $durasi_sewa = max(0, $row['durasi_sewa']);
            $harga_total = $durasi_sewa * $row['harga_sewa'] * $row['jumlah_item'];
            $keterlambatan = max(0, $row['keterlambatan']);
            $denda = $keterlambatan * $denda_per_hari;

            $data['total_bayar'] += $harga_total + $denda;
            $data['denda'] += $denda;
        }

        return $data;
    }

    public function insert_pembayaran($data) {
        return $this->db->insert('pembayaran', $data);
    }

    public function update_status_transaksi($id_transaksi, $status) {
        return $this->db->where('id_transaksi', $id_transaksi)->update('transaksi', ['status' => $status]);
    }
}
