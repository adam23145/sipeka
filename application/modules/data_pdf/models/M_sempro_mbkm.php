<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

/**
 * 
 */
class M_sempro_mbkm extends CI_Model
{

    // Fungsi untuk mengambil data berdasarkan subcode
    function getdatapdf($subcode)
    {
        // Query untuk mengambil data dari tabel sempro_mbkm_riset berdasarkan subcode
        $this->db->select('*'); // Ambil semua kolom
        $this->db->from('sempro_mbkm_riset'); // Nama tabel
        $this->db->where('submission_code', $subcode); // Filter berdasarkan submission_code

        $query = $this->db->get(); // Menjalankan query

        // Cek apakah ada data yang ditemukan
        if ($query->num_rows() > 0) {
            return $query->result_array(); // Mengembalikan data dalam bentuk array
        } else {
            return null; // Tidak ada data
        }
    }
    // Fungsi untuk mendapatkan nip dosen berdasarkan nama dosen
    public function get_nip_by_dosen_name($dosen_name)
    {
        // Query untuk mengambil nip dari tabel dosen berdasarkan nama dosen
        $this->db->select('nip');  // Ambil nip dari tabel dosen
        $this->db->from('m_dosen'); 
        $this->db->where('nama', $dosen_name);
        $query = $this->db->get();  // Menjalankan query

        // Cek apakah ada data yang ditemukan
        if ($query->num_rows() > 0) {
            $nip_data = $query->row_array();  // Ambil data nip dari query
            return $nip_data['nip'];  // Mengembalikan nip
        } else {
            return null;  // Jika nip tidak ditemukan
        }
    }
}
