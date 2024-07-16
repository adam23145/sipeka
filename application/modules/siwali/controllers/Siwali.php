<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

date_default_timezone_set('Asia/Jakarta');

class Siwali extends MX_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('m_wali');
	}

	function index() {
		$this->load->view('siwali/siwali');
	}

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