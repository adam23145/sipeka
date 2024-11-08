<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Form_mbkm extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('M_mbkm');
		$this->load->helper('string');
		if (!$this->session->userdata('logged_in')) {
			redirect('login');
		}
	}

	function index()
	{
		$this->breadcrumb->add('Form', 'form/form_mbkm')
			->add('Pengajuan Sempro Mbkm', 'form/form_mbkm');
		$majorcode			= substr($this->session->userdata['logged_in']['userid'], 4, 3);
		$nim				= substr($this->session->userdata['logged_in']['userid'], 0, 12);
		$token				= random_string('numeric', 3);
		$subm_id  			= 'FKIS1605-' . $majorcode . $token . date("dhs");
		// $major_name			= $this->M_global->get_jurusan($majorcode);
		$major_name			= $this->M_global->get_jurusan2($nim);

		$data = array(
			'thisContent' 	=> 'form/v_mbkm',
			'thisJs'		=> 'form/js_mbkm',
			'subm_id'		=> $subm_id,
			'majorname'		=> $major_name[0]['jurusan'],
		);
		$this->parser->parse('template/template', $data);
	}
	public function submit()
	{
		// Check if both files are uploaded
		if (empty($_FILES["dokumen_pendukung"]) || empty($_FILES["dokumen_pendukung2"])) {
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
			mkdir($directory, 0755, true); // Create directory if it doesn't exist
		}

		$allowed = array('doc', 'docx', 'ppt', 'pptx', 'pdf');

		// First file validation and upload
		$file_name_1 = $_FILES["dokumen_pendukung"]["name"];
		$file_tmp_name_1 = $_FILES["dokumen_pendukung"]["tmp_name"];
		$file_ext_1 = pathinfo($file_name_1, PATHINFO_EXTENSION);
		$file_name_new_1 = 'mbkm-' . $file_name_1;
		$file_upload_1 = $directory . "/" . $file_name_new_1;

		if (!in_array($file_ext_1, $allowed)) {
			$response = array(
				'status' => false,
				'message' => 'Format file dokumen pendukung tidak didukung.',
				'csrf_hash' => $this->security->get_csrf_hash()
			);
			echo json_encode($response);
			return;
		}

		// Second file validation and upload
		$file_name_2 = $_FILES["dokumen_pendukung2"]["name"];
		$file_tmp_name_2 = $_FILES["dokumen_pendukung2"]["tmp_name"];
		$file_ext_2 = pathinfo($file_name_2, PATHINFO_EXTENSION);
		$file_name_new_2 = 'mbkmpenilaian-' . $file_name_2;
		$file_upload_2 = $directory . "/" . $file_name_new_2;

		if (!in_array($file_ext_2, $allowed)) {
			$response = array(
				'status' => false,
				'message' => 'Format file dokumen pendukung 2 tidak didukung.',
				'csrf_hash' => $this->security->get_csrf_hash()
			);
			echo json_encode($response);
			return;
		}

		// Check if NIM already exists
		$nim = $this->input->post('nim');
		$nim_exists = $this->M_mbkm->check_nim_exists($nim);

		if ($nim_exists) {
			$response = array(
				'status' => false,
				'message' => 'Sudah melakukan pengiriman Mbkm',
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

		// Move both files to the directory
		if (move_uploaded_file($file_tmp_name_1, $file_upload_1) && move_uploaded_file($file_tmp_name_2, $file_upload_2)) {
			$data = array(
				'mbkm' => $this->input->post('mbkm'),
				'nama_mahasiswa' => $this->input->post('nama_mahasiswa'),
				'nim' => $nim,
				'prodi' => $this->input->post('majorname'),
				'dosen_pembimbing_utama' => null,
				'dosen_pembimbing_kedua' => null,
				'tanggal_pengajuan' => date('Y-m-d'),
				'status_pengajuan' => 'Menunggu',
				'dokumen_pendukung' => $file_pth . $file_name_new_1,
				'dokumen_pengajuan' => $file_pth . $file_name_new_2,
				'submission_code' => $submission_code,
			);

			$insert = $this->M_mbkm->insert($data);

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
