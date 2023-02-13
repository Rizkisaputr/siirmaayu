<?php defined('BASEPATH') OR exit('No direct script access allowed');
require_once 'DataGridModelBase.php';
/**
 * @property CI_DB_query_builder $db
 * @property DataGridModelBase $DataGridModelBase
 * @property Ion_auth $ion_auth
 */

class DG_rujuk extends DataGridModelBase
{
	private $where;
	public function __construct()
	{
		parent::__construct('tb_rujukan', array('tb_pasien.nama','tb_pasien.goldarah','tb_rs.nama','tb_rujukan.type','tb_rujukan.dibuat','tb_rujukan.alasan_rujukan','tb_rujukan.status_rujukan'));
		$this->setTitleExport('Laporan Rujukan');
		$this->setCollumnData(array(
			'type'			=> 'Kategori Rujukan',
			'pasien'		=> 'Nama Pasien',
			'umur'			=> 'Umur',
			'pasangan'		=> 'Penanggung Jawab',
			'goldarah'		=> 'Golongan Darah',
			'perujuk'		=> 'Perujuk',
			'media'			=> 'Media Kom',
			'ibuanak_nobidan'		=> 'Nomor Perujuk',
			'ibuanak_namabidan'		=> 'Nama Perujuk',	
			'dirujuk'		=> 'Tujuan Rujukan',
			'no_rm'			=> 'no_rm',
			'layanan'		=> 'Layanan',
			'kelas_bed'		=> 'Ruangan / Bed',
			'alasan_rujukan'=> 'Alasan Rujukan',
			'pembiayaan'	=> 'Pembiayaan',
			'transportasi'	=> 'Transportasi',
			'diagnosis'		=> 'Diagnosis',
			'ibuanak_icdx'	=> 'Kode ICD X', 	
			'tindakan'		=> 'Tindakan',
			'kesadaran'		=> 'Kesadaran',
			'tensi'			=> 'Tensi',
			'nadi'			=> 'Nadi',
			'suhu'			=> 'Suhu',
			'pernapasan'	=> 'Pernapasan',
			'nyeri'			=> 'Nyeri',
			'keterangan_lain'=> 'Keterangan Lain',
			'hasil_lab'		=> 'Hasil Lab',
			'hasil_radiologi_ekg'=> 'Hasil Radiologi',
			'tindakan'		=> 'Tindakan Pra-Rujukan',
			'status_rujukan'=> 'Status Rujukan',
			'info_rujuk_balik'=> 'Advis / Instruksi RS',
			'dibuat'		=> 'Waktu Dibuat',
			'direspon'		=> 'Waktu Direspons'
			//'sms_rujukan'	=> 'Nomor SMS',
			//'wa_rujukan'	=> 'Nomor WA',
			


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
			->select('tb_rujukan.type,tb_rujukan.id_rujukan,tb_pasien.nama AS pasien,tb_pasien.umur AS umur, tb_pasien.pasangan as pasangan, tb_pasien.goldarah as goldarah, tb_rs.nama AS rs,p.nama AS perujuk, tb_rujukan.dibuat,tb_rujukan.alasan_rujukan,tb_rujukan.pembiayaan,tb_rujukan.tindakan,tb_rujukan.media,tb_rujukan.transportasi, tb_rujukan.no_rm,tb_rujukan.status_rujukan,penerima.full_name,pengalih.nama as pengalih,tb_rujukan.info_rujuk_balik, tb_rujukan.diagnosis,tb_rujukan.kesadaran,tb_rujukan.tensi,tb_rujukan.nadi,tb_rujukan.suhu,tb_rujukan.pernapasan,tb_rujukan.nyeri,tb_rujukan.ibuanak_namabidan,tb_rujukan.ibuanak_nobidan,tb_rujukan.rujukbalik_status')
			->join('tb_rs p','tb_rujukan.id_rs_perujuk = p.id_rs')
			->join('tb_rs','tb_rujukan.id_rs_dirujuk = tb_rs.id_rs')
			->join('tb_rs pengalih','pengalih.id_rs = tb_rujukan.id_rs_pengalih','left')
			->join('users as penerima','penerima.id=tb_rujukan.id_penerima','left')
			->join('tb_pasien','tb_rujukan.no_rm = tb_pasien.id_rm');
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

	public function get_kelas_bed_selection(){
		//$selection=array('0'=>'Semua'); ini akan menampilkan semua bed kelas
		$this->db->select('id_kelas_bed,nama');
		foreach ($this->db->get('tb_kelas_bed')->result() as $row){
			$selection[$row->id_kelas_bed]=$row->nama;
		}
		return $selection;
	}
	public function get_layanan_selection(){
		//$selection=array('0'=>'Semua');  ini akan menampilkan semua layanan
		$this->db->select('id_jenis_layanan,nama');
		foreach ($this->db->get('tb_layanan_type')->result() as $row){
			$selection[$row->id_jenis_layanan]=$row->nama;
		}
		return $selection;
	}
	public function insert_pasien(array $data){
		return $this->db->insert('tb_pasien',$data) ? $this->db->insert_id() : false;
	}
	public function get_single_pasien_selected(array $filter){
		$this->db->reset_query();
		foreach ($filter as $f=>$w){
			$this->db->where($f,$w);
		}
		$this->db->select('id_rm,nama');
		$row=$this->db->get('tb_pasien')->row();
		if($row)
			return array($row->id_rm=>$row->nama);
		return array();
	}

	public function get_pasien($id)
	{
		$this->db->where('id_rm',$id);
		return $this->db->get('tb_pasien')->row();

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
		$this->db->select('tb_pasien.nama as pasien,tb_pasien.umur as umur,tb_pasien.pasangan as pasangan,tb_pasien.goldarah as goldarah, perujuk.nama as perujuk,dirujuk.nama as dirujuk,tb_rujukan.media,tb_rujukan.type,tb_rujukan.no_rm, tb_rujukan.alasan_rujukan,tb_rujukan.pembiayaan,tb_rujukan.transportasi,tb_rujukan.no_rm,tb_rujukan.diagnosis,tb_rujukan.ibuanak_icdx,tb_rujukan.kesadaran,tb_rujukan.tensi,tb_rujukan.nadi,tb_rujukan.suhu,tb_rujukan.pernapasan,tb_rujukan.nyeri,tb_rujukan.keterangan_lain,tb_rujukan.hasil_lab,tb_rujukan.hasil_radiologi_ekg,tb_rujukan.tindakan,tb_rujukan.status_rujukan,tb_rujukan.info_rujuk_balik,tb_rujukan.dibuat,tb_rujukan.direspon,tb_rujukan.ibuanak_namabidan,tb_rujukan.ibuanak_nobidan,tb_layanan_type.nama AS layanan,tb_kelas_bed.nama as kelas_bed');
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

	public function get_ambulance() {
		$selection = array('' => ' -- Pilih Ambulance -- ');

		foreach ($this->db->get('tb_ambulance')->result() as $row){
			$selection[$row->id_ambulance]=$row->nopol;
		}
		return $selection;
	}

	public function get_bidan()
	{
		$data_bidan = $this->db->like('profesi_name','bidan', 'both')->get('tb_nakes');
		//$data_dokter = $this->db->like('profesi_name','dokter', 'both')->get('tb_nakes');
		$selection = array('' => ' -- Pilih Nakes Perujuk-- ');
		foreach($data_bidan->result() as $d)
		{
			$selection[$d->id_nakes]=$d->nama;
		}

		return $selection;
	}

	public function get_dokter()
	{
		$data_dokter = $this->db->like('profesi_name','dokter', 'both')->get('tb_nakes');
		$selection = array('' => ' -- Pilih Nakes Perujuk-- ');
		foreach($data_dokter->result() as $d)
		{
			$selection[$d->id_nakes]=$d->nama;
		}

		return $selection;
	}

	public function get_bidandokter()
	{
		$data_bidandokter = $this->db->like('profesi_name','dokter', 'both');
		$data_bidandokter = $this->db->or_like('profesi_name','bidan', 'both');
		$data_bidandokter = $this->db->or_like('profesi_name','perawat', 'both');
		$data_bidandokter = $this->db->get('tb_nakes');
		$selection = array('' => ' -- Pilih Nakes Perujuk-- ');
		foreach($data_bidandokter->result() as $d)
		{
			$selection[$d->id_nakes]=$d->nama;
		}

		return $selection;
	}

	public function get_namabidan()
	{
		$data_namabidan = $this->db->like('profesi_name','bidan', 'both')->get('tb_nakes');

		$selection = array('' => ' -- Pilih Nakes Perujuk-- ');
		foreach($data_namabidan->result() as $d)
		{
			$selection[$d->nama]=$d->nama;
		}

		return $selection;
	}

	public function get_namadokter()
	{
		$data_namadokter = $this->db->like('profesi_name','dokter', 'both')->get('tb_nakes');

		$selection = array('' => ' -- Pilih Nakes Perujuk-- ');
		foreach($data_namadokter->result() as $d)
		{
			$selection[$d->nama]=$d->nama;
		}

		return $selection;
	}

	public function get_namabidandokter()
	{
		$data_namabidandokter = $this->db->like('profesi_name','dokter', 'both');
		$data_namabidandokter = $this->db->or_like('profesi_name','bidan', 'both');
		$data_namabidandokter = $this->db->or_like('profesi_name','perawat', 'both');
		$data_namabidandokter = $this->db->get('tb_nakes');
		$selection = array('' => ' -- Pilih Nakes Perujuk-- ');
		foreach($data_namabidandokter->result() as $d)
		{
			$selection[$d->nama]=$d->nama;
		}

		return $selection;
	}

			
	public   function  get_hp($ibuanak_nobidan)  {

        
        //  bila  penulisan  no  hp  0812  339  545

        $ibuanak_nobidan  =  str_replace("  ","",$ibuanak_nobidan);

        //  bila  penulisan  no  hp  (0274)  778787

        $ibuanak_nobidan  =  str_replace("(","",$ibuanak_nobidan);

        //  bila  penulisan  no  hp  (0274)  778787

        $ibuanak_nobidan  =  str_replace(")","",$ibuanak_nobidan);

        //  bila  penulisan  no  hp  0811.239.345

        $ibuanak_nobidan  =  str_replace(".","",$ibuanak_nobidan);

		//$ibuanak_nobidan = $this->db->get('tb_rujukan');

        //  bila  no  hp  terdapat  karakter  +  dan  0-9

        if(!preg_match('/[^+0-9]/',trim($ibuanak_nobidan))){

                //  cek  karakter  1-3  apakah  +62

                if(substr(trim($ibuanak_nobidan),  0,  3)=='62'){

                        $hp  =  trim($ibuanak_nobidan);

                }

                //  cek  karakter  1  apakah  0

                elseif(substr(trim($ibuanak_nobidan),  0,  1)=='0'){

                        $hp  =  '62'.substr(trim($ibuanak_nobidan),  1);

                }

        }

		}

 
      
}