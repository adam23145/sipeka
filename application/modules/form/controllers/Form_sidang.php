<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class form_sidang extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_sidang');
        $this->load->model('M_detail');
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
        $submission_details = $this->M_global->get_submission_details_by_nim($nim);
        $publikasi_details = $this->M_global->get_submission_details_by_nim_and_acc($nim);

        // Cek apakah data pertama ada dan tidak kosong
        if (!empty($submission_details) && isset($submission_details['title'])) {
            $title = $submission_details['title'];
            $submission_code = $submission_details['submission_code'];
        } else if (!empty($publikasi_details) && isset($publikasi_details['judul_tugas_akhir'])) {
            $title = $publikasi_details['judul_tugas_akhir'];
            $submission_code = '';
        } else {
            $title = '';
            $submission_code = '';
        }

        // Ambil detail pengajuan jika ada
        $title_sub = $this->M_detail->get_sub($submission_code);

        // Cek apakah data title_sub ada dan tidak kosong
        if (!empty($title_sub) && isset($title_sub[0]['dosbing'])) {
            $dosbing = $title_sub[0]['dosbing'];
            $dosen_p = $this->M_detail->get_nama_dosen($dosbing);
        } else {
            $dosbing = '';
            $dosen_p = '';  // Atur ini sesuai kebutuhan Anda
        }

        $data = array(
            'thisContent' => 'form/v_sidang',
            'thisJs' => 'form/js_sidang',
            'subm_id' => $subm_id,
            'majorname' => $major_name[0]['jurusan'],
            'csrf_token_name' => $this->security->get_csrf_token_name(),
            'csrf_token_hash' => $this->security->get_csrf_hash(),
            'judul' => $title,
            'submission_code' => $submission_code,
            'dosbing' => $dosbing,
            'dosen_p' => $dosen_p
        );

        $this->parser->parse('template/template', $data);
    }


    public function submit()
    {
        $subm_id = $this->input->post('subm_id');
        $submission_code = $this->input->post('submission_code');
        $nim = substr($this->session->userdata('logged_in')['userid'], 0, 12);
        $existing_submission = $this->M_sidang->check_existing_submission_by_nim($nim);

        // Cek apakah submission_code ada di log_bimbingan_skripsi dan status_bimb == 'Setuju Sidang'
        if ($submission_code) {
            $is_submission_approved = $this->M_sidang->check_submission_approval($submission_code);
        }else{
            $is_submission_approved = true;   
        }

        if ($is_submission_approved) {
            if ($existing_submission) {
                if ($existing_submission['status'] == 1) {
                    $response = array('status' => 'error', 'message' => 'Pengajuan Anda masih menunggu proses.');
                } elseif ($existing_submission['status'] == 0) {
                    $data = array(
                        'judul_sidang' => $this->input->post('judul_sidang'),
                        'subm_id' => $subm_id,
                        'nim' => $nim,
                        'status' => 1,
                        'nama_mahasiswa' => $this->input->post('nama_mahasiswa')
                    );

                    if ($this->M_sidang->simpan_pengajuan($data)) {
                        $response = array('status' => 'success', 'message' => 'Pengajuan Sidang Anda Telah Dikirim!');
                    } else {
                        $response = array('status' => 'error', 'message' => 'Gagal menyimpan pengajuan.');
                    }
                } elseif ($existing_submission['status'] == 2) {
                    $response = array('status' => 'error', 'message' => 'Pengajuan sebelumnya sudah diterima. Tidak bisa mengajukan lagi.');
                }
            } else {
                $data = array(
                    'judul_sidang' => $this->input->post('judul_sidang'),
                    'subm_id' => $subm_id,
                    'nim' => $nim,
                    'status' => 1,
                    'nama_mahasiswa' => $this->input->post('nama_mahasiswa')
                );

                if ($this->M_sidang->simpan_pengajuan($data)) {
                    $response = array('status' => 'success', 'message' => 'Pengajuan Sidang Anda Telah Dikirim!');
                } else {
                    $response = array('status' => 'error', 'message' => 'Gagal menyimpan pengajuan.');
                }
            }
        } else {
            $response = array('status' => 'error', 'message' => 'Submission code tidak valid atau belum disetujui untuk Sidang.');
        }

        echo json_encode($response);
    }
}
