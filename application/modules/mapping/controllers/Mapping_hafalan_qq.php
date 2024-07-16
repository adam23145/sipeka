<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

require_once APPPATH.'libraries/ExcelTemplate/autoload.php'; // if you don't use framework
use PhpOffice\PhpSpreadsheet\IOFactory;

class Mapping_hafalan_qq extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('M_mapping_hafalan_qq');
		if (!$this->session->userdata('logged_in')) {
			redirect('login');
		}
	}

	function index(){
		$this->breadcrumb->add('Settings','mapping/mapping_hafalan_qq')
		->add('Data Kiraatul Qur`an','mapping/mapping_hafalan_qq');
		$data_mahasiswa = $this->M_global->get_mhs();
		$data_qq = $this->M_global->get_qq();
		$data_dosen = $this->M_global->get_dosen1();
		$data_prodi = $this->M_global->get_prodi();
		$data_tahun = $this->M_global->get_start_angkatan();
		$data = array(
			'thisContent'		=> 'mapping/v_mapping_hafalan_qq',
			'thisJs'			=> 'mapping/js_mapping_hafalan_qq',
			'data_mahasiswa'	=> $data_mahasiswa,
			'data_qq'			=> $data_qq,
			'data_dosen'		=> $data_dosen,
			'data_prodi'		=> $data_prodi,
			'data_tahun'		=> $data_tahun
		);
		$this->parser->parse('template/template', $data);
	}
	
	function list_data(){
		if(!$_POST){return;}
		header('Content-Type: application/json');
		$jurusan	= $_POST['jurusan'];
		$angkatan	= $_POST['angkatan'];
		$data = $this->M_mapping_hafalan_qq->get_data_mappingHafalan($jurusan,$angkatan);
		echo $data;
	}

	function save(){
		$id	= $_POST['id'];
		$item = array(
			'nim'				=> $_POST['nim'],
			'kiraatul_quran'	=> $_POST['kiraatul_quran'],
			'nip'				=> $_POST['nip'],
			'upd'				=> $this->session->userdata['logged_in']['userid']
		);		
		if ($id == 0) {
			$insert = $this->M_mapping_hafalan_qq->insert($item);
			$result['feedback'] = 'Successfully Add Mapping'; 
		} else {
			$this->M_mapping_hafalan_qq->update($id, $item);
			$result['feedback'] = 'Successfully Update Mapping'; 
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
					$vars['nim']			= $single_schedule[0];
					$vars['kiraatul_quran']	= $single_schedule[1];
					$vars['nip']			= $single_schedule[2];
					$vars['upd']			= $this->session->userdata['logged_in']['userid'];
					$items[] = $vars;
				}
				$i++;
			}
			$ins = $this->M_mapping_hafalan_qq->insert_batch($items);
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
		$this->M_mapping_hafalan_qq->delete($id);
	}

}