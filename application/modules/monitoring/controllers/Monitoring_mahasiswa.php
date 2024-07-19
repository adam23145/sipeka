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

        // Fetch data from the model
        $list = $this->M_mahasiswa->get_guidance_count_per_student($limit, $start, $search);
        $totalData = $this->M_mahasiswa->count_all_students();
        $totalFiltered = $this->M_mahasiswa->count_filtered_students($search);

        // Prepare data for DataTables
        $data = array();
        foreach ($list as $item) {
            $row = array();
            $row[] = $item->nim;
            $row[] = $item->student_name;
            $row[] = $item->jumlah_bimbingan;
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
}