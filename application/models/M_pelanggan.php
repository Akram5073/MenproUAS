<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_pelanggan extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    // Ambil data pelanggan dengan limit, offset dan pencarian multi-kolom
    public function get_pelanggan($limit, $offset, $search)
    {
        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like('nama', $search);
            $this->db->or_like('email', $search);
            $this->db->or_like('no_telepon', $search);
            $this->db->group_end();
        }
        return $this->db->get('pelanggan', $limit, $offset)->result_array();
    }

    // Ambil semua data pelanggan (tanpa limit/paging)
    public function get_all()
    {
        return $this->db->get('pelanggan')->result_array();
    }

    // Hitung total baris berdasarkan search
    public function count_all($search)
    {
        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like('nama', $search);
            $this->db->or_like('email', $search);
            $this->db->or_like('no_telepon', $search);
            $this->db->group_end();
        }
        return $this->db->count_all_results('pelanggan');
    }

    // Cek apakah email sudah ada
    public function cek_email($email)
    {
        return $this->db->get_where('pelanggan', ['email' => $email])->row();
    }

    // Tambah pelanggan baru
    public function tambah_pelanggan($data)
    {
        return $this->db->insert('pelanggan', $data);
    }

    // Cek apakah pelanggan punya transaksi aktif
    public function cek_transaksi_pelanggan($id_pelanggan)
    {
        $this->db->where('id_pelanggan', $id_pelanggan);
        $query = $this->db->get('transaksi');
        return $query->num_rows() > 0;
    }

    // Hapus pelanggan
    public function delete_pelanggan($id)
    {
        $this->db->where('id_pelanggan', $id);
        $this->db->delete('pelanggan');
    }

    // Ambil data pelanggan berdasarkan ID
    public function get_pelanggan_by_id($id)
    {
        return $this->db->get_where('pelanggan', ['id_pelanggan' => $id])->row_array();
    }

    // Update data pelanggan
    public function update_pelanggan($id, $data)
    {
        $this->db->where('id_pelanggan', $id);
        $this->db->update('pelanggan', $data);
    }
}
