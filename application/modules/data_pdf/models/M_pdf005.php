<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
/**
 * 
 */
class M_pdf005 extends CI_Model {
	
	function getdatapdf($subcode,$userid){
		$query = "	SELECT
						* 
					FROM
						title_submission a
						LEFT JOIN m_dosen b ON ( a.dosbing = b.nip )
					WHERE
						submission_code = '$subcode'
						AND nim='$userid'
					";
		$data = $this->db->query($query)->result_array();
		return $data;
	}

	function getdatatgl($subcode,$userid){
		$query = "	SELECT
						* 
					FROM
						log_bimbingan
					WHERE
						submission_code = '$subcode' 
					";
		$data = $this->db->query($query)->result_array();
		return $data;
	}
}