<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
/**
 * 
 */
class M_pdf006 extends CI_Model
{

	function getdatapdf($subcode, $userid)
	{
		$query = " SELECT
						* 
					FROM
						sempro a
						LEFT JOIN m_dosen b ON ( a.dosbing = b.nip )
					WHERE
						submission_code = '$subcode'
						AND nim = '$userid'
					";
		$data = $this->db->query($query)->result_array();
		return $data;
	}
	function getNamaDosen($subcode, $userid)
	{
		$query = "SELECT 
					b.nama AS nama_dosen,
					b.nip AS nip_dosen
				  FROM 
					sempro a
					LEFT JOIN m_dosen b ON a.penguji = b.nip
				  WHERE 
					a.submission_code = '$subcode'
					AND a.nim = '$userid'";

		$data = $this->db->query($query)->row_array();

		return $data ? $data : ['nama_dosen' => null, 'nip_dosen' => null];
	}
}
