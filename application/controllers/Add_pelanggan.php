<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Add_pelanggan extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_add_pelanggan');
        $this->load->library('session');
        $this->load->helper(['form', 'url']);
    }

    public function index()
    {
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $nama = trim($this->input->post('nama'));
            $alamat = trim($this->input->post('alamat'));
            $email = trim($this->input->post('email'));
            $no_telepon = trim($this->input->post('no_telepon'));

            // Validasi manual
            if (empty($nama) || empty($alamat) || empty($email) || empty($no_telepon)) {
                $this->session->set_flashdata('error', 'Semua field wajib diisi!');
            } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $this->session->set_flashdata('error', 'Email tidak valid!');
            } else if (!preg_match('/^\d+$/', $no_telepon)) {
                $this->session->set_flashdata('error', 'No telepon hanya boleh angka!');
            } else {
                if ($this->M_add_pelanggan->cek_email($email)) {
                    $this->session->set_flashdata('error', 'Email sudah terdaftar!');
                } else {
                    $data = [
                        'nama' => $nama,
                        'alamat' => $alamat,
                        'email' => $email,
                        'no_telepon' => $no_telepon
                    ];
                    if ($this->M_add_pelanggan->tambah_pelanggan($data)) {
                        $this->session->set_flashdata('success', 'Pelanggan berhasil ditambahkan!');
                        redirect('pelanggan/tambah');
                    } else {
                        $this->session->set_flashdata('error', 'Gagal menyimpan data!');
                    }
                }
            }
        }

        $this->load->view('templates/header');
        $this->load->view('templates/navbar');
        $this->load->view('add_pelanggan');
        $this->load->view('templates/footer');
    }
}
