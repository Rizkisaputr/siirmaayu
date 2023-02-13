<?php
/**
 * @property CI_DB_query_builder $db
 * @property DataGridModelBase $DataGridModelBase
 */
require_once 'DataGridModelBase.php';

class DG_Jenis_Layanan extends DataGridModelBase
{
	public function __construct()
	{
		parent::__construct('tb_layanan_type', array('nama'));
	}
}
