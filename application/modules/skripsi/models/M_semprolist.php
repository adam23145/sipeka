<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class M_semprolist extends CI_Model {

	function get_data_profil($userid)
	{
		$this->db->where('email', $userid);
		$data = $this->db->get('m_dosen')->result_array();
		return $data;
	}

	function get_data_sempro($kodedsn) {
		$where = "dosbing = '$kodedsn' and submission_status in ('Seminar Proposal') AND tm.nim=m.nim ";
		$this->datatables->select("
			tm.id,
			tm.submission_code,
			tm.nim,
			m.nama,
			tm.title,
			tm.dosbing,
			tm.submission_status
			");
		$this->datatables->from("title_submission tm, m_mahasiswa m");
		$this->datatables->where($where);
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