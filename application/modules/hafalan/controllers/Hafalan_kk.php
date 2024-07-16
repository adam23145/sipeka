<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

require_once APPPATH.'libraries/ExcelTemplate/autoload.php'; // if you don't use framework
use PhpOffice\PhpSpreadsheet\IOFactory;

class Hafalan_kk extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('M_hafalan_kk');
		if (!$this->session->userdata('logged_in')) {
			redirect('login');
		}
	}

	function index(){
		$this->breadcrumb->add('Hafalan','hafalan/hafalan_kk')
		->add('Data Kiraatul Kutub','hafalan/hafalan_kk');
		$data_mahasiswa = $this->M_global->get_mahasiswa();
		$data_kk = $this->M_global->get_kk();
		$data_dosen = $this->M_global->get_dosen1();
		$data_status = $this->M_global->get_status();
		$level = $this->session->userdata['logged_in']['userlevel'];
		$data = array(
			'thisContent'		=> 'hafalan/v_hafalan_kk',
			'thisJs'			=> 'hafalan/js_hafalan_kk',
			'level'				=> $level,
			'data_mahasiswa'	=> $data_mahasiswa,
			'data_kk'			=> $data_kk,
			'data_dosen'		=> $data_dosen,
			'data_status'		=> $data_status
		);
		$this->parser->parse('template/template', $data);
	}
	
	function list_data(){
		header('Content-Type: application/json');
		$data = $this->M_hafalan_kk->get_data_hafalan($this->session->userdata['logged_in']['userid'],$this->session->userdata['logged_in']['userlevel'],$post['search']['value']);
		echo $data;
	}

	function save(){
		$id	= $_POST['id'];
		$item = array(
			'mapping_kk'	=> $_POST['mapping_kk'],
			'link'			=> $_POST['link'],
			'tgl_upload'	=> date("Y-m-d H:i:s"),
			'upd'			=> $this->session->userdata['logged_in']['userid']
		);
		if ($id == 0 or $id == ""){
			$insert = $this->M_hafalan_kk->insert($item);
			$result['feedback'] = 'Successfully Add Link'; 
		} else {
			$this->M_hafalan_kk->update($id, $item);
			$result['feedback'] = 'Successfully Update Link'; 
		}
		echo json_encode($item);
	}
	
	function save_nilai(){
		$id	= $_POST['idForDosen'];
		$item = array(
			'membaca'		=> $_POST['membaca'],
			'memahami'		=> $_POST['memahami'],
			'menganalisa'	=> $_POST['menganalisa'],
			'nilai'			=> $_POST['nilai'],
			'status_lulus'	=> $_POST['status_lulus'],
			'tgl_nilai'		=> date("Y-m-d H:i:s"),
			'keterangan'	=> $_POST['ket'],
			'upd'			=> $this->session->userdata['logged_in']['userid']
		);
		$this->M_hafalan_kk->update($id, $item);
		$result['feedback'] = 'Successfully Update Nilai'; 
		echo json_encode($item);
	}
	
	public function uploads(){
		$config['upload_path']          = dirname(APPPATH) . "/public/uploads/";
		$config['allowed_types']        = 'xls|xlsx';
		$config['file_name']            = "upload_".date("YmdHis");
		
		$this->load->library('upload', $config);

		if ($this->upload->do_upload('fileupload')){
			$data = array('upload_data' => $this->upload->data());
			$inputFileName = dirname(APPPATH) . "/public/uploads/" . $data['upload_data']['file_name'];
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
			$ins = $this->M_hafalan_kk->insert_batch($items);
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
	
	function cetak_pdf(){
		$this->load->library('pdfgenerator');
		
		$get_bgimage = file_get_contents(FCPATH . "public/assets/core/images/bg_kk.png");
		$get_image = file_get_contents(FCPATH . "public/assets/core/images/logo.png");
		$nim = explode("@", $this->session->userdata['logged_in']['userid']);
		$get_user		= $this->M_hafalan_kk->getdata_sertifikat($nim[0]);
		$data['users'] 	= $get_user[0];
		$data['bg'] 	= 'data:image/PNG' . ';base64,' . base64_encode($get_bgimage);
		$data['image'] 	= 'data:image/PNG' . ';base64,' . base64_encode($get_image);
		// var_dump($data);exit();
		// $this->load->view('../modules/hafalan/views/sertifikat_hadist', $data);
	    $html = $this->load->view('../modules/hafalan/views/sertifikat_kk', $data, TRUE);
	    
	    $this->pdfgenerator->generate($html,'contoh',TRUE,'A4',"landscape");
	}

	function delete(){
		$id = $_POST['id'];
		$this->M_hafalan_kk->delete($id);
	}

}