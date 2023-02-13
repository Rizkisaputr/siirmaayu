<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @property CI_DB_query_builder $db
 * @property DataGridModelBase $DataGridModelBase
 */
require_once 'DataGridModelBase.php';

class DG_Nakes extends DataGridModelBase
{
	public function __construct()
	{
		parent::__construct('tb_nakes', array(
				'tb_nakes.nama','tb_nakes.data_sk','tb_nakes.alamat','tb_nakes.telp','tb_nakes.alamat','tb_nakes.telp','tb_nakes.email','tb_nakes.keterangan','tb_nakes.profesi_name','tb_rs.nama'));
	}

	protected function select_query_obj()
	{
		return $this
			->db
			->select('tb_nakes.*,tb_rs.nama as nama_rs')
			->join('tb_rs','tb_nakes.id_rs=tb_rs.id_rs');
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
			'spesialis'	=> 'Isi 1 jika spesialis dan 0 jika bukan',
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
