<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
/**
 * 
 */
class M_R_bimbingan_skripsi extends CI_Model {

	function get_data_skripsi($date1) {
		$where = " 1=1 ";

		if ($date1!='') {
			$where = " mhs.tahun_masuk = '$date1' ";
		}

		$this->datatables->select('
			ROW_NUMBER() OVER (ORDER BY ts.nim DESC) AS no_urut,
			ts.nim,
			mhs.nama AS namamhs,
			ts.title,
			ts.dosbing,
			ds.nama,
			ts.bimbingan_ke
		');
		$this->datatables->from('bimbingan_skripsi ts');
		$this->datatables->join('m_mahasiswa mhs', 'ts.nim=mhs.nim');
		$this->datatables->join('m_dosen ds', 'ds.nip=ts.dosbing', 'left');
		// $this->datatables->join('log_bimbingan_skripsi lbs', 'lbs.submission_code=ts.submission_code');
		$this->datatables->where($where);
		$data = $this->datatables->generate();
		return $data;
	}

	function update($id, $item){
		$this->db->where('nim',$id);
		$update = $this->db->update('m_mahasiswa',$item);
		return $update;
	}

	function insert($item){
		$insert 	= $this->db->insert('m_mahasiswa',$item);
		return $insert;
	}
	
	function insert_batch($item){
		$insert 	= $this->db->insert_batch('m_mahasiswa',$item);
		return $insert;
	}
	
	function delete($id){

	$this->db->where('nim', $id);
	$delete = $this->db->delete('m_mahasiswa');
	return $delete;

	}

}