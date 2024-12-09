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

    public function get_all($limit, $start, $search = null, $jurusan = null)
    {
        $this->db->select('ps.id, ps.nim, ps.judul_sidang, ps.nama_mahasiswa, ps.tanggal_sidang, ps.tempat_sidang, ps.jam_mulai, ps.jam_selesai, ps.status');
        $this->db->from('pengajuan_sidang ps');
        $this->db->join('m_mahasiswa m', 'ps.nim = m.nim', 'inner'); // Join ke tabel mahasiswa

        // Filter berdasarkan jurusan
        if ($jurusan) {
            $this->db->where('m.jurusan', $jurusan);
        }

        // Pencarian (search)
        if ($search) {
            $this->db->like('LOWER(ps.nama_mahasiswa)', strtolower($search));
        }

        // Urutkan berdasarkan status dan ID
        $this->db->order_by('ps.status', 'ASC');
        $this->db->order_by('ps.id', 'DESC');

        // Limit data untuk pagination
        $this->db->limit($limit, $start);
        $query = $this->db->get();

        return $query->result();
    }

    public function count_all($jurusan = null)
    {
        $this->db->from('pengajuan_sidang ps');
        $this->db->join('m_mahasiswa m', 'ps.nim = m.nim', 'inner'); // Join ke tabel mahasiswa

        // Filter berdasarkan jurusan
        if ($jurusan) {
            $this->db->where('m.jurusan', $jurusan);
        }

        return $this->db->count_all_results();
    }

    public function count_filtered($search = null, $jurusan = null)
    {
        $this->db->from('pengajuan_sidang ps');
        $this->db->join('m_mahasiswa m', 'ps.nim = m.nim', 'inner'); // Join ke tabel mahasiswa

        // Filter berdasarkan jurusan
        if ($jurusan) {
            $this->db->where('m.jurusan', $jurusan);
        }

        // Pencarian
        if ($search) {
            $this->db->like('LOWER(ps.nama_mahasiswa)', strtolower($search));
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
        $this->db->distinct();
        $this->db->where('jabatan', 'Dosen');
        $this->db->from('m_dosen');
        $query = $this->db->get();
        return $query->result_array();
    }
}
