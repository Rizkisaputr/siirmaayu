<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @property CI_DB_query_builder $db
 * @property DataGridModelBase $DataGridModelBase
 */
require_once 'DataGridModelBase.php';

class DG_Stok_Darah extends DataGridModelBase
{
	public function __construct()
	{
		parent::__construct('tb_stok_darah', array(
				'tb_stok_darah.gol_darah','tb_stok_darah.stok','tb_stok_darah.keterangan','tb_rs.nama'));
	}

	protected function select_query_obj()
	{
		return $this
			->db
			->select('tb_stok_darah.*,tb_rs.nama as nama_rs')
			->join('tb_rs','tb_stok_darah.id_rs=tb_rs.id_rs');
	}
	
	public $id_rs=NULL;
}
