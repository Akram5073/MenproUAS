<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_transaksi extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function get_all_transaksi() {
        $sql = "
            SELECT 
                t.id_transaksi, 
                t.id_admin,
                a.nama AS admin_nama, -- Tambah: nama admin
                p.nama AS pelanggan_nama, 
                GROUP_CONCAT(CONCAT(d.jumlah_item, ' x ', ps.kategori) SEPARATOR '<br>') AS detail_item,
                t.tanggal_sewa, 
                t.tanggal_kembali, 
                pb.tanggal_bayar,
                pb.metode_bayar,
                pb.jumlah_bayar,
                t.jaminan,  
                t.status
            FROM transaksi t
            JOIN admin a ON t.id_admin = a.id_admin
            JOIN pelanggan p ON t.id_pelanggan = p.id_pelanggan
            JOIN detail_transaksi d ON t.id_transaksi = d.id_transaksi
            JOIN playstation ps ON d.id_playstation = ps.id_playstation
            LEFT JOIN pembayaran pb ON t.id_transaksi = pb.id_transaksi
            GROUP BY t.id_transaksi
            ORDER BY t.tanggal_sewa DESC
        ";

        return $this->db->query($sql)->result();
    }
}
