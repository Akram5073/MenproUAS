<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('M_pelanggan');
        $this->load->database();
        $this->load->helper('url');
    }

    public function index() {
        $data['adminCount']     = $this->db->count_all('Admin');
        $data['pelangganCount'] = $this->db->count_all('Pelanggan');
        $data['psCount']        = $this->db->count_all('Playstation');
        $data['transaksiCount'] = $this->db->count_all('Transaksi');
        $data['pelanggan']      = $this->M_pelanggan->get_all();
        
        // Load view dengan template
        $this->load->view('templates/header');
        $this->load->view('templates/navbar');
        $this->load->view('dashboard', $data);
        $this->load->view('templates/footer');
    }
}
