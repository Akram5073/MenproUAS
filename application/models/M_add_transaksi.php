<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_add_transaksi extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    /**
     * Simpan transaksi utama dan detail transaksi ke database
     * 
     * @param int $id_pelanggan
     * @param string $tanggal_sewa
     * @param string $tanggal_kembali
     * @param array $id_playstation
     * @param array $jumlah_item
     * @param string $jaminan
     * @return array ['status' => bool, 'message' => string (optional)]
     */
    public function simpanTransaksi($id_pelanggan, $tanggal_sewa, $tanggal_kembali, $id_playstation, $jumlah_item, $jaminan) {
        $this->db->trans_begin(); // Start transaction

        try {
            // 1. Insert transaksi utama dengan kolom jaminan
            $this->db->insert('transaksi', [
                'id_pelanggan' => $id_pelanggan,
                'tanggal_sewa' => $tanggal_sewa,
                'tanggal_kembali' => $tanggal_kembali,
                'status' => 'Proses',
                'jaminan' => $jaminan  // Tambahan kolom jaminan
            ]);

            $id_transaksi = $this->db->insert_id(); // Ambil ID transaksi baru

            // 2. Ambil harga sewa berdasarkan id_playstation
            $this->db->where_in('id_playstation', $id_playstation);
            $query = $this->db->select('id_playstation, harga_sewa')->get('playstation');

            $harga_map = [];
            foreach ($query->result_array() as $row) {
                $harga_map[$row['id_playstation']] = $row['harga_sewa'];
            }

            // 3. Insert detail transaksi untuk setiap item
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

            $this->db->trans_commit(); // Commit transaksi jika semua berhasil
            return ['status' => true];

        } catch (Exception $e) {
            $this->db->trans_rollback(); // Rollback jika error
            return ['status' => false, 'message' => $e->getMessage()];
        }
    }
}
