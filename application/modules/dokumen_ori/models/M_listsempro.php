<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class M_listsempro extends CI_Model {

	function get_doksempro($usr) {
		$where = " nim ='$usr' ";
		$this->datatables->select("
			id,
			submission_code,
			title,
			tgl_sempro,
			nim,
			penguji,
			file_basempro,
			file_proposal
			");
		$this->datatables->from("sempro");
		$this->datatables->where($where);
		// $this->datatables->add_column('action','<center>
  //           <button class="btn btn-primary btn-sm btn-edit"><i style="color: white;" class="fa fa-pencil-alt"></i></button>
  //           <!-- <button class="btn btn-success btn-sm btn-view"><i style="color: white;" class="far fa-eye"></i></button> -->
  //           </center>
  //           ');
		$data = $this->datatables->generate();
		return $data;
	}

	function update($id, $submission_code, $title, $rms_maslh, $upd){
		$query	= "UPDATE title_submission SET title='".$title."', rms_maslh='".$rms_maslh."' WHERE id='".$id."'AND submission_code='".$submission_code."' ";
		$update = $this->db->query($query);
		return $update;
	}

}