<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class List_sempro extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('M_semprolist');
		if (!$this->session->userdata('logged_in')) {
			redirect('login');
		}
	}

	function index(){
		$this->breadcrumb->add('List Seminar Proposal','bimbingan/list_sempro');
		$data = array(
			'thisContent' 	=> 'bimbingan/v_sempro_list',
			'thisJs'		=> 'bimbingan/js_sempro_list',
		);
		$this->parser->parse('template/template', $data);
	}

	function get_list_sempro()
	{
		$userid 		= $this->session->userdata['logged_in']['userid'];
		$cek_kode 		= $this->M_semprolist->get_data_profil($userid);
		$kodedsn		= $cek_kode[0]['kode_dosen'];
		header('Content-Type: application/json');
		$data 			= $this->M_semprolist->get_data_sempro($kodedsn);
		echo $data;
	}

	// function save(){
	// 	$upd 				= $this->session->userdata['logged_in']['userid'];
	// 	$id 				= $_POST['id'];
	// 	$submission_code	= $_POST['submission_code'];

		
	// 	$this->M_semprolist->update($id, $submission_code, $upd);
	// 	$result['feedback'] = 'Successfully Updated Data'; 

	// 	echo json_encode($result);
	// }

	// function insert(){
	// 	$upd 				= $this->session->userdata['logged_in']['userid'];
	// 	$nim 				= $_POST['nim'];
	// 	$title 				= $_POST['title'];
	// 	$submission_code	= $_POST['submission_code'];
	// 	$dosbing			= $_POST['dosbing'];

		
	// 	$this->M_bimbingan->insert($submission_code, $title, $nim, $upd, $dosbing);
	// 	$result['feedback'] = 'Berhasil Membuat Data Bimbingan'; 

	// 	echo json_encode($result);
	// }
	
}