<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Berita_acara_sempro extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('data_pdf/M_beritaacarasempro');
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
        $subcode = base64_decode($this->input->get('subcd'));
        $userid = substr($this->session->userdata['logged_in']['userid'], 0, 12);
        $data_det = $this->M_beritaacarasempro->getdatapdf($subcode, $userid);
        $koordinator = $this->M_koorprodi->get_koordinator_by_major_name($data_det[0]['prodi']);

        if ($koordinator) {
            $namakoor = $koordinator['namakoor'];
            $nipkoor = $koordinator['nipkoor'];
        } else {
            $namakoor = 'Tidak ditemukan';
            $nipkoor = 'Tidak ditemukan';
        }

        $data = array(
            'nim'           => $data_det[0]['nim'],
            'student_name'  => $data_det[0]['nama_mahasiswa'],
            'jurusan'       => $data_det[0]['prodi'],
            'title'         => $data_det[0]['judul'],
            'dosbing'       => $data_det[0]['dosen_pembimbing'],
            'nama'          => $data_det[0]['nama'],
            'subcode'       => $subcode,
            'namakoor'      => $namakoor,
            'namakoor'      => $namakoor,
            'nipkoor'       => $nipkoor,
            'pembahas' => isset($data_det[0]['nama']) ? $data_det[0]['nama'] : 'N/A',
            'nip_pembahas' => isset($data_det[0]['dosen_pembimbing']) ? $data_det[0]['dosen_pembimbing'] : 'N/A',
            'tanggal_sempro' => $data_det[0]['tanggal_pengajuan'],
        );

        $this->load->view('v_beritaacarasempro', $data);
    }
}
