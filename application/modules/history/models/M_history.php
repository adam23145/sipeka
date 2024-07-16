<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class M_history extends CI_Model {

	function get_data_history($usr) {
		$where = " nim ='$usr' ";
		$this->datatables->select("
			id,
			submission_code,
			title,
			submission_status,
			rms_maslh,
			loker,
			TO_CHAR(createddate,'YYYY-MM-DD HH24:II:SS')AS createddate,
			TO_CHAR(lup,'YYYY-MM-DD HH24:II:SS')AS lup
			");
		$this->datatables->from("title_submission");
		$this->datatables->where($where);
		$this->datatables->add_column('action','<center>
            <button class="btn btn-primary btn-sm btn-edit"><i style="color: white;" class="fa fa-pencil-alt"></i></button>
            <!-- <button class="btn btn-success btn-sm btn-view"><i style="color: white;" class="far fa-eye"></i></button> -->
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