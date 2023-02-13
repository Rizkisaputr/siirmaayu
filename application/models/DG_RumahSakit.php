<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @property CI_DB_query_builder $db
 * @property DataGridModelBase $DataGridModelBase
 */
require_once 'DataGridModelBase.php';

class DG_RumahSakit extends DataGridModelBase
{
	public function __construct()
	{
		parent::__construct('tb_rs',array('nama','jenis','kode_rs','telepon','alamat'));
	}

	protected function select_query_obj()
	{
		return $this->db->select('id_rs,nama,jenis,kode_rs,telepon,alamat,tgl_update');
	}
	public function get_selection_fasilitas(){
		$this->db->reset_query();
		$selection=array();
		foreach ($this->db->get('tb_layanan_type')->result() as $row){
			$selection[$row->id_jenis_layanan]=$row->nama;
		}
		return $selection;
	}
	public function insert_data($data = array(),$layanan= array())
	{
		$this->db->trans_start();
		$insert_id= parent::insert_data($data);
		if($insert_id==FALSE)
			return FALSE;
		if(is_array($layanan)){
			$insert_data=array();
			foreach ($layanan as $l){
				array_push($insert_data,array('id_jenis_layanan'=>$l,'id_rs'=>$insert_id));
			}
			if(count($insert_data)>0){
				$this->db->insert_batch('tb_layanan',$insert_data);
			}
		}
		$status=$this->db->trans_status();
		$this->db->trans_complete();
		return $status?$insert_id:FALSE;
	}
	public function get_single_data($where = array())
	{
		$data= parent::get_single_data($where);
		if($data){
			$this->db->reset_query();
			$this->db->where('id_rs',$data['id_rs']);
			$data['layanan']=array();
			foreach ($this->db->get('tb_layanan')->result() as $row){
				array_push($data['layanan'],$row->id_jenis_layanan);
			}
		}
		return $data;
	}
	public function update_data($where = array(), $data = array(),$layanan=array())
	{
//		$this->db->trans_start();
		if(parent::update_data($where, $data)){
			$this->db->reset_query();
			$this->db->delete('tb_layanan',array('id_rs'=>$where['id_rs']));
			$insert_data=array();
			if(is_array($layanan)){
				foreach ($layanan as $l){
					array_push($insert_data,array('id_jenis_layanan'=>$l,'id_rs'=>$where['id_rs']));
				}
				if(count($insert_data)>0){
					$this->db->insert_batch('tb_layanan',$insert_data);
				}
			}

		}
		$status=$this->db->trans_status();
		$this->db->trans_complete();
		return $status;
	}

	protected function template_head()
	{
		$headers	= parent::template_head();
		unset($headers[7]);

		return $headers;
	}
	protected function template_info_data()
	{
		return array(
			'jenis'		=> 'Jenis Fasilitas Kesehatan yaitu: Rumah Sakit,Klinik atau Puskesmas',
			'pos_lat'	=> 'Posisi latitude dari Fasilitas Kesehatan yang diapit dengan tanda petik',
			'pos_lon'	=> 'Posisi longitude dari Fasilitas Kesehatan yang diapit dengan tanda petik'
		);
	}
	protected function transform_import_row($row)
	{
		if(isset($row['pos_lat'])){
			$row['pos_lat']=str_replace('"','',$row['pos_lat']);
		}else{
			$row['pos_lat']='';
		}
		if(isset($row['pos_lon'])){
			$row['pos_lon']=str_replace('"','',$row['pos_lon']);
		}else{
			$row['pos_lon']='';
		}
		return parent::transform_import_row($row);
	}
}
