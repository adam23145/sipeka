<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
/**
 * 
 */
class M_bimbinganmbkm extends CI_Model
{
    public function get_approved_submissions($nim)
    {
        $this->db->where('UPPER(status_pengajuan)', 'ACC');
        $this->db->where('UPPER(nim)', strtoupper($nim));
        $query = $this->db->get('mbkm_riset');
        return $query->result();
    }
    public function get_log_bimbingan_by_id($id_mbkm)
    {
        $this->db->where('id_mbkm', $id_mbkm);
        $query = $this->db->get('bimbingan_sempro_mbkm'); 
        return $query->result();
    }
    public function count_publikasi_by_id($id_mbkm)
    {
        $this->db->where('id_mbkm', $id_mbkm);
        $this->db->from('bimbingan_sempro_mbkm'); // Sesuaikan nama tabel jika perlu
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
