<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

require_once APPPATH.'libraries/ExcelTemplate/autoload.php'; // if you don't use framework
use PhpOffice\PhpSpreadsheet\IOFactory;

class Data_skripsi extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('M_skripsi');
		if (!$this->session->userdata('logged_in')) {
			redirect('login');
		}
	}

	function index(){
		$this->breadcrumb->add('Settings','data_master/data_skripsi')
		->add('Data Skripsi','data_master/data_skripsi');
		$data_prodi = $this->M_global->get_prodi();
		$data = array(
			'thisContent' 	=> 'data_master/v_skripsi',
			'thisJs'		=> 'data_master/js_data_skripsi',
			'data_prodi'	=> $data_prodi
		);
		$this->parser->parse('template/template', $data);
	}
	
	function list_data(){
		header('Content-Type: application/json');
		$date1 		= $_POST['date1'];
		$data 		= $this->M_skripsi->get_data_skripsi($date1);
		echo $data;
	}

	

}