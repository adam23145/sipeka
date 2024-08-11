<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
/**
 * 
 */
class M_sidang extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
}