<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class M_publikasi extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function insert($data)
    {
        return $this->db->insert('ajuan_tugas_akhir', $data);
    }

    public function get_all($limit, $start, $search = null)
    {
        $nama = $this->session->userdata['logged_in']['username'];

        $this->db->limit($limit, $start);
        $this->db->where('nama_mahasiswa', $nama);

        
        if ($search) {
            $this->db->group_start(); // Memulai grup kondisi untuk LIKE
            $this->db->like('LOWER(judul_tugas_akhir)', strtolower($search));
            $this->db->or_like('LOWER(nama_mahasiswa)', strtolower($search));
            $this->db->group_end(); // Mengakhiri grup kondisi untuk LIKE
        }

        $query = $this->db->get('ajuan_tugas_akhir');
        return $query->result();
    }

    public function count_all()
    {
        $nama = $this->session->userdata['logged_in']['username'];
        $this->db->where('nama_mahasiswa', $nama);
        return $this->db->count_all_results('ajuan_tugas_akhir');
    }

    public function count_filtered($search = null)
    {
        $nama = $this->session->userdata['logged_in']['username'];
        $this->db->where('nama_mahasiswa', $nama);

       
        if ($search) {
            $this->db->group_start(); // Memulai grup kondisi untuk LIKE
            $this->db->like('LOWER(judul_tugas_akhir)', strtolower($search));
            $this->db->or_like('LOWER(nama_mahasiswa)', strtolower($search));
            $this->db->group_end(); // Mengakhiri grup kondisi untuk LIKE
        }
        
        $query = $this->db->get('ajuan_tugas_akhir');
        return $query->num_rows();
    }
}
