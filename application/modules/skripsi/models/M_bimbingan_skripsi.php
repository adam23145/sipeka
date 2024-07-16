<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
/**
 * 
 */
class M_bimbingan_skripsi extends CI_Model {

	function get_data_detail($date1, $date2, $group, $nipdosen) {
		$where = " bs.dosbing='$nipdosen' AND bs.status_bimb = 'Setuju Sidang' " ;

		if ($date1!='' || $date2!='') {
			if ($group!='0'){
				$where = " bs.dosbing='$nipdosen' AND date(bs.createddate) BETWEEN '$date1' AND '$date2' AND ts.jurusan = '$group' AND bs.status_bimb = 'Setuju Sidang' ";
			}else{
				$where = " bs.dosbing='$nipdosen' AND date(bs.createddate) BETWEEN '$date1' AND '$date2' AND bs.status_bimb = 'Setuju Sidang'  ";
			}

			$this->datatables->select('
			bs.id as id,
			bs.nim,
			ts.student_name,
			ts.url_judulbimbingan,
			ts.jurusan,
			bs.title,
			bs.createddate,
			bs.awalbimbingan,
			bs.terakhirbimbingan,
			bs.dosbing,
			d.nama AS namados,
			bs.keterangan_bimbingan,
			bs.status_bimb
			');
			$this->datatables->from('bimbingan_skripsi bs ');
			$this->datatables->join('title_submission ts', 'bs.submission_code = ts.submission_code');
			$this->datatables->join('m_dosen d', 'bs.dosbing = d.nip');
			$this->datatables->where($where);
		}else{
			$this->datatables->select('
			bs.id as id,
			bs.nim,
			ts.student_name,
			ts.url_judulbimbingan,
			ts.jurusan,
			bs.title,
			bs.createddate,
			bs.awalbimbingan,
			bs.terakhirbimbingan,
			bs.dosbing,
			d.nama AS namados,
			bs.keterangan_bimbingan,
			bs.status_bimb
			');
			$this->datatables->from('bimbingan_skripsi bs ');
			$this->datatables->join('title_submission ts', 'bs.submission_code = ts.submission_code');
			$this->datatables->join('m_dosen d', 'bs.dosbing = d.nip');
			$this->datatables->where($where);
			
		}

		
		$data = $this->datatables->generate();
		return $data;
	}
}