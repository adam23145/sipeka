<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
/**
 * 
 */
class M_daftar_judul extends CI_Model {

	function get_data_detail($date1, $date2, $group) {
		$where = '';

		if ($date1!='' || $date2!='') {
			if ($group!='0'){
				$where = " ts.date(createddate) BETWEEN '$date1' AND '$date2' AND ts.jurusan = '$group' AND ts.submission_status <> 'Tolak' ";
			}else{
				$where = " ts.date(createddate) BETWEEN '$date1' AND '$date2' AND ts.submission_status <> 'Tolak'  ";
			}

			$this->datatables->select('
			ts.id,
			ts.submission_code,
			ts.nim,
			ts.student_name,
			ts.title,
			ts.rms_maslh,
			ts.jurusan,
			ts.submission_status,
			ts.loker,
			ts.upd,
			ts.keterangan_upd,
			ts.dosbing,
			d.nama,
			ts.createddate

			');
			$this->datatables->from('title_submission ts');
			$this->datatables->join('m_dosen d', 'ts.dosbing=d.nip', 'left');
			$this->datatables->where($where);
		}else{
			if ($group!='0'){
				$where = "  ts.jurusan = '$group' AND ts.submission_status <> 'Tolak' ";
			}else{
				$where = " 1=1 AND ts.submission_status <> 'Tolak'";
			}


			$this->datatables->select('
			ts.id,
			ts.submission_code,
			ts.nim,
			ts.student_name,
			ts.title,
			ts.rms_maslh,
			ts.jurusan,
			ts.submission_status,
			ts.loker,
			ts.upd,
			ts.keterangan_upd,
			ts.dosbing,
			d.nama,
			ts.createddate

			');
			$this->datatables->from('title_submission ts');
			$this->datatables->join('m_dosen d', 'ts.dosbing=d.nip', 'left');
			$this->datatables->where($where);
		}

		
		$data = $this->datatables->generate();
		return $data;
	}
}