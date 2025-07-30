<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_playstation extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function get_stok_by_kategori($kategori) {
        $this->db->select_sum('stok');
        $this->db->where('kategori', $kategori);
        $query = $this->db->get('playstation');
        $result = $query->row();
        return $result ? $result->stok : 0;
    }
}
