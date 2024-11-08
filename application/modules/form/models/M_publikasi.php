<?php
defined('BASEPATH') or exit('No direct script access allowed');

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
    public function get_all()
    {
        $this->db->distinct(); 
        $this->db->where('jabatan', 'Dosen'); 
        $query = $this->db->get('m_dosen'); 
        return $query->result();
    }
    public function check_existing($nim, $jenis_tugas_akhir)
    {
        $this->db->where('nim', $nim);
        $this->db->where('jenis_tugas_akhir', $jenis_tugas_akhir);
        $query = $this->db->get('ajuan_tugas_akhir'); // Sesuaikan nama tabel

        return $query->num_rows() > 0;
    }
}
