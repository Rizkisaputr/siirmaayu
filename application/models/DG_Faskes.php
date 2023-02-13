<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @property CI_DB_query_builder $db
 * @property DataGridModelBase $DataGridModelBase
 */
require_once 'DataGridModelBase.php';

class DG_Faskes extends DataGridModelBase
{
	public function __construct()
	{
		parent::__construct('tb_faskes', array('tb_faskes.nama_faskes','tb_faskes.jumlah'));
	}

	protected function select_query_obj()
	{
		return $this
			->db
			->select('tb_faskes.*,tb_rs.nama as nama_rs')
			->join('tb_rs','tb_faskes.id_rs=tb_rs.id_rs');
	}
	protected function template_head()
	{
		$head = parent::template_head();
		$head[1]['display_name']='Nama Alat Kesehatan';
		unset($head[0]);
		unset($head[3]);
		return array_values($head);
	}
	protected function transform_import_row($row)
	{
		if(is_null($this->id_rs))
			return false;
		$row['id_rs']=$this->id_rs;
		return parent::transform_import_row($row);
	}
	public $id_rs=NULL;
}
