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
 * @property User_model $User_model
 * @property Model_Rumah_Sakit $Model_Rumah_Sakit
 * @property DG_Kelas_Bed $DG_Kelas_Bed
 * @property DG_Jenis_Layanan $DG_Jenis_Layanan
 * @property DG_Jenis_RS $DG_Jenis_RS
 */

class Admin extends MX_Controller
{
	protected $user_data;
	public function __construct()
	{
		parent::__construct();
		if(!$this->ion_auth->is_admin()){
			show_404();
		}
		$this->load->model('Model_Rumah_Sakit');
		$this->user_data=$this->M_Base->cek_auth();
		date_default_timezone_set('Asia/jakarta');
	}
	function _remap($fn){
		switch ($fn){
			case 'users':
				$this->load->model('User_model');
				my_map($this->uri->segment(4),array(
					NULL		=> array($this,'users'),
					'list'		=> array($this,'data_user'),
					'add'		=> array($this,'add_user'),
					'edit'		=> array($this,'edit_user',$this->uri->segment(5)),
					'delete'	=> array($this,'delete_user',$this->uri->segment(5))
				));
				break;
			case 'kelas_bed':
				$this->load->model('User_model');
				my_map($this->uri->segment(4),array(
					NULL		=> array($this,'kelas'),
					'list'		=> array($this,'kelas_data'),
					'add'		=> array($this,'kelas_add'),
					'edit'		=> array($this,'kelas_edit',$this->uri->segment(5)),
					'delete'	=> array($this,'kelas_delete',$this->uri->segment(5))
				));
				break;
			case 'layanan':
				$this->load->model('User_model');
				my_map($this->uri->segment(4),array(
					NULL		=> array($this,'layanan'),
					'list'		=> array($this,'layanan_data'),
					'add'		=> array($this,'layanan_add'),
					'edit'		=> array($this,'layanan_edit',$this->uri->segment(5)),
					'delete'	=> array($this,'layanan_delete',$this->uri->segment(5))
				));
				break;
			case 'jenis':
				$this->load->model('User_model');
				my_map($this->uri->segment(4),array(
					NULL		=> array($this,'jenis'),
					'list'		=> array($this,'jenis_data'),
					'add'		=> array($this,'jenis_add'),
					'edit'		=> array($this,'jenis_edit',$this->uri->segment(5)),
					'delete'	=> array($this,'jenis_delete',$this->uri->segment(5))
				));
				break;
			case 'icdx':
				my_map($this->uri->segment(4),array(
					NULL		=> array($this,'icdx'),
					'list'		=> array($this,'icdx_data'),
					'add'		=> array($this,'icdx_add'),
					'edit'		=> array($this,'icdx_edit',$this->uri->segment(5)),
					'delete'	=> array($this,'icdx_delete',$this->uri->segment(5))
				));
				break;
			case 'desa':
				my_map($this->uri->segment(4),array(
					NULL		=> array($this,'desa'),
					'list'		=> array($this,'desa_data'),
					'add'		=> array($this,'desa_add'),
					'edit'		=> array($this,'desa_edit',$this->uri->segment(5)),
					'delete'	=> array($this,'desa_delete',$this->uri->segment(5))
				));
				break;
			case 'dokumentasi':
				my_map($this->uri->segment(4),array(
					NULL		=> array($this,'dokumentasi')
				));
			break;
			default:
				show_404();
		}
	}
	public function index(){
		echo 'Forbidden';
	}

	/**
	 * User manager
	 */
	public function users(){
		$message=$this->session->flashdata('message');
		$data=$this->M_Base->get_config();
		$data['title'] 		= 'users';
		$data['user'] 		= $this->ion_auth->user()->row();
		$data['page_head']	= 'User';
		$data['page_desc']	= 'List Pengguna';
		if(isset($message)){
			$data['message']=$message;
		}
		$data_back=$this->M_Base->get_data_back();
		$data=array_merge($data,$data_back);
		render_back('pages.admin_user.list',$data);
	}

	public function data_user(){
		$this->load->helper('datagrid');
		//get all the param
		$offset=$this->input->get('start');
		$limit=$this->input->get('length');
		$q=$this->input->get('search');
		$columns=$this->input->get('columns');
		$order=$this->input->get('order');

		$data=$this->User_model->list_users($limit,$offset,$q['value'],get_order_by($columns,$order));
		$all_data=$this->User_model->total_users();
		$response=array(
			'draw'=>$this->input->get('draw'),
			'data'=>$data,
			'recordsTotal'=>$all_data,
			'recordsFiltered'=>$q?$this->User_model->total_filtered_users($q['value']):$all_data
		);
		send_json($response);
	}
	public function add_user(){
		if($_POST){
			$this->form_validation->set_rules('username','Username','required|trim|min_length[5]|is_unique[users.username]');
			$this->form_validation->set_rules('email','Email','required|trim|is_unique[users.email]|valid_email');
			$this->form_validation->set_rules('password','Password','required|trim|min_length[8]');
			$this->form_validation->set_rules('user_type','Jenis User','required');
			if($this->form_validation->run()==FALSE){
				$message=array('status'=>FALSE,'message'=>validation_errors());
			}
			else{
				$email=strtolower($this->input->post('email'));
				$admin_rs=$this->input->post('user_type');
				switch ($admin_rs){
					case 'admin': $groups=1; break;
					case 'psc': $groups=4; break;
					default:
						$groups=3;
				}
				if($user_id=$this->ion_auth_model->register(
					$this->input->post('username'),
					$this->input->post('password'),
					$email,
					array(
						'phone'		=> $this->input->post('phone'),
						'full_name'	=> $this->input->post('full_name')
					),
					array($groups)
				)){
					switch($admin_rs)
					{
						case 'admin':
							$this->session->set_flashdata('message',array('status'=>TRUE,'message'=>'Superadmin ditambahkan'));
							redirect(base_url('panel/admin/users'),'refresh');
							exit();
						break;
						case 'psc':
							$this->session->set_flashdata('message',array('status'=>TRUE,'message'=>'PSC berhasil ditambahkan'));
							redirect(base_url('panel/admin/users'),'refresh');
							exit();
						break;
						default:
							if($this->User_model->add_rs_permission($user_id,$admin_rs)){
								$this->session->set_flashdata('message',array('status'=>TRUE,'message'=>'Data ditambahkan'));
								redirect(base_url('panel/admin/users'),'refresh');
								exit();
							}else{
								$message=array('status'=>FALSE,'message'=>$this->ion_auth->messages());
								$this->ion_auth->delete_user($user_id);
							}
						break;
					}

				}else{
					$message=array('status'=>FALSE,'message'=>$this->ion_auth->messages());
				}
			}
		}
		$data=$this->M_Base->get_config();
		if(isset($message))
			$data['message']=$message;
		$data['title'] 		= 'user add';
		$data['user'] 		= $this->ion_auth->user()->row();
		$data['page_head']	= 'User';
		$data['page_desc']	= 'Tambah Pengguna';
		$selection_usr_type=$this->Model_Rumah_Sakit->get_rs_selection('Pengurus');
		$selection_usr_type['admin'] = 'Superadmin';
		$selection_usr_type['psc'] = 'PSC';
		$data['selection_user_type']=$selection_usr_type;
		if(isset($message)){
			$data['message']=$message;
		}
		$data_back=$this->M_Base->get_data_back();
		$data=array_merge($data,$data_back);
		render_back('pages.admin_user.create',$data);
	}
	public function edit_user($id_user){
		if($_POST){
			$this->form_validation->set_rules('username','Username','required|trim|min_length[5]');
			$this->form_validation->set_rules('email','Email','required|trim|valid_email');
			$this->form_validation->set_rules('user_type','Jenis User','required');
			if($this->form_validation->run()==FALSE){
				$message=array('status'=>FALSE,'message'=>validation_errors());
			}
			else{
				$email=strtolower($this->input->post('email'));
				switch ($admin_rs=$this->input->post('user_type')){
					case 'admin':
						$this->db->update('users_groups',array('group_id'=>1),array('user_id'=>$id_user));
						$this->User_model->delete_rs_permission($id_user);
						break;
					case 'psc':
						$this->db->update('users_groups',array('group_id'=>4),array('user_id'=>$id_user));
						$this->User_model->delete_rs_permission($id_user);
						break;
					default:
						$this->db->update('users_groups',array('group_id'=>3),array('user_id'=>$id_user));
						$this->User_model->replace_rs_permission($id_user,$admin_rs);
				}
				if($this->ion_auth_model->update(
					$id_user,array(
						'username'	=> $this->input->post('username'),
						'email'		=> $email,
						'full_name'	=> $this->input->post('full_name'),
						'phone'		=> $this->input->post('phone')
					)
				)){
					$this->session->set_flashdata('message',array('status'=>TRUE,'message'=>'Data berhasil diedit'));
					redirect(base_url('panel/admin/users'),'refresh');
					exit();
				}else{
					$message=array('status'=>FALSE,'message'=>$this->ion_auth->messages());
				}
			}
		}
		$data=$this->M_Base->get_config();
		if(isset($message))
			$data['message']=$message;
		$data['title'] 		= 'user add';
		$data['user'] 		= $this->ion_auth->user()->row();
		$data['page_head']	= 'User';
		$data['page_desc']	= 'Tambah Pengguna';
		$selection_usr_type=$this->Model_Rumah_Sakit->get_rs_selection('Pengurus');
		$selection_usr_type['admin'] = 'Superadmin';
		$selection_usr_type['psc'] = 'PSC';
		$data['selection_user_type']=$selection_usr_type;
		$data['edit_data']	= $this->User_model->get_user_data($id_user);
		if(!$data['edit_data'])
			show_404();
		if(isset($message)){
			$data['message']=$message;
		}
		$data_back=$this->M_Base->get_data_back();
		$data=array_merge($data,$data_back);
		render_back('pages.admin_user.edit',$data);
	}
	public function delete_user($id_user){
		if($this->ion_auth->get_user_id()==$id_user){
			$this->session->set_flashdata('message',array(
				'status'=>FALSE,
				'message'=>'anda tidak dapat menghapus akun anda sendiri'
			));
		}else if($this->ion_auth_model->delete_user($id_user)){
			$this->session->set_flashdata('message',array(
				'status'=>TRUE,
				'message'=>'Berhasil Menghapus User'
			));
		}else{
			$this->session->set_flashdata('message',array(
				'status'=>FALSE,
				'message'=>$this->ion_auth->message()
			));
		}
		redirect(base_url('panel/admin/users'),'refresh');
	}

	/**
	 * Kelas Bed
	 */
	public function kelas(){
		$message=$this->session->flashdata('message');
		$data=$this->M_Base->get_config();
		$data['title'] 		= 'Kelas Bed';
		$data['user'] 		= $this->ion_auth->user()->row();
		$data['page_head']	= 'Kelas Bed';
		$data['page_desc']	= 'List Kelas Bed';
		if(isset($message)){
			$data['message']=$message;
		}
		$data_back=$this->M_Base->get_data_back();
		$data=array_merge($data,$data_back);
		render_back('pages.kelas_bed.list',$data);
	}
	public function kelas_data(){
		$this->load->helper('datagrid');
		//get all the param
		$offset=$this->input->get('start');
		$limit=$this->input->get('length');
		$q=$this->input->get('search');
		$columns=$this->input->get('columns');
		$order=$this->input->get('order');

		$this->load->model('DG_Kelas_Bed');

		$data=$this->DG_Kelas_Bed->get($limit,$offset,$q['value'],get_order_by($columns,$order));
		$all_data=$this->DG_Kelas_Bed->total();
		$response=array(
			'draw'=>$this->input->get('draw'),
			'data'=>$data,
			'recordsTotal'=>$all_data,
			'recordsFiltered'=>$q?$this->DG_Kelas_Bed->total_filtered($q['value']):$all_data
		);
		send_json($response);
	}
	public function kelas_add(){
		if($_POST){
			$this->form_validation->set_rules('nama','Nama','required|trim');
			$this->form_validation->set_rules('unigender','Unigender','required|trim|in_list[0,1]');
			if($this->form_validation->run()==FALSE){
				$message=array('status'=>FALSE,'message'=>validation_errors());
			}
			else{
				$this->load->model('DG_Kelas_Bed');
				unset($_POST['save']);
				if($this->DG_Kelas_Bed->insert_data($_POST)){
					$this->session->set_flashdata('message',array('status'=>TRUE,'message'=>'Kelas telah ditambahkan'));
					redirect(base_url('panel/admin/kelas_bed'),'refresh');
				}else{
					$message=array('status'=>FALSE,'message'=>'Gagal Menginput Data');
				}
			}
		}
		$data=$this->M_Base->get_config();
		if(isset($message))
			$data['message']=$message;
		$data['title'] 		= 'Kelas Bed';
		$data['user'] 		= $this->ion_auth->user()->row();
		$data['page_head']	= 'Kelas Bed';
		$data['page_desc']	= 'Tambah Kelas Bed';
		if(isset($message)){
			$data['message']=$message;
		}
		$data_back=$this->M_Base->get_data_back();
		$data=array_merge($data,$data_back);
		render_back('pages.kelas_bed.create',$data);
	}
	public function kelas_edit($idKelas){
		$this->load->model('DG_Kelas_Bed');
		$edit_data=$this->DG_Kelas_Bed->get_single_data(array('id_kelas_bed'=>$idKelas));
		if(!$edit_data)
			show_404();
		if($_POST){
			$this->form_validation->set_rules('nama','Nama','required|trim');
			$this->form_validation->set_rules('unigender','Unigender','required|trim|in_list[0,1]');
			if($this->form_validation->run()==FALSE){
				$message=array('status'=>FALSE,'message'=>validation_errors());
			}
			else{
				unset($_POST['save']);
				if($this->DG_Kelas_Bed->update_data(array('id_kelas_bed'=>$idKelas),$_POST)){
					$this->session->set_flashdata('message',array('status'=>TRUE,'message'=>'Kelas telah diupdate'));
					redirect(base_url('panel/admin/kelas_bed'),'refresh');
				}else{
					$message=array('status'=>FALSE,'message'=>'Gagal Mengupdate Data');
				}
			}
		}
		$data=$this->M_Base->get_config();
		if(isset($message))
			$data['message']=$message;
		$data['title'] 		= 'Kelas Bed';
		$data['user'] 		= $this->ion_auth->user()->row();
		$data['page_head']	= 'Kelas Bed';
		$data['page_desc']	= 'Edit Kelas Bed';
		$data['edit_data']	= $edit_data;
		if(isset($message)){
			$data['message']=$message;
		}
		$data_back=$this->M_Base->get_data_back();
		$data=array_merge($data,$data_back);
		render_back('pages.kelas_bed.edit',$data);
	}
	public function kelas_delete($idKelas){
		$this->load->model('DG_Kelas_Bed');
		if($this->DG_Kelas_Bed->delete_data(array('id_kelas_bed'=>$idKelas))){
			$this->session->set_flashdata('message',array(
				'status'=>TRUE,
				'message'=>'Data telah dihapus'
			));
		}else{
			$this->session->set_flashdata('message',array(
				'status'=>FALSE,
				'message'=>'Gagal menghapus Data'
			));
		}
		redirect(base_url('panel/admin/kelas_bed'),'refresh');
	}

	/*
	 * Fasilitas Jenis
	 */
	public function layanan(){
		$message=$this->session->flashdata('message');
		$data=$this->M_Base->get_config();
		$data['title'] 		= 'Jenis Layanan';
		$data['user'] 		= $this->ion_auth->user()->row();
		$data['page_head']	= 'Jenis Layanan';
		$data['page_desc']	= 'List Jenis Layanan';
		if(isset($message)){
			$data['message']=$message;
		}
		$data_back=$this->M_Base->get_data_back();
		$data=array_merge($data,$data_back);
		render_back('pages.jenis_layanan.list',$data);
	}
	public function layanan_data(){
		$this->load->helper('datagrid');
		//get all the param
		$offset=$this->input->get('start');
		$limit=$this->input->get('length');
		$q=$this->input->get('search');
		$columns=$this->input->get('columns');
		$order=$this->input->get('order');

		$this->load->model('DG_Jenis_Layanan');

		$data=$this->DG_Jenis_Layanan->get($limit,$offset,$q['value'],get_order_by($columns,$order));
		$all_data=$this->DG_Jenis_Layanan->total();
		$response=array(
			'draw'=>$this->input->get('draw'),
			'data'=>$data,
			'recordsTotal'=>$all_data,
			'recordsFiltered'=>$q?$this->DG_Jenis_Layanan->total_filtered($q['value']):$all_data
		);
		send_json($response);
	}
	public function layanan_add(){
		if($_POST){
			$this->form_validation->set_rules('nama','Nama','required|trim');
			if($this->form_validation->run()==FALSE){
				$message=array('status'=>FALSE,'message'=>validation_errors());
			}
			else{
				$this->load->model('DG_Jenis_Layanan');
				unset($_POST['save']);
				if($this->DG_Jenis_Layanan->insert_data($_POST)){
					$this->session->set_flashdata('message',array('status'=>TRUE,'message'=>'Jenis Layanan telah ditambahkan'));
					redirect(base_url('panel/admin/layanan'),'refresh');
				}else{
					$message=array('status'=>FALSE,'message'=>'Gagal Menginput Data');
				}
			}
		}
		$data=$this->M_Base->get_config();
		if(isset($message))
			$data['message']=$message;
		$data['title'] 		= 'jenis Layanan';
		$data['user'] 		= $this->ion_auth->user()->row();
		$data['page_head']	= 'jenis Layanan';
		$data['page_desc']	= 'Tambah jenis Layanan';
		if(isset($message)){
			$data['message']=$message;
		}
		$data_back=$this->M_Base->get_data_back();
		$data=array_merge($data,$data_back);
		render_back('pages.jenis_layanan.create',$data);
	}
	public function layanan_edit($idLayanan){
		$this->load->model('DG_Jenis_Layanan');
		$edit_data=$this->DG_Jenis_Layanan->get_single_data(array('id_jenis_layanan'=>$idLayanan));

		if($_POST){
			$this->form_validation->set_rules('nama','Nama','required|trim');
			if($this->form_validation->run()==FALSE){
				$message=array('status'=>FALSE,'message'=>validation_errors());
			}
			else{
				unset($_POST['save']);
				if($this->DG_Jenis_Layanan->update_data(array('id_jenis_layanan'=>$idLayanan),$_POST)){
					$this->session->set_flashdata('message',array('status'=>TRUE,'message'=>'Jenis Layanan telah diedit'));
					redirect(base_url('panel/admin/layanan'),'refresh');
				}else{
					$message=array('status'=>FALSE,'message'=>'Gagal Mengedit Data');
				}
			}
		}
		$data=$this->M_Base->get_config();
		if(isset($message))
			$data['message']=$message;
		$data['title'] 		= 'Jenis Layanan';
		$data['user'] 		= $this->ion_auth->user()->row();
		$data['page_head']	= 'Jenis Layanan';
		$data['page_desc']	= 'Edit jenis Layanan';
		$data['edit_data']	= $edit_data;
		if(isset($message)){
			$data['message']=$message;
		}
		$data_back=$this->M_Base->get_data_back();
		$data=array_merge($data,$data_back);
		render_back('pages.jenis_layanan.edit',$data);
	}
	public function layanan_delete($idLayanan){
		$this->load->model('DG_Jenis_Layanan');
		if($this->DG_Jenis_Layanan->delete_data(array('id_jenis_layanan'=>$idLayanan))){
			$this->session->set_flashdata('message',array(
				'status'=>TRUE,
				'message'=>'Data telah dihapus'
			));
		}else{
			$this->session->set_flashdata('message',array(
				'status'=>FALSE,
				'message'=>'Gagal menghapus Data'
			));
		}
		redirect(base_url('panel/admin/layanan'),'refresh');
	}
	/*
	 * Jenis RS
	 */
	public function jenis(){
		$message=$this->session->flashdata('message');
		$data=$this->M_Base->get_config();
		$data['title'] 		= 'Jenis Fasilitas Kesehatan';
		$data['user'] 		= $this->ion_auth->user()->row();
		$data['page_head']	= 'Jenis Fasilitas Kesehatan';
		$data['page_desc']	= 'List Fasilitas Kesehatan';
		if(isset($message)){
			$data['message']=$message;
		}
		$data_back=$this->M_Base->get_data_back();
		$data=array_merge($data,$data_back);
		render_back('pages.jenis_rs.list',$data);
	}
	public function jenis_data(){
		$this->load->helper('datagrid');
		//get all the param
		$offset=$this->input->get('start');
		$limit=$this->input->get('length');
		$q=$this->input->get('search');
		$columns=$this->input->get('columns');
		$order=$this->input->get('order');

		$this->load->model('DG_Jenis_RS');

		$data=$this->DG_Jenis_RS->get($limit,$offset,$q['value'],get_order_by($columns,$order));
		$all_data=$this->DG_Jenis_RS->total();
		$response=array(
			'draw'=>$this->input->get('draw'),
			'data'=>$data,
			'recordsTotal'=>$all_data,
			'recordsFiltered'=>$q?$this->DG_Jenis_RS->total_filtered($q['value']):$all_data
		);
		send_json($response);
	}
	public function jenis_add(){
		if($_POST){
			$this->form_validation->set_rules('value','Nama','required|trim');
			if($this->form_validation->run()==FALSE){
				$message=array('status'=>FALSE,'message'=>validation_errors());
			}
			else{
				$this->load->model('DG_Jenis_RS');
				unset($_POST['save']);
				if($this->DG_Jenis_RS->insert_data($_POST)){
					$this->session->set_flashdata('message',array('status'=>TRUE,'message'=>'Jenis Fasilitas Kesehatan telah ditambahkan'));
					redirect(base_url('panel/admin/jenis'),'refresh');
				}else{
					$message=array('status'=>FALSE,'message'=>'Gagal Menginput Data');
				}
			}
		}
		$data=$this->M_Base->get_config();
		if(isset($message))
			$data['message']=$message;
		$data['title'] 		= 'Jenis Fasilitas Kesehatan';
		$data['user'] 		= $this->ion_auth->user()->row();
		$data['page_head']	= 'Jenis Fasilitas Kesehatan';
		$data['page_desc']	= 'Tambah jenis Fasilitas Kesehatan';
		if(isset($message)){
			$data['message']=$message;
		}
		$data_back=$this->M_Base->get_data_back();
		$data=array_merge($data,$data_back);
		render_back('pages.jenis_rs.create',$data);
	}
	public function jenis_edit($id_enum){
		$this->load->model('DG_Jenis_RS');
		$edit_data=$this->DG_Jenis_RS->get_single_data(array('id_enum'=>$id_enum));

		if($_POST){
			$this->form_validation->set_rules('value','Nama','required|trim');
			if($this->form_validation->run()==FALSE){
				$message=array('status'=>FALSE,'message'=>validation_errors());
			}
			else{
				unset($_POST['save']);
				if($this->DG_Jenis_RS->update_data(array('id_enum'=>$id_enum),$_POST)){
					$this->session->set_flashdata('message',array('status'=>TRUE,'message'=>'Jenis Fasilitas Kesehatan telah diedit'));
					redirect(base_url('panel/admin/jenis'),'refresh');
				}else{
					$message=array('status'=>FALSE,'message'=>'Gagal Mengedit Data');
				}
			}
		}
		$data=$this->M_Base->get_config();
		if(isset($message))
			$data['message']=$message;
		$data['title'] 		= 'Jenis Fasilitas Kesehatan';
		$data['user'] 		= $this->ion_auth->user()->row();
		$data['page_head']	= 'Jenis Fasilitas Kesehatan';
		$data['page_desc']	= 'Edit Jenis Fasilitas Kesehatan';
		$data['edit_data']	= $edit_data;
		if(isset($message)){
			$data['message']=$message;
		}
		$data_back=$this->M_Base->get_data_back();
		$data=array_merge($data,$data_back);
		render_back('pages.jenis_rs.edit',$data);
	}
	public function jenis_delete($id_enum){
		$this->load->model('DG_Jenis_RS');
		if($this->DG_Jenis_RS->delete_data(array('id_enum'=>$id_enum))){
			$this->session->set_flashdata('message',array(
				'status'=>TRUE,
				'message'=>'Data telah dihapus'
			));
		}else{
			$this->session->set_flashdata('message',array(
				'status'=>FALSE,
				'message'=>'Gagal menghapus Data'
			));
		}
		redirect(base_url('panel/admin/jenis'),'refresh');
	}

	/*
	 * Jenis ICD X
	 */
	public function icdx(){
		$message=$this->session->flashdata('message');
		$data=$this->M_Base->get_config();
		$data['title'] 		= 'Data ICD X';
		$data['user'] 		= $this->ion_auth->user()->row();
		$data['page_head']	= 'Data ICD X';
		$data['page_desc']	= 'List ICD X';
		if(isset($message)){
			$data['message']=$message;
		}
		$data_back=$this->M_Base->get_data_back();
		$data=array_merge($data,$data_back);
		render_back('pages.icdx.list',$data);
	}
	public function icdx_data(){
		$this->load->helper('datagrid');
		//get all the param
		$offset=$this->input->get('start');
		$limit=$this->input->get('length');
		$q=$this->input->get('search');
		$columns=$this->input->get('columns');
		$order=$this->input->get('order');

		$this->load->model('DG_Icdx');

		$data=$this->DG_Icdx->get($limit,$offset,$q['value'],get_order_by($columns,$order));
		$all_data=$this->DG_Icdx->total();
		$response=array(
			'draw'=>$this->input->get('draw'),
			'data'=>$data,
			'recordsTotal'=>$all_data,
			'recordsFiltered'=>$q?$this->DG_Icdx->total_filtered($q['value']):$all_data
		);
		send_json($response);
	}
	public function icdx_add(){
		if($_POST){
			$this->form_validation->set_rules('kode','Kode','required|trim');
			$this->form_validation->set_rules('keterangan','Keterangan','required|trim');
			if($this->form_validation->run()==FALSE){
				$message=array('status'=>FALSE,'message'=>validation_errors());
			}
			else{
				$this->load->model('DG_Icdx');
				unset($_POST['save']);
				if($this->DG_Icdx->insert_data($_POST)){
					$this->session->set_flashdata('message',array('status'=>TRUE,'message'=>'ICD X telah ditambahkan'));
					redirect(base_url('panel/admin/icdx'),'refresh');
				}else{
					$message=array('status'=>FALSE,'message'=>'Gagal Menginput Data');
				}
			}
		}
		$data=$this->M_Base->get_config();
		if(isset($message))
			$data['message']=$message;
		$data['title'] 		= 'Data ICD X';
		$data['user'] 		= $this->ion_auth->user()->row();
		$data['page_head']	= 'Data ICD X';
		$data['page_desc']	= 'Tambah Data ICD X';
		if(isset($message)){
			$data['message']=$message;
		}
		$data_back=$this->M_Base->get_data_back();
		$data=array_merge($data,$data_back);
		render_back('pages.icdx.create',$data);
	}
	public function icdx_edit($id){
		$this->load->model('DG_Icdx');
		$edit_data=$this->DG_Icdx->get_single_data(array('id_icdx'=>$id));

		if($_POST){
			$this->form_validation->set_rules('kode','Kode','required|trim');
			$this->form_validation->set_rules('keterangan','Keterangan','required|trim');
			if($this->form_validation->run()==FALSE){
				$message=array('status'=>FALSE,'message'=>validation_errors());
			}
			else{
				unset($_POST['save']);
				if($this->DG_Icdx->update_data(array('id_icdx'=>$id),$_POST)){
					$this->session->set_flashdata('message',array('status'=>TRUE,'message'=>'Data ICD X telah diedit'));
					redirect(base_url('panel/admin/icdx'),'refresh');
				}else{
					$message=array('status'=>FALSE,'message'=>'Gagal Mengedit Data');
				}
			}
		}
		$data=$this->M_Base->get_config();
		if(isset($message))
			$data['message']=$message;
		$data['title'] 		= 'Data ICD X';
		$data['user'] 		= $this->ion_auth->user()->row();
		$data['page_head']	= 'Data ICD X';
		$data['page_desc']	= 'Tambah Data ICD X';
		$data['edit_data']	= $edit_data;
		if(isset($message)){
			$data['message']=$message;
		}
		$data_back=$this->M_Base->get_data_back();
		$data=array_merge($data,$data_back);
		render_back('pages.icdx.edit',$data);
	}
	public function icdx_delete($id){
		$this->load->model('DG_Icdx');
		if($this->DG_Icdx->delete_data(array('id_icdx'=>$id))){
			$this->session->set_flashdata('message',array(
				'status'=>TRUE,
				'message'=>'Data telah dihapus'
			));
		}else{
			$this->session->set_flashdata('message',array(
				'status'=>FALSE,
				'message'=>'Gagal menghapus Data'
			));
		}
		redirect(base_url('panel/admin/icdx'),'refresh');
	}

	public function desa(){
		$message=$this->session->flashdata('message');
		$data=$this->M_Base->get_config();
		$data['title'] 		= 'Data Desa';
		$data['user'] 		= $this->ion_auth->user()->row();
		$data['page_head']	= 'Data Desa';
		$data['page_desc']	= 'List Desa';
		if(isset($message)){
			$data['message']=$message;
		}
		$data_back=$this->M_Base->get_data_back();
		$data=array_merge($data,$data_back);
		render_back('pages.desa.list',$data);
	}
	public function desa_data(){
		$this->load->helper('datagrid');
		//get all the param
		$offset=$this->input->get('start');
		$limit=$this->input->get('length');
		$q=$this->input->get('search');
		$columns=$this->input->get('columns');
		$order=$this->input->get('order');

		$this->load->model('DG_desa');

		$data=$this->DG_desa->get($limit,$offset,$q['value'],get_order_by($columns,$order));
		$all_data=$this->DG_desa->total();
		$response=array(
			'draw'=>$this->input->get('draw'),
			'data'=>$data,
			'recordsTotal'=>$all_data,
			'recordsFiltered'=>$q?$this->DG_desa->total_filtered($q['value']):$all_data
		);
		send_json($response);
	}
	public function desa_add(){
		$this->load->model('Model_Rumah_Sakit');
		if($_POST){
			$this->form_validation->set_rules('desa','Desa','required|trim');
			$this->form_validation->set_rules('id_rs','Rumah Sakit','required|trim');
			if($this->form_validation->run()==FALSE){
				$message=array('status'=>FALSE,'message'=>validation_errors());
			}
			else{
				$this->load->model('DG_desa');
				unset($_POST['save']);
				if($this->DG_desa->insert_data($_POST)){
					$this->session->set_flashdata('message',array('status'=>TRUE,'message'=>'Desa telah ditambahkan'));
					redirect(base_url('panel/admin/desa'),'refresh');
				}else{
					$message=array('status'=>FALSE,'message'=>'Gagal Menginput Data');
				}
			}
		}
		$data=$this->M_Base->get_config();
		if(isset($message))
			$data['message']=$message;
		$data['title'] 		= 'Data Desa';
		$data['user'] 		= $this->ion_auth->user()->row();
		$data['page_head']	= 'Data Desa';
		$data['page_desc']	= 'Tambah Data Desa';
		if(isset($message)){
			$data['message']=$message;
		}
		$data['selection_rs'] = $this->Model_Rumah_Sakit->get_rs_selection();
		$data_back=$this->M_Base->get_data_back();
		$data=array_merge($data,$data_back);
		render_back('pages.desa.form',$data);
	}
	public function desa_edit($id){
		$this->load->model('DG_desa');
		$this->load->model('Model_Rumah_Sakit');
		$edit_data=$this->DG_desa->get_single_data(array('id_desa'=>$id));

		if($_POST){
			$this->form_validation->set_rules('desa','Desa','required|trim');
			$this->form_validation->set_rules('id_rs','Rumah Sakit','required|trim');
			if($this->form_validation->run()==FALSE){
				$message=array('status'=>FALSE,'message'=>validation_errors());
			}
			else{
				unset($_POST['save']);
				if($this->DG_desa->update_data(array('id_desa'=>$id),$_POST)){
					$this->session->set_flashdata('message',array('status'=>TRUE,'message'=>'Data Desa telah diedit'));
					redirect(base_url('panel/admin/desa'),'refresh');
				}else{
					$message=array('status'=>FALSE,'message'=>'Gagal Mengedit Data');
				}
			}
		}
		$data=$this->M_Base->get_config();
		if(isset($message))
			$data['message']=$message;
		$data['title'] 		= 'Data Desa';
		$data['user'] 		= $this->ion_auth->user()->row();
		$data['page_head']	= 'Data Desa';
		$data['page_desc']	= 'Edit Data Desa';
		$data['edit_data']	= $edit_data;
		if(isset($message)){
			$data['message']=$message;
		}
		$data['selection_rs'] = $this->Model_Rumah_Sakit->get_rs_selection();
		$data_back=$this->M_Base->get_data_back();
		$data=array_merge($data,$data_back);
		render_back('pages.desa.form',$data);
	}
	public function desa_delete($id){
		$this->load->model('DG_desa');
		if($this->DG_desa->delete_data(array('id_desa'=>$id))){
			$this->session->set_flashdata('message',array(
				'status'=>TRUE,
				'message'=>'Data telah dihapus'
			));
		}else{
			$this->session->set_flashdata('message',array(
				'status'=>FALSE,
				'message'=>'Gagal menghapus Data'
			));
		}
		redirect(base_url('panel/admin/desa'),'refresh');
	}

}
