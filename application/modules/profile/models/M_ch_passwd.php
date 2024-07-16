<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
/**
 * 
 */
class M_ch_passwd extends CI_Model {

	function get_data_profil($userid){
		$this->db->where('userid', $userid);
		$data = $this->db->get('m_login')->result_array();
		return $data;
	}

	function update_p($userid, $inputpass1){
		$query 		= "UPDATE m_login SET pass='$inputpass1' WHERE userid='$userid'";
		$process 	= $this->db->query($query);
		return $process;
	}
}