<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @property CI_DB_query_builder $db
 * @property DataGridModelBase $DataGridModelBase
 */
require_once 'DataGridModelBase.php';

class DG_Jadwal_Dokter extends DataGridModelBase
{
	public function __construct()
	{
		parent::__construct('tb_jadwal_dokter', array('tb_dokter.nama','tb_jadwal_dokter.id_dokter','tb_jadwal_dokter.mulai','tb_jadwal_dokter.selesai'));
	}

	protected function select_query_obj()
	{
		return $this
			->db
			->select('tb_jadwal_dokter.id_jadwal_dokter,tb_dokter.id_rs,tb_dokter.nama,tb_jadwal_dokter.id_dokter,tb_jadwal_dokter.hari,tb_jadwal_dokter.jam_mulai,tb_jadwal_dokter.jam_selesai,tb_jadwal_dokter.tgl_update')
			->join('tb_dokter','tb_jadwal_dokter.id_dokter=tb_dokter.id_dokter');
	}
	protected function template_head()
	{
		$row= parent::template_head();
		unset($row[1]);
		unset($row[2]);
		unset($row[3]);
		unset($row[4]);
		unset($row[5]);
		unset($row[6]);
		return array_values($row);
	}
	protected function template_info_data()
	{
		return array(
			'spesialis'	=> 'Isi hari : Isi 0 => Mnggu, 1=>Senin,2=>Selasa,3=>Rabu,4=>Kamis,5=>Jumat,6=>Sabtu',
			'id_dokter'	=> 'id_dokter lihat di Menu Data Dokter',
		);
	}
	protected function transform_import_row($row)
	{
		if(is_null($this->id_rs))
			return false;
		$row['id_rs']=$this->id_rs;
		if(isset($row['id_dokter'])){
			$row['id_dokter']=str_replace('"','',$row['id_dokter']);
		}
		return parent::transform_import_row($row);
	}
	public function get_dokter_selection($is_admin,$in=array()){
		if(!$is_admin){
			$this->db->where_in('id_rs',$in);
		}
		$this->db->select('id_dokter,nama');
		$selection=array();
		foreach ($this->db->get('tb_dokter')->result() as $row){
			$selection[$row->id_dokter]=$row->nama;
		}
		return $selection;
	}
	public function get_dokter_rs($idDokter){
		$this->db->reset_query();
		$this->db->select('id_rs');
		$this->db->where('id_dokter',$idDokter);
		$r=$this->db->get('tb_dokter')->row();
		return $r?$r->id_rs:false;
	}
}
