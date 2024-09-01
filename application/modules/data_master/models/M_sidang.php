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

    public function get_all($limit, $start, $search = null)
    {
        $this->db->select('id, nim, judul_sidang, nama_mahasiswa, tanggal_sidang, tempat_sidang, jam_mulai, jam_selesai, status');
        $this->db->from('pengajuan_sidang');

        // Filter berdasarkan status
        $this->db->where_in('status', [1, 2]);

        // Pencarian
        if ($search) {
            $this->db->like('LOWER(nama_mahasiswa)', strtolower($search));
        }
        $this->db->order_by('status', 'ASC');
        $this->db->order_by('id', 'DESC');    

        $this->db->limit($limit, $start);
        $query = $this->db->get();
        return $query->result();
    }


    public function count_all()
    {
        return $this->db->count_all('pengajuan_sidang');
    }

    public function count_filtered($search = null)
    {
        $this->db->from('pengajuan_sidang');

        $this->db->where('status', 1);
        if ($search) {
            $this->db->like('LOWER(nama_mahasiswa)', strtolower($search));
        }

        return $this->db->count_all_results();
    }
    public function get_by_id($id)
    {
        $this->db->from('pengajuan_sidang');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row();
    }

    public function update($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('pengajuan_sidang', $data);
    }
    public function get_dosen()
    {
        $this->db->select('*');
        $this->db->from('m_dosen');
        $this->db->where_in('jabatan', ['Dosen', 'Kajur', 'Wadek 1']);
        $query = $this->db->get();
        return $query->result_array();
    }
}
