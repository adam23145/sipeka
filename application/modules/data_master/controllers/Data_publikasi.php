<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

require_once APPPATH . 'libraries/ExcelTemplate/autoload.php'; // if you don't use framework
use PhpOffice\PhpSpreadsheet\IOFactory;

class Data_publikasi extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('M_publikasi');
		$this->load->model('M_global');
		if (!$this->session->userdata('logged_in')) {
			redirect('login');
		}
	}
	function index()
	{
		$this->breadcrumb->add('Settings', 'data_master/data_publikasi')
			->add('Data Publikasi', 'data_master/data_publikasi');
		$data = array(
			'thisContent' 	=> 'data_master/v_publikasi',
			'thisJs'		=> 'data_master/js_data_publikasi',
		);
		$this->parser->parse('template/template', $data);
	}
	function get_data()
	{
		$limit = $this->input->post('length');
		$start = $this->input->post('start');
		$search = $this->input->post('search')['value'];
		$status = $this->input->post('status'); // Get the status filter

		$list = $this->M_publikasi->get_all($limit, $start, $search, $status);
		$totalData = $this->M_publikasi->count_all();
		$totalFiltered = $this->M_publikasi->count_filtered($search, $status);

		$data = array();
		foreach ($list as $item) {
			$row = array();
			$row[] = $item->jenis_tugas_akhir;
			$row[] = $item->judul_tugas_akhir;
			$row[] = $item->nama_mahasiswa;
			$row[] = $item->nim;
			$row[] = $item->tanggal_pengajuan;
			$row[] = '<select class="form-control status-select" data-id="' . $item->id . '">
                        <option value="Menunggu" ' . ($item->status_pengajuan == 'Menunggu' ? 'selected' : '') . '>Menunggu</option>
                        <option value="Disetujui" ' . ($item->status_pengajuan == 'Disetujui' ? 'selected' : '') . '>Disetujui</option>
                        <option value="Ditolak" ' . ($item->status_pengajuan == 'Ditolak' ? 'selected' : '') . '>Ditolak</option>
                        <option value="Revisi" ' . ($item->status_pengajuan == 'Revisi' ? 'selected' : '') . '>Revisi</option>
                      </select>';
			$data[] = $row;
		}

		$json_data = array(
			"draw" => intval($this->input->post('draw')),
			"recordsTotal" => intval($totalData),
			"recordsFiltered" => intval($totalFiltered),
			"data" => $data
		);

		echo json_encode($json_data);
	}
	
	function update_status()
	{
		$id = $this->input->post('id');
		$status = $this->input->post('status');
		$this->M_publikasi->update_status($id, $status);
		echo json_encode(array("status" => TRUE));
	}
}
