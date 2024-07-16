<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

require_once APPPATH.'libraries/ExcelTemplate/autoload.php'; // if you don't use framework
use PhpOffice\PhpSpreadsheet\IOFactory;

class Data_prodi extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('M_prodi');
		if (!$this->session->userdata('logged_in')) {
			redirect('login');
		}
	}

	function index(){
		$this->breadcrumb->add('Settings','data_master/data_prodi')
		->add('Data Prodi','data_master/data_prodi');
		$data_status = $this->M_global->get_status();
		$data = array(
			'thisContent' 	=> 'data_master/v_prodi',
			'thisJs'		=> 'data_master/js_data_prodi',
			'data_status'	=> $data_status
		);
		$this->parser->parse('template/template', $data);
	}
	
	function list_data(){
		header('Content-Type: application/json');
		$data = $this->M_prodi->get_data_prodi();
		echo $data;
	}

	function save(){
		$id	= $_POST['id'];
		$item = array(
			'major_code'	=> $_POST['major_code'],
			'major_name'	=> $_POST['major_name'],
			'status'		=> $_POST['status'],
			'upd'			=> $this->session->userdata['logged_in']['userid']
		);		
		if ($id == 0) {
			$insert = $this->M_prodi->insert($item);
			$result['feedback'] = 'Successfully Added Login'; 
		} else {
			$this->M_prodi->update($id, $item);
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
					$vars['ayat']		= $single_schedule[0];
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
			$ins = $this->M_prodi->insert_batch($items);
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
		$this->M_prodi->delete($id);
	}

}