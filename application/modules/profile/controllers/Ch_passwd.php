<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Ch_passwd extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('M_ch_passwd');
		$this->load->helper('string');
		if (!$this->session->userdata('logged_in')) {
			redirect('home_ppt');
		}
	}

	function index(){
		$this->breadcrumb->add('Profile','profile/Ch_passwd')
		->add('Change Password','profile/Ch_passwd');
		
		$data = array(
			'thisContent' 		=> 'profile/v_ch_password',
			'thisJs'			=> 'profile/js_change_ps',
		);
		$this->parser->parse('template/template', $data);
	}

	function get_profil(){
		$userid 			= $this->session->userdata['logged_in']['userid'];
		$data_profil 		= $this->M_ch_passwd->get_data_profil($userid);

		$data = array(
				'nama_kary' 		=> $data_profil[0]['username'],
			);
		echo json_encode($data);
	}

	function update_pass(){
		$userid 	= $_POST['userid'];
		$inputpass1 = $_POST['inputpass1'];
		// $inputpass1 = base64_encode($_POST['inputpass1']);

		$this->M_ch_passwd->update_p($userid, $inputpass1);
		$result['feedback'] = 'Successfully Updated Password';

		echo json_encode($result);
	}

}