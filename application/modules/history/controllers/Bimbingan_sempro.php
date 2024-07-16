<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Bimbingan_sempro extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('M_bimbinganSempro');
		if (!$this->session->userdata('logged_in')) {
			redirect('login');
		}
	}

	function index(){
		$this->breadcrumb->add('Bimbingan Sempro','history/bimbingan_sempro');
		$data = array(
			'thisContent' 	=> 'history/v_bimbinganSempro',
			'thisJs'		=> 'history/js_bimbinganSempro',
		);
		$this->parser->parse('template/template', $data);
	}

	function data_submission(){
		$userid	= $this->session->userdata['logged_in']['userid'];
		$usr    = substr($userid, 0,12);
		header('Content-Type: application/json');
		$data = $this->M_bimbinganSempro->get_data_history($usr);
		echo $data;
	}
	
}