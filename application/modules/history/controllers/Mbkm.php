<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Mbkm extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('M_mbkm');
        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        }
    }

    function index()
    {
        $this->breadcrumb->add('History', 'history/mbkm');
        $data = array(
            'thisContent'     => 'history/v_mbkm',
            'thisJs'        => 'history/js_mbkm',
        );
        $this->parser->parse('template/template', $data);
    }
    public function get_data()
    {
        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $search = $this->input->post('search')['value'];

        $list = $this->M_mbkm->get_all($limit, $start, $search);
        $totalData = $this->M_mbkm->count_all();
        $totalFiltered = $this->M_mbkm->count_filtered($search);

        $data = array();
        foreach ($list as $item) {
            $row = array();
            $row['mbkm'] = $item->mbkm !== null ? $item->mbkm : '-';
            $row['nama_mahasiswa'] = $item->nama_mahasiswa !== null ? $item->nama_mahasiswa : '-';
            $row['nim'] = $item->nim !== null ? $item->nim : '-';
            $row['tanggal_pengajuan'] = $item->tanggal_pengajuan !== null ? $item->tanggal_pengajuan : '-';
            $row['pembimbing_1'] = $item->dosen_pembimbing_utama !== null ? $item->dosen_pembimbing_utama : '-';
            $row['pembimbing_2'] = $item->dosen_pembimbing_kedua !== null ? $item->dosen_pembimbing_kedua : '-';
            $row['status_pengajuan'] = $item->status_pengajuan !== null ? $item->status_pengajuan : '-';

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
