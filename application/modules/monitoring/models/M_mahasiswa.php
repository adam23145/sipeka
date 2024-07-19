<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class M_mahasiswa extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    /**
     * Get the count of guidance sessions per student.
     */
    public function get_guidance_count_per_student($limit, $start, $search = null, $year = null)
    {
        $this->db->select('b.nim, m.nama, m.tahun_masuk,b.bimbingan_ke');
        $this->db->from('bimbingan b');
        $this->db->join('m_mahasiswa m', 'b.nim = m.nim');
        $this->db->group_by('b.nim, m.nama, m.tahun_masuk,b.bimbingan_ke');

        if ($search) {
            $this->db->like('LOWER(m.nama)', strtolower($search));
        }

        if ($year) {
            $this->db->where('m.tahun_masuk', $year); // Add year filter
        }

        $this->db->limit($limit, $start);

        $query = $this->db->get();
        return $query->result();
    }

    public function count_all_students($year = null)
    {
        $this->db->select('b.nim');
        $this->db->from('bimbingan b');
        $this->db->join('m_mahasiswa m', 'b.nim = m.nim');
        $this->db->group_by('b.nim');

        if ($year) {
            $this->db->where('m.tahun_masuk', $year); // Add year filter
        }

        return $this->db->count_all_results();
    }

    public function count_filtered_students($search = null, $year = null)
    {
        $this->db->select('b.nim');
        $this->db->from('bimbingan b');
        $this->db->join('m_mahasiswa m', 'b.nim = m.nim');
        $this->db->group_by('b.nim');

        if ($search) {
            $this->db->like('LOWER(m.nama)', strtolower($search));
        }

        if ($year) {
            $this->db->where('m.tahun_masuk', $year); // Add year filter
        }

        $query = $this->db->get();
        return $query->num_rows();
    }


    public function get_unique_years()
    {
        // Select distinct years from the joined tables
        $this->db->distinct();
        $this->db->select('m.tahun_masuk');
        $this->db->from('bimbingan b');
        $this->db->join('m_mahasiswa m', 'b.nim = m.nim');
        $this->db->order_by('m.tahun_masuk', 'asc'); // Optional: Order years ascending

        $query = $this->db->get();
        return $query->result_array(); // Returns an array of unique years
    }
}
