<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
/**
 * 
 */
class M_hafalan_kk extends CI_Model {

	function get_data_hafalan($upd,$userlevel,$filter=""){
		$i=0;$user = explode("@",$upd);
		$this->datatables->select('
			ROW_NUMBER() OVER (ORDER BY mha.id DESC) AS no_urut,
			tha.id,
			mha.id mapping_kk,
			ms.id id_lulus,
			mha.nim,
			mha.kiraatul_kutub id_kk,
			mha.nip,
			mh.nama,
			ma.kiraotul_kutub,
			ma.tema,
			md.nama AS dosen,
			tha.link,
			tha.membaca,
			tha.memahami,
			tha.menganalisa,
			tha.nilai,
			ms.status_lulus,
			tha.tgl_upload,
			tha.tgl_nilai,
			tha.keterangan
		');
		$this->datatables->from('mapping_hafalan_kk mha');
		// $this->datatables->join('m_mahasiswa mh','a.id_prodi = CAST(j.major_code AS integer) ','inner');
		$this->datatables->join('m_mahasiswa mh','mh.nim = mha.nim','inner');
		$this->datatables->join('m_kk ma','ma."id" = mha.kiraatul_kutub','inner');
		$this->datatables->join('m_dosen md','CAST(md.kode_dosen AS BIGINT) = mha.nip','inner');
		$this->datatables->join('trans_hafalan_kk tha','tha.mapping_kk = mha."id"','left');
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

	function getdata_sertifikat($nim){
		$sql = "";
		$sql .= "SELECT nama,nim,jurusan,SUM(membaca)/COUNT(1) membaca,SUM(memahami)/COUNT(1) memahami, ";
		$sql .= "SUM(menganalisa)/COUNT(1) menganalisa, ROUND(SUM(nilai)/COUNT(1),2) nilai ";
		$sql .= "FROM ( ";
		$sql .= "SELECT mm.nama,mm.nim,mm.jurusan,tha.membaca,tha.memahami,tha.menganalisa,tha.nilai ";
		$sql .= "FROM trans_hafalan_kk tha ";
		$sql .= "INNER JOIN mapping_hafalan_kk mha ON mha.id = tha.mapping_kk ";
		$sql .= "INNER JOIN m_mahasiswa mm ON mm.nim = mha.nim ";
		$sql .= "WHERE mha.nim = '" . $nim . "'  ";
		$sql .= ") v ";
		$sql .= "GROUP BY nama,nim,jurusan ";
		
		$query = $this->db->query($sql);
		$result = $query->result_array();
		return $result;
	}

	function update($id, $item){
		$this->db->where('id',$id);
		$update = $this->db->update('trans_hafalan_kk',$item);
		return $update;
	}

	function insert($item){
		$insert 	= $this->db->insert('trans_hafalan_kk',$item);
		return $insert;
	}
	
	function insert_batch($item){
		$insert 	= $this->db->insert_batch('trans_hafalan_kk',$item);
		return $insert;
	}
	
	function delete($id){

	$this->db->where('id', $id);
	$delete = $this->db->delete('trans_hafalan_kk');
	return $delete;

	}

}