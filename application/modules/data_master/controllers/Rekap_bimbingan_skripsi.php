<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

require_once APPPATH.'libraries/ExcelTemplate/autoload.php'; // if you don't use framework
use PhpOffice\PhpSpreadsheet\IOFactory;

class Rekap_bimbingan_skripsi extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('M_R_bimbingan_skripsi');
		if (!$this->session->userdata('logged_in')) {
			redirect('login');
		}
	}

	function index(){
		$this->breadcrumb->add('Settings','data_master/rekap_bimbingan_skripsi')
		->add('Rekap Bimbingan Skripsi','data_master/rekap_bimbingan_skripsi');
		$data_prodi = $this->M_global->get_prodi();
		$data = array(
			'thisContent' 	=> 'data_master/v_R_skripsi',
			'thisJs'		=> 'data_master/js_Rbimbingan_skripsi',
			'data_prodi'	=> $data_prodi
		);
		$this->parser->parse('template/template', $data);
	}
	
	function list_data(){
		header('Content-Type: application/json');
		$date1 		= $_POST['date1'];
		$data 		= $this->M_R_bimbingan_skripsi->get_data_skripsi($date1);
		echo $data;
	}

	

}