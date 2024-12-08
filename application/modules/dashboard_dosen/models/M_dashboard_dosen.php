<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
/**
 * 
 */
class M_dashboard_dosen extends CI_Model
{

	function cekdosen($email)
	{
		$query 		= "SELECT * FROM m_dosen WHERE email='$email' AND jabatan ='Dosen' ";
		$data 		= $this->db->query($query)->result_array();
		return $data;
	}

	function get_baru_sem($nip, $jbt)
	{
		$query 		= "SELECT count(*) as jmlnew_sem FROM title_submission WHERE code_status='New' AND submission_status='In Review Dosen' AND dosbing='" . $nip . "' AND loker='" . $jbt . "' ";
		$data 		= $this->db->query($query)->result_array();
		return $data;
	}

	function get_pr_sem($nip)
	{
		$query 		= "SELECT count(*) as jmlproses_sem FROM bimbingan WHERE dosbing='" . $nip . "' AND status_bimb!='Setuju' ";
		$data 		= $this->db->query($query)->result_array();
		return $data;
	}

	function get_end_sem($nip)
	{
		$query 		= "SELECT count(*) as jmlend_sem FROM bimbingan WHERE dosbing='" . $nip . "' AND status_bimb='Setuju' ";
		$data 		= $this->db->query($query)->result_array();
		return $data;
	}

	function get_baru($nip, $jbt)
	{
		$query 		= "SELECT count(*) as jmlnew FROM title_submission WHERE code_status='New' AND submission_status='Bimbingan Skripsi' AND dosbing='" . $nip . "' AND loker='" . $jbt . "' ";
		$data 		= $this->db->query($query)->result_array();
		return $data;
	}

	function get_pr($nip)
	{
		// $query 		= "SELECT count(*) as jmlproses FROM bimbingan_skripsi WHERE dosbing='".$nip."' AND status_bimb!='Setuju' ";
		$query 		= "SELECT count(ba.id) as jmlproses FROM bimbingan_skripsi ba, title_submission ts WHERE ba.submission_code=ts.submission_code AND ba.status_bimb in ('new','Bimbingan Skripsi') AND ba.dosbing = '$nip' ";
		$data 		= $this->db->query($query)->result_array();
		return $data;
	}

	function get_end($nip)
	{
		$query 		= "SELECT count(bs.id) as jmlend FROM bimbingan_skripsi bs, title_submission ts WHERE bs.submission_code = ts.submission_code AND bs.dosbing='" . $nip . "' AND bs.status_bimb = 'Setuju Sidang' ";
		$data 		= $this->db->query($query)->result_array();
		return $data;
	}

	function cek_ayat($nip)
	{
		$where = "";
		if ($nip <> "") {
			$where = " AND nip='$nip' ";
		}
		// $query 		= "SELECT count(id) as jml FROM title_submission WHERE nim='$nim' AND submission_status !='Tolak' ";
		$query 		= "SELECT count(1) as jml FROM mapping_hafalan_ayat WHERE 1=1 $where ";
		$data 		= $this->db->query($query)->result_array();
		return $data;
	}

	function cek_hadist($nip)
	{
		$where = "";
		if ($nip <> "") {
			$where = " AND nip='$nip' ";
		}
		// $query 		= "SELECT count(id) as jml FROM title_submission WHERE nim='$nim' AND submission_status !='Tolak' ";
		$query 		= "SELECT count(1) as jml FROM mapping_hafalan_hadist WHERE 1=1 $where ";
		$data 		= $this->db->query($query)->result_array();
		return $data;
	}

	function cek_kk($nip)
	{
		$where = "";
		if ($nip <> "") {
			$where = " AND nip='$nip' ";
		}
		// $query 		= "SELECT count(id) as jml FROM title_submission WHERE nim='$nim' AND submission_status !='Tolak' ";
		$query 		= "SELECT count(1) as jml FROM mapping_hafalan_kk WHERE 1=1 $where ";
		$data 		= $this->db->query($query)->result_array();
		return $data;
	}

	function cek_qq($nip)
	{
		$where = "";
		if ($nip <> "") {
			$where = " AND nip='$nip' ";
		}
		// $query 		= "SELECT count(id) as jml FROM title_submission WHERE nim='$nim' AND submission_status !='Tolak' ";
		$query 		= "SELECT count(1) as jml FROM mapping_hafalan_qq WHERE 1=1 $where ";
		$data 		= $this->db->query($query)->result_array();
		return $data;
	}
	public function count_bimbingan_baru($prodi)
	{
		$this->db->where('(UPPER(dosen_pembimbing) IS NULL OR UPPER(dosen_pembimbing) = \'\')');
		$this->db->where('UPPER(prodi)', strtoupper($prodi));
		return $this->db->count_all_results('mbkm_riset');
	}

	public function count_proses_bimbingan($prodi)
	{
		$this->db->where('UPPER(dosen_pembimbing) IS NOT NULL');
		$this->db->where('UPPER(dosen_pembimbing) !=', '');
		$this->db->where('UPPER(status_pengajuan) !=', 'ACC');
		$this->db->where('UPPER(prodi)', strtoupper($prodi));
		return $this->db->count_all_results('mbkm_riset');
	}

	public function count_selesai_bimbingan($prodi)
	{
		$this->db->where('UPPER(status_pengajuan)', 'ACC');
		$this->db->where('UPPER(prodi)', strtoupper($prodi));
		return $this->db->count_all_results('mbkm_riset');
	}

	public function publikasiNew($username)
	{
		$this->db->where('status_pengajuan', 'Menunggu');
		$this->db->group_start();
		$this->db->where('dosen_pembimbing_utama', $username);
		$this->db->or_where('dosen_pembimbing_kedua', $username);
		$this->db->group_end();

		return $this->db->count_all_results('ajuan_tugas_akhir');
	}
	public function publikasi($username)
	{
		$this->db->where('status_pengajuan', 'Diproses');
		$this->db->group_start();
		$this->db->where('dosen_pembimbing_utama', $username);
		$this->db->or_where('dosen_pembimbing_kedua', $username);
		$this->db->group_end();

		return $this->db->count_all_results('ajuan_tugas_akhir');
	}

	public function donepublikasi($username)
	{
		$this->db->where('status_pengajuan', 'Acc');
		$this->db->group_start();
		$this->db->where('dosen_pembimbing_utama', $username);
		$this->db->or_where('dosen_pembimbing_kedua', $username);
		$this->db->group_end();

		return $this->db->count_all_results('ajuan_tugas_akhir');
	}
	public function sempronewmbkbm($username)
	{
		$this->db->distinct(); 
		$this->db->select('m_dosen.nip'); 
		$this->db->from('mbkm_riset');
		$this->db->where('mbkm_riset.status_pengajuan_sempro', null);
		$this->db->where('posisi_berkas', 'Dosen');
		$this->db->where('m_dosen.nama', $username);
		$this->db->join('m_dosen', 'm_dosen.nip = mbkm_riset.dosen_pembimbing', 'inner');
		return $this->db->count_all_results();
	}
	public function semprombkbm($username)
	{
		$this->db->distinct(); 
		$this->db->select('m_dosen.nip'); 
		$this->db->from('mbkm_riset');
		$this->db->where('status_pengajuan_sempro', 'Menunggu');
		$this->db->where('m_dosen.nama', $username);
		$this->db->join('m_dosen', 'm_dosen.nip = mbkm_riset.dosen_pembimbing', 'inner');
		return $this->db->count_all_results();
	}
	public function semprodonembkbm($username)
	{
		$this->db->distinct(); 
		$this->db->select('m_dosen.nip'); 
		$this->db->from('mbkm_riset');
		$this->db->where('mbkm_riset.status_pengajuan_sempro', 'Acc');
		$this->db->where('m_dosen.nama', $username);
		$this->db->join('m_dosen', 'm_dosen.nip = mbkm_riset.dosen_pembimbing', 'inner');
		return $this->db->count_all_results();
	}
	public function skripsinewmbkbm($username)
	{
		$this->db->distinct(); 
		$this->db->select('m_dosen.nip'); 
		$this->db->from('mbkm_riset');
		$this->db->where('mbkm_riset.status_pengajuan_skripsi', null);
		$this->db->where('mbkm_riset.status_pengajuan_sempro', 'Acc');
		$this->db->where('m_dosen.nama', $username);
		$this->db->join('m_dosen', 'm_dosen.nip = mbkm_riset.dosen_pembimbing', 'inner');
		return $this->db->count_all_results();
	}
	public function skripsimbkbm($username)
	{
		$this->db->distinct(); 
		$this->db->select('m_dosen.nip'); 
		$this->db->from('mbkm_riset');
		$this->db->where('status_pengajuan_skripsi', 'Menunggu');
		$this->db->where('m_dosen.nama', $username);
		$this->db->join('m_dosen', 'm_dosen.nip = mbkm_riset.dosen_pembimbing', 'inner');
		return $this->db->count_all_results();
	}
	public function skripsidonembkbm($username)
	{
		$this->db->distinct(); 
		$this->db->select('m_dosen.nip'); 
		$this->db->from('mbkm_riset');
		$this->db->where('status_pengajuan_skripsi', 'Acc');
		$this->db->where('m_dosen.nama', $username);
		$this->db->join('m_dosen', 'm_dosen.nip = mbkm_riset.dosen_pembimbing', 'inner');
		return $this->db->count_all_results();
	}
}
