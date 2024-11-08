<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sempro_mbkm extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('data_pdf/M_sempro_mbkm');
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

        // Ambil data dari model berdasarkan subcode
        $data_det = $this->M_sempro_mbkm->getdatapdf($subcode);

        // Cek apakah data ditemukan
        if ($data_det) {
            // Ambil koordinator berdasarkan jurusan
            $koordinator = $this->M_koorprodi->get_koordinator_by_major_name($data_det[0]['prodi']);

            // Jika koordinator ditemukan, ambil namakoor dan nipkoor
            if ($koordinator) {
                $namakoor = $koordinator['namakoor'];
                $nipkoor = $koordinator['nipkoor'];
            } else {
                // Jika tidak ditemukan, set nilai default
                $namakoor = 'Tidak ditemukan';
                $nipkoor = 'Tidak ditemukan';
            }
            $dosen_pembimbing_utama = $data_det[0]['dosen_pembimbing_utama'];

            // Panggil fungsi get_nip_by_dosen_name untuk mendapatkan nip
            $nip_dosen = $this->M_sempro_mbkm->get_nip_by_dosen_name($dosen_pembimbing_utama);

            // Menambahkan nip ke data
            $data_det[0]['nip'] = $nip_dosen;
            $data = array(
                'nim'           => $data_det[0]['nim'],
                'student_name'  => $data_det[0]['nama_mahasiswa'],
                'jurusan'       => $data_det[0]['prodi'],
                'title'         => $data_det[0]['mbkm'],
                'dosbing'       => $nip_dosen,
                'nama'          => $data_det[0]['dosen_pembimbing_utama'],
                'subcode'       => $subcode,
                'namakoor'      => $namakoor,
                'nipkoor'       => $nipkoor,
            );

            // Load view tanpa pdfgenerator
            $this->load->view('v_semprombkm', $data);
        } else {
            // Jika data tidak ditemukan, redirect atau tampilkan error
            show_error('Data tidak ditemukan', 404);
        }
    }
}
