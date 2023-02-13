<?php defined('BASEPATH') OR exit('No direct script access allowed');
require_once 'DataGridModelBase.php';
/**
 * @property CI_DB_query_builder $db
 * @property DataGridModelBase $DataGridModelBase
 * @property Ion_auth $ion_auth
 */

class DG_rujuk_konfirmasi extends DataGridModelBase
{
	private $where;
	public function __construct()
	{
		parent::__construct('tb_rujukan', array('tb_pasien.nama','tb_pasien.umur','tb_pasien.pasangan','tb_pasien.goldarah','tb_rs.nama','tb_rujukan.dibuat','tb_rujukan.alasan_rujukan','tb_rujukan.status_rujukan'));
		$this->setTitleExport('Laporan Rujukan');
		$this->setCollumnData(array(
			'type'			=> 'Kategori Rujukan',
			'pasien'		=> 'Nama Pasien',
			'umur'			=> 'Umur',
			'pasangan'		=> 'Pasangan',
			'goldarah'		=> 'Golongan Darah',
			'perujuk'		=> 'Perujuk',
			'dirujuk'		=> 'Dirujuk',
			'id_rm'			=> 'id_rm',
			'layanan'		=> 'Layanan',
			'kelas_bed'		=> 'Bed',
			'alasan_rujukan'=> 'Alasan Rujukan',
			'pembiayaan'	=> 'Pembiayaan',
			'transportasi'	=> 'Transportasi',
			'media'			=> 'Media',
			'diagnosis'		=> 'Diagnosis',
			'ibuanak_icdx'	=> 'Kode ICD X',
			'kesadaran'		=> 'Kesadaran',
			'tensi'			=> 'Tensi',
			'nadi'			=> 'Nadi',
			'suhu'			=> 'Suhu',
			'pernapasan'	=> 'Pernapasan',
			'nyeri'			=> 'Nyeri',
			'keterangan_lain'=> 'Keterangan Lain',
			'hasil_lab'		=> 'Hasil Lab',
			'hasil_radiologi_ekg'=> 'Hasil Radiologi',
			'tindakan'		=> 'Tindakan',
			'status_rujukan'=> 'Status Rujukan',
			'info_rujuk_balik'=> 'Balasan',
			'rujukbalik_fu_id'=> 'rujukbalik_fu_id',
			'rujukbalik_fu_tanggal' => 'rujukbalik_fu_tanggal',
			'dibuat'		=> 'Dibuat',
			'direspon'		=> 'Direspon'
		));
		$this->where=array();
	}

	protected function select_query_obj()
	{

		foreach ($this->where as $key=>$value){
			$this->db->where($key,$value);
		}
		return $this
			->db
			->select('tb_rujukan.type,tb_rujukan.ibuanak_icdx,tb_rujukan.id_rujukan,tb_pasien.nama AS pasien,tb_rs.nama AS rs,tb_rujukan.dibuat,
				tb_rujukan.rujukbalik_tanggal tanggal,
				tb_rujukan.rujukbalik_status status,
				tb_rujukan.rujukbalik_tindakan tindakan, 
				tb_rujukan.rujukbalik_diagnosa diagnosa,
				tb_rujukan.rujukbalik_fu_tanggal tgl_fu,
				tb_rujukan.rujukbalik_fu_id id_fu,
				fu.nama as tempat')
			->where_in('rujukbalik_status',array('Meninggal Dunia','Pulang'))
			->join('tb_rs','tb_rujukan.id_rs_perujuk = tb_rs.id_rs')
			->join('tb_rs fu','tb_rujukan.rujukbalik_fu_id = fu.id_rs','left')
			->join('users as penerima','penerima.id=tb_rujukan.id_penerima','left')
			->join('tb_pasien','tb_rujukan.no_rm = tb_pasien.id_rm');
	}
	
	public function setWhere($key,$value)
	{
		$this->where[$key]=$value;
	}

	public function get_namars_selection()
	{
		$data_namars = $this->db->like('nama','RS', 'both');
		$data_namars = $this->db->or_like('nama','rumah sakit', 'both');
		$data_namars = $this->db->or_like('nama','sakit', 'both');
		$data_namars = $this->db->get('tb_rs');
		$selection = array('' => ' -- Pilih Nakes Perujuk-- ');
		foreach($data_namars->result() as $d)
		{
			$selection[$d->nama]=$d->nama;
		}

		return $selection;
	}
	

}
