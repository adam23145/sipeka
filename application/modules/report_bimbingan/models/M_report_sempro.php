<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class M_report_sempro extends CI_Model {

	function get_data_profil($userid)
	{
		$this->db->where('email', $userid);
		$data = $this->db->get('m_dosen')->result_array();
		return $data;
	}

	function get_data_sempro($date1, $date2, $jrsn) {

		$where = " 1=1 ";

		if ($date1!='' || $date2!='') {

			if($jrsn!='0'){
				$where = " b.awalbimb BETWEEN '$date1' AND '$date2' AND ts.jurusan='$jrsn' ";
			}else{
				$where = " b.awalbimb BETWEEN '$date1' AND '$date2' ";
			}

		}else{
			if($jrsn!='0'){
				$where = " ts.jurusan='$jrsn' ";
			}else{
				$where = " 1=1 ";
			}
		}

		$this->datatables->select("
			b.id,
			b.nim,
			ts.student_name,
			ts.jurusan,
			b.title,
			b.dosbing,
			ds.nama,
			b.awalbimb,
			b.akhirbimb,
			b.status_bimb
			");
		$this->datatables->from("bimbingan b");
		$this->datatables->join("title_submission ts", "b.submission_code=ts.submission_code");
		$this->datatables->join('m_dosen ds', 'ds.nip=b.dosbing', 'left');
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