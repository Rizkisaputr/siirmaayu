<?php
/**
 * @property CI_DB_query_builder $db
 * @property DataGridModelBase $DataGridModelBase
 */
require_once 'DataGridModelBase.php';

class DG_desa extends DataGridModelBase
{
	public function __construct()
	{
		parent::__construct('tb_desa', array('tb_desa.desa','tb_rs.nama'));
	}
	public function insert_data($data = array())
	{
		return parent::insert_data($data);
	}
	public function update_data($where = array(), $data = array())
	{
		return parent::update_data($where, $data);
	}
	protected function select_query_obj()
	{
		return $this
			->db
			->select('tb_desa.*,tb_rs.nama as nama_rs')
			->join('tb_rs','tb_desa.id_rs=tb_rs.id_rs');
	}
}
