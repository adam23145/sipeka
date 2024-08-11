<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class M_sidang extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    // Method to get all records with optional search and pagination
    public function get_all($limit, $start, $search)
    {
        $this->db->select('judul_sidang, nama_mahasiswa, nim, tanggal_sidang, tempat_sidang, status');
        $this->db->from('pengajuan_sidang');

        if ($search) {
            $this->db->group_start(); // Start grouping
            $this->db->like('LOWER(judul_sidang)', strtolower($search));
            $this->db->group_end(); // End grouping
        }

        $this->db->limit($limit, $start);
        $query = $this->db->get();
        return $query->result();
    }


    public function count_all()
    {
        return $this->db->count_all('pengajuan_sidang');
    }

    public function count_filtered($search)
    {
        $this->db->from('pengajuan_sidang');

        if ($search) {
            $this->db->like('judul_sidang', $search);
            $this->db->or_like('nama_mahasiswa', $search);
            $this->db->or_like('nim', $search);
        }

        return $this->db->count_all_results();
    }
}
