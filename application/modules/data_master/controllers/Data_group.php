<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Data_group extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('M_group');
		if (!$this->session->userdata('logged_in')) {
			redirect('login');
		}
	}

	function index(){
		$this->breadcrumb->add('Settings','data_master/data_group')
		->add('Data Group','data_master/data_group');
		$data_site = $this->M_global->get_site();
		$data = array(
			'thisContent' 	=> 'data_master/v_group',
			'thisJs'		=> 'data_master/js_data_group',
			'data_site'		=> $data_site
		);
		$this->parser->parse('template/template', $data);
	}

	function data_group(){
		header('Content-Type: application/json');
		$data = $this->M_group->get_data_group();
		echo $data;
	}

	function save(){
		$upd 		= $this->session->userdata['logged_in']['userid'];
		$id 		= $_POST['id'];
		$group		= $_POST['grp_name'];
		$site		= $_POST['site'];
		$is_active	= $_POST['status'];

		if ($id == 0) {
			$insert = $this->M_group->insert($group,$site,$is_active,$upd);
			$result['feedback'] = 'Successfully Added Group'; 
		} else {
			$this->M_group->update($id, $group,$site,$is_active,$upd);
			$result['feedback'] = 'Successfully Updated Group'; 
		}
		echo json_encode($result);
	}

	function delete(){
		$id = $_POST['id'];
		$this->M_group->delete($id);
	}

}