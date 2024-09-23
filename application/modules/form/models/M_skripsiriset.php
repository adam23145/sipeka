<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_skripsiriset extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function insert($data)
    {
        return $this->db->insert('skripsi_riset', $data);
    }
    public function get_all()
    {
        $query = $this->db->get('m_dosen');
        return $query->result();
    }
}
