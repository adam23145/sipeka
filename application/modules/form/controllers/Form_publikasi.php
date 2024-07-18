<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class form_publikasi extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('M_publikasi');
		$this->load->helper('string');
		if (!$this->session->userdata('logged_in')) {
			redirect('login');
		}
	}

	function index()
	{
		$this->breadcrumb->add('Form', 'form/form_publikasi')
			->add('Pengajuan Publikasi', 'form/form_publikasi');
		$majorcode			= substr($this->session->userdata['logged_in']['userid'], 4, 3);
		$nim				= substr($this->session->userdata['logged_in']['userid'], 0, 12);
		$token				= random_string('numeric', 3);
		$subm_id  			= 'FKIS1605-' . $majorcode . $token . date("dhs");
		// $major_name			= $this->M_global->get_jurusan($majorcode);
		$major_name			= $this->M_global->get_jurusan2($nim);

		$data = array(
			'thisContent' 	=> 'form/v_publikasi',
			'thisJs'		=> 'form/js_publikasi',
			'subm_id'		=> $subm_id,
			'majorname'		=> $major_name[0]['jurusan'],
		);
		$this->parser->parse('template/template', $data);
	}
	function submit()
	{
		$data = array(
			'jenis_tugas_akhir' => $this->input->post('jenis_tugas_akhir'),
			'judul_tugas_akhir' => $this->input->post('judul_tugas_akhir'),
			'deskripsi_tugas_akhir' => $this->input->post('deskripsi_tugas_akhir'),
			'nama_mahasiswa' => $this->input->post('nama_mahasiswa'),
			'nim' => $this->input->post('nim'),
			'dosen_pembimbing_utama' => $this->input->post('dosen_pembimbing_utama'),
			'dosen_pembimbing_kedua' => $this->input->post('dosen_pembimbing_kedua'),
			'tanggal_pengajuan' => date('Y-m-d'),
			'status_pengajuan' => 'Menunggu',
			'dokumen_pendukung' => $this->input->post('dokumen_pendukung'),
			'kategori_riset' => $this->input->post('kategori_riset'),
			'tanggal_mulai_riset' => $this->input->post('tanggal_mulai_riset'),
			'tanggal_selesai_riset' => $this->input->post('tanggal_selesai_riset'),
			'institusi_kolaborator' => $this->input->post('institusi_kolaborator'),
			'nama_jurnal_conference' => $this->input->post('nama_jurnal_conference'),
			'status_publikasi' => $this->input->post('status_publikasi'),
			'link_publikasi' => $this->input->post('link_publikasi')
		);

		$insert = $this->M_publikasi->insert($data);

		$response = array(
			'status' => $insert,
			'csrf_hash' => $this->security->get_csrf_hash()
		);

		echo json_encode($response);
	}
}
