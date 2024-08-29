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
		$query 		= "SELECT id, submission_code, nim, student_name, title, rms_maslh, jurusan, TO_CHAR(createddate,'YYYY-MM-DD HH24:II:SS')AS createddate, submission_status, loker, urgensi,code_status, dosbing, url_judulbimbingan, status_url FROM title_submission WHERE nim='$nim' AND submission_status='Bimbingan Sempro'";
		$data 		= $this->db->query($query)->result_array();
		return $data;
	}

	function get_bi($nim)
	{
		$query 		= "SELECT bimbingan_ke,submission_code FROM bimbingan WHERE nim='$nim' ";
		$data 		= $this->db->query($query)->result_array();
		return $data;
	}

	function update($userid, $sub_code, $nobim, $stats, $tanggal, $beritaacara)
	{

		if ($stats == 'Bimbingan') {
			if ($nobim == 1) {
				$query 		= " UPDATE bimbingan 
								SET bimbingan_ke = '$nobim',
								status_bimb = '$stats',
								upd = '$userid',
								keterangan_bimbingan = '$beritaacara',
								date_modified = '$tanggal',
								awalbimb = '$tanggal'
								WHERE
								submission_code = '$sub_code' ";
			} else {
				$query 		= " UPDATE bimbingan 
									SET bimbingan_ke = '$nobim',
									status_bimb = '$stats',
									upd = '$userid',
									keterangan_bimbingan = '$beritaacara',
									date_modified = '$tanggal'
									WHERE
									submission_code = '$sub_code' ";
			}
		} else {
			if ($nobim == 1) {
				$query 		= " UPDATE bimbingan 
								SET bimbingan_ke = '$nobim',
								status_bimb = '$stats',
								upd = '$userid',
								keterangan_bimbingan = '$beritaacara',
								date_modified = '$tanggal',
								awalbimb = '$tanggal',
								akhirbimb = '$tanggal'
								WHERE
								submission_code = '$sub_code' ";
			} else {
				$query 		= " UPDATE bimbingan 
								SET bimbingan_ke = '$nobim',
								status_bimb = '$stats',
								upd = '$userid',
								keterangan_bimbingan = '$beritaacara',
								date_modified = '$tanggal',
								akhirbimb = '$tanggal'
								WHERE
								submission_code = '$sub_code' ";
			}
		}



		$update 	= $this->db->query($query);
		return $update;
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
	function update_log($userid, $sub_code, $nobim, $stats, $tanggal, $beritaacara)
	{
		$query 		= "INSERT INTO log_bimbingan(submission_code,bimbingan_ke,status_bimb,upd,keterangan_bimbingan,tgl_bimbingan)
										  VALUES('$sub_code','$nobim','$stats','$userid','$beritaacara','$tanggal')";
		$insert 	= $this->db->query($query);
		return $insert;
	}

	function update_sub($userid, $sub_code, $beritaacara)
	{
		$query 		= "UPDATE title_submission 
								SET submission_status = 'Seminar Proposal',
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
													VALUES('$sub_code','Seminar Proposal','Dosen','$userid','$beritaacara','Proses')";
		$insert 	= $this->db->query($query);
		return $insert;
	}

	function insert_dokumenba($userid, $nimmhs, $titlesub, $sub_code, $dosenpembimbing)
	{
		$query 		= "INSERT INTO dokumen(nim, title, dokumen, upd, dosbing, submission_code)
													VALUES('$nimmhs','$titlesub','Berita Acara Siap Diujikan Sempro','$userid','$dosenpembimbing','$sub_code')";
		$insert 	= $this->db->query($query);
		return $insert;
	}

	function insert_dokumenlayak($userid, $nimmhs, $titlesub, $sub_code, $dosenpembimbing)
	{
		$query 		= "INSERT INTO dokumen(nim, title, dokumen, upd, dosbing, submission_code)
													VALUES('$nimmhs','$titlesub','Surat Kelayakan Sempro','$userid','$dosenpembimbing','$sub_code')";
		$insert 	= $this->db->query($query);
		return $insert;
	}

	function get_data_logb($sub_code)
	{
		$this->datatables->select("
			id,
			bimbingan_ke,
			keterangan_bimbingan,
			status_bimb,
			tgl_bimbingan AS lup
			");
		$this->datatables->from("log_bimbingan");
		$this->datatables->where("submission_code='$sub_code'");
		$data = $this->datatables->generate();
		return $data;
	}
}
