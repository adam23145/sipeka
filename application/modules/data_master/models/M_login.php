<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
/**
 * 
 */
class M_login extends CI_Model {

	function get_data_login() {
		$this->datatables->select('
			id,
			userid,
			username,
			email,
			images,
			status,
			userlevel
			');
		$this->datatables->from('m_login');
		$this->datatables->add_column('action','<center>
            <button class="btn btn-primary btn-sm btn-edit"><i style="color: white;" class="fa fa-pencil-alt"></i></button>
            <button class="btn btn-danger btn-sm btn-delete"><i style="color: white;" class="fa fa-trash-alt"></i></button>
            </center>
            ');
		$data = $this->datatables->generate();
		return $data;
	}


	

	function update($id, $userid, $full_name, $email, $password, $status, $level){
		$query	= "UPDATE m_login SET userid='".$userid."', username='".$full_name."', email='".$email."', pass='".$password."',  status='".$status."', userlevel='".$level."' WHERE id='".$id."' ";
		$update = $this->db->query($query);
		return $update;
	}

	function insert_data($userid, $full_name, $email, $password, $status, $level){
		$query 		= " INSERT INTO m_login(userid,username,email,pass,status,userlevel) VALUES('".$userid."', '".$full_name."', '".$email."', '".$password."', '".$status."', '".$level."') ";
		$insert 	= $this->db->query($query);
		return $insert;
	}

	function insert($item){
		$insert 	= $this->db->insert('m_login',$item);
		return $insert;
	}
	
	function insert_batch($item){
		$insert 	= $this->db->insert_batch('m_login',$item);
		return $insert;
	}

	function delete($id){

	$this->db->where('id', $id);
	$delete = $this->db->delete('m_login');
	return $delete;

	}

}