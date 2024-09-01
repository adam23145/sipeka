<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
/**
 * 
 */
class m_koorprodi extends CI_Model
{
    public function get_koordinator_by_major_name($major_name)
    {
        $this->db->select('m_jurusan.*, m_dosen.nama AS namakoor, m_dosen.nip AS nipkoor');
        $this->db->from('m_jurusan');
        $this->db->join('m_dosen', 'm_jurusan.koor_id = m_dosen.id', 'left');
        $this->db->where('m_jurusan.major_name', $major_name);
        $query = $this->db->get();

        return $query->row_array();
    }
    public function getBimbinganSempro($submission_code)
    {
        $this->db->select('tgl_bimbingan as tanggal, keterangan_bimbingan as topik');
        $this->db->from('log_bimbingan');
        $this->db->where('submission_code', $submission_code);
        $this->db->order_by('tgl_bimbingan', 'ASC');
        $query = $this->db->get();

        return $query->result_array(); 
    }
    public function getBimbinganSkripsi($submission_code)
    {
        $this->db->select('tgl_bimbingan_skripsi as tanggal, keterangan_bimbingan as topik');
        $this->db->from('log_bimbingan_skripsi');
        $this->db->where('submission_code', $submission_code);
        $this->db->order_by('tgl_bimbingan_skripsi', 'ASC');
        $query = $this->db->get();

        return $query->result_array(); 
    }
}
