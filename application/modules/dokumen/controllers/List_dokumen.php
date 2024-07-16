<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class List_dokumen extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('M_list_dokumen');
		if (!$this->session->userdata('logged_in')) {
			redirect('login');
		}
	}

	function index(){
		$this->breadcrumb->add('Bimbingan Sempro','dokumen/list_dokumen');
		$data = array(
			'thisContent' 	=> 'dokumen/v_list_dokumen',
			'thisJs'		=> 'dokumen/js_list_dokumen',
		);
		$this->parser->parse('template/template', $data);
	}

	function data_submission(){
		$userid	= $this->session->userdata['logged_in']['userid'];
		$usr    = substr($userid, 0,12);
		header('Content-Type: application/json');
		$data = $this->M_list_dokumen->get_data_history($usr);
		echo $data;
	}
	
}