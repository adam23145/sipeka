<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
/**
 * 
 */
class M_mappingGroup extends CI_Model {

	function get_mapping() {
		$this->datatables->select('
			m.id,
			m.userid,
			full_name,
			group_name,
			group_level,
			m.status,
			m.upd,
			m.lup
			');
		$this->datatables->from('mapping_member m, m_login l');
		$this->datatables->where('m.userid=l.userid');
		$this->datatables->add_column('action','<center>
            <button class="btn btn-primary btn-sm btn-edit"><i style="color: white;" class="fa fa-pencil-alt"></i></button>
            <button class="btn btn-danger btn-sm btn-delete"><i style="color: white;" class="fa fa-trash-alt"></i></button>
            </center>
            ');
		$data = $this->datatables->generate();
		return $data;
	}

	function update($id, $userid, $group, $g_level, $status, $upd){
		$query	= "UPDATE mapping_member SET userid='".$userid."', group_name='".$group."', group_level='".$g_level."',status='".$status."', upd='".$upd."' WHERE id='".$id."' ";
		$update = $this->db->query($query);
		return $update;
	}

	function insert($userid, $group, $g_level, $status, $upd){
		$query 		= " INSERT INTO mapping_member(userid,group_name,group_level,status,upd) VALUES('".$userid."','".$group."', '".$g_level."', '".$status."', '".$upd."') ";
		$insert 	= $this->db->query($query);
		return $insert;
	}

	function delete($id){
	$this->db->where('id', $id);
	$delete = $this->db->delete('mapping_member');
	return $delete;

	}

}