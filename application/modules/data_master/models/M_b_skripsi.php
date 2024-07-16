<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
/**
 * 
 */
class M_b_skripsi extends CI_Model {

	function get_data_skripsi() {
		// $where = " 1=1 ";

		$this->datatables->select('ROW_NUMBER( ) OVER ( ORDER BY ds.id DESC ) AS id, ds.nip, ds.nama, SUM(CASE WHEN ts.dosbing=ds.nip THEN 1 ELSE 0 END) AS jml');
		$this->datatables->from('m_dosen ds');
		$this->datatables->join('title_submission ts', 'ts.dosbing=ds.nip', 'left');
		// $this->datatables->where($where);
		$this->datatables->group_by('ds.nip'); 
		$this->datatables->group_by('ds.id'); 
		$this->datatables->group_by('ds.nama'); 
		// $this->datatables->group_by('ts.id'); 
		$data = $this->datatables->generate();
		return $data;
	}

}