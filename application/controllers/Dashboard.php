<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('M_pelanggan');
        $this->load->database();
        $this->load->helper('url');
        $this->load->library('session');  // Pastikan session dimuat

        // 🔐 Proteksi akses: cek login
        if (!$this->session->userdata('logged_in')) {
            redirect('index.php/auth/login');  // arahkan ke halaman login
        }
    }

    public function index() {
        $data['adminCount']     = $this->db->count_all('admin');
        $data['pelangganCount'] = $this->db->count_all('pelanggan');
        $data['psCount']        = $this->db->count_all('playstation');
        $data['transaksiCount'] = $this->db->count_all('transaksi');
        $data['pelanggan']      = $this->M_pelanggan->get_all();

        // Load view
        $this->load->view('templates/header');
        $this->load->view('templates/navbar');
        $this->load->view('dashboard', $data);
        $this->load->view('templates/footer');
    }
}
