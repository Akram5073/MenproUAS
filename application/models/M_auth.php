<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_auth extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function register($data) {
        return $this->db->insert('admin', $data);
    }

    public function login($username, $password) {
        return $this->db->get_where('admin', [
            'username' => $username,
            'password' => $password  // Untuk keamanan, sebaiknya pakai hash
        ])->row_array();
    }
}
