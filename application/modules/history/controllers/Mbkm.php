<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Mbkm extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('M_mbkm');
        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        }
    }

    function index()
    {
        $this->breadcrumb->add('History', 'history/mbkm');
        $data = array(
            'thisContent'     => 'history/v_mbkm',
            'thisJs'        => 'history/js_mbkm',
        );
        $this->parser->parse('template/template', $data);
    }
    public function get_data()
    {
        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $search = $this->input->post('search')['value'];

        $list = $this->M_mbkm->get_all($limit, $start, $search);
        $totalData = $this->M_mbkm->count_all();
        $totalFiltered = $this->M_mbkm->count_filtered($search);

        $data = array();
        foreach ($list as $item) {
            $row = array();
            $row['mbkm'] = $item->mbkm !== null ? $item->mbkm : '-';
            $row['nama_mahasiswa'] = $item->nama_mahasiswa !== null ? $item->nama_mahasiswa : '-';
            $row['nim'] = $item->nim !== null ? $item->nim : '-';
            $row['tanggal_pengajuan'] = $item->tanggal_pengajuan !== null ? $item->tanggal_pengajuan : '-';
            $row['pembimbing_1'] = $item->dosen_pembimbing_utama !== null ? $item->dosen_pembimbing_utama : '-';
            $row['pembimbing_2'] = $item->dosen_pembimbing_kedua !== null ? $item->dosen_pembimbing_kedua : '-';
            if ($item->status_pengajuan == 'Revisi') {
                $row['status_pengajuan'] = '<button class="btn btn-warning btn-revisi" data-toggle="modal" data-target="#modalRevisi" data-id="' . $item->id . '">Lihat Revisi</button>';
            } else {
                $row['status_pengajuan'] = $item->status_pengajuan !== null ? $item->status_pengajuan : '-';
            }

            $data[] = $row;
        }


        $json_data = array(
            "draw" => intval($this->input->post('draw')),
            "recordsTotal" => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $data
        );

        echo json_encode($json_data);
    }
    public function get_revisi()
    {
        $id = $this->input->post('id');
        $revisi = $this->M_mbkm->get_revisi_by_id($id);

        if ($revisi) {
            echo json_encode(array(
                'status' => 'success',
                'message' => 'Data revisi berhasil dimuat.',
                'data' => $revisi // Anda bisa mengirimkan data ini jika perlu
            ));
        } else {
            echo json_encode(array(
                'status' => 'error',
                'message' => 'Data revisi tidak ditemukan.'
            ));
        }
    }
    public function update_revisi()
    {
        $id = $this->input->post('id');
        $judulRevisi = $this->input->post('judulRevisi');

        $currentData = $this->M_mbkm->get_revisi_by_id($id);

        $updateData = [];

        // Update judul revisi jika ada perubahan
        if (!empty($judulRevisi) && $judulRevisi !== $currentData->mbkm) {
            $updateData['mbkm'] = $judulRevisi;
        }

        // Handle uploaded document file
        if (!empty($_FILES["dokumen_pendukung"]["name"])) {
            $userid = $this->session->userdata['logged_in']['userid'];
            $directory = './document/filembkm/' . $userid;
            $file_pth = 'document/filembkm/' . $userid . '/';

            // Buat direktori jika belum ada
            if (!is_dir($directory)) {
                mkdir($directory, 0755, true);
            }

            $allowed = ['doc', 'docx', 'ppt', 'pptx', 'pdf'];

            $file_name = $_FILES["dokumen_pendukung"]["name"];
            $file_tmp_name = $_FILES["dokumen_pendukung"]["tmp_name"];
            $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
            $file_name_new = 'mbkm-' . $file_name;
            $file_upload = $directory . "/" . $file_name_new;

            // Hapus file lama jika ada
            if (!empty($currentData->dokumen_pendukung)) {
                $oldFilePath = './' . $currentData->dokumen_pendukung; // Ambil path file lama
                if (file_exists($oldFilePath)) {
                    unlink($oldFilePath); // Hapus file lama
                }
            }

            // Validasi ekstensi file
            if (!in_array($file_ext, $allowed)) {
                $response = [
                    'status' => false,
                    'message' => 'Format file tidak didukung. Harap unggah file dengan format .doc, .docx, .ppt, .pptx, atau .pdf.',
                    'csrf_hash' => $this->security->get_csrf_hash()
                ];
                echo json_encode($response);
                return;
            }

            // Pindahkan file yang diunggah
            if (move_uploaded_file($file_tmp_name, $file_upload)) {
                $updateData['dokumen_pendukung'] = $file_pth . $file_name_new; // Simpan path file yang baru
            } else {
                $response = [
                    'status' => false,
                    'message' => 'Gagal mengunggah file. Silakan coba lagi.',
                    'csrf_hash' => $this->security->get_csrf_hash()
                ];
                echo json_encode($response);
                return;
            }
        }

        // Update database jika ada data yang diubah
        if (!empty($updateData)) {
            $result = $this->M_mbkm->update_revisi($id, $updateData);

            if ($result) {
                $response = [
                    'status' => 'success',
                    'message' => 'Revisi berhasil diperbarui.'
                ];
            } else {
                $response = [
                    'status' => 'error',
                    'message' => 'Gagal memperbarui revisi.'
                ];
            }
        } else {
            $response = [
                'status' => 'info',
                'message' => 'Tidak ada perubahan untuk diperbarui.'
            ];
        }

        echo json_encode($response);
    }
}
