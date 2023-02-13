<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @property CI_DB_query_builder $db
 * @property DataGridModelBase $DataGridModelBase
 */
require_once 'DataGridModelBase.php';

class DG_Bed extends DataGridModelBase
{
	private $selection_kelas;
	private $where;
	public function __construct()
	{
		parent::__construct('tb_bed', array('tb_rs.nama','tb_bed.nama','tb_bed.kelas'));
		$this->db->reset_query();
		$this->db->select('id_kelas_bed,nama');
		$selection=array();
		foreach ($this->db->get('tb_kelas_bed')->result() as $row){
			$selection[$row->id_kelas_bed]=$row->nama;
		}
		$this->selection_kelas=$selection;
		$this->setTitleExport('Laporan Bed');
		$this->setCollumnData(array(
			'rs'			=> 'Rumah Sakit',
			'nama'			=> 'Nama',
			'kapasitas_l'	=> 'Kapasitas Laki-Laki',
			'kapasitas_p'	=> 'Kapasitas Perempuan',
			'terpakai_l'	=> 'Terpakai Laki-Laki',
			'terpakai_p'	=> 'Terpakai Perempuan',
			'kosong_l'		=> 'Kosong Laki-Laki',
			'kosong_p'		=> 'Kosong Perempuan',
			'kelas'			=> 'Kelas',
			'tgl_update'	=> 'Update'
		));
		$this->where=array();
	}

	/**
	 * @param bool $where
	 */
	public function setWhere($key,$value)
	{
		$this->where[$key]=$value;
	}

	protected function select_query_obj()
	{
		foreach ($this->where as $key=>$value){
			$this->db->where($key,$value);
		}
		return $this
			->db
			->select('tb_bed.id_bed,tb_bed.nama,tb_rs.nama as nama_rs,tb_bed.kapasitas_l,tb_bed.kapasitas_p,tb_bed.terpakai_l,tb_bed.terpakai_p,tb_kelas_bed.nama as kelas,tb_bed.tgl_update')
			->join('tb_rs','tb_bed.id_rs=tb_rs.id_rs')
			->join('tb_kelas_bed','tb_bed.kelas=tb_kelas_bed.id_kelas_bed');
	}
	protected function template_head()
	{
		return array(
			array('field_name'=>'nama','display_name'=>'Nama Bed'),
			array('field_name'=>'kapasitas_l','display_name'=>'Kapasitas Laki-laki'),
			array('field_name'=>'kapasitas_p','display_name'=>'Kapasitas Perempuan'),
			array('field_name'=>'terpakai_l','display_name'=>'Terpakai Laki-laki'),
			array('field_name'=>'terpakai_p','display_name'=>'Terpakai Perempuan'),
			array('field_name'=>'kelas','display_name'=>'Kelas Bed')
		);
	}
	protected function template_info_data()
	{
		$list_kelas=implode(',',$this->selection_kelas);
		return array(
			'kapasitas_p'	=> 'Untuk Bed unigender field ini tidak perlu diisi',
			'terpakai_p'	=> 'Untuk Bed unigender field ini tidak perlu diisi',
			'kelas'			=> 'Kelas bed, antara lain ['.$list_kelas.']'
		);
	}
	protected function transform_import_row($row)
	{
		if(!$this->id_rs){
			return false;
		}
		$row['id_rs']=$this->id_rs;
		$row['kelas']=array_search($row['kelas'],$this->selection_kelas);
		if($row['kelas']===FALSE)
			return false;
		return parent::transform_import_row($row);
	}
	public $id_rs=NULL;
	protected function export_row_query($args)
	{
		if($args['id_rs']){
			$this->db->where('tb_bed.id_rs',$args['id_rs']);
		}else{
			$this->load->model('User_model');
			$in=$this->User_model->get_all_user_rs($this->ion_auth->get_user_id());
			if($in!==TRUE)
				$this->db->where_in('tb_bed.id_rs',$in);
		}
		if($args['kelas']){
			$this->db->where('tb_bed.kelas',$args['kelas']);
		}
		$this->db->select('tb_rs.nama as rs,tb_bed.nama,tb_bed.kapasitas_l,tb_bed.kapasitas_p,tb_bed.terpakai_l,tb_bed.terpakai_p,(tb_bed.kapasitas_l-tb_bed.terpakai_l) as kosong_l,(tb_bed.kapasitas_p-tb_bed.terpakai_p) as kosong_p,tb_kelas_bed.nama as kelas,tb_kelas_bed.unigender,tb_bed.tgl_update');
		$this->db->join('tb_kelas_bed','tb_bed.kelas=tb_kelas_bed.id_kelas_bed');
		$this->db->join('tb_rs','tb_bed.id_rs=tb_rs.id_rs');
		$this->db->order_by('tb_rs.nama,tb_kelas_bed.nama,tb_bed.tgl_update','ASC');
		return $this->db->get('tb_bed');
	}
	protected function export_data_row_head($sheet, $row_index, $head_data)
	{
		//rs
		$sheet->setCellValueByColumnAndRow(1,$row_index,$head_data['rs']);
		$sheet->getColumnDimensionByColumn(1)->setAutoSize(true);
		$sheet->mergeCellsByColumnAndRow(1,$row_index,1,$row_index+1);
		//bed
		$sheet->setCellValueByColumnAndRow(2,$row_index,$head_data['nama']);
		$sheet->getColumnDimensionByColumn(2)->setAutoSize(true);
		$sheet->mergeCellsByColumnAndRow(2,$row_index,2,$row_index+1);
		//kapasitas l&p
		$sheet->setCellValueByColumnAndRow(3,$row_index,'Kapasitas');
		$sheet->mergeCellsByColumnAndRow(3,$row_index,4,$row_index);
		$sheet->setCellValueByColumnAndRow(3,$row_index+1,'Laki-laki');
		$sheet->getColumnDimensionByColumn(3)->setAutoSize(true);
		$sheet->setCellValueByColumnAndRow(4,$row_index+1,'Perempuan');
		$sheet->getColumnDimensionByColumn(4)->setAutoSize(true);
		//terpakai l&p
		$sheet->setCellValueByColumnAndRow(5,$row_index,'Terpakai');
		$sheet->mergeCellsByColumnAndRow(5,$row_index,6,$row_index);
		$sheet->setCellValueByColumnAndRow(5,$row_index+1,'Laki-laki');
		$sheet->getColumnDimensionByColumn(5)->setAutoSize(true);
		$sheet->setCellValueByColumnAndRow(6,$row_index+1,'Perempuan');
		$sheet->getColumnDimensionByColumn(6)->setAutoSize(true);
		//kosong l&p
		$sheet->setCellValueByColumnAndRow(7,$row_index,'Kosong');
		$sheet->mergeCellsByColumnAndRow(7,$row_index,8,$row_index);
		$sheet->setCellValueByColumnAndRow(7,$row_index+1,'Laki-laki');
		$sheet->getColumnDimensionByColumn(7)->setAutoSize(true);
		$sheet->setCellValueByColumnAndRow(8,$row_index+1,'Perempuan');
		$sheet->getColumnDimensionByColumn(8)->setAutoSize(true);
		//kelas
		$sheet->setCellValueByColumnAndRow(9,$row_index,$head_data['kelas']);
		$sheet->getColumnDimensionByColumn(9)->setAutoSize(true);
		$sheet->mergeCellsByColumnAndRow(9,$row_index,9,$row_index+1);
		//updated
		$sheet->setCellValueByColumnAndRow(10,$row_index,$head_data['tgl_update']);
		$sheet->getColumnDimensionByColumn(10)->setAutoSize(true);
		$sheet->mergeCellsByColumnAndRow(10,$row_index,10,$row_index+1);

		//batch set style
		$style=$sheet->getStyleByColumnAndRow(1,$row_index,count($head_data),$row_index+1);
		$style->getFont()->setBold(TRUE);
		$style->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
		$style->getFill()->getStartColor()->setRGB("F5F5F5");
		return $row_index+1;
	}
	protected function export_row_maker($sheet, $row_index, $row_data)
	{
		if($row_data['unigender']==TRUE){
			$head_conf_keys=array_keys($this->collumn_data);
			foreach ($head_conf_keys as $index=>$head_conf_key){
				switch ($head_conf_key){
					case 'kapasitas_l':
					case 'terpakai_l':
					case 'kosong_l':
						$sheet->setCellValueByColumnAndRow(1+$index,$row_index,$row_data[$head_conf_key]);
						$sheet->mergeCellsByColumnAndRow(1+$index,$row_index,2+$index,$row_index);
						break;
					case 'kapasitas_p':
					case 'terpakai_p':
					case 'kosong_p':
						break;
					default:
						$sheet->setCellValueByColumnAndRow(1+$index,$row_index,$row_data[$head_conf_key]);
				}
			}
			$sheet
				->getStyleByColumnAndRow(1,$row_index,count($head_conf_keys),$row_index)
				->getBorders()
				->getAllBorders()
				->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
		}else{
			parent::export_row_maker($sheet, $row_index, $row_data);
		}
	}
}
