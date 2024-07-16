<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class DAshboard extends CI_Controller {

	function __construct(){
		parent::__construct();
		// $this->load->model('M_pengajuanJudul');
		// if (!$this->session->userdata('logged_in')) {
		// 	redirect('login');
		// }
	}

	function index(){
		$this->breadcrumb->add('Dashboard','dashboard/Dashboard');
		$data = array(
			'thisContent' 	=> 'dashboard/v_dashboard',
			'thisJs'		=> 'dashboard/js_dashboard',
		);
		$this->parser->parse('template/template', $data);
	}

	function data_login(){
		header('Content-Type: application/json');
		$data = $this->M_login->get_data_login();
		echo $data;
	}

	function save(){
		$id 		= $_POST['id'];
		$userid		= $_POST['userid'];
		$full_name	= $_POST['full_name'];
		$email		= $_POST['email'];
		$password	= $_POST['password'];
		$status		= $_POST['status'];

		if ($id == 0) {
			$insert = $this->M_login->insert($userid, $full_name, $email, $password, $status);
			$result['feedback'] = 'Successfully Added Login'; 
		} else {
			$this->M_login->update($id, $userid, $full_name, $email, $password, $status);
			$result['feedback'] = 'Successfully Updated Login'; 
		}
		echo json_encode($result);
	}

	function delete(){
		$id = $_POST['id'];
		$this->M_login->delete($id);
	}

}