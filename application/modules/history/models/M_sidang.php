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
    public function get_all($limit, $start, $search)
    {
        $nim = substr($this->session->userdata('logged_in')['userid'], 0, 12);
        $this->db->select('judul_sidang, nama_mahasiswa, nim, tanggal_sidang, tempat_sidang, status');
        $this->db->from('pengajuan_sidang');
        $this->db->where('nim', $nim);
    
        if ($search) {
            $this->db->group_start(); 
            $this->db->like('LOWER(judul_sidang)', strtolower($search));
            $this->db->group_end(); 
        }
    
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        return $query->result();
    }
    public function count_all()
    {
        $nim = substr($this->session->userdata('logged_in')['userid'], 0, 12);
        $this->db->from('pengajuan_sidang');
        $this->db->where('nim', $nim);
        return $this->db->count_all_results();
    }

    public function count_filtered($search)
    {
        $nim = substr($this->session->userdata('logged_in')['userid'], 0, 12);
        $this->db->from('pengajuan_sidang');
        $this->db->where('nim', $nim); 

        if ($search) {
            $this->db->group_start();
            $this->db->like('judul_sidang', $search);
            $this->db->or_like('nama_mahasiswa', $search);
            $this->db->or_like('nim', $search);
            $this->db->group_end();
        }

        return $this->db->count_all_results();
    }
}
