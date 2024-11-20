<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sidang_publikasi extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('data_pdf/M_bimbinganmbkm');
        $this->load->model('data_pdf/M_koorprodi');

		if (!$this->session->userdata('logged_in')) {
			redirect('login');
		} else if ($this->session->userdata['logged_in']['userlevel'] !== "mahasiswa") {
			redirect('login');
		}
	}

	public function index()
	{
        $nim = substr($this->session->userdata['logged_in']['userid'], 0, 12);
        $data = $this->M_bimbinganmbkm->get_approved_submissions($nim);
        $log_bimbingan = $this->M_bimbinganmbkm->get_log_bimbingan_by_id($data[0]->id);
        $countdata = $this->M_bimbinganmbkm->count_publikasi_by_id($data[0]->id);
        $nip = $this->M_bimbinganmbkm->get_nip_by_name($data[0]->dosen_pembimbing_utama);
        $lastIndex = count($log_bimbingan) - 1; 
		$bulan					= substr($log_bimbingan[$lastIndex]->tanggal, 5, 2);
		$tahun					= substr($log_bimbingan[$lastIndex]->tanggal, 0, 4);
		$tanggal				= substr($log_bimbingan[$lastIndex]->tanggal, 8, 2);
		$bulan_arr = [
			'01' => 'JANUARI',
			'02' => 'FEBRUARI',
			'03' => 'MARET',
			'04' => 'APRIL',
			'05' => 'MEI',
			'06' => 'JUNI',
			'07' => 'JULI',
			'08' => 'AGUSTUS',
			'09' => 'SEPTEMBER',
			'10' => 'OKTOBER',
			'11' => 'NOVEMBER',
			'12' => 'DESEMBER'
		];
		$vbulan = $bulan_arr[$bulan];
		$tglacc = $tanggal . " " . $vbulan . " " . $tahun;
		$namakoor = '';
		$nipkoor = '';
        $koordinator = $this->M_koorprodi->get_koordinator_by_major_name($data[0]->prodi);

		if ($koordinator) {
			$namakoor = $koordinator['namakoor'];
			$nipkoor = $koordinator['nipkoor'];
		} else {
			$namakoor = 'Tidak ditemukan';
			$nipkoor = 'Tidak ditemukan';
		}


		$data = array(
			'nim'					=>	$data[0]->nim,
			'student_name'			=>	$data[0]->nama_mahasiswa,
			'jurusan'				=>	$data[0]->prodi,
			'title'					=>	$data[0]->judul,
			'dosbing'				=>	$nip,
			'nama'					=>	$data[0]->dosen_pembimbing,
			'namakoor'				=>	$namakoor,
			'nipkoor'				=>	$nipkoor,
			'tglacc'				=>	$tglacc,
		);
		$this->load->view('v_sidangmbkm', $data);
	}
}
