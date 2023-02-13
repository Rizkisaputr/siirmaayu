<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Restserver\Libraries\REST_Controller;
/**
 * API
 * @property CI_Loader $load
 * @property Api_Base $Api_Base
 * @property M_Base $M_Base
 * @property CI_DB_query_builder $db
 * @property CI_Form_validation form_validation
 * @property Api_Auth $Api_Auth
 * @property DG_RumahSakit $DG_RumahSakit
 * @property DG_Bed $DG_Bed
 * @property DG_Faskes $DG_Faskes
 * @property DG_Dokter $DG_Dokter
 * @property DG_Jadwal_Dokter $DG_Jadwal_Dokter
 * @property DG_Kelas_Bed $DG_Kelas_Bed
 * @property DG_Jenis_Layanan $DG_Jenis_Layanan
 * @property DG_Pasien $DG_Pasien
 * @property DG_Rujuk_Balik $DG_Rujuk_Balik
 * @property DG_rujuk $DG_rujuk
 * @property CI_Upload upload
 */

class Api extends Custom_Rest_Controller
{
	public function __construct($config = 'rest')
	{
		parent::__construct($config);
		$this->load->model('Api_Base');
		//initialize file upload form
		$config =array();
		$config['upload_path']          = FCPATH.'assets/public/';
		$config['allowed_types']        = 'gif|jpg|png|docx|doc|xls|xlsx|pdf';
		$config['max_size']             = 2048;
		$config['encrypt_name']			= TRUE;

		$this->load->library('upload', $config);
	}
	public function index_get(){
		$this->my_make_respon(
			array($this->M_Base->get_config()),
			FALSE,
			'Please Read Api Documentation',
			REST_Controller::HTTP_OK
		);
	}
	public function login_post(){
		try{
			if($user_data=$this->Api_Auth->api_login($this->post('email'),$this->post('password'))){
				$this->load->helper('jwtauthorization');
				$this->my_make_respon(array('token'=>JWT_AUTHORIZATION::generateToken($user_data)));
			}else{
				throw new Exception('Invalid email and password',REST_Controller::HTTP_FORBIDDEN);
			}
		}catch (Exception $e){
			$this->my_make_respon(NULL,FALSE,$e->getMessage(),$e->getCode());
		}
	}
	public function profil_get($id_user=NULL){
		try{
			if(($user=$this->api_logged_in())===FALSE){
				throw new Exception('Not logged in',REST_Controller::HTTP_FORBIDDEN);
			}
			if($id_user){
				$me=$this->api_logged_in();
				if($me->permission->admin){
					$this->my_make_respon($this->Api_Auth->detil_user($id_user));
				}else{
					throw new Exception('Anda harus menjadi admin untuk melakukan operasi ini',REST_Controller::HTTP_FORBIDDEN);
				}
			}else{
				$this->my_make_respon($user);
			}
		}catch (Exception $e){
			$this->my_make_respon(NULL,FALSE,$e->getMessage(),$e->getCode());
		}
	}
	public function profil_post(){
		try{
			if(($user=$this->api_logged_in())===FALSE){
				throw new Exception('Not logged in',REST_Controller::HTTP_FORBIDDEN);
			}
			//form validation
			$this->form_validation->set_rules('username','Username','trim|required|min_length[5]');
			$this->form_validation->set_rules('email','Email','trim|required');
			$this->form_validation->valid_email('email');
			$this->form_validation->set_rules('full_name','Nama Lengkap','trim|alpha_numeric_spaces');
			if($this->post('is_change_password')){
				if($this->post('is_change_password')==='yes'){
					$this->form_validation->set_rules('new_password','Password','required|min_length[5]|xss_clean');
				}
			}
			//end of form validation
			if($this->form_validation->run()==FALSE)
				throw new Exception(validation_errors(),REST_Controller::HTTP_BAD_REQUEST);
			$data				= array();
			$data['username']	= $this->post('username');
			$data['email']		= $this->post('email');
			$data['full_name']	= $this->post('full_name');
			$data['phone']	= $this->post('phone');
			if($this->post('is_change_password')==='yes'){
				$data['password'] = $this->post('new_password');
			}
			if(isset($_POST['is_change_password'])){
				unset($_POST['is_change_password']);
			}
			if(isset($_POST['new_password'])){
				unset($_POST['new_password']);
			}
			$this->load->library('ion_auth');
			if(!$this->ion_auth->update($user->id,$data)){
				throw new Exception('Gagal mengupdate profil',REST_Controller::HTTP_BAD_REQUEST);
			}
			$this->my_make_respon(NULL);
		}catch (Exception $e){
			$this->my_make_respon(NULL,FALSE,$e->getMessage(),$e->getCode());
		}
	}
	///////////////////////////////////////////////////////////////////////////////////////////////////
	/// Rujukan
	///////////////////////////////////////////////////////////////////////////////////////////////////
	public function rujukan_get($id=NULL){
		try{
			if(($user=$this->api_logged_in())===FALSE){
				throw new Exception('Not logged in',REST_Controller::HTTP_FORBIDDEN);
			}
			$this->load->model('DG_rujuk');
			if($id){
				$data = $this->DG_rujuk->get_single_data(array('id_rujukan'=>$id));
				if($data===NULL)
					throw new Exception('Not Found',REST_Controller::HTTP_NOT_FOUND);
				if(!$user->permission->admin&&!in_array($data['id_rs_perujuk'],$user->permission->rs)){
					throw new Exception('Anda tidak memiliki permission di rumah sakit ini',REST_Controller::HTTP_FORBIDDEN);
				}
				$this->my_make_respon($data);
			}else{
				if(!$user->permission->admin){
					$this->DG_rujuk->setIn('tb_rujukan.id_rs_perujuk',$user->permission->rs);
				}
				$param=$this->list_param();
				$this->my_make_respon($this->DG_rujuk->get($param[0],$param[1],$param[2],$param[3]));
			}
		}catch (Exception $e){
			$this->my_make_respon(NULL,FALSE,$e->getMessage(),$e->getCode());
		}
	}
	//todo: implement this
	public function rujukan_post($id=NULL){
		try{
			if(($user=$this->api_logged_in())===FALSE){
				throw new Exception('Not logged in',REST_Controller::HTTP_FORBIDDEN);
			}
			//form validation
			switch ($_POST['pasien_type']){
				case 'old':
					$this->form_validation->set_rules('no_rm','Pasien','required|is_natural_no_zero');
					break;
				case 'new':
					$this->form_validation->set_rules('nama','Nama Pasien','required|trim|alpha_numeric_spaces');
					$this->form_validation->set_rules('kontak','Kontak Pasien','trim');
					$this->form_validation->set_rules('tgl_lahir','Tanggal Lahir','trim');
					$this->form_validation->set_rules('tempat_lahir','Tempat Lahir','trim|alpha_numeric_spaces');
					$this->form_validation->set_rules('jenis_kelamin','Jenis Kelamin','trim|in_list[Laki-laki,Perempuan]');
					$this->form_validation->set_rules('nik','NIK','trim|numeric');
					$this->form_validation->set_rules('alamat','Alamat','trim');
					break;
				default:
					throw new Exception('nilai pasien_type salah',REST_Controller::HTTP_BAD_REQUEST);
			}
			$this->form_validation->set_rules('id_rs_perujuk','Asal Rujukan','trim|required|integer');
			$this->form_validation->set_rules('id_rs_dirujuk','Tujuan Rujukan','trim|required|integer');
			$this->form_validation->set_rules('alasan_rujukan','Alasan Rujukan','trim|required');
			//end of form validation
			if($this->form_validation->run()==FALSE)
				throw new Exception(validation_errors(),REST_Controller::HTTP_BAD_REQUEST);
			$this->load->model('DG_rujuk');
			$this->load->model('DG_Pasien');
			if($id){
				$data=$this->DG_rujuk->get_single_data(array('id_rujukan'=>$id));
				if(!$data)
					throw new Exception('Not Found',REST_Controller::HTTP_NOT_FOUND);
				if(!$user->permission->admin&&!in_array($data['id_rs_perujuk'],$user->permission->rs)&&!in_array($this->post('id_rs_perujuk'),$user->permission->rs)){
					throw new Exception('Tidak dapat mengedit rujukand ari rumahsakit ini',REST_Controller::HTTP_FORBIDDEN);
				}
			}else{
				if(!$user->permission->admin&&$this->post('id_rs_perujuk')){
					throw new Exception('Anda tidak bisa membuat rujukan dari rumah sakit ini.',REST_Controller::HTTP_FORBIDDEN);
				}
				if($this->post('pasien_type')==='old'){
					$insert_data=$_POST;
					unset($insert_data['pasien_type']);
				}elseif ($this->post('pasien_type')==='new'){
					$pasien_data=array(
						'nama'			=> $this->post('nama'),
						'kontak'		=> $this->post('kontak'),
						'tgl_lahir'		=> $this->post('tgl_lahir'),
						'jenis_kelamin'	=> $this->post('jenis_kelamin'),
						'nik'			=> $this->post('nik'),
						'tempat_lahir'	=> $this->post('tempat_lahir'),
						'alamat'		=> $this->post('alamat'),
					);
					$id_pasien=$this->DG_rujuk->insert_pasien($pasien_data);
					if(!$id_pasien)
						throw new Exception('Gagal menginput pasien');
					$insert_data=array(
						'id_rs_perujuk'			=> $this->post('id_rs_perujuk'),
						'id_rs_dirujuk'			=> $this->post('id_rs_dirujuk'),
						'transportasi'			=> $this->post('transportasi'),
						'alasan_rujukan' 		=> $this->post('alasan_rujukan'),
						'diagnosis' 			=> $this->post('diagnosis'),
						'no_rm' 				=> $id_pasien,
						'kesadaran'				=> $this->post('kesadaran'),
						'tensi'					=> $this->post('tensi'),
						'nadi'					=> $this->post('nadi'),
						'suhu'					=> $this->post('suhu'),
						'pernapasan'			=> $this->post('pernapasan'),
						'keterangan_lain'		=> $this->post('keterangan_lain'),
						'hasil_lab'				=> $this->post('hasil_lab'),
						'hasil_radiologi_ekg'	=> $this->post('hasil_radiologi_ekg')
					);
					if(!$this->DG_Pasien->add_rs_owner($insert_data['no_rm'],$insert_data['id_rs_perujuk'])){
						throw new Exception('Gagal menambahkan pasien ke Fasilitas Kesehatan yang merujuk');
					}
				}else{
					throw new Exception('Input Error');
				}
				$insert_data=$this->upload_procedure($insert_data);
				if(!$this->DG_Pasien->add_rs_owner($insert_data['no_rm'],$insert_data['id_rs_dirujuk'])){
					throw new Exception('Gagal menambahkan pasien ke Fasilitas Kesehatan yang dirujuk');
				}
				if($insert_data===FALSE)
					throw new Exception('Gagal dalam mengupload lampiran',REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
				if(!$this->DG_rujuk->insert_data($insert_data)){
					throw new Exception('Input Error');
				}
			}
			$this->my_make_respon(NULL);
		}catch(Exception $e){
			$this->my_make_respon(NULL,FALSE,$e->getMessage(),$e->getCode());
		}
	}
	public function rujukan_delete($id){
		try{
			if(($user=$this->api_logged_in())===FALSE){
				throw new Exception('Not logged in',REST_Controller::HTTP_FORBIDDEN);
			}
			$this->load->model('DG_rujuk');
			$data = $this->DG_rujuk->get_single_data(array('id_rujukan'=>$id));
			if($data===NULL)
				throw new Exception('Not Found',REST_Controller::HTTP_NOT_FOUND);
			if(!$user->permission->admin&&!in_array($data['id_rs_perujuk'],$user->permission->rs)){
				throw new Exception('Anda tidak dapat menghapus rujukan dari rumah sakit ini',REST_Controller::HTTP_FORBIDDEN);
			}
			if(!$this->DG_rujuk->delete_data(array('id_rujukan'=>$id)))
				throw new Exception('Tidak dapat menghapus rujukan',REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
			$this->my_make_respon(NULL);
		}catch (Exception $e){
			$this->my_make_respon(NULL,FALSE,$e->getMessage(),$e->getCode());
		}
	}
	///////////////////////////////////////////////////////////////////////////////////////////////////
	/// Rujuk Balik
	///////////////////////////////////////////////////////////////////////////////////////////////////
	public function rujuk_balik_get($id=NULL){
		try{
			if(($user=$this->api_logged_in())===FALSE){
				throw new Exception('Not logged in',REST_Controller::HTTP_FORBIDDEN);
			}
			$this->load->model('DG_rujuk');
			if($id){
				$this->load->model('DG_Rujuk_Balik');
				$data = $this->DG_Rujuk_Balik->get_rujukan_info($id);
				if($data===NULL)
					throw new Exception('Not Found',REST_Controller::HTTP_NOT_FOUND);
				if(!$user->permission->admin&&!in_array($data['id_rs_dirujuk'],$user->permission->rs)){
					throw new Exception('Anda tidak memiliki permission di rumah sakit ini',REST_Controller::HTTP_FORBIDDEN);
				}
				$this->my_make_respon($data);
			}else{
				if(!$user->permission->admin){
					$this->DG_rujuk->setIn('tb_rujukan.id_rs_dirujuk',$user->permission->rs);
				}
				$param=$this->list_param();
				$this->my_make_respon($this->DG_rujuk->get($param[0],$param[1],$param[2],$param[3]));
			}
		}catch (Exception $e){
			$this->my_make_respon(NULL,FALSE,$e->getMessage(),$e->getCode());
		}
	}
	public function rujuk_balik_post($id=NULL){
		try{
			if(($user=$this->api_logged_in())===FALSE){
				throw new Exception('Not logged in',REST_Controller::HTTP_FORBIDDEN);
			}
			//form validation
			$this->form_validation->set_rules('status_rujukan','Status Rujukan','trim|required|in_list[Diterima,Ditolak]');
			$this->form_validation->set_rules('info_rujuk_balik','Status Rujukan','trim');
			//end of form validation
			if($this->form_validation->run()===FALSE)
				throw new Exception(validation_errors(),REST_Controller::HTTP_BAD_REQUEST);
			$this->load->model('DG_Rujuk_Balik');
			$data = $this->DG_Rujuk_Balik->get_rujukan_info($id);
			if($data===NULL)
				throw new Exception('Tidak ditemukan',REST_Controller::HTTP_NOT_FOUND);
			if(!$user->permission->admin&&!in_array($data['id_rs_dirujuk'],$user->permission->rs))
				throw new Exception('Tidak memiliki hak akses untuk merespon rujukan ini',REST_Controller::HTTP_FORBIDDEN);
			$this->db->set('direspon','NOW()',FALSE);
			$this->db->set('id_penerima',$user->id);
			if(!$this->DG_Rujuk_Balik->update_data(array('id_rujukan'=>$id),$_POST))
				throw new Exception('Gagal mengkonfirmasi rujukan');
			$this->my_make_respon(NULL);
		}catch(Exception $e){
			$this->my_make_respon(NULL,FALSE,$e->getMessage(),$e->getCode());
		}
	}
	///////////////////////////////////////////////////////////////////////////////////////////////////
	/// Pasien
	///////////////////////////////////////////////////////////////////////////////////////////////////
	public function pasien_get($id_pasien=NULL){
		try{
			if(($user=$this->api_logged_in())===FALSE){
				throw new Exception('Not logged in',REST_Controller::HTTP_FORBIDDEN);
			}
			$this->load->model('DG_Pasien');
			if($id_pasien){
				$this->my_make_respon($this->DG_Pasien->get_single_data(array('id_rm'=>$id_pasien)));
			}else{
				$param=$this->list_param();
				$this->my_make_respon($this->DG_Pasien->get($param[0],$param[1],$param[2],$param[3]));
			}
		}catch (Exception $e){
			$this->my_make_respon(NULL,FALSE,$e->getMessage(),$e->getCode());
		}
	}
	public function pasien_post($id_pasien=NULL){
		try{
			if(($user=$this->api_logged_in())===FALSE){
				throw new Exception('Not logged in',REST_Controller::HTTP_FORBIDDEN);
			}
			//form validation
			$this->form_validation->set_rules('nama','Nama Pasien','required|trim|alpha_numeric_spaces');
			$this->form_validation->set_rules('kontak','Kontak Pasien','trim');
			$this->form_validation->set_rules('tgl_lahir','Tanggal Lahir','trim');
			$this->form_validation->set_rules('tempat_lahir','Tempat Lahir','trim|alpha_numeric_spaces');
			$this->form_validation->set_rules('jenis_kelamin','Jenis Kelamin','trim|in_list[Laki-laki,Perempuan]');
			$this->form_validation->set_rules('nik','NIK','trim|numeric');
			$this->form_validation->set_rules('alamat','Alamat','trim');
			//form validation end
			if($this->form_validation->run()==FALSE)
				throw new Exception(validation_errors(),REST_Controller::HTTP_BAD_REQUEST);
			$this->load->model('DG_Pasien');
			if($id_pasien){
				$edit_data=$this->DG_Pasien->get_single_data(array('id_rm'=>$id_pasien));
				if($edit_data===NULL)
					throw new Exception('Data tidak ditemukan',REST_Controller::HTTP_NOT_FOUND);
				if(!$this->DG_Pasien->update_data(array('id_rm'=>$id_pasien),$_POST))
					throw new Exception('Gagal mengupdate data',REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
			}else{
				if(!$this->DG_Pasien->insert_data($_POST))
					throw new Exception('Gagal menambahkan data',REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
			}
			$this->my_make_respon(NULL);
		}catch(Exception $e){
			$this->my_make_respon(NULL,FALSE,$e->getMessage(),$e->getCode());
		}
	}
	public function pasien_delete($id_pasien){
		try{
			if(($user=$this->api_logged_in())===FALSE){
				throw new Exception('Not logged in',REST_Controller::HTTP_FORBIDDEN);
			}
			$this->load->model('DG_Pasien');
			if($this->DG_Pasien->get_single_data(array('id_rm'=>$id_pasien))===NULL){
				throw new Exception('Data Tidak Ditemukan',REST_Controller::HTTP_NOT_FOUND);
			}
			if(!$this->DG_Pasien->delete_data(array('id_rm'=>$id_pasien))){
				throw new Exception('Gagal menghapus pasien',REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
			}
			$this->my_make_respon(NULL);
		}catch (Exception $e){
			$this->my_make_respon(NULL,FALSE,$e->getMessage(),$e->getCode());
		}
	}
	///////////////////////////////////////////////////////////////////////////////////////////////////
	/// Rumah Sakit
	///////////////////////////////////////////////////////////////////////////////////////////////////
	public function rs_get($id_rs=NULL){
		try{
			if(($user=$this->api_logged_in())===FALSE){
				throw new Exception('Not logged in',REST_Controller::HTTP_FORBIDDEN);
			}
			$this->load->model('DG_RumahSakit');
			if($id_rs){
				if(!$user->permission->admin&&!in_array($id_rs,$user->permission->rs)){
					throw new Exception('Anda tidak memiliki permission di rumah sakit ini',REST_Controller::HTTP_FORBIDDEN);
				}
				$this->my_make_respon($this->DG_RumahSakit->get_single_data(array('id_rs'=>$id_rs)));
			}else{
				if(!$user->permission->admin){
					$this->DG_RumahSakit->setIn('id_rs',$user->permission->rs);
				}
				$param=$this->list_param();
				$this->my_make_respon($this->DG_RumahSakit->get($param[0],$param[1],$param[2],$param[3]));
			}
		}catch (Exception $e){
			$this->my_make_respon(NULL,FALSE,$e->getMessage(),$e->getCode());
		}
	}
	public function rs_post($id_rs=NULL){
		try{
			if(($user=$this->api_logged_in())===FALSE){
				throw new Exception('Not logged in',REST_Controller::HTTP_FORBIDDEN);
			}
			//form validation
			$this->form_validation->set_rules('nama','Nama Rumah Sakit','trim|required');
			$this->form_validation->set_rules('kode_rs','Kode Rumah Sakit','trim');
			$this->form_validation->set_rules('telepon','Telepon','trim|required|numeric');
			$this->form_validation->set_rules('jenis','Jenis','trim|required');
			$this->form_validation->set_rules('alamat','Alamat','required');
			$this->form_validation->set_rules('pos_lat','Latitude','trim|decimal');
			$this->form_validation->set_rules('pos_lon','Longitude','trim|decimal');
			$layanan=NULL;
			if(isset($_POST['layanan'])){
				$layanan=$_POST['layanan'];
				if(!is_array($layanan)){
					$layanan=array($layanan);
				}
				unset($_POST['layanan']);
			}
			//end of form validation
			if($this->form_validation->run()==FALSE)
				throw new Exception(validation_errors(),REST_Controller::HTTP_BAD_REQUEST);
			$this->load->model('DG_RumahSakit');
			if($id_rs){
				if(!$user->permission->admin&&!in_array($id_rs,$user->permission->rs)){
					throw new Exception('Anda tidak memiliki permission di rumah sakit ini',REST_Controller::HTTP_FORBIDDEN);
				}
				//update
				if(!$this->DG_RumahSakit->update_data(array('id_rs'=>$id_rs),$_POST,$layanan))
					throw new Exception('Gagal mengupdate data',REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
			}else{
				if(!$user->permission->admin){
					throw new Exception('Hanya admin yang bisa menambah rumah sakit',REST_Controller::HTTP_FORBIDDEN);
				}
				//insert
				if(!$this->DG_RumahSakit->insert_data($_POST,$layanan)){
					throw new Exception('Gagal menambahkan Rumahsakit',REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
				}
			}
			$this->my_make_respon(NULL);
		}catch (Exception $e){
			$this->my_make_respon(NULL,FALSE,$e->getMessage(),$e->getCode());
		}
	}
	public function rs_delete($id_rs){
		try{
			if(($user=$this->api_logged_in())===FALSE){
				throw new Exception('Not logged in',REST_Controller::HTTP_FORBIDDEN);
			}
			if(!$user->permission->admin){
				throw new Exception('Only admin can do this operation',REST_Controller::HTTP_FORBIDDEN);
			}
			if(!$id_rs){
				throw new Exception('Incomplate request',REST_Controller::HTTP_BAD_REQUEST);
			}
			$this->load->model('DG_RumahSakit');
			if(!$this->DG_RumahSakit->delete_data(array('id_rs'=>$id_rs))){
				throw new Exception('Error deleting data',REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
			}
			$this->my_make_respon(NULL);
		}catch (Exception $e){
			$this->my_make_respon(NULL,FALSE,$e->getMessage(),$e->getCode());
		}
	}
	///////////////////////////////////////////////////////////////////////////////////////////////////
	/// Bed
	///////////////////////////////////////////////////////////////////////////////////////////////////
	public function bed_get($id_bed=NULL){
		try{
			if(($user=$this->api_logged_in())===FALSE){
				throw new Exception('Not logged in',REST_Controller::HTTP_FORBIDDEN);
			}
			$this->load->model('DG_Bed');
			if($id_bed){
				$data = $this->DG_Bed->get_single_data(array('id_bed'=>$id_bed));
				if($data===NULL)
					throw new Exception('Not Found',REST_Controller::HTTP_NOT_FOUND);
				if(!$user->permission->admin&&!in_array($data['id_rs'],$user->permission->rs)){
					throw new Exception('Anda tidak memiliki permission di rumah sakit ini',REST_Controller::HTTP_FORBIDDEN);
				}
				$this->my_make_respon($data);
			}else{
				if(!$user->permission->admin){
					$this->DG_Bed->setIn('id_rs',$user->permission->rs);
				}
				$param=$this->list_param();
				$this->my_make_respon($this->DG_Bed->get($param[0],$param[1],$param[2],$param[3]));
			}
		}catch (Exception $e){
			$this->my_make_respon(NULL,FALSE,$e->getMessage(),$e->getCode());
		}
	}
	public function bed_post($id_bed=NULL){
		try{
			if(($user=$this->api_logged_in())===FALSE){
				throw new Exception('Not logged in',REST_Controller::HTTP_FORBIDDEN);
			}
			$this->form_validation->set_rules('id_rs','ID Rumah Sakit','required|trim|integer');
			$this->form_validation->set_rules('nama','Nama Bed','required|trim|alpha_numeric_spaces');
			$this->form_validation->set_rules('kapasitas_l','Kapasitas Laki-laki','required|trim|is_natural');
			$this->form_validation->set_rules('kapasitas_p','Kapasitas Perempuan','required|trim|is_natural');
			$this->form_validation->set_rules('terpakai_l','Terpakai Laki-laki','required|trim|is_natural|less_than_equal_to['.$this->input->post('kapasitas_l').']',array('less_than_equal_to'=>'Terpakai harus lebih kecil dari kapasitas'));
			$this->form_validation->set_rules('terpakai_p','Terpakai Perempuan','required|trim|is_natural|less_than_equal_to['.$this->input->post('kapasitas_p').']',array('less_than_equal_to'=>'Terpakai harus lebih kecil dari kapasitas'));
			$this->form_validation->set_rules('kelas','ID Kelas Bed','required|trim|is_natural');
			if($this->form_validation->run()==FALSE)
				throw new Exception(validation_errors(),REST_Controller::HTTP_BAD_REQUEST);
			$this->load->model('DG_Bed');
			if($id_bed){
				if(!$user->permission->admin){
					$edit_data=$this->DG_Bed->get_single_data(array('id_bed'=>$id_bed));
					if($edit_data===NULL)
						throw new Exception('Not Found',REST_Controller::HTTP_NOT_FOUND);
					if(!in_array($edit_data['id_rs'],$user->permission->rs)||!in_array($this->post('id_rs'),$user->permission->rs)){
						throw new Exception('Anda tidak boleh menambahkan/mengubah bed di rumah sakit ini',REST_Controller::HTTP_FORBIDDEN);
					}
				}
				if(!$this->DG_Bed->update_data(array('id_bed'=>$id_bed),$_POST))
					throw new Exception('Gagal mengupdate data',REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
			}else{
				if(!$user->permission->admin&&!in_array($this->post('id_rs'),$user->permission->rs)){
					throw new Exception('Anda tidak boleh menambahkan bed di rumah sakit ini',REST_Controller::HTTP_FORBIDDEN);
				}
				if(!$this->DG_Bed->insert_data($_POST))
					throw new Exception('Gagal menambahkan data',REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
			}
			$this->my_make_respon(NULL);
		}catch(Exception $e){
			$this->my_make_respon(NULL,FALSE,$e->getMessage(),$e->getCode());
		}
	}
	public function bed_delete($id_bed){
		try{
			if(($user=$this->api_logged_in())===FALSE){
				throw new Exception('Not logged in',REST_Controller::HTTP_FORBIDDEN);
			}
			$this->load->model('DG_Bed');
			$data = $this->DG_Bed->get_single_data(array('id_bed'=>$id_bed));
			if($data===NULL)
				throw new Exception('Not Found',REST_Controller::HTTP_NOT_FOUND);
			if(!$user->permission->admin&&!in_array($data['id_rs'],$user->permission->rs)){
				throw new Exception('Anda tidak dapat menghapus bed rumah sakit ini',REST_Controller::HTTP_FORBIDDEN);
			}
			if(!$this->DG_Bed->delete_data(array('id_bed'=>$id_bed)))
				throw new Exception('Tidak dapat menghapus bed',REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
			$this->my_make_respon(NULL);
		}catch (Exception $e){
			$this->my_make_respon(NULL,FALSE,$e->getMessage(),$e->getCode());
		}
	}
	///////////////////////////////////////////////////////////////////////////////////////////////////
	/// Fasilitas
	///////////////////////////////////////////////////////////////////////////////////////////////////
	public function faskes_get($id_fk=NULL){
		try{
			if(($user=$this->api_logged_in())===FALSE){
				throw new Exception('Not logged in',REST_Controller::HTTP_FORBIDDEN);
			}
			$this->load->model('DG_Faskes');
			if($id_fk){
				$data = $this->DG_Faskes->get_single_data(array('id_faskes'=>$id_fk));
				if($data===NULL)
					throw new Exception('Not Found',REST_Controller::HTTP_NOT_FOUND);
				if(!$user->permission->admin&&!in_array($data['id_rs'],$user->permission->rs)){
					throw new Exception('Anda tidak memiliki permission di rumah sakit ini',REST_Controller::HTTP_FORBIDDEN);
				}
				$this->my_make_respon($data);
			}else{
				if(!$user->permission->admin){
					$this->DG_Faskes->setIn('id_rs',$user->permission->rs);
				}
				$param=$this->list_param();
				$this->my_make_respon($this->DG_Faskes->get($param[0],$param[1],$param[2],$param[3]));
			}
		}catch (Exception $e){
			$this->my_make_respon(NULL,FALSE,$e->getMessage(),$e->getCode());
		}
	}
	public function faskes_post($id_fk=NULL){
		try{
			if(($user=$this->api_logged_in())===FALSE){
				throw new Exception('Not logged in',REST_Controller::HTTP_FORBIDDEN);
			}
			//form validation
			$this->form_validation->set_rules('id_rs','Nama Rumah Sakit','required|trim|integer');
			$this->form_validation->set_rules('nama_faskes','Nama Fasilitas','required|trim|alpha_numeric_spaces');
			$this->form_validation->set_rules('jumlah','Jumlah Fasilitas','required|trim|is_natural');
			//end of form validation
			if($this->form_validation->run()==FALSE)
				throw new Exception(validation_errors(),REST_Controller::HTTP_BAD_REQUEST);
			$this->load->model('DG_Faskes');
			if($id_fk){
				if(!$user->permission->admin){
					$edit_data=$this->DG_Faskes->get_single_data(array('id_faskes'=>$id_fk));
					if($edit_data===NULL)
						throw new Exception('Not Found',REST_Controller::HTTP_NOT_FOUND);
					if(!in_array($edit_data['id_rs'],$user->permission->rs)||!in_array($this->post('id_rs'),$user->permission->rs)){
						throw new Exception('Anda tidak boleh menambahkan/mengubah fasilitas di rumah sakit ini',REST_Controller::HTTP_FORBIDDEN);
					}
				}
				if(!$this->DG_Faskes->update_data(array('id_faskes'=>$id_fk),$_POST))
					throw new Exception('Gagal mengupdate data',REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
			}else{
				if(!$user->permission->admin&&!in_array($this->post('id_rs'),$user->permission->rs)){
					throw new Exception('Anda tidak boleh menambahkan fasilitas di rumah sakit ini',REST_Controller::HTTP_FORBIDDEN);
				}
				if(!$this->DG_Faskes->insert_data($_POST))
					throw new Exception('Gagal menambahkan data',REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
			}
			$this->my_make_respon(NULL);
		}catch(Exception $e){
			$this->my_make_respon(NULL,FALSE,$e->getMessage(),$e->getCode());
		}
	}
	public function faskes_delete($id_fk){
		try{
			if(($user=$this->api_logged_in())===FALSE){
				throw new Exception('Not logged in',REST_Controller::HTTP_FORBIDDEN);
			}
			$this->load->model('DG_Faskes');
			$data = $this->DG_Faskes->get_single_data(array('id_faskes'=>$id_fk));
			if($data===NULL)
				throw new Exception('Not Found',REST_Controller::HTTP_NOT_FOUND);
			if(!$user->permission->admin&&!in_array($data['id_rs'],$user->permission->rs)){
				throw new Exception('Anda tidak dapat menghapus faskes rumah sakit ini',REST_Controller::HTTP_FORBIDDEN);
			}
			if(!$this->DG_Faskes->delete_data(array('id_faskes'=>$id_fk)))
				throw new Exception('Tidak dapat menghapus faskes',REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
			$this->my_make_respon(NULL);
		}catch (Exception $e){
			$this->my_make_respon(NULL,FALSE,$e->getMessage(),$e->getCode());
		}
	}
	///////////////////////////////////////////////////////////////////////////////////////////////////
	/// Dokter
	///////////////////////////////////////////////////////////////////////////////////////////////////
	public function dokter_get($id_dokter=NULL){
		try{
			if(($user=$this->api_logged_in())===FALSE){
				throw new Exception('Not logged in',REST_Controller::HTTP_FORBIDDEN);
			}
			$this->load->model('DG_Dokter');
			if($id_dokter){
				$data = $this->DG_Dokter->get_single_data(array('id_dokter'=>$id_dokter));
				if($data===NULL)
					throw new Exception('Not Found',REST_Controller::HTTP_NOT_FOUND);
				if(!$user->permission->admin&&!in_array($data['id_rs'],$user->permission->rs)){
					throw new Exception('Anda tidak memiliki permission di rumah sakit ini',REST_Controller::HTTP_FORBIDDEN);
				}
				$this->my_make_respon($data);
			}else{
				if(!$user->permission->admin){
					$this->DG_Dokter->setIn('id_rs',$user->permission->rs);
				}
				$param=$this->list_param();
				$this->my_make_respon($this->DG_Dokter->get($param[0],$param[1],$param[2],$param[3]));
			}
		}catch (Exception $e){
			$this->my_make_respon(NULL,FALSE,$e->getMessage(),$e->getCode());
		}
	}
	public function dokter_post($id_dokter=NULL){
		try{
			if(($user=$this->api_logged_in())===FALSE){
				throw new Exception('Not logged in',REST_Controller::HTTP_FORBIDDEN);
			}
			//form validation
			$this->form_validation->set_rules('id_rs','Nama Rumah Sakit','required|trim|integer');
			$this->form_validation->set_rules('nama','Nama Dokter','required|trim|alpha_numeric_spaces');
			$this->form_validation->set_rules('no_idi','No Idi','trim');
			$this->form_validation->set_rules('bidang','Bidang','required|trim|alpha_numeric_spaces');
			//end of form validation
			if($this->form_validation->run()==FALSE)
				throw new Exception(validation_errors(),REST_Controller::HTTP_BAD_REQUEST);
			$this->load->model('DG_Dokter');
			if($id_dokter){
				if(!$user->permission->admin){
					$edit_data=$this->DG_Dokter->get_single_data(array('id_dokter'=>$id_dokter));
					if($edit_data===NULL)
						throw new Exception('Not Found',REST_Controller::HTTP_NOT_FOUND);
					if(!in_array($edit_data['id_rs'],$user->permission->rs)||!in_array($this->post('id_rs'),$user->permission->rs)){
						throw new Exception('Anda tidak boleh menambahkan/mengubah dokter di rumah sakit ini',REST_Controller::HTTP_FORBIDDEN);
					}
				}
				if(!$this->DG_Dokter->update_data(array('id_dokter'=>$id_dokter),$_POST))
					throw new Exception('Gagal mengupdate data',REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
			}else{
				if(!$user->permission->admin&&!in_array($this->post('id_rs'),$user->permission->rs)){
					throw new Exception('Anda tidak boleh menambahkan dokter di rumah sakit ini',REST_Controller::HTTP_FORBIDDEN);
				}
				if(!$this->DG_Dokter->insert_data($_POST))
					throw new Exception('Gagal menambahkan data',REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
			}
			$this->my_make_respon(NULL);
		}catch(Exception $e){
			$this->my_make_respon(NULL,FALSE,$e->getMessage(),$e->getCode());
		}
	}
	public function dokter_delete($id_dokter){
		try{
			if(($user=$this->api_logged_in())===FALSE){
				throw new Exception('Not logged in',REST_Controller::HTTP_FORBIDDEN);
			}
			$this->load->model('DG_Dokter');
			$data = $this->DG_Dokter->get_single_data(array('id_dokter'=>$id_dokter));
			if($data===NULL)
				throw new Exception('Not Found',REST_Controller::HTTP_NOT_FOUND);
			if(!$user->permission->admin&&!in_array($data['id_rs'],$user->permission->rs)){
				throw new Exception('Anda tidak dapat menghapus dokter rumah sakit ini',REST_Controller::HTTP_FORBIDDEN);
			}
			if(!$this->DG_Dokter->delete_data(array('id_dokter'=>$id_dokter)))
				throw new Exception('Tidak dapat menghapus dokter',REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
			$this->my_make_respon(NULL);
		}catch (Exception $e){
			$this->my_make_respon(NULL,FALSE,$e->getMessage(),$e->getCode());
		}
	}
	///////////////////////////////////////////////////////////////////////////////////////////////////
	/// Jadwal Dokter
	///////////////////////////////////////////////////////////////////////////////////////////////////
	public function jadwal_dokter_get($id_jadwal=NULL){
		try{
			if(($user=$this->api_logged_in())===FALSE){
				throw new Exception('Not logged in',REST_Controller::HTTP_FORBIDDEN);
			}
			$this->load->model('DG_Jadwal_Dokter');
			if($id_jadwal){
				$data = $this->DG_Jadwal_Dokter->get_single_data(array('id_jadwal_dokter'=>$id_jadwal));
				if($data===NULL)
					throw new Exception('Not Found',REST_Controller::HTTP_NOT_FOUND);
				if(!$user->permission->admin&&!in_array($data['id_rs'],$user->permission->rs)){
					throw new Exception('Anda tidak memiliki permission di rumah sakit ini',REST_Controller::HTTP_FORBIDDEN);
				}
				$this->my_make_respon($data);
			}else{
				if(!$user->permission->admin){
					$this->DG_Jadwal_Dokter->setIn('tb_dokter.id_rs',$user->permission->rs);
				}
				$param=$this->list_param();
				$this->my_make_respon($this->DG_Jadwal_Dokter->get($param[0],$param[1],$param[2],$param[3]));
			}
		}catch (Exception $e){
			$this->my_make_respon(NULL,FALSE,$e->getMessage(),$e->getCode());
		}
	}
	public function jadwal_dokter_post($id_jadwal=NULL){
		try{
			if(($user=$this->api_logged_in())===FALSE){
				throw new Exception('Not logged in',REST_Controller::HTTP_FORBIDDEN);
			}
			//form validation
			$this->form_validation->set_rules('id_dokter','Nama Rumah Sakit','required|trim|integer');
			$this->form_validation->set_rules('hari','Hari','required|trim');
			$this->form_validation->set_rules('jam_mulai','Jam Mulai','required|trim');
			$this->form_validation->set_rules('jam_selesai','Jam Selesai','required|trim');
			//end of form validation
			if($this->form_validation->run()==FALSE)
				throw new Exception(validation_errors(),REST_Controller::HTTP_BAD_REQUEST);
			$this->load->model('DG_Jadwal_Dokter');
			if($id_jadwal){
				if(!$user->permission->admin){
					$edit_data=$this->DG_Jadwal_Dokter->get_single_data(array('id_jadwal_dokter'=>$id_jadwal));
					if($edit_data===NULL)
						throw new Exception('Not Found',REST_Controller::HTTP_NOT_FOUND);
					if(!in_array($this->DG_Jadwal_Dokter->get_dokter_rs($edit_data['id_dokter']),$user->permission->rs)||!in_array($this->DG_Jadwal_Dokter->get_dokter_rs($this->post('id_dokter')),$user->permission->rs)){
						throw new Exception('Anda tidak boleh menambahkan/mengubah jadwal dokter rumah sakit ini',REST_Controller::HTTP_FORBIDDEN);
					}
				}
				if(!$this->DG_Jadwal_Dokter->update_data(array('id_jadwal_dokter'=>$id_jadwal),$_POST))
					throw new Exception('Gagal mengupdate data',REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
			}else{
				if(!$user->permission->admin&&!in_array($this->DG_Jadwal_Dokter->get_dokter_rs($this->post('id_dokter')),$user->permission->rs)){
					throw new Exception('Anda tidak boleh menambahkan jadwal dokter di rumah sakit ini',REST_Controller::HTTP_FORBIDDEN);
				}
				if(!$this->DG_Jadwal_Dokter->insert_data($_POST))
					throw new Exception('Gagal menambahkan data',REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
			}
			$this->my_make_respon(NULL);
		}catch(Exception $e){
			$this->my_make_respon(NULL,FALSE,$e->getMessage(),$e->getCode());
		}
	}
	public function jadwal_dokter_delete($id_jadwal){
		try{
			if(($user=$this->api_logged_in())===FALSE){
				throw new Exception('Not logged in',REST_Controller::HTTP_FORBIDDEN);
			}
			$this->load->model('DG_Jadwal_Dokter');
			$data = $this->DG_Jadwal_Dokter->get_single_data(array('id_jadwal_dokter'=>$id_jadwal));
			if($data===NULL)
				throw new Exception('Not Found',REST_Controller::HTTP_NOT_FOUND);
			if(!$user->permission->admin&&!in_array($data['id_rs'],$user->permission->rs)){
				throw new Exception('Anda tidak dapat menghapus jadwal dokter rumah sakit ini',REST_Controller::HTTP_FORBIDDEN);
			}
			if(!$this->DG_Jadwal_Dokter->delete_data(array('id_jadwal_dokter'=>$id_jadwal)))
				throw new Exception('Tidak dapat menghapus jadwal dokter',REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
			$this->my_make_respon(NULL);
		}catch (Exception $e){
			$this->my_make_respon(NULL,FALSE,$e->getMessage(),$e->getCode());
		}
	}
	///////////////////////////////////////////////////////////////////////////////////////////////////
	/// Kelas Bed
	///////////////////////////////////////////////////////////////////////////////////////////////////
	public function kelas_bed_get($id_kelas_bed=NULL){
		try{
			if(($user=$this->api_logged_in())===FALSE){
				throw new Exception('Not logged in',REST_Controller::HTTP_FORBIDDEN);
			}
			$this->load->model('DG_Kelas_Bed');
			if($id_kelas_bed){
				$data = $this->DG_Kelas_Bed->get_single_data(array('id_kelas_bed'=>$id_kelas_bed));
				if($data===NULL)
					throw new Exception('Not Found',REST_Controller::HTTP_NOT_FOUND);
				if(!$user->permission->admin){
					throw new Exception('Hanya admin yang bisa melakukan ini',REST_Controller::HTTP_FORBIDDEN);
				}
				$this->my_make_respon($data);
			}else{
				$param=$this->list_param();
				$this->my_make_respon($this->DG_Kelas_Bed->get($param[0],$param[1],$param[2],$param[3]));
			}
		}catch (Exception $e){
			$this->my_make_respon(NULL,FALSE,$e->getMessage(),$e->getCode());
		}
	}
	public function kelas_bed_post($id_kelas_bed=NULL){
		try{
			if(($user=$this->api_logged_in())===FALSE){
				throw new Exception('Not logged in',REST_Controller::HTTP_FORBIDDEN);
			}
			//form validation
			$this->form_validation->set_rules('nama','Nama','required|trim');
			$this->form_validation->set_rules('unigender','Unigender','required|trim|in_list[0,1]');
			//end of form validation
			if($this->form_validation->run()==FALSE)
				throw new Exception(validation_errors(),REST_Controller::HTTP_BAD_REQUEST);
			$this->load->model('DG_Kelas_Bed');
			if($id_kelas_bed){
				if(!$user->permission->admin){
					throw new Exception('Hanya admin yang bisa melakukan ini',REST_Controller::HTTP_FORBIDDEN);
				}
				if(!$this->DG_Kelas_Bed->update_data(array('id_kelas_bed'=>$id_kelas_bed),$_POST))
					throw new Exception('Gagal mengupdate data',REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
			}else{
				if(!$user->permission->admin){
					throw new Exception('Hanya admin yang bisa melakukan ini',REST_Controller::HTTP_FORBIDDEN);
				}
				if(!$this->DG_Kelas_Bed->insert_data($_POST))
					throw new Exception('Gagal menambahkan data',REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
			}
			$this->my_make_respon(NULL);
		}catch(Exception $e){
			$this->my_make_respon(NULL,FALSE,$e->getMessage(),$e->getCode());
		}
	}
	public function kelas_bed_delete($id_kelas_bed){
		try{
			if(($user=$this->api_logged_in())===FALSE){
				throw new Exception('Not logged in',REST_Controller::HTTP_FORBIDDEN);
			}
			$this->load->model('DG_Kelas_Bed');
			if(!$user->permission->admin){
				throw new Exception('Hanya admin yang bisa melakukan ini',REST_Controller::HTTP_FORBIDDEN);
			}
			$data = $this->DG_Kelas_Bed->get_single_data(array('id_kelas_bed'=>$id_kelas_bed));
			if($data===NULL){
				throw new Exception('Not Found',REST_Controller::HTTP_NOT_FOUND);
			}
			if(!$this->DG_Kelas_Bed->delete_data(array('id_kelas_bed'=>$id_kelas_bed)))
				throw new Exception('Gagal menghapus data',REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
			$this->my_make_respon(NULL);
		}catch (Exception $e){
			$this->my_make_respon(NULL,FALSE,$e->getMessage(),$e->getCode());
		}
	}
	///////////////////////////////////////////////////////////////////////////////////////////////////
	/// Jenis Layanan
	///////////////////////////////////////////////////////////////////////////////////////////////////
	public function jenis_layanan_get($id_jenis_layanan=NULL){
		try{
			if(($user=$this->api_logged_in())===FALSE){
				throw new Exception('Not logged in',REST_Controller::HTTP_FORBIDDEN);
			}
			$this->load->model('DG_Jenis_Layanan');
			if($id_jenis_layanan){
				$data = $this->DG_Jenis_Layanan->get_single_data(array('id_jenis_layanan'=>$id_jenis_layanan));
				if($data===NULL)
					throw new Exception('Not Found',REST_Controller::HTTP_NOT_FOUND);
				if(!$user->permission->admin){
					throw new Exception('Hanya admin yang bisa melakukan ini',REST_Controller::HTTP_FORBIDDEN);
				}
				$this->my_make_respon($data);
			}else{
				$param=$this->list_param();
				$this->my_make_respon($this->DG_Jenis_Layanan->get($param[0],$param[1],$param[2],$param[3]));
			}
		}catch (Exception $e){
			$this->my_make_respon(NULL,FALSE,$e->getMessage(),$e->getCode());
		}
	}
	public function jenis_layanan_post($id_jenis_layanan=NULL){
		try{
			if(($user=$this->api_logged_in())===FALSE){
				throw new Exception('Not logged in',REST_Controller::HTTP_FORBIDDEN);
			}
			//form validation
			$this->form_validation->set_rules('nama','Nama','required|trim');
			//end of form validation
			if($this->form_validation->run()==FALSE)
				throw new Exception(validation_errors(),REST_Controller::HTTP_BAD_REQUEST);
			$this->load->model('DG_Jenis_Layanan');
			if($id_jenis_layanan){
				if(!$user->permission->admin){
					throw new Exception('Hanya admin yang bisa melakukan ini',REST_Controller::HTTP_FORBIDDEN);
				}
				if(!$this->DG_Jenis_Layanan->update_data(array('id_jenis_layanan'=>$id_jenis_layanan),$_POST))
					throw new Exception('Gagal mengupdate data',REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
			}else{
				if(!$user->permission->admin){
					throw new Exception('Hanya admin yang bisa melakukan ini',REST_Controller::HTTP_FORBIDDEN);
				}
				if(!$this->DG_Jenis_Layanan->insert_data($_POST))
					throw new Exception('Gagal menambahkan data',REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
			}
			$this->my_make_respon(NULL);
		}catch(Exception $e){
			$this->my_make_respon(NULL,FALSE,$e->getMessage(),$e->getCode());
		}
	}
	public function jenis_layanan_delete($id_jenis_layanan){
		try{
			if(($user=$this->api_logged_in())===FALSE){
				throw new Exception('Not logged in',REST_Controller::HTTP_FORBIDDEN);
			}
			$this->load->model('DG_Jenis_Layanan');
			if(!$user->permission->admin){
				throw new Exception('Hanya admin yang bisa melakukan ini',REST_Controller::HTTP_FORBIDDEN);
			}
			$data = $this->DG_Jenis_Layanan->get_single_data(array('id_jenis_layanan'=>$id_jenis_layanan));
			if($data===NULL){
				throw new Exception('Not Found',REST_Controller::HTTP_NOT_FOUND);
			}
			if(!$this->DG_Jenis_Layanan->delete_data(array('id_jenis_layanan'=>$id_jenis_layanan)))
				throw new Exception('Gagal menghapus data',REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
			$this->my_make_respon(NULL);
		}catch (Exception $e){
			$this->my_make_respon(NULL,FALSE,$e->getMessage(),$e->getCode());
		}
	}
	///////////////////////////////////////////////////////////////////////////////////////////////////
	/// Lainya
	///////////////////////////////////////////////////////////////////////////////////////////////////
	public function selection_rs_get(){
		try{
			if(($user=$this->api_logged_in())===FALSE){
				throw new Exception('Not logged in',REST_Controller::HTTP_FORBIDDEN);
			}
			if(!$user->permission->admin){
				$this->db->where_in('id_rs',$user->permission->rs);
			}
			$data=$this->db->select('id_rs,nama')->get('tb_rs')->result();
			$this->my_make_respon($data);
		}catch (Exception $e){
			$this->my_make_respon(NULL,FALSE,$e->getMessage(),$e->getCode());
		}
	}
	public function enum_get($type){
		$data=$this->db->select('value')->where('type_enum',$type)->get('tb_enum')->result();
		$this->my_make_respon($data);
	}
	private function upload_procedure($insert_data=array()){
		//upload attachment
		$attachment_fields=array('attachment_1','attachment_2','attachment_3');
		foreach ($attachment_fields as $attch){
			if(!empty($_FILES[$attch]['name'])){
				if(!$this->upload->do_upload($attch)){
					return false;
				}
				$insert_data[$attch]=$this->upload->data('file_name');
			}
		}
		return $insert_data;
	}
	public function rs_recomendation_post($id_perujuk){
		$this->load->model('DG_rujuk');
		$data=$this->DG_rujuk->rs_recomendation($this->post('id_kelas_bed'),$this->post('id_jenis_layanan'),$id_perujuk);
		$this->my_make_respon($data);
	}
}
