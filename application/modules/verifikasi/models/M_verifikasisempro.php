<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
/**
 * 
 */
class M_verifikasisempro extends CI_Model
{
    public function is_barcode_exists($submission_code)
    {
        $this->db->where('submission_code', $submission_code);
        $this->db->where('LOWER(status_bimb)', 'setuju');
        $query = $this->db->get('log_bimbingan');
        return $query->num_rows() > 0;
    }
}