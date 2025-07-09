<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_pelanggan extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function get_pelanggan($limit, $offset, $search) {
        $this->db->like('nama', $search);
        return $this->db->get('Pelanggan', $limit, $offset)->result_array();
    }

    public function get_all() {
    return $this->db->get('Pelanggan')->result_array();
    }

    public function count_all($search) {
        $this->db->like('nama', $search);
        return $this->db->count_all_results('Pelanggan');
    }

    public function cek_email($email) {
        return $this->db->get_where('pelanggan', ['email' => $email])->row();
    }

    public function tambah_pelanggan($data) {
        return $this->db->insert('pelanggan', $data);
    }
}
