<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Laporan extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function get_pendapatan_bulanan() {
        return $this->db->query("
            SELECT 
                MONTHNAME(tanggal_bayar) AS bulan, 
                SUM(jumlah_bayar) AS total_pendapatan 
            FROM pembayaran
            GROUP BY MONTH(tanggal_bayar)
            ORDER BY MONTH(tanggal_bayar)
        ")->result_array();
    }

    public function get_agregasi_pendapatan() {
        return $this->db->query("
            SELECT 
                AVG(total_pendapatan) AS rata_rata,
                MIN(total_pendapatan) AS pendapatan_terendah,
                MAX(total_pendapatan) AS pendapatan_tertinggi
            FROM (
                SELECT 
                    MONTHNAME(tanggal_bayar) AS bulan,
                    SUM(jumlah_bayar) AS total_pendapatan
                FROM pembayaran
                GROUP BY MONTH(tanggal_bayar)
            ) AS subquery
        ")->row_array();
    }
}
