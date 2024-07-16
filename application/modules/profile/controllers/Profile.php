<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Profile extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('M_profile');
		$this->load->helper('string');
		if (!$this->session->userdata('logged_in')) {
			redirect('home_ppt');
		}
	}

	function index(){
		$this->breadcrumb->add('Profile','profile/profile')
		->add('Edit Profile','profile/profile');
		$userid 			= $this->session->userdata['logged_in']['userid'];
		$data_profil 		= $this->M_profile->get_data_profil($userid);
		$gambar				= $data_profil[0]['images'];
		$direktori			= $data_profil[0]['filepath'];

		if($gambar		=='no_image.jpg'){
			$imagedir	= 'public/assets/core/images/user2-160x160.jpg';
		}else{
			$imagedir	= $direktori.$gambar;
		}

		
		$data = array(
			'thisContent' 		=> 'profile/v_profile',
			'thisJs'			=> 'profile/js_profile',
			'nama_kary'			=> $data_profil[0]['username'],
			'email'				=> $data_profil[0]['email'],
			'group_m'			=> $data_profil[0]['userlevel'],
			'imagedir'			=> $imagedir,
		);
		$this->parser->parse('template/template', $data);
	}

	function get_profil(){
		$userid 			= $this->session->userdata['logged_in']['userid'];
		$data_profil 		= $this->M_profile->get_data_profil($userid);

		$data = array(
				'nama_kary' 		=> $data_profil[0]['username'],
				'email' 			=> $data_profil[0]['email'],
				'image'				=> $data_profil[0]['images'],
				'imgpath'			=> $data_profil[0]['filepath'],
			);
		echo json_encode($data);
	}

	function update(){
		$userid 		= $_POST['inputuserID'];
		$inputName 		= $_POST['inputName'];
		$inputEmail 	= $_POST['inputEmail'];

		$this->M_profile->update_data($userid, $inputName, $inputEmail);
		$result['feedback'] = 'Successfully Updated Profile';

		echo json_encode($result);
	}

	function get_data(){
		$userid = $this->session->userdata['logged_in']['userid'];
		$data 	= $this->M_profil->get_biodata($userid);
		echo json_encode($data);
	}

	function unggah_foto(){

		if (empty($_FILES["pas_foto"])) {
			return false;
		}

		$userid 	= $this->session->userdata['logged_in']['userid'];
		$directory 	= './document/pegawai/'.$userid;
		$file_pth	=	'document/pegawai/'.$userid.'/';

		if (!is_dir($directory)) {
			mkdir($directory);
		}

		$allowed 		= array('jpg', 'jpeg');
		$file_name 		= $_FILES["pas_foto"]["name"];
		$file_tmp_name 	= $_FILES["pas_foto"]["tmp_name"];
		$file_size 		= $_FILES["pas_foto"]["size"];
		$file_type 		= $_FILES["pas_foto"]["type"];   
		$file_ext 		= pathinfo($file_name, PATHINFO_EXTENSION);
		$file_name_new 	= 'pas-foto-'.$userid.'.'.$file_ext;
		$dir_upload 	= $directory."/";
		$file_upload 	= $dir_upload . $file_name_new;

		
		if ($file_size>1000000) {

		}

		if (!in_array($file_ext, $allowed)) {
			return false; 
		}

		if (move_uploaded_file($file_tmp_name, $file_upload)) {
			 $data_login['filepath'] 	= $file_pth;
			 $data_login['images'] 		= $file_name_new;
			 $update = $this->M_profile->update_image($userid, $data_login);
			 if ($update) {
			 	return FALSE;
			 } else {
			 	return FALSE;
			 }
		}
	}

}