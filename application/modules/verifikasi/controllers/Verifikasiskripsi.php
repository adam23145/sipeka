<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Verifikasiskripsi extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('M_verifikasiskripsi');
        $this->load->helper('url');
        $this->load->library('form_validation');
        $this->load->library('session');
        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        }
    }

    function index()
    {
        $this->breadcrumb->add('Verifikasi Data Skripsi', 'Verifikasi');
        $data = array(
            'thisContent'     => 'verifikasi/v_checkDataSkripsi',
            'thisJs'        => 'verifikasi/js_checkDataSkripsi',
        );
        $this->parser->parse('template/template', $data);
    }
    public function check_barcode()
    {
        // Ambil data barcode dari form
        $submission_code = $this->input->post('barcode');
        if (empty($submission_code)) {
            echo '<div class="alert alert-danger">Barcode is required</div>';
            return;
        }

        // Cek status_pengajuan_judul di tabel mbkm_riset
        $this->db->where('submission_code', $submission_code);
        $query = $this->db->get('mbkm_riset');

        if ($query->num_rows() == 0) {
            echo '<div class="alert alert-danger">Data tidak ditemukan di mbkm_riset.</div>';
            return;
        }

        $row = $query->row();
        if ($row->status_pengajuan_judul != 'Acc') {
            echo '<div class="alert alert-danger">Status pengajuan judul belum disetujui (Acc).</div>';
            return;
        }

        // Pengecekan barcode
        $exists = $this->M_verifikasiskripsi->is_barcode_exists($submission_code);

        if ($exists) {
            echo '<div class="alert alert-success">Data benar dan sesuai prosedur.</div>';
        } else {
            echo '<div class="alert alert-danger">Data salah atau tidak sesuai prosedur.</div>';
        }
    }
}
