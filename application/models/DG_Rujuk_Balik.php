<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @property CI_DB_query_builder $db
 * @property DataGridModelBase $DataGridModelBase
 */
require_once 'DataGridModelBase.php';

class DG_Rujuk_Balik extends DataGridModelBase
{
	public function __construct()
	{
		parent::__construct('tb_rujukan', array('tb_pasien.type','tb_pasien.nama','tb_pasien.goldarah','tb_pasien.umur','tb_pasien.pasangan','tb_pasien.goldarah','tb_rs.nama','tb_rujukan.type','tb_rujukan.dibuat','tb_rujukan.alasan_rujukan','tb_rujukan.status_rujukan,tb_rujukan.rujukbalik_status'));
		$this->setTitleExport('Laporan Rujukan Diterima');
		$this->collumn_data=array(
			'type'			=> 'Kategori Rujukan',
			'pasien'		=> 'Nama Pasien',
			'umur'			=> 'Umur',
			'pasangan'		=> 'Penanggung Jawab',
			'goldarah'		=> 'Golongan Darah',
			'perujuk'		=> 'Perujuk',
			'dirujuk'		=> 'Penerima Rujukan',
			'layanan'		=> 'Layanan',
			'kelas_bed'		=> 'Ruangan / Bed',
			'alasan_rujukan'=> 'Alasan Rujukan',
			'pembiayaan'	=> 'Pembiayaan',
			'transportasi'	=> 'Transportasi',
			'media'			=> 'Media Kom',
			'no_rm'			=> 'no_rm',
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
			'tindakan'		=> 'Tindakan Pra-Rujukan',
			'status_rujukan'=> 'Status Rujukan',
			'info_rujuk_balik'=> 'Advis / Instruksi RS',
			'dibuat'		=> 'Waktu Dibuat',
			'direspon'		=> 'Waktu Direspon'		
		);
	}

	public function get_rujukan_info($id){
		$this->db->reset_query();
		$this->db->select('tb_rujukan.type,tb_rujukan.id_rujukan as "ID Rujukan",tb_pasien.nama AS pasien,tb_pasien.goldarah as goldarah, dirujuk.nama AS dirujuk,tb_rujukan.media,tb_rujukan.type,dirujuk.id_rs as id_dirujuk,perujuk.nama AS perujuk,tb_kelas_bed.nama as "Kelas Bed",tb_layanan_type.nama as "Layanan",tb_rujukan.transportasi,tb_rujukan.no_rm, tb_rujukan.alasan_rujukan as "Alasan Rujukan",tb_rujukan.diagnosis,tb_rujukan.ibuanak_icdx,tb_rujukan.kesadaran,tb_rujukan.tensi,tb_rujukan.nadi,tb_rujukan.suhu,tb_rujukan.pernapasan,tb_rujukan.transportasi,tb_rujukan.nyeri,tb_rujukan.keterangan_lain as "Keterangan Lain",tb_rujukan.hasil_lab as Hasil Lab,tb_rujukan.hasil_radiologi_ekg as "Hasil Radiologi",tb_rujukan.tindakan,tb_rujukan.status_rujukan as "Status Rujukan",tb_rujukan.dibuat,tb_rujukan.pembiayaan,tb_rujukan.media,tb_rujukan.attachment_1,tb_rujukan.attachment_2,tb_rujukan.attachment_3,pengalih.nama as pengalih,tb_rujukan.rujukbalik_status,
			tb_rujukan.ibuanak_nobidan,
			tb_rujukan.ibuanak_namabidan,
			tb_rujukan.ibuanak_kodebidan,
			tb_pasien.umur,
			tb_pasien.pasangan,
			tb_pasien.goldarah,
			tb_pasien.nik,
			tb_rujukan.sms_rujukan
			');
		$this->db->join('tb_pasien','tb_rujukan.no_rm = tb_pasien.id_rm');
		$this->db->join('tb_rs dirujuk','dirujuk.id_rs = tb_rujukan.id_rs_dirujuk');
		$this->db->join('tb_rs perujuk','perujuk.id_rs = tb_rujukan.id_rs_perujuk');
		$this->db->join('tb_rs pengalih','pengalih.id_rs = tb_rujukan.id_rs_pengalih','left');
		$this->db->join('tb_kelas_bed','tb_rujukan.id_kelas_bed = tb_kelas_bed.id_kelas_bed','left');
		$this->db->join('tb_layanan_type','tb_rujukan.id_jenis_layanan = tb_layanan_type.id_jenis_layanan','left');
		$this->db->where('tb_rujukan.id_rujukan',$id);
		return $this->db->get('tb_rujukan')->row_array();
	}


	protected function export_row_query($args)
	{
		if($args['id_rs']){
			$this->db->where('dirujuk.id_rs',$args['id_rs']);
		}else{
			$this->load->model('User_model');
			$in=$this->User_model->get_all_user_rs($this->ion_auth->get_user_id());
			if($in!==TRUE)
				$this->db->where_in('dirujuk.id_rs',$in);
		}
		if(!is_null($args['start'])&&!is_null($args['end'])){
			$start	= $args['start'];
			$end	= $args['end'];
			$this->db->where("DATE(tb_rujukan.dibuat) BETWEEN '$start' AND '$end'",NULL,FALSE);
		}
		$this->db->select('tb_rujukan.type,tb_pasien.nama as pasien,tb_pasien.umur as umur, tb_pasien.pasangan as pasangan, tb_pasien.goldarah as goldarah, perujuk.nama as perujuk,dirujuk.nama as dirujuk, tb_rujukan.no_rm, tb_rujukan.alasan_rujukan,tb_rujukan.pembiayaan,tb_rujukan.transportasi,tb_rujukan.diagnosis,tb_rujukan.ibuanak_icdx,tb_rujukan.kesadaran,tb_rujukan.tensi,tb_rujukan.nadi,tb_rujukan.suhu,tb_rujukan.pernapasan,tb_rujukan.nyeri,tb_rujukan.keterangan_lain,tb_rujukan.hasil_lab,tb_rujukan.hasil_radiologi_ekg,tb_rujukan.tindakan,tb_rujukan.media,tb_rujukan.status_rujukan,tb_rujukan.info_rujuk_balik,tb_rujukan.dibuat,tb_rujukan.direspon,tb_layanan_type.nama AS layanan,tb_kelas_bed.nama as kelas_bed,pengalih.nama as pengalih');
		$this->db->join('tb_rs perujuk','perujuk.id_rs=tb_rujukan.id_rs_perujuk');
		$this->db->join('tb_rs dirujuk','dirujuk.id_rs=tb_rujukan.id_rs_dirujuk');
		$this->db->join('tb_rs pengalih','pengalih.id_rs = tb_rujukan.id_rs_pengalih','left');
		$this->db->join('tb_pasien','tb_rujukan.no_rm=tb_pasien.id_rm');
		$this->db->join('tb_kelas_bed','tb_rujukan.id_kelas_bed=tb_kelas_bed.id_kelas_bed','left');
		$this->db->join('tb_layanan_type','tb_rujukan.id_jenis_layanan=tb_layanan_type.id_jenis_layanan','left');
		return parent::export_row_query($args);
	}
	protected function export_row_head($sheet, $row_index, $args)
	{
		if(!is_null($args['start'])&&!is_null($args['end'])){
			//$sheet->mergeCellsByColumnAndRow(1,$row_index,count($this->collumn_data),$row_index);
			//$sheet->setCellValueByColumnAndRow(1,$row_index,'Instansi '.$id_rs);
			//$sheet->getStyleByColumnAndRow(1,$row_index)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
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
