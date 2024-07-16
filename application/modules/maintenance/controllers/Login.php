<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

date_default_timezone_set('Asia/Jakarta');

class Login extends MX_Controller {

	function __construct(){
		parent::__construct();
		// $this->load->model('Model_login');
	}

	function index() {
		$this->load->view('maintenance/login');
		
	}

	// function verifyLogin(){
	// 	$userid 	= $this->input->post('userid');
	// 	$password 	= $this->input->post('password');	
	// 	$cek_login 	= $this->Model_login->cek_login($userid, $password);
	// 	if ($cek_login) {
			
	// 		$sess_array = array(
	// 			'userid' 		=> $cek_login->userid,
	// 			'username'		=> $cek_login->username,
	// 			'userlevel'		=> $cek_login->userlevel,
	// 			'dir'			=> $cek_login->filepath,
	// 			'image'		 	=> $cek_login->images,
	// 		);
	// 		$this->session->set_userdata('logged_in', $sess_array);
	// 		$upd_statuslogin = $this->Model_login->update_status_login($userid);
	// 		$data = 1;
	// 		echo json_encode($data);
			
	// 	} else {

	// 		$userid 		= $this->input->post('userid');
	// 		$search_userid	= $this->Model_login->search_userid($userid);

	// 		if($search_userid>0){
	// 			$fail_login = $this->Model_login->count_fail_login($userid);
	// 		}
	// 		$data = 0;
	// 		echo json_encode($data);
	// 	}
	// }

	public function logout()
	{
		if ($this->session->userdata('logged_in')){
			$this->session->unset_userdata(array('logged_in' => ''));
			$this->db->where('userid',$this->session->userdata['logged_in']['userid']);
			$data = array(
				'is_login' => 0
			);
			
			$this->db->update('m_login', $data);
			session_destroy();
			redirect('login');

		} else if ($this->session->userdata('biodata')) {
			$this->session->unset_userdata(array('logged_in' => ''));
			session_destroy();
			redirect('login');
			
		} else {
			redirect('login');
		}
	}
}

?>