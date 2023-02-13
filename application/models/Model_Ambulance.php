<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @property CI_DB_query_builder $db
 * @property Ion_auth $ion_auth
 * @property User_model $User_model
 */

class Model_Ambulance extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function get_value($type){
		
		$this->db->where('type_enum',$type);
		$data = $this->db->get('tb_enum');

		$ret = array();
		foreach ($data->result() as $row){
			$ret[$row->value]=$row->value;
		}
		return $ret;

	}

}