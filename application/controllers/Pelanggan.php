<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pelanggan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_pelanggan');
        $this->load->helper('url');
    }

    public function index()
    {
        $limit = 10;
        $page = $this->input->get('page') ? (int) $this->input->get('page') : 1;
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
    public function delete($id)
    {
        $this->load->model('M_pelanggan');
        $this->M_pelanggan->delete_pelanggan($id);

        // Redirect kembali dengan pesan
        redirect('index.php/pelanggan?message=Data berhasil dihapus&type=success');

    }

    public function edit($id)
    {
        $this->load->model('M_pelanggan');
        $data['pelanggan'] = $this->M_pelanggan->get_pelanggan_by_id($id);

        if (!$data['pelanggan']) {
            show_404();
        }

        $this->load->view('edit_pelanggan', $data);
    }

    public function update($id)
    {
        $this->load->model('M_pelanggan');
        $data = [
            'nama' => $this->input->post('nama'),
            'alamat' => $this->input->post('alamat'),
            'email' => $this->input->post('email'),
            'no_telepon' => $this->input->post('no_telepon')
        ];

        $this->M_pelanggan->update_pelanggan($id, $data);
        redirect('index.php/pelanggan?message=Data berhasil diperbarui&type=success');
    }

}
