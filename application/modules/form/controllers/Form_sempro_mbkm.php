<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Form_sempro_mbkm extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('M_sempro_mbkm');
		$this->load->helper('string');
		if (!$this->session->userdata('logged_in')) {
			redirect('login');
		}
	}

	function index()
	{
		$this->breadcrumb->add('Form', 'form/form_sempro_mbkm')
			->add('Pengajuan Sempro Mbkm', 'form/form_sempro_mbkm');
		$majorcode			= substr($this->session->userdata['logged_in']['userid'], 4, 3);
		$nim				= substr($this->session->userdata['logged_in']['userid'], 0, 12);
		$token				= random_string('numeric', 3);
		$subm_id  			= 'FKIS1605-' . $majorcode . $token . date("dhs");
		// $major_name			= $this->M_global->get_jurusan($majorcode);
		$major_name			= $this->M_global->get_jurusan2($nim);

		$data = array(
			'thisContent' 	=> 'form/v_sempro_mbkm',
			'thisJs'		=> 'form/js_sempro_mbkm',
			'subm_id'		=> $subm_id,
			'majorname'		=> $major_name[0]['jurusan'],
		);
		$this->parser->parse('template/template', $data);
	}
	public function submit()
	{
		if (empty($_FILES["dokumen_pendukung"])) {
			$response = array(
				'status' => false,
				'message' => 'File dokumen pendukung tidak boleh kosong',
				'csrf_hash' => $this->security->get_csrf_hash()
			);
			echo json_encode($response);
			return;
		}

		$userid = $this->session->userdata['logged_in']['userid'];
		$directory = './document/filembkm/' . $userid;
		$file_pth = 'document/filembkm/' . $userid . '/';

		if (!is_dir($directory)) {
			mkdir($directory, 0755, true); // Buat direktori jika belum ada
		}

		$allowed = array('doc', 'docx', 'ppt', 'pptx', 'pdf');
		$file_name = $_FILES["dokumen_pendukung"]["name"];
		$file_tmp_name = $_FILES["dokumen_pendukung"]["tmp_name"];
		$file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
		$file_name_new = 'semprombkm-' . $file_name;
		$file_upload = $directory . "/" . $file_name_new;

		// Validasi ekstensi file
		if (!in_array($file_ext, $allowed)) {
			$response = array(
				'status' => false,
				'message' => 'Format file tidak didukung. Harap unggah file dengan format .doc, .docx, .ppt, .pptx, atau .pdf.',
				'csrf_hash' => $this->security->get_csrf_hash()
			);
			echo json_encode($response);
			return;
		}

		// Cek apakah NIM sudah ada
		$nim = $this->input->post('nim');
		$nim_exists = $this->M_sempro_mbkm->check_nim_exists($nim); // Asumsikan Anda sudah punya fungsi check_nim_exists di model

		if ($nim_exists) {
			$response = array(
				'status' => false,
				'message' => 'Sudah Melakukan Pengiriman Mbkm',
				'csrf_hash' => $this->security->get_csrf_hash()
			);
			echo json_encode($response);
			return;
		}
		$this->load->helper('string');

		do {
			$token = random_string('numeric', 3);
			$submission_code = 'FKIS1605-' . $token . date("dhs");
			$existing_code = $this->db->where('submission_code', $submission_code)
				->get('mbkm_riset')
				->row();
		} while ($existing_code);

		if (move_uploaded_file($file_tmp_name, $file_upload)) {
			$data = array(
				'mbkm' => $this->input->post('mbkm'),
				'nama_mahasiswa' => $this->input->post('nama_mahasiswa'),
				'nim' => $nim,
				'prodi' => $this->input->post('majorname'),
				'dosen_pembimbing_utama' => null,
				'dosen_pembimbing_kedua' => null,
				'tanggal_pengajuan' => date('Y-m-d'),
				'status_pengajuan' => 'Menunggu',
				'dokumen_pendukung' => $file_pth . $file_name_new,
				'submission_code' => $submission_code,
			);

			$insert = $this->M_sempro_mbkm->insert($data);

			$response = array(
				'status' => $insert,
				'message' => $insert ? 'Data berhasil disimpan' : 'Data gagal disimpan',
				'csrf_hash' => $this->security->get_csrf_hash()
			);
		} else {
			$response = array(
				'status' => false,
				'message' => 'Gagal mengunggah file dokumen pendukung',
				'csrf_hash' => $this->security->get_csrf_hash()
			);
		}

		echo json_encode($response);
	}
}
