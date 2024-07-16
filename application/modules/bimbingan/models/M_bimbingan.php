<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class M_bimbingan extends CI_Model {

	function get_data_profil($userid)
	{
		$this->db->where('email', $userid);
		$data = $this->db->get('m_dosen')->result_array();
		return $data;
	}

	function get_data_bimbingan($kodedsn) {
		$where = "dosbing = '$kodedsn' AND loker = 'Dosen' and aksi !='pickup' and submission_status='In Review Dosen' ";
		$this->datatables->select("
			id,
			submission_code,
			nim,
			url_judulbimbingan,
			title,
			dosbing,
			student_name,
			TO_CHAR(createddate,'YYYY-MM-DD HH24:II:SS')AS createddate,
			submission_status,
			loker
			");
		$this->datatables->from("title_submission");
		$this->datatables->where($where);
		$this->datatables->add_column('action','<center>
            <button class="btn btn-info btn-sm btn-edit">proses</button>
            </center>
            ');
		$data = $this->datatables->generate();
		return $data;
	}

	function update($id, $submission_code, $upd, $stts_sub, $stts_code, $keter){
		$query	= " UPDATE title_submission SET aksi='pickup', upd='".$upd."', submission_status='".$stts_sub."', code_status='".$stts_code."', keterangan_upd='".$keter."' WHERE id='".$id."' ";
		$update = $this->db->query($query);
		return $update;
	}

	function insert_logsub($id, $submission_code, $upd, $stts_sub, $stts_code, $keter, $loker){
		$query	= " INSERT INTO trans_title_submission (submission_code,submission_status,loker,upd_by,keterangan_upd,code_status ) VALUES('".$submission_code."', '".$stts_sub."', '".$loker."', '".$upd."', '".$keter."', '".$stts_code."' ) ";
		$insert = $this->db->query($query);
		return $insert;
	}

	function insert($submission_code, $title, $nim, $upd, $dosbing){
		$query	= " INSERT INTO bimbingan(submission_code,nim,title,status_bimb,upd,dosbing,createddate) VALUES('".$submission_code."', '".$nim."', '".$title."', 'new','".$upd."', '".$dosbing."',current_timestamp) ";
		$update = $this->db->query($query);
		return $update;
	}

}