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

    public function insert_pembayaran($data) {
        return $this->db->insert('pembayaran', $data);
    }

    public function update_status_transaksi($id_transaksi, $status) {
        return $this->db->where('id_transaksi', $id_transaksi)->update('transaksi', ['status' => $status]);
    }
}
