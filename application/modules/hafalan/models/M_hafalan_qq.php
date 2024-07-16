<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
/**
 * 
 */
class M_hafalan_qq extends CI_Model {

	function get_data_hafalan($upd,$userlevel,$filter=""){
		$i=0;$user = explode("@",$upd);
		$this->datatables->select('
			(ROW_NUMBER() OVER (ORDER BY mha.id DESC)) AS no_urut,
			tha.id,
			mha.id AS mapping_qq,
			ms.id id_lulus,
			mha.nim,
			mha.kiraatul_quran AS id_qq,
			mha.nip,
			mh.nama,
			ma.kiraatul_quran,
			ma.tema,
			md.nama AS dosen,
			tha.link,
			tha.fashohah,
			tha.makhroj,
			tha.tajwid,
			tha.nilai,
			ms.status_lulus,
			tha.tgl_upload,
			tha.tgl_nilai,
			tha.keterangan
		');
		$this->datatables->from('mapping_hafalan_qq mha');
		// $this->datatables->join('m_mahasiswa mh','a.id_prodi = CAST(j.major_code AS integer) ','inner');
		$this->datatables->join('m_mahasiswa mh','mh.nim = mha.nim','inner');
		$this->datatables->join('m_qq ma','ma."id" = mha.kiraatul_quran','inner');
		$this->datatables->join('m_dosen md','CAST(md.kode_dosen AS BIGINT) = mha.nip','inner');
		$this->datatables->join('trans_hafalan_qq tha','tha.mapping_qq = mha."id"','left');
		$this->datatables->join('m_status ms','ms.id = tha."status_lulus"','left');
		if($filter <> ""){
			// var_dump($filter);exit();
			$this->datatables->where("mh.nama like '%" . $filter . "%'");
		}
		if($userlevel == "mahasiswa"){
			$this->datatables->where("mha.nim = '" . $user[0] . "'");
			$this->datatables->add_column('action','<center>
				<button class="btn btn-primary btn-sm btn-edit"><i style="color: white;" class="fa fa-pencil-alt"></i></button>
				<button class="btn btn-success btn-sm btn-preview"><i style="color: white;" class="fas fa-eye"></i></button>
				</center>
			');
		}else if($userlevel == "Dosen"){
			// $this->datatables->where("mha.nip = '" . $user[0] . "'");
			$this->datatables->where("md.email = '" . $upd . "'");
			$this->datatables->add_column('action','<center>
				<button class="btn btn-primary btn-sm btn-nilai"><i style="color: white;" class="fa fa-pencil-alt"></i></button>
				<button class="btn btn-success btn-sm btn-preview"><i style="color: white;" class="fas fa-eye"></i></button>
				</center>
			');
		}else{
			$this->datatables->add_column('action','<center>
				<button class="btn btn-success btn-sm btn-preview"><i style="color: white;" class="fas fa-eye"></i></button>
				</center>
			');
		}
		$data = $this->datatables->generate();
		return $data;
	}

	function update($id, $item){
		$this->db->where('id',$id);
		$update = $this->db->update('trans_hafalan_qq',$item);
		return $update;
	}

	function insert($item){
		$insert 	= $this->db->insert('trans_hafalan_qq',$item);
		return $insert;
	}
	
	function insert_batch($item){
		$insert 	= $this->db->insert_batch('trans_hafalan_qq',$item);
		return $insert;
	}
	
	function delete($id){

	$this->db->where('id', $id);
	$delete = $this->db->delete('trans_hafalan_qq');
	return $delete;

	}

}