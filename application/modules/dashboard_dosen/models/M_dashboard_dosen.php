<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
/**
 * 
 */
class M_dashboard_dosen extends CI_Model {

	function cekdosen($email){
		$query 		= "SELECT * FROM m_dosen WHERE email='$email' AND jabatan ='Dosen' ";
		$data 		= $this->db->query($query)->result_array();
		return $data;
	}

	function get_baru_sem($nip,$jbt){
		$query 		= "SELECT count(*) as jmlnew_sem FROM title_submission WHERE code_status='New' AND submission_status='In Review Dosen' AND dosbing='".$nip."' AND loker='".$jbt."' ";
		$data 		= $this->db->query($query)->result_array();
		return $data;
	}

	function get_pr_sem($nip){
		$query 		= "SELECT count(*) as jmlproses_sem FROM bimbingan WHERE dosbing='".$nip."' AND status_bimb!='Setuju' ";
		$data 		= $this->db->query($query)->result_array();
		return $data;
	}

	function get_end_sem($nip){
		$query 		= "SELECT count(*) as jmlend_sem FROM bimbingan WHERE dosbing='".$nip."' AND status_bimb='Setuju' ";
		$data 		= $this->db->query($query)->result_array();
		return $data;
	}

	function get_baru($nip,$jbt){
		$query 		= "SELECT count(*) as jmlnew FROM title_submission WHERE code_status='New' AND submission_status='Bimbingan Skripsi' AND dosbing='".$nip."' AND loker='".$jbt."' ";
		$data 		= $this->db->query($query)->result_array();
		return $data;
	}

	function get_pr($nip){
		// $query 		= "SELECT count(*) as jmlproses FROM bimbingan_skripsi WHERE dosbing='".$nip."' AND status_bimb!='Setuju' ";
		$query 		= "SELECT count(ba.id) as jmlproses FROM bimbingan_skripsi ba, title_submission ts WHERE ba.submission_code=ts.submission_code AND ba.status_bimb in ('new','Bimbingan Skripsi') AND ba.dosbing = '$nip' ";
		$data 		= $this->db->query($query)->result_array();
		return $data;
	}

	function get_end($nip){
		$query 		= "SELECT count(bs.id) as jmlend FROM bimbingan_skripsi bs, title_submission ts WHERE bs.submission_code = ts.submission_code AND bs.dosbing='".$nip."' AND bs.status_bimb = 'Setuju Sidang' ";
		$data 		= $this->db->query($query)->result_array();
		return $data;
	}

	function cek_ayat($nip){
		$where = "";
		if($nip <> ""){
			$where = " AND nip='$nip' ";
		}
		// $query 		= "SELECT count(id) as jml FROM title_submission WHERE nim='$nim' AND submission_status !='Tolak' ";
		$query 		= "SELECT count(1) as jml FROM mapping_hafalan_ayat WHERE 1=1 $where ";
		$data 		= $this->db->query($query)->result_array();
		return $data;
	}
	
	function cek_hadist($nip){
		$where = "";
		if($nip <> ""){
			$where = " AND nip='$nip' ";
		}
		// $query 		= "SELECT count(id) as jml FROM title_submission WHERE nim='$nim' AND submission_status !='Tolak' ";
		$query 		= "SELECT count(1) as jml FROM mapping_hafalan_hadist WHERE 1=1 $where ";
		$data 		= $this->db->query($query)->result_array();
		return $data;
	}
	
	function cek_kk($nip){
		$where = "";
		if($nip <> ""){
			$where = " AND nip='$nip' ";
		}
		// $query 		= "SELECT count(id) as jml FROM title_submission WHERE nim='$nim' AND submission_status !='Tolak' ";
		$query 		= "SELECT count(1) as jml FROM mapping_hafalan_kk WHERE 1=1 $where ";
		$data 		= $this->db->query($query)->result_array();
		return $data;
	}
	
	function cek_qq($nip){
		$where = "";
		if($nip <> ""){
			$where = " AND nip='$nip' ";
		}
		// $query 		= "SELECT count(id) as jml FROM title_submission WHERE nim='$nim' AND submission_status !='Tolak' ";
		$query 		= "SELECT count(1) as jml FROM mapping_hafalan_qq WHERE 1=1 $where ";
		$data 		= $this->db->query($query)->result_array();
		return $data;
	}

}