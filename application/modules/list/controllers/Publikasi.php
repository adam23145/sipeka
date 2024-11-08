<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

require_once APPPATH . 'libraries/ExcelTemplate/autoload.php'; // Jika tidak menggunakan framework
use PhpOffice\PhpSpreadsheet\IOFactory;

class Publikasi extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('M_publikasi');
		$this->load->model('M_global');

		// Cek login
		if (!$this->session->userdata('logged_in')) {
			redirect('login');
		}
	}

	// Halaman utama pengajuan publikasi
	function index()
	{
		$this->load->library('breadcrumb');
		$this->breadcrumb->add('List', 'list/data_publikasi')
			->add('Pengajuan Publikasi', 'list/data_publikasi');

		$data = array(
			'thisContent' => 'list/v_publikasi',
			'thisJs' => 'list/js_data_publikasi',
		);
		$this->parser->parse('template/template', $data);
	}

	function get_data()
	{
		$limit = $this->input->post('length');
		$start = $this->input->post('start');
		$search = $this->input->post('search')['value'];
		$status = $this->input->post('status'); // Status filter dari dropdown
		if (empty($status)) {
			$status = 'Menunggu';
		}

		$lvl   = $this->session->userdata['logged_in']['userlevel'];
		$username = $this->session->userdata['logged_in']['username'];
		if ($lvl == 'Koordinator Prodi') {
			if ($username == 'Koordinator Prodi HBS') {
				$jur = 'Hukum Bisnis Syariah';
			} else if ($username == 'Koordinator Prodi ES') {
				$jur = 'Ekonomi Syariah';
			}
		}

		$list = $this->M_publikasi->get_all($limit, $start, $search, $status, $jur);
		$totalData = $this->M_publikasi->count_all($jur);
		$totalFiltered = $this->M_publikasi->count_filtered($search, $status, $jur);

		$data = array();
		$no = $start + 1;
		foreach ($list as $item) {
			$row = array();
			$row[] = $no++;
			$row[] = $item->nim;
			$row[] = $item->nama_mahasiswa;
			$row[] = date('d-m-Y', strtotime($item->tanggal_pengajuan));
			$row[] = $item->judul_tugas_akhir;
			$row[] = $item->jenis_tugas_akhir;
			$row[] = $item->dosen_pembimbing_utama;
			$modalHtml = '<div class="modal fade" id="modalKonfirmasi' . $item->id . '" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
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
                                <label for="dosen_pembimbing_utama_' . $item->id . '">Dosen Pembimbing Utama:</label>
                                <select class="form-control" id="dosen_pembimbing_utama_' . $item->id . '" name="dosen_pembimbing_utama" required>
                                    <!-- Options will be added dynamically via Ajax -->
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="dosen_pembimbing_kedua_' . $item->id . '">Dosen Pembimbing Kedua:</label>
                                <select class="form-control" id="dosen_pembimbing_kedua_' . $item->id . '" name="dosen_pembimbing_kedua">
                                </select>
                            </div>';

			$modalHtml .= '</div>
                        <div class="modal-footer">';
			if ($item->status_pengajuan == 'Menunggu') {
				$modalHtml .= '<button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                   <button type="button" class="btn btn-success" id="modal-confirm-btn" onclick="confirmAction(' . $item->id . ')">Simpan</button>';
			}
			$modalHtml .= '</div>
                    </div>
                </div>
            </div>';
			$row[] = '<a href="' . base_url($item->dokumen_pendukung) . '" class="btn btn-success" target="_blank">Download</a>';

			if ($item->status_pengajuan == 'Menunggu'&& $item->dosen_pembimbing_utama == null) {
				$row[] = '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalKonfirmasi' . $item->id . '">
							Konfirmasi
							</button>' . $modalHtml;
			} else {
				$row[] = '<div class="alert alert-info" role="alert">
							Status Pengajuan: ' . $item->status_pengajuan . ' dosen konfirmasi
						</div>';
			}
			$data[] = $row;
		}

		// JSON response untuk DataTables
		$json_data = array(
			"draw" => intval($this->input->post('draw')),
			"recordsTotal" => intval($totalData),
			"recordsFiltered" => intval($totalFiltered),
			"data" => $data
		);

		echo json_encode($json_data);
	}

	public function update_status()
	{
		$id = $this->input->post('id');
		$dosen_pembimbing_utama = $this->input->post('dosen_pembimbing_utama');
		$dosen_pembimbing_kedua = $this->input->post('dosen_pembimbing_kedua');
		if (!$id) {
			echo json_encode(array('status' => false, 'message' => 'Invalid data.'));
			return;
		}

		$data_update = array(
			'dosen_pembimbing_utama' => $dosen_pembimbing_utama,
			'dosen_pembimbing_kedua' => $dosen_pembimbing_kedua,
		);
		$update = $this->M_publikasi->update_status($id, $data_update);

		if ($update) {
			echo json_encode(array('status' => true, 'message' => 'Status berhasil diperbarui.'));
		} else {
			echo json_encode(array('status' => false, 'message' => 'Gagal memperbarui status.'));
		}
	}
}
