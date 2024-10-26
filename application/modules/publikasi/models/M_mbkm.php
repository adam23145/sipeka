<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class M_mbkm extends CI_Model
{
    public function get_all_data($limit, $start, $order, $dir, $status = null, $username = null)
    {
        $this->db->order_by('tanggal_pengajuan', 'DESC');
        $this->db->limit($limit, $start);
        $this->db->order_by($order, $dir);

        // Filter berdasarkan status jika diberikan
        if ($status) {
            $this->db->where('UPPER(status_pengajuan)', strtoupper($status)); // Case-insensitive
        } else {
            $this->db->where('UPPER(status_pengajuan)', 'MENUNGGU');
        }

        // Filter berdasarkan dosen pembimbing
        if ($username) {
            $this->db->group_start();
            $this->db->where('dosen_pembimbing_utama', $username);
            $this->db->or_where('dosen_pembimbing_kedua', $username);
            $this->db->group_end();
        }

        $query = $this->db->get('mbkm_riset');

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return null;
        }
    }

    public function count_all_data($status = null, $username = null)
    {
        if ($status) {
            $this->db->where('UPPER(status_pengajuan)', strtoupper($status)); // Case-insensitive
        } else {
            $this->db->where('UPPER(status_pengajuan)', 'MENUNGGU');
        }

        // Filter berdasarkan dosen pembimbing
        if ($username) {
            $this->db->group_start();
            $this->db->where('dosen_pembimbing_utama', $username);
            $this->db->or_where('dosen_pembimbing_kedua', $username);
            $this->db->group_end();
        }

        $query = $this->db->get('mbkm_riset');
        return $query->num_rows();
    }

    public function search_data($limit, $start, $search, $order, $dir, $status = null, $username = null)
    {
        $searchUpper = strtoupper($search);

        $this->db->like('UPPER(nama_mahasiswa)', $searchUpper);
        $this->db->or_like('mbkm', $search);
        $this->db->limit($limit, $start);

        // Filter berdasarkan status jika diberikan
        if ($status) {
            $this->db->where('UPPER(status_pengajuan)', strtoupper($status)); // Case-insensitive
        } else {
            $this->db->where('UPPER(status_pengajuan)', 'MENUNGGU');
        }

        // Filter berdasarkan dosen pembimbing
        if ($username) {
            $this->db->group_start();
            $this->db->where('dosen_pembimbing_utama', $username);
            $this->db->or_where('dosen_pembimbing_kedua', $username);
            $this->db->group_end();
        }

        $this->db->order_by('tanggal_pengajuan', 'DESC');
        $query = $this->db->get('mbkm_riset');

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return null;
        }
    }

    public function count_filtered_data($search, $status = null, $username = null)
    {
        $searchUpper = strtoupper($search);

        $this->db->like('UPPER(nama_mahasiswa)', $searchUpper);
        $this->db->or_like('mbkm', $search);

        if ($status) {
            $this->db->where('UPPER(status_pengajuan)', strtoupper($status));
        } else {
            $this->db->where('UPPER(status_pengajuan)', 'MENUNGGU');
        }

        // Filter berdasarkan dosen pembimbing
        if ($username) {
            $this->db->group_start();
            $this->db->where('dosen_pembimbing_utama', $username);
            $this->db->or_where('dosen_pembimbing_kedua', $username);
            $this->db->group_end();
        }

        $query = $this->db->get('mbkm_riset');
        return $query->num_rows();
    }

    public function get_all($search = null)
    {
        $this->db->distinct(); // Mark query to take unique data
        $this->db->where('jabatan', 'Dosen'); // Add condition for position

        // If a search term is provided, filter the results
        if ($search) {
            // Use UPPER() for case-insensitive search
            $this->db->like('UPPER(nama)', strtoupper($search)); // Use 'like' for partial matching
        }

        $query = $this->db->get('m_dosen'); // Get all unique lecturer data from the 'm_dosen' table
        return $query->result();
    }
    public function getMbkmRisetData($bimbingan_mbkm_id)
    {
        $this->db->where('id', $bimbingan_mbkm_id);
        $query = $this->db->get('mbkm_riset');

        if ($query->num_rows() > 0) {
            return $query->result();
        }

        return null;
    }
    public function saveBimbingan($data)
    {
        return $this->db->insert('bimbingan_mbkm', $data);
    }
    public function checkStatus($id_mbkm)
    {
        $this->db->select('status_pengajuan');
        $this->db->from('mbkm_riset');
        $this->db->where('id', $id_mbkm);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->row()->status_pengajuan;
        }

        return null;
    }
    public function updateStatus($id_mbkm, $status)
    {
        $this->db->set('status_pengajuan', $status);
        $this->db->where('id', $id_mbkm);
        return $this->db->update('mbkm_riset');
    }
    public function getLogBimbingan($id_bimbingan_form)
    {
        $this->db->where('id_mbkm', $id_bimbingan_form);
        $query = $this->db->get('bimbingan_mbkm'); 
        return $query->result();
    }
}
