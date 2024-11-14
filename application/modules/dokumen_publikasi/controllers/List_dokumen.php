<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class List_dokumen extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('M_list_dokumen');
		if (!$this->session->userdata('logged_in')) {
			redirect('login');
		}
	}

	// Display document list
	function index()
	{
		$this->breadcrumb->add('List Dokumen', 'dokumen_publikasi/list_dokumen');
		$data = array(
			'thisContent' => 'dokumen_publikasi/v_list_dokumen',
			'thisJs' => 'dokumen_publikasi/js_list_dokumen',
		);
		$this->parser->parse('template/template', $data);
	}
	public function get_submissions()
	{
		$userid = $this->session->userdata('logged_in')['userid'];
		$usr = substr($userid, 0, 12);
		$encoded_usr = urlencode($usr);  // Meng-encode nim (userid)

		$submissions = $this->M_list_dokumen->get_approved_submissions($usr);
		$data = array();

		if (!empty($submissions)) {
			$data[] = array(
				'judul_tugas_akhir' => $submissions[0]->judul_tugas_akhir,
				'dokumen' => 'Berita Acara Bimbingan Publikasi',
				'aksi' => base_url('data_pdf/Bimbingan_publikasi?subcd=' . $encoded_usr),
			);

			$data[] = array(
				'judul_tugas_akhir' => $submissions[0]->judul_tugas_akhir,
				'dokumen' => 'Form Siap Diujikan Sidang',
				'aksi' => base_url('data_pdf/Sidang_publikasi?subcd=' . $encoded_usr),
			);
		}

		echo json_encode(array(
			'draw' => intval($this->input->get('draw')),
			'recordsTotal' => count($data),
			'recordsFiltered' => count($data),
			'data' => $data
		));
	}
}
