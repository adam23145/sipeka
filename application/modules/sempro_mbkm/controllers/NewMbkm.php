<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

require_once APPPATH . 'libraries/ExcelTemplate/autoload.php'; // Jika tidak menggunakan framework
use PhpOffice\PhpSpreadsheet\IOFactory;

class NewMbkm extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('M_newmbkm');
		$this->load->model('M_global');

		// Cek login
		if (!$this->session->userdata('logged_in')) {
			redirect('login');
		}
	}

	function index()
    {
        $this->breadcrumb->add('Data Mbkm', 'Mbkm');
        $data = array(
            'thisContent'     => 'sempro_mbkm/v_new_mbkm',
            'thisJs'        => 'sempro_mbkm/js_new_mbkm',
        );
        $this->parser->parse('template/template', $data);
    }
	function get_data()
	{
		$limit = $this->input->post('length');
		$start = $this->input->post('start');
		$search = $this->input->post('search')['value'];
		$status = $this->input->post('status'); 
		if (empty($status)) {
			$status = 'Menunggu';
		}

		$username = $this->session->userdata['logged_in']['username'];
		$list = $this->M_newmbkm->get_all($limit, $start, $search, $status,$username);
		$totalData = $this->M_newmbkm->count_all($username);
		$totalFiltered = $this->M_newmbkm->count_filtered($search, $status,$username);

		$data = array();
		$no = $start + 1;
		foreach ($list as $item) {
			$row = array();
			$row[] = $no++;
			$row[] = $item->nim;
			$row[] = $item->nama_mahasiswa;
			$row[] = date('d-m-Y', strtotime($item->tanggal_pengajuan));
			$row[] = $item->mbkm;
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
                        <div class="modal-body">';

			if ($item->status_pengajuan == 'Menunggu') {
				$modalHtml .= '<label for="status_' . $item->id . '">Status:</label>
                   <select name="status" class="form-control status-dropdown" data-id="' . $item->id . '">
                       <option value="Diproses" ' . ($item->status_pengajuan == 'Diproses' ? 'selected' : '') . '>Diterima</option>
                       <option value="Ditolak" ' . ($item->status_pengajuan == 'Ditolak' ? 'selected' : '') . '>Ditolak</option>
                   </select>';
			} else {
				$modalHtml .= '<div class="alert alert-info" role="alert">
                        Status Pengajuan: ' . $item->status_pengajuan . '
                   </div>';
			}

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

			if ($item->status_pengajuan == 'Menunggu') {
				$row[] = '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalKonfirmasi' . $item->id . '">
							Konfirmasi
							</button>' . $modalHtml;
			} else {
				$row[] = '<div class="alert alert-info" role="alert">
							Status Pengajuan: ' . $item->status_pengajuan . '
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
		$status = $this->input->post('status');
		if (!$id || !$status) {
			echo json_encode(array('status' => false, 'message' => 'Invalid data.'));
			return;
		}
		$data_update = array(
			'status_pengajuan' => $status
		);
		$update = $this->M_newmbkm->update_status($id, $data_update);

		if ($update) {
			echo json_encode(array('status' => true, 'message' => 'Status berhasil diperbarui.'));
		} else {
			echo json_encode(array('status' => false, 'message' => 'Gagal memperbarui status.'));
		}
	}
}
