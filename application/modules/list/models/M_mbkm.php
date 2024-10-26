<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class M_mbkm extends CI_Model
{
    public function get_all_data($limit, $start, $order, $dir, $jur, $status = null)
    {
        $this->db->order_by('tanggal_pengajuan', 'DESC');
        $this->db->limit($limit, $start);
        $this->db->order_by($order, $dir);
        $this->db->where('prodi', $jur);

        // Filter berdasarkan status jika diberikan
        if ($status) {
            $this->db->where('UPPER(status_pengajuan)', strtoupper($status)); // Case-insensitive
        }else {
            $this->db->where('UPPER(status_pengajuan)', 'MENUNGGU');
        }

        $query = $this->db->get('mbkm_riset');

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return null;
        }
    }


    public function count_all_data($jur, $status = null)
    {
        $this->db->where('prodi', $jur);

        // Filter berdasarkan status jika diberikan
        if ($status) {
            $this->db->where('UPPER(status_pengajuan)', strtoupper($status)); // Case-insensitive
        }else {
            $this->db->where('UPPER(status_pengajuan)', 'MENUNGGU');
        }

        $query = $this->db->get('mbkm_riset');
        return $query->num_rows();
    }


    public function search_data($limit, $start, $search, $order, $dir, $jur, $status = null)
    {
        $searchUpper = strtoupper($search);

        $this->db->like('UPPER(nama_mahasiswa)', $searchUpper);
        $this->db->or_like('mbkm', $search);
        $this->db->limit($limit, $start);
        $this->db->where('prodi', $jur);

        // Filter berdasarkan status jika diberikan
        if ($status) {
            $this->db->where('UPPER(status_pengajuan)', strtoupper($status)); // Case-insensitive
        }else {
            $this->db->where('UPPER(status_pengajuan)', 'MENUNGGU');
        }

        $this->db->order_by('tanggal_pengajuan', 'DESC');
        $query = $this->db->get('mbkm_riset');

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return null;
        }
    }

    public function count_filtered_data($search, $jur, $status = null)
    {
        $searchUpper = strtoupper($search);

        $this->db->like('UPPER(nama_mahasiswa)', $searchUpper);
        $this->db->or_like('mbkm', $search);
        $this->db->where('prodi', $jur);

        if ($status) {
            $this->db->where('UPPER(status_pengajuan)', strtoupper($status));
        } else {
            $this->db->where('UPPER(status_pengajuan)', 'MENUNGGU');
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

    public function update_status($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('mbkm_riset', $data);
    }
}
