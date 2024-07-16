<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Form_detail_sempro extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('M_detail_sempro');
		if (!$this->session->userdata('logged_in')) {
			redirect('login');
		}
	}

	function edit(){
		$this->breadcrumb->add('Histori','history/form_detail_sempro')
		->add('Detail Bimbingan Skripsi','history/form_detail_sempro');

		$sub_code 	= $this->uri->segment(4);
		$title_sub 	= $this->M_detail_sempro->get_sub($sub_code);
		$dosbing 	= $title_sub[0]['dosbing'];
		$dosen_p 	= $this->M_detail_sempro->get_nama_dosen($dosbing);

		$data = array(
			'thisContent' 	=> 'history/v_detail_sempro',
			'thisJs'		=> 'history/js_detail_sempro',
			'judul'			=> $title_sub[0]['title'],
			'loker'			=> $title_sub[0]['loker'],
			'jurusan'		=> $title_sub[0]['jurusan'],
			'rumusan'		=> $title_sub[0]['rms_maslh'],
			'urgensi'		=> $title_sub[0]['urgensi'],
			'sub_status'	=> $title_sub[0]['submission_status'],
			'student_name'	=> $title_sub[0]['student_name'],
			'nim'			=> $title_sub[0]['nim'],
			'dos_pemb'		=> $dosen_p[0]['nama'],
			'sub_code'		=> $sub_code
		);
		$this->parser->parse('template/template', $data);
	}

	function data_status(){
		$sub_code 	= $_POST['subcode'];
		header('Content-Type: application/json');
		$data = $this->M_detail_sempro->get_data_status($sub_code);
		echo $data;
	}

	function get_dokumen(){
		$userid 		= substr($this->session->userdata['logged_in']['userid'], 0,12);
		$query 		= "SELECT * FROM dokumen WHERE nim='$userid' AND aktif='Y' AND dokumen='Surat Tugas Dosen Pembimbing' ";
		$data 		= $this->db->query($query)->result_array();

		echo json_encode ($data);
	}

	

}