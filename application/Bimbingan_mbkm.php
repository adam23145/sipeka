<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Bimbingan_mbkm extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('M_mbkm');
        $this->load->helper('url');
        $this->load->library('form_validation');
        $this->load->library('session');

        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        }
    }

    function index()
    {
        $this->breadcrumb->add('Bimbingan Mbkm', 'Bimbingan Mbkm');
        $data = array(
            'thisContent' => 'publikasi/v_bimbingan_mbkm',
            'thisJs'      => 'publikasi/js_bimbingan_mbkm',
        );
        $this->parser->parse('template/template', $data);
    }

    public function setIdBimbinganMbkm()
    {
        $id = $this->input->post('id');
        $this->session->set_userdata('bimbingan_mbkm_id', $id);
    }

    public function getDataMbkmRiset()
    {
        // Check if bimbingan_mbkm_id is set in the session
        $bimbingan_mbkm_id = $this->session->userdata('bimbingan_mbkm_id');
        if ($bimbingan_mbkm_id) {
            $data = $this->M_mbkm->getMbkmRisetData($bimbingan_mbkm_id);

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
        $id_mbkm = $this->input->post('id_bimbingan_form');

        $statusPengajuan = $this->M_mbkm->checkStatus($id_mbkm);

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
            'id_mbkm' => $id_mbkm,
            'tanggal' => $this->input->post('tanggal'),
            'status' => $this->input->post('sub_status'),
            'revisi' => $this->input->post('keterangan')
        ];

        $isSaved = $this->M_mbkm->saveBimbingan($data);

        if ($isSaved) {
            if($this->input->post('sub_status') == 'Acc'){
                $isUpdated = $this->M_mbkm->updateStatus($id_mbkm, 'Acc');
            }else{
                $isUpdated = $this->M_mbkm->updateStatus($id_mbkm, 'Revisi');
            }

            if ($isUpdated) {
                $response = [
                    'success' => true,
                    'message' => 'Data berhasil disimpan dan status diperbarui menjadi Revisi.'
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
        $id_bimbingan_form = $this->session->userdata('bimbingan_mbkm_id');
        if (!$id_bimbingan_form) {
            echo json_encode([]);
            return;
        }
        $data = $this->M_mbkm->getLogBimbingan($id_bimbingan_form);

        echo json_encode($data);
    }
}
