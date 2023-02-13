<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @property CI_DB_query_builder $db
 * @property DataGridModelBase $DataGridModelBase
 */
require_once 'DataGridModelBase.php';

class DG_Dokter extends DataGridModelBase
{
	public function __construct()
	{
		parent::__construct('tb_dokter', array('tb_dokter.nama','tb_dokter.bidang','tb_dokter.id_dokter','tb_dokter.no_idi','tb_rs.nama'));
	}

	protected function select_query_obj()
	{
		return $this
			->db
			->select('tb_dokter.*,tb_rs.nama as nama_rs')
			->join('tb_rs','tb_dokter.id_rs=tb_rs.id_rs');
	}
	protected function template_head()
	{
		$row= parent::template_head();
		unset($row[0]);
		unset($row[2]);
		unset($row[6]);
		return array_values($row);
	}
	protected function template_info_data()
	{
		return array(
			'spesialis'	=> 'Isi 1 jika SPOG, 2=SpA, 3=SpPD, 4=SpP, 5=SpAn, 6=SpRad, 7 Sp.Lainnya dan 0 dokter umum',
			'no_idi'	=> 'Nomor ID ikatan dokter indonesia dengan tanda petik dua',
		);
	}
	protected function transform_import_row($row)
	{
		if(is_null($this->id_rs))
			return false;
		$row['id_rs']=$this->id_rs;
		if(isset($row['no_idi'])){
			$row['no_idi']=str_replace('"','',$row['no_idi']);
		}
		return parent::transform_import_row($row);
	}
	public $id_rs=NULL;
}
