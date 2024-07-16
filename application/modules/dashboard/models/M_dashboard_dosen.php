<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
/**
 * 
 */
class M_pengajuanJudul extends CI_Model {

	function get_data_login() {
		$this->datatables->select('
			id,
			userid,
			full_name,
			email,
			image,
			status
			');
		$this->datatables->from('m_login');
		// $this->datatables->where('office!="Belum Ditentukan"');
		$this->datatables->add_column('action','<center>
            <button class="btn btn-raised btn-icon btn-info mr-1 btn-edit"><i style="color: white;" class="fa fa-pencil"></i></button>
            <button class="btn btn-raised btn-icon btn-danger mr-1 btn-delete"><i style="color: white;" class="fa fa-trash"></i></button>
            </center>
            ');
		$data = $this->datatables->generate();
		return $data;
	}


	

	function update($id, $userid, $full_name, $email, $password, $status){
		$query	= "UPDATE m_login SET userid='".$userid."', full_name='".$full_name."', email='".$email."', password='".$password."',  status='".$status."' WHERE id='".$id."' ";
		$update = $this->db->query($query);
		return $update;
	}

	function insert($userid, $full_name, $email, $password, $status){
		$query 		= " INSERT INTO m_login(userid,full_name,email,password,status) VALUES('".$userid."', '".$full_name."', '".$email."', '".$password."', '".$status."') ";
		$insert 	= $this->db->query($query);
		return $insert;
	}

	function delete($id){

	$this->db->where('id', $id);
	$delete = $this->db->delete('m_login');
	return $delete;

	}

}