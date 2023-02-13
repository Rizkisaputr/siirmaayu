<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Model_Wa extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function check_wa_id($id) {
		$this->db->where('tb_wa.message_id',$id);
		return $this->db->get('tb_wa');
	}

	public function check_wa_nakes_id($kd) {
		$this->db->where('tb_nakes.id_nakes',$kd);
		return $this->db->get('tb_nakes');
	}
	
	public function check_wa_nakes_nama($kd) {
		$this->db->where('tb_nakes.nama',$kd);
		return $this->db->get('tb_nakes');
	}
	
	public function set_wa($data)
	{
		$this->db->insert('tb_wa',$data);
	}

	public function get_wa()
	{
		$this->db->where('status',0);
		return $this->db->get('tb_wa');
	}

	public function set_wa_ok($id)
	{
		$this->db->where('id_wa',$id);
		$this->db->update('tb_wa',array('status' => 1));
	}

	public function get_wa_kode_rs($kd)
	{
		$this->db->where('kode_rs',$kd);
		return $this->db->get('tb_rs');
	}

	public function check_wa_pasien($where)
	{
		$this->db->where($where,null,false);
		return $this->db->get('tb_pasien');
	}

	public function check_wa_perujuk($telp)
	{
		$this->db->like('telp',$telp);
		return $this->db->get('tb_nakes');
	}
	

	public function save_wa_pasien($data)
	{
		$this->db->insert('tb_pasien',$data);
		return $this->db->insert_id();
	}

	public function save_wa_rujukan($data)
	{
		$this->db->insert('tb_rujukan',$data);
	}

	public function save_wa_owner($data)
	{
		$this->db->insert('tb_pasien_owner',$data);
	}

}