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
		$this->breadcrumb->add('Form','skripsi/Form_bimbingan')
		->add('Form bimbingan','skripsi/Form_bimbingan');

		$nim 				= $this->uri->segment(4);
		$data_dosen 		= $this->M_global->get_dosen1();
		$title_sub 			= $this->M_bimbing->get_sub($nim);
		$status_url			= $title_sub[0]['status_url'];
		$url_judulbimbingan	= $title_sub[0]['url_judulbimbingan'];

		if($status_url == '1' || $status_url == 1){
			$url_judulbimbingan = '<button type="button" class="btn btn-block btn-secondary disabled">Belum input url</button>';
		}else{
			$url_judulbimbingan = '<a href="'.$url_judulbimbingan.'" target="_blank" style="width:100px;" class="btn btn-block btn-success btn-sm">lihat url</a>';
		}
		
		$bimke 				= $this->M_bimbing->get_bi($nim);
		$sub_code 			= $bimke[0]['submission_code'];
		$countlog			= $this->M_bimbing->cont_logbi($sub_code);
		$bimlog				= $this->M_bimbing->get_logbi($sub_code);
		$bbi				= $this->M_bimbing->get_bimbi($sub_code);

		$valtglbim			=	substr($bbi[0]['awalbimbingan'], 0,10);

		date_default_timezone_set('Asia/Jakarta');
		$from 		= strtotime($valtglbim);
		$today 		= time();
		$difference = $today - $from;
		$durasibim	= floor($difference / 86400);

		if($bimke[0]['bimbingan_ke'] < 7){
			
			$val			= 'Setuju Sidang';
			
		}else{
			// if($durasibim < 60){
			// 	$val			= 'Setuju Sidang';
			// }else{
				$val			= '';
			// }
		}
		$status_bimbingan 	= $this->M_bimbing->get_status_bimbingan($val);

		

		if($countlog[0]['jmllogbi']<1){
			$tanggal2 = '';
			$tanggal = '';
		}else{
			$valMo			=	substr($bbi[0]['awalbimbingan'], 5,2);
			$valYe			=	substr($bbi[0]['awalbimbingan'], 0,4);
			$valDa			=	substr($bbi[0]['awalbimbingan'], 8,2);


			if($valMo=='01'){
				$vbulan 		= 'Januari';
			}else if($valMo=='02'){
				$vbulan 		= 'Februari';
			}else if($valMo=='03'){
				$vbulan 		= 'Maret';
			}else if($valMo=='04'){
				$vbulan 		= 'April';
			}else if($valMo=='05'){
				$vbulan 		= 'Mei';
			}else if($valMo=='06'){
				$vbulan 		= 'Juni';
			}else if($valMo=='07'){
				$vbulan 		= 'Juli';
			}else if($valMo=='08'){
				$vbulan 		= 'Agustus';
			}else if($valMo=='09'){
				$vbulan 		= 'September';
			}else if($valMo=='10'){
				$vbulan 		= 'Oktober';
			}else if($valMo=='11'){
				$vbulan 		= 'November';
			}else if($valMo=='12'){
				$vbulan 		= 'Desember';
			}
			
			$tanggal 		= 	$valDa.' '.$vbulan.' '.$valYe;

			$vMo			=	substr($bimlog[0]['tgl_bimbingan_skripsi'], 5,2);
			$vYe			=	substr($bimlog[0]['tgl_bimbingan_skripsi'], 0,4);
			$vDa			=	substr($bimlog[0]['tgl_bimbingan_skripsi'], 8,2);


			if($vMo=='01'){
				$vBl 		= 'Januari';
			}else if($vMo=='02'){
				$vBl 		= 'Februari';
			}else if($vMo=='03'){
				$vBl 		= 'Maret';
			}else if($vMo=='04'){
				$vBl 		= 'April';
			}else if($vMo=='05'){
				$vBl 		= 'Mei';
			}else if($vMo=='06'){
				$vBl 		= 'Juni';
			}else if($vMo=='07'){
				$vBl 		= 'Juli';
			}else if($vMo=='08'){
				$vBl 		= 'Agustus';
			}else if($vMo=='09'){
				$vBl 		= 'September';
			}else if($vMo=='10'){
				$vBl 		= 'Oktober';
			}else if($vMo=='11'){
				$vBl 		= 'November';
			}else if($vMo=='12'){
				$vBl 		= 'Desember';
			}
			
			$tanggal2 		= 	$vDa.' '.$vBl.' '.$vYe;
		}

		

		$data = array(
			'thisContent' 		=> 'skripsi/v_bimbing',
			'thisJs'			=> 'skripsi/js_bimbing',
			'judul'				=> $title_sub[0]['title'],
			'id_sub'			=> $title_sub[0]['id'],
			'nim'				=> $title_sub[0]['nim'],
			'student_name'		=> $title_sub[0]['student_name'],
			'loker'				=> $title_sub[0]['loker'],
			'jurusan'			=> $title_sub[0]['jurusan'],
			'rumusan'			=> $title_sub[0]['rms_maslh'],
			'dosbing'			=> $title_sub[0]['dosbing'],
			'createddate'		=> $tanggal,
			'tanggal2'			=> $tanggal2,
			'urgensi'			=> $title_sub[0]['urgensi'],
			'sub_status'		=> $title_sub[0]['submission_status'],
			'bimb_no'			=> ($bimke[0]['bimbingan_ke']+1),
			'sub_code'			=> $sub_code,
			'data_dosen'		=> $data_dosen,
			'status_bimbingan'	=> $status_bimbingan,
			'url_judulbimbingan'	=> $url_judulbimbingan,
			'durasibim'	=> $durasibim,
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
		$nim 				= $_POST['nim'];
		$judul 				= $_POST['judul'];
		$dosbing 			= $_POST['dosbing'];
		$tanggal			= $_POST['tanggal'];
		
		$beritaacara		= $_POST['beritaacara'];
		

		$update = $this->M_bimbing->update($userid, $sub_code, $nobim, $stats, $tanggal, $beritaacara);
		if($update){
			$update = $this->M_bimbing->update_log($userid, $sub_code, $nobim, $stats, $tanggal, $beritaacara);

			if ($update) {
				if($stats=='Setuju Sidang'){
					$update_stts = $this->M_bimbing->update_sub($userid, $sub_code, $beritaacara);
					if($update_stts){
						$insert_log_stts = $this->M_bimbing->insert_sub_log($userid, $sub_code, $beritaacara);
						

						

						if($insert_log_stts){
							$insert_dok = $this->M_bimbing->insert_dok($userid, $nim, $sub_code, $judul, $dosbing);

							if($insert_dok){
								$insert_dok2 = $this->M_bimbing->insert_dok2($userid, $nim, $sub_code, $judul, $dosbing);
								if($insert_dok2){
									$result['feedback'] = 'Berhasil Membuat Keterangan Bimbingan Skripsi';
									echo json_encode($result);
								}								
							}							
						}
					}
				}else{
					$result['feedback'] = 'Berhasil Membuat Keterangan Bimbingan Skripsi';
							echo json_encode($result);
				}
				
				
			}
		}		
		
		
	}

}