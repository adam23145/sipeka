<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

require_once APPPATH.'libraries/ExcelTemplate/autoload.php'; // if you don't use framework
use PhpOffice\PhpSpreadsheet\IOFactory;

class Data_login extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('M_login');
		if (!$this->session->userdata('logged_in')) {
			redirect('login');
		}
	}

	function index(){
		$this->breadcrumb->add('Settings','data_master/data_login')
		->add('Data Login','data_master/data_login');
		$data_level = $this->M_global->get_level();
		$data = array(
			'thisContent' 	=> 'data_master/v_login',
			'thisJs'		=> 'data_master/js_data_login',
			'data_level'	=> $data_level

		);
		$this->parser->parse('template/template', $data);
	}

	function data_login(){
		header('Content-Type: application/json');
		$searchValue = $this->input->post('search')['value'];
		$data = $this->M_login->get_data_login($searchValue);
		echo $data;
	}

	function save(){
		$id 		= $_POST['id'];
		$userid		= $_POST['userid'];
		$full_name	= $_POST['full_name'];
		$email		= $_POST['email'];
		$kode_level	= $_POST['level'];
		$password	= $_POST['password'];
		$status		= $_POST['status'];

		if ($id == 0) {
			$insert = $this->M_login->insert_data($userid, $full_name, $email, $password, $status, $kode_level);
			$result['feedback'] = 'Successfully Added Login'; 
		} else {
			$this->M_login->update($id, $userid, $full_name, $email, $password, $status, $kode_level);
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
					$vars['userid']			= $single_schedule[0];
					$vars['username']		= $single_schedule[1];
					$vars['userlevel']		= $single_schedule[2];
					$vars['status']			= $single_schedule[3];
					$vars['upd']			= $this->session->userdata['logged_in']['userid'];
					
					// foreach( $single_schedule as $single_item ){
						// $vars[strtolower($schdeules[0][$j])] =  $single_item;
						// $j++;
					// }
					$items[] = $vars;
				}
				$i++;
			}
			$ins = $this->M_login->insert_batch($items);
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
		$this->M_login->delete($id);
	}

}