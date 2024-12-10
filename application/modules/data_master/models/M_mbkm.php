<?php
class M_mbkm extends CI_Model
{
    private $table = 'mbkm_riset';

    public function fetch_data($searchValue, $orderColumn, $orderDir, $start, $length, $jur)
    {
        $columns = ['judul', 'nim', 'prodi', 'tanggal_pengajuan', 'dosen_pembimbing'];

        $this->db->select('*')->from($this->table);
        $this->db->where('status_pengajuan_skripsi', 'Acc');
        if ($jur) {
            $this->db->where('prodi', $jur);
        }

        if (!empty($searchValue)) {
            $this->db->group_start()
                ->like('judul', $searchValue)
                ->or_like('nim', $searchValue)
                ->or_like('prodi', $searchValue)
                ->or_like('tanggal_pengajuan', $searchValue)
                ->group_end();
        }

        if (isset($columns[$orderColumn])) {
            $this->db->order_by($columns[$orderColumn], $orderDir);
        }

        $this->db->limit($length, $start);

        return $this->db->get()->result();
    }

    public function count_all()
    {
        return $this->db->count_all($this->table);
    }
    public function get_all_dosen($search = null)
    {
        $this->db->select('nip, nama');
        $this->db->where('jabatan', 'Dosen');

        if ($search) {
            $this->db->like('UPPER(nama)', strtoupper($search));
        }

        $this->db->where('createddate =', "(SELECT MAX(createddate) FROM m_dosen AS sub WHERE sub.nip = m_dosen.nip)", FALSE);

        $query = $this->db->get('m_dosen');
        return $query->result();
    }
    public function count_filtered($searchValue, $jur)
    {
        $this->db->from($this->table);
        if ($jur) {
            $this->db->where('prodi', $jur);
        }

        $this->db->where('status_pengajuan_skripsi', 'Acc');
        if (!empty($searchValue)) {
            $this->db->group_start()
                ->like('judul', $searchValue)
                ->or_like('nim', $searchValue)
                ->or_like('prodi', $searchValue)
                ->or_like('tanggal_pengajuan', $searchValue)
                ->group_end();
        }

        return $this->db->count_all_results();
    }

    public function update($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update($this->table, $data);
    }
}
