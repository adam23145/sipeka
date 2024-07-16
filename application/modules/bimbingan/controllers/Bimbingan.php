<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Bimbingan extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('M_bimbingan');
		if (!$this->session->userdata('logged_in')) {
			redirect('login');
		}
	}

	function index(){
		$this->breadcrumb->add('Bimbingan Masuk','bimbingan');
		$data = array(
			'thisContent' 	=> 'bimbingan/v_bimbingan',
			'thisJs'		=> 'bimbingan/js_bimbingan',
		);
		$this->parser->parse('template/template', $data);
	}

	function data_login(){
		header('Content-Type: application/json');
		$data = $this->M_login->get_data_login();
		echo $data;
	}

	function get_new_bimbingan()
	{
		$userid 		= $this->session->userdata['logged_in']['userid'];
		$cek_kode 		= $this->M_bimbingan->get_data_profil($userid);
		$kodedsn		= $cek_kode[0]['kode_dosen'];
		header('Content-Type: application/json');
		$data 			= $this->M_bimbingan->get_data_bimbingan($kodedsn);
		echo $data;
	}

	function save(){
		$upd 				= $this->session->userdata['logged_in']['userid'];
		$id 				= $_POST['id'];
		$submission_code	= $_POST['submission_code'];
		$loker				= $_POST['loker'];
		$stts_sub			= 'Bimbingan Sempro';
		$stts_code			= 'Proses';
		$keter				= 'Proses bimbingan sempro';

		
		$proses = $this->M_bimbingan->update($id, $submission_code, $upd, $stts_sub, $stts_code, $keter);
		if($proses){
			$insert_log = $this->M_bimbingan->insert_logsub($id, $submission_code, $upd, $stts_sub, $stts_code, $keter, $loker);
			if($insert_log){
				$result['feedback'] = 'Successfully Updated Data'; 
			}
		}
		

		echo json_encode($result);
	}

	function insert(){
		$upd 				= $this->session->userdata['logged_in']['userid'];
		$nim 				= $_POST['nim'];
		$title 				= $_POST['title'];
		$submission_code	= $_POST['submission_code'];
		$dosbing			= $_POST['dosbing'];

		
		$this->M_bimbingan->insert($submission_code, $title, $nim, $upd, $dosbing);
		$result['feedback'] = 'Berhasil Membuat Data Bimbingan'; 

		echo json_encode($result);
	}
	
}