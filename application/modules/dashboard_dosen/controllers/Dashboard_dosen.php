<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Dashboard_dosen extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('M_dashboard_dosen');
		if (!$this->session->userdata('logged_in')) {
			redirect('login');
		}
	}

	function index(){
		$this->breadcrumb->add('Dashboard Dosen','dashboard_dosen/Dashboard_dosen');
		$email 	= $this->session->userdata['logged_in']['userid'];
		$username = $this->session->userdata['logged_in']['username'];
		$dosen 	= $this->M_dashboard_dosen->cekdosen($email);
		$nip = "";
		$jbt = "";
		if(isset($dosen[0])){
			$nip 	= $dosen[0]['nip'];
			$jbt 	= $dosen[0]['jabatan'];
		}
		
		$baru_sem 	= $this->M_dashboard_dosen->get_baru_sem($nip, $jbt);
		$proses_sem	= $this->M_dashboard_dosen->get_pr_sem($nip);
		$selesai_sem= $this->M_dashboard_dosen->get_end_sem($nip);

		$baru 	= $this->M_dashboard_dosen->get_baru($nip, $jbt);
		$proses	= $this->M_dashboard_dosen->get_pr($nip);
		$selesai= $this->M_dashboard_dosen->get_end($nip);
		$publikasinew = $this->M_dashboard_dosen->publikasiNew($username);
		$publikasi = $this->M_dashboard_dosen->publikasi($username);
		$donepublikasi = $this->M_dashboard_dosen->donepublikasi($username);
		$newsempro2 = $this->M_dashboard_dosen->sempronewmbkbm($username);
		$sempro = $this->M_dashboard_dosen->semprombkbm($username);
		$semprodone = $this->M_dashboard_dosen->semprodonembkbm($username);
		$newskripsi = $this->M_dashboard_dosen->skripsinewmbkbm($username);
		$skripsi = $this->M_dashboard_dosen->skripsimbkbm($username);
		$skripsidone = $this->M_dashboard_dosen->skripsidonembkbm($username);
		$ayat 				= $this->M_dashboard_dosen->cek_ayat($nip);
		$hadist				= $this->M_dashboard_dosen->cek_hadist($nip);
		$kk 				= $this->M_dashboard_dosen->cek_kk($nip);
		$qq 				= $this->M_dashboard_dosen->cek_qq($nip);

		$data 	= array(
			'thisContent' 	=> 'dashboard_dosen/v_dashboard_dosen',
			'thisJs'		=> 'dashboard_dosen/js_dashboard_dosen',
			'bskripsinew'	=> $baru[0]['jmlnew'],
			'bskripsipr'	=> $proses[0]['jmlproses'],
			'bskripsiend'	=> $selesai[0]['jmlend'],
			'bsempronew'	=> $baru_sem[0]['jmlnew_sem'],
			'bsempropr'		=> $proses_sem[0]['jmlproses_sem'],
			'bsemproend'	=> $selesai_sem[0]['jmlend_sem'],
			'ayat'			=> $ayat[0]['jml'],
			'hadist'		=> $hadist[0]['jml'],
			'publikasinew' => $publikasinew,
			'publikasi' => $publikasi,
			'donepublikasi'=> $donepublikasi,
			'sempronew'=> $newsempro2,
			'sempro'=> $sempro,
			'semprodone'=> $semprodone,
			'skripsinew'=> $newskripsi,
			'skripsi'=> $skripsi,
			'skripsidone'=> $skripsidone,
			'kk'			=> $kk[0]['jml'],
			'qq'			=> $qq[0]['jml'],
		);
		$this->parser->parse('template/template', $data);
	}

}