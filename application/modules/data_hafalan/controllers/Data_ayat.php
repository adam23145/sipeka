<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

require_once APPPATH.'libraries/ExcelTemplate/autoload.php'; // if you don't use framework
use PhpOffice\PhpSpreadsheet\IOFactory;

class Data_ayat extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('M_ayat');
		if (!$this->session->userdata('logged_in')) {
			redirect('login');
		}
	}

	function index(){
		$this->breadcrumb->add('Settings','data_hafalan/data_ayat')
		->add('Data Ayat','data_hafalan/data_ayat');
		$data_prodi = $this->M_global->get_prodi();
		$data_status = $this->M_global->get_status();
		// $data_tahun = $this->M_global->get_start_angkatan();
		$data = array(
			'thisContent' 	=> 'data_hafalan/v_ayat',
			'thisJs'		=> 'data_hafalan/js_data_ayat',
			'data_prodi'	=> $data_prodi,
			'data_status'	=> $data_status
			// 'data_tahun'	=> $data_tahun
		);
		$this->parser->parse('template/template', $data);
	}
	
	function list_data(){
		if(!$_POST){return;}
		header('Content-Type: application/json');
		$jurusan	= $_POST['jurusan'];
		// $angkatan	= $_POST['angkatan'];
		$data = $this->M_ayat->get_data_ayat($jurusan);
		echo $data;
	}

	function save(){
		$id	= $_POST['id'];
		$item = array(
			'ayat'				=> $_POST['ayat'],
			'tema'				=> $_POST['tema'],
			'id_prodi'			=> $_POST['prodi'],
			// 'tahun_angkatan'	=> $_POST['tahun_angkatan'],
			'status'			=> $_POST['status'],
			'upd'				=> $this->session->userdata['logged_in']['userid']
		);		
		if ($id == 0) {
			$insert = $this->M_ayat->insert($item);
			$result['feedback'] = 'Successfully Added Login'; 
		} else {
			$this->M_ayat->update($id, $item);
			$result['feedback'] = 'Successfully Updated Login'; 
		}
		echo json_encode($item);
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
					$vars['ayat']			= $single_schedule[0];
					$vars['tema']			= $single_schedule[1];
					$vars['id_prodi']		= $single_schedule[2];
					// $vars['tahun_angkatan']	= $single_schedule[3];
					$vars['status']			= 1;
					$vars['upd']			= $this->session->userdata['logged_in']['userid'];
					$items[] = $vars;
				}
				$i++;
			}
			$ins = $this->M_ayat->insert_batch($items);
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
		$this->M_ayat->delete($id);
	}

}