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
            // Check status_pengajuan for conditional buttons
            if ($item->status_pengajuan == 'Revisi') {
                $row['status_pengajuan'] = '<button class="btn btn-warning btn-revisi" data-toggle="modal" data-target="#modalRevisi" data-id="' . $item->id . '">Lihat Revisi</button>';
            } else {
                if ($item->dosen_pembimbing_utama !== null) {
                    $row['status_pengajuan'] = 'Menunggu Konfirmasi Dosen';
                } else {
                    $row['status_pengajuan'] = $item->status_pengajuan !== null ? $item->status_pengajuan : '-';
                }
            }
            // if ($item->dokumen_pendukung !== null) {
            //     $row['dokumen_pendukung'] = '
            //         <a href="' . base_url($item->dokumen_pendukung) . '" class="btn btn-primary" target="_blank" style="padding: 10px 20px; margin: 5px;">Sempro Data</a>
            //         <a href="' . base_url($item->dokumen_pendukung) . '" class="btn btn-secondary" target="_blank" style="padding: 10px 20px;margin: 5px;">Form Persetujuan Dosen Pembimbing</a>';
            // } else {
            //     $row['dokumen_pendukung'] = '-';
            // }
            if ($item->dokumen_pendukung !== null && $item->dosen_pembimbing_utama !== null) {
                // Menyusun URL dengan parameter subcd
                $subcd = base64_encode($item->submission_code); // Misalnya jika submission_code perlu dienkode
                $row['dokumen_pendukung'] = '
                    <a href="' . base_url('data_pdf/Sempro_mbkm/index?subcd=' . $subcd) . '" class="btn btn-primary" target="_blank" style="padding: 10px 20px;margin: 5px;">Form Persetujuan Dosen Pembimbing</a>';
            } else {
                $row['dokumen_pendukung'] = '-';
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

        // Function to handle file uploads
        function handleFileUpload($fileInput, $fileNamePrefix, $currentFilePath, $directory)
        {
            $allowed = ['doc', 'docx', 'ppt', 'pptx', 'pdf'];
            $file_name = $_FILES[$fileInput]["name"];
            $file_tmp_name = $_FILES[$fileInput]["tmp_name"];
            $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
            $file_name_new = $fileNamePrefix . '-' . $file_name;
            $file_upload = $directory . "/" . $file_name_new;

            // Validate file extension
            if (!in_array($file_ext, $allowed)) {
                return ['status' => false, 'message' => 'Format file tidak didukung. Harap unggah file dengan format .doc, .docx, .ppt, .pptx, atau .pdf.'];
            }

            // Remove old file if it exists
            if (!empty($currentFilePath) && file_exists('./' . $currentFilePath)) {
                unlink('./' . $currentFilePath);
            }

            // Move new file
            if (move_uploaded_file($file_tmp_name, $file_upload)) {
                return ['status' => true, 'file_path' => $file_upload];
            } else {
                return ['status' => false, 'message' => 'Gagal mengunggah file. Silakan coba lagi.'];
            }
        }

        $userid = $this->session->userdata['logged_in']['userid'];
        $directory = './document/filembkm/' . $userid;
        $file_pth = 'document/filembkm/' . $userid . '/';

        // Create directory if it doesn't exist
        if (!is_dir($directory)) {
            mkdir($directory, 0755, true);
        }

        // Process dokumen_pendukung
        if (!empty($_FILES["dokumen_pendukung"]["name"])) {
            $result = handleFileUpload("dokumen_pendukung", "mbkm", $currentData->dokumen_pendukung, $directory);
            if ($result['status']) {
                $updateData['dokumen_pendukung'] = $file_pth . basename($result['file_path']);
            } else {
                echo json_encode(['status' => false, 'message' => $result['message'], 'csrf_hash' => $this->security->get_csrf_hash()]);
                return;
            }
        }

        // Process dokumen_pendukung2
        if (!empty($_FILES["dokumen_pendukung2"]["name"])) {
            $result = handleFileUpload("dokumen_pendukung2", "mbkmpenilaian", $currentData->dokumen_pendukung2, $directory);
            if ($result['status']) {
                $updateData['dokumen_pendukung2'] = $file_pth . basename($result['file_path']);
            } else {
                echo json_encode(['status' => false, 'message' => $result['message'], 'csrf_hash' => $this->security->get_csrf_hash()]);
                return;
            }
        }

        // Update database if there are changes
        if (!empty($updateData)) {
            $result = $this->M_mbkm->update_revisi($id, $updateData);
            $response = $result ? ['status' => 'success', 'message' => 'Revisi berhasil diperbarui.'] : ['status' => 'error', 'message' => 'Gagal memperbarui revisi.'];
        } else {
            $response = ['status' => 'info', 'message' => 'Tidak ada perubahan untuk diperbarui.'];
        }

        echo json_encode($response);
    }
}
