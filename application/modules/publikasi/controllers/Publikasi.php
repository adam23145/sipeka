<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Publikasi extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('M_publikasi');
        $this->load->helper('url');
        $this->load->library('form_validation');
        $this->load->library('session');
        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        }
    }

    function index()
    {
        $this->breadcrumb->add('Data Publikasi', 'Publikasi');
        $data = array(
            'thisContent'     => 'publikasi/v_publikasi',
            'thisJs'        => 'publikasi/js_publikasi',
        );
        $this->parser->parse('template/template', $data);
    }
    function get_data()
	{
		$limit = $this->input->post('length');
		$start = $this->input->post('start');
		$search = $this->input->post('search')['value'];
		$status = $this->input->post('status'); // Status filter dari dropdown
		if (empty($status)) {
			$status = 'Disetujui';
		}

		$username = $this->session->userdata['logged_in']['username'];
		$list = $this->M_publikasi->get_all($limit, $start, $search, $status,$username);
		$totalData = $this->M_publikasi->count_all($username);
		$totalFiltered = $this->M_publikasi->count_filtered($search, $status,$username);

		$data = array();
		$no = $start + 1;
		foreach ($list as $item) {
			$row = array();
			$row[] = $no++;
			$row[] = date('d-m-Y', strtotime($item->tanggal_pengajuan));
			$row[] = $item->nim;
			$row[] = $item->jenis_tugas_akhir;
			$row[] = $item->judul_tugas_akhir;
			$row[] = $item->nama_mahasiswa;
			$row[] = '<a href="' . base_url($item->dokumen_pendukung) . '" class="btn btn-success" target="_blank">Download</a>';
			if ($item->status_pengajuan == 'Revisi') {
				$row[]  = '<button class="btn btn-secondary" disabled>Menunggu revisi dari mahasiswa</button>';
			}  else if($item->status_pengajuan == 'Acc'){
				$row[]  = '<button onclick="goToPage(' . $item->id . ')" class="btn btn-primary">Check</button>';
			} 
			else {
				$row[]  = '<button onclick="goToPage(' . $item->id . ')" class="btn btn-primary">Check Revisi</button>';
			}

			$data[] = $row;
		}

		// JSON response untuk DataTables
		$json_data = array(
			"draw" => intval($this->input->post('draw')),
			"recordsTotal" => intval($totalData),
			"recordsFiltered" => intval($totalFiltered),
			"data" => $data
		);

		echo json_encode($json_data);
	}
}
