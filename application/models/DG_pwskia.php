<?php defined('BASEPATH') OR exit('No direct script access allowed');
require_once 'DataGridModelBase.php';
/**
 * @property CI_DB_query_builder $db
 * @property DataGridModelBase $DataGridModelBase
 * @property Ion_auth $ion_auth
 */

class DG_pwskia extends DataGridModelBase
{
	private $where;
	public function __construct()
	{
		parent::__construct('tb_rs', array('tb_rs.nama'));
	}

	protected function select_query_obj()
	{

		/*foreach ($this->where as $key=>$value){
			$this->db->where($key,$value);
		}*/
		return $this
			->db
			->select('count(id_desa) desa,tb_rs.id_rs,tb_rs.nama AS nama_rs')
			->join('tb_desa','tb_desa.id_rs = tb_rs.id_rs')
			->group_by('tb_desa.id_rs');
	}

	
	public function setWhere($key,$value)
	{
		$this->where[$key]=$value;
	}

	public function getDesa($id)
	{
		return $this->db->where('id_rs',$id)->get('tb_desa');
	}

	public function getRs($id)
	{
		return $this->db->where('id_rs',$id)->get('tb_rs');
	}

	public function get_rs_selection($not,$in=array(),$admin =FALSE){
		$this->db->reset_query();
		if($admin===FALSE){
			if($not){
				$this->db->where_not_in('id_rs',$in);
			}else{
				$this->db->where_in('id_rs',$in);
			}
		}
		$selection=array();
		$this->db->select('id_rs,nama')->order_by('nama');
		foreach ($this->db->get('tb_rs')->result() as $row){
			$selection[$row->id_rs]=$row->nama;
		}
		return $selection;
	}

	public function get_layanan_selection(){
		$selection=array('0'=>'Semua');
		$this->db->select('id_jenis_layanan,nama');
		foreach ($this->db->get('tb_layanan_type')->result() as $row){
			$selection[$row->id_jenis_layanan]=$row->nama;
		}
		return $selection;
	}

	public function checkPwskia($id,$bln)
	{
		$this->db->where('id_desa',$id);
		$this->db->where('bulan',$bln);
		return $this->db->get('tb_pwskia');

	}

	public function savePwskia($data)
	{
		$this->db->insert('tb_pwskia',$data);

	}
	
	public function updatePwskia($id,$data)
	{
		$this->db->where('id_pwskia',$id);
		$this->db->update('tb_pwskia',$data);
	}


	public function getPwskia($where)
	{
		return $this->db->from('tb_pwskia')
		->join('tb_desa','tb_desa.id_desa = tb_pwskia.id_desa')
		->where($where)
		->get();
	}

	public function checkPwskiaTarget($id,$bln)
	{
		$this->db->where('id_desa',$id);
		$this->db->where('bulan',$bln);
		return $this->db->get('tb_pwskia_target');

	}

	public function savePwskiaTarget($data)
	{
		$this->db->insert('tb_pwskia_target',$data);

	}
	
	public function updatePwskiaTarget($id,$data)
	{
		$this->db->where('id_pwskia_target',$id);
		$this->db->update('tb_pwskia_target',$data);
	}


	public function getPwskiaTarget($where)
	{
		return $this->db->from('tb_pwskia_target')
		->join('tb_desa','tb_desa.id_desa = tb_pwskia_target.id_desa')
		->where($where)
		->get();
	}
	

}
