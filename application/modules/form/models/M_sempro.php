<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
/**
 * 
 */
class M_sempro extends CI_Model {

	function cek_jud($nim){
		$query 		= "SELECT title,submission_code,dosbing FROM title_submission WHERE nim='$nim' AND submission_status !='Tolak' ";
		$data 		= $this->db->query($query)->result_array();
		return $data;
	}

	function get_count_sempro($userid){
		$query 		= "SELECT count(*) as jmlsem FROM title_submission WHERE nim='$userid' ";
		$data 		= $this->db->query($query)->result_array();
		return $data;
	}

	function get_data_sempro($userid){
		$query 		= "SELECT submission_status FROM title_submission WHERE nim='$userid' AND submission_status !='Tolak'  ";
		$data 		= $this->db->query($query)->result_array();
		return $data;
	}

	function inserttodok($nim, $judul, $titledok, $dosbing, $file_name_new, $file_pth, $userid, $sub_code){
		$query 		= "INSERT INTO dokumen ( 
									nim,
									title,
									dokumen,
									upd,
									dosbing,
									createddate,
									submission_code,
									file_dok,
									filepath)
									VALUES(
									'".$nim."',
									'".$judul."',
									'".$titledok."',
									'".$userid."',
									'".$dosbing."',
									CURRENT_TIMESTAMP,
									'".$sub_code."',
									'".$file_name_new."',
									'".$file_pth."'
									)";
		$insert 	= $this->db->query($query);
		return $insert;
	}

	function insert_file($sub_code, $nama, $nim, $majorname, $judul, $tanggal, $penguji, $file_name_new, $file_pth, $dosbing){
		$query 		= "INSERT INTO sempro ( 
									submission_code,
									nim,
									student_name,
									title,
									tgl_sempro,
									jurusan,
									penguji,
									path_basempro,
									file_basempro,
									dosbing
									)VALUES(
									'".$sub_code."',
									'".$nim."',
									'".$nama."',
									'".$judul."',
									'".$tanggal."',
									'".$majorname."',
									'".$penguji."',
									'".$file_pth."',
									'".$file_name_new."',
									'".$dosbing."'
									)";
		$insert 	= $this->db->query($query);
		return $insert;
	}

	function updatefile($sub_code, $file_name_new2, $file_pth2){
		$query 		= "UPDATE sempro SET file_proposal='".$file_name_new2."', path_proposal='".$file_pth2."' WHERE submission_code='".$sub_code."' ";
		$update 	= $this->db->query($query);
		return $update;
	}

	function updatesub($sub_code, $userid, $sub_status, $cd_stats){
		$query 		= "UPDATE title_submission SET submission_status='".$sub_status."', code_status='".$cd_stats."', date_modified=CURRENT_TIMESTAMP, aksi='unpickup' WHERE submission_code='".$sub_code."' ";
		$update 	= $this->db->query($query);
		return $update;
	}

	function insert_log($sub_code, $userid, $sub_status, $cd_stats){
		$query 		= "INSERT INTO trans_title_submission ( 
									submission_code,
									submission_status,
									code_status,
									loker,
									keterangan_upd,
									upd_by )VALUES(
									'".$sub_code."',
									'".$sub_status."',
									'".$cd_stats."',
									'Dosen',
									'".$sub_status."',
									'".$userid."'
									)";
		$insert 	= $this->db->query($query);
		return $insert;
	}

}