<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @property CI_Form_validation $form_validation
 * @property CI_Input $input
 * @property CI_Session $session
 * @property CI_DB_query_builder $db
 * @property Ion_auth ion_auth
 * @property Ion_auth_model ion_auth_model
 * @property M_Base M_Base
 * @property CI_URI uri
 */

class User_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

	public function list_users($limit=10,$offset=0,$q=NULL,$order=array()){
		$this->db->reset_query();
		$inner=$this->db
			->select('GROUP_CONCAT(groups.description)',FALSE)
			->join('groups','users_groups.group_id = groups.id')
			->where('users_groups.user_id = users.id')
			->get_compiled_select('users_groups',TRUE);
		if($q){
			$this->db->group_start();
			$this->db->or_like('username',$q);
			$this->db->or_like('email',$q);
			$this->db->or_like('full_name',$q);
			$this->db->or_like('phone',$q);
			$this->db->group_end();
		}
		if(count($order)>1){
			$this->db->order_by($order[0],$order[1]);
		}
		return $this->db
			->select("id,username,email,full_name,phone,($inner) as groups")
			->get('users',$limit,$offset)->result();
	}

	public function total_users(){
		$this->db->reset_query();
		return $this->db->count_all('users');
	}
	public function total_filtered_users($q=NULL){
		$this->db->reset_query();
		$inner=$this->db
			->select('GROUP_CONCAT(groups.name)',FALSE)
			->join('groups','users_groups.group_id = groups.id')
			->where('users_groups.user_id = users.id')
			->get_compiled_select('users_groups',TRUE);
		if($q){
			$this->db->like('username',$q);
			$this->db->like('email',$q);
			$this->db->like('full_name',$q);
			$this->db->like('phone',$q);
		}
		return $this->db->count_all('users');
	}
	public function add_rs_permission($uid,$rs_id){
		return $this->db->insert('tb_rs_permission',array('id_user'=>$uid,'id_rs'=>$rs_id));
	}
	public function get_rs_permission_id($uid){
		$this->db->where('id_user',$uid);
		return $this->db->get('tb_rs_permission')->row();
	}

	public function have_rs_permission($uid,$rs_id){
		if($this->ion_auth->is_admin($uid)){
			return true;
		}
		$this->db->reset_query();
		$this->db->select('id_permission');
		$this->db->where('id_user',$uid);
		$this->db->where('id_rs',$rs_id);
		return $this->db->get('tb_rs_permission')->row()? TRUE : FALSE ;
	}

	public function replace_rs_permission($uid,$rs_id){
		$exist=$this->get_rs_permission_id($uid);
		if($exist){
			return $this->db->update('tb_rs_permission',array('id_rs'=>$rs_id),array('id_user'=>$uid));
		}else{
			return $this->add_rs_permission($uid,$rs_id);
		}
	}
	public function delete_rs_permission($uid){
		$this->db->where('id_user',$uid);
		$this->db->delete('tb_rs_permission');
	}
	public function get_user_data($id_user){
		$user_data=$this->ion_auth->user($id_user)->row();
		if($this->ion_auth->is_admin($id_user)){
			$user_data->user_type='admin';
		}else{
			$user_type=$this->get_rs_permission_id($id_user);
			$user_data->user_type=$user_type?$user_type->id_rs:NULL;
		}
		return $user_data;
	}
	public function get_all_user_rs($uid){
		if($this->ion_auth->is_admin($uid))
			return TRUE;
		$this->db->reset_query();
		$ids=array();
		foreach ($this->db->select('id_rs')->where('id_user',$uid)->get('tb_rs_permission')->result() as $row){
			array_push($ids,$row->id_rs);
		}
		return $ids;
	}

	public function is_puskesmas($uid){
		$is_puskesmas = FALSE;
		if($this->ion_auth->is_admin($uid))
			return TRUE;
		$this->db->reset_query();
		$ids=array();
		$rs = $this->db->from('tb_rs_permission')
		->join('tb_rs','tb_rs.id_rs = tb_rs_permission.id_rs')
		->select('tb_rs.jenis')
		->where('id_user',$uid)
		->get();
		foreach ($rs->result() as $row){
			if ($row->jenis == "Puskesmas") $is_puskesmas = TRUE;
		}
		return $is_puskesmas;
	}
}
