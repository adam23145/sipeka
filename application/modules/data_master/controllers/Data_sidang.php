<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

require_once APPPATH . 'libraries/ExcelTemplate/autoload.php'; // if you don't use framework
use PhpOffice\PhpSpreadsheet\IOFactory;

class Data_sidang extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('M_sidang');
		$this->load->model('M_global');
		if (!$this->session->userdata('logged_in')) {
			redirect('login');
		}
	}
	function index()
	{
		$this->breadcrumb->add('Settings', 'data_master/data_sidang')
			->add('Data Mahasiswa', 'data_master/data_sidang');
		$data = array(
			'thisContent' 	=> 'data_master/v_sidang',
			'thisJs'		=> 'data_master/js_data_sidang',
		);
		$this->parser->parse('template/template', $data);
	}
}