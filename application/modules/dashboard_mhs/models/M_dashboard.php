<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
/**
 * 
 */
class M_dashboard extends CI_Model {

	function get_status_jdl($nim){
		$query 		= "SELECT * FROM title_submission WHERE code_status!='Tutup' AND nim='$nim' ";
		$data 		= $this->db->query($query)->result_array();
		return $data;
	}

	function cek_jud($nim){
		// $query 		= "SELECT count(id) as jml FROM title_submission WHERE nim='$nim' AND submission_status !='Tolak' ";
		$query 		= "SELECT count(id) as jml FROM title_submission WHERE nim='$nim' AND code_status!='Tutup' ";
		$data 		= $this->db->query($query)->result_array();
		return $data;
	}
	
	function cek_ayat($nim){
		// $query 		= "SELECT count(id) as jml FROM title_submission WHERE nim='$nim' AND submission_status !='Tolak' ";
		$query 		= "SELECT count(1) as jml FROM mapping_hafalan_ayat WHERE nim='$nim' ";
		$data 		= $this->db->query($query)->result_array();
		return $data;
	}
	
	function cek_hadist($nim){
		// $query 		= "SELECT count(id) as jml FROM title_submission WHERE nim='$nim' AND submission_status !='Tolak' ";
		$query 		= "SELECT count(1) as jml FROM mapping_hafalan_hadist WHERE nim='$nim' ";
		$data 		= $this->db->query($query)->result_array();
		return $data;
	}
	
	function cek_kk($nim){
		// $query 		= "SELECT count(id) as jml FROM title_submission WHERE nim='$nim' AND submission_status !='Tolak' ";
		$query 		= "SELECT count(1) as jml FROM mapping_hafalan_kk WHERE nim='$nim' ";
		$data 		= $this->db->query($query)->result_array();
		return $data;
	}
	
	function cek_qq($nim){
		// $query 		= "SELECT count(id) as jml FROM title_submission WHERE nim='$nim' AND submission_status !='Tolak' ";
		$query 		= "SELECT count(1) as jml FROM mapping_hafalan_qq WHERE nim='$nim' ";
		$data 		= $this->db->query($query)->result_array();
		return $data;
	}

}