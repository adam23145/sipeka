<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class List_pengajuan extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('M_list_pengajuan');
		if (!$this->session->userdata('logged_in')) {
			redirect('login');
		}
	}

	function list_data(){
		$this->breadcrumb->add('List Pengajuan','list/list_pengajuan');
		$stts_sub 	= $this->uri->segment(4);
		$data = array(
			'thisContent' 	=> 'list/v_list_pengajuan',
			'thisJs'		=> 'list/js_list_pengajuan',
			'data_sub'		=> $stts_sub
		);
		$this->parser->parse('template/template', $data);
	}

	function data_submission(){	
		$stts_s = $_POST['data_sub'];
		$userlevel = $this->session->userdata['logged_in']['userlevel'];
		$userid = $this->session->userdata['logged_in']['userid'];
		$searchValue = $this->input->post('search')['value'];
		if($stts_s == 'Revisi'){
			$stts_sub = 'Submit revisi';
		}else{			
			$stts_sub = $stts_s;			
		}

		header('Content-Type: application/json');

		if($userlevel=='Koordinator Prodi'){
			$datax	= $this->M_list_pengajuan->get_data_koor($userid);
			$ps 	= $datax[0]['program_study'];

			$data = $this->M_list_pengajuan->get_data_pengajuanx($stts_sub,$userlevel,$ps,$searchValue);
		}else if($userlevel=='Sekjur' || $userlevel=='Kajur' ){
			$data = $this->M_list_pengajuan->get_data_pengajuan($stts_sub,$userlevel,$searchValue);
			
		}else{
			$data = $this->M_list_pengajuan->get_data_pengajuan($stts_sub,$userlevel,$searchValue);
		}
				
		echo $data;
	}

	function save(){
		$upd 				= $this->session->userdata['logged_in']['userid'];
		$id 				= $_POST['id'];
		$submission_code	= $_POST['submission_code'];
		$title				= $_POST['title'];
		$rms_maslh			= $_POST['rms_maslh'];

		$insert = $this->M_list_pengajuan->insert($id, $submission_code, $title, $rms_maslh, $upd);
		$result['feedback'] = 'Berhasil Update '; 
		
		echo json_encode($result);
	}

	
}