<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class M_list_dokumen extends CI_Model {

	// function get_data_history($usr) {
	// 	$where = " tsu.nim ='$usr' AND tsu.submission_code=bsi.submission_code AND tsu.nim=bsi.nim";
	// 	$this->datatables->select("
	// 		tsu.id,
	// 		tsu.submission_code,
	// 		tsu.title,
	// 		tsu.submission_status,
	// 		tsu.rms_maslh,
	// 		tsu.loker,
	// 		TO_CHAR(bsi.createddate,'YYYY-MM-DD HH24:II:SS')AS createddate,
	// 		TO_CHAR(bsi.lup,'YYYY-MM-DD HH24:II:SS')AS lup
	// 		");
	// 	$this->datatables->from("title_submission tsu, bimbingan bsi");
	// 	$this->datatables->where($where);
	// 	$this->datatables->add_column('action','<center>
 //            <button class="btn btn-primary btn-sm btn-view"><i style="color: white;" class="fa fa-eye"></i></button>
 //            </center>
 //            ');
	// 	$data = $this->datatables->generate();
	// 	return $data;
	// }

	function get_data_history($usr) {
		$where = " ts.nim ='$usr' AND ts.submission_code=dk.submission_code AND ts.nim=dk.nim";
		$this->datatables->select("
			dk.id,
			ts.title,
			ts.submission_code,
			dk.nim,
			dk.dokumen,
			dk.file_dok,
			dk.filepath,
			TO_CHAR(dk.lup,'YYYY-MM-DD HH24:II:SS')AS lup
			");
		$this->datatables->from("title_submission ts, dokumen dk");
		$this->datatables->where($where);
		$this->datatables->add_column('action','<center>
            <button class="btn btn-primary btn-sm btn-view">download</button>
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