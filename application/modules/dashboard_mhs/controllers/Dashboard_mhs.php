<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Dashboard_mhs extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('M_dashboard');
		if (!$this->session->userdata('logged_in')) {
			redirect('login');
		}
		if($this->session->userdata['logged_in']['userlevel']=='Dosen'){
			redirect('dashboard_dosen');
		}
		if($this->session->userdata['logged_in']['userlevel']=='Dosen'){
			redirect('dashboard_mhs');
		}
	}

	function index(){
		$nim				= substr($this->session->userdata['logged_in']['userid'], 0,12);
		$jml 				= $this->M_dashboard->cek_jud($nim);
		$data_jdl 			= $this->M_dashboard->get_status_jdl($nim);
		$ayat 				= $this->M_dashboard->cek_ayat($nim);
		$hadist				= $this->M_dashboard->cek_hadist($nim);
		$kk 				= $this->M_dashboard->cek_kk($nim);
		$qq 				= $this->M_dashboard->cek_qq($nim);
		$mbkm 				= $this->M_dashboard->count_mbkm($nim);
		$tugas_akhir 		= $this->M_dashboard->count_publikasi($nim);

		if($jml[0]['jml']  <= 0){
			$subtstat = 'Belum ada pengajuan';
		}else{
			if($data_jdl[0]['submission_status'] == 'Tolak' && $data_jdl[0]['code_status'] == 'Revisi'){
				$subtstat = $data_jdl[0]['code_status'];
			}else{
				$subtstat = $data_jdl[0]['submission_status'];
			}
		}

		$this->breadcrumb->add('Dashboard','dashboard_mhs');
		$data = array(
			'thisContent' 			=> 'dashboard_mhs/v_dashboard_mhs',
			'thisJs'				=> 'dashboard_mhs/js_dashboard_mhs',
			'submission_status'		=> $subtstat,
			'ayat'					=> $ayat[0]['jml'],
			'hadist'				=> $hadist[0]['jml'],
			'kk'					=> $kk[0]['jml'],
			'qq'					=> $qq[0]['jml'],
			'mbkm'					=> $mbkm,
			'tugas_akhir'					=> $tugas_akhir,
		);
		$this->parser->parse('template/template', $data);
	}

	function data_login(){
		header('Content-Type: application/json');
		$data = $this->M_login->get_data_login();
		echo $data;
	}

	function save(){
		$id 		= $_POST['id'];
		$userid		= $_POST['userid'];
		$full_name	= $_POST['full_name'];
		$email		= $_POST['email'];
		$password	= $_POST['password'];
		$status		= $_POST['status'];

		if ($id == 0) {
			$insert = $this->M_login->insert($userid, $full_name, $email, $password, $status);
			$result['feedback'] = 'Successfully Added Login'; 
		} else {
			$this->M_login->update($id, $userid, $full_name, $email, $password, $status);
			$result['feedback'] = 'Successfully Updated Login'; 
		}
		echo json_encode($result);
	}

	function delete(){
		$id = $_POST['id'];
		$this->M_login->delete($id);
	}

}