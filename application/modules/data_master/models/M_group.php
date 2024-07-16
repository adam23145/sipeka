<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
/**
 * 
 */
class M_group extends CI_Model {

	function get_data_group() {
		$this->datatables->select('
			id,
			group,
			site,
			status,
			upd,
			lup
			');
		$this->datatables->from('m_group');
		$this->datatables->add_column('action','<center>
            <button class="btn btn-primary btn-sm btn-edit"><i style="color: white;" class="fa fa-pencil-alt"></i></button>
            <button class="btn btn-danger btn-sm btn-delete"><i style="color: white;" class="fa fa-trash-alt"></i></button>
            </center>
            ');
		$data = $this->datatables->generate();
		return $data;
	}


	

	function update($id, $group,$site,$is_active,$upd){
		$query	= "UPDATE m_group SET group='".$group."', site='".$site."', is_active='".$is_active."', upd='".$upd."' WHERE id='".$id."' ";
		$update = $this->db->query($query);
		return $update;
	}

	function insert($group,$site,$is_active,$upd){
		$query 		= " INSERT INTO m_group(`group`,id_site,is_active,upd) VALUES('".$group."', '".$site."', '".$is_active."', '".$upd."') ";
		$insert 	= $this->db->query($query);
		return $insert;
	}

	function delete($id){

	$this->db->where('id', $id);
	$delete = $this->db->delete('m_group');
	return $delete;

	}

}