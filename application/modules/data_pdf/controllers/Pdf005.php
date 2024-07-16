<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Pdf005 extends CI_Controller {

    function __construct() {
		parent::__construct();
		$this->load->model('data_pdf/M_pdf005');

		if (!$this->session->userdata('logged_in')) {
			redirect('login');
		} else if ($this->session->userdata['logged_in']['userlevel'] !== "mahasiswa"){
			redirect('login');
		}
	}
 
	public function index()
	{
		$subcode				= base64_decode($_GET['subcd']);
		// var_dump($subcode);
		$userid 				= substr($this->session->userdata['logged_in']['userid'], 0,12 );
		$data_det				= $this->M_pdf005->getdatapdf($subcode,$userid);
		$data_logbi				= $this->M_pdf005->getdatatgl($subcode,$userid);
		$tanggalan				= $data_logbi[0]['tgl_bimbingan'];
		$keterangan_bimbingan	= $data_logbi[0]['keterangan_bimbingan'];

		$bulan					= substr($tanggalan,5,2);
		$tahun					= substr($tanggalan,0,4);
		$tanggal				= substr($tanggalan,8,2);

		if($bulan=='01'){
			$vbulan 		= 'JANUARI';
		}else if($bulan=='02'){
			$vbulan 		= 'FEBRUARI';
		}else if($bulan=='03'){
			$vbulan 		= 'MARET';
		}else if($bulan=='04'){
			$vbulan 		= 'APRIL';
		}else if($bulan=='05'){
			$vbulan 		= 'MEI';
		}else if($bulan=='06'){
			$vbulan 		= 'JUNI';
		}else if($bulan=='07'){
			$vbulan 		= 'JULI';
		}else if($bulan=='08'){
			$vbulan 		= 'AGUSTUS';
		}else if($bulan=='09'){
			$vbulan 		= 'SEPTEMBER';
		}else if($bulan=='10'){
			$vbulan 		= 'OKTOBER';
		}else if($bulan=='11'){
			$vbulan 		= 'NOVEMBER';
		}else if($bulan=='12'){
			$vbulan 		= 'DESEMBER';
		}


		$tglacc 			= $tanggal." ".$vbulan." ".$tahun; 
		
		if($data_det[0]['jurusan']=='Hukum Bisnis Syariah'){
			$namakoor 	= 'Mohammad Hipni, S.H.I.,M.HI.';
			$nipkoor	= '198001172014041000';
		}else if($data_det[0]['jurusan']=='Ekonomi Syariah'){
			$namakoor 	= 'Dahruji, S.E.,M.E.I';
			$nipkoor	= '198109132015041000';
		}

		$data 					= array(
			'nim'					=>	$data_det[0]['nim'],
			'student_name'			=>	$data_det[0]['student_name'],
			'jurusan'				=>	$data_det[0]['jurusan'],
			'title'					=>	$data_det[0]['title'],
			'dosbing'				=>	$data_det[0]['dosbing'],
			'nama'					=>	$data_det[0]['nama'],
			'namakoor'				=>	$namakoor,
			'nipkoor'				=>	$nipkoor,
			'tglacc'				=>	$tglacc,
			'keterangan_bimbingan'	=>	$keterangan_bimbingan,
		);
		// $this->load->view('data_pdf/v_pdf005',$data);
		// $this->load->view('data_pdf/v_pdf005');

		$this->load->library('pdfgenerator');
		$html = $this->load->view('v_pdf005', $data, true);
	    $this->pdfgenerator->generate($html,'Form Kelayakan Mengikuti Sidang Sempro');

	}
}