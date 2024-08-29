<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
/**
 * 
 */
class M_prodi extends CI_Model {

	function get_data_prodi() {
		$this->datatables->select('
			ROW_NUMBER() OVER (ORDER BY j.major_name DESC) AS no_urut,
			j.id,
			j.major_code,
			j.major_name,
			j.nip,
			j.nama,
			j.status
			');
		$this->datatables->from('m_jurusan j');
		$this->datatables->add_column('action','<center>
            <button class="btn btn-primary btn-sm btn-edit"><i style="color: white;" class="fa fa-pencil-alt"></i></button>
            <button class="btn btn-danger btn-sm btn-delete"><i style="color: white;" class="fa fa-trash-alt"></i></button>
            </center>
            ');
		$data = $this->datatables->generate();
		return $data;
	}

	function update($id, $item){
		$this->db->where('id',$id);
		$update = $this->db->update('m_jurusan',$item);
		return $update;
	}

	function insert($item){
		$insert 	= $this->db->insert('m_jurusan',$item);
		return $insert;
	}
	
	function insert_batch($item){
		$insert 	= $this->db->insert_batch('m_jurusan',$item);
		return $insert;
	}
	
	function delete($id){

	$this->db->where('id', $id);
	$delete = $this->db->delete('m_jurusan');
	return $delete;

	}

}