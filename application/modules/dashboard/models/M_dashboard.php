<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
/**
 * 
 */
class M_dashboard extends CI_Model
{

	function get_status_st($userid)
	{
		$query 		= "SELECT * FROM m_dosen WHERE status='aktif' AND email='$userid' ";
		$data 		= $this->db->query($query)->result_array();
		return $data;
	}

	function get_revisi($jur, $lvl)
	{
		if ($lvl == 'Wadek' || $lvl == 'Dekan') {
			$query 		= "SELECT count(*) as jmlrevisi FROM title_submission WHERE code_status='Submit revisi' ";
			$data 		= $this->db->query($query)->result_array();
		} else if ($lvl == 'Sekjur' || $lvl == 'Kajur') {
			$query 		= "SELECT count(*) as jmlrevisi FROM title_submission WHERE code_status='Submit revisi' AND loker='$lvl' ";
			$data 		= $this->db->query($query)->result_array();
		} else if ($lvl == 'Admin Prodi') {
			$query 		= "SELECT count(*) as jmlrevisi FROM title_submission WHERE code_status='Submit revisi' AND jurusan='$jur'";
			$data 		= $this->db->query($query)->result_array();
		} else {
			$query 		= "SELECT count(*) as jmlrevisi FROM title_submission WHERE code_status='Submit revisi' AND jurusan='$jur' AND loker='$lvl' ";
			$data 		= $this->db->query($query)->result_array();
		}

		return $data;
	}

	function get_count($jur, $lvl)
	{
		if ($lvl == 'Wadek' || $lvl == 'Dekan') {
			$query 		= "SELECT count(*) as jmlnew FROM title_submission WHERE code_status='New' AND submission_status='Menunggu Review Koorprodi' ";
			$data 		= $this->db->query($query)->result_array();
		} else if ($lvl == 'Sekjur' || $lvl == 'Kajur') {
			$query 		= "SELECT count(*) as jmlnew FROM title_submission WHERE code_status='New' AND loker='$lvl' ";
			$data 		= $this->db->query($query)->result_array();
		} else if ($lvl == 'Admin Prodi') {
			$query 		= "SELECT count(*) as jmlnew FROM title_submission WHERE code_status='New' AND jurusan='$jur' AND loker='Koordinator Prodi' ";
			$data 		= $this->db->query($query)->result_array();
		} else {
			$query 		= "SELECT count(*) as jmlnew FROM title_submission WHERE code_status='New' AND jurusan='$jur' AND loker='$lvl' ";
			$data 		= $this->db->query($query)->result_array();
		}

		return $data;
	}

	function get_counttolak($jur, $lvl)
	{
		if ($lvl == 'Wadek' || $lvl == 'Dekan') {
			$query 		= "SELECT count(*) as jmltolak FROM title_submission WHERE  submission_status='Tolak' ";
			$data 		= $this->db->query($query)->result_array();
		} else if ($lvl == 'Sekjur' || $lvl == 'Kajur') {
			$query 		= "SELECT count(*) as jmltolak FROM title_submission WHERE  submission_status='Tolak' ";
			$data 		= $this->db->query($query)->result_array();
		} else {
			$query 		= "SELECT count(*) as jmltolak FROM title_submission WHERE  jurusan='$jur' AND submission_status='Tolak' ";
			$data 		= $this->db->query($query)->result_array();
		}

		return $data;
	}

	function get_countall($jur, $lvl)
	{
		if ($lvl == 'Wadek' || $lvl == 'Dekan') {
			$query 		= "SELECT count(*) as jmlall FROM title_submission WHERE 1=1 AND submission_status NOT IN ('Tolak') ";
			$data 		= $this->db->query($query)->result_array();
		} else if ($lvl == 'Sekjur' || $lvl == 'Kajur') {
			$query 		= "SELECT count(*) as jmlall FROM title_submission WHERE  loker='$lvl' ";
			$data 		= $this->db->query($query)->result_array();
		} else if ($lvl == 'Admin Prodi') {
			$query 		= "SELECT count(*) as jmlall FROM title_submission WHERE  jurusan='$jur'";
			$data 		= $this->db->query($query)->result_array();
		}else {
			$query 		= "SELECT count(*) as jmlall FROM title_submission WHERE  jurusan='$jur' AND loker='$lvl' ";
			$data 		= $this->db->query($query)->result_array();
		}

		return $data;
	}

	function get_count_rev($jur, $lvl)
	{

		if ($lvl == 'Koordinator Prodi') {
			$query 		= "SELECT count(*) as jmlrev FROM title_submission WHERE submission_status='In Review Koorprodi' AND jurusan='$jur' AND loker='$lvl' ";
		} else {
			$query 		= "SELECT count(*) as jmlrev FROM title_submission WHERE submission_status='In Review $lvl' AND loker='$lvl' AND code_status!='New' ";
		}

		$data 		= $this->db->query($query)->result_array();
		return $data;
	}

	function get_count_app($userid, $lvl, $jur)
	{
		if ($lvl == 'Kajur') {
			$query 		= "	SELECT count(*) as jmlapp FROM title_submission WHERE submission_status NOT IN ('Menunggu Review Koorprodi','Tolak','In Review Sekjur','In Review Kajur') ";

			// $query 		= "	SELECT COUNT
			// 					( * ) AS jmlapp 
			// 				FROM
			// 					trans_title_submission tts JOIN title_submission tsu ON tts.submission_code = tsu.submission_code
			// 				WHERE
			// 					tts.submission_status ='Acc Kajur' AND upd_by='".$userid."' ";
		} else if ($lvl == 'Sekjur') {
			$query 		= "	SELECT count(*) as jmlapp FROM title_submission WHERE submission_status NOT IN ('Menunggu Review Koorprodi','Tolak','In Review Sekjur') ";

			// $query 		= "	SELECT COUNT
			// 					( * ) AS jmlapp 
			// 				FROM
			// 					trans_title_submission tts JOIN title_submission tsu ON tts.submission_code = tsu.submission_code
			// 				WHERE
			// 					tts.submission_status ='Acc Sekjur' AND upd_by='".$userid."' ";In Review Sekjur
		} else {
			$query 		= "SELECT count(*) as jmlapp FROM title_submission WHERE jurusan='$jur' AND submission_status NOT IN ('Menunggu Review Koorprodi','Tolak') ";
			// $query 		= "SELECT count(*) as jmlapp FROM trans_title_submission WHERE submission_status='Acc Koordinator Prodi' AND upd_by='".$userid."' ";
		}

		$data 		= $this->db->query($query)->result_array();
		return $data;
	}


	function get_baru_sem($userid, $lvl)
	{
		$query 		= "SELECT count(*) as jmlnew_sem FROM title_submission WHERE code_status='New' AND submission_status='In Review Dosen' ";
		$data 		= $this->db->query($query)->result_array();
		return $data;
	}


	function get_newsempro($userid, $lvl, $jur)
	{
		if ($lvl == 'Koordinator Prodi') {
			$query 		= "SELECT count(*) as newsempro FROM title_submission WHERE code_status='New' AND submission_status='In Review Dosen' AND aksi ='none' AND jurusan = '$jur' ";
			$data 		= $this->db->query($query)->result_array();
			return $data;
		} else {
			$query 		= "SELECT count(*) as newsempro FROM title_submission WHERE code_status='New' AND submission_status='In Review Dosen' AND aksi ='none' ";
			$data 		= $this->db->query($query)->result_array();
			return $data;
		}
	}

	function get_pr_sem($userid, $lvl, $jur)
	{
		$where = " ";
		if ($lvl == 'Koordinator Prodi') {
			$query 		= "SELECT count(b.id) as jmlproses_sem FROM bimbingan b, title_submission ts WHERE b.submission_code=ts.submission_code AND b.status_bimb!='Setuju' AND ts.jurusan='$jur' ";
			$where = " AND ts.jurusan='$jur' ";
		} else {
			$query 		= "SELECT count(b.id) as jmlproses_sem FROM bimbingan b, title_submission ts WHERE b.submission_code=ts.submission_code AND b.status_bimb!='Setuju' ";
		}

		$data 		= $this->db->query($query)->result_array();
		return $data;
	}

	function get_end_sem($userid, $lvl, $jur)
	{
		if ($lvl == 'Koordinator Prodi') {
			$query 		= "SELECT count(b.submission_code) as jmlend_sem FROM bimbingan b, title_submission ts WHERE b.submission_code=ts.submission_code AND b.status_bimb='Setuju' AND ts.jurusan='$jur' ";
		} else {
			$query 		= "SELECT count(b.submission_code) as jmlend_sem FROM bimbingan b, title_submission ts WHERE b.submission_code=ts.submission_code AND b.status_bimb='Setuju'  ";
		}
		// $query 		= "SELECT count(*) as jmlend_sem FROM bimbingan WHERE status_bimb='Setuju' ";
		$data 		= $this->db->query($query)->result_array();
		return $data;
	}

	function get_baru($userid, $lvl, $jur)
	{
		$query 		= "SELECT count(*) as jmlnew FROM title_submission WHERE code_status='New' AND submission_status='Bimbingan Skripsi'  ";
		$data 		= $this->db->query($query)->result_array();
		return $data;
	}

	function get_pr($userid, $lvl, $jur)
	{
		if ($lvl == 'Koordinator Prodi') {
			$query 		= "SELECT count(bs.id) as jmlproses FROM bimbingan_skripsi bs, title_submission ts WHERE bs.submission_code=ts.submission_code AND bs.status_bimb in ('Bimbingan Skripsi','new') AND ts.jurusan='$jur'  ";
		} else {
			$query 		= "SELECT count(*) as jmlproses FROM bimbingan_skripsi WHERE status_bimb in ('Bimbingan Skripsi','new') ";
			// $query 		= "SELECT count(*) as jmlproses FROM bimbingan_skripsi WHERE status_bimb='Bimbingan Skripsi' ";
		}

		$data 		= $this->db->query($query)->result_array();
		return $data;
	}

	function get_end($userid, $lvl, $jur)
	{
		if ($lvl == 'Koordinator Prodi') {
			$query 		= "SELECT count(bs.id) as jmlend FROM bimbingan_skripsi bs, title_submission ts WHERE bs.submission_code=ts.submission_code AND status_bimb='Setuju Sidang' AND ts.jurusan='$jur' ";
		} else {
			$query 		= "SELECT count(*) as jmlend FROM bimbingan_skripsi WHERE status_bimb='Setuju Sidang' ";
		}
		$data 		= $this->db->query($query)->result_array();
		return $data;
	}

	function cek_ayat()
	{
		// $query 		= "SELECT count(id) as jml FROM title_submission WHERE nim='$nim' AND submission_status !='Tolak' ";
		$query 		= "SELECT count(1) as jml FROM mapping_hafalan_ayat ";
		$data 		= $this->db->query($query)->result_array();
		return $data;
	}

	function cek_hadist()
	{
		// $query 		= "SELECT count(id) as jml FROM title_submission WHERE nim='$nim' AND submission_status !='Tolak' ";
		$query 		= "SELECT count(1) as jml FROM mapping_hafalan_hadist  ";
		$data 		= $this->db->query($query)->result_array();
		return $data;
	}

	function cek_kk()
	{
		// $query 		= "SELECT count(id) as jml FROM title_submission WHERE nim='$nim' AND submission_status !='Tolak' ";
		$query 		= "SELECT count(1) as jml FROM mapping_hafalan_kk ";
		$data 		= $this->db->query($query)->result_array();
		return $data;
	}

	function cek_qq()
	{
		// $query 		= "SELECT count(id) as jml FROM title_submission WHERE nim='$nim' AND submission_status !='Tolak' ";
		$query 		= "SELECT count(1) as jml FROM mapping_hafalan_qq ";
		$data 		= $this->db->query($query)->result_array();
		return $data;
	}
	public function count_skripsiriset()
	{
		$this->db->where('status_pengajuan', 'Menunggu');
		$query = $this->db->get('skripsi_riset');
		return $query->num_rows();
	}
	public function count_mbkm($jur)
	{
		$this->db->where('status_pengajuan', 'Menunggu');
        $this->db->where('prodi', $jur); 
		$query = $this->db->get('mbkm_riset');
		return $query->num_rows();
	}
	
	public function count_publikasi($jur)
	{
		$this->db->where('status_pengajuan', 'Menunggu');
        $this->db->where('prodi', $jur); 
		$query = $this->db->get('ajuan_tugas_akhir');
		return $query->num_rows();
	}
}
