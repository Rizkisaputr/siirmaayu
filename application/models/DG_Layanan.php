<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @property CI_DB_query_builder $db
 * @property DataGridModelBase $DataGridModelBase
 */
require_once 'DataGridModelBase.php';

class DG_Layanan extends DataGridModelBase
{
	public function __construct()
	{
		parent::__construct('tb_layanan', array('tb_layanan_type.nama','tb_layanan.jumlah','tb_rs.nama'));
	}

	protected function select_query_obj()
	{
		return $this
			->db
			->select('tb_layanan.id_layanan,tb_layanan.jumlah,tb_layanan_type.nama,tb_rs.nama')
			->join('tb_rs','tb_layanan.id_rs=tb_rs.id_rs')
			->join('tb_layanan_type','tb_layanan.id_jenis_layanan=tb_layanan_type.id_jenis_layanan');
	}
}
