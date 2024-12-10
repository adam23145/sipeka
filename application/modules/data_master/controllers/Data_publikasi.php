<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Data_publikasi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_publikasi');
        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        }
    }

    public function index()
    {
        $data = [
            'thisContent' => 'data_master/v_publikasi',
            'thisJs'      => 'data_master/js_publikasi',
        ];
        $this->parser->parse('template/template', $data);
    }

    public function fetch_data()
    {
        $searchValue = $this->input->post('search')['value'];
        $orderColumn = $this->input->post('order')[0]['column'];
        $orderDir = $this->input->post('order')[0]['dir'];
        $start = $this->input->post('start');
        $length = $this->input->post('length');
        $lvl   = $this->session->userdata['logged_in']['userlevel'];
		$username 		= $this->session->userdata['logged_in']['username'];
		if ($lvl == 'Admin Prodi') {
			if ($username == 'Admin Prodi HBS') {
				$jur = 'Hukum Bisnis Syariah';
			} else if ($username == 'Admin Prodi ES') {
				$jur = 'Ekonomi Syariah';
			}
		}
        $dataPublikasi = $this->M_publikasi->fetch_data($searchValue, $orderColumn, $orderDir, $start, $length,$jur );
        $totalRecords = $this->M_publikasi->count_all();
        $totalFiltered = $this->M_publikasi->count_filtered($searchValue,$jur);

        $data = [];
        $no = $start + 1;
        foreach ($dataPublikasi as $row) {
            $data[] = [
                $no++,
                $row->judul_tugas_akhir,
                $row->nim,
                $row->prodi,
                $row->tanggal_pengajuan,
                $row->dosen_pembimbing_utama,
                $row->id,
            ];
        }

        $output = [
            "draw" => intval($this->input->post('draw')),
            "recordsTotal" => $totalRecords,
            "recordsFiltered" => $totalFiltered,
            "data" => $data,
            "csrfHash" => $this->security->get_csrf_hash(), // Perbarui CSRF Hash
        ];

        echo json_encode($output);
    }
    public function fetch_dosen_select2()
    {
        $search = $this->input->get('search'); 
        $dosen = $this->M_publikasi->get_all_dosen($search);
    
        $data = array();
        foreach ($dosen as $row) {
            $data[] = array(
                'id' => $row->nama,  // Pastikan id adalah NIP, bukan nama
                'text' => $row->nama
            );
        }
    
        echo json_encode($data); // Kirim data dalam format JSON
    }
    

    public function update_data()
    {
        $id = $this->input->post('id');
        $judul = $this->input->post('judul');
        $dosen_pembimbing = $this->input->post('dosen_pembimbing');

        $data = [
            'judul_tugas_akhir' => $judul,
            'dosen_pembimbing_utama' => $dosen_pembimbing,
        ];

        $this->M_publikasi->update($id, $data);

        echo json_encode(['success' => true, 'message' => 'Data berhasil diperbarui']);
    }
}
