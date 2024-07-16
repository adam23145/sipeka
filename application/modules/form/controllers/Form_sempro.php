<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Form_sempro extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('M_sempro');
		$this->load->helper('string');
		if (!$this->session->userdata('logged_in')) {
			redirect('login');
		}
	}

	function index(){
		$this->breadcrumb->add('Form','form/form_sempro')
		->add('Form Sempro','form/form_sempro');
		$majorcode			= substr($this->session->userdata['logged_in']['userid'], 4,3);
		$nim				= substr($this->session->userdata['logged_in']['userid'], 0,12);
		$userid 			= substr($this->session->userdata['logged_in']['userid'],0,12);
		$cekjudul			= $this->M_sempro->cek_jud($nim);
		$countsemp 			= $this->M_sempro->get_count_sempro($userid);
		if($countsemp[0]['jmlsem']=='0'){
			$judul 		= '';
			$dosbing 	= '';
			$submission_code 	= '';
		}else{
			$judul = $cekjudul[0]['title'];
			$dosbing 	= $cekjudul[0]['dosbing'];
			$submission_code 	= $cekjudul[0]['submission_code'];
		}
		
		$major_name			= $this->M_global->get_jurusan($majorcode);
		$jurusan 			= $major_name[0]['major_name'];
		$get_dosen			= $this->M_global->get_dosen3($jurusan, $dosbing);

		$data = array(
			'thisContent' 	=> 'form/v_sempro',
			'thisJs'		=> 'form/js_sempro',
			'majorname'		=> $jurusan,
			'judul'			=> $judul,
			'sub_code'		=> $submission_code,
			'dosbing'		=> $dosbing,
			'get_dosen'		=> $get_dosen,
		);
		$this->parser->parse('template/template', $data);
	}

	function get_count_sempro(){
		$userid 			= substr($this->session->userdata['logged_in']['userid'],0,12);
		$countsemp 			= $this->M_sempro->get_count_sempro($userid);

		$data = array(
				'countsemp' 		=> $countsemp[0]['jmlsem'],
			);
		echo json_encode($data);
	}

	function get_sempro(){
		$userid 			= substr($this->session->userdata['logged_in']['userid'],0,12);
		$data_profil 		= $this->M_sempro->get_data_sempro($userid);
		$b =$data_profil[0]['submission_status'];

		if(is_null($b) || $b==''){
			$b='-';
		}

		$data = array(
				'submission_status' 		=> $b,
			);
		echo json_encode($data);
	}

	function save(){

		if (empty($_FILES["file_ba"])) {
			return false;
		}

		$sub_code 	= $_POST['sub_code'];
		$nama 		= $_POST['nama'];
		$nim 		= $_POST['nim'];
		$majorname 	= $_POST['majorname'];
		$judul 		= $_POST['judul'];
		$tanggal 	= $_POST['tanggal'];
		$penguji 	= $_POST['dsnpenguji'];
		$dosbing 	= $_POST['dosbing'];

		$userid 	= $this->session->userdata['logged_in']['userid'];
		$directory 	= './document/filebasempro/'.$userid;
		$file_pth	=	'document/filebasempro/'.$userid.'/';

		if (!is_dir($directory)) {
			mkdir($directory);
		}

		$allowed 		= array('doc', 'docx', 'pdf');
		$file_name 		= $_FILES["file_ba"]["name"];
		$file_tmp_name 	= $_FILES["file_ba"]["tmp_name"];
		$file_size 		= $_FILES["file_ba"]["size"];
		$file_type 		= $_FILES["file_ba"]["type"];   
		$file_ext 		= pathinfo($file_name, PATHINFO_EXTENSION);
		// $file_name_new 	= 'sempro-'.$userid.'.'.$file_ext;
		$file_name_new 	= 'sempro-'.$file_name;
		$dir_upload 	= $directory."/";
		$file_upload 	= $dir_upload . $file_name_new;

		
		if ($file_size>100000000) {

		}

		if (!in_array($file_ext, $allowed)) {
			return false; 
		}

		if (move_uploaded_file($file_tmp_name, $file_upload)) {
			 $insert = $this->M_sempro->insert_file($sub_code, $nama, $nim, $majorname, $judul, $tanggal, $penguji, $file_name_new, $file_pth, $dosbing);
			if ($insert) {
				$titledok		= "File Berita Acara Sempro";
				$inserttodok	= $this->M_sempro->inserttodok($nim, $judul, $titledok, $dosbing, $file_name_new, $file_pth, $userid, $sub_code);

				$directory2 	= './document/filebasempro/'.$userid;
				$file_pth2		=	'document/filebasempro/'.$userid.'/';

				if (!is_dir($directory2)) {
					mkdir($directory2);
				}

				$allowed2 		= array('doc', 'docx', 'pdf');
				$file_name2 	= $_FILES["file_prop"]["name"];
				$file_tmp_name2 = $_FILES["file_prop"]["tmp_name"];
				$file_size2 	= $_FILES["file_prop"]["size"];
				$file_type2 	= $_FILES["file_prop"]["type"];   
				$file_ext2 		= pathinfo($file_name2, PATHINFO_EXTENSION);
				$file_name_new2 = 'proposal-'.$file_name2;
				$dir_upload2 	= $directory2."/";
				$file_upload2 	= $dir_upload2 . $file_name_new2;
				
				if ($file_size2>100000000) {

				}

				if (!in_array($file_ext2, $allowed2)) {
					return false; 
				}

				if (move_uploaded_file($file_tmp_name2, $file_upload2)){
					$update			= $this->M_sempro->updatefile($sub_code, $file_name_new2, $file_pth2);
					$sub_status 	= 'Bimbingan Skripsi';
					$cd_stats 		= 'New';
					$update_sub		= $this->M_sempro->updatesub($sub_code, $userid, $sub_status, $cd_stats);
					$inserlogsub 	= $this->M_sempro->insert_log($sub_code, $userid, $sub_status, $cd_stats);

					if($update){
						$titledok 		= " File Seminar Proposal ";
						$file_name_new 	= $file_name_new2;
						$file_pth 		= $file_pth2;
						$inserttodok2	= $this->M_sempro->inserttodok($nim, $judul, $titledok, $dosbing, $file_name_new, $file_pth, $userid, $sub_code);
					 	return FALSE;
					}else{
					 	return FALSE;
				 	}
				}			 	
			}
		}
	}

}