<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class form_sidang extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_sidang');
        $this->load->helper('string');
        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        }
    }

    public function index()
    {
        $this->breadcrumb->add('Form', 'form/form_sidang')
            ->add('Pengajuan Sidang', 'form/form_sidang');
        $majorcode = substr($this->session->userdata('logged_in')['userid'], 4, 3);
        $nim = substr($this->session->userdata('logged_in')['userid'], 0, 12);
        $token = random_string('numeric', 3);
        $subm_id = 'FKIS1605-' . $majorcode . $token . date("dhs");
        $major_name = $this->M_global->get_jurusan2($nim);
        $submission = $this->M_global->get_submission_code_by_nim($nim);

        $data = array(
            'thisContent' => 'form/v_sidang',
            'thisJs' => 'form/js_sidang',
            'subm_id' => $subm_id,
            'majorname' => $major_name[0]['jurusan'],
            'csrf_token_name' => $this->security->get_csrf_token_name(),
            'csrf_token_hash' => $this->security->get_csrf_hash(),
            'judul' => isset($submission['title']) ? $submission['title'] : ''
        );
        $this->parser->parse('template/template', $data);
    }

    public function submit()
    {
        $subm_id = $this->input->post('subm_id');
        $nim = substr($this->session->userdata('logged_in')['userid'], 0, 12); // Ambil NIM dari session

        // Cek apakah sudah ada pengajuan dengan NIM yang sama
        $existing_submission = $this->M_sidang->check_existing_submission_by_nim($nim);

        if ($existing_submission) {
            // Jika status pengajuan sebelumnya adalah 'Menunggu' (status = 1)
            if ($existing_submission['status'] == 1) {
                $response = array('status' => 'error', 'message' => 'Pengajuan Anda masih menunggu proses.');
            } elseif ($existing_submission['status'] == 0) {
                // Jika pengajuan sebelumnya ditolak, simpan pengajuan baru
                $data = array(
                    'judul_sidang' => $this->input->post('judul_sidang'),
                    'subm_id' => $subm_id,
                    'nim' => $nim,
                    'status' => 1, // Status baru adalah 'Menunggu'
                    'nama_mahasiswa' => $this->input->post('nama_mahasiswa')
                );

                if ($this->M_sidang->simpan_pengajuan($data)) {
                    $response = array('status' => 'success', 'message' => 'Pengajuan Sidang Anda Telah Dikirim!');
                } else {
                    $response = array('status' => 'error', 'message' => 'Gagal menyimpan pengajuan.');
                }
            } elseif ($existing_submission['status'] == 2) {
                // Jika pengajuan sebelumnya diterima
                $response = array('status' => 'error', 'message' => 'Pengajuan sebelumnya sudah diterima. Tidak bisa mengajukan lagi.');
            }
        } else {
            // Jika tidak ada pengajuan sebelumnya, simpan pengajuan baru
            $data = array(
                'judul_sidang' => $this->input->post('judul_sidang'),
                'subm_id' => $subm_id,
                'nim' => $nim,
                'status' => 1, // Status baru adalah 'Menunggu'
                'nama_mahasiswa' => $this->input->post('nama_mahasiswa')
            );

            if ($this->M_sidang->simpan_pengajuan($data)) {
                $response = array('status' => 'success', 'message' => 'Pengajuan Sidang Anda Telah Dikirim!');
            } else {
                $response = array('status' => 'error', 'message' => 'Gagal menyimpan pengajuan.');
            }
        }

        echo json_encode($response);
    }
}
