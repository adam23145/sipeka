<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
/**
 * 
 */
class M_skripsi extends CI_Model {

	function get_data_skripsi($date1) {
		$where = " 1=1 ";

		if ($date1!='') {
			$where = " mhs.tahun_masuk = '$date1' ";
		}

		$this->datatables->select('
			ROW_NUMBER() OVER (ORDER BY ts.nim DESC) AS no_urut,
			ts.nim,
			ts.student_name,
			ts.title,
			ts.url_judulbimbingan,
			ts.submission_status,
			ts.dosbing,
			ds.nama
		');
		$this->datatables->from('title_submission ts');
		$this->datatables->join('m_mahasiswa mhs', 'ts.nim=mhs.nim');
		$this->datatables->join('m_dosen ds', 'ds.nip=ts.dosbing', 'left');
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