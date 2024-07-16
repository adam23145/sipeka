<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class History_review extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('M_history_review');
		if (!$this->session->userdata('logged_in')) {
			redirect('login');
		} 
	}

	function index() {
		$this->load->library('breadcrumb');
		$this->breadcrumb->add('List','list/history_review')
		->add('History Review','list/history_review');


		
		$userlevel = $this->session->userdata['logged_in']['userlevel'];
		$userid = $this->session->userdata['logged_in']['userid'];
		if($userlevel == 'Koordinator Prodi'){
			$get_jurusan3 = $this->M_global->get_jurusankoorprodi($userid);

			$prodi = $get_jurusan3[0]['program_study'];

			if($prodi == 'Ekonomi Syariah'){
				$get_mahasiswa = $this->M_global->get_mahasiswa_ES();
			}else{
				$get_mahasiswa = $this->M_global->get_mahasiswa_HBS();
			}



		}else{
			$get_mahasiswa = $this->M_global->get_mahasiswa();
		}

		$data = array(
			'thisContent' 	=> 'list/v_history_review',
			'thisJs'		=> 'list/js_history_review',
			'get_mahasiswa'		=> $get_mahasiswa,
			'lpl'		=> $userlevel,
		);
		$this->parser->parse('template/template', $data);
	}

	function data_detail() {
		if (!$_POST) {
			return;
		}

		header('Content-Type: application/json');
		
		$date1 		= $_POST['date1'];
		$date2 		= $_POST['date2'];
		$nmmhs 		= $_POST['nmmhs'];

		$pjgmhs = strlen($nmmhs);
		// var_dump($pjgmhs);
		// return;
		$userlevel 	= $_POST['lpl'];
		$userid 	= $this->session->userdata['logged_in']['userid'];

		if($userlevel=='Koordinator Prodi'){
			$datax	= $this->M_history_review->get_data_koor($userid);
			$ps 	= $datax[0]['program_study'];
		}else{
			$ps 	= '';
		}
		// $userlevel 	= $this->session->userdata['logged_in']['userlevel'];

		$data = $this->M_history_review->get_data_detail($date1, $date2, $nmmhs, $userlevel, $ps,$pjgmhs);
		echo $data;
	}

}