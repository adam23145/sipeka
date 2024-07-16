<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Form_judul extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('M_pengajuanJudul');
		$this->load->helper('string');
		if (!$this->session->userdata('logged_in')) {
			redirect('login');
		}
	}

	function index(){
		$this->breadcrumb->add('Form','form/form_judul')
		->add('Pengajuan Judul','form/form_judul');
		$majorcode			= substr($this->session->userdata['logged_in']['userid'], 4,3);
		$nim				= substr($this->session->userdata['logged_in']['userid'], 0,12);
		$token				= random_string('numeric', 3);
		$subm_id  			= 'FKIS1605-'.$majorcode.$token.date("dhs");
		// $major_name			= $this->M_global->get_jurusan($majorcode);
		$major_name			= $this->M_global->get_jurusan2($nim);
		
		$data = array(
			'thisContent' 	=> 'form/v_pengajuan_judul',
			'thisJs'		=> 'form/js_pengajuan_judul',
			'subm_id'		=> $subm_id,
			'majorname'		=> $major_name[0]['jurusan'],
		);
		$this->parser->parse('template/template', $data);
	}

	function get_judul(){
		$userid 			= substr($this->session->userdata['logged_in']['userid'],0,12);
		$cekjudul 			= $this->M_pengajuanJudul->cek_jud($userid);		

		$data = array(
				'jml' 		=> $cekjudul[0]['jml'],
			);
		echo json_encode($data);
	}

	function save(){
		$user 				= $this->session->userdata['logged_in']['userid'];
		$userid 			= substr($user, 0,12);
		$sub_code 			= $_POST['sub_code'];
		$nama				= $_POST['nama'];
		$jurusan 			= $_POST['majorname'];
		$nim				= $_POST['nim'];
		$judul				= $_POST['judul'];
		$rumusah_masalah	= $_POST['rumusah_masalah'];
		$urgensi			= $_POST['urgensi'];
		$sub_status			= 'Menunggu Review Koorprodi';
		$code_status		= 'New';
		$loker				= 'Koordinator Prodi';

		$insert = $this->M_pengajuanJudul->insert($userid, $sub_code, $nama, $nim, $jurusan, $judul, $rumusah_masalah, $urgensi, $sub_status, $code_status, $loker);
		if ($insert) {
			$inser_log = $this->M_pengajuanJudul->insert_log($sub_code, $rumusah_masalah, $urgensi, $userid, $sub_status, $code_status, $loker);
			if ($inser_log) {
				$result['feedback'] = 'Berhasil Mengajukan Judul'; 
			}
		}

		echo json_encode($result);
	}

	function delete(){
		$id = $_POST['id'];
		$this->M_login->delete($id);
	}

}