<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Report_selesai_sempro extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('M_report_sempro');
		if (!$this->session->userdata('logged_in')) {
			redirect('login');
		}
	}

	function index(){
		$this->breadcrumb->add('Report Selesai Sempro','report_sempro/report_selesai_sempro');
		$jurusan = $this->M_global->get_prodi();
		$data = array(
			'thisContent' 	=> 'report_sempro/v_end_sempro',
			'thisJs'		=> 'report_sempro/js_end_sempro',
			'jurusan'		=> $jurusan
		);
		$this->parser->parse('template/template', $data);
	}

	function data_detail() {

		if (!$_POST) {
			return;
		}

		header('Content-Type: application/json');
		$date1 			= $_POST['date1'];
		$date2 			= $_POST['date2'];
		
		$searchValue = $this->input->post('search')['value'];
		$lepel 			= $_POST['lepel'];
		// var_dump($lepel);
		// return;
		$userid 		= $this->session->userdata['logged_in']['userid'];

		if ($lepel == 'Koordinator Prodi'){
			$jur 	= $this->M_report_sempro->get_jur($userid);
			$jrsn 	= $jur[0]['program_study'];
		}else{
			$jrsn 			= $_POST['jrsn'];
		}

		$data = $this->M_report_sempro->get_data_end_sempro($date1, $date2, $jrsn,$searchValue);
		echo $data;
	}
	
}