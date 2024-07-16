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

	function get_data_sempro($date1, $date2, $nmmhs, $kodedsn) {
		$where = " ts.dosbing='$kodedsn' ";

		if ($date1!='' || $date2!='') {

			if ($nmmhs!='0'){
				$where = "awalbimb BETWEEN '$date1' AND '$date2' AND b.nim IN ($nmmhs) AND ts.dosbing='$kodedsn' AND b.status_bimb='Setuju' ";
			}else{
				$where = "awalbimb BETWEEN '$date1' AND '$date2' AND ts.dosbing='$kodedsn' AND b.status_bimb='Setuju' ";
			}
		}else{
			if ($nmmhs!='0'){
				$where = " b.nim IN ($nmmhs) AND ts.dosbing='$kodedsn' AND b.status_bimb='Setuju' ";
			}else{
				$where = " ts.dosbing='$kodedsn' AND b.status_bimb='Setuju' ";
			}
		}


		$this->datatables->select("
			b.id,
			b.nim,
			ts.student_name,
			ts.jurusan,
			ts.url_judulbimbingan,
			b.title,
			d.nama,
			b.dosbing,
			b.awalbimb,
			b.akhirbimb,
			b.status_bimb
			");
		$this->datatables->from("bimbingan b");
		$this->datatables->join("title_submission ts", "b.submission_code=ts.submission_code");
		$this->datatables->join("m_dosen d", "d.nip=b.dosbing");
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

	function get_dosen($userid){
		$query 		= "SELECT * FROM m_dosen WHERE status='aktif' AND email= '$userid' ORDER BY nama ASC";
		$data 		= $this->db->query($query)->result_array();
		return $data;
	}

}