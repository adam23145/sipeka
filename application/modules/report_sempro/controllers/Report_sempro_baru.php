<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Report_sempro_baru extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('M_report_sempro');
		if (!$this->session->userdata('logged_in')) {
			redirect('login');
		}
	}

	function index(){
		$this->breadcrumb->add('Report Sempro Baru','report_sempro/report_sempro_baru');
		$jurusan = $this->M_global->get_prodi();
		$data = array(
			'thisContent' 	=> 'report_sempro/v_sempro_baru',
			'thisJs'		=> 'report_sempro/js_sempro_baru',
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
		$searchValue = $this->input->post('search')['value'];
		$date2 			= $_POST['date2'];
		$jrsn 			= $_POST['jrsn'];

		$data = $this->M_report_sempro->get_data_sempro($date1, $date2, $jrsn,$searchValue);
		echo $data;
	}
	
}