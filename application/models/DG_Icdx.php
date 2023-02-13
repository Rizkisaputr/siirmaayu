<?php
/**
 * @property CI_DB_query_builder $db
 * @property DataGridModelBase $DataGridModelBase
 */
require_once 'DataGridModelBase.php';

class DG_Icdx extends DataGridModelBase
{
	public function __construct()
	{
		parent::__construct('tb_icdx', array('value'));
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
		return parent::select_query_obj();
	}
}
