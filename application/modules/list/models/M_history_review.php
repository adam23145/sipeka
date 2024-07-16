<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
/**
 * 
 */
class M_history_review extends CI_Model
{

	function get_data_detail($date1, $date2, $nmmhs, $userlevel, $ps, $pjgmhs, $searchValue = null)
	{
		$where = '';
		$tambahan = '';


		if ($userlevel == 'Dosen') {
			$tambahan = " AND ts.submission_status NOT IN ('In Review Koorprodi','In Review Sekjur','In Review Kajur') ";
			$tambahan2 = " ts.submission_status NOT IN ('In Review Koorprodi','In Review Sekjur','In Review Kajur') ";
		} else if ($userlevel == 'Kajur') {
			$tambahan = " AND ts.submission_status NOT IN ('In Review Koorprodi','In Review Sekjur','Tolak','Menunggu Review Koorprodi','Acc Koordinator Prodi') ";
			$tambahan2 = " ts.submission_status NOT IN ('In Review Koorprodi','In Review Sekjur','Tolak','Menunggu Review Koorprodi','Acc Koordinator Prodi') ";
		} else if ($userlevel == 'Sekjur') {
			$tambahan = " AND ts.submission_status NOT IN ('In Review Koorprodi', 'Tolak', 'Menunggu Review Koorprodi', 'Acc Koordinator Prodi','In Review Sekjur') ";
			$tambahan2 = " ts.submission_status NOT IN ('In Review Koorprodi', 'Tolak', 'Menunggu Review Koorprodi', 'Acc Koordinator Prodi','In Review Sekjur') ";
		} else if ($userlevel == 'Koordinator Prodi') {
			$tambahan = " AND ts.jurusan='$ps' AND ts.submission_status NOT IN ('Menunggu Review Koorprodi','Tolak') ";
		} else {
			$tambahan2 = "1=1";
		}

		if ($date1 != '' || $date2 != '') {
			if ($nmmhs != '0') {
				if ($pjgmhs > 0) {
					$where = "date(ts.createddate) BETWEEN '$date1' AND '$date2' AND nim IN ($nmmhs) " . $tambahan . "  ";
				} else {
					$where = "date(ts.createddate) BETWEEN '$date1' AND '$date2' " . $tambahan . "  ";
				}
			} else {
				$where = "date(ts.createddate) BETWEEN '$date1' AND '$date2' " . $tambahan . "  ";
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
			ds.nama,
			ts.createddate

			');
			$this->datatables->from('title_submission ts');
			$this->datatables->join('m_dosen ds', 'ds.nip=ts.dosbing', 'left');
			$this->datatables->where($where);
			if (!empty($searchValue)) {
				$this->db->like('ts.student_name', $searchValue, 'both');
			}
		} else {
			if ($nmmhs != '0') {
				if ($pjgmhs > 0) {
					$where = " nim IN ($nmmhs) " . $tambahan . "  ";
				} else {
					$where = " 1=1 " . $tambahan . " ";
				}
			} else {
				$where = " 1=1 " . $tambahan . " ";
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
			ds.nama,
			ts.createddate

			');
			$this->datatables->from('title_submission ts');
			$this->datatables->join('m_dosen ds', 'ds.nip=ts.dosbing', 'left');
			$this->datatables->where($where);
			
			if (!empty($searchValue)) {
				$this->db->like('ts.student_name', $searchValue, 'both');
			}
		}


		$data = $this->datatables->generate();
		return $data;
	}

	function get_data_koor($userid)
	{
		$query 		= "SELECT * FROM m_dosen WHERE status='aktif' AND jabatan !='Dosen' AND email='$userid' ";
		$data 		= $this->db->query($query)->result_array();
		return $data;
	}
}
