<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Form_detail extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('M_detail');
		if (!$this->session->userdata('logged_in')) {
			redirect('login');
		}
	}

	function edit(){
		$this->breadcrumb->add('Form','form/form_detail')
		->add('Detail Pengajuan Judul','form/form_detail');

		$sub_code 	= $this->uri->segment(4);
		$title_sub 	= $this->M_detail->get_sub($sub_code);
		$dpturl 	= $title_sub[0]['url_judulbimbingan'];
		$sttsurl 	= $title_sub[0]['status_url'];

		if($dpturl == 'none' || $dpturl == ''){
			$dpturl = 'Belum input URL';
		}else{
			$dpturl = ' <a href="'.$dpturl.'" target="_blank">klik disini</a>';
		}

		if($sttsurl == 0 || $sttsurl == '0'){
			$sttsurl = '<button class="btn btn-block btn-secondary disabled">Anda sudah input URL</button>';
		}else{
			$sttsurl = '<button onclick="myFunction()" class="btn btn-block btn-warning btn-lg" >Input URL</button>';
		}

		$dosbing 	= $title_sub[0]['dosbing'];
		$dosen_p 	= $this->M_detail->get_nama_dosen($dosbing);
		if($dosbing=='-' || $dosbing=='None'){
			$dos_pemb='';
		}else{
			$dos_pemb = $dosen_p[0]['nama'];
		}

		$substt = $title_sub[0]['submission_status'];
		$sb		= $title_sub[0]['code_status'];

		if($substt=='Tolak'){
			if($sb!='Tutup'){
				$submstt = $sb;
			}else{
				$submstt = 'Ditolak';
			}
			 
		}else{
			$submstt = $substt;
		}

		$data = array(
			'thisContent' 	=> 'form/v_detail',
			'thisJs'		=> 'form/js_detail',
			'judul'			=> $title_sub[0]['title'],
			'submission_code'			=> $title_sub[0]['submission_code'],
			'loker'			=> $title_sub[0]['loker'],
			'jurusan'		=> $title_sub[0]['jurusan'],
			'rumusan'		=> $title_sub[0]['rms_maslh'],
			'urgensi'		=> $title_sub[0]['urgensi'],
			'sub_status'	=> $submstt,
			'student_name'	=> $title_sub[0]['student_name'],
			'nim'			=> $title_sub[0]['nim'],
			'dos_pemb'		=> $dos_pemb,
			'sub_code'		=> $sub_code,
			'dpturl'		=> $dpturl,
			'sttsurl'		=> $sttsurl
		);
		$this->parser->parse('template/template', $data);
	}

	function get_pdf() {
		if (!$_POST) {
			return;
		}

		header('Content-Type: application/json');
		$fid 			= $_POST['fid'];
		$fnim 			= $_POST['fnim'];
		$fjudul 		= $_POST['fjudul'];

		$data_pdf = $this->M_detail->get_pdf($fnim,$fjudul);
		$data 				= array(
			'nim'				=> $data_pdf[0]['nim'],
			'submission_code'	=> $data_pdf[0]['submission_code']
		);

		echo json_encode($data);
	}

	function data_status(){
		$sub_code 	= $_POST['subcode'];
		header('Content-Type: application/json');
		$data = $this->M_detail->get_data_status($sub_code);
		echo $data;
	}

	function get_dokumen(){
		$userid 		= substr($this->session->userdata['logged_in']['userid'], 0,12);
		$query 			= " SELECT * FROM dokumen WHERE nim='$userid' AND aktif='Y' AND dokumen='Cetak form kesediaan menjadi dosen pembimbing' ";
		$data 			= $this->db->query($query)->result_array();

		echo json_encode ($data);
	}

	function get_sttsurl(){
		$userid 		= substr($this->session->userdata['logged_in']['userid'], 0,12);
		$query 			= " SELECT status_url,url_judulbimbingan FROM title_submission WHERE nim='$userid' AND submission_status !='Tolak' ";
		$data 			= $this->db->query($query)->result_array();

		echo json_encode ($data);
	}

	function save(){
		$user 				= $this->session->userdata['logged_in']['userid'];
		$userid 			= substr($user, 0,12);
		$sub_code 			= $_POST['sub_code'];
		$judul				= $_POST['judul'];
		$rumusah_masalah	= $_POST['rumusah_masalah'];
		$urgensi			= $_POST['urgensi'];
		$sub_stats 			= 'Menunggu Review Koorprodi';
		$code_stats 		= 'Submit revisi';
		$loker 				= 'Koordinator Prodi';

		$update = $this->M_detail->update($userid, $sub_code, $judul, $rumusah_masalah, $sub_stats, $code_stats, $loker);

		if($update){
			$insert_log = $this->M_detail->insert_log($sub_code, $rumusah_masalah, $userid, $sub_stats, $code_stats, $loker);

			if($insert_log){
				$result['feedback'] = 'Berhasil Mengedit Pengajuan Judul';
			}
		}		
		echo json_encode($result);
	}

	function save_url(){
		$user 				= $this->session->userdata['logged_in']['userid'];
		$userid 			= $_POST['nim'];
		$sub_code 			= $_POST['submission_code'];
		$loker				= $_POST['loker'];
		$sub_status			= $_POST['sub_status'];
		$urlbimbingan		= $_POST['urlbimbingan'];
		$status_url			= '0';
		$code_stats			= 'Acc';
		$keterangan			= 'Input URL';

		$update = $this->M_detail->update_url($userid, $sub_code, $urlbimbingan, $status_url);

		if($update){
			$insert_log = $this->M_detail->insert_log_url($sub_code, $userid, $sub_status, $code_stats, $loker, $keterangan);

			if($insert_log){
				$result['feedback'] = 'Berhasil Menginput URL';
			}
		}		
		echo json_encode($result);
	}

}