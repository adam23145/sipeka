<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Historis extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('M_history');
		if (!$this->session->userdata('logged_in')) {
			redirect('login');
		}
	}

	function index(){
		$this->breadcrumb->add('History','history/historis');
		$data = array(
			'thisContent' 	=> 'history/v_history',
			'thisJs'		=> 'history/js_historis',
		);
		$this->parser->parse('template/template', $data);
	}

	function data_submission(){
		$userid	= $this->session->userdata['logged_in']['userid'];
		$usr    = substr($userid, 0,12);
		header('Content-Type: application/json');
		$data = $this->M_history->get_data_history($usr);
		echo $data;
	}

	function save(){
		$upd 				= $this->session->userdata['logged_in']['userid'];
		$id 				= $_POST['id'];
		$submission_code	= $_POST['submission_code'];
		$title				= $_POST['title'];
		$rms_maslh			= $_POST['rms_maslh'];

		$insert = $this->M_history->insert($id, $submission_code, $title, $rms_maslh, $upd);
		$result['feedback'] = 'Berhasil Update '; 
		
		echo json_encode($result);
	}

	
}