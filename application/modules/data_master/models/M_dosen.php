<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
/**
 * 
 */
class M_dosen extends CI_Model
{
	function get_data_dosen($searchValue = null)
	{
		$this->datatables->select('
			ROW_NUMBER() OVER (ORDER BY d.nip DESC) AS no_urut,
			d.id,
			d.nip,
			d.kode_dosen,
			d.nama,
			d.email,
			d.jenis_kelamin,
			d.jabatan,
			d.program_study,
			d.status
		');
		$this->datatables->from('m_dosen d');

		// Menambahkan subquery untuk menggabungkan data dan hanya mengambil data dengan email unik
		$this->datatables->where('d.id IN (SELECT MIN(id) FROM m_dosen GROUP BY email)');

		if (!empty($searchValue)) {
			$this->datatables->like('d.nama', $searchValue, 'both');
		}

		$this->datatables->add_column('action', '<center>
			<button class="btn btn-primary btn-sm btn-edit"><i style="color: white;" class="fa fa-pencil-alt"></i></button>
			<button class="btn btn-danger btn-sm btn-delete"><i style="color: white;" class="fa fa-trash-alt"></i></button>
			</center>
			');
		$data = $this->datatables->generate();
		return $data;
	}

	function update($nip, $kode_dosen, $nama, $email, $jenis_kelamin, $status, $createddate, $upd, $cp, $jabatan, $program_stud, $id)
	{
		// Query untuk update tabel m_dosen
		$query_dosen = "UPDATE m_dosen SET kode_dosen='$kode_dosen', nama='$nama', email='$email', jenis_kelamin='$jenis_kelamin', status='$status', upd='$upd', cp='$cp', jabatan='$jabatan', program_study='$program_stud' WHERE id='$id'";
		$update_dosen = $this->db->query($query_dosen);

		// Cek apakah ada user dengan userid tersebut di tabel m_login
		$query_check_user = "SELECT * FROM m_login WHERE userid='$email'";
		$result_check_user = $this->db->query($query_check_user);

		// Jika ada, update username dengan nilai $nama
		if ($result_check_user->num_rows() > 0) {
			$query_update_login = "UPDATE m_login SET username='$nama' WHERE userid='$email'";
			$update_login = $this->db->query($query_update_login);
		}

		return $this->db->affected_rows() > 0; // Mengembalikan hasil update pada m_dosen
	}


	function insert_data($nip, $kode_dosen, $nama, $email, $jenis_kelamin, $status, $createddate, $upd, $cp, $jabatan, $program_study)
	{
		$query 		= " INSERT INTO m_dosen(nip,kode_dosen,nama,email,jenis_kelamin,status,createddate,upd,cp,jabatan,program_study) VALUES('" . $nip . "', '" . $kode_dosen . "', '" . $nama . "', '" . $email . "', '" . $jenis_kelamin . "', '" . $status . "', '" . $createddate . "', '" . $upd . "', '" . $cp . "', '" . $jabatan . "', '" . $program_study . "') ";
		$insert 	= $this->db->query($query);
		return $insert;
	}

	function insert($item)
	{
		$insert 	= $this->db->insert('m_dosen,', $item);
		return $insert;
	}

	function insert_batch($item)
	{
		$insert 	= $this->db->insert_batch('m_dosen', $item);
		return $insert;
	}

	function delete($id)
	{

		$this->db->where('id', $id);
		$delete = $this->db->delete('m_dosen');
		return $delete;
	}
}
