<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Pdf003 extends CI_Controller {

    function __construct() {
		parent::__construct();
		$this->load->model('data_pdf/M_pdf003');

		if (!$this->session->userdata('logged_in')) {
			redirect('login');
		} else if ($this->session->userdata['logged_in']['userlevel'] !== "mahasiswa"){
			redirect('login');
		}
	}
 
	public function index()
	{
		$subcode			= base64_decode($_GET['subcd']);
		$userid 			= substr($this->session->userdata['logged_in']['userid'], 0,12 );
		$data_det			= $this->M_pdf003->getdatapdf($subcode,$userid);
		$data_jml			= $this->M_pdf003->getjml($subcode,$userid);
		if($data_det[0]['jurusan']=='Hukum Bisnis Syariah'){
			$namakoor 	= 'Mohammad Hipni, S.H.I.,M.HI.';
			$nipkoor	= '198001172014041000';
		}else if($data_det[0]['jurusan']=='Ekonomi Syariah'){
			$namakoor 	= 'Dahruji, S.E.,M.E.I';
			$nipkoor	= '198109132015041000';
		}

		$data 					= array(
			'nim'				=>	$data_det[0]['nim'],
			'student_name'		=>	$data_det[0]['student_name'],
			'jurusan'			=>	$data_det[0]['jurusan'],
			'title'				=>	$data_det[0]['title'],
			'dosbing'			=>	$data_det[0]['dosbing'],
			'nama'				=>	$data_det[0]['nama'],
			'submission_code'	=>	$data_det[0]['submission_code'],
			'namakoor'			=>	$namakoor,
			'nipkoor'			=>	$nipkoor,
			'jumlb'				=>	$data_jml[0]['jumlb'],
		);
		// $this->load->view('data_pdf/v_payslip_pdf',$data);
		// $this->load->view('data_pdf/v_pdf001');

		$this->load->library('pdfgenerator');
		$html = $this->load->view('v_pdf003', $data, true);
	    $this->pdfgenerator->generate($html,'Berita Acara Bimbingan Skripsi');

	}
}