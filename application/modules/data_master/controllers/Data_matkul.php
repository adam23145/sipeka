<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

require_once APPPATH.'libraries/ExcelTemplate/autoload.php'; // if you don't use framework
use PhpOffice\PhpSpreadsheet\IOFactory;

class Data_matkul extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('M_matkul');
		if (!$this->session->userdata('logged_in')) {
			redirect('login');
		}
	}

	function index(){
		$this->breadcrumb->add('Settings','data_master/data_matkul')
		->add('Data Mata Kuliah','data_master/data_matkul');
		$data_matkul = $this->M_global->get_matkul();
		$data = array(
			'thisContent' 	=> 'data_master/v_matkul',
			'thisJs'		=> 'data_master/js_data_matkul',
			'data_matkul'	=> $data_matkul
		);
		$this->parser->parse('template/template', $data);
	}
	
	function list_data(){
		header('Content-Type: application/json');
		$data = $this->M_matkul->get_data_matkul();
		echo $data;
	}

	function save(){
		$id	= $_POST['id'];
		if ($id == 0) {
			$item = array(
				'kode_matkul'	=> $_POST['kode_matkul'],
				'nama_matkul'	=> $_POST['nama_matkul'],
			);		
			$insert = $this->M_matkul->insert($item);
			$result['feedback'] = 'Successfully Added Login'; 
		} else {
			$item = array(
				'kode_matkul'	=> $_POST['kode_matkul'],
				'nama_matkul'	=> $_POST['nama_matkul'],
			);		
			$this->M_matkul->update($id, $item);
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
					$vars['ayat']		= $single_schedule[0];
					$vars['tema']		= $single_schedule[1];
					$vars['id_prodi']	= $single_schedule[2];
					$vars['status']		= 1;
					$vars['upd']		= $this->session->userdata['logged_in']['userid'];
					
					
					$items[] = $vars;
				}
				$i++;
			}
			$ins = $this->M_matkul->insert_batch($items);
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
		$this->M_matkul->delete($id);
	}

}