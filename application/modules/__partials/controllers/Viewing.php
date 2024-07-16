<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Viewing extends CI_Controller {

	function loading_card(){
		$this->load->view('__partials/loading_card');
	}
}