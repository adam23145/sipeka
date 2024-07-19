<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
/**
 * 
 */
class M_publikasi extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function insert($data)
    {
        return $this->db->insert('ajuan_tugas_akhir', $data);
    }

    public function get_all($limit, $start, $search = null, $status = null)
    {
        
        $this->db->limit($limit, $start);
        
        if ($status) {
            $this->db->where('status_pengajuan', $status); // Filter by status
        }

        if ($search) {
            $this->db->group_start(); // Memulai grup kondisi untuk LIKE
            $this->db->like('LOWER(judul_tugas_akhir)', strtolower($search));
            $this->db->or_like('LOWER(nama_mahasiswa)', strtolower($search));
            $this->db->group_end(); // Mengakhiri grup kondisi untuk LIKE
        }
        $query = $this->db->get('ajuan_tugas_akhir');
        return $query->result();
    }

    public function count_all()
    {
        return $this->db->count_all('ajuan_tugas_akhir');
    }

    public function count_filtered($search = null, $status = null)
    {
        // $nama = $this->session->userdata['logged_in']['username'];

        // $this->db->where('nama_mahasiswa', $nama); // Add this condition

        if ($status) {
            $this->db->where('status_pengajuan', $status); // Filter by status
        }

        if ($search) {
            $this->db->group_start(); // Start a group for the LIKE conditions
            $this->db->like('judul_tugas_akhir', $search);
            $this->db->or_like('nama_mahasiswa', $search);
            $this->db->group_end(); // End the group
        }

        $query = $this->db->get('ajuan_tugas_akhir');
        return $query->num_rows();
    }

    public function update_status($id, $status)
    {
        $this->db->where('id', $id);
        $this->db->update('ajuan_tugas_akhir', array('status_pengajuan' => $status));
    }
}
