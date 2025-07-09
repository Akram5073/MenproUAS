<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_add_pelanggan extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database(); // <-- pastikan database diload
    }

    public function cek_email($email) {
        return $this->db->get_where('pelanggan', ['email' => $email])->row();
    }

    public function tambah_pelanggan($data) {
        return $this->db->insert('pelanggan', $data);
    }
}
