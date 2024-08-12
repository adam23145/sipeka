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
        $this->db->select('id, nim, judul_sidang, nama_mahasiswa, tanggal_sidang, tempat_sidang, status');
        $this->db->from('pengajuan_sidang');

        $this->db->where('status', 1);
        if ($search) {
            $this->db->like('LOWER(nama_mahasiswa)', strtolower($search));
        }

        // Order by `id` in descending order
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
}
