<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_playstation extends CI_Model {
    public function get_all_with_stock() {
        return $this->db->select('id_playstation, kategori, harga_sewa, stok')
                    ->from('playstation')
                    ->get()
                    ->result_array();
    }
}
