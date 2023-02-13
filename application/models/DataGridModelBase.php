<?php defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;
/**
 * @property CI_DB_query_builder $db
 * @property CI_Upload $upload
 */

class DataGridModelBase extends CI_Model
{
	private $table;
	private $searchable;
	private $in;

	/**
	 * DataGridModelBase constructor.
	 * @param $table
	 * @param array $searchable
	 */
	public function __construct($table, array $searchable=array())
	{
		parent::__construct();
		$this->table			= $table;
		$this->searchable		= $searchable;
		$this->select_query_obj = $this->db;
		$this->in				= NULL;
		foreach ($this->db->list_fields($this->table) as $field){
			$this->collumn_data[$field]=$field;
		}
	}

	/**
	 * Get data grid list
	 * @param int $limit
	 * @param int $offset
	 * @param null $q
	 * @param array $order
	 * @return array
	 */
	public function get($limit=10, $offset=0, $q=NULL, $order=array()){
		$this->db->reset_query();
		if($q){
			$this->db->group_start();
			foreach ($this->searchable as $search_field){
				$this->db->or_like($search_field,$q);
			}
			$this->db->group_end();
		}
		if(count($order)>1){
			$this->db->order_by($order[0],$order[1]);
		}
		return $this
			->_query()
			->get($this->table,$limit,$offset)->result();
	}

	/**
	 * get total data
	 * @return int
	 */
	public function total(){
		$this->db->reset_query();
		return $this->_query()->count_all_results($this->table);
	}

	/**
	 * get total filtered data
	 * @param null $q
	 * @return int
	 */
	public function total_filtered($q=NULL){
		$this->db->reset_query();
		if($q){
			foreach ($this->searchable as $search_field){
				$this->db->or_like($search_field,$q);
			}
		}
		return $this->_query()->count_all_results($this->table);
	}

	/**
	 * Getting single data from table
	 * @param array $where
	 * @return mixed
	 */
	public function get_single_data($where=array()){
		$this->db->reset_query();
		foreach ($where as $field=>$value){
			$this->db->where($field,$value);
		}
		return $this->db->get($this->table)->row_array();
	}

	/**
	 * Delete data
	 * @param array $where
	 * @return mixed
	 */
	public function delete_data($where=array()){
		$this->db->reset_query();
		foreach ($where as $field=>$value){
			$this->db->where($field,$value);
		}
		return $this->db->delete($this->table);
	}

	/**
	 * Insert data
	 * @param array $data
	 * @return mixed
	 */
	public function insert_data($data=array()){
		return $this->db->insert($this->table,$data) ? $this->db->insert_id() : false;
	}

	/**
	 * Update data
	 * @param array $where
	 * @param array $data
	 * @return bool
	 */
	public function update_data($where=array(), $data=array()){
		return $this->db->update($this->table,$data,$where);
	}

	/**
	 * Set table
	 * @param mixed $table
	 */
	public function setTable($table)
	{
		$this->table = $table;
	}

	/**
	 * Set Searchable
	 * @param array $searchable
	 */
	public function setSearchable($searchable)
	{
		$this->searchable = $searchable;
	}

	/**
	 * Set In
	 * @param array $searchable
	 */
	public function setIn($key,$in,$not=false)
	{
		$this->in = array('key'=>$key,'in'=>$in,'not'=>$not);
	}

	/**
	 * Overide this to make custom query
	 * @return CI_DB_query_builder
	 */
	protected function select_query_obj(){
		return $this->db;
	}

	/**
	 * Don't overide this
	 */
	private final function _query(){
		if(is_array($this->in)){
			if(isset($this->in['key'])&&isset($this->in['in'])){
				if($this->in['not'])
					$this->db->where_not_in($this->in['key'],$this->in['in']);
				else
					$this->db->where_in($this->in['key'],$this->in['in']);
			}
		}
		return $this->select_query_obj();
	}

	/**
	 * Overide this to make template header
	 * @return array
	 */
	protected function template_head(){
		$header=array();
		foreach ($this->db->field_data($this->table) as $field){
			if(!$field->primary_key){
				array_push($header,array('field_name'=>$field->name,'display_name'=>ucwords(str_replace('_',' ',$field->name))));
			}
		}
		return $header;
	}


	protected final function template_info($header=array()){
		$penjelasan=array();
		$info_data=$this->template_info_data();
		//With header data, we can make info here
		foreach ($header as $head){
			if(isset($info_data[$head['field_name']]))
				array_push($penjelasan,$head['display_name'].' : '.$info_data[$head['field_name']]);
		}
		//end of header info
		return $penjelasan;
	}

	/**
	 * Override this to make info
	 * @return array
	 */
	protected function template_info_data(){
		return array();
	}

	/**
	 * Avoid overiding this
	 * @param $headers
	 * @return Spreadsheet
	 * @throws \PhpOffice\PhpSpreadsheet\Exception
	 */
	protected final function make_excel($headers){
		$spreadsheet=new Spreadsheet();
		$sheet=$spreadsheet->getActiveSheet();
		$sheet->getPageSetup()->setFitToWidth(TRUE);
		foreach ($headers as $index=>$head_info){
			$sheet->setCellValueByColumnAndRow(1+$index,1,$head_info['display_name']);
			$sheet->getColumnDimensionByColumn(1+$index)->setAutoSize(true);
			$style=$sheet->getStyleByColumnAndRow(1+$index,1);
			$style->getFont()->setBold(TRUE);
			$style->getBorders()->getOutline()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
			$style->getFill()->getStartColor()->setRGB("F5F5F5");
		}
		$penjelasan=$this->template_info($headers);
		if(count($penjelasan)>0){
			$max_col=count($headers);
			$sheet->setCellValueByColumnAndRow($max_col+2,1,'INFO');
			$style=$sheet->getStyleByColumnAndRow($max_col+2,1);
			$style->getFont()->setBold(TRUE);
			foreach ($penjelasan as $index=>$info){
				$sheet->setCellValueByColumnAndRow($max_col+2,2+$index,$info);
			}
		}
		return $spreadsheet;
	}
	/**
	 * Generate Template, avoid to overide this
	 */
	public final function make_template(){
		$spreadsheet=$this->make_excel($this->template_head());
		$writer=new Xlsx($spreadsheet);

		$filename='Template Import '.$this->table;
		// Redirect output to a client’s web browser (Xlsx)
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="'.$filename.'.xlsx"');
		header('Cache-Control: max-age=0');
		// If you're serving to IE 9, then the following may be needed
		header('Cache-Control: max-age=1');
		// If you're serving to IE over SSL, then the following may be needed
		header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
		header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
		header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
		header('Pragma: public'); // HTTP/1.0

		$writer->save('php://output');
		exit();
	}

	/**
	 * Overide this to change import row
	 * @param $row
	 * @return mixed
	 */
	protected function transform_import_row($row){
		return $row;
	}

	/**
	 * Import excel ke db, avoid to overide this
	 * @param $field_name
	 * @return array
	 */
	public final function import_excel($field_name){
		$file_data=null;
		$return_value=array('status'=>FALSE,'message'=>'Unknown Error');
		try{
			$config =array();
			$config['upload_path']          = FCPATH.'assets/public/import/';
			$config['allowed_types']        = 'gif|jpg|png|docx|doc|xls|xlsx|pdf';
			$config['max_size']             = 2048;
			$config['encrypt_name']			= TRUE;
			$this->load->library('upload', $config);

			if(!$this->upload->do_upload($field_name)){
				throw new Exception($this->upload->display_errors('',''));
			}
			$file_data=$this->upload->data();
			$spreadsheet=IOFactory::load($file_data['full_path']);
			$sheet=$spreadsheet->getActiveSheet();
			$head_info=$this->template_head();
			//verify head
			foreach ($head_info as $index=>$head){
				$valid=$sheet->getCellByColumnAndRow($index+1,1,TRUE)->getValue()==$head['display_name'];
				if(!$valid)
					throw new Exception('Excel file is invalid');
			}
			$index=2;
			$insert_data=array();
			while ($sheet->cellExistsByColumnAndRow(1,$index)){
				$row=array();
				foreach ($head_info as $i=>$head){
					$row[$head['field_name']]=$valid=$sheet->getCellByColumnAndRow($i+1,$index,TRUE)->getValue();
				}
				if(count($row)==count($head_info)){
					$row=$this->transform_import_row($row);
					if($row===FALSE)
						throw new Exception('Data baris ke-'.$index.' Tidak valid');
					array_push($insert_data,$row);
				}
				$index++;
			}
			if(count($insert_data)>0){
				$count=$this->db->insert_batch($this->table,$insert_data);;
				if($count===FALSE)
					throw new Exception('Gagal mengimport data');
				$return_value=array('status'=>TRUE,'message'=>$count.' Data berhasil diimport');
			}else{
				throw new Exception('File excel tidak memiliki data');
			}
		}catch (Exception $e){
			$return_value=array('status'=>FALSE,'message'=>$e->getMessage());
		}finally{
			if(!is_null($file_data)){
				unlink($file_data['full_path']);
			}
		}
		return $return_value;
	}

	protected $title_export='Laporan';
	protected $collumn_data=array();

	/**
	 * @param string $title_export
	 * @return DataGridModelBase
	 */
	public function setTitleExport($title_export)
	{
		$this->title_export = $title_export;
		return $this;
	}

	/**
	 * @param array $collumn_data
	 * @return DataGridModelBase
	 */
	public function setCollumnData($collumn_data)
	{
		$this->collumn_data = $collumn_data;
		return $this;
	}

	/**
	 * @param $args array
	 * @return CI_DB_result
	 */
	protected function export_row_query($args){
		return $this->db->get($this->table);
	}

	/**
	 * @param $sheet \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet
	 * @param $row_index integer
	 * @param $row_data array|object
	 */
	protected function export_row_maker($sheet, $row_index, $row_data){
		$head_conf_keys=array_keys($this->collumn_data);
		foreach ($head_conf_keys as $index=>$head_conf_key){
			$sheet->setCellValueByColumnAndRow(1+$index,$row_index,$row_data[$head_conf_key]);
		}
		$sheet
			->getStyleByColumnAndRow(1,$row_index,count($head_conf_keys),$row_index)
			->getBorders()
			->getAllBorders()
			->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
	}

	/**
	 * overide this to make custom sub head
	 * @param $sheet \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet
	 * @param $row_index integer
	 * @param $args array
	 * @return integer last index
	 * @throws \PhpOffice\PhpSpreadsheet\Exception
	 */
	protected function export_row_head($sheet, $row_index,$args){
		$sheet->mergeCellsByColumnAndRow(1,$row_index,count($this->collumn_data),$row_index);
		$sheet->setCellValueByColumnAndRow(1,$row_index,'Dibuat Tanggal: '.date('Y-m-d H:i:s'));
		$sheet->getStyleByColumnAndRow(1,$row_index)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
		return $row_index;
	}

	/**
	 * overide this to make custom sub head
	 * @param $sheet \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet
	 * @param $row_index integer
	 * @param $head_data array
	 * @return integer last index
	 * @throws \PhpOffice\PhpSpreadsheet\Exception
	 */
	protected function export_data_row_head($sheet, $row_index,$head_data){
		$head_conf_keys=array_keys($head_data);
		foreach ($head_conf_keys as $index=>$head_conf_key){
			$sheet->setCellValueByColumnAndRow(1+$index,$row_index,$head_data[$head_conf_key]);
			$sheet->getColumnDimensionByColumn(1+$index)->setAutoSize(true);
			$style=$sheet->getStyleByColumnAndRow(1+$index,$row_index);
			$style->getFont()->setBold(TRUE);
			$style->getBorders()->getOutline()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
			$style->getFill()->getStartColor()->setRGB("F5F5F5");
		}
		return $row_index;
	}
	public final function export_excel($args=NULL){
		try{
			$spreadsheet=new Spreadsheet();
			$sheet=$spreadsheet->getActiveSheet();
			$sheet->getPageSetup()->setFitToWidth(TRUE);
			//title
			$sheet->setCellValueByColumnAndRow(1,1,$this->title_export);
			$sheet->mergeCellsByColumnAndRow(1,1,count($this->collumn_data),1);
			$sheet->getStyleByColumnAndRow(1,1)->applyFromArray(array(
				'alignment'=>array(
					'horizontal'=>\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER
				),
				'font'=>array(
					'underline'=>\PhpOffice\PhpSpreadsheet\Style\Font::UNDERLINE_SINGLE
				)
			));
			$sheet->getStyleByColumnAndRow(1,1)->getFont()->setSize(20);
			$now_row=$this->export_row_head($sheet,2,$args)+1;
			//make data header
			$now_row=$this->export_data_row_head($sheet,$now_row,$this->collumn_data);
			$now_row++;
			//data
			$q=$this->export_row_query($args);
			while ($data_row=$q->unbuffered_row('array')){
				$this->export_row_maker($sheet,$now_row,$data_row);
				$now_row++;
			}
			$writer=new Xlsx($spreadsheet);
			$filename=str_replace(' ','_',$this->title_export).'_'.date('Y-m-d H:i:s');
			header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			header('Content-Disposition: attachment;filename="'.$filename.'.xlsx"');
			header('Cache-Control: max-age=0');
			// If you're serving to IE 9, then the following may be needed
			header('Cache-Control: max-age=1');
			// If you're serving to IE over SSL, then the following may be needed
			header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
			header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
			header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
			header('Pragma: public'); // HTTP/1.0
			$writer->save('php://output');
			exit();
		}catch (Exception $e){
			show_error($e->getMessage());
		}
	}
}
