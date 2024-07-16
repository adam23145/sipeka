<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class List_dokumen extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('M_list_dokumen');
		if (!$this->session->userdata('logged_in')) {
			redirect('login');
		}
	}

	function index(){
		$this->breadcrumb->add('List Dokumen','dokumen/list_dokumen');
		$userid = $this->session->userdata['logged_in']['userid'];
		$data = array(
			'thisContent' 	=> 'dokumen/v_list_dokumen',
			'thisJs'		=> 'dokumen/js_list_dokumen',
			'userid'		=> $userid
		);
		$this->parser->parse('template/template', $data);
	}

	function get_dokumen(){
		$userid 		= $_POST['userid'];
		$usr 			= substr($userid, 0,12);
		$this->db->where('nim', $usr);
		$data = $this->db->get('dokumen')->result_array();
		
		echo json_encode($data);
	}

	function data_submission(){	
		$stts_s = $_POST['data_sub'];
		$userlevel = $this->session->userdata['logged_in']['userlevel'];
		if($stts_s == 'Revisi'){
			$stts_sub = 'Submit revisi';
		}else{
			if($userlevel=='Sekjur' || $userlevel=='Kajur'){
				$stts_sub = 'Diteruskan';
			}else{
				$stts_sub = $stts_s;
			}
			
		}
		

		header('Content-Type: application/json');
		$data = $this->M_list_pengajuan->get_data_pengajuan($stts_sub,$userlevel);
		echo $data;
	}

	function save(){
		$upd 				= $this->session->userdata['logged_in']['userid'];
		$id 				= $_POST['id'];
		$submission_code	= $_POST['submission_code'];
		$title				= $_POST['title'];
		$rms_maslh			= $_POST['rms_maslh'];

		$insert = $this->M_list_pengajuan->insert($id, $submission_code, $title, $rms_maslh, $upd);
		$result['feedback'] = 'Berhasil Update '; 
		
		echo json_encode($result);
	}

	
}