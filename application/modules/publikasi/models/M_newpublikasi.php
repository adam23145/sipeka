<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
/**
 * 
 */
class M_newpublikasi extends CI_Model
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

    public function get_all($limit, $start, $search = null, $status = null,$username)
    {

        $this->db->limit($limit, $start);

        if ($status) {
            $this->db->where('status_pengajuan', $status); // Filter by status
        }

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

    public function count_all($username)
    {
        $this->db->group_start();
        $this->db->where('dosen_pembimbing_utama', $username);
        $this->db->or_where('dosen_pembimbing_kedua', $username);
        $this->db->group_end();
        return $this->db->count_all('ajuan_tugas_akhir');
    }

    public function count_filtered($search = null, $status = null,$username)
    {
        // $nama = $this->session->userdata['logged_in']['username'];

        // $this->db->where('nama_mahasiswa', $nama); // Add this condition

        if ($status) {
            $this->db->where('status_pengajuan', $status); // Filter by status
        }

        $this->db->group_start();
        $this->db->where('dosen_pembimbing_utama', $username);
        $this->db->or_where('dosen_pembimbing_kedua', $username);
        $this->db->group_end();
        if ($search) {
            $this->db->group_start(); // Start a group for the LIKE conditions
            $this->db->like('LOWER(judul_tugas_akhir)', strtolower($search));
            $this->db->or_like('LOWER(nama_mahasiswa)', strtolower($search));
            $this->db->group_end(); // End the group
        }

        $query = $this->db->get('ajuan_tugas_akhir');
        return $query->num_rows();
    }
    
    public function update_status($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('ajuan_tugas_akhir', $data);
    }
}
