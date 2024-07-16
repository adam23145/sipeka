<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
/**
 * 
 */
class M_response extends CI_Model
{

	function get_sub($sub_code)
	{
		$query 		= "SELECT id, submission_code, nim, student_name, title, rms_maslh, jurusan, TO_CHAR(createddate,'YYYY-MM-DD HH24:II:SS')AS createddate, submission_status, loker, urgensi,code_status, dosbing FROM title_submission WHERE submission_code='$sub_code'";
		$data 		= $this->db->query($query)->result_array();
		return $data;
	}


	function update($userid, $sub_code, $id_sub, $stats, $loker_grp, $dosen, $aksi_stat, $reason)
	{
		$query 		= " UPDATE title_submission 
								SET submission_status = '$stats',
								code_status = '$aksi_stat',
								loker = '$loker_grp',
								keterangan_upd = '$reason',
								dosbing = '$dosen',
								upd = '$userid' 
								WHERE
								submission_code = '$sub_code' 
								AND ID = '$id_sub' ";
		$update 	= $this->db->query($query);
		return $update;
	}
	// public function update_title($submission_code, $new_title)
	// {
	// 	$this->db->set('title', $new_title);
	// 	$this->db->where('submission_code', $submission_code);
	// 	$this->db->update('title_submission');

	// 	return $this->db->affected_rows() > 0;
	// }
	// function get_current_title($submission_code)
	// {
	// 	$this->db->select('title');
	// 	$this->db->where('submission_code', $submission_code);
	// 	$query = $this->db->get('title_submission');
	// 	return $query->row_array()['title'];
	// }

	function update_title($submission_code, $new_title, $old_title,$username)
	{
		$data = array(
			'title' => $new_title,
			// tambahkan field yang ingin di-update
		);

		$this->db->where('submission_code', $submission_code);
		$this->db->update('title_submission', $data);

		if ($this->db->affected_rows() > 0) {
			$this->insert_title_log($submission_code, $old_title, $new_title,$username);
			return true;
		} else {
			return false;
		}
	}

	function insert_title_log($submission_code, $old_title, $new_title, $username)
	{
		$log_data = array(
			'submission_code' => $submission_code,
			'old_title' => $old_title,
			'new_title' => $new_title,
			'username' => $username,
		);

		$this->db->insert('title_submission_log', $log_data);

		return ($this->db->affected_rows() > 0) ? true : false;
	}
	function update_log($userid, $sub_code, $stats, $loker_grp, $reason, $aksi_stat, $aksi_log)
	{
		$query 		= "INSERT INTO trans_title_submission(submission_code,submission_status,loker,upd_by,keterangan_upd, code_status)
						VALUES('$sub_code','$stats','$loker_grp','$userid','$reason','$aksi_log')";
		$insert 	= $this->db->query($query);
		return $insert;
	}

	function insertdok($userid, $nim, $judul, $dosen, $sub_code)
	{
		$query 		= "INSERT INTO dokumen(submission_code, nim, title, dokumen, dosbing, upd, createddate,file_dok)
									VALUES('$sub_code','$nim','$judul','Cetak form kesediaan menjadi dosen pembimbing','$dosen','$userid', current_timestamp,'Form Kesediaan Menjadi Dosen Pembimbing.docx')";
		$insert 	= $this->db->query($query);
		return $insert;
	}


	function get_data_status($sub_code)
	{
		$this->datatables->select("
			id,
			submission_status,
			loker,
			upd_by,
			keterangan_upd,
			urgensi,
			TO_CHAR(lup,'YYYY-MM-DD HH24:II:SS')AS lup
			");
		$this->datatables->from("trans_title_submission");
		$this->datatables->where("submission_code='$sub_code'");
		$data = $this->datatables->generate();
		return $data;
	}
}
