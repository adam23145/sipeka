<?php
class M_list_dokumen extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function get_approved_submissions($nim)
    {
        $this->db->where('UPPER(status_pengajuan)', 'ACC');
        $this->db->where('UPPER(nim)', strtoupper($nim)); // Gunakan UPPER() untuk memastikan pencocokan
        $query = $this->db->get('ajuan_tugas_akhir');
        return $query->result();
    }
}
