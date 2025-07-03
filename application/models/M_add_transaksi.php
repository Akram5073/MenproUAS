<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_add_transaksi extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function simpanTransaksi($id_pelanggan, $tanggal_sewa, $tanggal_kembali, $id_playstation, $jumlah_item) {
        $this->db->trans_begin();

        try {
            // Insert transaksi utama
            $this->db->insert('transaksi', [
                'id_pelanggan' => $id_pelanggan,
                'tanggal_sewa' => $tanggal_sewa,
                'tanggal_kembali' => $tanggal_kembali,
                'status' => 'Proses'
            ]);

            $id_transaksi = $this->db->insert_id();

            // Ambil harga sewa playstation berdasarkan id
            $this->db->where_in('id_playstation', $id_playstation);
            $query = $this->db->select('id_playstation, harga_sewa')->get('playstation');

            $harga_map = [];
            foreach ($query->result_array() as $row) {
                $harga_map[$row['id_playstation']] = $row['harga_sewa'];
            }

            // Insert ke detail_transaksi
            foreach ($id_playstation as $i => $id_ps) {
                $jumlah = (int) $jumlah_item[$i];
                $harga = isset($harga_map[$id_ps]) ? $harga_map[$id_ps] : 0;

                $this->db->insert('detail_transaksi', [
                    'id_transaksi' => $id_transaksi,
                    'id_playstation' => $id_ps,
                    'jumlah_item' => $jumlah,
                    'harga_sewa' => $harga
                ]);
            }

            $this->db->trans_commit();
            return ['status' => true];
        } catch (Exception $e) {
            $this->db->trans_rollback();
            return ['status' => false, 'message' => $e->getMessage()];
        }
    }
}
