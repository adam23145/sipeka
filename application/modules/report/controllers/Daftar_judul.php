<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Daftar_judul extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('M_daftar_judul');
		if (!$this->session->userdata('logged_in')) {
			redirect('login');
		} 
	}

	function index() {
		$this->load->library('breadcrumb');
		$this->breadcrumb->add('Report','report/daftar_judul')
		->add('Daftar Judul','report/daftar_judul');
		$jurusan = $this->M_global->get_prodi();
		$data = array(
			'thisContent' 	=> 'report/v_daftar_judul',
			'thisJs'		=> 'report/js_daftar_judul',
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
		$group 		= $_POST['jrsn'];
		$userid 	= $this->session->userdata['logged_in']['userid'];

		$data = $this->M_daftar_judul->get_data_detail($date1, $date2, $group);
		echo $data;
	}

}