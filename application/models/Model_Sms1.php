<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Model_Sms1 extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function check_sms_id($id) {
		$this->db->where('tb_sms.message_id',$id);
		return $this->db->get('tb_sms');
	}

	public function check_nakes_id($kd) {
		$this->db->where('tb_nakes.id_nakes',$kd);
		return $this->db->get('tb_nakes');
	}
	
	public function check_nakes_nama($kd) {
		$this->db->where('tb_nakes.nama',$kd);
		return $this->db->get('tb_nakes');
	}
	
	public function set_sms($data)
	{
		$this->db->insert('tb_sms',$data);
	}

	public function get_sms()
	{
		$this->db->where('status',0);
		return $this->db->get('tb_sms');
	}

	public function set_sms_ok($id)
	{
		$this->db->where('id_sms',$id);
		$this->db->update('tb_sms',array('status' => 1));
	}

	public function get_kode_rs($kd)
	{
		$this->db->where('kode_rs',$kd);
		return $this->db->get('tb_rs');
	}

	public function check_pasien($where)
	{
		$this->db->where($where,null,false);
		return $this->db->get('tb_pasien');
	}

	public function check_perujuk($telp)
	{
		$this->db->like('telp',$telp);
		return $this->db->get('tb_nakes');
	}
	

	public function save_pasien($data)
	{
		$this->db->insert('tb_pasien',$data);
		return $this->db->insert_id();
	}

	public function save_rujukan($data)
	{
		$this->db->insert('tb_rujukan',$data);
	}

	public function save_owner($data)
	{
		$this->db->insert('tb_pasien_owner',$data);
	}

}