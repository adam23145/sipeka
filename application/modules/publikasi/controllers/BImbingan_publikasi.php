<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Bimbingan_publikasi extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('M_publikasi');
        $this->load->helper('url');
        $this->load->library('form_validation');
        $this->load->library('session');

        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        }
    }

    function index()
    {
        $this->breadcrumb->add('Bimbingan Publikasi', 'Bimbingan Publikasi');
        $data = array(
            'thisContent' => 'publikasi/v_bimbingan_publikasi',
            'thisJs'      => 'publikasi/js_bimbingan_publikasi',
        );
        $this->parser->parse('template/template', $data);
    }

    public function setIdBimbinganPublikasi()
    {
        $id = $this->input->post('id');
        $this->session->set_userdata('bimbingan_publikasi_id', $id);
    }

    public function getDataPublikasiRiset()
    {
        // Check if bimbingan_mbkm_id is set in the session
        $bimbingan_publikasi_id = $this->session->userdata('bimbingan_publikasi_id');
        if ($bimbingan_publikasi_id) {
            $data = $this->M_publikasi->getPublikasiRisetData($bimbingan_publikasi_id);

            if ($data) {
                echo json_encode($data);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Data not found']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'ID not set']);
        }
    }
    public function submit()
    {
        $id_publikasi = $this->input->post('id_bimbingan_form');

        $statusPengajuan = $this->M_publikasi->checkStatus($id_publikasi);

        if ($statusPengajuan == 'Revisi') {
            $response = [
                'success' => false,
                'message' => 'Data tidak dapat disimpan karena status pengajuan masih dalam tahap revisi. Mohon konfirmasi kepada mahasiswa.'
            ];
            echo json_encode($response);
            return;
        } else if ($statusPengajuan == 'Acc') {
            $response = [
                'success' => false,
                'message' => 'Mahasiswa telah menyelesaikan proses bimbingan. Tidak ada data yang perlu disimpan.'
            ];
            echo json_encode($response);
            return;
        }

        $data = [
            'id_publikasi' => $id_publikasi,
            'tanggal' => $this->input->post('tanggal'),
            'status' => $this->input->post('sub_status'),
            'revisi' => $this->input->post('keterangan')
        ];

        if (strtoupper($this->input->post('sub_status')) == 'ACC') {
            $countBimbingan = $this->M_publikasi->countBimbingan($id_publikasi);
            if ($countBimbingan >= 8 || $countBimbingan == null || $countBimbingan == "") {
                $response = [
                    'success' => false,
                    'message' => 'Data tidak dapat disimpan karena belum mencapai 8 bimbingan.'
                ];
                echo json_encode($response);
                return;
            }
        }


        $isSaved = $this->M_publikasi->saveBimbingan($data);

        if ($isSaved) {
            if (strtoupper($this->input->post('sub_status')) == 'ACC') {
                $isUpdated = $this->M_publikasi->updateStatus($id_publikasi, 'Acc');
            } else {
                $isUpdated = $this->M_publikasi->updateStatus($id_publikasi, 'Revisi');
            }

            if ($isUpdated) {
                $response = [
                    'success' => true,
                    'message' => 'Data berhasil disimpan'
                ];
            } else {
                $response = [
                    'success' => false,
                    'message' => 'Data berhasil disimpan, tetapi gagal memperbarui status.'
                ];
            }
        } else {
            $response = [
                'success' => false,
                'message' => 'Gagal menyimpan data.'
            ];
        }

        echo json_encode($response);
    }

    public function getLogBimbingan()
    {
        $id_bimbingan_form = $this->session->userdata('bimbingan_publikasi_id');
        if (!$id_bimbingan_form) {
            echo json_encode([]);
            return;
        }
        $data = $this->M_publikasi->getLogBimbingan($id_bimbingan_form);

        echo json_encode($data);
    }
}
