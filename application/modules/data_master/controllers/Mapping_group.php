<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Mapping_group extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('M_mappingGroup');
		if (!$this->session->userdata('logged_in')) {
			redirect('login');
		}
	}

	function index(){
		$this->breadcrumb->add('Settings','data_master/mapping_group')
		->add('Mapping Group','data_master/mapping_group');
		$data_login		=	$this->M_global->get_login();
		$data_gl		=	$this->M_global->get_gl();
		$data_group		=	$this->M_global->get_group();
		$data = array(
			'thisContent' 	=> 'data_master/v_mappingGroup',
			'thisJs'		=> 'data_master/js_mappingGroup',
			'data_login'	=> $data_login,
			'data_gl'		=> $data_gl,
			'data_group'	=> $data_group
		);
		$this->parser->parse('template/template', $data);
	}

	function data_mapping(){
		header('Content-Type: application/json');
		$data = $this->M_mappingGroup->get_mapping();
		echo $data;
	}

	function save(){
		$upd 		= $this->session->userdata['logged_in']['userid'];
		$id 		= $_POST['id'];
		$userid		= $_POST['userid'];
		$group		= $_POST['group'];
		$g_level	= $_POST['g_level'];
		$status		= $_POST['status'];

		if ($id == 0) {
			$insert = $this->M_dept->insert($userid, $group, $g_level, $status, $upd);
			$result['feedback'] = 'Successfully Added Mapping'; 
		} else {
			$this->M_dept->update($id, $userid, $group, $g_level, $status, $upd);
			$result['feedback'] = 'Successfully Updated Mapping'; 
		}
		echo json_encode($result);
	}

	function delete(){
		$id = $_POST['id'];
		$this->M_dept->delete($id);
	}

}