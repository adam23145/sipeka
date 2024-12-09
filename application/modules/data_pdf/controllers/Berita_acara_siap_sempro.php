<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Berita_acara_siap_sempro extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('data_pdf/M_beritaacarasiapsempro');
        $this->load->model('data_pdf/M_koorprodi');

        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        } else if ($this->session->userdata['logged_in']['userlevel'] !== "mahasiswa") {
            redirect('login');
        }
    }

    public function index()
    {
        $subcode = base64_decode($this->input->get('subcd'));
        $userid = substr($this->session->userdata['logged_in']['userid'], 0, 12);
        $data_det = $this->M_beritaacarasiapsempro->getdatapdf($subcode, $userid);
        $data_jml = $this->M_beritaacarasiapsempro->getjml($data_det[0]['id']);

        $log_bimbingan = $this->M_beritaacarasiapsempro->getBimbinganSempro($data_det[0]['id']);
        $koordinator = $this->M_koorprodi->get_koordinator_by_major_name($data_det[0]['prodi']);

        if ($koordinator) {
            $namakoor = $koordinator['namakoor'];
            $nipkoor = $koordinator['nipkoor'];
        } else {
            $namakoor = 'Tidak ditemukan';
            $nipkoor = 'Tidak ditemukan';
        }


        $data = array(
            'nim' => $data_det[0]['nim'],
            'student_name' => $data_det[0]['nama_mahasiswa'],
            'jurusan' => $data_det[0]['prodi'],
            'title' => $data_det[0]['judul'],
            'dosbing' => $data_det[0]['dosen_pembimbing'],
            'nama' => $data_det[0]['nama'],
            'submission_code' => $data_det[0]['submission_code'],
            'jumlb' => $data_jml,
            'subcode'        => $subcode,
            'log_bimbingan' => $log_bimbingan,
            'namakoor' => $namakoor,
            'nipkoor' => $nipkoor,
        );

        $this->load->view('v_berita_acara_siap_sempro', $data);
    }
}
