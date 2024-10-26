<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class M_list_pengajuan extends CI_Model {

	function get_data_pengajuan($stts_sub, $userlevel, $searchValue = null) {


		if($userlevel=='Wadek' || $userlevel=='Dekan'){
			$where = "code_status='$stts_sub' " ;
		}else if($userlevel=='Sekjur' || $userlevel=='Kajur'){
			if($stts_sub == 'Tolak' || $stts_sub == 'tolak' ){
				$where = " submission_status='$stts_sub'  " ;
			}else{
				$where = "code_status='$stts_sub' and loker='$userlevel' " ;
			}
			
		}else{
			$where = "code_status='$stts_sub' and loker='$userlevel' AND jurusan='$ps' " ;
		}
		$this->datatables->select("
			id,
			submission_code,
			nim,
			student_name,
			rms_maslh,
			urgensi,
			title,
			jurusan,
			TO_CHAR(createddate,'YYYY-MM-DD HH24:II:SS')AS createddate,
			code_status,
			,
	(CASE WHEN submission_status = 'Tolak' THEN '<center><button class=\"btn btn-primary btn-sm disable\"><i style=\"color: white;\" class=\"fa fa-pencil-alt\"></i></button></center>'
				WHEN submission_status != 'Tolak' THEN '<center><button class=\"btn btn-primary btn-sm btn-edit\"><i style=\"color: white;\" class=\"fa fa-pencil-alt\"></i></button></center>' END) as action
			");
		$this->datatables->from("title_submission");
		$this->datatables->where($where);
		if (!empty($searchValue)) {
			$this->db->like('student_name', $searchValue, 'both');
		}
		// $this->datatables->add_column('action','<center>
  //           <button class="btn btn-primary btn-sm btn-edit"><i style="color: white;" class="fa fa-pencil-alt"></i></button>
  //           </center>
  //           ');
		$data = $this->datatables->generate();
		return $data;
	}

	function get_data_pengajuanx($stts_sub,$userlevel,$ps, $searchValue = null) {
		if($stts_sub == 'Tolak'){
			$where = "submission_status='$stts_sub' AND jurusan='$ps' " ;
		}else{
			$where = "code_status='$stts_sub' and loker='$userlevel' AND jurusan='$ps' " ;
		}
		
		$this->datatables->select("
			id,
			submission_code,
			nim,
			student_name,
			rms_maslh,
			urgensi,
			title,
			jurusan,
			TO_CHAR(createddate,'YYYY-MM-DD HH24:II:SS')AS createddate,
			code_status
			");
		$this->datatables->from("title_submission");
		$this->datatables->where($where);
		if (!empty($searchValue)) {
			$this->db->like('student_name', $searchValue, 'both');
		}
		$this->datatables->add_column('action','<center>
            <button class="btn btn-primary btn-sm btn-edit"><i style="color: white;" class="fa fa-pencil-alt"></i></button>
            </center>
            ');
		$data = $this->datatables->generate();
		return $data;
	}

	function get_data_pengajuanxx($stts_sub,$userlevel) {
		

			$where = " submission_status='$stts_sub'  " ;
		
		$this->datatables->select("
			id,
			submission_code,
			nim,
			student_name,
			rms_maslh,
			urgensi,
			title,
			jurusan,
			TO_CHAR(createddate,'YYYY-MM-DD HH24:II:SS')AS createddate,
			code_status
			");
		$this->datatables->from("title_submission");
		$this->datatables->where($where);
		$this->datatables->add_column('action','<center>
            <button class="btn btn-primary  disabled"><i style="color: white;" class="fa fa-pencil-alt"></i></button>
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

	function get_data_koor($userid){
		$query 		= "SELECT * FROM m_dosen WHERE status='aktif' AND jabatan !='Dosen' AND email='$userid' ";
		$data 		= $this->db->query($query)->result_array();
		return $data;
	}

}