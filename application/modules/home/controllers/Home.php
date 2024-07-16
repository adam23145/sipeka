<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Home extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('M_home');
		if (!$this->session->userdata('logged_in')) {
			redirect('login');
		}
	}

	function index() {
		if ($this->session->userdata('logged_in')){
			$level = $this->session->userdata['logged_in']['userlevel'];
			
			if ($level == 'superadmin') {
				redirect('dashboard');
			} else if ($level == 'mahasiswa') {
				redirect('dashboard_mhs');
			} else if ($level == 'Koordinator Prodi') {
				redirect('dashboard');
			} else if ($level == 'Sekjur') {
				redirect('dashboard');
			} else if ($level == 'Kajur') {
				redirect('dashboard');
			} else if ($level == 'Dosen') {
				redirect('dashboard_dosen');
			} else if ($level == 'Wadek'){
				redirect('dashboard');
			}else if ($level == 'Dekan'){
				redirect('dashboard');
			} else if ($level == 'Admin Prodi'){
				redirect('data_master/data_mahasiswa');
			} else if ($level == 'Admin Lab'){
				redirect('data_hafalan/data_ayat');
			}
		} else {
			redirect('login');
		}	
	}

}