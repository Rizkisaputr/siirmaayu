<?php
/**
 * @property CI_DB_query_builder $db
 * @property DataGridModelBase $DataGridModelBase
 */
require_once 'DataGridModelBase.php';

class DG_Jenis_RS extends DataGridModelBase
{
	const ENUM_TYPE='jenis_rs';
	public function __construct()
	{
		parent::__construct('tb_enum', array('value'));
	}
	public function insert_data($data = array())
	{
		$data['type_enum']=self::ENUM_TYPE;
		return parent::insert_data($data);
	}
	public function update_data($where = array(), $data = array())
	{
		$data['type_enum']=self::ENUM_TYPE;
		return parent::update_data($where, $data);
	}
	protected function select_query_obj()
	{
		$this->db->where('type_enum',self::ENUM_TYPE);
		return parent::select_query_obj();
	}
}
