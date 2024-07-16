<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
/**
 * 
 */
class M_detail extends CI_Model {

	function get_sub($sub_code){
		$query 		= "SELECT * FROM title_submission WHERE submission_code='$sub_code'";
		$data 		= $this->db->query($query)->result_array();
		return $data;
	}

	function get_pdf($fnim,$fjudul){
		$where = " nim='$fnim' AND title='$fjudul' AND submission_status!='Tolak' ";
		$this->db->select('nim,submission_code');
		$this->db->from('title_submission');
		$this->db->where($where);
		$query=$this->db->get();
		$data= $query->result_array();

		return $data;
	}

	function get_nama_dosen($dosbing){
		$query 		= "SELECT * FROM m_dosen WHERE status='aktif' AND jabatan='Dosen' and nip='$dosbing' ";
		$data 		= $this->db->query($query)->result_array();
		return $data;
	}

	function update($userid, $sub_code, $judul, $rumusah_masalah, $sub_stats, $code_stats, $loker){
		$query 		= " UPDATE title_submission 
								SET title = '$judul',
								rms_maslh = '$rumusah_masalah',
								upd = '$userid',
								submission_status = '$sub_stats',
								loker = '$loker',
								code_status = '$code_stats'
								WHERE
									submission_code = '$sub_code' ";
		$update 	= $this->db->query($query);
		return $update;
	}

	function insert_log($sub_code, $rumusah_masalah, $userid, $sub_stats, $code_stats, $loker){
		$query 		= "INSERT INTO trans_title_submission(submission_code, submission_status, loker, upd_by, keterangan_upd, code_status)
						VALUES('".$sub_code."', '".$sub_stats."', '".$loker."', '".$userid."','".$rumusah_masalah."', '".$code_stats."' )";
		$insert_log = $this->db->query($query);
		return $insert_log;
	}

	function update_url($userid, $sub_code, $urlbimbingan, $status_url){
		$query 		= " UPDATE title_submission 
								SET status_url = '$status_url',
								url_judulbimbingan = '$urlbimbingan',
								upd = '$userid'
								WHERE
									submission_code = '$sub_code' ";
		$update 	= $this->db->query($query);
		return $update;
	}

	function insert_log_url($sub_code, $userid, $sub_status, $code_stats, $loker, $keterangan){
		$query 		= "INSERT INTO trans_title_submission(submission_code, submission_status, loker, upd_by, keterangan_upd, code_status)
						VALUES('".$sub_code."', '".$sub_status."', '".$loker."', '".$userid."','".$keterangan."', '".$code_stats."' )";
		$insert_log = $this->db->query($query);
		return $insert_log;
	}

	function get_data_status($sub_code) {
		$where = " submission_code= '$sub_code' ";
		$this->datatables->select("
			id,
			submission_status,
			loker,
			upd_by,
			keterangan_upd,
			urgensi,
			TO_CHAR(lup,'YYYY-MM-DD HH24:II:SS')AS lup
			");
		$this->datatables->from('trans_title_submission');
		$this->datatables->where($where);
		$data = $this->datatables->generate();
		return $data;
	}


}