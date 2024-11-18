<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Bimbingan_mbkm extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('data_pdf/M_bimbinganmbkm');
        $this->load->model('data_pdf/M_koorprodi');

        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        } else if ($this->session->userdata['logged_in']['userlevel'] !== "mahasiswa") {
            redirect('login');
        }
    }

    public function index()
    {
        // $nim = base64_decode($this->input->get('nim'));
        $nim = substr($this->session->userdata['logged_in']['userid'], 0, 12);
        $data = $this->M_bimbinganmbkm->get_approved_submissions($nim);
        $koordinator = $this->M_koorprodi->get_koordinator_by_major_name($data[0]->prodi);
        $log_bimbingan = $this->M_bimbinganmbkm->get_log_bimbingan_by_id($data[0]->id);
        $countdata = $this->M_bimbinganmbkm->count_publikasi_by_id($data[0]->id);
        $nip = $this->M_bimbinganmbkm->get_nip_by_name($data[0]->dosen_pembimbing);

        if ($koordinator) {
            $namakoor = $koordinator['namakoor'];
            $nipkoor = $koordinator['nipkoor'];
        } else {
            $namakoor = 'Tidak ditemukan';
            $nipkoor = 'Tidak ditemukan';
        }


        $data = array(
            'nim' => $data[0]->nim,
            'student_name' => $data[0]->nama_mahasiswa,
            'jurusan' => $data[0]->prodi,
            'title' => $data[0]->judul,
            'dosbing' => $nip,
            'nama' => $data[0]->dosen_pembimbing,
            'namakoor' => $namakoor,
            'nipkoor' => $nipkoor,
            'log_bimbingan' => $log_bimbingan,
            'jumlb' => $countdata,
        );

        // Menampilkan langsung ke browser
        $this->load->view('v_bimbinganmbkm', $data);
    }
}
