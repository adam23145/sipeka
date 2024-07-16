<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class VerifyLogin extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('Model_login');
	}

	function index() {

		$userid 	= $this->input->post('userid');
		$password 	= $this->input->post('password');	
		$cek_login 	= $this->Model_login->cek_login($userid, $password);
		if ($cek_login) {
			
			$sess_array = array(
				'userid' 		=> $cek_login->userid,
				'full_name'		=> $cek_login->username,
				'level'		 	=> $cek_login->userlevel,
				'image'		 	=> $cek_login->images,
				// 'position'	 	=> $cek_login->level,
			);
			$this->session->set_userdata('logged_in', $sess_array);
			$upd_statuslogin = $this->Model_login->update_status_login($userid);
			$data = 1;
			echo json_encode($data);
			
		} else {

			$userid 		= $this->input->post('userid');
			$search_userid	= $this->Model_login->search_userid($userid);

			if($search_userid>0){
				$fail_login = $this->Model_login->count_fail_login($userid);
			}
			$data = 0;
			echo json_encode($data);
		}
	}	
}