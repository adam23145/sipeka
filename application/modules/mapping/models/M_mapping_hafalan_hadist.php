<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
/**
 * 
 */
class M_mapping_hafalan_hadist extends CI_Model {

	function get_data_mappingHafalan($jurusan,$angkatan) {
		$i=0;
		$this->datatables->select('
			ROW_NUMBER() OVER (ORDER BY h.id DESC) AS no_urut,
			h."id",
			h.nim,
			h.hadist,
			h.nip,
			mj.major_name,
			mh.tahun_masuk tahun_angkatan,
			mh.nama mhs,
			ma.hadist nama_hadist,
			ma.tema,
			md.nama dosen
		');
		$this->datatables->from('mapping_hafalan_hadist h');
		// $this->datatables->join('m_mahasiswa mh','a.id_prodi = CAST(j.major_code AS integer) ','inner');
		$this->datatables->join('m_mahasiswa mh','mh.nim = h.nim','inner');
		$this->datatables->join('m_hadist ma','ma."id" = h.hadist','inner');
		$this->datatables->join('m_jurusan mj','CAST(mj."major_code" AS SMALLINT) = ma.id_prodi','inner');
		$this->datatables->join('m_dosen md','CAST(md.kode_dosen AS BIGINT) = h.nip','inner');
		// $this->datatables->where('a.status = 1');
		if($jurusan <> ""){$this->datatables->where("ma.id_prodi = '$jurusan'");}
		if($angkatan <> ""){$this->datatables->where("mh.tahun_masuk = '$angkatan'");}
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
		$update = $this->db->update('mapping_hafalan_hadist',$item);
		return $update;
	}

	function insert($item){
		$insert 	= $this->db->insert('mapping_hafalan_hadist',$item);
		return $insert;
	}
	
	function insert_batch($item){
		$insert 	= $this->db->insert_batch('mapping_hafalan_hadist',$item);
		return $insert;
	}
	
	function delete($id){

	$this->db->where('id', $id);
	$delete = $this->db->delete('mapping_hafalan_hadist');
	return $delete;

	}

}