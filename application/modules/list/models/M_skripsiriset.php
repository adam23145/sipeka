<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
/**
 * 
 */
class M_skripsiriset extends CI_Model
{
    var $table = 'skripsi_riset';
    var $column_order = array(null, 'nama_mahasiswa', 'nim', 'skripsi_riset', 'status_pengajuan', 'dokumen_pendukung'); // Sesuaikan dengan kolom di database
    var $column_search = array('nama_mahasiswa', 'nim', 'skripsi_riset'); // Kolom yang bisa dicari
    var $order = array('id' => 'desc'); // Urutan default

    private function _get_datatables_query()
    {
        $this->db->from($this->table);
        $i = 0;

        foreach ($this->column_search as $item) {
            // Periksa apakah ada 'search' dalam POST
            if (isset($_POST['search']['value']) && $_POST['search']['value'] != '') {
                if ($i === 0) {
                    $this->db->group_start();
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if (count($this->column_search) - 1 == $i) {
                    $this->db->group_end();
                }
            }
            $i++;
        }

        // Mengatur pengurutan
        if (isset($_POST['order'])) {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }


    public function get_datatables()
    {
        $this->_get_datatables_query();

        // Cek apakah 'length' dan 'start' didefinisikan di $_POST
        if (isset($_POST['length']) && $_POST['length'] != -1) {
            $this->db->limit($_POST['length'], isset($_POST['start']) ? $_POST['start'] : 0);
        }

        $query = $this->db->get();
        return $query->result();
    }


    public function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    public function update_status($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('skripsi_riset', $data); // 'skripsi_riset' adalah nama tabel
    }
}
