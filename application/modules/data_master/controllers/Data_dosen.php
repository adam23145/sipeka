<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

require_once APPPATH.'libraries/ExcelTemplate/autoload.php'; // if you don't use framework
use PhpOffice\PhpSpreadsheet\IOFactory;

class Data_dosen extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('M_dosen');
		if (!$this->session->userdata('logged_in')) {
			redirect('login');
		}
	}

	function index(){
		$this->breadcrumb->add('Settings','data_master/data_dosen')
		->add('Data Dosen','data_master/data_dosen');
		$data_prodi = $this->M_global->get_prodi();
		$data_jabatan = $this->M_global->get_jabatan();
		$data = array(
			'thisContent' 	=> 'data_master/v_dosen',
			'thisJs'		=> 'data_master/js_data_dosen',
			'data_prodi'	=> $data_prodi,
			'data_jabatan'	=> $data_jabatan
		);
		$this->parser->parse('template/template', $data);
	}
	
	function list_data(){
		header('Content-Type: application/json');
		$searchValue = $this->input->post('search')['value'];
		$data = $this->M_dosen->get_data_dosen($searchValue);
		echo $data;
	}

	function save(){
		// $id	= $_POST['nip'];
		$id 				= $_POST['id'];
		$nip				= $_POST['nip'];
		$kode_dosen			= $_POST['nip'];
		$nama				= $_POST['nama'];
		$email				= $_POST['email'];
		$jenis_kelamin		= $_POST['jenis_kelamin'];
		$status				= $_POST['status'];
		$createddate		= date('Y-m-d H:i:s');
		$upd				= $this->session->userdata['logged_in']['userid'];
		$cp					= '';
		$jabatan			= $_POST['jabatan'];
		$program_study		= $_POST['program_study'];
		

		if ($id == '0' || $id == 0 || $id == null) {
			$insert = $this->M_dosen->insert_data($nip, $kode_dosen, $nama, $email, $jenis_kelamin, $status, $createddate, $upd, $cp, $jabatan, $program_study);
			if($insert){
				$result['feedback'] = 'Berhasil menambah dosen/staf'; 
			}else{
				$result['feedback'] = 'Ada kesalahan'; 
			}
			
		} else {
			$update_result = $this->M_dosen->update($nip, $kode_dosen, $nama, $email, $jenis_kelamin, $status, $createddate, $upd, $cp, $jabatan, $program_study, $id);

			// Cek apakah pembaruan berhasil
			if ($update_result) {
				$result['feedback'] = 'Berhasil merubah dosen/staf: ' . $nama; 
			} else {
				$result['feedback'] = 'Gagal merubah dosen/staf. Data tidak ditemukan atau tidak ada perubahan.' . $nama;
			}
		}
		echo json_encode($result);
	}
	
	public function uploads(){
		$config['upload_path']          = dirname(APPPATH) . "/document/uploads_tmp/";
		$config['allowed_types']        = 'xls|xlsx';
		$config['file_name']            = "upload_".date("YmdHis");
		
		$this->load->library('upload', $config);

		if ($this->upload->do_upload('fileupload')){
			$data = array('upload_data' => $this->upload->data());
			$inputFileName = dirname(APPPATH) . "/document/uploads_tmp/" . $data['upload_data']['file_name'];
			$inputFileType = \PhpOffice\PhpSpreadsheet\IOFactory::identify($inputFileName);
			$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputFileType);
			$spreadsheet = $reader->load($inputFileName);
			$schdeules = $spreadsheet->getActiveSheet()->toArray();
			$items = array();
			$i=0;
			foreach( $schdeules as $single_schedule )
			{
				if($i > 0){
					// $j=0;
					$vars['dosen']		= $single_schedule[0];
					$vars['tema']		= $single_schedule[1];
					$vars['id_prodi']	= $single_schedule[2];
					$vars['status']		= 1;
					$vars['upd']		= $this->session->userdata['logged_in']['userid'];
					// foreach( $single_schedule as $single_item ){
						// $vars[strtolower($schdeules[0][$j])] =  $single_item;
						// $j++;
					// }
					$items[] = $vars;
				}
				$i++;
			}
			$ins = $this->M_dosen->insert_batch($items);
			if($ins){
				unlink($inputFileName);
				$result['feedback'] = 'Successfully Uploaded Data'; 
			}
			echo json_encode($result);
		}else{
			$error = array('error' => $this->upload->display_errors());
			print_r($error);
		}
	}

	function delete(){
		$id = $_POST['id'];
		$this->M_dosen->delete($id);
	}

}