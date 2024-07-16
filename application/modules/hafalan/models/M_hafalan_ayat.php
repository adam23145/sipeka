<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
/**
 * 
 */
class M_hafalan_ayat extends CI_Model {

	function get_data_hafalan($upd,$userlevel,$filter=""){
		$i=0;$user = explode("@",$upd);
		// var_dump($userlevel);exit();
		$this->datatables->select('
			ROW_NUMBER() OVER (ORDER BY mha.id DESC) AS no_urut,
			tha.id,
			mha.id mapping_ayat,
			ms.id id_lulus,
			mha.nim,
			mha.ayat id_ayat,
			mha.nip,
			mh.nama,
			ma.ayat,
			ma.tema,
			md.nama AS dosen,
			tha.link,
			tha.menghafal,
			tha.memahami,
			tha.nilai,
			ms.status_lulus,
			tha.tgl_upload,
			tha.tgl_nilai,
			tha.keterangan
		');
		$this->datatables->from('mapping_hafalan_ayat mha');
		// $this->datatables->join('m_mahasiswa mh','a.id_prodi = CAST(j.major_code AS integer) ','inner');
		$this->datatables->join('m_mahasiswa mh','mh.nim = mha.nim','inner');
		$this->datatables->join('m_ayat ma','ma."id" = mha.ayat','inner');
		$this->datatables->join('m_dosen md','CAST(md.kode_dosen AS BIGINT) = mha.nip','inner');
		$this->datatables->join('trans_hafalan_ayat tha','tha.mapping_ayat = mha."id"','left');
		$this->datatables->join('m_status ms','ms.id = tha."status_lulus"','left');
		
		if($filter <> ""){
			// var_dump($filter);exit();
			$this->datatables->where("mh.nama like '%" . $filter . "%'");
		}
		// var_dump($filter);exit();
		if($userlevel == "mahasiswa"){
			$this->datatables->where("mha.nim = '" . $user[0] . "'");
			$this->datatables->add_column('action','<center>
				<button class="btn btn-primary btn-sm btn-edit"><i style="color: white;" class="fa fa-pencil-alt"></i></button>
				<button class="btn btn-success btn-sm btn-preview"><i style="color: white;" class="fas fa-eye"></i></button>
				</center>
			');
		}else if($userlevel == "Dosen"){
			$this->datatables->where("md.email = '" . $upd . "'");
			// $this->datatables->where("mha.nip = CAST(md.kode_dosen AS BIGINT) ");
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
		// var_dump($data);exit();
		return $data;
	}

	function update($id, $item){
		$this->db->where('id',$id);
		$update = $this->db->update('trans_hafalan_ayat',$item);
		return $update;
	}
	
	function getdata_sertifikat($nim){
		$sql = "";
		$sql .= "SELECT nama,nim,jurusan,SUM(menghafal)/COUNT(1) menghafal,SUM(memahami)/COUNT(1) memahami,ROUND(SUM(nilai)/COUNT(1),2) nilai ";
		$sql .= "FROM ( ";
		$sql .= "SELECT mm.nama,mm.nim,mm.jurusan,tha.menghafal,tha.memahami,tha.nilai ";
		$sql .= "FROM trans_hafalan_ayat tha ";
		$sql .= "INNER JOIN mapping_hafalan_ayat mha ON mha.id = tha.mapping_ayat ";
		$sql .= "INNER JOIN m_mahasiswa mm ON mm.nim = mha.nim ";
		$sql .= "WHERE mha.nim = '". $nim ."'  ";
		$sql .= ") v ";
		$sql .= "GROUP BY nama,nim,jurusan ";
		
		$query = $this->db->query($sql);
		$result = $query->result_array();
		return $result;
	}

	function insert($item){
		$insert 	= $this->db->insert('trans_hafalan_ayat',$item);
		return $insert;
	}
	
	function insert_batch($item){
		$insert 	= $this->db->insert_batch('trans_hafalan_ayat',$item);
		return $insert;
	}
	
	function delete($id){

	$this->db->where('id', $id);
	$delete = $this->db->delete('trans_hafalan_ayat');
	return $delete;

	}

}