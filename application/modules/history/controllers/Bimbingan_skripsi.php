<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Bimbingan_skripsi extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('M_bimbinganSkripsi');
		if (!$this->session->userdata('logged_in')) {
			redirect('login');
		}
	}

	function index(){
		$this->breadcrumb->add('Bimbingan Skripsi','history/bimbingan_skripsi');
		$data = array(
			'thisContent' 	=> 'history/v_bimbinganSkripsi',
			'thisJs'		=> 'history/js_bimbinganSkripsi',
		);
		$this->parser->parse('template/template', $data);
	}

	function data_submission(){
		$userid	= $this->session->userdata['logged_in']['userid'];
		$usr    = substr($userid, 0,12);
		header('Content-Type: application/json');
		$data = $this->M_bimbinganSkripsi->get_data_history($usr);
		echo $data;
	}
	
}