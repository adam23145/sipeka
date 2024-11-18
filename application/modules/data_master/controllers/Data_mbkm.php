<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Data_mbkm extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_mbkm');
        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        }
    }

    /**
     * Menampilkan halaman utama Data MBKM
     */
    public function index()
    {
        $data = [
            'thisContent' => 'data_master/v_mbkm', // View utama
            'thisJs'      => 'data_master/js_mbkm', // File JS tambahan (opsional)
        ];

        // Gunakan template parser untuk memuat template utama
        $this->parser->parse('template/template', $data);
    }

    /**
     * Mengambil data untuk DataTables
     */
    public function fetch_data()
    {
        $searchValue = $this->input->post('search')['value']; // Pencarian
        $orderColumn = $this->input->post('order')[0]['column']; // Kolom untuk pengurutan
        $orderDir = $this->input->post('order')[0]['dir']; // Arah pengurutan
        $start = $this->input->post('start'); // Offset
        $length = $this->input->post('length'); // Limit

        // Ambil data dari model
        $dataMbkm = $this->M_mbkm->fetch_data($searchValue, $orderColumn, $orderDir, $start, $length);
        $totalRecords = $this->M_mbkm->count_all(); // Total data tanpa filter
        $totalFiltered = $this->M_mbkm->count_filtered($searchValue); // Total data setelah filter

        // Format data untuk DataTables
        $data = [];
        $no = $start + 1;
        foreach ($dataMbkm as $row) {
            $data[] = [
                $no++,
                $row->submission_code,
                $row->judul, // Judul
                $row->nim,
                $row->tanggal_pengajuan,
                $row->dosen_pembimbing,
                $row->posisi_berkas,
                $row->id, 
            ];
        }

        $output = [
            "draw" => intval($this->input->post('draw')),
            "recordsTotal" => $totalRecords,
            "recordsFiltered" => $totalFiltered,
            "data" => $data,
        ];

        // Kirim data dalam format JSON
        echo json_encode($output);
    }
    public function update_data()
    {
        $submission_code = $this->input->post('submission_code');
        $judul = $this->input->post('judul');

        $data = [
            'judul' => $judul,
        ];

        $this->M_mbkm->update($submission_code, $data);

        echo json_encode(['success' => true, 'message' => 'Data berhasil diperbarui']);
    }
}
