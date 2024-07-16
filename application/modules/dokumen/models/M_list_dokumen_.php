<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class M_list_dokumen extends CI_Model {

	function get_data_dokumen($stts_sub, $userlevel) {
		$where = "code_status='$stts_sub' and loker='$userlevel' " ;
		$this->datatables->select("
			id,
			submission_code,
			nim,
			student_name,
			rms_maslh,
			urgensi,
			title,
			jurusan,
			TO_CHAR(createddate,'YYYY-MM-DD HH24:II:SS')AS createddate
			");
		$this->datatables->from("title_submission");
		$this->datatables->where($where);
		$this->datatables->add_column('action','<center>
            <button class="btn btn-primary btn-sm btn-edit"><i style="color: white;" class="fa fa-pencil-alt"></i></button>
            </center>
            ');
		$data = $this->datatables->generate();
		return $data;
	}

	function update($id, $submission_code, $title, $rms_maslh, $upd){
		$query	= "UPDATE title_submission SET title='".$title."', rms_maslh='".$rms_maslh."' WHERE id='".$id."'AND submission_code='".$submission_code."' ";
		$update = $this->db->query($query);
		return $update;
	}

}