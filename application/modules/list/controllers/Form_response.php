<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Form_response extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('M_response');
		if (!$this->session->userdata('logged_in')) {
			redirect('login');
		}

		if($this->session->userdata['logged_in']['userlevel'] == 'Wadek' || $this->session->userdata['logged_in']['userlevel'] == 'Dekan' || $this->session->userdata['logged_in']['userlevel'] == 'Admin Prodi' ){
			redirect('dashboard');
		}
	}

	function edit(){
		$this->breadcrumb->add('Form','list/form_response')
		->add('Detail Pengajuan Judul','list/form_response');

		$sub_code 	= $this->uri->segment(4);
		$title_sub 	= $this->M_response->get_sub($sub_code);
		$jurusan 	= $title_sub[0]['jurusan'];
		$data_dosen = $this->M_global->get_dosen($jurusan);
		
		if($title_sub[0]['code_status']=='Proses'){
			$stts_skrip = 'Pengajuan Baru';
		}else if($title_sub[0]['code_status']=='Submit revisi'){
			$stts_skrip = 'Pengajuan Revisi';
		}else{
			$stts_skrip = 'Diteruskan';
		}

		if($title_sub[0]['submission_status']!='In Review Koorprodi'){
			$dosbing = $title_sub[0]['dosbing'];
		}else{
			$dosbing = '';
		}

		$data = array(
			'thisContent' 	=> 'list/v_resp',
			'thisJs'		=> 'list/js_resp',
			'judul'			=> $title_sub[0]['title'],
			'id_sub'		=> $title_sub[0]['id'],
			'nim'			=> $title_sub[0]['nim'],
			'student_name'	=> $title_sub[0]['student_name'],
			'loker'			=> $title_sub[0]['loker'],
			'jurusan'		=> $title_sub[0]['jurusan'],
			'dosbing'		=> $dosbing,
			'rumusan'		=> $title_sub[0]['rms_maslh'],
			'createddate'	=> $title_sub[0]['createddate'],
			'urgensi'		=> $title_sub[0]['urgensi'],
			'sub_status'	=> $title_sub[0]['submission_status'],
			'sub_code'		=> $sub_code,
			'stts_skrip'	=> $stts_skrip,
			'data_dosen'	=> $data_dosen
		);
		$this->parser->parse('template/template', $data);
	}

	function data_status(){
		$sub_code 			= $_POST['subcode'];
		header('Content-Type: application/json');
		$data = $this->M_response->get_data_status($sub_code);
		echo $data;
	}

	function update_title()
	{
		$submission_code = $this->input->post('submission_code');
		$new_title = $this->input->post('new_title');
		$judul = $this->input->post('judul2');
		$username = $this->session->userdata['logged_in']['username'];

		// Mendapatkan judul lama sebelum melakukan update
		// $old_title = $this->M_response->get_current_title($submission_code);

		if ($submission_code && $new_title && $judul && $username) {
			$update = $this->M_response->update_title($submission_code, $new_title, $judul,$username);

			if ($update) {
				$response = array('status' => 'success', 'message' => 'Title updated successfully');
			} else {
				$response = array('status' => 'error', 'message' => 'Failed to update title');
			}
		} else {
			$response = array('status' => 'error', 'message' => 'Invalid input data');
		}

		echo json_encode($response);
	}

	function save(){
		$userid 			= $this->session->userdata['logged_in']['userid'];
		$sub_code 			= $_POST['sub_code'];

		$id_sub 			= $_POST['id_sub'];
		$stats				= $_POST['stats'];
		$loker				= $_POST['loker'];
		$loker_grp			= $_POST['loker_grp'];
		$nim				= $_POST['nim'];
		$judul				= $_POST['judul'];
		$reason				= $_POST['reason'];
		
		if($stats=='Terima'){			
			$dosen 				= $_POST['dsen'];
			$aksi_stat			= 'New';
			$aksi_log			= 'Acc';
			$stats				= 'In Review '.$loker;
			$stats2				= 'In Review '.$loker_grp;
			
			// $stats1				= 'Acc '.$loker;
			// if($loker_grp=='Dosen'){
			// 	$stats				= 'Bimbingan '.$loker_grp;
			// }


			if($loker=='Koordinator Prodi'){
			
				$update = $this->M_response->update($userid, $sub_code, $id_sub, $stats, $loker, $dosen, $aksi_stat, $reason);
				if($update){

					$update_log = $this->M_response->update_log($userid, $sub_code, $stats, $loker, $reason, $aksi_stat,$aksi_log);
					if ($update_log) {
						$stats = 'Acc '.$loker;
						$update2 = $this->M_response->update($userid, $sub_code, $id_sub, $stats, $loker, $dosen, $aksi_stat, $reason);
							if($update2){
								$update_log2 = $this->M_response->update_log($userid, $sub_code, $stats, $loker, $reason, $aksi_stat,$aksi_log);
								if ($update_log2) {
									//mulai next loker
									$update3 = $this->M_response->update($userid, $sub_code, $id_sub, $stats2, $loker_grp, $dosen, $aksi_stat, $reason);
										if($update3){
											$update_log3 = $this->M_response->update_log($userid, $sub_code, $stats2, $loker_grp, $reason, $aksi_stat,$aksi_log);
											if ($update_log3) {
												$result['feedback'] = 'Berhasil Approve Pengajuan Judul';
											}
										}
								}
							}
					}
				}
			}else{
				$stats = 'Acc '.$loker;
				$update = $this->M_response->update($userid, $sub_code, $id_sub, $stats, $loker, $dosen, $aksi_stat, $reason);
				if($update){

					$update_log = $this->M_response->update_log($userid, $sub_code, $stats, $loker, $reason, $aksi_stat,$aksi_log);
					if ($update_log) {
								
						//mulai next loker
						if($loker_grp == 'Dosen'){
							$statusurl = '1';
							$update3 = $this->M_response->updateforurl($userid, $sub_code, $id_sub, $stats2, $loker_grp, $dosen, $aksi_stat, $reason,$statusurl);
						}else{
							$update3 = $this->M_response->update($userid, $sub_code, $id_sub, $stats2, $loker_grp, $dosen, $aksi_stat, $reason);
						}

						
						if($update3){
							$update_log3 = $this->M_response->update_log($userid, $sub_code, $stats2, $loker_grp, $reason, $aksi_stat,$aksi_log);
							if ($update_log3) {
								if($loker_grp=='Dosen'){
									$insertdok = $this->M_response->insertdok($userid, $nim, $judul, $dosen, $sub_code);
								}
								$result['feedback'] = 'Berhasil Approve Pengajuan Judul';
							}
						}							
					}
				}
			}



		}else if($stats=='Tolak'){
			$loker_grp			= 'mahasiswa';
			$dosen 				= 'None';
			$aksi_stat			= $_POST['akstats'];
			$aksi_log			= 'Revisi';

			$update = $this->M_response->update($userid, $sub_code, $id_sub, $stats, $loker_grp, $dosen, $aksi_stat, $reason);
				if($update){
					$update = $this->M_response->update_log($userid, $sub_code, $stats, $loker_grp, $reason, $aksi_stat,$aksi_log);

					if ($update) {
						
						$result['feedback'] = 'Berhasil Tolak Pengajuan Judul';
					}
				}
		}
				
		
		echo json_encode($result);
	}

}