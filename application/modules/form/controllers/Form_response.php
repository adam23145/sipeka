<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Form_response extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('M_response');
		if (!$this->session->userdata('logged_in')) {
			redirect('login');
		}

		if($this->session->userdata['logged_in']['userlevel'] == 'Wadek' || $this->session->userdata['logged_in']['userlevel'] == 'Dekan' || $this->session->userdata['logged_in']['userlevel'] == 'Admin Prodi' ){
			redirect('dasbhoard');
		}
	}

	function edit(){
		$this->breadcrumb->add('Form','form/form_response')
		->add('Detail Pengajuan Judul','form/form_response');

		$sub_code 	= $this->uri->segment(4);
		$title_sub 	= $this->M_response->get_sub($sub_code);
		$jurusan 	= $title_sub[0]['jurusan'];
		$data_dosen = $this->M_global->get_dosen($jurusan);
		
		if($title_sub[0]['code_status']=='Proses'){
			$stts_skrip = 'Pengajuan Baru';
		}else if($title_sub[0]['code_status']=='Submit revisi'){
			$stts_skrip = 'Pengajuan Revisi';
		}else{
			$stts_skrip = 'Diteruskan';
		}

		if($title_sub[0]['submission_status']!='In Review Koorprodi'){
			$dosbing = $title_sub[0]['dosbing'];
		}else{
			$dosbing = '';
		}

		$data = array(
			'thisContent' 	=> 'form/v_resp',
			'thisJs'		=> 'form/js_resp',
			'judul'			=> $title_sub[0]['title'],
			'id_sub'		=> $title_sub[0]['id'],
			'nim'			=> $title_sub[0]['nim'],
			'student_name'	=> $title_sub[0]['student_name'],
			'loker'			=> $title_sub[0]['loker'],
			'jurusan'		=> $title_sub[0]['jurusan'],
			'dosbing'		=> $dosbing,
			'rumusan'		=> $title_sub[0]['rms_maslh'],
			'createddate'	=> $title_sub[0]['createddate'],
			'urgensi'		=> $title_sub[0]['urgensi'],
			'sub_status'	=> $title_sub[0]['submission_status'],
			'sub_code'		=> $sub_code,
			'stts_skrip'	=> $stts_skrip,
			'data_dosen'	=> $data_dosen
		);
		$this->parser->parse('template/template', $data);
	}

	function data_status(){
		$sub_code 			= $_POST['subcode'];
		header('Content-Type: application/json');
		$data = $this->M_response->get_data_status($sub_code);
		echo $data;
	}

	function save(){
		$userid 			= $this->session->userdata['logged_in']['userid'];
		$sub_code 			= $_POST['sub_code'];

		$id_sub 			= $_POST['id_sub'];
		$stats				= $_POST['stats'];
		$loker			= $_POST['loker'];
		$loker_grp			= $_POST['loker_grp'];
		$nim				= $_POST['nim'];
		$judul				= $_POST['judul'];
		
		if($stats=='Terima'){			
			$dosen 				= $_POST['dsen'];
			$aksi_stat			= 'New';
			$aksi_log			= 'Acc';
			// $stats				= 'In Review '.$loker_grp;
			$stats				= 'Acc '.$loker;
			// if($loker_grp=='Dosen'){
			// 	$stats				= 'Bimbingan '.$loker_grp;
			// }
		}else if($stats=='Tolak'){
			$loker_grp			= 'mahasiswa';
			$dosen 				= 'None';
			$aksi_stat			= $_POST['aksi_stat'];
			$aksi_log			= 'Revisi';
		}
		$reason				= $_POST['reason'];
		

		$update = $this->M_response->update($userid, $sub_code, $id_sub, $stats, $loker_grp, $dosen, $aksi_stat, $reason);
		if($update){
			$update = $this->M_response->update_log($userid, $sub_code, $stats, $loker_grp, $reason, $aksi_stat,$aksi_log);

			if ($update) {
				if($_POST['stats']=='Terima'){
					if($loker_grp=='Dosen'){
						$insertdok = $this->M_response->insertdok($userid, $nim, $judul, $dosen, $sub_code);
					}					
				}
				
				$result['feedback'] = 'Berhasil Approve Pengajuan Judul';
			}
		}		
		
		echo json_encode($result);
	}

}