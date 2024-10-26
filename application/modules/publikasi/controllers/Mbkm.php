<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Mbkm extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('M_mbkm');
        $this->load->helper('url');
        $this->load->library('form_validation');
        $this->load->library('session');
        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        }
    }

    function index()
    {
        $this->breadcrumb->add('Data Mbkm', 'Mbkm');
        $data = array(
            'thisContent'     => 'publikasi/v_mbkm',
            'thisJs'        => 'publikasi/js_mbkm',
        );
        $this->parser->parse('template/template', $data);
    }
    public function get_data()
    {
        $columns = array(
            0 => 'nim', // Tambahkan NIM
            1 => 'nama_mahasiswa',
            2 => 'tanggal_pengajuan',
            3 => 'mbkm',
            4 => 'dokumen_pendukung'
        );

        $username = $this->session->userdata['logged_in']['username'];

        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $konfirmasi_status = $this->input->post('status');

        $order = isset($this->input->post('order')[0]['column']) ? $columns[$this->input->post('order')[0]['column']] : $columns[0];
        $dir = isset($this->input->post('order')[0]['dir']) ? $this->input->post('order')[0]['dir'] : 'asc';

        $totalData = $this->M_mbkm->count_all_data($konfirmasi_status, $username);
        $totalFiltered = $totalData;

        // Cek apakah ada input 'search'
        if (empty($this->input->post('search')['value'])) {
            $mahasiswa = $this->M_mbkm->get_all_data($limit, $start, $order, $dir, $konfirmasi_status, $username);
        } else {
            $search = isset($this->input->post('search')['value']) ? $this->input->post('search')['value'] : '';
            $mahasiswa = $this->M_mbkm->search_data($limit, $start, $search, $order, $dir, $konfirmasi_status, $username);
            $totalFiltered = $this->M_mbkm->count_filtered_data($search, $konfirmasi_status, $username);
        }

        $data = array();
        if (!empty($mahasiswa)) {
            foreach ($mahasiswa as $mhs) {
                $nestedData['nim'] = strtoupper($mhs->nim); // NIM Uppercase
                $nestedData['nama_mahasiswa'] = $mhs->nama_mahasiswa;
                $nestedData['tanggal_pengajuan'] = $mhs->tanggal_pengajuan;
                $nestedData['mbkm'] = $mhs->mbkm;
                $nestedData['dokumen_pendukung'] = '<a href="' . base_url($mhs->dokumen_pendukung) . '" class="btn btn-success" target="_blank">Download</a>';

                // Cek status dan atur nilai action
                if ($mhs->status_pengajuan == 'Revisi') {
                    $nestedData['action'] = '<button class="btn btn-secondary" disabled>Menunggu revisi dari mahasiswa</button>';
                }  else if($mhs->status_pengajuan == 'Acc'){
                    $nestedData['action'] = '<button onclick="goToPage(' . $mhs->id . ')" class="btn btn-primary">Check</button>';
                } 
                else {
                    $nestedData['action'] = '<button onclick="goToPage(' . $mhs->id . ')" class="btn btn-primary">Check Revisi</button>';
                }

                $data[] = $nestedData; // Ensure this is added to the data array
            }
        }

        $json_data = array(
            "draw"            => intval($this->input->post('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        );

        echo json_encode($json_data);
    }
}
