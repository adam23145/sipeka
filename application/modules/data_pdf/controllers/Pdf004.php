<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pdf004 extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('data_pdf/M_pdf004');
        $this->load->model('data_pdf/M_koorprodi');

		if (!$this->session->userdata('logged_in')) {
			redirect('login');
		} else if ($this->session->userdata['logged_in']['userlevel'] !== "mahasiswa") {
			redirect('login');
		}
	}

	public function index()
	{
		$subcode				= base64_decode($_GET['subcd']);
		$userid 				= substr($this->session->userdata['logged_in']['userid'], 0, 12);
		$data_det				= $this->M_pdf004->getdatapdf($subcode, $userid);
		$data_logbi				= $this->M_pdf004->getdatatgl($subcode, $userid);
		$tanggalan				= $data_logbi[0]['tgl_bimbingan_skripsi'];
		$keterangan_bimbingan	= $data_logbi[0]['keterangan_bimbingan'];

		$bulan					= substr($tanggalan, 5, 2);
		$tahun					= substr($tanggalan, 0, 4);
		$tanggal				= substr($tanggalan, 8, 2);

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
		// Ambil data koordinator berdasarkan jurusan dari database
		$koordinator = $this->M_koorprodi->get_koordinator_by_major_name($data_det[0]['jurusan']);

		if ($koordinator) {
			$namakoor = $koordinator['namakoor'];
			$nipkoor = $koordinator['nipkoor'];
		} else {
			// Jika tidak ada data koordinator, bisa ditangani dengan pesan error atau default value
			$namakoor = 'Tidak ditemukan';
			$nipkoor = 'Tidak ditemukan';
		}


		$data = array(
			'nim'					=>	$data_det[0]['nim'],
			'student_name'			=>	$data_det[0]['student_name'],
			'jurusan'				=>	$data_det[0]['jurusan'],
			'title'					=>	$data_det[0]['title'],
			'dosbing'				=>	$data_det[0]['dosbing'],
			'nama'					=>	$data_det[0]['nama'],
			'namakoor'				=>	$namakoor,
			'subcode'		=> $subcode,
			'nipkoor'				=>	$nipkoor,
			'tglacc'				=>	$tglacc,
			'keterangan_bimbingan'	=>	$keterangan_bimbingan,
		);
		$this->load->view('v_pdf004', $data);
	}
}
