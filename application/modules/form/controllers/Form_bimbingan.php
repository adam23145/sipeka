<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Form_bimbingan extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('M_bimbing');
		if (!$this->session->userdata('logged_in')) {
			redirect('login');
		}
	}

	function edit(){
		$this->breadcrumb->add('Form','form/Form_bimbingan')
		->add('Form bimbingan','form/Form_bimbingan');

		$nim 		= $this->uri->segment(4);
		$data_dosen = $this->M_global->get_dosen1();
		$title_sub 	= $this->M_bimbing->get_sub($nim);
		$bimke 		= $this->M_bimbing->get_bi($nim);

		$url_judulbimbingan = $title_sub[0]['url_judulbimbingan'];
		$status_url = $title_sub[0]['status_url'];

		if($status_url == '1'){
			$url_judulbimbingan = '<button type="button" class="btn btn-block btn-secondary disabled">Belum input url</button>';
		}else{
			$url_judulbimbingan = '<a href="'.$url_judulbimbingan.'" target="_blank" style="width:100px;" class="btn btn-block btn-success btn-sm">lihat url</a>';
		}
		

		$data = array(
			'thisContent' 			=> 'form/v_bimbing',
			'thisJs'				=> 'form/js_bimbing',
			'judul'					=> $title_sub[0]['title'],
			'id_sub'				=> $title_sub[0]['id'],
			'nim'					=> $title_sub[0]['nim'],
			'student_name'			=> $title_sub[0]['student_name'],
			'loker'					=> $title_sub[0]['loker'],
			'dosbing'				=> $title_sub[0]['dosbing'],
			'jurusan'				=> $title_sub[0]['jurusan'],
			'rumusan'				=> $title_sub[0]['rms_maslh'],
			'createddate'			=> $title_sub[0]['createddate'],
			'urgensi'				=> $title_sub[0]['urgensi'],
			'url_judulbimbingan'	=>$url_judulbimbingan,
			'sub_status'			=> $title_sub[0]['submission_status'],
			'bimb_no'				=> ($bimke[0]['bimbingan_ke']+1),
			'sub_code'				=> $bimke[0]['submission_code'],
			'data_dosen'			=> $data_dosen
		);
		$this->parser->parse('template/template', $data);
	}

	function log_bimb(){
		$sub_code 			= $_POST['subcode'];
		header('Content-Type: application/json');
		$data = $this->M_bimbing->get_data_logb($sub_code);
		echo $data;
	}

	function save(){
		$userid 			= $this->session->userdata['logged_in']['userid'];
		$lepel 				= $this->session->userdata['logged_in']['userlevel'];

		if ($lepel!='Dosen') {
			redirect('login');
		}
		$stats				= $_POST['stats'];
		
		$sub_code 			= $_POST['sub_code'];
		$nobim 				= $_POST['nobim'];
		$tanggal			= $_POST['tanggal'];		
		$beritaacara		= $_POST['beritaacara'];

		$titlesub			= $_POST['titlesub'];		
		$dosenpembimbing	= $_POST['dosenpembimbing'];		
		$nimmhs				= $_POST['nimmhs'];		

		$update = $this->M_bimbing->update($userid, $sub_code, $nobim, $stats, $tanggal, $beritaacara);
		if($update){
			$update = $this->M_bimbing->update_log($userid, $sub_code, $nobim, $stats, $tanggal, $beritaacara);

			if ($update) {
				if($stats=='Setuju'){
					$update_stts = $this->M_bimbing->update_sub($userid, $sub_code, $beritaacara);
					if($update_stts){
						$insert_log_stts = $this->M_bimbing->insert_sub_log($userid, $sub_code, $beritaacara);
						if($insert_log_stts){
							$insert_dokumenba = $this->M_bimbing->insert_dokumenba($userid, $nimmhs, $titlesub, $sub_code, $dosenpembimbing);

							if($insert_dokumenba){
								$insert_dokumenlayak = $this->M_bimbing->insert_dokumenlayak($userid, $nimmhs, $titlesub, $sub_code, $dosenpembimbing);
								if($insert_dokumenlayak){
									$result['feedback'] = 'Berhasil Menyimpan Data';
									echo json_encode($result);
								}								
							}
						}
					}
				}else{
					$result['feedback'] = 'Berhasil Membuat Berita Acara Bimbingan';
						echo json_encode($result);
				}	
			}
		}		
	}
}