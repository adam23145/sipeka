<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_mbkm extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function insert($data)
    {
        return $this->db->insert('mbkm_riset', $data);
    }
    public function check_nim_exists($nim)
    {
        $this->db->where('nim', $nim);
        $this->db->where('status_pengajuan !=', 'Ditolak'); // Menambahkan kondisi status tidak 'Ditolak'
        $query = $this->db->get('mbkm_riset');

        if ($query->num_rows() > 0) {
            return true; // NIM sudah ada dan statusnya tidak 'Ditolak'
        } else {
            return false; // NIM tidak ditemukan atau statusnya 'Ditolak'
        }
    }
}
