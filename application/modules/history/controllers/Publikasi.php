<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Publikasi extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('M_publikasi');
        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        }
    }

    function index()
    {
        $this->breadcrumb->add('History', 'history/publikasi');
        $data = array(
            'thisContent'     => 'history/v_publikasi',
            'thisJs'        => 'history/js_publikasi',
        );
        $this->parser->parse('template/template', $data);
    }
    public function get_data()
    {
        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $search = $this->input->post('search')['value'];

        $list = $this->M_publikasi->get_all($limit, $start, $search);
        $totalData = $this->M_publikasi->count_all();
        $totalFiltered = $this->M_publikasi->count_filtered($search);

        $data = array();
        foreach ($list as $item) {
            $row = array();
            $row['jenis_tugas_akhir'] = $item->jenis_tugas_akhir;
            $row['judul_tugas_akhir'] = $item->judul_tugas_akhir;
            $row['nama_mahasiswa'] = $item->nama_mahasiswa;
            $row['nim'] = $item->nim;
            $row['tanggal_pengajuan'] = $item->tanggal_pengajuan;
            $row['status_pengajuan'] = $item->status_pengajuan;
            // Tambahkan kolom lain sesuai kebutuhan

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
}
