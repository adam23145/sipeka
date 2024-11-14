<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
/**
 * 
 */
class M_bimbinganpublikasi extends CI_Model
{
    public function get_approved_submissions($nim)
    {
        $this->db->where('UPPER(status_pengajuan)', 'ACC');
        $this->db->where('UPPER(nim)', strtoupper($nim));
        $query = $this->db->get('ajuan_tugas_akhir');
        return $query->result();
    }
    public function get_log_bimbingan_by_id($id_publikasi)
    {
        $this->db->where('id_publikasi', $id_publikasi);
        $query = $this->db->get('bimbingan_publikasi'); 
        return $query->result();
    }
    public function count_publikasi_by_id($id_publikasi)
    {
        $this->db->where('id_publikasi', $id_publikasi);
        $this->db->from('bimbingan_publikasi'); // Sesuaikan nama tabel jika perlu
        return $this->db->count_all_results();
    }
    public function get_nip_by_name($nama_dosen) {
        $this->db->select('nip');
        $this->db->from('m_dosen');
        $this->db->where('nama', $nama_dosen);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->row()->nip; // Mengambil nip dari hasil query
        } else {
            return null; // Mengembalikan null jika tidak ditemukan
        }
    }
}
