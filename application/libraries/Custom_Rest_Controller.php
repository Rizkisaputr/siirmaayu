<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Restserver\Libraries\REST_Controller;

/**
 * Class Custom_Rest_Controller
 * @property Api_Auth $Api_Auth
 */
class Custom_Rest_Controller extends REST_Controller
{
	public function __construct($config)
	{
		parent::__construct($config);
		$this->load->model('Api_Auth');
		date_default_timezone_set('Asia/jakarta');
	}

	protected $user_data;
	protected function early_checks()
	{
		$token=$this->input->get_request_header('token');
		if($token){
			$this->load->helper('jwtauthorization');
			$this->user_data=JWT_AUTHORIZATION::validateToken($token);
		}else{
			$this->user_data=FALSE;
		}
	}

	protected function my_make_respon($data,$status=TRUE,$message='OK',$code=REST_Controller::HTTP_OK){
		$this->set_response(array(
			'status'	=> $status,
			'message'	=> $message,
			'data'		=> $data
		),$code);
	}

	protected function api_logged_in(){
		return $this->user_data?$this->Api_Auth->detil_user($this->user_data->id):$this->user_data;
	}
	public function list_param(){
		$limit=$this->get('limit')?$this->get('limit'):10;
		$offset=$this->get('offset')?$this->get('offset'):0;
		$q=$this->get('q')?$this->get('q'):NULL;
		$order_field=$this->get('ob');
		$order_dir=$this->get('od');
		$order=array();
		if($order_dir&&$order_field){
			array_push($order,$order_field);
			array_push($order,$order_dir);
		}
		return array($limit,$offset,$q,$order);
	}
}
