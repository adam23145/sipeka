<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
/**
 * 
 */
class M_report_skripsi extends CI_Model
{

	function get_data_detail($date1, $date2, $group, $searchValue = null)
	{
		$where = " 1=1 ";

		if ($date1 != '' || $date2 != '') {

			if ($group != '0') {
				$where = " awalbimbingan BETWEEN '$date1' AND '$date2' AND ts.jurusan = '$group' ";
			} else {
				$where = " awalbimbingan BETWEEN '$date1' AND '$date2'  ";
			}
		} else {

			if ($group != '0') {
				$where = " ts.jurusan = '$group' ";
			} else {
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
		if (!empty($searchValue)) {
			$this->db->like('ts.student_name', $searchValue, 'both');
		}


		$data = $this->datatables->generate();
		return $data;
	}


	function get_data_detail_proses($date1, $date2, $group, $searchValue = null)
	{
		$where = " 1=1 AND status_bimb= 'Bimbingan Skripsi' ";

		if ($date1 != '' || $date2 != '') {

			if ($group != '0') {
				$where = " awalbimbingan BETWEEN '$date1' AND '$date2' AND ts.jurusan = '$group' AND status_bimb in('Bimbingan Skripsi','new') ";
			} else {
				$where = " awalbimbingan BETWEEN '$date1' AND '$date2' AND status_bimb in('Bimbingan Skripsi','new')  ";
			}
		} else {

			if ($group != '0') {
				$where = " ts.jurusan = '$group' AND status_bimb in('Bimbingan Skripsi','new') ";
			} else {
				$where = " 1=1 AND status_bimb in('Bimbingan Skripsi','new')  ";
				// $where = " 1=1 AND status_bimb= 'Bimbingan Skripsi'  ";
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
			d.nama,
			bs.keterangan_bimbingan,
			bs.status_bimb
			');
		$this->datatables->from('bimbingan_skripsi bs ');
		$this->datatables->join('title_submission ts', 'bs.submission_code = ts.submission_code');
		$this->datatables->join('m_dosen d', 'bs.dosbing = d.nip', 'left');
		$this->datatables->where($where);

		if (!empty($searchValue)) {
			$this->db->like('ts.student_name', $searchValue, 'both');
		}

		$data = $this->datatables->generate();
		return $data;
	}


	function get_data_detail_selesai($date1, $date2, $group)
	{
		$where = " 1=1 AND status_bimb= 'Setuju Sidang' ";

		if ($date1 != '' || $date2 != '') {

			if ($group != '0') {
				$where = " awalbimbingan BETWEEN '$date1' AND '$date2' AND ts.jurusan = '$group' AND status_bimb= 'Setuju Sidang' ";
			} else {
				$where = " awalbimbingan BETWEEN '$date1' AND '$date2' AND status_bimb= 'Setuju Sidang'  ";
			}
		} else {

			if ($group != '0') {
				$where = " ts.jurusan = '$group' AND status_bimb= 'Setuju Sidang' ";
			} else {
				$where = " 1=1 AND status_bimb= 'Setuju Sidang'  ";
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
			d.nama,
			bs.keterangan_bimbingan,
			bs.status_bimb
			');
		$this->datatables->from('bimbingan_skripsi bs');
		$this->datatables->join('title_submission ts', 'bs.submission_code = ts.submission_code');
		$this->datatables->join('m_dosen d', 'bs.dosbing = d.nip', 'left');
		$this->datatables->where($where);

	
		$data = $this->datatables->generate();
		return $data;
	}

	function get_jur($userid)
	{
		$query 		= "SELECT * FROM m_dosen WHERE status='aktif' AND email= '$userid' ORDER BY nama ASC";
		$data 		= $this->db->query($query)->result_array();
		return $data;
	}
}
