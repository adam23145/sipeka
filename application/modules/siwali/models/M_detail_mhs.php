<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_wali extends CI_Model {

	function cek_login($userid, $password){
		$query 	= " SELECT * FROM m_login WHERE status=1 AND userid='$userid' AND pass='$password' ";
		$result = $this->db->query($query)->row();
		return $result;
	}

	function update_status_login($userid){
		$query 	= "UPDATE m_login SET is_login = '1' WHERE userid='$userid'";
		$result	= $this->db->query($query);
		return $result;
	}

	function search_userid($userid){
		$query		= "SELECT userid FROM m_login WHERE userid='$userid'";
		$result 	= $this->db->query($query)->num_rows();
		return $result;
	}

	function count_fail_login($userid){
		$search_fail 	= "SELECT userid, login_failed FROM m_login WHERE userid='$userid'";
		$get2 			= $this->db->query($search_fail);
		$result3	 	= $get2->row();
		$count_fail 	= $result3->login_failed;
		$new_fail 		= $count_fail+1;
		$query_upd 		= "UPDATE m_login SET login_failed=$new_fail WHERE userid='$userid'";
		$update 		= $this->db->query($query_upd);
		return $update;
	}

}

