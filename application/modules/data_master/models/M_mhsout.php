<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
/**
 * 
 */
class M_mahasiswa extends CI_Model {

	function get_data_mahasiswa() {
		$this->datatables->select('
			ROW_NUMBER() OVER (ORDER BY mhs.nim DESC) AS no_urut,
			mhs.nim,
			mhs.nama,
			mhs.email,
			mhs.fakultas,
			mhs.jurusan,
			mhs.jenis_kelamin,
			mhs.tahun_masuk,
			mhs.status
		');
		$this->datatables->from('m_mahasiswa mhs');
		$this->datatables->add_column('action','<center>
				<button class="btn btn-primary btn-sm btn-edit"><i style="color: white;" class="fa fa-pencil-alt"></i></button>
				<button class="btn btn-danger btn-sm btn-delete"><i style="color: white;" class="fa fa-trash-alt"></i></button>
            </center>
		');
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