<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Skripsi_riset extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('M_skripsiriset');
        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        }
    }

    function index()
    {
        $this->load->library('breadcrumb');
        $this->breadcrumb->add('List', 'list/skripsi_riset')
            ->add('Skripsi Riset', 'list/skripsi_riset');
        $data = array(
            'thisContent'     => 'list/v_skripsiriset',
            'thisJs'        => 'list/js_skripsiriset',
        );
        $this->parser->parse('template/template', $data);
    }
    public function get_data()
    {
        $columns = array(
            0 => 'nama_mahasiswa',
            1 => 'tanggal_pengajuan',
            2 => 'skripsi_riset',
            3 => 'dokumen_pendukung'
        );

        $limit = $this->input->post('length');
        $start = $this->input->post('start');

        // Cek apakah 'order' dan 'dir' ada di POST
        $order = isset($this->input->post('order')[0]['column']) ? $columns[$this->input->post('order')[0]['column']] : $columns[0];
        $dir = isset($this->input->post('order')[0]['dir']) ? $this->input->post('order')[0]['dir'] : 'asc';

        $totalData = $this->M_skripsiriset->count_all_data();
        $totalFiltered = $totalData;

        // Cek apakah ada input 'search'
        if (empty($this->input->post('search')['value'])) {
            $mahasiswa = $this->M_skripsiriset->get_all_data($limit, $start, $order, $dir);
        } else {
            $search = isset($this->input->post('search')['value']) ? $this->input->post('search')['value'] : '';
            $mahasiswa =  $this->M_skripsiriset->search_data($limit, $start, $search, $order, $dir);
            $totalFiltered = $this->M_skripsiriset->count_filtered_data($search);
        }

        $data = array();
        if (!empty($mahasiswa)) {
            foreach ($mahasiswa as $mhs) {
                $nestedData['nama_mahasiswa'] = $mhs->nama_mahasiswa;
                $nestedData['tanggal_pengajuan'] = $mhs->tanggal_pengajuan;
                $nestedData['skripsi_riset'] = $mhs->skripsi_riset;
                $nestedData['dokumen_pendukung'] = $mhs->dokumen_pendukung;
                $nestedData['dokumen_pendukung'] = '<a href="' . base_url($mhs->dokumen_pendukung) . '" class="btn btn-success" target="_blank">Download</a>';
                $modalHtml = '<div class="modal fade" id="modalKonfirmasi' . $mhs->id . '" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalLabel">Konfirmasi Skripsi Riset</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="dosen_pembimbing_utama_' . $mhs->id . '">Dosen Pembimbing Utama:</label>
                                <select class="form-control" id="dosen_pembimbing_utama_' . $mhs->id . '" name="dosen_pembimbing_utama" required>
                                    <!-- Options will be added dynamically via Ajax -->
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="dosen_pembimbing_kedua_' . $mhs->id . '">Dosen Pembimbing Kedua:</label>
                                <select class="form-control" id="dosen_pembimbing_kedua_' . $mhs->id . '" name="dosen_pembimbing_kedua">
                                </select>
                            </div>';

                // Cek status_pengajuan
                if ($mhs->status_pengajuan == 'Menunggu') {
                    $modalHtml .= '<label for="status_' . $mhs->id . '">Status:</label>
                   <select name="status" class="form-control status-dropdown" data-id="' . $mhs->id . '">
                       <option value="Menunggu" ' . ($mhs->status_pengajuan == 'Menunggu' ? 'selected' : '') . '>Menunggu</option>
                       <option value="Diterima" ' . ($mhs->status_pengajuan == 'Diterima' ? 'selected' : '') . '>Diterima</option>
                       <option value="Ditolak" ' . ($mhs->status_pengajuan == 'Ditolak' ? 'selected' : '') . '>Ditolak</option>
                   </select>';
                } else {
                    $modalHtml .= '<div class="alert alert-info" role="alert">
                        Status Pengajuan: ' . $mhs->status_pengajuan . '
                   </div>';
                }

                $modalHtml .= '</div>
                        <div class="modal-footer">';
                if ($mhs->status_pengajuan == 'Menunggu') {
                    $modalHtml .= '<button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                   <button type="button" class="btn btn-success" id="modal-confirm-btn" onclick="confirmAction(' . $mhs->id . ')">Simpan</button>';
                }
                $modalHtml .= '</div>
                    </div>
                </div>
            </div>';


                if ($mhs->status_pengajuan == 'Menunggu') {
                    $nestedData['konfirmasi'] = '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalKonfirmasi' . $mhs->id . '">
                                Konfirmasi
                                </button>' . $modalHtml;
                } else {
                    $nestedData['konfirmasi'] = '<div class="alert alert-info" role="alert">
                                Status Pengajuan: ' . $mhs->status_pengajuan . '
                            </div>';
                }



                $data[] = $nestedData;
            }
        }

        $json_data = array(
            "draw"            => intval($this->input->post('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        );

        echo json_encode($json_data);
    }


    public function fetch_dosen_select2()
    {
        $dosen = $this->M_skripsiriset->get_all(); // Mengambil data dosen dari model

        $data = array();
        foreach ($dosen as $row) {
            $data[] = array(
                'id' => $row->nama,
                'text' => $row->nama
            );
        }

        echo json_encode($data); // Mengirim data dalam format JSON
    }
    public function update_status()
    {
        $id = $this->input->post('id');
        $status = $this->input->post('status');
        $dosen_pembimbing_utama = $this->input->post('dosen_pembimbing_utama');
        $dosen_pembimbing_kedua = $this->input->post('dosen_pembimbing_kedua');

        // Cek apakah data id dan status ada
        if (!$id || !$status) {
            echo json_encode(array('status' => false, 'message' => 'Invalid data.'));
            return;
        }

        // Persiapkan data untuk di-update
        $data_update = array(
            'dosen_pembimbing_utama' => $dosen_pembimbing_utama,
            'dosen_pembimbing_kedua' => $dosen_pembimbing_kedua,
            'status_pengajuan' => $status
        );

        // Update status di database
        $update = $this->M_skripsiriset->update_status($id, $data_update);

        if ($update) {
            // Jika update berhasil
            echo json_encode(array('status' => true, 'message' => 'Status berhasil diperbarui.'));
        } else {
            // Jika update gagal
            echo json_encode(array('status' => false, 'message' => 'Gagal memperbarui status.'));
        }
    }
}
