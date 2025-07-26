<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('M_auth');
        $this->load->helper(['url', 'form']);
        $this->load->library('session');
    }

    public function login() {
        $data['error'] = '';

        if ($this->input->post()) {
            $username = $this->input->post('username');
            $password = $this->input->post('password');

            $user = $this->M_auth->login($username, $password);

            if ($user) {
                $this->session->set_userdata([
                    'id_admin' => $user['id_admin'],
                    'nama' => $user['nama'],
                    'logged_in' => true
                ]);
                redirect('index.php/dashboard');  // Redirect ke halaman utama
            } else {
                $data['error'] = 'Username atau password salah.';
            }
        }

        $this->load->view('auth/login', $data);
    }

    public function register() {
        $data['error'] = '';
        $data['success'] = '';

        if ($this->input->post()) {
            $nama = $this->input->post('nama');
            $username = $this->input->post('username');
            $password = $this->input->post('password');

            $insert = $this->M_auth->register([
                'nama' => $nama,
                'username' => $username,
                'password' => $password
            ]);

            if ($insert) {
                $data['success'] = 'Register berhasil. Silakan login.';
            } else {
                $data['error'] = 'Register gagal.';
            }
        }

        $this->load->view('auth/register', $data);
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect('auth/login');
    }
}
