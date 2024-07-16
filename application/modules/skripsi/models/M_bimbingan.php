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
		$where = "tsu.dosbing = '$kodedsn' AND tsu.submission_code=so.submission_code AND loker = 'Dosen' AND tsu.nim=so.nim AND tsu.submission_status='Bimbingan Skripsi' AND aksi!='pickup' ";
		$this->datatables->select("
			tsu.id,
			tsu.submission_code,
			tsu.nim,
			tsu.title,
			tsu.url_judulbimbingan,
			tsu.dosbing,
			tsu.student_name,
			so.tgl_sempro,
			tsu.submission_status
			");
		$this->datatables->from("title_submission tsu, sempro so");
		$this->datatables->where($where);
		$this->datatables->add_column('action','<center>
            <button class="btn btn-primary btn-sm btn-proses">proses</button>
            </center>
            ');
		$data = $this->datatables->generate();
		return $data;
	}

	function insert($submission_code, $title, $nim, $upd, $dosbing){
		$query	= " INSERT INTO bimbingan_skripsi(submission_code,nim,title,status_bimb,upd,dosbing,createddate) VALUES('".$submission_code."', '".$nim."', '".$title."', 'new','".$upd."', '".$dosbing."', CURRENT_TIMESTAMP) ";
		$insert = $this->db->query($query);
		return $insert;
	}

	function update_sub($submission_code, $nim, $upd, $id){
		$query	= " UPDATE title_submission SET aksi='pickup', code_status='Proses', date_modified=CURRENT_TIMESTAMP, keterangan_upd= 'Proses bimbingan skripsi', upd='".$upd."' WHERE id='".$id."' ";
		$update = $this->db->query($query);
		return $update;
	}

	function insert_log_sub($submission_code,$upd){
		$query	= " INSERT INTO trans_title_submission(submission_code,submission_status,loker,upd_by,keterangan_upd,code_status)VALUES('".$submission_code."', 'Bimbingan Skripsi', 'Dosen', '".$upd."', 'Proses bimbingan skripsi', 'Proses') ";
		$insert = $this->db->query($query);
		return $insert;
	}

}