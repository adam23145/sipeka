<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
/**
 * 
 */
class M_pdf001 extends CI_Model {
	
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
}