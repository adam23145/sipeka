<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_mbkm extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function insert($data)
    {
        return $this->db->insert('mbkm_riset', $data);
    }
}
