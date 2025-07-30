<?php
// Tambahan pada M_add_transaksi.php agar stok playstation dikurangi dan dipindahkan ke stok_disewa

class M_add_transaksi extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function simpanTransaksi($id_pelanggan, $tanggal_sewa, $tanggal_kembali, $id_playstation, $jumlah_item, $jaminan, $id_admin) {
        $this->db->trans_begin();

        try {
            // Insert transaksi utama
            $this->db->insert('transaksi', [
                'id_pelanggan' => $id_pelanggan,
                'tanggal_sewa' => $tanggal_sewa,
                'tanggal_kembali' => $tanggal_kembali,
                'status' => 'Proses',
                'jaminan' => $jaminan,
                'id_admin' => $id_admin
            ]);

            $id_transaksi = $this->db->insert_id();

            // Ambil data harga dan stok
            $this->db->where_in('id_playstation', $id_playstation);
            $query = $this->db->select('id_playstation, harga_sewa, stok, stok_disewa')->get('playstation');

            $playstation_data = [];
            foreach ($query->result_array() as $row) {
                $playstation_data[$row['id_playstation']] = $row;
            }

            // Insert detail dan update stok
            foreach ($id_playstation as $i => $id_ps) {
                $jumlah = (int) $jumlah_item[$i];
                $ps = $playstation_data[$id_ps];

                // Validasi stok cukup
                if ($jumlah > $ps['stok']) {
                    throw new Exception("Stok untuk {$ps['id_playstation']} tidak mencukupi.");
                }

                // Insert detail transaksi
                $this->db->insert('detail_transaksi', [
                    'id_transaksi' => $id_transaksi,
                    'id_playstation' => $id_ps,
                    'jumlah_item' => $jumlah,
                    'harga_sewa' => $ps['harga_sewa']
                ]);

                // Update stok dan stok_disewa
                $this->db->set('stok', 'stok - ' . $jumlah, false);
                $this->db->set('stok_disewa', 'stok_disewa + ' . $jumlah, false);
                $this->db->where('id_playstation', $id_ps);
                $this->db->update('playstation');
            }

            $this->db->trans_commit();
            return ['status' => true];

        } catch (Exception $e) {
            $this->db->trans_rollback();
            return ['status' => false, 'message' => $e->getMessage()];
        }
    }
}
