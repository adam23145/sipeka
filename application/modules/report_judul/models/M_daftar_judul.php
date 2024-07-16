<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
/**
 * 
 */
class M_daftar_judul extends CI_Model {

	function get_data_detail($date1, $date2, $group) {
		$where = " submission_status='Menunggu Review Koorprodi' AND code_status='New' ";

		if ($date1!='' || $date2!='') {
			if ($group!='0'){
				$where = "date(createddate) BETWEEN '$date1' AND '$date2' AND jurusan = '$group' AND submission_status='Menunggu Review Koorprodi' AND code_status='New' ";
			}else{
				$where = "date(createddate) BETWEEN '$date1' AND '$date2' AND submission_status='Menunggu Review Koorprodi' AND code_status='New'  ";
			}

			$this->datatables->select('
			id,
			submission_code,
			nim,
			student_name,
			title,
			rms_maslh,
			jurusan,
			submission_status,
			loker,
			upd,
			keterangan_upd,
			dosbing,
			createddate

			');
			$this->datatables->from('title_submission');
			$this->datatables->where($where);
		}else{
			$this->datatables->select('
			id,
			submission_code,
			nim,
			student_name,
			title,
			rms_maslh,
			jurusan,
			submission_status,
			loker,
			upd,
			keterangan_upd,
			dosbing,
			createddate

			');
			$this->datatables->from('title_submission');
			$this->datatables->where($where);
		}

		
		$data = $this->datatables->generate();
		return $data;
	}

	function get_data_detail_ditolak($date1, $date2, $group) {
		$where = " submission_status='Tolak' ";

		if ($date1!='' || $date2!='') {
			if ($group!='0'){
				$where = "date(createddate) BETWEEN '$date1' AND '$date2' AND jurusan = '$group' AND submission_status='Tolak' ";
			}else{
				$where = "date(createddate) BETWEEN '$date1' AND '$date2' AND submission_status='Tolak'  ";
			}

			$this->datatables->select('
			id,
			submission_code,
			nim,
			student_name,
			title,
			rms_maslh,
			jurusan,
			submission_status,
			loker,
			upd,
			keterangan_upd,
			dosbing,
			createddate

			');
			$this->datatables->from('title_submission');
			$this->datatables->where($where);
		}else{
			$this->datatables->select('
			id,
			submission_code,
			nim,
			student_name,
			title,
			rms_maslh,
			jurusan,
			submission_status,
			loker,
			upd,
			keterangan_upd,
			dosbing,
			createddate

			');
			$this->datatables->from('title_submission');
			$this->datatables->where($where);
		}

		
		$data = $this->datatables->generate();
		return $data;
	}

	function get_data_detail_revisi($date1, $date2, $group) {
		$where = " code_status='Submit revisi' ";

		if ($date1!='' || $date2!='') {
			if ($group!='0'){
				$where = "date(createddate) BETWEEN '$date1' AND '$date2' AND jurusan = '$group' AND code_status='Submit revisi' ";
			}else{
				$where = "date(createddate) BETWEEN '$date1' AND '$date2' AND code_status='Submit revisi'  ";
			}

			$this->datatables->select('
			id,
			submission_code,
			nim,
			student_name,
			title,
			rms_maslh,
			jurusan,
			submission_status,
			loker,
			upd,
			keterangan_upd,
			dosbing,
			createddate

			');
			$this->datatables->from('title_submission');
			$this->datatables->where($where);
		}else{
			$this->datatables->select('
			id,
			submission_code,
			nim,
			student_name,
			title,
			rms_maslh,
			jurusan,
			submission_status,
			loker,
			upd,
			keterangan_upd,
			dosbing,
			createddate

			');
			$this->datatables->from('title_submission');
			$this->datatables->where($where);
		}

		
		$data = $this->datatables->generate();
		return $data;
	}
}