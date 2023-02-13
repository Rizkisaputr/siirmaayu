<?php
/**
 * @property CI_DB_query_builder $db
 * @property DataGridModelBase $DataGridModelBase
 */
require_once 'DataGridModelBase.php';

class DG_Kelas_Bed extends DataGridModelBase
{
	public function __construct()
	{
		parent::__construct('tb_kelas_bed', array('nama'));
	}
}
