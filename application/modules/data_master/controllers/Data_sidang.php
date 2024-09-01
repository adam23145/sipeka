<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

require_once APPPATH . 'libraries/ExcelTemplate/autoload.php'; // if you don't use framework
use PhpOffice\PhpSpreadsheet\IOFactory;

class Data_sidang extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('M_sidang');
		$this->load->model('M_global');
		if (!$this->session->userdata('logged_in')) {
			redirect('login');
		}
	}
	function index()
	{
		$this->breadcrumb->add('Settings', 'data_master/data_sidang')
			->add('Data Sidang', 'data_master/data_sidang');
		$data = array(
			'thisContent' 	=> 'data_master/v_sidang',
			'thisJs'		=> 'data_master/js_data_sidang',
		);
		$this->parser->parse('template/template', $data);
	}
	public function get_data()
	{
		$limit = $this->input->post('length');
		$start = $this->input->post('start');
		$search = $this->input->post('search')['value']; // Ensure this is set correctly

		$list = $this->M_sidang->get_all($limit, $start, $search);
		$totalData = $this->M_sidang->count_all();
		$totalFiltered = $this->M_sidang->count_filtered($search);

		$data = array();
		foreach ($list as $item) {
			if ($item->status == 2) {
				$action = ''; 
			} else {
				$action = '<button class="btn btn-primary edit-btn" data-id="' . $item->id . '">Edit</button>';
			}
			$data[] = array(
				'id' => $item->id,
				'nim' => $item->nim,
				'judul_sidang' => $item->judul_sidang,
				'nama_mahasiswa' => $item->nama_mahasiswa,
				'status' => $item->status == 1 ? 'Menunggu' : ($item->status == 2 ? 'Diterima' : 'Ditolak'),
				'tanggal_sidang' => $item->tanggal_sidang,
				'tanggal_sidang' => $item->tanggal_sidang,
				'tempat_sidang' => $item->tempat_sidang,
				'jam_mulai' => $item->jam_mulai,
				'jam_selesai' => $item->jam_selesai,
				'action' => $action,
			);
		}

		$json_data = array(
			'draw' => intval($this->input->post('draw')),
			'recordsTotal' => intval($totalData),
			'recordsFiltered' => intval($totalFiltered),
			'data' => $data
		);

		echo json_encode($json_data);
	}


	public function get_sidang()
	{
		$id = $this->input->post('id');
		$sidang = $this->M_sidang->get_by_id($id);
		$data_dosen = $this->M_sidang->get_dosen();

		// Gabungkan data sidang dengan data dosen dalam array asosiatif
		$response = [
			'sidang' => $sidang,
			'data_dosen' => $data_dosen
		];

		echo json_encode($response);
	}



	public function update()
	{
		$data = array(
			'status' => $this->input->post('status'),
			'tanggal_sidang' => $this->input->post('tanggal_sidang'),
			'tempat_sidang' => $this->input->post('tempat_sidang'),
			'pembimbing_2' => $this->input->post('pembimbing'),
			'penguji_1' => $this->input->post('penguji1'),
			'penguji_2' => $this->input->post('penguji2'),
			'jam_mulai' => $this->input->post('jam_mulai'),
			'jam_selesai' => $this->input->post('jam_selesai'),
		);
		$id = $this->input->post('sidang_id');
		$this->M_sidang->update($id, $data);
		$this->session->set_flashdata('success', 'Data updated successfully');
		echo json_encode(array("status" => TRUE));
	}
}
