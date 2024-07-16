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
		$where = "b.dosbing = '$kodedsn' and b.status_bimb in ('new','Bimbingan') ";
		$this->datatables->select("
			b.id,
			b.submission_code,
			b.nim,
			ts.student_name,
			ts.url_judulbimbingan,
			b.title,
			b.dosbing,
			b.bimbingan_ke,
			b.status_bimb
			");
		$this->datatables->from("bimbingan b");
		$this->datatables->join("title_submission ts","b.submission_code=ts.submission_code");
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
		$query	= " INSERT INTO bimbingan(submission_code,nim,title,status_bimb,upd,dosbing) VALUES('".$submission_code."', '".$nim."', '".$title."', 'new','".$upd."', '".$dosbing."') ";
		$update = $this->db->query($query);
		return $update;
	}

}