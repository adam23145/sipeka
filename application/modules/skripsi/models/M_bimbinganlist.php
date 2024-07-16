<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class M_bimbinganlist extends CI_Model {

	function get_data_profil($userid)
	{
		$this->db->where('email', $userid);
		$data = $this->db->get('m_dosen')->result_array();
		return $data;
	}

	function get_data_bimbingan($kodedsn) {
		$where = "ba.dosbing = '$kodedsn' and ba.status_bimb in ('new','Bimbingan Skripsi') ";
		$this->datatables->select("
			ba.id,
			ba.submission_code,
			ba.nim,
			ts.student_name,
			ts.url_judulbimbingan,
			ba.title,
			ba.dosbing,
			ba.bimbingan_ke,
			ba.status_bimb
			");
		$this->datatables->from("bimbingan_skripsi ba");
		$this->datatables->join("title_submission ts", "ba.submission_code=ts.submission_code");
		$this->datatables->where($where);
		$this->datatables->add_column('action','<center>
            <button class="btn btn-primary btn-sm btn-edit">edit</button>
            </center>
            ');
		$data = $this->datatables->generate();
		return $data;
	}

	function update($id, $submission_code, $upd){
		$query	= " UPDATE title_submission SET aksi='pickup', upd='".$upd."' WHERE id='".$id."' ";
		$update = $this->db->query($query);
		return $update;
	}

	function insert($submission_code, $title, $nim, $upd, $dosbing){
		$query	= " INSERT INTO bimbingan_skripsi(submission_code,nim,title,status_bimb,upd,dosbing) VALUES('".$submission_code."', '".$nim."', '".$title."', 'new','".$upd."', '".$dosbing."') ";
		$update = $this->db->query($query);
		return $update;
	}

}