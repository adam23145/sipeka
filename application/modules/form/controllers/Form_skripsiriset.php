<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Form_skripsiriset extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('M_skripsiriset');
		$this->load->helper('string');
		if (!$this->session->userdata('logged_in')) {
			redirect('login');
		}
	}

	function index()
	{
		$this->breadcrumb->add('Form', 'form/form_skripsiriset')
			->add('Pengajuan Skripsi Riset', 'form/form_skripsiriset');
		$majorcode			= substr($this->session->userdata['logged_in']['userid'], 4, 3);
		$nim				= substr($this->session->userdata['logged_in']['userid'], 0, 12);
		$token				= random_string('numeric', 3);
		$subm_id  			= 'FKIS1605-' . $majorcode . $token . date("dhs");
		// $major_name			= $this->M_global->get_jurusan($majorcode);
		$major_name			= $this->M_global->get_jurusan2($nim);

		$data = array(
			'thisContent' 	=> 'form/v_skripsiriset',
			'thisJs'		=> 'form/js_skripsiriset',
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
		$directory = './document/fileskpripsiriset/' . $userid;
		$file_pth = 'document/fileskpripsiriset/' . $userid . '/';

		if (!is_dir($directory)) {
			mkdir($directory, 0755, true); // Create the directory recursively if it does not exist
		}

		$allowed = array('doc', 'docx', 'ppt', 'pptx', 'pdf');
		$file_name = $_FILES["dokumen_pendukung"]["name"];
		$file_tmp_name = $_FILES["dokumen_pendukung"]["tmp_name"];
		$file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
		$file_name_new = 'skprisriset-' . $file_name;
		$file_upload = $directory . "/" . $file_name_new;

		if (!in_array($file_ext, $allowed)) {
			$response = array(
				'status' => false,
				'message' => 'Format file tidak didukung. Harap unggah file dengan format .doc, .docx, .ppt, .pptx, atau .pdf.',
				'csrf_hash' => $this->security->get_csrf_hash()
			);
			echo json_encode($response);
			return;
		}

		if (move_uploaded_file($file_tmp_name, $file_upload)) {
			$data = array(
				'skripsi_riset' => $this->input->post('skripsi_riset'),
				'nama_mahasiswa' => $this->input->post('nama_mahasiswa'),
				'nim' => $this->input->post('nim'),
				'prodi' => $this->input->post('majorname'),
				'dosen_pembimbing_utama' => $this->input->post('dosen_pembimbing_utama'),
				'dosen_pembimbing_kedua' => $this->input->post('dosen_pembimbing_kedua'),
				'tanggal_pengajuan' => date('Y-m-d'),
				'status_pengajuan' => 'Menunggu',
				'dokumen_pendukung' => $file_pth . $file_name_new,
			);

			$insert = $this->M_skripsiriset->insert($data);

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


	public function fetch_dosen_select2()
	{
		$dosen = $this->M_skripsiriset->get_all(); // Mengambil data dosen dari model

		$data = array();
		foreach ($dosen as $row) {
			$data[] = array(
				'id' => $row->nama,
				'text' => $row->nama
			);
		}

		echo json_encode($data); // Mengirim data dalam format JSON
	}
}