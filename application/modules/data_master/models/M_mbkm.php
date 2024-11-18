<?php
class M_mbkm extends CI_Model
{
    private $table = 'mbkm_riset'; // Nama tabel di database

    /**
     * Mengambil data dengan filter, pagination, dan sorting
     */
    public function fetch_data($searchValue, $orderColumn, $orderDir, $start, $length)
    {
        // Kolom untuk pengurutan (sesuaikan indeks dengan kolom tabel)
        $columns = ['submission_code', 'nim', 'tanggal_pengajuan', 'dosen_pembimbing', 'posisi_berkas'];

        $this->db->select('*')->from($this->table);

        // Filter pencarian
        if (!empty($searchValue)) {
            $this->db->group_start()
                ->like('submission_code', $searchValue)
                ->or_like('nim', $searchValue)
                ->or_like('tanggal_pengajuan', $searchValue)
                ->or_like('dosen_pembimbing', $searchValue)
                ->or_like('posisi_berkas', $searchValue)
                ->group_end();
        }

        // Sorting
        if (isset($columns[$orderColumn])) {
            $this->db->order_by($columns[$orderColumn], $orderDir);
        }

        // Pagination
        $this->db->limit($length, $start);

        return $this->db->get()->result();
    }

    /**
     * Menghitung total data tanpa filter
     */
    public function count_all()
    {
        return $this->db->count_all($this->table);
    }

    /**
     * Menghitung total data setelah filter
     */
    public function count_filtered($searchValue)
    {
        $this->db->from($this->table);

        if (!empty($searchValue)) {
            $this->db->group_start()
                ->like('submission_code', $searchValue)
                ->or_like('nim', $searchValue)
                ->or_like('tanggal_pengajuan', $searchValue)
                ->or_like('dosen_pembimbing', $searchValue)
                ->or_like('posisi_berkas', $searchValue)
                ->group_end();
        }

        return $this->db->count_all_results();
    }
    public function update($submission_code, $data)
    {
        $this->db->where('submission_code', $submission_code);
        $this->db->update('mbkm_riset', $data);
    }
}
