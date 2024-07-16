<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Histori_bimbingan_skripsi extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('M_bimbingan_skripsi');
		if (!$this->session->userdata('logged_in')) {
			redirect('login');
		} 
	}

	function index() {
		$this->load->library('breadcrumb');
		$this->breadcrumb->add('Histori','skripsi/histori_bimbingan_skripsi')
		->add('Histori Bimbingan Skripsi','skripsi/histori_bimbingan_skripsi');
		$jurusan = $this->M_global->get_prodi();
		$data = array(
			'thisContent' 	=> 'skripsi/v_bimbingan_skripsi',
			'thisJs'		=> 'skripsi/js_bimbingan_skripsi',
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

		$getnip		= $this->M_global->get_nip($userid);
		$nipdosen 	= $getnip[0]['nip'];

		$data = $this->M_bimbingan_skripsi->get_data_detail($date1, $date2, $group,$nipdosen);
		echo $data;
	}

}