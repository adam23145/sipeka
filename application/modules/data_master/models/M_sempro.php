<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
/**
 * 
 */
class M_sempro extends CI_Model {

	function get_data_sempro($res_prodi) {
		$where = " 1=1 AND jurusan='$res_prodi' ";
		$this->datatables->select('
			ROW_NUMBER() OVER (ORDER BY b.id DESC) AS no_urut,
			b.id,
			ts.nim,
			ts.url_judulbimbingan,
			ts.submission_status,
			ts.loker,
			ts.student_name,
			ts.title,
			b.status_bimb,
			ts.dosbing,
			ds.nama,
			b.submission_code
			');
		$this->datatables->from('bimbingan b');
		$this->datatables->join('title_submission ts','b.submission_code=ts.submission_code');
		$this->datatables->join('m_dosen ds','ts.dosbing=ds.nip');
		$this->datatables->where($where);
		$this->datatables->add_column('action','<center>
            <button class="btn btn-primary btn-sm btn-edit"><i style="color: white;" class="fa fa-pencil-alt"></i></button>
            </center>
            ');
		$data = $this->datatables->generate();
		return $data;
	}

	function updatejudul($id, $submission_code, $nim, $jdlskrip, $upd){
		$query 		= " UPDATE bimbingan 
								SET title = '$jdlskrip',
								upd = '$upd'
								WHERE
									submission_code = '$submission_code' ";
		$update 	= $this->db->query($query);
		return $update;
	}

	function updatejudul2($id, $submission_code, $pembimbbar, $nim, $jdlskrip, $upd){
		$query 		= " UPDATE bimbingan 
								SET title = '$jdlskrip',
								dosbing = '$pembimbbar',
								upd = '$upd'
								WHERE
									submission_code = '$submission_code' ";
		$update 	= $this->db->query($query);
		return $update;
	}

	function updatesub($id, $submission_code, $nim, $jdlskrip, $upd){
		$query 		= " UPDATE title_submission 
								SET title = '$jdlskrip',
								upd = '$upd'
								WHERE
									submission_code = '$submission_code' ";
		$update 	= $this->db->query($query);
		return $update;
	}

	function updatesub2($id, $submission_code, $pembimbbar, $nim, $jdlskrip, $upd){
		$query 		= " UPDATE title_submission 
								SET title = '$jdlskrip',
								dosbing = '$pembimbbar',
								upd = '$upd'
								WHERE
									submission_code = '$submission_code' ";
		$update 	= $this->db->query($query);
		return $update;
	}

	function insertlogsub($submission_code, $submission_status, $loker, $upd, $ket){
		$query 		= " INSERT INTO trans_title_submission (submission_code, submission_status, loker, upd_by, keterangan_upd)
						VALUES('".$submission_code."', '".$submission_status."', '".$loker."', '".$upd."', '".$ket."') ";
		$insert 	= $this->db->query($query);
		return $insert;
	}

}