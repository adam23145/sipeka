<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Template extends MX_Controller {
	
	public function index()
	{
		// if ($this->session->userdata('logged_in')){

			$data = array(
				'thisContent' => "__partials/content",
			);
			$this->parser->parse('template/template', $data);
			
		// } else {

		// 	redirect('login');
			
		// }
	}
	
}