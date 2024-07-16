<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
/**
 * 
 */
class M_report_skripsi extends CI_Model {

	function get_data_detail($date1, $date2, $group) {
		$where = " 1=1 " ;

		if ($date1!='' || $date2!='') {

			if ($group!='0'){
				$where = " awalbimbingan BETWEEN '$date1' AND '$date2' AND ts.jurusan = '$group' ";
			}else{
				$where = " awalbimbingan BETWEEN '$date1' AND '$date2'  ";
			}

			
		}else{
			
			if ($group!='0'){
				$where = " ts.jurusan = '$group' ";
			}else{
				$where = " 1=1  ";
			}
			
		}

		$this->datatables->select('
			bs.id as id,
			bs.nim,
			ts.student_name,
			ts.jurusan,
			bs.title,
			bs.createddate,
			bs.awalbimbingan,
			bs.terakhirbimbingan,
			bs.dosbing,
			bs.keterangan_bimbingan,
			bs.status_bimb
			');
		$this->datatables->from('bimbingan_skripsi bs ');
		$this->datatables->join('title_submission ts', 'bs.submission_code = ts.submission_code');
		$this->datatables->where($where);

		
		$data = $this->datatables->generate();
		return $data;
	}
}