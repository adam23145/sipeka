<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class M_bimbinganSkripsi extends CI_Model {

	function get_data_history($usr) {
		$where = " tsu.nim ='$usr' AND tsu.submission_code=bsi.submission_code AND tsu.nim=bsi.nim";
		$this->datatables->select("
			tsu.id,
			tsu.submission_code,
			tsu.title,
			tsu.submission_status,
			tsu.rms_maslh,
			tsu.loker,
			TO_CHAR(bsi.createddate,'YYYY-MM-DD HH24:II:SS')AS createddate,
			TO_CHAR(bsi.lup,'YYYY-MM-DD HH24:II:SS')AS lup
			");
		$this->datatables->from("title_submission tsu, bimbingan_skripsi bsi");
		$this->datatables->where($where);
		$this->datatables->add_column('action','<center>
            <button class="btn btn-primary btn-sm btn-view"><i style="color: white;" class="fa fa-eye"></i></button>
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