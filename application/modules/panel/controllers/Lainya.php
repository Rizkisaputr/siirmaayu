<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @property CI_Form_validation $form_validation
 * @property CI_Input $input
 * @property CI_Session $session
 * @property CI_DB_query_builder $db
 * @property Ion_auth ion_auth
 * @property Ion_auth_model ion_auth_model
 * @property M_Base M_Base
 */

class Lainya extends MX_Controller
{
	protected $user_data;
	public function __construct()
	{
		parent::__construct();
		$this->user_data=$this->M_Base->cek_auth();
		date_default_timezone_set('Asia/jakarta');
	}
	public function index(){
		redirect(base_url('panel'),'refresh');
	}
	public function profil(){
		if($_POST){
			$this->form_validation->set_rules('username','Username','trim|required|min_length[5]');
			$this->form_validation->set_rules('email','Email','trim|required');
			$this->form_validation->valid_email('email');
			$this->form_validation->set_rules('full_name','Nama Lengkap','trim|alpha_numeric_spaces');
			if($this->input->post('is_change_password')){
				if($this->input->post('is_change_password')==='yes'){
					$this->form_validation->set_rules('new_password','Password','required|min_length[5]|xss_clean');
				}
			}
			if($this->form_validation->run() == FALSE){
				$message=array('status'=>FALSE,'message'=>validation_errors());
			}else{
				$data				= array();
				$data['username']	= $this->input->post('username');
				$data['email']		= $this->input->post('email');
				$data['full_name']	= $this->input->post('full_name');
				$data['phone']	= $this->input->post('phone');
				if($this->input->post('is_change_password')==='yes'){
					$data['password'] = $this->input->post('new_password');
				}
				$this->load->library('ion_auth');
				if($this->ion_auth->update($this->ion_auth->get_user_id(),$data)){
					$message=array('status'=>TRUE,'message'=>'Sukses update profil');
				}else{
					$message=array('status'=>FALSE,'message'=>'Gagal Update Profil');
				}
			}
		}
		$data=$this->M_Base->get_config();
		$data['title'] 		= 'profil';
		$data['user'] 		= $this->ion_auth->user()->row();
		$data['page_head']	= 'Profil User';
		$data['page_desc']	= 'Edit Profil Anda';
		if(isset($message)){
			$data['message']=$message;
		}
		$data_back=$this->M_Base->get_data_back();
		$data=array_merge($data,$data_back);
		render_back('pages.profil',$data);
	}
}
