<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

require_once APPPATH.'libraries/ExcelTemplate/autoload.php'; // if you don't use framework
use PhpOffice\PhpSpreadsheet\IOFactory;

class Data_mahasiswa extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('M_mahasiswa');
		if (!$this->session->userdata('logged_in')) {
			redirect('login');
		}
	}

	function index(){
		$this->breadcrumb->add('Settings','data_master/data_mahasiswa')
		->add('Data Mahasiswa','data_master/data_mahasiswa');
		$data_prodi = $this->M_global->get_prodi();
		$data = array(
			'thisContent' 	=> 'data_master/v_mahasiswa',
			'thisJs'		=> 'data_master/js_data_mahasiswa',
			'data_prodi'	=> $data_prodi
		);
		$this->parser->parse('template/template', $data);
	}
	
	function list_data(){
		header('Content-Type: application/json');
		$data = $this->M_mahasiswa->get_data_mahasiswa();
		echo $data;
	}

	function save(){
		$id	= $_POST['id'];
		if ($id == 0) {
			$item = array(
				'nim'			=> $_POST['nim'],
				'nama'			=> $_POST['nama'],
				'email'			=> $_POST['email'],
				'fakultas'		=> $_POST['fakultas'],
				'jurusan'		=> $_POST['jurusan'],
				'jenis_kelamin'	=> $_POST['jenis_kelamin'],
				'tahun_masuk'	=> $_POST['tahun_masuk'],
				'status'		=> $_POST['status'],
				'upd'			=> $this->session->userdata['logged_in']['userid']
			);		
			$insert = $this->M_mahasiswa->insert($item);
			$result['feedback'] = 'Successfully Added Login'; 
		} else {
			$item = array(
				'nama'			=> $_POST['nama'],
				'email'			=> $_POST['email'],
				'fakultas'		=> $_POST['fakultas'],
				'jurusan'		=> $_POST['jurusan'],
				'tahun_masuk'	=> $_POST['tahun_masuk'],
				'jenis_kelamin'	=> $_POST['jenis_kelamin'],
				'status'		=> $_POST['status'],
				'upd'			=> $this->session->userdata['logged_in']['userid']
			);		
			$this->M_mahasiswa->update($id, $item);
			$result['feedback'] = 'Successfully Updated Login'; 
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
					$vars['nim']			= $single_schedule[0];
					$vars['nama']			= $single_schedule[1];
					$vars['email']			= $single_schedule[2];
					$vars['fakultas']		= $single_schedule[3];
					$vars['jurusan']		= $single_schedule[4];
					$vars['jenis_kelamin']	= $single_schedule[5];
					$vars['tahun_masuk']	= $single_schedule[6];
					$vars['status']			= $single_schedule[7];
					$vars['upd']			= $this->session->userdata['logged_in']['userid'];
					$vars['nik']			= $single_schedule[8];
					$vars['agama']			= $single_schedule[9];
					$vars['tempat_lahir']	= $single_schedule[10];
					$vars['ibu_kandung']	= $single_schedule[11];
					$vars['tgl_masuk']		= $single_schedule[12];
					// foreach( $single_schedule as $single_item ){
						// $vars[strtolower($schdeules[0][$j])] =  $single_item;
						// $j++;
					// }
					$items[] = $vars;
				}
				$i++;
			}
			$ins = $this->M_mahasiswa->insert_batch($items);
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
		$this->M_mahasiswa->delete($id);
	}

}