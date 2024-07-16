<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
/**
 * 
 */
class M_pengajuanJudul extends CI_Model {

	function cek_jud($userid){
		$query 		= "SELECT count(id) as jml FROM title_submission WHERE nim='$userid' AND submission_status !='Tolak' ";
		$data 		= $this->db->query($query)->result_array();
		return $data;
	}

	function insert($userid, $sub_code, $nama, $nim, $jurusan, $judul, $rumusah_masalah, $urgensi, $sub_status, $code_status, $loker){
		$query 		= " INSERT INTO title_submission ( 
						submission_code, 
						nim, 
						student_name, 
						title, 
						rms_maslh,
						urgensi,
						jurusan, 
						submission_status,
						code_status,
						loker, 
						upd, 
						createddate, 
						date_modified )
						VALUES
						(
						'".$sub_code."',
						'".$nim."',
						'".$nama."',
						'".$judul."',
						'".$rumusah_masalah."',
						'".$urgensi."',
						'".$jurusan."',
						'".$sub_status."',
						'".$code_status."',
						'".$loker."',
						'".$userid."',
						CURRENT_TIMESTAMP,
						CURRENT_TIMESTAMP
						) ";
		$insert 	= $this->db->query($query);
		return $insert;
	}

	function insert_log($sub_code, $rumusah_masalah, $urgensi, $userid, $sub_status, $code_status, $loker){
		$query 		= "INSERT INTO trans_title_submission ( 
									submission_code,
									submission_status,
									code_status,
									loker,
									keterangan_upd,
									urgensi,
									upd_by )VALUES(
									'".$sub_code."',
									'".$sub_status."',
									'".$code_status."',
									'".$loker."',
									'".$rumusah_masalah."',
									'".$urgensi."',
									'".$userid."'
									)";
		$insert 	= $this->db->query($query);
		return $insert;
	}

}