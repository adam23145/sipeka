<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
/**
 * 
 */
class M_dashboard extends CI_Model
{

	function get_status_jdl($nim)
	{
		$query 		= "SELECT * FROM title_submission WHERE code_status!='Tutup' AND nim='$nim' ";
		$data 		= $this->db->query($query)->result_array();
		return $data;
	}

	function cek_jud($nim)
	{
		// $query 		= "SELECT count(id) as jml FROM title_submission WHERE nim='$nim' AND submission_status !='Tolak' ";
		$query 		= "SELECT count(id) as jml FROM title_submission WHERE nim='$nim' AND code_status!='Tutup' ";
		$data 		= $this->db->query($query)->result_array();
		return $data;
	}

	function cek_ayat($nim)
	{
		// $query 		= "SELECT count(id) as jml FROM title_submission WHERE nim='$nim' AND submission_status !='Tolak' ";
		$query 		= "SELECT count(1) as jml FROM mapping_hafalan_ayat WHERE nim='$nim' ";
		$data 		= $this->db->query($query)->result_array();
		return $data;
	}

	function cek_hadist($nim)
	{
		// $query 		= "SELECT count(id) as jml FROM title_submission WHERE nim='$nim' AND submission_status !='Tolak' ";
		$query 		= "SELECT count(1) as jml FROM mapping_hafalan_hadist WHERE nim='$nim' ";
		$data 		= $this->db->query($query)->result_array();
		return $data;
	}

	function cek_kk($nim)
	{
		// $query 		= "SELECT count(id) as jml FROM title_submission WHERE nim='$nim' AND submission_status !='Tolak' ";
		$query 		= "SELECT count(1) as jml FROM mapping_hafalan_kk WHERE nim='$nim' ";
		$data 		= $this->db->query($query)->result_array();
		return $data;
	}

	function cek_qq($nim)
	{
		// $query 		= "SELECT count(id) as jml FROM title_submission WHERE nim='$nim' AND submission_status !='Tolak' ";
		$query 		= "SELECT count(1) as jml FROM mapping_hafalan_qq WHERE nim='$nim' ";
		$data 		= $this->db->query($query)->result_array();
		return $data;
	}
	public function get_status_pengajuan_judul($nim)
	{
		$this->db->select('status_pengajuan_judul, posisi_berkas'); // Pisahkan kolom dengan koma
		$this->db->from('mbkm_riset');
		$this->db->where('nim', $nim);
		$this->db->where('status_pengajuan_judul !=', 'Ditolak');
		$query = $this->db->get();

		return $query->row(); // Mengambil satu baris
	}

	public function count_publikasi($nim)
	{
		$this->db->where('nim', $nim);
		$query = $this->db->get('ajuan_tugas_akhir');
		return $query->num_rows();
	}
	public function count_mbkm($nim)
	{
		$this->db->select('COUNT(*) as total');
		$this->db->from('mbkm_riset');
		$this->db->where('nim', $nim);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->row()->total;
		} else {
			return 0;
		}
	}
}
