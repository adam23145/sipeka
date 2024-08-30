<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
/**
 * 
 */
class M_bimbing extends CI_Model
{

	function get_sub($nim)
	{
		$query 		= "SELECT id, submission_code, nim, student_name, title, rms_maslh, jurusan, TO_CHAR(createddate,'YYYY-MM-DD HH24:II:SS')AS createddate, submission_status, loker, urgensi,code_status,dosbing, status_url, url_judulbimbingan FROM title_submission WHERE nim='$nim' AND submission_status='Bimbingan Skripsi'";
		$data 		= $this->db->query($query)->result_array();
		return $data;
	}

	function get_bi($nim)
	{
		$query 		= "SELECT bimbingan_ke,submission_code,createddate FROM bimbingan_skripsi WHERE nim='$nim' ";
		$data 		= $this->db->query($query)->result_array();
		return $data;
	}


	function get_bimbi($sub_code)
	{
		$query 		= "SELECT bimbingan_ke,submission_code,createddate,awalbimbingan,terakhirbimbingan FROM bimbingan_skripsi WHERE submission_code='$sub_code' ";
		$data 		= $this->db->query($query)->result_array();
		return $data;
	}
	function get_latest_bimbingan_date($sub_code)
	{
		$this->db->select_max('tgl_bimbingan');
		$this->db->from('log_bimbingan');
		$this->db->where('submission_code', $sub_code);
		$query = $this->db->get();
		$result = $query->row_array();

		return $result['tgl_bimbingan'];
	}
	function cont_logbi($sub_code)
	{
		$query 		= " SELECT count(*) as jmllogbi FROM log_bimbingan_skripsi WHERE submission_code='$sub_code' ";
		$data 		= $this->db->query($query)->result_array();
		return $data;
	}

	function get_logbi($sub_code)
	{
		$query 		= "SELECT * FROM log_bimbingan_skripsi WHERE submission_code='$sub_code' ORDER BY id DESC LIMIT 1 ";
		$data 		= $this->db->query($query)->result_array();
		return $data;
	}

	function get_status_bimbingan($val)
	{
		$query 		= "SELECT * FROM m_option WHERE option_type='status skripsi' AND option_name!='$val' AND status='Y' ORDER BY urutan ASC ";
		$data 		= $this->db->query($query)->result_array();
		return $data;
	}

	function update($userid, $sub_code, $nobim, $stats, $tanggal, $beritaacara)
	{
		if ($stats != 'Setuju Sidang') {

			if ($nobim == 1) {
				$query 		= " UPDATE bimbingan_skripsi 
									SET bimbingan_ke = '$nobim',
									status_bimb = '$stats',
									upd = '$userid',
									keterangan_bimbingan = '$beritaacara',
									date_modified = '$tanggal',
									awalbimbingan = '$tanggal'
									WHERE
									submission_code = '$sub_code' ";
			} else {
				$query 		= " UPDATE bimbingan_skripsi 
									SET bimbingan_ke = '$nobim',
									status_bimb = '$stats',
									upd = '$userid',
									keterangan_bimbingan = '$beritaacara',
									date_modified = '$tanggal'
									WHERE
									submission_code = '$sub_code' ";
			}
		} else {
			$query 		= " UPDATE bimbingan_skripsi 
									SET bimbingan_ke = '$nobim',
									status_bimb = '$stats',
									upd = '$userid',
									keterangan_bimbingan = '$beritaacara',
									date_modified = '$tanggal',
									terakhirbimbingan = '$tanggal'
									WHERE
									submission_code = '$sub_code' ";
		}

		$update 	= $this->db->query($query);
		return $update;
	}

	function update_log($userid, $sub_code, $nobim, $stats, $tanggal, $beritaacara)
	{
		$query 		= "INSERT INTO log_bimbingan_skripsi(submission_code,bimbingan_ke,status_bimb,upd,keterangan_bimbingan,tgl_bimbingan_skripsi)
										  VALUES('$sub_code','$nobim','$stats','$userid','$beritaacara','$tanggal')";
		$insert 	= $this->db->query($query);
		return $insert;
	}

	function update_sub($userid, $sub_code, $beritaacara)
	{
		$query 		= "UPDATE title_submission 
								SET submission_status = 'Bimbingan Skripsi',
								upd = '$userid',
								keterangan_upd = '$beritaacara',
								date_modified = current_timestamp
								WHERE
								submission_code = '$sub_code'";
		$insert 	= $this->db->query($query);
		return $insert;
	}

	function insert_sub_log($userid, $sub_code, $beritaacara)
	{
		$query 		= "INSERT INTO trans_title_submission(submission_code,submission_status,loker,upd_by,keterangan_upd, code_status)
													VALUES('$sub_code','Bimbingan Skripsi','Dosen','$userid','$beritaacara','Proses')";
		$insert 	= $this->db->query($query);
		return $insert;
	}

	function insert_dok($userid, $nim, $sub_code, $judul, $dosbing)
	{
		$query 		= "INSERT INTO dokumen(nim, title, dokumen, upd, dosbing, createddate, submission_code, file_dok, filepath)
								    VALUES('$nim', '$judul', 'Berita Acara Bimbingan Skripsi', '$userid', '$dosbing', current_timestamp, '$sub_code', 'Form Surat Ket Mengikuti Sidang.doc', 'document/files/')";
		$insert 	= $this->db->query($query);
		return $insert;
	}

	function insert_dok2($userid, $nim, $sub_code, $judul, $dosbing)
	{
		$query 		= "INSERT INTO dokumen(nim, title, dokumen, upd, dosbing, createddate, submission_code, file_dok, filepath)
								    VALUES('$nim', '$judul', 'Form Siap Diujikan Sidang', '$userid', '$dosbing', current_timestamp, '$sub_code', 'Form Surat Ket Mengikuti Sidang.doc', 'document/files/')";
		$insert 	= $this->db->query($query);
		return $insert;
	}

	// function get_data_logb($sub_code) {
	// 	$this->datatables->select("
	// 		id,
	// 		bimbingan_ke,
	// 		keterangan_bimbingan,
	// 		status_bimb,
	// 		TO_CHAR(lup,'YYYY-MM-DD HH24:II:SS')AS lup
	// 		");
	// 	$this->datatables->from("log_bimbingan_skripsi");
	// 	$this->datatables->where("submission_code='$sub_code'");
	// 	$data = $this->datatables->generate();
	// 	return $data;
	// }


	function get_data_logb($sub_code)
	{
		$this->datatables->select("
			id,
			bimbingan_ke,
			keterangan_bimbingan,
			status_bimb,
			tgl_bimbingan_skripsi
			");
		$this->datatables->from("log_bimbingan_skripsi");
		$this->datatables->where("submission_code='$sub_code'");
		$data = $this->datatables->generate();
		return $data;
	}
}
