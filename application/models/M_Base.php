<?php
/**
 * Created by PhpStorm.
 * User: Bayu Setiawan
 * Date: 09/04/2018
 * Time: 20:10
 * @property Ion_auth|Ion_auth_model $ion_auth        The ION Auth spark
 * @property CI_Form_validation      $form_validation The form validation library
 * @property CI_Session $session
 * @property CI_URI uri
 * @property CI_DB_query_builder $db
 * @property CI_Config $config
 */

class M_Base extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->load->library(array('ion_auth'));
	}

	public function get_config(){
		$this->config->load('smartrujukan');
		$data=array();
		$data['application_name']		=$this->config->item('application_name');
		$data['application_long_name']	=$this->config->item('application_long_name');
		$data['media']					=$this->config->item('media');
		$data['covid']					=$this->config->item('covid');
		$data['version']				=$this->config->item('version');
		$data['application_copyright']	=$this->config->item('application_copyright');
		$data['api_doc_url']			=$this->config->item('api_doc_url');
		return $data;
	}

	public function get_data_back(){
		$data=array();
		$data['uris']=$this->uri->segment_array();
		return $data;
	}

	public function cek_auth(){
		if(!$this->ion_auth->logged_in()){
			$this->session->set_flashdata('message', "<p>Anda belum login</p>");
			//redirect(base_url('auth/login'));
			redirect(base_url('auth/login'));
			exit();
		}
		return $this->ion_auth->user()->row();
	}

	public function get_enum($type,$db_result=FALSE){
		$this->db->where('type_enum',$type);
		if($db_result){
			return $this->db->get('tb_enum')->result();
		}
		$this->db->select('value');
		$enums=array();
		foreach ($this->db->get('tb_enum')->result() as $row){
			array_push($enums,$row->value);
		}
		return $enums;
	}
}
