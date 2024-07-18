<?php
defined('BASEPATH') or exit('No direct script access allowed');

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

}
