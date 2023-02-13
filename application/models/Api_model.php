<?php

class Api_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

	public function user($n)
	{
		$this->db->where('email',$n);
		return $this->db->get('users');
	}

	public function rs($n = null)
	{
		if ($n != null) $this->db->where('nama',$n);
		return $this->db->get('tb_rs');
	}

	public function init($n)
	{
		$this->db->where('id_rs',$n);
		return $this->db->delete('tb_bed');
	}

	public function kelas($n)
	{
		$this->db->like('UPPER(nama)',strtoupper(trim($n)),false);
		return $this->db->get('tb_kelas_bed');
	}

	public function cek_bed($where)
	{
		$this->db->where($where);
		return $this->db->get('tb_bed');
	}

	public function update_bed($id,$data)
	{
		$this->db->where('id_bed',$id);
		return $this->db->update('tb_bed',$data);
	}

	public function insert_bed($n)
	{
		$this->db->insert('tb_bed',$n);
	}

	public function check_dokter($n)
	{
		$this->db->where($n);
		return $this->db->get('tb_dokter');
	}

	public function dokter($n,$id = null)
	{
		if ($id != null) {
			$this->db->where('id_dokter',$id);
			$this->db->update('tb_dokter',$n);
		} else {
			$this->db->insert('tb_dokter',$n);
		}
	}

	public function cek_stok_darah($where)
	{
		$this->db->where($where);
		return $this->db->get('tb_stok_darah');
	}

	public function update_stok_darah($id,$data)
	{
		$this->db->where('id_stok_darah',$id);
		return $this->db->update('tb_stok_darah',$data);
	}

	public function insert_stok_darah($n)
	{
		$this->db->insert('tb_stok_darah',$n);
	}


}
