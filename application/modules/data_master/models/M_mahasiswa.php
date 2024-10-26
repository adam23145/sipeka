<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
/**
 * 
 */
class M_mahasiswa extends CI_Model
{

	function get_data_mahasiswa($status = null, $searchValue = null, $jur = null)
	{
		$this->datatables->select('
        ROW_NUMBER() OVER (ORDER BY mhs.nim DESC) AS no_urut,
        mhs.nim,
        mhs.nama,
        mhs.email,
        mhs.fakultas,
        mhs.jurusan,
        mhs.jenis_kelamin,
        mhs.tahun_masuk,
        mhs.status
    ');
		$this->datatables->from('m_mahasiswa mhs');
		if ($jur) {
			$this->datatables->where('mhs.jurusan', $jur);
		}
		if ($status) {
			$this->datatables->where('mhs.status', $status);
		}

		if (!empty($searchValue)) {
			$this->datatables->like('mhs.nama', $searchValue, 'both');
		}

		$this->datatables->add_column('action', '<center>
            <button class="btn btn-primary btn-sm btn-edit"><i style="color: white;" class="fa fa-pencil-alt"></i></button>
            <button class="btn btn-danger btn-sm btn-delete"><i style="color: white;" class="fa fa-trash-alt"></i></button>
        </center>
    ');

		$data = $this->datatables->generate();
		return $data;
	}

	function update($id, $item)
	{
		$this->db->where('nim', $id);
		$update = $this->db->update('m_mahasiswa', $item);
		return $update;
	}
	function updatePassword($id, $data)
	{
		$this->db->where('userid', $id);
		$update = $this->db->update('m_login', $data);
		return $update;
	}

	function insert($item)
	{
		$insert 	= $this->db->insert('m_mahasiswa', $item);
		return $insert;
	}
	function insert_data($userid, $username, $password, $userlevel)
	{
		// Menggunakan query builder untuk menghindari SQL injection
		$data = array(
			'userid'    => $userid,
			'username'  => $username,
			'pass'      => $password, // Idealnya, enkripsi password sebelum disimpan
			'userlevel' => $userlevel
		);

		// Gunakan insert() untuk menyisipkan data
		return $this->db->insert('m_login', $data);
	}

	function insert_batch($item)
	{
		$insert 	= $this->db->insert_batch('m_mahasiswa', $item);
		return $insert;
	}

	function delete($id)
	{

		$this->db->where('nim', $id);
		$delete = $this->db->delete('m_mahasiswa');
		return $delete;
	}
}
