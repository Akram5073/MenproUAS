<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pelanggan extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('M_pelanggan');
        $this->load->helper('url');
    }

    public function index() {
        $limit = 10;
        $page = $this->input->get('page') ? (int)$this->input->get('page') : 1;
        $offset = ($page - 1) * $limit;
        $search = $this->input->get('search') ?? '';

        $data['pelanggan'] = $this->M_pelanggan->get_pelanggan($limit, $offset, $search);
        $data['total_rows'] = $this->M_pelanggan->count_all($search);
        $data['limit'] = $limit;
        $data['page'] = $page;
        $data['search'] = $search;

        $this->load->view('templates/header');
        $this->load->view('templates/navbar');
        $this->load->view('pelanggan', $data);
        $this->load->view('templates/footer');
    }
}
