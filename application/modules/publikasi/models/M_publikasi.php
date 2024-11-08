<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

date_default_timezone_set('Asia/Jakarta');

/**
 * Model Publikasi
 */
class M_publikasi extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    // Mengambil semua data publikasi dengan limit dan offset
    public function get_all($limit, $start, $search = null, $status = null, $username)
    {
        $this->db->limit($limit, $start);

        if ($status) {
            $this->db->where('status_pengajuan', $status); // Filter berdasarkan status
        }

        // Filter berdasarkan username untuk dosen pembimbing
        $this->db->group_start();
        $this->db->where('dosen_pembimbing_utama', $username);
        $this->db->or_where('dosen_pembimbing_kedua', $username);
        $this->db->group_end();

        if ($search) {
            $this->db->group_start(); // Memulai grup kondisi untuk LIKE
            $this->db->like('LOWER(judul_tugas_akhir)', strtolower($search));
            $this->db->or_like('LOWER(nama_mahasiswa)', strtolower($search));
            $this->db->group_end(); // Mengakhiri grup kondisi untuk LIKE
        }

        $query = $this->db->get('ajuan_tugas_akhir');
        return $query->result();
    }

    // Menghitung semua data publikasi
    public function count_all($username)
    {
        $this->db->group_start();
        $this->db->where('dosen_pembimbing_utama', $username);
        $this->db->or_where('dosen_pembimbing_kedua', $username);
        $this->db->group_end();
        return $this->db->count_all('ajuan_tugas_akhir');
    }

    // Menghitung jumlah data publikasi yang difilter
    public function count_filtered($search = null, $status = null, $username)
    {
        if ($status) {
            $this->db->where('status_pengajuan', $status); // Filter berdasarkan status
        }

        // Filter berdasarkan username untuk dosen pembimbing
        $this->db->group_start();
        $this->db->where('dosen_pembimbing_utama', $username);
        $this->db->or_where('dosen_pembimbing_kedua', $username);
        $this->db->group_end();

        if ($search) {
            $this->db->group_start(); // Memulai grup kondisi untuk LIKE
            $this->db->like('LOWER(judul_tugas_akhir)', strtolower($search));
            $this->db->or_like('LOWER(nama_mahasiswa)', strtolower($search));
            $this->db->group_end(); // Mengakhiri grup kondisi untuk LIKE
        }

        $query = $this->db->get('ajuan_tugas_akhir');
        return $query->num_rows();
    }
    public function getPublikasiRisetData($bimbingan_pengajuan_id)
    {
        $this->db->where('id', $bimbingan_pengajuan_id);
        $query = $this->db->get('ajuan_tugas_akhir');

        if ($query->num_rows() > 0) {
            return $query->result();
        }

        return null;
    }
    public function saveBimbingan($data)
    {
        return $this->db->insert('bimbingan_publikasi', $data);
    }
    public function checkStatus($id_publikasi)
    {
        $this->db->select('status_pengajuan');
        $this->db->from('ajuan_tugas_akhir');
        $this->db->where('id', $id_publikasi);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->row()->status_pengajuan;
        }

        return null;
    }
    public function updateStatus($id_publikasi, $status)
    {
        $this->db->set('status_pengajuan', $status);
        $this->db->where('id', $id_publikasi);
        return $this->db->update('ajuan_tugas_akhir');
    }
    public function getLogBimbingan($id_bimbingan_form)
    {
        $this->db->where('id_publikasi', $id_bimbingan_form);
        $query = $this->db->get('bimbingan_publikasi');
        return $query->result();
    }
    public function countBimbingan($id_publikasi)
    {
        $this->db->where('id_publikasi', $id_publikasi);
        return $this->db->count_all_results('bimbingan_publikasi');
    }
}
