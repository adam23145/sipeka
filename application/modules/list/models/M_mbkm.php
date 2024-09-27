<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
/**
 * 
 */
class M_mbkm extends CI_Model
{
    public function get_all_data($limit, $start, $order, $dir)
    {
        $this->db->order_by('tanggal_pengajuan', 'DESC'); 
        $this->db->limit($limit, $start);
        $this->db->order_by($order, $dir);
        $query = $this->db->get('mbkm_riset'); 

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return null;
        }
    }

    public function count_all_data()
    {
        $query = $this->db->get('mbkm_riset');
        return $query->num_rows();
    }

    public function search_data($limit, $start, $search, $order, $dir)
    {
        $searchUpper = strtoupper($search);

        $this->db->like('UPPER(nama_mahasiswa)', $searchUpper);
        $this->db->or_like('mbkm', $search);
        $this->db->limit($limit, $start);
        $this->db->order_by('tanggal_pengajuan', 'DESC'); 
        $query = $this->db->get('mbkm_riset');

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return null;
        }
    }

    public function count_filtered_data($search)
    {
        $searchUpper = strtoupper($search);

        $this->db->like('UPPER(nama_mahasiswa)', $searchUpper);
        $this->db->or_like('mbkm', $search);
        $query = $this->db->get('mbkm_riset');
        return $query->num_rows();
    }

    public function get_all()
    {
        $query = $this->db->get('m_dosen');
        return $query->result();
    }
    public function update_status($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('mbkm_riset', $data);
    }
}
