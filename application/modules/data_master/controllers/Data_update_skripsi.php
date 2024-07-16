<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

require_once APPPATH.'libraries/ExcelTemplate/autoload.php'; // if you don't use framework
use PhpOffice\PhpSpreadsheet\IOFactory;

class Data_update_skripsi extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('M_update_skripsi');
		if (!$this->session->userdata('logged_in')) {
			redirect('login');
		}
	}

	function index(){
		$this->breadcrumb->add('Settings','data_master/data_update_skripsi')
		->add('Data sempro','data_master/data_update_skripsi');
		$data_status 	= $this->M_global->get_status();
		$email 			= $this->session->userdata['logged_in']['userid'];
		$get_prodi 		= $this->M_global->getprodiadmin($email);
		$res_prodi 		= $get_prodi[0]['program_study'];
		$jurusan 		= $res_prodi;
		$dpt_jur 		= $this->M_global->get_dosen($jurusan);

		$data = array(
			'thisContent' 	=> 'data_master/v_update_skripsi',
			'thisJs'		=> 'data_master/js_data_update_skripsi',
			'data_status'	=> $data_status,
			'res_prodi'		=> $res_prodi,
			'dpt_jur'		=> $dpt_jur,
		);
		$this->parser->parse('template/template', $data);
	}
	
	function list_data(){
		header('Content-Type: application/json');
		$res_prodi = $_POST['res_prodi'];
		$data = $this->M_update_skripsi->get_data_sempro($res_prodi);
		echo $data;
	}

	function save(){
		$submission_code	= $_POST['submission_code'];
		$id					= $_POST['id'];
		$nim				= $_POST['nim'];
		$jdlskrip			= $_POST['jdlskrip'];
		$namapembimbing		= $_POST['namapembimbing'];
		$pembimbbar			= $_POST['pembimbbar'];
		$nampembimbbar		= $_POST['nampembimbbar'];
		$submission_status	= $_POST['submission_status'];
		$loker				= $_POST['loker'];
		$ket				= 'Perubahan judul';
		
		$upd				= $this->session->userdata['logged_in']['userid'];	

		if ($pembimbbar == 0) {
			$updatejdlskripsi = $this->M_update_skripsi->updatejudulskripsi($id, $submission_code, $nim, $jdlskrip, $upd);

			if($updatejdlskripsi){
				$update = $this->M_update_skripsi->updatejudul($id, $submission_code, $nim, $jdlskrip, $upd);

				if($update){
					$updatesub = $this->M_update_skripsi->updatesub($id, $submission_code, $nim, $jdlskrip, $upd);

					if($updatesub){
						$insertlogsub = $this->M_update_skripsi->insertlogsub($submission_code, $submission_status, $loker, $upd, $ket);
						if($insertlogsub){
							$result['feedback'] = 'Berhasil Mengedit Pengajuan Judul';
						}else{
							$result['feedback'] = 'Gagal Mengedit Pengajuan Judul';
						}
					}else{
							$result['feedback'] = 'Gagal Mengedit Pengajuan Judul';
						}
				}else{
							$result['feedback'] = 'Gagal Mengedit Pengajuan Judul';
						}
			}else{
				$result['feedback'] = 'Gagal Mengedit Pengajuan Judul';
			}
		} else {
			$ket 				=  'Perubahan judul & Perubahan dosen dari '.$namapembimbing.' menjadi '.$nampembimbbar;
			$updatejdlskripsi 			= $this->M_update_skripsi->updatejudulskripsi2($id, $submission_code, $pembimbbar, $nim, $jdlskrip, $upd);

			if($updatejdlskripsi){
				$update 			= $this->M_update_skripsi->updatejudul2($id, $submission_code, $pembimbbar, $nim, $jdlskrip, $upd);

				if($update){
					$updatesub = $this->M_update_skripsi->updatesub2($id, $submission_code, $pembimbbar, $nim, $jdlskrip, $upd);

					if($updatesub){
						$insertlogsub = $this->M_update_skripsi->insertlogsub($submission_code, $submission_status, $loker, $upd, $ket);

						if($insertlogsub){
							$result['feedback'] = 'Berhasil Mengedit Pengajuan Judul';
						}else{
							$result['feedback'] = 'Gagal Mengedit Pengajuan Judul';
						}
					}else{
						$result['feedback'] = 'Gagal Mengedit Pengajuan Judul';
					}
				}else{
					$result['feedback'] = 'Gagal Mengedit Pengajuan Judul';
				}
			}else{
				$result['feedback'] = 'Gagal Mengedit Pengajuan Judul';
			}

				
		}
		echo json_encode($result);
	}

}