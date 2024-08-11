<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Sidang extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('M_sidang');
        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        }
    }

    function index()
    {
        $this->breadcrumb->add('History', 'history/sidang');
        $data = array(
            'thisContent' => 'history/v_sidang',
            'thisJs' => 'history/js_sidang',
        );
        $this->parser->parse('template/template', $data);
    }

    public function get_data()
    {
        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $search = $this->input->post('search')['value'];

        $list = $this->M_sidang->get_all($limit, $start, $search);
        $totalData = $this->M_sidang->count_all();
        $totalFiltered = $this->M_sidang->count_filtered($search);

        $data = array();
        foreach ($list as $item) {
            $data[] = array(
                'judul_sidang' => !empty($item->judul_sidang) ? $item->judul_sidang : '-',
                'nama_mahasiswa' => !empty($item->nama_mahasiswa) ? $item->nama_mahasiswa : '-',
                'nim' => !empty($item->nim) ? $item->nim : '-',
                'tanggal_sidang' => !empty($item->tanggal_sidang) ? $item->tanggal_sidang : '-',
                'tempat_sidang' => !empty($item->tempat_sidang) ? $item->tempat_sidang : '-',
                'status' => $item->status == 1 ? 'Menunggu' : ($item->status == 2 ? 'Diterima' : 'Ditolak')
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
}
