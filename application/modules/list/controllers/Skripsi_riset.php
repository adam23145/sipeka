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
    public function fetch_pengajuan()
    {
        $this->load->model('M_skripsiriset');

        // Pastikan 'start' dan 'draw' memiliki nilai default jika tidak ada di POST
        $start = isset($_POST['start']) ? $_POST['start'] : 0;
        $draw = isset($_POST['draw']) ? $_POST['draw'] : 1;

        $list = $this->M_skripsiriset->get_datatables();
        $data = array();
        $no = $start;

        foreach ($list as $pengajuan) {
            $no++;
            $row = array();
            $row[] = $pengajuan->nama_mahasiswa;
            $row[] = $pengajuan->nim;
            $row[] = $pengajuan->skripsi_riset;
            $row[] = '<span id="status-' . $pengajuan->id . '">' . $pengajuan->status_pengajuan . '</span>';

            // Dropdown status pengajuan
            $row[] = '<select name="status" class="form-control mt-2 status-dropdown" data-id="' . $pengajuan->id . '">
                        <option value="Menunggu" ' . ($pengajuan->status_pengajuan == 'Menunggu' ? 'selected' : '') . '>Menunggu</option>
                        <option value="Diterima" ' . ($pengajuan->status_pengajuan == 'Diterima' ? 'selected' : '') . '>Diterima</option>
                        <option value="Ditolak" ' . ($pengajuan->status_pengajuan == 'Ditolak' ? 'selected' : '') . '>Ditolak</option>
                      </select>
                      <button class="btn btn-primary mt-2 update-status" data-id="' . $pengajuan->id . '">Perbarui</button>';

            // Tombol download dokumen
            $row[] = '<a href="' . base_url($pengajuan->dokumen_pendukung) . '" class="btn btn-success" target="_blank">Download</a>';

            $data[] = $row;
        }

        // Output untuk DataTables
        $output = array(
            "draw" => $draw, // Menggunakan nilai default jika 'draw' tidak ada
            "recordsTotal" => $this->M_skripsiriset->count_all(),
            "recordsFiltered" => $this->M_skripsiriset->count_filtered(),
            "data" => $data,
        );

        echo json_encode($output);
    }
    public function update_status_ajax()
    {
        $id = $this->input->post('id');
        $status = $this->input->post('status');

        // Cek apakah data id dan status ada
        if (!$id || !$status) {
            echo json_encode(array('status' => false, 'message' => 'Invalid data.'));
            return;
        }

        // Persiapkan data untuk di-update
        $data_update = array(
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
