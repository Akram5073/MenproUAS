<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('M_Laporan');
        $this->load->helper('url');
    }

    public function index() {
        $data['pendapatan_bulanan'] = $this->M_Laporan->get_pendapatan_bulanan();
        $data['agregasi'] = $this->M_Laporan->get_agregasi_pendapatan();

        $this->load->view('templates/header');
        $this->load->view('templates/navbar');
        $this->load->view('laporan', $data);
        $this->load->view('templates/footer');
    }
}
