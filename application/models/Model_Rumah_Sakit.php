<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @property CI_DB_query_builder $db
 * @property Ion_auth $ion_auth
 * @property User_model $User_model
 */

class Model_Rumah_Sakit extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Get data rumah sakit
	 * @param string $selection
	 * @param string $q
	 * @param integer $limit
	 * @param int $offset
	 * @return array
	 */
	public function get_rumah_sakit($selection, $q=NULL, $limit=NULL, $offset=0){
		$this->db->select($selection);
		if($q){
			$this->db->group_start();
				$this->db->like('nama',$q);
				$this->db->like('kode_rs',$q);
				$this->db->like('telepon',$q);
				$this->db->like('alamat',$q);
			$this->db->group_end();
		}
		if(!$this->ion_auth->is_admin()){
			$this->load->model('User_model');
			$this->db->where_in('id_rs',$this->User_model->get_all_user_rs($this->ion_auth->get_user_id()));
		}
		return $this->db->get('tb_rs',$limit,$offset)->result();
	}

	public function get_rs_selection($prefix=''){
		$prefix.=' ';
		$ret=array();
		$this->db->order_by('nama');
		foreach ($this->get_rumah_sakit('id_rs,nama') as $row){
			$ret[strval($row->id_rs)]=$prefix.$row->nama;
		}
		return $ret;
	}
	
	public function get_rs_front(){
		$ret=array();
		$this->db->order_by('nama');
		$rs = $this->db->get('tb_rs');
		foreach ($rs->result() as $row){
			$ret[strval($row->id_rs)]=$row->nama;
		}
		return $ret;
	}
	
	public function get_type_faskes(){
		
		$ret=array();
		$this->db->select('jenis');
		$this->db->group_by('jenis');
		foreach ($this->db->get('tb_rs')->result() as $row){
			$ret[$row->jenis]=$row->jenis;
		}
		return $ret;
	}

	public function get_kelas_bed_selection($prefix=''){
		$prefix.='';
		$ret=array();
		$this->db->order_by('nama');
		foreach ($this->get_kelas_bed() as $row){
			$ret[strval($row->id_kelas_bed)]=$prefix.$row->nama;
		}
		return $ret;
	}

	public function get_rs_data($idRs){
		$this->db->where('id_rs',$idRs);
		return $this->db->get('tb_rs')->row();
	}

	public function get_kelas_bed(){
		$this->db->reset_query();
		$this->db->order_by('nama');
		return $this->db->get('tb_kelas_bed')->result();
	}

	public function save_nakes($data){
		$this->db->insert('tb_nakes',$data);
	}
}
