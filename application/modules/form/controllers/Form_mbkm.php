<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
class Form_mbkm extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('M_pengajuanjudulmbkm');
		$this->load->helper('string');
		if (!$this->session->userdata('logged_in')) {
			redirect('login');
		}
	}

	function index()
	{
		$this->breadcrumb->add('Form', 'form/form_mbkm')
			->add('Pengajuan Judul Mbkm', 'form/form_mbkm');
		$majorcode = substr($this->session->userdata['logged_in']['userid'], 4, 3);
		$nim = substr($this->session->userdata['logged_in']['userid'], 0, 12);
		$token = random_string('numeric', 3);
		$subm_id = 'FKIS1605-' . $majorcode . $token . date("dhs");
		$major_name = $this->M_global->get_jurusan2($nim);

		$data = array(
			'thisContent' => 'form/v_pengajuan_judul_mbkm',
			'thisJs' => 'form/js_pengajuan_judul_mbkm',
			'subm_id' => $subm_id,
			'majorname' => $major_name[0]['jurusan'],
		);
		$this->parser->parse('template/template', $data);
	}

	public function submit()
	{
		$subm_id = $this->input->post('sub_code');
		$nama = $this->input->post('nama');
		$nim = $this->input->post('nim');
		$majorname = $this->input->post('majorname');
		$judul = $this->input->post('judul');
		$rumusah_masalah = $this->input->post('rumusah_masalah');
		$urgensi = $this->input->post('urgensi');

		if ($this->M_pengajuanjudulmbkm->is_submission_exists($nim)) {
			echo json_encode([
				'status' => 'error',
				'message' => 'Anda sudah memiliki pengajuan yang belum ditolak!'
			]);
			exit();
		}

		$data = array(
			'submission_code' => $subm_id,
			'nama_mahasiswa' => $nama,
			'nim' => $nim,
			'prodi' => $majorname,
			'judul' => $judul,
			'rumusan_masalah' => $rumusah_masalah,
			'urgensi' => $urgensi,
			'posisi_berkas' => 'Koordinator Prodi',
			'status_pengajuan' => 'Menunggu',
			'tanggal_pengajuan' => date('Y-m-d'),
		);

		if ($this->M_pengajuanjudulmbkm->save_submission($data)) {
			echo json_encode([
				'status' => 'success',
				'message' => 'Pengajuan Judul MBKM berhasil disimpan!'
			]);
		} else {
			echo json_encode([
				'status' => 'error',
				'message' => 'Terjadi kesalahan saat menyimpan pengajuan!'
			]);
		}
	}
}
