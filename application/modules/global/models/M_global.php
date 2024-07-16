<?php
/**
 * 
 */
class M_global extends CI_Model {

	function get_level(){
		$data = $this->db->get('m_level')->result_array();
		return $data;
	}

	function get_site(){
		$this->db->where('status', 'active');
		$data = $this->db->get('m_site')->result_array();
		return $data;
	}

	function get_jurusan($majorcode){
		$query 		= "SELECT major_name FROM m_jurusan WHERE major_code='$majorcode'";
		$data 		= $this->db->query($query)->result_array();
		return $data;
	}

	function get_jurusan2($nim){
		$query 		= "SELECT jurusan FROM m_mahasiswa WHERE nim='$nim'";
		$data 		= $this->db->query($query)->result_array();
		return $data;
	}

	function get_jurusankoorprodi($userid){
		$query 		= "SELECT program_study FROM m_dosen WHERE email='$userid'";
		$data 		= $this->db->query($query)->result_array();
		return $data;
	}

	function get_dosen($jurusan){
		$query 		= "SELECT * FROM m_dosen WHERE status='aktif' AND jabatan='Dosen' AND program_study='$jurusan' ORDER BY nama ";
		$data 		= $this->db->query($query)->result_array();
		return $data;
	}

	function get_dosen3($jurusan, $dosbing){
		$query 		= "SELECT * FROM m_dosen WHERE status='aktif' AND jabatan='Dosen' AND program_study='$jurusan' AND nip !='$dosbing' ORDER BY nama ";
		$data 		= $this->db->query($query)->result_array();
		return $data;
	}

	function get_dosen1(){
		$query 		= "SELECT * FROM m_dosen WHERE status='aktif' AND jabatan='Dosen' ORDER BY nama ASC";
		$data 		= $this->db->query($query)->result_array();
		return $data;
	}

	function getprodiadmin($email){
		$query 		= "SELECT * FROM m_dosen WHERE status='aktif' AND jabatan='Admin Prodi' AND email='$email' ";
		$data 		= $this->db->query($query)->result_array();
		return $data;
	}

	function get_nip($userid){
		$query 		= "SELECT * FROM m_dosen WHERE status='aktif' AND jabatan='Dosen' AND email= '$userid' ORDER BY nama ASC";
		$data 		= $this->db->query($query)->result_array();
		return $data;
	}

	function get_mahasiswa(){
		$query 		= "SELECT * FROM m_mahasiswa WHERE status='aktif' ";
		$data 		= $this->db->query($query)->result_array();
		return $data;
	}

	function get_mahasiswa_HBS(){
		$query 		= "SELECT nim,student_name as nama FROM title_submission WHERE jurusan='Hukum Bisnis Syariah' ORDER BY student_name ASC ";
		$data 		= $this->db->query($query)->result_array();
		return $data;
	}

	function get_mahasiswa_ES(){
		$query 		= "SELECT nim,student_name as nama FROM title_submission WHERE jurusan='Ekonomi Syariah' ORDER BY student_name ASC ";
		$data 		= $this->db->query($query)->result_array();
		return $data;
	}

	// function get_mahasiswa(){
		// $this->db->where('status', 'aktif');
		// $data = $this->db->get('m_mahasiswa')->result_array();
		// return $data;
	// }
	
	function get_start_angkatan(){
		$this->db->select('min(tahun_masuk) tahun_masuk');
		$this->db->where('tahun_masuk IS NOT NULL', NULL, FALSE);
		$data = $this->db->get('m_mahasiswa')->result_array();
		// $i=0;
		while($data[0]['tahun_masuk'] < date("Y")){
			array_unshift($data, array("tahun_masuk" => ($data[0]['tahun_masuk']+1)));
			// $i++;
		}
		return $data;
	}

	
	// SELECT min(tahun_masuk) start_date 
// FROM m_mahasiswa
// WHERE tahun_masuk IS NOT NULL
	
	function get_mhs(){
		$this->db->select('*');    
		$this->db->from('m_mahasiswa mm');
		$this->db->join(
		'm_login ml', 
		"CAST(SPLIT_PART(ml.userid, '@', 1) AS BIGINT) = mm.nim AND ml.userlevel = 'mahasiswa' ");
		$this->db->order_by('mm.nama ASC');
		$data = $this->db->get()->result_array();
		return $data;
	}

	function get_jabatan(){
		$this->db->order_by('id', 'DESC');
		$data = $this->db->get('m_jabatan')->result_array();
		return $data;
	}

	function get_status(){
		$this->db->order_by('id', 'DESC');
		$data = $this->db->get('m_status')->result_array();
		return $data;
	}

	function get_prodi(){
		$this->db->order_by('major_name', 'ASC');
		$data = $this->db->get('m_jurusan')->result_array();
		return $data;
	}

	function get_ayat(){
		$this->db->order_by('ayat', 'ASC');
		$data = $this->db->get('m_ayat')->result_array();
		return $data;
	}
	
	function get_hadist(){
		$this->db->order_by('tema', 'ASC');
		$data = $this->db->get('m_hadist')->result_array();
		return $data;
	}
	
	function get_kk(){
		$this->db->order_by('kiraotul_kutub', 'ASC');
		$data = $this->db->get('m_kk')->result_array();
		return $data;
	}
	
	function get_qq(){
		$this->db->order_by('kiraatul_quran', 'ASC');
		$data = $this->db->get('m_qq')->result_array();
		return $data;
	}
	
	function get_matkul(){
		$this->db->order_by('nama_matkul', 'ASC');
		$data = $this->db->get('m_matkul')->result_array();
		return $data;
	}

}