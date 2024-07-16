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
		$level 		= $this->session->userdata['logged_in']['userlevel'];
		$userid 	= $this->session->userdata['logged_in']['userid'];

		if($level == 'Dosen'){
			$datajrs 	= $this->M_semprolist->get_dosen($userid);
			$jur		= $datajrs[0]['program_study'];

			if($jur == 'Hukum Bisnis Syariah' ){
				$get_mahasiswa = $this->M_global->get_mahasiswa();
			}else if($jur == 'Ekonomi Syariah' ){
				$get_mahasiswa = $this->M_global->get_mahasiswa();
			}
		}else{
			$get_mahasiswa = $this->M_global->get_mahasiswa();
		}

		
		$data = array(
			'thisContent' 	=> 'bimbingan/v_sempro_list',
			'thisJs'		=> 'bimbingan/js_sempro_list',
			'get_mahasiswa'		=> $get_mahasiswa,
		);
		$this->parser->parse('template/template', $data);
	}

	function data_detail() {

		if (!$_POST) {
			return;
		}

		header('Content-Type: application/json');
		$userid 		= $this->session->userdata['logged_in']['userid'];
		$cek_kode 		= $this->M_semprolist->get_data_profil($userid);
		$kodedsn		= $cek_kode[0]['kode_dosen'];
		$date1 			= $_POST['date1'];
		$date2 			= $_POST['date2'];
		$nmmhs 			= $_POST['nmmhs'];
		$userlevel 		= $_POST['lpl'];
		$userid 		= $this->session->userdata['logged_in']['userid'];

		$data = $this->M_semprolist->get_data_sempro($date1, $date2, $nmmhs, $kodedsn);
		echo $data;
	}
	
}