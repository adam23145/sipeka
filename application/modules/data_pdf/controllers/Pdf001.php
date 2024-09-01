<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pdf001 extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('data_pdf/M_pdf001');
        $this->load->model('data_pdf/M_koorprodi');
        // Cek sesi login
        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        } else if ($this->session->userdata['logged_in']['userlevel'] !== "mahasiswa") {
            redirect('login');
        }
    }

    public function index()
    {
        // Decode subcode dari URL
        $subcode = base64_decode($this->input->get('subcd'));
        $userid = substr($this->session->userdata['logged_in']['userid'], 0, 12);
        $data_det = $this->M_pdf001->getdatapdf($subcode, $userid);

        // Ambil data koordinator berdasarkan jurusan dari database
        $koordinator = $this->M_koorprodi->get_koordinator_by_major_name($data_det[0]['jurusan']);

        if ($koordinator) {
            $namakoor = $koordinator['namakoor'];
            $nipkoor = $koordinator['nipkoor'];
        } else {
            // Jika tidak ada data koordinator, bisa ditangani dengan pesan error atau default value
            $namakoor = 'Tidak ditemukan';
            $nipkoor = 'Tidak ditemukan';
        }

        // Data yang akan dikirim ke view
        $data = array(
            'nim'           => $data_det[0]['nim'],
            'student_name'  => $data_det[0]['student_name'],
            'jurusan'       => $data_det[0]['jurusan'],
            'title'         => $data_det[0]['title'],
            'dosbing'       => $data_det[0]['dosbing'],
            'nama'          => $data_det[0]['nama'],
            'subcode'       => $subcode,
            'namakoor'      => $namakoor,
            'nipkoor'       => $nipkoor,
        );

        // Load view tanpa pdfgenerator
        $this->load->view('v_pdf001', $data);
    }
}
