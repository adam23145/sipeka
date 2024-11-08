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
        } else {
            $this->db->where('UPPER(status_pengajuan)', 'MENUNGGU');
        }

        $query = $this->db->get('sempro_mbkm_riset');

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
        } else {
            $this->db->where('UPPER(status_pengajuan)', 'MENUNGGU');
        }

        $query = $this->db->get('sempro_mbkm_riset');
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
        } else {
            $this->db->where('UPPER(status_pengajuan)', 'MENUNGGU');
        }

        $this->db->order_by('tanggal_pengajuan', 'DESC');
        $query = $this->db->get('sempro_mbkm_riset');

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

        $query = $this->db->get('sempro_mbkm_riset');
        return $query->num_rows();
    }

    public function get_all($search = null)
    {
        $this->db->select('nip, nama');
        $this->db->where('jabatan', 'Dosen');
        
        if ($search) {
            $this->db->like('UPPER(nama)', strtoupper($search));
        }
    
        $this->db->where('createddate =', "(SELECT MAX(createddate) FROM m_dosen AS sub WHERE sub.nip = m_dosen.nip)", FALSE); 
    
        $query = $this->db->get('m_dosen');
        return $query->result();
    }
    

    public function update_status($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('sempro_mbkm_riset', $data);
    }
}
