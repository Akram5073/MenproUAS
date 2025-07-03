<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('M_transaksi');
        $this->load->helper('url');
    }

    public function index() {
        $data['transaksi'] = $this->M_transaksi->get_all_transaksi();

        $this->load->view('templates/header');
        $this->load->view('templates/navbar');
        $this->load->view('transaksi', $data);
        $this->load->view('templates/footer');
    }
}
