<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @property CI_DB_query_builder $db
 * @property DataGridModelBase $DataGridModelBase
 */
require_once 'DataGridModelBase.php';

class DG_Pasien extends DataGridModelBase
{
	
	private $where;
	public function __construct()
	{
		$table		= 'tb_pasien';
		$searchable	= array('tb_pasien.nama','tb_pasien.kontak','tb_pasien.tgl_lahir','tb_pasien.jenis_kelamin','tb_pasien.nik','tb_pasien.tempat_lahir','tb_pasien.alamat','tb_rs.nama');

		$this->where=array();
		parent::__construct($table, $searchable);
	}
	public function setWhere($key,$value)
	{
		$this->where[$key]=$value;
	}
	protected function select_query_obj()
	{
		foreach ($this->where as $key=>$value){
			$this->db->where($key,$value);
		}
		return parent::select_query_obj()
			->select('tb_pasien.*,COALESCE(GROUP_CONCAT(tb_rs.nama),"-") as rs_names')
			->join('tb_pasien_owner','tb_pasien.id_rm=tb_pasien_owner.id_rm','left')
			->join('tb_rs','tb_pasien_owner.id_rs=tb_rs.id_rs','left')
			->group_by('tb_pasien.id_rm');
	}
	public function insert_data($data = array())
	{
		$this->db->trans_begin();
		if(isset($data['rs_owner'])){
			$rs_owner=$data['rs_owner'];
			if(!is_array($rs_owner)){
				return false;
			}
			unset($data['rs_owner']);
		}
		$retval= parent::insert_data($data);
		if($retval===FALSE)
			return $retval;
		if(isset($rs_owner)){
			if(count($rs_owner)>0){
				$rs_owners=array();
				foreach ($rs_owner as $id_rs){
					array_push($rs_owners,array('id_rm'=>$retval,'id_rs'=>$id_rs));
				}
				if(!$this->db->insert_batch('tb_pasien_owner',$rs_owners)){
					return false;
				}
			}
		}
		$status=$this->db->trans_status();
		$this->db->trans_complete();
		return $status?$retval:$status;
	}
	public function update_data($where = array(), $data = array())
	{
		$this->db->trans_begin();
		if(isset($data['rs_owner'])){
			$rs_owner=$data['rs_owner'];
			if(!is_array($rs_owner)){
				return false;
			}
			unset($data['rs_owner']);
		}
		$retval= parent::update_data($where, $data);
		if($retval===FALSE)
			return $retval;
		if(isset($rs_owner)){
			if(!$this->db->delete('tb_pasien_owner',array('id_rm'=>$where['id_rm']))){
				return false;
			}
			if(count($rs_owner)>0){
				$rs_owners=array();
				foreach ($rs_owner as $id_rs){
					array_push($rs_owners,array('id_rm'=>$where['id_rm'],'id_rs'=>$id_rs));
				}
				if(!$this->db->insert_batch('tb_pasien_owner',$rs_owners)){
					return false;
				}
			}
		}
		$status=$this->db->trans_status();
		$this->db->trans_complete();
		return $status?$retval:$status;
	}

	public function add_rs_owner($id_rm,$id_rs){
		if($this->db->get_where('tb_pasien_owner',array('id_rs'=>$id_rs,'id_rm'=>$id_rm),1)->num_rows()<1){
			return $this->db->insert('tb_pasien_owner',array(
				'id_rm'	=> $id_rm,
				'id_rs'	=> $id_rs
			));
		}else
			return TRUE;
	}

	public function get_single_data($where = array())
	{
		$data=parent::get_single_data($where);
		if(!is_null($data)){
			$data['owners']=$this->list_rs_owner($data['id_rm']);
		}
		return $data;
	}

	public function list_rs_owner($id_rm){
		$this->db->select('tb_rs.id_rs,tb_rs.nama');
		$this->db->join('tb_rs','tb_pasien_owner.id_rs=tb_rs.id_rs');
		return $this->db->get_where('tb_pasien_owner',array('id_rm'=>$id_rm))->result_array();
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
