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
    public function get_guidance_count_per_student($limit, $start, $search = null)
    {
        $this->db->select('b.nim, ts.student_name, COUNT(*) as jumlah_bimbingan');
        $this->db->from('bimbingan b');
        $this->db->join('title_submission ts', 'b.submission_code = ts.submission_code');
        $this->db->group_by('b.nim, ts.student_name');

        if ($search) {
            $this->db->or_like('LOWER(ts.student_name)', strtolower($search));
        }

        $this->db->limit($limit, $start);

        $query = $this->db->get();
        return $query->result();
    }


    public function count_all_students()
    {
        $this->db->select('b.nim');
        $this->db->from('bimbingan b');
        $this->db->join('title_submission ts', 'b.submission_code = ts.submission_code');
        $this->db->group_by('b.nim');

        return $this->db->count_all_results();
    }

    public function count_filtered_students($search = null)
    {
        $this->db->select('b.nim');
        $this->db->from('bimbingan b');
        $this->db->join('title_submission ts', 'b.submission_code = ts.submission_code'); // Add if needed
        $this->db->group_by('b.nim');

        if ($search) {
            $this->db->or_like('LOWER(ts.student_name)', strtolower($search));
        }

        $query = $this->db->get();
        return $query->num_rows();
    }
}
