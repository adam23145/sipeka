<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Report_sempro extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('M_report_sempro');
		if (!$this->session->userdata('logged_in')) {
			redirect('login');
		}
	}

	function index(){
		$this->breadcrumb->add('Report Sempro','report/report_sempro');
		$jurusan = $this->M_global->get_prodi();
		$data = array(
			'thisContent' 	=> 'report/v_report_sempro',
			'thisJs'		=> 'report/js_report_sempro',
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
		$jrsn 			= $_POST['jrsn'];

		$data = $this->M_report_sempro->get_data_sempro($date1, $date2, $jrsn);
		echo $data;
	}
	
}