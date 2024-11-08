<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Sempro_mbkm extends CI_Controller
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
        $this->load->library('breadcrumb');
        $this->breadcrumb->add('List', 'list/mbkm')
            ->add('Skripsi Riset', 'list/mbkm');
        $data = array(
            'thisContent'     => 'list/v_mbkm',
            'thisJs'        => 'list/js_mbkm',
        );
        $this->parser->parse('template/template', $data);
    }
    public function get_data()
    {
        $columns = array(
            0 => 'nim', // Tambahkan NIM
            1 => 'nama_mahasiswa',
            2 => 'tanggal_pengajuan',
            3 => 'mbkm',
            4 => 'dokumen_pendukung'
        );

        $lvl   = $this->session->userdata['logged_in']['userlevel'];
        $username         = $this->session->userdata['logged_in']['username'];
        if ($lvl == 'Koordinator Prodi') {
            if ($username == 'Koordinator Prodi HBS') {
                $jur = 'Hukum Bisnis Syariah';
            } else if ($username == 'Koordinator Prodi ES') {
                $jur = 'Ekonomi Syariah';
            }
        }
        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $konfirmasi_status = $this->input->post('konfirmasi_status');

        $order = isset($this->input->post('order')[0]['column']) ? $columns[$this->input->post('order')[0]['column']] : $columns[0];
        $dir = isset($this->input->post('order')[0]['dir']) ? $this->input->post('order')[0]['dir'] : 'asc';

        $totalData = $this->M_mbkm->count_all_data($jur,$konfirmasi_status);
        $totalFiltered = $totalData;

        // Cek apakah ada input 'search'
        if (empty($this->input->post('search')['value'])) {
            $mahasiswa = $this->M_mbkm->get_all_data($limit, $start, $order, $dir, $jur,$konfirmasi_status);
        } else {
            $search = isset($this->input->post('search')['value']) ? $this->input->post('search')['value'] : '';
            $mahasiswa =  $this->M_mbkm->search_data($limit, $start, $search, $order, $dir, $jur,$konfirmasi_status);
            $totalFiltered = $this->M_mbkm->count_filtered_data($search, $jur,$konfirmasi_status);
        }

        $data = array();
        if (!empty($mahasiswa)) {
            foreach ($mahasiswa as $mhs) {
                $nestedData['nim'] = strtoupper($mhs->nim); // NIM Uppercase
                $nestedData['nama_mahasiswa'] = $mhs->nama_mahasiswa;
                $nestedData['tanggal_pengajuan'] = $mhs->tanggal_pengajuan;
                $nestedData['mbkm'] = $mhs->mbkm;
                $nestedData['dosen'] = $mhs->dosen_pembimbing_utama;
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


                if ($mhs->status_pengajuan == 'Menunggu' && $mhs->dosen_pembimbing_utama == null) {
                    $nestedData['konfirmasi'] = '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalKonfirmasi' . $mhs->id . '">
                                Konfirmasi
                                </button>' . $modalHtml;
                } else {
                    $nestedData['konfirmasi'] = '<div class="alert alert-info" role="alert">
                                Status Pengajuan: ' . $mhs->status_pengajuan . ' dosen konfirmasi
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
        $search = $this->input->get('search'); // Get the search term from the request
        $dosen = $this->M_mbkm->get_all($search); // Pass the search term to the model

        $data = array();
        foreach ($dosen as $row) {
            $data[] = array(
                'id' => $row->nama,
                'text' => $row->nama
            );
        }

        echo json_encode($data); // Send data in JSON format
    }

    public function update_status()
    {
        $id = $this->input->post('id');
        $dosen_pembimbing_utama = $this->input->post('dosen_pembimbing_utama');
        $dosen_pembimbing_kedua = $this->input->post('dosen_pembimbing_kedua');

        // Cek apakah data id dan status ada
        if (!$id) {
            echo json_encode(array('status' => false, 'message' => 'Invalid data.'));
            return;
        }

        // Persiapkan data untuk di-update
        $data_update = array(
            'dosen_pembimbing_utama' => $dosen_pembimbing_utama,
            'dosen_pembimbing_kedua' => $dosen_pembimbing_kedua,
        );

        // Update status di database
        $update = $this->M_mbkm->update_status($id, $data_update);

        if ($update) {
            // Jika update berhasil
            echo json_encode(array('status' => true, 'message' => 'Status berhasil diperbarui.'));
        } else {
            // Jika update gagal
            echo json_encode(array('status' => false, 'message' => 'Gagal memperbarui status.'));
        }
    }
}
