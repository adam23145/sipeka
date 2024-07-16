<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
/**
 * 
 */
class M_matkul extends CI_Model {

	function get_data_matkul() {
		$this->datatables->select('
			ROW_NUMBER() OVER (ORDER BY mm.id DESC) AS no_urut,
			mm.id,
			mm.kode_matkul,
			mm.nama_matkul
		');
		$this->datatables->from('m_matkul mm');
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
		$update = $this->db->update('m_matkul',$item);
		return $update;
	}

	function insert($item){
		$insert 	= $this->db->insert('m_matkul',$item);
		return $insert;
	}
	
	function insert_batch($item){
		$insert 	= $this->db->insert_batch('m_matkul',$item);
		return $insert;
	}
	
	function delete($id){

	$this->db->where('id', $id);
	$delete = $this->db->delete('m_matkul');
	return $delete;

	}

}