<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
/**
 * 
 */
class M_profile extends CI_Model {

	function get_data_profil($userid){
		$this->db->where('userid', $userid);
		$data = $this->db->get('m_login')->result_array();
		return $data;
	}

	function update_data($userid, $inputName, $inputEmail){
		$query 		= " UPDATE m_login SET full_name='$inputName', email='$inputEmail' WHERE userid='$userid' ";
		$process 	= $this->db->query($query);
		return $process;
	}

	function update_image($userid, $data_login) {
		$this->db->trans_begin();
		$this->db->where('userid', $userid);
		$this->db->update('m_login', $data_login);
		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			return FALSE;
		} else {
			$this->db->trans_commit();
			return TRUE;
		}
	}
}