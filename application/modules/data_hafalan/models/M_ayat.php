<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
/**
 * 
 */
class M_ayat extends CI_Model {

	function get_data_ayat($jurusan) {
		$i=0;
		$this->datatables->select('
			a.id,
			ROW_NUMBER() OVER (ORDER BY a.ayat) AS no_urut,
			a.id_prodi,
			s.id id_status,
			a.ayat,
			a.tema,
			s.status,
			j.major_name
			');
		$this->datatables->from('m_ayat a');
		$this->datatables->join('m_jurusan j','a.id_prodi = CAST(j.major_code AS integer) ','inner');
		$this->datatables->join('m_status s','a.status = s.id','inner');
		$this->datatables->where('a.status = 1');
		if($jurusan <> ""){$this->datatables->where("a.id_prodi = '$jurusan'");}
		// if($angkatan <> ""){$this->datatables->where("a.tahun_angkatan = '$angkatan'");}
		$this->datatables->add_column('action','<center>
            <button class="btn btn-primary btn-sm btn-edit"><i style="color: white;" class="fa fa-pencil-alt"></i></button>
            <button class="btn btn-danger btn-sm btn-delete"><i style="color: white;" class="fa fa-trash-alt"></i></button>
            </center>
            ');
		$data = $this->datatables->generate();
		return $data;
	}

	function update($id, $item){
		$this->db->where('id',$id);
		$update = $this->db->update('m_ayat',$item);
		return $update;
	}

	function insert($item){
		$insert 	= $this->db->insert('m_ayat',$item);
		return $insert;
	}
	
	function insert_batch($item){
		$insert 	= $this->db->insert_batch('m_ayat',$item);
		return $insert;
	}
	
	function delete($id){

	$this->db->where('id', $id);
	$delete = $this->db->delete('m_ayat');
	return $delete;

	}

}