<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
/**
 * 
 */
class M_pengajuanjudulmbkm extends CI_Model
{

    public function save_submission($data)
    {
        if ($this->db->insert('mbkm_riset', $data)) {
            return true;  // Berhasil disimpan
        } else {
            return false; // Gagal disimpan
        }
    }
    public function is_submission_exists($nim)
    {
        // Cek apakah ada pengajuan dengan NIM yang sama dan status bukan Ditolak
        $this->db->where('nim', $nim);
        $this->db->where('status_pengajuan !=', 'Ditolak');
        $query = $this->db->get('mbkm_riset');
        
        return $query->num_rows() > 0; // Jika ada pengajuan yang statusnya bukan Ditolak
    }
}
