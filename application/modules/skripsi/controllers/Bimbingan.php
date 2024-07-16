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
		$this->breadcrumb->add('Bimbingan Skripsi','bimbingan');
		$data = array(
			'thisContent' 	=> 'skripsi/v_bimbingan',
			'thisJs'		=> 'skripsi/js_bimbingan',
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
		// var_dump($cek_kode);exit();
		$kodedsn		= $cek_kode[0]['kode_dosen'];
		header('Content-Type: application/json');
		$data 			= $this->M_bimbingan->get_data_bimbingan($kodedsn);
		// 197912292015041002
		// 197912292015041002
		// var_dump($data);exit();
		echo $data;
	}

	function save(){
		$upd 				= $this->session->userdata['logged_in']['userid'];
		$id 				= $_POST['id'];
		$submission_code	= $_POST['submission_code'];

		
		$this->M_bimbingan->update($id, $submission_code, $upd);
		$result['feedback'] = 'Successfully Updated Data'; 

		echo json_encode($result);
	}

	function insert(){
		$upd 				= $this->session->userdata['logged_in']['userid'];
		$id 				= $_POST['id'];
		$nim 				= $_POST['nim'];
		$title 				= $_POST['title'];
		$submission_code	= $_POST['submission_code'];
		$dosbing			= $_POST['dosbing'];

		
		$insert = $this->M_bimbingan->insert($submission_code, $title, $nim, $upd, $dosbing);
		if($insert){
			$update = $this->M_bimbingan->update_sub($submission_code, $nim, $upd, $id);
			if($update){
				$insertsub = $this->M_bimbingan->insert_log_sub($submission_code,$upd);
				if($insertsub){
					$result['feedback'] = 'Berhasil Membuat Data Bimbingan'; 
				}
			}
		}
		

		echo json_encode($result);
	}
	
}