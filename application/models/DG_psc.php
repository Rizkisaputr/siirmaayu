<?php defined('BASEPATH') OR exit('No direct script access allowed');
require_once 'DataGridModelBase.php';
/**
 * @property CI_DB_query_builder $db
 * @property DataGridModelBase $DataGridModelBase
 * @property Ion_auth $ion_auth
 */

class DG_psc extends DataGridModelBase
{
	private $where;
	public function __construct()
	{
		parent::__construct('tb_psc', array('tb_pasien.nama','tb_rs.nama','tb_rujukan.dibuat','tb_rujukan.alasan_rujukan','tb_rujukan.status_rujukan'));
		$this->setTitleExport('Laporan Rujukan');
		$this->setCollumnData(array(
			'pasien'		=> 'Nama Pasien',
			'perujuk'		=> 'Perujuk',
			'dirujuk'		=> 'Dirujuk',
			'layanan'		=> 'Layanan',
			'kelas_bed'		=> 'Bed',
			'alasan_rujukan'=> 'Alasan Rujukan',
			'pembiayaan'	=> 'Pembiayaan',
			'diagnosis'		=> 'Diagnosis',
			'kesadaran'		=> 'Kesadaran',
			'tensi'			=> 'Tensi',
			'nadi'			=> 'Nadi',
			'suhu'			=> 'Suhu',
			'pernapasan'	=> 'Pernapasan',
			'nyeri'			=> 'Nyeri',
			'keterangan_lain'=> 'Keterangan Lain',
			'hasil_lab'		=> 'Hasil Lab',
			'hasil_radiologi_ekg'=> 'Hasil Radiologi',
			'tindakan'		=> 'Pembiayaan',
			'status_rujukan'=> 'Status Rujukan',
			'info_rujuk_balik'=> 'Balasan',
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
			->select('tb_psc.*,tb_rs.nama AS nama_rs')
			->join('tb_rs','tb_psc.id_rs = tb_rs.id_rs');
	}

	
	public function setWhere($key,$value)
	{
		$this->where[$key]=$value;
	}

	public function get_rs_selection($not,$in=array(),$admin=FALSE){
		$this->db->reset_query();
		if($admin===FALSE){
			if($not){
				$this->db->where_not_in('id_rs',$in);
			}else{
				$this->db->where_in('id_rs',$in);
			}
		}
		$selection=array();
		$this->db->select('id_rs,nama')->order_by('nama');
		foreach ($this->db->get('tb_rs')->result() as $row){
			$selection[$row->id_rs]=$row->nama;
		}
		return $selection;
	}
	public function get_kelas_bed_selection(){
		$selection=array('0'=>'Semua');
		$this->db->select('id_kelas_bed,nama');
		foreach ($this->db->get('tb_kelas_bed')->result() as $row){
			$selection[$row->id_kelas_bed]=$row->nama;
		}
		return $selection;
	}
	public function get_layanan_selection(){
		$selection=array('0'=>'Semua');
		$this->db->select('id_jenis_layanan,nama');
		foreach ($this->db->get('tb_layanan_type')->result() as $row){
			$selection[$row->id_jenis_layanan]=$row->nama;
		}
		return $selection;
	}
	
	public function rs_recomendation($kelas,$layanan,$perujuk=NULL){
		$i_q_bed=$this
			->db
			->where('tb_rs.id_rs=tb_bed.id_rs')
			->where('tb_bed.kelas',$kelas)
			->get_compiled_select('tb_bed');
		$i_q_layanan=$this
			->db
			->where('tb_rs.id_rs=tb_layanan.id_rs')
			->where('tb_layanan.id_jenis_layanan',$layanan)
			->get_compiled_select('tb_layanan');
		$q_distance='"?" as distance_in_km';
		if($perujuk){
			$posisi_perujuk=$this
				->db
				->select('pos_lat,pos_lon')
				->where('id_rs',$perujuk)
				->get('tb_rs')->row();
			if($posisi_perujuk){
				$perujuk_lat=$posisi_perujuk->pos_lat;
				$perujuk_lon=$posisi_perujuk->pos_lon;
				if(is_numeric($perujuk_lat)&&is_numeric($perujuk_lon)){
					$q_distance="111.1111 *DEGREES(ACOS(COS(RADIANS($perujuk_lat))* COS(RADIANS(pos_lat))* COS(RADIANS($perujuk_lon) - RADIANS(pos_lon))+ SIN(RADIANS($perujuk_lat))* SIN(RADIANS(pos_lat)))) AS distance_in_km";
					$this->db->order_by('distance_in_km','ASC');
				}
			}
		}

		$this->db->select("tb_rs.id_rs,tb_rs.nama,$q_distance",FALSE);
		if(!is_null($kelas)&&$kelas!=0){
			$this->db->where("EXISTS($i_q_bed)",NULL,FALSE);
		}
		if(!is_null($layanan)&&$layanan!=0){
			$this->db->where("EXISTS($i_q_layanan)",NULL,FALSE);
		}
		$this->db->order_by('tb_rs.nama','ASC');
		return $this->db->get('tb_rs')->result();
	}

	protected function export_row_query($args)
	{
		if($args['id_rs']){
			$this->db->where('perujuk.id_rs',$args['id_rs']);
		}else{
			$this->load->model('User_model');
			$in=$this->User_model->get_all_user_rs($this->ion_auth->get_user_id());
			if($in!==TRUE)
				$this->db->where_in('perujuk.id_rs',$in);
		}
		if(!is_null($args['start'])&&!is_null($args['end'])){
			$start	= $args['start'];
			$end	= $args['end'];
			$this->db->where("DATE(tb_rujukan.dibuat) BETWEEN '$start' AND '$end'",NULL,FALSE);
		}
		$this->db->select('tb_pasien.nama as pasien,perujuk.nama as perujuk,dirujuk.nama as dirujuk,tb_rujukan.alasan_rujukan,tb_rujukan.pembiayaan,tb_rujukan.transportasi,tb_rujukan.diagnosis,tb_rujukan.kesadaran,tb_rujukan.tensi,tb_rujukan.nadi,tb_rujukan.suhu,tb_rujukan.pernapasan,tb_rujukan.nyeri,tb_rujukan.keterangan_lain,tb_rujukan.hasil_lab,tb_rujukan.hasil_radiologi_ekg,tb_rujukan.tindakan,tb_rujukan.status_rujukan,tb_rujukan.info_rujuk_balik,tb_rujukan.dibuat,tb_rujukan.direspon,tb_layanan_type.nama AS layanan,tb_kelas_bed.nama as kelas_bed');
		$this->db->join('tb_rs perujuk','perujuk.id_rs=tb_rujukan.id_rs_perujuk');
		$this->db->join('tb_rs dirujuk','dirujuk.id_rs=tb_rujukan.id_rs_dirujuk');
		$this->db->join('tb_pasien','tb_rujukan.no_rm=tb_pasien.id_rm');
		$this->db->join('tb_kelas_bed','tb_rujukan.id_kelas_bed=tb_kelas_bed.id_kelas_bed','left');
		$this->db->join('tb_layanan_type','tb_rujukan.id_jenis_layanan=tb_layanan_type.id_jenis_layanan','left');
		return parent::export_row_query($args);
	}
	protected function export_row_head($sheet, $row_index, $args)
	{
		if(!is_null($args['start'])&&!is_null($args['end'])){
			$sheet->mergeCellsByColumnAndRow(1,$row_index,count($this->collumn_data),$row_index);
			$sheet->setCellValueByColumnAndRow(1,$row_index,'Tanggal '.$args['start'].' sampai '.$args['end']);
			$sheet->getStyleByColumnAndRow(1,$row_index)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
			$row_index++;
		}
		return parent::export_row_head($sheet, $row_index, $args);
	}
	protected function export_row_maker($sheet, $row_index, $row_data)
	{
		parent::export_row_maker($sheet, $row_index, $row_data);
	}
}
