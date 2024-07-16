<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Dashboard extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('M_dashboard');
		if (!$this->session->userdata('logged_in')) {
			redirect('login');
		}

		if($this->session->userdata['logged_in']['userlevel'] == 'Dosen'){
			redirect('dashboard_dosen');
		}

		if($this->session->userdata['logged_in']['userlevel'] == 'mahasiswa'){
			redirect('dashboard_mhs');
		}
	}

	function index(){
		$userid			= $this->session->userdata['logged_in']['userid'];
		$lvl			= $this->session->userdata['logged_in']['userlevel'];
		$data_st		= $this->M_dashboard->get_status_st($userid);
		if($lvl=='Wadek' || $lvl=='Dekan' || $lvl=='Sekjur' || $lvl=='Kajur' || $lvl=='Admin Prodi' ){
			$jur 		= '';
		}else{
			$jur 		= $data_st[0]['program_study'];
		}
		

		$data_ds		= $this->M_dashboard->get_count($jur,$lvl);
		$data_tl		= $this->M_dashboard->get_counttolak($jur,$lvl);
		$data_all		= $this->M_dashboard->get_countall($jur,$lvl);
		$data_revisi	= $this->M_dashboard->get_revisi($jur,$lvl);
		$data_rv		= $this->M_dashboard->get_count_rev($jur,$lvl);
		$data_app		= $this->M_dashboard->get_count_app($userid,$lvl, $jur);

		$newsempro 		= $this->M_dashboard->get_newsempro($userid,$lvl,$jur);

		$baru_sem 		= $this->M_dashboard->get_baru_sem($userid,$lvl);


		$proses_sem		= $this->M_dashboard->get_pr_sem($userid,$lvl,$jur);


		$selesai_sem	= $this->M_dashboard->get_end_sem($userid,$lvl,$jur);

		$baru 	= $this->M_dashboard->get_baru($userid,$lvl,$jur);
		$proses	= $this->M_dashboard->get_pr($userid,$lvl,$jur);
		$selesai= $this->M_dashboard->get_end($userid,$lvl,$jur);
		
		$ayat 				= $this->M_dashboard->cek_ayat("");
		$hadist				= $this->M_dashboard->cek_hadist("");
		$kk 				= $this->M_dashboard->cek_kk("");
		$qq 				= $this->M_dashboard->cek_qq("");

		$this->breadcrumb->add('Dashboard','dashboard/Dashboard');
		$data = array(
			'thisContent' 	=> 'dashboard/v_dashboard',
			'thisJs'		=> 'dashboard/js_dashboard',
			'lvl'			=> $lvl,
			'jmlh_new'		=> $data_ds[0]['jmlnew'],
			'jmltolak'		=> $data_tl[0]['jmltolak'],
			'jmlrev'		=> $data_rv[0]['jmlrev'],
			'jmlapp'		=> $data_app[0]['jmlapp'],
			'jmlrevisi'		=> $data_revisi[0]['jmlrevisi'],
			'bsempronew'	=> $baru_sem[0]['jmlnew_sem'],
			'newsempro'		=> $newsempro[0]['newsempro'],
			'bsempropr'		=> $proses_sem[0]['jmlproses_sem'],
			'bsemproend'	=> $selesai_sem[0]['jmlend_sem'],
			'bskripsinew'	=> $baru[0]['jmlnew'],
			'bskripsipr'	=> $proses[0]['jmlproses'],
			'bskripsiend'	=> $selesai[0]['jmlend'],
			'jmlall'		=> $data_all[0]['jmlall'],
			'ayat'			=> $ayat[0]['jml'],
			'hadist'		=> $hadist[0]['jml'],
			'kk'			=> $kk[0]['jml'],
			'qq'			=> $qq[0]['jml'],
		);
		$this->parser->parse('template/template', $data);
	}

	

}