<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Report_proses_skripsi extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('M_report_skripsi');
		if (!$this->session->userdata('logged_in')) {
			redirect('login');
		} 
	}

	function index() {
		$this->load->library('breadcrumb');
		$this->breadcrumb->add('Report Skripsi','report_skripsi/Report_proses_skripsi');
		$jurusan = $this->M_global->get_prodi();
		$data = array(
			'thisContent' 	=> 'report_skripsi/v_proses_skripsi',
			'thisJs'		=> 'report_skripsi/js_proses_skripsi',
			'jurusan'		=> $jurusan
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
		// $group 		= $_POST['jrsn'];

		$lepel 			= $_POST['lepel'];
		$userid 		= $this->session->userdata['logged_in']['userid'];

		if ($lepel == 'Koordinator Prodi'){
			$jur 	= $this->M_report_skripsi->get_jur($userid);
			$group 	= $jur[0]['program_study'];
		}else{
			$group 			= $_POST['jrsn'];
		}

		$data = $this->M_report_skripsi->get_data_detail_proses($date1, $date2, $group);
		echo $data;
	}

}