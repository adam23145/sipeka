<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Monitoring_mahasiswa extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('M_mahasiswa');
        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        }
    }

    function index()
    {
        $this->breadcrumb->add('Settings', 'monitoring/monitoring_mahasiswa')
            ->add('Data Monitoring Mahasiswa', 'monitoring/monitoring_mahasiswa');
        $data = array(
            'thisContent' => 'monitoring/v_monitoring_mahasiswa',
            'thisJs' => 'monitoring/js_monitoring_mahasiswa',
        );

        $this->parser->parse('template/template', $data);
    }

    public function get_guidance_count_data()
    {
        // Retrieve input values
        $limit = $this->input->post('length', true);
        $start = $this->input->post('start', true);
        $search = $this->input->post('search')['value'];
        $year = $this->input->post('year'); // Get the year filter
        $jurusan = $this->input->post('jurusan'); // Get the jurusan filter

        // Fetch data from the model
        $list = $this->M_mahasiswa->get_guidance_count_per_student($limit, $start, $search, $year, $jurusan);
        $totalData = $this->M_mahasiswa->count_all_students($year, $jurusan);
        $totalFiltered = $this->M_mahasiswa->count_filtered_students($search, $year, $jurusan);

        // Prepare data for DataTables
        $data = array();
        foreach ($list as $item) {
            $row = array();
            $row[] = $item->nim;
            $row[] = $item->nama;
            $row[] = $item->tahun_masuk;
            $row[] = $item->jurusan;
            $row[] = $item->title;
            $row[] = $item->bimbingan_ke;
            $data[] = $row;
        }

        // Create JSON response
        $json_data = array(
            "draw" => intval($this->input->post('draw')),
            "recordsTotal" => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $data,
            "csrf_token" => $this->security->get_csrf_hash() // Add CSRF token
        );

        // Send JSON response
        echo json_encode($json_data);
    }

    public function get_jurusan()
    {
        $jurusan = $this->M_mahasiswa->get_unique_jurusan();
        echo json_encode($jurusan);
    }


    public function get_years()
    {
        $years = $this->M_mahasiswa->get_unique_years();
        echo json_encode($years);
    }
}
