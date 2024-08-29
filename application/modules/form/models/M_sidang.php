<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_sidang extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function check_existing_submission_by_nim($nim)
    {
        $this->db->where('nim', $nim);
        $this->db->order_by('id', 'DESC'); // Urutkan berdasarkan ID secara menurun
        $this->db->limit(1); // Ambil hanya satu baris dengan ID terbesar
        $query = $this->db->get('pengajuan_sidang'); // Ganti dengan nama tabel yang sesuai
        return $query->row_array();
    }


    public function simpan_pengajuan($data)
    {
        return $this->db->insert('pengajuan_sidang', $data); // Ganti dengan nama tabel yang sesuai
    }
    public function check_submission_approval($submission_code)
    {
        $query = $this->db->get_where('log_bimbingan_skripsi', [
            'submission_code' => $submission_code,
            'status_bimb' => 'Setuju Sidang'
        ]);

        return $query->num_rows() > 0;
    }
}
