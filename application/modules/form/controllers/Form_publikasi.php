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
		$directory = './document/filepublikasi/' . $userid;
		$file_pth = 'document/filepublikasi/' . $userid . '/';

		if (!is_dir($directory)) {
			mkdir($directory, 0755, true); // Create the directory recursively if it does not exist
		}

		$allowed = array('doc', 'docx', 'ppt', 'pptx', 'pdf');
		$file_name = $_FILES["dokumen_pendukung"]["name"];
		$file_tmp_name = $_FILES["dokumen_pendukung"]["tmp_name"];
		$file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
		$file_name_new = 'publikasi-' . $file_name;
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
				'jenis_tugas_akhir' => $this->input->post('jenis_tugas_akhir'),
				'judul_tugas_akhir' => $this->input->post('judul_tugas_akhir'),
				'deskripsi_tugas_akhir' => $this->input->post('deskripsi_tugas_akhir'),
				'nama_mahasiswa' => $this->input->post('nama_mahasiswa'),
				'nim' => $this->input->post('nim'),
				'dosen_pembimbing_utama' => $this->input->post('dosen_pembimbing_utama'),
				'dosen_pembimbing_kedua' => $this->input->post('dosen_pembimbing_kedua'),
				'tanggal_pengajuan' => date('Y-m-d'),
				'status_pengajuan' => 'Menunggu',
				'dokumen_pendukung' => $file_pth . $file_name_new,
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
		$dosen = $this->M_publikasi->get_all(); // Mengambil data dosen dari model

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
